@extends('layouts.dashboard_layout')


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

        {{-- charts --}}
        <div class="chart-wrapper" style="background-color: white; padding: 1.25rem; border-radius: .25rem">
            <h2 class="text-dark">Gender count per barangay</h2>
            <canvas id="gender-reports-chart"></canvas>
        </div>

    </div>
@endsection


@section('script')
    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script>
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
                    backgroundColor: [
                        '#229ff3'
                    ],
                },
                {
                    label: 'Female',
                    data: femaleAgeCounts,
                    backgroundColor: [
                        '#ff6384'
                    ]
                }
            ]
        };

        const ageConfig = {
            type: 'bar',
            data: ageReportsData,
            options: {
                responsive: true,
                scales: {
                    y: {
                        ticks: {
                            precision: 0,
                        },
                    }
                }
            },
        };

        const ageReportChart = new Chart(
            document.getElementById('age-reports-chart'),
            ageConfig
        );

        const genderReports = {!! json_encode($gender_reports) !!}

        const barangayLabels = Object.keys(genderReports)
        const maleBarangayCounts = []
        const femaleBarangayCounts = []
        barangayLabels.forEach(barngay => {
            maleBarangayCounts.push(genderReports[`${barngay}`]['male'])
            femaleBarangayCounts.push(genderReports[`${barngay}`]['female'])
        });
        const barangayReportsData = {
            labels: barangayLabels,
            datasets: [{
                    label: 'Male',
                    data: maleBarangayCounts,
                    backgroundColor: [
                        '#229ff3'
                    ],
                },
                {
                    label: 'Female',
                    data: femaleBarangayCounts,
                    backgroundColor: [
                        '#ff6384'
                    ]
                }
            ]
        };

        const genderConfig = {
            type: 'bar',
            data: barangayReportsData,
            options: {
                responsive: true,
                scales: {
                    y: {
                        ticks: {
                            precision: 0,
                        },
                    }
                }
            },
        };

        const genderReportsChart = new Chart(
            document.getElementById('gender-reports-chart'),
            genderConfig
        )
    </script>
@endsection
