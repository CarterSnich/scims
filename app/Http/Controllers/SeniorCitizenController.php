<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\SeniorCitizen;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SeniorCitizenController extends Controller
{
    // store
    public function store(Request $request)
    {
        $dt = new Carbon();
        $before = $dt->subYears(60)->format('Y-m-d');

        $validator = Validator::make(
            $request->all(),
            [
                // personal information
                'lastname' => ['required'],
                'firstname' => ['required'],
                'middlename' => ['nullable'],

                // picture
                'picture' => ['required', 'image'],

                // personal information
                'date_of_birth' => ['required', 'date', "before_or_equal:{$before}"],
                'sex' => ['required', 'in:male,female'],
                'place_of_birth' => ['required'],
                'civil_status' => ['required', Rule::in(SeniorCitizen::$civil_statuses)],
                'address' => ['required'],
                'educational_attainment' => ['required', Rule::in(array_keys(SeniorCitizen::$educational_attainments))],
                'occupation' => ['required'],
                'annual_income' => ['required', 'numeric', 'gte:0'],
                'other_skills' => ['nullable'],

                // member   
                'name_of_association' => ['nullable'],
                'address_of_association' => ['required_with:name_of_association'],
                'date_of_membership' => ['required_with:name_of_association'],
                'date_elected' => ['nullable', 'prohibited_if:name_of_association,null'],
                'term' => ['required_with:date_elected']

            ],
            [
                'date_of_birth.before' => 'The date of birth must more than 60+ years ago today.',
            ]
        );

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator->errors()->toArray())
                ->with([
                    'toast' => [
                        'type' => 'warning',
                        'message' => 'Please check your inputs.'
                    ]
                ]);
        }

        $family_composition = [];
        for ($i = 0; $i < count($request->_family_member ?? []); $i++) {
            array_push($family_composition, [
                'name' => $request->family_member_name[$i],
                'relationship' => $request->family_member_relationship[$i],
                'age' => $request->family_member_age[$i],
                'civil_status' => $request->family_member_civil_status[$i],
                'occupation' => $request->family_member_occupation[$i],
                'income' => $request->family_member_income[$i],
                'occupation' => $request->family_member_occupation[$i]
            ]);
        }

        if (!Storage::disk('public')->put('pictures', $request->file('picture'))) {
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
        $formValues['family_composition'] = $family_composition;
        $citizen = SeniorCitizen::create($formValues);

        return
            redirect()
            ->action([DashboardController::class, 'view_citizen'], [
                'citizen' => $citizen
            ])
            ->with([
                'toast' => [
                    'type' => 'success',
                    'message' => 'Senior citizen registered successfully.'
                ]
            ]);
    }

    // update sernior citizen data
    public function update(Request $request, SeniorCitizen $citizen)
    {
        $validator = Validator::make($request->all(), [
            // identification
            'lastname' => ['required'],
            'firstname' => ['required'],

            // address
            'barangay' => ['required', 'integer', 'exists:barangays,id'],
            'province' => ['required'],

            // other details
            'birthdate' => ['required', 'date'],
            'age' => ['required', 'numeric', 'gte:60'],
            'marital_status' => ['required', 'in:unmarried,married,divorced,widowed'],
            'gender' => ['required', 'in:male,female']
        ]);


        if ($validator->fails()) {
            return
                back()
                ->withInput()
                ->withErrors($validator->errors()->toArray());
        } else {
            $formValues = $request->all();

            if ($request['picture']) {
                if (!Storage::disk('public')->put('pictures', $request->file('picture'))) {
                    return
                        back()
                        ->withInput()
                        ->with([
                            'toast' => [
                                'type' => 'warning',
                                'message' => 'Failed to upload picture file.'
                            ]
                        ]);
                }
                $formValues['picture'] = $request->file('picture')->hashName();
            }

            $citizen->update($formValues);
            return
                redirect()
                ->action(
                    [DashboardController::class, 'view_citizen'],
                    ['id' => $citizen['id']]
                )
                ->with([
                    'toast' => [
                        'type' => 'success',
                        'message' => 'Senior citizen updated successfully.'
                    ]
                ]);
        }
    }

    // delist
    public function delist(Request $request, SeniorCitizen $citizen)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'delist_reason' => ['required']
            ]
        );

        if ($validator->fails()) {
            return
                back()
                ->with([
                    'toast' => [
                        'type' => 'warning',
                        'message' => 'Please, check your inputs.'
                    ]
                ]);
        } else {
            $citizen->delist_reason = $request->delist_reason;
            if ($citizen->save()) {
                return
                    redirect('/citizens/delisted')
                    ->with([
                        'toast' =>  [
                            'type' => 'success',
                            'message' => 'Senior Citizen delisted successfully.'
                        ]
                    ]);
            } else {
                return
                    back()
                    ->with([
                        'toast' =>  [
                            'type' => 'warning',
                            'message' => 'Failed to delist Senior Citizen.'
                        ]
                    ]);
            }
        }
    }

    // recover citizen
    public function recover(SeniorCitizen $citizen)
    {
        if (auth()->user()->type == 'admin') {
            $citizen->is_delisted = false;
            $citizen->delist_reason = null;

            if ($citizen->save()) {
                return
                    redirect('/citizens')
                    ->with([
                        'toast' => [
                            'type' => 'success',
                            'message' => 'Senior Citizen recovered successfully.'
                        ]
                    ]);
            } else {
                return
                    back()
                    ->with([
                        'toast' => [
                            'type' => 'warning',
                            'message' => 'Failed to recover citizen.'
                        ]
                    ]);
            }
        } else {
            return
                back()
                ->with([
                    'toast' => [
                        'type' => 'warning',
                        'message' => 'Unauthorized action.'
                    ]
                ]);
        }
    }

    public function destory(SeniorCitizen $citizen)
    {
        if (auth()->user()->type == 'admin') {
            if ($citizen->is_delisted !== 1) {
                return
                    back()
                    ->with([
                        'toast' => [
                            'type' => 'danger',
                            'message' => 'Invalid action.'
                        ]
                    ]);
            }

            if ($citizen->delete()) {
                return
                    redirect('/citizens/delisted')
                    ->with([
                        'toast' => [
                            'type' => 'success',
                            'message' => 'Senior Citizen deleted successfully.'
                        ]
                    ]);
            } else {
                return
                    back()
                    ->with([
                        'toast' => [
                            'type' => 'warning',
                            'message' => 'Failed to delete Senior Citizen.'
                        ]
                    ]);
            }
        } else {
            return
                back()
                ->with([
                    'toast' => [
                        'type' => 'warning',
                        'message' => 'Unauthorized action.'
                    ]
                ]);
        }
    }
}
