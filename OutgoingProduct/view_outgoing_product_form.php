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
<!Doctype html>
<html>

<head>
    <title> Forms</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/index.css?v=<?php echo time() ?>">
</head>

<body>
    <?php
    $current_page = 'inventory';
    include('../utils/navigation.php');

    if (!$con) {
        echo "<div class='error-div'><i class='far fa-times-circle'></i>" . mysqli_connect_error() . "</div>";
    } else {
        $record_id = $_GET['record'];
        $selectQuery = "SELECT * FROM stk_outgoing where outgoingId=$record_id";
        $result = mysqli_query($con, $selectQuery);
        $rowSelect = mysqli_fetch_assoc($result);
        if($rowSelect["userId"]!=$row["userId"]){
            header("location:view_outgoing_products.php");
        }
        if (!$result) {
            echo "<div class='error-div'><i class='far fa-times-circle'></i>" . mysqli_error($con) . "</div>";
        } else {
    ?>
            <form action="OutgoingProductUpdate.php" method="post">
                <h3>Outgoing Product Update</h3>
                    <input type="hidden" id="outgoing" name="outgoingId" value='<?php echo $rowSelect["outgoingId"] ?>' readonly>
                <div class="form-group">
                    <label for="qty">Quantity:</label>
                    <input type="text" id="qty" name="quantity" placeholder="Enter the Quantity" value='<?php echo $rowSelect["quantity"]?>' pattern="[0-9]{1,}">
                </div>
                <div class="form-group">
                    <label for='select'>Product:</label>
                    <?php
                    if (!$con) {
                        echo "<div class='error-div'><i class='far fa-times-circle'></i>Failed to connect due to." . mysqli_connect_error() . "</div>";
                    } else {
                        $selectQuery = "SELECT productId,product_Name from stk_products where productId =".$rowSelect['productId'];
                        $result = mysqli_query($con, $selectQuery);
                        if (!$result) {
                            echo "<h2 style='font-size:14px;font-family:sans-serif;color:#000;display:inline-block'>Something failed:" . mysqli_error($con) . ".</h2>";
                        } else {
                            if (mysqli_num_rows($result) == 0) {
                                echo "<h2 style='font-size:14px;font-family:sans-serif;color:#000;display:inline-block'>No Product found In the database.</h2>";
                            } else {
                                echo "<select name='productId' id='select'>";
                                
                                $row = mysqli_fetch_assoc($result);
                                
                                echo "<option value=" . $row['productId'] . ">" . $row['product_Name'] . "</option>";
                               
                                $selectOtherProductsQuery = "SELECT productId,product_Name from stk_products where productId !=".$rowSelect['productId'];
                               
                                $resultProducts = mysqli_query($con, $selectOtherProductsQuery);
                               
                                while($rowProducts = mysqli_fetch_assoc($resultProducts)){
                                    echo "<option value=" . $rowProducts['productId'] . ">" . $rowProducts['product_Name'] . "</option>";
                                }
                                echo "</select>";
                            }
                        }
                    } ?>
                </div>
                <input type="submit" value="Update">
            </form>
    <?php
        }
    }
    include('../utils/footer.php');
    ?>
</body>

</html>