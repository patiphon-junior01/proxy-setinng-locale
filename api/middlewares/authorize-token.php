<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// require("../config.php");
function ValidateToken($headers)
{
  if (!isset($headers['Authorization'])) {
    http_response_code(403);
    return [
      [
        "Message" => "Unauthorized",
        "Status" => "Invalid",
        "StatusCode" => 403,
      ]
    ];
  }

  $Authorization = $headers['Authorization'];
  $token =  (explode(" ", $Authorization));
  if (!isset($token[1])) {
    return [
      [
        "Message" => "Unauthorized",
        "Status" => "Invalid",
        "StatusCode" => 403,
      ]
    ];
  }

  // validate token
  $decoded = null;
  try {
    $decoded = JWT::decode($token[1], new Key($_ENV['SECRET_KEY'], 'HS256'));
  } catch (Exception $e) {
    http_response_code(403);
    return [
      [
        "Message" => "Unauthorized",
        "Status" => "Invalid",
        "Exception" => $e->getMessage(),
        "StatusCode" => 403,
      ]
    ];
  }

  return [true, $decoded];
}
