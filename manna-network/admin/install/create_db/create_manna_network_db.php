<?php

echo '<p style="text-align:left">

Enter the following command either in the mysql command line or the sql window of PHPMyAdmin or other MySql management software

<p style="text-align:left">
<code style=" color:red;">CREATE DATABASE mannanetwork;</code>';
echo "<p style=\"text-align:left\">
Create a user named \"reader\"- You should add/change/delete the random password as you like. Copy and save it in the password field in the agent/install/db_read_cfg/db_reader_auth.php file.
<p style=\"text-align:left\"><code style=\" color:red;\">CREATE USER 'reader'@'localhost' IDENTIFIED BY 'eCALxGstr2NhZFRU8LQ70yWU5sBxshC6OTTTr7dGOFqI994agkIQEp30lciZ';</code>


<p style=\"text-align:left\">Create a user named \"writer\"- You should add/change/delete the random password as you like. Copy and save it in the password field in the agent/install/db_write_cfg/db_writer_auth.php file
<p style=\"text-align:left\"><code style=\" color:red;\">CREATE USER 'writer'@'localhost' IDENTIFIED BY
'0TX0YXhdccLBd8tEquef04imeaZ8yx5KcH5s9Kk9vtm3MnE0oDuHMIX1V5BD';</code>";
?>




