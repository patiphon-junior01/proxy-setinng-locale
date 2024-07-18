<?php
$dns = 'mysql:host=hostname;dbname=name-database';
$username = 'username';
$password = 'yourepassword';

// Create connection
try {
  $obj = new PDO($dns, $username, $password);
  $obj->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $obj->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "not success " .  $e->getMessage();
}
