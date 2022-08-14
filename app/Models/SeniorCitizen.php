<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeniorCitizen extends Model
{
    use HasFactory;

    protected $fillable = [
        // personal information
        'lastname',
        'firstname',
        'middlename',
        'gender',
        'age',
        'birthdate',
        'birthplace',
        'picture',

        // contact information
        'phone_number',
        'email',

        // location details
        'barangay',
        'province',
        'years_of_stay',

        // other information
        'religion',
        'marital_status',
        'educational_attainment',
        'status',

        // emergency details
        'emergency_contact_person',
        'emergency_contact_number',
        'emergency_contact_address',

        // vaccination details
        'first_dose_date',
        'second_dose_date',
        'booster_dose_date',

        // delist
        'is_delisted',
        'delist_reason'
    ];
}
