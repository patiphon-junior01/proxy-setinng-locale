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
    echo json_encode(["Message" => $e->getMessage(), "Status" => "Internal Error", "StatusCode" => 500]);
  }
} else {
  http_response_code(405);
  echo json_encode(["Message" => "Method not allowed", "Status" => "Not Found Method", "StatusCode" => 403]);
}
