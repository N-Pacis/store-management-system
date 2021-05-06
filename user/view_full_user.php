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
    $uid = $rowUser['userId'];
}
?>
<!Doctype html>
<html>

<head>
    <title> Forms</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/index.css?v=<?php echo time()?>">
</head>

<body>
    <?php
          $current_page = 'user';
          include('../utils/navigation.php');
          if (!$con) {
              echo mysqli_connect_error();
          }
          else {
              $selectQuery = "SELECT stk.userId,stk.firstName, stk.lastName,stk.gender,stk.telephone,stk.email,stk.userName,c.countryId,c.countryName as nationality from stk_users stk INNER JOIN countries c ON stk.nationality=c.countryId where userId=$uid";
              $result =mysqli_query($con,$selectQuery);
              if(!$result){
                echo "<div class='error-div'><i class='far fa-times-circle'></i>Failed due to.".mysqli_error($con)."</div>";
              }
              else{

                  $row = mysqli_fetch_assoc($result);
                  echo ('
                        <div class="user-info">
                             <div class="user-info-group">
                                <h2>User Id:</h2>
                                <p>'.$row["userId"].'</p>
                            </div>
                            <div class="user-info-group">
                                <h2>First Name:</h2>
                                <p>'.$row["firstName"].'</p>
                            </div>
                            <div class="user-info-group">
                                <h2>Last Name:</h2>
                                <p>'.$row["lastName"].'</p>
                            </div>
                            <div class="user-info-group">
                                <h2>Gender:</h2>
                                <p>'.$row["gender"].'</p>
                            </div>
                            <div class="user-info-group">
                                <h2>Telephone:</h2>
                                <p>'.$row["telephone"].'</p>
                            </div>
                            <div class="user-info-group">
                                <h2>Email:</h2>
                                <p>'.$row["email"].'</p>
                            </div>
                            <div class="user-info-group">
                                <h2>Username:</h2>
                                <p>'.$row["userName"].'</p>
                            </div>
                            <div class="user-info-group">
                                <h2>Nationality:</h2>
                                <p>'.$row["nationality"].'</p>
                            </div>
                        </div>
                        <div class="action-links">
                            <a href="view_users_form.php" class="user-update-btn">Update Profile</a>
                            <a href="deleteUser.php" class="user-update-btn user-delete-btn">Delete Account</a>
                        </div>
                  ');
              }

          }
          include('../utils/footer.php');
    ?>
</body>

</html>