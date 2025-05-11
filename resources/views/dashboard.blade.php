@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-5 text-center fw-bold display-5 animate__animated animate__fadeIn animate__delay-1s">📊 Attendance Trends Dashboard</h1>

    <!-- Summary Cards -->
    <div class="row mb-5 g-4">
        <div class="col-lg-4 col-md-6">
            <div class="card shadow-sm border-0 rounded-4 animate__animated animate__flipInX animate__delay-0.2s">
                <div class="card-body text-center p-5">
                    <div class="mb-3">
                        <i class="bi bi-person-circle fs-1 text-primary"></i>
                    </div>
                    <h6 class="text-muted">Total Students</h6>
                    <h2 class="fw-bold text-primary">{{ $totalStudents }}</h2>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card shadow-sm border-0 rounded-4 animate__animated animate__flipInX animate__delay-0.4s">
                <div class="card-body text-center p-5">
                    <div class="mb-3">
                        <i class="bi bi-check-circle-fill fs-1 text-success"></i>
                    </div>
                    <h6 class="text-muted">Total Attendance Logs</h6>
                    <h2 class="fw-bold text-success">{{ $attendanceCount }}</h2>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card shadow-sm border-0 rounded-4 animate__animated animate__flipInX animate__delay-0.6s">
                <div class="card-body p-5">
                    <h6 class="text-muted text-center mb-3">Attendance Summary by Status</h6>
                    <ul class="list-group list-group-flush">
                        @foreach ($attendancePerStatus as $attendance)
                            <li class="list-group-item d-flex justify-content-between">
                                <span>{{ $attendance->status }}</span>
                                <span class="fw-bold">{{ number_format($attendance->total) }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 rounded-4 animate__animated animate__fadeInUp animate__delay-0.8s">
                <div class="card-header bg-light text-center fw-bold fs-5 py-3">
                    Attendance by Status
                </div>
                <div class="card-body">
                    <canvas id="attendanceStatusChart" height="200"></canvas> <!-- Larger chart -->
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm border-0 rounded-4 animate__animated animate__fadeInUp animate__delay-1s">
                <div class="card-header bg-light text-center fw-bold fs-5 py-3">
                    Attendance Over Time
                </div>
                <div class="card-body">
                    <canvas id="attendanceTrendChart" height="200"></canvas> <!-- Larger chart -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Animate.css & Bootstrap Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"/>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Attendance Status Chart (Bar)
new Chart(document.getElementById('attendanceStatusChart'), {
    type: 'bar',
    data: {
        labels: {!! json_encode($attendancePerStatus->pluck('status')) !!},
        datasets: [{
            label: 'Count',
            data: {!! json_encode($attendancePerStatus->pluck('total')) !!},
            backgroundColor: ['#2196f3', '#4caf50', '#a40000'],
            borderRadius: 8,
            fill: true,
            tension: 0.4,
        }]
    },
    options: {
        animation: {
            duration: 1200,
            easing: 'easeInOutExpo'
        },
        responsive: true,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Attendance Trend Chart (Line)
new Chart(document.getElementById('attendanceTrendChart'), {
    type: 'line',
    data: {
        labels: {!! json_encode($attendancePerDay->pluck('date')) !!},
        datasets: [{
            label: 'Attendance Count',
            data: {!! json_encode($attendancePerDay->pluck('total')) !!},
            backgroundColor: 'rgba(173, 216, 230, 0.2)',  // Light blue
            borderColor: 'rgba(34, 139, 34, 1)',          // Dark green
            pointBackgroundColor: 'rgba(50, 205, 50, 1)',
            fill: true,
            tension: 0.4,
        }]
    },
    options: {
        animation: {
            duration: 1500,
            easing: 'easeInOutQuad'
        },
        responsive: true,
        plugins: {
            legend: { position: 'top' }
        },
        scales: {
            x: {
                ticks: {
                    autoSkip: true,
                    maxRotation: 45,
                    minRotation: 45,
                }
            },
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
@endsection
