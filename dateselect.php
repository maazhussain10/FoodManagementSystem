<?php
session_start();
if (!isset($_SESSION['uname'])) {
  echo "<script>window.location.href='index.php';</script>";
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Reports</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
  <script src="jquery.min.js"></script>
  <!-- <script src="js/bootstrap.min.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>

  </style>

</head>

<body>
  <?php
  include 'nav.php';
  ?>

  <div class="container-fluid mt-5">

    <div class="row">
      <div class="col-sm-3">
        <div class="card text-center">
          <h4 class="card-header">
            ITEM WISE REPORT
          </h4>
          <div class="card-body">
            <form action="newreport.php" method="post">
              <label class="form-label" for="from">From</label><br>
              <input type="date" class="form-control" name="date1" /><br>
              <label class="form-label" for="to">To</label><br>
              <input type="date" class="form-control" name="date2" /><br>
              <br />
              <button type="submit" class="btn btn-primary" value="Get Report">GET REPORT</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="card text-center">
          <h4 class="card-header">
            MONTHLY REPORTS
          </h4>
          <div class="card-body">
            <form action="monthlyReport.php" method="post">
              <label class="form-label" for="from">From</label><br>
              <input type="date" class="form-control" name="date1" /><br>
              <label for="to">To</label><br>
              <input type="date" class="form-control" name="date2" /><br>
              <br />
              <button type="submit" class="btn btn-primary" value="Get Report">GET REPORT</button>
            </form>
          </div>

        </div>



      </div>
      <div class="col-sm-3">
        <div class="card text-center">
          <h4 class="card-header">
            CATEGORY REPORTS
          </h4>
          <div class="card-body">
            <form action="categoryReport.php" method="post">
              <label class="form-label" for="from">From</label><br>
              <input type="date" class="form-control" name="date1" /><br>
              <label class="form-label" for="to">To</label><br>
              <input type="date" class="form-control" name="date2" /><br>
              <br />
              <button type="submit" class="btn btn-primary" value="Get Report">GET REPORT</button>
            </form>
          </div>
        </div>



      </div>
      <div class="col-sm-3">
        <div class="card text-center">
          <h4 class="card-header">
            AVERAGE REPORTS
          </h4>
          <div class="card-body">
            <form action="average.php" method="post">
              <label class="form-label" for="from">From</label><br>
              <input type="date" class="form-control" name="date1" /><br>
              <label class="form-label" for="to">To</label><br>
              <input type="date" class="form-control" name="date2" /><br>
              <br />
              <button type="submit" class="btn btn-primary" value="Get Report">GET REPORT</button>
            </form>
          </div>

        </div>



      </div>
    </div>
    <div class="row mt-5 mb-3">
      
    </div>




  </div>

</body>

</html>