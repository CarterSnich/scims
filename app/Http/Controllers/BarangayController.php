<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class BarangayController extends Controller
{
    // store
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'barangay_name' => ['required', Rule::unique('barangays', 'barangay_name')],
            'contact_person' => ['required'],
            'contact_no' => ['required', 'regex:/(09)[0-9]{9}/'],
            'email' => ['required', 'email']
        ]);

        if ($validator->fails()) {
            $errors = array_merge($validator->errors()->toArray(), [
                'on_insert' => true
            ]);
            return redirect()
                ->action([DashboardController::class, 'barangays'])
                ->withErrors($errors)
                ->withInput();
        } else {
            Barangay::create($request->all());
            return redirect()
                ->action([DashboardController::class, 'barangays'])
                ->with([
                    'toast' => [
                        'type' => 'success',
                        'message' => 'Barangay added successfully.'
                    ]
                ]);
        }
    }

    // update
    public function update(Request $request, Barangay $barangay)
    {
        $validator = Validator::make($request->all(), [
            'barangay_name' => ['required', "unique:barangays,barangay_name,{$barangay['id']}"],
            'contact_person' => ['required'],
            'contact_no' => ['required', 'regex:/(09)[0-9]{9}/'],
            'email' => ['required', 'email']
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator->errors());
        } else {
            try {
                $barangay->update($request->all());
                return back()
                    ->with([
                        'toast' => [
                            'type' => 'success',
                            'message' => 'Barangay updated successfully.'
                        ]
                    ]);
            } catch (QueryException $th) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors([
                        'toast' => [
                            'type' => 'warning',
                            'message' => 'Failed to update barangay information.'
                        ]
                    ]);
            }
        }
    }

    // destroy
    public function destroy(Barangay $barangay)
    {
        if ($barangay->delete()) {
            return redirect()
                ->action([DashboardController::class, 'barangays'])
                ->with([
                    'toast' => [
                        'type' => 'success',
                        'message' => 'Barangay deleted successfully.'
                    ]
                ]);
        }
        return back()->with([
            'toast' => [
                'type' => 'danger',
                'message' => 'Failed to delete barangay.'
            ]
        ]);
    }
}
