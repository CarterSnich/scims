@extends('layouts.dashboard_layout')

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
                                    <input type="text" class="form-control" id="middlename" name="middlename">
                                </div>

                                {{-- gender --}}
                                <div class="col-3">
                                    <label for="gender" class="form-label text-info">Gender</label>
                                    <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror" required>
                                        <option value="" selected disabled>Select gender</option>
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- age --}}
                                <div class="col-3">
                                    <label for="age" class="form-label text-info">Age</label>
                                    <input type="number" class="form-control @error('age') is-invalid @enderror" id="age" name="age" value="{{ old('age') }}" required>
                                    @error('age')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- birth date --}}
                                <div class="col-3">
                                    <label for="birthdate" class="form-label text-info">Birthdate</label>
                                    <input type="date" class="form-control @error('birthdate') is-invalid @enderror" id="birthdate" name="birthdate" value="{{ old('birthdate') }}" required>
                                    @error('birthdate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- birth place --}}
                                <div class="col-9">
                                    <label for="birthplace" class="form-label text-info">Birthplace</label>
                                    <input type="text" class="form-control @error('birthplace') is-invalid @enderror" id="birthplace" name="birthplace" value="{{ old('birthplace') }}" required>
                                    @error('birthplace')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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

                    {{-- contact information --}}
                    <div>
                        <div class="d-flex gap-3">
                            <h3>Contact information</h3>
                            <hr class="flex-fill">
                        </div>

                        <div class="row ps-3 g-3 flex-fill">

                            {{-- phone number --}}
                            <div class="col-6">
                                <label for="phone_number" class="form-label text-info">Phone number</label>
                                <input type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" id="phone_number" value="{{ old('phone_number') }}">
                                @error('phone_number')
                                    <div class="invalid-feeback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- email --}}
                            <div class="col-6">
                                <label for="email" class="form-label text-info">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                    </div>

                    {{-- location details --}}
                    <div>
                        <div class="d-flex gap-3">
                            <h3>Location details</h3>
                            <hr class="flex-fill">
                        </div>

                        <div class="row ps-3 g-3 flex-fill">

                            {{-- barangay --}}
                            <div class="col-6">
                                <label for="barangay" class="form-label text-info">Barangay</label>
                                <select name="barangay" id="barangay" class="form-control @error('barangay') is-invalid @enderror" required>
                                    <option value="" selected disabled>Select barangay</option>
                                    @foreach ($barangays as $barangay)
                                        <option value="{{ $barangay->id }}" {{ old('barangay') == $barangay->id ? 'selected' : '' }}>{{ $barangay->barangay_name }}</option>
                                    @endforeach
                                </select>
                                @error('barangay')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- province --}}
                            <div class="col-6">
                                <label for="province" class="form-label text-info">Province</label>
                                <input type="text" class="form-control @error('province') is-invalid @enderror" id="province" name="province" value="{{ old('province') }}" required>
                                @error('province')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- years of stay --}}
                            <div class="col-3">
                                <label for="years_of_stay" class="form-label text-info">Years of stay</label>
                                <input type="text" class="form-control @error('years_of_stay') is-invalid @enderror" id="years_of_stay" name="years_of_stay" value="{{ old('years_of_stay') }}" required>
                                @error('years_of_stay')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                    </div>

                    {{-- other details --}}
                    <div>
                        <div class="d-flex gap-3">
                            <h3>Other details</h3>
                            <hr class="flex-fill">
                        </div>

                        <div class="row ps-3 g-3 flex-fill">

                            {{-- religion --}}
                            <div class="col-6">
                                <label for="religion" class="form-label text-info">Religion</label>
                                <input type="text" name="religion" class="form-control @error('religion') is-invalid @enderror" id="religion" value="{{ old('religion') }}" required>
                                @error('religion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- marital_status --}}
                            <div class="col-6">
                                <label for="marital_status" class="form-label text-info">Marital status</label>
                                <select type="text" class="form-select @error('marital_status') is-invalid @enderror" id="marital_status" name="marital_status">
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

                            {{-- educational attainment --}}
                            <div class="col-6">
                                <label for="educational_attainment" class="form-label text-info">Educational attainment</label>
                                <input type="text" class="form-control @error('educational_attainment') is-invalid @enderror" id="educational_attainment" value="{{ old('educational_attainment') }}" name="educational_attainment">
                                @error('educational_attainment')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- status --}}
                            <div class="col-6">
                                <label for="status" class="form-label text-info">Status</label>
                                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                                    <option value="" selected disabled>Select status</option>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="deceased" {{ old('status') == 'deceased' ? 'selected' : '' }}>Deceased</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                    </div>

                    {{-- emergency information --}}
                    <div>
                        <div class="d-flex gap-3">
                            <h3>Emergancy information</h3>
                            <hr class="flex-fill">
                        </div>

                        <div class="row ps-3 g-3 flex-fill">

                            {{-- emergency contact person --}}
                            <div class="col-6">
                                <label for="emergency_contact_person" class="form-label text-info">Emergency contact person</label>
                                <input type="text" name="emergency_contact_person" class="form-control @error('emergency_contact_person') is-invalid @enderror" id="emergency_contact_person" value="{{ old('emergency_contact_person') }}" required>
                                @error('emergency_contact_person')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- emergency contact number --}}
                            <div class="col-6">
                                <label for="emergency_contact_number" class="form-label text-info">Emergency contact number</label>
                                <input type="text" class="form-control @error('emergency_contact_number') is-invalid @enderror" name="emergency_contact_number" id="emergency_contact_number" value="{{ old('emergency_contact_number') }}" required>
                                @error('emergency_contact_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- emergency contact address --}}
                            <div class="col-6">
                                <label for="emergency_contact_address" class="form-label text-info">Emergency contact address</label>
                                <input type="text" class="form-control @error('emergency_contact_address') is-invalid @enderror" id="emergency_contact_address" name="emergency_contact_address" value="{{ old('emergency_contact_address') }}" required>
                                @error('emergency_contact_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                    </div>


                    {{-- vaccination details --}}
                    <div>
                        <div class="d-flex gap-3">
                            <h3>Vaccination details</h3>
                            <hr class="flex-fill">
                        </div>

                        <div class="row ps-3 g-3 flex-fill">

                            {{-- emergency contact person --}}
                            <div class="col-6">
                                <label for="first_dose_date" class="form-label text-info">First dose date</label>
                                <input type="date" name="first_dose_date" class="form-control @error('first_dose_date') is-invalid @enderror" id="first_dose_date" value="{{ old('first_dose_date') }}">
                                @error('first_dose_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- emergency contact number --}}
                            <div class="col-6">
                                <label for="second_dose_date" class="form-label text-info">Second dose date</label>
                                <input type="date" class="form-control @error('second_dose_date') is-invalid @enderror" name="second_dose_date" id="second_dose_date" value="{{ old('second_dose_date') }}">
                                @error('second_dose_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- emergency contact address --}}
                            <div class="col-6">
                                <label for="booster_dose_date" class="form-label text-info">Booster dose date</label>
                                <input type="date" class="form-control @error('booster_dose_date') is-invalid @enderror" id="booster_dose_date" name="booster_dose_date" value="{{ old('booster_dose_date') }}">
                                @error('booster_dose_date')
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

        })()
    </script>
@endsection

@if ($errors->any())
    {{-- @dd($errors) --}}
@endif
