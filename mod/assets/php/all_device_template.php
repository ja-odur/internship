<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 8/5/17
 * Time: 11:57 PM
 */
?>

<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

include ('db_credentials.php');
include ('alarm_values.php');

?>

<?php
//function declaration
function deviceTemplate ($deviceName, $id, $tempValue, $HumidityValue, $AirflowValue)
{

?>

    <div class="deviceTable container-fluid">

        <table class="table table-condensed table-hover table-striped" style="border: 1px solid rgba(6,6,6,0.17);box-shadow: 4px 4px 8px black;">
            <thead>
            <tr>
                <th colspan="3" style="text-align: center"><?php echo $deviceName; ?></th>

            </tr>
            </thead>
            <tbody>

            <?php
            parameter_template('Temperature', $tempValue, $id, $GLOBALS['temperature']);
            parameter_template('Humidity', $HumidityValue, $id, $GLOBALS['humidity']);
            parameter_template('Airflow', $AirflowValue, $id, $GLOBALS['airflow']);
            ?>

            </tbody>
        </table>

    </div>

    <script>
        $(document).ready(function (){


            var BlickT = $('<?php echo "#temp".$id; ?>');
            var BlickH = $('<?php echo "#humidity".$id; ?>');
            var BlickA = $('<?php echo "#airflow".$id; ?>');

            if(BlickT.css('backgroundColor') == 'rgb(255, 0, 0)' || BlickH.css('backgroundColor') == 'rgb(255, 0, 0)'
                || BlickA.css('backgroundColor') == 'rgb(255, 0, 0)')
            {
                var id = $('<?php echo '#device'.$id;?>');
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


function color($Identity, $param_value, $param_name)
{
    if($param_name == 'temp')
    {
        echo 'id="temp' . $Identity . '" ';

        if ($param_value > $GLOBALS['tempAlert'])
        {
            echo 'style = "background-color: red;"';
        }
        elseif ($param_value > $GLOBALS['tempWarning'])
        {
            echo 'style = " background-color: rgb(255, 200, 26);"';
        }
        else
        {
            echo 'style = " background-color: #00f200;"';
        }
    }

    elseif ($param_name == 'humidity')
    {
        echo 'id="humidity'.$Identity.'" ';

        if($param_value > $GLOBALS['humAlert'])
        {
            echo 'style = "background-color: red;"';
        }
        elseif($param_value > $GLOBALS['humWarning'])
        {
            echo 'style = " background-color: rgb(255, 200, 26);"';
        }
        else
        {
            echo 'style = " background-color: blue;"';
        }
    }

    elseif ($param_name == 'airflow')
    {
        echo 'id="airflow'.$Identity.'" ';

        if($param_value > $GLOBALS['airAlert'])
        {
            echo 'style = "background-color: rgb(255, 0, 0);"';
        }
        elseif($param_value > $GLOBALS['airWarning'])
        {
            echo 'style = " background-color: rgb(255, 200, 26);"';
        }
        else
        {
            echo 'style = " background-color: #77bcd9;"';
        }

    }
    else
        {
            //add parameter
        }
}

function parameter_template($name, $value, $id, $paramName)
{
    if ($value != null)
    {
        ?>
        <tr>
            <td class="device-param"><div class="leftDiv-device-param" <?php color($id, $value, $paramName);?>></div></td>
            <td class="dataAlign"><?php echo $name; ?></td>
            <td class="valueAlign"><?php echo $value;?></td>
        </tr>
        <?php
    }

}

//deviceTemplate ('watchdog 1200 mutundwe dc', '13244658765846', 25, 60, 55);

?>

