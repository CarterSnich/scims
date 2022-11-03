<?php

namespace App\Models;

class Constants
{
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

    public const PH_PURPOSE = [
        'registration'  => 'Registration',
        'update' => 'Update/Amendment'
    ];

    public const PH_CIVIL_STATUS = [
        'single' => 'Single',
        'married' => 'Married',
        'legally_separated' => 'Legally Separated',
        'annulled' => 'Annulled',
        'widower' => 'Widow/er',
    ];

    public const PH_CITIZENSHIP = [
        'filipino' => 'Filipino',
        'foreign' => 'Foreign National',
        'dual' => 'Dual Citizen',
    ];
}
