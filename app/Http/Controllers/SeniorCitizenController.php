<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Constants;
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
        $dateOfBirth = Carbon::parse($request->date_of_birth ?? date('Y-m-d'));

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
                'age' => ['required', 'gte:60', "in:{$dateOfBirth->age}"],
                'sex' => ['required', 'in:male,female'],
                'place_of_birth' => ['required'],
                'civil_status' => ['required', Rule::in(Constants::CIVIL_STATUSES)],
                // 'address' => ['required'], // broken down to specific attributes
                'educational_attainment' => ['required', Rule::in(array_keys(Constants::EDUCATIONAL_ATTAINMENTS))],
                'occupation' => ['required'],
                'annual_income' => ['required', 'numeric', 'gte:0'],
                'other_skills' => ['nullable'],

                // address
                'house_no' => ['nullable'],
                'street' => ['nullable'],
                'barangay' => ['required', 'exists:barangays,id'],


                // member   
                'name_of_association' => ['nullable'],
                'address_of_association' => ['required_with:name_of_association'],
                'date_of_membership' => ['required_with:name_of_association'],
                'date_elected' => ['nullable', 'prohibited_if:name_of_association,null'],
                'term' => ['required_with:date_elected'],
            ],
            [
                'age.in' => 'Age must match the date of birth.'
            ]
        );

        if ($validator->fails()) {
            dd($validator->errors());
            return back()
                ->withInput()
                ->withErrors($validator->errors())
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
                'picture' => ['nullable', 'image'],

                // personal information
                'date_of_birth' => ['required', 'date', "before_or_equal:{$before}"],
                'age' => ['required', 'gte:60'],
                'sex' => ['required', 'in:male,female'],
                'place_of_birth' => ['required'],
                'civil_status' => ['required', Rule::in(Constants::CIVIL_STATUSES)],
                // 'address' => ['required'], // broken down to specific attrivbutes
                'educational_attainment' => ['required', Rule::in(array_keys(Constants::EDUCATIONAL_ATTAINMENTS))],
                'occupation' => ['required'],
                'annual_income' => ['required', 'numeric', 'gte:0'],
                'other_skills' => ['nullable'],

                // address
                'house_no' => ['nullable'],
                'street' => ['nullable'],
                'barangay' => ['required', 'exists:barangays,id'],

                // member   
                'name_of_association' => ['nullable'],
                'address_of_association' => ['required_with:name_of_association'],
                'date_of_membership' => ['required_with:name_of_association'],
                'date_elected' => ['nullable', 'prohibited_if:name_of_association,null'],
                'term' => ['required_with:date_elected'],
            ]
        );


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

            $formValues['family_composition'] = $family_composition;
            $citizen->update($formValues);

            return
                redirect()
                ->intended("/citizens/{$citizen->id}")
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
