<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\SeniorCitizen;
use App\Models\SocialPension;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Contracts\Service\Attribute\Required;

class SocialPensionController extends Controller
{
    // store
    public function store(Request $request)
    {
        $dt = new Carbon();
        $before = $dt->subYears(60)->format('Y-m-d');

        $validator = Validator::make(
            $request->all(),
            [
                //basic information
                'lastname' => ['required'],
                'firstname' => ['required'],
                'middlename' => ['nullable'],
                'picture' => ['required', 'image'],

                'citizenship' => ['required'],
                'date_of_birth' => ['required', 'date', "before_or_equal:{$before}"],
                'place_of_birth' => ['required'],
                'sex' =>  ['required', 'in:male,female'],
                'civil_status' => [
                    'required',
                    Rule::in(SeniorCitizen::$civil_statuses)
                ],
                'house_no' => ['nullable'],
                'street' => ['nullable'],
                'barangay' => ['required', 'exists:barangays,id'],
                'no_of_years_stay' => ['required', 'gte:0'],
                'living_arrangement' => [
                    'required',
                    Rule::in(array_keys(SocialPension::LIVING_ARRANGEMENTS))
                ],

                // economic status
                'pensioner' => ['required', 'boolean'],
                'pensioner_amount' => ['required_if:pensioner,1'],
                'pensioner_source' => [
                    'required_if:pensioner,1',
                    Rule::in(array_keys(SocialPension::LIVING_ARRANGEMENTS))
                ],

                'permanent_source_of_income' => ['required', 'boolean'],
                'source_of_income' => ['required_if:permanent_source_of_income,1'],
                'regular_support_from_family' => ['required', 'boolean'],
                'type_of_support' => ['required_if:regular_support_from_family,1', 'in:cash,kind'],
                'support_cash_amount' => ['required_if:type_of_support,cash', 'nullable'],
                'support_kind_specify' => ['required_if:type_of_support,kind', 'nullable'],
                'how_often' => ['required_if:regular_support_from_family,1'],

                // health condition
                'has_existing_illness' => ['required', 'boolean'],
                'specify_illness' => ['required_if:has_existing_illness,1'],
                'hospitalized_in_last_six_months' => ['required', 'boolean']
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
                        'message' => 'Please check your inputs.'
                    ]
                ]);
        }

        if (!Storage::disk('public')->put('pension-pictures', $request->file('picture'))) {
            return back()
                ->withInput()
                ->with([
                    'toast' => [
                        'type' => 'warning',
                        'message' => 'Failed to upload picture file.'
                    ]
                ]);
        }

        $formValues = $request->all();
        $formValues['picture'] = $request->file('picture')->hashName();
        $pension = SocialPension::create($formValues);

        return
            redirect('/pensions');
    }
}
