<?php
    require_once("db.php");
    if(isset($_SESSION['admin'])){
        header("Location: ./dashboard.php");
    }else{
        if(isset($_GET["login"])){
            $username = $_POST["username"];
            $password = $_POST["password"];
            $sql = "SELECT * FROM admin WHERE username = ?"; //Prevention of SQL Injection bind_param
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $checkPassword = $Encryptor->check($password, $row["password"]);
                
                if(!$checkPassword){
                    $Error = "Invalid username or password \n Please try again". $Encryptor->encrypt($password);
                }else{
                    $_SESSION['admin'] = true;
                    $_SESSION['admin_id'] = $row['id'];
                    $_SESSION['admin_username'] = $row['username'];
                    $_SESSION['admin_permission'] = $row['permission'];
                    $_SESSION['admin_name'] = $row['fullname'];
                    header("Location: ./dashboard.php");
                }
            }else{
                $Error = "Invalid username or password";
            }
        }
    }
?>
<!doctype html>
<html lang="en">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Flight Reservation | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Flight Reservation | Login" />
    <meta name="author" content="sudo apt i-love-ubuntu" />
    <meta name="description" content="Flight Reservation - Login"/>
    <meta name="keywords" content="Flight Reservation" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css" integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/adminlte.css" />
  </head>
  <body class="login-page bg-body-secondary">
    <div class="login-box">
      <div class="login-logo">
        <a href="./index.php"><b>Flight Reservation</b></a>
      </div>
      <div class="card">
        <div class="card-body login-card-body">
            <?php
                if(isset($Error)){
                    echo '<div class="alert alert-danger alert-dismissible">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <h5><i class="icon fas fa-ban"></i> Error!</h5>
                            '.$Error.'
                        </div>';
                }
            ?>
          <p class="login-box-msg">Sign in to admin system</p>
          <form action="login.php?login" method="post" autocomplete="off">
            <div class="input-group mb-3">
              <input type="text" name="username" class="form-control" placeholder="Username" autocomplete="new-text" />
              <div class="input-group-text"><span class="bi bi-person"></span></div>
            </div>
            <div class="input-group mb-3">
              <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="new-password" />
              <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Sign In</button>
                    </div>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="./js/adminlte.js"></script>
  </body>
</html>

<?php
    //Terminate the connection to the database
    $conn->close();
?>