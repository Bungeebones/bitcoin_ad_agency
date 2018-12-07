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

$sql="CREATE TABLE `links` (
  `id` int(21) NOT NULL AUTO_INCREMENT,
  `customer_id` int(12) DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(76) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` int(20) NOT NULL DEFAULT '0',
  `nofollow` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on',
  `location_id` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `website_street` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website_district` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 `price_slot`         int(11)   NOT NULL DEFAULT '0',
`coin_type` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,   
  UNIQUE KEY `id_2` (`id`),
  KEY `id` (`id`),
  KEY `id_3` (`id`),
INDEX `location_id` (`location_id`),
INDEX `category` (`category`),
INDEX `price_slot` (`price_slot`)
) ENGINE=InnoDB AUTO_INCREMENT=8087 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='customer data';
";
if ($conn->query($sql) === TRUE) {
    echo "<br>Table links created successfully";
} else {
    echo "<br>Error creating links table: " . $conn->error;
}

$conn->close();

?>

