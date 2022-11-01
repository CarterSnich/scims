<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeniorCitizen extends Model
{
    use HasFactory;


    protected $fillable = [
        // name
        'lastname',
        'firstname',
        'middlename',

        // picture
        'picture',

        // peronsal information
        'date_of_birth',
        'sex',
        'place_of_birth',
        'civil_status',
        // 'address', // broken down to specific attributes
        'educational_attainment',
        'occupation',
        'annual_income',
        'other_skills',

        // address
        'house_no',
        'street',
        'barangay',

        // family composition
        'family_composition',

        // membership to senior citizen association
        'name_of_association',
        'address_of_association',
        'date_of_membership',
        'date_elected',
        'term',

        // delist details
        'is_delisted',
        'delist_reason'
    ];


    protected $casts = [
        'family_composition' => 'json'
    ];
}
