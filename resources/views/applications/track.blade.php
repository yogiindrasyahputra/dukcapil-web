@extends('layouts.app')

@section('title', 'Pelacakan pengajuan')

@php
    $statusMeta = match ($application->status) {
        'submitted' => [
            'label' => 'Menunggu verifikasi',
            'tone' => 'waiting',
            'progress' => 28,
            'headline' => 'Pengajuan diterima.',
            'summary' => 'Permohonan anda sedang menunggu pemeriksaan awal oleh petugas.',
            'nextAction' => 'Petugas akan mengecek kelengkapan dokumen dan data pemohon.',
            'panelLabel' => 'Menunggu pemeriksaan awal',
            'cta' => 'Kembali ke layanan',
            'ctaIcon' => '↗',
        ],
        'verified' => [
            'label' => 'Data diverifikasi',
            'tone' => 'processing',
            'progress' => 62,
            'headline' => 'Dokumen sedang diperiksa.',
            'summary' => 'Data yang Anda kirim sudah masuk ke tahap verifikasi petugas.',
            'nextAction' => 'Silakan tetap mengikuti jadwal kunjungan dan siapkan dokumen asli.',
            'panelLabel' => 'Proses verifikasi aktif',
            'cta' => 'Lihat jadwal',
            'ctaIcon' => '→',
        ],
        'approved' => [
            'label' => 'Disetujui',
            'tone' => 'approved',
            'progress' => 82,
            'headline' => 'Permohonan disetujui.',
            'summary' => 'Permohonan Anda telah memenuhi syarat dan berlanjut ke tahap finalisasi.',
            'nextAction' => 'Ikuti jadwal yang telah ditetapkan dan bawa dokumen pendukung yang diperlukan.',
            'panelLabel' => 'Persetujuan siap finalisasi',
            'cta' => 'Riwayat layanan',
            'ctaIcon' => '✓',
        ],
        'rejected' => [
            'label' => 'Perlu perbaikan',
            'tone' => 'rejected',
            'progress' => 40,
            'headline' => 'Ada dokumen yang perlu dilengkapi.',
            'summary' => 'Permohonan Anda memerlukan penyesuaian agar dapat dilanjutkan.',
            'nextAction' => 'Periksa kembali catatan petugas dan lengkapi dokumen yang diminta.',
            'panelLabel' => 'Perbaikan dokumen',
            'cta' => 'Perbarui dokumen',
            'ctaIcon' => '↺',
        ],
        'completed' => [
            'label' => 'Selesai',
            'tone' => 'completed',
            'progress' => 100,
            'headline' => 'Pengajuan selesai diproses.',
            'summary' => 'Semua tahapan administrasi telah selesai sesuai prosedur.',
            'nextAction' => 'Anda dapat menyimpan bukti pelayanan dan mengikuti instruksi selanjutnya bila diperlukan.',
            'panelLabel' => 'Proses selesai',
            'cta' => 'Bukti layanan',
            'ctaIcon' => '✓',
        ],
        default => [
            'label' => 'Menunggu konfirmasi',
            'tone' => 'waiting',
            'progress' => 35,
            'headline' => 'Pengajuan sedang diproses.',
            'summary' => 'Tinjauan terhadap pengajuan Anda masih berlangsung.',
            'nextAction' => 'Pantau halaman ini secara berkala untuk update terbaru.',
            'panelLabel' => 'Update terbaru',
            'cta' => 'Kembali ke layanan',
            'ctaIcon' => '↗',
        ],
    };
    $statusLabel = $statusMeta['label'];
    $statusTone = $statusMeta['tone'];
    $progress = $statusMeta['progress'];
    $headline = $statusMeta['headline'];
    $summary = $statusMeta['summary'];
    $nextAction = $statusMeta['nextAction'];
    $panelLabel = $statusMeta['panelLabel'];
    $visitDate = $application->visit_date?->locale('id')->translatedFormat('l, d F Y') ?? 'Tanggal belum ditentukan';
    $submittedAt = $application->created_at?->locale('id')->translatedFormat('d F Y, H.i') ?? 'Pengajuan sudah tercatat';
    $maskedNik = substr($application->nik, 0, 4).' •••• •••• '.substr($application->nik, -4);
    $timelineSteps = [
        ['state' => 'is-complete', 'marker' => '✓', 'title' => 'Pengajuan dikirim', 'detail' => $submittedAt],
        ['state' => 'is-current', 'marker' => '2', 'title' => 'Status saat ini', 'detail' => $statusLabel.' — '.($application->status === 'submitted' ? 'Petugas akan memeriksa data dan dokumen Anda.' : ($application->status === 'rejected' ? 'Dokumen perlu disesuaikan agar pengajuan bisa dilanjutkan.' : 'Periksa kembali halaman ini untuk mengetahui status terbaru.'))],
        ['state' => '', 'marker' => '3', 'title' => 'Keputusan final', 'detail' => match ($application->status) {
            'completed' => 'Pengajuan telah selesai dan bukti layanan siap diunduh.',
            'rejected' => 'Tim akan menginformasikan langkah lanjutan setelah perbaikan dokumen.',
            default => 'Tim verifikasi akan menginformasikan hasil akhir melalui kanal resmi.',
        }],
    ];
    $dashboardFeed = match ($application->status) {
        'submitted' => [
            ['time' => '08:15', 'badge' => 'Inquiry', 'title' => 'Permohonan masuk', 'detail' => 'Pengajuan Anda berhasil diterima dan dicatat sistem.', 'state' => 'ok'],
            ['time' => '08:32', 'badge' => 'Queue', 'title' => 'Menunggu penjadwalan', 'detail' => 'Petugas menyiapkan urutan pemeriksaan berkas.', 'state' => 'pending'],
            ['time' => '08:56', 'badge' => 'Review', 'title' => 'Verifikasi dokumen', 'detail' => 'Data dan lampiran sedang diperiksa kelengkapannya.', 'state' => 'active'],
        ],
        'verified' => [
            ['time' => '09:12', 'badge' => 'Verified', 'title' => 'Data diverifikasi', 'detail' => 'Konten dokumen telah disetujui sekaligus diverifikasi.', 'state' => 'ok'],
            ['time' => '09:22', 'badge' => 'Queue', 'title' => 'Jadwal sedang diproses', 'detail' => 'Waktu kunjungan diperbarui sesuai slot yang tersedia.', 'state' => 'pending'],
            ['time' => '09:40', 'badge' => 'Live', 'title' => 'Siap kunjungan', 'detail' => 'Kantor menyiapkan loket dan petugas untuk hari yang ditentukan.', 'state' => 'active'],
        ],
        'approved' => [
            ['time' => '10:06', 'badge' => 'Approved', 'title' => 'Status disetujui', 'detail' => 'Permohonan Anda telah mendapatkan persetujuan awal.', 'state' => 'ok'],
            ['time' => '10:14', 'badge' => 'Final', 'title' => 'Finalisasi dokumen', 'detail' => 'Tahap terakhir sedang dipersiapkan untuk pengambilan hasil.', 'state' => 'active'],
            ['time' => '10:30', 'badge' => 'Notice', 'title' => 'Siap hadir', 'detail' => 'Petugas menyiapkan jadwal kedatangan terakhir.', 'state' => 'pending'],
        ],
        'rejected' => [
            ['time' => '11:08', 'badge' => 'Check', 'title' => 'Ada kebutuhan revisi', 'detail' => 'Satu dokumen perlu disesuaikan agar pengajuan dilanjutkan.', 'state' => 'warn'],
            ['time' => '11:24', 'badge' => 'Action', 'title' => 'Perlu konfirmasi', 'detail' => 'Silakan lengkapi data yang ditandai berdasarkan catatan petugas.', 'state' => 'pending'],
            ['time' => '11:40', 'badge' => 'Follow-up', 'title' => 'Tindak lanjut aktif', 'detail' => 'Tim menunggu hasil perbaikan dokumen dari Anda.', 'state' => 'active'],
        ],
        'completed' => [
            ['time' => '12:05', 'badge' => 'Done', 'title' => 'Pengajuan selesai', 'detail' => 'Semua tahapan administrasi telah berhasil diselesaikan.', 'state' => 'ok'],
            ['time' => '12:11', 'badge' => 'Archive', 'title' => 'Bukti tersimpan', 'detail' => 'Dokumen dan bukti pelayanan telah terarsip otomatis.', 'state' => 'ok'],
            ['time' => '12:16', 'badge' => 'Closed', 'title' => 'Selesai', 'detail' => 'Proses ditutup dengan status final dan dapat diunduh kembali.', 'state' => 'active'],
        ],
        default => [
            ['time' => '09:05', 'badge' => 'Sync', 'title' => 'System update', 'detail' => 'Data sedang diperbarui dalam proses verifikasi.', 'state' => 'pending'],
            ['time' => '09:14', 'badge' => 'Monitor', 'title' => 'Menunggu validasi', 'detail' => 'Sistem menunggu konfirmasi dari petugas terkait dokumen.', 'state' => 'active'],
            ['time' => '09:22', 'badge' => 'Queue', 'title' => 'Status siap dibuka', 'detail' => 'Pantau halaman ini untuk update berikutnya.', 'state' => 'pending'],
        ],
    };
    $pipelineCurrent = match ($application->status) {
        'verified' => 2,
        'approved' => 3,
        'completed' => 5,
        default => 1,
    };
    $pipelineStages = [
        ['title' => 'Pengajuan diterima', 'detail' => 'Data pengajuan tercatat di sistem.'],
        ['title' => 'Verifikasi berkas', 'detail' => 'Pemeriksaan data dan dokumen pemohon.'],
        ['title' => 'Persetujuan', 'detail' => 'Penetapan hasil pemeriksaan oleh petugas.'],
        ['title' => 'Jadwal pelayanan', 'detail' => 'Persiapan kunjungan ke kantor pelayanan.'],
        ['title' => 'Selesai', 'detail' => 'Hasil layanan siap diterima pemohon.'],
    ];
    foreach ($pipelineStages as $index => &$stage) {
        $stage['state'] = $application->status === 'rejected' && $index === 1
            ? 'attention'
            : ($index < $pipelineCurrent ? 'complete' : ($index === $pipelineCurrent ? 'current' : 'pending'));
        $stage['progress'] = match ($stage['state']) {
            'complete' => 100,
            'current' => $progress,
            'attention' => 40,
            default => 8,
        };
    }
    unset($stage);
    $requiredDocumentKeys = array_keys($service['documents']);
    if ($application->service_slug === 'ktp-el' && ($application->details['application_type'] ?? null) !== 'lost') {
        $requiredDocumentKeys = array_diff($requiredDocumentKeys, ['police_letter']);
    }
    if ($application->service_slug === 'kia' && isset($application->details['child_birth_date'])
        && now()->diffInYears($application->details['child_birth_date']) < 5) {
        $requiredDocumentKeys = array_diff($requiredDocumentKeys, ['child_photo']);
    }
    $uploadedDocuments = is_array($application->documents) ? $application->documents : [];
    $uploadedDocumentCount = count(array_intersect(array_keys($uploadedDocuments), $requiredDocumentKeys));
    $requiredDocumentCount = count($requiredDocumentKeys);
    $lastUpdatedAt = $application->updated_at?->locale('id')->translatedFormat('d F Y, H.i')
        ?? $application->created_at?->locale('id')->translatedFormat('d F Y, H.i')
        ?? 'Waktu belum tersedia';
@endphp

@section('content')
    <main class="wrap tracking-page">
        <a class="back-link" href="{{ route('home') }}">← Kembali ke halaman utama</a>

        <section class="tracking-hero reveal">
            <div class="tracking-hero-copy">
                <span class="tracking-status tracking-status--{{ $statusTone }}">{{ $statusLabel }}</span>
                <p class="eyebrow"><span class="eyebrow-mark"></span> Tanda terima digital</p>
                <h1>{{ $headline }}</h1>
                <p class="tracking-intro">{{ $summary }}</p>
                <div class="tracking-priority" aria-live="polite">
                    <span class="tracking-priority__label">Tindak lanjut</span>
                    <strong>{{ $nextAction }}</strong>
                </div>

                <div class="tracking-code" aria-label="Kode pelacakan">
                    <div>
                        <span>KODE PELACAKAN</span>
                        <strong id="tracking-code">{{ $application->tracking_code }}</strong>
                    </div>
                    <button class="tracking-copy" type="button" data-copy-tracking="{{ $application->tracking_code }}" aria-describedby="tracking-copy-feedback">Salin kode</button>
                    <span class="tracking-copy-feedback" id="tracking-copy-feedback" role="status" aria-live="polite"></span>
                </div>

                <div class="tracking-quick-stats" aria-label="Statistik cepat">
                    <div class="mini-stat">
                        <span>Nomor pengajuan</span>
                        <strong>#{{ $application->id }}</strong>
                    </div>
                    <div class="mini-stat">
                        <span>Jadwal kunjungan</span>
                        <strong>{{ $visitDate }}</strong>
                    </div>
                </div>

                <div class="tracking-highlights" aria-label="Fitur utama">
                    <article class="highlight-card">
                        <span class="highlight-icon">✓</span>
                        <div>
                            <strong>Verifikasi</strong>
                            <small>Data dan dokumen diproses</small>
                        </div>
                    </article>
                    <article class="highlight-card">
                        <span class="highlight-icon">⏱</span>
                        <div>
                            <strong>Jadwal</strong>
                            <small>Hadir sesuai waktu yang ditetapkan</small>
                        </div>
                    </article>
                    <article class="highlight-card">
                        <span class="highlight-icon">☎</span>
                        <div>
                            <strong>Support</strong>
                            <small>Hubungi kanal resmi bila dibutuhkan</small>
                        </div>
                    </article>
                </div>
            </div>

            <aside class="tracking-panel" aria-label="Ringkasan status">
                <div class="panel-header">
                    <span>Ringkasan status</span>
                    <i>{{ $panelLabel }}</i>
                </div>

                <div class="panel-progress">
                    <div>
                        <span>Progres verifikasi</span>
                        <strong>{{ $progress }}%</strong>
                    </div>
                    <div class="progress-bar" aria-hidden="true">
                        <span style="width: {{ $progress }}%"></span>
                    </div>
                </div>

                <ul class="status-list">
                    @foreach ($pipelineStages as $stage)
                        <li class="{{ $stage['state'] === 'complete' ? 'is-done' : ($stage['state'] === 'current' ? 'is-current' : ($stage['state'] === 'attention' ? 'is-attention' : '')) }}">
                            <span aria-hidden="true">@if ($stage['state'] === 'complete') ✓ @elseif ($stage['state'] === 'attention') ! @else • @endif</span>
                            {{ $stage['title'] }}@if ($stage['state'] === 'current') · {{ $statusLabel }}@endif
                        </li>
                    @endforeach
                </ul>
            </aside>
        </section>

        <section class="tracking-timeline reveal" aria-labelledby="tracking-timeline-title">
            <div class="section-heading">
                <h2 id="tracking-timeline-title">Perjalanan pengajuan</h2>
            </div>

            <ol>
                @foreach ($timelineSteps as $index => $step)
                    <li class="tracking-step {{ $step['state'] }}" @if ($step['state'] === 'is-current') aria-current="step" @endif>
                        <span class="tracking-step-marker" aria-hidden="true">{{ $step['marker'] }}</span>
                        <div>
                            <h3>{{ $step['title'] }}</h3>
                            <p>
                                @if ($step['state'] === 'is-current')
                                    <strong>{{ $statusLabel }}</strong>
                                    @if ($application->status === 'submitted')
                                        — Petugas akan memeriksa data dan dokumen Anda.
                                    @elseif ($application->status === 'rejected')
                                        — Dokumen perlu disesuaikan agar pengajuan bisa dilanjutkan.
                                    @else
                                        — Periksa kembali halaman ini untuk mengetahui status terbaru.
                                    @endif
                                @else
                                    {{ $step['detail'] }}
                                @endif
                            </p>
                        </div>
                    </li>
                @endforeach
            </ol>
        </section>

        <section
            class="live-dashboard reveal"
            aria-label="Dashboard status pengajuan"
            data-status-endpoint="{{ route('applications.track.status', ['code' => $application->tracking_code]) }}"
            data-status="{{ $application->status }}"
            data-last-updated="{{ $application->updated_at?->format('U.u') ?? '' }}">
            <div class="dashboard-topbar">
                <div>
                    <span class="info-kicker">Pusat kendali pengajuan</span>
                    <h2>Monitor proses layanan</h2>
                    <p class="dashboard-subtitle">Status resmi diperiksa otomatis setiap 30 detik. Rincian dashboard dimuat ulang jika ada perubahan.</p>
                </div>
                <span class="status-live"><span class="live-dot"></span><span data-status-sync role="status" aria-live="polite">Sinkron otomatis · 30 dtk</span></span>
            </div>

            <div class="dashboard-grid dashboard-grid--operations">
                <article class="dashboard-card dashboard-card--accent">
                    <span>Jenis layanan</span>
                    <strong>{{ $service['title'] }}</strong>
                    <small>{{ $application->service_slug }}</small>
                </article>
                <article class="dashboard-card">
                    <span>Kesiapan berkas</span>
                    <strong>{{ $uploadedDocumentCount }}/{{ $requiredDocumentCount }}</strong>
                    <small>Berkas wajib tersedia</small>
                </article>
                <article class="dashboard-card">
                    <span>Update terakhir</span>
                    <strong>{{ $lastUpdatedAt }}</strong>
                    <small>Waktu pencatatan status</small>
                </article>
                <article class="dashboard-card">
                    <span>Waktu lokal</span>
                    <strong data-local-clock>--:--</strong>
                    <small>Jam perangkat Anda</small>
                </article>
            </div>

            <div class="operations-pipeline" aria-label="Tahapan operasional pengajuan">
                <div class="operations-pipeline__heading">
                    <div><span class="info-kicker">Alur operasional</span><h3>Lima tahap layanan</h3></div>
                    <span class="pipeline-current">{{ $statusLabel }}</span>
                </div>
                <ol>
                    @foreach ($pipelineStages as $index => $stage)
                        <li class="pipeline-stage pipeline-stage--{{ $stage['state'] }}">
                            <span class="pipeline-marker" aria-hidden="true">
                                @if ($stage['state'] === 'complete') ✓ @elseif ($stage['state'] === 'attention') ! @else {{ $index + 1 }} @endif
                            </span>
                            <div class="pipeline-stage__copy">
                                <strong>{{ $stage['title'] }}</strong>
                                <span>{{ $stage['detail'] }}</span>
                            </div>
                            <div class="pipeline-stage__meter" aria-label="Tahap {{ $stage['title'] }}: {{ $stage['progress'] }}%">
                                <span style="width: {{ $stage['progress'] }}%"></span>
                            </div>
                        </li>
                    @endforeach
                </ol>
                @if ($application->status === 'rejected')
                    <p class="pipeline-alert"><strong>Perlu tindak lanjut:</strong> periksa catatan petugas dan lengkapi dokumen yang diminta sebelum proses berlanjut.</p>
                @endif
            </div>

            <div class="dashboard-feed">
                <div class="dashboard-feed__heading">
                    <div><span class="info-kicker">Preview aktivitas</span><h3>Simulasi alur status</h3></div>
                    <span>Ilustrasi · bukan log petugas</span>
                </div>
                @foreach ($dashboardFeed as $entry)
                    <article class="feed-item feed-item--{{ $entry['state'] }}">
                        <time>{{ $entry['time'] }}</time>
                        <div>
                            <span>{{ $entry['badge'] }}</span>
                            <h3>{{ $entry['title'] }}</h3>
                            <p>{{ $entry['detail'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        <section class="analytics-canvas reveal" aria-label="Infografik status layanan">
            <div class="analytics-heading">
                <div>
                    <span class="info-kicker">Canvas overview</span>
                    <h2>Ringkasan status operasional</h2>
                </div>
                <span class="mini-chip">{{ $statusLabel }}</span>
            </div>
            <div class="analytics-grid">
                <article class="chart-panel">
                    <div class="ring-wrap" aria-label="Progres layanan">
                        <div class="ring-chart" style="--value: {{ $progress }}; --track: rgba(255,255,255,0.12);">
                            <span>{{ $progress }}%</span>
                        </div>
                    </div>
                    <div>
                        <strong>Progres alur</strong>
                        <p>Ringkasan tahapan dihitung dari status pengajuan yang tersimpan.</p>
                    </div>
                </article>

                <article class="chart-panel chart-panel--bars">
                    <div class="bars-chart" aria-label="Progres tahapan pengajuan">
                        @foreach ($pipelineStages as $stage)
                            <span class="bars-chart__stage bars-chart__stage--{{ $stage['state'] }}" style="--h: {{ max(8, $stage['progress']) }}%" title="{{ $stage['title'] }}: {{ $stage['progress'] }}%">
                                <i>{{ ['Terima', 'Periksa', 'Setuju', 'Jadwal', 'Selesai'][$loop->index] }}</i>
                            </span>
                        @endforeach
                    </div>
                    <div>
                        <strong>Progres per tahap</strong>
                        <p>Visualisasi mengikuti tahapan dan status pengajuan ini, bukan statistik agregat kantor.</p>
                    </div>
                </article>
            </div>
        </section>

        <div class="tracking-main-grid reveal">
            <section class="tracking-details" aria-label="Ringkasan pengajuan">
                <div class="section-heading compact">
                    <h2>Detail pengajuan</h2>
                </div>

                <div class="tracking-detail"><span>Nama pemohon</span><strong>{{ $application->applicant_name }}</strong></div>
                <div class="tracking-detail"><span>NIK</span><strong>{{ $maskedNik }}</strong></div>
                <div class="tracking-detail"><span>Layanan</span><strong>{{ $service['title'] }}</strong></div>
                <div class="tracking-detail"><span>Nomor permohonan</span><strong>#{{ $application->id }}</strong></div>
                <div class="tracking-detail"><span>Lokasi kunjungan</span><strong>{{ $application->office }}</strong></div>
                <div class="tracking-detail"><span>Jadwal kunjungan</span><strong>{{ $visitDate }} · {{ $application->time_slot }}</strong></div>
            </section>

            <aside class="tracking-side-stack" aria-label="Informasi tambahan">
                <div class="tracking-insight-grid">
                    <article class="insight-card">
                        <span>Progress</span>
                        <strong>{{ $progress }}%</strong>
                        <small>Verifikasi saat ini</small>
                    </article>
                    <article class="insight-card">
                        <span>Status</span>
                        <strong>{{ $statusLabel }}</strong>
                        <small>{{ $application->status }}</small>
                    </article>
                    <article class="insight-card">
                        <span>Jadwal</span>
                        <strong>{{ $application->time_slot }}</strong>
                        <small>{{ $visitDate }}</small>
                    </article>
                </div>
                <article class="info-card accent-card">
                    <span class="info-kicker">Langkah selanjutnya</span>
                    <h3>Siap hadir sesuai jadwal</h3>
                    <p>Petugas akan memeriksa data dan dokumen yang Anda kirim. Bawa dokumen asli untuk verifikasi dan pastikan lokasi kunjungan sesuai jadwal.</p>
                </article>

                <article class="info-card">
                    <span class="info-kicker">Catatan penting</span>
                    <ul class="info-list">
                        <li>Pastikan nomor telepon dan email aktif.</li>
                        <li>Ikuti instruksi petugas jika ada dokumen yang belum lengkap.</li>
                        <li>Hubungi kanal resmi bila ada perubahan jadwal.</li>
                    </ul>
                </article>
            </aside>
        </div>

        <section class="tracking-next reveal">
            <h2>Langkah selanjutnya</h2>
            <p>Petugas akan memeriksa data dan dokumen yang Anda kirim. Hadir sesuai jadwal kunjungan dan bawa dokumen asli untuk verifikasi. Bila ada perubahan, hubungi kantor dinas melalui kanal resmi.</p>
        </section>

        <div class="tracking-actions">
            <a class="button button-primary" href="{{ route('home') }}#daftar-layanan">{{ $statusMeta['cta'] }} <span aria-hidden="true">{{ $statusMeta['ctaIcon'] }}</span></a>
            <a class="button button-secondary" href="{{ route('services.show', ['slug' => $application->service_slug]) }}">Lihat detail layanan</a>
            <button class="button button-secondary tracking-print" type="button" onclick="window.print()">Cetak bukti</button>
        </div>

        <section class="office-map-section reveal" aria-labelledby="office-map-title">
            <div class="section-heading compact office-map-heading">
                <div>
                    <span class="info-kicker">Kantor pelayanan</span>
                    <h2 id="office-map-title">Lokasi kantor pelayanan</h2>
                </div>
                <span class="office-hours">Buka hari kerja</span>
            </div>

            <div class="office-map-wrap">
                <div class="office-map" aria-label="Peta interaktif lokasi kantor pelayanan">
                    <iframe
                        title="Peta lokasi kantor pelayanan"
                        src="https://www.google.com/maps?q=Jl.%20Cempaka%20No.6A%2C%20Ujung%20Padang%2C%20Kec.%20Padangsidimpuan%20Sel.%2C%20Kota%20Padang%20Sidempuan%2C%20Sumatera%20Utara%2022725&z=17&output=embed"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        allowfullscreen>
                    </iframe>
                    <div class="office-map-label" aria-hidden="true">
                        <span class="office-map-pin">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M19 10.1c0 5-7 11-7 11s-7-6-7-11a7 7 0 1 1 14 0Z" stroke="currentColor" stroke-width="1.8"/>
                                <circle cx="12" cy="10" r="2.4" stroke="currentColor" stroke-width="1.8"/>
                            </svg>
                        </span>
                        <span>
                            <strong>Kantor pelayanan</strong>
                            <small>Jl. Cempaka No. 6A · Padangsidimpuan</small>
                        </span>
                    </div>
                </div>

                <div class="office-address-card">
                    <span class="info-kicker">Alamat kantor</span>
                    <h3>Lokasi pelayanan</h3>
                    <p>Jl. Cempaka No.6A, Ujung Padang, Kec. Padangsidimpuan Sel., Kota Padang Sidempuan, Sumatera Utara 22725</p>

                    <ul class="office-meta">
                        <li>
                            <span>Hari</span>
                            <strong>Senin - Jumat</strong>
                        </li>
                        <li>
                            <span>Jam</span>
                            <strong>08.00 - 16.00 WIB</strong>
                        </li>
                        <li>
                            <span>Catatan</span>
                            <strong>Hadir sesuai jadwal kunjungan</strong>
                        </li>
                    </ul>

                    <a href="https://maps.google.com/?q=Jl.%20Cempaka%20No.6A%2C%20Ujung%20Padang%2C%20Kec.%20Padangsidimpuan%20Sel.%2C%20Kota%20Padang%20Sidempuan%2C%20Sumatera%20Utara%2022725" target="_blank" rel="noopener noreferrer">Buka di Google Maps ↗</a>
                </div>
            </div>
        </section>
    </main>

    <style>
        .tracking-page {
            --page-bg: #f3f7fc;
            --panel-bg: #ffffff;
            --panel-alt: #f7faff;
            --panel-soft: #edf4fc;
            --line: #dce6f1;
            --text: #172b43;
            --muted: #66788e;
            --muted-strong: #334d69;
            --green: #1d5fa8;
            --green-soft: rgba(29, 95, 168, 0.1);
            --ink: #172b43;
            padding: 34px 0 72px;
            background: radial-gradient(circle at 8% 3%, rgba(190, 216, 246, 0.36), transparent 27%),
                        radial-gradient(circle at 96% 45%, rgba(220, 229, 255, 0.32), transparent 29%),
                        linear-gradient(180deg, #fbfdff 0%, #f3f7fc 55%, #f7faff 100%);
            color: var(--text);
        }

        .reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .reveal.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        @media (prefers-reduced-motion: reduce) {
            .reveal {
                opacity: 1;
                transform: none;
                transition: none;
            }
        }

        .tracking-hero,
        .tracking-timeline,
        .live-dashboard,
        .analytics-canvas,
        .tracking-details,
        .tracking-side-stack,
        .tracking-next,
        .office-map-section {
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        }

        .tracking-hero:hover,
        .tracking-timeline:hover,
        .live-dashboard:hover,
        .analytics-canvas:hover,
        .tracking-details:hover,
        .tracking-side-stack:hover,
        .tracking-next:hover,
        .office-map-section:hover {
            transform: translateY(-2px);
            box-shadow: 0 26px 60px rgba(28, 55, 44, 0.12);
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin: 0 0 24px;
            color: var(--green);
            text-decoration: none;
            font-weight: 800;
            font-size: 13px;
        }

        .tracking-hero {
            display: grid;
            grid-template-columns: minmax(0, 1.5fr) minmax(260px, .8fr);
            gap: 28px;
            padding: 28px;
            border: 1px solid var(--line);
            border-radius: 32px;
            background: linear-gradient(145deg, #ffffff, #f1f6fc);
            box-shadow: 0 22px 55px rgba(28, 55, 44, 0.09);
        }

        .tracking-hero h1 {
            color: #183654;
        }

        .tracking-hero .eyebrow {
            color: #1d5fa8;
        }

        .tracking-hero-copy {
            min-width: 0;
        }

        .tracking-status {
            display: inline-flex;
            align-items: center;
            padding: 9px 14px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            background: rgba(29, 95, 168, 0.08);
            color: var(--green);
            border: 1px solid rgba(29, 95, 168, 0.14);
        }

        .tracking-status--waiting {
            background: rgba(249, 186, 92, 0.12);
            border-color: rgba(249, 186, 92, 0.2);
            color: #8a5708;
        }

        .tracking-status--processing {
            background: rgba(125, 140, 255, 0.12);
            border-color: rgba(125, 140, 255, 0.24);
            color: #4f53a5;
        }

        .tracking-status--approved,
        .tracking-status--completed {
            background: rgba(29, 95, 168, 0.1);
            border-color: rgba(29, 95, 168, 0.16);
            color: #1d5fa8;
        }

        .tracking-status--rejected {
            background: rgba(250, 120, 120, 0.12);
            border-color: rgba(250, 120, 120, 0.18);
            color: #a52f2f;
        }

        .tracking-intro {
            max-width: 620px;
            margin: 0 0 26px;
            color: var(--muted);
            font-size: 17px;
            line-height: 1.8;
        }

        .tracking-priority {
            display: grid;
            gap: 6px;
            max-width: 560px;
            margin: 0 0 18px;
            padding: 14px 16px;
            border: 1px solid rgba(29, 95, 168, 0.12);
            border-radius: 16px;
            background: linear-gradient(135deg, rgba(255,255,255,0.96), rgba(234, 242, 252, 0.95));
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.6);
        }

        .tracking-priority__label {
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: #597067;
        }

        .tracking-priority strong {
            font-size: 14px;
            line-height: 1.6;
            color: var(--text);
        }

        .tracking-code {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            align-items: center;
            gap: 16px;
            margin-bottom: 14px;
            padding: 18px 18px 16px;
            border-radius: 22px;
            background: linear-gradient(135deg, #e8f2fc, #eaf0fb);
            color: #172b43;
            border: 1px solid rgba(29, 95, 168, 0.12);
            box-shadow: 0 14px 28px rgba(24, 56, 95, 0.08);
        }

        .tracking-code div {
            min-width: 0;
        }

        .tracking-code span {
            display: block;
            margin-bottom: 6px;
            font-size: 10px;
            letter-spacing: .15em;
            text-transform: uppercase;
            color: #66788e;
        }

        .tracking-code strong {
            display: block;
            overflow-wrap: anywhere;
            font-family: "Manrope", sans-serif;
            font-size: clamp(20px, 2.1vw, 34px);
            font-weight: 800;
            letter-spacing: .13em;
            color: #17477d;
        }

        .tracking-copy {
            min-width: 135px;
            padding: 13px 16px;
            border: 1px solid rgba(29, 95, 168, 0.18);
            border-radius: 14px;
            background: #ffffff;
            color: #17477d;
            font-weight: 800;
            cursor: pointer;
            transition: transform .2s ease, background .2s ease;
        }

        .tracking-copy:hover {
            background: #e6f0fb;
            transform: translateY(-2px);
        }

        .tracking-copy-feedback {
            display: block;
            min-height: 20px;
            margin-top: -8px;
            font-size: 12px;
            font-weight: 700;
            color: #1d5fa8;
        }

        .tracking-quick-stats {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
            margin-top: 10px;
        }

        .tracking-highlights {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 18px;
        }

        .highlight-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 12px;
            border: 1px solid rgba(23, 107, 82, 0.08);
            border-radius: 16px;
            background: #ffffff;
        }

        .highlight-icon {
            display: grid;
            place-items: center;
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: linear-gradient(135deg, rgba(23,107,82,0.1), rgba(113,188,153,0.2));
            color: var(--green);
            font-size: 16px;
            font-weight: 800;
        }

        .highlight-card strong {
            display: block;
            font-size: 13px;
            line-height: 1.3;
            color: var(--ink);
        }

        .highlight-card small {
            display: block;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.5;
        }

        .mini-stat {
            padding: 16px 18px;
            border: 1px solid var(--line);
            border-radius: 18px;
            background: #ffffff;
        }

        .mini-stat span {
            display: block;
            margin-bottom: 8px;
            color: var(--muted);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .05em;
            text-transform: uppercase;
        }

        .mini-stat strong {
            display: block;
            font-size: 15px;
            line-height: 1.5;
            color: var(--text);
        }

        .tracking-panel {
            padding: 22px 20px 18px;
            border: 1px solid var(--line);
            border-radius: 24px;
            background: linear-gradient(180deg, #ffffff, #f7faf7);
        }

        .panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .panel-header i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 42px;
            padding: 7px 8px;
            border-radius: 999px;
            background: rgba(22, 118, 89, 0.12);
            color: var(--green);
            font-style: normal;
        }

        .panel-progress {
            margin-bottom: 18px;
        }

        .dashboard-grid--operations { grid-template-columns: repeat(4, minmax(0, 1fr)); }

        .panel-progress > div:first-child {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 10px;
            color: var(--muted);
            font-size: 12px;
            font-weight: 700;
        }

        .panel-progress strong {
            color: var(--text);
            font-size: 24px;
            font-weight: 800;
        }

        .progress-bar {
            height: 10px;
            width: 100%;
            overflow: hidden;
            border-radius: 999px;
            background: #e8f4eb;
        }

        .progress-bar span {
            display: block;
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(90deg, #d8f7a8, #62d9b0);
        }

        .status-list {
            margin: 0;
            padding: 0;
            list-style: none;
            display: grid;
            gap: 10px;
        }

        .status-list li {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 12px;
            border-radius: 12px;
            color: var(--muted);
            background: #f4f8f5;
            font-weight: 700;
        }

        .status-list li span {
            display: inline-grid;
            place-items: center;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: rgba(23, 107, 82, 0.1);
            color: var(--green);
            font-size: 14px;
            font-weight: 900;
        }

        .status-list .is-current {
            color: var(--text);
            background: #e8f4eb;
        }

        .status-list .is-done {
            color: var(--green);
        }

        .status-list .is-attention {
            color: #8a5708;
            background: #fff5df;
        }

        .status-list .is-attention span {
            color: #80510b;
            background: #f8dfad;
        }

        .tracking-timeline,
        .tracking-details,
        .tracking-next,
        .info-card,
        .live-dashboard,
        .analytics-canvas {
            border: 1px solid var(--line);
            border-radius: 28px;
            background: rgba(255, 255, 255, 0.94);
            box-shadow: 0 16px 36px rgba(28, 55, 44, 0.06);
        }

        .live-dashboard {
            margin-top: 28px;
            padding: 24px 26px;
            background: linear-gradient(135deg, rgba(15, 31, 26, 0.97), rgba(23, 107, 82, 0.86));
            color: #edf7f1;
            border-color: rgba(196, 231, 205, 0.18);
        }

        .analytics-canvas {
            margin-top: 28px;
            padding: 24px 26px;
            background: linear-gradient(135deg, rgba(16, 24, 31, 0.94), rgba(21, 39, 48, 0.92));
            color: #edf7f1;
            border-color: rgba(202, 216, 219, 0.13);
        }

        .analytics-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 18px;
        }

        .analytics-heading h2 {
            margin: 0;
            color: #fff;
            font-size: clamp(22px, 2.2vw, 28px);
            letter-spacing: -.05em;
        }

        .mini-chip {
            display: inline-flex;
            align-items: center;
            padding: 8px 10px;
            border-radius: 999px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.12);
            color: #d7f9e0;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .analytics-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 1.2fr);
            gap: 18px;
        }

        .chart-panel {
            display: grid;
            grid-template-columns: 160px minmax(0, 1fr);
            gap: 18px;
            align-items: center;
            padding: 18px;
            border-radius: 22px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .ring-wrap {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ring-chart {
            --value: 50;
            --size: 116px;
            width: var(--size);
            height: var(--size);
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: conic-gradient(#85f0b0 calc(var(--value) * 1%), rgba(255,255,255,0.12) 0);
            box-shadow: inset 0 0 0 1px rgba(255,255,255,0.1);
            position: relative;
        }

        .ring-chart::before {
            content: "";
            position: absolute;
            inset: 14px;
            border-radius: 50%;
            background: rgba(16, 24, 31, 0.96);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .ring-chart span {
            position: relative;
            z-index: 1;
            color: #fff;
            font-size: 24px;
            font-weight: 800;
        }

        .chart-panel strong {
            display: block;
            margin-bottom: 6px;
            color: #fff;
            font-size: 18px;
        }

        .chart-panel p {
            margin: 0;
            color: rgba(237, 247, 241, 0.72);
            line-height: 1.7;
        }

        .chart-panel--bars {
            grid-template-columns: minmax(0, 1.2fr) minmax(0, 1fr);
        }

        .bars-chart {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 12px;
            height: 120px;
            padding: 10px 8px 0;
        }

        .bars-chart span {
            flex: 1;
            position: relative;
            display: inline-flex;
            align-items: end;
            justify-content: center;
            height: var(--h);
            min-height: 30px;
            border-radius: 12px 12px 0 0;
            background: linear-gradient(180deg, rgba(141, 208, 255, 0.92), rgba(91, 176, 141, 0.88));
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.45);
        }

        .bars-chart .bars-chart__stage--pending { background: linear-gradient(180deg,rgba(164,183,194,.52),rgba(101,125,137,.35)); }
        .bars-chart .bars-chart__stage--current { background: linear-gradient(180deg,#d1ef7e,#67d9b1); }
        .bars-chart .bars-chart__stage--attention { background: linear-gradient(180deg,#ffd27c,#da8c55); }

        .bars-chart i {
            position: absolute;
            bottom: -22px;
            font-style: normal;
            color: rgba(237, 247, 241, 0.72);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .05em;
            text-transform: uppercase;
        }

        .dashboard-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 18px;
        }

        .dashboard-topbar h2 {
            margin: 0;
            color: #f4fbf5;
            font-size: clamp(22px, 2.2vw, 28px);
            letter-spacing: -.05em;
        }

        .dashboard-subtitle {
            max-width: 620px;
            margin: 7px 0 0;
            color: rgba(235, 246, 237, 0.7);
            font-size: 12px;
        }

        .status-live {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.09);
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: #d9f4e3;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .live-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #75f4b0;
            box-shadow: 0 0 0 0 rgba(117, 244, 176, 0.7);
            animation: pulseDot 1.8s infinite;
        }

        @keyframes pulseDot {
            0% { box-shadow: 0 0 0 0 rgba(117, 244, 176, 0.65); }
            70% { box-shadow: 0 0 0 12px rgba(117, 244, 176, 0); }
            100% { box-shadow: 0 0 0 0 rgba(117, 244, 176, 0); }
        }

        .status-live .live-dot { animation: none; box-shadow: none; }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 18px;
        }

        .dashboard-card {
            padding: 18px 18px 16px;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 18px;
            background: rgba(255,255,255,0.04);
        }

        .dashboard-card--accent {
            background: linear-gradient(135deg, rgba(129, 211, 180, 0.12), rgba(255,255,255,0.03));
        }

        .dashboard-card span {
            display: block;
            margin-bottom: 8px;
            color: rgba(230, 243, 233, 0.8);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .11em;
            text-transform: uppercase;
        }

        .dashboard-card strong {
            display: block;
            margin-bottom: 4px;
            font-size: clamp(18px, 2vw, 24px);
            color: #fff;
            line-height: 1.35;
        }

        .dashboard-card small {
            color: rgba(235, 246, 237, 0.72);
            font-size: 12px;
        }

        .dashboard-grid--operations .dashboard-card:nth-child(3) strong { font-size: 14px; }

        .operations-pipeline {
            margin: 6px 0 22px;
            padding: 20px;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 22px;
            background: rgba(255,255,255,0.045);
        }

        .operations-pipeline__heading,
        .dashboard-feed__heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            margin-bottom: 16px;
        }

        .operations-pipeline__heading h3,
        .dashboard-feed__heading h3 {
            margin: 2px 0 0;
            color: #fff;
            font: 800 16px Manrope,sans-serif;
        }

        .pipeline-current {
            padding: 7px 10px;
            border: 1px solid rgba(255,255,255,0.14);
            border-radius: 999px;
            background: rgba(255,255,255,0.08);
            color: #e4f8eb;
            font-size: 10px;
            font-weight: 800;
        }

        .operations-pipeline ol {
            display: grid;
            gap: 9px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .pipeline-stage {
            display: grid;
            grid-template-columns: 30px minmax(0,1fr) minmax(80px,.7fr);
            align-items: center;
            gap: 12px;
            min-height: 50px;
            padding: 9px 11px;
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 14px;
            background: rgba(5,18,16,0.18);
        }

        .pipeline-marker {
            display: grid;
            place-items: center;
            width: 27px;
            height: 27px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            color: rgba(235,246,237,0.72);
            font-size: 11px;
            font-weight: 900;
        }

        .pipeline-stage__copy strong,
        .pipeline-stage__copy span { display: block; }
        .pipeline-stage__copy strong { color: #f5fbf6; font-size: 11px; }
        .pipeline-stage__copy span { margin-top: 2px; color: rgba(235,246,237,0.62); font-size: 10px; }
        .pipeline-stage__meter { height: 6px; overflow: hidden; border-radius: 99px; background: rgba(255,255,255,0.1); }
        .pipeline-stage__meter span { display: block; height: 100%; border-radius: inherit; background: linear-gradient(90deg,#68d7ae,#c8f078); transition: width .6s ease; }
        .pipeline-stage--complete .pipeline-marker { background: rgba(104,215,174,0.18); color: #8ff0bd; }
        .pipeline-stage--current { border-color: rgba(200,240,120,0.27); background: rgba(200,240,120,0.07); }
        .pipeline-stage--current .pipeline-marker { background: #c8f078; color: #183b2d; }
        .pipeline-stage--attention { border-color: rgba(255,191,97,0.32); background: rgba(255,191,97,0.08); }
        .pipeline-stage--attention .pipeline-marker { background: #f0b060; color: #33220b; }

        .pipeline-alert {
            margin: 14px 0 0;
            padding: 11px 13px;
            border: 1px solid rgba(255,191,97,0.25);
            border-radius: 12px;
            background: rgba(255,191,97,0.09);
            color: #f7dfb8;
            font-size: 11px;
            line-height: 1.6;
        }

        .dashboard-feed {
            display: grid;
            gap: 12px;
        }

        .dashboard-feed__heading { margin-bottom: 2px; }
        .dashboard-feed__heading>span { color: rgba(235,246,237,0.6); font-size: 10px; text-align: right; }

        .feed-item {
            display: grid;
            grid-template-columns: 70px minmax(0, 1fr);
            gap: 14px;
            align-items: start;
            padding: 14px 16px;
            border-radius: 18px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            opacity: 0;
            transform: translateY(10px);
            animation: feedIn .55s ease forwards;
        }

        .feed-item time {
            color: rgba(216, 235, 221, 0.8);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .feed-item span {
            display: inline-block;
            margin-bottom: 6px;
            padding: 5px 8px;
            border-radius: 999px;
            background: rgba(255,255,255,0.08);
            color: #e6f8eb;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .feed-item h3 {
            margin: 0 0 5px;
            color: #ffffff;
            font-size: 17px;
        }

        .feed-item p {
            margin: 0;
            color: rgba(233, 244, 236, 0.8);
            line-height: 1.7;
        }

        .feed-item--ok { border-color: rgba(117, 244, 176, 0.18); }
        .feed-item--warn { border-color: rgba(255, 191, 97, 0.2); }
        .feed-item--pending { border-color: rgba(160, 194, 255, 0.18); }
        .feed-item--active { border-color: rgba(124, 209, 255, 0.2); }
        @keyframes feedIn { to { opacity: 1; transform: translateY(0); } }

        .tracking-timeline {
            margin-top: 28px;
            padding: 24px 26px;
        }

        .section-heading {
            margin-bottom: 18px;
        }

        .section-heading h2 {
            margin: 0;
            font-size: clamp(22px, 2vw, 28px);
            letter-spacing: -.05em;
        }

        .section-heading.compact {
            margin-bottom: 12px;
        }

        .tracking-timeline ol {
            list-style: none;
            margin: 0;
            padding: 0;
            display: grid;
            gap: 16px;
        }

        .tracking-step {
            display: grid;
            grid-template-columns: 46px minmax(0, 1fr);
            gap: 16px;
            align-items: start;
            padding: 16px 18px;
            border-radius: 20px;
            border: 1px solid var(--line);
            background: #fbfcfb;
        }

        .tracking-step-marker {
            display: grid;
            place-items: center;
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: rgba(23, 107, 82, 0.08);
            color: var(--green);
            font-weight: 800;
            font-size: 18px;
        }

        .tracking-step.is-complete .tracking-step-marker {
            background: rgba(23, 107, 82, 0.12);
            color: var(--green);
        }

        .tracking-step.is-current {
            border-color: rgba(29, 95, 168, 0.2);
            background: linear-gradient(135deg, #eaf3fc, #ffffff);
        }

        .tracking-step.is-current .tracking-step-marker {
            background: linear-gradient(135deg, #347dc5, #17477d);
            color: #ffffff;
        }

        .tracking-step h3 {
            margin: 0 0 4px;
            font-size: 18px;
            line-height: 1.4;
            color: var(--text);
        }

        .tracking-step strong {
            color: var(--text);
        }

        .tracking-step p {
            margin: 0;
            color: var(--muted);
            line-height: 1.7;
        }

        .tracking-main-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.4fr) minmax(260px, 0.8fr);
            gap: 24px;
            margin-top: 28px;
        }

        .tracking-details {
            padding: 24px 24px 12px;
        }

        .tracking-detail {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 14px 0;
            border-bottom: 1px solid var(--line);
        }

        .tracking-detail:last-child {
            border-bottom: 0;
        }

        .tracking-detail span {
            color: var(--muted);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .tracking-detail strong {
            max-width: 58%;
            text-align: right;
            font-size: 15px;
            line-height: 1.6;
            color: var(--text);
        }

        .tracking-side-stack {
            display: grid;
            gap: 24px;
        }

        .info-card {
            padding: 22px 20px;
        }

        .accent-card {
            background: linear-gradient(135deg, #edf7ef, #ffffff);
        }

        .info-kicker {
            display: inline-block;
            margin-bottom: 10px;
            color: var(--green);
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .12em;
        }

        .info-card h3 {
            margin: 0 0 8px;
            font-size: 22px;
            letter-spacing: -.04em;
            color: var(--text);
        }

        .info-card p,
        .info-list {
            margin: 0;
            color: var(--muted);
            line-height: 1.7;
        }

        .info-list {
            padding-left: 18px;
        }

        .tracking-next {
            margin-top: 28px;
            padding: 24px 26px;
        }

        .tracking-next h2 {
            margin: 0 0 8px;
            font-size: clamp(22px, 2vw, 28px);
            letter-spacing: -.05em;
            color: var(--text);
        }

        .tracking-next p {
            margin: 0;
            color: var(--muted);
            line-height: 1.8;
        }

        .office-map-section {
            margin-top: 28px;
            padding: 24px 26px;
            border: 1px solid var(--line);
            border-radius: 28px;
            background: rgba(10, 17, 19, 0.8);
            box-shadow: 0 16px 36px rgba(2, 14, 15, 0.32);
        }

        .office-map-heading {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 18px;
        }

        .office-hours {
            display: inline-flex;
            align-items: center;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(23, 107, 82, 0.08);
            color: var(--green);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .office-map-wrap {
            display: grid;
            grid-template-columns: minmax(0, 1.5fr) minmax(260px, 0.7fr);
            gap: 20px;
            align-items: stretch;
        }

        .office-map {
            position: relative;
            overflow: hidden;
            min-height: 420px;
            border-radius: 24px;
            border: 1px solid var(--line);
            background: #eaf0ec;
            box-shadow: inset 0 0 0 1px rgba(255,255,255,.04);
        }

        .office-map iframe {
            display: block;
            width: 100%;
            height: 100%;
            min-height: 420px;
            border: 0;
        }

        .office-map-label {
            position: absolute;
            top: 16px;
            left: 16px;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 11px;
            max-width: calc(100% - 32px);
            padding: 11px 15px 11px 11px;
            border: 1px solid rgba(255, 255, 255, .72);
            border-radius: 16px;
            background: rgba(255, 255, 255, .94);
            box-shadow: 0 8px 24px rgba(26, 48, 37, .16);
            backdrop-filter: blur(10px);
        }

        .office-map-pin {
            display: grid;
            width: 38px;
            height: 38px;
            flex: 0 0 38px;
            place-items: center;
            border-radius: 12px;
            color: #ffffff;
            background: linear-gradient(145deg, #287d5b, #14513d);
        }

        .office-map-pin svg {
            width: 21px;
            height: 21px;
        }

        .office-map-label strong,
        .office-map-label small {
            display: block;
        }

        .office-map-label strong {
            color: #20352b;
            font-size: 13px;
            line-height: 1.35;
        }

        .office-map-label small {
            margin-top: 2px;
            color: #607167;
            font-size: 11px;
            line-height: 1.4;
        }

        .office-address-card {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 24px 22px;
            border-radius: 24px;
            background: linear-gradient(135deg, #f0f8f1, #ffffff);
            border: 1px solid var(--line);
        }

        .office-address-card h3 {
            margin: 0 0 10px;
            font-size: 24px;
            letter-spacing: -.06em;
            color: var(--text);
        }

        .office-address-card p {
            margin: 0 0 16px;
            color: var(--muted);
            line-height: 1.8;
        }

        .office-meta {
            list-style: none;
            margin: 0 0 18px;
            padding: 0;
            display: grid;
            gap: 12px;
        }

        .office-meta li {
            display: flex;
            flex-direction: column;
            gap: 4px;
            padding: 12px 0;
            border-top: 1px solid var(--line);
        }

        .office-meta span {
            color: var(--muted);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .09em;
            text-transform: uppercase;
        }

        .office-meta strong {
            color: var(--text);
            line-height: 1.5;
            font-size: 14px;
        }

        .office-address-card a {
            color: var(--green);
            text-decoration: none;
            font-weight: 800;
        }

        .tracking-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            margin-top: 26px;
        }

        .button-primary {
            color: #ffffff !important;
            background: linear-gradient(135deg, #217b5d, #12503d) !important;
            box-shadow: 0 12px 25px rgba(23, 107, 82, 0.18);
        }

        .button-secondary {
            border: 1px solid var(--line) !important;
            color: var(--text) !important;
            background: #ffffff !important;
        }

        @media (max-width: 860px) {
            .tracking-hero,
            .tracking-main-grid,
            .office-map-wrap {
                grid-template-columns: 1fr;
            }

            .dashboard-grid--operations { grid-template-columns: repeat(2, minmax(0, 1fr)); }

            .office-map-heading {
                flex-direction: column;
                align-items: flex-start;
            }

            .tracking-code {
                grid-template-columns: 1fr;
            }

            .tracking-copy {
                width: 100%;
            }

            .tracking-detail {
                flex-direction: column;
                align-items: flex-start;
            }

            .tracking-detail strong {
                max-width: none;
                text-align: left;
            }
        }

        @media (max-width: 560px) {
            .tracking-page {
                padding-top: 20px;
            }

            .wrap {
                width: min(100% - 24px, 1160px);
            }

            .tracking-hero,
            .tracking-timeline,
            .tracking-details,
            .tracking-next,
            .info-card,
            .live-dashboard,
            .analytics-canvas {
                border-radius: 22px;
            }

            .tracking-hero {
                padding: 18px;
            }

            .tracking-quick-stats,
            .tracking-highlights,
            .dashboard-grid,
            .analytics-grid {
                grid-template-columns: 1fr;
            }

            .operations-pipeline { padding: 14px; }
            .pipeline-stage { grid-template-columns: 28px minmax(0,1fr); gap: 9px; }
            .pipeline-stage__meter { grid-column: 2; }
            .operations-pipeline__heading,
            .dashboard-feed__heading { align-items: flex-start; flex-direction: column; }
            .dashboard-feed__heading>span { text-align: left; }

            .chart-panel {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .feed-item {
                grid-template-columns: 1fr;
                gap: 8px;
            }

            .tracking-step {
                grid-template-columns: 38px minmax(0, 1fr);
                padding: 14px 12px;
            }

            .tracking-step-marker {
                width: 38px;
                height: 38px;
                font-size: 16px;
            }
        }

        .tracking-page {
            background: transparent;
        }

        .tracking-hero {
            border-color: #dce6f1;
            background: linear-gradient(125deg, #ffffff 0%, #eef5fc 72%, #f3f7fc 100%);
            box-shadow: 0 24px 56px rgba(31, 57, 88, 0.09);
        }

        .tracking-hero h1 {
            color: #183654;
        }

        .tracking-hero .eyebrow,
        .back-link {
            color: #1d5fa8;
        }

        .tracking-hero .eyebrow-mark {
            background: linear-gradient(90deg, #1d5fa8, #8cbbea);
        }

        .tracking-status--waiting {
            border-color: #ead8ae;
            background: #fbf4e4;
            color: #805b17;
        }

        .tracking-status--processing {
            border-color: #d7deed;
            background: #eff3fa;
            color: #425d88;
        }

        .tracking-status--approved,
        .tracking-status--completed {
            border-color: #c8dcef;
            background: #eaf3fc;
            color: #1d5fa8;
        }

        .tracking-status--rejected {
            border-color: #f0d1cc;
            background: #fff0ed;
            color: #a52f2f;
        }

        .tracking-panel {
            border-color: #dce6f1;
            background: linear-gradient(160deg, #ffffff, #f4f8f3);
            box-shadow: 0 12px 30px rgba(31, 57, 43, 0.055);
        }

        .tracking-timeline,
        .tracking-details,
        .tracking-next,
        .info-card,
        .office-map-section {
            border-color: #e0e8e0;
            background: #ffffff;
            box-shadow: 0 14px 34px rgba(31, 57, 43, 0.055);
        }

        .tracking-timeline h2,
        .tracking-details h2,
        .tracking-next h2 {
            color: #1c3a2d;
        }

        .tracking-step {
            border-color: #e4ebe4;
            background: #fbfcfa;
        }

        .tracking-step.is-current {
            border-color: #cfe2d1;
            background: linear-gradient(120deg, #eef6ef, #ffffff);
        }

        .tracking-detail {
            border-color: #e2e9e2;
            background: #fbfcfa;
        }

        .tracking-detail:nth-child(2n) {
            background: #f5f8f5;
        }

        .tracking-detail span,
        .mini-stat span,
        .office-meta span {
            color: #62736a;
        }

        .accent-card,
        .office-address-card {
            background: linear-gradient(145deg, #f0f7f0, #ffffff 78%);
        }

        .tracking-next {
            background: linear-gradient(120deg, #f0f7f0, #ffffff 68%, #fbf5e9);
        }

        .office-map {
            min-height: 440px;
            border-color: #dce5dd;
            box-shadow: 0 10px 24px rgba(31, 57, 43, 0.08);
        }

        .office-map iframe {
            min-height: 440px;
        }

        .office-address-card {
            border-color: #dfe8de;
        }

        .office-address-card a {
            color: #1d5fa8;
        }

        .button-primary {
            background: linear-gradient(135deg, #1d5fa8, #17477d) !important;
            box-shadow: 0 11px 24px rgba(29, 95, 168, 0.18);
        }

        .button-secondary {
            border-color: #dfe6df !important;
            color: #30483c !important;
            background: #ffffff !important;
        }

        @media (max-width: 560px) {
            .office-map,
            .office-map iframe {
                min-height: 340px;
            }

            .office-map-label {
                top: 10px;
                left: 10px;
                max-width: calc(100% - 20px);
                padding: 9px 12px 9px 9px;
            }

            .office-map-pin {
                width: 34px;
                height: 34px;
                flex-basis: 34px;
            }

            .office-map-label small {
                font-size: 10px;
            }
        }
    </style>

    <script>
        const revealElements = document.querySelectorAll('.reveal');

        if ('IntersectionObserver' in window) {
            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        revealObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.16 });

            revealElements.forEach((element) => revealObserver.observe(element));
        } else {
            revealElements.forEach((element) => element.classList.add('is-visible'));
        }

        document.querySelectorAll('.feed-item').forEach((item, index) => {
            item.style.animationDelay = `${index * 140}ms`;
        });

        const copyButton = document.querySelector('[data-copy-tracking]');
        if (copyButton) {
            copyButton.addEventListener('click', async (event) => {
                const button = event.currentTarget;
                const feedback = document.getElementById('tracking-copy-feedback');

                try {
                    if (!navigator.clipboard?.writeText) {
                        throw new Error('Clipboard API tidak tersedia.');
                    }

                    await navigator.clipboard.writeText(button.dataset.copyTracking);
                    feedback.textContent = 'Kode berhasil disalin.';
                    button.textContent = 'Tersalin';
                    button.disabled = true;
                    setTimeout(() => {
                        button.textContent = 'Salin kode';
                        button.disabled = false;
                        feedback.textContent = '';
                    }, 1800);
                } catch (error) {
                    feedback.textContent = 'Kode belum bisa disalin. Silakan pilih dan salin kode secara manual.';
                }
            });
        }

        const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (!reducedMotion) {
            document.querySelectorAll('.ring-chart').forEach((chart) => {
                const value = Number(chart.style.getPropertyValue('--value')) || 0;
                chart.style.setProperty('--target-value', String(value));
                chart.style.setProperty('--value', '0');
                requestAnimationFrame(() => {
                    chart.style.setProperty('--value', String(value));
                });
            });
        }

        const localClock = document.querySelector('[data-local-clock]');
        const updateLocalClock = () => {
            if (localClock) {
                localClock.textContent = new Intl.DateTimeFormat('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                }).format(new Date());
            }
        };
        updateLocalClock();
        window.setInterval(updateLocalClock, 1000);

        const liveDashboard = document.querySelector('.live-dashboard[data-status-endpoint]');
        const syncLabel = liveDashboard?.querySelector('[data-status-sync]');
        if (liveDashboard && syncLabel) {
            let secondsUntilSync = 30;
            const checkForStatusUpdate = async () => {
                syncLabel.textContent = 'Memeriksa status…';
                try {
                    const response = await fetch(liveDashboard.dataset.statusEndpoint, {
                        headers: { Accept: 'application/json' },
                        cache: 'no-store',
                        credentials: 'same-origin',
                    });
                    if (!response.ok) throw new Error(`Pemeriksaan status gagal (${response.status}).`);
                    const snapshot = await response.json();
                    if (typeof snapshot.status !== 'string') throw new Error('Respons status tidak valid.');

                    if (snapshot.status !== liveDashboard.dataset.status
                        || (snapshot.updated_at && snapshot.updated_at !== liveDashboard.dataset.lastUpdated)) {
                        syncLabel.textContent = 'Status berubah · memuat dashboard terbaru…';
                        window.location.reload();
                        return;
                    }

                    const checkedAt = new Intl.DateTimeFormat('id-ID', {
                        hour: '2-digit',
                        minute: '2-digit',
                    }).format(new Date());
                    syncLabel.textContent = `Diperiksa ${checkedAt} · pembaruan 30 dtk`;
                } catch (error) {
                    syncLabel.textContent = 'Sinkronisasi gagal · mencoba lagi';
                }
            };

            window.setInterval(() => {
                if (document.hidden) return;
                secondsUntilSync--;
                if (secondsUntilSync <= 0) {
                    secondsUntilSync = 30;
                    checkForStatusUpdate();
                    return;
                }
                syncLabel.textContent = `Sinkron otomatis · ${secondsUntilSync} dtk`;
            }, 1000);
        }
    </script>
@endsection
