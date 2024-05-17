<?php
header('X-Frame-Options: SAMEORIGIN');
$request = $_SERVER['REQUEST_URI'];
$required = true;

// default routing
switch ($request) {
  case '/pong-framework/':
    require __DIR__ . '/web/index.php';
    break;

  case '/pong-framework/':
  case '/pong-framework/home':
    require __DIR__ . '/web/index.php';
    break;

  case '/pong-framework/admin':
    require __DIR__ . '/web/admin/index.php';
    break;

  default:
    require __DIR__ . '/web/404.php';
    break;
}
