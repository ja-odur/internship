
<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 7/15/17
 * Time: 11:52 PM
 */
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

                    <div class="leftDiv-device-param"  <?php colorTemp($deviceId, $tempValue, 24, 20);?>></div>
                    <div>Temperature</div>
                    <div class="rightDiv-device-param" >
                        <?php echo $tempValue ;?>
                    </div>

                </div>

                <div class="device-param">

                    <div class="leftDiv-device-param" <?php colorHum($deviceId, $HumidityValue, 60, 50);?>></div>
                    <div>Humidity</div>
                    <div class="rightDiv-device-param">
                        <?php echo $HumidityValue; ?>
                    </div>

                </div>

                <?php if($AirflowValue != null)
                {
                    ?>
                <div class="device-param">

                    <div class="leftDiv-device-param" <?php colorAir($deviceId, $AirflowValue, 55, 46)?>></div>
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

function color($param_value, $paraName, $upperLimit, $moderateLimit)
{
    if($param_value > $upperLimit){
        echo 'style = "background-color: red;"';

    }
    elseif($param_value > $moderateLimit){
        echo 'style = " background-color: rgb(255, 200, 26);"';
    }
    else {
        if($paraName == 'temp'){
            echo 'style = " background-color: #00f200;"';
        }

        if($paraName == 'hum'){
            echo 'style = " background-color: blue;"';
        }

        if($paraName == 'air'){
            echo 'style = " background-color: #77bcd9;"';
        }

    }
}

function colorTemp($id, $param_value, $upperLimit, $moderateLimit)
{
    echo 'id="temp'.$id.'" ';

    if($param_value > $upperLimit){
        echo 'style = "background-color: red;"';

    }
    elseif($param_value > $moderateLimit){
        echo 'style = " background-color: rgb(255, 200, 26);"';
    }
    else {
        echo 'style = " background-color: #00f200;"';
    }

}

function colorHum($id, $param_value, $upperLimit, $moderateLimit)
{
    echo 'id="humidity'.$id.'" ';

    if($param_value > $upperLimit){
        echo 'style = "background-color: red;"';

    }
    elseif($param_value > $moderateLimit){
        echo 'style = " background-color: rgb(255, 200, 26);"';
    }
    else {
        echo 'style = " background-color: blue;"';
    }
}

function colorAir($id, $param_value, $upperLimit, $moderateLimit)
{
    echo 'id="airflow'.$id.'" ';

    if($param_value > $upperLimit){
        echo 'style = "background-color: rgb(255, 0, 0);"';

    }
    elseif($param_value > $moderateLimit){
        echo 'style = " background-color: rgb(255, 200, 26);"';
    }
    else {
        echo 'style = " background-color: #77bcd9;"';
    }
}
?>
