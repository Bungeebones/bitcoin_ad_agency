<?php

if(!defined("DB_NAME_CUSTOMERS")){
include(dirname( __FILE__, 6 )."/manna-configs/db_cfg/auth_constants.php");
}
$dbname = DB_NAME_CUSTOMERS; //both names of each database were saved to the auth+
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("<br>Connection failed: " . $conn->connect_error);
} 
echo "<br>Connected successfully";

$sql="

CREATE TABLE `price_slots_daily_ledger` (
  `id` int(20) NOT NULL,
  `user_id` int(8) NOT NULL DEFAULT '0',
  `link_id` int(9) NOT NULL,
  `balance` decimal(20,10) NOT NULL DEFAULT '0.0000000000',
  `tn_balance` decimal(20,10) NOT NULL DEFAULT '0.0000000000',
  `trans_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `trans_type` varchar(7) DEFAULT NULL,
  `deposit` decimal(20,10) NOT NULL DEFAULT '0.0000000000',
  `deposit_id` varchar(18) NOT NULL DEFAULT '0',
  `purchase` decimal(20,10) NOT NULL DEFAULT '0.0000000000',
  `purchase_id` varchar(18) NOT NULL DEFAULT '0',
 PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`),
INDEX `user_id` (`user_id`),
INDEX `link_id` (`link_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='price slots daily ledger';
";
if ($conn->query($sql) === TRUE) {
    echo "<br>Table price slots daily ledger created successfully";
} else {
    echo "<br>Error creating table price slots daily ledger: " . $conn->error;
}




$conn->close();
?>
