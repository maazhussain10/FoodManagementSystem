<?php
session_start();
if(!isset($_SESSION['uname']))
{
echo "<script>window.location.href='index.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Attendance</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

</head>
  <style>
body{
background-color:#CBFFC2;
}
</style>

<body>
<div class="container-fluid">
<?php 
include 'nav.php';
?>

<center><h3>Attendance details</h3></center>
  <hr>
  <center> <a href="reportfront.php" style="font-size:20px">Click here for attendence report ...</a></center>
  <hr/>
  <form action="attendenceback.php" method="post">
    <center><div class="form-inline">
	<input type="date" class="form-control" name="date" placeholder="Select the date " >
     <br/>
	 <h3>RMK</h3>
       <input type="text" class="form-control" name="rmk_staff" placeholder="Staff count">
      <input type="text" class="form-control" name="rmk_student" placeholder="Students count">
	   <input type="text" class="form-control" name="rmk_worker" placeholder="Workers count">
	    <h3>RMD</h3>
       <input type="text" class="form-control" name="rmd_staff" placeholder="Staff count">
      <input type="text" class="form-control" name="rmd_student" placeholder="Students count">
	   <input type="text" class="form-control" name="rmd_worker" placeholder="Workers count">
	    <h3>RMKCET</h3>
       <input type="text" class="form-control" name="cet_staff" placeholder="Staff count">
      <input type="text" class="form-control" name="cet_student" placeholder="Students count">
	   <input type="text" class="form-control" name="cet_worker" placeholder="Workers count">
	    <h3>MATRIC SCHOOL</h3>
       <input type="text" class="form-control" name="school_staff" placeholder="Staff count">
      <input type="text" class="form-control" name="school_student" placeholder="Students count">
	   <input type="text" class="form-control" name="school_worker" placeholder="Workers count">
	   <h3>RESIDENTIAL SCHOOL</h3>
       <input type="text" class="form-control" name="r_staff" placeholder="Staff count">
      <input type="text" class="form-control" name="r_student" placeholder="Students count">
	   <input type="text" class="form-control" name="r_worker" placeholder="Workers count">
	    <h3>CBSE</h3>
       <input type="text" class="form-control" name="cbse_staff" placeholder="Staff count">
      <input type="text" class="form-control" name="cbse_student" placeholder="Students count">
	   <input type="text" class="form-control" name="cbse_worker" placeholder="Workers count">
	    <h3>POLYTECHNIC</h3>
       <input type="text" class="form-control" name="poly_staff" placeholder="Staff count">
      <input type="text" class="form-control" name="poly_student" placeholder="Students count">
	   <input type="text" class="form-control" name="poly_worker" placeholder="Workers count">
    </div></center>
<br/>
  <center><button type="submit" class="btn btn-info">save</button></center><br/>
  
  
</div>
</form>
</body>
</html>
