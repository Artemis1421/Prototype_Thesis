<?php 
include '../includes/config.php';
session_start(); 
$user_id = 0;
$remote_ip = 0;
$action =  '';
$date = date("Y-m-d");

if (isset( $_SESSION['id'] )) {
	$user_id = $_SESSION['id'];
}
if ( isset($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
	$remote_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	if ( strpos( $remote_ip, "," ) > 0 ) {
		$remote_ip_for = explode( ",", $remote_ip );
		$remote_ip = $remote_ip_for[0];
	}
} else {

	if (isset( $_SERVER['REMOTE_ADDR'] )) {
		$remote_ip = $_SERVER['REMOTE_ADDR'];
	}

}

if (isset( $_SERVER['REQUEST_URI'] )) {
	$action = $_SERVER['REQUEST_URI'];
	$action = preg_replace('/^.+[\\\\\\/]/', '', $action);
	//$action = preg_replace('/^\/inventory/', '', $action);
}

$sql  = "INSERT INTO log (user_id,remote_ip,action,date)";
$sql .= " VALUES ('{$user_id}','{$remote_ip}','{$action}','{$date}')";

$result = mysqli_query($conn, $sql);