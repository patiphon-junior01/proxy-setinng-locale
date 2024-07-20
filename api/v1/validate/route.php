<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require("../../../config.php");
require("../../function.php");
require("../../../lib/validate.php");
// http: //pong-framework.test/api/v1/route.php?query_string=string-date
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json");

$function = new db();

// start validate
$headers = getallheaders();
$decoded = null;
$varValidate = ValidateToken($headers);
if ($varValidate[0] !== true) {
  http_response_code(403);
  echo json_encode($varValidate);
  return;
}
$decoded = $varValidate[1];
// end validate

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
