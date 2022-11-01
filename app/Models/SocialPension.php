<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialPension extends Model
{
    use HasFactory;

    protected $fillable = [
        'lastname',
        'firstname',
        'middlename',
        'picture',

        'citizenship',
        'age',
        'date_of_birth',
        'place_of_birth',
        'sex',
        'civil_status',
        'house_no',
        'street',
        'barangay',
        'no_of_years_stay',
        'living_arrangement',

        // economic status
        'pensioner',
        'pensioner_amount',
        'pensioner_source',

        'permanent_source_of_income',
        'source_of_income',
        'regular_support_from_family',
        'type_of_support',
        'support_cash_amount',
        'support_kind_specify',
        'how_often',

        // health condition
        'has_existing_illness',
        'specify_illness',
        'hospitalized_in_last_six_months'
    ];
}
