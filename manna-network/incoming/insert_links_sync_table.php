<?php
//grab the last entry from log and return hash of timestamp
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/agent_cfg.php");
if(!defined('WRITER_AGENTS')){ 
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/".WRITER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/mysqli_connect.php");
$searchString = ',';
 if( strpos($_POST['id'], $searchString) !== false ) {
     $results_are_arrays = 1;
 }
else
{
$results_are_arrays = 0;
}

//get the last inserted local link

$sql = "SELECT * FROM links ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");
while($row = mysqli_fetch_array($result)){
$this_last_url = $row['url'];
}

$link_hash_url = rtrim($this_last_url, "/ \t\n\r");
$conacat = $link_hash_url.$exchange_pw;
$link_hash_key = hash('sha512', $conacat);
if($_POST['link_hash_key'] == $link_hash_key){
	if($results_are_arrays == 1) 
	{
	$id = explode(",",$_POST['id']);
	$customer_id = explode(",",$_POST['customer_id']); 
	$category = explode(",",$_POST['category']); 
	$url = explode(",",$_POST['url']); 
	$name = explode(",",$_POST['name']); 
	$description = explode(",",$_POST['description']);
	$location_id = explode(",",$_POST['location_id']); 
	$website_street = explode(",",$_POST['website_street']);
	$website_district = explode(",",$_POST['website_district']);  
	$start_date = explode(",",$_POST['start_date']); 
	$nofollow = explode(",",$_POST['nofollow']); 
	$price_slot = explode(",",$_POST['price_slot']);
	$non_detectable = explode(",",$_POST['non_detectable']);
	$approved = explode(",",$_POST['approved']);
	   
	foreach($id as $key=>$value){
	$query = "INSERT INTO `links` (`id`,`customer_id`, `category`, `url`,`name`, `description`, `location_id`, `website_street`, `website_district`, `start_date`, `nofollow`, `price_slot`, `non_detectable`  ) VALUES ('$id[$key]', '$customer_id[$key]', '$category[$key]', '$url[$key]', '$name[$key]', '$description[$key]', '$location_id[$key]', '$website_street[$key]', '$website_district[$key]', '$start_date[$key]', '$nofollow[$key]', '$price_slot[$key]', '$non_detectable[$key]'  )  "; 
$result = mysqli_query($mysqli, $query);
	}
	} 
	else
	{
	$id = $_POST['id'];
	$customer_id = $_POST['customer_id']; 
	$category = $_POST['category']; 
	$url = $_POST['url']; 
	$name = $_POST['name']; 
	$description = $_POST['description'];
	$location_id = $_POST['location_id']; 
	$website_street = $_POST['website_street'];
$website_district = $_POST['website_district'];  
	$start_date = $_POST['start_date']; 
	$nofollow = $_POST['nofollow']; 
	$price_slot = $_POST['price_slot']; 
	if($customer_id !=""){
	$query = "INSERT INTO `links` (`id`, `customer_id`, `category`, `url`,`name`,`description`,`start_date`,`nofollow`,`location_id`,`website_street`,`website_district`) VALUES ('$id', '$customer_id' , '$category' ,'$url' , '$name' , '$description' , '$start_date' ,  '$nofollow', '$location_id' ,  '$website_street',  '$website_district'  )  "; 
	$result = mysqli_query($mysqli, $query);
	}
	}
$sql = "SELECT  * FROM links ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 16 Account' query");
while($row = mysqli_fetch_array($result)){
$new_last_url = $row['url'];
}
echo  $new_last_url;
}

