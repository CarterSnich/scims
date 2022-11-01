<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Constants extends Model
{
    use HasFactory;

    public const LIVING_ARRANGEMENTS = [
        '1' => 'Living alone',
        '2' => 'Owned house',
        '3' => 'Living with relatives',
        '4' => 'Rented'
    ];

    public const PENSIONER_SOURCES = [
        'gsis' => 'GSIS',
        'sss' => 'SSS',
        'afpslai' => 'AFPSLAI',
        'others' => 'Others'
    ];

    public const PENSIONER_SOURCES_2 = [
        'gsis' => 'GSIS',
        'sss' => 'SSS',
        'private' => 'Private'
    ];

    public const CIVIL_STATUSES = ['unmarried', 'married', 'divorced', 'widowed'];

    public const  EDUCATIONAL_ATTAINMENTS = [
        '1' => 'Less than secondary (high) school graduation',
        '2' => 'Secondary (high) school diploma or equivalent',
        '3' => 'Some postsecondary education',
        '4' => 'Postsecondary certificate, diploma or degree'
    ];

    public const AFFILIATIONS = [
        'fscap' => 'FSCAP',
        'cose' => 'COSE',
        'others' => 'Others'
    ];
}
