<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use Illuminate\Http\Request;
use App\Models\SeniorCitizen;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use League\Flysystem\ConnectionRuntimeException;

class SeniorCitizenController extends Controller
{
    // store
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // picture
            'picture' => ['required', 'image'],

            // identification
            'lastname' => ['required'],
            'firstname' => ['required'],
            'middlename',

            // address
            'barangay' => ['required', 'integer', 'exists:barangays,id'],
            'province' => ['required'],

            // other details
            'birthdate' => ['required', 'date'],
            'age' => ['required', 'gte:60'],
            'gender' => ['required', 'in:male,female'],
            'marital_status' => ['required', 'in:unmarried,married,divorced,widowed']
        ], [
            'age' => 'The age must be 60 or older.'
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

    // destroy
    public function destroy(SeniorCitizen $citizen)
    {
        if ($citizen->delete()) {
            return redirect()
                ->action([DashboardController::class, 'citizens'])
                ->with([
                    'toast' => [
                        'type' => 'success',
                        'message' => 'Senior citizen removed successfully.'
                    ]
                ]);
        }
        return back()->with([
            'toast' =>  [
                'type' => 'danger',
                'message' => 'Failed to remove senior citizen.'
            ]
        ]);
    }

    public function print(SeniorCitizen $citizen)
    {
        $citizen['citizenId'] = date('Y', strtotime($citizen['created_at'])) . '-' . str_pad($citizen['id'], 5, '0', STR_PAD_LEFT);
        $citizen['fullname'] = "{$citizen['lastname']}, {$citizen['firstname']} {$citizen['middlename']}";
        return view('layouts.print_citizen', [
            'citizen' => $citizen,
            'barangay' => Barangay::where('id', '=', $citizen['barangay'])->first()
        ]);
    }
}
