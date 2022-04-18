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
        $sql = "UPDATE categories SET deleted = 1 WHERE md5(id) = '$id'";
        $result1 = mysqli_query($conn, $sql);
    }

    if ( $result1 && mysqli_affected_rows($conn)  == 1) {
                header("Location: ../inventory/category.php");
                exit();
            }else{
                header("Location: ../inventory/delete_cetegory.php?error=Incorect data input");
                exit();
            }
    }

if ( isset($_POST['Cancel'])) {
    header("Location: inventory.php?");
    exit();
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
    <div class="px-6 bg-gray-200 rounded-lg w-72 " id="addQuantityForm" > 
     <form class="flex flex-col p-12 space-y-1" method="post">
            <h1 class="mt-6 text-lg font-semibold tracking-wide text-left text-gray-600 uppercase">Delete Category?</h1>
            <div class="flex flex-col justify-center my-6 space-y-2 align-middle">
              <input class="w-full text-base text-center text-white bg-green-500 rounded-md hover:bg-green-600" name="delete" value="Delete" type="submit">
              <a class="w-full text-base text-center text-white bg-red-500 rounded-md hover:bg-red-600"  name="Cancel" href="category.php">Cancel  </a>
            </div>
        </form>
      </div>
    </div>
  </body>
</html>


