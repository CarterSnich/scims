@extends('layouts.dashboard_layout')

@section('title', 'View PhilHealth Registration')

@section('style')
    <style>
        #main {
            display: flex;
            flex-flow: column;
            height: 100%;
        }

        #data-wrapper {
            display: block;
            overflow-y: auto;
            overflow-x: hidden
        }

        #picture-placeholder {
            min-height: 200px;
            min-width: 200px;
            max-height: 200px;
            max-width: 200px;
            aspect-ratio: 1/1
        }
    </style>

@endsection

@section('content')
    {{-- main content --}}
    <div id="main">

        {{-- page header --}}
        @if (false)
            {{-- page header --}}
            <div class="d-flex justify-content-between">
                <div class="d-flex gap-2">
                    {{-- go back button --}}
                    <a href="/philhealths" class="btn btn-secondary" data-has-tooltip="true" data-bs-placement="bottom" title="Go back">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                        </svg>
                        <span class="visually-hidden">Go back</span>
                    </a>
                    <h2 class="my-auto ">PhilHealth</h2>
                </div>
            </div>
            <hr style="min-height: 1px">
        @endif

        <div id="data-wrapper" class="flex-fill d-flex">
            <iframe id="pdf-viewer" class="flex-fill" frameborder="0"></iframe>
        </div>

    </div>

@endsection

@section('script')

    <meta name="form1" content="{{ asset('images/pmrf-1.jpg') }}">
    <meta name="form2" content="{{ asset('images/pmrf-2.jpg') }}">
    <meta name="philhealth" content="{{ json_encode($philhealth) }}">

    <script>
        (function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-has-tooltip="true"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        })()
    </script>

    <script src="{{ asset('js/jspdf.umd.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/pdf-philhealth.js') }}"></script>
@endsection
