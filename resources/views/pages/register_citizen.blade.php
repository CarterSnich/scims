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
                <h2 class="my-auto">Senior Citizen registration</h2>
            </div>
            <button class="btn btn-primary" type="submit" form="registration-form">Submit</button>
        </div>
        <hr>
        <div id="form-wrapper">
            <form id="registration-form" class="d-flex flex-column px-3 pb-3 needs-validation" action="/citizens/add/submit" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                @method('POST')

                <div class="d-grid gap-5">

                    {{-- name --}}
                    <div>
                        <div class="d-flex gap-3">
                            <h3>Name</h3>
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
                                <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                                @error('date_of_birth')
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

                            {{-- sex --}}
                            <div class="col-6">
                                <label for="sex" class="form-label text-info">Sex</label>
                                <select name="sex" id="sex" class="form-select">
                                    <option value="" selected disabled>Select sex</option>
                                    <option value="male" {{ old('sex') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('sex') == 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('sex')
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

                            {{-- commented out. im breaking down the address to more specific attributes --}}
                            {{-- address --}}
                            {{-- <div class="col-6">
                                <label for="address" class="form-label text-info">Address</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div> --}}

                            {{-- educational attainment --}}
                            <div class="col-6">
                                <label for="educational_attainment" class="form-label text-info">Educational attainment</label>
                                <select class="form-select @error('educational_attainment') is-invalid @enderror" id="educational_attainment" name="educational_attainment" required>
                                    <option value="" selected disabled>Select educational attainemnt</option>
                                    @foreach (App\Models\Constants::EDUCATIONAL_ATTAINMENTS as $key => $attainment)
                                        <option value="{{ $key }}" {{ old('educational_attainment') == $key ? 'selected' : '' }}>{{ $attainment }}</option>
                                    @endforeach
                                </select>
                                @error('educational_attainment')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- occupation --}}
                            <div class="col-6">
                                <label for="occupation" class="form-label text-info">Occupation</label>
                                <input type="text" class="form-control" id="occupation" name="occupation" value="{{ old('occupation') }}" required>
                                @error('occupation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- annual_income --}}
                            <div class="col-6">
                                <label for="annual_income" class="form-label text-info">Annual income</label>
                                <input type="text" class="form-control" id="annual_income" name="annual_income" value="{{ old('annual_income') }}" pattern="([1-9][0-9]*|0)" required>
                                @error('annual_income')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- other_skills --}}
                            <div class="col-6">
                                <label for="other_skills" class="form-label text-info">Other skills</label>
                                <input type="text" class="form-control" id="other_skills" name="other_skills" value="{{ old('other_skills') }}">
                                @error('other_skills')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
                        </div>

                    </div>


                    {{-- family composition --}}
                    <div>
                        <div class="d-flex gap-3">
                            <h3>Family composition</h3>
                            <hr class="flex-fill">
                        </div>
                        <div class="ps-3 g-3">
                            <table class="table table-light mb-0" id="family-composition-table">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Relationship</th>
                                        <th scope="col">Age</th>
                                        <th scope="col">Civil status</th>
                                        <th scope="col">Occupation</th>
                                        <th scope="col">Income</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <div class="p-2 bg-light">
                                <button type="button" class="btn btn-outline-primary w-100 insert-family-entry">+</button>
                            </div>
                        </div>
                    </div>


                    {{-- membership to senior citizen association --}}
                    <div>
                        <div class="d-flex gap-3">
                            <h3>Membership to Senior Citizen Association</h3>
                            <hr class="flex-fill">
                        </div>

                        <div class="row ps-3 g-3 flex-fill">

                            {{-- name of association --}}
                            <div class="col-6">
                                <label for="name_of_association" class="form-label text-info">Name of Association</label>
                                <input type="text" name="name_of_association" class="form-control" value="{{ old('name_of_association') }}" id="name_of_association">
                                @error('name_of_association')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- address_of_association --}}
                            <div class="col-6">
                                <label for="address_of_association" class="form-label text-info">Address</label>
                                <input type="text" class="form-control @error('address_of_association') is-invalid @enderror" id="address_of_association" name="address_of_association" value="{{ old('address_of_association') }}">
                                @error('address_of_association')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- date_of_membership --}}
                            <div class="col-6">
                                <label for="date_of_membership" class="form-label text-info">Date of Membership</label>
                                <input type="date" class="form-control @error('date_of_membership') is-invalid @enderror" id="date_of_membership" name="date_of_membership" value="{{ old('date_of_membership') }}">
                                @error('date_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Date elected --}}
                            <div class="col-3">
                                <label for="date_elected" class="form-label text-info">If an Officer, Date Elected</label>
                                <input type="date" class="form-control @error('date_elected') is-invalid @enderror" id="date_elected" name="date_elected" value="{{ old('date_elected') }}">
                                @error('date_elected')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- term --}}
                            <div class="col-3">
                                <label for="term" class="form-label text-info">& Term</label>
                                <input type="text" class="form-control @error('term') is-invalid @enderror" id="term" name="term" value="{{ old('term') }}">
                                @error('term')
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
    <script src="{{ asset('js/register-citizen.js') }}"></script>
@endsection
