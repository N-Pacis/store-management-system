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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/index.css?v=<?php echo time() ?>">
</head>
<body>
<?php
  $current_page = 'product';
  include('../utils/navigation.php');
 if (!$con) {
     echo "<div class='error-div'><i class='far fa-times-circle'></i>".mysqli_connect_error()."</div>";
 }
 else{
    $record_id = $_GET['record'];
    $selectQuery = "SELECT * FROM stk_products where productId=$record_id";
    $result = mysqli_query($con,$selectQuery);
    $row = mysqli_fetch_assoc($result);
    if(!$result){
       "<div class='error-div'><i class='far fa-times-circle'></i>".mysqli_error($con)."</div>";
    }
    else{
        echo ('
            <form action="productUpdate.php" method="post">
                <h3>Product Update</h3>
                    <input type="hidden" id="pid" name="productId" value='.$record_id.' readonly>
                <div class="form-group">
                    <label for="pname">Product Name:</label>
                    <input type="text" id="pname" name="productName" placeholder="Enter Product Name" value='.$row["product_Name"].' pattern="[A-Za-z .]{1,50}">
                </div>
                <div class="form-group">
                    <label for="brand">Brand:</label>
                    <input type="text" id="brand" name="brand" placeholder="Enter the Brand" value='.$row["brand"].' pattern="[A-Za-z .]{1,50}">
                </div>
                <div class="form-group">
                    <label for="sphone">Supplier Phone:</label>
                    <input type="text" id="sphone" name="supplierPhone" placeholder="Enter the Supplier Phone" value='.$row["supplier_phone"].' pattern="[0-9]{1,20}">
                </div>
                <div class="form-group">
                    <label for="supplier">Supplier:</label>
                    <input type="text" id="supplier" name="supplier" placeholder="Enter the Supplier" value='.$row["supplier"].' pattern="[A-Za-z .]{1,50}">
                </div>
                <input type="submit" value="Update">
            </form>
        ');
    }
 }
 include('../utils/footer.php');
?>
</body>

</html>