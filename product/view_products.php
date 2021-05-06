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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/index.css?v=<?php echo time() ?>">
</head>
<body>
<?php  
   $current_page="product"; 
   include('../utils/navigation.php');
   if (!$con) {
       echo "<div class='error-div'><i class='far fa-times-circle'></i>".mysqli_connect_error()."</div>";
   }
   else{
       $selectQuery = "SELECT * from stk_products stp INNER JOIN stk_users stu ON stp.userId = stu.userId ";
       $result = mysqli_query($con,$selectQuery);
       if(!$result){
           echo "<div class='error-div'><i class='far fa-times-circle'></i>Failed to fetch products.".mysqli_error($con)."</div>";
       }
       else{
           if(mysqli_num_rows($result)>0){
               echo "<div class='table-div'><table>
                 <tr>
                    <th>Product Id</th> 
                    <th>Product Name</th>
                    <th>Brand</th>
                    <th>Supplier phone</th>
                    <th>Supplier</th>
                    <th>Created By</th>
               ";
                    if($role==2){
                       echo "
                        <th>Edit</th>
                        <th>Delete</th>";
                    }
                 echo "
                 </tr>
               ";
               while($row=mysqli_fetch_assoc($result)){
                   echo "<tr>
                            <td>".$row['productId']."</td>
                            <td>".$row['product_Name']."</td>
                            <td>".$row['brand']."</td>
                            <td>".$row['supplier_phone']."</td>
                            <td>".$row['supplier']."</td>
                            <td>".$row['username']."</td>
                   ";
                            if($role==2){
                                echo "
                                <td><a href='view_product_form.php?record=$row[productId]'>Edit</a></td>
                                <td><a href='deleteProduct.php?record=$row[productId]' class='delete'>Delete</a></td>";
                            }
                            echo "
                        </tr>";
               }
               echo "</table></div>";
           }
           else{
               echo "
                    <div class='error-div'><i class='far fa-sad-tear'></i>No products found</div>
               ";
           }
       }
   }
   if($role==2){
       echo "<a class='register-link' href='ProductRegistration.php'>Register A Product</a>";
   }
   include('../utils/footer.php');
?>
</body>
</html>