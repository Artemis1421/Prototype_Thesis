<?php 
include '../includes/config.php';
session_start(); 
if (isset($_POST['oldPassword']) && isset($_POST['newPassword']) 
    && isset($_POST['confirmPassword']) && isset($_POST['submit'])) {

    function validation($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }

    $oldPass = validation($_POST['oldPassword']);
    $newPass = validation($_POST['newPassword']);
    $confirm = validation($_POST['confirmPassword']);
    $id = $_GET['id'];
    date_default_timezone_set('Asia/Manila');
    $date = date("Y-m-d  h:i:sa");

    if ( $newPass != $confirm) {
        header("Location: ../users/settings.php?error=New password does not match");
        exit();
    }
    $query = "SELECT password FROM users where id = $id";
    $result1 = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result1);
    $dbpass = $row['password'];
    $oldcon = md5($oldPass);

    if ($oldcon == $dbpass){
        $hash = md5($newPass);
        $sql = "UPDATE users SET password ='$hash', last_login = '$date' WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_affected_rows($conn)  == 1) {
                    header("Location: ../users/logout.php");
                    exit();
                }else{
                    header("Location: settings.php?error=Incorect Data");
                    exit();
                }
            }else {
                header("Location: settings.php?error=Incorect Data");
                exit();
            }
    }



?>