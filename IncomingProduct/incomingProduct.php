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
        $uid = $row['userId'];

        if($qty === "" || $pId === "" || $uid ===""){
            echo "<div class='error-div'><i class='far fa-times-circle'></i>All fields are required!</div>";
        }
        else{
            if(!$con){
                echo "<div class='error-div'><i class='far fa-times-circle'></i>Failed to connect due to.".mysqli_connect_error()."</div>";
            }

            else{
                $selectQuery = "SELECT * FROM stk_products where productId=$pId";
                $selectResult = mysqli_query($con,$selectQuery);

                if(!$selectResult){
                    echo "<div class='error-div'><i class='far fa-times-circle'></i>Unable to find the specified product</div>"; 
                }

                else{
                    $selectUser = "SELECT * FROM stk_users where userId=$uid";
                    $selectUserResult = mysqli_query($con,$selectUser);

                    if(!$selectUserResult){
                        echo "<div class='error-div'><i class='far fa-times-circle'></i>Unable to find the specified user</div>"; 
                    }

                    else{
                        $insertQuery = "INSERT INTO stk_inventory(quantity,productId,userId) values('$qty','$pId','$uid')";
                        $result = mysqli_query($con,$insertQuery);

                        if(!$result){
                            echo "<div class='error-div'><i class='far fa-times-circle'></i>Unable to register incoming product due to.".mysqli_error($con)."</div>";
                        }

                        else{
                            echo "<div class='success-div'><i class='far fa-check-circle'></i>Registered successfully";
                            echo "<a href='view_incoming_products.php'>View Incoming Products</a></div>";
                        }
                    }
                }
                
            }
        }
       
        include('../utils/footer.php');
    ?>
</body>
</html>