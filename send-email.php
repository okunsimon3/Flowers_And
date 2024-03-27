<?php


if(!empty($_POST)) {
    $recipient = "okunsimon3@gmail.com";
    $header = "This is the title of the email";
    $message = "This is the message of the email";
    $firstname = strip_tags($_POST["firstName"]);
    $lastname = strip_tags($_POST["lastName"]);
    if(!empty($_POST["phoneNumber"])) {
        $phonenumber = filter_var($_POST["phoneNumber"], FILTER_SANITIZE_NUMBER_INT);
    } else {
        $phonenumber = "";
    }
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $details = strip_tags($_POST["details"]);

    $message .= "This user has submitted the form {$firstname} {$lastname} {$phonenumber} {$email} {$details}";

    if(isset($_POST['g-recaptcha-response'])){
        $captcha=$_POST['g-recaptcha-response'];
      }
      if(!$captcha){
        echo '<h2>Please check the the captcha form.</h2>';
        exit;
      }
      $secretKey = "6Le2zKUpAAAAACxjdYTwrY1ii-yPJPvJH_N78jKd";
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

    mail($recipient,$header,$message);

    header("Location: localhost:");

}

?>