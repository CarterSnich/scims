<?php

namespace App\Http\Controllers;

use App\Models\Constants;
use App\Models\Philhealth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class PhilHealthController extends Controller
{
    // store
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [

                'pin' => ['nullable'],
                'purpose' => ['required', Rule::in(array_keys(Constants::PH_PURPOSE))],
                'konsulta_provider' => ['nullable'],

                /* PERSONAL DETAILS */

                // member
                'member_lastname' => ['required'],
                'member_firstname' => ['required'],
                'member_name_extension' => ['required'],
                'member_middlename' => ['nullable', 'prohibited_if:member_no_middlename,1'],
                'member_no_middlename' => ['nullable'],
                'member_no_mononym' => ['nullable'],

                // mother's
                'mother_lastname' => ['nullable', 'required_with_all:mother_firstname'],
                'mother_firstname' => ['nullable', 'required_with_all:mother_lastname'],
                'mother_name_extension' => ['nullable'],
                'mother_middlename' => ['nullable', 'prohibited_if:mother_no_middlename,1'],
                'mother_no_middlename' => ['nullable'],
                'mother_no_mononym' => ['nullable'],

                // spouse's
                'spouse_lastname' => ['nullable', 'required_with_all:spouse_firstname'],
                'spouse_firstname' => ['nullable', 'required_with_all:spouse_lastname'],
                'spouse_name_extension' => ['nullable'],
                'spouse_middlename' => ['nullable', 'prohibited_if:spouse_no_middlename,1'],
                'spouse_no_middlename' => ['nullable'],
                'spouse_no_mononym' => ['nullable'],

                'date_of_birth' => ['required', 'date'],
                'place_of_birth' => ['required'],
                'philsys_id_number' =>  ['nullable'],
                'sex' => ['required', 'in:male,female'],
                'civil_status' => ['required', Rule::in(array_keys(Constants::PH_CIVIL_STATUS))],
                'citizenship' =>  ['required', Rule::in(array_keys(Constants::PH_CITIZENSHIP))],
                'tin' =>  ['nullable'],

                /* ADDRESS and CONTACT DETAILS */

                // permanent home address
                'permanent_unit_room_no_floor' => ['nullable'],
                'permanent_building_name' => ['nullable'],
                'permanent_lot_block_phase_house_no' => ['nullable'],
                'permanent_street_name' => ['nullable'],
                'permanent_subdivision' => ['nullable'],
                'permanent_barangay' => ['nullable'],
                'permanent_municipality_city' => ['nullable'],
                'permanent_province_state_country' => ['nullable'],
                'permanent_zip_code' => ['nullable'],

                // mailing address
                'mailing_unit_room_no_floor' => ['nullable'],
                'mailing_building_name' => ['nullable'],
                'mailing_lot_block_phase_house_no' => ['nullable'],
                'mailing_street_name' => ['nullable'],
                'mailing_subdivision' => ['nullable'],
                'mailing_barangay' => ['nullable'],
                'mailing_municipality_city' => ['nullable'],
                'mailing_province_state_country' => ['nullable'],
                'mailing_zip_code' => ['nullable'],

                // contact
                'home_phone_no' => ['nullable'],
                'mobile_no' => ['required', 'regex:/(09)[0-9]{9}/'],
                'business_direct_line' => ['nullable'],
                'email' => ['nullable'],

                /* DECLARATION OF DEPENDENTS */
                'dependent' => ['nullable', 'array'],

                /* MEMBER TYPE */

                // direct contributor
                "employed_private" => ['boolean'],
                "kasambahay" => ['boolean'],
                "family_driver" => ['boolean'],
                "employed_government" => ['boolean'],
                "migrant_worker" => ['boolean'],
                "professional_practitioner" => ['boolean'],
                "migrant_worker_based" => ['nullable', 'in:land,sea'],
                "self_earning" => ['boolean'],
                "lifetime" => ['boolean'],
                "individual" => ['boolean'],
                "dual_citizenship" => ['boolean'],
                "sole_proprietor" => ['boolean'],
                "foreign_national" => ['boolean'],
                "group_enrollment" => ['boolean'],
                "pra_ssrv_no" => ['nullable'],
                "group_enrollment_scheme" => ['nullable'],
                "acr_icard_no" => ['nullable'],

                // indirect Contributor
                "listahanan" => ['boolean'],
                "lgu_sponsored" => ['boolean'],
                "four_ps_mcct" => ['boolean'],
                "nga_sponsored" => ['boolean'],
                "senior_citizen" => ['boolean'],
                "private_sponsored" => ['boolean'],
                "pamana" => ['boolean'],
                "kia_kipo" => ['boolean'],
                "person_with_disability" => ['boolean'],
                "pwd_id_no" => ['nullable'],
                "bangsamoro_normalization" => ['boolean'],

                // income
                "profession" => ['nullable'],
                "monthly_income" => ['nullable'],
                "proof_of_income" => ['nullable'],

                // for philhealth use only
                "pos_financially_incapable" => ['nullable'],
                "financially_incapable" => ['nullable'],

                /* UPDATE/AMENDENT */

                // change/correct name
                "change_correction_of_name" => ['boolean'],
                "update_name_from" => ['nullable', 'required_if:change_correction_of_name,1'],
                "update_name_to" => ['nullable', 'required_if:change_correction_of_name,1'],

                // correction of date of birth
                "correction_of_date_of_birth" => ['boolean'],
                "update_date_of_birth_from" => ['nullable', 'required_if:correction_of_date_of_birth,1'],
                "update_date_of_birth_to" => ['nullable', 'required_if:correction_of_date_of_birth,1'],

                // correction of Sex
                'correction_of_sex' => ['boolean'],
                "update_sex_from" => ['nullable', 'required_if:correction_of_sex,1'],
                "update_sex_to" => ['nullable', 'required_if:correction_of_sex,1'],

                // change of civil status
                "change_of_civil_status" => ['boolean'],
                'update_civil_status_from' => ['nullable', 'required_if:change_of_civil_status,1'],
                'update_civil_status_to' => ['nullable', 'required_if:change_of_civil_status,1'],

                // change of personal info
                'update_personal_info' => ['boolean'],
                "update_personal_info_from" => ['nullable', 'required_if:update_personal_info,1'],
                "update_personal_info_to" => ['nullable', 'required_if:update_personal_info,1'],

            ]

        );


        if ($validator->fails()) {
            return back()
                ->withErrors($validator->errors())
                ->withInput()
                ->with([
                    'toast' => [
                        'type' => 'warning',
                        'message' => 'Please, check your inputs.'
                    ]
                ]);
        }

        $dependents = [];
        foreach ($request->dependent as $i) {
            $dependents[$i] = [
                "dependent_lastname" => $request->dependent_lastname[$i],
                "dependent_firstname" => $request->dependent_firstname[$i],
                "dependent_name_extension" => $request->dependent_name_extension[$i],
                "dependent_middlename" => $request->dependent_middlename[$i],
                "dependent_no_middlename" => $request->dependent_no_middlename[$i] ?? false,
                "dependent_no_mononym" => $request->dependent_no_mononym[$i] ?? false,
                "dependent_permanent_disability" => $request->dependent_permanent_disability[$i] ?? false,
            ];
        }

        $formValues = $validator->validated();
        $formValues['dependents'] = $dependents;
        $philhealth = Philhealth::create($formValues);

        if ($philhealth) {
            return redirect()
                ->intended('/philhealth/' . $philhealth->id)
                ->with([
                    'toast' => [
                        'type' => 'success',
                        'message' => 'PhilHealth registered successfully.'
                    ]
                ]);
        } else {
            return redirect()
                ->intended('/philhealth/register')
                ->with([
                    "toast" => [
                        "type" => 'danger',
                        "message" => "Failed to register PhilHealth application."
                    ]
                ]);
        }
    }
}
