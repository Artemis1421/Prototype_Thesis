<?php 
include '../includes/config.php';
session_start(); 
if (isset($_POST['edit_quantity_add']) && isset($_POST['edit_quantity_rem'])) {

	function validation($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$add = validation($_POST['edit_quantity_add']);
	$rem = validation($_POST['edit_quantity_rem']);
	$id = $_GET['id'];
	$p_id = $_GET['p_id'];
	$o_id = $_GET['o_id'];
	date_default_timezone_set('Asia/Manila');
	$date = date("Y-m-d  h:i:sa");

	if ($add) {
		$sql = "UPDATE sales SET qty = qty +'$add', date = '$date' WHERE id = '$id'";
		$result1 = mysqli_query($conn, $sql);
		$query = "UPDATE products SET quantity = quantity - '$add' WHERE id = '$p_id'";
		$result2 = mysqli_query($conn, $query);
	}
	if ($rem) {
		$sql = "UPDATE sales SET qty = qty - '$rem', date = '$date' WHERE id = '$id'";
		$result1 = mysqli_query($conn, $sql);
		$query = "UPDATE products SET quantity = quantity + '$rem' WHERE id = '$p_id'";
		$result2 = mysqli_query($conn, $query);
	}

	if ($result1 && mysqli_affected_rows($conn)  == 1) {
            	header("Location: order_view.php?id=$o_id");
		        exit();
            }else{
				header("Location: edit_view_order.php?error=Incorect Data&id=$id&p_id=$p_id&o_id=$o_id");
		        exit();
			}
	}

if ( isset($_POST['Cancel'])) {
	header("Location: order_view.php?");
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
	    class="px-6 bg-gray-200 rounded-lg w-72" 
	    id="editForm">
	        <form class="flex flex-col p-12 space-y-1" method="post">
	            <div class="mb-4">
	            	<?php if (isset($_GET['error'])) { ?>
                    <p class="p-2 mx-6 text-xs bg-red-400 rounded-md text-white-400"><?php echo $_GET['error']; ?></p>
                    <?php } ?>
	                <h3 class="text-lg font-semibold tracking-wide text-gray-600 uppercase">Edit Order Quantity</h3><br>

	                <?php
	                	$p_id = $_REQUEST['p_id'];
	                	$sql = "SELECT quantity FROM products WHERE id = '$p_id'";
	                	$result = mysqli_query($conn, $sql);
	                	$row = mysqli_fetch_array($result);
	                	$quantity = $row['quantity'];
	                 ?>

	                <h3 class="text-xs tracking-wide text-gray-600 uppercase">Add Quantity</h3>
	                <input class="w-full py-1 mb-2 rounded-md" type="number" name="edit_quantity_add" min="0" max="<?php echo $quantity; ?>">

	                <h3 class="text-xs tracking-wide text-gray-600 uppercase">Minus Quantity</h3>
	                <input class="w-full py-1 mb-2 rounded-md" type="number" name="edit_quantity_rem" min="0" max="<?php echo $_REQUEST['qty']; ?>">
	            </div>

	            <div class="flex flex-col mt-4 space-y-2">
	               	<input class="text-white bg-green-500 rounded-md hover:bg-green-600" type="submit" value="Submit" name="submit">
	              	<a class="text-center text-white bg-red-500 rounded-md hover:bg-red-600" href="order_view.php?id=<?php echo $_REQUEST['o_id'];?>">Cancel</a>
	            </div>
	        </form>
	    </div>
</div>
</body>
</html>