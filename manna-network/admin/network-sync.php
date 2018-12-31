<?php
function dirname_safe($path, $level = 0){
    $dir = explode(DIRECTORY_SEPARATOR, $path);
    $level = $level * -1;
    if($level == 0) $level = count($dir);
    array_splice($dir, $level);
    return implode($dir, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
}

$site_path = $_SERVER['DOCUMENT_ROOT'] ;
  if($_SERVER['SERVER_PORT']=="443"){
   $site_url="https://".$_SERVER['SERVER_NAME'] ;
  }
  else
  {
   $site_url="http://".$_SERVER['SERVER_NAME'] ;
  }

if( !defined( __DIR__ ) ) define( __DIR__, dirname(__FILE__) );

if(!defined("READER_AGENTS")){
require_once( dirname_safe(__DIR__, 2).'manna-configs/db_cfg/auth_constants.php');
}

require_once( dirname_safe(__DIR__, 2).'manna-configs/db_cfg/'.READER_AGENTS);
require_once( dirname_safe(__DIR__, 2).'manna-configs/db_cfg/agent_config.php');
	$mysqli = new mysqli($servername, $username, $password, $dbname);
   
        // Check connection
          if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
           } 
      
//now we need to select the last row of every table that we sync with the network with
//we'll start with just the links table
$agent_table_names = array('links', 'categories', 'categories_regional2', 'promo_codes');
//$agent_array_labels = array('links', 'categories', 'categories_regional2', 'promo_codes');
$agent_column_names = array('url', 'lft', 'lft', 'id');
$customer_table_names = array('balance', 'balance', 'price_slots_subscripts', 'regional_sign_ups', 'price_slots_daily_ledger');
//$customer_array_labels = array('balance_DMC', 'balance_BCH', 'price_slots_subscripts', 'regional_sign_ups', 'price_slots_daily_ledger');
$customer_column_names = array('amount_DMC', 'amount_BCH', 'price_slot_amnt', 'id', 'id');
$send_array_agents = array();
foreach($agent_table_names as $key => $value){
$query = "SELECT $agent_column_names[$key] FROM `$value` ORDER BY id DESC LIMIT 1"; 
	$result = mysqli_query($mysqli, $query);
  	while($row = mysqli_fetch_array($result)){
		$got  = $row[$agent_column_names[$key]]; 
			}
      if(mysqli_num_rows($result)>0){
	$send_array_agents[$key] = $got;
	}
	else
	{
	$send_array_customers[$key] = '0';
	}

$str_json_send_array_agents = json_encode($send_array_agents);
   }

if(!defined("READER_CUSTOMERS")){
require_once( dirname_safe(__DIR__, 2).'manna-configs/db_cfg/auth_constants.php');
}

require_once( dirname_safe(__DIR__, 2).'manna-configs/db_cfg/'.READER_CUSTOMERS);
$mysqli = new mysqli($servername, $username, $password, $dbname);
   $send_array_customers = array();
foreach($customer_table_names as $key => $value){
$query = "SELECT $customer_column_names[$key] FROM `$value` ORDER BY id DESC LIMIT 1"; 
	$result = mysqli_query($mysqli, $query);
  	while($row = mysqli_fetch_array($result)){
$customer_column_name = $customer_column_names[$key];
		$got  = $row[$customer_column_name]; 
			}
if(mysqli_num_rows($result)>0){
$customer_array_label = $customer_array_labels[$key];
$send_array_customers[$key] = $got;
}
else
{
$send_array_customers[$key] = '0';


}

$str_json_send_array_customers = json_encode($send_array_customers);
      }
$possibleHostSources = $_SERVER['HTTP_HOST']."|". $_SERVER['SERVER_NAME'];
  
//we got these values for the agent_conn_credential table
//| id | agent_url |foldername | agent_ID | last_links_url | last_categories_lft | last_categories_regional2_lft | last_BTC_balance | last_DMC_balance |last_price_slots_subscripts | last_regional_sign_ups_id | last_promo_title | last_price_slots_day_ledger  

//and they  are stored in two arrays  1) $send_array_agents and 2) $send_array_customers
$agents_array_labels_string = implode(",",$agent_array_labels);
$customers_array_labels_string = implode(",",$customer_array_labels);
$agents_array_values_string = implode(",",$send_array_agents);
$customers_array_values_string = implode(",",$send_array_customers);

$agent_url_builder = "http://manna-network.cash/incoming/agent_conn_credentials.php"; 
$postData = array("str_json_send_array_agents" => $str_json_send_array_agents, "str_json_send_array_customers" => $str_json_send_array_customers,  "agent_ID"=>AGENT_ID, "foldername" => AGENT_FOLDERNAME, "agent_url" => AGENT_URL, "host_name" => $possibleHostSources, "remote_key" => $exchange_pw );
$handle = curl_init();
curl_setopt_array($handle,
  array(
     CURLOPT_URL => $agent_url_builder,
     // Enable the post response.
    CURLOPT_POST       => true,
    // The data to transfer with the response.
    CURLOPT_POSTFIELDS => $postData,
    CURLOPT_RETURNTRANSFER     => true,
  )
);
 
$data = curl_exec($handle);
 curl_close($handle);
echo $data;
?>
