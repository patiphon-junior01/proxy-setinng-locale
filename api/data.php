<?php

class config
{
  private static  $HOST;
  private static  $USER;
  private static  $PASS;
  private static  $DB;

  private $dns = null;
  public $conn = null;

  public function __construct()
  {
    try {
      self::$HOST = $_ENV['HOST'];
      self::$USER = $_ENV['USER'];
      self::$PASS = $_ENV['PASS'];
      self::$DB = $_ENV['DBNAME'];
      $this->dns = "mysql:host=" . self::$HOST . ";dbname=" . self::$DB . "";
      $this->conn = new PDO($this->dns, self::$USER, self::$PASS);
      $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      die("connect failed " . $e->getMessage());
    }

    return $this->conn;
  }

  public function testinput($data)
  {
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    $data = trim($data);

    return $data;
  }

  public function testinput1($data)
  {
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);

    return $data;
  }

  public function message($context, $status)
  {

    return  json_encode(["massage" => $context, "status" => $status]);
  }
}
