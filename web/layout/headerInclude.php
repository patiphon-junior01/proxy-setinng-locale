<?php
session_save_path('tmp');
session_start([
  'cookie_lifetime' => 0,
  'cookie_secure' => true,
  'cookie_httponly' => true,
  'use_only_cookies' => true,
  'sid_length' => 200,
  'sid_bits_per_character' => 6,
]);
// ถ้าจะใช้ให้เปิด
// require('backend/function.php');
// require("backend/connect.php");
// $conn = new db;