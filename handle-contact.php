<?php

$first_name = $_GET["first-name"];
$last_name = $_GET["last-name"];
$email = $_GET["email"];
$phone = $_GET["phone-number"];
$comments = $_GET["comments"];

$output = sprintf("Name:%s %s\nEmail:%s\nPhone:%s\nComments\n%s",
    $first_name, $last_name, $email, $phone, $comments);
mail( "jackmuratore@gmail.com",
    "From My WebSite",
    $output);
?>
