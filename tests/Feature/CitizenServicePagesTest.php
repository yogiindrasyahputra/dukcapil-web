<?php

namespace Tests\Feature;

use App\Models\CitizenApplication;
use App\Support\CitizenServices;
use Illuminate\Support\Str;
use Tests\TestCase;

class CitizenServicePagesTest extends TestCase
{
    public function test_homepage_links_to_a_dedicated_page_for_every_service(): void
    {
        $artworks = [
            'ktp-el' => 'ktp-elektronik-background-hd.webp',
            'kartu-keluarga' => 'kartu-keluarga-background-hd.webp',
            'akta-kelahiran' => 'akta-kelahiran-background-hd.webp',
            'akta-kematian' => 'akta-kematian-background-hd.webp',
            'pindah-datang' => 'pindah-datang-background-hd.webp',
            'kia' => 'kartu-identitas-anak-background-hd.webp',
        ];
        $response = $this->get(route('home'))
            ->assertOk()
            ->assertSee('<html lang="id"', false)
            ->assertSee('theme-toggle', false)
            ->assertSee('name="theme-color" content="#f3f7fc"', false)
            ->assertSee('class="home-page"', false)
            ->assertSee('hero-landscape.jpg');

        $this->assertFileExists(public_path('images/hero-landscape.jpg'));

        foreach (CitizenServices::all() as $slug => $service) {
            $response->assertSee($service['title']);
            $response->assertSee(route('services.show', ['slug' => $slug]));
            $response->assertSee($artworks[$slug]);

            $servicePage = $this->get(route('services.show', ['slug' => $slug]))
                ->assertOk()
                ->assertSee($service['title'])
                ->assertSee('service-document-image')
                ->assertSee($artworks[$slug])
                ->assertSee('name="documents[', false)
                ->assertSee('data-service-slug="'.$slug.'"', false)
                ->assertSee('role="group" aria-label="Tahap formulir pengajuan"', false)
                ->assertSee('aria-controls="application-step-4"', false)
                ->assertSee('role="status" aria-live="polite"', false)
                ->assertSee('Ringkasan pengajuan');

            if ($slug === 'ktp-el') {
                $servicePage->assertSee('data-lost-document-field', false)
                    ->assertSee('data-ktp-marital-status', false);
            }

            if ($slug === 'kia') {
                $servicePage->assertSee('data-child-photo-field', false)
                    ->assertSee('Pas foto anak (wajib untuk usia 5 tahun ke atas)');
            }
        }
    }

    public function test_application_tracking_page_shows_a_receipt_and_masks_the_nik(): void
    {
        $application = new CitizenApplication([
            'tracking_code' => (string) Str::uuid(),
            'service_slug' => 'ktp-el',
            'applicant_name' => 'Pemohon Contoh',
            'nik' => '1234567890129012',
            'family_card_number' => '9876543210987654',
            'birth_date' => '1990-01-01',
            'phone' => '081234567890',
            'address' => 'Jalan Contoh No. 1',
            'office' => 'Kantor Dinas (pusat)',
            'visit_date' => '2026-10-20',
            'time_slot' => '09.00 - 10.00',
            'details' => ['application_type' => 'new', 'marital_status' => 'unmarried'],
            'documents' => [],
            'status' => 'submitted',
        ]);

        $this->view('applications.track', [
            'application' => $application,
            'service' => CitizenServices::find($application->service_slug),
        ])
            ->assertSee('Pengajuan diterima.')
            ->assertSee('Menunggu verifikasi')
            ->assertSee('Perjalanan pengajuan')
            ->assertSee('Alur operasional')
            ->assertSee('Lima tahap layanan')
            ->assertSee('Sinkron otomatis')
            ->assertSee('Simulasi alur status')
            ->assertSee('Ilustrasi · bukan log petugas')
            ->assertSee(route('applications.track.status', ['code' => $application->tracking_code]))
            ->assertSee('Pengajuan dikirim')
            ->assertSee('Status saat ini')
            ->assertSee($application->tracking_code)
            ->assertSee('data-copy-tracking="'.$application->tracking_code.'"', false)
            ->assertSee('Salin kode')
            ->assertSee('Cetak bukti')
            ->assertSee('1234 •••• •••• 9012')
            ->assertDontSee('1234567890129012');
    }

    public function test_tracking_dashboard_maps_each_application_status_to_operational_stages(): void
    {
        $application = new CitizenApplication([
            'tracking_code' => (string) Str::uuid(),
            'service_slug' => 'ktp-el',
            'applicant_name' => 'Pemohon Contoh',
            'nik' => '1234567890129012',
            'family_card_number' => '9876543210987654',
            'birth_date' => '1990-01-01',
            'phone' => '081234567890',
            'address' => 'Jalan Contoh No. 1',
            'office' => 'Kantor Dinas (pusat)',
            'visit_date' => '2026-10-20',
            'time_slot' => '09.00 - 10.00',
            'details' => ['application_type' => 'new', 'marital_status' => 'unmarried'],
            'documents' => [],
        ]);

        foreach ([
            'submitted' => 'current',
            'verified' => 'current',
            'approved' => 'current',
            'rejected' => 'attention',
            'completed' => 'complete',
        ] as $status => $stageState) {
            $application->status = $status;

            $this->view('applications.track', [
                'application' => $application,
                'service' => CitizenServices::find($application->service_slug),
            ])
                ->assertSee('data-status="'.$status.'"', false)
                ->assertSee('pipeline-stage--'.$stageState, false);
        }
    }
}
