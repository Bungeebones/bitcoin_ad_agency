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


if( !defined( __DIR__ ) ) define( __DIR__, dirname(__FILE__) );

if(!defined("WRITER_AGENTS")){
require_once( dirname_safe(__DIR__, 4).'manna-configs/db_cfg/auth_constants.php');
}

require_once( dirname_safe(__DIR__, 4).'manna-configs/db_cfg/'.WRITER_AGENTS);
require_once( dirname_safe(__DIR__, 4).'manna-configs/db_cfg/agent_config.php');
	$mysqli = new mysqli($servername, $username, $password, $dbname);

$dir = dirname(__FILE__).DIRECTORY_SEPARATOR."manna_daily/";

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

$files = scandir('manna_daily');
foreach ($files as &$value) {

	if($value != "index.php" && $value != ".."&& $value != "."){
	$folder_name = $value;
	$files2 = scandir('manna_daily/'.$folder_name);

	   foreach ($files2 as $value2) {
		if($value2 != "index.php" && $value2 != ".." && $value2 != "."){

		echo '<h1>opening file ', $_SERVER['DOCUMENT_ROOT'].'/'.AGENT_FOLDERNAME.'/admin/install/fill_db/manna_daily/'.$folder_name.'/'.$value2;
		echo '</h1>';

			$iniinserted = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/'.AGENT_FOLDERNAME.'/admin/install/fill_db/manna_daily/'.$folder_name.'/'.$value2);

		$tobinserted = explode(";", $iniinserted);
			foreach($tobinserted as$key=>$value3){
			echo '<br>Inserting ', $value3;
				if ($mysqli->query($value3) === TRUE) {
				   echo "<h3>$value2 data inserted successfully</h3><br>Still loading ... ";
				} else {
				  if($mysqli->error !="Query was empty"){
				    echo "<h3>Error inserting $value2 data: " . $mysqli->error ."</h3>";
				    }
				}
			}
		}
	    }
echo '<br>Your web directory should be fully populated with links and categories,functioning and viewable at bitcoin_ad_agency/agent-dir/index.php.<br>ATTENTION! Visit the "Add URL" page (from the link in the upper nav bar of the directory) for the last configuration.'; 
	}

}
	
?>
