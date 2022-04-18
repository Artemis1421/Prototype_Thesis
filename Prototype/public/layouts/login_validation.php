<?php 
include '../includes/config.php';
session_start(); 
 
if (isset($_POST['admin_username']) && isset($_POST['admin_password'])) {

	function validation($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$admin_username = validation($_POST['admin_username']);
	$admin_password = validation($_POST['admin_password']);

	if (empty($admin_username) || empty($admin_password)) {
		header("Location: login.php?error=User Name and Password is required");
	    exit();
	}else{
		$pass =  md5($admin_password);
		$sql = "SELECT * FROM users WHERE username='$admin_username' AND password='$pass'";

		$result = mysqli_query($conn, $sql);
		
		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['username'] === $admin_username && $row['password'] === $pass) {
            	$_SESSION['username'] = $row['username'];
            	$_SESSION['name'] = $row['name'];
            	$_SESSION['id'] = $row['id'];
            	header("Location: ../dashboard/dashboard.php");
		        exit();
            }else{
				header("Location: login.php?error=Incorect User name or password");
		        exit();
			}
		}else{
			header("Location: login.php?error=Incorect User name or password");
	        exit();
		}
	}
	
}else{
	header("Location: login.php");
	exit();
}
