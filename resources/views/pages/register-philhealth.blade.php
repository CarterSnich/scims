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
    </style>
@endsection

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
            <form id="registration-form" class="d-flex flex-column px-3 pb-3 needs-validation" action="/intakes/register/submit" method="POST" enctype="multipart/form-data" novalidate>
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
                                <input type="text" class="form-control form-control-sm" id="pin" name="pin">
                            </div>

                            {{-- purpose --}}
                            <div>
                                <label for="purpose" class="form-label text-info">PURPOSE</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="purpose" id="purpose_registration" value="registration" required>
                                        <label class="form-check-label" for="purpose_registration">Registration</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="purpose" id="purpose_update" value="update">
                                        <label class="form-check-label" for="purpose_update">Update/Amendment</label>
                                    </div>
                                </div>
                            </div>

                            {{-- konsulta provider --}}
                            <div>
                                <label for="" class="form-label text-info">PREFERRED KonSulta PROVIDER</label>
                                <input type="text" class="form-control form-control-sm" name="konsulta_provider">
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
                                            <td class="text-center align-middle"><input type="text" class=" form-control form-control-sm" name="member_lastname" required></td>
                                            <td class="text-center align-middle"><input type="text" class=" form-control form-control-sm" name="member_firstname" required></td>
                                            <td class="text-center align-middle"><input type="text" class=" form-control form-control-sm" name="member_name_extension"></td>
                                            <td class="text-center align-middle"><input type="text" class=" form-control form-control-sm" name="member_middlename"></td>
                                            <td class="text-center align-middle"><input type="checkbox" class="form-check-input" name="member_no_middlename"></td>
                                            <td class="text-center align-middle"><input type="checkbox" class="form-check-input" name="member_no_mononym"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="fs-small w-1per">
                                                MOTHER'S
                                                <div class="text-no-wrap">MAIDEN NAME</div>
                                            </th>
                                            <td class="text-center align-middle"><input type="text" class=" form-control form-control-sm" name="mother_lastname"></td>
                                            <td class="text-center align-middle"><input type="text" class=" form-control form-control-sm" name="mother_firstname"></td>
                                            <td class="text-center align-middle"><input type="text" class=" form-control form-control-sm" name="mother_name_extension"></td>
                                            <td class="text-center align-middle"><input type="text" class=" form-control form-control-sm" name="mother_middlename"></td>
                                            <td class="text-center align-middle"><input type="checkbox" class="form-check-input" name="mother_no_middlename"></td>
                                            <td class="text-center align-middle"><input type="checkbox" class="form-check-input" name="mother_no_mononym"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                SPOUSE
                                                <div class="fs-small text-no-wrap">(If married)</div>
                                            </th>
                                            <td class="text-center align-middle"><input type="text" class=" form-control form-control-sm" name="spouse_lastname"></td>
                                            <td class="text-center align-middle"><input type="text" class=" form-control form-control-sm" name="spouse_firstname"></td>
                                            <td class="text-center align-middle"><input type="text" class=" form-control form-control-sm" name="spouse_name_extension"></td>
                                            <td class="text-center align-middle"><input type="text" class=" form-control form-control-sm" name="spouse_middlename"></td>
                                            <td class="text-center align-middle"><input type="checkbox" class="form-check-input" name="spouse_no_middlename"></td>
                                            <td class="text-center align-middle"><input type="checkbox" class="form-check-input" name="spouse_no_mononym"></td>
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
                                <input type="text" class="form-control form-control-sm @error('place_of_birth') is-invalid @enderror" id="firstname" name="firstname" value="{{ old('place_of_birth') }}" required>
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
                                    @foreach (App\Models\Constants::PH_CIVIL_STATUS as $status)
                                        <option value="{{ $status }}" {{ old('civil_status') == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
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
                                            <input class="form-check-input" type="radio" name="citizenship" id="citizenship_{{ $key }}" value="{{ $key }}" @if ($loop->first) required @endif>
                                            <label class="form-check-label" for="citizenship_{{ $key }}">{{ $citizenship }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                @error('citizenship')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- date of birth --}}
                            <div class="col-3">
                                <label for="date_of_birth" class="form-label text-info">Date of birth</label>
                                <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" class="form-control form-control-sm @error('date_of_birth') is-invalid @enderror">
                                @error('date_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- place of birth --}}
                            <div class="col-6">
                                <label for="place_of_birth" class="form-label text-info">Place of birth</label>
                                <input type="text" class="form-control form-control-sm @error('place_of_birth') is-invalid @enderror" name="place_of_birth" id="place_of_birth" value="{{ old('place_of_birth') }}" required>
                                @error('place_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- tax payers identification number --}}
                            <div class="col-6">
                                <label for="tin" class="form-label text-info">TAX PAYER'S IDENTIFICATION NUMBER (TIN)</label>
                                <input type="text" class="form-control form-control-sm" id="tin" name="tin" value="{{ old('tin') }}">
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
                            <div>
                                <p class="mb-0 lead">PERMANENT HOME ADDRESS</p>
                                <div class="row g-3">

                                    {{-- permanent_unit_room_no_floor --}}
                                    <div class="col-3">
                                        <label for="permanent_unit_room_no_floor" class="form-label text-info">Unit/Room No./Floor</label>
                                        <input type="text" class="form-control form-control-sm" name="permanent_unit_room_no_floor" id="permanent_unit_room_no_floor">
                                    </div>

                                    {{-- permanent_building_name --}}
                                    <div class="col-3">
                                        <label for="permanent_building_name" class="form-label text-info">Building Name</label>
                                        <input type="text" class="form-control form-control-sm" name="permanent_building_name" id="permanent_building_name">
                                    </div>

                                    {{-- lot/block/phase/house number --}}
                                    <div class="col-3">
                                        <label for="permanent_lot_block_phase_house_no" class="form-label text-info">Lot/Block/Phase/House Number</label>
                                        <input type="text" class="form-control form-control-sm" name="permanent_lot_block_phase_house_no" id="permanent_lot_block_phase_house_no">
                                    </div>

                                    {{-- street name --}}
                                    <div class="col-3">
                                        <label for="permanent_street_name" class="form-label text-info">Street Name</label>
                                        <input type="text" class="form-control form-control-sm" name="permanent_street_name" id="permanent_street_name">
                                    </div>

                                    {{-- subdivision --}}
                                    <div class="col-2">
                                        <label for="permanent_subdivision" class="form-label text-info">Subdivision</label>
                                        <input type="text" class="form-control form-control-sm" name="permanent_subdivision" id="permanent_subdivision">
                                    </div>

                                    {{-- barangay --}}
                                    <div class="col-3">
                                        <label for="permanent_barangay" class="form-label text-info">Barangay</label>
                                        <input type="text" class="form-control form-control-sm" name="permanent_barangay" id="permanent_barangay">
                                    </div>

                                    {{-- barangay --}}
                                    <div class="col-3">
                                        <label for="permanent_municipality_city" class="form-label text-info">Municipality/City</label>
                                        <input type="text" class="form-control form-control-sm" name="permanent_municipality_city" id="permanent_municipality_city">
                                    </div>

                                    {{-- province/state/country --}}
                                    <div class="col-3">
                                        <label for="permanent_province_state_country" class="form-label text-info">Province/State/Country</label>
                                        <input type="text" class=" form-control  form-control-sm" name="permanent_province_state_country" id="permanent_province_state_country">
                                    </div>

                                    {{-- zip code --}}
                                    <div class="col-1">
                                        <label for="permanent_zip_code" class="form-label text-info">ZIP Code</label>
                                        <input type="text" class=" form-control  form-control-sm" name="permanent_zip_code" id="permanent_zip_code">
                                    </div>

                                </div>
                            </div>

                            {{-- mailing home address --}}
                            <div>
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
                                        <input type="text" class="form-control form-control-sm" name="mailing_unit_room_no_floor" id="mailing_unit_room_no_floor">
                                    </div>

                                    {{-- mailing_building_name --}}
                                    <div class="col-3">
                                        <label for="mailing_building_name" class="form-label text-info">Building Name</label>
                                        <input type="text" class="form-control form-control-sm" name="mailing_building_name" id="mailing_building_name">
                                    </div>

                                    {{-- lot/block/phase/house number --}}
                                    <div class="col-3">
                                        <label for="mailing_lot_block_phase_house_no" class="form-label text-info">Lot/Block/Phase/House Number</label>
                                        <input type="text" class="form-control form-control-sm" name="mailing_lot_block_phase_house_no" id="mailing_lot_block_phase_house_no">
                                    </div>

                                    {{-- street name --}}
                                    <div class="col-3">
                                        <label for="mailing_street_name" class="form-label text-info">Street Name</label>
                                        <input type="text" class="form-control form-control-sm" name="mailing_street_name" id="mailing_street_name">
                                    </div>

                                    {{-- subdivision --}}
                                    <div class="col-2">
                                        <label for="mailing_subdivision" class="form-label text-info">Subdivision</label>
                                        <input type="text" class="form-control form-control-sm" name="mailing_subdivision" id="mailing_subdivision">
                                    </div>

                                    {{-- barangay --}}
                                    <div class="col-3">
                                        <label for="mailing_barangay" class="form-label text-info">Barangay</label>
                                        <input type="text" class="form-control form-control-sm" name="mailing_barangay" id="mailing_barangay">
                                    </div>

                                    {{-- barangay --}}
                                    <div class="col-3">
                                        <label for="mailing_municipality_city" class="form-label text-info">Municipality/City</label>
                                        <input type="text" class="form-control form-control-sm" name="mailing_municipality_city" id="mailing_municipality_city">
                                    </div>

                                    {{-- province/state/country --}}
                                    <div class="col-3">
                                        <label for="mailing_province_state_country" class="form-label text-info">Province/State/Country</label>
                                        <input type="text" class=" form-control  form-control-sm" name="mailing_province_state_country" id="mailing_province_state_country">
                                    </div>

                                    {{-- zip code --}}
                                    <div class="col-1">
                                        <label for="mailing_zip_code" class="form-label text-info">ZIP Code</label>
                                        <input type="text" class=" form-control  form-control-sm" name="mailing_zip_code" id="mailing_zip_code">
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
                                        <input type="text" class="form-control form-control-sm" name="home_phone_no" id="home_phone_no">
                                    </div>

                                    {{-- mobile number --}}
                                    <div class="col-6">
                                        <label for="mobile_no" class="form-label text-info">Mobile Number (Required)</label>
                                        <input type="text" class="form-control form-control-sm" name="mobile_no" id="mobile_no" required>
                                        @error('mobile_no')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Business direct line --}}
                                    <div class="col-6">
                                        <label for="home_phone_no" class="form-label text-info">Business (Direct Line)</label>
                                        <input type="text" class="form-control form-control-sm" name="home_phone_no" id="home_phone_no" required>
                                    </div>

                                    {{-- Email address --}}
                                    <div class="col-6">
                                        <label for="email" class="form-label text-info">E-mail Address (Required for OFW)</label>
                                        <input type="email" class="form-control form-control-sm" name="email" id="email" required>
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
                                            <td class="text-center align-middle"><input type="checkbox" class="form-check-input" name="dependent_no_middlename"></td>
                                            <td class="text-center align-middle"><input type="checkbox" class="form-check-input" name="dependent_no_mononym"></td>
                                            <td class="text-center align-middle"><input type="checkbox" class="form-check-input" name="dependent_permanent_disability"></td>
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
                        <div class="d-grid ps-3 flex-fill">
                            <div class="row ms-0">
                                <div class="col-8">
                                    <p class="text-center lead">DIRECT CONTRINBUTOR</p>
                                    <div class="row">

                                        {{-- employed private --}}
                                        <div class="col-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="employed_private" id="employed_private">
                                                <label class="form-check-label" for="employed_private">Employed Private</label>
                                            </div>
                                        </div>

                                        {{-- employed private --}}
                                        <div class="col-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="kasambahay" id="kasambahay">
                                                <label class="form-check-label" for="kasambahay">Kasambahay</label>
                                            </div>
                                        </div>

                                        {{-- employed private --}}
                                        <div class="col-4 ">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="family_driver" id="family_driver">
                                                <label class="form-check-label" for="family_driver">Family Driver</label>
                                            </div>
                                        </div>

                                        {{-- employed government --}}
                                        <div class="col-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="employed_government" id="employed_government">
                                                <label class="form-check-label" for="employed_government">Employed Government</label>
                                            </div>
                                        </div>

                                        {{-- migrant worker --}}
                                        <div class="col-8">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="migrant_worker" id="migrant_worker">
                                                <label class="form-check-label" for="migrant_worker">Migrant Worker</label>
                                            </div>
                                        </div>

                                        {{-- professional practitioner --}}
                                        <div class="col-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="professional_practitioner" id="professional_practitioner">
                                                <label class="form-check-label text-no-wrap" for="professional_practitioner">Professional Practitioner</label>
                                            </div>
                                        </div>

                                        <div class="col-8 ps-5">
                                            {{-- land based --}}
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" value="land_based" id="land_based">
                                                <label class="form-check-label" for="land_based">Land-Based</label>
                                            </div>
                                            {{-- sea based --}}
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" value="sea_based" id="sea_based">
                                                <label class="form-check-label" for="sea_based">Sea-Based</label>
                                            </div>
                                        </div>

                                        {{-- self earning individual --}}
                                        <div class="col-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="self_earning" id="self_earning">
                                                <label class="form-check-label" for="self_earning">Self-Earning Individual</label>
                                            </div>
                                        </div>

                                        {{-- lifetime member --}}
                                        <div class="col-8">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="lifetime" id="lifetime">
                                                <label class="form-check-label" for="lifetime">Lifetime Member</label>
                                            </div>
                                        </div>

                                        {{-- individual --}}
                                        <div class="col-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="individual" id="individual">
                                                <label class="form-check-label" for="individual">Individual</label>
                                            </div>
                                        </div>

                                        {{-- dual citizenship --}}
                                        <div class="col-8">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="dual_citizenship" id="dual_citizenship">
                                                <label class="form-check-label" for="dual_citizenship">Filipinos with Dual Citizenship</label>
                                            </div>
                                        </div>

                                        {{-- sole proprietor --}}
                                        <div class="col-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="sole_proprietor" id="sole_proprietor">
                                                <label class="form-check-label" for="sole_proprietor">Sole Proprietor</label>
                                            </div>
                                        </div>

                                        {{-- foreign national --}}
                                        <div class="col-8">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="foreign_national" id="foreign_national">
                                                <label class="form-check-label" for="foreign_national">Foreign National</label>
                                            </div>
                                        </div>

                                        {{-- group enrollment scheme --}}
                                        <div class="col-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="group_enrollment" id="group_enrollment">
                                                <label class="form-check-label" for="group_enrollment">Group Enrollment Scheme</label>
                                            </div>
                                        </div>

                                        {{-- pra SRRV no --}}
                                        <div class="col-8 ps-5">
                                            <div class="d-flex flex-row align-items-center gap-2">
                                                <label class="form-label mb-0 text-no-wrap" for="pra_ssrv_no">PRA SRRV No.</label>
                                                <input type="text" class="form-control form-control-sm" name="pra_ssrv_no" id="pra_ssrv_no">
                                            </div>
                                        </div>

                                        <div class="col-4 ps-5">
                                            <input type="text" class="form-control form-control-sm" name="group_enrollment_scheme">
                                        </div>

                                        {{-- acr i-card no --}}
                                        <div class="col-8 ps-5">
                                            <div class="d-flex flex-row align-items-center gap-2">
                                                <label class="form-label mb-0 text-no-wrap" for="acr_icard_no">ACR I-Card No.</label>
                                                <input type="text" class="form-control form-control-sm" name="acr_icard_no" id="acr_icard_no">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>

            </form>
        </div>
    </div>
@endsection

@section('script')
    <script></script>

@endsection
