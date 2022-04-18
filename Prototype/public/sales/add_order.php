<?php 
include '../includes/config.php';
include '../records/log_insertion.php';
if (isset($_SESSION['id']) && isset($_SESSION['name'])) {

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Order</title>
    <link rel="stylesheet" href="../styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>
</head>
<body>
            <?php

                $query = "SELECT * FROM orders";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if (mysqli_num_rows($result) == null){
                    $order_id = 101;
                }else{
                    $query = "SELECT id FROM orders ORDER BY id DESC LIMIT 1";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $order_id = $row['id'] + 1;
                }
            ?>
<form method="post" action="add_order_validation.php?id=<?php echo $order_id?>">
    <div class="flex h-screen">
        <?php include_once '../includes/nav.php'?>
        
        <div class="flex flex-col w-full bg-gray-100">
            <div class="flex justify-between px-6 m-6">
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
                    
                <div class="flex items-center justify-end space-x-4">
                    <div class="flex align-middle">
                        <input 
                            class="" 
                            type="text" 
                            name="add_customer"
                            placeholder="Customer Name"
                            required>
                                <svg class="relative w-4 right-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                    </div>
                    <select 
                        class="" 
                        name="add_payment" required>
                        <option value="">Payment Method</option>
                        <option value="Cash">Cash</option>
                        <option value="GCash">GCash</option>
                        <option value="Credit">Credit</option>
                    </select>

                    <h1 class="text-lg tracking-wide text-gray-600 uppercase">
                        <?php
                                echo "ORDER# ".$order_id;
                        ?>
                    </h1>
                </div>
            </div>

            
            <div class="w-full px-12 overflow-auto h-5/6">
                <table class="w-full h-1 px-6 mt-3 text-center border border-black table-fixed">
                    <thead>
                        <tr class="text-sm tracking-wide text-gray-600 uppercase bg-gray-200 border-b border-black">
                            <th class="w-1/12 py-2">Product ID</th>
                            <th class="w-1/12">Product Name</th>
                            <th class="w-1/12">Category</th>
                            <th class="w-1/12">Available</th>
                            <th class="w-2/12">Quantity</th>
                            <th class="w-1/12">Price</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm font-light text-gray-600"
                    id="products_table">
                    <?php
                            //need alis and left join to get name of products and categories to selsect names  
                        $query  = "SELECT p.id,p.product_name,p.quantity,p.sale_price,p.category_id,p.date,p.deleted,c.name"; //c.name to get the gategory name 
                        $query .= " FROM products p";
                        $query .= " LEFT JOIN categories c ON p.category_id = c.id";
                        $query .= " WHERE p.deleted != 1";
                        $query .= " ORDER BY p.id ASC";
                      if ($result = mysqli_query($conn, $query)): // if connection and query is true 
                      $i=1;
                      ?> 
                    <?php  while($row =  mysqli_fetch_array($result)): //Creates a loop through results and get the table data?>                                        
                            <tr class= "items-center text-sm text-gray-600 border-b border-gray-400 item">
                                <td><?php echo $row['id'] ?> 
                                    <input type="hidden" name="p_id<?php echo $i;?>" value="<?php echo $row['id']; ?>">
                                </td>
                                <td><?php echo $row['product_name'] ?> </td>
                                <td><?php echo $row['name'] ?> </td>
                                <td><?php echo $row['quantity'] ?> </td>
                                <td>
                                    <input class="py-1 w-48" type="number" name="order_quantity<?php echo $i;?>" placeholder="Product Quantity" min="0" max="<?php echo $row['quantity'] ?>">
                                </td>
                                <td>
                                    <input class="py-2 pl-4 text-center bg-gray-100 border-none" type="text" name="add_price<?php echo $i++; ?>" value="<?php echo $row['sale_price']; ?>" disabled> 
                                </td>
                            </tr>
                            
                    <?php endwhile; ?>
                <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="flex justify-end p-6 mx-6 mt-2">
                <input 
                type="submit"
                class="px-4 py-2 text-white bg-green-500 rounded-lg hover:bg-green-600"
                name="submit" 
                value="Submit Order">
            </div>
        </div>
    </div>
</form>
</body>
<script src="../js/functions.js"></script>
</html>
<?php
}else{
     header("Location: ../index.php");
     exit();
}
 ?>