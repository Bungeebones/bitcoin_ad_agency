<?php
$agent_url = "insert your site's domain name here";
$agent_folder = "manna-network";
//IMPORTANT - YOU NEED TO CONTACT MANNA NETWORK ADMINISTRATION TO GET A VALID AGENT ID. IMPROPER CONFIGURATION CAN RESULT IN LOSS OF YOUR AND YOUR DOWNLINE'S COMMISSIONS AND ENLISTMENT CREDITS! 

define("AGENT_ID", "insert your agent ID number here");
define("AGENT_FOLDERNAME", "manna-network");
define("AGENT_URL", "insert your site's domain name here");
//root user with full grant capabilities - used for setup only - removing password after installation is fine
$servername = "localhost";
$username = "root";
$password = "your_db_users_pw";

$exchange_pw = "insert your exchange_pw here";

//the original file at download should be like following
/*
$agent_url = "insert your site's domain name here";//insert your domain name inside the quotes
define("AGENT_URL", "insert your site's domain name here");

//IMPORTANT - YOU NEED TO CONTACT MANNA NETWORK ADMINISTRATION TO GET A VALID AGENT ID. IMPROPER CONFIGURATION CAN RESULT IN LOSS OF YOUR AND YOUR DOWNLINE'S COMMISSIONS AND ENLISTMENT CREDITS! 
define("AGENT_ID", "insert your agent ID number here");//get it from http://manna-network.cash/agents
//define("AGENT_ID", "1");//bad example WRONG  NOTE has quotes 
//Correct example - define("AGENT_ID", 1);

//temporary (i.e. for installation purposes only) root user with full grant capabilities - used for setup only - removing password after installation is fine
$servername = "localhost";
$username = "root";//your MySql user name here
$password = "insert your mysql user's password here";

$exchange_pw = "insert your exchange_pw here";//get it from http://manna-network.cash/agents

$agent_folder = "manna-network";
define("AGENT_FOLDERNAME", "manna-network");//get it from http://manna-network.cash/downloads/agents
*/
?>
