<?php
$regional_num = "";
$link_record_num = "";
$link_page_total = ""; 
$link_page_id = ""; 
$pagem_url_cat = "";
$link_page_num = ""; 
$cat_page_num = ""; 
$category_id = ""; 
$lnk_num = "";

include(dirname( __FILE__, 2 ). "/manna-configs/db_cfg/agent_config.php");
include(dirname( __FILE__, 2 ). "/mannanetwork-dir/functions/functions.php");
require_once('translations/en.php');
$regional_num=  $_GET['regional_num'];
$regionList = getRegions($regional_num);
$menu_str = '<form action="'. htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8").'">
<select name="subLoc'.$_GET['subloc'].'" onchange="updateregionalButton(this.value), showSubLoc';
if($_GET['subloc'] == 4){
$menu_str .= '4';
}
else
{
$menu_str .= $_GET['subloc']+1;
}
$menu_str .= '(this.value)"><option value="">'.WORDING_AJAX_REGIONAL_MENU1.'</option> ';
foreach($regionList as $key=>$value){
 if($regionList[$key]['lft']+1 < $regionList[$key]['rgt']){
	$menu_str .= "<option value='y:" . $regionList[$key]['id'] .":".$regionList[$key]['name'] ."'>".$regionList[$key]['name']."</option>";
	}
	else
	{
	$menu_str .= "<option value='n:" . $regionList[$key]['id']  .":".$regionList[$key]['name'] . "'>".$regionList[$key]['name']."</option>";
	}
}

$menu_str .= '</select><br>

</form>';
echo $menu_str;

?>
