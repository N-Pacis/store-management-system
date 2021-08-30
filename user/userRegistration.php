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
        header("location:view_users.php");
    }
}
?>
<!Doctype html>
<html>

<head>
    <title> Forms</title>
    <link rel="stylesheet" href="../css/index.css?v=<?php echo time()?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/index.css?v=<?php echo time() ?>">
</head>

<body>
    <form action="user.php" method="post" enctype="multipart/form-data">
        <h3>User Registration</h3>

        <div class="form-group">
            <label for="fname">First Name:</label>
            <input type="text" id="fname" name="firstName" placeholder="Enter First Name" pattern="[A-Za-z .]{1,50}">
        </div>
        <div class="form-group">
            <label for="lname">Last Name:</label>
            <input type="text" id="lname" name="lastName" placeholder="Enter Last Name" pattern="[A-Za-z .]{1,50}">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" placeholder="Enter your email" pattern=".{1,100}">
        </div>
        <div class="form-group">
            <label for="tel">Telephone:</label>
            <input type="text" id="tel" name="telephone" placeholder="Enter your Telephone number" pattern="[0-9]{1,20}">
        </div>
        <div class="form-group">
            <label for="">Gender:</label>
            <input type="radio" id="male" name="gender" value="male">
            <label for="male" class="gender-label">Male</label>
            <input type="radio" id="female" name="gender" value="female">
            <label for="female" class="gender-label">Female</label>
        </div>
        <div class="form-group">
                 <label for="nationality">Nationality</label>
                <select name="nationality" id="nationality">
                    <?php
                    if(!$con) {
                        echo "<div class='error-div'><i class='far fa-times-circle'></i>Failed to connect due to.".mysqli_connect_error()."</div>";
                    }else {
                        $countriesQuery = mysqli_query($con, "SELECT * FROM countries");
                        if($countriesQuery) {
                            while($row = mysqli_fetch_assoc($countriesQuery)) {
                                echo "<option value=".$row['countryId'].">".$row['countryName']."</option>";
                            }
                        }
                        else{
                            echo "<div class='error-div'><i class='far fa-times-circle'></i>Failed to fetch countries due to.".mysqli_error($con)."</div>";
                        }
                    }
                    ?>
                </select>
        </div>
        <div class="form-group">
                 <label for="roles">Roles</label>
                <select name="roles" id="roles">
                    <?php
                    if(!$con) {
                        echo "<div class='error-div'><i class='far fa-times-circle'></i>Failed to connect due to.".mysqli_connect_error()."</div>";
                    }else {
                        $rolesQuery = mysqli_query($con, "SELECT * FROM roles");
                        if($rolesQuery) {
                            while($row = mysqli_fetch_assoc($rolesQuery)) {
                                echo "<option value=".$row['roleId'].">".$row['role']."</option>";
                            }
                        }
                        else{
                            echo "<div class='error-div'><i class='far fa-times-circle'></i>Failed to fetch roles due to.".mysqli_error($con)."</div>";
                        }
                    }
                    ?>
                </select>
        </div>
        <div class="form-group">
            <label for="uname">User Name:</label>
            <input type="text" id="uname" name="username" placeholder="Enter User Name" pattern="[A-Za-z0-9]{1,50}">
        </div>
        <div class="form-group">
            <label for="pass">Password:</label>
            <input type="password" id="pass" name="password" placeholder="Enter password" pattern=".{5,}">
        </div>
        <div class="form-group">
            <label for="repeatpass">Confirm Password:</label>
            <input type="password" id="repeatpass" name="cpassword" placeholder="Repeat entered password" pattern=".{5,}">
        </div>
        <input type="submit" value="Register">
        <div class="or-div">
            <hr>
            Or
            <hr>
        </div>
        <a class="register-link login-link" href="loginForm.php">Login</a>
    </form>
    <?php include('../utils/footer.php');?>
</body>

</html>
