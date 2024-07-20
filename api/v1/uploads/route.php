<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  try {
    // move file
    if ($_FILES && $_FILES['files']['tmp_name'] != '') {
      $uploads_dir = 'uploads';
      $tmp_name = $_FILES["files"]["tmp_name"];
      $name = $_FILES["files"]["name"];
      $logingMove =  move_uploaded_file($tmp_name, "./../../../$uploads_dir/$name");
      if ($logingMove) {
        http_response_code(200);
        echo json_encode(
          [
            "Message" => "This Route POST Api",
            "Status" => "Success",
            "StatusCode" => 200,
            "files" => $_FILES
          ]
        );
        return;
      } else {
        echo json_encode(["Message" => "File To Uploads", "Status" => "File To Move", "StatusCode" => 400, "files" => $_FILES]);
        return;
      }
    }
    echo json_encode(["Message" => "File Invalid", "Status" => "File Invalid", "StatusCode" => 500, "files" => $_FILES]);
  } catch (Exception $e) {
    echo json_encode(["Message" => "Internal Error", "Status" => "Internal Error", "StatusCode" => 500]);
  }
} else if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
  $rawPostData = file_get_contents('php://input');
  $deleteReq = json_decode($rawPostData, true);   // Decode JSON data
  try {
    $uploads_dir = 'uploads';

    // find file
    if (file_exists("./../../../" . $uploads_dir . "/" . $deleteReq['file'])) {
      unlink("./../../../" . $uploads_dir . "/" . $deleteReq['file']);
      http_response_code(200);
      echo json_encode(
        [
          "Message" => "ลบไฟล์สำเร็จ",
          "Status" => "Success",
          "StatusCode" => 200,
          "files-name" => $deleteReq['file']
        ]
      );
      exit;
      return;
    } {
      http_response_code(400);
      echo json_encode(
        [
          "Message" => "ไม่พบรายการไฟล์",
          "Status" => "Faile To Delete",
          "StatusCode" => 404,
          "files-name" => $deleteReq['file']
        ]
      );
      return;
    }

    if (unlink("./../../../" . $uploads_dir . "/" . $deleteReq['file'])) {
      http_response_code(200);
      echo json_encode(
        [
          "Message" => "ลบไฟล์สำเร็จ",
          "Status" => "Success",
          "StatusCode" => 200,
          "files-name" => $deleteReq['file']
        ]
      );
      return;
    } else {
      http_response_code(400);
      echo json_encode(
        [
          "Message" => "ลบไฟล์ไม่สำเร็จ",
          "Status" => "Faile To Delete",
          "StatusCode" => 400,
          "files-name" => $deleteReq['file']
        ]
      );
      return;
    }
  } catch (Exception $e) {
    echo json_encode(["Message" => $e->getMessage(), "Status" => "Internal Error", "StatusCode" => 500]);
  }
} else {
  http_response_code(405);
  echo json_encode(["Message" => "Method not allowed", "Status" => "Not Found Method", "StatusCode" => 403]);
}
