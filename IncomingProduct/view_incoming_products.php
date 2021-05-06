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
    <link rel="stylesheet" href="../css/index.css?v=<?php echo time() ?>">
</head>

<body>
    <?php
    $current_page = 'inventory';
    include('../utils/navigation.php');
    if (!$con) {
        echo "<div class='error-div'><i class='far fa-times-circle'></i>" . mysqli_connect_error() . "</div>";
    } else {
        $selectQuery = "SELECT inventory_id,quantity,sti.productId as pid,sti.userId as uid,product_Name,username from stk_inventory sti INNER JOIN stk_users stu ON sti.userId=stu.userId INNER JOIN stk_products stp ON sti.productId=stp.productId";
        $result = mysqli_query($con, $selectQuery);
        if (!$result) {
            echo "<div class='error-div'><i class='far fa-times-circle'></i>Something failed." . mysqli_error($con) . "</div>";
        } else {
            if (mysqli_num_rows($result) > 0) {
                echo "<div class='table-div'><table>
                 <tr>
                    <th>Inventory Id</th> 
                    <th>Quantity</th>
                    <th>Product</th>
                    <th>Created By</th>
                    <th colspan='2'>Actions</th>
                 </tr>
               ";
                while ($rowInventory = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>" . $rowInventory['uid'] . "</td>
                            <td>" . $rowInventory['quantity'] . "</td>
                            <td>" . $rowInventory['product_Name'] . "</td>
                            <td>" . $rowInventory['username'] . "</td>
                    ";
                            if($row['userId'] == $rowInventory['uid']){
                                echo "
                                <td><a href='view_incoming_product_form.php?record=$rowInventory[inventory_id]'>Edit</a></td>
                                <td><a href='deleteIncomingProduct.php?record=$rowInventory[inventory_id]' class='delete'>Delete</a></td>";
                            }
                    echo "         
                        </tr>";
                }
                echo "</table></div>";
            } else {
                echo "
                    <div class='error-div'><i class='far fa-sad-tear'></i>No Incoming products found.</div>
               ";
            }
        }
    }
        echo "<a class='register-link' href='IncomingProductsRegistration.php'>Register An Inventory</a>";

    include('../utils/footer.php');
    ?>
</body>

</html>