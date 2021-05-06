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
    $current_page = 'outgoing';
    include('../utils/navigation.php');
    if (!$con) {
        echo "<div class='error-div'><i class='far fa-times-circle'></i>" . mysqli_connect_error() . "</div>";
    } else {
        $selectQuery = "SELECT outgoingId,quantity,sto.productId as pid,sto.userId as uid,product_Name,username from stk_outgoing sto INNER JOIN stk_users stu ON sto.userId=stu.userId INNER JOIN stk_products stp ON sto.productId=stp.productId";
        $result = mysqli_query($con, $selectQuery);
        if (!$result) {
            echo "<div class='error-div'><i class='far fa-times-circle'></i>Something failed." . mysqli_error($con) . "</div>";
        } else {
            if (mysqli_num_rows($result) > 0) {
                echo "<div class='table-div'><table>
                 <tr>
                    <th>Outgoing Id</th> 
                    <th>Quantity</th>
                    <th>Product</th>
                    <th>Created By</th>
                    <th colspan='2'>Actions</th>
                 </tr>
               ";
                while ($rowOutgoing = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>" . $rowOutgoing['outgoingId'] . "</td>
                            <td>" . $rowOutgoing['quantity'] . "</td>
                            <td>" . $rowOutgoing['product_Name'] . "</td>
                            <td>" . $rowOutgoing['username'] . "</td>
                    ";
                            if($row['userId'] == $rowOutgoing['uid']){
                                echo "
                                <td><a href='view_outgoing_product_form.php?record=$rowOutgoing[outgoingId]'>Edit</a></td>
                                <td><a href='deleteOutgoingProduct.php?record=$rowOutgoing[outgoingId]' class='delete'>Delete</a></td>";
                            }
                    echo "        
                        </tr>";
                }
                echo "</table></div>";
            } else {
                echo "
                    <div class='error-div'><i class='far fa-sad-tear'></i>No Outgoing products found. Register one?</div>
               ";
            }
        }
    }
    echo "<a class='register-link' href='OutgoingProductsRegistration.php'>Register An Outgoing Product</a>";
    include('../utils/footer.php');
    ?>
</body>

</html>