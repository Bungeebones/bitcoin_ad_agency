<?php
include(dirname( __FILE__, 3 ). "/manna-network-agent_cfg.php");
include(dirname( __FILE__, 3 ). "/".AGENT_FOLDERNAME."/db_cfg/auth_constants.php");
include(dirname( __FILE__, 3 ). "/".AGENT_FOLDERNAME."/db_cfg/".READER_AGENTS);
include(dirname( __FILE__, 3 ). "/".AGENT_FOLDERNAME."/db_cfg/mysqli_connect.php");
//require('config.php');//these settings are no longer editable and are embedded in the code
$url = $_SERVER['SERVER_NAME'];
echo '<br> url of agent = ', $url;
echo '<br> dirname( __FILE__, 3 ) = ', dirname( __FILE__, 3 );
echo '<br>AGENT_FOLDERNAME = ', AGENT_FOLDERNAME;
require('../functions/functions.php');


echo ' 
<h3 style="color:red;">Congratulations on getting your new blog!</h3>';
print_r($_POST);

$url = $_POST['http_host'];
echo '<br>the url = in the wp_errors page is ', $url;
		$sql="select * from `links` where `url` like '%$url%'";
			  $result = mysqli_query($mysqli, $sql) or die("Couldn't execute 'Edit members index 558");
		$num_results_in_temp = mysqli_num_rows($result);
				if( $num_results_in_temp >0) 
			{
				//lets get the data, especially the download_type and then just redirect to the appropraite download page
				while ($row = mysqli_fetch_array($result)){
				$new_user_affiliate_num = $row['id'];
                                 // $progress = $row['progress'];
				}

echo '<h3 style="color:red;">This web directory page will enable you to earn Bitcoin Cash but to get it to display properly you need to login to <a target="_blank"  href="http://'.$url.'/wp-admin"><u>your WP DASHBOARD </u></a>and configure the Affiliate Number settings for this web directory to operate properly AND for you to get credited properly! (Note: You should have received another email with your login credentials if you misplaced the password that Wordpress displayed for you).</h3>
<h2> YOUR Manna Network AFFILIATE NUMBER IS ... ';
echo $new_user_affiliate_num;
echo'</h2>
<h4> To configure it, click the "MannaNetwork" button in the left menu of your Dashboard and add it to the form as the screenshot indicates.</h4>
<img width="90%"src="screenshot.png">
<h3>For more information, login with your blog user credentials at the server site <a target=_blank" href="http://BungeeBones.com/members/index.php">BungeeBones.com</a> <br>NOTE: If you ever have to retrieve your password from the Bungeebones site use the same email you used to create your blog.</h3>';
}
else
{
echo '<h3 style="color:red;">We have not detected that you have registered this site as an advertiser yet in the manna network. Please register your web site to receive free advertising across the whole network. Then you will receive an affiliate number/link id number that you use to configure this plugin.
</h3>';
echo '
<iframe src="https://'.$_SERVER['SERVER_NAME']."/".AGENT_FOLDERNAME.'/members/register.php?referer_lnk_num='.$_GET['lnk_num'].'&remote_server='.$server_url.'" width="100%" height="950"]
		</iframe>';

}


?>
