@extends('layouts.dashboard_layout')

@section('title', 'Update Senior Citizens')

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
            <button class="btn btn-primary" type="submit" form="edit-form">Save</button>
        </div>
        <hr>
        <form id="edit-form" class="d-flex flex-column px-3 pb-3 needs-validation" action="/citizens/{{ $citizen->id }}/update" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')

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
                                    <input type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" id="lastname" value="{{ $citizen->firstname }}" required>
                                    @error('lastname')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- firstname --}}
                                <div class="col-6">
                                    <label for="firstname" class="form-label text-info">First name</label>
                                    <input type="text" class="form-control @error('firstname') is-invalid @enderror" id="firstname" name="firstname" value="{{ $citizen->lastname }}" required>
                                    @error('firstname')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row g-3">
                                {{-- middlename --}}
                                <div class="col-6">
                                    <label for="middlename" class="form-label text-info">Middle name</label>
                                    <input type="text" class="form-control" id="middlename" name="middlename" value="{{ $citizen->middlename }}">
                                </div>
                            </div>

                        </div>

                        {{-- picture --}}
                        <div class="d-flex flex-column gap-2">
                            <div class="mb-auto">
                                <img id="picture-placeholder" class="mt-auto mx-auto rounded d-block" src="{{ asset('storage/pictures/' . $citizen->picture) }}" height="200" width="200">
                            </div>
                            <div class="d-flex flex-column gap-2">
                                <input type="file" accept="image/png,image/jpeg" class="d-none form-control @error('picture') is-invalid @enderror" name="picture" id="picture-upload">
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
                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth" name="date_of_birth" value="{{ $citizen->date_of_birth }}" required>
                            @error('date_of_birth')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- sex --}}
                        <div class="col-6">
                            <label for="sex" class="form-label text-info">Sex</label>
                            <select name="sex" id="sex" class="form-select">
                                <option value="" selected disabled>Select sex</option>
                                <option value="male" {{ $citizen->sex == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ $citizen->sex == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('sex')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- place of birth --}}
                        <div class="col-6">
                            <label for="place_of_birth" class="form-label text-info">Place of birth</label>
                            <input type="text" class="form-control @error('place_of_birth') is-invalid @enderror" name="place_of_birth" id="place_of_birth" value="{{ $citizen->place_of_birth }}" required>
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
                                    <option value="{{ $status }}" {{ $citizen->civil_status == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                            @error('civil_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- address --}}
                        <div class="col-6">
                            <label for="address" class="form-label text-info">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ $citizen->address }}" required>
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
                                @foreach (App\Models\Constants::EDUCATIONAL_ATTAINMENTS as $key => $attainment)
                                    <option value="{{ $key }}" {{ $citizen->educational_attainment == $key ? 'selected' : '' }}>{{ $attainment }}</option>
                                @endforeach
                            </select>
                            @error('educational_attainment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- occupation --}}
                        <div class="col-6">
                            <label for="occupation" class="form-label text-info">Occupation</label>
                            <input type="text" class="form-control" id="occupation" name="occupation" value="{{ $citizen->occupation }}" required>
                            @error('occupation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- annual_income --}}
                        <div class="col-6">
                            <label for="annual_income" class="form-label text-info">Annual income</label>
                            <input type="text" class="form-control" id="annual_income" name="annual_income" value="{{ $citizen->annual_income }}" pattern="^(?!0,?\d)([0-9]{2}[0-9]{0,}(\.[0-9]{2}))$" required>
                            @error('annual_income')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- other_skills --}}
                        <div class="col-6">
                            <label for="other_skills" class="form-label text-info">Other skills</label>
                            <input type="text" class="form-control" id="other_skills" name="other_skills" value="{{ $citizen->other_skills }}">
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

                                @foreach ($citizen->family_composition as $member)
                                    <tr>
                                        <input type="hidden" name="_family_member[]" value="{{ $loop->index }}">
                                        <td>
                                            <input type="text" class="form-control form-control-sm" name="family_member_name[]" value="{{ $member['name'] }}" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm" name="family_member_relationship[]" value="{{ $member['relationship'] }}" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm" name="family_member_age[]" value="{{ $member['age'] }}" required>
                                        </td>
                                        <td>
                                            <select class="form-select form-select-sm" name="family_member_civil_status[]" required>
                                                <option value="" selected disabled>Select status</option>
                                                <option value="unmarried" @if ($member['civil_status'] === 'unmarried') selected @endif>Unmarried</option>
                                                <option value="married" @if ($member['civil_status'] === 'married') selected @endif>Married</option>
                                                <option value="divorced" @if ($member['civil_status'] === 'divorced') selected @endif>Divorced</option>
                                                <option value="widowed" @if ($member['civil_status'] === 'widowed') selected @endif>Widowed</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm" name="family_member_occupation[]" value="{{ $member['occupation'] }}" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm" name="family_member_income[]" pattern="([1-9][0-9]*|0)" value="{{ $member['income'] }}" required>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm remove-entry">Remove</button>
                                        </td>
                                    </tr>
                                @endforeach
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
                            <input type="text" name="name_of_association" class="form-control" value="{{ $citizen->name_of_association }}" id="name_of_association">
                            @error('name_of_association')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- address_of_association --}}
                        <div class="col-6">
                            <label for="address_of_association" class="form-label text-info">Address</label>
                            <input type="text" class="form-control @error('address_of_association') is-invalid @enderror" id="address_of_association" name="address_of_association" value="{{ $citizen->address_of_association }}">
                            @error('address_of_association')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- date_of_membership --}}
                        <div class="col-6">
                            <label for="date_of_membership" class="form-label text-info">Date of Membership</label>
                            <input type="date" class="form-control @error('date_of_membership') is-invalid @enderror" id="date_of_membership" name="date_of_membership" value="{{ $citizen->date_of_membership }}">
                            @error('date_of_birth')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Date elected --}}
                        <div class="col-3">
                            <label for="date_elected" class="form-label text-info">If an Officer, Date Elected</label>
                            <input type="date" class="form-control @error('date_elected') is-invalid @enderror" id="date_elected" name="date_elected" value="{{ $citizen->date_elected }}">
                            @error('date_elected')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- term --}}
                        <div class="col-3">
                            <label for="term" class="form-label text-info">& Term</label>
                            <input type="text" class="form-control @error('term') is-invalid @enderror" id="term" name="term" value="{{ $citizen->term }}">
                            @error('term')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- vaccination status --}}
                <div>
                    <div class="d-flex gap-3">
                        <h3>Vaccination status</h3>
                        <hr class="flex-fill">
                    </div>

                    <div class="row ps-3 g-3 flex-fill">

                        {{-- vaccine --}}
                        <div class="col-6">
                            <label for="vaccine" class="form-label text-info">Vaccine</label>
                            <select name="vaccine" id="vaccine" class="form-select">
                                @foreach (App\Models\Constants::VACCINES as $key => $vaccine)
                                    <option value="{{ $key }}" {{ $citizen->vaccine == $key ? 'selected' : '' }}>{{ $vaccine }}</option>
                                @endforeach
                            </select>
                            @error('vaccine')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- first dose --}}
                        <div class="col-6">
                            <label for="first_dose" class="form-label text-info">First dose date</label>
                            <input type="date" class="form-control" name="first_dose" id="first_dose" value="{{ $citizen->first_dose }}">
                            @error('first_dose')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- second dose --}}
                        <div class="col-6">
                            <label for="second_dose" class="form-label text-info">Second dose date</label>
                            <input type="date" class="form-control" name="second_dose" id="second_dose" value="{{ $citizen->second_dose }}">
                            @error('second_dose')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- booster dose --}}
                        <div class="col-6">
                            <label for="booster_dose" class="form-label text-info">Booster dose date</label>
                            <input type="date" class="form-control" name="booster_dose" id="booster_dose" value="{{ $citizen->booster_dose }}">
                            @error('booster_dose')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>

            </div>
        </form>
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

        $('button.insert-family-entry').on('click', function() {
            $('#family-composition-table tbody').append(`       
                <tr>
                    <input type="hidden" name="_family_member[]" value="${$('#family-composition-table tbody').children().length}">
                    <td>
                        <input type="text" class="form-control form-control-sm" name="family_member_name[]" required>
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm" name="family_member_relationship[]" required>
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm" name="family_member_age[]" required>
                    </td>
                    <td>
                        <select class="form-select form-select-sm" name="family_member_civil_status[]" required>
                            <option value="" selected disabled>Select status</option>
                            <option value="unmarried">Unmarried</option>
                            <option value="married">Married</option>
                            <option value="divorced">Divorced</option>
                            <option value="widowed">Widowed</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm" name="family_member_occupation[]" required>
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm" name="family_member_income[]" pattern="([1-9][0-9]*|0)" required>
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
    </script>
@endsection
