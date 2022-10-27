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
            <form id="registration-form" class="d-flex flex-column px-3 pb-3 needs-validation" action="/pensions/apply/submit" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                @method('POST')

                <div class="d-grid gap-5">

                    {{-- basic information --}}
                    <div>
                        <div class="d-flex gap-3">
                            <h3>A. Background Informatio</h3>
                            <hr class="flex-fill">
                        </div>

                        <div class="row ps-3 g-3 flex-fill">
                            {{-- lastname --}}
                            <div class="col-6">
                                <label for="lastname" class="form-label text-info">Last name</label>
                                <input type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" id="lastname" value="{{ old('lastname') }}" required>
                                @error('lastname')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- firstname --}}
                            <div class="col-6">
                                <label for="firstname" class="form-label text-info">First name</label>
                                <input type="text" class="form-control @error('firstname') is-invalid @enderror" id="firstname" name="firstname" value="{{ old('firstname') }}" required>
                                @error('firstname')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- middlename --}}
                            <div class="col-6">
                                <label for="middlename" class="form-label text-info">Middle name</label>
                                <input type="text" class="form-control" id="middlename" name="middlename" value="{{ old('middlename') }}">
                            </div>

                            {{-- nhts=-pr hh ho. --}}
                            <div class="col-6">
                                <label for="nhts_pr_hh_no" class="form-label text-info">NHTS-PR HH No.</label>
                                <input type="text" class="form-control" id="nhts_pr_hh_no" name="nhts_pr_hh_no" value="{{ old('nhts_pr_hh_no') }}" required>
                            </div>

                            {{-- sex --}}
                            <div class="col-6">
                                <label for="sex" class="form-label text-info">Sex</label>
                                <select class="form-select @error('sex') is-invalid @enderror" id="sex" name="sex" required>
                                    <option value="" selected disabled>Select sex</option>
                                    <option value="male" {{ old('sex') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('sex') == 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('sex')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- civil status --}}
                            <div class="col-6">
                                <label for="civil_status" class="form-label text-info">Civil status</label>
                                <select class="form-select @error('civil_status') is-invalid @enderror" id="civil_status" name="civil_status" required>
                                    <option value="" selected disabled>Select status</option>
                                    @foreach (App\Models\Constants::CIVIL_STATUSES as $status)
                                        <option value="{{ $status }}" {{ old('civil_status') == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                                @error('civil_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- date of birth --}}
                            <div class="col-6">
                                <label for="date_of_birth" class="form-label text-info">Date of birth</label>
                                <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" class="form-select @error('date_of_birth') is-invalid @enderror">
                                @error('date_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- place of birth --}}
                            <div class="col-6">
                                <label for="place_of_birth" class="form-label text-info">Place of birth</label>
                                <input type="text" class="form-control @error('place_of_birth') is-invalid @enderror" name="place_of_birth" id="place_of_birth" value="{{ old('place_of_birth') }}" required>
                                @error('place_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- House number --}}
                            <div class="col-6">
                                <label for="house_no" class="form-label text-info">House no.</label>
                                <input type="text" class="form-control @error('hosue_no') is-invalid @enderror" id="house_no" name="house_no" value="{{ old('house_no') }}" required>
                                @error('house_no')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- street --}}
                            <div class="col-6">
                                <label for="street" class="form-label text-info">Street</label>
                                <input type="text" class="form-control @error('street') is-invalid @enderror" id="street" name="street" value="{{ old('street') }}" required>
                                @error('street')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- barangay --}}
                            <div class="col-6">
                                <label for="barangay" class="form-label text-info">Barangay</label>
                                <select class="form-select @error('barangay') is-invalid @enderror" name="barangay" id="barangay" required>
                                    <option value="" selected disabled>Select barangay</option>
                                    @foreach ($barangays as $barangay)
                                        <option value="{{ $barangay->id }}" {{ old('barangay') == $barangay->id ? 'selected' : '' }}>
                                            {{ $barangay->barangay_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('barangay')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- citizenship --}}
                            <div class="col-6">
                                <label for="citizenship" class="form-label text-info">Citizenship</label>
                                <input type="text" class="form-control @error('citizenship') is-invalid @enderror" id="citizenship" name="citizenship" value="{{ old('citizenship') }}" required>
                                @error('citizenship')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- citizenship --}}
                            <div class="col-6">
                                <label for="landline" class="form-label text-info">Landline</label>
                                <input type="text" class="form-control @error('landline') is-invalid @enderror" id="landline" name="landline" value="{{ old('landline') }}">
                                @error('landline')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- email --}}
                            <div class="col-6">
                                <label for="email" class="form-label text-info">E-mail</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- mobile_no --}}
                            <div class="col-6">
                                <label for="mobile_no" class="form-label text-info">Mobile No.</label>
                                <input type="text" class="form-control @error('mobile_no') is-invalid @enderror" id="mobile_no" name="mobile_no" value="{{ old('mobile_no') }}" pattern="(09)[0-9]{9}">
                                @error('mobile_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- affiliation --}}
                            <div class="col-12">
                                <div class="mb-2">
                                    <label class="form-check-label me-3 text-info">(Affiliation) Pls. Check</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input is-required-by" type="radio" name="pensioner" id="pensioner-yes" value="1">
                                        <label class="form-check-label" for="pensioner-yes">FSCAP</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input is-required-by" type="radio" name="pensioner" id="pensioner-no" value="0" checked>
                                        <label class="form-check-label" for="pensioner-no">COSE</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input is-required-by" type="radio" name="pensioner" id="pensioner-no" value="0" checked>
                                        <label class="form-check-label" for="pensioner-no">Others</label>
                                    </div>
                                </div>
                                <div class="d-grid gap-1 opacity-25 dependent" data-requires="pensioner">
                                    <div class="d-flex flex-row gap-2">
                                        <label class="text-nowrap" for="pensioner_amount">Specify</label>
                                        <input class="form-control form-control-sm @error('pensioner_amount') is-invalid @enderror" name="pensioner_amount" id="pensioner_amount" type="text" pattern="([1-9][0-9]*|0)" disabled>
                                    </div>
                                </div>
                                @error('pensioner_amount')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- osca id --}}
                            <div class="col-4">
                                <label for="osca_id" class="form-label text-info">OSCA ID.</label>
                                <input type="text" class="form-control @error('osca_id') is-invalid @enderror" id="osca_id" name="osca_id" value="{{ old('osca_id') }}" required>
                                @error('osca_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- issued_on --}}
                            <div class="col-4">
                                <label for="issued_on" class="form-label text-info">Issued on</label>
                                <input type="text" class="form-control @error('issued_on') is-invalid @enderror" id="issued_on" name="issued_on" value="{{ old('issued_on') }}" required>
                                @error('issued_on')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- issued_at --}}
                            <div class="col-4">
                                <label for="issued_at" class="form-label text-info">Issued at</label>
                                <input type="text" class="form-control @error('issued_at') is-invalid @enderror" id="issued_at" name="issued_at" value="{{ old('issued_at') }}" required>
                                @error('issued_at')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- living arrangement --}}
                            <div class="col-12">
                                <label class="form-label text-info">Living arrangement</label>
                                <div class="d-block">
                                    @foreach (App\Models\Constants::LIVING_ARRANGEMENTS as $key => $arrangement)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input  @error('living_arrangement') is-invalid @enderror" type="radio" name="living_arrangement" id="{{ "arrangement{$loop->iteration}" }}" value="{{ $key }}" {{ old('living_arrangement') == $key ? 'checked' : '' }} {{ $loop->first ? 'required' : '' }}>
                                            <label class="form-check-label" for="{{ "arrangement{$loop->iteration}" }}">{{ $arrangement }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                @error('living_arrangement')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- pensioner --}}
                            <div class="col-12">
                                <div class="mb-2">
                                    <label class="form-check-label me-3 text-info">If Pension: (Pls. Check)</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input is-required-by" type="radio" name="pensioner" id="pensioner-yes" value="1">
                                        <label class="form-check-label" for="pensioner-yes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input is-required-by" type="radio" name="pensioner" id="pensioner-no" value="0" checked>
                                        <label class="form-check-label" for="pensioner-no">No</label>
                                    </div>
                                </div>
                                <div class="d-grid gap-1 opacity-25 dependent" data-requires="pensioner">
                                    <div class="d-flex flex-row gap-2">
                                        <span>Source:</span>
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input @error('pension_source') is-invalid @enderror" type="radio" id="{{ $key }}" name="pensioner_source" value="{{ $key }}" disabled>
                                                <label class="form-check-label" for="{{ $key }}">GSIS</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input @error('pension_source') is-invalid @enderror" type="radio" id="{{ $key }}" name="pensioner_source" value="{{ $key }}" disabled>
                                                <label class="form-check-label" for="{{ $key }}">SSS</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input @error('pension_source') is-invalid @enderror" type="radio" id="{{ $key }}" name="pensioner_source" value="{{ $key }}" disabled>
                                                <label class="form-check-label" for="{{ $key }}">Private</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row gap-2">
                                        <label class="text-nowrap" for="pensioner_amount">If yes, how much?</label>
                                        <input class="form-control form-control-sm @error('pensioner_amount') is-invalid @enderror" name="pensioner_amount" id="pensioner_amount" type="text" pattern="([1-9][0-9]*|0)" disabled>
                                    </div>
                                </div>
                                @error('pensioner_amount')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                @error('pensioner_source')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{--  regular support from the family --}}
                            <div class="col-12">
                                <div class="mb-2">
                                    <label class="form-check-label me-3 text-info">If Non-Pensioner: are you receiving support family members/relative/friends?</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input is-required-by" type="radio" name="regular_support_from_family" id="family-support-yes" value="1">
                                        <label class="form-check-label" for="family-support-yes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input is-required-by" type="radio" name="regular_support_from_family" id="family-support-no" value="0" checked>
                                        <label class="form-check-label" for="family-support-no">No</label>
                                    </div>
                                </div>
                                <div class="d-grid gap-1 opacity-25 dependent" data-requires="regular_support_from_family">
                                    <div class="d-flex flex-column gap-2">
                                        <label for="source_of_income">If yes, from what source?</label>
                                        <div class="d-block">
                                            <div class="form-check">
                                                <input class="form-check-input @error('type_of_support') is-invalid @enderror" type="radio" value="cash" id="type_of_support1" name="type_of_support">
                                                <label class="form-check-label" for="type_of_support1">
                                                    Cash
                                                </label>
                                                <div class="d-flex flex-row gap-2">
                                                    <label for="support_cash_amount" class="text-nowrap">How much?</label>
                                                    <input class="form-control form-control-sm d-inline @error('support_cash_amount') is-invalid @enderror" name="support_cash_amount" id="support_cash_amount" type="text" disabled>

                                                </div>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input @error('type_of_support') is-invalid @enderror" type="radio" value="kind" id="type_of_support2" name="type_of_support" disabled>
                                                <label class="form-check-label" for="type_of_support2">
                                                    Kind
                                                </label>
                                                <div class="d-flex flex-row gap-2">
                                                    <label for="support_kind_specify" class="text-nowrap">Specify?</label>
                                                    <input class="form-control form-control-sm d-inline @error('support_kind_specify') is-invalid @enderror" name="support_kind_specify" id="support_kind_specify" type="text" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @error('type_of_support')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                @error('support_cash_amount')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                @error('support_kind_specify')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                @error('source_of_income')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- meals per day --}}
                            <div class="col-12">
                                <label class="form-label text-info">How many meals do you have in a day?</label>
                                <div class="d-block">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input  @error('meals_per_day') is-invalid @enderror" type="radio" name="meals_per_day" id="three_meals" value="3" {{ old('meals_per_day') == 3 ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="three_meals">Three meals (3)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input  @error('meals_per_day') is-invalid @enderror" type="radio" name="meals_per_day" id="two_meals" value="2" {{ old('meals_per_day') == 2 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="two_meals">Two meals (2)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input  @error('meals_per_day') is-invalid @enderror" type="radio" name="meals_per_day" id="one_meal" value="1" {{ old('meals_per_day') == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="one_meal">One meal (1)</label>
                                    </div>
                                </div>
                                @error('meals_per_day')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- have disability --}}
                            <div class="col-12">
                                <div class="mb-2">
                                    <label class="form-check-label me-3 text-info">Do you have disability?</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input is-required-by" type="radio" name="has_existing_illness" id="has_existing_illness-yes" value="1">
                                        <label class="form-check-label" for="has_existing_illness-yes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input is-required-by" type="radio" name="has_existing_illness" id="has_existing_illness-no" value="0" checked>
                                        <label class="form-check-label" for="has_existing_illness-no">No</label>
                                    </div>
                                </div>
                                <div class="d-grid gap-1 opacity-25 dependent" data-requires="has_existing_illness">
                                    <div class="d-flex flex-row gap-2">
                                        <label class="text-nowrap" for="specify_illness">If yes, what type (i.e blind, deaf)</label>
                                        <input class="form-control form-control-sm @error('specify_illness') is-invalid @enderror" name="specify_illness" id="specify_illness" type="text" pattern="([1-9][0-9]*|0)" disabled>
                                        @error('specify_illness')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- is immobile --}}
                            <div class="col-12">
                                <label class="form-label text-info">Are you immobile?</label>
                                <div class="d-block">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input  @error('is_immobile') is-invalid @enderror" type="radio" name="is_immobile" id="bedridden" value="bedridden" {{ old('is_immobile') == 'bedridden' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="three_meals">Bedridden</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input  @error('is_immobile') is-invalid @enderror" type="radio" name="is_immobile" id="dependent" value="dependent" {{ old('is_immobile') == 'dependent' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="two_meals">Depdendent on assistive device</label>
                                    </div>
                                </div>
                                @error('meals_per_day')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- pre existing illnesses --}}
                            <div class="col-12">
                                <label for="pre_existing_illnesses" class="form-label text-info">Do you have pre-existing illnesses? (i.e. hypertension, diabetes, arthritis)</label>
                                <input type="text" class="form-control @error('pre_existing_illnesses') is-invalid @enderror" id="pre_existing_illnesses" name="pre_existing_illnesses" value="{{ old('pre_existing_illnesses') }}">
                                @error('pre_existing_illnesses')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        
                        </div>

                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#picture-upload').on('change', function() {
            const [file] = this.files
            if (file) $('#picture-placeholder').attr('src', URL.createObjectURL(file))
        })

        $('.is-required-by').on('change', function() {
            let dependentElement = $(`.dependent[data-requires="${this.name}"]`).get(0);
            console.dir(dependentElement)
            if (this.value === '1') {
                $(dependentElement).removeClass('opacity-25')
                $(dependentElement).find('input').prop("disabled", false)
            } else {
                $(dependentElement).find('input').val('')
                $(dependentElement).find('input[type=checkbox]').prop('checked', false)
                $(dependentElement).find('input[type=radio]').prop('checked', false)
                $(dependentElement).addClass('opacity-25')
                $(dependentElement).find('input').prop("disabled", true)
            }
        })
    </script>

@endsection
