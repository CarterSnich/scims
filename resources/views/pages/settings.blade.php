@extends('layouts.dashboard_layout')

@section('title', 'User Settings')

@section('style')
    <style>
        #main {
            display: flex;
            flex-flow: column;
            height: 100%;
        }
    </style>
@endsection

@section('content')
    {{-- main content --}}
    <div id="main">
        {{-- page header --}}
        <div class="d-flex justify-content-between">
            <div class="d-flex gap-2">
                {{-- go back button --}}
                <a href="{{ url()->previous() === url()->current() ? '/dashboard' : url()->previous() }}" class="btn btn-secondary" data-has-tooltip="true" data-bs-placement="bottom" title="Go back">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                    </svg>
                    <span class="visually-hidden">Go back</span>
                </a>
                <h2 class="my-auto">
                    Settings
                </h2>
            </div>
        </div>
        <hr style="min-height: 1px">
        {{-- data wrapper --}}
        <div id="data-wrapper" class="bg-dark">
            <div class="px-3 pb-3 gap-5">

                {{-- password --}}
                <form class="needs-validation" method="POST" action="/settings/{{ auth()->user()->id }}/password_update" novalidate>
                    @csrf
                    <div class="d-flex">
                        <h3 class="h3 mb-0 me-3">Password</h3>
                        <hr class="flex-fill">
                    </div>

                    <div class="d-grid ms-5 my-3 gap-1">

                        {{-- current password --}}
                        <div class="row">
                            <div class="col-4">
                                <label class="fs-4 form-label" for="password">Current password</label>
                            </div>
                            <div class="col-6">
                                <input type="password" class="form-control @error('password') is-invalid @endif" id="password" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- new password --}}
                        <div class="row">
                            <div class="col-4">
                                <label class="fs-4 form-label" for="new-password">New password</label>
                            </div>
                            <div class="col-6">
                                <input type="password" class="form-control @error('new_password') is-invalid @endif" id="new-password" name="new_password" required>
                                @error('new_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- password confirmation --}}
                        <div class="row">
                            <div class="col-4">
                                <label class="fs-4 form-label" for="password-confirmation">Confirm new password</label>
                            </div>
                            <div class="col-6">
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @endif" id="password-confirmation" name="password_confirmation" required>
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- submit button --}}
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary float-right ">Save</button>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection
