@extends('layouts.dashboard_layout')

@section('content')
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

        tbody>tr>td>img {
            max-height: 32px;
            max-width: 32px;
        }

        input[type="search"]::-webkit-search-decoration,
        input[type="search"]::-webkit-search-cancel-button,
        input[type="search"]::-webkit-search-results-button,
        input[type="search"]::-webkit-search-results-decoration {
            display: none;
        }
    </style>

    {{-- main content --}}
    <div id="main">
        {{-- page header --}}
        <div class="d-flex justify-content-between">
            {{-- page title --}}
            <h2 class="m-0">
                ID Applications
            </h2>

            {{-- search bar --}}
            <form action="/citizens" method="GET" id="search-barangay-form" class="input-group ms-auto w-auto">
                <div class="d-flex bg-light rounded-start">
                    <input type="search" class="form-control bg-transparent border-0" name="search" placeholder="Search citizen" value="{{ Request::get('search') }}">
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
            <div class="btn-toolbar ms-3" role="toolbar">
                <div class="btn-group" role="group">
                    <a href="/id_applications/apply" class="btn btn-secondary" data-has-tooltip="true" data-bs-placement="left" title="New application">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                        </svg>
                        <span class="visually-hidden">New application</span>
                    </a>
                </div>
            </div>

        </div>
        <hr style="min-height: 1px">
        {{-- table wrapper --}}
        <div class="bg-light table-wrapper">
            <table class="table table-borderless m-0 table-hover">
                <thead>
                    <tr class="shadow-sm bg-light">
                        <th scope="col">#</th>
                        <th scope="col">Purpose</th>
                        <th scope="col">Date applied</th>
                        <th scope="col">Date issued</th>
                        <th scope="col">OSCA ID</th>
                        <th scope="col">Full name</th>
                        <th scope="col" class="fit text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="table-bordered">
                    @foreach ($applications as $application)
                        <tr>
                            <th scope="row">{{ ($applications->currentPage() - 1) * 50 + $loop->index + 1 }}</th>
                            <td>{{ \App\Models\IdApplication::PURPOSE[$application->purpose] }}</td>
                            <td>{{ date('F j, Y', strtotime($application->date_applied)) }}</td>
                            <td>{{ date('F j, Y', strtotime($application->date_issued)) }}</td>
                            <td>{{ $application->osca_id }}</td>
                            <td>{{ "{$application->lastname}, {$application->firstname} {$application->middlename}" }}</td>
                            <td class="fit">
                                <a href="/id_applications/{{ $application->id }}" class="btn btn-success">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- pagination --}}
        <div class="d-flex mt-3 justify-content-between">
            @php
                $rowFrom = $applications->perPage() * ($applications->currentPage() - 1);
                $rowTo = $rowFrom + $applications->count();
            @endphp
            <p class="my-auto">
                Showing rows {{ $rowFrom }} - {{ $rowTo }} of {{ $applications->total() }}
            </p>
            <nav>
                <ul class="pagination mb-0">
                    <li class="page-item disabled text-dark">
                        <a class="page-link" href="#" tabindex="-1">Page</a>
                    </li>

                    @for ($i = 1; $i <= $applications->lastPage(); $i++)
                        <li class="page-item @if ($i == $applications->currentPage()) active @endif">
                            @if (Request::get('search'))
                                <a class="page-link" href="{{ url()->full() }}?page={{ $i }}" tabindex="-1">{{ $i }}</a>
                            @else
                                <a class="page-link" href="/citizens?page={{ $i }}" tabindex="-1">{{ $i }}</a>
                            @endif
                        </li>
                    @endfor
                </ul>
            </nav>
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

            $('#search-barangay-form>div>input[type=search]').on('change input', function() {
                if (this.value.length) {
                    $('#search-barangay-form>div>button').removeClass('opacity-0');
                } else {
                    $('#search-barangay-form>div>button').addClass('opacity-0');
                }
            })

            $('#search-barangay-form>div>button').on('click', function() {
                $('#search-barangay-form>div>input[type=search]').val('')
                $(this).addClass('opacity-0')
            })

        });
    </script>
@endsection
