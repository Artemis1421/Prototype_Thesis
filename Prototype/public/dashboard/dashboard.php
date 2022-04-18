<?php 
include'../includes/config.php';
include '../records/log_insertion.php';
if (isset($_SESSION['id']) && isset($_SESSION['username'])) {

 ?>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script type="text/javascript" src="../js/systemTime.js"></script>
    <title>Dashboard</title>

    <link rel="stylesheet" href="styles.css">
</head>

<body onLoad="initClock()">
    <div class="flex h-screen">
        <?php include_once '../includes/nav.php'?>
        
        <div class="flex flex-col w-full px-12 bg-gray-100">
            <div class="flex h-16 my-6 justify-left">
                <div class="text-2xl font-semibold text-gray-700">
                    <a id="mon">January</a>
                    <a id="d">1</a>,
                    <a id="y">0</a><br />
                    <a id="h">12</a> :
                    <a id="m">00</a> :
                    <a id="s">00</a>
                    <a class="hidden" id="mi">000</a>
                    <a class="uppercase" id="stamp">AM</a>
                </div>
            </div>

            <div class="flex h-full">
                <div class="flex w-full space-x-16">
                    <div class="flex flex-col w-1/4">
                        <h1 class="pb-4 text-lg font-bold">Most Popular Product</h1>
                        <table class="w-full border border-black">
                            <thead class="border-b border-black">
                                <tr class="text-xs font-semibold text-center uppercase bg-gray-200">
                                    <th class="w-1/6 py-2">Product</th>
                                    <th class="w-1/6">Total Sold</th>
                                    <th class="w-1/6">Sales</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600">
                                <?php 
                                    $sql = "SELECT p.product_name, sum(s.qty),s.qty,s.price from sales s left JOIN products p on s.product_id = p.id group by p.product_name order by sum(s.qty) desc LIMIT 5";
                                    if ($result = mysqli_query($conn, $sql)):   
                                        while($row = mysqli_fetch_array($result)):
                                 ?>
                                <tr class="text-center border-b border-gray-400">
                                    <td class="w-1/6"><?php echo $row['product_name']; ?></td>
                                    <td class="w-1/6"><?php echo $row['sum(s.qty)']; ?></td>
                                    <td class="w-1/6">₱ <?php echo $row['sum(s.qty)'] * $row['price']; ?></td>
                                </tr>
                                <?php endwhile; ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="flex flex-col w-2/6">
                        <h1 class="pb-4 text-lg font-bold">Latest Sales</h1>
                        <table class="w-full border border-black">
                            <thead class="border-b border-black">
                                <tr class="text-xs font-semibold text-center uppercase bg-gray-200">
                                    <th class="w-1/12 py-2">ID</th>
                                    <th class="w-1/12">Product</th>
                                    <th class="w-1/12">Date</th>
                                    <th class="w-1/12">Total Sale</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600">
                                  <?php 
                                    $sql = "SELECT s.order_id, s.product_id, s.qty, s.price,s.date,p.product_name FROM sales s LEFT JOIN products p ON s.product_id = p.id ORDER by s.order_id DESC LIMIT 20";
                                    if ($result = mysqli_query($conn, $sql)):   
                                        while($row = mysqli_fetch_array($result)):
                                 ?>
                                <tr class="text-center border-b border-gray-400">
                                    <td class="w-1/12"><?php echo $row['order_id'] ?></td>
                                    <td class="w-1/12"><?php echo $row['product_name'] ?></td>
                                    <td class="w-1/12"><?php echo $row['date'] ?></td>
                                    <td class="w-1/12">₱ <?php echo $row['qty'] * $row['price']?></td>
                                </tr>
                                <?php endwhile; ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="flex flex-col w-1/4">
                        <h1 class="pb-4 text-lg font-bold">Low on Stock Product</h1>
                        <table class="w-full border border-black">
                            <thead class="border-b border-black">
                                <tr class="text-xs font-semibold text-center uppercase bg-gray-200">
                                    <th class="w-1/6 py-2">id</th>
                                    <th class="w-1/6">Product</th>
                                    <th class="w-1/6">quantity</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600">
                                <?php
                                    $query  = "SELECT  s.id, s.product_id, s.quantity,p.product_name";
                                    $query .= " FROM stock s ";
                                    $query .= " LEFT JOIN products p ON s.product_id = p.id";
                                    $query .= " WHERE s.quantity <= 1800 and s.product_id !=0";
                                    $query .= " ORDER BY s.id ASC";
                                    if ($result = mysqli_query($conn, $query)): // if connection and query is true ?> 
                                <?php  while($row =  mysqli_fetch_array($result)): //Creates a loop through results and get the table data?> 
                                <tr class="text-center border-b border-gray-400">
                                    <td class="w-1/6"><?php echo $row['id'] ?></td>
                                    <td class="w-1/6"><?php echo $row['product_name'] ?></td>
                                    <td class="w-1/6"><?php echo $row['quantity'] ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
                    
            </div>
        </div>
    </div>
</body>

</html>
<?php 
}else{
     header("Location: ../index.php");
     exit();
}
 ?>
