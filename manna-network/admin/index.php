<?php
 
echo '<h2>Installation</h2>
<p>Visit the installation page at <a href="install/index.php">/manna-network/admin/install/index.php</a>
<p>For online documentation and support please refer to
<a href="https://manna-network.com/">manna-network.com</a>.<br/> ';

echo '<h2>Maintenance and Update Features</h2>';
echo '<a target="_blank" href="update_user_pws.php">Update YOUR Database User Passwords</a> Note these passwords are ONLY used by the scripts and various servers so YOU do not need to memorize them and will never use them. BUT FOR SECURITY reasons it may be neccessary to change them.
<p>Also note ... in order for the script to work, it needs for you to reconfigure the db_root_auth.php file in the manna-configs folder. We say "reconfigure" because you should have disabled it after installation. Please be sure to deactivate it again after updating the DB reader and writer users.';




?>

