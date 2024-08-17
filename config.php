<?php
require __DIR__ . "/vendor/autoload.php";
Dotenv\Dotenv::createImmutable(__DIR__)->load();
define("Beseurl", $_ENV['BESE_URL']); // global var
// constant("Beseurl"); // forcall