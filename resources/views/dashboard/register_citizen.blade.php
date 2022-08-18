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

                    {{-- Address --}}
                    <div>
                        <div class="d-flex gap-3">
                            <h3>Address</h3>
                            <hr class="flex-fill">
                        </div>

                        <div class="row ps-3 g-3 flex-fill">

                            {{-- barangay --}}
                            <div class="col-6">
                                <label for="barangay" class="form-label text-info">Barangay</label>
                                <select name="barangay" id="barangay" class="form-select @error('barangay') is-invalid @enderror" required>
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

                        </div>

                    </div>

                    {{-- other details --}}
                    <div>
                        <div class="d-flex gap-3">
                            <h3>Other details</h3>
                            <hr class="flex-fill">
                        </div>

                        <div class="row ps-3 g-3 flex-fill">

                            {{-- birth date --}}
                            <div class="col-6">
                                <label for="birthdate" class="form-label text-info">Birthdate</label>
                                <input type="date" class="form-control @error('birthdate') is-invalid @enderror" id="birthdate" name="birthdate" value="{{ old('birthdate') }}" required>
                                @error('birthdate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- age --}}
                            <div class="col-6">
                                <label for="age" class="form-label text-info">Age</label>
                                <input type="number" class="form-control @error('age') is-invalid @enderror" id="age" name="age" value="{{ old('age') }}" required>
                                @error('age')
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

                            {{-- gender --}}
                            <div class="col-6">
                                <label for="gender" class="form-label text-info">Gender</label>
                                <select name="gender" id="gender" class="form-select">
                                    <option value="" selected disabled>Select gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                @error('gender')
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
