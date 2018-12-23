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

$sql="CREATE TABLE `balance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `t_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount_DMC` decimal(20,10) unsigned zerofill NOT NULL,
  `amount_BCH` decimal(20,10) unsigned zerofill NOT NULL,
  `txid` varchar(65) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ;
";

if ($conn->query($sql) === TRUE) {
    echo "<br>Table balance created successfully";
} else {
    echo "<br>Error creating balance table: " . $conn->error;
}


$conn->close();

?>

