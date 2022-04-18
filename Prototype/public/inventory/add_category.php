<?php 
include '../includes/config.php';
session_start(); 
if (isset($_POST['add_category_name'])  &&isset($_POST['submit'])) {

	function validation($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$name = validation($_POST['add_category_name']);

	if (empty($name)) {
		header("Location: category.php?");
		$error = 'error=Fields must not be empty';
		        exit();
	}
		$query = "SELECT name FROM categories WHERE name = '$name'";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_array($result);
		$dbname = $row['name'];
		if ($dbname == $name){
			$sql = "UPDATE categories SET deleted = 0 WHERE name = '$name'";

		} else {

		$sql = "INSERT INTO categories (`id`, `name`, `deleted`) VALUES";
		$sql .= "( default, '$name', 0)";

		}

	if (mysqli_query($conn, $sql)) {
            	header("Location: ../inventory/category.php");
		        exit();
            }else{
				header("Location: category.php?error=Incorect Data");
		        exit();
			}
	}

if ( isset($_POST['Cancel'])) {
	header("Location: category.php?");
	exit();
}
