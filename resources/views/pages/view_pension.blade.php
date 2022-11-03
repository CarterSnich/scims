@extends('layouts.dashboard_layout')

@section('title', 'View Social Pension Application')

@section('content')
    <style>
        #main {
            display: flex;
            flex-flow: column;
            height: 100%;
        }

        #data-wrapper {
            display: block;
            overflow-y: auto;
            overflow-x: hidden
        }

        #picture-placeholder {
            min-height: 200px;
            min-width: 200px;
            max-height: 200px;
            max-width: 200px;
            aspect-ratio: 1/1
        }
    </style>
    {{-- main content --}}
    <div id="main">
        {{-- page header --}}
        <div class="d-flex justify-content-between">
            <div class="d-flex gap-2">
                {{-- go back button --}}
                <a href="/pensions" class="btn btn-secondary" data-has-tooltip="true" data-bs-placement="bottom" title="Go back">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                    </svg>
                    <span class="visually-hidden">Go back</span>
                </a>
                <h2 class="my-auto ">Social Pension Application </h2>
            </div>

            {{-- button toolbar --}}
            <div class="btn-toolbar gap-2" role="toolbar">
                <div class="btn-group me" role="group">
                    {{-- update button --}}
                    {{-- <a href="/pensions/{{ $pension['id'] }}/edit" class="btn btn-secondary" data-has-tooltip="true" data-bs-placement="bottom" title="Update">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"></path>
                        </svg>
                        <span class="visually-hidden">Update</span>
                    </a> --}}
                    {{-- print button --}}
                    {{-- <a href="/print/pension/{{ $pension['id'] }}" id="print-button" class="btn btn-secondary" data-has-tooltip="true" data-bs-placement="bottom" title="Print" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                            <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                            <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                        </svg>
                        <span class="visually-hidden">Print</span>
                    </a> --}}
                </div>
            </div>

        </div>
        <hr style="min-height: 1px">
        {{-- data wrapper --}}

        <div id="data-wrapper" class="px-3 pb-3">

            <div class="d-grid gap-5">

                {{-- I. Basic Information --}}
                <div>
                    <div class="d-flex gap-3">
                        <h3>I. Basic information</h3>
                        <hr class="flex-fill">
                    </div>

                    <div class="d-flex gap-3 ps-3">

                        <div class="row g-3 flex-fill">

                            {{-- lastname --}}
                            <div class="col-6">
                                <label for="lastname" class="form-label text-info">Last name</label>
                                <p class="fs-3 px-1 m-0 border-bottom border-secondary">{{ $pension->lastname }}</p>
                            </div>

                            {{-- firstname --}}
                            <div class="col-6">
                                <label for="firstname" class="form-label text-info">First name</label>
                                <p class="fs-3 px-1 m-0 border-bottom border-secondary">{{ $pension->firstname }}</p>
                            </div>

                            {{-- middlename --}}
                            <div class="col-6">
                                <label for="middlename" class="form-label text-info">Middle name</label>
                                <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                    @if ($pension->middlename)
                                        {{ $pension->middlename }}
                                    @else
                                        <i class="text-muted">N/A</i>
                                    @endif
                                </p>
                            </div>

                        </div>

                        {{-- picture --}}
                        <div class="d-flex">
                            <img id="picture-placeholder" class="rounded d-block img-thumbnail mb-auto" src="{{ asset("storage/pension-pictures/{$pension->picture}") }}">
                        </div>

                    </div>

                    <div class="d-flex gap-3 ps-3">

                        <diw class="row g-3 flex-fill">

                            {{-- citizenship --}}
                            <div class="col-6">
                                <label for="citizenship" class="form-label text-info">Citizenship</label>
                                <p class="fs-3 px-1 m-0 border-bottom border-secondary">{{ $pension->citizenship }}</p>
                            </div>

                            {{-- age --}}
                            <div class="col-6">
                                <label for="age" class="form-label text-info">Age</label>
                                <p class="fs-3 px-1 m-0 border-bottom border-secondary">{{ $pension->age }} years old</p>
                            </div>

                            {{-- date of birth --}}
                            <div class="col-6">
                                <label for="date_of_birth" class="form-label text-info">Birthdate</label>
                                <p class="fs-3 px-1 m-0 border-bottom border-secondary">{{ $pension->date_of_birth }}</p>
                            </div>

                            {{-- place of birth --}}
                            <div class="col-6">
                                <label for="date_of_birth" class="form-label text-info">Birthplace</label>
                                <p class="fs-3 px-1 m-0 border-bottom border-secondary">{{ $pension->place_of_birth }}</p>
                            </div>

                            {{-- sex --}}
                            <div class="col-6">
                                <label for="sex" class="form-label text-info">Sex</label>
                                <p class="fs-3 px-1 m-0 border-bottom border-secondary">{{ Str::ucfirst($pension->sex) }}</p>
                            </div>

                            {{-- Civil status --}}
                            <div class="col-6">
                                <label for="civil_status" class="form-label text-info">Civil status</label>
                                <p class="fs-3 px-1 m-0 border-bottom border-secondary">{{ ucfirst($pension->civil_status) }}</p>
                            </div>

                            {{-- address --}}
                            <div class="col-6">
                                <label for="house_no" class="form-label text-info">House no.</label>
                                <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                    {{ "{$pension->house_no}, " }} {{ "{$pension->street}, " }} {{ $barangay->barangay_name }}
                                </p>
                            </div>

                            {{-- no. of years stay --}}
                            <div class="col-6">
                                <label for="no_of_years_stay" class="form-label text-info">No. of years</label>
                                <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                    {{ $pension->no_of_years_stay }}
                                </p>
                            </div>

                            {{-- living arrangement --}}
                            <div class="col-6">
                                <label for="living_arrangement" class="form-label text-info">Living arrangement</label>
                                <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                    {{ $living_arrangement }}
                                </p>
                            </div>

                        </diw>
                    </div>
                </div>


                {{-- economic status --}}
                <div>
                    <div class="d-flex gap-3">
                        <h3>II. Economic Status</h3>
                        <hr class="flex-fill">
                    </div>

                    <div class="row ps-3 g-3 flex-fill">

                        {{-- pensioner --}}
                        <div class="col-4">
                            <label for="pensioner" class="form-label text-info">Pensioner?</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                {{ $pension->pensioner ? 'Yes' : 'No' }}
                            </p>
                        </div>

                        {{-- pension amount --}}
                        <div class="col-4">
                            <label for="pensioner_amount" class="form-label text-info">Amount</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                @if ($pension->pensioner_amount)
                                    {{ $pension->pensioner_amount }}
                                @else
                                    <i class="text-muted">N/A</i>
                                @endif
                            </p>
                        </div>

                        {{-- pensioner source --}}
                        <div class="col-4">
                            <label for="pensioner_source" class="form-label text-info">Pensioner source</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                @if ($pensioner_source)
                                    {{ $pensioner_source }}
                                @else
                                    <i class="text-muted">N/A</i>
                                @endif
                            </p>
                        </div>

                        {{-- permanent_source_of_income --}}
                        <div class="col-4">
                            <label for="permanent_source_of_income" class="form-label text-info">Permanent source of income?</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                {{ $pension->permanent_source_of_income ? 'Yes' : 'No' }}
                            </p>
                        </div>

                        {{-- source_of_income --}}
                        <div class="col-8">
                            <label for="source_of_income" class="form-label text-info">Source of income</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                @if ($pension->source_of_income)
                                    {{ $pension->source_of_income }}
                                @else
                                    <i class="text-muted">N/A</i>
                                @endif
                            </p>
                        </div>

                        {{-- regular support from family --}}
                        <div class="col-4">
                            <label for="regular_support_from_family" class="form-label text-info">Regular Support from Family?</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                {{ $pension->regular_support_from_family ? 'Yes' : 'No' }}
                            </p>
                        </div>

                        {{-- type of support --}}
                        <div class="col-2">
                            <label for="address" class="form-label text-info">Type of support</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                @if ($pension->type_of_support)
                                    {{ Str::ucfirst($pension->type_of_support) }}
                                @else
                                    <i class="text-muted">N/A</i>
                                @endif
                            </p>
                        </div>


                        @if ($pension->type_of_support === 'cash')
                            {{-- support cash amount --}}
                            <div class="col-6">
                                <label for="support_cash_amount" class="form-label text-info">Support cash amount</label>
                                <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                    P {{ $pension->support_cash_amount }}
                                </p>
                            </div>
                        @else
                            {{-- support kind specify --}}
                            <div class="col-6">
                                <label for="support_kind_specify" class="form-label text-info">Support kind specify</label>
                                <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                    {{ $pension->support_kind_specify }}
                                </p>
                            </div>
                        @endif


                        {{-- how often --}}
                        <div class="col-12">
                            <label for="how_often" class="form-label text-info">How often?</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                @if ($pension->regular_support_from_family)
                                    {{ $pension->how_often }}
                                @else
                                    <i class="text-muted">N/A</i>
                                @endif
                            </p>
                        </div>

                    </div>

                </div>


                {{-- III. Health Condition --}}
                <div>
                    <div class="d-flex gap-3">
                        <h3>III. Health Condition</h3>
                        <hr class="flex-fill">
                    </div>

                    <div class="row ps-3 g-3 flex-fill">

                        {{-- has_existing_illness --}}
                        <div class="col-4">
                            <label for="has_existing_illness" class="form-label text-info">Has existing illness?</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                {{ $pension->has_existing_illness ? 'Yes' : 'No' }}
                            </p>
                        </div>

                        {{-- specify_illness --}}
                        <div class="col-12">
                            <label for="specify_illness" class="form-label text-info">Specify type of illness/ilnesses</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                @if ($pension->specify_illness)
                                    {{ $pension->specify_illness }}
                                @else
                                    <i class="text-muted">N/A</i>
                                @endif
                            </p>
                        </div>

                        {{-- specify_illness --}}
                        <div class="col-4">
                            <label for="specify_illness" class="form-label text-info">Hospotalized within the last six months?</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                {{ $pension->hospitalized_in_last_six_months ? 'Yes' : 'No' }}
                            </p>
                        </div>



                    </div>
                </div>

            </div>
        </div>

    </div>


@endsection

@section('script')
    <script>
        (function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-has-tooltip="true"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        })()
    </script>
@endsection
