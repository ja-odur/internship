<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

include ('db_credentials.php');


$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

$query = sprintf("SELECT tempAlert, tempWarning, humAlert, humWarning, airAlert, airWarning FROM parameter_value_setup WHERE country = 'All'");


$result = $conn->query($query);

$data = array();

foreach ($result as $row) {
    $data[] = $row;
}

$result->close();

$conn->close();

$GLOBALS['tempAlert'] = $data[0]['tempAlert'];
$GLOBALS['tempWarning'] = $data[0]['tempWarning'];
$GLOBALS['humAlert'] = $data[0]['humAlert'];
$GLOBALS['humWarning'] = $data[0]['humWarning'];
$GLOBALS['airAlert'] = $data[0]['airAlert'];
$GLOBALS['airWarning'] = $data[0]['airWarning'];


?>



<?php //function declaration
function deviceTemplate ($deviceName, $deviceId, $tempValue, $HumidityValue, $AirflowValue)
{
    ?>

    <div class="device-template-wrapper"  id="<?php echo 'device'.$deviceId;?>">


        <div class="detail-param-wrapper">

            <div class="device-details">
                <?php echo $deviceName;?>
            </div>

            <div class="device-param-wrapper">
                <div class="device-param">

                    <div class="leftDiv-device-param"  <?php colorTemp($deviceId, $tempValue);?>></div>
                    <div>Temperature</div>
                    <div class="rightDiv-device-param" >
                        <?php echo $tempValue ;?>
                    </div>

                </div>

                <div class="device-param">

                    <div class="leftDiv-device-param" <?php colorHum($deviceId, $HumidityValue);?>></div>
                    <div>Humidity</div>
                    <div class="rightDiv-device-param">
                        <?php echo $HumidityValue; ?>
                    </div>

                </div>

                <?php if($AirflowValue != null)
                {
                    ?>
                    <div class="device-param">

                        <div class="leftDiv-device-param" <?php colorAir($deviceId, $AirflowValue)?>></div>
                        <div>Airflow</div>
                        <div class="rightDiv-device-param">
                            <?php echo $AirflowValue; ?>
                        </div>

                    </div>
                    <?php
                }
                ?>

            </div>

        </div>

        <div class="graph-canvas">
            <canvas  id="<?php echo $deviceId; ?>"></canvas>
        </div>

    </div>

    <script>
        $(document).ready(function (){


            var BlickT = $('<?php echo "#temp".$deviceId; ?>');
            var BlickH = $('<?php echo "#humidity".$deviceId; ?>');
            var BlickA = $('<?php echo "#airflow".$deviceId; ?>');

            if(BlickT.css('backgroundColor') == 'rgb(255, 0, 0)' || BlickH.css('backgroundColor') == 'rgb(255, 0, 0)'
                || BlickA.css('backgroundColor') == 'rgb(255, 0, 0)')
            {
                var id = $('<?php echo '#device'.$deviceId;?>');
                id.addClass('alertOn');

                if(BlickT.css('backgroundColor') == 'rgb(255, 0, 0)' ) {
                    setInterval(function () {
                        BlickT.toggle();
                    }, 200);
                }

                if(BlickH.css('backgroundColor') == 'rgb(255, 0, 0)' ) {
                    setInterval(function () {
                        BlickH.toggle();
                    }, 200);
                }

                if(BlickA.css('backgroundColor') == 'rgb(255, 0, 0)' ) {
                    setInterval(function () {
                        BlickA.toggle();
                    }, 200);
                }



            }


        });
    </script>


    <?php
}
?>


<?php


function colorTemp($id, $param_value)
{
    echo 'id="temp'.$id.'" ';

    if($param_value > $GLOBALS['tempAlert']){
        echo 'style = "background-color: red;"';

    }
    elseif($param_value > $GLOBALS['tempWarning']){
        echo 'style = " background-color: rgb(255, 200, 26);"';
    }
    else {
        echo 'style = " background-color: #00f200;"';
    }

}

function colorHum($id, $param_value)
{
    echo 'id="humidity'.$id.'" ';

    if($param_value > $GLOBALS['humAlert']){
        echo 'style = "background-color: red;"';

    }
    elseif($param_value > $GLOBALS['humWarning']){
        echo 'style = " background-color: rgb(255, 200, 26);"';
    }
    else {
        echo 'style = " background-color: blue;"';
    }
}

function colorAir($id, $param_value)
{
    echo 'id="airflow'.$id.'" ';

    if($param_value > $GLOBALS['airAlert']){
        echo 'style = "background-color: rgb(255, 0, 0);"';

    }
    elseif($param_value > $GLOBALS['airWarning']){
        echo 'style = " background-color: rgb(255, 200, 26);"';
    }
    else {
        echo 'style = " background-color: #77bcd9;"';
    }
}
?>
