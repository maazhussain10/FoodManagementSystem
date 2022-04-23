<?php
include 'nav.php';
?>
<?php
  include('dbConnect.php');
  $smt=$con->prepare("select distinct(item) from category order by item;");
  $smt->execute();
  $res=$smt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Dispatch</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <style type="text/css">
	body{
		background-color:#CBFFC2;
	}
	*{
		font-weight:bold;
	}
  	input{
		font-size:15px;
		color:black;
		margin-right: 10px;
  	}
  	.add-button {
  		background-color: #4CAF50; /* Green */
	    border: none;
	    color: white;
	    padding: 3px 2px;
	    text-align: center;
	    text-decoration: none;
	    display: inline-block;
	    font-size: 10px;
	    cursor: pointer;
  	}
  </style>
</head>
<body>
	<center><h3>Dispatch details</h3></center>
	<form action="disbck.php" method="post" name="entryForm">
		 <center>Enter the date:<input type="date" name="date"></center><br/>
		<br>
		<center>
    <?php
          echo "<select name=name1 onchange=getQuantity(this) class=1 style='color:red; height:40px'>";
          echo "<option value=''>Select Item</option>";
          $array_values = array();
          while($row=$res->fetch_assoc()){
            $value=$row['item'];
            array_push($array_values,$value);
            echo "<option value='".$value."'>".$value."</option>";
          }
          echo "</select>";
    ?>
		<input type="text" name="available1" disabled="true"  />
		<input type="text" id="aaa" onchange="addValue(this)" class="1" name="rmk1" placeholder="RMK" />
		<input type="text" id="aaa" onchange="addValue(this)" class="1" name="rmd1" placeholder="RMD"/>
		<input type="text" id="aaa" onchange="addValue(this)" class="1" name="rmkcet1" placeholder="RMKCET"/>
		<input type="text" id="aaa" onchange="addValue(this)" class="1" name="school1" placeholder="SCHOOL"/></center>
		<br>
		<center>
      <div id="dynamic_data1"></div>
		<div onclick="addForm()"  type="button" class="btn btn-success">ADD</div></center>
		<br>
		<br>
		<br>
		<center><input type="submit" onclick="checkDate()" class="btn btn-primary"></center>
	</form>


	<script type="text/javascript">
		var counter = 2;

		function addForm(){
      var datas= <?php echo json_encode($array_values); ?>;
      for(let i=0 ; i<20 ; i++){
        node="";
        node+= '<select type="text" name="name'+counter+'" class='+counter+' onchange="getQuantity(this)">';
        node+= '<option value="">Select Item</option>';
        for(let i=0;i<datas.length;i++){
          node+= '<option value='+datas[i]+'>'+datas[i]+'</option>';
        }
				node+= '</select><input type="text" name="available'+counter+'" disabled="true" /> <input type="text" onchange="addValue(this)" class="'+counter+'" name="rmk'+counter+'" placeholder="RMK"/><input type="text" onchange="addValue(this)" class="'+counter+'" name="rmd'+counter+'" placeholder="RMD"/><input type="text" onchange="addValue(this)" class="'+counter+'" name="rmkcet'+counter+'" placeholder="RMKCET"/><input type="text" onchange="addValue(this)" class="'+counter+'" name="school'+counter+'" placeholder="SCHOOL"/><br><br><div id="dynamic_data'+counter+'"></div>';
				document.getElementById('dynamic_data'+(counter-1)).innerHTML += node;
				counter++;
			}
		}

		function addValue(node){
			var itemNumber = node.className;
			var values = node.value;
			var existingValue = document.forms["entryForm"]["available"+itemNumber].value;

			if(existingValue-values<0)
				alert("Dispatch Value does not exist");
			else
				document.forms["entryForm"]["available"+itemNumber].value = existingValue-values;
		}

		function getQuantity(node){
			var itemNumber = node.className;
			var item = node.value;
			console.log(item,itemNumber);
  			var xhttp = new XMLHttpRequest();
  			xhttp.onreadystatechange = function() {
    			if (this.readyState == 4 && this.status == 200) {
      				document.forms["entryForm"]["available"+itemNumber].value = this.responseText;
    			}
  			};
		    xhttp.open("POST", "available-stock-particular-item.php", true);
  			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  			var params = "item="+item;
  			xhttp.send(params);
		}

		function checkDate(){
			if(!document.getElementByName("date").value)
				alert("Please Select any date");
		}
	</script>
</body>
</html>
