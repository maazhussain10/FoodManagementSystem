<?php
session_start();
if (!isset($_SESSION['uname'])) {
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
  <script src="js/bootstrap.min.js"></script>
  <script src="jquery.min.js"></script>
  
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->

</head>
<style>

</style>

<body>
  <div class="text-center">
    <?php
    include 'nav.php';
    ?>

    <center class="my-4">
      <h3>Attendance details</h3>
    </center>
    <center> <a href="reportfront.php" class="btn btn-success mb-3" >View attendence report</a></center>
    
    <div class="container-fluid">
    <form action="attendenceback.php" method="post">
      <div class="row">
        <div class="col-sm-4 offset-sm-4 mb-3">
          <input type="date" class="form-control my-2" name="date" placeholder="Select the date ">
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-sm-4 ">
          <h3>RMK</h3>
          <input type="text" class="form-control my-1" name="rmk_staff" placeholder="Staff count">
          <input type="text" class="form-control my-2" name="rmk_student" placeholder="Students count">
          <input type="text" class="form-control my-2" name="rmk_worker" placeholder="Workers count">
        </div>
        <div class="col-sm-4 ">
          <h3>RMD</h3>
          <input type="text" class="form-control my-2" name="rmd_staff" placeholder="Staff count">
          <input type="text" class="form-control my-2" name="rmd_student" placeholder="Students count">
          <input type="text" class="form-control my-2" name="rmd_worker" placeholder="Workers count">
        </div>
        <div class="col-sm-4 ">
          <h3>RMKCET</h3>
          <input type="text" class="form-control my-2" name="cet_staff" placeholder="Staff count">
          <input type="text" class="form-control my-2" name="cet_student" placeholder="Students count">
          <input type="text" class="form-control my-2" name="cet_worker" placeholder="Workers count">
        </div>
        
      </div>
      <div class="row mt-5">
        <div class="col-sm-4">
          <h3>RESIDENTIAL SCHOOL</h3>
          <input type="text" class="form-control my-2" name="r_staff" placeholder="Staff count">
          <input type="text" class="form-control my-2" name="r_student" placeholder="Students count">
          <input type="text" class="form-control my-2" name="r_worker" placeholder="Workers count">
        </div>
        <div class="col-sm-4">
          <h3>CBSE</h3>
          <input type="text" class="form-control my-2" name="cbse_staff" placeholder="Staff count">
          <input type="text" class="form-control my-2" name="cbse_student" placeholder="Students count">
          <input type="text" class="form-control my-2" name="cbse_worker" placeholder="Workers count">
        </div>
        <div class="col-sm-4">
          <h3>POLYTECHNIC</h3>
          <input type="text" class="form-control my-2" name="poly_staff" placeholder="Staff count">
          <input type="text" class="form-control my-2" name="poly_student" placeholder="Students count">
          <input type="text" class="form-control my-2" name="poly_worker" placeholder="Workers count">
        </div>
      </div>
      <div class="row mt-5">
      <div class="col-sm-4 ">
          <h3>MATRIC SCHOOL</h3>
          <input type="text" class="form-control my-2" name="school_staff" placeholder="Staff count">
          <input type="text" class="form-control my-2" name="school_student" placeholder="Students count">
          <input type="text" class="form-control my-2" name="school_worker" placeholder="Workers count">
        </div>
      </div>


    </form> 
    </div>
    
    



    <br />
    <center><button type="submit" class="btn btn-info">save</button></center><br />


  </div>

</body>

</html>