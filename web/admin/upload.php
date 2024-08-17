<?php
include_once("web/layout/headerInclude.php");
$page_nav = 0;

// send data to crul with method post
$decodePost = null;
if (isset($_FILES['files']) && $_FILES['files']['tmp_name']  != '') {
  $filePath = $_FILES['files']['tmp_name'];
  $fileName = $_FILES['files']['name'];
  $postData = array('files' => new CURLFile($filePath, mime_content_type($filePath), $fileName));
  $decodePost = HTTP::ControllersPostUploadFileJson("/api/v1/uploads/route.php", $postData, "POST"); //Default is Post Method
}

$longDelFile = null;
$codehttp = null;
if (isset($_GET['Del']) && $_GET['Del'] == "true") {
  if (isset($_GET['name-file'])) {
    $postDataDel = json_encode(["file" => $_GET['name-file']]);
    $longDelFile = HTTP::ControllersPostOptionJson("/api/v1/uploads/route.php", $postDataDel, "DELETE"); //Default is Post Method
    $codehttp = $longDelFile ? true : false;
  }
}

$dir = "uploads";
$dirFileUploads = scandir($dir);
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
          <div class="mb-2 pb-2 border-bottom">
            <p class="fw-bold">List Form Upload File POST API</p>
            <form method="post" action="<?= $_SERVER['REDIRECT_URL'] ?>" enctype="multipart/form-data">
              <input type="file" name="files" id="files" onchange="changeFile(this.value)" class="form-control mb-2" placeholder="Types Number..">
              <p class="mb-1">Files is :
                <?= isset($_FILES['files']) && $_FILES['files']['tmp_name']  != '' ? $_FILES['files']['name'] : "N/A" ?>
              </p>
              <button class="btn btn-dark mb-2" disabled="true" id="btn-subbmit" type="submit">Submit</button>
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
          <div>
            <?php if (isset($_GET['Del']) && $_GET['Del'] == "true" && $longDelFile != null && $longDelFile['StatusCode'] == 200) { ?>
              <div class="alert alert-primary" role="alert" id="alerts-success">
                <?= $longDelFile['Message'] ?>
              </div>
            <?php } ?>
            <?php if ((isset($_GET['Del']) && $_GET['Del'] == "true" && $longDelFile == null) || ($longDelFile != null && $longDelFile['StatusCode'] != 200)) { ?>
              <div class="alert alert-danger" role="alert" id="alerts-del">
                <?= $longDelFile ? $longDelFile['Message'] : "ลบรายการไม่สำเร็จ" ?>
              </div>
            <?php } ?>
            <p class="fw-bold">Files Uploads </p>
            <ol>
              <?php
              foreach ($dirFileUploads as $index => $rows) { ?>
                <?php if ($index > 1) { ?>
                  <li class="mb-2">
                    <?= $rows ?>
                    <a href="<?= $_SERVER['REDIRECT_URL'] ?>?Del=true&name-file=<?= $rows ?>" class="btn"><i class="fas fa-folder-minus"></i></a>
                  </li>
                <?php } ?>
              <?php } ?>
            </ol>
            <?php if (count($dirFileUploads) == 2) { ?>
              <div class="w-100 text-center">
                <span>ไม่มีข้อมูล</span>
              </div>
            <?php } ?>
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

  <script>
    const alertSuccsss = document.getElementById("alerts-success")
    const alertDel = document.getElementById("alerts-del")
    const files = document.getElementById("files")

    setTimeout(() => {
      if (alertSuccsss) {
        alertSuccsss.classList.add("d-none")
      }
      if (alertDel) {
        alertDel.classList.add("d-none")
      }
    }, 2000)


    const changeFile = (e) => {
      document.getElementById("btn-subbmit").disabled = false
    }
  </script>
</body>

</html>