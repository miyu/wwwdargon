<?php
require_once(__DIR__ . "/.config.php");
require_once(__DIR__ . "/../ip2c/ip2country.php");

class WyvernJr
{
   /**
    * @var PDO
    */
   private $pdo;
   
   public function __construct($need_db = false)
   {
      global $web_config;
      
      if($need_db)
      {
         $this->pdo = new PDO($web_config["PDO_DSN"], $web_config["PDO_USER"], $web_config["PDO_PASS"]);
         $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
   }
   
   public function increment_hits($name, $countrySpecific = false)
   {
      $country_code = null;
      if($countrySpecific)
      {
         $ip2c = new ip2country();
         $country_code = $ip2c->get_country_code();//"205.175.98.207");
      }
      if(!isset($country_code)) // loopback/unknown ip or not country specific.
         $country_code = "-";
      
      
      $hour_id = floor(time() / 3600);
      $statement = $this->pdo->prepare(
         "INSERT INTO jr_stats (name, country_code, hour_id, hits) ".
         "VALUES (:name, :country_code, $hour_id, 1) " .
         "ON DUPLICATE KEY UPDATE hits=hits+1");
      $statement->bindValue(":name", $name, PDO::PARAM_STR);
      $statement->bindValue(":country_code", $country_code, PDO::PARAM_STR);
      $statement->execute();
      
      //echo($countrySpecific . " . " . $country_code . " . " . $hour_id);
   }
   
   // returns: 1 if row inserted, 2 if updated.
   public function add_subscription($email, $data, $add_info)
   {
      $confirmation_code = md5(uniqid(rand(), true));
      
      $ip2c = new ip2country();
      $country_code = $ip2c->get_country_code();
      
      $script_a = "INSERT INTO jr_subscriptions (email, timestamp, country_code, confirmation_code";
      $script_b = ") VALUES (:email, FROM_UNIXTIME(:timestamp), :country_code, :confirmation_code";
      $script_c = ") ON DUPLICATE KEY UPDATE " .
                  "email=VALUES(email)";
      
      if(!empty($add_info))
      {
         $script_a .= ", add_info";
         $script_b .= ", :add_info";
         $script_c .= ", add_info=VALUES(add_info)";
      }

      foreach($data as $key => $value)
      {         
         $script_a .= ", "  . $key;
         $script_b .= ", :" . $key;
         $script_c .= ", "  . $key . "=VALUES(" . $key . ")";
      }      
      
      $script = $script_a . $script_b . $script_c;      
      
      $statement = $this->pdo->prepare($script);
      $statement->bindValue(":email", $email, PDO::PARAM_STR);
      $statement->bindValue(":timestamp", time(), PDO::PARAM_INT);
      $statement->bindValue(":country_code", $country_code, PDO::PARAM_STR);
      $statement->bindValue(":confirmation_code", $confirmation_code, PDO::PARAM_STR);
      
      if(!empty($add_info))
         $statement->bindValue(":add_info", $add_info, PDO::PARAM_STR);
      
      foreach($data as $key => $value)
         $statement->bindValue(":" . $key, $value, PDO::PARAM_BOOL);
      
      $statement->execute();
      
      $result = $statement->rowCount();
      
      if($result === 1)
      {
         $this->send_confirmation_email($email, $confirmation_code);
      }
      
      return $result;
   } // add_subscription
   
   private function send_confirmation_email($email, $confirmation_code)
   {
      $date_string = date("Y-m-d H:i:s");
      $confirmation_url = "http://www.dargon.io/do_confirm/" . $confirmation_code . "/";

      $headers = "";
      $headers .= "Reply-To: The Dargon Project <noreply@dargon.io>\r\n"; 
      $headers .= "Return-Path: The Dargon Project <noreply@dargon.io>\r\n"; 
      $headers .= "From: The Dargon Project <noreply@dargon.io>\r\n"; 
      $headers .= "Organization: The Dargon Project\r\n";
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
      $headers .= "X-Priority: 3\r\n";
      $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";

      $message = "<div style='font-family: \"Courier New\", Courier, monospace'>".
                 "<p style='display:none; display:none !important;'>- BEGIN MESSAGE GENERATED ON " . $date_string . " - </p>".
                 "<p>To whom it may concern,</p>".
                 "<p>".
                 "We've received your request for updates regarding The Dargon Project.".
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
                 "<a href='" . $confirmation_url . "'>".
                 $confirmation_url.
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
      $result = mail($email, "[Dargon] Confirm your email address!", $message, $headers);
      return $result;
   }
   
   public function confirm_subscription($confirmation_code)
   {
      $statement = $this->pdo->prepare("UPDATE jr_subscriptions SET confirmed=1, confirmation_code=\"\" WHERE confirmation_code=:confirmation_code");
      $statement->bindParam(":confirmation_code", $confirmation_code);
      $statement->execute();
      return $statement->rowCount();
   }
}

?>