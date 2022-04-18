<?php 
include '../includes/config.php';
include '../records/log_insertion.php';
include '../includes/pagination.php';
if (isset($_SESSION['id']) && isset($_SESSION['name'])) {

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Orders</title>
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
            </div>
            
            <div class="w-full px-12 overflow-auto h-5/6">
                <table class="w-full h-1 px-6 mt-3 border border-black table-fixed">
                    <thead>
                        <tr class="text-sm tracking-wide text-gray-600 uppercase bg-gray-200 border-b border-black">
                            <th class="w-1/12 py-2">Order ID</th>
                            <th class="w-1/12">Customer</th>
                            <th class="w-1/12">Payment Method</th>
                            <th class="w-1/12">Notes</th>
                            <th class="w-1/12">Date</th>
                            <th class="w-1/12">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm font-light text-gray-600" 
                    id="products_table">
                        <?php
                            $results_per_page = 25;
                            $sql = "SELECT * FROM orders";
                            if ($result = mysqli_query($conn, $sql)):
                                $result = mysqli_query($conn, $sql);
                                $number_of_results= mysqli_num_rows($result);
                                $number_of_pages = ceil($number_of_results/$results_per_page);

                        if(!isset($_GET['page'])){
                            $page = 1;
                        }else{
                            $page = $_GET['page'];
                        }
                        
                        $this_page_first_result = ($page-1) * $results_per_page;  
                        $sql1 = "SELECT * FROM orders ORDER BY id DESC LIMIT $this_page_first_result,$results_per_page";
                        $result1 = mysqli_query($conn, $sql1);
                        while($row = mysqli_fetch_array($result1)):
                        ?>


                        <tr class= "text-sm text-center text-gray-600 border-b border-gray-400">
                            <td class="py-1 font-semibold text-green-500">
                                <a class="hover:text-gray-600" href="../sales/order_view.php?id=<?php echo $row['id']?>"> <?php echo $row['id']; ?> </a>
                            </td>
                            <td class="py-1"><?php echo $row['customer']; ?></td>
                            <td class="py-1"><?php echo $row['paymethod']; ?></td>
                            <td class="py-1"><?php echo $row['notes']; ?></td>
                            <td class="py-1"><?php echo $row['date']; ?></td>
                            <td class="flex justify-center py-1">
                                <a 
                                class="w-4 transform hover:text-green-500 hover:scale-110"
                                onclick="openEdit()"
                                href="edit_orders.php?id=<?php echo $row['id'] ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                        <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
                <div class="flex justify-end py-4">
                <?php  
                    $url = 'orders.php';
                    if($number_of_pages > 1)
                        echo get_pagination_links($page,$number_of_pages,$url);    
                ?>
                </div>
            </div>
        </div>
    </div>
</body>
<script language="JavaScript" type="text/javascript" src="../js/functions.js"></script>
</html>
<?php
}else{
     header("Location: ../index.php");
     exit();
}
 ?>
