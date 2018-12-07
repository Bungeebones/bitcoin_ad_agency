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

$sql="CREATE TABLE `recruiters_tree` (
  `id` int(21) NOT NULL AUTO_INCREMENT,
 `url` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_id` int(6) NOT NULL DEFAULT '0',
  `wp_domain` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_parked` tinyint(1) DEFAULT '0',
  `parent` int(10) DEFAULT '0',
  `lft` int(10) NOT NULL DEFAULT '0',
  `rgt` int(10) NOT NULL DEFAULT '0',
  `time_period` tinyint(1) NOT NULL DEFAULT '8',
  `start_clone_date` int(10) DEFAULT NULL,
  `last_update` int(20) NOT NULL,
  `end_clone_date` datetime NOT NULL,
   `display_freebies` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  UNIQUE KEY `id_2` (`id`),
  KEY `id` (`id`),
  INDEX `link_id` (`link_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ;
";
if ($conn->query($sql) === TRUE) {
    echo "<br>Table recruiters_tree created successfully";
} else {
    echo "<br>Error creating recruiters_tree table: " . $conn->error;
}

$conn->close();

?>


