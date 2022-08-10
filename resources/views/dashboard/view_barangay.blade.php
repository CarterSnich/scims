@extends('layouts.dashboard_layout')

@section('style')
    <style>
        #main {
            display: flex;
            flex-flow: column;
            height: 100%;
        }

        #barangay-data-wrapper {
            display: block;
            overflow-y: auto;
            overflow-x: hidden
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
            <div class="d-flex gap-2">
                {{-- go back button --}}
                <a href="/barangays" class="btn btn-secondary" data-has-tooltip="true" data-bs-placement="bottom" title="Go back">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                    </svg>
                    <span class="visually-hidden">Go back</span>
                </a>
                {{-- page title --}}
                <h2 class="m-0">Barangay {{ $barangay['barangay_name'] }}</h2>
            </div>
            {{-- button toolbar --}}
            <div class="btn-toolbar gap-2" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group" role="group" aria-label="Third group">

                    {{-- edit barangay button --}}
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#edit-barangay-modal" data-has-tooltip="true" data-bs-placement="bottom" title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"></path>
                        </svg>
                        <span class="visually-hidden">Print all</span>
                    </button>

                    {{-- print barangays button --}}
                    <button type="button" class="btn btn-secondary" data-has-tooltip="true" data-bs-placement="bottom" title="Print all">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                            <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                            <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                        </svg>
                        <span class="visually-hidden">Print all</span>
                    </button>
                </div>
                {{-- delete barangay modal button --}}
                <button type="button" class="btn btn-danger" data-has-tooltip="true" data-bs-placement="bottom" title="Delete barangay" data-bs-toggle="modal" data-bs-target="#delete-barangay-modal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                    </svg>
                    <span class="visually-hidden">Delete</span>
                </button>
            </div>
        </div>

        <hr style="min-height: 1px">

        {{-- barangay data wrapper --}}
        <div id="barangay-data-wrapper" class="bg-dark gap-3">
            <div class="d-flex flex-column px-3 gap-5">
                <div class="row g-3 mb-3">
                    <div class="col-12 d-flex">
                        <h3 class="h3 mb-0 me-3">Contact information</h3>
                        <hr class="flex-fill">
                    </div>
                    <div class="col-12 row g-3 mt-0 ps-4">
                        <div class="col-md-4">
                            <label for="lastname" class="form-label text-info">Contact person</label>
                            <h4 id="firstname">{{ $barangay['contact_person'] }}</h4>
                        </div>
                        <div class="col-md-4">
                            <label for="firstname" class="form-label text-info">Contact number</label>
                            <h4 id="middlename">{{ $barangay['contact_no'] }}</h4>
                        </div>
                        <div class="col-md-4">
                            <label for="middlename" class="form-label text-info">Contact email</label>
                            <h4 id="lastname" class="">{{ $barangay['email'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            {{-- residents table wrapper --}}
            <div class="d-flex flex-column px-3 gap-5">
                <div class="row g-3">
                    <div class="col-12 d-flex">
                        <h3 class="h3 mb-0 me-3">Residents</h3>
                        <hr class="flex-fill">
                    </div>
                    <div class="col-12 row g-3 mt-0">
                        <div class="col-md-12">
                            {{-- table --}}
                            <div class="table-wrapper mx-3 bg-light">
                                <table class="table table-borderless m-0 table-hover">
                                    <thead>
                                        <tr class="shadow-sm bg-light">
                                            <th scope="col">#</th>
                                            <th scope="col">Senior Citizen ID</th>
                                            <th scope="col">Last name</th>
                                            <th scope="col">First name</th>
                                            <th scope="col">Middle name</th>
                                            <th scope="col" class="fit text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-bordered">
                                        @foreach ($citizens as $citizen)
                                            <tr>
                                                <th scope="row">{{ ($citizens->currentPage() - 1) * $citizens->perPage() + $loop->index + 1 }}</th>
                                                <td>{{ date('Y', strtotime($citizen['created_at'])) . '-' . str_pad($citizen['id'], 5, '0', STR_PAD_LEFT) }}</td>
                                                <td>{{ $citizen['lastname'] }}</td>
                                                <td>{{ $citizen['firstname'] }}</td>
                                                <td>{{ $citizen['middlename'] }}</td>
                                                <td class="fit">
                                                    <a href="/citizens/{{ $citizen['id'] }}" class="btn btn-success">View</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- pagination --}}
                            <div class="d-flex m-3 justify-content-between">
                                @php
                                    $rowFrom = $citizens->perPage() * ($citizens->currentPage() - 1);
                                    $rowTo = $rowFrom + $citizens->count();
                                @endphp
                                <p class="my-auto">Showing rows {{ $rowFrom }} - {{ $rowTo }} of {{ $citizens->total() }}</p>
                                <nav>
                                    <ul class="pagination mb-0">
                                        <li class="page-item disabled text-dark">
                                            <a class="page-link" href="#" tabindex="-1">Page</a>
                                        </li>

                                        @for ($i = 1; $i <= $citizens->lastPage(); $i++)
                                            <li class="page-item @if ($i == $citizens->currentPage()) active @endif">
                                                <a class="page-link" href="/barangays/{{ $barangay['id'] }}?page={{ $i }}" tabindex="-1">{{ $i }}</a>
                                            </li>
                                        @endfor
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- edit modal --}}
    <div class="modal fade text-dark" id="edit-barangay-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit barangay</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-barangay-form" class="needs-validation" method="POST" action="/barangays/{{ $barangay['id'] }}/update" novalidate>
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="barangay_name" class="col-form-label">Barangay name</label>
                            <input type="text" class="form-control @error('barangay_name') is-invalid @enderror" name="barangay_name" value="{{ $barangay['barangay_name'] }}" required>
                            @error('barangay_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="contact-person" class="col-form-label">Contact person</label>
                            <input type="text" class="form-control @error('contact_person') is-invalid @enderror" name="contact_person" value="{{ $barangay['contact_person'] }}" required>
                            @error('contact_person')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="contact_no" class="col-form-label">Contact no.</label>
                            <input type="text" class="form-control @error('contact_no') is-invalid @enderror" name="contact_no" value="{{ $barangay['contact_no'] }}" required>
                            @error('contact_no')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="col-form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $barangay['email'] }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="edit-barangay-form">Update</button>
                </div>
            </div>
        </div>
    </div>

    {{-- delete confirmation modal --}}
    <div class="modal fade text-dark" id="delete-barangay-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete barangay</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="delete-barangay-form" method="POST" action="/barangays/{{ $barangay['id'] }}/destroy" novalidate>
                        @csrf
                        @method('DELETE')
                        <h4>Delete Bgry. {{ $barangay['barangay_name'] }}?</h4>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" form="delete-barangay-form">Delete</button>
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


            let editBarangayModal = document.getElementById('edit-barangay-modal')

            @if ($errors->any())
                new bootstrap.Modal(editBarangayModal).show()
            @endif

            editBarangayModal.addEventListener('hidden.bs.modal', function() {
                editBarangayModal.querySelector('form#edit-barangay-form').reset()
                $('form#edit-barangay-form').removeClass('was-validated')
                $('form#edit-barangay-form :input').removeClass('is-invalid')
            })
        });
    </script>
@endsection
