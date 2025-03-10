<?php
  session_start();
  if(!isset($_SESSION['admin'])){
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
  <title>FlightDB | Manage Table</title>
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
  <link rel="stylesheet" href="./css/adminlte.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
    integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
    integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css" />
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
        <?php 
          if(isset($_GET["manage"])){
            if($_GET["manage"] == "flight"){
              navigatePanel("mflight");
            }else if($_GET["manage"] == "user"){
              navigatePanel("muser");
            }
          }else{
            navigatePanel("moverall");
          }
        ?>
      </div>
    </aside>

    <main class="app-main">
      <div class="container-fluid py-3">
        <div class="row">
          <div class="col-md-5 col-lg-4 col-xxl-3">
            <div class="card">
              <div class="card-header"> Managements System: <?php echo isset($_GET["manage"]) ? ucfirst($_GET["manage"]) : "Overall" ?> </div>
              <div class="card-body">
                <?php
                  if(isset($_GET["manage"])){
                    if($_GET["manage"] == "flight"){
                    ?>
                      <div class="list-group">
                        <a href="?manage=flight&kind=flight"   class="list-group-item list-group-item-action <?php echo $_GET["kind"] == "flight"   ? "active" : "" ?>">Manage Flights</a>
                        <a href="?manage=flight&kind=seat"     class="list-group-item list-group-item-action <?php echo $_GET["kind"] == "seat"     ? "active" : "" ?>">Manage Seats</a>
                        <a href="?manage=flight&kind=aircraft" class="list-group-item list-group-item-action <?php echo $_GET["kind"] == "aircraft" ? "active" : "" ?>">Manage Aircrafts</a>
                        <a href="?manage=flight&kind=airline"  class="list-group-item list-group-item-action <?php echo $_GET["kind"] == "airline"  ? "active" : "" ?>">Manage Airlines</a>
                        <a href="?manage=flight&kind=airport"  class="list-group-item list-group-item-action <?php echo $_GET["kind"] == "airport"  ? "active" : "" ?>">Manage Airports</a>
                        <a href="?manage=flight&kind=transit"  class="list-group-item list-group-item-action <?php echo $_GET["kind"] == "transit"  ? "active" : "" ?>">Manage Transit</a>
                      </div>
                    <?php
                    }else if($_GET["manage"] == "user"){
                    ?>
                      <div class="list-group">
                        <a href="?manage=user&kind=user"                
                           class="list-group-item list-group-item-action <?php echo $_GET["kind"] == "user"      ? "active" : "" ?>">Manage User</a>
                        <a href="?manage=user&kind=passenger"           
                           class="list-group-item list-group-item-action <?php echo $_GET["kind"] == "passenger" ? "active" : "" ?>">Manage Passenger</a>
                        <a href="?manage=user&kind=booking"             
                           class="list-group-item list-group-item-action <?php echo $_GET["kind"] == "booking"   ? "active" : "" ?>">Manage Booking</a>
                        <a href="?manage=user&kind=passenger_booking"   
                           class="list-group-item list-group-item-action <?php echo $_GET["kind"] == "passenger_booking"   ? "active" : "" ?>">Manage Passenger Booking</a>
                        <a href="?manage=user&kind=booking_flight"   
                           class="list-group-item list-group-item-action <?php echo $_GET["kind"] == "booking_flight"   ? "active" : "" ?>">Manage Booking Flight</a>
                        <a href="?manage=user&kind=ticket"   
                           class="list-group-item list-group-item-action <?php echo $_GET["kind"] == "ticket"   ? "active" : "" ?>">Manage Ticket</a>
                        <a href="?manage=user&kind=payment"   
                           class="list-group-item list-group-item-action <?php echo $_GET["kind"] == "payment"   ? "active" : "" ?>">Manage Payment</a>
                      </div>
                    <?php
                    }
                  }else{
                    echo "<h2>Overall Management</h2>";
                  }
                  ?>
              </div>
            </div>
          </div>
          <div class="col-md-7 col-lg-8 col-xxl-9">
            <div class="card">
              <div class="card-header">Add new <?php echo ucfirst($_GET["manage"]); ?> record.</div>
              <div class="card-body">
                <form>
                  <div class="row">
                    <div class="col-md-3">
                      <label for="flnum" class="form-label">Flight Number</label>
                      <input type="text" class="form-control" id="flnum" value="" required="">
                    </div>
                    <div class="col-md-3">
                      <label for="available_seat" class="form-label">Available Seat</label>
                      <input type="number" min="10" max="600" step="1" class="form-control" id="available_seat" value="" required="">
                    </div>
                    <div class="col-md-3">
                      <label for="aircraftID" class="form-label">Aircraft ID</label>
                      <input type="text" class="form-control" id="aircraftID" value="" required="">
                    </div>
                    <div class="col-md-3">
                      <label for="airlineCode" class="form-label">Airline Code</label>
                      <input type="text" class="form-control" id="airlineCode" value="" required="">
                    </div>
                    <div class="col-md-6 mt-4">
                      <label for="arrtime" class="form-label">ARR/DEP TIME</label>
                      <div class="row">
                        <div class="col-6"><input type="datetime-local" class="form-control" id="arrtime" placeholder="Arrival Time" value="" required=""></div>
                        <div class="col-6"><input type="datetime-local" class="form-control" id="deptime" placeholder="Depart Time" value="" required=""></div>
                      </div>
                    </div>
                    <div class="col-md-6 mt-4">
                      <label for="arr_ap" class="form-label">ARR/DEP Airport Code</label>
                      <div class="row">
                        <div class="col-6"><input type="text" class="form-control" id="arr_ap" placeholder="Arrival Airport" value="" required=""></div>
                        <div class="col-6"><input type="text" class="form-control" id="dep_ap" placeholder="Depart Airport" value="" required=""></div>
                      </div>
                    </div>
                    <div class="col-12 mt-4">
                      <div class="btn btn-success">Add new <?php echo ucfirst($_GET["manage"]); ?> record</div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">Data Query for <?php echo ucfirst($_GET["kind"]); ?></div>
              <div class="card-body">
              <table id="table-grid" cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
                <thead>
                <tr id="table-header">
                    
                </tr>
                </thead>
              </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
    integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
  <script src="./js/adminlte.js"></script>
  <script type="text/javascript">
    function rowDataGet (e) {
        console.log(e)
    }
    $(document).ready(function() {
      //function to write actual data of a table row
        $.ajax("api/query.php?query_column&query_table=<?php echo $_GET["kind"]; ?>", {
            type: 'POST',
            success: function(data) {
                var columns = [];
                var priColumns = [];
                $.each(JSON.parse(data), function(key, value){
                    columns.push({data: value.name});
                    if(value.pkey){
                        priColumns.push(value.name);
                    }
                    $("#table-header").append("<th>"+value.name+"</th>");
                });
                columns.push({title:  "Action",
                  "render": function(data, type, full) { 
                    console.log(full, type, data)
                    return `<div class="btn-group">
                      <button type="button" onclick="rowDataGet(this)" data data-information="${JSON.stringify(full)}" class="btn btn-warning">Edit</button>
                      <button type="button" onclick="rowDataGet(this)" data data-information="${JSON.stringify(full)}" class="btn btn-danger">Delete</button>
                    </div>` 
                    }
                });
                $('#table-grid').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url" : "api/query.php?query_table=<?php echo $_GET["kind"]; ?>",
                        "type" : "POST"
                    },
                    "columns": columns
                });
            }
        });
    });
</script>
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
</body>

</html>