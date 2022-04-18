<?php 
include '../includes/config.php';
include '../records/log_insertion.php';
if (isset($_SESSION['id']) && isset($_SESSION['username'])) {

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="flex h-screen bg-gray-100">
        <?php 
        include_once '../includes/nav.php';
        ?>

        <div class="flex flex-col items-start p-6 border-r w-72">
            <?php if (isset($_GET['error'])) { ?>
                <p class="w-48 px-2 py-2 text-xs font-semibold bg-red-400 rounded-md text-white-400"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <h2 class="mt-8 text-xs font-semibold tracking-wide text-gray-600 uppercase ">Account</h2>
            <div class="mt-4 space-y-2">
                <button type="button"
                onclick="openUser()"> Change Username
                </button>
                <button type="button"
                onclick="openPass()"> Change Password
                </button>
            </div>

            <div 
            class="absolute top-0 bottom-0 hidden w-3/4 p-12 space-y-4 left-1/4"
            id="userWindow">
            <form method="post" action="edit_username.php?id=<?php echo $_SESSION['id']?>"
            class="space-y-2"> 
                <div>
                    <h2 class="text-xs font-semibold tracking-wide text-gray-600 uppercase">Old Username</h2>
                    <input type="text" name="oldUsername"
                    class="w-48 py-1 bg-gray-200 border-none rounded-md" required>
                </div>
                <div>
                    <h2 class="text-xs font-semibold tracking-wide text-gray-600 uppercase">New Username</h2>
                    <input type="text" name="newUsername" placeholder="" 
                    class="w-48 py-1 bg-gray-200 border-none rounded-md" required>
                </div>
                <div>
                    <h2 class="text-xs font-semibold tracking-wide text-gray-600 uppercase">Confirm New Username</h2>
                    <input type="text" name="confirmUsername" placeholder="" 
                    class="w-48 py-1 bg-gray-200 border-none rounded-md" required>
                </div>
                <button type="submit"
                class="w-48 px-4 py-2 text-white bg-green-500 rounded-md hover:bg-green-600" name="submit">
                Change Username</button> 
            </form> 
            </div>

            <div 
            class="absolute top-0 bottom-0 hidden w-3/4 p-12 space-y-4 left-1/4"
            id="passWindow">
            <form action="edit_password.php?id=<?php echo $_SESSION['id']?>" method="post"
            class="space-y-2">
                <div>
                    <h2 class="text-xs font-semibold tracking-wide text-gray-600 uppercase">Old Password</h2>
                    <input type="password" name="oldPassword" placeholder="" id=""
                    class="w-48 py-1 bg-gray-200 border-none rounded-md" required>
                </div>
                <div>
                    <h2 class="text-xs font-semibold tracking-wide text-gray-600 uppercase">New Password</h2>
                    <input type="password" name="newPassword" placeholder="" id=""
                    class="w-48 py-1 bg-gray-200 border-none rounded-md" required>
                </div>
                <div>
                    <h2 class="text-xs font-semibold tracking-wide text-gray-600 uppercase">Confirm New Password</h2>
                    <input type="password" name="confirmPassword" placeholder="" id=""
                    class="w-48 py-1 bg-gray-200 border-none rounded-md" required>
                </div>

                <button type="submit"
                class="w-48 px-4 py-2 text-white bg-green-500 rounded-md hover:bg-green-600" name="submit">
                    Change Password</button>
            </form>
            
            </div>
        </div>
    </div>

<script>
function openUser(){
    document.getElementById('userWindow').style.display = "block";
    document.getElementById('passWindow').style.display = "none";
}

function closeUser(){
    document.getElementById('userWindow').style.display = "none";
}

function openPass(){
    document.getElementById('passWindow').style.display = "block";
    document.getElementById('userWindow').style.display = "none";
}

function closePass(){
    document.getElementById('passWindow').style.display = "none";
}
</script>
    
</body>
</html>
<?php
}else{
     header("Location: ../index.php");
     exit();
}
 ?>