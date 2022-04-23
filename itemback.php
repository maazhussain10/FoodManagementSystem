<?php
session_start();
if(!isset($_SESSION['uname']))
{
echo "<script>window.location.href='index.php';</script>";
}
if(!isset($_POST['item']))
{
	echo "<script>window.location.href='itemwise.php';</script>";
}
include('dbConnect.php');
$item=$_POST['item'];
$smt=$con->prepare("select * from current where item=?");
$smt->bind_param('s',$item);
$smt->execute();
$res=$smt->get_result();
if(!$row=$res->fetch_assoc())
{
	echo "<script>window.alert('Item not found!');</script>";
	echo "<script>window.location.href='itemwise.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Item Available</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
body{
background-color:LemonChiffon;
}
</style>
</head>
<body>
<?php 
include 'nav.php';
?>
<div class="container">


  <center><h2>Item Available</h2></center>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Item</th>
        <th>Category</th>
        <th>Quantity</th>
      </tr>
    </thead>
    <tbody>
	<?php
	   echo "<tr>";
       echo"<td>".$row['item'] ."</td>";
       echo"<td>".$row['category'] ."</td>";
       echo"<td>".$row['quantity'] ."</td>";
       echo"</tr>";
    ?>
    </tbody>
  </table>
  <center><a href="homepage.php">Home</a></center>
</div>
</body>
</html>
