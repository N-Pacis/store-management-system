<?php
session_start();
if(isset($_SESSION['user'])){
    header('location:view_users.php');
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
    <form action="loginHandler.php" method="post" enctype="multipart/form-data">
        <h3>User Login</h3>
        <div class="form-group">
            <label for="uname">User Name:</label>
            <input type="text" id="uname" name="username" placeholder="Enter User Name" pattern="[A-Za-z0-9]{1,50}">
        </div>
        <div class="form-group">
            <label for="pass">Password:</label>
            <input type="password" id="pass" name="password" placeholder="Enter password" pattern=".{5,}">
        </div>
        <input type="submit" value="Login">
    </form>
    <?php include('../utils/footer.php');?>
</body>

</html>