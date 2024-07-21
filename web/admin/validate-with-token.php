<?php
include_once("web/layout/headerInclude.php");

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$page_nav = 0;
$key = $_ENV['SECRET_KEY'];
$payload = [
  'iss' => 'http://example.org',
  'aud' => 'http://example.com',
  'iat' => 1356999524,
  'nbf' => 1357000000,
  'time' => time()
];

$jwt = null;
if (!isset($_SESSION['token'])) {
  $jwt = JWT::encode($payload, $key, 'HS256');
} else {
  $jwt = $_SESSION['token'];
}

$decode = HTTP::ControllersGetWithToken("/api/v1/validate/route.php", $jwt);
if ($decode['StatusCode'] == 200) {
  $_SESSION["token"] =  $decode["Session"]["token"];
  $_SESSION["fullname"] =  "Patiphon";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pong-Framewrok</title>
  <?php include("web/linkframework/css.php"); ?>
  <?php include("web/layout/datatable/css.php"); ?>
</head>

<body class="sidebar-mini layout-fixed sidebar-collapse">
  <!-- page to web -->
  <input type="number" id="nav_page" value="<?= $page_nav  ?>" class="d-none">
  <div class="wrapper">


    <?php include("web/layout/preloder.php"); ?>
    <?php include("web/layout/header.php"); ?>
    <?php include("web/layout/slidebar.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 fw-bold p-0">หน้าหลัก</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">หน้าหลัก</a></li>
                <li class="breadcrumb-item active">หน้าหลัก</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <?php
          if ($decode) {
            echo "<pre>";
            print_r($decode);
            echo "</pre>";
          }
          ?>
        </div>
        <button id="topButton" class="btn_totop"><i class="fas fa-chevron-up"></i></button>
      </section>
      <!-- /.content -->

    </div>
    <?php include("web/layout/footer.php"); ?>
  </div>

  <!-- ./wrapper -->
  <?php include("web/linkframework/js.php"); ?>
  <?php include("web/layout/datatable/js.php"); ?>
</body>

</html>