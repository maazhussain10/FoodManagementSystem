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
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
<style>
body{
background-color:#CBFFC2;
}
</style>
</head>
<body>
<?php
include 'nav.php';
?>
<div class="container">


  <center><h2>Add Category	</h2></center><hr>
  <form action="updateCategory.php" method="POST">
            <center><button type="submit" class="btn btn-info">Update Category</button></center>
    </form><hr>
  <form action="addcategorybck.php" method="POST">
            <label for="name" id="tab">Enter Category Name:</label>
            <input type="text" id="name" class="form-control" name="category" placeholder="Add category"><br>
             <label for="name" id="tab">Enter Item name:</label>
            <input type="text" id="name" class="form-control" name="item" placeholder="Add item"><br>
            <center><button type="submit" class="btn btn-info">Submit</button></center>
    </form><hr>
		<center><h2>Remove category	</h2></center><hr>
  <form action="removecategorybck.php" role="form" method="POST">
            <label for="name" id="tab">Enter category Name:</label>
			<?php
			include('dbConnect.php');
			$smt=$con->prepare("select distinct(category) from category");
			$smt->execute();
			$res=$smt->get_result();
			?>
			<select name="category" class="form-control">
			<?php
			while($row=$res->fetch_assoc())
			{
				echo "<option value='".$row['category']."'>".$row['category']."</option>";
			}

			?>
			</select>
            <br/>
            <center><button type="submit" class="btn btn-info">Submit</button></center>
        </form><hr>
  <table class="table table-bordered">
  <center><h2>List of category	</h2></center><hr>
    <tr>
	<th style="text-align:center">List of  categories</th>
	<button onclick="fix_onChange_editable_elements()"> Edit</button>
	</tr>
	<?php
		$smt=$con->prepare("select distinct(category) from category");
		$smt->execute();
		$res=$smt->get_result();
		while($row=$res->fetch_assoc())
		{
			echo "<tr><td contenteditable='false' onchange='editCategory()' style='text-align:center;color:indianred;font-size:20px'>".$row["category"] ."</td></tr>";
			?>
			<script>
			function fix_onChange_editable_elements(){
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
							console.log(this.data_orig,this.innerHTML)
							editCategoryName(this.data_orig,this.innerHTML);
							delete this.data_orig;
						}
					};
				}
			}

			function editCategoryName(oldData,newData){
				console.log(oldData,newData);
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						console.log(this.responseText);
				}
				};
				xhttp.open("GET", "editCategoryName.php?newCategory="+newData+"&oldCategory="+oldData, true);
				xhttp.send();
			}
     </script><?php
		}
		?>
      </table>
  <center><a href="homepage.php"><button type="submit" class="btn btn-success">Home</button></a></center>
</div>

</body></html>
