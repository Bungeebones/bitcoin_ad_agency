<?php
if(!defined("DB_NAME_CUSTOMERS")){
include(dirname( __FILE__, 6 ) . "/manna-configs/db_cfg/auth_constants.php");
}
$dbname = DB_NAME_CUSTOMERS; //both names of each database were saved to the auth+
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("<br>Connection failed: " . $conn->connect_error);
} 
echo "<br>Connected successfully";

$sql="CREATE TABLE `price_slots_subscripts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(8) NOT NULL DEFAULT '0',
  `link_id` int(8) NOT NULL,
  `price_slot_amnt` decimal(20,10) unsigned zerofill NOT NULL,
  `coin_type` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat_id` int(5) NOT NULL DEFAULT '0',
  `t_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `start_date` varchar(19) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `agent_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='customer data';
";

if ($conn->query($sql) === TRUE) {
    echo "<br>Table price_slots_subscripts created successfully";
} else {
    echo "<br>Error creating price_slots_subscripts table: " . $conn->error;
}


$conn->close();

?>

