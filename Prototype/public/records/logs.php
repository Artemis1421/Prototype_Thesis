<?php 
include '../includes/config.php';
include '../includes/pagination.php';
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['name'])) {

?>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Logs</title>

    <link rel="stylesheet" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>

</head>

<body>

    <div class="flex h-screen">
        <?php include_once '../includes/nav.php'?>
        <?php include_once '../includes/config.php'?>
        
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
                <table class="w-full h-1 px-6 py-1 mt-3 text-center border border-black table-fixed sortable">
                    <thead class="bg-gray-200">
                        <tr class="text-sm tracking-wide text-gray-600 uppercase border-b border-black">
                            <th class="w-1/12 py-2">ID</th>
                            <th class="w-2/12">USER</th>
                            <th class="w-1/12">ACTION</th>
                            <th class="w-1/12">DATE</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm font-light text-gray-600"
                    id="products_table">
                                <?php
                                $remove =  array('.php','_','?error=','%20user%20name%20does%20not%20match',
                                                'Fields%20must%20not%20be%20empty','Invalid','Incorect%20data%20input',
                                                'Incorect%20Data', '?id=', 'New%20username%20does%20not%20match',
                                                'New%20password%20does%20not%20match','Incorect','?','=');
                                
                                $results_per_page = 25;
                                $sql  = "SELECT  l.id, l.user_id, l.action, l.date, u.name"; 
                                $sql .= " FROM log l ";
                                $sql .= " LEFT JOIN users u ON l.user_id = u.id";
                                $sql .= " ORDER BY l.id DESC";
                                $result = mysqli_query($conn,$sql);
                                $number_of_results= mysqli_num_rows($result);
                                $number_of_pages = ceil($number_of_results/$results_per_page);
                
                                if(!isset($_GET['page'])){
                                    $page = 1;
                                }else{
                                    $page = $_GET['page'];
                                }
                
                                $this_page_first_result = ($page-1) * $results_per_page;
                                            
                
                                $query  = "SELECT  l.id, l.user_id, l.action, l.date, u.name"; // select id user_id, action
                                $query .= " FROM log l ";
                                $query .= " LEFT JOIN users u ON l.user_id = u.id";
                                $query .= " ORDER BY l.id DESC LIMIT $this_page_first_result , $results_per_page";
                                //$query .=  "LIMIT" . $this_page_first_result . ",". $results_per_page;
                                $result1 = mysqli_query($conn, $query);
                                if ($result1 = mysqli_query($conn, $query)):?> 
                                <?php  while($row =  mysqli_fetch_array($result1)):
                                    
                                 ?>     
                                        
                            <tr class= "items-center text-sm text-gray-600 border-b border-gray-400 item">
                                <td><?php echo $row['id'] ?> </td>
                                <td><?php echo $row['name'] ?> </td>
                                <td><?php echo str_replace($remove," ",$row['action']) ?> </td>
                                <td><?php echo $row['date'] ?> </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <div class="flex justify-end py-4">
                <?php  
                    $url = 'logs.php';
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