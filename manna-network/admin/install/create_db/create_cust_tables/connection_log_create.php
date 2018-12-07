<?php
if(!defined("DB_NAME_CUSTOMERS")){
include(__DIR__) . "../../../../../db_cfg/auth_constants.php";
}
$dbname = DB_NAME_CUSTOMERS; //both names of each database were saved to the auth+
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("<br>Connection failed: " . $conn->connect_error);
} 
echo "<br>Connected successfully";

$sql="CREATE TABLE `connection_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `t_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  
  `updated_table_list` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='customer data';

";
if ($conn->query($sql) === TRUE) {
    echo "<br>Table users created successfully";
} else {
    echo "<h3>Error creating table users: " . $conn->error.'</h3>';
}


$conn->close();
?>
