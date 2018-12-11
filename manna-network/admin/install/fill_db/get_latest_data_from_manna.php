<!DOCTYPE html>
<html>
<head>
<title>Welcome to the Manna Network SQL Download Page!</title>
<style>
    body {
        width: 90em;
        margin: 0 auto;
        font-family: Tahoma, Verdana, Arial, sans-serif;
    }
</style>
</head>
<body>
<?php

//check scan of manna_daily
$dir = dirname( __FILE__, 6 ) . "/manna-network/admin/install/fill_db/manna_daily";
$lastMod = 0;
$lastModFile = '';
foreach (scandir($dir) as $entry) {

if($entry !=="index.php" && $entry !=="." && $entry !==".."){

$filemodtime = filemtime($dir.$entry);

//is_file($dir.$entry) &&

    if ( $filemodtime > $lastMod) {

        $lastMod = $filemodtime;
        $lastModFile = $entry;
    }
  }
}

echo '<br>The default data file in your newly installed version (the files are located in manna-network/admin/install/fill_db/manna_daily) is named (and was created on) ', $lastModFile ;
echo '<br>If the script below reports a newer version is available at Manna-Network.cash then please follow the instructions to download, move, extract and replace the current data'; 
//$postData = array("link_hash_key" => $link_hash_key, "callback" => "sync", "linkString" => $_POST['linkString']);
$postData = "";
$mannanetwork_download_url = "http://manna-network.cash/manna_daily/index.php";
$handle = curl_init();
curl_setopt_array($handle,
  array(
     CURLOPT_URL => $mannanetwork_download_url,
     // Enable the post response.
    CURLOPT_POST       => true,
    // The data to transfer with the response.
    CURLOPT_POSTFIELDS => $postData,
    CURLOPT_RETURNTRANSFER     => true,
  )
);
$data = curl_exec($handle);
//echo 'data  = ', $data;
 curl_close($handle);
//if the value in remote links table matches agent conn credentials then send links list to delete from remote
$pieces = explode("---", $data);

$name = $pieces[0];
$timedate = $pieces[1];
$minipieces = explode("|",$timedate);
$time = $minipieces[0];
//echo '<br> time = ', $time;
$day = $minipieces[1];
$newday = str_replace(".sql", "", $day);
echo '<h1>These sql files you are about to download were last updated on ', $newday;
$newtime = str_replace("_", ":", $minipieces[0]);
echo ' at '. $newtime .'</h1><h1>The file name is <span style="color:red;">', $data;
$download_link = '</span><br><br> Now click the link and download that file named: <a href="http://manna-network.cash/manna_daily/';
$download_link .= $data;
$download_link .= '">'. $data .'</a> to your hard drive.</h1>';
echo $download_link ;
echo '<h1 style ="color:darkgreen;">After you download it to your hard drive, upload it to YOUR website\'s <br><span style="color:black;">manna-network/admin/install/fill_db/manna_daily </span>folder.<br>&nbsp;<br>UNZIP the zipped file and delete the original zip.</h1>

<h1>Be sure to move the new folder into the right "group". In Apache and Nginx systems, for example, the folders and files in the public-html or www folder belong to the www-data group. But your uploaded and unzipped folder may not. Check by migrating to the location you uploaded and check the permissions. Change the group recursively for all files and subfolders if it needs to be changed.</h1>
<h1 style="color:red;">Now close this browser window and return to the admin/install/index.php page and proceed to the next step.</h1>';
?>
</body></html>
