<?php
      include(dirname( __FILE__, 4 ).'/manna-configs/db_cfg/agent_config.php');

if(isset($_POST['submit']))	{
$site_path = $_SERVER['DOCUMENT_ROOT'] ;
  if($_SERVER['SERVER_PORT']=="443"){
   $site_url="https://".$_SERVER['SERVER_NAME'] ;
  }
  else
  {
   $site_url="http://".$_SERVER['SERVER_NAME'] ;
  }

$dbnamecustomers = $_POST['dbnamecustomers'];
 $dbnameagents = $_POST['dbnameagents'];
  session_start();
   $_SESSION['dbnameagents'] = $dbnameagents;
    $_SESSION['dbnamecustomers']   = $dbnamecustomers;
     echo "User Has submitted the form and entered this customer db name : <b> ".$dbnamecustomers ."</b>";
      echo "<br>User Has submitted the form and entered this agent db name : <b>". $dbnameagents." </b>";

 
        // Create connection
          function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
           {
            $pieces = [];
            $max = mb_strlen($keyspace, '8bit') - 1;
             for ($i = 0; $i < $length; ++$i) {
               $pieces []= $keyspace[random_int(0, $max)];
             }
          return implode('', $pieces);
          }
     

       $mysqli = new mysqli($servername, $username, $password);
        // Check connection
          if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
           } 
        echo "<br>Connected successfully";
if ( mysqli_select_db($mysqli, $dbnamecustomers)) {
   echo '<br>customers db exists<br> A "lock" was placed preventing the overwriting of database tables<br>Only a manual intervention (i.e. removing tables from mysql command line) can override the lock.';
$table_lock = 'true';
}
else
{
$table_lock = 'false';
         $sql="CREATE DATABASE IF NOT EXISTS ".$dbnamecustomers ;
	 if ($mysqli->query($sql) === TRUE) {
	    echo "<br>Customers Data base created successfully";
		}
		else
		{
		 echo "<br>Customers Data base creation FAILED";
		}
}
if (mysqli_select_db($mysqli, $dbnameagents)) {
   echo '<br>agents db exists<br> A "lock" was placed preventing the overwriting of database tables<br>Only a manual intervention (i.e. removing tables from mysql command line) can override the lock.';
$table_lock = 'true';
}
else
{
$table_lock = 'false';
		 $sql2="CREATE DATABASE IF NOT EXISTS ".$dbnameagents ;
	 if ($mysqli->query($sql2) === TRUE) {
	    echo "<br>Agents Data base created successfully";
		}
		else
		{
		echo "<br>Agents Data base creation FAILED";
		}
}

if($table_lock=="true"){
echo '<h1>Tables are locked but new user passwords and authorization files are being created</h1>';
}
		$cust_db_reader_pw = random_str(32);
		$cust_db_writer_pw = random_str(32);
		$agent_db_reader_pw = random_str(32);
		$agent_db_writer_pw = random_str(32);

		$sql1="CREATE USER '".$_POST['manna_reader_customers']."'@'localhost' IDENTIFIED BY '".$cust_db_reader_pw."'"; 
		$sql2="CREATE USER '".$_POST['manna_writer_customers']."'@'localhost' IDENTIFIED BY '".$cust_db_writer_pw."'";
               	$sql3="CREATE USER '".$_POST['manna_reader_agents']."'@'localhost' IDENTIFIED BY '".$agent_db_reader_pw."'"; 
		$sql4="CREATE USER '".$_POST['manna_writer_agents']."'@'localhost' IDENTIFIED BY '".$agent_db_writer_pw."'";

echo '<br>$sql1 = ', $sql1;
echo '<br>$sql2 = ', $sql2;
echo '<br>$sql3 = ',  $sql3;
echo '<br>$sql4 = ',  $sql4;

/////////////////  Each pair of sql statements = a read/write pair of users for each db ////////////////////////////////
	//////////////////   For each successful query, we have a user that needs writes granted	


			if ($mysqli->query($sql1) === TRUE) {
			 echo "<br>the user ".$_POST['manna_reader_customers']." - was  create successfully ";
			 //now we have to also copy that password to the database config file so that the user can be used to access data
			  //file_get_contents db_cfg/db_writer_auth_template.php and db_cfg/db_reader_auth_template.php
			   $sqlc="GRANT SELECT on ".$dbnamecustomers.".* to '". $_POST['manna_reader_customers']."'@'localhost'";
			     if ($mysqli->query($sqlc) === TRUE) {
					    echo "<br>the read only user ".$_POST['manna_reader_customers']." - was  granted rights successfully ";
				
					}
					else
					{
					 echo "<br>the readonly capable user ".$_POST['manna_reader_agents']." - FAILED  granting rights line 104 ";
					}

				}
else
{
echo '<h1>Failed to connect to db to grant user permissions -  sql1'.$sql1.'</h1>';

}
			       if ($mysqli->query($sql2) === TRUE) {
					    echo "<br>the user ".$_POST['manna_writer_customers']." - was  create successfully ";
			       //now we have to also copy that password to the database config file so that the user can be used to access data
			       //file_get_contents db_cfg/db_writer_auth_template.php and db_cfg/db_reader_auth_template.php
				$sqla="GRANT SELECT, DELETE, UPDATE, INSERT on ".$dbnamecustomers.".* to '". $_POST['manna_writer_customers']."'@'localhost'";
				  if ($mysqli->query($sqla) === TRUE) {
					    echo "<br>the write capable user ".$_POST['manna_writer_customers']." - was  granted rights successfully ";
				
						}
						else
						{
						 echo "<br>the write capable user ".$_POST['manna_writer_customers']." - FAILED  granting rights line 122 ";
						}
					 }
else
{
echo '<h1>Failed to connect to db to grant user permissions -  sql2 '.$sql2.'</h1>';

}
				if ($mysqli->query($sql3) === TRUE) {
				 echo "<br>the user ".$_POST['manna_reader_agents']." - was  create successfully ";
				 //now we have to also copy that password to the database config file so that the user can be used to access data
				  //file_get_contents db_cfg/db_writer_auth_template.php and db_cfg/db_reader_auth_template.php
				   $sqlc="GRANT SELECT on ".$dbnameagents.".* to '". $_POST['manna_reader_agents']."'@'localhost'";
				     if ($mysqli->query($sqlc) === TRUE) {
					    echo "<br>the read only user ".$_POST['manna_reader_agents']." - was  granted rights successfully ";
				
					}
					else
					{
					 echo "<br>the readonly capable user ".$_POST['manna_reader_agents']." - FAILED  granting rights line 134 ";
					}

				}
else
{
echo '<h1>Failed to connect to db to grant user permissions -  sql3 '.$sql3.'</h1>';

}
			       if ($mysqli->query($sql4) === TRUE) {
					    echo "<br>the user ".$_POST['manna_writer_agents']." - was  create successfully ";
			       //now we have to also copy that password to the database config file so that the user can be used to access data
			       //file_get_contents db_cfg/db_writer_auth_template.php and db_cfg/db_reader_auth_template.php
				$sqlb="GRANT SELECT, DELETE, UPDATE, INSERT on ".$dbnameagents.".* to '". $_POST['manna_writer_agents']."'@'localhost'";
				  if ($mysqli->query($sqlb) === TRUE) {
					    echo "<br>the write capable user ".$_POST['manna_writer_agents']." - was  granted rights successfully ";
				
						}
						else
						{
						 echo "<br>the write capable user ".$_POST['manna_writer_agents']." - FAILED  granting rights line 149 ";
						}
					 }
else
{
echo '<h1>Failed to connect to db to grant user permissions - sql4 '.$sql4 .'</h1>';

}
	//define and create a "constants" file to save the names of db user in order to retrieve the customized file names later
                     $constants_writer = '<?php     
                                 define("READER_CUSTOMERS", "'.   $_POST['manna_reader_customers']. '_auth.php");
                                 define("WRITER_CUSTOMERS", "'. $_POST['manna_writer_customers']. '_auth.php");
				 define("READER_AGENTS", "'.   $_POST['manna_reader_agents']. '_auth.php");
 				define("WRITER_AGENTS", "'.  $_POST['manna_writer_agents']. '_auth.php");
define("DB_NAME_CUSTOMERS", "'.$dbnamecustomers.'");
define("DB_NAME_AGENTS", "'.$dbnameagents.'");
					?>';

//////////////////////////////     Now we save the constants file  -- The file will be "included" before ALL data calls and can call each/any user for each/any db from the constants used. 

$constants_save_location = dirname( __FILE__, 4 )."/manna-configs/db_cfg/auth_constants.php";
echo '<br>line 186 $constants_save_location = = ', $constants_save_location;
$handle = fopen($constants_save_location, 'w') or die('<br> Cannot open file line 186:  '.$constants_save_location); //open file for writing ('w','r','a')...
fwrite($handle, $constants_writer);

		  

////////////////  Now, we create four db authorization user files (four files altogether) - a readonly & read/write user for each db  //////////////
  ///////////////   the customers db deals mostly with page viewers, the agents db deals with network connections. separating them is more secure.  //////////////////////////////

   		 $web_content_cust_reader='<?php
			      $servername = "localhost";
			      $username = "'.$_POST['manna_reader_customers'].'";
			      $password = "'.$cust_db_reader_pw .'";
			      $dbname = "'.$dbnamecustomers .'";
			      ?>';
		$web_content_cust_writer='<?php
			      $servername = "localhost";
			      $username = "'.$_POST['manna_writer_customers'].'";
			      $password = "'.$cust_db_writer_pw .'";
			      $dbname = "'.$dbnamecustomers .'";
			      ?>';
		$web_content_agent_reader='<?php
			      $servername = "localhost";
			      $username = "'.$_POST['manna_reader_agents'].'";
			      $password = "'.$agent_db_reader_pw .'";
			      $dbname = "'.$dbnameagents .'";
			      ?>';
		$web_content_agent_writer='<?php
			      $servername = "localhost";
			      $username = "'.$_POST['manna_writer_agents'].'";
			      $password = "'.$agent_db_writer_pw .'";
			      $dbname = "'.$dbnameagents .'";
			      ?>';


 				try {
                                  $auth_filepath = dirname( __FILE__, 4 )."/manna-configs/db_cfg/".$_POST['manna_reader_customers']."_auth.php";
                                $handle = fopen($auth_filepath, 'w') or die('Cannot open file line 223:  '.$auth_filepath); //open file for writing ('w','r','a')...
                                  fwrite($handle, $web_content_cust_reader);
                                  echo '<br>User auth files saved to ', $auth_filepath;
			          $e = "Could not write the database user configuration. <br><br>";
				 if ($web_content_cust_reader === false) {
				 // Handle the error
				 echo '<h1>Writing CUSTOMER Reader db config failed</h1>';
				    }
			       } catch (Exception $e) {
				    // Handle exception
				 echo'<h1>web_content exception'.$e.'</h1>';
			       }
			      

				 try {
				//$new_hostname2 = $site_path."/db_cfg/".$new_manna_db_writer_user."_auth.php";
                                  $auth_filepath2 = dirname( __FILE__, 4 )."/manna-configs/db_cfg/".$_POST['manna_writer_customers']."_auth.php";
                                   echo '<br>User auth files saved to ', $auth_filepath2;
                                    $handle = fopen($auth_filepath2, 'w') or die('Cannot open file 241:  '.$auth_filepath2); //open file for writing ('w','r','a')...
                                  fwrite($handle, $web_content_cust_writer);
					$f = "Could not write the database user configuration. <br><br>";
				  if ($web_content_cust_writer === false) {
				  // Handle the error
				  echo '<h1>Writing CUSTOMER Writer db config failed</h1>';
				    }
				} catch (Exception $f) {
				    // Handle exception
				echo'<h1>web_content exception'.$f.'</h1>';
				}




 				try {
                                  $auth_filepath3 = dirname( __FILE__, 4 )."/manna-configs/db_cfg/".$_POST['manna_reader_agents']."_auth.php";
                                $handle = fopen($auth_filepath3, 'w') or die('Cannot open file 258:  '.$auth_filepath3); //open file for writing ('w','r','a')...
                                  fwrite($handle, $web_content_agent_reader);
                                  echo '<br>User auth files saved to ', $auth_filepath3;
			         $e = "Could not write the database user configuration. <br><br>";
				 if ($web_content_agent_reader === false) {
				 // Handle the error
				 echo '<h1>Writing AGENT Reader db config failed</h1>';
				    }
			       } catch (Exception $e) {
				    // Handle exception
				 echo'<h1>web_content exception'.$e.'</h1>';
			       }
			      

				 try {
				  $auth_filepath4 = dirname( __FILE__, 4 )."/manna-configs/db_cfg/".$_POST['manna_writer_agents']."_auth.php";
                                   echo '<br>User auth files saved to ', $auth_filepath4;
                                    $handle = fopen($auth_filepath4, 'w') or die('Cannot open file 274:  '.$auth_filepath4); //open file for writing ('w','r','a')...
                                  fwrite($handle, $web_content_agent_writer);
					$f = "Could not write the database user configuration. <br><br>";
				  if ($web_content_agent_writer === false) {
				  // Handle the error
				  echo '<h1>Writing AGENT Writer db config failed</h1>';
				    }
				} catch (Exception $f) {
				    // Handle exception
				echo'<h1>web_content exception'.$f.'</h1>';
				}

if($table_lock=="true"){

echo
			'<h3> Summary: Except for errors reported above, <b><u>NO Data base</u></b> have been created. No new users were created but each user was given new passwords. A new file was created (overwriting their previous one) for each user essentially saving that users new login credentials with different 32 character long passwords. The database tables for each of the two databases could have data and, so, were locked and not overwritten.</h3>';


echo '<h1>Close this browser window to return to the admin/install/index.php page </h1>

<h1>NEXT STEP: Follow the directions under the "Fill Your Database Tables" section</h1>'; 


}
else
{
			//now we need to create tables for each database (by naming conventions and folder name)
			//////////////////////////////////////   cust folder  /////////////////////////////////
					include('create_db/create_cust_tables/customers_tbl_create.php');
                                        include('create_db/create_cust_tables/balance_tbl_create.php');
					include('create_db/create_cust_tables/price_slots_daily_ledger_tbl_create.php');
					include('create_db/create_cust_tables/price_slots_subscripts_tbl_create.php');
					include('create_db/create_cust_tables/regional_sign_ups_tbl_create.php');
					include('create_db/create_cust_tables/customer_links_tbl_create.php');
					include('create_db/create_cust_tables/users_tbl_create.php');
                                        include('create_db/create_cust_tables/customer_promo_tbl_create.php');
include('create_db/create_agent_tables/categories_tbl_create.php');
include('create_db/create_agent_tables/categories_regional2_tbl_create.php');
include('create_db/create_agent_tables/links_tbl_create.php');
include('create_db/create_agent_tables/recruiters_tree_tbl_create.php');			
			echo
			'<h3> Summary: Except for errors reported above, Two Data base have been created, along with two users for each, and each user was granted either readonly access or write/read abilities to that db. A file was created for each user essentially saving that users login credentials with different 32 character long passwords. A "constants" file was created and will be included at every data base call to select the appropriate user using the minimum privileges for security. Lastly, we created the database tables for each of the two databases for use by your installed script.</h3>';


echo '<h1>Close this browser window to return to the admin/install/index.php page </h1>

<h1>NEXT STEP: Follow the directions under the "Fill Your Database Tables" section</h1>'; 

}
        }
	else
	{
function checkRootMysqlUser(){
       include(dirname( __FILE__, 4 ).'/manna-configs/db_cfg/agent_config.php');
       $mysqli = new mysqli($servername, $username, $password);
        // Check connection
          if ($mysqli->connect_error) {
            return("Connection failed: " . $mysqli->connect_error);
           } else
{
        return "Connected successfully";
}
}

$db_connect = checkRootMysqlUser();
	?>
	<!DOCTYPE html>
	<html>
	<head>
	<title>Create the Manna Network!</title>
	<style>
	    body {
		width: 35em;
		margin: 0 auto;
		font-family: Tahoma, Verdana, Arial, sans-serif;
	    }
	</style>
	</head>
	<body>
<h1>Manna Network Agent Version Installation</h1>
<h4>First, we confirm that you have configured the manna-configs/agent_config.php file.</h4>
<?php
/*if($agent_url=="insert your site's domain name here"){
echo '<p style="color:red;">Test 1 FAILED - You need to configure the $agent_url in the manna-configs/agent_config.php file
<br>Enter your website\'s domain name between the quotes';
}
else
{
echo '<p style="color:darkgreen;">Test 1 SUCCESS - It appears you have correctly configured your site\'s domain name';
}
*/

if(AGENT_URL=="insert your site's domain name here"){
echo '<p style="color:red;">Test 1 FAILED - You need to configure the AGENT_URL in the manna-configs/agent_config.php file
<br>Enter your website\'s domain name between the quotes';
}
else
{
echo '<p style="color:darkgreen;">Test 2 SUCCESS - It appears you have correctly configured your site\'s domain name';
}





if(AGENT_ID=="insert your agent ID number here"){
echo '<p style="color:red;">Test 2 FAILED - You need to configure the AGENT_ID
<br>If you have not gotten one yet, contact the adminstrator at <a target="_blank" href="http://manna-network.com">http://manna-network.com</a> to apply for your agent id AND your $exchange_pw (BOTH needed in the config file)';}
elseif(!is_int(AGENT_ID)){
echo '<p style="color:red;">Test 2 FAILED - You need to configure the AGENT_ID as an INTEGER (i.e. no decimals, no quotes - just a number etc
<br>If you have not gotten one yet, contact the adminstrator at <a target="_blank" href="http://manna-network.com">http://manna-network.com</a> to apply for your agent id AND your $exchange_pw (BOTH needed in the config file)';
}
else
{
echo '<p style="color:darkgreen;">Test 2 SUCCESS - It appears you have correctly configured the AGENT_ID';
}

if($db_connect == "Connected successfully"){

echo '<p style="color:darkgreen;">Test 3 SUCCESS - This script has successfully connected to the Mysql database through the temporary user in the manna-configs/agent_config.php file. Remember to remove that user\'s login credentials after installation (for an extra level of security)';

}
else
{
echo '<p style="color:red;">Test 3 FAILED - This script currently cannot connect to the Mysql database. <p>Please configure the user in the manna-configs/agent_config.php file.<p>Grant that user enough privileges to create databases, add users and grant privileges to those users. <p>After installation, remove the password from that user for added security. ';
} 

if($exchange_pw == "insert your exchange_pw here" ){
echo '<p style="color:red;">Test 4 FAILED - You need to configure the $exchange_pw
<br>If you have not gotten one yet, contact the adminstrator at <a target="_blank" href="http://manna-network.com">http://manna-network.com</a> to apply for your agent id AND your $exchange_pw (BOTH needed in the config file)';


}
else
{
echo '<p style="color:darkgreen;">Test 4 SUCCESS - It appears you have correctly configured your $exchange_pw setting';
} 


?>
	<form name="test" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
	 <h2> Then we will create TWO separate databases for the Manna Network</h2>

	<h4>1) One will be for use by customers - mostly read only - but also will handle customer registrations</h4>
	<h4>2) The other will be for use by the Manna Network to sync the network's and agent's data</h4>
	<h4>3) You can create the two databases manually, instead, and enter their names below if you wish.</h4>

	Confirm (or edit) the name of database #1<input type="text" name="dbnamecustomers" value="manna_customers"><br>
	Confirm (or edit) the name of database #2<input type="text" name="dbnameagents" value="manna_agents"><br>

	<h2>We will create two users for each database</h2> 
	<h4>1) manna_reader_customer & manna_writer_customer and </h4><h4>2) manna_reader_agent & manna_writer_agent</h4>
	<h4>3) If the user name exists it will generate an error and will not install. Either delete the user or create a new one.</h4>
	Confirm (or edit) the username of readonly user on <b>customer</b> database<input type="text" name="manna_reader_customers" value="manna_reader_customers"><br>
	Confirm (or edit) the username of write capable user on <b>customer</b> database<input type="text" name="manna_writer_customers" value="manna_writer_customers"><br>
	<hr>
	Confirm (or edit) the username of readonly user on <b>agent</b> database<input type="text" name="manna_reader_agents" value="manna_reader_agents"><br>
	Confirm (or edit) the username of write capable user on <b>agent</b> database<input type="text" name="manna_writer_agents" value="manna_writer_agents"><br>
	<h4>We will then create 32 character random passwords for each and will store their login files in the db_cfg directory when completed</h4>

	<h2>Submitting the form will also create all the required tables for each database</h2>

	
		   <input type="submit" name="submit" value="Submit Form"><br>

		</form>


	</body>
	</html>
	<?php
	}
?>
