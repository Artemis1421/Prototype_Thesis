<?php 
include '../includes/config.php';
session_start();

	function validation($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

$query = "SELECT id FROM products";
$result = mysqli_query($conn, $query);
if($result){
	$row = mysqli_num_rows($result);
	for ($i=1; $i < $row+1 ; $i++) { 

if (isset($_POST['add_customer']) && isset($_POST['add_payment']) && isset($_POST['order_quantity'.$i])
	&& isset($_POST['p_id'.$i])) {


	$name = validation($_POST['add_customer']);
	$payment = validation($_POST['add_payment']);
	$quantity = validation($_POST['order_quantity'.$i]);
	$p_id= validation($_POST['p_id'.$i]);
	$id = $_GET['id'];
	date_default_timezone_set('Asia/Manila');
	$date = date("Y-m-d  h:i:sa");

	
	
	if (empty($name) || empty($payment) || $quantity == 0) {
		header("Location: add_order.php?error=Fields must not be empty");
		exit();
	} if (empty($quantity)) {
		;
	} else {
		$sql = "INSERT INTO `sales`(`id`, `order_id`, `product_id`, `qty`, `price`, `date`) VALUES";
		$sql .= "( default, '$id',";
		$sql .= " '$p_id', '$quantity',";
		$sql .= " '123','$date') ";
		$result1 = mysqli_query($conn, $sql);

}
	}
	$sql = "UPDATE products SET quantity = quantity-$quantity WHERE id = $p_id";
	$result2 = mysqli_query($conn, $sql);

}
	$sql = "INSERT INTO `orders`(`id`, `customer`, `notes`, `paymethod`, `date`) VALUES";
	$sql .= "( default, '$name',";
	$sql .= " '', '$payment',";
	$sql .= " '$date') ";
	$result1 = mysqli_query($conn, $sql);
	if ($result1) {
            	header("Location: ../sales/add_order.php");
		        exit();
            }else{
				header("Location: ../sales/add_order.php?error=Incorect Data");
		        exit();
			}
}

