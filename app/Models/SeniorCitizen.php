<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeniorCitizen extends Model
{
    use HasFactory;

    public static $civil_statuses = ['unmarried', 'married', 'divorced', 'widowed'];

    public static $educational_attainments = [
        '1' => 'Less than secondary (high) school graduation',
        '2' => 'Secondary (high) school diploma or equivalent',
        '3' => 'Some postsecondary education',
        '4' => 'Postsecondary certificate, diploma or degree'
    ];


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
        'address',
        'educational_attainment',
        'occupation',
        'annual_income',
        'other_skills',

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
