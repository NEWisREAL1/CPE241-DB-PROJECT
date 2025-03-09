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
          <div class="col-md-6">
            <div class="card">
              <div class="card-header"> Managements System: <?php echo isset($_GET["manage"]) ? ucfirst($_GET["manage"]) : "Overall" ?> </div>
              <div class="card-body">
                <?php
                  if(isset($_GET["manage"])){
                    if($_GET["manage"] == "flight"){
                    ?>
                      <div class="list-group">
                        <a href="?manage=flight&kind=flight"   class="list-group-item list-group-item-action">Manage Flights</a>
                        <a href="?manage=flight&kind=seat"     class="list-group-item list-group-item-action">Manage Seats</a>
                        <a href="?manage=flight&kind=aircraft" class="list-group-item list-group-item-action">Manage Aircrafts</a>
                        <a href="?manage=flight&kind=airline"  class="list-group-item list-group-item-action">Manage Airlines</a>
                        <a href="?manage=flight&kind=airport"  class="list-group-item list-group-item-action">Manage Airports</a>
                      </div>
                    <?php
                    }else if($_GET["manage"] == "user"){
                    ?>
                      <div class="list-group">
                        <a href="?manage=user&kind=passenger" class="list-group-item list-group-item-action">Manage Passenger</a>
                        <a href="?manage=user&kind=booking"   class="list-group-item list-group-item-action">Manage Booking</a>
                        <a href="?manage=user&kind=user"      class="list-group-item list-group-item-action">Manage User</a>
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
        </div>
      </div>
      <!-- <div class='card my-3 mx-3'>
        <div class='card-header'>
          <h2>Select Table to View</h2>
        </div>
        <div class='card-body p-5'>
          <form method="get">
            <div class="row">
              <div class="col">
                <select name="table" class="form-select mb-1">
                  <option value="" disabled selected>Select a table</option>
                  <?php
                  $tables = $conn->query("SHOW TABLES");
                  while ($row = $tables->fetch_array()) {
                    echo "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="col">
                <input type="number" name="limit" class="form-control" placeholder="Query Limit (Default 100)">
              </div>
            </div>
            <input type="submit" value="View Table" class="btn btn-primary">
          </form>
        </div>
      </div>

      <?php
      if (isset($_GET['table'])) {
        $table = $_GET['table'];
        $limit = isset($_GET['limit']) && $_GET['limit'] !== "" ? (int)$_GET['limit'] : 100;
        $query = "SELECT * FROM `$table` LIMIT $limit";
        $result = $conn->query($query);

        echo "<div class='card mb-3 mx-5'>
                  <div class='card-header'>
                    <h3 class='card-title'>" . $table . "</h3>
                  </div>
                <div class='card-body p-0'>
          <table class='table table-striped'><thead>";
        while ($field = $result->fetch_field()) {
          echo "<th>" . $field->name . "</th>";
        }
        echo "</thead>";
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          foreach ($row as $value) {
            echo "<td>" . htmlspecialchars($value) . "</td>";
          }
          echo "</tr>";
        }
        echo "</table></div>";

        if ($result->num_rows <= 0) {
          echo "<div class='small-box-footer text-center m-2'>--- (no record found) ---</div>";
        }
        // else {
        //   echo "<form method='get'>";
        //   echo "<input type='hidden' name='table' value='$table'>";
        //   echo "<input type='hidden' name='limit' value='" . ($limit + 100) . "'>";
        //   echo "<input type='submit' value='Query More'>";
        //   echo "</form>";
        // }

        echo "</div>";
      }
      ?> -->
    </main>

  </div>

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
</body>

</html>