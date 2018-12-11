<?php
// deprecated on 12/8/2018  $agent_url = "insert your site's domain name here";
// commented out on createdatabase.php tests too
//NOTE: the next two settings can be adjusted according to your preference. Just be sure that you match the name changes you make here by renaming either and/or both the bitcoin_ad_agency-master  folder name or the manna-network folder name (you can even move the files and folders in the latter up one level)
// deprecated on 12/8/2018 $agent_folder = "bitcoin_ad_agency/manna-network";
if (!defined('AGENT_FOLDERNAME')) {
define("AGENT_FOLDERNAME", "bitcoin_ad_agency/manna-network");
}


//IMPORTANT - YOU NEED TO CONTACT MANNA NETWORK ADMINISTRATION TO GET A VALID AGENT ID. IMPROPER CONFIGURATION CAN RESULT IN LOSS OF YOUR AND YOUR DOWNLINE'S COMMISSIONS AND ENLISTMENT CREDITS! 
if (!defined('AGENT_ID')) {
define("AGENT_ID", 7);
}
if (!defined('AGENT_URL')) {
define("AGENT_URL", "https://central.com");
}
//root user with full grant capabilities - used for setup only - removing password after installation is fine
$servername = "localhost";
$username = "root";
$password = "M1y1s1q1l1***###";

$exchange_pw = "RkJYmDLnI3qC1lzyboigW1mZshp1GHTT";

//the original file at download should be like following
/*
if (!defined('AGENT_FOLDERNAME')) {
define("AGENT_FOLDERNAME", "bitcoin_ad_agency/manna-network");
}
if (!defined('AGENT_URL')) {
define("AGENT_URL", "insert your site's domain name here");
}

//IMPORTANT - YOU NEED TO CONTACT MANNA NETWORK ADMINISTRATION TO GET A VALID AGENT ID. IMPROPER CONFIGURATION CAN RESULT IN LOSS OF YOUR AND YOUR DOWNLINE'S COMMISSIONS AND ENLISTMENT CREDITS! 
if (!defined('AGENT_ID')) {
define("AGENT_ID", "insert your agent ID number here");//get it from https://manna-network.cash/admin/agents/register.php
//define("AGENT_ID", "1");//bad example WRONG  NOTE has quotes 
//Correct example - define("AGENT_ID", 1);
}

$exchange_pw = "insert your exchange_pw here";//get it from https://manna-network.cash/admin/agents/register.php

//temporary (i.e. for installation purposes only) root user with full grant capabilities - used for setup only - removing password after installation is fine
$servername = "localhost";
$username = "root";//your MySql user name here
$password = "insert your mysql user's password here";




*/
?>
