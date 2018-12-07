<?php
if(!defined("DB_NAME_AGENTS")){
include(dirname( __FILE__, 6 ) . "/manna-configs/db_cfg/auth_constants.php");
}
$dbname = DB_NAME_AGENTS; //both names of each database were saved to the auth+
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("<br>Connection failed: " . $conn->connect_error);
} 
echo "<br>Connected successfully";

$sql = "
CREATE TABLE `categories_regional2` (
  `id` int(21) NOT NULL,
  `name` varchar(36)DEFAULT NULL,
  `parent` int(21) DEFAULT '1',
  `lft` int(10) NOT NULL DEFAULT '0',
  `rgt` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`),
INDEX `parent` (`parent`),
INDEX `lft` (`lft`),
INDEX `rgt` (`rgt`)
)  ENGINE=InnoDB AUTO_INCREMENT=11287 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='categories regional2 data';
";
if ($conn->query($sql) === TRUE) {
    echo "<br>Table categories_regional2 created successfully";
} else {
    echo "<br>Error creating categories_regional2 table: " . $conn->error;
}

$conn->close();

?>

