 <?php
function getRegions($regional_num){
if (!defined('READER_AGENTS')) {
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");
        $query = "SELECT * FROM categories_regional2 WHERE parent = '".$regional_num."' ORDER BY NAME";
	$query= mysqli_query($mysqli, $query);
if(mysqli_num_rows($query) > 0){
        while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
        $send_array[] = $row ;
        }
	return $send_array;
}
else
{
return "Sorry, No Regional Entries Found."; 

}
}


function getLinks($category_id){

$category_id = 9;
if (!defined('READER_AGENTS')) {
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");
        $query = 'SELECT * FROM `links` WHERE category='.$category_id.' ORDER BY price_slot desc; ';
	$query= mysqli_query($mysqli, $query);
if(mysqli_num_rows($query) > 0){
        while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
        $send_array[] = $row ;
        }
	return $send_array;
}
else
{
return "Sorry, No Links Found."; 

}
}

function getCategoryChildren($id){
if (!defined('READER_AGENTS')) {
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/auth_constants.php");
}
if($id == ""){
$id = 1;
}
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");
	$query = 'SELECT * FROM `categories` WHERE parent='.$id.' ORDER BY name;';
	$result= mysqli_query($mysqli, $query);
     if(mysqli_num_rows($result) > 0){  
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	$send_array[] = $row ;
	}
	return $send_array;
}
else
{
return "<h1>Sorry, No Sub-categories Found. </h1>"; 

}
}





function categoryName($id){
if (!defined('READER_AGENTS')) {
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");
$id = mysqli_real_escape_string($mysqli, $id);
	$query = 'SELECT name FROM `categories` WHERE id="'.$id.'"';

	$result = mysqli_query($mysqli, $query);

	$row = mysqli_fetch_row($result);

	return $row[0];

}

function categoryPath($catid, $regional_number){
if (!defined('READER_AGENTS')) {
include(dirname( __FILE__, 3 ). "/manna-network/db_cfg/auth_constants.php");
}
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/manna-configs/db_cfg/mysqli_connect.php");
	$path = '';
$catid=mysqli_real_escape_string($mysqli, $catid);
	$query = 'SELECT lft,rgt FROM `categories` WHERE id="'.$catid.'"';

	$result = mysqli_query($mysqli, $query);
	$row = mysqli_fetch_array($result);
	$lft = $row['lft'];
	$rgt = $row['rgt'];
	$query = 'SELECT name,id FROM `categories` WHERE lft < '.$lft.' AND rgt > '.$rgt.' ORDER BY lft ASC';
	$result = mysqli_query($mysqli, $query);
	while($row = @mysqli_fetch_array($result)){
		if($row['id'] != '1')
if($regional_number != ""){
$path .= ' | <a href="/'.$folder_name.'/'.$file_name.'/'. $affiliate_num.'/'.$row['id'].'///////'.$regional_number.'">'.$row['name'].'</a>';
}
else
{
$path .= ' | <a href="/'.$folder_name.'/'.$file_name.'/'. $affiliate_num.'/'.$row['id'].'">'.$row['name'].'</a>';
}
	}



	return $path;
}

?>

