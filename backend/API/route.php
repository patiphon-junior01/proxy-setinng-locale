<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  http_response_code(200);
  echo json_encode(["Message" => "This Api"]);
} else {
  http_response_code(405);
  echo 'Method not allowed';
  header("Location: ../../");
}
