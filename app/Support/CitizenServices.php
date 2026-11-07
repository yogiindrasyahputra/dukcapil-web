<?php

namespace App\Support;

class CitizenServices
{
    public static function all(): array
    {
        return [
            'ktp-el' => [
                'title' => 'KTP elektronik',
                'description' => 'Pengajuan KTP-el baru dan penggantian karena hilang, rusak, atau perubahan data.',
                'process' => 'Sekitar 1 hari kerja setelah verifikasi dan perekaman.',
                'documents' => [
                    'family_card' => 'Kartu Keluarga',
                    'supporting_document' => 'Akta kelahiran atau ijazah',
                    'police_letter' => 'Surat keterangan kehilangan dari kepolisian',
                ],
                'fields' => [
                    'application_type' => [
                        'label' => 'Jenis pengajuan',
                        'options' => [
                            'new' => 'KTP-el baru',
                            'lost' => 'Penggantian KTP-el hilang',
                            'damaged' => 'Penggantian KTP-el rusak',
                            'correction' => 'Perubahan data',
                        ],
                    ],
                    'marital_status' => [
                        'label' => 'Status perkawinan',
                        'options' => ['unmarried' => 'Belum menikah', 'married' => 'Sudah menikah'],
                    ],
                ],
            ],
            'kartu-keluarga' => [
                'title' => 'Kartu Keluarga',
                'description' => 'Pengajuan KK baru, perubahan anggota keluarga, atau pembaruan data.',
                'process' => '1 sampai 3 hari kerja setelah berkas diverifikasi.',
                'documents' => [
                    'identity_card' => 'KTP-el pemohon',
                    'marriage_or_birth_record' => 'Buku nikah atau akta perkawinan/kelahiran',
                    'previous_family_card' => 'Kartu Keluarga sebelumnya (jika ada perubahan)',
                ],
                'fields' => [
                    'application_type' => [
                        'label' => 'Keperluan',
                        'options' => [
                            'new' => 'Pembuatan KK baru',
                            'change' => 'Perubahan anggota/data',
                            'correction' => 'Perbaikan data',
                        ],
                    ],
                    'family_change' => ['label' => 'Ringkasan perubahan yang diajukan', 'type' => 'text'],
                ],
            ],
            'akta-kelahiran' => [
                'title' => 'Akta kelahiran',
                'description' => 'Pencatatan kelahiran dan pengajuan akta kelahiran anak.',
                'process' => 'Sekitar 1 hari kerja setelah berkas diverifikasi.',
                'documents' => [
                    'birth_certificate' => 'Surat keterangan lahir dari bidan atau rumah sakit',
                    'family_card' => 'Kartu Keluarga orang tua',
                    'parents_identity' => 'KTP-el kedua orang tua',
                    'marriage_book' => 'Buku nikah atau akta perkawinan orang tua',
                ],
                'fields' => [
                    'child_name' => ['label' => 'Nama lengkap anak', 'type' => 'text'],
                    'child_birth_date' => ['label' => 'Tanggal lahir anak', 'type' => 'date'],
                    'child_birth_place' => ['label' => 'Tempat lahir anak', 'type' => 'text'],
                ],
            ],
            'akta-kematian' => [
                'title' => 'Akta kematian',
                'description' => 'Pencatatan peristiwa kematian dan pengajuan akta kematian.',
                'process' => 'Sekitar 1 hari kerja setelah berkas diverifikasi.',
                'documents' => [
                    'death_certificate' => 'Surat keterangan kematian',
                    'deceased_identity' => 'KTP-el dan Kartu Keluarga almarhum',
                    'witness_identity' => 'KTP-el dua orang saksi',
                ],
                'fields' => [
                    'deceased_name' => ['label' => 'Nama lengkap almarhum/almarhumah', 'type' => 'text'],
                    'death_date' => ['label' => 'Tanggal meninggal', 'type' => 'date'],
                    'death_place' => ['label' => 'Tempat meninggal', 'type' => 'text'],
                ],
            ],
            'pindah-datang' => [
                'title' => 'Pindah atau datang',
                'description' => 'Pengurusan perpindahan domisili keluar atau kedatangan penduduk.',
                'process' => '1 sampai 2 hari kerja setelah berkas diverifikasi.',
                'documents' => [
                    'family_card' => 'Kartu Keluarga',
                    'identity_card' => 'KTP-el pemohon',
                    'supporting_document' => 'Surat pengantar atau surat keterangan pindah',
                ],
                'fields' => [
                    'direction' => [
                        'label' => 'Jenis perpindahan',
                        'options' => ['outgoing' => 'Pindah keluar', 'incoming' => 'Pindah datang'],
                    ],
                    'destination' => ['label' => 'Alamat tujuan atau asal', 'type' => 'text'],
                ],
            ],
            'kia' => [
                'title' => 'Kartu Identitas Anak',
                'description' => 'Pengajuan KIA untuk anak berusia di bawah 17 tahun.',
                'process' => 'Sekitar 1 hari kerja setelah berkas diverifikasi.',
                'documents' => [
                    'family_card' => 'Kartu Keluarga',
                    'birth_certificate' => 'Akta kelahiran anak',
                    'parent_identity' => 'KTP-el orang tua',
                    'child_photo' => 'Pas foto anak (wajib untuk usia 5 tahun ke atas)',
                ],
                'fields' => [
                    'child_name' => ['label' => 'Nama lengkap anak', 'type' => 'text'],
                    'child_birth_date' => ['label' => 'Tanggal lahir anak', 'type' => 'date'],
                ],
            ],
        ];
    }

    public static function find(string $slug): array
    {
        $service = self::all()[$slug] ?? null;

        abort_if($service === null, 404);

        return $service;
    }
}
