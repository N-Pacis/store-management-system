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
    <link rel="stylesheet" href="../css/index.css?v=<?php echo time() ?>">
    <title>Product</title>
</head>
<body>
    <?php 
        $current_page = 'inventory';
        include('../utils/navigation.php');
        //get the post result from the frontend and put them in variables
        $qty = $_POST['quantity'];
        $pId = $_POST['productId'];
        $uId = $row['userId'];
        $inventory = $_POST['inventoryId'];

        if($qty === "" || $pId === "" || $uId === ""){
            echo "<div class='error-div'><i class='far fa-times-circle'></i>All fields are required!</div>";
        }
        else{
            if(!$con){
                echo "<div class='error-div'><i class='far fa-times-circle'></i>Failed to connect due to.".mysqli_connect_error()."</div>";
            }
            else{
                $selectInventoryQuery=mysqli_query($con,"select * from  stk_inventory where inventory_id=$inventory");
                $rowInventory = mysqli_fetch_assoc($selectInventoryQuery);
                if($rowInventory['userId']!=$uId){
                    header("location:view_incoming_products.php");
                }
                else{
                   $selectQuery = "SELECT * FROM stk_products where productId=$pId";
                    $selectResult = mysqli_query($con,$selectQuery);
                    if(!$selectResult){
                        echo "<div class='error-div'><i class='far fa-times-circle'></i>Unable to find the specified product</div>";
                    }
                    else{
                        $selectUser = "SELECT * FROM stk_users WHERE userId=".$uId;
                        $selectUserResult = mysqli_query($con,$selectUser) or die (mysqli_error($con));
                        if(mysqli_num_rows($selectUserResult) < 1){
                            echo "<div class='error-div'><i class='far fa-times-circle'></i>Unable to find the specified user</div>";
                        }
                        else{
                            $updateQuery = "UPDATE stk_inventory SET quantity='$qty',userId='$uId',productId='$pId' WHERE inventory_id=$inventory";
                            $result = mysqli_query($con,$updateQuery);
                            if(!$result){
                                echo "<div class='error-div'><i class='far fa-times-circle'></i>Unable to update incoming product due to.".mysqli_error($con)."</div>";
                            }
                            else{
                                echo "<div class='success-div'><i class='far fa-check-circle'></i>Updated successfully";
                                echo "<a href='view_incoming_products.php'>View Incoming Products</a></div>";
                            }
                        }
                    }
                }
                
            }
        }
        include('../utils/footer.php');
    ?>
</body>
</html>