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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="new.css">
</head>
<body>
<div class="back">
<div class="page-header">
<center>
<h3>RMK ENGINEERING COLLEGE</h3>
</center>
</div>
<br><br><br>
<center>
<div class="container">
<div class="jumbotron" id="jumbo">
<center>
<form action="log.php" method="post" class="form-inline">
<div class="form-group">
<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
<input type="text" name="uname" class="form-control" placeholder="Username"></div><br><br>
<div class="form-group">
<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
<input type="password" name="pass" class="form-control" placeholder="Password"></div><br><br>

<button type="submit" class="btn btn-success" data-toggle="rmk" data-target="#demo">Login</button>
</form>
</center>
</div>
</div>
</div>
</div>
</center>
</div>
</body>
</html>