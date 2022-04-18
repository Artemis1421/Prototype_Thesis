<?php 
include '../includes/config.php';
include '../records/log_insertion.php';

if (isset($_SESSION['id']) && isset($_SESSION['name'])) {

 ?>
<html lang="en">

<head>
    <title>Stocks</title>
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
                <table class="w-full h-1 px-6 mt-3 text-center border border-black table-fixed sortable">
                    <thead>
                        <tr class="text-sm tracking-wide text-gray-600 uppercase bg-gray-200 border-b border-black">
                            <th class="w-1/12 py-2">id</th>
                            <th class="w-2/12">product name</th>
                            <th class="w-2/12">quantity</th>
                            <th class="w-1/12">comments</th>
                            <th class="w-1/12">date</th>
                            <th class="w-1/12">action</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm font-light text-gray-600"
                    id="products_table">
                                <?php
                                $query  = "SELECT  s.id, s.product_id, s.quantity, s.comments, s.date, p.product_name"; // select id user_id, action
                                $query .= " FROM stock s ";
                                $query .= " LEFT JOIN products p ON s.product_id = p.id";
                                $query .= " WHERE s.product_id != 0";
                                $query .= " ORDER BY s.id ASC";
                                if ($result = mysqli_query($conn, $query)): // if connection and query is true ?> 
                                <?php  while($row =  mysqli_fetch_array($result)): //Creates a loop through results and get the table data?>    
                                        
                            <tr class= "items-center text-sm text-gray-600 border-b border-gray-400 item">
                                <td><?php echo $row['id'] ?> </td>
                                <td><?php echo $row['product_name'] ?> </td>
                                <td><?php echo $row['quantity'] ?> </td>
                                <td><?php echo $row['comments'] ?> </td>
                                <td><?php echo $row['date'] ?> </td>
                                <td class="flex items-center justify-center">
                                    <a 
                                    class="w-4 transform hover:text-green-500 hover:scale-110"
                                    href="add_notes.php?id=<?php echo md5($row['id']) ?>" >
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