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
    if($role != 2){
        header("location:view_products.php");
    }
}
?>
<!Doctype html>
<html>

<head>
    <title> Forms</title>
    <link rel="stylesheet" href="../css/index.css?v=<?php echo time()?>">
</head>

<body>
    <?php
        $current_page = 'product';
        include('../utils/navigation.php');
    ?>
    <form action="product.php" method="post">
        <h3>Product Registration</h3>

        <div class="form-group">
            <label for="pname">Product Name:</label>
            <input type="text" id="pname" name="productName" placeholder="Enter Product Name" pattern="[A-Za-z .]{1,50}">
        </div>
        <div class="form-group">
            <label for="brand">Brand:</label>
            <input type="text" id="brand" name="brand" placeholder="Enter the Brand" pattern="[A-Za-z .]{1,50}">
        </div>
        <div class="form-group">
            <label for="sphone">Supplier Phone:</label>
            <input type="text" id="sphone" name="supplierPhone" placeholder="Enter the Supplier Phone" pattern="[0-9]{1,20}">
        </div>
        <div class="form-group">
            <label for="supplier">Supplier:</label>
            <input type="text" id="supplier" name="supplier" placeholder="Enter the Supplier" pattern="[A-Za-z .]{1,50}">
        </div>
        <input type="submit" value="Register">
    </form>
    <?php include('../utils/footer.php');?>
</body>

</html>