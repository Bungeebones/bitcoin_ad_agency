<? 

session_start();
$message   = $_SESSION['message'];
$moniker="<h5>Success</h5>";
$body_width="wide";

include('../960top.php');

echo '<h1> Thank you! <br>Your order was processed successfully.</h1>';
echo $message;
echo '<h1><a href="/members/index.php">RETURN To Control Panel</a></h1>';


include('../960bottom.php');
