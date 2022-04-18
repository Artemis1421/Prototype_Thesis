<?php 
include '../includes/config.php';
session_start(); 
 
if (isset($_POST['edit_category'])&&isset($_POST['submit']) ) {

    function validation($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }

    $name = validation($_POST['edit_category']);
    $id = $_GET['id'];
    date_default_timezone_set('Asia/Manila');
    $date = date("Y-m-d  h:i:sa");

    
        $sql = "UPDATE categories SET name = '$name' WHERE md5(id) = '$id'";
        $result1 = mysqli_query($conn, $sql);
    if ( $result1 && mysqli_affected_rows($conn)  == 1) {
                unset($id);
                header("Location: ../inventory/category.php");
                exit();
            }else{
                header("Location: ../inventory/add_note.php?error=Incorect data input");
                exit();
            }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="flex items-center justify-center h-screen bg-gray-100">
        <div class="px-6 bg-gray-200 rounded-lg w-72">
            <form class="flex flex-col p-12 space-y-1" method="post">
                <div class="mb-4">
                    <?php if (isset($_GET['error'])) { ?>
                        <p class="p-2 mx-6 text-xs bg-red-400 rounded-md text-white-400"><?php echo $_GET['error']; ?></p>
                    <?php } ?>
                    <h1 class="text-xs tracking-wide text-gray-600 uppercase">Edit Category</h1>
                    <input class="w-full py-1 mb-2 rounded-lg" type="text" name="edit_category" required>
                </div>

                <div class="flex flex-col mt-4 space-y-2">
                    <input class="text-white bg-green-500 rounded-md hover:bg-green-600" type="submit" value="Submit" name="submit">
	                <a class="text-center text-white bg-red-500 rounded-md hover:bg-red-600" href="category.php">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>