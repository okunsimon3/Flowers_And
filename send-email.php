<?php


if(!empty($_POST)) {
    $recipient = "This is an email address";
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

    mail($recipient,$header,$message);

    header("Location: localhost:");

}

?>