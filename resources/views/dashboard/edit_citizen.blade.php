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
    </style>
@endsection

@section('content')
    <div id="main">
        {{-- page header --}}
        <div class="d-flex justify-content-between">
            <div class="d-flex gap-2">
                <a href="/citizens" class="btn btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                    </svg>
                </a>
                <h2 class="my-auto">Edit Senior Citizen <strong class="text-primary">#{{ $citizen['citizenId'] }}</strong></h2>
            </div>
        </div>
        <hr>

        {{-- form wrapper --}}
        <div id="form-wrapper">
            <form id="registration-form" class="d-flex flex-column px-3 pb-3 gap-5 needs-validation" action="/citizens/{{ $citizen['id'] }}/update" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')

                {{-- personal information --}}
                <div class="row g-3">
                    <div class="col-12 d-flex">
                        <h3 class="h3 mb-0 me-3">Personal information</h3>
                        <hr class="flex-fill">
                    </div>
                    <div class="col-12 d-grid px-5 gap-3">
                        {{-- picture --}}
                        <div class="row">
                            <div class="col-4">
                                <label class="h3 form-label text-info">Picture 2x2</la>
                            </div>
                            <div class="col-4">
                                <div class="d-flex">
                                    <div>
                                        <img id="picture-placeholder" class="mt-auto mx-auto rounded d-block" src="{{ asset("storage/pictures/{$citizen['picture']}") }}" height="200" width="200">
                                    </div>
                                    <div class="ms-2">
                                        <input type="file" accept="image/*" class="d-none form-control @error('picture') is-invalid @enderror" name="picture" id="picture-upload" aria-label="Upload">
                                        <label class="btn btn-secondary" for="picture-upload">Upload</label>
                                        @error('picture')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- lastname --}}
                        <div class="row">
                            <div class="col-4">
                                <label for="lastname" class="h3 form-label text-info">Last name</label>
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') ?? $citizen['lastname'] }}" required>
                                @error('lastname')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- lastname --}}
                        <div class="row">
                            <div class="col-4">
                                <label for="firstname" class="h3 form-label text-info">First name</label>
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') ?? $citizen['firstname'] }}" required>
                                @error('firstname')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- middlename --}}
                        <div class="row">
                            <div class="col-4">
                                <label for="middlename" class="h3 form-label text-info">Middle name</label>
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" name="middlename" value="{{ old('middlename') ?? $citizen['middlename'] }}">
                            </div>
                        </div>

                        {{-- barangay --}}
                        <div class="row">
                            <div class="col-4">
                                <label for="barangay" class="h3 form-label text-info">Barangay</label>
                            </div>
                            <div class="col-6">
                                <select class="form-select @error('barangay') is-invalid @enderror" name="barangay" required>
                                    <option selected disabled value="">Select barangay</option>
                                    @foreach ($barangays as $barangay)
                                        <option value="{{ $barangay['id'] }}" {{ (old('barangay') ?? $citizen['barangay']) == $barangay['id'] ? 'selected' : '' }}>
                                            {{ $barangay['barangay_name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('barangay')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- province --}}
                        <div class="row">
                            <div class="col-4">
                                <label for="province" class="h3 form-label text-info">Province</label>
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control @error('province') is-invalid @enderror" name="province" value="{{ old('province') ?? $citizen['province'] }}" required>
                                @error('province')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- birth date --}}
                        <div class="row">
                            <div class="col-4">
                                <label for="birthdate" class="h3 form-label text-info">Date of birth</label>
                            </div>
                            <div class="col-6">
                                <input type="date" class="form-control @error('birthdate') is-invalid @enderror" name="birthdate" value="{{ old('birthdate') ?? $citizen['birthdate'] }}">
                                @error('birthdate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- age --}}
                        <div class="row">
                            <div class="col-4">
                                <label for="age" class="h3 form-label text-info">Age</label>
                            </div>
                            <div class="col-6">
                                <input type="number" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age') ?? $citizen['age'] }}" required>
                                @error('age')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- marital status --}}
                        <div class="row">
                            <div class="col-4">
                                <label for="marital_status" class="h3 form-label text-info">Marital status</label>
                            </div>
                            <div class="col-6">
                                <select class="form-select @error('marital_status') is-invalid @enderror" name="marital_status" value="{{ old('marital_status') }}" required>
                                    <option selected disabled value="">Select status</option>
                                    <option value="unmarried" {{ (old('marital_status') ?? $citizen['marital_status']) == 'unmarried' ? 'selected' : '' }}>Unmarried</option>
                                    <option value="married" {{ (old('marital_status') ?? $citizen['marital_status']) == 'married' ? 'selected' : '' }}>Married</option>
                                    <option value="divorced" {{ (old('marital_status') ?? $citizen['marital_status']) == 'divorced' ? 'selected' : '' }}>Divorced</option>
                                    <option value="widowed" {{ (old('marital_status') ?? $citizen['marital_status']) == 'widowed' ? 'selected' : '' }}>Widowed</option>
                                </select>
                                @error('marital_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- gender --}}
                        <div class="row">
                            <div class="col-4">
                                <label for="gender" class="h3 form-label text-info">Gender</label>
                            </div>
                            <div class="col-6">
                                <select class="form-select @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender') }}" required>
                                    <option selected disabled value="">Select gender</option>
                                    <option value="male" {{ (old('gender') ?? $citizen->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ (old('gender') ?? $citizen->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- submit button --}}
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-6">
                                <button type="submit" class="w-100 btn btn-primary">Submit</button>
                            </div>
                        </div>

                    </div>
                </div>

            </form>
        </div>
    </div>

    {{-- cancel confirmation modal --}}
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
        $(function() {
            $('#picture-upload').on('change', function() {
                const [file] = this.files
                if (file) {
                    $('#picture-placeholder').attr('src', URL.createObjectURL(file))
                }
            })
        });
    </script>
@endsection
