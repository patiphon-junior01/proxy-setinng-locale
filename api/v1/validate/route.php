<?php
require("../../../config.php");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json");

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require("../../function.php");
require("../../middlewares/authorize-token.php");

$function = new db();

// start validate
$headers = getallheaders();
$decoded = null;
$varValidate = ValidateToken($headers);
if ($varValidate[0] !== true) {
  http_response_code(403);
  echo json_encode($varValidate[0]);
  return;
}
$decoded = $varValidate;
// end validate

$Authorization = $headers['Authorization'];
$token =  (explode(" ", $Authorization));

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  try {
    // test get data
    $data = $function->select_manaul_field("firsttable", ['*']);
    if (!$data) {
      $data = [];
    }

    // return array encode
    http_response_code(200);
    echo json_encode(
      [
        "Message" => "This Route Api",
        "Status" => "Success",
        "StatusCode" => 200,
        "table-first" => $data,
        "Playload" => $decoded,
        "Time" => Time(),
        "Session" => ["token" => $token[1]]
      ]
    );
  } catch (Exception $e) {
    http_response_code(400);
    // return array encode
    echo json_encode(
      [
        "Message" => $e->getMessage(),
        "Status" => "Faile",
        "StatusCode" => 400,
        "table-first" => null,
      ]
    );
  }
} else {
  http_response_code(405);
  echo json_encode(["Message" => "Method not allowed", "Status" => "Not Found Method", "StatusCode" => 403]);
}