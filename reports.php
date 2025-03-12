<?php session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ./login.php");
}
define("NAVIGATE_PHP", true);
include 'navigate.php';
include 'db.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>FlightDB | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="AdminLTE v4 | Dashboard" />
    <meta name="author" content="ColorlibHQ" />
    <meta name="description"
        content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS." />
    <meta name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
        integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
        integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
        integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/adminlte.css" />
    <script src="https://cdn.plot.ly/plotly-3.0.0.min.js" charset="utf-8"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.17/d3.min.js'></script>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    <script>
        $(function () {
            var dateFormat = "mm/dd/yy",
                from = $("#from")
                    .datepicker({
                        defaultDate: "+1w",
                        changeMonth: true,
                        numberOfMonths: 3
                    })
                    .on("change", function () {
                        to.datepicker("option", "minDate", getDate(this));
                    }),
                to = $("#to").datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 3
                })
                    .on("change", function () {
                        from.datepicker("option", "maxDate", getDate(this));
                    });

            function getDate(element) {
                var date;
                try {
                    date = $.datepicker.parseDate(dateFormat, element.value);
                } catch (error) {
                    date = null;
                }

                return date;
            }
        });
    </script>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item d-none d-md-block">
                        <a href="logout.php?logout=true" class="nav-link">
                            <button type="button" class="btn btn-outline-danger mb-2 btn-sm">Logout</button>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <div class="sidebar-brand">
                <a href="./index.html" class="brand-link">
                    <span class="brand-text fw-light">FlightDB Admin</span>
                </a>
            </div>
            <div class="sidebar-wrapper">
                <?php navigatePanel("report"); ?>
            </div>
        </aside>

        <main class="app-main">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row my-2 mx-0">
                        <div class="col-sm-6">
                            <h1>FlightDB Reports</h1>
                        </div>
                        <div class="col-sm-6 text-end">
                            <form method="get" class="m-auto">
                                <label for="from">From</label>
                                <input type="text" id="from" name="from">
                                <label for="to">to</label>
                                <input type="text" id="to" name="to">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon text-bg-primary shadow-sm">
                                    <i class="bi bi-check-circle-fill"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Bookings</span>
                                    <span id="total-booking" class="info-box-number">1,661</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon text-bg-success shadow-sm">
                                    <i class="bi bi-currency-dollar"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Revenue</span>
                                    <span id="total-revenue" class="info-box-number inline">$0</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon text-bg-warning text-white shadow-sm">
                                    <i class="bi bi-tag-fill"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Average Booking Price</span>
                                    <span id="avg-price" class="info-box-number">$0</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon text-bg-danger shadow-sm">
                                    <i class="bi bi-x-circle-fill"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Cancellation Rate</span>
                                    <span id="cancel-rate" class="info-box-number">0%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card mb-4">
                                <div class="card-header border-0">
                                    <h3 class="card-title">
                                        <i class="fas fa-map-marker-alt mr-1"></i>
                                        Popular Routes
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-primary btn-sm"
                                            data-lte-toggle="card-collapse">
                                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <table class='table table-striped m-0'>
                                        <thead>
                                            <tr class="text-end">
                                                <th class="text-start">Route</th>
                                                <th>Boookings</th>
                                                <th>Revenue</th>
                                                <th>Avg.Price</th>
                                                <th>Cancellations</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td id="route-1">TARO - MOVA</td>
                                                <td id="route-1-book" style="text-align: right;">540</td>
                                                <td id="route-1-revenue" style="text-align: right;">$75,600.00</td>
                                                <td id="route-1-avg-price" style="text-align: right;">$140.50</td>
                                                <td id="route-1-cancel" style="text-align: right;">3.2%</td>
                                            </tr>
                                            <tr>
                                                <td id="route-2">ZEN - MOVA</td>
                                                <td id="route-2-book" style="text-align: right;">485</td>
                                                <td id="route-2-revenue" style="text-align: right;">$56,600.12</td>
                                                <td id="route-2-avg-price" style="text-align: right;">$140.00</td>
                                                <td id="route-2-cancel" style="text-align: right;">4.1%</td>
                                            </tr>
                                            <tr>
                                                <td id="route-3">MOVA - ZEN</td>
                                                <td id="route-3-book" style="text-align: right;">410</td>
                                                <td id="route-3-revenue" style="text-align: right;">$49,000.95</td>
                                                <td id="route-3-avg-price" style="text-align: right;">$198.00</td>
                                                <td id="route-3-cancel" style="text-align: right;">5.0%</td>
                                            </tr>
                                            <tr>
                                                <td id="route-4">BKK - LYRA</td>
                                                <td id="route-4-book" style="text-align: right;">347</td>
                                                <td id="route-4-revenue" style="text-align: right;">$37,078.81</td>
                                                <td id="route-4-avg-price" style="text-align: right;">$121.56</td>
                                                <td id="route-4-cancel" style="text-align: right;">1.3%</td>
                                            </tr>
                                            <tr>
                                                <td id="route-5">LYRA - BKK</td>
                                                <td id="route-5-book" style="text-align: right;">295</td>
                                                <td id="route-5-revenue" style="text-align: right;">$30,890.00</td>
                                                <td id="route-5-avg-price" style="text-align: right;">$187.74</td>
                                                <td id="route-5-cancel" style="text-align: right;">0.5%</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-header border-0">
                                    <h3 class="card-title">
                                        <i class="fas fa-map-marker-alt mr-1"></i>
                                        Booking Trend
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-primary btn-sm"
                                            data-lte-toggle="card-collapse">
                                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body pb-0">
                                    <div id="booking-trend"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card mb-4">
                                <div class="card-header border-0">
                                    <h3 class="card-title">
                                        <i class="fas fa-map-marker-alt mr-1"></i>
                                        Customers Insight
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-primary btn-sm"
                                            data-lte-toggle="card-collapse">
                                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body pb-0">
                                    <div id="customer-pie" style="min-height: 120px;"></div>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-header border-0">
                                    <h3 class="card-title">
                                        <i class="fas fa-map-marker-alt mr-1"></i>
                                        Top Payment Methods
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-primary btn-sm"
                                            data-lte-toggle="card-collapse">
                                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body pb-0">
                                    <div id="payment-method-pie" style="min-height: 120px;"></div>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-header border-0">
                                    <h3 class="card-title">
                                        <i class="fas fa-map-marker-alt mr-1"></i>
                                        Total Revenue Growth
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-primary btn-sm"
                                            data-lte-toggle="card-collapse">
                                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                        <p class="text-success text-xl">
                                            <h3>457,500.50 USD</h3> 
                                        </p>
                                        <p class="d-flex flex-column text-right">
                                            <span class="font-weight-bold text-success">
                                                <i class="bi bi-graph-up-arrow"></i> +12.5%
                                            </span>
                                            <span class="text-muted">Since Last Month</span>
                                        </p>
                                    </div>
                                    <div class="d-flex flex-column justify-content-between align-items-center border-bottom mb-3">
                                        <span class="text-muted">Total Refund Due to Cancellations</span>
                                        <h3 class="text-danger">21,000.00 USD</h3> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
        integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
    <script src="./js/adminlte.js"></script>
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
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
        integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js" integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y=" crossorigin="anonymous" ></script>
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js" integrity="sha256-XPpPaZlU8S/HWf7FZLAncLg2SAkP8ScUTII89x9D3lY=" crossorigin="anonymous" ></script> -->
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap/dist/maps/world.js"></script>
    <script src="./js/report_chart.js?date=<?php echo time(); ?>" type="module"></script>
</body>

</html>