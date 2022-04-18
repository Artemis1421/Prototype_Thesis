<?php 
include '../includes/config.php';
session_start(); 
if (isset($_POST['add_product_name']) && isset($_POST['add_product_category']) 
	&& isset($_POST['add_product_quantity']) && isset($_POST['add_product_price']) &&isset($_POST['submit'])) {

	function validation($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$name = validation($_POST['add_product_name']);
	$category = validation($_POST['add_product_category']);
	$quantity = validation($_POST['add_product_quantity']);
	$price = validation($_POST['add_product_price']);
	$id = $_GET['id'];
	date_default_timezone_set('Asia/Manila');
	$date = date("Y-m-d  h:i:sa");

	if ($quantity) {
		$sql = "UPDATE products SET quantity ='$quantity', date = '$date' WHERE md5(id) = '$id'";
		$result1 = mysqli_query($conn, $sql);
	}
	if ($category) {
		$sql = "UPDATE products SET category_id = '$category', date = '$date' WHERE md5(id) = '$id'";
		$result1 = mysqli_query($conn, $sql);
	}
	if ($price ) {

		$sql = "UPDATE products SET sale_price = '$price', date = '$date' WHERE md5(id) = '$id'";
		$result1 = mysqli_query($conn, $sql);
	}
	if ($name) {

		$sql = "UPDATE products SET product_name = '$name', date = '$date' WHERE md5(id) = '$id'";
		$result1 = mysqli_query($conn, $sql);
	}

	if ($result1 && mysqli_affected_rows($conn)  == 1) {
            	header("Location: ../inventory/inventory.php");
		        exit();
            }else{
				header("Location: inventory.php?error=Incorect Data");
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
	    class="px-6 bg-gray-200 rounded-lg w-80" 
	    id="editForm">
	        <form class="flex flex-col p-12 space-y-1" method="post">
	            <div class="mb-4">
	            	<?php if (isset($_GET['error'])) { ?>
                    <p class="p-2 mx-6 text-xs bg-red-400 rounded-md text-white-400"><?php echo $_GET['error']; ?></p>
                    <?php } ?>
	                <h3 class="text-lg font-semibold tracking-wide text-gray-600 uppercase">Edit product</h3><br>
	                <h3 class="text-xs tracking-wide text-gray-600 uppercase">Product Name</h3>
	                <input class="w-full py-1 mb-2 rounded-md" type="text" name="add_product_name">

	                <h3 class="text-xs tracking-wide text-gray-600 uppercase">Category</h3>
	                <select class="w-full py-1 mb-2 rounded-md" name="add_product_category">
	                			<option value=""> Select Category</option>
                                 <?php 
                                        $sql = "SELECT * FROM categories WHERE deleted != 1 ORDER BY id";

                                        if ($result = mysqli_query($conn, $sql)):
                                            while ($row = mysqli_fetch_array($result)):
                                     ?>
                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                                </select>

	                <h3 class="text-xs tracking-wide text-gray-600 uppercase">Quantity</h3>
	                <input class="w-full py-1 mb-2 rounded-md" type="number" name="add_product_quantity">

	                <h3 class="text-xs tracking-wide text-gray-600 uppercase">Sale Price</h3>
	                <input class="w-full py-1 mb-2 rounded-md" type="number" step="any" name="add_product_price">
	            </div>

	            <div class="flex flex-col mt-4 space-y-2">
	                <input class="text-white bg-green-500 rounded-md hover:bg-green-600" type="submit" value="Submit" name="submit">
	                <button class="text-white bg-red-500 rounded-md hover:bg-red-600" name="Cancel" 
	                onclick="closeAdd()"> Cancel </button>
	            </div>
	        </form>
	    </div>
</div>
</body>
</html>

