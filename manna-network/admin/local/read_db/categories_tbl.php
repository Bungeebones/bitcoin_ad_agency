<?php
include("../../install/db_read_cfg/categories/db_auth.php");
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

$sql = "Select * FROM `categories`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
   $id=$row["id"];
$name=$row["name"];
$parent=$row["parent"];
$lft=$row["lft"];
$rgt=$row["rgt"];
$is_approved=$row["is_approved"];
$population=$row["population"];
$pop_cont=$row["pop_cont"];
$pop_country=$row["pop_country"];
$pop_state=$row["pop_state"];
$pop_city=$row["pop_city"];
$paid_link_array=$row["paid_link_array"];
    }
} else {
    echo "0 results";
}
$conn->close();

?>
