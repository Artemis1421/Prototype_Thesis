<?php 
include '../includes/config.php';
session_start(); 
if (isset($_POST['oldUsername']) && isset($_POST['newUsername']) 
    && isset($_POST['confirmUsername']) && isset($_POST['submit'])) {

    function validation($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }

    $oldName = validation($_POST['oldUsername']);
    $newName = validation($_POST['newUsername']);
    $confirm = validation($_POST['confirmUsername']);
    $id = $_GET['id'];
    date_default_timezone_set('Asia/Manila');
    $date = date("Y-m-d  h:i:sa");

    if ( $newName != $confirm) {
        header("Location: ../users/settings.php?error=New username does not match");
        exit();
    }
    $query = "SELECT username FROM users where id = $id";
    $result1 = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result1);
    $dbname  = $row['username'];
    if($oldName == $dbname) {
        $sql = "UPDATE users SET username ='$newName', last_login = '$date' WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_affected_rows($conn)  == 1) {
                header("Location: ../users/logout.php");
                exit();
            }else{
                header("Location: settings.php?error=Incorect Data");
                exit();
            }
        } else {
            header("Location: settings.php?error=Incorect Data");
            exit();
        }

    }

?>