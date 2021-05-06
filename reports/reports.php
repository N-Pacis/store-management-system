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
    <link rel="stylesheet" href="../css/index.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>

<body>
    <?php
    $current_page = 'reports';
    include('../utils/navigation.php');
    ?>
    <div class="reports">
        <ol>
            <li><a href="search.php">Search User By Username.</a></li>
            <li><a href="quantities_registered.php">Total Items Registered In store.</a></li>
            <li><a href="InventoryItemsByProduct.php">Total Items By Product registered in the store.</a></li>
            <li><a href="OutgoingItemsByProduct.php">Total Items By Product taken out of the store.</a></li>
            <li><a href="quantities_taken.php">Total Items taken out of the store.</a></li>
            <li><a href="details_of_incoming.php">List of users, respective products and quantities in the store.</a></li>
            <li><a href="details_of_outgoing.php">List of users,respective products and quantities products outgoing.</a></li>
            <li><a href="userLoginDetails.php">User Login Information.</a></li>
        </ol>
    </div>
    <?php
    include('../utils/footer.php');
    ?>
</body>

</html>