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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
          integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
          crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/index.css?v=<?php echo time() ?>">
    <title>User</title>
</head>
<body>
    <?php
       require_once '../utils/connection.php';

       if(!$con){
           echo "<div class='error-div'>
                    <i class='far fa-times-circle'></i>
                    Connection Error!<br><a href='UserRegistration.php'>Back to registration?</a>
                 </div>";
       }

       else{

            //get the post result from the frontend and put them in variables
            $fname = $_POST['firstName'];
            $lname = $_POST['lastName'];
            $email = $_POST['email'];
            $tel = $_POST['telephone'];
            $nationality = $_POST['nationality'];
            $role = $_POST['roles'];
            $username = $_POST['username'];
            $user_password = $_POST['password'];
            $cpassword = $_POST['cpassword'];

            if($fname === "" || $lname === "" || $email === "" || !$_POST['gender'] || $nationality === "" ||$role === ""
                || $username === "" || $user_password === "" || $cpassword === ""){
                echo "<div class='error-div'>
                         <i class='far fa-times-circle'></i>
                         All fields are required!<br>
                         <a href='UserRegistration.php'>Back to registration?</a>
                      </div>";
            }

            else if($user_password != $cpassword){
                echo "<div class='error-div'>
                          <i class='far fa-times-circle'></i>
                          The both passwords do not match!<br>
                          <a href='UserRegistration.php'>Back to registration?</a>
                      </div>";
            }

            else{
                $selectUsernameQuery = mysqli_query($con,"select * from stk_users where username='$username'");
                if(mysqli_num_rows($selectUsernameQuery)>0){
                    echo "<div class='error-div'>
                             <i class='far fa-times-circle'></i>Username is already taken!<br>
                             <a href='UserRegistration.php'>Back to registration?</a>
                          </div>";
                }
                else{
                    $selectEmailQuery = mysqli_query($con,"select * from stk_users where email='$email'");
                    if(mysqli_num_rows($selectEmailQuery)>0){
                        echo "<div class='error-div'>
                                  <i class='far fa-times-circle'></i>Email is already registered!<br>
                                  <a href='UserRegistration.php'>Back to registration?</a>
                              </div>";
                    }
                    else{
                        //Hash the password;
                         $hashed =  hash('SHA512',$user_password);
                        //register a user
                        $gender = $_POST['gender'];

                        $insertQuery = "INSERT INTO stk_users(firstName,lastName,telephone,gender,nationality
                            ,role,userName,email,user_password) values('$fname','$lname','$tel',
                             '$gender','$nationality','$role','$username','$email','$hashed')";
                        $result = mysqli_query($con,$insertQuery);
                        if(!$result){
                            echo "<div class='error-div'>
                                       <i class='far fa-times-circle'></i>Unable to register user due to.".mysqli_error($con)
                                ."<br><a href='UserRegistration.php'>Back to registration?</a></div>";
                        }
                        else{
                            $_SESSION['user']=$username;
                            header("location:view_users.php");
                       }
                    }

                }
            }
       }

       include('../utils/footer.php');
    ?>
</body>
</html>