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

        <!--JavaScript-->
        <script type="text/javascript" src = "assets/js/jquery.min.js"></script>
        <script type="text/javascript" src = "assets/js/main_settings.js"></script>
        <script type="text/javascript" src = "assets/bootstrap/js/bootstrap.min.js"></script>
        <script>

            $(document).ready(function () {
                var content_width = $(window).width() - 210;
                $('.content-wrapper').css({width:content_width});
            });

        </script>

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
                border: 1px solid #57bba7;
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

                    <li class = 'active' id="param_settings"><a href="#">Parameters</a></li>
                    <li id="settings"><a href="#" >Settings</a></li>

                    <li class="divider" style="width: 20px;height: 75px;"></li>
                    <li id="logout"><a href="#" style="text-align: center">Logout</a></li>


                </ul>
            </div>
        </div>



        <div class="content-wrapper">
            <div class="container-fluid">
                <h1 class="content-header">WATCHDOG <small>Dashboard </small> <small>PARAMETER SETUP</small></h1>


                <div class="param-setup-wrapper">

                    <div class="container-fluid" style="margin: auto;">
                        <div style="border: 1px solid rgba(60, 55, 155, 0.61); padding: 7px;box-shadow: 4px 4px 8px rgba(60, 55, 155, 0.61); border-radius: 10px">

                            <label id="label_default_values" style="width: 100%;">
                                <div style="position: relative;width: 100%;">

                                    <div style="color: #2aabd2"><b>Use default values</b></div>
                                    <div class="checkbox" style="position: absolute;top: -2px;right: 5px; margin-top: 0; padding: 0; border-radius: 10px">
                                        <input type="checkbox" id="checkbox_default_values" >
                                        <label for="checkbox_default"></label>
                                    </div>

                                </div>
                            </label>
                            <div id="form-wrapper">
                                <div class="form-group">
                                    <label>Temperature:</label>
                                    <input type="number" name="tempAlert" id="tempAlert" class="form-control" placeholder="Enter Alert value" >
                                    <input type="number" name="tempWarning" id="tempWarning" class="form-control" placeholder="Enter warning value" >
                                    <input type="hidden" name="tempOK" id="tempOK" class="form-control" placeholder="Enter acceptable value(Max)" >
                                </div>

                                <div class="form-group">
                                    <label>Humidity: </label>
                                    <input type="number" name="humAlert" id="humAlert" class="form-control" placeholder="Enter Alert value">
                                    <input type="number" name="humWarning" id="humWarning" class="form-control" placeholder="Enter warning value" >
                                    <input type="hidden" name="humOK" id="humOK" class="form-control" placeholder="Enter acceptable value(Max)" >
                                </div>

                                <div class="form-group">
                                    <label >Airflow: </label>
                                    <input type="number" name="airAlert" id="airAlert" class="form-control" placeholder="Enter Alert value">
                                    <input type="number" name="airWarning" id="airWarning" class="form-control" placeholder="Enter warning value" >
                                    <input type="hidden" name="airOK" id="airOK" class="form-control" placeholder="Enter acceptable value(Max)" >
                                </div>

                                <div>
                                    <input type="submit" id = "submit" value="send data" style="width: 100%;height: 30px;border-radius: 10px;">
                                    <p id="msg" style="color: green;text-align: center;"></p>
                                    <!--<button id ="submit" >Submit data</button>-->
                                </div>
                            </div>

                        </div>

                    </div>



                </div>
                <h1 id="ses"></h1>
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


