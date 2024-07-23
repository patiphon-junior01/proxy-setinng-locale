<?php
require __DIR__ . "/config_session.php";
require __DIR__ . "/config.php";
require __DIR__ . "/api/middlewares/page/authorize-token.php";
header('X-Frame-Options: SAMEORIGIN');

$request = $_SERVER['REDIRECT_URL'];
$required = true;

// ไม่ให้เข้าไปยัง folder หลัก
$myArray = explode("/", $request);
// Use array_filter to remove empty elements
$myArray = array_filter($myArray, function ($row) {
  return strlen($row) > 0;
});

// Re-index the array to remove gaps in keys
$myArray = array_values($myArray);

if (count($myArray) > 0 && $myArray[0] == "/web") {
  require __DIR__ . '/web/404.php';
  return;
}

// debug
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

// default routing
$is_handler_route = false;
switch ($request) {

  case '/':
    require __DIR__ . '/web/index.php';
    $is_handler_route = true;
    break;

  case '/':
  case '/home':
    require __DIR__ . '/web/index.php';
    $is_handler_route = true;
    break;


  case '/admin/validate':
    // for test middlewares page
    $isPass = ValidateTokenLogin($_SESSION['token']); // is pass
    // $isPass = ValidateTokenLogin(" vkfdgbnk"); // no pass
    if ($isPass) {
      require __DIR__ . '/web/admin/validate-with-token.php';
    }
    $is_handler_route = true;
    break;

    // old enpoint
    // case '/admin':
    //   require __DIR__ . '/web/admin/index.php';
    //   break;

    // case '/admin/curl':
    //   require __DIR__ . '/web/admin/curl.php';
    //   break;

    // case '/admin/upload':
    //   require __DIR__ . '/web/admin/upload.php';

    // default:
    //   require __DIR__ . '/web/404.php';
    //   break;
}

// if use switch for check route is return;
if ($is_handler_route) {
  return;
}

// for debug
// $dirWeb = scandir("web");
// echo "<pre>";
// var_dump($myArray);
// var_dump($dirWeb);
// echo "</pre>";

// enpoint page
$enpoint_page = "";
$enpoint_page_no_lastName = "";
foreach ($myArray as $index => $page) {
  $enpoint_page_no_lastName .= "/{$page}";
  if ($index == count($myArray) - 1) {
    $enpoint_page .= "/{$page}.php";
    continue;
  }
  $enpoint_page .= "/{$page}";
}

$targetFileNoLastName = __DIR__ . "/web{$enpoint_page_no_lastName}";
$targetFile = __DIR__ . "/web{$enpoint_page}";
$fallbackFile = __DIR__ . '/web/404.php';

if (file_exists($targetFile)) {
  require $targetFile;
} else {
  if (file_exists($targetFileNoLastName . "/index.php")) {
    require $targetFileNoLastName . "/index.php";
  } else {
    require $fallbackFile;
  }
}
