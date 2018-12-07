<?php
include("../../install/db_read_cfg/links/db_auth.php");
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

$sql="SELECT * FROM `links`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
   $id=$row["id"];
$BB_user_ID=$row["BB_user_ID"];
$category=$row["category"];
$temp=$row["temp"];
$url=$row["url"];
$name=$row["name"];
$description=$row["description"];
$approved=$row["approved"];
$non_detectable=$row["non_detectable"];
$is_a_modified=$row["is_a_modified"];
$start_date=$row["start_date"];
$nofollow=$row["nofollow"];

    }
} else {
    echo "0 results";
}
$conn->close();


?>
