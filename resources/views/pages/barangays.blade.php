@extends('layouts.dashboard_layout')

@section('title', 'Barangays')

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
        <div class="d-flex justify-content-between gap-2">
            {{-- page title --}}
            <h2 class="m-0">Manage barangays</h2>

            {{-- search bar --}}
            <form action="/barangays" method="GET" id="search-barangay-form" class="input-group ms-auto w-auto">
                <div class="d-flex bg-light rounded-start">
                    <input type="search" class="form-control bg-transparent border-0" name="search" placeholder="Search barangay" value="{{ Request::get('search') }}">
                    <button type="button" class="btn bg-transparent border-0 opacity-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                        </svg>
                    </button>
                </div>
                <button class="btn btn-primary" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg>
                </button>
            </form>

            {{-- button toolbar --}}
            <div class="btn-group" role="group" aria-label="Third group">

                {{-- add barangay button --}}
                @if (auth()->user()->type == 'admin')
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#add-barangay-modal" data-has-tooltip="true" data-bs-placement="bottom" title="Add barangay">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                        </svg>
                        <span class="visually-hidden">Add</span>
                    </button>
                @endif

                {{-- print barangays button --}}
                <a href="/print/barangays" class="btn btn-secondary" data-has-tooltip="true" data-bs-placement="bottom" title="Print barangays" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                    </svg>
                    <span class="visually-hidden">Print barangays</span>
                </a>
            </div>

        </div>


        <hr style="min-height: 1px">

        {{-- table wrapper --}}
        <div class="bg-light table-wrapper">
            <table class="table table-borderless m-0 table-hover">
                <thead>
                    <tr class="shadow-sm bg-light">
                        <th scope="col">#</th>
                        <th scope="col">Barangay</th>
                        <th scope="col">Contact person</th>
                        <th scope="col">Contact no.</th>
                        <th scope="col">Email</th>
                        <th scope="col" class="fit text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="table-bordered">
                    @foreach ($barangays as $barangay)
                        <tr>
                            <th scope="row">{{ ($barangays->currentPage() - 1) * 50 + $loop->index + 1 }}</th>
                            <td>{{ $barangay['barangay_name'] }}</td>
                            <td>{{ $barangay['contact_person'] }}</td>
                            <td>{{ $barangay['contact_no'] }}</td>
                            <td>{{ $barangay['email'] }}</td>
                            <td class="fit">
                                <a href="/barangays/{{ $barangay['id'] }}" class="btn btn-success">
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- pagination --}}
        <div class="d-flex mt-3 justify-content-between">
            @php
                $rowFrom = $barangays->perPage() * ($barangays->currentPage() - 1);
                $rowTo = $rowFrom + $barangays->count();
            @endphp
            <p class="my-auto">Showing rows {{ $rowFrom }} - {{ $rowTo }} of {{ $barangays->total() }}</p>

            <nav>
                <ul class="pagination mb-0">
                    <li class="page-item disabled text-dark">
                        <a class="page-link" href="#" tabindex="-1">Page</a>
                    </li>
                    @for ($i = 1; $i <= $barangays->lastPage(); $i++)
                        <li class="page-item @if ($i == $barangays->currentPage()) active @endif">
                            @if (Request::get('search'))
                                <a class="page-link" href="{{ url()->full() }}&page={{ $i }}" tabindex="-1">{{ $i }}</a>
                            @else
                                <a class="page-link" href="/barangays?page={{ $i }}" tabindex="-1">{{ $i }}</a>
                            @endif
                        </li>
                    @endfor
                </ul>
            </nav>
        </div>

    </div>

    {{-- add modal --}}
    <div class="modal fade text-dark" id="add-barangay-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add barangay</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add-barangay-form" class="needs-validation" method="POST" action="/barangays/add" novalidate>
                        @csrf
                        <div>
                            <label for="barangay_name" class="col-form-label">Barangay name</label>
                            <input type="text" class="form-control @error('on_insert') is-invalid @enderror" name="barangay_name" value="@error('on_insert') {{ old('barangay_name') }} @enderror" required>
                            @error('barangay_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="contact-person" class="col-form-label">Contact person</label>
                            <input type="text" class="form-control @error('on_insert') is-invalid @enderror" name="contact_person" value="@error('on_insert') {{ old('contact_person') }} @enderror" required>
                            @error('contact_person')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="contact_no" class="col-form-label">Contact no.</label>
                            <input type="text" class="form-control @error('on_insert') is-invalid @enderror" name="contact_no" value=" @error('on_insert') {{ old('contact_no') }} @enderror" required>
                            @error('contact_no')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="col-form-label">Email</label>
                            <input type="email" class="form-control @error('on_insert') is-invalid @enderror" name="email" value="@error('on_insert') {{ old('email') }} @enderror" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="add-barangay-form">Add</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-has-tooltip="true"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })

            $('.modal').on('hidden.bs.modal', function() {
                $(this).find('form :input:not([type=hidden])').removeClass('is-invalid').val('')
                $(this).find('form').removeClass('was-validated')
            })

            @error('on_insert')
                $('#add-barangay-modal').modal('show');
            @enderror

            $('#search-barangay-form>div>input[type=search]').on('change input', function() {
                if (this.value.length) {
                    $('#search-barangay-form>div>button').removeClass('opacity-0');
                } else {
                    $('#search-barangay-form>div>button').addClass('opacity-0');
                }
            })

            $('#search-barangay-form>div>button').on('click', function() {
                $('#search-barangay-form>div>input[type=search]').val('')
            })
        });
    </script>
@endsection
