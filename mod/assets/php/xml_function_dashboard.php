<?php
/**
 * Created by PhpStorm.
 * User: ja
 * Date: 8/13/17
 * Time: 5:16 PM
 */
?>


<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

include ('xml_connection.php');
include("insert_intoDB.php");
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

$GLOBALS['critical'] = 'True_critical';
$GLOBALS['warning'] = 'True_warning';
$GLOBALS['normal'] = 'Normal';


$uganda_mutundwe = xmlDevice_dashboard($xml_mutundwe);
$uganda_plot77 = xmlDevice_dashboard($xml_Plot77);
$uganda_mbuyaGFL = xmlDevice_dashboard($xml_mbuyaGroundFloor);
$uganda_mbuya2ndFL = xmlDevice_dashboard($xml_mbuyaSecondFloor);
$zambia = xmlDevice_dashboard($xml_zambia);
$swaziland = xmlDevice_dashboard($xml_swaziland);




function xmlDevice_dashboard($xml)
{
    $alert_status = null;
    $serverName = $xml->attributes()->host; // host
    //echo "$serverName<br>";
    $serverIP = $xml->attributes()->address; //ip address


    $dateTime = $xml->attributes()->datetime; //date and time
    $dateTimeArray = explode(" ", $dateTime);

    $time = $dateTimeArray[2];

    $date1 = $dateTimeArray[1];
    $dateArray = explode("/", $date1);
    $aDate =array($dateArray[2], $dateArray[1], $dateArray[0]);
    $date = implode("-", $aDate);

    $date_time = implode(' ', array($date, $time));



    foreach($xml->devices->device as $devices){
        $id = $devices->attributes()->id;
        $name = $devices->attributes()->name;
        $deviceIdTimeDate = $id.$date_time;

        ?>

        <script>console.log('<?php echo $deviceIdTimeDate; ?>')</script>

        <?php

        $tempC =$maxTemp = $minTemp = $humidity =$maxHum =$minHum =$airflow =$maxAirflow =$minAirflow = null;

        foreach($devices->field as $field){
            $key = $field->attributes()->key;

            if($key == "TempC" || $key == "Humidity" || $key == "Airflow"){
                $value = $field->attributes()->value;
                $minValue = $field->attributes()->min;
                $maxValue = $field->attributes()->max;
                $niceName = $field->attributes()->niceName;


                if($key == "TempC"){
                    $tempC = $value; $maxTemp = $maxValue; $minTemp = $minValue;
                    $alert_status = check_for_alerts($tempC, $GLOBALS['tempAlert'], $GLOBALS['tempWarning'], $alert_status);
                }
                elseif($key == "Humidity"){
                    $humidity = $value; $maxHum = $maxValue; $minHum = $minValue;
                    $alert_status = check_for_alerts($humidity, $GLOBALS['humAlert'], $GLOBALS['humWarning'], $alert_status);
                }
                else {
                    $airflow = $value; $maxAirflow = $maxValue; $minAirflow = $minValue;
                    $alert_status = check_for_alerts($airflow, $GLOBALS['airAlert'], $GLOBALS['airWarning'], $alert_status);
                }


            }



        }
        insertIntoDB($serverName, $serverIP, $name, $id, $deviceIdTimeDate,  $date_time, $date, $time, $tempC, $maxTemp,
            $minTemp, $humidity, $maxHum, $minHum, $airflow, $maxAirflow, $minAirflow);
    }

return $alert_status;

}


function check_for_alerts($value, $critical_val, $warning_val, $bool)
{
    if($value > $critical_val)
    {
       $bool = $GLOBALS['critical'];
    }
    elseif (($value > $warning_val)&&($bool != $GLOBALS['critical']))
    {
        $bool = $GLOBALS['warning'];
    }
    elseif(($bool != $GLOBALS['critical'])&&($bool != $GLOBALS['warning']))
    {
        $bool = $GLOBALS['normal'];

    }
    else {}

    return $bool;
}

function background_setter ($bool)
{
   if($bool == $GLOBALS['critical'])
   {
      //echo 'style = "background-color: red; border-color: red;"';
       echo 'background-color: red; border-color: red;';
   }
   elseif ($bool == $GLOBALS['warning'])
   {
       //echo 'style = " background-color: rgb(255, 200, 26); border-color: rgb(255, 200, 26);"';
       echo 'background-color: rgb(255, 200, 26); border-color: rgb(255, 200, 26);';
   }
   elseif($bool == null)
   {
       //echo 'style = " background-color: #00f200; border-color: #00f200;"';
       echo 'background-color: grey; border-color: grey;';
   }
else
    {
        //echo 'style = " background-color: #00f200; border-color: #00f200;"';
        echo 'background-color: #00f200; border-color: #00f200;';
    }
}


/*
 // testing

 echo 'file accessed';

$test = check_for_alerts(27, $GLOBALS['tempAlert'], $GLOBALS['tempWarning'], 'not chnaged');

echo "<br>$test";

*/

?>
<style>
    .header-circle {
        border-bottom: 1px solid black;
        margin-top: 0px;
        height: 50px;
        text-align: center;
    }
    .uganda_DC :hover {
        cursor: pointer;
    }
</style>
<div style="margin: auto; width: 700px;position: relative; height: auto;">

<div class="circle-template">
    <h1 class="header-circle">Uganda</h1>
    <div style="height: 150px; width: 150px;margin: auto; position: relative;">

        <div class="uganda_DC" id="ug_mutundwe" style="border-radius: 150px 0 30px 0; position: absolute;top: 0;left: 0;
        <?php background_setter($uganda_mutundwe);?>">
            <span class="dc-label" style="right: 10px; bottom: 20px;">Mutundwe</span>
        </div>

        <div class="uganda_DC" id="ug_plot77" style="border-radius: 0 150px 0 30px; position: absolute;top: 0;right: 0;
        <?php background_setter($uganda_plot77);?>">
            <span class="dc-label" style="left: 10px; bottom: 20px;">Plot 77</span>
        </div>

        <div class="uganda_DC" id="ug_mbuyaGFL" style="border-radius: 0 30px 0 150px; position: absolute;bottom: 0;left: 0;
        <?php background_setter($uganda_mbuyaGFL);?>">
            <span class="dc-label" style="right: 10px; top: 20px;">Mbuya GFL</span>
        </div>

        <div class="uganda_DC" id="ug_mbuya2nFL" style="border-radius: 30px 0 150px 0; position: absolute;bottom: 0;right: 0;
        <?php background_setter($uganda_mbuya2ndFL);?>">
            <span class="dc-label" style="left: 10px; top: 20px;">Mbuya 2ndFL</span>
        </div>

    </div>

</div>

<div class="circle-template">
    <h1 class="header-circle">Zambia</h1>
    <div id="zambia_dc" style="border: 1px solid blue; height: 150px; width: 150px;margin: auto;  border-radius: 150px; <?php background_setter($zambia);?>">

    </div>

</div>

<div class="circle-template">
    <h1 class="header-circle">Swaziland</h1>
    <div id="swaziland_dc" style="border: 1px solid blue; height: 150px; width: 150px;margin: auto; border-radius: 150px; <?php background_setter($swaziland);?>">

    </div>

</div>

</div>

<script>
    $(document).ready(function (){

        $('#ug_mutundwe').click(function () {
            window.location.href = 'dash_mutundwe.php';
            //$('.content-wrapper').load('assets/php/mutundwe.php');
        });

        $('#ug_mbuyaGFL').click(function () {
            window.location.href = 'dash_mbuya_groundF.php'
            //$('.content-wrapper').load('assets/php/mbuya_ground_floor.php');
        });

        $('#ug_mbuya2nFL').click(function () {
            window.location.href = 'dash_mbuya_secondF.php'
            //$('.content-wrapper').load('assets/php/mbuya_second_floor.php');
        });

        $('#zambia_dc').click(function () {
            window.location.href = 'dash_zambia.php';
            //$('.content-wrapper').load('assets/php/zambia.php');
        });
        $('#swaziland_dc').click(function () {
            window.location.href = 'swaziland.php';
            //$('.content-wrapper').load('assets/php/swaziland.php');
        });
        $('#ug_plot77').click(function () {
            window.location.href = 'dash_plot77.php';
        });

    });
</script>







