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
    <link rel="stylesheet" href="../css/index.css?v=<?php echo time();?>">
</head>
<body>
<?php   
   $current_page='reports';
   include('../utils/navigation.php');
   $host = "localhost";
   $user = "root";
   $password = "";
   $database = "Stock_DB";
   $con = mysqli_connect($host,$user,$password,$database);
   if (!$con) {
     echo mysqli_connect_error();
    } 
    else {
        $username = $_POST['username'];
        $sql = "SELECT stk.userId,stk.firstName, stk.lastName,stk.gender,stk.telephone,stk.email,stk.username,c.countryId,c.countryName as nationality,r.role from stk_users stk INNER JOIN countries c ON stk.nationality=c.countryId INNER JOIN roles r ON stk.role=r.roleId where stk.username LIKE '$username'";
        $result = mysqli_query($con, $sql);
        if(!$result){
            echo "<div class='error-div'><i class='far fa-times-circle'></i>Failed due to:".mysqli_error($con)."</div>";
        }
        else{
                if(mysqli_num_rows($result) > 0){
                    echo "<div class='table-div'>
                    <table>
                    <tr>
                    <th>User Id</th>
                    <th>FirstName</th>
                    <th>LastName</th>
                    <th>Gender</th>
                    <th>Telephone</th>
                    <th>Email</th>
                    <th>username</th>
                    <th>Nationality</th>
                    <th>Role</th>
                    </tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "
                        <tr>
                        <td>" . $row["userId"] . "</td>
                        <td>" . $row["firstName"] . "</td>
                        <td>" . $row["lastName"] . "</td>
                        <td>" . $row["gender"] . "</td>
                        <td>" . $row["telephone"] . "</td>
                        <td>" . $row["email"] . "</td>
                        <td>" . $row["username"] . "</td>
                        <td>" . $row["nationality"] . "</td>
                        <td>" . $row["role"] . "</td>
                        </tr>";
                    }
                    echo "</table></div>";
                    echo "<br><a href='reports.php' class='register-link'>Back to Reports?</a>";
                }
                else{
                    echo "
                    <div class='error-div'><i class='far fa-sad-tear'></i>No users found with user ame $username. Register one?<br>
                    <a href='../user/userRegistration.php'>Register</a></div>";
                     echo "<br><a href='reports.php' class='register-link'>Back to Reports?</a>";
                }
        }
    }
    include('../utils/footer.php');
?>
</body>
</html>