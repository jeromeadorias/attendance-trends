@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-5 text-center fw-bold display-5 animate__animated animate__fadeInDown">📈 Attendance Trends Dashboard</h1>

    <!-- Summary Cards -->
    <div class="row mb-5 g-4">
        <div class="col-md-6">
            <div class="card shadow border-0 rounded-4 animate__animated animate__zoomIn">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="bi bi-people-fill fs-1 text-primary"></i>
                    </div>
                    <h6 class="text-muted">Total Students</h6>
                    <h2 class="fw-bold text-primary">{{ $totalStudents }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow border-0 rounded-4 animate__animated animate__zoomIn" style="animation-delay: 0.2s;">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="bi bi-journal-check fs-1 text-success"></i>
                    </div>
                    <h6 class="text-muted">Total Attendance Logs</h6>
                    <h2 class="fw-bold text-success">{{ $attendanceCount }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card shadow border-0 rounded-4 animate__animated animate__fadeInUp">
                <div class="card-header bg-white border-bottom-0 text-center fw-bold fs-5 py-3">
                    Attendance by Status
                </div>
                <div class="card-body">
                    <canvas id="attendanceStatusChart" height="200"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow border-0 rounded-4 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                <div class="card-header bg-white border-bottom-0 text-center fw-bold fs-5 py-3">
                    Attendance Over Time
                </div>
                <div class="card-body">
                    <canvas id="attendanceTrendChart" height="200"></canvas>
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
            backgroundColor: ['#28a745', '#ffc107', '#dc3545'],
            borderRadius: 6,
        }]
    },
    options: {
        animation: {
            duration: 1200,
            easing: 'easeOutBounce'
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
            backgroundColor: 'rgba(0, 123, 255, 0.2)',
            borderColor: 'rgba(0, 123, 255, 1)',
            pointBackgroundColor: 'rgba(0, 123, 255, 1)',
            fill: true,
            tension: 0.4,
        }]
    },
    options: {
        animation: {
            duration: 1500,
            easing: 'easeInOutQuart'
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
