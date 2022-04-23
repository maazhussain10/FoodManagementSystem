<?php
session_start();
if(!isset($_SESSION['uname']))
{
	echo "<script>window.location.href='index.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head><title>Remove Category</title></head>
<body>
<form action="removecategorybck.php" method="post">
<input type="text" name="category" placeholder="Name of the Category"/>
<input type="submit" value="Remove"/>
</form>
</body></html>