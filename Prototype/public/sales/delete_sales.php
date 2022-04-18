<?php 
include '../includes/config.php';
session_start(); 
 
if (isset($_POST['delete']) ) {

    function validation($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }

    $delete = $_POST['delete'];
    $id = $_GET['id'];
    date_default_timezone_set('Asia/Manila');
    $date = date("Y-m-d  h:i:sa");

    if($delete){
        $sql = "UPDATE products SET deleted = 1 ,  date = '$date' WHERE id = '$id'";
        $result1 = mysqli_query($conn, $sql);
    }

    if ( $result1 && mysqli_affected_rows($conn)  == 1) {
                unset($id);
                header("Location: ../inventory/inventory.php");
                exit();
            }else{
                header("Location: ../inventory/auqna.php?error=Incorect data input");
                exit();
            }
    }
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sagum Farms</title>

    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="flex items-center justify-center h-screen ">
    <div class="w-72 bg-gray-200 px-6 py-4 rounded-lg " id="addQuantityForm" > 
     <form class="p-12 flex flex-col space-y-1" method="post">
            <h1 class="mt-6 text-center text-lg text-gray-600 uppercase tracking-wide">Delete Product?</h1>
            <div class="flex align-middle justify-center my-6 space-x-2">
              <input class="w-24 text-base text-white text-center bg-green-500 rounded-md hover:bg-green-600" name="delete" value="Delete" type="submit">
              <a class="w-24 text-base text-white bg-red-500 rounded-md hover:bg-red-600 text-center"  name="Cancel" href="orders.php">Cancel  </a>
            </div>
        </form>
      </div>
    </div>
  </body>
</html>


