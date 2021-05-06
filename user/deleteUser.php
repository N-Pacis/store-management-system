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
    $rowUser = mysqli_fetch_assoc($selectQuery);
    $role = $rowUser['role'];
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
          include('../utils/navigation.php');
          if(!$con){
              echo "<div class='error-div'><i class='far fa-times-circle'></i>Failed to connect due to.".mysqli_connect_error()."</div>";
          }
          else{
              $uid = $rowUser['userId'];
              $findQuery = "SELECT * FROM stk_users where userId=$uid";
              $result = mysqli_query($con,$findQuery);
              if(!$result){
                  echo "<div class='error-div'><i class='far fa-times-circle'></i>Unable to find the specified user.</div>";
              }
              else{
                    $updateQuery = "DELETE FROM stk_users where userId=$uid";
                    $result = mysqli_query($con,$updateQuery);
                    if(!$result){
                        echo "<div class='error-div'><i class='far fa-times-circle'></i>Unable to delete user due to.".mysqli_error($con)."</div>";
                    }
                    else{
                        echo "<div class='success-div'><i class='far fa-check-circle'></i>Deleted successfully<br>";
                        echo "<a href='view_users.php'>View Users</a></div>";
                    }
              }
          }
          include('../utils/footer.php');
    ?>
</body>
</html>