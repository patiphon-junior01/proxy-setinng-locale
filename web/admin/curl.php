<?php
include_once("web/layout/headerInclude.php");
$page_nav = 0;
// required connect with router only
if (!$required) {
  header('Location: /pong-framework');
}

$decode = HTTP::ControllersGet("/api/v1/route.php?query_string=bngfnbgh");

// send data to crul with method post
$decodePost = null;
if (isset($_POST['input-id']) && $_POST['input-id']) {
  $postData = json_encode(['input-id' => $_POST['input-id']]);
  $decodePost = HTTP::ControllersPostOptionJson("/api/v1/route.php", $postData); //Default is Post Method
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
          // if ($decodePost) {
          //   echo "<pre>";
          //   print_r($decodePost);
          //   echo "</pre>";
          // }
          ?>
          <div class="border-bottom mb-4">
            <p class="fw-bold">List Form Get API</p>
            <ul>
              <?php foreach ($decode['data'] as $index => $row) { ?>
                <li>
                  <?= $index + 1 . " : " . $row['name'] ?>
                </li>
              <?php } ?>
            </ul>
          </div>
          <div>
            <p class="fw-bold">List Form POST API</p>
            <form action="<?= $_SERVER['REDIRECT_URL'] ?>" method="post">
              <input type="number" name="input-id" id="input-id" class="form-control mb-2" placeholder="Types Number..">
              <p class="mb-1">input-id is :
                <?= isset($_POST['input-id']) && $_POST['input-id']  != '' ? $_POST['input-id'] : "N/A" ?></p>
              <button class="btn btn-dark mb-2">Submit</button>
              <button class="btn btn-info mb-2" onclick="()=> {
              window.location.reload()
              }">Clear</button>
              <div>Result :
                <?php
                if ($decodePost) {
                  echo "<pre>";
                  print_r($decodePost);
                  echo "</pre>";
                }
                ?>
              </div>
            </form>
          </div>
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