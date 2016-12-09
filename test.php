<?php
include 'curl_class.php';

if(isset($_GET['code'])) {
  $code = $_GET['code'];
  $params = array (
    "client_id" => "32irqwponwmokihv2k4e6944no1jex",
    "client_secret" => "qpa0dtiolvj118azo7d5v1nm9tkhiq",
    "grant_type" => "authorization_code",
    "redirect_uri" => "https://web.njit.edu/~jic6/curl_class/index.php",
    "code" => $code
  );
  $curl = new curl('https://api.twitch.tv/kraken/oauth2/token', $params);
  $response = $curl->post();
  $response = json_decode($response,true);
  $token = $response['access_token'];
  $headers = array(
    "Accept: application/vnd.twitchtv.v3+json",
    "Authorization: OAuth $token",
    "Client-ID: 32irqwponwmokihv2k4e6944no1jex"
  );
  $curl = new curl('https://api.twitch.tv/kraken/user', array(), $headers);
  $response = $curl->get();
  $response = json_decode($response, true);
  echo $response['email'];
  echo $response['name'];
  echo '<img src="'.$response['logo'].'">';
}
echo '<a
href="https://api.twitch.tv/kraken/oauth2/authorize?response_type=code&client_id=32irqwponwmokihv2k4e6944no1jex&redirect_uri=https://web.njit.edu/~jic6/curl_class/index.php&scope=user_read">Click
this link</a>';


?>
