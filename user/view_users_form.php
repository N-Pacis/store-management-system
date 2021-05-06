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
    $user = $rowUser['userId'];
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
              $selectQuery = "SELECT stk.userId,stk.firstName, stk.lastName,stk.gender,stk.telephone,stk.email,stk.userName,c.countryId,c.countryName as nationality from stk_users stk INNER JOIN countries c ON stk.nationality=c.countryId where userId=$user";
              $result =mysqli_query($con,$selectQuery);
              if(!$result){
                echo "<div class='error-div'><i class='far fa-times-circle'></i>Failed due to.".mysqli_error($con)."</div>";
              }
              else{
                  $row = mysqli_fetch_assoc($result);
                  echo ('
                        <form action="userUpdate.php" method="post" enctype="multipart/form-data">
                            <h3>User update</h3>
     
                            <div class="form-group">
                                <label for="fname">First Name:</label>
                                <input type="text" id="fname" name="firstName" placeholder="Enter First Name" value='.$row["firstName"].' pattern="[A-Za-z .]{1,50}">
                            </div>
                            <div class="form-group">
                                <label for="lname">Last Name:</label>
                                <input type="text" id="lname" name="lastName" placeholder="Enter Last Name" value='.$row["lastName"].' pattern="[A-Za-z .]{1,50}">
                            </div>
                            <div class="form-group">
                                <label for="tel">Telephone:</label>
                                <input type="text" id="tel" name="telephone" placeholder="Enter your Telephone number" value='.$row["telephone"].' pattern="[0-9]{1,20}">
                            </div>
                            <div class="form-group">
                                <label for="">Gender:</label>
                                ');
                                   if($row["gender"]=="male"){
                                      echo "<input type='radio' id='male' name='gender' value='male' checked>";
                                   } 
                                   else{
                                      echo "<input type='radio' id='male' name='gender' value='male'>";
                                   };
                                echo('
                                <label for="male" class="gender-label">Male</label>
                                ');
                                    if($row["gender"]=="female"){
                                        echo "<input type='radio' id='female' name='gender' value='female' checked>";
                                    } 
                                    else{
                                        echo "<input type='radio' id='female' name='gender' value='female'>";

                                    };
                                echo('
                                <label for="female" class="gender-label">Female</label>
                            </div>
                            <div class="form-group">
                                <label for="nationality">Nationality</label>
                                <select name="nationality" id="nationality">
                                   <option value='.$row["countryId"].'>'.$row["nationality"].'</option>
                            ');
                            $nationalitySelect = "SELECT c.countryId,c.countryName from countries c where countryId !=$row[countryId]";
                            $resultNationality = mysqli_query($con,$nationalitySelect);
                            while($rowNationality = mysqli_fetch_assoc($resultNationality)){
                                   echo ("<option value=".$rowNationality['countryId'].">".$rowNationality['countryName']."</option>");
                            }
                            echo ('
                                </select>
                            </div>
                            <input type="submit" value="Update">
                        </form>
                        <footer>
                            <p>Copyright@2021 RCA</p>
                        </footer>
                  ');
              }
            
          }
          include('../utils/footer.php');
    ?>
<script>
    let file = document.getElementById("picture").value
</script>
</body>

</html>