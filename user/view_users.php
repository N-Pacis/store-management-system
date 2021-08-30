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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/index.css?v=<?php echo time() ?>">
</head>
<body>
<?php   
   $current_page='user';
    include('../utils/navigation.php');

   if (!$con) {
     echo mysqli_connect_error();
    } 
    else {
        $sql = "SELECT stk.userId,stk.firstName, stk.lastName,stk.gender,stk.telephone,stk.email,stk.username,c.countryId,c.countryName as nationality,r.role from stk_users stk INNER JOIN countries c ON stk.nationality=c.countryId INNER JOIN roles r ON stk.role=r.roleId";
        $result = mysqli_query($con, $sql);
        if(!$result){
            echo "<div class='error-div'><i class='far fa-times-circle'></i>Failed due to:".mysqli_error($con)."</div>";
        }
        else{
                if(mysqli_num_rows($result) > 0){
                    echo "<div class='table-div'><table>
                    <tr>
                    <th>User Id</th>
                    <th>FirstName</th>
                    <th>LastName</th>
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
                        <td>" . $row["email"] . "</td>
                        <td>" . $row["username"] . "</td>
                        <td>" . $row["nationality"]     . "</td>
                        <td>" . $row["role"] . "</td>
                        </tr>";
                    }
                    echo "</table></div>";
                }
                else{
                    echo "
                    <div class='error-div'><i class='far fa-sad-tear'></i>No users found<br>
                    </div>
                     ";
                }
        }
    }
    //if($role == 1){
        //echo "<a class='register-link' href='userRegistration.php'>Register A User</a>";
    //}
    include('../utils/footer.php');
?>
</body>
</html>

