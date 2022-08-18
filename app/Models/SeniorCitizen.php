<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeniorCitizen extends Model
{
    use HasFactory;

    protected $fillable = [
        // citizen id
        'citizen_id',

        // personal information
        'lastname',
        'firstname',
        'middlename',

        // location details
        'barangay',
        'province',

        // other details
        'birthdate',
        'age',
        'marital_status',

        // picture
        'picture',

        // delist details
        'is_delisted',
        'delist_reason'
    ];
}
