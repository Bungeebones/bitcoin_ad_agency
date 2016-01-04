<?php
/*require_once("config/config.php");
require_once("php-login.php");
$login = new Login();
if ($login->isUserLoggedIn() == true) {   
*/ 
$user_id = $_SESSION['user_id'];
$phpself = basename(__FILE__);
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;

include($_SERVER['DOCUMENT_ROOT']."/classes/link_class.php");//load order 1
include($_SERVER['DOCUMENT_ROOT']."/classes/categories_class.php");//load order 2

$moniker="<h5>Add Your Link</h5>";
$body_width="wide";

include($_SERVER['DOCUMENT_ROOT']."/members/nirv_top.php");
//include($_SERVER['DOCUMENT_ROOT']."/members/nirv_top_menu.php");
if(isset($_GET[cat_id])){

	echo "<h1>Step 1 - Completed</h1><h3>There Are No More Sub-Categories Under The ". $cat_name ." Category.</h3><div style='font-size=150%'> Use the contact form and send in your suggestions if you believe some should be added. <br>Thanks<br>The admin.</div>";

$second_section = "
<div style='padding: 5px; background-color:gray;color:white;'><p>Categories are automatically \"paginated\" to display 20 links per page. Link positions paid for with Bitcoin will be displayed first. Links \"paid for\" with \"DemoCoins\" will be displayed next. Finally, free links will be displayed last. All links outbid will be pushed lower on their page and possibly onto lower pages. You can purchase better positions from your BungeeBones User Control Panel's \"Add/Manage Funds\" link in the upper nav bar.</p>
</div>";
 $second_section .= "<div style='padding: 5px;height:10px;'>&nbsp;</div><div style='padding: 5px;background-color:lightgray;color:white;border: 2px solid; border-radius: 25px;'><p>Select A Sub-Category (optional)</h3>
To list in a sub-category (listed below) click the one you want and fill in link information there. Generally, the higher the category, the more competitive it is. 
";

 $second_section .= "<h4 style='color: red;'>Your Current Selection Places Your Link In The ". $cat_name . " Category</h4><h5>But Here Are Its Sub-categories Too!";
 $second_section .= $nav;
 $second_section .= $cat_info;
 $second_section .= '</h5><h6 style="color: red;">OR, You may even suggest your own sub-category!</h6>
Suggested category #1<input type=text" name="suggest1"></input><br>Suggested category#2 (this could become a sub-category of suggested category #1) <input type=text" name="suggest2" ></input>
<br><font style="color: black; font-size:1;">Note: By default, whatever category you are currently in will the one that your link will be inserted into <b><u>"IF" your suggestion is rejected</u></b>.</font>
<h3>Please be diligent about your category selection!</h3></div>';
//begin review peers section

$second_section .=  '<div style="padding: 5px;height:10px;">&nbsp;</div><div style="padding: 5px;background-color:lightblue;color:black;border: 2px solid; border-radius: 25px;"><h3>Detect A Broken Or Mis-Categorized Link AND Move Your Listing Up!</h3
<h3>You can also scope out your category peers too!</h3>
 NEED TO REBUILD THIS> GET ALL THE LINKS FrOM THIS CAT. AND DISPLAY WITH LINK BYEACH TO TO REPORT IF BAD
</div>
';	
$second_section .=  '<div style="padding: 5px;height:10px;">&nbsp;</div><div style="padding: 5px;background-color:#b1b1b1;color:black;border: 2px solid; border-radius: 25px;">ADD REGIONAL INFORMATION TO YOUR LISTING
<p>If you derive your business from a geographical area (such as local, city wide, state wide etc.) then one of the easiest SEO methods to implement is to put your location information with your listing.

';
if($cat_id > 1){
		include('regional_dropdown.php');
}	

$second_section .=  '</div>';



$second_section .=  '<div style="padding: 5px;height:10px;">&nbsp;</div><div style="padding: 5px;background-color:lightblue;color:black;border: 2px solid; border-radius: 25px;"><h3> Add Your Link Info</h3>';

IF(count($regional_path)>3){
$second_section .=  '<h2 style="color:red">Step 2b - Additional Regional Info (optional because you added your city location)</h2><b><p align="left">Add Your Company Street Address <br> <input type="text" name="street"  size="40">
								<p  align="left">Add Your Company Postal Code<br><input type="text" name="zip"  size="40"></b>';

}
else
{
$second_section .=  '
			
					<h3 style="color: red">Additional Company Location Info (Optional)</h3>
					<p align="left">If you select from all the available Regional Filters dropdowns above (i.e. selected a city) then more options will appear here to enable you to add your business address to be displayed in the directory.';
}

$second_section .=  '<form action=""><br>Business Phone Number (optional)<input type="text" name="phone" value="" size="30">
<br>Homepage URL<input type="text" name="requiredurl" value="http://" size="30">
<br>TITLE<input type="text" name="requiredtitle"  size="40">
<br>Descriptions limited to max 255 characters.	<textarea rows="4" name="requiredlink_description" cols="40"></textarea>

<br>No Follow Tags - If you want to add a "nofollow" tag to your link to keep search engines from indexing it then check the following radio button. Doing so will add the nofollow tag to your link listing in all the directories. For more information see <a target="_blank" href="http://support.google.com/webmasters/bin/answer.py?hl=en&answer=96569">this Google help page</a> <br>
<h3><font color="red">Check here to make your link "nofollow"  <input type="checkbox" name="nofollow"></h3>
<br><input type="submit" value="Submit Link Info" name="B1">&nbsp;&nbsp;<input type="reset" value="Cancel" name="B2"></p>
</form>	
							
   <h3><a href="/members/index.php">Return To Your User Control Panel</a></h3>





</div>';






echo $second_section;
}
else
{
?>

<h3 style='color: red;'>STEP 1 - Choose Your First Or Main Category</h3>

<table><tr align='center'><td>	<ul><li><a href="/members/addalink.php?cat_id=60">Accessories</a></li><li><a href="/members/addalink.php?cat_id=65">Art/Photo/Music</a></li><li><a href="/members/addalink.php?cat_id=69">Automotive</a></li><li><a href="/members/addalink.php?cat_id=10023">Bitcoin</a></li><li><a href="/members/addalink.php?cat_id=102">Books/Media</a></li><li><a href="/members/addalink.php?cat_id=111">Business</a></li><li><a href="/members/addalink.php?cat_id=125">Careers</a></li><li><a href="/members/addalink.php?cat_id=126">Clothes/Apparel</a></li><li><a href="/members/addalink.php?cat_id=134">Commerce</a></li><li><a href="/members/addalink.php?cat_id=9">Computers</a></li><li><a href="/members/addalink.php?cat_id=148">Education</a></li><li><a href="/members/addalink.php?cat_id=147">Electronics</a></li><li><a href="/members/addalink.php?cat_id=2198">Environment</a></li><li><a href="/members/addalink.php?cat_id=3085">FaceBook Profiles</a></li><li><a href="/members/addalink.php?cat_id=2702">Finance</a></li><li><a href="/members/addalink.php?cat_id=10000">Food/Restaurants</a></li></ul></td><td width="50%" align="left" valign="top"><ul><li><a href="/members/addalink.php?cat_id=1307">Games</a></li><li><a href="/members/addalink.php?cat_id=1330">Health</a></li><li><a href="/members/addalink.php?cat_id=1375">Home</a></li><li><a href="/members/addalink.php?cat_id=1401">Kids &amp; Teens</a></li><li><a href="/members/addalink.php?cat_id=1415">News</a></li><li><a href="/members/addalink.php?cat_id=2822">Professional</a></li><li><a href="/members/addalink.php?cat_id=3">Real Estate</a></li><li><a href="/members/addalink.php?cat_id=1275">Recreation</a></li><li><a href="/members/addalink.php?cat_id=1438">Reference</a></li><li><a href="/members/addalink.php?cat_id=8">Religion</a></li><li><a href="/members/addalink.php?cat_id=10010">Sales_Reps</a></li><li><a href="/members/addalink.php?cat_id=2799">Services</a></li><li><a href="/members/addalink.php?cat_id=2027">Shopping</a></li><li><a href="/members/addalink.php?cat_id=2068">Society</a></li><li><a href="/members/addalink.php?cat_id=2098">Sports</a></li><li><a href="/members/addalink.php?cat_id=124">Travel</a></li></ul></td></tr></table> 

<?
include($_SERVER['DOCUMENT_ROOT']."/members/nirv_bot_nsb.php");
}
/*

} else {
    // the user is not logged in...
    include("views/not_logged_in.php");
}
*/
