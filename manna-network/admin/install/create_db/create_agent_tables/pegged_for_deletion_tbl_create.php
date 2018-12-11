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

$sql="CREATE TABLE  `pegged_for_deletion` (
  `id` int(11) NOT NULL,
  `link_id` int(8) NOT NULL,
  `non_detectable` int(1) NOT NULL DEFAULT '0',
  `url` varchar(80) NOT NULL,
  `pegged_date` date NOT NULL,
 UNIQUE KEY `id_2` (`id`),
  KEY `id` (`id`),
  INDEX `link_id` (`link_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ;
";
if ($conn->query($sql) === TRUE) {
    echo "<br>Table pegged_for_deletion table created successfully";
} else {
    echo "<br>Error creating pegged_for_deletion table: " . $conn->error;
}

$conn->close();

?>


