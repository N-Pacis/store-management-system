<?php
session_start();
require_once '../utils/connection.php';
if(!isset($_SESSION['user'])){
    header('location:loginForm.php');
}
else{
    require_once '../utils/connection.php';
    $user = $_SESSION['user'];
    $selectQuery = mysqli_query($con,"Select * from stk_users where username='$user'");
    $row = mysqli_fetch_assoc($selectQuery);
    $role = $row['role'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/index.css?v=<?php echo time();?>">
    <title>Document</title>
</head>

<body>
    <?php
        $current_page='reports';
        include('../utils/navigation.php');
    ?>
    <h2 class='search-user'>Search a user by username</h2>
    <div class='search-div'>
        <form action='searchUser.php' method='post' class='search-form'>
            <div class='form-group'>
                <label for='uname'>User Name:</label>
                <input type='text' id='uname' name='username' placeholder='Enter User Name'>
                <input type='submit' value='Search'>
            </div>
        </form>
    </div>
    <?php 
    include('../utils/footer.php');
    ?>
</body>

</html>