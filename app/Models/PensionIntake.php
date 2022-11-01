<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PensionIntake extends Model
{
    use HasFactory;

    protected $fillable = [
        "lastname",
        "firstname",
        "middlename",
        "nhts_pr_hh_no",
        "sex",
        "civil_status",
        "date_of_birth",
        "place_of_birth",
        "house_no",
        "street",
        "barangay",
        "citizenship",
        "landline",
        "email",
        "mobile_no",
        "affiliation",
        "affiliation_others",
        "osca_id",
        "issued_on",
        "issued_at",
        "living_arrangement",
        "pensioner",
        "pensioner_source",
        "pensioner_amount",
        "regular_support_from_family",
        "type_of_support",
        "support_cash_amount",
        "support_kind_specify",
        "meals_per_day",
        "is_disabled",
        "specify_disability",
        "is_immobile",
        "immobile_state",
        "pre_existing_illnesses",
    ];
}
