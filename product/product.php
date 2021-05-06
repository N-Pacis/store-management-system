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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/index.css?v=<?php echo time() ?>">
    <title>Product</title>
</head>
<body>
    <?php 
         $current_page = 'product';
         include('../utils/navigation.php');
        //get the post result from the frontend and put them in variables
        $pname = $_POST['productName'];
        $brand = $_POST['brand'];
        $sphone = $_POST['supplierPhone'];
        $supplier = $_POST['supplier'];
        $user_id = $row["userId"];

        if($pname === "" || $brand === "" ||  $sphone === "" || $supplier === ""){
            echo "<div class='error-div'><i class='far fa-times-circle'></i>All fields are required!</div>";
        }
        else{
            if(!$con){
                echo "<div class='error-div'><i class='far fa-times-circle'></i>Failed to connect due to.".mysqli_connect_error()."</div>";

            }
            else{
                //register a user
                $insertQuery = "INSERT INTO stk_products(product_Name,brand,supplier_phone,supplier,userId) values('$pname','$brand','$sphone','$supplier',$user_id)";
                $result = mysqli_query($con,$insertQuery);
                if(!$result){
                    echo "<div class='error-div'><i class='far fa-times-circle'></i>Unable to register user due to.".mysqli_error($con)."</div>";
                }
                else{
                    echo "<div class='success-div'><i class='far fa-check-circle'></i>Registered successfully";
                    echo "<br><a href='view_products.php'>View Products</a></div>";
                }
            }
        }
        include('../utils/footer.php');
    ?>
</body>
</html>