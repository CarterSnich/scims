<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Philhealth extends Model
{
    use HasFactory;


    protected $fillable = [
        'pin',
        'purpose',
        'konsulta_provider',

        /* PERSONAL DETAILS */

        // member
        'member_lastname',
        'member_firstname',
        'member_name_extension',
        'member_middlename',
        'member_no_middlename',
        'member_no_mononym',

        // mother's
        'mother_lastname',
        'mother_firstname',
        'mother_name_extension',
        'mother_middlename',
        'mother_no_middlename',
        'mother_no_mononym',

        // spouse's
        'spouse_lastname',
        'spouse_firstname',
        'spouse_name_extension',
        'spouse_middlename',
        'spouse_no_middlename',
        'spouse_no_mononym',

        'date_of_birth',
        'place_of_birth',
        'philsys_id_number',
        'sex',
        'civil_status',
        'citizenship',
        'tin',

        /* ADDRESS and CONTACT DETAILS */

        // permanent home address
        'permanent_unit_room_no_floor',
        'permanent_building_name',
        'permanent_lot_block_phase_house_no',
        'permanent_street_name',
        'permanent_subdivision',
        'permanent_barangay',
        'permanent_municipality_city',
        'permanent_province_state_country',
        'permanent_zip_code',

        // mailing address
        'same_as_above',
        'mailing_unit_room_no_floor',
        'mailing_building_name',
        'mailing_lot_block_phase_house_no',
        'mailing_street_name',
        'mailing_subdivision',
        'mailing_barangay',
        'mailing_municipality_city',
        'mailing_province_state_country',
        'mailing_zip_code',

        // contact
        'home_phone_no',
        'mobile_no',
        'business_direct_line',
        'email',

        /* DECLARATION OF DEPENDENTS */
        'dependents',

        /* MEMBER TYPE */

        // direct contributor
        "employed_private",
        "kasambahay",
        "family_driver",
        "employed_government",
        "migrant_worker",
        "professional_practitioner",
        "migrant_worker_based",
        "self_earning",
        "lifetime",
        "individual",
        "dual_citizenship",
        "sole_proprietor",
        "foreign_national",
        "group_enrollment",
        "pra_ssrv_no",
        "group_enrollment_scheme",
        "acr_icard_no",

        // indirect Contributor
        "listahanan",
        "lgu_sponsored",
        "four_ps_mcct",
        "nga_sponsored",
        "senior_citizen",
        "private_sponsored",
        "pamana",
        "kia_kipo",
        "person_with_disability",
        "pwd_id_no",
        "bangsamoro_normalization",

        // income
        "profession",
        "monthly_income",
        "proof_of_income",

        // for philhealth use only
        "pos_financially_incapable",
        "financially_incapable",

        /* UPDATE/AMENDENT */

        // change/correct name
        "change_correction_of_name",
        "update_name_from",
        "update_name_to",

        // correction of date of birth
        "correction_of_date_of_birth",
        "update_date_of_birth_from",
        "update_date_of_birth_to",

        // correction of Sex
        'correction_of_sex',
        "update_sex_from",
        "update_sex_to",

        // change of civil status
        "change_of_civil_status",
        'update_civil_status_from',
        'update_civil_status_to',

        // change of personal info
        'update_personal_info',
        "update_personal_info_from",
        "update_personal_info_to",
    ];

    protected $casts = [
        'dependents' => 'json'
    ];
}
