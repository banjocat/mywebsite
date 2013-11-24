<?php

function human_check($question, $answer)
{
    $numbers = preg_split( "/\s/", $question);
    if (count($numbers) !== 2)
        return false;

    $right = $numbers[0] + $numbers[1];
    return $right == $answer;
}

function process_email($output)
{
    mail( "jackmuratore@gmail.com",
        "From My WebSite",
        $output);
}

$first_name = $_GET["first-name"];
$last_name = $_GET["last-name"];
$email = $_GET["email"];
$phone = $_GET["phone-number"];
$comments = $_GET["comments"];
<<<<<<< HEAD
$check_question = $_GET["human-question"];
$check = $_GET["human-check"];
$output = sprintf(
    "Name:%s %s\nEmail:%s\nPhone:%s\nComments\n%s",
    $first_name, $last_name, $email, $phone, $comments);
?>
<?php include 'header.php';?>
<?php
    $allgood = <<<EOD
<h1>Thank you</h1>
<p>
An email was sent.
I shall contact you back as soon as possible.
</p>
EOD;

$allbad = <<<EOD
<h1>Human Check Failed</h1>
<p>
Sorry but the human check failed.
Please try again.
</p>
EOD;

if (human_check($check_question, $check))
    echo($allgood);
else
    echo($allbad);

=======

$output = sprintf("Name:%s %s\nEmail:%s\nPhone:%s\nComments\n%s",
    $first_name, $last_name, $email, $phone, $comments);
mail( "jackmuratore@gmail.com",
    "From My WebSite",
    $output);
>>>>>>> 1e890df61f86c8c6be6aa4d0b91f528ee1123308
?>
