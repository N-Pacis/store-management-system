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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/index.css?v=<?php echo time() ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
           $current_page = 'product';
           include('../utils/navigation.php');
          //get the post result from the frontend and put them in variables
          $pid = $_POST['productId'];
          $pname = $_POST['productName'];
          $brand = $_POST['brand'];
          $sphone = $_POST['supplierPhone'];
          $supplier = $_POST['supplier'];
  
          if($pname === "" || $brand === "" ||  $sphone === "" || $supplier === ""){
              echo "<div class='error-div'><i class='far fa-times-circle'></i>All fields are required!</div>";
          }
          else{
              if(!$con){
                  echo "<div class='error-div'><i class='far fa-times-circle'></i>Failed to connect due to.".mysqli_connect_error()."</div>";
              }
              else{
                $updateQuery ="UPDATE stk_products set product_Name='$pname',brand='$brand',supplier_phone='$sphone',supplier='$supplier' WHERE productId=$pid";
                $result = mysqli_query($con,$updateQuery);
                if(!$result){
                    echo "<div class='error-div'><i class='far fa-times-circle'></i>Unable to update user due to.".mysqli_error($con)."</div>";
                }
                else{
                    echo "<div class='success-div'><i class='far fa-check-circle'></i>Updated successfully<br>";
                    echo "<a href='view_products.php'>View Products</a></div>";
                }
            }
          }
          include('../utils/footer.php');
    ?>
</body>
</html>