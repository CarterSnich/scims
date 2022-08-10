@extends('layouts.dashboard_layout')

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
                <h2 class="my-auto">
                    {{ $citizen['lastname'] }}, {{ $citizen['firstname'] }} {{ $citizen['middlename'] }}
                </h2>
            </div>
            {{-- button toolbar --}}
            <div class="btn-toolbar" role="toolbar">
                <div class="btn-group me-2" role="group">
                    {{-- update button --}}
                    <a href="/citizens/{{ $citizen['id'] }}/edit" class="btn btn-secondary" data-has-tooltip="true" data-bs-placement="bottom" title="Update">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"></path>
                        </svg>
                        <span class="visually-hidden">Update</span>
                    </a>
                    {{-- print button --}}
                    <a href="/citizens/{{ $citizen['id'] }}/print" id="print-button" class="btn btn-secondary" data-has-tooltip="true" data-bs-placement="bottom" title="Print" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                            <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                            <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                        </svg>
                        <span class="visually-hidden">Print</span>
                    </a>
                </div>
                <div class="btn-group" role="group" aria-label="Third group">
                    {{-- button delist/remove --}}
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-modal" data-has-tooltip="true" data-bs-placement="bottom" title="Delist">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                        </svg>
                        <span class="visually-hidden">Delete</span>
                    </button>
                </div>
            </div>
        </div>
        <hr style="min-height: 1px">
        {{-- data wrapper --}}
        <div id="data-wrapper" class="bg-dark">
            <div class="px-3 pb-3 gap-5">

                <div class="d-flex">
                    <h3 class="h3 mb-0 me-3">Personal information</h3>
                    <hr class="flex-fill">
                </div>

                <div class="d-flex ps-5 pt-3">
                    {{-- personal information --}}
                    <div class="flex-fill d-grid gap-3">

                        {{-- lastname --}}
                        <div class="row">
                            <div class="col-4">
                                <label for="lastname" class="h3 form-label text-info">Last name</label>
                            </div>
                            <div class="col-8">
                                <h3 id="lastname" class="border-bottom">{{ $citizen['lastname'] }}</h3>
                            </div>
                        </div>

                        {{-- firstname --}}
                        <div class="row">
                            <div class="col-4">
                                <label for="firstname" class="h3 form-label text-info">First name</label>
                            </div>
                            <div class="col-8">
                                <h3 id="firstname" class="border-bottom">{{ $citizen['firstname'] }}</h3>
                            </div>
                        </div>

                        {{-- middlename --}}
                        <div class="row">
                            <div class="col-4">
                                <label for="middlename" class="h3 form-label text-info">Middle name</label>
                            </div>
                            <div class="col-8">
                                @if ($citizen['middlename'])
                                    <h3 id="middlename" class="border-bottom">{{ $citizen['middlename'] }}</h3>
                                @else
                                    <h3 id="middlename" class="text-muted border-bottom">N/A</h3>
                                @endif
                            </div>
                        </div>

                        {{-- birthdate --}}
                        <div class="row">
                            <div class="col-4">
                                <label for="birthdate" class="h3 form-label text-info">Date of birth</label>
                            </div>
                            <div class="col-8">
                                <h3 id="birthdate" class="border-bottom">
                                    {{ date('F j, Y', strtotime($citizen['birthdate'])) }}
                                </h3>
                            </div>
                        </div>

                        {{-- gender --}}
                        <div class="row">
                            <div class="col-4">
                                <label for="gender" class="h3 form-label text-info">Gender</label>
                            </div>
                            <div class="col-8">
                                <h3 id="gender" class="border-bottom">
                                    {{ ucfirst($citizen['gender']) }}
                                </h3>
                            </div>
                        </div>

                        {{-- age --}}
                        <div class="row">
                            <div class="col-4">
                                <label for="age" class="h3 form-label text-info">Age</label>
                            </div>
                            <div class="col-8">
                                <h3 id="age" class="border-bottom">
                                    {{ $citizen['age'] }}
                                </h3>
                            </div>
                        </div>

                        {{-- marital status --}}
                        <div class="row">
                            <div class="col-4">
                                <label for="marital_status" class="h3 form-label text-info">Marital status</label>
                            </div>
                            <div class="col-8">
                                <h3 id="marital_status" class="border-bottom">
                                    {{ ucfirst($citizen['marital_status']) }}
                                </h3>
                            </div>
                        </div>

                        {{-- barangay --}}
                        <div class="row">
                            <div class="col-4">
                                <label for="barangay" class="h3 form-label text-info">Barangay</label>
                            </div>
                            <div class="col-8">
                                @if ($barangay)
                                    <h3 id="barangay" class="border-bottom">
                                        Brgy. {{ $barangay['barangay_name'] }}
                                    </h3>
                                @else
                                    <h3 id="barangay" class="border-bottom text-muted">N/A</h3>
                                @endif
                            </div>
                        </div>

                        {{-- province --}}
                        <div class="row">
                            <div class="col-4">
                                <label for="province" class="h3 text-info">Province</label>
                            </div>
                            <div class="col-8">
                                <h3 id="province" class="border-bottom">
                                    {{ $citizen['province'] }}
                                </h3>
                            </div>
                        </div>

                    </div>

                    {{-- picture wrapper --}}
                    <div class="d-flex flex-column gap-2 mx-5">

                        {{-- picture --}}
                        <div class="border p-1 bg-white rounded">
                            <img src="{{ asset("storage/pictures/{$citizen['picture']}") }}" alt="" height="200" width="200">
                        </div>

                        {{-- senior citizen ID --}}
                        <h3 class="mx-auto">
                            <strong class="text-primary">#{{ $citizen['citizenId'] }}</strong>
                        </h3>
                    </div>

                </div>


            </div>
        </div>

    </div>

    {{-- delete confirmation modal --}}
    <div class="modal fade text-dark" id="delete-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove citizen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="delete-form" method="POST" action="/citizens/{{ $citizen['id'] }}/delete">
                        @csrf
                        @method('DELETE')
                        <h4>Remove Senior Citizen #{{ date('Y', strtotime($citizen['created_at'])) . '-' . str_pad($citizen['id'], 5, '0', STR_PAD_LEFT) }}?</h4>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" form="delete-form">Remove</button>
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
