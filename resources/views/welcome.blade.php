@extends('layouts.app')

@section('title', 'Layanan Administrasi Kependudukan')
@section('page_class', 'home-page')

@section('content')
    <main>
        <section class="home-hero wrap">
            <video class="hero-background" autoplay muted loop playsinline preload="metadata" poster="{{ asset('images/hero-landscape.jpg') }}" aria-hidden="true" tabindex="-1">
                <source src="{{ asset('videos/hero-background.mp4') }}" type="video/mp4">
            </video>
            <div class="hero-copy">
                <p class="eyebrow"><span class="eyebrow-mark"></span> Portal layanan administrasi kependudukan</p>
                <h1>Urus dokumen kependudukan,<br><span>lebih mudah dari awal.</span></h1>
                <p class="lead">Pilih layanan, siapkan berkas, dan ajukan permohonan dengan panduan yang jelas.</p>
                <div class="hero-tags" aria-label="Layanan populer">
                    <span>Mulai dari:</span>
                    <a href="{{ route('services.show', ['slug' => 'ktp-el']) }}">KTP elektronik</a>
                    <a href="{{ route('services.show', ['slug' => 'kartu-keluarga']) }}">Kartu Keluarga</a>
                    <a href="{{ route('services.show', ['slug' => 'akta-kelahiran']) }}">Akta kelahiran</a>
                </div>
                <div class="hero-actions">
                    <a class="button button-primary" href="#daftar-layanan">Jelajahi layanan <span aria-hidden="true">↗</span></a>
                    <a class="text-link" href="#alur-layanan">Pelajari alurnya <span aria-hidden="true">↓</span></a>
                </div>
                <div class="hero-proof"><span aria-hidden="true">✳</span> Persyaratan jelas <i aria-hidden="true"></i> Pengajuan terarah <i aria-hidden="true"></i> Status dengan kode pelacakan</div>
            </div>

            <div class="hero-art" aria-hidden="true">
                <span class="hero-glow"></span>
                <span class="art-orbit"></span>
                <span class="art-orbit art-orbit-two"></span>

                <div class="hero-document">
                    <div class="hero-document-top">
                        <span>Pelayanan</span>
                        <i></i>
                    </div>
                    <div class="hero-document-seal">✓</div>
                    <div class="hero-document-lines">
                        <i></i>
                        <i></i>
                        <i></i>
                    </div>
                    <div class="hero-document-bottom">
                        <span>Proses terjadwal</span>
                        <b>2025</b>
                    </div>
                </div>

                <div class="art-chip chip-top">
                    <span>✓</span>
                    <div><b>Persyaratan</b><br>siap dipenuhi</div>
                </div>

                <div class="art-chip chip-bottom">
                    <span class="chip-dot"></span>
                    <div><b>Status</b><br>pelacakan aktif</div>
                </div>
            </div>

            <a class="hero-scroll" href="#daftar-layanan"><span>Jelajahui layanan</span><b aria-hidden="true">↓</b></a>
        </section>

        <section class="trust-strip wrap" aria-label="Statistik layanan">
            <div class="trust-item">
                <strong>06</strong>
                <span>Jenis layanan administrasi kependudukan</span>
            </div>
            <div class="trust-item">
                <strong>Jelas</strong>
                <span>Panduan dokumen untuk setiap layanan</span>
            </div>
            <div class="trust-item">
                <strong>Terjadwal</strong>
                <span>Persiapan kunjungan ke kantor</span>
            </div>
            <div class="trust-item">
                <strong>Terpantau</strong>
                <span>Perkembangan pengajuan dengan kode pelacakan</span>
            </div>
        </section>

        <section class="feature-section section-pad">
            <div class="wrap">
                <div class="section-heading">
                    <div>
                        <p class="eyebrow"><span class="eyebrow-mark"></span> Kenapa memilih kami</p>
                        <h2>Proses yang lebih terarah</h2>
                    </div>
                    <p>Temukan layanan yang sesuai, pelajari dokumen yang perlu disiapkan, lalu ikuti tahapan pengajuan dengan lebih tertib. Setelah mengirim permohonan, simpan kode pelacakan untuk melihat perkembangannya dan ikuti arahan petugas.</p>
                </div>

                <div class="feature-grid">
                    <article class="feature-card">
                        <span class="feature-icon">✓</span>
                        <h3>Persyaratan jelas</h3>
                        <p>Periksa daftar dokumen untuk layanan yang dipilih sebelum mulai mengisi formulir. Dengan begitu, Anda dapat menyiapkan berkas lebih awal dan mengurangi risiko ada persyaratan yang terlewat.</p>
                    </article>
                    <article class="feature-card">
                        <span class="feature-icon">⏱</span>
                        <h3>Langkah pengajuan terarah</h3>
                        <p>Ikuti urutan mulai dari memilih jenis layanan, melengkapi data dan dokumen, hingga mengirim permohonan. Informasi proses membantu Anda mengetahui apa yang perlu dilakukan berikutnya.</p>
                    </article>
                    <article class="feature-card">
                        <span class="feature-icon">◷</span>
                        <h3>Kunjungan lebih terencana</h3>
                        <p>Pelajari informasi waktu pelayanan dan arahan kunjungan sebelum datang ke kantor. Siapkan dokumen yang diperlukan agar proses pemeriksaan dapat berlangsung lebih tertib.</p>
                    </article>
                    <article class="feature-card">
                        <span class="feature-icon">⌕</span>
                        <h3>Status dapat dipantau</h3>
                        <p>Gunakan kode pelacakan dari bukti pengajuan untuk melihat status permohonan. Jika ada dokumen yang perlu diperbaiki, periksa catatan dan ikuti instruksi yang ditampilkan.</p>
                    </article>
                    <article class="feature-card">
                        <span class="feature-icon">▤</span>
                        <h3>Panduan sesuai jenis layanan</h3>
                        <p>Setiap layanan memiliki halaman informasi tersendiri, termasuk keterangan proses, persyaratan, dan langkah setelah formulir dikirim. Pastikan memilih layanan yang sesuai kebutuhan Anda.</p>
                    </article>
                    <article class="feature-card">
                        <span class="feature-icon">Rp</span>
                        <h3>Informasi biaya terbuka</h3>
                        <p>Informasi biaya ditampilkan pada halaman layanan. Layanan administrasi yang tercantum di portal ini tidak dipungut biaya; waspadai permintaan pembayaran di luar informasi resmi.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="services-section section-pad" id="daftar-layanan">
            <div class="wrap">
                <div class="section-heading">
                    <div>
                        <p class="eyebrow"><span class="eyebrow-mark"></span> Pilih kebutuhan Anda</p>
                        <h2>Layanan kependudukan</h2>
                    </div>
                    <p>Setiap layanan punya halaman tersendiri berisi persyaratan, estimasi proses, dan formulir pengajuan.</p>
                </div>

                <div class="service-grid">
                    @foreach ($services as $slug => $service)
                        <a class="service-card{{ match ($slug) { 'ktp-el' => ' service-card-ktp', 'kartu-keluarga' => ' service-card-family', 'akta-kelahiran' => ' service-card-birth', 'akta-kematian' => ' service-card-death', 'pindah-datang' => ' service-card-move', 'kia' => ' service-card-kia', default => '' } }}" href="{{ route('services.show', ['slug' => $slug]) }}" style="--accent: {{ ['#1d5fa8', '#2879bd', '#1683b8', '#466ec1', '#245f92', '#527ec8'][$loop->index % 6] }}">
                            @if (in_array($slug, ['ktp-el', 'kartu-keluarga', 'akta-kelahiran', 'akta-kematian', 'pindah-datang', 'kia'], true))
                                <img class="service-card-background" src="{{ asset(match ($slug) { 'ktp-el' => 'images/ktp-elektronik-background-hd.webp', 'kartu-keluarga' => 'images/kartu-keluarga-background-hd.webp', 'akta-kelahiran' => 'images/akta-kelahiran-background-hd.webp', 'akta-kematian' => 'images/akta-kematian-background-hd.webp', 'pindah-datang' => 'images/pindah-datang-background-hd.webp', 'kia' => 'images/kartu-identitas-anak-background-hd.webp' }) }}" alt="" aria-hidden="true">
                            @endif
                            <div class="service-card-art">
                                <span class="service-art-orbit"></span>
                                <span class="service-art-sheet">
                                    <span class="service-art-icon">{{ ['ID', 'KK', 'AK', '✳', '↗', 'KIA'][$loop->index % 6] }}</span>
                                    <span class="service-art-line line-long"></span>
                                    <span class="service-art-line line-short"></span>
                                    <span class="service-art-stamp">✓</span>
                                </span>
                                <span class="service-art-spark">✦</span>
                            </div>
                            <div class="service-card-copy">
                                <span class="service-card-kicker">LAYANAN {{ str_pad((string) ($loop->index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                                <h3>{{ $service['title'] }}</h3>
                                <p>{{ $service['description'] }}</p>
                                <span class="card-link">Lihat layanan <span aria-hidden="true">↗</span></span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="steps-section section-pad" id="alur-layanan">
            <div class="wrap">
                <div class="section-heading">
                    <div>
                        <p class="eyebrow"><span class="eyebrow-mark"></span> Sederhana dan terarah</p>
                        <h2>Tiga langkah pengajuan</h2>
                    </div>
                    <p>Ikuti tahapan berikut agar Anda tahu apa yang perlu disiapkan, bagaimana mengirim permohonan, dan cara memeriksa perkembangannya.</p>
                </div>
                <div class="steps-grid">
                    <article class="step-card">
                        <span class="step-number">01</span>
                        <span class="step-card-kicker">MULAI DARI KEBUTUHAN</span>
                        <h3>Pilih layanan</h3>
                        <p>Kenali layanan yang paling sesuai dengan keperluan Anda. Baca persyaratan dan alur pada halaman layanan sebelum menyiapkan berkas.</p>
                        <span class="step-card-note">Hasil: Anda mengetahui dokumen yang perlu disiapkan.</span>
                    </article>
                    <article class="step-card">
                        <span class="step-number">02</span>
                        <span class="step-card-kicker">ISI DENGAN TELITI</span>
                        <h3>Lengkapi pengajuan</h3>
                        <p>Masukkan data pemohon sesuai dokumen, unggah berkas yang diminta, lalu tentukan jadwal kunjungan bila diperlukan.</p>
                        <span class="step-card-note">Periksa kembali data sebelum mengirim formulir.</span>
                    </article>
                    <article class="step-card">
                        <span class="step-number">03</span>
                        <span class="step-card-kicker">SIMPAN BUKTI ANDA</span>
                        <h3>Pantau prosesnya</h3>
                        <p>Simpan bukti pengajuan dan kode pelacakan. Gunakan kode tersebut untuk memeriksa status serta membaca arahan petugas.</p>
                        <span class="step-card-note">Jika diminta perbaikan, ikuti catatan yang tersedia.</span>
                    </article>
                </div>
            </div>
        </section>

        <section class="contact-section section-pad" id="kontak">
            <div class="wrap contact-wrap">
                <div class="contact-panel">
                    <div class="contact-intro">
                        <p class="eyebrow"><span class="eyebrow-mark"></span> Privasi dan keamanan</p>
                        <h2>Jaga data pribadi Anda.</h2>
                        <p>Data kependudukan bersifat pribadi. Pastikan alamat situs dan kanal komunikasi benar-benar resmi sebelum mengirim NIK, nomor KK, atau dokumen pendukung. Jangan membagikan kode pelacakan maupun dokumen kepada pihak yang tidak berkepentingan.</p>
                        <div class="safety-note">
                            <span class="safety-note-mark" aria-hidden="true">✓</span>
                            <p>Pengurusan dokumen kependudukan tidak dipungut biaya. Abaikan permintaan pembayaran melalui rekening pribadi atau tautan yang tidak terverifikasi.</p>
                        </div>
                    </div>
                    <div class="contact-side">
                        <span>Perlu informasi atau bantuan?</span>
                        <a href="tel:1500537"><span>Halo Dukcapil<small>Informasi layanan kependudukan</small></span><strong>1500-537 ↗</strong></a>
                        <a href="https://kemendagri.lapor.go.id" target="_blank" rel="noopener noreferrer"><span>Kanal pengaduan resmi<small>Sampaikan pengaduan melalui kanal pemerintah</small></span><strong>kemendagri.lapor.go.id ↗</strong></a>
                    </div>
                </div>

                <div class="office-map-card">
                    <div class="office-map-heading">
                        <div class="office-map-title">
                            <span class="office-mini-label">KANTOR PELAYANAN</span>
                            <h3>Kunjungi kantor kami</h3>
                            <p>Periksa lokasi dan jam pelayanan sebelum merencanakan kunjungan.</p>
                        </div>
                        <div class="office-map-meta">
                            <div><span class="office-meta-icon" aria-hidden="true">⌖</span><span><small>ALAMAT</small><strong>Jl. Cempaka No.6A, Ujung Padang, Padangsidimpuan</strong></span></div>
                            <div><span class="office-meta-icon" aria-hidden="true">◷</span><span><small>JAM PELAYANAN</small><strong>Senin–Jumat · 08.00–16.00 WIB</strong></span></div>
                        </div>
                    </div>
                    <iframe
                        class="office-mini-map"
                        title="Peta lokasi Kantor Pelayanan Dukcapil Padangsidimpuan"
                        src="https://www.google.com/maps?q=Jl.%20Cempaka%20No.6A%2C%20Ujung%20Padang%2C%20Kec.%20Padangsidimpuan%20Sel.%2C%20Kota%20Padang%20Sidempuan%2C%20Sumatera%20Utara%2022725&output=embed"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </section>
    </main>

    <style>
        .home-page .trust-strip {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
            margin-top: -24px;
            margin-bottom: 0;
            position: relative;
            z-index: 2;
        }

        .home-page .trust-item {
            display: grid;
            align-content: start;
            gap: 8px;
            min-height: 126px;
            padding: 20px 20px 18px;
            border: 1px solid #e5ebe3;
            border-radius: 18px;
            background: linear-gradient(145deg, #fff 0%, #f8faf6 100%);
            box-shadow: 0 12px 30px rgba(24, 53, 38, .07);
            text-align: left;
        }

        .home-page .trust-item strong {
            font-family: Manrope, "DM Sans", sans-serif;
            font-size: clamp(22px, 2vw, 30px);
            letter-spacing: -.06em;
            color: #1d5fa8;
        }

        .home-page .trust-item span {
            max-width: 24ch;
            color: #65756b;
            font-size: 12px;
            font-weight: 600;
            line-height: 1.55;
        }

        .home-page .feature-section {
            position: relative;
            isolation: isolate;
            margin-top: 42px;
            padding: 82px 0 88px;
            overflow: hidden;
            border: 0;
            background:
                radial-gradient(ellipse at 88% 12%, rgba(116, 174, 235, .2), transparent 30%),
                radial-gradient(ellipse at 8% 92%, rgba(55, 119, 190, .24), transparent 35%),
                linear-gradient(135deg, #102845 0%, #173d66 54%, #10243d 100%);
        }

        .home-page .feature-section::before,
        .home-page .feature-section::after {
            position: absolute;
            z-index: -1;
            width: 420px;
            height: 420px;
            border: 1px solid rgba(177, 210, 246, .14);
            border-radius: 50%;
            content: "";
            pointer-events: none;
        }

        .home-page .feature-section::before {
            top: -290px;
            right: -80px;
            box-shadow: 0 0 0 34px rgba(177, 210, 246, .03), 0 0 0 68px rgba(177, 210, 246, .02);
        }

        .home-page .feature-section::after {
            bottom: -340px;
            left: -150px;
            width: 500px;
            height: 500px;
        }

        .home-page .feature-section .section-heading {
            align-items: end;
            gap: 48px;
            margin-bottom: 38px;
        }

        .home-page .feature-section .section-heading .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 17px;
            color: #b9d8fa;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .18em;
            text-transform: uppercase;
        }

        .home-page .feature-section .section-heading .eyebrow-mark {
            background: #85bafa;
            box-shadow: 0 0 0 4px rgba(133, 186, 250, .16);
        }

        .home-page .feature-section .section-heading h2 {
            max-width: 14ch;
            color: #f7fbff;
            font-size: clamp(36px, 4.5vw, 54px);
            line-height: 1.04;
            letter-spacing: -.065em;
        }

        .home-page .feature-section .section-heading > p {
            max-width: 430px;
            margin-bottom: 4px;
            color: rgba(239, 246, 255, .78);
            font-size: 14px;
            line-height: 1.9;
        }

        .home-page .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            margin-top: 0;
            counter-reset: feature;
        }

        .home-page .feature-card {
            position: relative;
            display: flex;
            min-height: 248px;
            flex-direction: column;
            align-items: flex-start;
            padding: 28px 27px 26px;
            overflow: hidden;
            border: 1px solid rgba(203, 220, 240, .9);
            border-radius: 20px;
            background:
                radial-gradient(ellipse at 100% 0%, rgba(178, 209, 245, .28), transparent 34%),
                linear-gradient(145deg, #ffffff 0%, #f1f6fc 100%);
            box-shadow: 0 18px 38px rgba(4, 18, 35, .2);
            counter-increment: feature;
            transition: transform .24s ease, box-shadow .24s ease, border-color .24s ease;
        }

        .home-page .feature-card::before {
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            height: 2px;
            background: linear-gradient(90deg, #347dc5, #b8d7f7 58%, transparent);
            content: "";
        }

        .home-page .feature-card::after {
            position: absolute;
            top: 28px;
            right: 27px;
            color: #8297b0;
            content: "0" counter(feature);
            font: 800 12px Manrope, "DM Sans", sans-serif;
            letter-spacing: .16em;
        }

        .home-page .feature-card:hover {
            transform: translateY(-6px);
            border-color: #8db9e8;
            box-shadow: 0 25px 48px rgba(4, 18, 35, .27);
        }

        .home-page .feature-icon {
            display: inline-grid;
            place-items: center;
            width: 48px;
            height: 48px;
            margin-bottom: 21px;
            border: 1px solid #cdddf0;
            border-radius: 15px;
            background: linear-gradient(145deg, #e5f1ff, #dce9f7);
            color: #1d5fa8;
            font-size: 19px;
            font-weight: 800;
            box-shadow: 0 6px 15px rgba(34, 79, 130, .1);
        }

        .home-page .feature-card h3 {
            margin: 0 0 10px;
            color: #1b3552;
            font-size: 19px;
            line-height: 1.32;
            letter-spacing: -.04em;
        }

        .home-page .feature-card p {
            margin: 0;
            color: #5f738c;
            font-size: 13px;
            line-height: 1.8;
        }

        :root[data-theme="dark"] .home-page .trust-item,
        :root[data-theme="dark"] .home-page .feature-card {
            border-color: var(--line);
            background: var(--card);
            box-shadow: none;
        }

        :root[data-theme="dark"] .home-page .feature-section {
            border-color: var(--line);
            background:
                radial-gradient(ellipse at 88% 12%, rgba(116, 174, 235, .12), transparent 30%),
                linear-gradient(135deg, #0a1c30 0%, #102a46 54%, #0a1c30 100%);
        }

        :root[data-theme="dark"] .home-page .feature-section .section-heading h2 {
            color: var(--ink);
        }

        :root[data-theme="dark"] .home-page .feature-card h3 {
            color: var(--ink);
        }

        :root[data-theme="dark"] .home-page .feature-section .section-heading > p,
        :root[data-theme="dark"] .home-page .feature-card p,
        :root[data-theme="dark"] .home-page .trust-item span {
            color: var(--muted);
        }

        :root[data-theme="dark"] .home-page .trust-item strong,
        :root[data-theme="dark"] .home-page .feature-section .section-heading .eyebrow {
            color: var(--green);
        }

        :root[data-theme="dark"] .home-page .feature-icon {
            border-color: var(--line);
            background: var(--card-alt);
            color: var(--green);
        }

        .home-page .steps-section {
            padding: 82px 0 88px;
            background:
                radial-gradient(ellipse at 95% 10%, rgba(122, 169, 221, .17), transparent 28%),
                linear-gradient(180deg, #f7faff, #edf3fa);
        }

        .home-page .steps-section .section-heading {
            margin-bottom: 34px;
        }

        .home-page .steps-section .section-heading .eyebrow {
            color: #416d9e;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .16em;
            text-transform: uppercase;
        }

        .home-page .steps-section .section-heading h2 {
            color: #1b3552;
            font-size: clamp(34px, 4vw, 46px);
            letter-spacing: -.06em;
        }

        .home-page .steps-section .section-heading > p {
            max-width: 430px;
            color: #5f738c;
            font-size: 14px;
            line-height: 1.8;
        }

        .home-page .steps-grid {
            gap: 18px;
        }

        .home-page .step-card {
            position: relative;
            min-height: 294px;
            padding: 27px 26px 24px;
            overflow: hidden;
            border: 1px solid #dce6f1;
            border-radius: 20px;
            background: linear-gradient(150deg, #fff 0%, #f3f7fc 100%);
            box-shadow: 0 14px 34px rgba(24, 56, 95, .08);
            transition: transform .24s ease, box-shadow .24s ease, border-color .24s ease;
        }

        .home-page .step-card::before {
            position: absolute;
            inset: 0 0 auto;
            height: 3px;
            background: linear-gradient(90deg, #347dc5, #b8d7f7 55%, transparent);
            content: "";
        }

        .home-page .step-card:hover {
            transform: translateY(-5px);
            border-color: #b6cce5;
            box-shadow: 0 22px 42px rgba(24, 56, 95, .12);
        }

        .home-page .step-number {
            width: 42px;
            height: 42px;
            border: 1px solid #cdddf0;
            border-radius: 14px;
            color: #1d5fa8;
            background: linear-gradient(145deg, #e5f1ff, #dce9f7);
            font-size: 13px;
        }

        .home-page .step-card-kicker {
            display: block;
            margin-top: 21px;
            color: #416d9e;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: .15em;
        }

        .home-page .step-card h3 {
            margin: 7px 0 9px;
            color: #1b3552;
            font-size: 20px;
            letter-spacing: -.04em;
        }

        .home-page .step-card p {
            margin: 0;
            color: #5f738c;
            font-size: 13px;
            line-height: 1.75;
        }

        .home-page .step-card-note {
            display: block;
            margin-top: 17px;
            padding-top: 12px;
            border-top: 1px solid #dce6f1;
            color: #416d9e;
            font-size: 11px;
            font-weight: 700;
            line-height: 1.5;
        }

        .home-page .contact-section {
            padding: 80px 0 86px;
            background:
                radial-gradient(ellipse at 8% 12%, rgba(65, 123, 190, .25), transparent 31%),
                linear-gradient(135deg, #102845 0%, #173d66 56%, #10243d 100%);
        }

        .home-page .contact-wrap {
            display: grid;
            gap: 27px;
            width: min(1160px, calc(100% - 56px));
        }

        .home-page .contact-panel {
            grid-template-columns: minmax(0, 1.1fr) minmax(300px, .9fr);
            align-items: stretch;
            gap: 56px;
            padding: 0;
            border: 0;
            border-radius: 0;
            background: transparent;
            box-shadow: none;
        }

        .home-page .contact-intro .eyebrow {
            margin: 0 0 17px;
            color: #b9d8fa;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .16em;
            text-transform: uppercase;
        }

        .home-page .contact-intro .eyebrow-mark {
            background: #85bafa;
        }

        .home-page .contact-panel h2 {
            max-width: 15ch;
            color: #f7fbff;
            font-size: clamp(35px, 4vw, 48px);
            line-height: 1.07;
            letter-spacing: -.06em;
        }

        .home-page .contact-panel .contact-intro > p:not(.eyebrow) {
            max-width: 620px;
            margin: 17px 0 0;
            color: rgba(239, 246, 255, .82);
            font-size: 14px;
            line-height: 1.85;
        }

        .home-page .safety-note {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            max-width: 620px;
            margin-top: 22px;
            padding: 15px 17px;
            border: 1px solid rgba(177, 210, 246, .22);
            border-radius: 14px;
            background: rgba(255, 255, 255, .055);
        }

        .home-page .safety-note-mark {
            display: grid;
            flex: 0 0 24px;
            width: 24px;
            height: 24px;
            place-items: center;
            border-radius: 50%;
            color: #17314f;
            background: #85bafa;
            font-size: 12px;
            font-weight: 900;
        }

        .home-page .safety-note p {
            margin: 0;
            color: rgba(239, 246, 255, .9);
            font-size: 12px;
            line-height: 1.7;
        }

        .home-page .contact-side {
            align-content: center;
            gap: 0;
            padding: 25px 27px;
            border: 1px solid #d3e2f3;
            border-radius: 20px;
            background: linear-gradient(145deg, #fff, #f1f6fc);
            box-shadow: 0 18px 42px rgba(4, 18, 35, .2);
        }

        .home-page .contact-side > span {
            width: auto;
            margin-bottom: 12px;
            padding: 0;
            color: #416d9e;
            background: transparent;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .13em;
            text-transform: uppercase;
        }

        .home-page .contact-side a {
            align-items: center;
            padding: 15px 0;
            border-top: 1px solid #dce6f1;
            color: #1b3552;
            font-size: 13px;
        }

        .home-page .contact-side a > span {
            display: grid;
            gap: 3px;
            font-weight: 700;
        }

        .home-page .contact-side a small {
            color: #66788e;
            font-size: 11px;
            font-weight: 500;
        }

        .home-page .contact-side a strong {
            color: #1d5fa8;
            font-size: 12px;
            text-align: right;
        }

        .home-page .office-map-card {
            overflow: hidden;
            border: 1px solid #d3e2f3;
            border-radius: 22px;
            background: linear-gradient(145deg, #fff, #f1f6fc);
            box-shadow: 0 22px 50px rgba(4, 18, 35, .2);
        }

        .home-page .office-map-heading {
            display: grid;
            grid-template-columns: minmax(0, .9fr) minmax(0, 1.1fr);
            align-items: center;
            gap: 32px;
            padding: 27px 31px 25px;
        }

        .home-page .office-mini-label {
            color: #416d9e;
            font-size: 9px;
            letter-spacing: .16em;
        }

        .home-page .office-map-title h3 {
            margin: 7px 0 5px;
            color: #1b3552;
            font-size: 24px;
            letter-spacing: -.045em;
        }

        .home-page .office-map-title p {
            margin: 0;
            color: #66788e;
            font-size: 12px;
            line-height: 1.65;
        }

        .home-page .office-map-meta {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .home-page .office-map-meta > div {
            display: flex;
            align-items: flex-start;
            gap: 11px;
            min-width: 0;
            padding: 13px;
            border: 1px solid #dce6f1;
            border-radius: 13px;
            background: rgba(255, 255, 255, .82);
        }

        .home-page .office-meta-icon {
            display: grid;
            flex: 0 0 32px;
            width: 32px;
            height: 32px;
            place-items: center;
            border-radius: 10px;
            color: #1d5fa8;
            background: #e6f0fb;
            font-size: 17px;
        }

        .home-page .office-map-meta > div > span:last-child {
            display: grid;
            gap: 4px;
        }

        .home-page .office-map-meta small {
            color: #416d9e;
            font-size: 8px;
            font-weight: 800;
            letter-spacing: .12em;
        }

        .home-page .office-map-meta strong {
            color: #334d69;
            font-size: 11px;
            line-height: 1.5;
        }

        .home-page .office-mini-map {
            width: 100%;
            min-height: 360px;
            display: block;
            margin-top: 0;
            border: 0;
            border-top: 1px solid #dce6f1;
            background: #e8eee8;
        }

        .home-page .trust-item {
            position: relative;
            overflow: hidden;
            transition: transform .22s ease, box-shadow .22s ease;
        }

        .home-page .trust-item:before {
            position: absolute;
            inset: 0 0 auto;
            height: 3px;
            background: linear-gradient(90deg, #1d5fa8, #8cbbea);
            content: "";
        }

        .home-page .trust-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 34px rgba(24, 56, 95, 0.1);
        }

        .home-page .contact-side a {
            transition: color .2s ease, transform .2s ease;
        }

        .home-page .contact-side a:hover {
            color: #1d5fa8;
            transform: translateX(3px);
        }

        :root[data-theme="dark"] .home-page .steps-section {
            background:
                radial-gradient(ellipse at 95% 10%, rgba(122, 169, 221, .1), transparent 28%),
                linear-gradient(180deg, #10243a, #0b1a2b);
        }

        :root[data-theme="dark"] .home-page .steps-section .section-heading h2,
        :root[data-theme="dark"] .home-page .step-card h3 {
            color: var(--ink);
        }

        :root[data-theme="dark"] .home-page .steps-section .section-heading > p,
        :root[data-theme="dark"] .home-page .step-card p {
            color: var(--muted);
        }

        :root[data-theme="dark"] .home-page .step-card {
            border-color: var(--line);
            background: var(--card);
            box-shadow: none;
        }

        :root[data-theme="dark"] .home-page .step-card-note {
            border-color: var(--line);
            color: var(--green);
        }

        @media (max-width: 860px) {
            .home-page .trust-strip,
            .home-page .feature-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .home-page .contact-panel {
                grid-template-columns: 1fr;
                gap: 28px;
            }

            .home-page .office-map-heading {
                grid-template-columns: 1fr;
                gap: 18px;
            }
        }

        @media (max-width: 560px) {
            .home-page .trust-strip,
            .home-page .feature-grid {
                grid-template-columns: 1fr;
            }

            .home-page .trust-strip {
                gap: 10px;
                margin-top: -12px;
            }

            .home-page .trust-item {
                min-height: auto;
                padding: 15px 17px;
            }

            .home-page .feature-section {
                margin-top: 24px;
                padding: 54px 0 58px;
            }

            .home-page .feature-section .section-heading {
                display: block;
                margin-bottom: 27px;
            }

            .home-page .feature-section .section-heading h2 {
                max-width: 100%;
                font-size: 38px;
            }

            .home-page .feature-section .section-heading > p {
                margin-top: 12px;
                font-size: 13px;
            }

            .home-page .feature-card {
                min-height: 0;
                padding: 24px 22px;
            }

            .home-page .steps-section {
                padding: 56px 0 62px;
            }

            .home-page .steps-section .section-heading {
                display: block;
                margin-bottom: 24px;
            }

            .home-page .steps-section .section-heading h2 {
                font-size: 36px;
            }

            .home-page .steps-section .section-heading > p {
                margin-top: 12px;
                font-size: 13px;
            }

            .home-page .steps-grid {
                grid-template-columns: 1fr;
                gap: 13px;
            }

            .home-page .step-card {
                min-height: 0;
                padding: 23px 21px;
            }

            .home-page .contact-section {
                padding: 55px 0 60px;
            }

            .home-page .contact-wrap {
                width: calc(100% - 30px);
                gap: 20px;
            }

            .home-page .contact-panel {
                gap: 23px;
            }

            .home-page .contact-panel h2 {
                font-size: 36px;
            }

            .home-page .contact-side {
                padding: 20px;
            }

            .home-page .office-map-heading {
                padding: 22px 19px;
            }

            .home-page .office-map-meta {
                grid-template-columns: 1fr;
                gap: 9px;
            }

            .home-page .office-mini-map {
                min-height: 280px;
            }

            .feature-card {
                padding: 20px 16px;
            }
        }

        body.home-page .site-header {
            position: sticky;
            top: 0;
            background: #10395f;
            border-bottom-color: rgba(255, 255, 255, 0.14);
            box-shadow: none;
            backdrop-filter: blur(14px);
        }

        body.home-page .site-header .wrap {
            width: min(1250px, calc(100% - 56px));
        }

        body.home-page .header-inner {
            min-height: 84px;
        }

        body.home-page .brand,
        body.home-page .brand small,
        body.home-page .main-nav a,
        body.home-page .main-nav a:hover {
            color: #fff;
        }

        body.home-page .brand small {
            color: rgba(255, 255, 255, 0.76);
        }

        body.home-page .main-nav a:hover {
            background: rgba(255, 255, 255, 0.14);
        }

        body.home-page .main-nav .nav-cta,
        body.home-page .main-nav .nav-cta:hover {
            color: #174b39;
            background: #fff;
            box-shadow: 0 8px 20px rgba(5, 25, 38, 0.2);
        }

        body.home-page .home-hero {
            position: relative;
            isolation: isolate;
            width: 100%;
            min-height: 540px;
            display: grid;
            grid-template-columns: minmax(0, 1fr);
            align-items: center;
            margin: 0;
            padding: 85px 28px 72px;
            overflow: hidden;
            border: 0;
            border-radius: 0;
            background: url("{{ asset('images/hero-landscape.jpg') }}") center / cover no-repeat;
            box-shadow: none;
        }

        body.home-page .home-hero::before,
        body.home-page .home-hero::after {
            display: none;
        }

        body.home-page .home-hero::before {
            position: absolute;
            z-index: 1;
            inset: 0;
            width: auto;
            height: auto;
            display: block;
            border-radius: 0;
            background: linear-gradient(180deg, rgba(8, 28, 47, 0.56), rgba(8, 28, 47, 0.66));
            content: "";
            pointer-events: none;
        }

        body.home-page .hero-background {
            position: absolute;
            z-index: 0;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        body.home-page .hero-copy {
            position: relative;
            z-index: 2;
            width: min(1120px, 100%);
            margin: 0 auto;
            text-align: center;
        }

        body.home-page .hero-art {
            display: none;
        }

        body.home-page .hero-scroll {
            z-index: 2;
        }

        body.home-page .hero-copy .eyebrow {
            width: fit-content;
            justify-content: center;
            margin: 0 auto 42px;
            padding: 8px 14px;
            border: 1px solid rgba(255, 255, 255, 0.34);
            border-radius: 999px;
            color: #fff;
            background: rgba(14, 37, 52, 0.32);
            font-size: 10px;
            letter-spacing: 0.14em;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.45);
        }

        body.home-page .home-hero .eyebrow-mark {
            background: #e5ce91;
        }

        body.home-page .hero-copy h1 {
            max-width: 1100px;
            margin: 0 auto 20px;
            color: #fff;
            font-size: clamp(46px, 6vw, 76px);
            letter-spacing: -0.075em;
            line-height: 1.04;
            text-wrap: balance;
            text-shadow: 0 2px 6px rgba(0, 0, 0, 0.55), 0 8px 26px rgba(0, 0, 0, 0.32);
        }

        body.home-page .hero-copy h1 span {
            color: #e7d7a7;
        }

        body.home-page .hero-copy .lead {
            max-width: 610px;
            margin: 0 auto;
            color: rgba(255, 255, 255, 0.9);
            font-size: 19px;
            line-height: 1.65;
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.72);
        }

        .hero-tags {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 9px;
            margin-top: 23px;
            color: #fff;
            font-size: 13px;
            font-weight: 700;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.55);
        }

        .hero-tags a {
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            padding: 7px 14px;
            border: 1px solid rgba(255, 255, 255, 0.48);
            border-radius: 999px;
            color: #fff;
            background: rgba(7, 29, 49, 0.72);
            text-decoration: none;
            transition: background .2s ease, border-color .2s ease, transform .2s ease;
        }

        .hero-tags a:hover {
            transform: translateY(-2px);
            border-color: rgba(255, 255, 255, 0.72);
            background: rgba(7, 29, 49, 0.9);
        }

        body.home-page .home-hero .hero-actions {
            justify-content: center;
            gap: 13px;
            margin-top: 38px;
        }

        body.home-page .home-hero .button-primary {
            min-height: 51px;
            padding-inline: 22px;
            color: #174b39;
            background: #fff;
            box-shadow: 0 12px 28px rgba(5, 25, 38, 0.22);
        }

        body.home-page .home-hero .button-primary:hover {
            color: #123e30;
            background: #f2f5ec;
            box-shadow: 0 16px 32px rgba(5, 25, 38, 0.28);
        }

        body.home-page .home-hero .text-link {
            padding: 12px 15px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 12px;
            color: #fff;
            background: rgba(7, 29, 49, 0.78);
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.4);
        }

        body.home-page .home-hero .text-link span {
            color: #e7d7a7;
        }

        body.home-page .hero-copy .hero-proof {
            width: fit-content;
            max-width: 100%;
            justify-content: center;
            flex-wrap: wrap;
            gap: 12px;
            margin: 23px auto 0;
            padding: 10px 16px;
            border: 1px solid rgba(255, 255, 255, 0.38);
            border-radius: 999px;
            color: #fff;
            background: rgba(7, 29, 49, 0.78);
            font-size: 14px;
            line-height: 1.5;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.4);
        }

        body.home-page .hero-proof span {
            color: #e7d7a7;
        }

        body.home-page .hero-proof i {
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: #e7d7a7;
        }

        .hero-scroll {
            position: absolute;
            bottom: 26px;
            left: 50%;
            display: grid;
            justify-items: center;
            gap: 6px;
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-decoration: none;
            text-transform: uppercase;
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.8);
            transform: translateX(-50%);
        }

        .hero-scroll b {
            width: 28px;
            height: 28px;
            display: grid;
            place-items: center;
            border: 1px solid rgba(255, 255, 255, 0.55);
            border-radius: 50%;
            font-size: 15px;
            font-weight: 500;
        }

        body.home-page .trust-strip {
            position: relative;
            z-index: 2;
            width: min(1080px, calc(100% - 56px));
            margin-top: -34px;
            margin-bottom: 20px;
            padding: 10px 12px;
            border: 1px solid #e2e8e1;
            border-radius: 22px;
            background: #fff;
            box-shadow: 0 18px 44px rgba(24, 47, 36, 0.12);
        }

        body.home-page .trust-item,
        body.home-page .trust-item:hover {
            min-width: 0;
            padding: 13px 10px;
            border: 0;
            border-radius: 14px;
            background: transparent;
            box-shadow: none;
            transform: none;
        }

        body.home-page .trust-item::before {
            display: none;
        }

        body.home-page .trust-item:not(:last-child) {
            border-right: 1px solid #e7ebe5;
            border-radius: 0;
        }

        body.home-page .trust-item strong {
            color: #245e46;
        }

        body.home-page .trust-item span {
            font-size: 10px;
            letter-spacing: 0.04em;
        }

        @media (max-width: 720px) {
            body.home-page .site-header {
                position: sticky;
                top: 0;
            }

            body.home-page .site-header .wrap {
                width: calc(100% - 30px);
            }

            body.home-page .header-inner {
                flex-wrap: wrap;
                justify-content: center;
                gap: 7px;
                padding-block: 9px;
            }

            body.home-page .brand {
                justify-content: center;
            }

            body.home-page .main-nav a:not(.nav-cta) {
                border: 1px solid rgba(255, 255, 255, 0.2);
                color: #fff;
                background: rgba(255, 255, 255, 0.1);
            }

            body.home-page .main-nav .nav-cta {
                color: #174b39;
                background: #fff;
                box-shadow: 0 5px 12px rgba(5, 25, 38, 0.2);
            }

            body.home-page .home-hero {
                min-height: 570px;
                padding: 52px 20px 82px;
            }

            body.home-page .hero-background {
                object-position: 68% center;
            }

            body.home-page .home-hero::before {
                background: linear-gradient(180deg, rgba(8, 28, 47, 0.64), rgba(8, 28, 47, 0.72));
            }

            body.home-page .hero-copy {
                align-self: center;
            }

            body.home-page .hero-copy .eyebrow {
                margin-bottom: 22px;
                font-size: 11px;
                letter-spacing: 0.1em;
            }

            body.home-page .hero-copy h1 {
                margin-bottom: 15px;
                font-size: clamp(34px, 8.8vw, 48px);
                line-height: 1.06;
                letter-spacing: -0.065em;
            }

            body.home-page .hero-copy h1 br {
                display: none;
            }

            body.home-page .hero-copy .lead {
                font-size: 16px;
                line-height: 1.6;
            }

            .hero-tags {
                gap: 7px;
                margin-top: 20px;
                font-size: 12px;
            }

            .hero-tags a {
                min-height: 40px;
                padding: 7px 12px;
                font-size: 12px;
            }

            body.home-page .home-hero .hero-actions {
                display: flex;
                flex-direction: column;
                gap: 9px;
                margin-top: 22px;
            }

            body.home-page .home-hero .hero-actions .button {
                width: min(300px, 100%);
            }

            body.home-page .home-hero .text-link {
                padding: 10px 13px;
            }

            body.home-page .hero-proof {
                gap: 8px;
                margin-top: 18px;
                font-size: 12px;
            }

            .hero-scroll {
                bottom: 17px;
                font-size: 9px;
            }

            body.home-page .trust-strip {
                width: calc(100% - 28px);
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 0;
                margin-top: -24px;
                padding: 7px;
                border-radius: 17px;
            }

            body.home-page .trust-item,
            body.home-page .trust-item:not(:last-child) {
                padding: 12px 5px;
                border-radius: 0;
            }

            body.home-page .trust-item:nth-child(odd) {
                border-right: 1px solid #e7ebe5;
            }

            body.home-page .trust-item:nth-child(-n+2) {
                border-bottom: 1px solid #e7ebe5;
            }

            body.home-page .trust-item strong {
                font-size: 21px;
            }

            body.home-page .trust-item span {
                font-size: 8px;
                line-height: 1.35;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            body.home-page .hero-background {
                display: none;
            }

            .hero-tags a,
            .hero-scroll {
                scroll-behavior: auto;
                transition: none;
            }
        }
    </style>
@endsection
