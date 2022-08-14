<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Barangay;
use Illuminate\Http\Request;
use App\Models\SeniorCitizen;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SeniorCitizenController extends Controller
{
    // store
    public function store(Request $request)
    {
        // dd($request->all());
        $carbon = new Carbon();
        $birthdate_before = $carbon->subYears($request->age)->format('Y-m-d');

        $validator = Validator::make($request->all(), [

            // personal information
            'lastname' => ['required'],
            'firstname' => ['required'],
            'middlename' => ['nullable'],
            'gender' => ['required'],
            'age' => ['required', 'integer', 'min:60'],
            'birthdate' => ['required', 'date'],
            'birthplace' => ['required'],
            'picture' => ['required', 'image'],

            // contact information
            'phone_number' => ['nullable', 'regex:/(09)[0-9]{9}/'],
            'email' => ['nullable', 'email'],

            // location details
            'barangay' => ['required', 'exists:barangays,id'],
            'province' => ['required'],
            'years_of_stay' => ['required', 'min:0'],

            // other information
            'religion' => ['required'],
            'marital_status' => ['required', 'in:unmarried,married,divorced,widowed'],
            'educational_attainment' => ['required'],
            'status' => ['required', 'in:active,deceased'],

            // emergency details
            'emergency_contact_person' => ['required'],
            'emergency_contact_number' => ['required', 'regex:/(09)[0-9]{9}/'],
            'emergency_contact_address' => ['required'],

            // vaccination details
            'first_dose_date' => ['nullable', 'date'],
            'second_dose_date' => ['nullable', 'date'],
            'booster_dose_date' => ['nullable', 'date'],

        ], [
            'age.min' => 'The age must be 60 or older.',
            'birthdate.after_or_equal' => 'Birthdate must match the age.'
        ]);

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
        } else {
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
            $formValues = $validator->validated();
            $formValues['picture'] = $request->file('picture')->hashName();
            $id = SeniorCitizen::create($formValues);
            return redirect()
                ->action(
                    [DashboardController::class, 'view_citizen'],
                    ['id' => $id]
                )
                ->with([
                    'toast' => [
                        'type' => 'success',
                        'message' => 'Senior citizen registered successfully.'
                    ]
                ]);
        }
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
            'age' => ['required', 'gte:60'],
            'gender' => ['required', 'in:male,female'],
            'marital_status' => ['required', 'in:unmarried,married,divorced,widowed']
        ], [], [
            'emergency_contact_number' => 'emergency contact no.',
            'philhealthID' => 'PhilHealth ID',
            'tin' => 'TIN'
        ]);


        if ($validator->fails()) {
            return
                back()
                ->withInput()
                ->withErrors($validator->errors()->toArray());
        } else {
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
            }

            $formValues = $validator->validated();
            $formValues['picture'] = $request->file('picture')->hashName();
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
            if ($request->deceased) $citizen->status = 'deceased';
            $citizen->is_delisted = true;
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

    public function recover(SeniorCitizen $citizen)
    {
        if (auth()->user()->type == 'admin') {
            $citizen->is_delisted = false;
            $citizen->delist_reason = null;
            $citizen->status = 'active';
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
}
