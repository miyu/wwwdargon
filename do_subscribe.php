<?php
function get_bool_or_false($name) {
   $val = array_key_exists($name, $_GET) ? $_GET[$name] : 
          (array_key_exists($name, $_POST) ? $_POST[$name] : "off");
   
   if(strcasecmp($val, "on") == 0 || 
      strcasecmp($val, "true") == 0 || 
      strcasecmp($val, "1") == 0)
      return true;
   return false;
};

function handle_data_bool(&$array, $name) {
   $array[$name] = get_bool_or_false($name);
};

$email = array_key_exists("email", $_GET) ? $_GET["email"] : 
            (array_key_exists("email", $_POST) ? $_POST["email"] : null);

$add_info = array_key_exists("add_info", $_GET) ? $_GET["add_info"] : 
            (array_key_exists("add_info", $_POST) ? $_POST["add_info"] : "");

if($email === null)
   die("email must be specified");

if (!filter_var($email, FILTER_VALIDATE_EMAIL))
   die("The email address ($email) is considered invalid.");

$data = array();
handle_data_bool($data, "i_alpha");
handle_data_bool($data, "i_beta");
handle_data_bool($data, "i_charity");
handle_data_bool($data, "i_addon");
handle_data_bool($data, "i_feedback");
handle_data_bool($data, "c_sw");
handle_data_bool($data, "c_re");
handle_data_bool($data, "c_webdesign");
handle_data_bool($data, "c_webdev");
handle_data_bool($data, "c_macos");
handle_data_bool($data, "c_mobile");
handle_data_bool($data, "c_linux");
handle_data_bool($data, "c_uxweb");
handle_data_bool($data, "c_gdesign");
handle_data_bool($data, "c_uxdesktop");
handle_data_bool($data, "c_gillust");
handle_data_bool($data, "c_community");
handle_data_bool($data, "c_audio");
handle_data_bool($data, "c_outreach");
handle_data_bool($data, "c_video");
handle_data_bool($data, "c_qa");
handle_data_bool($data, "c_local");
handle_data_bool($data, "c_support");
handle_data_bool($data, "c_textcomp");
handle_data_bool($data, "e_rdp");
handle_data_bool($data, "e_siu");
handle_data_bool($data, "e_rm");
handle_data_bool($data, "e_cs_simple");
handle_data_bool($data, "e_map_text");
handle_data_bool($data, "e_cs_adv");
handle_data_bool($data, "e_map_model");

require_once("include/wyvern_jr.php");
$wyvern = new WyvernJr(true);
$wyvern->increment_hits("do_subscribe", true);
$result = $wyvern->add_subscription($email, $data, trim($add_info));

$title = "__title__";
$message = "__message__";
switch($result)
{
   case 0: // nothing changed
      $title = "You're Good to Go!";
      $message = "We had an identical subscription for <i><b>" . $email . "</b></i>.";
      break;
   case 1: // inserted
      $title = "Confirm your Email Subscription";
      $message = "We've sent an email to <i><b>" . $email . "</b></i>. After receiving the email, please click the link provided to complete your subscription. ";
      break;
   case 2: // updated
      $title = "Subscription Updated";
      $message = "The previous subscription for <i><b>" . $email . "</b></i> was updated.";
      break;
}
?>
<h2><?php echo($title); ?></h2>
<p>
   <?php echo($message); ?> <br/>
   If you would like to update your response, <a href="#" onclick="returnToForm();">click here</a>.
</p>
<p>
</p>
<p>
   We're hoping to ship Dargon soon and will contact you whenever we do so. We've been grateful for your patience and can assure you that we're almost ready. The wait will be worth it. We promise.
</p>
<div style="margin-left: 1em; margin-top: 0.5em;">
   <span style="float: left; margin-right: 0.3em;">-</span>
   <div style="float: left; white-space: nowrap;" class="paragraph-like">
      ItzWarty <br/>
      Creator and Lead Developer of The Dargon Project <br/>
      <a href="http://www.Twitter.com/ItzWarty/">@ItzWarty on Twitter</a>, <a href="mailto:ItzWarty@gmail.com">ItzWarty@gmail.com</a><br/>
   </div>
   <br style="clear: both;"/>
</div>