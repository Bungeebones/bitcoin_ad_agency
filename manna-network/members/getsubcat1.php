<!--
<!DOCTYPE html>
<html>
<head>

</head>
<body>
-->
<?php
require_once('translations/en.php');
$q = $_GET['q'];
if(!defined('READER_AGENTS')){ 
include(dirname(__DIR__, 2)."/manna-configs/db_cfg/auth_constants.php");
}
include(dirname(__DIR__, 2)."/manna-configs/db_cfg/".READER_AGENTS);
include(dirname(__DIR__, 2)."/manna-configs/db_cfg/mysqli_connect.php");
if (!$mysqli) {
    die('Could not connect: ' . mysqli_error($mysqli));
}
//$parsed_q = explode(":",$q);
$sql="SELECT * FROM categories WHERE parent = '".$q."'";
$result = mysqli_query($mysqli,$sql);

//echo str_replace(array("\n", "\t", "\r"), '', '<form>
$menu_str = '<select name="subCat1" onchange="showSubCat2(this.value),  getSummaryReport(this.value)">
<option value="">'.WORDING_AJAX_MENU1.'</option> ';

echo $menu_str;


while($row = mysqli_fetch_array($result)) {
   if($row['lft']+1 < $row['rgt']){
	 echo "<option value='y:" . $row['id'] .":".$row['name'] ."'>".$row['name']."</option>";
	}
	else
	{
	 echo "<option value='n:" . $row['id']  .":".$row['name'] . "'>".$row['name']."</option>";
	}
}
//echo str_replace(array("\n", "\t", "\r"), '', '</select></form>');
echo str_replace(array("\n", "\t", "\r"), '', '</select>');
mysqli_close($mysqli);
?>
<!--</body>
</html> -->
