<?php
$confirmation_code = array_key_exists("param1", $_GET) ? $_GET["param1"] : 
                     (array_key_exists("param1", $_POST) ? $_POST["param1"] : null);

require_once(__DIR__. "/include/wyvern_jr.php");
$wyvern = new WyvernJr(true);
$result = $wyvern->confirm_subscription($confirmation_code);

$status = 0;
if($result === 0)
   $status = -1;
else
   $status = 1;

$wyvern->increment_hits("do_confirm_" . strval($status), true);

global $web_config;
header('Location: ' . $web_config["SITE_URL"] . "/?status=" . urlencode(strval($status)), true, 303);
?>