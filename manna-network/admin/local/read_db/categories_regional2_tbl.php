<?php
include("../../install/db_read_cfg/categories_regional2/db_auth.php");

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

$sql="SELECT * FROM `categories_regional2`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
   $id=$row["id"];
$name=$row["name"];
$parent=$row["parent"];
$lft=$row["lft"];
$rgt=$row["rgt"];
    }
} else {
    echo "0 results";
}
$conn->close();
?>
