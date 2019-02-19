<?php date_default_timezone_set('America/New_York'); 
//include(dirname( __FILE__, 2 ). "/manna-configs/db_cfg/agent_config.php");
include(dirname( __FILE__, 2 ). "/manna-configs/db_cfg/auth_constants.php");
include(dirname( __FILE__, 2 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 2 ). "/manna-configs/db_cfg/mysqli_connect.php");
require(dirname( __FILE__, 1 ). "/functions/functions.php");
 
if (array_key_exists("affiliate_num",$_POST))
  {
$affiliate_num = $_POST['affiliate_num'];
  }
else
  {
  $affiliate_num = "";
  }
if (array_key_exists("agent_num",$_POST))
  {
$agent_num  = $_POST['agent_num'];
  }
else
  {
  $agent_num  = "";
  }
if (array_key_exists("category_id",$_POST))
  {
$category_id  = $_POST['category_id'];
  }

if (array_key_exists("cat_page_num",$_POST))
  {
$cat_page_num  = $_POST['cat_page_num'];
  }
else
  {
  $cat_page_num  = "";
  }
if (array_key_exists("link_page_num",$_POST))
  {
$link_page_num  = $_POST['link_page_num'];
  }
else
  {
  $link_page_num  = "";
  }
if (array_key_exists("link_page_id",$_POST))
  {
$link_page_id  = $_POST['link_page_id'];
  }
else
  {
  $link_page_id  = "";
  }
if (array_key_exists("pagem_url_cat",$_POST))
  {
$pagem_url_cat  = $_POST['pagem_url_cat'];
  }
else
  {
  $pagem_url_cat  = "";
  }
if (array_key_exists("link_page_total",$_POST))
  {
$link_page_total  = $_POST['link_page_total'];
  }
else
  {
  $link_page_total  = "";
  }
if (array_key_exists("link_record_num",$_POST))
  {
$link_record_num  = $_POST['link_record_num'];
  }
else
  {
  $link_record_num  = "";
  }
if (array_key_exists("regional_number",$_POST))
  {
$regional_number  = $_POST['regional_number'];
  }
else
  {
  $regional_number  = "";
  }
//echo '<br>$category_id = ', $category_id;
if(isset($category_id) && $category_id > 0 && $category_id !=""){

$catList = getCategoryChildren($category_id);
echo json_encode($catList);
}
else
{
echo "NO MORE SUB CATEGORIES";
}
?>
