<?php
session_start();
if(!isset($_SESSION['uname']))
{
echo "<script>window.location.href='index.php';</script>";
}
include('dbConnect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Purchase</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <style>
	*{
		font-weight:bold;
	}
	.form-control{
		font-size:15px;
		color:black;
	}
	body{
		background-color:#CBFFC2;
	}
  </style>
  </head>
<body>
<div class="container-fluid">
<?php include 'nav.php'; ?>
<?php
        include('dbConnect.php');
        $smt=$con->prepare("select distinct(item) from category order by item;");
        $smt->execute();
        $res=$smt->get_result();
?>

  <center><h2>Enter the Item</h2></center><br/>
  <form  action="fil.php" name="entryForm" method="post">
    <center>Enter the date: <input type="date" name="date" placeholder="Select date"/></center>
    <center>
      <?php
          echo "<select name=name1 onchange=getCategory(this) class=1>";
          echo "<option value=''>Select Item</option>";
          $array_values = array();
          while($row=$res->fetch_assoc()){
            $value=$row['item'];
            array_push($array_values,$value);
            echo "<option value='".$value."'>".$value."</option>";
          }
          echo "</select>";
      ?>
      <input type="text" id="aaa" name="category1" readonly="readonly" />
      <input type="text" id="qty1" onchange="addValue(this)" class="1" name="qty1" placeholder="Quantity" />
      <input type="text" id="amt1" onchange="addValue(this)" class="1" name="amt1" placeholder="Amount/Kg"/>
      <input type="text" class="1" name="total1" placeholder="Total Amount" readonly="readonly" />
  </center>
  <br>
      <center>
        <div id="dynamic_data1"></div>
      <div onclick="addForm()"  type="button" class="btn btn-success">ADD</div></center>
      <br>
      <center>
        <input type="submit" onclick="checkDate()" class="btn btn-primary"></center>
  </form>
<center><a href="homepage.php">Home</a></center>
</div>
<script>
      var counter = 2;
  function addForm(){
      var datas= <?php echo json_encode($array_values); ?>;
      for(let i=0 ; i<20 ; i++){
      node="";
      node+= '<select type="text" name="name'+counter+'" class='+counter+' onchange="getCategory(this)">';
      node+= '<option value="">Select Item</option>';
      for(let i=0;i<datas.length;i++){
        node+= '<option value='+datas[i]+'>'+datas[i]+'</option>';
      }
      node+='</select><input type="text" name="category'+counter+'" readonly="readonly" /><input type="text" id="qty'+counter+'" onchange="addValue(this)" class='+counter+' name="qty'+counter+'" placeholder="Quantity" /><input type="text" id="amt'+counter+'" onchange="addValue(this)" class='+counter+' name="amt'+counter+'" placeholder="Amount/Kg"/><input type="text" class='+counter+' name="total'+counter+'" placeholder="Total Amount" readonly="readonly"/><br><br><div id="dynamic_data'+counter+'"></div>';
      document.getElementById('dynamic_data'+(counter-1)).innerHTML += node;
      counter++;
    }
  }

  function checkDate(){
			if(!document.getElementByName("date").value)
				alert("Please Select any date");
		}

  function addValue(node){
    var itemNumber = node.className;
    console.log(itemNumber);
    var quantity=document.getElementById('qty'+itemNumber).value;
    var amount=document.getElementById('amt'+itemNumber).value;
    console.log(quantity,amount);
    document.forms["entryForm"]["total"+itemNumber].value = quantity*amount;
  }

  function getCategory(node){
    var itemNumber = node.className;
    var item = node.value;

    console.log(item,itemNumber);
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.forms["entryForm"]["category"+itemNumber].value = this.responseText;
        }
      };
      xhttp.open("POST", "category_search.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      var params = "item="+item;
      xhttp.send(params);
  }
  </script>
</body>
</html>
