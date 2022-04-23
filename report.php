<?php
session_start();
include 'nav.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>attendance report</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <style>
  body{
background-color:#CBFFC2;
}
  th,td
  {
    border:2px solid black;
    border-collapse: collapse;
    width:1%;
    padding: 5px;
  }
</style>
</head>
<body>
<h1><center>Monthly Attendance Report</center></h1>
<?php
$x=$_POST['date1'];
$y=$_POST['date2'];

include('dbConnect.php');
$smt=$con->prepare("select * from attendence where date>=? and date<=?");
$smt->bind_param('ss',$x,$y);
$smt->execute();
$res=$smt->get_result();
//print_r($res);
?>


<hr/>
<br>
<center>From:    <input type="text" name="Month" value="<?php echo $_POST['date1'];?>" disabled/> TO: <input type="text" name="Month" value="<?php echo $_POST['date2'];?>" disabled/> </center><br/>
<table align="center">
  <tr>
  <th rowspan="2">DATE</th>
  <th colspan="3">RMK</th>
  <th colspan="3">RMD</th>
  <th colspan="3">RMKCET</th>
  <th colspan="3">MSCHOOL</th>
  <th colspan="3">RSCHOOL</th>
  <th colspan="3">CBSE</th>
  <th colspan="3">POLYTECH</th>
  <th rowspan="2">TOTAL</th>
</tr>
<tr>
  <th>stud</th>
  <th>staff</th>
  <th>workrs</th>
   <th>stud</th>
  <th>staff</th>
  <th>workrs</th>
   <th>stud</th>
  <th>staff</th>
  <th>workrs</th>
   <th>stud</th>
  <th>staff</th>
  <th>workrs</th>
   <th>stud</th>
  <th>staff</th>
  <th>workrs</th>
   <th>stud</th>
  <th>staff</th>
  <th>workrs</th>
   <th>stud</th>
  <th>staff</th>
  <th>workrs</th>
</tr>

<?php
while($row=$res->fetch_assoc()){
	echo '<tr>
  <td>'.$row['date'].'</td>
  <td>'.$row['rmk_students'].'</td>
  <td>'.$row['rmk_staff'].'</td>
  <td>'.$row['rmk_workers'].'</td>
  <td>'.$row['rmd_students'].'</td>
  <td>'.$row['rmd_staff'].'</td>
  <td>'.$row['rmd_workers'].'</td>
  <td>'.$row['cet_students'].'</td>
  <td>'.$row['cet_staff'].'</td>
  <td>'.$row['cet_workers'].'</td>
  <td>'.$row['school_students'].'</td>
  <td>'.$row['school_staff'].'</td>
  <td>'.$row['school_workers'].'</td>
  <td>'.$row['r_students'].'</td>
  <td>'.$row['r_staff'].'</td>
  <td>'.$row['r_workers'].'</td>
  <td>'.$row['cbse_students'].'</td>
  <td>'.$row['cbse_staff'].'</td>
  <td>'.$row['cbse_workers'].'</td>
  <td>'.$row['poly_students'].'</td>
  <td>'.$row['poly_staff'].'</td>
  <td>'.$row['poly_workers'].'</td>
  <td>'.$row['total_count'].'</td>
</tr>';
}
?>

<!--
<tr>
  <td>1/5/2018</td>
  <td>1000</td>
  <td>250</td>
  <td>700</td>
  <td>850</td>
  <td>50</td>
  <td>250</td>
  <td>450</td>
  <td>20</td>
  <td>180</td>
  <td>450</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>20</td>
  <td>180</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>430</td>
  <td>60</td>
  <td>60</td>
  <td>4950</td>
</tr>
<tr>
  <td>2/5/2018</td>
  <td>1000</td>
  <td>250</td>
  <td>700</td>
  <td>850</td>
  <td>50</td>
  <td>250</td>
  <td>450</td>
  <td>20</td>
  <td>180</td>
  <td>450</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>20</td>
  <td>180</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>430</td>
  <td>60</td>
  <td>60</td>
  <td>4950</td>
</tr>
<tr>
  <td>3/5/2018</td>
  <td>1000</td>
  <td>250</td>
  <td>700</td>
  <td>850</td>
  <td>50</td>
  <td>250</td>
  <td>450</td>
  <td>20</td>
  <td>180</td>
  <td>450</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>20</td>
  <td>180</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>430</td>
  <td>60</td>
  <td>60</td>
  <td>4950</td>
</tr>
<tr>
  <td>4/5/2018</td>
  <td>1000</td>
  <td>250</td>
  <td>700</td>
  <td>850</td>
  <td>50</td>
  <td>250</td>
  <td>450</td>
  <td>20</td>
  <td>180</td>
  <td>450</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>20</td>
  <td>180</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>430</td>
  <td>60</td>
  <td>60</td>
  <td>4950</td>
</tr>
<tr>
  <td>5/5/2018</td>
  <td>1000</td>
  <td>250</td>
  <td>700</td>
  <td>850</td>
  <td>50</td>
  <td>250</td>
  <td>450</td>
  <td>20</td>
  <td>180</td>
  <td>450</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>20</td>
  <td>180</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>430</td>
  <td>60</td>
  <td>60</td>
  <td>4950</td>
</tr>
<tr>
  <td>6/5/2018</td>
  <td>1000</td>
  <td>250</td>
  <td>700</td>
  <td>850</td>
  <td>50</td>
  <td>250</td>
  <td>450</td>
  <td>20</td>
  <td>180</td>
  <td>450</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>20</td>
  <td>180</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>430</td>
  <td>60</td>
  <td>60</td>
  <td>4950</td>
</tr>
<tr>
  <td>7/5/2018</td>
  <td>1000</td>
  <td>250</td>
  <td>700</td>
  <td>850</td>
  <td>50</td>
  <td>250</td>
  <td>450</td>
  <td>20</td>
  <td>180</td>
  <td>450</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>20</td>
  <td>180</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>430</td>
  <td>60</td>
  <td>60</td>
  <td>4950</td>
</tr>
<tr>
  <td>8/5/2018</td>
  <td>1000</td>
  <td>250</td>
  <td>700</td>
  <td>850</td>
  <td>50</td>
  <td>250</td>
  <td>450</td>
  <td>20</td>
  <td>180</td>
  <td>450</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>20</td>
  <td>180</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>430</td>
  <td>60</td>
  <td>60</td>
  <td>4950</td>
</tr>
<tr>
  <td>9/5/2018</td>
  <td>1000</td>
  <td>250</td>
  <td>700</td>
  <td>850</td>
  <td>50</td>
  <td>250</td>
  <td>450</td>
  <td>20</td>
  <td>180</td>
  <td>450</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>20</td>
  <td>180</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>430</td>
  <td>60</td>
  <td>60</td>
  <td>4950</td>
</tr>
<tr>
  <td>10/5/2018</td>
  <td>1000</td>
  <td>250</td>
  <td>700</td>
  <td>850</td>
  <td>50</td>
  <td>250</td>
  <td>450</td>
  <td>20</td>
  <td>180</td>
  <td>450</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>20</td>
  <td>180</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>430</td>
  <td>60</td>
  <td>60</td>
  <td>4950</td>
</tr>
<tr>
  <td>11/5/2018</td>
  <td>1000</td>
  <td>250</td>
  <td>700</td>
  <td>850</td>
  <td>50</td>
  <td>250</td>
  <td>450</td>
  <td>20</td>
  <td>180</td>
  <td>450</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>20</td>
  <td>180</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>430</td>
  <td>60</td>
  <td>60</td>
  <td>4950</td>
</tr>
<tr>
  <td>12/5/2018</td>
  <td>1000</td>
  <td>250</td>
  <td>700</td>
  <td>850</td>
  <td>50</td>
  <td>250</td>
  <td>450</td>
  <td>20</td>
  <td>180</td>
  <td>450</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>20</td>
  <td>180</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>430</td>
  <td>60</td>
  <td>60</td>
  <td>4950</td>
</tr>
<tr>
  <td>13/5/2018</td>
  <td>1000</td>
  <td>250</td>
  <td>700</td>
  <td>850</td>
  <td>50</td>
  <td>250</td>
  <td>450</td>
  <td>20</td>
  <td>180</td>
  <td>450</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>20</td>
  <td>180</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>430</td>
  <td>60</td>
  <td>60</td>
  <td>4950</td>
</tr>
<tr>
  <td>14/5/2018</td>
  <td>1000</td>
  <td>250</td>
  <td>700</td>
  <td>850</td>
  <td>50</td>
  <td>250</td>
  <td>450</td>
  <td>20</td>
  <td>180</td>
  <td>450</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>20</td>
  <td>180</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>430</td>
  <td>60</td>
  <td>60</td>
  <td>4950</td>
</tr>
<tr>
  <td>15/5/2018</td>
  <td>1000</td>
  <td>250</td>
  <td>700</td>
  <td>850</td>
  <td>50</td>
  <td>250</td>
  <td>450</td>
  <td>20</td>
  <td>180</td>
  <td>450</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>20</td>
  <td>180</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>430</td>
  <td>60</td>
  <td>60</td>
  <td>4950</td>
</tr>
<tr>
  <td>16/5/2018</td>
  <td>1000</td>
  <td>250</td>
  <td>700</td>
  <td>850</td>
  <td>50</td>
  <td>250</td>
  <td>450</td>
  <td>20</td>
  <td>180</td>
  <td>450</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>20</td>
  <td>180</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>430</td>
  <td>60</td>
  <td>60</td>
  <td>4950</td>
</tr>
<tr>
  <td>17/5/2018</td>
  <td>1000</td>
  <td>250</td>
  <td>700</td>
  <td>850</td>
  <td>50</td>
  <td>250</td>
  <td>450</td>
  <td>20</td>
  <td>180</td>
  <td>450</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>20</td>
  <td>180</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>430</td>
  <td>60</td>
  <td>60</td>
  <td>4950</td>
</tr>
<tr>
  <td>18/5/2018</td>
  <td>1000</td>
  <td>250</td>
  <td>700</td>
  <td>850</td>
  <td>50</td>
  <td>250</td>
  <td>450</td>
  <td>20</td>
  <td>180</td>
  <td>450</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>20</td>
  <td>180</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>430</td>
  <td>60</td>
  <td>60</td>
  <td>4950</td>
</tr>
<tr>
  <td>19/5/2018</td>
  <td>1000</td>
  <td>250</td>
  <td>700</td>
  <td>850</td>
  <td>50</td>
  <td>250</td>
  <td>450</td>
  <td>20</td>
  <td>180</td>
  <td>450</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>20</td>
  <td>180</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>430</td>
  <td>60</td>
  <td>60</td>
  <td>4950</td>
</tr>
<tr>
  <td>20/5/2018</td>
  <td>1000</td>
  <td>250</td>
  <td>700</td>
  <td>850</td>
  <td>50</td>
  <td>250</td>
  <td>450</td>
  <td>20</td>
  <td>180</td>
  <td>450</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>20</td>
  <td>180</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>430</td>
  <td>60</td>
  <td>60</td>
  <td>4950</td>
</tr>
<tr>
  <td>21/5/2018</td>
  <td>1000</td>
  <td>250</td>
  <td>700</td>
  <td>850</td>
  <td>50</td>
  <td>250</td>
  <td>450</td>
  <td>20</td>
  <td>180</td>
  <td>450</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>20</td>
  <td>180</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>430</td>
  <td>60</td>
  <td>60</td>
  <td>4950</td>
</tr>
<tr>
  <td>22/5/2018</td>
  <td>1000</td>
  <td>250</td>
  <td>700</td>
  <td>850</td>
  <td>50</td>
  <td>250</td>
  <td>450</td>
  <td>20</td>
  <td>180</td>
  <td>450</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>20</td>
  <td>180</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>430</td>
  <td>60</td>
  <td>60</td>
  <td>4950</td>
</tr>
<tr>
  <td>23/5/2018</td>
  <td>1000</td>
  <td>250</td>
  <td>700</td>
  <td>850</td>
  <td>50</td>
  <td>250</td>
  <td>450</td>
  <td>20</td>
  <td>180</td>
  <td>450</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>20</td>
  <td>180</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>430</td>
  <td>60</td>
  <td>60</td>
  <td>4950</td>
</tr>
<tr>
  <td>24/5/2018</td>
  <td>1000</td>
  <td>250</td>
  <td>700</td>
  <td>850</td>
  <td>50</td>
  <td>250</td>
  <td>450</td>
  <td>20</td>
  <td>180</td>
  <td>450</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>20</td>
  <td>180</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>430</td>
  <td>60</td>
  <td>60</td>
  <td>4950</td>
</tr>
<tr>
  <td>25/5/2018</td>
  <td>1000</td>
  <td>250</td>
  <td>700</td>
  <td>850</td>
  <td>50</td>
  <td>250</td>
  <td>450</td>
  <td>20</td>
  <td>180</td>
  <td>450</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>20</td>
  <td>180</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>430</td>
  <td>60</td>
  <td>60</td>
  <td>4950</td>
</tr>
<tr>
  <td>26/5/2018</td>
  <td>1000</td>
  <td>250</td>
  <td>700</td>
  <td>850</td>
  <td>50</td>
  <td>250</td>
  <td>450</td>
  <td>20</td>
  <td>180</td>
  <td>450</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>20</td>
  <td>180</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>430</td>
  <td>60</td>
  <td>60</td>
  <td>4950</td>
</tr>
<tr>
  <td>27/5/2018</td>
  <td>1000</td>
  <td>250</td>
  <td>700</td>
  <td>850</td>
  <td>50</td>
  <td>250</td>
  <td>450</td>
  <td>20</td>
  <td>180</td>
  <td>450</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>20</td>
  <td>180</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>430</td>
  <td>60</td>
  <td>60</td>
  <td>4950</td>
</tr>
<tr>
  <td>28/5/2018</td>
  <td>1000</td>
  <td>250</td>
  <td>700</td>
  <td>850</td>
  <td>50</td>
  <td>250</td>
  <td>450</td>
  <td>20</td>
  <td>180</td>
  <td>450</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>20</td>
  <td>180</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>430</td>
  <td>60</td>
  <td>60</td>
  <td>4950</td>
</tr>
<tr>
  <td>29/5/2018</td>
  <td>1000</td>
  <td>250</td>
  <td>700</td>
  <td>850</td>
  <td>50</td>
  <td>250</td>
  <td>450</td>
  <td>20</td>
  <td>180</td>
  <td>450</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>20</td>
  <td>180</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>430</td>
  <td>60</td>
  <td>60</td>
  <td>4950</td>
</tr>
<tr>
  <td>30/5/2018</td>
  <td>1000</td>
  <td>250</td>
  <td>700</td>
  <td>850</td>
  <td>50</td>
  <td>250</td>
  <td>450</td>
  <td>20</td>
  <td>180</td>
  <td>450</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>20</td>
  <td>180</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>430</td>
  <td>60</td>
  <td>60</td>
  <td>4950</td>
</tr>
<tr>
  <td>31/5/2018</td>
  <td>1000</td>
  <td>250</td>
  <td>700</td>
  <td>850</td>
  <td>50</td>
  <td>250</td>
  <td>450</td>
  <td>20</td>
  <td>180</td>
  <td>450</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>20</td>
  <td>180</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>430</td>
  <td>60</td>
  <td>60</td>
  <td>4950</td>
</tr>
<tr>
  <th>TOTAL</th>
  <td>1000</td>
  <td>250</td>
  <td>700</td>
  <td>850</td>
  <td>50</td>
  <td>250</td>
  <td>450</td>
  <td>20</td>
  <td>180</td>
  <td>450</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>20</td>
  <td>180</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>430</td>
  <td>60</td>
  <td>60</td>
  <td>4950</td>
</tr>

<br>
<br>-->
</table>
<center>
<button onclick="myFunction()">Print this page</button>
<script>
function myFunction() {
  window.print();
}
</script>
</table>
</center>
</body>
</html>
