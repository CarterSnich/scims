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
            <form id="registration-form" class="d-flex flex-column px-3 pb-3 needs-validation" method="POST" enctype="multipart/form-data" novalidate>
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
                            <div class="d-flex flex-column">
                                <div class="mb-auto">
                                    <img id="picture-placeholder" class="mt-auto mx-auto rounded d-block" height="200" width="200">
                                </div>
                                <div>
                                    <input type="file" accept="image/*" class="d-none form-control @error('picture') is-invalid @enderror" name="picture" id="picture-upload" required>
                                    <label class="btn btn-secondary d-block" for="picture-upload">Upload</label>
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

                            {{-- sex --}}
                            <div class="col-6">
                                <label for="sex" class="form-label text-info">Sex</label>
                                <select name="sex" id="sex" class="form-select">
                                    <option value="" selected disabled>Select sex</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
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
                                <select class="form-select @error('civil_status') is-invalid @enderror" id="marital_status" name="marital_status" required>
                                    <option value="" selected disabled>Select status</option>
                                    <option value="unmarried" {{ old('marital_status') == 'unmarried' ? 'selected' : '' }}>Unmarried</option>
                                    <option value="married" {{ old('marital_status') == 'married' ? 'selected' : '' }}>Married</option>
                                    <option value="divorced" {{ old('marital_status') == 'divorced' ? 'selected' : '' }}>Divorced</option>
                                    <option value="widowed" {{ old('marital_status') == 'widowed' ? 'selected' : '' }}>Widowed</option>
                                </select>
                                @error('marital_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- address --}}
                            <div class="col-6">
                                <label for="address" class="form-label text-info">Address</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- educational attainment --}}
                            <div class="col-6">
                                <label for="educational_attainment" class="form-label text-info">Educational attainment</label>
                                <select class="form-select @error('educational_attainment') is-invalid @enderror" id="educational_attainment" name="educational_attainment" required>
                                    <option value="" selected disabled>Select educational attainemnt</option>
                                    <option value="1" {{ old('educational_attainment') == '1' ? 'selected' : '' }}>Unmarried</option>
                                    <option value="2" {{ old('educational_attainment') == '2' ? 'selected' : '' }}>Married</option>
                                    <option value="3" {{ old('educational_attainment') == '3' ? 'selected' : '' }}>Divorced</option>
                                    <option value="4" {{ old('educational_attainment') == '4' ? 'selected' : '' }}>Widowed</option>
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
                                <input type="text" class="form-control" id="annual_income" name="annual_income" value="{{ old('annual_income') }}" pattern="[1-9][0-9]{3,}" required>
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


                    {{-- family composition --}}
                    <div>
                        <div class="d-flex gap-3">
                            <h3>Family composition</h3>
                            <hr class="flex-fill">
                        </div>
                        <div class="ps-3 g-3">
                            <table class="table table-light" id="family-composition-table">
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
                                    <tr>
                                        <td colspan="7">
                                            <button type="button" class="btn btn-outline-primary w-100 insert-family-entry">+</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
                                <input type="text" name="name_of_association" class="form-control" id="name_of_association">
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
                                <label for="date_elected" class="form-label text-info">Date Elected</label>
                                <input type="date" class="form-control @error('date_elected') is-invalid @enderror" id="date_elected" name="date_elected" value="{{ old('date_elected') }}">
                                @error('date_elected')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- term --}}
                            <div class="col-3">
                                <label for="term" class="form-label text-info">Term</label>
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
    <script>
        (function() {
            $('#picture-upload').on('change', function() {
                const [file] = this.files
                if (file) {
                    $('#picture-placeholder').attr('src', URL.createObjectURL(file))
                }
            })

            $('#family-composition-table button.insert-family-entry').on('click', function() {
                $('#family-composition-table tbody').prepend(`       
                    <tr>
                        <input type="hidden" name="_family_member">
                        <td>
                            <input type="text" class="form-control form-control-sm" name="family_member_name" required>
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-sm" name="family_member_relationship" required>
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-sm" name="family_member_age" required>
                        </td>
                        <td>
                            <select class="form-select form-select-sm" name="family_member_civil_status" required>
                                <option value="" selected disabled>Select status</option>
                                <option value="unmarried">Unmarried</option>
                                <option value="married">Married</option>
                                <option value="divorced">Divorced</option>
                                <option value="widowed">Widowed</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-sm" name="family_member_occupation" required>
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-sm" name="family_member_income" pattern="[1-9][0-9]{3,}" required>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-entry">Remove</button>
                        </td>
                    </tr>
                `)
            })


            $('#family-composition-table tbody').on('click', 'tr>td>button.remove-entry', function() {
                $(this).parent().parent().remove()
            })
        })()
    </script>
@endsection

@if ($errors->any())
    {{-- @dd($errors) --}}
@endif
