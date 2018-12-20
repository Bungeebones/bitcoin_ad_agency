<?php
//NOTE: the next AGENT_FOLDERNAME setting can be adjusted according to your folder naming preference. Just be sure that you match the name changes you make here to  those you make renaming the bitcoin_ad_agency folder 
if (!defined('AGENT_FOLDERNAME')) {
define("AGENT_FOLDERNAME", "bitcoin_ad_agency/manna-network");
}

//IMPORTANT - YOU MUST CONTACT MANNA NETWORK ADMINISTRATION TO GET A VALID AGENT ID! IMPROPER CONFIGURATION CAN RESULT IN LOSS OF YOUR AND YOUR DOWNLINE'S COMMISSIONS AND ENLISTMENT CREDITS! 
if (!defined('AGENT_ID')) {
define("AGENT_ID", 1);
}
if (!defined('AGENT_URL')) {
define("AGENT_URL", "https://1stwebtrafficbank.com");
}
if (!defined('AGENT_REGISTRATION_PAGE')) {
$agent_registration_page = AGENT_URL."/".AGENT_FOLDERNAME."/members/register.php";
define('AGENT_REGISTRATION_PAGE',$agent_registration_page);
}
if (!defined('AGENT_TECH_SUPPORT_CONTACT_PAGE')) {
define('AGENT_TECH_SUPPORT_CONTACT_PAGE',"https://1stwebtrafficbank.com/contact.php");
}

//root user with full grant capabilities - used for setup only - removing password after installation is fine
$servername = "localhost";
$username = "root";
$password = "M1y1s1q1l1***###";

$exchange_pw = "YHv23DJNSrSnJtAd2FICtnbagAcXC97V";


?>
