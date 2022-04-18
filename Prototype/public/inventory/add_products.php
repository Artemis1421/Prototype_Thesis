<?php 
include '../includes/config.php';
session_start(); 
if (isset($_POST['add_product_name']) && isset($_POST['add_product_category']) 
	&& isset($_POST['add_product_quantity']) && isset($_POST['add_product_price']) &&isset($_POST['submit'])) {

	function validation($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$name = validation($_POST['add_product_name']);
	$category = validation($_POST['add_product_category']);
	$quantity = validation($_POST['add_product_quantity']);
	$price = validation($_POST['add_product_price']);
	date_default_timezone_set('Asia/Manila');
	$date = date("Y-m-d  h:i:sa");

	$query = "SELECT product_name FROM products WHERE product_name = '$name'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);
	$dbname = $row['product_name'];
	
	if ($dbname == $name){
		$sql = "UPDATE products SET deleted = 0 WHERE product_name = '$name'";
	}
	elseif (empty($name) || empty($category) || empty($quantity) || empty($price)) {
		header("Location: inventory.php?error=Fields must not be empty");
		        exit();
	}else{
		$sql = "INSERT INTO products (`id`, `product_name`, `quantity`, `sale_price`, `category_id`, `date`,`deleted`) VALUES";
		$sql .= "( default, '$name',";
		$sql .= " '$quantity', '$price',";
		$sql .= " '$category', '$date', 0) ";
}
	if (mysqli_query($conn, $sql)) {
		$last_id = mysqli_insert_id($conn);
		$query = "INSERT INTO stock (`id`,`product_id`,`quantity`,`date`) VALUES (default, '$last_id','$quantity','$date ')";
		$result1 = mysqli_query($conn, $query);
            	header("Location: ../inventory/inventory.php");
		        exit();
            }else{
				header("Location: inventory.php?error=Incorect Data");
		        exit();
			}
	}

if ( isset($_POST['Cancel'])) {
	header("Location: inventory.php?");
	exit();
}
