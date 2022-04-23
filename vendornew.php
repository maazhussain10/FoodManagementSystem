<?php
session_start();
if(!isset($_SESSION['uname']))
{
echo "<script>window.location.href='index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en"><head>
  <title>Stock Available</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
body{
background-color:#ECE2FF;
}
</style>
</head>
<body>

<div class="container">
  <center><h2>Categories	</h2></center>
  <form action="index.html" method="POST">
            <label for="name" id="tab">Add Categories</label>
            <input type="text" id="name" name="Add" placeholder="Required"><br>
			            <label for="name" id="tab">Remove Categories</label>
            <input type="text" id="name" name="Remove" placeholder="Required"><br>
            <center><button type="submit" class="btn btn-info">Submit</button></center>
        </form>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Add category</th>
        <th>Remove Category</th>
      </tr>
    </thead>
      </table>
  <center><a href="homepage.php"><button type="submit" class="btn btn-info">Home</button></a></center>
</div>

</body></html>