

<!DOCTYPE HTML>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width initial-scale=1">
    <title></title>

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/main.css">

    <!--JavaScript-->
    <script type="text/javascript" src = "assets/js/jquery.min.js"></script>
    <script type="text/javascript" src = "assets/bootstrap/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="assets/js/main.js"></script>

    <style>
        .error{
            color: #ff0000;
        }
        #back_to_dashboard {
            position: absolute;
            left: 35%;
            top: 60px;
            width: 150px;
            height: 25px;
            text-align: center;

        }
        #back_to_dashboard > a {
            text-decoration: none;
            color: #000;
        }
        #back_to_dashboard > a:hover {
            text-decoration: underline;
            color: blue;
        }
    </style>

</head>

<body >

<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);
include ('db_credentials.php');


$username = $usernameErr = $password = $passwordErr = $error =  '';
$data = array();

if($_SERVER["REQUEST_METHOD"] == "POST")
{

    $username = $_POST['username'];
    $password = $_POST['password'];





    if(!empty($username))
    {
       // $username = crypt(data_test($username), 'watchdog');

        $sql = sprintf("SELECT username, password FROM user_authenication WHERE username = '$username'");

        $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $result = $conn->query($sql);

        foreach ($result as $row)
        {
            $data[] = $row;
        }
        $conn->close();

        if(!empty($password))
        {
            $password = data_test($password);
            if(!empty($data))
            {
                $hash = $data[0]['password'];
            }
            else
                {$hash = null;}

            if(password_verify($password, $hash))
            {
                session_id("$username");
                session_start();
                $_SESSION['usern@me_w@tchd0g_r00t'] = $username;
                $_SESSION['p@ssw0rd_w@tchd0g_r00t'] = $password;
                $_SESSION['h@sh_w@tchd0g_r00t'] = $hash;
                $_SESSION['db_h0st_w@tchd0g_r00t'] = DB_HOST;
                $_SESSION['db_usern@me_w@tchd0g_r00t'] = DB_USERNAME;
                $_SESSION['db_p@ssw0rd_w@tchd0g_r00t'] = DB_PASSWORD;
                $_SESSION['db_n@me_w@tchd0g_r00t'] = DB_NAME;
                session_write_close();

                header("location:settings.php");
                exit;
            }
            else
            {
                $error = 'Invalid username or password';
            }
        }
        else
        {
            $passwordErr = 'password is required';
        }

    }

    else
    {
        $usernameErr = 'Username is required';
    }



}


function data_test($data){
    $data = trim($data);
    $data = htmlspecialchars($data);

    return $data;
}

?>


        <div id="back_to_dashboard">
            <span class="glyphicon glyphicon-step-backward"></span><a href="index.php">Back to Dasboard</a>
        </div>

        <div style="width: 350px; height: 300px; margin: auto; margin-top: 100px; padding: auto; border: 1px solid rgba(6,6,6,0.17);box-shadow: 5px 5px 8px black;">

            <div class="container-fluid" style="margin: auto;">
                <h1 >WATCHDOG <small>Setup</small></h1>
                    <br>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">

                    <div class="form-group">
                        <label for="username">User name:</label>
                        <input name="username" id="username" class="form-control" placeholder="Enter username" >
                        <div class="error"><?php echo $usernameErr;?></div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password: </label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter password">
                        <div class="error"><?php echo $passwordErr;?></div>
                        <div class="error"><?php echo $error;?></div>
                    </div>

                    <div>
                        <input type="submit" name="submit" value="Login" >
                    </div>

                </form>

            </div>

        </div>

</body>

</html>


