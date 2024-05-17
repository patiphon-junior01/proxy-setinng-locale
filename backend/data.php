<?php
class config
{
  private const HOST = "host";
  private const USER = "username";
  private const PASS = "password";
  private const DB = "database name";

  private $dns = null;
  public $conn = null;

  public function __construct()
  {
    try {
      $this->dns = "mysql:host=" . self::HOST . ";dbname=" . self::DB . "";
      $this->conn = new PDO($this->dns, self::USER, self::PASS);
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
