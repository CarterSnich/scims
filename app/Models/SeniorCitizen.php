<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeniorCitizen extends Model
{
    use HasFactory;

    protected $fillable = [
        'lastname',
        'firstname',
        'middlename',
        'barangay',
        'province',
        'birthdate',
        'age',
        'gender',
        'marital_status',
        'picture'
    ];
}
