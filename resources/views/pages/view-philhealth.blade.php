@extends('layouts.dashboard_layout')

@section('title', 'View PhilHealth Registration')

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
                <a href="/philhealths" class="btn btn-secondary" data-has-tooltip="true" data-bs-placement="bottom" title="Go back">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                    </svg>
                    <span class="visually-hidden">Go back</span>
                </a>
                <h2 class="my-auto ">PhilHealth</h2>
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
                                <p class="fs-3 px-1 m-0 border-bottom border-secondary">{{ $philhealth->lastname }}</p>
                            </div>

                            {{-- firstname --}}
                            <div class="col-6">
                                <label for="firstname" class="form-label text-info">First name</label>
                                <p class="fs-3 px-1 m-0 border-bottom border-secondary">{{ $philhealth->firstname }}</p>
                            </div>

                            {{-- middlename --}}
                            <div class="col-6">
                                <label for="middlename" class="form-label text-info">Middle name</label>
                                <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                    @if ($philhealth->middlename)
                                        {{ $philhealth->middlename }}
                                    @else
                                        <i class="text-muted">N/A</i>
                                    @endif
                                </p>
                            </div>

                        </div>

                        {{-- picture --}}
                        <div class="d-flex">
                            <img id="picture-placeholder" class="rounded d-block img-thumbnail mb-auto" src="{{ asset("storage/pictures/{$philhealth->picture}") }}">
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
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">{{ date('F j, Y', strtotime($philhealth->date_of_birth)) }}</p>
                        </div>

                        {{-- sex --}}
                        <div class="col-6">
                            <label for="sex" class="form-label text-info">Sex</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">{{ ucfirst($philhealth->sex) }}</p>
                        </div>

                        {{-- place of birth --}}
                        <div class="col-6">
                            <label for="place_of_birth" class="form-label text-info">Place of birth</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">{{ $philhealth->place_of_birth }}</p>
                        </div>

                        {{-- civil status --}}
                        <div class="col-6">
                            <label for="civil_status" class="form-label text-info">Civil status</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">{{ ucfirst($philhealth->civil_status) }}</p>
                        </div>

                        {{-- broken down to specific attributes --}}
                        {{-- address --}}
                        {{-- <div class="col-6">
                            <label for="address" class="form-label text-info">Address</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">{{ $philhealth->address }}</p>
                        </div> --}}

                        {{-- educational attainment --}}
                        <div class="col-6">
                            <label for="educational_attainment" class="form-label text-info">Educational attainment</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">{{ App\Models\Constants::EDUCATIONAL_ATTAINMENTS[$philhealth->educational_attainment] }}</p>
                        </div>

                        {{-- occupation --}}
                        <div class="col-6">
                            <label for="occupation" class="form-label text-info">Occupation</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">{{ $philhealth->occupation }}</p>
                        </div>

                        {{-- annual income --}}
                        <div class="col-6">
                            <label for="annual_income" class="form-label text-info">Annual income</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">₱ {{ $philhealth->annual_income }}</p>
                        </div>

                        {{-- other skills --}}
                        <div class="col-6">
                            <label for="other_skills" class="form-label text-info">Other skills</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">{{ $philhealth->other_skills }}</p>
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
                                @if ($philhealth->house_no)
                                    {{ $philhealth->house_no }}
                                @else
                                    <i class="text-muted">N/A</i>
                                @endif
                            </p>
                        </div>

                        {{-- street --}}
                        <div class="col-6">
                            <label for="street" class="form-label text-info">Street</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                @if ($philhealth->street)
                                    {{ $philhealth->street }}
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
                                @foreach ($philhealth->family_composition as $member)
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


                {{-- Membership to Senior philhealth Association --}}
                <div>
                    <div class="d-flex gap-3">
                        <h3>Membership to Senior philhealth Association</h3>
                        <hr class="flex-fill">
                    </div>

                    <div class="row ps-3 g-3 flex-fill">

                        {{-- name_of_association --}}
                        <div class="col-12">
                            <label for="name_of_association" class="form-label text-info">Name of Association</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                @if ($philhealth->name_of_association)
                                    {{ $philhealth->name_of_association }}
                                @else
                                    <i class="text-muted">N/A</i>
                                @endif
                            </p>
                        </div>

                        {{-- address of association --}}
                        <div class="col-12">
                            <label for="address_of_association" class="form-label text-info">Address</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                @if ($philhealth->address_of_association)
                                    {{ $philhealth->address_of_association }}
                                @else
                                    <i class="text-muted">N/A</i>
                                @endif
                            </p>
                        </div>

                        {{-- date_of_membership --}}
                        <div class="col-4">
                            <label for="date_of_membership" class="form-label text-info">Date of Membership</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                @if ($philhealth->date_of_membership)
                                    {{ $philhealth->date_of_membership }}
                                @else
                                    <i class="text-muted">N/A</i>
                                @endif
                            </p>
                        </div>

                        {{-- date elected and term --}}
                        <div class="col-8">
                            <label for="date_of_membership" class="form-label text-info">If an officer, Date Elected & Term</label>
                            <p class="fs-3 px-1 m-0 border-bottom border-secondary">
                                @if ($philhealth->date_of_membership)
                                    {{ $philhealth->date_of_membership }} {{ $philhealth->term }}
                                @else
                                    <i class="text-muted">N/A</i>
                                @endif
                            </p>
                        </div>


                    </div>
                </div>

                @if ($philhealth->is_delisted)
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
                                    {{ $philhealth->delist_reason }}
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
