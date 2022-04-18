<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sagum Farms</title>

    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="flex flex-col items-center justify-center h-screen ">
    <h1 class="pb-12 font-bold tracking-wider text-gray-800 uppercase text-7xl">Sagum <br> Farms</h1>
        <div class="w-1/6 px-6 py-12 bg-gray-800 rounded-md">
            <form
            class="flex flex-col space-y-5"
            action="login_validation.php"
            method="post">
                <input 
                class="p-2 mx-6 text-xs rounded-md"
                type="text" name="admin_username" placeholder="Username">
                <input 
                class="p-2 mx-6 text-xs rounded-md"
                type="password" name="admin_password" placeholder="Password">
                <input
                class="p-2 mx-12 text-xs font-semibold rounded-md hover:bg-green-600 hover:text-white"
                type="submit" value="Login">
            </form>
        </div>
        <?php if (isset($_GET['error'])) { ?>
                <p class="px-6 py-4 mt-6 text-xs text-red-700 bg-red-400 rounded-md"><?php echo $_GET['error']; ?></p>
        <?php } ?>
    </div>
    
</body>
</html>
