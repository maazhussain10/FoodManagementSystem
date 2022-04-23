<?php
session_start();
include('dbConnect.php');
$smt=$con->prepare("insert INTO category (item, category) SELECT item,category FROM purchase WHERE (item,category) NOT IN (SELECT item,category FROM category);");
$smt->execute();
$smt=$con->prepare("update dispatch, category SET dispatch.category = category.category where dispatch.item = category.item;");
$smt->execute();
echo "<script>window.alert('Category Updated Successfully');</script>";
echo "<script>window.location.href='category.php';</script>";
?>
