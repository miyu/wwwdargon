<?php 
$headers = "";
$headers .= "Reply-To: The Dargon Project <noreply@dargon.io>\r\n"; 
$headers .= "Return-Path: The Dargon Project <noreply@dargon.io>\r\n"; 
$headers .= "From: The Dargon Project <noreply@dargon.io>\r\n"; 
$headers .= "Organization: The Dargon Project\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "X-Priority: 3\r\n";
$headers .= "X-Mailer: PHP". phpversion() ."\r\n";

$date_string = date("Y-m-d H:i:s");

$message = "<div style='font-family: \"Courier New\", Courier, monospace'>".
           "<p style='display:none; display:none !important;'>- BEGIN MESSAGE GENERATED ON " . $date_string . " - </p>".
           "<p>To whom it may concern,</p>".
           "<p>".
           "We've received your request for updates from The Dargon Project.".
           "</p>".
           "<p style='display:none; display:none !important;'>- MESSAGE GENERATED ON " . $date_string . " - </p>".
           "<p>".
           "Before we send you any further messages, we'd like to verify that we have your<br/>".
           "permission to do so.".
           "</p>".
           "--------------------------------------------------------------------------------".
           "<p style='display:none; display:none !important;'>- MESSAGE GENERATED ON " . $date_string . " - </p>".
           "<p>".
           "CONFIRM BY VISITING THE LINK BELOW: " .
           "</p>".
           "<p>".
           "<a href='http://www.dargon.io/subconfirm/6efd8c93a4b185d5e754a81577e7f589/'>".
           "http://www.dargon.io/subconfirm/6efd8c93a4b185d5e754a81577e7f589/".
           "</a>".
           "</p>".
           "--------------------------------------------------------------------------------".
           "<p style='display:none; display:none !important;'>- MESSAGE GENERATED ON " . $date_string . " - </p>".
           "<p>".
           "If you are uninterested in subscribing, simply ignore this message.".
           "</p>".
           "<p>".
           "Thank you for your time,<br/>".
           "- The Dargon Development Team".
           "</p>".
           "<p style='display:none; display:none !important;'>- END MESSAGE GENERATED ON " . $date_string . " - </p>".
           "</div>";

$result = mail("ItzWarty@gmail.com", "[Dargon] Subscription Confirmation", $message, $headers); 
echo($result);
echo("\r\n");
echo("\r\n");
echo($message);
?>