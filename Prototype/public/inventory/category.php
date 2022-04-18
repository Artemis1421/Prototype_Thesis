<?php 
include '../includes/config.php';
include '../records/log_insertion.php';
if (isset($_SESSION['id']) && isset($_SESSION['name'])) {

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Category</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>  
    
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="flex h-screen bg-gray-100">
        <?php
            include_once '../includes/nav.php';
        ?>

        <div class="flex flex-col w-full">
            <div class="flex justify-between p-6 mx-6">
                <div class="flex align-middle">
                    <input 
                    class="" 
                    type="text" 
                    name="search_id" 
                    placeholder="Search"
                    id="search_input">
                        <svg class="relative w-4 right-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                </div>
 
                <div>
                    <button 
                    class="px-6 py-1 text-white bg-green-500 rounded-lg" 
                    onclick="openAdd()">Add</button>
 
                    <div 
                    class="absolute z-10 hidden bg-gray-200 rounded-lg bottom-12 right-12 w-72" 
                    id="addForm">
                        <form class="flex flex-col w-full p-12 space-y-1" method="post" action="add_category.php">
                            <div class="mb-4 space-y-4">
                                <h3 class="text-xs tracking-wide text-gray-600 uppercase">Category Name</h3>
                                <input class="w-full py-1 rounded-md" type="text" name="add_category_name" required>
                            </div>
 
                            <div class="flex w-full px-4 space-x-2">
                                <input 
                                class="w-1/2 text-white bg-green-500 rounded-md hover:bg-green-600" 
                                type="submit" 
                                value="Submit" 
                                name="submit">
                                <button 
                                class="w-1/2 text-white bg-red-500 rounded-md hover:bg-red-600" 
                                name="Cancel" 
                                onclick="closeAdd()"> Cancel </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="w-full px-12 overflow-auto h-5/6">
                <table class="w-full h-1 px-6 mt-3 border border-black table-fixed sortable">
                    <thead>
                        <tr class="text-sm tracking-wide text-gray-600 uppercase bg-gray-200 border-b border-black">
                            <th class="w-1/6 py-2">Category ID</th>
                            <th class="w-1/4">Category Name</th>
                            <th class="w-1/4">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm font-light text-gray-600"
                    id="products_table">
                    <?php 
                        $sql = "SELECT * FROM categories WHERE deleted != 1 ORDER BY id ";

                        if ($result = mysqli_query($conn, $sql)):
                            while ($row = mysqli_fetch_array($result)):
                     ?>
                        <tr class="items-center text-sm text-center text-gray-600 border-b border-gray-400 item">
                            <td class=""><?php echo $row['id'] ?></td>
                            <td class=""><?php echo $row['name'] ?></td>

                            <td class="flex items-center justify-center h-6 space-x-2">
                                <a 
                                class="w-4 transform hover:text-green-500 hover:scale-110"
                                href="edit_category.php?id=<?php echo md5($row['id'])?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                        <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                    </svg>
                                </a>

                                <a
                                class="w-4 transform hover:text-green-500 hover:scale-110"
                                href="delete_cetegory.php?id=<?php echo md5($row['id'])?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script src="../js/functions.js"></script>
<script>
function openAdd(){
    document.getElementById("addForm").style.display = "block";
}

function closeAdd(){
    document.getElementById("addForm").style.display = "none";
}
</script>
</html>

<?php
}else{
     header("Location: ../index.php");
     exit();
}
 ?>