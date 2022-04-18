<?php 
include '../includes/config.php';
include '../records/log_insertion.php';
include '../includes/pagination.php';
if (isset($_SESSION['id']) && isset($_SESSION['name'])) {

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sales</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>

    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="flex h-screen">
        <?php include_once '../includes/nav.php'?>
        
        <div class="flex flex-col w-full bg-gray-100">
            <div class="flex justify-between px-6 m-6">
                <div class="flex align-middle">
                    <input 
                    type="text" 
                    class="" 
                    name="search_id" 
                    placeholder="Search"
                    id="search_input">
                        <svg class="relative w-4 right-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                           <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                </div>
            </div>
            
            <div class="w-full px-12 overflow-auto h-5/6">
                <table class="w-full h-1 px-6 mt-3 border border-black table-fixed sortable">
                    <thead>
                        <tr class="text-sm tracking-wide text-gray-600 uppercase bg-gray-200 border-b border-black">
                            <th class="w-1/12 py-2">Order ID</th>
                            <th class="w-1/12">Product Name</th>
                            <th class="w-1/12">Quantity</th>
                            <th class="w-1/12">Total</th>
                            <th class="w-1/12">Date</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm font-light text-gray-600"
                    id="products_table">
                    <?php 
                       $results_per_page = 25; 

                       $sql = "SELECT s.order_id, s.product_id, s.qty, s.price,s.date,p.product_name FROM sales s LEFT JOIN products p ON s.product_id = p.id ";
                       $result = mysqli_query($conn, $sql);
                       $number_of_results= mysqli_num_rows($result);
                       $number_of_pages = ceil($number_of_results/$results_per_page);

                       if(!isset($_GET['page'])){
                           $page = 1;
                       }else{
                           $page = $_GET['page'];
                       }

                       $this_page_first_result = ($page-1) * $results_per_page;
                       $sql1 = "SELECT s.order_id, s.product_id, s.qty, s.price,s.date,p.product_name FROM sales s LEFT JOIN products p ON s.product_id = p.id LIMIT $this_page_first_result,$results_per_page";
                       //$sql1 .= "LIMIT 0, 3";
                       $result1 = mysqli_query($conn, $sql1);
                       if ($result1 = mysqli_query($conn, $sql1)):
                           
                       while($row = mysqli_fetch_array($result1)):
                    ?>
                        <tr class= "text-sm text-center text-gray-600 border-b border-gray-400">
                            <td class="py-1"><?php echo $row['order_id']; ?></td>
                            <td class="py-1"><?php echo $row['product_name']; ?></td>
                            <td class="py-1"><?php echo $row['qty']; ?></td>
                            <td class="py-1">₱ <?php echo $row['qty'] * $row['price']; ?></td>
                            <td class="py-1"><?php echo $row['date']; ?> </td>
                        </tr>
                    <?php endwhile; ?>
                <?php endif; ?>
                    </tbody>
                </table>
                <div class="flex justify-end py-4">
                <?php  
                    $url = 'sales.php';
                    if($number_of_pages > 1)
                      echo get_pagination_links($page,$number_of_pages,$url);    
                ?>
            </div>
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