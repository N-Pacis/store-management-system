<?php
    session_start();
    require_once '../utils/connection.php';
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
       if(!isset($con)){
           echo "<div class='error-div'>
                    <i class='far fa-times-circle'></i>
                    Connection Error!<br><a href='loginForm.php'>Back to login?</a>
                 </div>";
       }
       else {
           //get the post result from the frontend and put them in variables
           $username = $_POST['username'];
           $user_password = $_POST['password'];

           if ($username === "" || $user_password === "") {
               echo "<div class='error-div'>
                         <i class='far fa-times-circle'></i>
                         All fields are required!<br>
                         <a href='loginForm.php'>Back to login?</a>
                      </div>";
           } else {
               $hashed = hash('sha512',$user_password);
               $checkUserQuery = mysqli_query($con,"SELECT * FROM stk_users where username='$username' and user_password='$hashed'");
               if (mysqli_num_rows($checkUserQuery)==0) {
                   echo "<div class='error-div'>
                         <i class='far fa-times-circle'></i>Invalid Username or Password<br><a href='loginForm.php'>Back to login?</a></div>";
               } else {
                  $_SESSION['user'] = $username;
                      $user = $_SESSION['user'];
                      $selectQuery = mysqli_query($con,"Select * from stk_users where username='$user'");
                      $rowUser = mysqli_fetch_assoc($selectQuery);
                      $role = $rowUser['role'];
                   $user_agent = $_SERVER['HTTP_USER_AGENT'];
                   function getBrowser(){
                       global $user_agent;
                        $arr_browsers = ["Opera", "Edg", "Chrome", "Safari", "Firefox", "MSIE", "Trident"];
                        foreach($arr_browsers as $browser){
                            if(strpos($user_agent,$browser) !== false){
                                $user_browser = $browser;
                                break;
                            }
                        }
                        switch($user_browser){
                            case 'Trident':
                                $user_browser = 'Internet Explorer';
                                break;
                            case 'MSIE':
                                $user_browser = 'Internet Explorer';
                                break;
                            case 'Edg':
                                $user_browser = 'Microsoft Edge';
                                break;
                        }
                        return $user_browser;
                   }

                      function getOS() {
                        global $user_agent;
                        $os_platform  = "Unknown OS Platform";

                        $os_array     = array(
                                              '/windows nt 10/i'      =>  'Windows 10',
                                              '/windows nt 6.3/i'     =>  'Windows 8.1',
                                              '/windows nt 6.2/i'     =>  'Windows 8',
                                              '/windows nt 6.1/i'     =>  'Windows 7',
                                              '/windows nt 6.0/i'     =>  'Windows Vista',
                                              '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                                              '/windows nt 5.1/i'     =>  'Windows XP',
                                              '/windows xp/i'         =>  'Windows XP',
                                              '/windows nt 5.0/i'     =>  'Windows 2000',
                                              '/windows me/i'         =>  'Windows ME',
                                              '/win98/i'              =>  'Windows 98',
                                              '/win95/i'              =>  'Windows 95',
                                              '/win16/i'              =>  'Windows 3.11',
                                              '/macintosh|mac os x/i' =>  'Mac OS X',
                                              '/mac_powerpc/i'        =>  'Mac OS 9',
                                              '/linux/i'              =>  'Linux',
                                              '/ubuntu/i'             =>  'Ubuntu',
                                              '/iphone/i'             =>  'iPhone',
                                              '/ipod/i'               =>  'iPod',
                                              '/ipad/i'               =>  'iPad',
                                              '/android/i'            =>  'Android',
                                              '/blackberry/i'         =>  'BlackBerry',
                                              '/webos/i'              =>  'Mobile'
                                        );

                        foreach ($os_array as $regex => $value)
                            if (preg_match($regex, $user_agent))
                                $os_platform = $value;

                        return $os_platform;
                    }
                   

                   $mac = strtok(exec('getmac'),' ');
                   $ip = getHostByName(gethostname());
                   $os = getOs();
                   $browser = getBrowser();
                   echo $mac;echo $ip;echo $os;echo $browser;
                   $user = $rowUser["userId"];
                   $insertLoginInfo = mysqli_query($con,"INSERT INTO login_info(MAC_ADDRESS,IP_ADDRESS,OS,Browser,user_id) values('$mac','$ip','$os','$browser',$user)");
                   if($insertLoginInfo){
                       header("location:view_users.php");
                   }
                   else{
                       echo "hello";
                       echo $mysqli_error($con);
                   }
               }
           }
       }

       include('../utils/footer.php');
    ?>
</body>
</html>
