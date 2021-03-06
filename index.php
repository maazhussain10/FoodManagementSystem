<?php
session_start();
session_destroy();
session_unset();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/bootstrap.min.js"></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->

    <link rel="stylesheet" type="text/css" href="new.css">
</head>

<body>
    
    <div class="back">
        <div class="page-header">
        <center class="mt-5"><img src="./assets/img/rmk.png" alt="" width="250" height="100" class="img-fluid "></center>
        </div>
        <br><br><br>
        <center>
            <div class="container">
                <div class="jumbotron" id="jumbo">
                    <center>
                        <form action="log.php" method="post" class="form-inline">
                            <div class="form-group">
                                <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input type="text" name="uname" class="form-control" placeholder="Username">
                                </div><br><br>
                                <div class="form-group">
                                    <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input type="password" name="pass" class="form-control" placeholder="Password">
                                    </div><br><br>

                                    <button type="submit" class="btn btn-success" data-toggle="rmk" data-target="#demo">Login</button>
                        </form>
                    </center>
                </div>
            </div>
    </div>
    </div>
    </center>
    </div>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
</body>

</html>