<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // login
    public function login()
    {
        return view('index');
    }

    // authenticate
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();

            if (auth()->user()->type == 'staff') {
                return redirect('citizens');
            } else {
                return redirect('citizens/delisted');
            }
        }

        return
            back()
            ->withErrors([
                'invalid-credentials' => 'Invalid credentials.'
            ])
            ->onlyInput('email');
    }

    // logout
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    // reset
    public function reset(User $user)
    {
        if (Auth::user()->type !== 'admin') {
            return
                redirect('dashboard')
                ->with([
                    'toast' => [
                        'type' => 'warning',
                        'message' => 'Invalid action.'
                    ]
                ]);
        }

        if ($user->update(['password' => Hash::make('password')])) {
            return
                redirect('users')
                ->with([
                    'toast' => [
                        'type' => 'success',
                        'message' => 'User account password resetted successfully.'
                    ]
                ]);
        } else {
            return
                redirect('users')
                ->with([
                    'toast' => [
                        'type' => 'warning',
                        'message' => 'Failed to reset user account password.'
                    ]
                ]);
        }
    }

    // store
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['email', 'required', 'unique:users,email'],
            'password' => ['required'],
            'password_confirmation' => ['required', 'same:password'],
            'name' => ['required'],
            'type' => ['required', 'in:admin,staff']
        ], [
            'password_confirmation.same' => 'The confirmation password does not match.'
        ], [
            'type' => 'user account type'
        ]);

        if ($validator->fails()) {
            return
                redirect()
                ->back()
                ->withInput()
                ->withErrors($validator->errors())
                ->with([
                    'toast' => [
                        'type' => 'warning',
                        'message' => 'Please check your inputs.'
                    ]
                ]);
        }

        $request['password'] = Hash::make($request['password']);
        User::create($request->all());
        return
            redirect('users')
            ->with([
                'toast' => [
                    'type' => 'success',
                    'message' => 'User account added successfully.'
                ]
            ]);
    }

    // password update
    public function password_update(Request $request, User $user)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'password' => ['required', 'current_password'],
                'new_password' => ['required'],
                'password_confirmation' => ['required', 'same:new_password']
            ],
            [
                'password_confirmation.same' => 'The confirmation password does not match.'
            ]
        );

        if ($validator->fails()) {
            return
                redirect()
                ->back()
                ->withInput()
                ->withErrors($validator->errors())
                ->with([
                    'toast' => [
                        'type' => 'warning',
                        'message' => 'Please check your inputs.'
                    ]
                ]);
        }

        if ($user->update(['password' => Hash::make($request['new_password'])])) {
            return
                redirect('settings')
                ->with([
                    'toast' => [
                        'type' => 'success',
                        'message' => 'Password updated.'
                    ]
                ]);
        } else {
            return
                redirect('settings')
                ->with([
                    'toast' => [
                        'type' => 'danger',
                        'message' => 'Failed to update password.'
                    ]
                ]);
        }
    }


    public function destroy(User $user)
    {
        if ($user->delete()) {
            return
                redirect('users')
                ->with([
                    'toast' => [
                        'type' => 'success',
                        'message' => 'User account deleted successfully.'
                    ]
                ]);
        }
        return
            redirect('users')
            ->with([
                'toast' => [
                    'type' => 'warning',
                    'message' => 'Failed to delete user account.'
                ]
            ]);
    }
}
