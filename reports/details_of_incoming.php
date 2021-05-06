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
    if($role != 1){
         header("location:reports.php");
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
    <title>Document</title>
</head>
<body>
    <?php
           $current_page='reports';
           include('../utils/navigation.php');
           if(!$con){
               echo "Failed to connect due to.".mysqli_connect_error();
           }
           else{
                $searchQuery = "SELECT usr.firstName,usr.lastName,usr.email,usr.username,prod.product_Name,prod.brand,prod.supplier,prod.supplier_phone,inv.quantity from stk_inventory inv INNER JOIN stk_users usr on inv.userId=usr.userId INNER JOIN stk_products prod on inv.productId=prod.productId";
                $result = mysqli_query($con,$searchQuery);
                if(!$result){
                    echo "Failed to search due to ".mysqli_error($con);
                }
                else{
                    if(mysqli_num_rows($result)>0){
                        echo "<div class='table-div'><table>
                                <tr>
                                    <th>First Name</th> 
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Username</th> 
                                    <th>Product Name</th>
                                    <th>Product Brand</th>
                                    <th>Supplier</th> 
                                    <th>Supplier Phone</th>
                                    <th>Quantity</th>
                                </tr>
                            ";
                        while($row=mysqli_fetch_assoc($result)){
                            echo "<tr>
                                    <td>".$row['firstName']."</td>
                                    <td>".$row['lastName']."</td>
                                    <td>".$row['email']."</td>
                                    <td>".$row['username']."</td>
                                    <td>".$row['product_Name']."</td>
                                    <td>".$row['brand']."</td>
                                    <td>".$row['supplier']."</td>
                                    <td>".$row['supplier_phone']."</td>
                                    <td>".$row['quantity']."</td>
                                </tr>";
                        }
                        echo "</table></div>";
                        echo "<br><a href='reports.php' class='register-link'>Back to Reports?</a>";
                    }
                    else{
                        echo "<div class='error-div'><i class='far fa-sad-tear'></i>No product found in the database.<br><a href='reports.php' class='register-link'>Back to Reports?</a></div>";
                    }
                }
           }
           include('../utils/footer.php');
    ?>
</body>
</html>