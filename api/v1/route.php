<?php
// http: //pong-framework.test/api/v1/route.php?query_string=string-date
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  http_response_code(200);
  // return array encode
  echo json_encode(
    [
      "Message" => "This Route Api",
      "Status" => "Success",
      "StatusCode" => 200,
      "data" => [
        ["name" => "data1"],
        ["name" => "data2"],
      ],
      "query" => isset($_GET['query_string']) ? $_GET['query_string'] : null
    ]
  );
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $rawPostData = file_get_contents('php://input');
  $post_input = json_decode($rawPostData, true);   // Decode JSON data

  http_response_code(200);
  echo json_encode(
    [
      "Message" => "This Route POST Api",
      "Status" => "Success",
      "StatusCode" => 200,
      "PostData" => $post_input['input-id']
    ]
  );
} else {
  http_response_code(405);
  echo json_encode(["Message" => "Method not allowed", "Status" => "Not Found Method", "StatusCode" => 403]);
}
