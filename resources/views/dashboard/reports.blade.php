@extends('layouts.dashboard_layout')


@section('style')
    <style>
        table tbody tr {
            transition: all ease-in-out 0.1s
        }

        table tbody tr.enlarge {
            font-size: xx-large;
        }
    </style>
@endsection

@section('content')
    <div id="main" class="d-grid gap-3">
        {{-- summary counts --}}
        <div class="row">
            {{-- senior citizens --}}
            <div class="col">
                <div class="card text-white bg-primary mx-auto mb-3" style="max-width: 18rem;">
                    <div class="card-header">Senior Citizens</div>
                    <div class="card-body p-5">
                        <h1 class="card-text text-center" style="font-size: 42pt">{{ $citizens->count() }}</h2>
                    </div>
                </div>
            </div>
            {{-- barangays --}}
            <div class="col">
                <div class="card text-white bg-warning mx-auto mb-3" style="max-width: 18rem;">
                    <div class="card-header">Barangays</div>
                    <div class="card-body p-5">
                        <h1 class="card-text text-center" style="font-size: 42pt">{{ $barangays->count() }}</h2>
                    </div>
                </div>
            </div>
            {{-- lorem ipsum --}}
            <div class="col">
                <div class="card text-white bg-info mx-auto mb-3" style="max-width: 18rem;">
                    <div class="card-header">Lorem Ipsum</div>
                    <div class="card-body p-5">
                        <h1 class="card-text text-center" style="font-size: 42pt">42</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- charts --}}
        <div class="chart-wrapper" style="background-color: white; padding: 1.25rem; border-radius: .25rem">
            <h2 class="text-dark">Gender count per age</h2>
            <canvas id="age-reports-chart"></canvas>
        </div>

        {{-- gender reports table --}}
        <div class="chart-wrapper gender-reports-table" style="background-color: white; padding: 1.25rem; border-radius: .25rem">
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
