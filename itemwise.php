<?php
session_start();
if(!isset($_SESSION['uname']))
{
echo "<script>window.location.href='index.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head><title>Reports</title>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
body{
background-color:#CBFFC2;
}
</style>
</head>
<body>
<?php 
include 'nav.php';
?>
<div class="container">


<center><h1>Reports</h1></center><hr>

<form action="itemback.php" method="post">
<div class="form-group">
<label for="item">Item Name:<br/>
<input type="text" class="form-control" id="item" name="item" /><br>
<button type="submit" class="btn btn-info">Get Report</button>
</div></form><hr/>
<center><a href="homepage.php">Home</a></center>
</div>
</body>
</html>
