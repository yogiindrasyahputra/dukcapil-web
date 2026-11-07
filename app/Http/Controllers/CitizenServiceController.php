<?php

namespace App\Http\Controllers;

use App\Models\CitizenApplication;
use App\Support\CitizenServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use RuntimeException;
use Throwable;

class CitizenServiceController extends Controller
{
    public function index()
    {
        return view('welcome', ['services' => CitizenServices::all()]);
    }

    public function show(string $slug)
    {
        return view('services.show', [
            'slug' => $slug,
            'service' => CitizenServices::find($slug),
        ]);
    }

    public function store(Request $request, string $slug): RedirectResponse
    {
        $service = CitizenServices::find($slug);
        $detailsRules = [];

        foreach ($service['fields'] as $key => $field) {
            $isConditionalKtpField = $slug === 'ktp-el'
                && $key === 'marital_status';
            $detailsRules["details.{$key}"] = [
                $isConditionalKtpField ? 'required_if:details.application_type,new' : 'required',
                ...($isConditionalKtpField ? ['nullable'] : []),
                'string',
                'max:255',
            ];

            if (isset($field['options'])) {
                $detailsRules["details.{$key}"][] = 'in:'.implode(',', array_keys($field['options']));
            } elseif (($field['type'] ?? null) === 'date') {
                $detailsRules["details.{$key}"] = ['required', 'date', 'before_or_equal:today'];
            }
        }

        $fileRules = [];
        foreach ($service['documents'] as $key => $label) {
            if (($slug === 'ktp-el' && $key === 'police_letter')
                || ($slug === 'kia' && $key === 'child_photo')) {
                continue;
            }

            $fileRules["documents.{$key}"] = ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'];
        }
        if ($slug === 'ktp-el') {
            $fileRules['documents.police_letter'] = [
                'required_if:details.application_type,lost',
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'max:5120',
            ];
        }
        if ($slug === 'kia') {
            $fileRules['documents.child_photo'] = [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'max:5120',
            ];
        }

        $validated = $request->validate(array_merge([
            'applicant_name' => ['required', 'string', 'max:150'],
            'nik' => ['required', 'regex:/^[0-9]{16}$/'],
            'family_card_number' => ['required', 'regex:/^[0-9]{16}$/'],
            'birth_date' => ['required', 'date', 'before_or_equal:today'],
            'phone' => ['required', 'regex:/^0[0-9]{9,12}$/'],
            'address' => ['required', 'string', 'max:1000'],
            'office' => ['required', 'in:Kantor Dinas (pusat),Kantor Kecamatan Utara,Kantor Kecamatan Selatan'],
            'visit_date' => ['required', 'date', 'after_or_equal:today'],
            'time_slot' => ['required', 'in:09.00 - 10.00,10.00 - 11.00,13.00 - 14.00,14.00 - 15.00'],
            'agree' => ['accepted'],
        ], $detailsRules, $fileRules));

        if (in_array((int) date('w', strtotime($validated['visit_date'])), [0, 6], true)) {
            throw ValidationException::withMessages([
                'visit_date' => 'Kantor tutup pada akhir pekan. Silakan pilih hari kerja.',
            ]);
        }

        if ($slug === 'ktp-el'
            && $validated['details']['application_type'] === 'new'
            && $validated['details']['marital_status'] !== 'married'
            && now()->diffInYears($validated['birth_date']) < 17) {
            throw ValidationException::withMessages([
                'birth_date' => 'Pengajuan KTP-el baru hanya untuk pemohon berusia 17 tahun ke atas atau yang sudah menikah.',
            ]);
        }

        if ($slug === 'kia') {
            $childAge = now()->diffInYears($validated['details']['child_birth_date']);
            if ($childAge >= 17) {
                throw ValidationException::withMessages([
                    'details.child_birth_date' => 'KIA diperuntukkan bagi anak yang berusia di bawah 17 tahun.',
                ]);
            }

            if ($childAge >= 5 && ! $request->hasFile('documents.child_photo')) {
                throw ValidationException::withMessages([
                    'documents.child_photo' => 'Pas foto wajib untuk anak berusia 5 tahun ke atas.',
                ]);
            }
        }

        $trackingCode = (string) Str::uuid();
        $storedFiles = [];

        try {
            DB::transaction(function () use ($request, $service, $slug, $validated, $trackingCode, &$storedFiles) {
                $documents = [];
                foreach ($service['documents'] as $key => $label) {
                    if ($slug === 'ktp-el' && $key === 'police_letter') {
                        continue;
                    }

                    $file = $request->file("documents.{$key}");
                    if ($file) {
                        $path = Storage::disk('local')->putFile("citizen-applications/{$trackingCode}", $file);
                        if (! is_string($path)) {
                            throw new RuntimeException("Gagal menyimpan berkas untuk {$label}.");
                        }
                        $storedFiles[] = $path;
                        $documents[$key] = ['label' => $label, 'path' => $path];
                    }
                }

                if ($slug === 'ktp-el' && $request->hasFile('documents.police_letter')) {
                    $file = $request->file('documents.police_letter');
                    $path = Storage::disk('local')->putFile("citizen-applications/{$trackingCode}", $file);
                    if (! is_string($path)) {
                        throw new RuntimeException('Gagal menyimpan surat keterangan kehilangan.');
                    }
                    $storedFiles[] = $path;
                    $documents['police_letter'] = [
                        'label' => $service['documents']['police_letter'],
                        'path' => $path,
                    ];
                }

                CitizenApplication::create([
                    'tracking_code' => $trackingCode,
                    'service_slug' => $slug,
                    'applicant_name' => $validated['applicant_name'],
                    'nik' => $validated['nik'],
                    'family_card_number' => $validated['family_card_number'],
                    'birth_date' => $validated['birth_date'],
                    'phone' => $validated['phone'],
                    'address' => $validated['address'],
                    'office' => $validated['office'],
                    'visit_date' => $validated['visit_date'],
                    'time_slot' => $validated['time_slot'],
                    'details' => $validated['details'],
                    'documents' => $documents,
                    'status' => 'submitted',
                ]);
            });
        } catch (Throwable $exception) {
            foreach ($storedFiles as $path) {
                Storage::disk('local')->delete($path);
            }

            throw $exception;
        }

        return redirect()->route('applications.track', ['code' => $trackingCode]);
    }

    public function track(string $code)
    {
        $application = CitizenApplication::where('tracking_code', $code)->firstOrFail();

        return view('applications.track', [
            'application' => $application,
            'service' => CitizenServices::find($application->service_slug),
        ]);
    }

    public function trackStatus(string $code): JsonResponse
    {
        $application = CitizenApplication::where('tracking_code', $code)->firstOrFail();

        return response()->json([
            'status' => $application->status,
            'updated_at' => $application->updated_at?->format('U.u'),
        ]);
    }
}
