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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.0.37/jspdf.plugin.autotable.js"></script> 
    <link rel="stylesheet" href="../styles.css">
</head>
<title>Daily Sales</title>
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

                <div class="flex align-middle">
                    <form action="" method="post"
                    class="space-x-2">
                        <input 
                        class=""
                        type="date"
                        name="date_id">
                        <input 
                        type="submit"
                        class="px-4 py-1 text-white bg-green-500 rounded-lg hover:bg-green-600" name="submit">
                    </form>
                </div>
            </div>

            <div class="w-full px-12 overflow-auto h-5/6">
                <table class="w-full h-1 px-6 mt-3 border border-black table-fixed sortable" id="table_with_data">
                    <thead>
                       <tr class="text-sm tracking-wide text-gray-600 uppercase bg-gray-200 border-b border-black">
                            <th class="w-2/12">Product</th>
                            <th class="w-2/12">Category</th>
                            <th class="w-2/12">Quantity</th>
                            <th class="w-2/12">Total</th>
                            <th class="w-2/12">Date</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm font-light text-gray-600"  id="products_table">
                        <?php 
                        $results_per_page = 25;
                            if (isset($_POST['date_id'])){
                                $date = $_POST['date_id'];
                                $dayformat = date("d", strtotime($date));
                                $formatDate = date("Y-m-".intval($dayformat), strtotime($date));
        
                                $sql1  = "SELECT sum(s.qty),";
                                $sql1 .= " DATE_FORMAT(s.date, '%Y-%m-%e') AS date,p.product_name,";
                                $sql1 .= " SUM(p.sale_price * s.qty) AS total_selling_price, c.name";
                                $sql1 .= " FROM sales s";
                                $sql1 .= " LEFT JOIN products p ON s.product_id = p.id";
                                $sql1 .= " LEFT JOIN categories c ON c.id = p.category_id";
                                $sql1 .= " WHERE DATE_FORMAT(s.date, '%Y-%m-%e' ) = '$formatDate'";
                                $sql1 .= " GROUP BY DATE_FORMAT( s.date,  '%e' ),s.product_id";        
                                $total=0;
                                $date;
                                if($result1 = mysqli_query($conn, $sql1)):
                                while($row = mysqli_fetch_array($result1)):
                                    $total +=$row['total_selling_price'];
                                    $date= $row['date'];
                                    ?>
                        <tr class="items-center text-sm text-center text-gray-600 border-b border-gray-400">
                            <td><?php echo $row['product_name']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['sum(s.qty)']; ?></td>
                            <td>₱ <?php echo $row['total_selling_price']; ?></td>
                            <td><?php echo $row['date']; ?></td>
                        </tr>
                    <?php endwhile;?>
                        <tr class="items-center text-sm text-center text-gray-600 border-b border-gray-400">
                            <td>TOTAL SELLING PRICE</td>
                            <td></td>
                            <td></td>
                            <td>₱ <?php echo $total;?></td>
                            <td><?php echo $date;?></td>
                        </tr>
                    <button
                        type="submit"
                        class="px-4 py-1 text-white bg-green-500 rounded-lg hover:bg-green-600" onclick="generatePDF()">Export to PDF</button>
                <?php endif; }?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</body>
<script src="../js/functions.js"></script>
<script src="../js/export.js"></script>
</html>
<?php
}else{
     header("Location: ../index.php");
     exit();
}
 ?>