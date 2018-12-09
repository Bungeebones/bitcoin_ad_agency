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
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',
  `user_name` varchar(60) NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255)  DEFAULT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64)  NOT NULL COMMENT 'user''s email, unique',
  `user_active` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'user''s activation status',
  `user_account_type` tinyint(1) DEFAULT NULL,
  `user_has_avatar` tinyint(1) DEFAULT NULL,
  `user_rememberme_token` varchar(64)  DEFAULT NULL COMMENT 'user''s remember-me cookie token',
  `user_creation_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of the creation of user''s account',
  `user_last_login_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of user''s last login',
  `user_failed_logins` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'user''s failed login attempts',
  `user_last_failed_login` int(10) DEFAULT NULL COMMENT 'unix timestamp of last failed login attempt',
  `user_activation_hash` varchar(40)  DEFAULT NULL COMMENT 'user''s email verification hash string',
  `user_password_reset_hash` char(40)  DEFAULT NULL COMMENT 'user''s password reset code',
  `user_password_reset_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of the password reset request',
  `recruiter_lnk_num` int(12) DEFAULT NULL,
  `agents_ID` int(12) DEFAULT NULL,
  `access_level` int(1) DEFAULT NULL,
  `user_registration_datetime` varchar(25)  DEFAULT NULL,
  `user_registration_ip` varchar(20)  DEFAULT NULL,
  `user_registration_proxy_ip` varchar(25) DEFAULT NULL,
`website_title`  varchar(25) DEFAULT NULL,
`website_description`  varchar(225) DEFAULT NULL,
`website_url`  varchar(60) DEFAULT NULL,
`category_id`  int(12) DEFAULT NULL,
`newcatsuggestion` varchar(60) DEFAULT NULL,
`location_id` int(12) DEFAULT NULL,
`website_street` varchar(80) DEFAULT NULL,
`website_district` varchar(60)  DEFAULT NULL,
`wants_tobea_widget` int(12) DEFAULT NULL,

  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='user data';

";
if ($conn->query($sql) === TRUE) {
    echo "<br>Table users created successfully";
} else {
    echo "<h3>Error creating table users: " . $conn->error.'</h3>';
}


$conn->close();
?>
