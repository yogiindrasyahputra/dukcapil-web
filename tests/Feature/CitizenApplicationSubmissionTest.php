<?php

namespace Tests\Feature;

use App\Models\CitizenApplication;
use App\Support\CitizenServices;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CitizenApplicationSubmissionTest extends TestCase
{
    use DatabaseTransactions;

    public function test_confirmed_applications_for_every_service_are_saved_to_sql(): void
    {
        $this->withoutMiddleware(ThrottleRequests::class);
        Storage::fake('local');
        $visitDate = now()->addWeekday()->toDateString();
        $serviceDetails = [
            'ktp-el' => ['application_type' => 'new', 'marital_status' => 'unmarried'],
            'kartu-keluarga' => ['application_type' => 'new', 'family_change' => 'Pembaruan data keluarga'],
            'akta-kelahiran' => [
                'child_name' => 'Anak Contoh',
                'child_birth_date' => now()->subYear()->toDateString(),
                'child_birth_place' => 'Padangsidimpuan',
            ],
            'akta-kematian' => [
                'deceased_name' => 'Almarhum Contoh',
                'death_date' => now()->subDay()->toDateString(),
                'death_place' => 'Padangsidimpuan',
            ],
            'pindah-datang' => ['direction' => 'outgoing', 'destination' => 'Jalan Tujuan No. 2'],
            'kia' => [
                'child_name' => 'Anak Contoh',
                'child_birth_date' => now()->subYears(2)->toDateString(),
            ],
        ];

        foreach (CitizenServices::all() as $slug => $service) {
            $index = array_search($slug, array_keys($serviceDetails), true) + 1;
            $nik = sprintf('%016d', $index);
            $documents = [];

            foreach ($service['documents'] as $key => $label) {
                if (($slug === 'ktp-el' && $key === 'police_letter')
                    || ($slug === 'kia' && $key === 'child_photo')) {
                    continue;
                }

                $documents[$key] = UploadedFile::fake()->image("{$key}.jpg");
            }

            $response = $this->post(route('services.store', ['slug' => $slug]), [
                'applicant_name' => "Pemohon {$slug}",
                'nik' => $nik,
                'family_card_number' => sprintf('%016d', $index + 100),
                'birth_date' => '1990-01-01',
                'phone' => '081234567890',
                'address' => 'Jalan Contoh No. 1',
                'office' => 'Kantor Dinas (pusat)',
                'visit_date' => $visitDate,
                'time_slot' => '09.00 - 10.00',
                'details' => $serviceDetails[$slug],
                'documents' => $documents,
                'agree' => '1',
            ]);

            $response->assertRedirect();
            $trackingCode = basename(parse_url($response->headers->get('Location'), PHP_URL_PATH));
            $application = CitizenApplication::where('tracking_code', $trackingCode)->firstOrFail();

            $this->assertDatabaseHas('citizen_applications', [
                'tracking_code' => $trackingCode,
                'service_slug' => $slug,
                'status' => 'submitted',
            ]);
            $this->assertSame($nik, $application->nik);
            $this->assertSame($serviceDetails[$slug], $application->details);
            $this->assertNotSame(
                $nik,
                DB::table('citizen_applications')->where('tracking_code', $trackingCode)->value('nik')
            );

            foreach ($application->documents as $document) {
                Storage::disk('local')->assertExists($document['path']);
            }

            $this->get(route('applications.track', ['code' => $trackingCode]))
                ->assertOk()
                ->assertSee("Pemohon {$slug}");
        }
    }

    public function test_application_is_not_saved_without_confirmation_consent(): void
    {
        $this->withoutMiddleware(ThrottleRequests::class);
        Storage::fake('local');
        $applicationsBefore = DB::table('citizen_applications')->count();
        $documents = [
            'family_card' => UploadedFile::fake()->image('family-card.jpg'),
            'supporting_document' => UploadedFile::fake()->image('supporting-document.jpg'),
        ];

        $this->post(route('services.store', ['slug' => 'ktp-el']), [
            'applicant_name' => 'Pemohon Tanpa Persetujuan',
            'nik' => '1234567890123456',
            'family_card_number' => '9876543210987654',
            'birth_date' => '1990-01-01',
            'phone' => '081234567890',
            'address' => 'Jalan Contoh No. 1',
            'office' => 'Kantor Dinas (pusat)',
            'visit_date' => now()->addWeekday()->toDateString(),
            'time_slot' => '09.00 - 10.00',
            'details' => ['application_type' => 'new', 'marital_status' => 'unmarried'],
            'documents' => $documents,
        ])
            ->assertSessionHasErrors('agree');

        $this->assertSame($applicationsBefore, DB::table('citizen_applications')->count());
    }
}
