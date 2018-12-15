<?php
include('bootstrap_header.php');
//include($_SERVER['DOCUMENT_ROOT']."/manna-network/members/classes/member_page_class.php");//load order 1
include(dirname(__DIR__, 3)."/manna-network/members/classes/member_page_class.php");//load order 1

$linkInfo = new member_info();
 $LINKinfo = new member_info();

$affiliate_link_display = $LINKinfo->getLinkByUserIdFree($user_id);
    $num_rows_affil = $affiliate_link_display[0]; $db_idaf= $affiliate_link_display[1]; 
$db_agents_ID = $affiliate_link_display[2];
$db_categoryaf = $affiliate_link_display[3];
   $db_urlaf = $affiliate_link_display[4];   $db_descriptionaf = $affiliate_link_display[5];  $db_nameaf =$affiliate_link_display[6];  $db_start_clone_dateaf = $affiliate_link_display[7];   
echo "<h1>Member's Home</h1>";

foreach($db_idaf as $key=>$value){
$link_pay_status[$key] = $LINKinfo->getLinkPayStatus($db_idaf[$key]);
//toggle the following "if" to either abort if link is already paid
//if($link_pay_status !== false){
$abort ="run";
if($link_pay_status !== false && $abort ==="abort"){
echo "<h3>hooAY! tHIS IS A PAID LINK! ", $link_pay_status;
echo '</h3>';

}
else
{
echo '<h3><a href="buy_price_slot.php?url='.$db_urlaf[$key].'&link_id='.$db_idaf[$key].'&category_id='.$db_categoryaf[$key].'">Buy Price Slot</a></h3>';
}
}

include('bootstrap_footer.php');

?>
