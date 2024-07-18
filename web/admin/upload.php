<?php
include_once("web/layout/headerInclude.php");
$page_nav = 0;
// required connect with router only
if (!$required) {
  header('Location: /pong-framework');
}


// send data to crul with method post
$decodePost = null;
// CURLOPT_POSTFIELDS => array('xxxx'=> new CURLFILE('/C:/Users/patip/Downloads/1.ภาพหน้าปก.บ้านปลอดภัยไร้กังวล 10 วิธีง่ายๆ ป้องกันโจรขโมย.jpg')),
if (isset($_FILES['files']) && $_FILES['files']['tmp_name']  != '') {
  $filePath = $_FILES['files']['tmp_name'];
  $fileName = $_FILES['files']['name'];
  $postData = array('files' => new CURLFile($filePath, mime_content_type($filePath), $fileName));
  $decodePost = HTTP::ControllersPostUploadFileJson("/api/v1/uploads/route.php", $postData, "POST"); //Default is Post Method
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
          <div>
            <p class="fw-bold">List Form Upload File POST API</p>
            <!-- action="<?= $_SERVER['REDIRECT_URL'] ?>" -->
            <!-- onsubmit="handlerFile()" -->
            <form method="post" action="<?= $_SERVER['REDIRECT_URL'] ?>" enctype="multipart/form-data">
              <input type="file" name="files" id="files" class="form-control mb-2" placeholder="Types Number..">
              <p class="mb-1">Files is :
                <?= isset($_FILES['files']) && $_FILES['files']['tmp_name']  != '' ? $_FILES['files']['name'] : "N/A" ?>
              </p>
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


  <script>
    // const handlerFile = async (e) => {
    //   e.preventDefault();
    //   const form = new FormData()
    //   form.append(e)
    //   console.log(form)
    // }
  </script>
</body>

</html>