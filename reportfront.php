<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head><title>Reports</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <style>
body{
background-color:#CBFFC2;
}
</style>

</head>
<body >
<?php
include 'nav.php';
?>

<div class="container">



<center><h1>Reports</h1></center><hr>

<form action="report.php" method="post">
<label for="from">From</label><br>
<input type="date" class="form-control" name="date1" /><br>
<label for="to">To</label><br>
<input type="date" class="form-control" name="date2" /><br>
<br/>
<button type="submit" class="btn btn-warning" value="Get Report">Get Report</button>
</form>
<center><a href="homepage.php" style="color:white">Home</a></center>
</div>
</body>
</html>
