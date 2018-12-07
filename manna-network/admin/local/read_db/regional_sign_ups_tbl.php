<?php
include("../../install/db_read_cfg/regional_sign_ups/db_auth.php");
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

$sql="SELECT * FROM `regional_sign_ups`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
$id=$row["id"];
$continent=$row["continent"];
$country=$row["country"];
$state=$row["state"];
$district1=$row["district1"];
$city=$row["city"];
$district2=$row["district2"];
$street=$row["street"];
$link_id=$row["link_id"];
$cat_id=$row["cat_id"];

    }
} else {
    echo "0 results";
}
$conn->close();

?>
