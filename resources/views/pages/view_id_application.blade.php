@extends('layouts.dashboard_layout')

@section('title', 'View ID Application')

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
                <a href="/citizens" class="btn btn-secondary" data-has-tooltip="true" data-bs-placement="bottom" title="Go back">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                    </svg>
                    <span class="visually-hidden">Go back</span>
                </a>
                <h2 class="my-auto ">
                    ID Application: <span class="text-primary">{{ \App\Models\IdApplication::PURPOSE[$application->purpose] }}</span>
                </h2>
            </div>

            {{-- button toolbar --}}
            <div class="btn-toolbar d-flex gap-2" role="toolbar">

                <div class="btn-group" role="group">

                </div>

            </div>

        </div>

        <hr style="min-height: 1px">

        {{-- data wrapper --}}
        <div id="data-wrapper" class="bg-dark px-3 pb-3">

            <div class="d-grid gap-5">

                {{-- Application details --}}
                <div>
                    <div class="d-flex gap-3">
                        <h3>Application details</h3>
                        <hr class="flex-fill">
                    </div>

                    <div class="row ps-3 g-3 flex-fill">

                        {{-- date applied --}}
                        <div class="col-4">
                            <label for="date_applied" class="form-label text-info">Date applied</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                {{ date('F j, Y', strtotime($application->date_applied)) }}
                            </p>
                        </div>

                        {{-- osca id --}}
                        <div class="col-4">
                            <label for="osca_id" class="form-label text-info">OSCA ID #</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                {{ $application->osca_id }}
                            </p>
                        </div>

                        {{-- date issued --}}
                        <div class="col-4">
                            <label for="date_issued" class="form-label text-info">Date issued</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                {{ $application->date_issued }}
                            </p>
                        </div>

                    </div>

                </div>


                {{-- Applicant information --}}
                <div>
                    <div class="d-flex gap-3">
                        <h3>Applicant information</h3>
                        <hr class="flex-fill">
                    </div>

                    <div class="row ps-3 g-3 flex-fill">
                        {{-- lastname --}}
                        <div class="col-4">
                            <label for="lastname" class="form-label text-info">Last name</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                {{ $citizen->lastname }}
                            </p>
                        </div>

                        {{-- firstname --}}
                        <div class="col-4">
                            <label for="firstname" class="form-label text-info">First name</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                {{ $citizen->firstname }}
                            </p>
                        </div>

                        {{-- middlename --}}
                        <div class="col-4">
                            <label for="middlename" class="form-label text-info">Middle name</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                @if ($citizen->middlename)
                                    {{ $citizen->middlename }}
                                @else
                                    <i class="text-muted">N/A</i>
                                @endif
                            </p>
                        </div>

                        {{-- barangay --}}
                        <div class="col-6">
                            <label for="barangay_name" class="form-label text-info">Barangay</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                {{ $barangay->barangay_name }}
                            </p>
                        </div>

                        {{-- province --}}
                        <div class="col-6">
                            <label for="province" class="form-label text-info">Province</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                {{ $citizen->province }}
                            </p>
                        </div>

                        {{-- date of birth --}}
                        <div class="col-4">
                            <label for="birthdate" class="form-label text-info">Date of birth</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                {{ date('F j, Y', strtotime($citizen->birthdate)) }}
                            </p>
                        </div>

                        {{-- age --}}
                        <div class="col-4">
                            <label for="age" class="form-label text-info">Age</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                {{ $citizen->age }} yrs. old
                            </p>
                        </div>

                        {{-- marital status --}}
                        <div class="col-4">
                            <label for="marital_status" class="form-label text-info">Marital status</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                {{ ucfirst($citizen->marital_status) }}
                            </p>
                        </div>

                    </div>

                </div>

                @if ($application->purpose == 'replacement')
                    {{-- for replacement --}}
                    <div>
                        <div class="d-flex gap-3">
                            <h3>For Replacement</h3>
                            <hr class="flex-fill">
                        </div>

                        <div class="row ps-3 g-3 flex-fill">
                            {{-- Reasons --}}
                            <div class="col-12">
                                <label for="lastname" class="form-label text-info">Reasons</label>
                                <div class="container-fluid">
                                    <div class="row row-cols-3">
                                        @foreach ($application->replacement_reasons as $reason)
                                            @if ($reason == 'others')
                                                <div class="col-12 d-flex gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square my-auto" viewBox="0 0 16 16">
                                                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                                        <path d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.235.235 0 0 1 .02-.022z" />
                                                    </svg>
                                                    <span>
                                                        <p class="fs-3 px-1 m-0">
                                                            Others: <span class="border-bottom border-secondary">{{ $application->replacement_reason_others }}</span>
                                                        </p>
                                                    </span>
                                                </div>
                                            @else
                                                <div class="col d-flex gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square my-auto" viewBox="0 0 16 16">
                                                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                                        <path d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.235.235 0 0 1 .02-.022z" />
                                                    </svg>
                                                    <span>
                                                        <p class="fs-3 px-1 m-0">
                                                            {{ \App\Models\IdApplication::REPLACEMENT_REASON[$reason] }}
                                                        </p>
                                                    </span>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                @endif

                @if ($application->purpose == 'lost_id')
                    {{-- for lost id --}}
                    <div>
                        <div class="d-flex gap-3">
                            <h3>For Lost ID</h3>
                            <hr class="flex-fill">
                        </div>

                        <div class="row ps-3 g-3 flex-fill">
                            {{-- date of loss --}}
                            <div class="col-4">
                                <label for="date_of_loss" class="form-label text-info">Date of Loss</label>
                                <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                    {{ date('F j, Y', strtotime($application->date_of_loss)) }}
                                </p>
                            </div>

                            {{-- lost location --}}
                            <div class="col-8">
                                <label for="lost_location" class="form-label text-info">Where</label>
                                <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                    {{ $application->lost_location }}
                                </p>
                            </div>

                        </div>

                    </div>
                @endif

                @if ($application->purpose == 'transferee')
                    {{-- for transferee --}}
                    <div>
                        <div class="d-flex gap-3">
                            <h3>For Transferee</h3>
                            <hr class="flex-fill">
                        </div>

                        <div class="row ps-3 g-3 flex-fill">
                            {{-- transfer from --}}
                            <div class="col-6">
                                <label for="transfer_from" class="form-label text-info">Transfer from</label>
                                <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                    {{ $application->transfer_from }}
                                </p>
                            </div>

                            {{-- transer to --}}
                            <div class="col-6">
                                <label for="transfer_to" class="form-label text-info">Transfer to</label>
                                <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                    {{ $application->transfer_from }}
                                </p>
                            </div>

                            {{-- transer reason --}}
                            <div class="col-6">
                                <label for="transfer_reason" class="form-label text-info">Transfer reason</label>
                                <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                    {{ $application->transfer_reason }}
                                </p>
                            </div>

                        </div>

                    </div>
                @endif

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
