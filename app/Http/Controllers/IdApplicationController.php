<?php

namespace App\Http\Controllers;

use App\Models\IdApplication;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class IdApplicationController extends Controller
{
    public function store(Request $request)
    {
        // dd($request);
        $validator = Validator::make(
            $request->all(),
            [
                // purpose
                'purpose' => ['required', 'in:new_registration,lost_id,replacement,transferee'],

                // application details
                'date_applied' => ['required', 'date'],
                'osca_id' => ['required'],
                'date_issued' => ['required', 'date'],

                // applicant
                'citizen' => ['required', 'exists:senior_citizens,id'],

                // for replacement
                'replacement_reasons' => ['nullable', 'required_if:purpose,replacement', 'array'],
                'replacement_reason_others' => Rule::requiredIf(fn () => $request->replacement_reasons ? in_array('others', $request->replacement_reasons) : false),

                // for lost id
                'date_of_loss' => ['nullable', 'required_if:purpose,lost_id', 'date'],
                'lost_location' => ['required_if:purpose,lost_id'],

                // for transferee
                'transfer_from' => ['required_if:purpose,transferee'],
                'transfer_to' => ['required_if:purpose,transferee'],
                'transfer_reason' => ['required_if:purpose,transferee'],
            ],
            [
                'date_of_loss.required_if' => 'Date of loss is required for Lost ID application.',
                'lost_location.required_if' => 'Lost location required for Lost ID application.',
                'replacement_reasons.required_if' => 'Select replacement reason.',
                'replacement_reason_others.required_if' => 'Provide other replacement reason.'
            ]
        );

        if ($validator->fails()) {
            return
                back()
                ->withInput()
                ->withErrors($validator->errors());
        } else {
            if (IdApplication::create($request->all())) {
                return
                    redirect('/id_applications')
                    ->with([
                        'toast' => [
                            'type' => 'success',
                            'message' => 'ID Application submitted.'
                        ]
                    ]);
            } else {
                return
                    back()
                    ->with([
                        'toast' => [
                            'type' => 'warning',
                            'message' => 'Failed to submit application.'
                        ]
                    ]);
            }
        }
    }
}
