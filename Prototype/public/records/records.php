<?php 
include '../includes/config.php';
include '../records/log_insertion.php';
if (isset($_SESSION['id']) && isset($_SESSION['name'])) {

 ?>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>

    <link rel="stylesheet" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>

</head>

<body>

    <div class="flex h-screen">
        <?php include_once '../includes/nav.php'?>
        <?php include_once '../includes/config.php'?>
        
        <div class="flex flex-col w-full bg-gray-100">
            <div class="flex justify-between p-6 mx-6 mt-6">
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

            </div>

            <div class="w-full px-12 overflow-auto h-5/6">
                <table class="w-full h-1 px-6 mt-3 text-center border border-black table-fixed sortable">
                    <thead>
                        <tr class="text-sm tracking-wide text-gray-600 uppercase border-b border-black ">
                            <th class="w-1/12">Product ID</th>
                            <th class="w-2/12">Product Name</th>
                            <th class="w-1/12">Category</th>
                            <th class="w-1/12">Available</th>
                            <th class="w-1/12">Sale Price</th>
                            <th class="w-1/12">Quantity</th>
                            <th class="w-1/12">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm font-light text-gray-600"
                    id="products_table">
                        <!--PHP OPEN TAG-->
                          
                            <?php
                                    //need alis and left join to get name of products and categories to selsect names  
                                $query  = "SELECT p.id,p.product_name,p.quantity,p.sale_price,p.category_id,p.date,c.name"; //c.name to get the gategory name 
                                $query .= " FROM products p";
                                $query .= " LEFT JOIN categories c ON p.category_id = c.id";
                                $query .= " ORDER BY p.id ASC";
                                
                                if ($result = mysqli_query($conn, $query)): // if connection and query is true 
                                    while($row =  mysqli_fetch_array($result)): //Creates a loop through results and get the table data?>    
                                        
                            <tr class= "items-center text-sm text-gray-600 border-b border-gray-400 item">
                                <td><?php echo $row['id'] ?> </td>
                                <td><?php echo $row['product_name'] ?> </td>
                                <td><?php echo $row['name'] ?> </td>
                                <td><?php echo $row['quantity'] ?> </td>
                                <td><?php echo $row['sale_price'] ?> </td>
                                <td><input type="number" class="py-1" min="0" step="1"></td>

                                <td class="flex items-center justify-center space-x-2 align-middle">
                                    <a 
                                    class="w-4 transform hover:text-green-500 hover:scale-110"
                                    href="auqna.php?id=<?php echo md5($row['id']) ?>"
                                    > 
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                        </svg>
                                    </a>

                                    <a 
                                    class="w-4 transform hover:text-green-500 hover:scale-110"
                                    href="edit_products.php?id=<?php echo md5($row['id']) ?>" 
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                        </svg>
                                    </a>

                                    <button 
                                    class="w-4 transform hover:text-green-500 hover:scale-110"
                                    onclick="openDelete()">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>

                                   <div 
                                    class="absolute z-10 hidden bg-gray-200 rounded-lg bottom-12 right-12 w-72" 
                                    id="deleteForm">
                                      <h1 class="mt-6 text-lg tracking-wide text-center text-gray-600 uppercase">Delete Product?</h1>
                                      <div class="flex justify-center my-6 space-x-2 align-middle">
                                        <button class="w-24 text-base text-white bg-green-500 rounded-md hover:bg-green-600"
                                        >Delete</button>
                                        <button class="w-24 text-base text-white bg-red-500 rounded-md hover:bg-red-600" 
                                        onclick="closeDelete()"> Cancel </button>
                                      </div>
                                    </div>
                                </td>
                            </tr>

                            <?php endwhile; ?>
                        <?php endif; ?>
                        <!--PHP CLOSE TAG-->
                    </tbody>
                </table>
            </div>

        </div>

    </div>

</body>
<script src="../js/functions.js"></script>
</html>
<?php
}else{
     header("Location: ../index.php");
     exit();
}
 ?>