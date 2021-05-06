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
        $current_page = 'outgoing';
        include('../utils/navigation.php');
        //get the post result from the frontend and put them in variables
        $qty = $_POST['quantity'];
        $pId = $_POST['productId'];
        $uid = $row['userId'];
        $outgoing = $_POST['outgoingId'];

        if($qty === "" || $pId === "" || $uid === ""){
            echo "<div class='error-div'><i class='far fa-times-circle'></i>All fields are required!</div>";
        }
        else{
            if(!$con){
                echo "<div class='error-div'><i class='far fa-times-circle'></i>Failed to connect due to.".mysqli_connect_error()."</div>";
            }
            else{
                $selectOutgoingQuery=mysqli_query($con,"select * from  stk_outgoing where outgoingId=$outgoing");
                $rowOutgoing = mysqli_fetch_assoc($selectOutgoingQuery);
                if($rowOutgoing['userId'] != $uid){
                    header("location:view_outgoing_products.php");
                }
                else{
                    $selectQuery = "SELECT * FROM stk_products where productId=$pId";
                    $selectResult = mysqli_query($con,$selectQuery);
                    if(!$selectResult){
                        echo "<div class='error-div'><i class='far fa-times-circle'></i>Unable to find the specified product</div>";
                    }
                    else{
                        $selectUser = "SELECT * FROM stk_users where userId=".$uid;
                        $selectUserResult = mysqli_query($con,$selectUser);
                        if(!$selectUserResult){
                            echo "<div class='error-div'><i class='far fa-times-circle'></i>Unable to find the specifiied user</div>";
                        }
                        else{
                            $updateQuery = "UPDATE stk_outgoing SET quantity='$qty',productId='$pId',userId='$uid' WHERE outgoingId=$outgoing";
                            $result = mysqli_query($con,$updateQuery);
                            if(!$result){
                                echo "<div class='error-div'><i class='far fa-times-circle'></i>Unable to update outgoing product due to.".mysqli_error($con)."</div>";
                            }
                            else{
                                echo "<div class='success-div'><i class='far fa-check-circle'></i>Updated successfully";
                                echo "<a href='view_outgoing_products.php'>View Outgoing Products</a></div>";
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