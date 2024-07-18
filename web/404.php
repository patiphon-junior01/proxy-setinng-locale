<?php
include_once("layout/headerInclude.php");
// required connect with router only
if (!$required) {
  header('Location: /pong-framework');
}
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

  <div class="">
    <?php include("web/layout/preloder.php"); ?>
    <div class="p-5 w-100 d-flex flex-column align-items-center">
      <p class="fs-1 fw-bold ">404 ไม่พบหน้าที่ต้องการ !!</p>
      <button class="mt-2 btn btn-primary"><a class="text-white" href="/">ไปหน้าเเรก</a></button>
      <button class="mt-2 btn btn-primary"><a class="text-white" href="/admin">ไปหน้า Admin</a></button>
    </div>
  </div>

  <!-- ./wrapper -->
  <?php include("web/linkframework/js.php"); ?>

</body>

</html>