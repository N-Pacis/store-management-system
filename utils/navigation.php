<?php
if(!$_SESSION['user'] or $_SESSION['user']==""){
    header('location:../user/loginForm.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <?php include('navigationStyle.php');?>
    <title>Document</title>
</head>

<body>
    <nav>
        <h2>STORE SYSTEM</h2>
        <input type="checkbox" name="checkbox" id="check">
        <label for="check"><i class="fas fa-bars"></i></label>
        <ul class="nav-links">
            <li class="nav-item"><a href="../user/view_users.php" class="<?php echo $current_page == 'user'? 'active':'';?>">Users</a></li>
            <li class="nav-item"><a href="../product/view_products.php" class="<?php echo $current_page == 'product'? 'active':'';?>">Products</a></li>
            <li class="nav-item"><a href="../IncomingProduct/view_incoming_products.php" class="<?php echo $current_page == 'inventory'? 'active':'';?>">Inventory</a></li>
            <li class="nav-item"><a href="../OutgoingProduct/view_outgoing_products.php" class="<?php echo $current_page == 'outgoing'? 'active':'';?>">Outgoing</a></li>
            <li class="nav-item"><a href="../reports/reports.php" class="<?php echo $current_page == 'reports'? 'active':'';?>">Reports</a></li>
        </ul>
        <div class="display-username"><a href="../user/view_full_user.php"><h2><?php echo $_SESSION['user']?></h2></a><a href="../user/logoutHandler.php"><i class="fas fa-sign-out-alt"></a></i>
</div>
    </nav>
</body>

</html>