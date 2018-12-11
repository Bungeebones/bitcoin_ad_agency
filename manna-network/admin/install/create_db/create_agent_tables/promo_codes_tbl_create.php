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

$sql="
CREATE TABLE IF NOT EXISTS `promo_codes` (
`id` int(12) NOT NULL,
`t_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`promo_title`                  varchar(25)           NULL,                   
 `promo_description`            varchar(225)          NULL,                   
 `coin_type`                    varchar(60)           NULL,                   
 `promo_amount`                 decimal(20,10) unsigned zerofill NOT NULL
) 

 ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='promo_codes';
";
if ($conn->query($sql) === TRUE) {
    echo "<br>Table promo_codes created successfully";
} else {
    echo "<br>Error creating table promo_codes: " . $conn->error;
}



$sql2="ALTER TABLE promo_codes MODIFY COLUMN id INT NOT NULL PRIMARY KEY AUTO_INCREMENT;";
if ($conn->query($sql2) === TRUE) {
    echo "<br>Table promo_codes altered successfully";
} else {
    echo "<br>Error altering table promo_codes: " . $conn->error;
}


$conn->close();
?>
