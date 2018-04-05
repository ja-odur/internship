<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 8/18/17
 * Time: 9:27 AM
 */
?>



<?php
function header_page ($js_file, $dc)
{
?>
<!DOCTYPE HTML>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width initial-scale=1">
    <title></title>

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="assets/css/deviceTemplate.css">

    <!--JavaScript-->
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/graph_device/js/Chart.min.js"></script>
    <script type="text/javascript" src="assets/graph_device/js/linegraph.js"></script>

    <script type="text/javascript" src="assets/js/<?php echo $js_file; ?>"></script>

</head>

<body>
<input type="hidden" id="hiddenField" value="<?php echo $dc; ?>" >
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid" id="main_nav-wrapper">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <img src="assets/images/logo.png"
                 style="display: inline;position:absolute;top: 13px; left: 0;width: 100px;">
            <a class="navbar-brand" href="#" style="position: absolute; left: 100px;top: 5px;">

                <h1 style="display: inline; margin-left: 3px;"> WATCHDOG</h1>
                <span>Dashboard</span>
            </a>
        </div>


        <div class="navbar-collapse collapse">

            <ul class="nav navbar-nav navbar-right" id="main-nav-ul">

                <li ><a href="login.php" style="color: blue;">Admin Login</a></li>

            </ul>


        </div>

    </div>

</div>

<div class="body-wrapper">

    <div class="verticalNav">
        <div class="container-fluid">

            <ul class="nav nav-pills  nav-stacked">

                <li <?php if($js_file == 'main.js'){ echo 'class="activeNav"'; } ?> id="dasboard"><a href="#">Dashboard</a></li>
                <li id="alerts"><a href="#">Alerts</a></li>
                <li id="category" class="dropdown" <?php if($js_file == 'main_mutundwe.js'){ echo 'class="activeNav"'; } ?> >
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="position: relative;">
                        Category<span class="caret" style="position: absolute;right: 5px;top: 17px;"></span>
                    </a>
                    <ul id="dropdown-cat" class="dropdown-menu" style="position:absolute; left: 80%; top: 95%;">

                        <li class="dropdown-header">COUNTRIES</li>
                        <li class="divider"></li>

                        <li id="uganda"><a href="#">Uganda</a></li>
                        <li id="zambia"><a href="#">Zambia</a></li>
                        <li id="swaziland"><a href="#">Swaziland</a></li>
                        <li class="divider"></li>

                        <li class="dropdown-header">DATA CENTRES</li>
                        <li class="divider"></li>
                        <li id="mutundwe"><a href="#">Mutundwe</a></li>
                        <li id="plot77"><a href="#">Plot 77</a></li>
                        <li id="mbuyaGround"><a href="#">Mbuya Ground Floor</a></li>
                        <li id="mbuyaSecond"><a href="#">Mbuya Second Floor</a></li>
                        <li id="zambiaDC"><a href="#">Zambia</a></li>
                        <li id="swazilandDC"><a href="#">Swaziland</a></li>


                    </ul>
                </li>
                <li id="display_trends"><a href="#">Display Trend</a></li>


            </ul>
        </div>
    </div>

    <button type="button" class="btn-position btn-toggle-nav" id="btn-toggle-nav">
            <span class="glyphicon glyphicon-menu-hamburger" style="color: white;">
            </span>
    </button>

    <?php
    }
?>

    <?php
    function content ()
    {
        ?>
        <div class="content-wrapper">

        </div>

        <?php
    }
    ?>


    <?php
    function footer ()
    {
    ?>
    </div>



    </body>
    </html>

<?php
    }
    ?>



