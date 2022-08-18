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
                    Senior Citizen <span class="text-primary">#{{ $citizen->citizen_id }}</span>
                    @if ($citizen->is_delisted)
                        <code class="fs-5 text-danger">DELISTED</code>
                    @endif
                </h2>
            </div>

            {{-- button toolbar --}}
            <div class="btn-toolbar" role="toolbar">
                <div class="btn-group me-2" role="group">
                    {{-- update button --}}
                    @unless($citizen->is_delisted || auth()->user()->type !== 'admin')
                        <a href="/citizens/{{ $citizen['id'] }}/edit" class="btn btn-secondary" data-has-tooltip="true" data-bs-placement="bottom" title="Update">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"></path>
                            </svg>
                            <span class="visually-hidden">Update</span>
                        </a>
                    @endunless
                    {{-- print button --}}
                    <a href="/print/citizen/{{ $citizen['id'] }}" id="print-button" class="btn btn-secondary" data-has-tooltip="true" data-bs-placement="bottom" title="Print" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                            <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                            <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                        </svg>
                        <span class="visually-hidden">Print</span>
                    </a>
                    {{-- apply ID --}}
                    @unless($citizen->is_delisted || auth()->user()->type !== 'staff')
                        <a href="/id_applications/apply/{{ $citizen->id }}" id="apply-id-button" class="btn btn-secondary" data-has-tooltip="true" data-bs-placement="bottom" title="Apply ID">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-credit-card-2-front" viewBox="0 0 16 16">
                                <path d="M14 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12zM2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2z" />
                                <path d="M2 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z" />
                            </svg>
                            <span class="visually-hidden">Apply ID</span>
                        </a>
                    @endunless
                </div>
                <div class="btn-group" role="group" aria-label="Third group">
                    @if ($citizen->is_delisted)
                        {{-- button recover --}}
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#recover-modal" data-has-tooltip="true" data-bs-placement="bottom" title="Recover">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                            </svg>
                            <span class="visually-hidden">Recover</span>
                        </button>
                    @else
                        {{-- button delist/remove --}}
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delist-modal" data-has-tooltip="true" data-bs-placement="bottom" title="Delist">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-dash" viewBox="0 0 16 16">
                                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                <path fill-rule="evenodd" d="M11 7.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z" />
                            </svg>
                            <span class="visually-hidden">Delist</span>
                        </button>
                    @endif
                </div>
            </div>

        </div>
        <hr style="min-height: 1px">
        {{-- data wrapper --}}

        <div id="data-wrapper" class="bg-dark px-3 pb-3">

            <div class="d-grid gap-5">

                {{-- personal information --}}
                <div>
                    <div class="d-flex gap-3">
                        <h3>Personal information</h3>
                        <hr class="flex-fill">
                    </div>

                    <div class="d-flex gap-3 ps-3">

                        <div class="row g-3 flex-fill">

                            {{-- lastname --}}
                            <div class="col-6">
                                <label for="lastname" class="form-label text-info">Last name</label>
                                <p class="fs-3 px-1 m-0 border-bottom border-secondary">{{ $citizen->lastname }}</p>
                            </div>

                            {{-- firstname --}}
                            <div class="col-6">
                                <label for="firstname" class="form-label text-info">First name</label>
                                <p class="fs-3 px-1 m-0 border-bottom border-secondary">{{ $citizen->firstname }}</p>
                            </div>

                            {{-- middlename --}}
                            <div class="col-6">
                                <label for="middlename" class="form-label text-info">Middle name</label>
                                <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                    @if ($citizen->middlename)
                                        {{ $citizen->middlename }}
                                    @else
                                        <i class="text-muted">N/A</i>
                                    @endif
                                </p>
                            </div>

                        </div>

                        {{-- picture --}}
                        <div class="d-flex">
                            <img id="picture-placeholder" class="rounded d-block img-thumbnail mb-auto" src="{{ asset("storage/pictures/{$citizen->picture}") }}">
                        </div>

                    </div>

                </div>


                {{-- address --}}
                <div>
                    <div class="d-flex gap-3">
                        <h3>Address</h3>
                        <hr class="flex-fill">
                    </div>

                    <div class="row ps-3 g-3 flex-fill">

                        {{-- barangay --}}
                        <div class="col-6">
                            <label for="barangay" class="form-label text-info">Barangay</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">{{ $barangay->barangay_name }}</p>
                        </div>

                        {{-- province --}}
                        <div class="col-6">
                            <label for="province" class="form-label text-info">Province</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">{{ $citizen->province }}</p>
                        </div>

                    </div>

                </div>


                {{-- other information --}}
                <div>
                    <div class="d-flex gap-3">
                        <h3>Other information</h3>
                        <hr class="flex-fill">
                    </div>

                    <div class="row ps-3 g-3 flex-fill">

                        {{-- birth date --}}
                        <div class="col-6">
                            <label for="birthdate" class="form-label text-info">Birthdate</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">{{ date('F j, Y', strtotime($citizen->birthdate)) }}</p>
                        </div>

                        {{-- age --}}
                        <div class="col-3">
                            <label for="age" class="form-label text-info">Age</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">{{ $citizen->age }} yrs. old</p>
                        </div>

                        {{-- marital_status --}}
                        <div class="col-6">
                            <label for="marital_status" class="form-label text-info">Marital status</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">{{ ucfirst($citizen->marital_status) }}</p>
                        </div>

                    </div>

                </div>


                @if ($citizen->is_delisted)
                    {{-- delist details --}}
                    <div>
                        <div class="d-flex gap-3">
                            <h3>Delisting details</h3>
                            <hr class="flex-fill">
                        </div>

                        <div class="row ps-3 g-3 flex-fill">

                            {{-- emergency contact person --}}
                            <div class="col">
                                <label for="first_dose_date" class="form-label text-info">Delist reason</label>
                                <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                    {{ $citizen->delist_reason }}
                                </p>
                            </div>

                        </div>

                    </div>
                @endif

            </div>
        </div>

    </div>



    @if ($citizen->is_delisted)
        {{-- recover confirmation modal --}}
        <div class="modal fade text-dark" id="recover-modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Recover citizen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="recover-form" method="POST" class="d-grid gap-3 needs-validation" action="/citizens/{{ $citizen['id'] }}/recover" novalidate>
                            @csrf
                            <p class="mb-1">Recover Senior Citizen #{{ date('Y', strtotime($citizen['created_at'])) . '-' . str_pad($citizen['id'], 5, '0', STR_PAD_LEFT) }}?</p>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" form="recover-form">Recover</button>
                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- delist confirmation modal --}}
        <div class="modal fade text-dark" id="delist-modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delist citizen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="delist-form" method="POST" class="d-grid gap-3 needs-validation" action="/citizens/{{ $citizen['id'] }}/delist" novalidate>
                            @csrf
                            <div>
                                <p class="mb-1">Provide a reason to delist Senior Citizen #{{ date('Y', strtotime($citizen['created_at'])) . '-' . str_pad($citizen['id'], 5, '0', STR_PAD_LEFT) }}.</p>
                                <textarea class="form-control" name="delist_reason" rows="4" required></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" form="delist-form">Delist</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
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
