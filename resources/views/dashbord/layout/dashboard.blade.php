@extends("dashbord.masterpage")

@section("content")
<div class="container-fluid py-4">
    <h1 class="text-center mb-5 section-title">Barber Shop Analytics Dashboard</h1>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-5">
        <!-- Total Clients -->
        <div class="col-md-3">
            <div class="stat-card p-3 text-center">
                <h5 class="stat-label mb-3">Total Clients</h5>
                @if(isset($stats))
                    <p class="stat-value">{{ $stats['total_users'] ?? 0 }}</p>
                    <p class="stat-value">{{ $stats['new_users'] ?? 0 }} new clients</p>
                @else
                    <p class="stat-value">No data available</p>
                @endif
            </div>
        </div>

        <!-- Total Appointments -->
        <div class="col-md-3">
            <div class="stat-card p-3 text-center">
                <h5 class="stat-label mb-3">Total Appointments</h5>
                @if(isset($stats))
                    <p class="stat-value">{{ $stats['total_appointments'] ?? 0 }}</p>
                    <small class="text-muted">{{ $stats['completed_appointments'] ?? 0 }} completed</small>
                @else
                    <p class="stat-value">No data available</p>
                @endif
            </div>
        </div>

        <!-- Available Services -->
        <div class="col-md-3">
            <div class="stat-card p-3 text-center">
                <h5 class="stat-label mb-3">Available Services</h5>
                @if(isset($stats))
                    <p class="stat-value">{{ $stats['total_services'] ?? 0 }}</p>
                @else
                    <p class="stat-value">No data available</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Monthly Appointments Trend -->
    <div class="col-md-12 mt-4">
        <div class="chart-container">
            <h5 class="section-title mb-4">Monthly Appointments Trend</h5>
            <canvas id="monthlyTrendChart"></canvas>
        </div>
    </div>

    <!-- Appointments by Status Chart -->
    <div class="col-md-6 mt-4">
        <div class="chart-container">
            <h5 class="section-title mb-4">Appointments by Status</h5>
            <canvas id="statusChart"></canvas>
        </div>
    </div>

</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Data for Monthly Appointments Trend Chart
        const monthlyTrendData = @json($monthlyTrendData ?? []);
        const monthlyTrendLabels = @json($monthlyTrendLabels ?? []);
        const ctxMonthlyTrend = document.getElementById('monthlyTrendChart').getContext('2d');

        new Chart(ctxMonthlyTrend, {
            type: 'line',
            data: {
                labels: monthlyTrendLabels,
                datasets: [{
                    label: 'Appointments',
                    data: monthlyTrendData,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    }
                }
            }
        });

        // Data for Appointments by Status Chart
        const statusData = @json($statusData ?? []);
        const statusLabels = @json($statusLabels ?? []);
        const ctxStatusChart = document.getElementById('statusChart').getContext('2d');

        new Chart(ctxStatusChart, {
            type: 'pie',
            data: {
                labels: statusLabels,
                datasets: [{
                    label: 'Status',
                    data: statusData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    }
                }
            }
        });
    });
</script>
@endsection
