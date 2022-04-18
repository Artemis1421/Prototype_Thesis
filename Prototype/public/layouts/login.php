<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sagum Farms</title>

    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="flex items-center justify-center h-screen ">
        <div class="w-1/6 bg-gray-200 px-6 py-12 rounded-md">
            <form
            class="flex flex-col space-y-5"
            action="login_validation.php"
            method="post">
                <?php if (isset($_GET['error']))?>
                <input 
                class="p-2 mx-6 text-xs rounded-md outline-none focus:ring-2 focus:ring-green-500"
                type="text" name="admin_username" placeholder="Username">
                <input 
                class="p-2 mx-6 text-xs rounded-md outline-none focus:ring-2 focus:ring-green-500"
                type="password" name="admin_password" placeholder="Password">
                <input
                class="p-2 mx-12 text-xs rounded-md hover:bg-green-600 hover:text-white"
                type="submit" value="Login">
            </form>
        </div>
    </div>
    
</body>
</html>
