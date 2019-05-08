<?php
require("./sendgrid-php/sendgrid-php.php");
$subject = 'subject';
$message = 'message';
$to = 'luisv555@gmail.com';
$mail ='lvalencia@csumb.edu';
$type = 'plain'; // or HTML
$charset = 'utf-8';

$from = new SendGrid\Email(null, $mail);
$subject = "Hello World from the SendGrid PHP Library!";
$to = new SendGrid\Email(null, $to);
$content = new SendGrid\Content("text/plain", "Hello, Email!");
$mail = new SendGrid\Mail($from, $subject, $to, $content);

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

$response = $sg->client->mail()->send()->post($mail);
echo $response->statusCode();
echo $response->headers();
echo $response->body();
?>