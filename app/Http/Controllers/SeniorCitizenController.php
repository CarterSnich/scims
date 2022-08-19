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

            // picture
            'picture' => ['required', 'image'],

            // personal information
            'lastname' => ['required'],
            'firstname' => ['required'],
            'middlename' => ['nullable'],

            // location details
            'barangay' => ['required', 'exists:barangays,id'],
            'province' => ['required'],

            // other information
            'birthdate' => ['required', 'date'],
            'age' => ['required', 'numeric', 'gte:60'],
            'marital_status' => ['required', 'in:unmarried,married,divorced,widowed'],
            'gender' => ['required', 'in:male,female']
        ], [
            'age.min' => 'The age must be 60 or older.',
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
            $formValues = $request->all();
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
