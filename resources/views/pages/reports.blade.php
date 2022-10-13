@extends('layouts.dashboard_layout')

@section('title', 'Reports')

@section('style')
    <style>
        .summary-counts>.col:nth-child(1)>.card {
            background-color: #0dcaf0;
        }

        .summary-counts>.col:nth-child(2)>.card {
            background-color: #ffc107;
        }

        .summary-counts>.col:nth-child(3)>.card {
            background-color: #0d6efd;
        }

        .summary-counts>.col:nth-child(4)>.card {
            background-color: #dc3545;
        }

        .card-logo {
            background-color: #000000aa
        }

        table tbody tr {
            transition: all ease-in-out 0.1s
        }

        table tbody tr.enlarge {
            font-size: xx-large;
        }


        .chart-wrapper,
        .table-wrapper {
            padding: 1.25rem;
            border-radius: .25rem;
            background-color: #ffffff;
        }
    </style>
@endsection

@section('content')
    <div id="main" class="d-grid gap-3">

        {{-- summary counts --}}
        <div class="row g-3 summary-counts">

            {{-- senior citizens --}}
            <div class="col">
                <div class="card text-white mx-auto" style="max-width: 18rem;">

                    <div class="card-body p-3 d-flex gap-3 align-items-center">
                        <div class="d-flex gap-2">
                            <div class="card-logo rounded-circle p-3 my-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"></path>
                                </svg>
                            </div>
                            <div>
                                <div>Senior Citizens</div>
                                <h1 class="mb-0">{{ $citizens->count() }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- barangays --}}
            <div class="col">
                <div class="card text-white mx-auto" style="max-width: 18rem;">
                    <div class="card-body p-3 d-flex gap-3 align-items-center">
                        <div class="d-flex gap-2">
                            <div class="card-logo rounded-circle p-3 my-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                                    <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"></path>
                                </svg>
                            </div>
                            <div>
                                <div>Barangays</div>
                                <h1 class="mb-0">{{ $barangays->count() }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- male citizens --}}
            <div class="col">
                <div class="card text-white mx-auto" style="max-width: 18rem;">
                    <div class="card-body p-3 d-flex gap-3 align-items-center">
                        <div class="d-flex gap-2">
                            <div class="card-logo rounded-circle p-3 my-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-gender-male" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M9.5 2a.5.5 0 0 1 0-1h5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V2.707L9.871 6.836a5 5 0 1 1-.707-.707L13.293 2H9.5zM6 6a4 4 0 1 0 0 8 4 4 0 0 0 0-8z" />
                                </svg>
                            </div>
                            <div>
                                <div>Male citizens</div>
                                <h1 class="mb-0">{{ $male_counts }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- female citizens --}}
            <div class="col">
                <div class="card text-white mx-auto" style="max-width: 18rem;">
                    <div class="card-body p-3 d-flex gap-3 align-items-center">
                        <div class="d-flex gap-2">
                            <div class="card-logo rounded-circle p-3 my-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-gender-female" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 1a4 4 0 1 0 0 8 4 4 0 0 0 0-8zM3 5a5 5 0 1 1 5.5 4.975V12h2a.5.5 0 0 1 0 1h-2v2.5a.5.5 0 0 1-1 0V13h-2a.5.5 0 0 1 0-1h2V9.975A5 5 0 0 1 3 5z" />
                                </svg>
                            </div>
                            <div>
                                <div>Female citizens</div>
                                <h1 class="mb-0">{{ $female_counts }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- charts --}}
        <div class="chart-wrapper">
            <h2 class="text-dark">Gender count per age</h2>
            <canvas id="age-reports-chart"></canvas>
        </div>

        {{-- gender reports table --}}
        <div class="table-wrapper">
            <h2 class="text-dark">Gender count per barangay</h2>
            <table class="table table-bordered table-striped mb-0">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Barangay</th>
                        <th scope="col">Male count</th>
                        <th scope="col">Female count</th>
                    </tr>
                </thead>
                <tbody title="Click a row to enlarge">
                    @foreach ($gender_reports as $barangay => $report)
                        <tr tabindex="0">
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td class="table-info">
                                <span>{{ $barangay }}</span>
                            </td>
                            <td class="table-primary">
                                <span>{{ $report['male'] }}</span>
                            </td>
                            <td class="table-danger">
                                <span>{{ $report['female'] }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection


@section('script')
    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script>
        (function() {
            const ageReports = {!! json_encode($age_reports) !!}

            const ageLabels = Object.keys(ageReports)
            const maleAgeCounts = []
            const femaleAgeCounts = []
            ageLabels.forEach(age => {
                maleAgeCounts.push(ageReports[`${age}`]['male'])
                femaleAgeCounts.push(ageReports[`${age}`]['female'])
            });

            const ageReportsData = {
                labels: ageLabels,
                datasets: [{
                        label: 'Male',
                        data: maleAgeCounts,
                        backgroundColor: '#229ff3',
                        borderColor: '#229ff3'
                    },
                    {
                        label: 'Female',
                        data: femaleAgeCounts,
                        backgroundColor: '#ff6384',
                        borderColor: '#ff6384'

                    }
                ]
            };

            const ageConfig = {
                type: 'line',
                data: ageReportsData,
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            ticks: {
                                precision: 0,
                            },
                        }
                    },
                },
            };

            const ageReportChart = new Chart(
                document.getElementById('age-reports-chart'),
                ageConfig
            );
        })()

        $('table tbody tr').on('click', function(e) {
            if ($(this).hasClass('enlarge')) {
                $(this).removeClass('enlarge')
            } else {
                $(this).addClass('enlarge').siblings().removeClass('enlarge')
            }
        })

        $('table tbody tr').on('blur', function(e) {
            $(this).removeClass('enlarge')
        })
    </script>
@endsection
