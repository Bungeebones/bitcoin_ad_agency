<?php
echo 'Now that we have the agent user downloaded the weekly zip and unpacking it here, now we need to:
<br>1)include the admins database credential file so we can insert into the tables
<br>2) In the foreach section below, we need to get the name of the file and match it to the right table and insert<br>
';
function dirname_safe($path, $level = 0){
    $dir = explode(DIRECTORY_SEPARATOR, $path);
    $level = $level * -1;
    if($level == 0) $level = count($dir);
    array_splice($dir, $level);
    return implode($dir, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
}
echo 'dirname_safe = ';
print_r(dirname_safe(__DIR__, 4));

$site_path = $_SERVER['DOCUMENT_ROOT'] ;
  if($_SERVER['SERVER_PORT']=="443"){
   $site_url="https://".$_SERVER['SERVER_NAME'] ;
  }
  else
  {
   $site_url="http://".$_SERVER['SERVER_NAME'] ;
  }

if( !defined( __DIR__ ) ) define( __DIR__, dirname(__FILE__) );

if(!defined("WRITER_AGENTS")){
require_once( dirname_safe(__DIR__, 4).'manna-configs/db_cfg/auth_constants.php');
}

require_once( dirname_safe(__DIR__, 4).'manna-configs/db_cfg/'.WRITER_AGENTS);
require_once( dirname_safe(__DIR__, 4).'manna-configs/db_cfg/agent_config.php');
	$mysqli = new mysqli($servername, $username, $password, $dbname);
/*	$folder_name = "agents_sql_files";
          $files = scandir($folder_name);
	foreach ($files as &$value) {
		if($value != "." && $value != ".."){
		//build the sql insert query
		$tobinserted = file_get_contents(__DIR__) .$folder_name.'/'.$value;
echo '<br>install_folder = ', $_SERVER ['REQUEST_URI'];
$request_uri = $_SERVER ['REQUEST_URI'];
$pieces = explode("/",$request_uri);			
$tobinserted = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/'.$pieces[1].'/admin/install/fill_db/manna_daily/'.$folder_name.'/'.$value);
if ($mysqli->query($tobinserted) === TRUE) {
			   echo "<h3>$value data inserted successfully</h3>";
			} else {
			    echo "<h3>Error inserting $value data: " . $mysqli->error ."</h3>";
			}
		}
	    }
*/
$dir = dirname(__FILE__).DIRECTORY_SEPARATOR."manna_daily/";
echo '$dir = ', $dir;

  $yourStartingPath = "manna_daily";
function listFolderFiles($dir)
{
    $fileInfo     = scandir($dir);
    $allFileLists = [];

foreach ($fileInfo as $folder) {
    if ($folder !== '.' && $folder !== '..') {
        if (is_dir($dir . DIRECTORY_SEPARATOR . $folder)     === true) {
            $allFileLists[$folder . '/'] = listFolderFiles($dir .     DIRECTORY_SEPARATOR . $folder);
echo 'Folder = '. $folder. '  <br>';
            } else {
                echo' ';
            }
        }
    }

    return $allFileLists;
}//end listFolderFiles()

//listFolderFiles('manna_daily');
//$dir = listFolderFiles('manna_daily');
//echo '<pre>$dir = ';
//print_r($dir);
//echo '</pre>';

//echo '<br>listFolderFiles = ', listFolderFiles('manna_daily');

$files = scandir('manna_daily');
foreach ($files as &$value) {

if($value != "index.php" && $value != ".."&& $value != "."){
$folder_name = $value;
$files2 = scandir('manna_daily/'.$folder_name);

	foreach ($files2 as $value2) {
if($value2 != "index.php" && $value2 != ".." && $value2 != "."){

echo '<h1>opening file ', $_SERVER['DOCUMENT_ROOT'].'/'.$agent_folder.'/admin/install/fill_db/manna_daily/'.$folder_name.'/'.$value2;
echo '</h1>';

	$iniinserted = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/'.$agent_folder.'/admin/install/fill_db/manna_daily/'.$folder_name.'/'.$value2);

$tobinserted = explode(";", $iniinserted);
foreach($tobinserted as$key=>$value3){
echo '<br>Inserting ', $value3;
	if ($mysqli->query($value3) === TRUE) {
				   echo "<h3>$value2 data inserted successfully</h3>";
				} else {
                                        if($mysqli->error !="Query was empty"){
				    echo "<h3>Error inserting $value2 data: " . $mysqli->error ."</h3>";
                                    }
				}
}
}
	}
}

}
	
?>
