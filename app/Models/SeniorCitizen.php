<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeniorCitizen extends Model
{
    use HasFactory;

    public static $educational_attainments = [
        '1' => '1 - Less than secondary (high) school graduation (highest)',
        '2' => '2 - Secondary (high) school diploma or equivalent (highest attainment)',
        '3' => '3 - Some postsecondary education (highest)',
        '4' => '4 - Postsecondary certificate, diploma or degree (highest)'
    ];


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
        'gender',

        // picture
        'picture',

        // delist details
        'is_delisted',
        'delist_reason'
    ];
}
