<?php 
include '../includes/config.php';
session_start(); 
if (isset($_POST['edit_customer']) && isset($_POST['edit_paymethod']) 
	&& isset($_POST['edit_notes'])) {

	function validation($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$name = validation($_POST['edit_customer']);
	$payment = validation($_POST['edit_paymethod']);
	$notes = validation($_POST['edit_notes']);
	$id = $_GET['id'];
	date_default_timezone_set('Asia/Manila');
	$date = date("Y-m-d  h:i:sa");

	if ($notes) {
		$sql = "UPDATE orders SET notes ='$notes', date = '$date' WHERE id = '$id'";
		$result1 = mysqli_query($conn, $sql);
	}
	if ($payment) {
		$sql = "UPDATE orders SET paymethod = '$payment', date = '$date' WHERE id = '$id'";
		$result1 = mysqli_query($conn, $sql);
	}
	if ($name) {
		$sql = "UPDATE orders SET customer = '$name', date = '$date' WHERE id = '$id'";
		$result1 = mysqli_query($conn, $sql);
	}

	if ($result1 && mysqli_affected_rows($conn)  == 1) {
            	header("Location: orders.php");
		        exit();
            }else{
				header("Location: edit_orders.php?error=Incorect Data&id=".$id);
		        exit();
			}
	}

if ( isset($_POST['Cancel'])) {
	header("Location: orders.php?");
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
    <div class="flex items-center justify-center h-screen bg-gray-100">
     <div 
	    class="px-6 bg-gray-200 rounded-lg w-72" 
	    id="editForm">
	        <form class="flex flex-col p-12 space-y-1" method="post">
	            <div class="mb-4">
	            	<?php if (isset($_GET['error'])) { ?>
                    	<p class="w-full px-6 py-2 mb-2 text-xs font-semibold text-center bg-red-400 rounded-md text-white-400"><?php echo $_GET['error']; ?></p>
                    <?php } ?>
	                <h3 class="mb-2 text-lg font-semibold tracking-wide text-gray-600 uppercase">Edit Order</h3>
	                <h3 class="text-xs tracking-wide text-gray-600 uppercase">Customer Name</h3>
	                <input class="w-full py-1 mb-2 rounded-md" type="text" name="edit_customer">

	                <h3 class="text-xs tracking-wide text-gray-600 uppercase">Payment Method</h3>
	                <select class="w-full py-1 mb-2 rounded-md" name="edit_paymethod">
                        <option value="">Method</option>
                        <option value="Cash">Cash</option>
                        <option value="GCash">GCash</option>
                        <option value="Credit">Credit</option>
	                </select>

	                <h3 class="text-xs tracking-wide text-gray-600 uppercase">Notes</h3>
	                <input class="w-full py-1 mb-2 rounded-md" type="text" name="edit_notes">
	            </div>

	            <div class="flex flex-col mt-4 space-y-2">
	                <input class="text-white bg-green-500 rounded-md hover:bg-green-600" type="submit" value="Submit" name="submit">
	                <a class="text-center text-white bg-red-500 rounded-md hover:bg-red-600" href="orders.php">Cancel</a>
	            </div>
	        </form>
	    </div>
</div>
</body>
</html>

