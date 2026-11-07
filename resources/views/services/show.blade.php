@extends('layouts.app')

@section('title', $service['title'])
@section('service_slug', $slug)

@php
    $palette = [
        'ktp-el' => ['#1d5fa8', 'ID'],
        'kartu-keluarga' => ['#2879bd', 'KK'],
        'akta-kelahiran' => ['#1683b8', 'AK'],
        'akta-kematian' => ['#466ec1', '✳'],
        'pindah-datang' => ['#245f92', '↗'],
        'kia' => ['#527ec8', 'KIA'],
    ];
    $serviceArtwork = [
        'ktp-el' => 'ktp-elektronik-background-hd.webp',
        'kartu-keluarga' => 'kartu-keluarga-background-hd.webp',
        'akta-kelahiran' => 'akta-kelahiran-background-hd.webp',
        'akta-kematian' => 'akta-kematian-background-hd.webp',
        'pindah-datang' => 'pindah-datang-background-hd.webp',
        'kia' => 'kartu-identitas-anak-background-hd.webp',
    ];
    [$accent, $symbol] = $palette[$slug];
    $optionalDocuments = $slug === 'ktp-el' ? ['police_letter'] : ($slug === 'kia' ? ['child_photo'] : []);
@endphp

@section('content')
    <main class="service-page{{ $slug === 'ktp-el' ? ' service-page-ktp' : '' }}" style="--service-accent: {{ $accent }}">
        <section class="wrap service-hero">
            <div class="service-hero-copy">
                <div class="breadcrumb"><a href="{{ route('home') }}">Beranda</a><span aria-hidden="true">/</span><span>{{ $service['title'] }}</span></div>
                <p class="eyebrow"><span class="eyebrow-mark"></span> Layanan administrasi kependudukan</p>
                <h1>{{ $service['title'] }}</h1>
                <p class="lead">{{ $service['description'] }}</p>
                <div class="service-meta">
                    <span class="meta-pill"><b aria-hidden="true">◷</b> {{ $service['process'] }}</span>
                    <span class="meta-pill"><b aria-hidden="true">✓</b> Tidak dipungut biaya</span>
                </div>
                <div class="hero-actions">
                    <a class="button button-primary" href="#formulir">Isi formulir <span aria-hidden="true">↓</span></a>
                    <a class="text-link" href="#persyaratan">Lihat persyaratan</a>
                </div>
            </div>
            <div class="service-scene{{ $slug === 'ktp-el' ? ' service-scene-ktp' : '' }}" aria-hidden="true">
                <span class="service-scene-glow"></span>
                <span class="service-scene-orbit"></span>
                <img class="service-document-image{{ $slug === 'ktp-el' ? '' : ' service-document-image-secondary' }}" src="{{ asset('images/'.$serviceArtwork[$slug]) }}" alt="">
                <span class="scene-float">Layanan aman &amp; terarah</span>
            </div>
        </section>

        <div class="wrap service-content">
            <div class="content-main">
                <section class="info-card" id="persyaratan">
                    <h2>Persyaratan dokumen</h2>
                    <p class="card-intro">Siapkan berkas di bawah ini dalam format JPG, PNG, atau PDF (maksimal 5 MB per berkas).</p>
                    <ul class="requirement-list">
                        @foreach ($service['documents'] as $key => $label)
                            <li>{{ $label }}@if (in_array($key, $optionalDocuments, true)) <span>— dapat bergantung pada jenis pengajuan atau usia</span>@endif</li>
                        @endforeach
                    </ul>
                </section>
                <section class="process-note">
                    <strong>Setelah formulir dikirim</strong>
                    <p>{{ $service['process'] }} Simpan kode pelacakan yang muncul setelah pengajuan berhasil. Petugas akan memeriksa kelengkapan berkas.</p>
                </section>
                <div class="track-card">
                    <strong>Sudah pernah mengajukan?</strong>
                    <p>Gunakan kode pelacakan yang Anda terima untuk melihat status permohonan.</p>
                    <span class="field-hint">Buka kembali tautan pelacakan dari tanda terima pengajuan Anda.</span>
                </div>
            </div>

            <section class="application-card" id="formulir">
                <a class="back-link" href="{{ route('home') }}#daftar-layanan">← Semua layanan</a>
                <h2>Formulir pengajuan</h2>
                <p>Lengkapi data dan unggah dokumen untuk memulai permohonan.</p>
                <div class="form-progress-panel" aria-live="polite">
                    <div class="form-progress-meta">
                        <span>Progress formulir</span>
                        <strong id="form-progress-text">0%</strong>
                    </div>
                    <div class="form-progress-track" aria-hidden="true">
                        <span id="form-progress-bar"></span>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="form-notice" role="alert">Periksa kembali isian yang ditandai. Pengajuan belum terkirim.</div>
                @endif
                <form action="{{ route('services.store', ['slug' => $slug]) }}" method="POST" enctype="multipart/form-data" class="wizard-form" data-service-slug="{{ $slug }}">
                    @csrf
                    <div class="wizard-steps" role="group" aria-label="Tahap formulir pengajuan">
                        <button type="button" class="wizard-step-pill is-current" data-step-pill="1" aria-controls="application-step-1" aria-current="step"><span>1</span> Pemohon</button>
                        <button type="button" class="wizard-step-pill" data-step-pill="2" aria-controls="application-step-2"><span>2</span> Detail</button>
                        <button type="button" class="wizard-step-pill" data-step-pill="3" aria-controls="application-step-3"><span>3</span> Berkas</button>
                        <button type="button" class="wizard-step-pill" data-step-pill="4" aria-controls="application-step-4"><span>4</span> Jadwal</button>
                    </div>

                    <div class="wizard-step is-active" id="application-step-1" data-step="1" role="group" aria-labelledby="application-step-title-1">
                        <div class="form-section-title" id="application-step-title-1" role="heading" aria-level="3" tabindex="-1"><span>1</span> Data pemohon</div>
                        <div class="form-stack">
                            <div class="form-field @error('applicant_name') has-error @enderror">
                                <label for="applicant_name">Nama lengkap</label>
                                <input id="applicant_name" name="applicant_name" value="{{ old('applicant_name') }}" autocomplete="name" maxlength="150" required>
                                @error('applicant_name')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-grid">
                                <div class="form-field @error('nik') has-error @enderror">
                                    <label for="nik">NIK <span>· 16 angka</span></label>
                                    <input id="nik" name="nik" inputmode="numeric" autocomplete="off" pattern="[0-9]{16}" maxlength="16" value="{{ old('nik') }}" required>
                                    @error('nik')<span class="field-error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-field @error('family_card_number') has-error @enderror">
                                    <label for="family_card_number">Nomor KK <span>· 16 angka</span></label>
                                    <input id="family_card_number" name="family_card_number" inputmode="numeric" autocomplete="off" pattern="[0-9]{16}" maxlength="16" value="{{ old('family_card_number') }}" required>
                                    @error('family_card_number')<span class="field-error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="form-grid">
                                <div class="form-field @error('birth_date') has-error @enderror">
                                    <label for="birth_date">Tanggal lahir</label>
                                    <input id="birth_date" type="date" name="birth_date" max="{{ now()->toDateString() }}" value="{{ old('birth_date') }}" required>
                                    @error('birth_date')<span class="field-error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-field @error('phone') has-error @enderror">
                                    <label for="phone">Nomor HP aktif</label>
                                    <input id="phone" type="tel" name="phone" inputmode="tel" autocomplete="tel" pattern="0[0-9]{9,12}" value="{{ old('phone') }}" required>
                                    @error('phone')<span class="field-error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="form-field @error('address') has-error @enderror">
                                <label for="address">Alamat sesuai KK</label>
                                <textarea id="address" name="address" maxlength="1000" data-character-counter required>{{ old('address') }}</textarea>
                                <div class="field-meta">
                                    <span class="field-hint">Catatan alamat akan otomatis disimpan</span>
                                    <span class="field-counter" data-counter-for="address">0/1000</span>
                                </div>
                                @error('address')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="wizard-actions">
                            <button type="button" class="button button-primary wizard-next" data-next-step>Selanjutnya <span aria-hidden="true">→</span></button>
                        </div>
                    </div>

                    <div class="wizard-step" id="application-step-2" data-step="2" role="group" aria-labelledby="application-step-title-2">
                        <div class="form-section-title" id="application-step-title-2" role="heading" aria-level="3" tabindex="-1"><span>2</span> Detail layanan</div>
                        <div class="form-stack">
                            @foreach ($service['fields'] as $key => $field)
                                @php($fieldType = $field['type'] ?? 'select')
                                <div class="form-field @error('details.'.$key) has-error @enderror" @if ($slug === 'ktp-el' && $key === 'marital_status') data-ktp-marital-field @endif>
                                    <label for="details_{{ $key }}">{{ $field['label'] }}</label>
                                    @if (isset($field['options']))
                                        <select id="details_{{ $key }}" name="details[{{ $key }}]" @if ($slug === 'ktp-el' && $key === 'marital_status') data-ktp-marital-status @else required @endif>
                                            <option value="">Pilih {{ strtolower($field['label']) }}</option>
                                            @foreach ($field['options'] as $value => $label)
                                                <option value="{{ $value }}" @selected(old('details.'.$key) === $value)>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <input id="details_{{ $key }}" type="{{ $fieldType }}" name="details[{{ $key }}]" value="{{ old('details.'.$key) }}" @if ($fieldType === 'date') max="{{ now()->toDateString() }}" @endif required>
                                    @endif
                                    @error('details.'.$key)<span class="field-error">{{ $message }}</span>@enderror
                                </div>
                            @endforeach
                        </div>
                        <div class="wizard-branch-note" data-branch-note aria-live="polite">
                            <span class="wizard-branch-note__icon" aria-hidden="true">i</span>
                            <span data-branch-note-text>Pilih jenis pengajuan untuk melihat persyaratan dan langkah yang sesuai.</span>
                        </div>
                        <div class="wizard-actions split">
                            <button type="button" class="button button-secondary wizard-prev">Kembali</button>
                            <button type="button" class="button button-primary wizard-next" data-next-step>Selanjutnya <span aria-hidden="true">→</span></button>
                        </div>
                    </div>

                    <div class="wizard-step" id="application-step-3" data-step="3" role="group" aria-labelledby="application-step-title-3">
                        <div class="form-section-title" id="application-step-title-3" role="heading" aria-level="3" tabindex="-1"><span>3</span> Unggah berkas</div>
                        <div class="form-stack">
                            @foreach ($service['documents'] as $key => $label)
                                @php($optional = in_array($key, $optionalDocuments, true))
                                <div class="form-field @error('documents.'.$key) has-error @enderror"
                                    @if ($slug === 'ktp-el' && $key === 'police_letter') data-lost-document-field @endif
                                    @if ($slug === 'kia' && $key === 'child_photo') data-child-photo-field @endif>
                                    <label for="documents_{{ $key }}">{{ $label }} @if ($optional)<span>· lihat ketentuan</span>@endif</label>
                                    <div class="upload-box">
                                        <input
                                            id="documents_{{ $key }}"
                                            type="file"
                                            name="documents[{{ $key }}]"
                                            accept=".jpg,.jpeg,.png,.pdf"
                                            @if (! $optional) required @endif
                                            @if ($slug === 'ktp-el' && $key === 'police_letter') data-lost-document @endif
                                        >
                                        <span class="upload-box__label">Pilih berkas</span>
                                    </div>
                                    <div class="file-meta"><span class="file-meta__text">Belum ada berkas dipilih</span></div>
                                    @if ($slug === 'ktp-el' && $key === 'police_letter')
                                        <span class="field-hint">Wajib jika mengajukan penggantian KTP-el hilang.</span>
                                    @elseif ($slug === 'kia' && $key === 'child_photo')
                                        <span class="field-hint">Wajib untuk anak berusia 5 tahun ke atas.</span>
                                    @else
                                        <span class="field-hint">JPG, PNG, atau PDF · maksimal 5 MB.</span>
                                    @endif
                                    @error('documents.'.$key)<span class="field-error">{{ $message }}</span>@enderror
                                </div>
                            @endforeach
                        </div>
                        <div class="wizard-actions split">
                            <button type="button" class="button button-secondary wizard-prev">Kembali</button>
                            <button type="button" class="button button-primary wizard-next" data-next-step>Selanjutnya <span aria-hidden="true">→</span></button>
                        </div>
                    </div>

                    <div class="wizard-step" id="application-step-4" data-step="4" role="group" aria-labelledby="application-step-title-4">
                        <div class="form-section-title" id="application-step-title-4" role="heading" aria-level="3" tabindex="-1"><span>4</span> Jadwal kunjungan</div>
                        <div class="form-stack">
                            <div class="form-field @error('office') has-error @enderror">
                                <label for="office">Lokasi perekaman</label>
                                <select id="office" name="office" required>
                                    <option value="">Pilih kantor</option>
                                    @foreach (['Kantor Dinas (pusat)', 'Kantor Kecamatan Utara', 'Kantor Kecamatan Selatan'] as $office)
                                        <option value="{{ $office }}" @selected(old('office') === $office)>{{ $office }}</option>
                                    @endforeach
                                </select>
                                @error('office')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-grid">
                                <div class="form-field @error('visit_date') has-error @enderror">
                                    <label for="visit_date">Tanggal kunjungan</label>
                                    <input id="visit_date" type="date" name="visit_date" min="{{ now()->toDateString() }}" value="{{ old('visit_date') }}" required>
                                    @error('visit_date')<span class="field-error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-field @error('time_slot') has-error @enderror">
                                    <label for="time_slot">Jam kunjungan</label>
                                    <select id="time_slot" name="time_slot" required>
                                        <option value="">Pilih jam</option>
                                        @foreach (['09.00 - 10.00', '10.00 - 11.00', '13.00 - 14.00', '14.00 - 15.00'] as $slot)
                                            <option value="{{ $slot }}" @selected(old('time_slot') === $slot)>{{ $slot }}</option>
                                        @endforeach
                                    </select>
                                    @error('time_slot')<span class="field-error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="wizard-review" aria-live="polite">
                            <div class="wizard-review__heading">
                                <span class="wizard-review__icon" aria-hidden="true">✓</span>
                                <div><strong>Ringkasan pengajuan</strong><small>Periksa pilihan sebelum dikirim.</small></div>
                            </div>
                            <dl>
                                <div><dt>Jenis pengajuan</dt><dd data-review-type>Belum dipilih</dd></div>
                                <div><dt>Berkas siap</dt><dd data-review-files>0 berkas</dd></div>
                                <div><dt>Lokasi dan jadwal</dt><dd data-review-appointment>Belum dipilih</dd></div>
                            </dl>
                        </div>
                        <div class="form-field @error('agree') has-error @enderror">
                            <label class="consent"><input type="checkbox" name="agree" value="1" @checked(old('agree')) required><span>Saya menyatakan data dan berkas yang diisi benar.</span></label>
                            @error('agree')<span class="field-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-notice">Layanan ini merupakan demonstrasi digital administrasi kependudukan. Untuk pengajuan resmi, silakan gunakan kanal terverifikasi Pemerintah Kota Padangsidimpuan.</div>
                        <div class="wizard-actions split">
                            <button type="button" class="button button-secondary wizard-prev">Kembali</button>
                            <button class="button button-primary button-submit" type="submit">Kirim pengajuan <span aria-hidden="true">↗</span></button>
                        </div>
                        <p class="field-hint" data-submit-status role="status" aria-live="polite"></p>
                    </div>
                </form>
            </section>
        </div>
    </main>
    <script>
        (() => {
            const form = document.querySelector('.wizard-form');
            if (!form) return;

            const applicationType = document.querySelector('[name="details[application_type]"]');
            const lostDocument = document.querySelector('[data-lost-document]');
            const maritalStatus = document.querySelector('[data-ktp-marital-status]');
            const applicantBirthDate = document.querySelector('[name="birth_date"]');
            const childBirthDate = document.querySelector('[name="details[child_birth_date]"]');
            const childPhoto = document.querySelector('#documents_child_photo');
            const steps = Array.from(form.querySelectorAll('.wizard-step'));
            const stepPills = Array.from(form.querySelectorAll('[data-step-pill]'));
            const progressText = document.getElementById('form-progress-text');
            const progressBar = document.getElementById('form-progress-bar');
            const branchNote = form.querySelector('[data-branch-note-text]');
            const reviewType = form.querySelector('[data-review-type]');
            const reviewFiles = form.querySelector('[data-review-files]');
            const reviewAppointment = form.querySelector('[data-review-appointment]');
            const submitButton = form.querySelector('.button-submit');
            const submitStatus = form.querySelector('[data-submit-status]');
            let isSubmitting = false;

            const updateConditionalFields = () => {
                const type = applicationType?.value || '';
                const isNewKtp = form.dataset.serviceSlug === 'ktp-el' && type === 'new';
                const needsPoliceLetter = form.dataset.serviceSlug === 'ktp-el' && type === 'lost';
                const maritalField = form.querySelector('[data-ktp-marital-field]');
                const policeField = form.querySelector('[data-lost-document-field]');

                if (maritalStatus && maritalField) {
                    maritalField.hidden = !isNewKtp;
                    maritalStatus.required = isNewKtp;
                    maritalStatus.disabled = !isNewKtp;
                }
                if (lostDocument && policeField) {
                    policeField.hidden = !needsPoliceLetter;
                    lostDocument.required = needsPoliceLetter;
                    lostDocument.disabled = !needsPoliceLetter;
                    if (!needsPoliceLetter) lostDocument.value = '';
                }

                const childAge = childBirthDate?.value ? getAge(childBirthDate.value) : null;
                const needsChildPhoto = form.dataset.serviceSlug === 'kia' && childAge !== null && childAge >= 5 && childAge < 17;
                const childPhotoField = form.querySelector('[data-child-photo-field]');
                if (childPhoto && childPhotoField) {
                    childPhotoField.hidden = childAge !== null && childAge < 5;
                    childPhoto.required = needsChildPhoto;
                    childPhoto.disabled = childAge !== null && childAge < 5;
                    if (childPhoto.disabled) childPhoto.value = '';
                }
                if (childBirthDate) {
                    childBirthDate.setCustomValidity(childAge !== null && childAge >= 17
                        ? 'KIA diperuntukkan bagi anak yang berusia di bawah 17 tahun.'
                        : '');
                }

                const applicantAge = applicantBirthDate?.value ? getAge(applicantBirthDate.value) : null;
                const needsKtpAgeReview = isNewKtp
                    && applicantAge !== null
                    && applicantAge < 17
                    && maritalStatus?.value !== 'married';
                applicationType?.setCustomValidity(needsKtpAgeReview
                    ? 'Pemohon di bawah 17 tahun hanya dapat mengajukan KTP-el baru jika sudah menikah.'
                    : '');

                if (branchNote) {
                    const messages = {
                        'ktp-el': {
                            new: 'KTP-el baru memerlukan data status perkawinan. Pemohon di bawah 17 tahun perlu sudah menikah.',
                            lost: 'Untuk penggantian karena hilang, surat keterangan kehilangan dari kepolisian wajib diunggah.',
                            damaged: 'Untuk KTP-el rusak, siapkan dokumen pendukung dan bawa kartu yang rusak saat kunjungan.',
                            correction: 'Untuk perubahan data, siapkan dokumen resmi yang membuktikan perubahan tersebut.',
                        },
                        'kartu-keluarga': {
                            new: 'Pengajuan KK baru diproses berdasarkan dokumen identitas dan dokumen peristiwa keluarga.',
                            change: 'Untuk perubahan anggota atau data, jelaskan ringkasan perubahan pada isian berikut.',
                            correction: 'Untuk koreksi data, pastikan berkas pendukung menunjukkan data yang benar.',
                        },
                        'pindah-datang': {
                            outgoing: 'Pilih pindah keluar dan masukkan alamat tujuan secara lengkap.',
                            incoming: 'Pilih pindah datang dan masukkan alamat asal perpindahan secara lengkap.',
                        },
                    };
                    branchNote.textContent = messages[form.dataset.serviceSlug]?.[type]
                        || (form.dataset.serviceSlug === 'kia'
                            ? (childAge === null ? 'KIA ditujukan untuk anak di bawah 17 tahun. Pas foto wajib untuk usia 5 tahun ke atas.' : childAge >= 17
                                ? 'Usia anak tidak memenuhi ketentuan KIA (di bawah 17 tahun).'
                                : childAge >= 5
                                    ? 'Usia anak memenuhi ketentuan KIA. Pas foto wajib disertakan.'
                                    : 'Usia anak di bawah 5 tahun; pas foto tidak wajib.')
                            : 'Lengkapi data sesuai dokumen resmi dan periksa kembali sebelum melanjutkan.');
                }
                updateProgress();
                updateReview();
                if (applicationType?.value) validateField(applicationType);
                if (childBirthDate?.value) validateField(childBirthDate);
            };

            const getAge = (dateValue) => {
                const birthDate = new Date(`${dateValue}T00:00:00`);
                if (Number.isNaN(birthDate.getTime()) || birthDate > new Date()) return null;
                const today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                const monthDifference = today.getMonth() - birthDate.getMonth();
                if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) age--;
                return age;
            };

            const updateProgress = () => {
                const requiredFields = Array.from(form.querySelectorAll('input[required], select[required], textarea[required]'));
                const total = requiredFields.length;
                const filled = requiredFields.filter((field) => {
                    if (field.type === 'checkbox') return field.checked;
                    if (field.type === 'file') return field.files && field.files.length > 0;
                    return String(field.value || '').trim().length > 0;
                }).length;
                const pct = total ? Math.round((filled / total) * 100) : 0;
                if (progressText) progressText.textContent = `${pct}%`;
                if (progressBar) progressBar.style.width = `${pct}%`;
            };

            const updateReview = () => {
                const selectedType = applicationType?.selectedOptions[0]?.textContent?.trim();
                const detailSummary = Array.from(form.querySelectorAll('[name^="details["]'))
                    .map((field) => field.selectedOptions?.[0]?.textContent?.trim() || field.value?.trim())
                    .filter((value) => value && !value.startsWith('Pilih '))
                    .join(' · ');
                const selectedFiles = Array.from(form.querySelectorAll('input[type="file"]'))
                    .filter((input) => !input.disabled && input.files?.length);
                const office = form.querySelector('[name="office"]')?.selectedOptions[0]?.textContent?.trim();
                const date = form.querySelector('[name="visit_date"]')?.value;
                const slot = form.querySelector('[name="time_slot"]')?.value;
                if (reviewType) {
                    reviewType.textContent = selectedType && !selectedType.startsWith('Pilih ')
                        ? selectedType
                        : (detailSummary || 'Belum dipilih');
                }
                if (reviewFiles) reviewFiles.textContent = `${selectedFiles.length} berkas terpilih`;
                if (reviewAppointment) {
                    const appointment = [office && !office.startsWith('Pilih ') ? office : '', date || '', slot || ''].filter(Boolean);
                    reviewAppointment.textContent = appointment.length ? appointment.join(' · ') : 'Belum dipilih';
                }
            };

            const getCurrentStep = () => Number(form.querySelector('.wizard-step.is-active')?.dataset.step || 1);

            const setCurrentStep = (nextStep, focusHeading = true) => {
                steps.forEach((step) => {
                    const isActive = Number(step.dataset.step) === nextStep;
                    step.classList.toggle('is-active', isActive);
                    step.hidden = !isActive;
                });
                stepPills.forEach((pill) => {
                    const target = Number(pill.dataset.stepPill);
                    const isCurrent = target === nextStep;
                    const isComplete = target < nextStep;
                    pill.classList.toggle('is-current', isCurrent);
                    pill.classList.toggle('is-complete', isComplete);
                    if (isCurrent) {
                        pill.setAttribute('aria-current', 'step');
                    } else {
                        pill.removeAttribute('aria-current');
                    }
                });
                if (focusHeading) {
                    form.querySelector(`#application-step-title-${nextStep}`)?.focus();
                }
            };

            const validateCurrentStep = () => {
                const currentStep = form.querySelector('.wizard-step.is-active');
                if (!currentStep) return true;
                const fields = Array.from(currentStep.querySelectorAll('input, select, textarea'));
                let firstInvalid = null;
                fields.forEach((field) => {
                    if (!field.required) return;
                    const value = field.type === 'checkbox' ? field.checked : field.value.trim();
                    const isFilled = field.type === 'checkbox'
                        ? field.checked
                        : (field.type === 'file' ? !!(field.files && field.files.length > 0) : value.length > 0);
                    const isValid = field.checkValidity() && (!field.required || isFilled);
                    field.closest('.form-field')?.classList.toggle('is-invalid', !isValid && field.required);
                    field.closest('.form-field')?.classList.toggle('is-valid', isValid && !field.hasAttribute('aria-invalid'));
                    field.setAttribute('aria-invalid', String(!isValid && field.required));
                    if (!isValid && !firstInvalid) firstInvalid = field;
                });
                if (firstInvalid) {
                    firstInvalid.focus();
                    firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstInvalid.reportValidity();
                    return false;
                }
                return true;
            };

            const validateField = (field) => {
                const wrapper = field.closest('.form-field');
                if (!wrapper) return;
                const value = field.type === 'checkbox' ? field.checked : field.value.trim();
                const isFilled = field.type === 'checkbox'
                    ? field.checked
                    : (field.type === 'file' ? !!(field.files && field.files.length > 0) : value.length > 0);
                const isValid = field.checkValidity() && (!field.required || isFilled);
                wrapper.classList.toggle('is-valid', isValid && !field.hasAttribute('aria-invalid'));
                wrapper.classList.toggle('is-invalid', !isValid && field.required);
                field.setAttribute('aria-invalid', String(!isValid && field.required));
                updateProgress();
            };

            form.querySelectorAll('input, select, textarea').forEach((field) => {
                const wrapper = field.closest('.form-field');
                field.addEventListener('focus', () => wrapper?.classList.add('is-focused'));
                field.addEventListener('blur', () => {
                    wrapper?.classList.remove('is-focused');
                    validateField(field);
                });
                field.addEventListener('input', () => validateField(field));
                field.addEventListener('change', () => {
                    validateField(field);
                    updateConditionalFields();
                });
            });

            form.querySelectorAll('.wizard-next').forEach((button) => {
                button.addEventListener('click', () => {
                    if (!validateCurrentStep()) return;
                    const current = getCurrentStep();
                    setCurrentStep(Math.min(current + 1, steps.length));
                });
            });

            form.querySelectorAll('.wizard-prev').forEach((button) => {
                button.addEventListener('click', () => {
                    const current = getCurrentStep();
                    setCurrentStep(Math.max(current - 1, 1));
                });
            });

            form.querySelectorAll('[data-step-pill]').forEach((pill) => {
                pill.addEventListener('click', () => {
                    const target = Number(pill.dataset.stepPill);
                    const current = getCurrentStep();
                    if (target > current) {
                        for (let stepNumber = current; stepNumber < target; stepNumber++) {
                            setCurrentStep(stepNumber, false);
                            if (!validateCurrentStep()) return;
                        }
                    }
                    setCurrentStep(target);
                });
            });

            applicationType?.addEventListener('change', updateConditionalFields);
            childBirthDate?.addEventListener('change', updateConditionalFields);

            document.querySelectorAll('[data-character-counter]').forEach((textarea) => {
                const counter = document.querySelector(`[data-counter-for="${textarea.id}"]`);
                const updateCounter = () => {
                    const length = textarea.value.length;
                    if (counter) counter.textContent = `${length}/${textarea.maxLength || 1000}`;
                };
                textarea.addEventListener('input', updateCounter);
                updateCounter();
            });

            document.querySelectorAll('input[type="file"]').forEach((input) => {
                const meta = input.closest('.form-field')?.querySelector('.file-meta__text');
                const uploadBox = input.closest('.upload-box');
                const updateFileMeta = (isUserChange = false) => {
                    const file = input.files && input.files[0];
                    if (meta) {
                        meta.textContent = file ? `${file.name} · ${(file.size / 1024 / 1024).toFixed(2)} MB` : 'Belum ada berkas dipilih';
                    }
                    if (uploadBox) uploadBox.classList.toggle('has-file', !!file);
                    input.setCustomValidity(file && file.size > 5 * 1024 * 1024 ? 'Ukuran berkas maksimal 5 MB.' : '');
                    if (file && file.size > 5 * 1024 * 1024) {
                        meta.textContent = 'Ukuran berkas melebihi batas 5 MB.';
                    }
                    if (file || isUserChange) validateField(input);
                    updateProgress();
                    updateReview();
                };
                input.addEventListener('change', () => updateFileMeta(true));
                input.addEventListener('dragenter', () => uploadBox?.classList.add('is-drag-over'));
                input.addEventListener('dragleave', () => uploadBox?.classList.remove('is-drag-over'));
                input.addEventListener('drop', () => uploadBox?.classList.remove('is-drag-over'));
                updateFileMeta();
            });

            form.addEventListener('submit', (event) => {
                if (isSubmitting) {
                    event.preventDefault();
                    return;
                }

                let firstInvalid = null;
                form.querySelectorAll('input, select, textarea').forEach((field) => {
                    if (field.required && !field.checkValidity()) {
                        if (!firstInvalid) firstInvalid = field;
                        field.closest('.form-field')?.classList.add('is-invalid');
                        field.setAttribute('aria-invalid', 'true');
                    }
                });

                if (firstInvalid) {
                    event.preventDefault();
                    firstInvalid.focus();
                    firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    return;
                }

                isSubmitting = true;
                form.setAttribute('aria-busy', 'true');
                if (submitButton) {
                    submitButton.disabled = true;
                    submitButton.textContent = 'Mengirim pengajuan…';
                }
                if (submitStatus) {
                    submitStatus.textContent = 'Pengajuan sedang dikirim. Mohon tunggu dan jangan kirim ulang.';
                }
            });

            steps.forEach((step) => {
                step.hidden = Number(step.dataset.step) !== 1;
            });
            updateConditionalFields();
            updateReview();
            const firstErrorStep = form.querySelector('.has-error')?.closest('.wizard-step');
            if (firstErrorStep) {
                setCurrentStep(Number(firstErrorStep.dataset.step), false);
                form.querySelectorAll('.has-error').forEach((wrapper) => {
                    const field = wrapper.querySelector('input, select, textarea');
                    const errorMessage = wrapper.querySelector('.field-error');
                    if (!field || !errorMessage) return;

                    errorMessage.id ||= `${field.id}-error`;
                    field.setAttribute('aria-invalid', 'true');
                    const describedBy = new Set((field.getAttribute('aria-describedby') || '').split(/\s+/).filter(Boolean));
                    describedBy.add(errorMessage.id);
                    field.setAttribute('aria-describedby', Array.from(describedBy).join(' '));
                });
                const firstErrorField = firstErrorStep.querySelector('.has-error input, .has-error select, .has-error textarea');
                firstErrorField?.focus();
            }
            updateProgress();
        })();
    </script>
@endsection
