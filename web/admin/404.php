<?php
include_once("layout/headerInclude.php");
$page_nav = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pong-Framewrok</title>
  <?php include("web/linkframework/css.php"); ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <!-- page to web -->
  <input type="number" id="nav_page" value="<?= $page_nav  ?>" class="d-none">

  <div class="wrapper">

    <?php include("web/layout/preloder.php"); ?>
    <?php include("web/layout/header.php"); ?>
    <?php include("web/layout/slidebar.php"); ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


      <!-- Main content -->
      <section class="content">

        <div class="container-fluid">

          <div class="row p-5">
            <p class="fs-1 fw-bold text-center">404 ไม่พบหน้าที่ต้องการ !!</p>
          </div>

      </section>
      <!-- /.content -->
    </div>
    <?php include("/web/layout/footer.php"); ?>
  </div>



  <!-- ./wrapper -->
  <?php include("web/linkframework/js.php"); ?>

</body>

</html>