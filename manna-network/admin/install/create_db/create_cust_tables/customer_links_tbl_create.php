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

$sql="
CREATE TABLE IF NOT EXISTS `customer_links` (
`id` int(12)  NOT NULL AUTO_INCREMENT,
`user_id`                  int(14)                    NULL,
`recruiter_lnk_num`              int(14)                   NULL,
`website_title`                  varchar(25)           NULL,                   
 `website_description`            varchar(225)          NULL,                   
 `website_url`                    varchar(60)           NULL,                   
 `category_id`                    int(12)               NULL,                   
 `newcatsuggestion`               varchar(60)           NULL,                   
 `location_id`                    int(12)               NULL,                   
 `website_street`                 varchar(80)           NULL,                   
 `website_district`               varchar(60)           NULL,
`customer_id`                  int(14)                    NULL,
`user_registration_datetime`  varchar(44)                NULL,
`wants_tobea_widget`        int DEFAULT 0,
PRIMARY KEY (id) ,
  KEY (id)   

) 

 ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ;
";
if ($conn->query($sql) === TRUE) {
    echo "<br>Table customers_links created successfully";
} else { 
    echo "<br>Error creating table customers_links: " . $conn->error;
}


$conn->close();
?>
