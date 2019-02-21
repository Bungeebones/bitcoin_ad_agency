<?php

$locus_array = "";
$link_record_num = "";
$link_page_total = ""; 
$link_page_id = ""; 
$pagem_url_cat = "";
$link_page_num = ""; 
$cat_page_num = ""; 
$category_id = ""; 
$lnk_num = "";

include(dirname( __FILE__, 2 ). "/manna-configs/db_cfg/agent_config.php");
include(dirname( __FILE__, 2 )). "/mannanetwork-dir/functions/functions.php";
$category_id  =  $_GET['q'];
$comboList = getCategoryChildren($category_id);

require_once('translations/en.php');

$menu_str = '<form action="'. htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8").'"><select name="subCat'.$_GET['subcat'].'" onchange="updatecategoryButton(this.value), showSubCat';
if($_GET['subcat'] == 4){
$menu_str .= '4';
}
else
{
$menu_str .= $_GET['subcat']+1;
}

$menu_str .= '(this.value)">
<option value="">'.WORDING_AJAX_MENU1.'</option> ';
foreach($comboList as $key=>$value){
 if($comboList[$key]['lft']+1 < $comboList[$key]['rgt']){
	$menu_str .= "<option value='y:" . $comboList[$key]['id'] .":".$comboList[$key]['name'] ."'>".$comboList[$key]['name']."</option>";
	}
	else
	{
	$menu_str .= "<option value='n:" . $comboList[$key]['id']  .":".$comboList[$key]['name'] . "'>".$comboList[$key]['name']."</option>";
	}
}

$menu_str .= '</select><br>

</form>';
echo $menu_str;

?>
