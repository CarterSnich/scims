@extends('layouts.dashboard_layout')

@section('title', 'ID Application')

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
                <h2 class="my-auto">OSCA ID Application</h2>
            </div>
            <button class="btn btn-primary" type="submit" form="application-form">Submit</button>
        </div>
        <hr>
        <div id="form-wrapper">
            <form id="application-form" class="d-flex flex-column px-3 pb-3 needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                @method('POST')

                <div class="d-grid gap-5">

                    {{-- Purpose --}}
                    <div>
                        <div class="d-flex gap-3">
                            <h3>Purpose</h3>
                            <hr class="flex-fill">
                        </div>

                        <div class="row ps-3 g-3 flex-fill">

                            {{-- new registration --}}
                            <div class="col-3 d-flex gap-2">
                                <input class="form-check-input my-auto" type="radio" name="purpose" id="new_registration" value="new_registration" required {{ old('purpose') == 'new_registration' ? 'checked' : '' }}>
                                <label class="form-check-label fs-3" for="new_registration">
                                    New Registration
                                </label>
                            </div>

                            {{-- lost id --}}
                            <div class="col-3 d-flex gap-2">
                                <input class="form-check-input my-auto" type="radio" name="purpose" id="lost_id" value="lost_id" {{ old('purpose') == 'lost_id' ? 'checked' : '' }}>
                                <label class="form-check-label fs-3" for="lost_id">
                                    Lost ID
                                </label>
                            </div>

                            {{-- replacement --}}
                            <div class="col-3 d-flex gap-2">
                                <input class="form-check-input my-auto" type="radio" name="purpose" id="replacement" value="replacement" {{ old('purpose') == 'replacement' ? 'checked' : '' }}>
                                <label class="form-check-label fs-3" for="replacement">
                                    Replacement
                                </label>
                            </div>

                            {{-- transferee --}}
                            <div class="col-3 d-flex gap-2">
                                <input class="form-check-input my-auto" type="radio" name="purpose" id="transferee" value="transferee" {{ old('purpose') == 'transferee' ? 'checked' : '' }}>
                                <label class="form-check-label fs-3" for="transferee">
                                    Transferee
                                </label>
                            </div>

                            <div class="d-none @error('purpose') is-invalid @enderror"></div>
                            @error('purpose')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>


                    </div>

                    {{-- application details --}}
                    <div>
                        <div class="d-flex gap-3">
                            <h3>Application details</h3>
                            <hr class="flex-fill">
                        </div>

                        <div class="row ps-3 g-3 flex-fill">

                            {{-- date applied --}}
                            <div class="col-6">
                                <label for="date_applied" class="form-label text-info">Date applied</label>
                                <input type="date" class="form-control @error('date_applied') is-invalid @enderror" name="date_applied" id="date_applied" value="{{ old('date_applied') }}" required>
                                @error('date_applied')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- osca id --}}
                            <div class="col-6">
                                <label for="osca_id" class="form-label text-info">OSCA ID #</label>
                                <input type="text" class="form-control @error('osca_id') is-invalid @enderror" name="osca_id" id="osca_id" value="{{ old('osca_id') }}" required>
                                @error('osca_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- date issued --}}
                            <div class="col-6">
                                <label for="date_issued" class="form-label text-info">Date issued</label>
                                <input type="date" class="form-control @error('date_issued') is-invalid @enderror" name="date_issued" id="date_issued" value="{{ old('date_issued') }}" required>
                                @error('date_issued')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- senior citizen --}}
                            <div class="col-6">
                                <label for="citizen" class="form-label text-info">Senior Citizen</label>
                                <select name="citizen" id="citizen" class="form-select @error('citizen') is-invalid @enderror" required>
                                    <option value="" selected disabled>Select citizen</option>
                                    @foreach ($citizens as $citizen)
                                        <option value="{{ $citizen->id }}" {{ (old('citizen') ?? $applicant->id) == $citizen->id ? 'selected' : '' }}>
                                            {{ "{$citizen->lastname}, {$citizen->firstname} {$citizen->middlename}" }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('citizen')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                    </div>

                    {{-- for replacement --}}
                    <div class="for replacement d-none">
                        <div class="d-flex gap-3">
                            <h3>For replacement</h3>
                            <hr class="flex-fill">
                        </div>

                        <div class="row ps-3 g-3 flex-fill">

                            <div class="col-md-12">
                                <label class="form-label text-info">Reasons</label>

                                <div class="container-fluid">
                                    <div class="row row-cols-4 @error('replacement_reasons') is-invalid @enderror @error('replacement_reason_others') is-invalid @enderror">
                                        {{-- dilapidated --}}
                                        <div class="col-3 form-check d-flex gap-2">
                                            <input class="form-check-input my-auto" type="checkbox" name="replacement_reasons[]" id="dilapidated" value="dilapidated">
                                            <label class="form-check-label fs-3" for="dilapidated">
                                                Dilapidated
                                            </label>
                                        </div>

                                        {{-- faded print --}}
                                        <div class="col-3 form-check d-flex gap-2">
                                            <input class="form-check-input my-auto" type="checkbox" name="replacement_reasons[]" id="faded_print" value="faded_print">
                                            <label class="form-check-label fs-3" for="faded_print">
                                                Faded Print
                                            </label>
                                        </div>

                                        {{-- erroneous entry --}}
                                        <div class="col-3 form-check d-flex gap-2">
                                            <input class="form-check-input my-auto" type="checkbox" name="replacement_reasons[]" id="erroneous_entry" value="erroneous_entry">
                                            <label class="form-check-label fs-3" for="erroneous_entry">
                                                Erroneous Entry
                                            </label>
                                        </div>

                                        {{-- change address --}}
                                        <div class="col-3 form-check d-flex gap-2">
                                            <input class="form-check-input my-auto" type="checkbox" name="replacement_reasons[]" id="change_address" value="change_address">
                                            <label class="form-check-label fs-3" for="change_address">
                                                Change Address
                                            </label>
                                        </div>

                                        {{-- change signature --}}
                                        <div class="col-3 form-check d-flex gap-2">
                                            <input class="form-check-input my-auto" type="checkbox" name="replacement_reasons[]" id="change_signature" value="change_signature">
                                            <label class="form-check-label fs-3" for="change_signature">
                                                Change Signature
                                            </label>
                                        </div>

                                        {{-- other reasons --}}
                                        <div class="col-9 form-check d-flex gap-2">
                                            <input class="form-check-input my-auto" type="checkbox" name="replacement_reasons[]" id="others" value="others">
                                            <label class="form-check-label fs-3" for="others">
                                                Others
                                            </label>
                                            <input type="text" class="form-control @error('replacement_reason_others') is-invalid @enderror" name="replacement_reason_others" id="replacement_reason_others">
                                        </div>

                                    </div>
                                    @error('replacement_reasons')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @error('replacement_reason_others')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>


                        </div>

                    </div>

                    {{-- for lost id --}}
                    <div class="for lost_id d-none">
                        <div class="d-flex gap-3">
                            <h3>For Lost ID</h3>
                            <hr class="flex-fill">
                        </div>

                        <div class="row ps-3 g-3 flex-fill">

                            {{-- date of loss --}}
                            <div class="col-4">
                                <label for="date_of_loss" class="form-label text-info">Date of Loss</label>
                                <input type="date" name="date_of_loss" class="form-control @error('date_of_loss') is-invalid @enderror" id="date_of_loss" value="{{ old('date_of_loss') }}">
                                @error('date_of_loss')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- lost_location --}}
                            <div class="col-8">
                                <label for="lost_location" class="form-label text-info">Where</label>
                                <input type="text" class="form-control @error('lost_location') is-invalid @enderror" name="lost_location" id="lost_location">
                                @error('lost_location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                    </div>

                    {{-- for transferee --}}
                    <div class="for transferee d-none">
                        <div class="d-flex gap-3">
                            <h3>For transferee</h3>
                            <hr class="flex-fill">
                        </div>

                        <div class="row ps-3 g-3 flex-fill">

                            {{-- transfer from --}}
                            <div class="col-6">
                                <label for="transfer_from" class="form-label text-info">Transfer from</label>
                                <input type="text" name="transfer_from" class="form-control @error('transfer_from') is-invalid @enderror" id="transfer_from" value="{{ old('transfer_from') }}">
                                @error('transfer_from')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- transfer to --}}
                            <div class="col-6">
                                <label for="transfer_to" class="form-label text-info">Transfer to</label>
                                <input type="text" class="form-control @error('transfer_to') is-invalid @enderror" name="transfer_to" id="transfer_to" value="{{ old('transfer_to') }}">
                                @error('transfer_to')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- transfer reason --}}
                            <div class="col-12">
                                <label for="transfer_reason" class="form-label text-info">Transfer reason</label>
                                <input type="text" class="form-control @error('transfer_reason') is-invalid @enderror" id="transfer_reason" name="transfer_reason" value="{{ old('transfer_reason') }}">
                                @error('transfer_reason')
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

            let purpose = $('form#application-form input[name=purpose]:checked').val()
            if (purpose !== 'new_registration' || purpose !== '') {
                $(`div.for.${purpose}`).removeClass('d-none')
                $(`div.for:not(.${purpose})`).addClass('d-none');
            }


            $('form#application-form input[name=purpose]').on('input', function(e) {
                $(`div.for.${this.value}`).removeClass('d-none')
                $(`div.for:not(.${this.value})`).addClass('d-none');

            })

        })()
    </script>
@endsection

@if ($errors->any())
    {{-- @dd($errors) --}}
@endif
