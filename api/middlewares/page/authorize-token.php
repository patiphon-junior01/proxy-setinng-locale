<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// require("../config.php");
function ValidateTokenLogin($token)
{
  if (!isset($token)) {
    require '/var/www/html/web/401.php';
    return false;
  }
  // validate token
  $decoded = null;
  try {
    $decoded = JWT::decode($token, new Key($_ENV['SECRET_KEY'], 'HS256'));
  } catch (Exception $e) {
    require '/var/www/html/web/401.php';
    return false;
  }

  return true;
}
