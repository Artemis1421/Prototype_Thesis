<?php 
include '../includes/config.php';
include '../records/log_insertion.php';
if (isset($_SESSION['id']) && isset($_SESSION['name'])) {

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Orders</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>
    <title>Document</title>

    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="flex h-screen">
        <?php include_once '../includes/nav.php'?>
        
        <div class="flex flex-col w-full bg-gray-100">
            <div class="flex justify-between px-6 m-6">
                <div class="flex align-middle">
                    <input 
                    class="py-2 pl-4" 
                    type="text" 
                    name="search_id" 
                    placeholder="Search"
                    id="search_input">
                        <svg class="relative w-4 right-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                           <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                </div>

                <div class="flex items-center">
                    <?php
                    $o_id = $_GET['id']; ?>
                    <h1 class="pl-2 text-lg font-medium tracking-wide text-gray-600 uppercase">ORDER # <?php echo$o_id; ?></h1>

                </div>
            </div>

            <div class="flex justify-start px-12 space-x-32 text-base font-medium tracking-wide text-gray-600 uppercase">
                    <div class="flex space-x-6 ">
                        <div class="flex flex-col">
                            <?php 
                            $o_id = $_GET['id'];
                            $sql = "SELECT customer, notes, paymethod, date FROM orders WHERE id = '$o_id'";
                            $result1 = mysqli_query($conn, $sql);
                            if ($result1):
                            $row = mysqli_fetch_assoc($result1);

                             ?>
                            <h1>Customer:</h1>
                            <h1>Payment Method:</h1>
                        </div>
                        <div class="flex flex-col">
                            <h1><?php echo $row['customer']; ?></h1>
                            <h1><?php echo $row['paymethod'] ?></h1>
                        </div>
                    </div>

                    <div class="flex space-x-6">
                        <div class="flex flex-col">
                            <h1>Date:</h1>
                            <h1>Notes:</h1>
                        </div>
                        <div class="flex flex-col">
                            <h1><?php echo $row['date']; ?></h1>
                            <h1><?php echo $row['notes']; ?></h1>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="w-full px-12 overflow-auto h-5/6">
                <table class="w-full h-1 px-6 mt-3 border border-black table-fixed sortable">
                    <thead>
                        <tr class="text-sm tracking-wide text-gray-600 uppercase border-b border-black">
                            <th class="w-1/12">Order ID</th>
                            <th class="w-1/12">Product Name</th>
                            <th class="w-1/12">Quantity</th>
                            <th class="w-1/12">Price</th>
                            <th class="w-1/12">Total</th>
                            <th class="w-1/12">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm font-light text-gray-600" id="products_table">
                        <?php 
                        $query = "SELECT s.id,s.order_id, s.product_id, s.qty, s.price,p.product_name FROM sales s INNER JOIN products p ON s.product_id = p.id WHERE order_id = '$o_id'";
                            
                        if ($result = mysqli_query($conn, $query)):
                        while($row =  mysqli_fetch_array($result)): ?>

                        <tr class= "text-sm text-center text-gray-600 border-b border-gray-400">
                            <td class="py-1 font-semibold">
                                <p><?php echo $row['order_id'] ?></p></td>
                            <td class="py-1"><?php echo $row['product_name'] ?></td>
                            <td class="py-1"><?php echo $row['qty'] ?></td>
                            <td class="py-1">₱ <?php echo $row['price'] ?></td>
                            <td class="py-1">₱ <?php echo $row['price'] * $row['qty'] ?></td>
                            <td class="flex justify-center py-1">
                               <a 
                                class="w-4 transform hover:text-green-500 hover:scale-110"
                                 href="edit_view_order.php?id=<?php echo $row['id']?>&p_id=<?php echo$row['product_id']?>&o_id=<?php echo$row['order_id']?>&qty=<?php echo $row['qty']?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                        <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                    </svg>
                                </a>

                                <a 
                                class="w-4 transform hover:text-green-500 hover:scale-110"
                                href="delete_order_view.php?id=<?php echo $row['qty']?>&p_id=<?php echo$row['product_id']?>&s_id=<?php echo $row['id'] ?>&o_id=<?php echo$row['order_id']?>" 
                                >
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
</html>
<?php
}else{
     header("Location: ../index.php");
     exit();
}
 ?>