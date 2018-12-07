<?php 
 //searched for old user db use - none found
   // / First we define the class

class member_info 
{
function getRegionalName($regionalnum){
/*  categories_regional2
id     | int(21)     | NO   | PRI | NULL    |       |
| name   | varchar(36) | YES  |     | NULL    |       |
| parent | int(21)     | YES  | MUL | 1       |       |
| lft    | int(10)     | NO   | MUL | 0       |       |
| rgt    | int(10)     | NO   | MUL | 0       |   
*/
if(!defined('READER_AGENTS')){ 
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/mysqli_connect.php");

$sql = "SELECT `name` 
FROM `categories_regional2`
WHERE `id` = '$regionalnum' ";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 11b Account' query");
if ($result->num_rows > 0) {
 while($row = mysqli_fetch_assoc($result)){
$name = $row['name'];
}
return $name;
}
else
{
return false;
}
}
function getUsersBalance($user_id){
/*| id          | int(11)                          | NO   | PRI | NULL              | auto_increment |
| user_id     | int(11)                          | NO   |     | NULL              |                |
| t_timestamp | timestamp                        | NO   |     | CURRENT_TIMESTAMP |                |
| amount_DMC  | decimal(20,10) unsigned zerofill | NO   |     | NULL              |                |
| amount_BCH  | decimal(20,10) unsigned zerofill | NO   |     | NULL              |                |
| txid        | varchar(65)                      | NO   |     | NULL    */
if(!defined('READER_CUSTOMERS')){ 
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/".READER_CUSTOMERS);
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/mysqli_connect.php");
//`leves` ($continent`, $country`, $state`, $district1`, $city`, $district2`
$query = "Select `id`, `amount_DMC`, `amount_BCH`   from `balance` where `user_id`='$user_id'"; 
$result = mysqli_query($mysqli, $query); 
$row = "";
$democoin_balance = "";
$bitcoin_cash_balance = "";
$id = "";
 while ($row = mysqli_fetch_array($result)) 
 {
$democoin_balance = $row['amount_DMC'];
$bitcoin_cash_balance = $row['amount_BCH'];
$id = $row['id'];
 }
$balance = array($id, $user_id, $democoin_balance, $bitcoin_cash_balance );
  return $balance;
 }


function getRegionalCompetitors($level, $loc_id, $cat_id, $link_id, $agent_ID){
//$regionalDisplayBlocksNum tells us total levels from which we can determine "lowest" level
if(!defined('READER_CUSTOMERS')){ 
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/".READER_CUSTOMERS);
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/mysqli_connect.php");
//`leves` ($continent`, $country`, $state`, $district1`, $city`, $district2`

$sql = "SELECT *
FROM `regional_sign_ups`
WHERE `cat_id`=$cat_id AND `$level` = '$loc_id' AND `link_id`='$link_id' AND `agent_ID`='$agent_ID'";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 11b Account' query");
$num_results = $result->num_rows;
return $num_results;
}


function getThisLinksRegionalInfo($link_id, $agent_ID){
if(!defined('READER_CUSTOMERS')){ 
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/".READER_CUSTOMERS);
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/mysqli_connect.php");
//`regional_sign_ups` (`id`, `continent`, `country`, `state`, `district1`, `city`, `district2`, `link_id`)
//| id | continent | country | state | district1 | city | district2 | street | link_id | cat_id |
$sql = "SELECT *
FROM `regional_sign_ups`
WHERE `link_id` = '$link_id' AND `agent_ID`= '$agent_ID' ";
$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 11b Account' query");
if ($result->num_rows > 0) {
 while($row = mysqli_fetch_assoc($result)){
$id = $row['id'];
$continent = $row['continent']; 
 $country  = $row['country'];  
$state = $row['state']; 
 $district1 = $row['district1'];  
$city = $row['city']; 
 $district2 = $row['district2']; 
$link_id = $row['link_id'];
$agent_ID = $row['agent_ID'];
}
$send_array = array($id,$continent,$country,$state,$district1,$city,$district2,$agent_ID );
//$send_array = array("id"=>$id,"continent"=>$continent,"country"=>$country,"state"=>$state,"district1"=>$district1,"city"=>$city,"district2"=>$district2,"link_id"=>$link_id,"agent_ID"=>$agent_ID );
return $send_array;
}
else
{
return false;
}
}



function getRegionalInfo($link_id, $agent_ID){
if(!defined('READER_CUSTOMERS')){ 
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/".READER_CUSTOMERS);
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/mysqli_connect.php");
//`regional_sign_ups` (`id`, `continent`, `country`, `state`, `district1`, `city`, `district2`, `link_id`)
//| id | continent | country | state | district1 | city | district2 | street | link_id | cat_id |
$sql = "SELECT *
FROM `regional_sign_ups`
WHERE `link_id` = '$link_id' AND `agent_ID` = '$agent_ID'";

$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 11b Account' query");
if ($result->num_rows > 0) {
 while($row = mysqli_fetch_assoc($result)){
$id = $row['id'];
$continent = $row['continent']; 
 $country  = $row['country'];  
$state = $row['state']; 
 $district1 = $row['district1'];  
$city = $row['city']; 
 $district2 = $row['district2']; 
$agent_ID = $row['agent_ID'];
}
$send_array = array($id,$continent,$country,$state,$district1,$city,$district2,$agent_ID );
return $send_array;
}
else
{
return false;
}
}

function copyToTempPriceslotsSubscripts($user_id, $agents_ID, $link_id, $price, $cat_id, $coin_type){
date_default_timezone_set('America/New_York');
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/agent_cfg.php");
if(!defined('WRITER_CUSTOMERS')){ 
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/".WRITER_CUSTOMERS);
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/mysqli_connect.php");
$subscribe = 0;//will will update this when the links table is updated from central
$start_date = time();
$query = "INSERT INTO `temp_price_slots_subscripts` (`user_id`,`link_id`,`price_slot_amnt`,`subscribe`,`coin_type`,`cat_id`, `start_date`, `agents_ID`) VALUES (    '$user_id' ,  '$link_id','$price','$subscribe','$coin_type','$cat_id', '$start_date', '$agents_ID') "; 
$result = mysqli_query($mysqli, $query);
}
 
 function sendBuyToCentral ($user_id, $agents_ID, $link_id, $price, $cat_id, $coin_type){
//now send user registration to central 
$file="http://manna-network.cash/incoming/buy.php";
$args = array(
'user_id' => $user_id,
'agents_ID' => $agents_ID,
'cat_id' => $cat_id,
'link_id' => $link_id,
'price' => $price,
'coin_type' => $coin_type);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $file);
//curl_setopt($ch, CURLOPT_POSTFIELDS, array('locus_array' => $locus_array,'link_record_num' => $link_record_num,'link_page_total' => $link_page_total, 'link_page_id' => $link_page_id, 'pagem_url_cat' => $pagem_url_cat,'link_page_num' => $link_page_num, 'cat_page_num' => $cat_page_num, 'url_cat' => $url_cat, 'affiliate_num' => $affiliate_num  ));
curl_setopt($ch, CURLOPT_POSTFIELDS,$args);

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);
echo($data);

}

function getPriceSlotPopulation($cat_id, $coin_type, $price_slot_amount){
if(!defined('READER_CUSTOMERS')){ 
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/".READER_CUSTOMERS);
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/mysqli_connect.php");
$sql = "SELECT *
FROM `price_slots_subscripts`
WHERE `cat_id` = '$cat_id'
AND `coin_type` = '$coin_type'
AND `price_slot_amnt` = $price_slot_amount";
  if ($result = mysqli_query($mysqli,$sql)) {
    /* determine number of rows result set */
    $row_cnt = mysqli_num_rows($result);
	if($row_cnt == 1){
	unset($link_id);
	 while($row = mysqli_fetch_assoc($result)){
	$link_id = $row['link_id'];
$agent_ID = $row['agent_ID'];
	}
$send_array = array($link_id, $agent_ID);
	return $send_array;
	}elseif($row_cnt > 1){
	$link_id = array();
	 while($row = mysqli_fetch_assoc($result)){
	$link_id[] = $row['link_id'];
$agent_ID[] = $row['agent_ID'];
	}
    $send_array = array($link_id, $agent_ID);
	return $send_array;
  }
 else
  {
   return false;
  }
 }
}

    function get_price_slots() {
//this func establishes ALL price slots up to the 50th(N) - which is 4.250810001427
//PRICE SLOT VALUES ARE PRACTICALLY SPEAKING PERMANENT! They serve as names of the positions
// Note - 10 decimal places (two more than 8 decimals of BCH for extra precision)
// Note that is the per-diem so the current price list works up to 6.376215002141 X $422.60 = $2500 +- ad expense per day. 
// As the BCH price climbs it can handle higher daily bids but currently can handle prices down to .00000001 BCH (one Satoshi) even though the network can't go that low. 

//the current test data starts with a low bid of 0.000074819226 BCH ($0.031573713/day [approx $1 mo.] at $422 BCH price) to a high bid of 0.0012783566 $0.5394/day [approx $16 mo.]
	for($i=0;$i<=49;$i++){
	$base = 0.00000001;
		if($i==0){
		$step[$i]= number_format($base * 1.5, 12);
		}
		else
		{
		$step[$i]= number_format($step[$i-1] * 1.5, 12);
		}
	}
	return $step;
    }



function getRegionalPopulation($link_id,$agent_ID){
if(!defined('READER_CUSTOMERS')){ 
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/".READER_CUSTOMERS);
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/mysqli_connect.php");

$sql = "SELECT *
FROM `regional_sign_ups`
WHERE `link_id` = '$link_id' AND `agent_ID`= '$agent_ID'"; 

$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 11b Account' query");
if ($result->num_rows > 0) {
 while($row = mysqli_fetch_row($result)){
$id = $row['id'];
return $id;
}
}
else
{
return false;
}
}

function getRegionalLftRgt($regionalnum){

if(!defined('READER_AGENTS')){ 
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/mysqli_connect.php");

$sql = "SELECT * 
FROM `categories_regional2`
WHERE `id` = '$id' ";

$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 11b Account' query");
if ($result->num_rows > 0) {
 while($row = mysqli_fetch_row($result)){
$lft = $row['lft'];
$rgt = $row['rgt'];
}
$sql2 = "SELECT * 
FROM `categories_regional2`
WHERE `lft` < $lft AND `rgt` > $rgt ";

$result = mysqli_query($mysqli, $sql2) or die("Couldn't execute 'Edit 11b Account' query");
if ($result->num_rows > 0) {
 while($row = mysqli_fetch_row($result)){
$lft = $row['lft'];
$rgt = $row['rgt'];
}
}
else
{
while($row = mysqli_fetch_row($result)){
$lft[] = $row['lft'];
$rgt[] = $row['rgt'];
}
$send_array= array($lft, $rgt);
return $send_array;
}
}
else
{
return false;
}





}

function getMinMaxPriceSlot($cat_id, $coin_type, $maxmin){

if(!defined('READER_CUSTOMERS')){ 
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/".READER_CUSTOMERS);
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/mysqli_connect.php");

if($maxmin=="MIN"){
$direction = "DESC";
$scope = "MIN";
}
else
{
$direction = "ASC";
$scope = "MAX";
}

$sql = "SELECT `id`, `user_id` , `link_id` , `price_slot_amnt`, `t_timestamp`,`coin_type`
FROM `price_slots_subscripts`
WHERE `cat_id` = '$cat_id'
AND `coin_type` = '$coin_type'
AND `price_slot_amnt` = (
SELECT $scope( `price_slot_amnt` ) AS `price_slot_amnt`
FROM `price_slots_subscripts`
WHERE `cat_id` = '$cat_id'  AND `coin_type` = '$coin_type' LIMIT 1 ) ORDER BY `id` $direction LIMIT 1";
$row = "";
$id = "";
$user_id = "";
$price_slot_amnt = "";
$link_id = "";
if(
$result = mysqli_query($mysqli, $sql)){
 while($row = mysqli_fetch_array($result)){
$id	= $row['id'];
$user_id	= $row['user_id'];
$price_slot_amnt 	= $row['price_slot_amnt'];
$link_id	= $row['link_id'];
};
$bid_info = array($id, $price_slot_amnt, $user_id, $link_id);
return $bid_info;
}
else
{
return false;
}
}

function getLinkPayStatus($link_id){

if(!defined('READER_CUSTOMERS')){ 
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/".READER_CUSTOMERS);
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/mysqli_connect.php");

$sql = "SELECT `id` 
FROM `price_slots_subscripts`
WHERE `link_id` = '$link_id' AND `user_id`='1' ";

$result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit 11b Account' query");
if ($result->num_rows > 0) {
 while($row = mysqli_fetch_assoc($result)){
$id = $row['id'];

}
return $id;
}
else
{
return false;
}

}


function getLinkByUserIdFree($user_id){

if(!defined('READER_CUSTOMERS')){ 
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/".READER_CUSTOMERS);
include(dirname( __FILE__, 4 ). "/manna-network/db_cfg/mysqli_connect.php");

if($user_id >0){
$query = "SELECT * FROM customer_links WHERE customer_id='$user_id'  ORDER BY `user_registration_datetime` ASC";
$result = @mysqli_query($mysqli, $query) or die("Couldn't execute 'Edit 3 Account' query");
$num_rows = mysqli_num_rows($result);
if($num_rows > 0){
while ($row = mysqli_fetch_array($result)){
$db_idf[] = $row['id'];
$db_agents_ID = $row['agents_ID'];
$db_categoryf[] = $row['category_id'];
$db_urlf[] = $row['website_url'];
$db_descriptionf[] = $row['website_description'];
$db_namef[] = $row['website_title'];
$db_start_datef[] = $row['user_registration_datetime'];
//$db_approvedf[] = $row['approved']; 
}

$num_links_this_user = count($db_idf);
}
$send_array = array($num_links_this_user, $db_idf, $db_agents_ID, $db_categoryf, $db_urlf, $db_descriptionf, $db_namef, $db_start_datef);
}
return $send_array;
}

}
?>
