<?php
class Registration
{
     private $db_connection            = null;

    public  $registration_successful  = false;
 
    public  $verification_successful  = false;

    public  $errors                   = array();

    public  $messages                 = array();


    public function __construct()
    {
    session_start();

//include('../db_cfg/agent1_writer_customers_auth.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/manna-network/db_cfg/auth_constants.php');
//load the READONLY AUTHS to select from category and regional-categories2 tables

       if (isset($_POST["register"]) AND !isset($_POST['opener'])) {
  $downline_name = ""; 
$downline_email = ""; 
$downline_password_new = ""; 
$downline_password_repeat = ""; 
$captcha = "";
$wdgts_lnk_num = "";
$wdgts_id = "";
$website_title = ""; 
$website_url = ""; 
$website_description = ""; 
$category_id = "";
$location_id = "";
$location_name = ""; 
$website_street = "";
$website_district = "";

if (array_key_exists ( "downline_name" , $_POST ) AND isset($_POST["downline_name"])) {$downline_name = $_POST['downline_name']; }
 if (array_key_exists ( "downline_email" , $_POST ) AND isset($_POST["downline_email"])) {$downline_email = $_POST['downline_email']; }
 if (array_key_exists ( "downline_password_new" , $_POST ) AND isset($_POST["downline_password_new"])) {$downline_password_new = $_POST['downline_password_new']; }
 if (array_key_exists ( "downline_password_repeat" , $_POST ) AND isset($_POST["downline_password_repeat"])) {$downline_password_repeat = $_POST['downline_password_repeat'];} 
 if (array_key_exists ( "captcha" , $_POST ) AND isset($_POST["captcha"])) {$captcha = $_POST["captcha"];} 
 if (array_key_exists ( "wdgts_lnk_num" , $_POST ) AND isset($_POST["wdgts_lnk_num"])) {$wdgts_lnk_num = $_POST["wdgts_lnk_num"];} 
 if (array_key_exists ( "wdgts_id" , $_POST ) AND isset($_POST["wdgts_id"])) {$wdgts_id = $_POST["wdgts_id"];} 
 if (array_key_exists ( "website_title" , $_POST ) AND isset($_POST["website_title"])) {$website_title = $_POST["website_title"];} 
 if (array_key_exists ( "website_url" , $_POST ) AND isset($_POST["website_url"])) {$website_url = $_POST["website_url"];} 
 if (array_key_exists ( "website_description" , $_POST ) AND isset($_POST["website_description"])) {$website_description = $_POST["website_description"];} 
 if (array_key_exists ( "category_id" , $_POST ) AND isset($_POST["category_id"])) {$category_id = $_POST["category_id"];} 
 if (array_key_exists ( "location_id" , $_POST ) AND isset($_POST["location_id"])) {$location_id = $_POST["location_id"];} 
 if (array_key_exists ( "location_name" , $_POST ) AND isset($_POST["location_name"])) {$location_name= $_POST["location_name"];} 
 if (array_key_exists ( "website_street" , $_POST ) AND isset($_POST["website_street"])) {$website_street = $_POST["website_street"];} 
if (array_key_exists ( "website_district" , $_POST ) AND isset($_POST["website_district"])) {$website_district = $_POST["website_district"];} 

//place the vars into sessions so if the transaction fails they can be used to insert in the form rather than have user reenter them (tedious)
$_SESSION['downline_name'] = $downline_name; 
$_SESSION['downline_email'] = $downline_email; 
$_SESSION['downline_password_new'] = $downline_password_new; 
$_SESSION['downline_password_repeat'] = $downline_password_repeat; 
$_SESSION["captcha"] = $captcha; 
$_SESSION["website_title"] = $website_title; 
$_SESSION["website_url"] = $website_url; 
$_SESSION["website_description"] = $website_description; 
$_SESSION["category_id"] = $category_id;  
$_SESSION["location_id"] = $location_id; 
$_SESSION["website_street"] = $website_street;
 
 $this->registerNewDownline($downline_name, $downline_email, $downline_password_new, $downline_password_repeat, $website_title, $website_url, $website_description, $category_id , $location_name, $location_id, $website_street, $website_district, $captcha);   
// if we have such a GET request, call the verifyNewDownline() method
        } else if (isset($_GET["id"]) && isset($_GET["verification_code"])) {
            $this->verifyNewDownline($_GET["id"], $_GET["verification_code"]);
        }
    }

    private function databaseConnection()
    {
        if ($this->db_connection != null) {
            return true;
        } else {
           include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".READER_DOWNLINES);
             $dsn = 'mysql:dbname='.$dbname.';host='.$servername;
             $user = $username;
             $password = $password;
                try {
                      $dbreader = new PDO($dsn, $user, $password);     
                 return true;
                } catch (PDOException $e) {
                $this->errors[] = MESSAGE_DATABASE_ERROR;
                return false;
            }
        }
    }
     private function registerNewDownline($downline_name, $downline_email, $downline_password, $downline_password_repeat, $website_title, $website_url, $website_description, $category_id, $location_name, $location_id, $website_street, $website_district, $captcha)  
    {
        $downline_name  = trim($downline_name);
        $downline_email = trim($downline_email);
        if (strtolower($captcha) != strtolower($_SESSION['captcha'])) {
          $this->errors[] = MESSAGE_CAPTCHA_WRONG;
       } elseif (empty($downline_name)) {
            $this->errors[] = MESSAGE_DOWNLINE_NAME_EMPTY;
        } elseif (empty($downline_password) || empty($downline_password_repeat)) {
            $this->errors[] = MESSAGE_PASSWORD_EMPTY;
        } elseif ($downline_password !== $downline_password_repeat) {
            $this->errors[] = MESSAGE_PASSWORD_BAD_CONFIRM;
        } elseif (strlen($downline_password) < 6) {
            $this->errors[] = MESSAGE_PASSWORD_TOO_SHORT;
        } elseif (strlen($downline_name) > 64 || strlen($downline_name) < 2) {
            $this->errors[] = MESSAGE_DOWNLINE_NAME_BAD_LENGTH;
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $downline_name)) {
            $this->errors[] = MESSAGE_DOWNLINE_NAME_INVALID;
        } elseif (empty($downline_email)) {
            $this->errors[] = MESSAGE_EMAIL_EMPTY;
        } elseif (strlen($downline_email) > 64) {
            $this->errors[] = MESSAGE_EMAIL_TOO_LONG;
        } elseif (!filter_var($downline_email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = MESSAGE_EMAIL_INVALID;
	} elseif (empty($website_title) ) {
            $this->errors[] = MESSAGE_WEBSITE_TITLE_EMPTY;
	} elseif (strlen($website_title) > 64 || strlen($website_title) < 6) {
            $this->errors[] = MESSAGE_WEBSITE_TITLE_BAD_LENGTH;
	} elseif (empty($website_url) ) {
            $this->errors[] = MESSAGE_WEBSITE_URL_EMPTY;
	} elseif (strlen($website_url) > 64) {
            $this->errors[] = MESSAGE_WEBSITE_URL_TOO_LONG; 
	} elseif (empty($website_description) ) {
            $this->errors[] = MESSAGE_WEBSITE_DESCRIPTION_EMPTY;
	} elseif (strlen($website_description) > 255) {
            $this->errors[] = MESSAGE_WEBSITE_DESCRIPTION_TOO_LONG;
	} elseif (!empty($website_street) AND empty($location_id)) {
             $this->errors[] .= MESSAGE_LOCATION_ID_EMPTY_STREET_FILLED; 
	} elseif (empty($category_id) ) {
           $this->errors[] = MESSAGE_WEBSITE_CATEGORY_EMPTY;
        // finally if all the above checks are ok
        } else if ($this->databaseConnection()) { 
  $dbreader = new PDO($dsn, $user, $password);
  $findUserNameExists = $dbreader->query('SELECT * FROM downlines WHERE downline_name = :downline_name ')->fetchColumn(); 
   $dbreader->bindParam(':downline_name', $downline_name, PDO::PARAM_STR);
     if ( $dbreader->last_row_count() == 0 ) {
       // the submitted user name is available 
         //Now check if the email is       
           $dbreader2 = new PDO($dsn, $user, $password);
             $findUserEmailExists = $dbreader2->query('SELECT * FROM downlines WHERE downline_email = :downline_email ')->fetchColumn(); 
               $dbreader2->bindParam(':downline_email', $downline_email, PDO::PARAM_STR);
                 if ( $dbreader2->last_row_count() == 0 ) {
                      //now that we know it TOO is available, process the user because both their selected user name and email are not used
  $hash_cost_factor = (defined('HASH_COST_FACTOR') ? HASH_COST_FACTOR : null);
			 $downline_password_hash = password_hash($downline_password, PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));
//now switch to write capable db downline			   
 $downline_activation_hash = sha1(uniqid(mt_rand(), true));
//NOW SWITCH TO DB USER WITH WRITE ACCESS
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".WRITER_DOWNLINES);
             $dsn = 'mysql:dbname='.$dbname.';host='.$servername;
             $user = $username;
             $password = $password;
                try {
                      $dbwriter = new PDO($dsn, $user, $password);     
                 return true;
                } catch (PDOException $e) {
                $this->errors[] = MESSAGE_DATABASE_ERROR;
                return false;
            };

				// write new downlines data into database
  $dbwriter = new PDO($dsn, $user, $password);
   $sql = "INSERT INTO downlines (downline_name, downline_password_hash, downline_email, downline_activation_hash, downline_registration_ip, downline_registration_datetime) VALUES (?, ?, ?, ?, ?,?)";
    $stmt= $dbwriter->prepare($sql);
     $now = date("Y-m-d H:i:s");
       $stmt->execute([$downline_name, $downline_password_hash,$downline_email, $downline_activation_hash, $_SERVER['REMOTE_ADDR'], $now ]);
         $lastInsertId = $dbwriter->lastInsertId(); 
	if ($lastInsertId) {
				//temporarily deactivate the requirement for email config in developmenet version
			        // send a verification email
				// HAVE THE VERIFICATION EMAIL SAY THEY NEED TO VERIFY THEIR EMAIL IN ORDER FOR THEIR LINK TO BE ADDED TO THE "APPROVAL QUEUE". Say "Otherwise it won't be broadcast to the network".

					/*            if ($this->sendVerificationEmail($downline_id, $downline_email, $downline_activation_hash)) {
							// when mail has been send successfully
							$this->messages[] = MESSAGE_VERIFICATION_MAIL_SENT;
							$this->registration_successful = true;
						    } else {
							// delete this downline users account immediately, as we could not send a verification email
							$query_delete_downline = $this->db_connection->prepare('DELETE FROM downlines WHERE downline_id=:downline_id');
							$query_delete_downline->bindValue(':downline_id', $downline_id, PDO::PARAM_INT);
							$query_delete_downline->execute();

							$this->errors[] = MESSAGE_VERIFICATION_MAIL_ERROR;
						    }
				      */ 
				  //after sending verification email insert the rest of the registration form into links and widgets table (where applicable)
				//send the values from post -> from registerNewUser() into links table  :website_title, :website_url, :website_description, :category_id, )
				
		$timestamp = time();
		//$stmt2 = $mysqli->prepare("INSERT INTO links (BB_user_ID, name, url, description, category, start_date) VALUES (?, ?, ?, ?, ?,?)");
		//$stmt2->bind_param("ssssss", $lastInsertId, $website_title, $website_url, $website_description, $category_id, $timestamp);
		//$stmt2->execute();
		//$new_link_id = $mysqli->insert_id;
		//$stmt2->close();



 $sql = "INSERT INTO links (MN_user_id, name, url, description, category, start_date) VALUES (?, ?, ?, ?, ?,?)";
    $stmt= $dbwriter->prepare($sql);
     $now = date("Y-m-d H:i:s");
       $stmt->execute([$lastInsertId, $website_title, $website_url, $website_description, $category_id, $timestamp]);
         $lastInsertId2 = $dbwriter->lastInsertId(); 

$dbwriter=null;//close the writers connection

//Open a readonly user
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/".WRITER_DOWNLINES);
             $dsn = 'mysql:dbname='.$dbname.';host='.$servername;
             $user = $username;
             $password = $password;
                try {
                      $dbreader = new PDO($dsn, $user, $password);     
                 return true;
                } catch (PDOException $e) {
                $this->errors[] = MESSAGE_DATABASE_ERROR;
                return false;
            };
				//if there is regional data enter that in regional signups :location_id, :website_street
						if($location_id > 1){
  $dbreader2 = new PDO($dsn, $user, $password);
             $findLocationExists = $dbreader2->query('SELECT * FROM categories_regional2 WHERE id = :id ')->fetchColumn(); 
               $dbreader2->bindParam(':id', $location_id, PDO::PARAM_INT);

 try {
		        $dbreader2 = new PDO($dsn, $user, $password);
		         foreach($dbreader2->query('SELECT * FROM categories_regional2 WHERE id = :id ')->fetchColumn(); 
		                                        $name	= $row['name'];
							$parent	= $row['parent'];
							$lft	= $row['lft'];
							$rgt	= $row['rgt'];
		         }

				 if ( $dbreader2->last_row_count() == 0 ) {
				$findLocationExists = 0;
				exit('No rows line 206');
				}
				else
				{
                                     try {
		        $dbreader2 = new PDO($dsn, $user, $password);
		         foreach($dbreader2->query('SELECT * FROM categories_regional2 WHERE `lft` < :lft  and `rgt` > :rgt ORDER by lft DESC')->fetchColumn(); 
		                                    $upid[] = $row['id'];
								$upname[]	= $row['name'];
								$upparent[]	= $row['parent'];
								$uplft[]	= $row['lft'];
								$uprgt[]	= $row['rgt'];

				 if ( $dbreader2->last_row_count() == 0 ) {
				$findLocationExists = 0;
				exit('No rows line 206');
				}
				else
				{


				}
		       $dbreader2 = null;
		      } catch (PDOException $e) {
		       print "Error!: " . $e->getMessage() . "<br/>";
		        die();
		      }


				}
		       $dbreader2 = null;
		      } catch (PDOException $e) {
		       print "Error!: " . $e->getMessage() . "<br/>";
		        die();
		      }





                 if ( $dbreader2->last_row_count() == 0 ) {
$findLocationExists = 0;
exit('No rows line 206');
}
else
{


}
						$stmt = $mysqli->prepare("SELECT * FROM categories_regional2 WHERE id = ?");
						$stmt->bind_param("s", $location_id);
						$stmt->execute();
						$result = $stmt->get_result();
						if($result->num_rows === 0) exit('No rows line 206');
							while($row = $result->fetch_assoc()) {
							$name	= $row['name'];
							$parent	= $row['parent'];
							$lft	= $row['lft'];
							$rgt	= $row['rgt'];
							}

						$stmt->close();

						//now get the upline of the selected region

						$stmt = $mysqli->prepare("SELECT * FROM categories_regional2 WHERE `lft` < ?  and `rgt` > ? ORDER by lft DESC");

						$stmt->bind_param("ii", $lft, $rgt);
						$stmt->execute();
						$result = $stmt->get_result();
							if($result->num_rows === 0){
							 exit('No rows line 221');
							}
							else
							{
							//if($result->num_rows > 1){
							$upid = array();
							$upname = array();
							$upparent = array();
							$uplft = array();
							$uprgt = array();
								while($row = $result->fetch_assoc()) {
								$upid[] = $row['id'];
								$upname[]	= $row['name'];
								$upparent[]	= $row['parent'];
								$uplft[]	= $row['lft'];
								$uprgt[]	= $row['rgt'];
								}

							$stmt->close();

							//heres the column names of regional_signups  id 	continent, country, state, district1, city, district2, street, link_id, cat_id

							$stmt3 = $mysqli->prepare("INSERT INTO regional_sign_ups (continent, country, state, city,  link_id, cat_id) VALUES (?, ?, ?, ?, ?,?)");
							$na = "0";
								if(count($upid) == 1){
								$stmt3->bind_param("iiiiii", $location_id, $na,$na,$na, $new_link_id, $category_id);
								}
								elseif(count($upid) == 2){
								$stmt3->bind_param("iiiiii", $upid[0], $location_id,$na,$na, $new_link_id, $category_id);
								}
								elseif(count($upid) == 3){
								$stmt3->bind_param("iiiiii", $upid[1], $upid[0],$location_id,$na, $new_link_id, $category_id);
								}
								elseif(count($upid) == 4){
								$stmt3 = $mysqli->prepare("INSERT INTO regional_sign_ups (continent, country, state, city,  link_id, cat_id, street) VALUES (?, ?, ?, ?, ?,?, ?)");
								$na = "0";
								$stmt3->bind_param("iiiiiis", $upid[2], $upid[1],$upid[0],$location_id, $new_link_id, $category_id, $website_street);
								}
							$stmt3->execute();
							$new_link_id = $mysqli->insert_id;
							$stmt3->close();
						     }
					   }
				} 
				else 
				{
			        $this->errors[] = MESSAGE_REGISTRATION_FAILED;
			        }
		         }
			else
			{
			$this->errors[] =  MESSAGE_EMAIL_ALREADY_EXISTS;
			}
	 	    }
		   else
		   {
		   $this->errors[] = MESSAGE_DOWNLINENAME_EXISTS ;
		}
              } 
            }

         /*
          * sends an email to the provided email address
          * @return boolean gives back true if mail has been sent, gives back false if no mail could been sent
          */
    public function sendVerificationEmail($downline_id, $downline_email, $downline_activation_hash)
    {
        $mail = new PHPMailer;

        // please look into the config/config.php for much more info on how to use this!
        // use SMTP or use mail()
        if ('EMAIL_USE_SMTP') {
            // Set mailer to use SMTP
            $mail->IsSMTP();
            //useful for debugging, shows full SMTP errors
            $mail->SMTPDebug = 2; // debugging: 1 = errors and messages, 2 = messages only
            // Enable SMTP authentication
            $mail->SMTPAuth = EMAIL_SMTP_AUTH;
            // Enable encryption, usually SSL/TLS
            if (defined(EMAIL_SMTP_ENCRYPTION)) {
                $mail->SMTPSecure = EMAIL_SMTP_ENCRYPTION;
            }
            // Specify host server
            $mail->Host = EMAIL_SMTP_HOST;
            $mail->Username = EMAIL_SMTP_USERNAME;
            $mail->Password = EMAIL_SMTP_PASSWORD;
            $mail->Port = EMAIL_SMTP_PORT;
        } else {
            $mail->IsMail();
        }

        $mail->From = EMAIL_VERIFICATION_FROM;
        $mail->FromName = EMAIL_VERIFICATION_FROM_NAME;
        $mail->AddAddress($downline_email);
        $mail->Subject = EMAIL_VERIFICATION_SUBJECT;
        $link = EMAIL_VERIFICATION_URL.'?id='.urlencode($downline_id).'&verification_code='.urlencode($downline_activation_hash);

  $mail->Body = EMAIL_VERIFICATION_CONTENT.' '.$link;

/////////////

        if(!$mail->Send()) {
            $this->errors[] = MESSAGE_VERIFICATION_MAIL_NOT_SENT . $mail->ErrorInfo;
            return false;
        } else {
            return true;
        }
    }

    /**
     * checks the id/verification code combination and set the downline user's activation status to true (=1) in the database
     */
    public function verifyNewDownline($downline_id, $downline_activation_hash)
    {
        // if database connection opened
        if ($this->databaseConnection()) {
            // try to update downline user with specified information
            $query_update_downline = $this->db_connection->prepare('UPDATE downlines SET downline_active = 1, downline_activation_hash = NULL WHERE downline_id = :downline_id AND downline_activation_hash = :downline_activation_hash');
            $query_update_downline->bindValue(':downline_id', intval(trim($downline_id)), PDO::PARAM_INT);
            $query_update_downline->bindValue(':downline_activation_hash', $downline_activation_hash, PDO::PARAM_STR);
            $query_update_downline->execute();

            if ($query_update_downline->rowCount() > 0) {
                $this->verification_successful = true;
                $this->messages[] = MESSAGE_REGISTRATION_ACTIVATION_SUCCESSFUL;
            } else {
                $this->errors[] = MESSAGE_REGISTRATION_ACTIVATION_NOT_SUCCESSFUL;
            }
        }
    }
}
