<!DOCTYPE html>
<html>
<head>
<title>Welcome to the Manna Network Installation Page!</title>
<style>
    body {
        width: 35em;
        margin: 0 auto;
        font-family: Tahoma, Verdana, Arial, sans-serif;
    }
</style>
</head>
<body>


<h1>Installation</h1>

<p>This installation process will: 

<br><b>Create TWO databases:</b>

<br> 1) manna_agents and 
<br> 2) manna_customers 
<br>
<hr>
<br><b>AND Create TWO users for EACH database (four users total):</b>

<br> 1) manna_agents with read access only
<br> 2) manna_agents with write and read access
<br>
<br> 1) manna_customers read access
<br> 2) manna_customers write access
<br>
<br>
<h3><u>Step 1</u> - Create Databases Specifically For Manna Network</h3>
<b>a)</b> Configure a <u>TEMPORARY</u> db user with nearly full authorization (everything except delete) so that it can create the other users and databases and tables and then delete it after installation is complete (for security reasons).
<br><b>b)</b>  Edit the file here and enter the db user credentials manna-configs/db_root_cfg/db_root_auth.php
<br><b>c)</b>  Edit and Configure the file here and enter the correct URL information manna-configs/manna-network-url_cfg.php
<br><br>
<h3><u>Step 2</u></h3>

<br>
Visit <a target="_blank" href="createdatabase.php"> this page</a> to create the two databases and to create the four users for the databases that Manna Network requires.
<br>
<br>
<h3><u>Step 3</u></h3>
<br>
NOW Fill Your Database Tables - Download the latest (daily) data to fill your database by clicking the link below. </p>
Complete data (sql) file (updated daily) <a target="_blank" href="fill_db/get_latest_data_from_manna.php">fill_db/get_latest_data_from_manna.php</a>
<br>
<br>
<h3><u>Step 4</u></h3>
<br>
<p>After you have copied or moved that downloaded file into the manna-network/admin/install/fill_db/manna_daily folder and unzipped it, click this link <br><a target="_blank" href="fill_db/insert_table_data.php">insert_table_data.php</a> (located in that folder) <br>and it will insert the uploaded file's data into the proper tables.
<br>
<br>
<h3><u>Step 5</u></h3>
<br>
<p>After you have inserted the latest data files, click this link <br><a target="_blank" href="../network-sync.php">network-sync.php</a> <br>and it will run a script to sync the data you inserted with the Manna Network  server to enable it to update your tables with daily entries and purchase and rankings.

