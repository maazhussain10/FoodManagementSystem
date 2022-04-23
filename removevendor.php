<?php
session_start();
if(!isset($_SESSION['uname']))
{
	echo "<script>window.location.href='index.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head><title>Remove Vendor</title></head>
<body>
<form action="removevendorbck.php" method="post">
<input type="text" name="vendor" placeholder="Name of the vendor"/>
<input type="submit" value="Remove"/>
</form>
</body></html>