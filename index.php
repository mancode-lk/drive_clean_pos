<?php include("layout/header.php"); ?>

<!-- Start::app-content -->
<div class="main-content app-content">
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div>
                <h1 class="page-title fw-semibold fs-20 mb-0">Comprehensive Dashboard</h1>
                <div>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Page Header Close -->

        <!-- Summary Metrics Section -->
        <div class="row">
            <!-- Metric Cards -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <h5 class="card-title text-muted">Total Revenue</h5>
                        <h3 class="card-text fw-bold">LKR 1,500,000</h3>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <h5 class="card-title text-muted">Completed Bookings</h5>
                        <h3 class="card-text fw-bold">120</h3>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <h5 class="card-title text-muted">Pending Bookings</h5>
                        <h3 class="card-text fw-bold">15</h3>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <h5 class="card-title text-muted">Top Staff</h5>
                        <h3 class="card-text fw-bold">Michael (40 Bookings)</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow border-0 mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Staff Performance Overview</h5>
                    </div>
                    <div class="card-body">
                        <!-- Table for Staff Progress Report -->
                        <table class="table table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>Staff Name</th>
                                    <th>Total Bookings</th>
                                    <th>Completed Bookings</th>
                                    <th>Pending Bookings</th>
                                    <th>Overdue Bookings</th>
                                    <th>Revenue Generated (LKR)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Michael</td>
                                    <td>50</td>
                                    <td>40</td>
                                    <td>5</td>
                                    <td>5</td>
                                    <td>LKR 400,000</td>
                                </tr>
                                <tr>
                                    <td>Sarah</td>
                                    <td>30</td>
                                    <td>25</td>
                                    <td>3</td>
                                    <td>2</td>
                                    <td>LKR 300,000</td>
                                </tr>
                                <tr>
                                    <td>John</td>
                                    <td>40</td>
                                    <td>35</td>
                                    <td>2</td>
                                    <td>3</td>
                                    <td>LKR 350,000</td>
                                </tr>
                                <!-- Add more staff rows as needed -->
                            </tbody>
                        </table>

                        <!-- Charts Section -->
                        <div class="row mt-4">
                            <!-- Individual Staff Charts -->
                            <div class="col-md-6 col-xl-4 mb-4">
                                <div class="card shadow border-0">
                                    <div class="card-header bg-secondary text-white">
                                        <h6 class="mb-0">Michael's Performance</h6>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="michaelChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4 mb-4">
                                <div class="card shadow border-0">
                                    <div class="card-header bg-secondary text-white">
                                        <h6 class="mb-0">Sarah's Performance</h6>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="sarahChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4 mb-4">
                                <div class="card shadow border-0">
                                    <div class="card-header bg-secondary text-white">
                                        <h6 class="mb-0">John's Performance</h6>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="johnChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Chart for Michael's Performance
            const michaelCtx = document.getElementById('michaelChart').getContext('2d');
            new Chart(michaelCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Completed', 'Pending', 'Overdue'],
                    datasets: [{
                        data: [40, 5, 5],
                        backgroundColor: ['#4CAF50', '#FFC107', '#F44336']
                    }]
                }
            });

            // Chart for Sarah's Performance
            const sarahCtx = document.getElementById('sarahChart').getContext('2d');
            new Chart(sarahCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Completed', 'Pending', 'Overdue'],
                    datasets: [{
                        data: [25, 3, 2],
                        backgroundColor: ['#4CAF50', '#FFC107', '#F44336']
                    }]
                }
            });

            // Chart for John's Performance
            const johnCtx = document.getElementById('johnChart').getContext('2d');
            new Chart(johnCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Completed', 'Pending', 'Overdue'],
                    datasets: [{
                        data: [35, 2, 3],
                        backgroundColor: ['#4CAF50', '#FFC107', '#F44336']
                    }]
                }
            });
        </script>

        <!-- Charts Section -->
        <div class="row">
            <!-- Revenue Chart -->
            <div class="col-xl-6 col-md-12 mb-4">
                <div class="card shadow border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Monthly Revenue (LKR)</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>
            <!-- Service Popularity Chart -->
            <div class="col-xl-6 col-md-12 mb-4">
                <div class="card shadow border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Most Popular Services</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="servicesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detailed Reports Section -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow border-0 mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Detailed Bookings Report</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Vehicle</th>
                                    <th>Services</th>
                                    <th>Total Bill Amount (LKR)</th>
                                    <th>Estimated Completion</th>
                                    <th>Booked Time</th>
                                    <th>Staff</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>John Doe</td>
                                    <td>Toyota Prius</td>
                                    <td>Oil Change</td>
                                    <td>LKR 10,000</td>
                                    <td>2025-01-10</td>
                                    <td>2025-01-08 10:00 AM</td>
                                    <td>Michael</td>
                                    <td>Completed</td>
                                </tr>
                                <tr>
                                    <td>Jane Smith</td>
                                    <td>Honda Civic</td>
                                    <td>Tire Replacement</td>
                                    <td>LKR 15,000</td>
                                    <td>2025-01-11</td>
                                    <td>2025-01-09 02:00 PM</td>
                                    <td>Sarah</td>
                                    <td>In Progress</td>
                                </tr>
                                <!-- Add more dummy rows -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- End::app-content -->

<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Content -->
        </div>
    </div>
</div>
<?php include("layout/footer.php"); ?>

<!-- Add Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Monthly Revenue Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Revenue (LKR)',
                data: [150000, 200000, 180000, 250000, 300000, 400000, 350000, 300000, 280000, 320000, 400000, 450000],
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true,
                tension: 0.4
            }]
        }
    });

    // Services Popularity Chart
    const servicesCtx = document.getElementById('servicesChart').getContext('2d');
    new Chart(servicesCtx, {
        type: 'pie',
        data: {
            labels: ['Oil Change', 'Tire Replacement', 'Car Wash', 'Brake Repair', 'Battery Replacement'],
            datasets: [{
                data: [30, 25, 20, 15, 10],
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF']
            }]
        }
    });
</script>
