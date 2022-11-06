@extends('layouts.dashboard_layout')

@section('title', 'Senior Citizen Registration')

@section('style')
    <style>
        #main {
            display: flex;
            flex-flow: column;
            height: 100%;
        }

        #form-wrapper {
            display: block;
            overflow-y: auto;
            overflow-x: hidden
        }

        #picture-placeholder {
            min-width: 200px;
            min-height: 200px;
        }

        /* hide arrows Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none !important;
            margin: 0 !important;
        }

        /* hide arrows Firefox */
        input[type=number] {
            -moz-appearance: textfield !important;
        }

        .fs-small {
            font-size: .75rem !important;
        }

        .w-1per {
            width: 1%
        }

        .text-no-wrap {
            white-space: nowrap;
        }

        .disabled {
            filter: brightness(0.5);
            pointer-events: none;
            cursor: none;
        }
    </style>
@endsection

@if ($errors->any())
    {{ var_dump($errors) }}
@endif

@section('content')
    <div id="main">
        <div class="d-flex justify-content-between">
            <div class="d-flex gap-2">
                <a href="/citizens" class="btn btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                    </svg>
                </a>
                <h2 class="my-auto">Social Pension Application</h2>
            </div>
            <button class="btn btn-primary" type="submit" form="registration-form">Submit</button>
        </div>
        <hr>
        <div id="form-wrapper">
            <form id="registration-form" class="d-flex flex-column px-3 pb-3 needs-validation" action="/philhealth/register/submit" method="POST" novalidate>
                @csrf
                @method('POST')

                <div class="d-grid gap-5">

                    <div class="row ms-3">

                        <div class="col-6">
                            <div class="bg-white p-1 mb-3" style="width: fit-content">
                                <img src="{{ asset('images/philhealth-logo.png') }}" class="img-fluid" style="height: 86px">
                            </div>

                            <div>
                                <p><u><strong>REMINDERS: </strong></u></p>
                                <ol class="ps-3 mb-0">
                                    <li>Your PhilHealth Identification Number (PIN) is your unique and permanent number.</li>
                                    <li>Always use your PIN in all transactions with PhilHealth.</li>
                                    <li>For Updating/Amendment check the appropriate box and provide details to be accomplised and submit corresponding supporting documents.</li>
                                    <li>Please read instructions at the back before filling-out this form.</li>
                                </ol>
                            </div>

                        </div>

                        <div class="col-6 d-flex flex-column gap-3">
                            <div class="d-grid text-center">
                                <h4><strong>PMRF</strong></h4>
                                <b>PHILHEALTH MEMBER REGISTRATION FORM</b>
                                <small>UHC v.1 January 2020</small>
                            </div>

                            {{-- philhealth identiication number --}}
                            <div>
                                <label for="pin" class="form-label text-info">PHILHEALTH IDENTIFICAION NUMBER (PIN)</label>
                                <input type="text" class="form-control form-control-sm" id="pin" name="pin" value="{{ old('pin') }}">
                            </div>

                            {{-- purpose --}}
                            <div>
                                <label for="purpose" class="form-label text-info">PURPOSE</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="purpose" id="purpose_registration" value="registration" @if (old('purpose') === 'registration') checked @endif required>
                                        <label class="form-check-label" for="purpose_registration">Registration</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="purpose" id="purpose_update" value="update" @if (old('purpose') === 'update') checked @endif>
                                        <label class="form-check-label" for="purpose_update">Update/Amendment</label>
                                    </div>
                                </div>
                            </div>

                            {{-- konsulta provider --}}
                            <div>
                                <label for="" class="form-label text-info">PREFERRED KonSulta PROVIDER</label>
                                <input type="text" class="form-control form-control-sm" name="konsulta_provider" value="{{ old('konsulta_provider') }}">
                            </div>
                        </div>


                    </div>

                    {{-- 
                    | -------------------------------------------------    
                    |    
                    |    I. PERSONAL DETAILS
                    |    
                    | -------------------------------------------------    
                    --}}
                    <div>
                        <div class="d-flex gap-3">
                            <h3>I. PERSONAL DETIALS</h3>
                            <hr class="flex-fill">
                        </div>
                        <div class="row ps-3 g-3 flex-fill">

                            {{-- names --}}
                            <div class="col-12">
                                <table class="table table-bordered table-light">
                                    <thead>
                                        <tr>
                                            <th scope="col" rowspan="2" class="p-0"></th>
                                            <th class="text-center align-middle" scope="col" rowspan="2">LAST NAME</th>
                                            <th class="text-center align-middle" scope="col" rowspan="2">FIRST NAME</th>
                                            <th class="text-center align-middle fs-small w-1per" scope="col" rowspan="2">NAME EXTENSION <br>(Jr./Sr./III)</th>
                                            <th scope="col" rowspan="2" class="text-center align-middle">MIDDLE NAME</th>
                                            <th scope="col" class="text-center align-middle fs-small w-1per">NO MIDDLE NAME</th>
                                            <th scope="col" class="text-center align-middle fs-small w-1per">MONONYM</th>
                                        </tr>
                                        <tr>
                                            <th colspan="2" class="text-center align-middle fs-small w-1per">(Check if applicable only)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">MEMBER</th>
                                            <td class="text-center align-middle">
                                                <input type="text" class=" form-control form-control-sm @error('member_lastname') is-invalid @enderror" name="member_lastname" value="{{ old('member_lastname') }}" required>
                                                @error('member_lastname')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td class="text-center align-middle">
                                                <input type="text" class=" form-control form-control-sm @error('member_firstname') is-invalid @enderror" name="member_firstname" value="{{ old('member_firstname') }}" required>
                                                @error('member_firstname')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td class="text-center align-middle">
                                                <input type="text" class=" form-control form-control-sm" name="member_name_extension" value="{{ old('member_name_extension') }}">
                                            </td>
                                            <td class="text-center align-middle">
                                                <input type="text" class=" form-control form-control-sm @error('member_middlename') is-invalid @enderror" name="member_middlename" value="{{ old('member_middlename') }}">
                                                @error('member_middlename')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td class="text-center align-middle">
                                                <input type="checkbox" class="form-check-input" value="1" name="member_no_middlename" value="{{ old('member_no_middlename') }}">
                                            </td>
                                            <td class="text-center align-middle">
                                                <input type="checkbox" class="form-check-input" value="1" name="member_no_mononym" value="{{ old('member_no_mononym') }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="fs-small w-1per">
                                                MOTHER'S
                                                <div class="text-no-wrap">MAIDEN NAME</div>
                                            </th>
                                            <td class="text-center align-middle">
                                                <input type="text" class=" form-control form-control-sm @error('mother_lastname') is-invalid @enderror" name="mother_lastname" value="{{ old('mother_lastname') }}">
                                                @error('mother_lastname')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td class="text-center align-middle">
                                                <input type="text" class=" form-control form-control-sm @error('mother_firstname') is-invalid @enderror" name="mother_firstname" value="{{ old('mother_firstname') }}">
                                                @error('mother_firstname')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td class="text-center align-middle">
                                                <input type="text" class=" form-control form-control-sm" name="mother_name_extension" value="{{ old('mother_name_extension') }}">
                                            </td>
                                            <td class="text-center align-middle">
                                                <input type="text" class=" form-control form-control-sm @error('mother_middlename') is-invalid @enderror" name="mother_middlename" value="{{ old('mother_middlename') }}">
                                                @error('mother_middlename')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td class="text-center align-middle">
                                                <input type="checkbox" class="form-check-input" value="1" name="mother_no_middlename" value="{{ old('mother_no_middlename') }}">
                                            </td>
                                            <td class="text-center align-middle">
                                                <input type="checkbox" class="form-check-input" value="1" name="mother_no_mononym" value="{{ old('mother_no_mononym') }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                SPOUSE
                                                <div class="fs-small text-no-wrap">(If married)</div>
                                            </th>
                                            <td class="text-center align-middle">
                                                <input type="text" class=" form-control form-control-sm @error('spouse_lastname') is-invalid @enderror" name="spouse_lastname" value="{{ old('spouse_lastname') }}">
                                                @error('spouse_middlename')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td class="text-center align-middle">
                                                <input type="text" class=" form-control form-control-sm @error('spouse_firstname') is-invalid @enderror" name="spouse_firstname" value="{{ old('spouse_firstname') }}">
                                                @error('spouse_firstname')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td class="text-center align-middle">
                                                <input type="text" class=" form-control form-control-sm" name="spouse_name_extension" value="{{ old('spouse_name_extension') }}">
                                            </td>
                                            <td class="text-center align-middle">
                                                <input type="text" class=" form-control form-control-sm @error('spouse_middlename') is-invalid @enderror" name="spouse_middlename" value="{{ old('spouse_middlename') }}">
                                                @error('spouse_middlename')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td class="text-center align-middle">
                                                <input type="checkbox" class="form-check-input" value="1" name="spouse_no_middlename" value="{{ old('spouse_no_middlename') }}">
                                            </td>
                                            <td class="text-center align-middle">
                                                <input type="checkbox" class="form-check-input" value="1" name="spouse_no_mononym" value="{{ old('spouse_no_mononym') }}">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            {{-- date of birth --}}
                            <div class="col-4">
                                <label for="date_of_birth" class="form-label text-info">DATE OF BIRTH</label>
                                <input type="date" class="form-control form-control-sm form-control form-control-sm-sm @error('date_of_birth') is-invalid @enderror" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" required>
                                @error('date_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- place of birth --}}
                            <div class="col-5">
                                <label for="place_of_birth" class="form-label text-info">PLACE OF BIRTH</label>
                                <input type="text" class="form-control form-control-sm @error('place_of_birth') is-invalid @enderror" id="place_of_birth" name="place_of_birth" value="{{ old('place_of_birth') }}" required>
                                @error('place_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- philsys_id_number --}}
                            <div class="col-3">
                                <label for="philsys_id_number" class="form-label text-info">PHILSYS ID NUMBER</label>
                                <input type="text" class="form-control form-control-sm" id="philsys_id_number" name="philsys_id_number" value="{{ old('philsys_id_number') }}">
                            </div>

                            {{-- sex --}}
                            <div class="col-2">
                                <label for="sex" class="form-label text-info">SEX</label>
                                <select class="form-select form-select-sm @error('sex') is-invalid @enderror" id="sex" name="sex" required>
                                    <option value="" selected disabled>Select sex</option>
                                    <option value="male" {{ old('sex') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('sex') == 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('sex')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- civil status --}}
                            <div class="col-2">
                                <label for="civil_status" class="form-label text-info">CIVIL STATUS</label>
                                <select class="form-select form-select-sm @error('civil_status') is-invalid @enderror" id="civil_status" name="civil_status" required>
                                    <option value="" selected disabled>Select status</option>
                                    @foreach (App\Models\Constants::PH_CIVIL_STATUS as $key => $status)
                                        <option value="{{ $key }}" {{ old('civil_status') == $key ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                                @error('civil_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- citizenship --}}
                            <div class="col-5">
                                <label for="citizenship" class="form-label text-info">CITIZENSHIP</label>
                                <div>
                                    @foreach (App\Models\Constants::PH_CITIZENSHIP as $key => $citizenship)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="citizenship" id="citizenship_{{ $key }}" value="{{ $key }}" @if (old('citizenship') == $key) checked @endif @if ($loop->first) required @endif>
                                            <label class="form-check-label" for="citizenship_{{ $key }}">{{ $citizenship }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                @error('citizenship')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- tax payer's identification number --}}
                            <div class="col-3">
                                <label for="tin" class="form-label text-info">TAX PAYER'S IDENTIFICATION NUMBER (TIN)</label>
                                <input type="text" class="form-control form-control-sm" id="tin" name="tin" value="{{ old('tin') }}">
                                @error('place_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                        </div>

                    </div>


                    {{-- 
                    | -------------------------------------------------    
                    |    
                    |    I. ADDRESS AND CONTACT DETAILS
                    |    
                    | -------------------------------------------------    
                    --}}
                    <div>
                        <div class="d-flex gap-3">
                            <h3>II. ADDRESS and CONTACT DETAILS</h3>
                            <hr class="flex-fill">
                        </div>
                        <div class="d-grid ps-3 gap-4 flex-fill">

                            {{-- permanent home address --}}
                            <div id="permanent-home-address">
                                <p class="mb-0 lead">PERMANENT HOME ADDRESS</p>
                                <div class="row g-3">

                                    {{-- permanent_unit_room_no_floor --}}
                                    <div class="col-3">
                                        <label for="permanent_unit_room_no_floor" class="form-label text-info">Unit/Room No./Floor</label>
                                        <input type="text" class="form-control form-control-sm" name="permanent_unit_room_no_floor" id="permanent_unit_room_no_floor" data-same-field="unit_room_no_floor" value="{{ old('permanent_unit_room_no_floor') }}">
                                    </div>

                                    {{-- permanent_building_name --}}
                                    <div class="col-3">
                                        <label for="permanent_building_name" class="form-label text-info">Building Name</label>
                                        <input type="text" class="form-control form-control-sm" name="permanent_building_name" id="permanent_building_name" data-same-field="building_name" value="{{ old('permanent_building_name') }}">
                                    </div>

                                    {{-- lot/block/phase/house number --}}
                                    <div class="col-3">
                                        <label for="permanent_lot_block_phase_house_no" class="form-label text-info">Lot/Block/Phase/House Number</label>
                                        <input type="text" class="form-control form-control-sm" name="permanent_lot_block_phase_house_no" id="permanent_lot_block_phase_house_no" data-same-field="lot_block_phase_house_no" value="{{ old('permanent_lot_block_phase_house_no') }}">
                                    </div>

                                    {{-- street name --}}
                                    <div class="col-3">
                                        <label for="permanent_street_name" class="form-label text-info">Street Name</label>
                                        <input type="text" class="form-control form-control-sm" name="permanent_street_name" id="permanent_street_name" data-same-field="street_name" value="{{ old('permanent_street_name') }}">
                                    </div>

                                    {{-- subdivision --}}
                                    <div class="col-2">
                                        <label for="permanent_subdivision" class="form-label text-info">Subdivision</label>
                                        <input type="text" class="form-control form-control-sm" name="permanent_subdivision" id="permanent_subdivision" data-same-field="subdivision" value="{{ old('permanent_subdivision') }}">
                                    </div>

                                    {{-- barangay --}}
                                    <div class="col-3">
                                        <label for="permanent_barangay" class="form-label text-info">Barangay</label>
                                        <input type="text" class="form-control form-control-sm" name="permanent_barangay" id="permanent_barangay" data-same-field="barangay" value="{{ old('permanent_barangay') }}">
                                    </div>

                                    {{-- barangay --}}
                                    <div class="col-3">
                                        <label for="permanent_municipality_city" class="form-label text-info">Municipality/City</label>
                                        <input type="text" class="form-control form-control-sm" name="permanent_municipality_city" id="permanent_municipality_city" data-same-field="municipality_city" value="{{ old('permanent_municipality_city') }}">
                                    </div>

                                    {{-- province/state/country --}}
                                    <div class="col-3">
                                        <label for="permanent_province_state_country" class="form-label text-info">Province/State/Country</label>
                                        <input type="text" class=" form-control  form-control-sm" name="permanent_province_state_country" id="permanent_province_state_country" data-same-field="province_state_country" value="{{ old('permanent_province_state_country') }}">
                                    </div>

                                    {{-- zip code --}}
                                    <div class="col-1">
                                        <label for="permanent_zip_code" class="form-label text-info">ZIP Code</label>
                                        <input type="text" class=" form-control  form-control-sm" name="permanent_zip_code" id="permanent_zip_code" data-same-field="zip_code" value="{{ old('permanent_zip_code') }}">
                                    </div>

                                </div>
                            </div>

                            {{-- mailing home address --}}
                            <div id="mailing-address">
                                <div class="d-flex flex-row gap-3">
                                    <p class="mb-0 lead">MAILING ADDRESS</p>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="same-as-above" value="1">
                                        <label class="form-check-label" for="same-as-above">SAME AS ABOVE</label>
                                    </div>
                                </div>
                                <div class="row g-3">

                                    {{-- mailing_unit_room_no_floor --}}
                                    <div class="col-3">
                                        <label for="mailing_unit_room_no_floor" class="form-label text-info">Unit/Room No./Floor</label>
                                        <input type="text" class="form-control form-control-sm" name="mailing_unit_room_no_floor" id="mailing_unit_room_no_floor" data-same-field="unit_room_no_floor" value="{{ old('mailing_unit_room_no_floor') }}">
                                    </div>

                                    {{-- mailing_building_name --}}
                                    <div class="col-3">
                                        <label for="mailing_building_name" class="form-label text-info">Building Name</label>
                                        <input type="text" class="form-control form-control-sm" name="mailing_building_name" id="mailing_building_name" data-same-field="building_name" value="{{ old('mailing_building_name') }}">
                                    </div>

                                    {{-- lot/block/phase/house number --}}
                                    <div class="col-3">
                                        <label for="mailing_lot_block_phase_house_no" class="form-label text-info">Lot/Block/Phase/House Number</label>
                                        <input type="text" class="form-control form-control-sm" name="mailing_lot_block_phase_house_no" id="mailing_lot_block_phase_house_no" data-same-field="lot_block_phase_house_no" value="{{ old('mailing_lot_block_phase_house_no') }}">
                                    </div>

                                    {{-- street name --}}
                                    <div class="col-3">
                                        <label for="mailing_street_name" class="form-label text-info">Street Name</label>
                                        <input type="text" class="form-control form-control-sm" name="mailing_street_name" id="mailing_street_name" data-same-field="street_name" value="{{ old('mailing_street_name') }}">
                                    </div>

                                    {{-- subdivision --}}
                                    <div class="col-2">
                                        <label for="mailing_subdivision" class="form-label text-info">Subdivision</label>
                                        <input type="text" class="form-control form-control-sm" name="mailing_subdivision" id="mailing_subdivision" data-same-field="subdivision" value="{{ old('mailing_subdivision') }}">
                                    </div>

                                    {{-- barangay --}}
                                    <div class="col-3">
                                        <label for="mailing_barangay" class="form-label text-info">Barangay</label>
                                        <input type="text" class="form-control form-control-sm" name="mailing_barangay" id="mailing_barangay" data-same-field="barangay" value="{{ old('mailing_barangay') }}">
                                    </div>

                                    {{-- Municipality/City --}}
                                    <div class="col-3">
                                        <label for="mailing_municipality_city" class="form-label text-info">Municipality/City</label>
                                        <input type="text" class="form-control form-control-sm" name="mailing_municipality_city" id="mailing_municipality_city" data-same-field="municipality_city" value="{{ old('municipality_city') }}">
                                    </div>

                                    {{-- province/state/country --}}
                                    <div class="col-3">
                                        <label for="mailing_province_state_country" class="form-label text-info">Province/State/Country</label>
                                        <input type="text" class=" form-control  form-control-sm" name="mailing_province_state_country" id="mailing_province_state_country" data-same-field="province_state_country" value="{{ old('mailing_province_state_country') }}">
                                    </div>

                                    {{-- zip code --}}
                                    <div class="col-1">
                                        <label for="mailing_zip_code" class="form-label text-info">ZIP Code</label>
                                        <input type="text" class=" form-control  form-control-sm" name="mailing_zip_code" id="mailing_zip_code" data-same-field="zip_code" value="{{ old('mailing_zip_code') }}">
                                    </div>

                                </div>
                            </div>

                            {{-- contact details  --}}
                            <div>
                                <div class="d-flex flex-row gap-3">
                                    <p class="mb-0 lead">CONTACT DETAILS</p>
                                </div>
                                <div class="row g-3">
                                    {{-- home phone number --}}
                                    <div class="col-6">
                                        <label for="home_phone_no" class="form-label text-info">Home Phone Number</label>
                                        <input type="text" class="form-control form-control-sm" name="home_phone_no" id="home_phone_no" value="{{ old('home_phone_no') }}">
                                    </div>

                                    {{-- mobile number --}}
                                    <div class="col-6">
                                        <label for="mobile_no" class="form-label text-info">Mobile Number (Required)</label>
                                        <input type="text" class="form-control form-control-sm  @error('mobile_no') is-invalid @enderror" name="mobile_no" id="mobile_no" required value="{{ old('mobile_no') }}">
                                        @error('mobile_no')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Business direct line --}}
                                    <div class="col-6">
                                        <label for="business_direct_line" class="form-label text-info">Business (Direct Line)</label>
                                        <input type="text" class="form-control form-control-sm" name="business_direct_line" id="business_direct_line" required value="{{ old('business_direct_line') }}">
                                    </div>

                                    {{-- Email address --}}
                                    <div class="col-6">
                                        <label for="email" class="form-label text-info">E-mail Address (Required for OFW)</label>
                                        <input type="email" class="form-control form-control-sm" name="email" id="email" required value="{{ old('email') }}">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 
                    | -------------------------------------------------    
                    |    
                    |    DECLARATION OF DEPENDENTS
                    |    
                    | -------------------------------------------------    
                    --}}
                    <div>
                        <div class="d-flex gap-3">
                            <h3>III. DECLARATION OF DEPENDENTS</h3>
                            <hr class="flex-fill">
                        </div>
                        <div class="d-grid ps-3 flex-fill">
                            <table class="table table-light table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle" scope="col" rowspan="2">LAST NAME</th>
                                        <th class="text-center align-middle" scope="col" rowspan="2">FIRST NAME</th>
                                        <th class="text-center align-middle fs-small w-1per" scope="col" rowspan="2">NAME EXTENSION <br>(Jr./Sr./III)</th>
                                        <th scope="col" rowspan="2" class="text-center align-middle">MIDDLE NAME</th>
                                        <th scope="col" class="text-center align-middle fs-small w-1per">NO MIDDLE NAME</th>
                                        <th scope="col" class="text-center align-middle fs-small w-1per">MONONYM</th>
                                        <th scope="col" rowspan="2" class="text-center align-middle fs-small w-1per">Check if with Permanent Disability</th>
                                    </tr>
                                    <tr>
                                        <th colspan="2" class="text-center align-middle fs-small">(Check if applicable only)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < 4; $i++)
                                        <tr>
                                            <td class="d-none">
                                                <input type="text" name="dependent[]" value="{{ $i }}">
                                            </td>
                                            <td class="text-center align-middle"><input type="text" class=" form-control form-control-sm" name="dependent_lastname[]"></td>
                                            <td class="text-center align-middle"><input type="text" class=" form-control form-control-sm" name="dependent_firstname[]"></td>
                                            <td class="text-center align-middle"><input type="text" class=" form-control form-control-sm" name="dependent_name_extension[]"></td>
                                            <td class="text-center align-middle"><input type="text" class=" form-control form-control-sm" name="dependent_middlename[]"></td>
                                            <td class="text-center align-middle"><input type="checkbox" class="form-check-input" value="1" name="dependent_no_middlename[]"></td>
                                            <td class="text-center align-middle"><input type="checkbox" class="form-check-input" value="1" name="dependent_no_mononym[]"></td>
                                            <td class="text-center align-middle"><input type="checkbox" class="form-check-input" value="1" name="dependent_permanent_disability[]"></td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>

                        </div>
                    </div>


                    {{-- 
                    | -------------------------------------------------    
                    |    
                    |    MEMBER TYPE
                    |    
                    | -------------------------------------------------    
                    --}}
                    <div>
                        <div class="d-flex gap-3">
                            <h3>III. MEMBER TYPE</h3>
                            <hr class="flex-fill">
                        </div>
                        <div class="d-grid g-3 ps-3 flex-fill">

                            <div class="row ms-0">
                                {{-- DIRECT CONTRIBUTOR --}}
                                <div class="col-8">
                                    <p class="text-center lead">DIRECT CONTRIBUTOR</p>
                                    <div class="row">

                                        {{-- employed private --}}
                                        <div class="col-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="employed_private">
                                                <label class="form-check-label" for="employed_private">Employed Private</label>
                                            </div>
                                        </div>

                                        {{-- employed private --}}
                                        <div class="col-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="kasambahay" name="kasambahay">
                                                <label class="form-check-label" for="kasambahay">Kasambahay</label>
                                            </div>
                                        </div>

                                        {{-- employed private --}}
                                        <div class="col-4 ">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" value="family_driver" id="family_driver" name="family_driver">
                                                <label class="form-check-label" for="family_driver">Family Driver</label>
                                            </div>
                                        </div>

                                        {{-- employed government --}}
                                        <div class="col-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" value="employed_government" id="employed_government" name="employed_government">
                                                <label class="form-check-label" for="employed_government">Employed Government</label>
                                            </div>
                                        </div>

                                        {{-- migrant worker --}}
                                        <div class="col-8">
                                            <div class="form-check">
                                                <input class="form-check-input is-required" type="checkbox" value="1" value="migrant_worker" id="migrant_worker" name="migrant_worker">
                                                <label class="form-check-label" for="migrant_worker">Migrant Worker</label>
                                            </div>
                                        </div>

                                        {{-- professional practitioner --}}
                                        <div class="col-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="professional_practitioner" name="professional_practitioner">
                                                <label class="form-check-label text-no-wrap" for="professional_practitioner">Professional Practitioner</label>
                                            </div>
                                        </div>

                                        <div class="col-8 ps-5">
                                            {{-- land based --}}
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input disabled" type="radio" id="land_based" name="migrant_worker_based" data-requires-field="migrant_worker">
                                                <label class="form-check-label" for="land_based" data-requires-field="migrant_worker">Land-Based</label>
                                            </div>
                                            {{-- sea based --}}
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input disabled" type="radio" value="sea" id="sea_based" name="migrant_worker_based" data-requires-field="migrant_worker">
                                                <label class="form-check-label" for="sea_based" data-requires-field="migrant_worker">Sea-Based</label>
                                            </div>
                                        </div>

                                        {{-- self earning individual --}}
                                        <div class="col-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="self_earning" name="self_earning">
                                                <label class="form-check-label" for="self_earning">Self-Earning Individual</label>
                                            </div>
                                        </div>

                                        {{-- lifetime member --}}
                                        <div class="col-8">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="lifetime" name="lifetime">
                                                <label class="form-check-label" for="lifetime">Lifetime Member</label>
                                            </div>
                                        </div>

                                        {{-- individual --}}
                                        <div class="col-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="individual" name="individual">
                                                <label class="form-check-label" for="individual">Individual</label>
                                            </div>
                                        </div>

                                        {{-- dual citizenship --}}
                                        <div class="col-8">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="dual_citizenship" name="dual_citizenship">
                                                <label class="form-check-label" for="dual_citizenship">Filipinos with Dual Citizenship</label>
                                            </div>
                                        </div>

                                        {{-- sole proprietor --}}
                                        <div class="col-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="sole_proprietor" name="sole_proprietor">
                                                <label class="form-check-label" for="sole_proprietor">Sole Proprietor</label>
                                            </div>
                                        </div>

                                        {{-- foreign national --}}
                                        <div class="col-8">
                                            <div class="form-check">
                                                <input class="form-check-input is-required" type="checkbox" value="1" id="foreign_national" name="foreign_national">
                                                <label class="form-check-label" for="foreign_national">Foreign National</label>
                                            </div>
                                        </div>

                                        {{-- group enrollment scheme --}}
                                        <div class="col-4">
                                            <div class="form-check">
                                                <input class="form-check-input is-required" type="checkbox" value="1" id="group_enrollment" name="group_enrollment">
                                                <label class="form-check-label" for="group_enrollment">Group Enrollment Scheme</label>
                                            </div>
                                        </div>

                                        {{-- pra SRRV no --}}
                                        <div class="col-8 ps-5 mb-1">
                                            <div class="d-flex flex-row align-items-center gap-2">
                                                <label class="form-label mb-0 text-no-wrap disabled" for="pra_ssrv_no" data-requires-field="foreign_national">PRA SRRV No.</label>
                                                <input type="text" class="form-control form-control-sm disabled" name="pra_ssrv_no" id="pra_ssrv_no" data-requires-field="foreign_national" data-required-value="foreign_national">
                                            </div>
                                        </div>

                                        <div class="col-4 ps-5">
                                            <input type="text" class="form-control form-control-sm disabled" name="group_enrollment_scheme" data-requires-field="group_enrollment">
                                        </div>

                                        {{-- acr i-card no --}}
                                        <div class="col-8 ps-5">
                                            <div class="d-flex flex-row align-items-center gap-2">
                                                <label class="form-label mb-0 text-no-wrap disabled" for="acr_icard_no" data-requires-field="foreign_national">ACR I-Card No.</label>
                                                <input type="text" class="form-control form-control-sm disabled" name="acr_icard_no" id="acr_icard_no" data-requires-field="foreign_national">
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                {{-- INDIRECT CONTRIBUTOR --}}
                                <div class="col-4 border-start">
                                    <p class="text-center lead">INDIRECT CONTRIBUTOR</p>
                                    <div class="row">

                                        {{-- Listahanan --}}
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="listahanan" name="listahanan">
                                                <label class="form-check-label" for="listahanan">Listahanan</label>
                                            </div>
                                        </div>

                                        {{-- lgu sponsored --}}
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="lgu_sponsored" name="lgu_sponsored">
                                                <label class="form-check-label" for="lgu_sponsored">LGU-Sponsored</label>
                                            </div>
                                        </div>

                                        {{-- 4ps/mcct --}}
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="four_ps_mcct" name="four_ps_mcct">
                                                <label class="form-check-label" for="four_ps_mcct">4Ps/MCCT</label>
                                            </div>
                                        </div>

                                        {{-- NGA-Sponsored --}}
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="nga_sponsored" name="nga_sponsored">
                                                <label class="form-check-label" for="nga_sponsored">NGA-Sponsored</label>
                                            </div>
                                        </div>

                                        {{-- senior citizen --}}
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="senior_citizen" name="senior_citizen">
                                                <label class="form-check-label" for="senior_citizen">Senior Citizen</label>
                                            </div>
                                        </div>

                                        {{-- private sponsored --}}
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="private_sponsored" name="private_sponsored">
                                                <label class="form-check-label" for="private_sponsored">Private-Sponsored</label>
                                            </div>
                                        </div>

                                        {{-- PAMANA --}}
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="pamana" name="pamana">
                                                <label class="form-check-label" for="pamana">PAMANA</label>
                                            </div>
                                        </div>

                                        {{-- KIA/KIPO --}}
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="kia_kipo" name="kia_kipo">
                                                <label class="form-check-label" for="kia_kipo">KIA/KIPO</label>
                                            </div>
                                        </div>

                                        {{-- person with disability --}}
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input is-required" type="checkbox" value="1" id="person_with_disability" name="person_with_disability">
                                                <label class="form-check-label" for="person_with_disability">Person with Disability</label>
                                            </div>
                                        </div>

                                        {{-- PWD ID no --}}
                                        <div class="col-12 ps-5">
                                            <label for="pwd_id_no" class="form-label mb-0 disabled" data-requires-field="person_with_disability">PWD ID No.</label>
                                            <input type="text" class="form-control form-control-sm disabled" id="pwd_id_no" name="pwd_id_no" data-requires-field="person_with_disability">
                                        </div>

                                        {{-- Bangsamoro/Normalization --}}
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="bangsamoro_normalization" name="bangsamoro_normalization">
                                                <label class="form-check-label" for="bangsamoro_normalization">Bangsamoro/Normalization</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row ms-0">
                                <div class="col-8 row">
                                    <div class="col-4 d-flex flex-column">
                                        <label for="profession" class="form-label">PROFESSION:</label>
                                        <input type="text" class="form-control form-control-sm" name="profession" id="profession">
                                    </div>
                                    <div class="col-4 d-flex flex-column">
                                        <label for="monthly_income" class="form-label">MONTHLY INCOME:</label>
                                        <input type="text" class="form-control form-control-sm" name="monthly_income" id="monthly_income">
                                    </div>
                                    <div class="col-4 d-flex flex-column">
                                        <label for="proof_of_income" class="form-label">PROOF OF INCOME:</label>
                                        <input type="text" class="form-control form-control-sm" name="proof_of_income" id="proof_of_income">
                                    </div>
                                </div>
                                <div class="col-4 d-flex flex-column border-start">
                                    <p class="text-center lead">For PhilHealth Use Only</p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" name="pos_financially_incapable" id="pos_financially_incapable">
                                        <label class="form-check-label" for="pos_financially_incapable">Point of Service (POS) Financially Incapable</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" name="financially_incapable" id="financially_incapable">
                                        <label class="form-check-label" for="financially_incapable">Financially Incapable</label>
                                    </div>
                                </div>
                            </div>

                        </div>



                    </div>


                    {{-- 
                    | -------------------------------------------------    
                    |    
                    |    V. UPDATING/AMENDMENT
                    |    
                    | -------------------------------------------------    
                    --}}
                    <div>
                        <div class="d-flex gap-3">
                            <h3>IV. UPDATING AMENDMENT</h3>
                            <hr class="flex-fill">
                        </div>
                        <div class="d-grid g-3 ps-3 flex-fill">
                            <table class="table table-bordered table-light">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle" scope="col">Please check:</th>
                                        <th class="text-center align-middle" scope="col">FROM</th>
                                        <th class="text-center align-middle" scope="col">TO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input is-required" type="checkbox" value="1" id="change_correction_of_name" name="change_correction_of_name">
                                                <label class="form-check-label" for="change_correction_of_name">
                                                    Change/Correction of Name
                                                </label>
                                            </div>
                                        </td>
                                        <td class="text-center align-middle"><input type="text" class=" form-control form-control-sm disabled" name="update_name_from" data-requires-field="change_correction_of_name"></td>
                                        <td class="text-center align-middle"><input type="text" class=" form-control form-control-sm disabled" name="update_name_to" data-requires-field="change_correction_of_name"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input is-required" type="checkbox" value="1" id="correction_of_date_of_birth" name="correction_of_date_of_birth">
                                                <label class="form-check-label" for="correction_of_date_of_birth">
                                                    Correction of Date of Birth
                                                </label>
                                            </div>
                                        </td>
                                        <td class="text-center align-middle"><input type="text" class=" form-control form-control-sm disabled" name="update_date_of_birth_from" data-requires-field="correction_of_date_of_birth"></td>
                                        <td class="text-center align-middle"><input type="text" class=" form-control form-control-sm disabled" name="update_date_of_birth_to" data-requires-field="correction_of_date_of_birth"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input is-required" type="checkbox" value="1" id="correction_of_sex" name="correction_of_sex">
                                                <label class="form-check-label" for="correction_of_sex">
                                                    Correction of Sex
                                                </label>
                                            </div>
                                        </td>
                                        <td class="text-center align-middle"><input type="text" class=" form-control form-control-sm disabled" name="update_sex_from" data-requires-field="correction_of_sex"></td>
                                        <td class="text-center align-middle"><input type="text" class=" form-control form-control-sm disabled" name="update_sex_to" data-requires-field="correction_of_sex"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input is-required" type="checkbox" value="1" id="change_of_civil_status" name="change_of_civil_status">
                                                <label class="form-check-label" for="change_of_civil_status">
                                                    Change of Civil Status
                                                </label>
                                            </div>
                                        </td>
                                        <td class="text-center align-middle"><input type="text" class=" form-control form-control-sm disabled" name="update_civil_status_from" data-requires-field="change_of_civil_status"></td>
                                        <td class="text-center align-middle"><input type="text" class=" form-control form-control-sm disabled" name="update_civil_status_to" data-requires-field="change_of_civil_status"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input is-required" type="checkbox" value="1" id="update_personal_info" name="update_personal_info">
                                                <label class="form-check-label d-grid" for="update_personal_info">
                                                    Updating of Personal Information/Address/
                                                    <small>Telephone Number/Mobile Number/E-mail Address</small>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="text-center align-middle"><input type="text" class=" form-control form-control-sm disabled" name="update_personal_info_from" data-requires-field="update_personal_info"></td>
                                        <td class="text-center align-middle"><input type="text" class=" form-control form-control-sm disabled" name="update_personal_info_to" data-requires-field="update_personal_info"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/philhealth-application.js') }}"></script>
@endsection
