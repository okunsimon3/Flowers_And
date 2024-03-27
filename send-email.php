<?php


if(!empty($_POST)) {
    $recipient = "okunsimon3@gmail.com";
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $title = "New Message From Contact Form";
    $message = "";
    $firstname = strip_tags($_POST["firstName"]);
    $lastname = strip_tags($_POST["lastName"]);
    if(!empty($_POST["phoneNumber"])) {
        $phonenumber = filter_var($_POST["phoneNumber"], FILTER_SANITIZE_NUMBER_INT);
    } else {
        $phonenumber = "";
    }
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $details = strip_tags($_POST["details"]);

    $message .= "This user has submitted the form \n {$firstname} {$lastname}, \n {$phonenumber}, \n {$email}, \n {$details}";

    if(isset($_POST['g-recaptcha-response'])){
        $captcha=$_POST['g-recaptcha-response'];
      }
      if(!$captcha){
        echo '<h2>Please check the the captcha form.</h2>';
        exit;
      }
      $secretKey = "6Lf_B6cpAAAAAJ68kCsUnR2QR8jzr17v1wtrVbmg";
      $ip = $_SERVER['REMOTE_ADDR'];
      // post request to server
      $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
      $response = file_get_contents($url);
      $responseKeys = json_decode($response,true);
      // should return JSON with success as true
      if($responseKeys["success"]) {
              echo '<h2>Thanks for posting comment</h2>';
      } else {
              echo '<h2>You are spammer ! Get the @$%K out</h2>';
      }

    mail($recipient,$title,$message);

    header("Location: https://flowersand.us/email.html");

}

?>