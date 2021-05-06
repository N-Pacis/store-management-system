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
    <link rel="stylesheet" href="../css/index.css?v=<?php echo time() ?>">
</head>

<body>
    <?php
    $current_page = 'outgoing';
    include('../utils/navigation.php');
    ?>
    <form action="OutgoingProduct.php" method="post">
        <h3>Outgoing Product</h3>
        <div class="form-group">
            <label for="qty">Quantity:</label>
            <input type="text" id="qty" name="quantity" placeholder="Enter the Quantity" pattern="[0-9]{1,}">
        </div>
        <div class="form-group">
            <label for='select'>Product:</label>
            <?php
            if (!$con) {
                echo "<div class='error-div'><i class='far fa-times-circle'></i>Failed to connect due to." . mysqli_connect_error() . "</div>";
            } else {
                $selectQuery = "SELECT productId,product_Name from stk_products";
                $result = mysqli_query($con, $selectQuery);
                if (!$result) {
                    echo "<h2 style='font-size:14px;font-family:sans-serif;color:#000;display:inline-block'>Something failed:" . mysqli_error($con) . ".</h2>";
                } else {
                    if (mysqli_num_rows($result) == 0) {
                        echo "<h2 style='font-size:14px;font-family:sans-serif;color:#000;display:inline-block'>No Product found In the database.</h2>";
                    } else {
                        echo "<select name='productId' id='select'>";
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value=" . $row['productId'] . ">" . $row['product_Name'] . "</option>";
                        }
                        echo "</select>";
                    }
                }
            }
            ?>
        </div>
        <input type="submit" value="Register">
    </form>
    <?php include('../utils/footer.php'); ?>
</body>

</html>