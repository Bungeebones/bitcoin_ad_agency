<?php
include('bootstrap_header.php'); 
include($_SERVER['DOCUMENT_ROOT']."/manna-network/db_cfg/agent_cfg.php");
if(isset($_POST['C1'])){
include('styles.css');
//include($_SERVER['DOCUMENT_ROOT']."/manna-network/members/classes/price_slot_class.php");//load order 1
include($_SERVER['DOCUMENT_ROOT']."/manna-network/members/classes/member_page_class.php");//load order 1
$linkInfo = new member_info();

$link_id = $_POST['link_id']; 
$price = $_POST['price']; 
$cat_id = $_POST['cat_id'];  
$coin_type = $_POST['coin_type']; 

$linkInfo->sendBuyToCentral($user_id, $agent_ID, $link_id, $price, $cat_id,$coin_type);

 $today1 = date('F j, Y, g:i a');
     $message="";
		$message .=  '<h1>Thank you! 
The transaction has been sent to central along with all other bids. They will be ordered, highest to lowest And by seniority (i.e. how long they have concinuously bought their current price slot).
Developer Notes. They are stored in the temp_price_slots_subscripts table in mannanetwork database. They will need to be distributed similar to how new links will be.
The .cash site will have to order the links according to temp, then UPDATE each winning link\'s price_slot column (in links table).

When the links table is distributed, the display will be ordered by price slots.
The temp table will be sent as a text file to be saved as their record of placemnets
The transaction details are below. The advertising fee reflects the per-diem (daily) fee which also will be distributed to members/publishers daily. The purchase will initiate regular automatic billing daily from this point forward until cancelled by you or there is insufficient funds in your account.</h1>';
	 

echo '<br>', $message;
echo '<p>Your seniority date for this price slot is :', $today1;
echo '. If there are other advertisers that bought this price slot earlier, then your ad will be displayed behind theirs. Similarly, other advertisers that buy this price slot after you will have their ad displayed below yours.
';
exit();
 }//close if isset c1



if(isset($_POST['B1'])){
$link_id = $_POST['link_id']; 
$price = $_POST['price']; 
$cat_id = $_POST['cat_id'];  
$coin_type = $_POST['coin_type']; 
include('styles.css');
include($_SERVER['DOCUMENT_ROOT']."/manna-network/members/classes/member_page_class.php");//load order 1
$linkInfo = new member_info();
$steps = $linkInfo->get_price_slots();
$thisLinksRegionalInfo = $linkInfo->getThisLinksRegionalInfo($_POST['link_id'], $agent_ID);

if(is_array($thisLinksRegionalInfo)){ 

//We will need the results of this later and mayne we can put it into a function (to alleviate clutter)
//First, we find out if this link has any regional info added to db. 
//If so, we determine its most local position to establish display blocks for each regional level so as to report number of competitors in each level

		if($thisLinksRegionalInfo[6]>0){
		$thisLinksMostLocalRegional = "district2";
		$regionalDisplayBlocksNum = "6";
		}elseif($thisLinksRegionalInfo[5]>0){
		$thisLinksMostLocalRegional = "city";
		$regionalDisplayBlocksNum = "5";
		}
		elseif($thisLinksRegionalInfo[4]>0){
		$thisLinksMostLocalRegional = "district1";
		$regionalDisplayBlocksNum = "4";
		}elseif($thisLinksRegionalInfo[3]>0){
		$thisLinksMostLocalRegional = "state";
		$regionalDisplayBlocksNum = "3";
		}elseif($thisLinksRegionalInfo[2]>0){
		$thisLinksMostLocalRegional = "country";
		$regionalDisplayBlocksNum = "2";
		}elseif($thisLinksRegionalInfo[1]>0){
		$thisLinksMostLocalRegional = "continent";
		$regionalDisplayBlocksNum = "1";
		}
//make a string to insert an empty column/spaceholder unless there is a link in that price slot
$regionalDisplaySpaceholder = '';
for($i=1;$i<=$regionalDisplayBlocksNum;$i++){
$regionalDisplaySpaceholder .= '<td>&nbsp;---</td>';
}
}
else
{
echo "<h2>You might acquire better positioning by adding regional info</h2>";
}


?>
<h1>Select Your Ad Position</h1>


<p>Use the list of "Price Slots" to select the relative and tenatative * position of your ad across the network. We will find the low, and high bids and figure out how wide a spread there is. 
<p> Higher price slots will always be an order of 1.5 times the lowest but because of decimal float we can't go downwards by .66 (maybe that log algorithm is mor correct?)

* The order that ads are displayed is determined daily using a combination of 1) Coin Type (BCH highest, Demo Coin and the free links) 2) Price Slot PRICE (highest to lowest) and 3) Seniority (i.e. longest continuous purchase of a particular Price Slot). Purchases are "relative and tentative" because other higher or lower payments can and do arrive that can render your ad higher or lower in the display. 


<style>
.grid-container {
  display: grid;
  grid-column-gap: 50px;
  grid-template-columns: auto auto auto;
  background-color: #2196F3;
  padding: 10px;
}
.grid-item {
  background-color: rgba(255, 255, 255, 0.8);
  border: 1px solid rgba(0, 0, 0, 0.8);
  padding: 20px;
  font-size: 30px;
  text-align: center;
}
</style>
<table>
 <?php
$min= number_format($_POST['min'],10, '.', '');
$max = number_format($_POST['max'],10, '.', '');
echo '<br> max = ', $max;
echo '<br>min = ', $min;

//get BCH price

$handle = curl_init();
$url = "https://min-api.cryptocompare.com/data/price?fsym=BCH&tsyms=USD,JPY,EUR";
// Set the url
curl_setopt($handle, CURLOPT_URL, $url);
//curl_setopt($handle, CURLOPT_POSTFIELDS,$args);
// Set the result output to be a string.
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
 $jsonlinkList = curl_exec($handle);
 curl_close($handle);

$data = json_decode($jsonlinkList, TRUE);

echo '<br>Current Bitcoin Cash USD Price ', $data['USD'];


$steps = array_reverse($steps);
foreach ($steps as $key=>$value){
//clean the slate
unset($competingLinkList);
unset($competingAgentList);
unset($competingLink);
unset($competingAgent);
$continent_tally = 0;
$country_tally = 0;
$state_tally = 0;
$district1_tally = 0;
$city_tally = 0;
$district2_tally = 0;
$value = number_format($value,10, '.', '');
$competitor_array = $linkInfo->getPriceSlotPopulation($_POST['cat_id'], $_POST['coin_type'], $value);
//brings back link id/agent id pairs
//This section either leaves the above vars unset (can be detected later) or as a pair of vars with "list" naming convention or without "list" in name (can be detected)
if(is_array($competitor_array)){  //if not, leaves all the variables unset
//if so, we need to find out each of the regional pops for each link
	if(is_array($competitor_array[0])){ //is array so, determine how many competitors in this price slot
		$competingLinkList = $competitor_array[0];
$competingAgentList = $competitor_array[1];
		foreach($competingLinkList as $key3=>$value3){
			foreach($thisLinksRegionalInfo as $key2=>$value2){
//array($id,$continent,$country,$state,$district1,$city,$district2,$agent_ID );

if($key2 == 1){
$loc_name ="continent";
$loc_id= $value2;
$continent_t = $linkInfo->getRegionalCompetitors( $loc_name, $loc_id, $cat_id, $competingLinkList[$key3], $competingAgentList[$key3]);
$continent_tally = $continent_tally + $continent_t ;
}elseif($key2 == 2){
$loc_name ="country";
$loc_id= $value2;
$country_t = $linkInfo->getRegionalCompetitors( $loc_name, $loc_id, $cat_id, $competingLinkList[$key3], $competingAgentList[$key3]);
$country_tally = $country_tally + $country_t ;
}elseif($key2 == 3){
$loc_name ="state";
$loc_id= $value2;
$state_t = $linkInfo->getRegionalCompetitors($loc_name, $loc_id, $cat_id, $competingLinkList[$key3], $competingAgentList[$key3]);
$state_tally = $state_tally + $state_t;
}elseif($key2 == 4){
$loc_name ="district1";
$loc_id= $value2;
$district1_t = $linkInfo->getRegionalCompetitors( $loc_name, $loc_id, $cat_id, $competingLinkList[$key3], $competingAgentList[$key3]);
$district1_tally = $district1_tally + $district1_t;
}elseif($key2 == 5){
$loc_name ="city";
$loc_id= $value2;
$city_t = $linkInfo->getRegionalCompetitors($loc_name, $loc_id, $cat_id, $competingLinkList[$key3], $competingAgentList[$key3]);
$city_tally = $city_tally +$city_t ; 
}elseif($key2 == 6){
$loc_id= $value2;
$loc_name ="district2";
$district2_t = $linkInfo->getRegionalCompetitors( $loc_name, $loc_id, $cat_id, $competingLinkList[$key3], $competingAgentList[$key3]);
$district2_tally = $district2_tally + $district2_t;
}

		}
		$competingAgentList = $competitor_array[1];
		}
	}
	else 
	{
	$competingLink = $competitor_array[0];//is not array so, is just 1 competitor in this price slot
	$competingAgent = $competitor_array[1];
		if(isset($thisLinksRegionalInfo)){
			foreach($thisLinksRegionalInfo as $key2=>$value2){
			//array($id,$continent,$country,$state,$district1,$city,$district2,$agent_ID );

if($key2 == 1){
$loc_name ="continent";
$loc_id= $value2;
$continent_tally = $linkInfo->getRegionalCompetitors( $loc_name, $loc_id, $cat_id, $competingLink, $competingAgent);
}elseif($key2 == 2){
$loc_name ="country";
$loc_id= $value2;
$country_tally = $linkInfo->getRegionalCompetitors( $loc_name, $loc_id, $cat_id, $competingLink, $competingAgent);
}elseif($key2 == 3){
$loc_name ="state";
$loc_id= $value2;
$state_tally = $linkInfo->getRegionalCompetitors( $loc_name, $loc_id, $cat_id, $competingLink, $competingAgent);
}elseif($key2 == 4){
$loc_name ="district1";
$loc_id= $value2;
$district1_tally = $linkInfo->getRegionalCompetitors( $loc_name, $loc_id, $cat_id, $competingLink, $competingAgent);

}elseif($key2 == 5){
$loc_name ="city";
$loc_id= $value2;
$city_tally = $linkInfo->getRegionalCompetitors( $loc_name, $loc_id, $cat_id, $competingLink, $competingAgent);

}elseif($key2 == 6){
$loc_name ="district2";
$loc_id= $value2;
$district2_tally = $linkInfo->getRegionalCompetitors($loc_name, $loc_id, $cat_id, $competingLink, $competingAgent);

}
		}
	}
}
$spacetaken = "<td>$continent_tally</td><td>$country_tally</td><td>$state_tally</td><td>$city_tally</td>";

}


?><tr><td>Price slot amount - <?php echo $value;?>
<br> USD value $<?php echo round($value * $data['USD'],2)." per day";?>
</td><td>

<form name="test" action="" method="post">
<input type="hidden" name="url" value="<?php echo $_POST['url'];?>"> 
<input type="hidden" name="link_id" value="<?php echo $_POST['link_id'];?>"> 
<input type="hidden" name="cat_id" value="<?php echo $_POST['cat_id'];?>"> 
<input type="hidden" name="coin_type" value="<?php echo $_POST['coin_type'];?>"> 
<?php
if($max == $value){
?>
<input type="text" name="price" value="<?php echo $value;?>"> 
<input type="submit" name="C1" value="Equal To The Highest" style="
    border:0;
    background-color:transparent;
    color: DarkOrange;
    text-decoration:underline;
font-weight:bold;
"/></form> </td>

<?php
}elseif($min < $value AND $max < $value){
?>
<input type="text" name="price" value="<?php echo $value;?>"> 
<input type="submit" name="C1" value="Higher Than ALL!" style="
    border:0;
    background-color:transparent;
    color: red;
    text-decoration:underline;
"/></form> </td><!--<td>&nbsp;</td>-->

<?php
echo $regionalDisplaySpaceholder;//add empty columns to above row
}elseif($min > $value){
?>
<input type="text" name="price" value="<?php echo $value;?>"> 
<input type="submit" name="C1" value="Lower Than Lowest" style="
    border:0;
    background-color:transparent;
    color: red;
    text-decoration:underline;
"/></form> </td><!--<td>&nbsp;</td>-->
<?php
echo $regionalDisplaySpaceholder;//add empty columns to above row
}elseif($min < $value){
?>
<input type="text" name="price" value="<?php echo $value;?>"> 
<input type="submit" name="C1" value="Higher Than Lowest
Lower Than Highest" style="
    border:0;
    background-color:transparent;
    color: darkgreen;
    text-decoration:underline;
"/></form> </td>
<?php
		if(isset($competingLinkList)){
		foreach($competingLinkList as $key=>$value){
		//plug the value in and see if this link is in regional sign ups
		$competingCatLinksRegionStatus =  $linkInfo->getRegionalInfo($value, $competingAgentList[$key]);
			if(is_array($competingCatLinksRegionStatus)){
				for($i=0;$i<=7;$i++){
						if(isset($thisLinksRegionalInfo[$i]) AND $thisLinksRegionalInfo[$i] == $competingCatLinksRegionStatus[$i]){
						//Array ( [0] => 4 [1] => 2568 [2] => 2732 [3] => 2859 [4] => 0 [5] => 5350 [6] => 0 [7] => 4 )
				include('switch.php');			
						}
					 }
				}
			}

		if(isset($spacetaken)){
		// getting error on 3rd offset echo $td[1] . $td[2].$td[3].$td[4] .$td[5].$td[6];
echo $spacetaken;
		}
		else
		{
		echo $regionalDisplaySpaceholder;//add empty columns to above row
		}
	}elseif (isset($competingLink)){
	//see if this one, single link in this price slot is in this same region as buyer
	$competingCatLinksRegionStatus =  $linkInfo->getRegionalInfo($competingLink,$competingAgent);
		for($i=0;$i<=7;$i++){
			if(isset($thisLinksRegionalInfo[$i]) AND $thisLinksRegionalInfo[$i] == $competingCatLinksRegionStatus[$i]){
			//Array ( [0] => 4 [1] => 2568 [2] => 2732 [3] => 2859 [4] => 0 [5] => 5350 [6] => 0 [7] => 4 )
	                  include('switch.php');			
			}
		}
		if(isset($spacetaken)){
echo $spacetaken;
		}
		else
		{
		echo $regionalDisplaySpaceholder;//add empty columns to above row
		}
	}
	else  // this price slot has no links in it
	{
	echo $regionalDisplaySpaceholder;//add empty columns to above row
	}
}else //is equal to lowest one owned
{
?>
<input type="text" name="price" value="<?php echo $value;?>"> 
<input type="submit" name="C1" value="Equal To The Lowest" style="
    border:0;
    background-color:transparent;
    color: DarkOrange;
font-weight:bold;
    text-decoration:underline;
"/></form> </td>
<?php
		if(isset($competingLinkList)){
		foreach($competingLinkList as $key=>$value){
		//plug the value in and see if this link is in regional sign ups
		$competingCatLinksRegionStatus =  $linkInfo->getRegionalInfo($value, $competingAgentList[$key]);
			if(is_array($competingCatLinksRegionStatus)){
				for($i=0;$i<=7;$i++){
						if(isset($thisLinksRegionalInfo[$i]) AND $thisLinksRegionalInfo[$i] == $competingCatLinksRegionStatus[$i]){
						//Array ( [0] => 4 [1] => 2568 [2] => 2732 [3] => 2859 [4] => 0 [5] => 5350 [6] => 0 [7] => 4 )
				include('switch.php');			
						}
					 }
				}
			}

		if(isset($spacetaken)){
		// getting error on 3rd offset echo $td[1] . $td[2].$td[3].$td[4] .$td[5].$td[6];
echo $spacetaken;
		}
		else
		{
		echo $regionalDisplaySpaceholder;//add empty columns to above row
		}
	}elseif (isset($competingLink)){
	//see if this one, single link in this price slot is in this same region as buyer
	$competingCatLinksRegionStatus =  $linkInfo->getRegionalInfo($competingLink,$competingAgent);
		for($i=0;$i<=7;$i++){
			if(isset($thisLinksRegionalInfo[$i]) AND $thisLinksRegionalInfo[$i] == $competingCatLinksRegionStatus[$i]){
			//Array ( [0] => 4 [1] => 2568 [2] => 2732 [3] => 2859 [4] => 0 [5] => 5350 [6] => 0 [7] => 4 )
	                  include('switch.php');			
			}
		}
		if(isset($spacetaken)){
		// getting error on 3rd offset echo $td[1] . $td[2].$td[3].$td[4] .$td[5].$td[6];
echo $spacetaken;
		}
		else
		{
		echo $regionalDisplaySpaceholder;//add empty columns to above row
		}
	}
	else  // this price slot has no links in it
	{
	echo $regionalDisplaySpaceholder;//add empty columns to above row
	//$td[$i] =  '<td>&nbsp;</td>';
	}
}


echo '</tr>';

 }

?></table>  
<?php

}
else
{


$display_block = '<div class="grid-container">
  <div class="item1"><h3>Purchase Better Placement Across The Entire Manna Network Ad Network!</h3><b>You can move your ad display ahead of ALL FREE ADS with either FREE "demo" coins or Bitcoin Cash!</b></div>';

include($_SERVER['DOCUMENT_ROOT']."/manna-network/members/classes/member_page_class.php");//load order 1
$LINKinfo = new member_info();
$link_pay_status = $LINKinfo->getLinkPayStatus($_GET['link_id']);
//toggle the following "if" to either abort if link is already paid
//if($link_pay_status !== false){
$abort ="run";
if($link_pay_status !== false && $abort ==="abort"){
echo "<h3>hooAY! tHIS IS A PAID LINK! ", $link_pay_status;
echo '</h3>';

}
else
{



include('styles.css');


$topBCHPriceSlot  = $LINKinfo->getMinMaxPriceSlot($_GET['category_id'], "BCH","MAX");
//$topBCHPriceSlot = ltrim($topBCHPriceSlot, '0');
$lowestBCHPriceSlot  = $LINKinfo->getMinMaxPriceSlot($_GET['category_id'], "BCH","MIN");
$topDMCPriceSlot  = $LINKinfo->getMinMaxPriceSlot($_GET['category_id'], "DMC", "MAX");
$lowestDMCPriceSlot  = $LINKinfo->getMinMaxPriceSlot($_GET['category_id'], "DMC","MIN");


//before we get regional id, wee need to check if this link has regional infoo added? 
$thisLinksRegionalInfo = $LINKinfo->getThisLinksRegionalInfo($_GET['link_id'], $agent_ID);

$users_balances = $LINKinfo->getUsersBalance($user_id);
//returns  array($id, $user_id, $democoin_balance, $bitcoin_cash_balance );
//DEv note - Not sure how to store or retrieve BCH Balance w/o constant calls to central? 

$display_block .= '


  <div class="item2"><h4>URL -> '. $_GET['url'].'</h4>
<h4>Link ID -> '. $_GET['link_id'].'</h4>
  <h4>Category ID -> '. $_GET['category_id'].'</h4>';
if(is_array($thisLinksRegionalInfo)){
$display_block .= ' <h4>Region INFO -> </h4>';
foreach($thisLinksRegionalInfo as $key=>$value){
if($key !==0 AND $key !==7){
//getRegionalName($regionalnum);
if($key==1 AND $value > 0){
$getName= $LINKinfo->getRegionalName($value);
$display_block .= '-> '.$getName;
}
if($key==2 AND $value > 0){
$getName= $LINKinfo->getRegionalName($value);
$display_block .= '-> '.$getName;
}
if($key==3 AND $value > 0){
$getName= $LINKinfo->getRegionalName($value);
$display_block .= '-> '.$getName;
}
if($key==4 AND $value > 0){
$getName= $LINKinfo->getRegionalName($value);
$display_block .= '-> '.$getName;
}
if($key==5 AND $value > 0){
$getName= $LINKinfo->getRegionalName($value);
$display_block .= '-> '.$getName;
}
if($key==6 AND $value > 0){
$getName= $LINKinfo->getRegionalName($value);
$display_block .= '-> '.$getName;
}
}
}

}

/*
if(ltrim($users_balances[3], '0') > 0){
 $display_block .= ' <h4>Your BCH Balance * -> '. ltrim($users_balances[3], '0').'</h4>';
}
else
{
$display_block .= '<h4>You Have NO BCH Balance * -><br><input type="submit" class="submit" name="B1" value="Load Your Account With BCH " style="
    border:0;
    background-color:transparent;
    color: blue;
    text-decoration:underline;
font-size: 16px;
font-weight: bold;
background-color: #4CAF50;
border-radius: 15px;

"/>';
}
if(ltrim($users_balances[2], '0') > 0){
 $display_block .= '<h4>Your Demo Coin Balance ** -> '. ltrim($users_balances[2], '0').'</h4>';
}
else
{
$display_block .= '<h4>You Have NO Demo Coin Balance ** -><br><input type="submit" class="submit" name="B1" value="Request Demo Coin From Your Upline Or Admin" 
style="
    border:0;
    background-color:transparent;
    color: blue;
    text-decoration:underline;
font-size: 16px;
font-weight: bold;
background-color: #4CAF50;
border-radius: 15px;

"/>';
}

*/
$display_block .= '
</div>  
  <div class="item4">
<h5>BCH Price Slots</h5>
<!--round for the display, send entire result so we can search db for match -->
<p>Top BCH Price Slot <BR>Price BCH -> '. ltrim($topBCHPriceSlot[1],'0').'</p>
<p>Lowest BCH Price Slot <BR>Price BCH ->  '.ltrim($lowestBCHPriceSlot[1],'0').'</p>
<form name="test" action="'. htmlentities($_SERVER['PHP_SELF']).'" method="post">
<input type="hidden" name="url" value="'.$_GET['url'].'"> 
<input type="hidden" name="link_id" value="'.$_GET['link_id'].'"> 
<input type="hidden" name="cat_id" value="'.$_GET['category_id'].'"> 
<input type="hidden" name="min" value="'.ltrim($lowestBCHPriceSlot[1],'0').'"> 
<input type="hidden" name="max" value="'.ltrim($topBCHPriceSlot[1],'0').'"> 






<input type="hidden" name="coin_type" value="BCH"> ';
if(ltrim($users_balances[3], '0') > 0){
 $display_block .= '<h5>Your BCH Balance * -> '. ltrim($users_balances[3], '0').'</h5>
<input type="submit" class="submit" name="B1" value="Buy BCH Price Slot" style="
    border:0;
    background-color:transparent;
    color: blue;
    text-decoration:underline;
font-size: 16px;
font-weight: bold;
background-color: #4CAF50;
border-radius: 15px;

"/>';
}
else
{
$display_block .= '<input type="submit" class="submit" name="B1" value="Load Your Account With BCH " style="
    border:0;
    background-color:transparent;
    color: blue;
    text-decoration:underline;
font-size: 16px;
font-weight: bold;
background-color: #4CAF50;
border-radius: 15px;

"/>';

}

 $display_block .= '</form>

</div>

<div class="item5">
<h5>Demo Coin Price Slots</h5>
<p>Top Demo Coin Price Slot <BR>Price DMC -> '. ltrim($topDMCPriceSlot[1],'0').'</p>

<p>Lowest Demo Coin Price Slot <BR>Price DMC -> '. ltrim($lowestDMCPriceSlot[1],'0').'</p>
<form name="test" action="'. htmlentities($_SERVER['PHP_SELF']).'" method="post">
<input type="hidden" name="url" value="'.$_GET['url'].'"> 
<input type="hidden" name="link_id" value="'.$_GET['link_id'].'"> 
<input type="hidden" name="cat_id" value="'.$_GET['category_id'].'"> 
<input type="hidden" name="min" value="'.ltrim($lowestDMCPriceSlot[1],'0').'"> 
<input type="hidden" name="max" value="'.ltrim($topDMCPriceSlot[1],'0').'"> 
<input type="hidden" name="coin_type" value="DMC"> <h5>Your Demo Coin Balance ** -> '. ltrim($users_balances[2], '0').'</h5>
<input type="submit" class="submit" name="B1" value="Buy DMC Price Slot" style="
    border:0;
    background-color:transparent;
    color: blue;
    text-decoration:underline;
font-size: 16px;
font-weight: bold;
background-color: #4CAF50;
border-radius: 15px;

"/></form>
</div>';
}
include('bootstrap_footer.php');

$display_block .= ' <div class="item8"><span>* Pre-load your BCH account to buy with Bitcoin Cash </span><br><span>** Contact admin or your upline if you need more Demo Coin</span></div>
</div>';

echo $display_block;

  


}
?>
