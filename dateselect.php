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



<center><h1>Item Wise Reports</h1></center><hr>

<form action="newreport.php" method="post">
<label for="from">From</label><br>
<input type="date" class="form-control" name="date1" /><br>
<label for="to">To</label><br>
<input type="date" class="form-control" name="date2" /><br>
<br/>
<button type="submit" class="btn btn-warning" value="Get Report">Get Report</button>
</form>

<center><h1>Monthly Reports</h1></center><hr>

<form action="monthlyReport.php" method="post">
<label for="from">From</label><br>
<input type="date" class="form-control" name="date1" /><br>
<label for="to">To</label><br>
<input type="date" class="form-control" name="date2" /><br>
<br/>
<button type="submit" class="btn btn-warning" value="Get Report">Get Report</button>
</form>
</div>
</div> 
<div class="container">

<center><h1>Category Reports</h1></center><hr>

<form action="categoryReport.php" method="post">
<label for="from">From</label><br>
<input type="date" class="form-control" name="date1" /><br>
<label for="to">To</label><br>
<input type="date" class="form-control" name="date2" /><br>
<br/>
<button type="submit" class="btn btn-warning" value="Get Report">Get Report</button>
</form>

<center><h1>Average Reports</h1></center><hr>

<form action="average.php" method="post">
<label for="from">From</label><br>
<input type="date" class="form-control" name="date1" /><br>
<label for="to">To</label><br>
<input type="date" class="form-control" name="date2" /><br>
<br/>
<button type="submit" class="btn btn-warning" value="Get Report">Get Report</button>
</form>
<center><a href="homepage.php" style="color:black;">Home</a></center>
</div>
</body>
</html>
