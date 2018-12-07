<?php
date_default_timezone_set('America/New_York'); 
 function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
           {
            $pieces = [];
            $max = mb_strlen($keyspace, '8bit') - 1;
             for ($i = 0; $i < $length; ++$i) {
               $pieces []= $keyspace[random_int(0, $max)];
             }
          return implode('', $pieces);
          }
include(dirname( __FILE__, 3 ). "/manna-configs/db_root_cfg/db_root_auth.php");
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
include(dirname( __FILE__, 3 ). "/manna-configs/db_root_cfg/mysqli_connect.php");
echo  '<br>$servername =',  $servername ;
echo '<br>$username = ',$username;
echo '<br>$password = ',$password;
echo '<br>$dbname = ', $dbname;

$READER_CUSTOMERS=READER_CUSTOMERS;

$WRITER_CUSTOMERS=WRITER_CUSTOMERS;
$READER_AGENTS=READER_AGENTS;
$WRITER_AGENTS=WRITER_AGENTS;
$DB_NAME_CUSTOMERS=DB_NAME_CUSTOMERS;
$DB_NAME_AGENTS=DB_NAME_AGENTS;

$update_array = array($READER_CUSTOMERS, $WRITER_CUSTOMERS, $READER_AGENTS, $WRITER_AGENTS);
echo '<br>"READER_CUSTOMERS= ', $READER_CUSTOMERS;
echo '<br>"WRITER_CUSTOMERS= ', $WRITER_CUSTOMERS;
echo '<br>"READER_AGENTS= ', $READER_AGENTS;
echo '<br>"WRITER_AGENTS= ', $WRITER_AGENTS;
echo '<br>"DB_NAME_CUSTOMERS= ', $DB_NAME_CUSTOMERS;
echo '<br>"DB_NAME_AGENTS= ', $DB_NAME_AGENTS;






if(isset($_POST['submit']))	{
echo 'in submit';
 $servername = "localhost";


		$cust_db_reader_pw = random_str(32);
		$cust_db_writer_pw = random_str(32);
		$agent_db_reader_pw = random_str(32);
		$agent_db_writer_pw = random_str(32);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".$READER_CUSTOMERS);
      $servername = "localhost";
			      $username1 = "a3_reader_customers";
				$dbnamecustomers = $dbname;


		  $sql1 ="UPDATE mysql.user SET authentication_string = PASSWORD('$cust_db_reader_pw') WHERE User='$username1'";
echo '<br>Error ',  $sql1;
		if ($conn->query($sql1) === TRUE) {
printf ("New Record has id %d.\n", mysqli_insert_id($conn));
		  echo("<br>Thank You. Your $READER_CUSTOMERS Password has been successfully changed.");
		}
else
{
echo '<br>Error ',  $sql1;
}
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".$WRITER_CUSTOMERS);
			      $username2 = "a3_writer_customers";
				$dbnamecustomers =  $dbname;
		  $sql2 ="UPDATE mysql.user SET authentication_string = PASSWORD('$cust_db_writer_pw') WHERE User='$username2'";
		if ($conn->query($sql2) === TRUE) {
printf ("New Record has id %d.\n", mysqli_insert_id($conn));
		  echo("<br>Thank You. Your $WRITER_CUSTOMERS Password has been successfully changed.");
		}
else
{
echo '<br>Error ',  $sql2;
}
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".$READER_AGENTS);
			      $username3 = "a3_reader_agents";
				$dbnameagents =$dbname; //should be exactly the same as below since are agents db name
		 $sql3 ="UPDATE mysql.user SET authentication_string = PASSWORD('$agent_db_reader_pw') WHERE User='$username3'";
echo '<br>'.$username3.'\'s encrpted password = '. $sql3;
		if ($conn->query($sql3) === TRUE) {
printf ("New Record has id %d.\n", mysqli_insert_id($conn));
		  echo("<br>Thank You. Your READER_AGENTS Password has been successfully changed.");
		}
else
{
echo '<br>Error ',  $sql3;
}
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".$WRITER_AGENTS);
  			      $username4 = "a3_writer_agents";
				$dbnameagents = $dbname ;
		  $sql4 ="UPDATE mysql.user SET authentication_string = PASSWORD('$agent_db_writer_pw') WHERE User='$username4'";
		if ($conn->query($sql4) === TRUE) {
printf ("New Record has id %d.\n", mysqli_insert_id($conn));
		  echo("<br>Thank You. Your WRITER_AGENTS Password has been successfully changed.");
		}
else
{
echo '<br>Error ',  $sql4;
}

/* We shouldn't ever have to rewrite the auth constants because the user form can't change any names
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

$constants_save_location = dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php";
$handle = fopen($constants_save_location, 'w') or die('<br> Cannot open file:  '.$constants_save_location); //open file for writing ('w','r','a')...
fwrite($handle, $constants_writer);
*/
		  

////////////////  Now, we create four db authorization user files (four files altogether) - a readonly & read/write user for each db  //////////////
  ///////////////   the customers db deals mostly with page viewers, the agents db deals with network connections. separating them is more secure.  //////////////////////////////

   		 $web_content_cust_reader='<?php
			      $servername = "localhost";
			      $username = "'.$username1.'";
			      $password = "'.$cust_db_reader_pw .'";
			      $dbname = "'.$dbnamecustomers .'";
			      ?>';
		$web_content_cust_writer='<?php
			      $servername = "localhost";
			      $username = "'.$username2.'";
			      $password = "'.$cust_db_writer_pw .'";
			      $dbname = "'.$dbnamecustomers .'";
			      ?>';
		$web_content_agent_reader='<?php
			      $servername = "localhost";
			      $username = "'.$username3.'";
			      $password = "'.$agent_db_reader_pw .'";
			      $dbname = "'.$dbnameagents .'";
			      ?>';
		$web_content_agent_writer='<?php
			      $servername = "localhost";
			      $username = "'.$username4.'";
			      $password = "'.$agent_db_writer_pw .'";
			      $dbname = "'.$dbnameagents .'";
			      ?>';


 				try {
                                  $auth_filepath = dirname( __FILE__, 4 ). "/manna-configs/db_cfg/".$username1."_auth.php";
                                $handle = fopen($auth_filepath, 'w') or die('Cannot open file:  '.$auth_filepath); //open file for writing ('w','r','a')...
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
                                  $auth_filepath2 = dirname( __FILE__, 4 ). "/manna-configs/db_cfg/".$username2."_auth.php";
                                   echo '<br>User auth files saved to ', $auth_filepath2;
                                    $handle = fopen($auth_filepath2, 'w') or die('Cannot open file:  '.$auth_filepath2); //open file for writing ('w','r','a')...
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

                                  $auth_filepath3 = dirname( __FILE__, 4 ). "/manna-configs/db_cfg/".$username3."_auth.php";
                                $handle = fopen($auth_filepath3, 'w') or die('Cannot open file:  '.$auth_filepath3); //open file for writing ('w','r','a')...
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
				  $auth_filepath4 = dirname( __FILE__, 4 ). "/manna-configs/db_cfg/".$username4."_auth.php";
                                   echo '<br>User auth files saved to ', $auth_filepath4;
                                    $handle = fopen($auth_filepath4, 'w') or die('Cannot open file:  '.$auth_filepath4); //open file for writing ('w','r','a')...
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

//lastly, we need to first flush the privileges and then, reinstate the privileges for the user


/////////////////////////////////////////////////////////////////////
        }
	else
	{
	?>
	<!DOCTYPE html>
	<html>
	<head>
	<title>Update your Manna Network User Passwords!</title>
	<style>
	    body {
		width: 35em;
		margin: 0 auto;
		font-family: Tahoma, Verdana, Arial, sans-serif;
	    }
	</style>
	</head>
	<body>
	<form name="test" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
	
	<h2>There are two databases and two users for each database</h2> 
	<h4>1) manna_reader_customer & manna_writer_customer and </h4><h4>2) manna_reader_agent & manna_writer_agent</h4>
	<h4>3) We will generate and save a new password for each of them.</h4>
	Confirm (or edit) the username of readonly user on <b>customer</b> database<input type="text" name="manna_reader_customers" value="manna_reader_customers"><br>
	Confirm (or edit) the username of write capable user on <b>customer</b> database<input type="text" name="manna_writer_customers" value="manna_writer_customers"><br>
	<hr>
	Confirm (or edit) the username of readonly user on <b>agent</b> database<input type="text" name="manna_reader_agents" value="manna_reader_agents"><br>
	Confirm (or edit) the username of write capable user on <b>agent</b> database<input type="text" name="manna_writer_agents" value="manna_writer_agents"><br>
	<h4>We will then create 32 character random passwords for each and will store their login files in the db_cfg directory when completed</h4>


	<h2 style="color:red;">Before submitting the form, be sure to have configured manna-configs/db_root_cfg/db_root_auth.php </h2>
		   <input type="submit" name="submit" value="Submit Form"><br>

		</form>


	</body>
	</html>
	<?php
	}
?>
