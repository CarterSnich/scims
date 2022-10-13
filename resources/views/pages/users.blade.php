@extends('layouts.dashboard_layout')

@section('title', 'User Accounts')

@section('style')
    <style>
        #main {
            display: flex;
            flex-flow: column;
            height: 100%;
        }

        .table-wrapper {
            flex-grow: 1;
            overflow: auto;
        }

        table>thead {
            position: sticky;
            top: 0;
        }

        .table td.fit,
        .table th.fit {
            white-space: nowrap;
            width: 1%;
        }
    </style>
@endsection

@section('content')
    <div id="main">

        {{-- page header --}}
        <div class="d-flex justify-content-between">
            {{-- page name --}}
            <h2 class="m-0">Manage user accounts</h2>

            {{-- button toolbar --}}
            <div class="btn-group" role="group" aria-label="Third group">
                {{-- add barangay button --}}
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-user-modal" data-has-tooltip="true" data-bs-placement="bottom" title="Add user account">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg>
                    <span class="visually-hidden">Add user</span>
                </button>
            </div>

        </div>

        <hr style="min-height: 1px">

        {{-- table wrapper --}}
        <div class="bg-light table-wrapper">
            <table class="table table-borderless m-0 table-hover">
                <thead>
                    <tr class="shadow-sm bg-light">
                        <th scope="col">#</th>
                        <th scope="col">Email</th>
                        <th scope="col">Name</th>
                        <th scope="col">User type</th>
                        <th scope="col" class="fit text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="table-bordered">
                    @foreach ($users as $user)
                        @if ($user['email'] == auth()->user()->email)
                            @continue
                        @endif
                        <tr>
                            <th scope="row">{{ $loop->index }}</th>
                            <td>{{ $user['email'] }}</td>
                            <td>{{ $user['name'] }}</td>
                            <td>{{ $user['type'] == 'admin' ? 'Administrator' : 'Staff' }}</td>
                            <td class="fit">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#reset-modal" data-user-id="{{ $user['id'] }}" data-user-email="{{ $user['email'] }}">Reset</button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-modal" data-user-id="{{ $user['id'] }}" data-user-email="{{ $user['email'] }}">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    {{-- add modal --}}
    <div class="modal fade text-dark" id="add-user-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add user account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add-user-form" class="needs-validation" method="POST" action="/users/add" novalidate>
                        @csrf
                        {{-- email --}}
                        <div>
                            <label for="email" class="col-form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- password --}}
                        <div>
                            <label for="password" class="col-form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- confirmation password --}}
                        <div>
                            <label for="password-confirmation" class="col-form-label">Confirm password</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password-confirmation" required>
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- name --}}
                        <div>
                            <label for="name" class="col-form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- user account type --}}
                        <div>
                            <label for="type" class="col-form-label">User account type</label>
                            <select class="form-select @error('type') is-invalid @enderror" name="type" required>
                                <option selected disabled value="">Select type</option>
                                <option value="admin" {{ old('type') == 'admin' ? 'selected' : '' }}>Administrator</option>
                                <option value="staff" {{ old('type') == 'staff' ? 'selected' : '' }}>Staff</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="add-user-form">Add</button>
                </div>
            </div>
        </div>
    </div>

    {{-- reset confirmation modal --}}
    <div class="modal fade text-dark" id="reset-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reset user account password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="reset-password-form" method="POST" action="" novalidate>
                        @csrf
                        <p>Please, alert the user before doing this action. This action will reset the password of the account and it <b>cannot</b> be undone.</p>
                        <p class="mb-1">To reset the password, type <span class="text-light px-1 bg-secondary rounded"></span> to confirm.</p>
                        <div class="d-grid gap-1">
                            <div>
                                <input type="text" class="form-control" data-match-input="" required>
                                <div class="invalid-feedback">
                                    Please match the input to required data.
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-danger" disabled>Reset password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- delete confirmation modal --}}
    <div class="modal fade text-dark" id="delete-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete user account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="delete-form" method="POST">
                        @csrf
                        @method('DELETE')
                        <h4>Delete user account <span class="text-primary"></span>?</h4>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" form="delete-form">Remove</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function() {
            let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-has-tooltip="true"]'))
            let tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })


            let addUserModal = document.getElementById('add-user-modal')

            @if ($errors->any())
                new bootstrap.Modal(addUserModal).show()
            @endif

            addUserModal.addEventListener('hidden.bs.modal', function() {
                $('form#add-user-form').removeClass('was-validated')
                $('form#add-user-form input:not([type=hidden])').val('')
                $('form#add-user-form input:not([type=hidden])').removeClass('is-invalid')
                $('form#add-user-form select')[0].selectedIndex = 0;
            })

            let resetModal = document.getElementById('reset-modal')
            resetModal.addEventListener('show.bs.modal', function(event) {
                let button = event.relatedTarget
                let userId = button.getAttribute('data-user-id')
                let email = button.getAttribute('data-user-email')

                // Update the modal's content.
                let form = resetModal.querySelector('#reset-password-form')
                let emailHolder = resetModal.querySelector('#reset-password-form span')
                let confirmInput = resetModal.querySelector('#reset-password-form input[type=text]')

                form.action = `users/${userId}/reset`
                emailHolder.innerText = email
                confirmInput.setAttribute('data-match-input', email)
            })

            $('#reset-password-form input[type=text]').on('change input', function() {
                $(this).parent().siblings('button[type=submit]').attr(
                    'disabled',
                    this.value != this.getAttribute('data-match-input')
                )
                $(this).removeClass('is-invalid')
            })

            $('#reset-password-form').on('submit', function(e) {
                let confirmInput = this.querySelector('input[type=text]');
                if (confirmInput.getAttribute('data-match-input') !== confirmInput.value) {
                    e.preventDefault();
                    confirmInput.classList.add('is-invalid')
                }
            })



            let deleteModal = document.getElementById('delete-modal')
            deleteModal.addEventListener('show.bs.modal', function() {
                let button = event.relatedTarget
                let userId = button.getAttribute('data-user-id')
                let email = button.getAttribute('data-user-email')

                $('form#delete-form').attr('action', `/users/${userId}/delete`)
                $('form#delete-form span').text(email)

            })

        });
    </script>
@endsection
