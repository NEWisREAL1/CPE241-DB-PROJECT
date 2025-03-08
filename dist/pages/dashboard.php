<span?php session_start(); if (!isset($_SESSION['admin'])) { header("Location: ./login.php"); } include 'db.php' ; ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>FlightDB | Dashboard</title>
        <!--begin::Primary Meta Tags-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="title" content="AdminLTE v4 | Dashboard" />
        <meta name="author" content="ColorlibHQ" />
        <meta name="description"
            content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS." />
        <meta name="keywords"
            content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
            integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" />
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
            integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
            integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
        <link rel="stylesheet" href="../../dist/css/adminlte.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
            integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
            integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous" />
    </head>

    <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
        <!--begin::App Wrapper-->
        <div class="app-wrapper">

            <!--begin::Header-->
            <nav class="app-header navbar navbar-expand bg-body">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Start Navbar Links-->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                                <i class="bi bi-list"></i>
                            </a>
                        </li>
                    </ul>
                    <!--end::Start Navbar Links-->
                    <!--begin::End Navbar Links-->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item d-none d-md-block">
                            <a href="logout.php?logout=true" class="nav-link">
                                <button type="button" class="btn btn-outline-danger mb-2 btn-sm">Logout</button>
                            </a>
                        </li>
                    </ul>
                    <!--end::End Navbar Links-->
                </div>
                <!--end::Container-->
            </nav>
            <!--end::Header-->

            <!--begin::Sidebar-->
            <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
                <!--begin::Sidebar Brand-->
                <div class="sidebar-brand">
                    <!--begin::Brand Link-->
                    <a href="./index.html" class="brand-link">
                        <!--begin::Brand Text-->
                        <span class="brand-text fw-light">FlightDB Admin</span>
                        <!--end::Brand Text-->
                    </a>
                    <!--end::Brand Link-->
                </div>
                <!--end::Sidebar Brand-->
                <!--begin::Sidebar Wrapper-->
                <div class="sidebar-wrapper">
                    <nav class="mt-2">
                        <!--begin::Sidebar Menu-->
                        <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                            data-accordion="false">

                            <li class="nav-item menu-open">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon bi bi-bar-chart-line"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item menu-open">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon bi bi-table"></i>
                                    <p>
                                        Manage Table
                                        <i class="nav-arrow bi bi-chevron-right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="manage.php" class="nav-link">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>View Table</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                        <!--end::Sidebar Menu-->
                    </nav>
                </div>
                <!--end::Sidebar Wrapper-->
            </aside>
            <!--end::Sidebar-->

            <!--begin::App Main-->
            <main class="app-main">

                <div class="app-content-header">
                    <div class="container-fluid">
                        <h3 class="mb-0">FlightDB Dashboard</h3>
                    </div>
                    <!--end::container-fluid-->
                </div>
                <!-- /.app-content-header -->
                <div class="app-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card mb-4">
                                    <div class="card-header border-0">
                                        <div class="d-flex justify-content-between">
                                            <h3 class="card-title">Sales</h3>
                                            <a href="javascript:void(0);"
                                                class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">View
                                                Report</a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <p class="d-flex flex-column">
                                                <span class="fw-bold fs-5">Class Counts</span> <span>Table:
                                                    seat_temporary</span>
                                            </p>
                                            <p class="ms-auto d-flex flex-column text-end">
                                                <span class="text-success"> <i class="bi bi-airplane"></i><span
                                                        id="total-seat-count" class="ml-1"></span></span>
                                                <span class="text-secondary">total seat count</span>
                                            </p>
                                        </div>
                                        <!-- /.d-flex -->
                                        <div class="position-relative mb-4">
                                            <canvas id="count-chart"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col-lg-6 -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- /.app-content -->

            </main>
            <!--end::App Main-->

        </div>
        <!--end::App Wrapper-->

        <!--begin::Script-->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <!--begin::Third Party Plugin(OverlayScrollbars)-->
        <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
            integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
        <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"></script>
        <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
            integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
            crossorigin="anonymous"></script>
        <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
        <script src="../../dist/js/adminlte.js"></script>
        <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
        <script>
            const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
            const Default = {
                scrollbarTheme: 'os-theme-light',
                scrollbarAutoHide: 'leave',
                scrollbarClickScroll: true,
            };
            document.addEventListener('DOMContentLoaded', function () {
                const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
                if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
                    OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                        scrollbars: {
                            theme: Default.scrollbarTheme,
                            autoHide: Default.scrollbarAutoHide,
                            clickScroll: Default.scrollbarClickScroll,
                        },
                    });
                }
            });
        </script>
        <!--end::OverlayScrollbars Configure-->
        <script>
            async function fetchData() {
                const response = await fetch('../api/api.php?table=seat_temporary');
                const data = await response.json();

                console.log(data);

                const labels = ['E', 'P', 'B', 'F'];
                const values = labels.map(label => {
                    const item = data.grouped_by_class.find(item => item.class === label);
                    return item ? item.count : 0; // Default to 0 if the class is not found
                });

                const ctx = document.getElementById('count-chart').getContext('2d');
                const total_elt = document.getElementById('total-seat-count');
                total_elt.textContent = data.total_records;
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Seats Count',
                            data: values,
                            backgroundColor: [
                                'rgba(116, 255, 116, 0.5)', // E
                                'rgba(237, 255, 33, 0.5)', // P
                                'rgba(135, 64, 155, 0.5)', // B
                                'rgba(35, 35, 35, 0.5)'  // F
                            ],
                            borderColor: 'rgb(40, 40, 40)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: { beginAtZero: true }
                        }
                    }
                });
            }

            fetchData();
        </script>
        <!--end::Count Chart-->
    </body>

    </html>