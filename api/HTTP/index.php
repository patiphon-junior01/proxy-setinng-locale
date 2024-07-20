<?php
class HTTP
{
  private static $enpoint = 'http://pong-framework.test';

  // if you want use __construct
  // public function __construct($enpoint)
  // {
  //   self::$enpoint = $enpoint;
  // }

  public static function ControllersGet($route)
  {
    try {
      $route = self::$enpoint . $route;
      $decode = self::CurlRoute($route, null, false, ['Content-Type: application/json'], true, 100, "GET");
      return $decode;
      return $decode;
    } catch (Exception $e) {
      return ["Message" => $e->getMessage(), "Status" => "Error 500", "StatusCode" => 500];
    }
  }


  public static function ControllersPostOptionJson($route, $body, $method = "POST")
  {
    try {
      $route = self::$enpoint . $route;
      $decode = self::CurlRoute($route, $body, true, ['Content-Type: application/json'], true, 100, $method);
      return $decode;
    } catch (Exception $e) {
      return ["Message" => $e->getMessage(), "Status" => "Error 500", "StatusCode" => 500];
    }
  }

  public static function ControllersPostUploadFileJson($route, $body, $method = "POST")
  {
    try {
      $headers = ['Content-Type: multipart/form-data'];
      $route = self::$enpoint . $route;
      $decode = self::CurlRoute($route, $body, true, $headers, true, 100, $method);
      return $decode;
    } catch (Exception $e) {
      return ["Message" => $e->getMessage(), "Status" => "Error 500", "StatusCode" => 500];
    }
  }

  public static function CurlRoute(
    $route,
    $body = null,
    $isNotGet = false,
    $headers = array(
      'Content-Type: application/json',
    ),
    $isHeader = true,
    $timeout = 100,
    $method  = 'GET'
  ) {
    try {

      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => $route,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => $timeout,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_POSTFIELDS =>  $isNotGet ?  $body : null,
        CURLOPT_HTTPHEADER =>  $isHeader ?  $headers : null,
      ));

      $response = curl_exec($curl);

      if (curl_errno($curl)) {
        $error_msg = curl_error($curl);
        curl_close($curl);
        return ["Message" => $error_msg, "Status" => "Error 500", "StatusCode" => 500];
      }

      curl_close($curl);
      $decode = json_decode($response, true);

      return $decode;
    } catch (Exception $e) {
      return ["Message" => $e->getMessage(), "Status" => "Error 500", "StatusCode" => 500];
    }
  }
}
