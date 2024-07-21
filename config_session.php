<?php
session_set_cookie_params([
  'lifetime' => 0,
  'path' => '/',  // ให้ทำงานได้ทั้งเว็บไซต์
  'domain' => '', // ตั้งค่าตามความเหมาะสม ถ้าเป็นโดเมนเดียวกันให้เว้นว่างไว้
  'secure' => false,
  'httponly' => false,
]);
session_start([
  'cookie_lifetime' => 0,
  'cookie_secure' => false,
  'cookie_httponly' => false,
  'use_only_cookies' => false,
  'sid_length' => 200,
  'sid_bits_per_character' => 6,
]);
