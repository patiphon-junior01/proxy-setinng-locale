<?php
require __DIR__ . "/config_session.php";
require __DIR__ . "/config.php";
require __DIR__ . "/api/middlewares/page/authorize-token.php";
header('X-Frame-Options: SAMEORIGIN');

$request = $_SERVER['REDIRECT_URL'];
$required = true;

// ไม่ให้เข้าไปยัง folder หลัก
$myArray = explode("/", $request);
if ($myArray[1] == "/web") {
  require __DIR__ . '/web/404.php';
  return;
}

// for get array server or debug
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

// default routing
switch ($request) {
  case '/':
    require __DIR__ . '/web/index.php';
    break;

  case '/':
  case '/home':
    require __DIR__ . '/web/index.php';
    break;

  case '/admin':
    require __DIR__ . '/web/admin/index.php';
    break;

  case '/admin/curl':
    require __DIR__ . '/web/admin/curl.php';
    break;

  case '/admin/upload':
    require __DIR__ . '/web/admin/upload.php';
    break;

  case '/admin/validate':
    $isPass = ValidateTokenLogin($_SESSION['token']); // is pass
    // $isPass = ValidateTokenLogin(" vkfdgbnk"); // no pass
    if ($isPass) {
      require __DIR__ . '/web/admin/validate-with-token.php';
    }
    break;

  default:
    require __DIR__ . '/web/404.php';
    break;
}
