<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdApplication extends Model
{
    use HasFactory;

    const PURPOSE = [
        'new_registration' => 'New registration',
        'lost_id' => 'Lost ID',
        'replacement' => 'Replacement',
        'transferee' => 'Transferee'
    ];

    const REPLACEMENT_REASON = [
        'dilapidated' => 'Dilapidated',
        'faded_print' => 'Faded Print',
        'erroneous_entry' => 'Erroneous Entry',
        'change_address' => 'Change Address',
        'change_signature' => 'Change Signature',
    ];

    protected $fillable = [
        // purpose
        'purpose',

        // application details
        'date_applied',
        'osca_id',
        'date_issued',

        // applicant
        'citizen',

        // for replacement
        'replacement_reasons',
        'replacement_reason_others',

        // for lost id
        'date_of_loss',
        'lost_location',

        // for transferee
        'transfer_from',
        'transfer_to',
        'transfer_reason'
    ];

    protected $casts = [
        'replacement_reasons' => 'array'
    ];
}
