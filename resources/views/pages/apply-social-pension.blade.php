@extends('layouts.dashboard_layout')

@section('title', 'Social Pension Application')

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
                            <h3>I. Basic information</h3>
                            <hr class="flex-fill">
                        </div>
                        <div class="d-flex gap-3 ps-3">
                            <div class="flex-fill d-flex flex-column gap-3">
                                <div class="row g-3">

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
                                </div>

                                <div class="row g-3">
                                    {{-- middlename --}}
                                    <div class="col-6">
                                        <label for="middlename" class="form-label text-info">Middle name</label>
                                        <input type="text" class="form-control" id="middlename" name="middlename" value="{{ old('middlename') }}">
                                    </div>
                                </div>

                            </div>

                            {{-- picture --}}
                            <div class="d-flex flex-column gap-2">
                                <div class="mb-auto">
                                    <img id="picture-placeholder" class="mt-auto mx-auto rounded d-block" height="200" width="200">
                                </div>
                                <div class="d-flex flex-column gap-2">
                                    <input type="file" accept="image/*" class="d-none form-control @error('picture') is-invalid @enderror" name="picture" id="picture-upload" required>
                                    <label class="btn btn-secondary d-block" for="picture-upload" tabindex="0">Upload</label>
                                    @error('picture')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>


                        <div class="row ps-3 g-3 flex-fill">

                            {{-- citizenship --}}
                            <div class="col-6">
                                <label for="citizenship" class="form-label text-info">Citizenship</label>
                                <input type="text" class="form-control @error('citizenship') is-invalid @enderror" id="citizenship" name="citizenship" value="{{ old('citizenship') }}" required>
                                @error('citizenship')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- age --}}
                            <div class="col-6">
                                <label for="age" class="form-label text-info">Age</label>
                                <input type="text" class="form-control @error('age') is-invalid @enderror" id="age" name="age" value="{{ old('age') }}" pattern="^([6-9]|(10))[0-9]+" required>
                                @error('age')
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

                            {{-- no of years stay --}}
                            <div class="col-6">
                                <label for="no_of_years_stay" class="form-label text-info">No. of years</label>
                                <input type="text" class="form-control @error('no_of_years_stay') is-invalid @enderror" id="no_of_years_stay" name="no_of_years_stay" value="{{ old('no_of_years_stay') }}" pattern="([1-9][0-9]*|0)" required>
                                @error('no_of_years_stay')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- living arrangement --}}
                            <div class="col-6">
                                <label class="form-label text-info">Living arrangement</label>
                                <div class="block">
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
                        </div>

                    </div>

                    {{-- economic status --}}
                    <div>
                        <div class="d-flex gap-3">
                            <h3>Economic status</h3>
                            <hr class="flex-fill">
                        </div>

                        <div class="row ps-3 g-3 flex-fill">

                            {{-- pensioner --}}
                            <div class="col-12">
                                <div class="mb-2">
                                    <label class="form-check-label me-3">
                                        Pensioner
                                    </label>
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
                                        <label class="text-nowrap" for="pensioner_amount">If yes, how much?</label>
                                        <input class="form-control form-control-sm @error('pensioner_amount') is-invalid @enderror" name="pensioner_amount" id="pensioner_amount" type="text" pattern="([1-9][0-9]*|0)" disabled>

                                    </div>
                                    <div class="d-flex flex-row gap-2">
                                        <span>Source:</span>
                                        <div>
                                            @foreach (App\Models\Constants::PENSIONER_SOURCES as $key => $source)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input @error('pension_source') is-invalid @enderror" type="radio" id="{{ $key }}" name="pensioner_source" value="{{ $key }}" disabled>
                                                    <label class="form-check-label" for="{{ $key }}">{{ $source }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @error('pensioner_amount')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                @error('pensioner_source')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            {{-- permanent_source_of_income --}}
                            <div class="col-12">
                                <div class="mb-2">
                                    <label class="form-check-label me-3">
                                        Permanent source of income
                                    </label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input is-required-by" type="radio" name="permanent_source_of_income" id="permanent_source_of_income-yes" value="1">
                                        <label class="form-check-label" for="permanent_source_of_income-yes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input is-required-by" type="radio" name="permanent_source_of_income" id="permanent_source_of_income-no" value="0" checked>
                                        <label class="form-check-label" for="permanent_source_of_income-no">No</label>
                                    </div>
                                </div>
                                <div class="d-grid gap-1 opacity-25 dependent" data-requires="permanent_source_of_income">
                                    <div class="d-flex flex-row gap-2">
                                        <label class="text-nowrap" for="source_of_income">If yes, from what source?</label>
                                        <input class="form-control form-control-sm @error('source_of_income') is-invalid @enderror" name="source_of_income" type="text" disabled>
                                        @error('source_of_income')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            {{--  regular support from the family --}}
                            <div class="col-12">
                                <div class="mb-2">
                                    <label class="form-check-label me-3">
                                        Regular Support form Family
                                    </label>
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
                                        <div class="d-flex flex-row gap-2">
                                            <label for="how_often" class="text-nowrap">How often?</label>
                                            <input type="text" class="form-control form-control-sm" name="how_often" id="how_often" disabled>
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

                        </div>
                    </div>


                    {{-- health condition --}}
                    <div>
                        <div class="d-flex gap-3">
                            <h3>Health Condition</h3>
                            <hr class="flex-fill">
                        </div>

                        <div class="row ps-3 g-3 flex-fill">

                            {{-- has_existing_illnes --}}
                            <div class="col-12">
                                <div class="mb-2">
                                    <label class="form-check-label me-3">
                                        Has existing illness?
                                    </label>
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
                                        <label class="text-nowrap" for="specify_illness">Specify type of illness/ilnesses?</label>
                                        <input class="form-control form-control-sm @error('specify_illness') is-invalid @enderror" name="specify_illness" id="specify_illness" type="text" pattern="([1-9][0-9]*|0)" disabled>
                                        @error('specify_illness')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- hospitalized_in_last_six_months --}}
                            <div class="col-12">
                                <div class="mb-2">
                                    <label class="form-check-label me-3">
                                        Hospitalized within the last six months?
                                    </label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('hospitalized_in_last_six_months') is-invalid @enderror" type="radio" name="hospitalized_in_last_six_months" id="hospitalized-yes" value="1">
                                        <label class="form-check-label" for="hospitalized-yes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input is-required-by" type="radio" name="hospitalized_in_last_six_months" id="hospitalized-no" value="0" checked>
                                        <label class="form-check-label" for="hospitalized-no">No</label>
                                    </div>
                                </div>
                                @error('hospitalized_in_last_six_months')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    {{-- confirmation cancel registration --}}
    <div class="modal fade" id="confirm-exit-modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content text-dark">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm cancel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to cancel registration?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="/citizens" class="btn btn-primary">Okay</a>
                </div>
            </div>
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
