<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 8/7/17
 * Time: 4:10 PM
 */
?>
<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 8/1/17
 * Time: 8:51 AM
 */
?>

<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);


session_start();
$username = $_SESSION['usern@me_w@tchd0g_r00t'];
session_write_close();

if (!empty($username))
{

    session_id($username);
    session_start();
    $_SESSION['usern@me_w@tchd0g_r00t'] = '';
    session_write_close();

    ?>
    <!DOCTYPE HTML>
    <html lang="en-US">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width initial-scale=1">
        <title></title>

        <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">

        <link rel="stylesheet" type="text/css" href="assets/css/main_settings.css">
        <!-- <link rel="stylesheet" type="text/css" href="assets/css/deviceTemplate.css"> -->

        <!--JavaScript-->
        <script type="text/javascript" src = "assets/js/jquery.min.js"></script>
        <script type="text/javascript" src = "assets/bootstrap/js/bootstrap.min.js"></script>

        <script>

            $(document).ready(function () {
                var content_width = $(window).width() - 210;
                $('.content-wrapper').css({width:content_width});
            });

        </script>
        <script type="text/javascript" src="assets/js/main_settings.js"></script>

        <style>
            .error {
                color: red;
            }
            #password_form {
                border: 1px solid rgba(60, 55, 155, 0.61);
                padding: 7px;
                box-shadow: 4px 4px 8px black;
                border-radius: 10px;
                width: 400px;
                /*margin-top: 15px;
                margin-left: 20px;*/
                margin:auto;
            }
            .header {
                font-size: x-large;
                text-align: center;
                border-bottom: 1px solid black;
                margin-bottom: 10px;
            }

            .checkbox {
                width: 18px;
                height: 18px;
                background-color: #ddd;
                float: right;
                position: relative;

            }
            .checkbox input[type="checkbox"] {
                visibility: hidden;
            }
            .checkbox label:before {
                content: '';
                width: 13px;
                height: 6px;
                border: 3px solid white;
                position: absolute;
                top:5px;
                left: 3px;
                border-top: none;
                border-right: none;
                transform: rotate(-45deg);
                opacity: 0;
            }
            .checkbox input[type="checkbox"]:checked + label:before {
                opacity: 1;
            }
            .checkbox input[type="checkbox"]:checked + label {
                background-color: #57bba7;
            }


            .checkbox label {
                width: 18px;
                height: 18px;
                position: absolute;
                top: -1px;
                left: -1px;
                background-color: white;
                border:1px solid #57bba7;
                border-radius: 10px;
                cursor: pointer;
            }

        </style>

    </head>

    <body>
    <input type="hidden" id="hiddenField" value="<?php echo $username;?>" >

    <div class = "body-wrapper">

        <div class="verticalNav">
            <div class="container-fluid">

                <ul class="nav nav-pills  nav-stacked navbar-fixed">

                    <li id="param_settings"><a href="#">Parameters</a></li>
                    <li class="active" id="settings"><a href="#" >Settings</a></li>

                    <li class="divider" style="width: 20px;height: 75px;"></li>
                    <li id="logout"><a href="#" style="text-align: center">Logout</a></li>


                </ul>
            </div>
        </div>



        <div class="content-wrapper">
            <div class="container-fluid">
                <h1 class="content-header">WATCHDOG <small>Dashboard </small> <small>ACCOUNTS SETUP</small></h1>

                <div style="margin-top: 20px"></div>

                <div id="password_form">
                    <div class="header">Add a user account</div>

                    <div class="form-group">
                        <label>Username:</label>
                        <input name="username" id="username" class="form-control" placeholder="Enter Username" >
                        <div class="error" id="username_error"></div>
                    </div>

                    <div class="form-group">
                        <label>Password: </label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter password">
                        <input type="password" name="password_verify" id="password_verify" class="form-control" placeholder="Verify password" style="margin-top: 5px;">
                        <div class="error" id="password_error"></div>
                    </div>
                    <label style="width: 100%;">
                        <div style="position: relative;">

                            <div style="color: #2aabd2"><b>Remove default account</b></div>
                            <div class="checkbox" style="position: absolute;top: -2px;right: 5px; margin-top: 0; padding: 0;border-radius: 10px;border: 1px solid grey;">
                                <input type="checkbox" id="checkbox_default" >
                                <label for="checkbox_default"></label>
                            </div>

                        </div>
                    </label>

                    <div>
                        <input type="submit" id = "submit_new_user" value="Add User Acccount" style="width: 100%;height:35px;margin-top: 10px;border-radius: 10px;">
                        <!--<button id ="submit" >Submit data</button>-->
                        <div id="ses" style="margin-top: 5px; color: green; text-align: center;"></div>
                    </div>

                </div>



            </div>









    </div>


    </body>
    </html>



    <?php

}
else
{
    header("location:login.php");
    exit;
}





?>



