@extends('layouts.dashboard_layout')

@section('title', 'View Senior Citizen')

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
                    Senior Citizen <span class="text-primary">#{{ $citizen_id }}</span>
                    @if ($citizen->is_delisted)
                        <code class="fs-5 text-danger">DELISTED</code>
                    @endif
                </h2>
            </div>

            {{-- button toolbar --}}
            <div class="btn-toolbar gap-2" role="toolbar">
                <div class="btn-group me" role="group">
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
                </div>
                <div class="btn-group" role="group">
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
                @if ($citizen->is_delisted)
                    <div class="btn-group" role="group">
                        {{-- button delete --}}
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirm-delete-modal" data-has-tooltip="true" data-bs-placement="bottom" title="Delete">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                            </svg>
                            <span class="visually-hidden">Recover</span>
                        </button>
                    </div>
                @endif
            </div>

        </div>
        <hr style="min-height: 1px">
        {{-- data wrapper --}}

        <div id="data-wrapper" class="px-3 pb-3">

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


                {{-- personal information --}}
                <div>
                    <div class="d-flex gap-3">
                        <h3>Personal information</h3>
                        <hr class="flex-fill">
                    </div>

                    <div class="row ps-3 g-3 flex-fill">

                        {{-- date of birth --}}
                        <div class="col-6">
                            <label for="date_of_birth" class="form-label text-info">Date of birth</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">{{ date('F j, Y', strtotime($citizen->date_of_birth)) }}</p>
                        </div>

                        {{-- sex --}}
                        <div class="col-6">
                            <label for="sex" class="form-label text-info">Sex</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">{{ ucfirst($citizen->sex) }}</p>
                        </div>

                        {{-- place of birth --}}
                        <div class="col-6">
                            <label for="place_of_birth" class="form-label text-info">Place of birth</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">{{ $citizen->place_of_birth }}</p>
                        </div>

                        {{-- civil status --}}
                        <div class="col-6">
                            <label for="civil_status" class="form-label text-info">Civil status</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">{{ ucfirst($citizen->civil_status) }}</p>
                        </div>

                        {{-- broken down to specific attributes --}}
                        {{-- address --}}
                        {{-- <div class="col-6">
                            <label for="address" class="form-label text-info">Address</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">{{ $citizen->address }}</p>
                        </div> --}}

                        {{-- educational attainment --}}
                        <div class="col-6">
                            <label for="educational_attainment" class="form-label text-info">Educational attainment</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">{{ App\Models\Constants::EDUCATIONAL_ATTAINMENTS[$citizen->educational_attainment] }}</p>
                        </div>

                        {{-- occupation --}}
                        <div class="col-6">
                            <label for="occupation" class="form-label text-info">Occupation</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">{{ $citizen->occupation }}</p>
                        </div>

                        {{-- annual income --}}
                        <div class="col-6">
                            <label for="annual_income" class="form-label text-info">Annual income</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">₱ {{ $citizen->annual_income }}</p>
                        </div>

                        {{-- other skills --}}
                        <div class="col-6">
                            <label for="other_skills" class="form-label text-info">Other skills</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">{{ $citizen->other_skills }}</p>
                        </div>


                    </div>

                </div>


                {{-- Address --}}
                <div>
                    <div class="d-flex gap-3">
                        <h3>Address</h3>
                        <hr class="flex-fill">
                    </div>

                    <div class="row ps-3 g-3 flex-fill">

                        {{-- House no. --}}
                        <div class="col-6">
                            <label for="house_no" class="form-label text-info">House No.</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                @if ($citizen->house_no)
                                    {{ $citizen->house_no }}
                                @else
                                    <i class="text-muted">N/A</i>
                                @endif
                            </p>
                        </div>

                        {{-- street --}}
                        <div class="col-6">
                            <label for="street" class="form-label text-info">Street</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                @if ($citizen->street)
                                    {{ $citizen->street }}
                                @else
                                    <i class="text-muted">N/A</i>
                                @endif
                            </p>
                        </div>

                        {{-- barangay --}}
                        <div class="col-6">
                            <label for="barangay" class="form-label text-info">Barangay</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">{{ $barangay->barangay_name }}</p>
                        </div>

                    </div>

                </div>


                {{-- family composition --}}
                <div>
                    <div class="d-flex gap-3">
                        <h3>Family composition</h3>
                        <hr class="flex-fill">
                    </div>

                    {{-- table wrapper --}}
                    <div class="ps-3">
                        <table class="table table-borderless m-0 table-hover bg-light">
                            <thead>
                                <tr class="shadow-sm bg-light">
                                    <th scope="col">Name</th>
                                    <th scope="col">Relationship</th>
                                    <th scope="col">Age</th>
                                    <th scope="col">Civil status</th>
                                    <th scope="col">Occupation</th>
                                    <th scope="col">Income</th>
                                    {{-- <th scope="col" class="fit text-center">Action</th> --}}
                                </tr>
                            </thead>
                            <tbody class="table-bordered">
                                @foreach ($citizen->family_composition as $member)
                                    <tr>
                                        <td>{{ $member['name'] }}</td>
                                        <td>{{ $member['relationship'] }}</td>
                                        <td>{{ $member['age'] }}</td>
                                        <td>{{ ucfirst($member['civil_status']) }}</td>
                                        <td>{{ $member['occupation'] }}</td>
                                        <td>{{ $member['income'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


                {{-- Membership to Senior Citizen Association --}}
                <div>
                    <div class="d-flex gap-3">
                        <h3>Membership to Senior Citizen Association</h3>
                        <hr class="flex-fill">
                    </div>

                    <div class="row ps-3 g-3 flex-fill">

                        {{-- name_of_association --}}
                        <div class="col-12">
                            <label for="name_of_association" class="form-label text-info">Name of Association</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                @if ($citizen->name_of_association)
                                    {{ $citizen->name_of_association }}
                                @else
                                    <i class="text-muted">N/A</i>
                                @endif
                            </p>
                        </div>

                        {{-- address of association --}}
                        <div class="col-12">
                            <label for="address_of_association" class="form-label text-info">Address</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                @if ($citizen->address_of_association)
                                    {{ $citizen->address_of_association }}
                                @else
                                    <i class="text-muted">N/A</i>
                                @endif
                            </p>
                        </div>

                        {{-- date_of_membership --}}
                        <div class="col-4">
                            <label for="date_of_membership" class="form-label text-info">Date of Membership</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                @if ($citizen->date_of_membership)
                                    {{ $citizen->date_of_membership }}
                                @else
                                    <i class="text-muted">N/A</i>
                                @endif
                            </p>
                        </div>

                        {{-- date elected and term --}}
                        <div class="col-8">
                            <label for="date_of_membership" class="form-label text-info">If an officer, Date Elected & Term</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                @if ($citizen->date_of_membership)
                                    {{ $citizen->date_of_membership }} {{ $citizen->term }}
                                @else
                                    <i class="text-muted">N/A</i>
                                @endif
                            </p>
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
        {{-- recover confirmation modal --}}
        <div class="modal fade text-dark" id="confirm-delete-modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete citizen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="delete-form" method="POST" class="d-grid gap-3 needs-validation" action="/citizens/{{ $citizen['id'] }}/destroy" novalidate>
                            @csrf
                            @method('DELETE')
                            <p class="mb-1">Delete Senior Citizen? This action cannot be undone.</p>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" form="delete-form">Delete</button>
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
