<?php
session_start();
if(!isset($_SESSION['uname']))
{
echo "<script>window.location.href='index.php';</script>";
}
include('dbConnect.php');
$res=$con->query("select item,category,sum(quantity) as quantity from current GROUP by item ORDER BY category, item");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Stock Available</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
<style>

body{
background-color:#CBFFC2;
}
th{
	color:indianred;
}
h2{
	color: violet;
}
</style>

</head>
<body>
<?php
include 'nav.php';
?>

<div class="container">


  <center><h2>Stock Available</h2></center>
  <button onclick="fix_onChange_editable_elements()"> Edit</button>
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
	while($row=$res->fetch_assoc())
    {
	   echo "<tr style='font-size:20px;'>";
       echo"<td contenteditable='false' id='itemName' onchange='editItemName()'>".$row['item'] ."</td>";
	   ?>
	   <script>
	   function fix_onChange_editable_elements()
		{
		  var tags = document.querySelectorAll('[contenteditable=false][onchange]');

		  var editable_elements = document.querySelectorAll("[contenteditable=false]");
			for(var i=0; i<editable_elements.length; i++)
			    editable_elements[i].setAttribute("contenteditable", true);

		  for (var i=tags.length-1; i>=0; i--)
			if (typeof(tags[i].onblur)!='function'){
				tags[i].onfocus = function(){
					this.data_orig=this.innerHTML;
				};
				tags[i].onblur = function(){
					if (this.innerHTML != this.data_orig){
					editItemName(this.data_orig,this.innerHTML);
					delete this.data_orig;
				}
				};
			}
		}

		function editItemName(oldData,newData)
		{
			console.log(oldData,newData);
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					console.log(this.responseText);
			}
			};
			xhttp.open("GET", "editItemName.php?newItem="+newData+"&oldItem="+oldData, true);
			xhttp.send();
		}
     </script><?php
       echo"<td>".$row['category'] ."</td>";
       echo"<td>".$row['quantity'] ."</td>";
       echo"</tr>";
	}
    ?>

    </tbody>
  </table>
  <center>
      <button onclick="myFunction()">Print this page</button>

<script>
function myFunction() {
  window.print();
}
</script>

   <br> <br>  <a href="homepage.php">Home</a></center>
</div>
</body>
</html>
