<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CitizenApplication extends Model
{
    protected $fillable = [
        'tracking_code',
        'service_slug',
        'applicant_name',
        'nik',
        'family_card_number',
        'birth_date',
        'phone',
        'address',
        'office',
        'visit_date',
        'time_slot',
        'details',
        'documents',
        'status',
    ];

    protected $casts = [
        'applicant_name' => 'encrypted',
        'nik' => 'encrypted',
        'family_card_number' => 'encrypted',
        'phone' => 'encrypted',
        'address' => 'encrypted',
        'birth_date' => 'encrypted',
        'details' => 'encrypted:array',
        'documents' => 'array',
        'visit_date' => 'date',
    ];
}
