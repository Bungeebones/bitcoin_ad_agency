<?php
echo '<br>in customers tbl(dirname( __FILE__, 6 ).', dirname( __FILE__, 6 );
echo '<br>in __DIR__', __DIR__;
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

$sql="
CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int(12) NOT NULL AUTO_INCREMENT,
 `remote_customer_id` int(12) NOT NULL,
 `agent_id` int(12) NOT NULL ,
PRIMARY KEY (customer_id) ,
  KEY (customer_id)   
)
 ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ;
";
if ($conn->query($sql) === TRUE) {
    echo "<br>Table customers created successfully";
} else {
    echo "<br>Error creating table customers: " . $conn->error;
}



$conn->close();
?>
