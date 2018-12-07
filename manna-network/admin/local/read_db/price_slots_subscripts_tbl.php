<?php
include("../../install/db_read_cfg/price_slots_subscripts/db_auth.php");
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

$sql="SELECT * FROM `price_slots_subscripts`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
 $id=$row["id"];
$user_id=$row["user_id"];
$link_id=$row["link_id"];
$wdgts_lnk_num=$row["wdgts_lnk_num"];
$wdgts_ID=$row["wdgts_ID"];
$price_slot_amnt=$row["price_slot_amnt"];
$subscribe=$row["subscribe"];
$coin_type=$row["coin_type"];
$cat_id=$row["cat_id"];
$t_timestamp=$row["t_timestamp"];
$start_date=$row["start_date"];

    }
} else {
    echo "0 results";
}
$conn->close();

?>
