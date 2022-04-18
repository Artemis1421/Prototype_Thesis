<?php 
include '../includes/config.php';
session_start(); 
 
if (isset($_POST['add_product_quantity'])&&isset($_POST['submit']) ) {

    function validation($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }

    $quantity = validation($_POST['add_product_quantity']);
    $id = $_GET['id'];
    date_default_timezone_set('Asia/Manila');
    $date = date("Y-m-d  h:i:sa");

    

    if (empty($quantity)) {
        header("Location: ../inventory/auqna.php?error=Field must not be empty");
        exit();
    }else{
        $sql = "UPDATE products SET quantity = quantity + '$quantity',  date = '$date' WHERE md5(id) = '$id'";
        $result1 = mysqli_query($conn, $sql);
    }if ( $result1 && mysqli_affected_rows($conn)  == 1) {
                unset($id);
                header("Location: ../inventory/inventory.php");
                exit();
            }else{
                header("Location: ../inventory/add_stock.php?error=Incorect data input");
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
    <div 
    class="px-6 bg-gray-200 rounded-lg w-72 " 
    id="addQuantityForm" > 
        <form class="flex flex-col p-12 space-y-1" method="post">
            <div class="mb-4">
                <?php if (isset($_GET['error'])) { ?>
                        <p class="p-2 mx-6 text-xs bg-red-400 rounded-md text-white-400"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                <h3 class="text-lg tracking-wide text-gray-600 uppercase">Add Stock</h3>
                <input class="w-full py-1 pl-2 mb-2 rounded-md" type="number" name="add_product_quantity" placeholder ="Quantity" min="0">
            </div>
            <div class="flex flex-col mt-4 space-y-2">
                <input class="text-white bg-green-500 rounded-md hover:bg-green-600"type="submit" name="submit" value="Submit">
                <a class="text-center text-white bg-red-500 rounded-md hover:bg-red-600" name="Cancel" href="inventory.php">Cancel  </a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
