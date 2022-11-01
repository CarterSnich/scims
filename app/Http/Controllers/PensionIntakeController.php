<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Constants;
use Illuminate\Http\Request;
use App\Models\PensionIntake;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class PensionIntakeController extends Controller
{
    // store
    public function store(Request $request)
    {
        $dt = new Carbon();
        $before = $dt->subYears(60)->format('Y-m-d');

        $validator = Validator::make(
            $request->all(),
            [
                "lastname" => ['required'],
                "firstname"  => ['required'],
                "middlename"  => ['nullable'],

                "nhts_pr_hh_no"  => ['required'],
                "sex"  => ['required', 'in:male,female'],
                "civil_status"  => ['required', Rule::in(Constants::CIVIL_STATUSES)],
                "date_of_birth"  => ['required', 'date', "before_or_equal:{$before}"],
                "place_of_birth"  => ['required'],

                "house_no"  => ['required'],
                "street"  => ['required'],
                "barangay"  => ['required', 'exists:barangays,id'],

                "citizenship"  => ['required'],
                "landline"  => ['required'],
                "email"  => ['required', 'email'],
                "mobile_no"  => ['required', 'regex:/(09)[0-9]{9}/'],

                "affiliation"  => ['required', Rule::in(array_keys(Constants::AFFILIATIONS))],
                "affiliation_others"  => ['nullable', 'required_if:affiliation,others'],

                "osca_id"  => ['required'],
                "issued_on"  => ['required', 'date'],
                "issued_at"  => ['required'],

                "living_arrangement"  => ['required', Rule::in(array_keys(Constants::LIVING_ARRANGEMENTS))],

                "pensioner"  => ['required', 'boolean'],
                "pensioner_source"  => ['nullable', 'required_if:pensioner,1', Rule::in(array_keys(Constants::PENSIONER_SOURCES_2))],
                "pensioner_amount"  => ['nullable', 'required_if:pensioner,1', 'gte:1'],

                "regular_support_from_family"  => ['required', 'boolean'],
                "type_of_support"  => ['nullable', 'required_if:regular_support_from_family,1', 'in:cash,kind'],
                "support_cash_amount"  => ['nullable', 'required_if:type_of_support,cash', 'gte:1'],
                "support_kind_specify"  => ['nullable', 'required_if:type_of_support,kind'],

                "meals_per_day"  => ['required', 'in:3,2,1'],

                "is_disabled"  => ['required', 'boolean'],
                "specify_disability"  => ['nullable', 'required_if:is_disabled,1'],

                "is_immobile"  => ['required', 'boolean'],
                "immobile_state"  => ['nullable', 'required_if:is_immobile,1'],

                "pre_existing_illnesses"  => ['nullable']
            ]
        );

        if ($validator->fails()) {
            return
                back()
                ->withInput()
                ->withErrors($validator->errors())
                ->with([
                    'toast' => [
                        'type' => 'warning',
                        'message' => 'Please, check your inputs.'
                    ]
                ]);
        }

        if (PensionIntake::create($validator->validated())) {
            return redirect()->intended('/intakes');
        } else {
            return
                redirect()
                ->intended('/intakes/register')
                ->with([
                    'toast' => [
                        'type' => 'danger',
                        'message' => 'Failed to store new pension intake.'
                    ]
                ]);
        }
    }
}
