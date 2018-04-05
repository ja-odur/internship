<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 8/15/17
 * Time: 9:52 PM
 */
?>
<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

include ('xml_connection.php');
include ('db_credentials.php');
include("insert_intoDB.php");
include ('alarm_values.php');

$GLOBALS['alarm_counter'] = $GLOBALS['alert_counter'] = $GLOBALS['warning_counter'] = 0;

$array = array();
$test = 0;


function alarm_checker($xml, $test)
{
    $serverName = $xml->attributes()->host; // host
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

        $tempC = $maxTemp = $minTemp = $humidity = $maxHum = $minHum = $airflow =$maxAirflow = $minAirflow = null;

        foreach($devices->field as $field){
            $key = $field->attributes()->key;

            if($key == "TempC" || $key == "Humidity" || $key == "Airflow"){
                $value = $field->attributes()->value;
                $minValue = $field->attributes()->min;
                $maxValue = $field->attributes()->max;
                $niceName = $field->attributes()->niceName;


                if($key == "TempC"){
                    $tempC = $value; $maxTemp = $maxValue; $minTemp = $minValue;

                    if($tempC > $GLOBALS['tempAlert'])
                    {
                       $GLOBALS['alert_counter'] += 1;
                       //$test += 1;
                    }
                    elseif ($tempC > $GLOBALS['tempWarning'])
                    {
                        $GLOBALS['warning_counter'] += 1;
                        //$test += 1;
                    }
                    else{}
                }
                elseif($key == "Humidity"){
                    $humidity = $value; $maxHum = $maxValue; $minHum = $minValue;

                    if($humidity > $GLOBALS['humAlert'])
                    {
                        $GLOBALS['alert_counter'] += 1;
                    }
                    elseif ($humidity > $GLOBALS['humWarning'])
                    {
                        $GLOBALS['warning_counter'] += 1;
                    }
                    else{}
                }
                else {
                    $airflow = $value; $maxAirflow = $maxValue; $minAirflow = $minValue;

                    if($airflow > $GLOBALS['airAlert'])
                    {
                        $GLOBALS['alert_counter'] += 1;
                    }
                    elseif ($airflow > $GLOBALS['airWarning'])
                    {
                        $GLOBALS['warning_counter'] += 1;
                    }
                    else{}

                }

            }



        }

        insertIntoDB($serverName, $serverIP, $name, $id, $deviceIdTimeDate,  $date_time, $date, $time, $tempC, $maxTemp, $minTemp, $humidity,
            $maxHum, $minHum, $airflow, $maxAirflow, $minAirflow);

    }


    foreach ($xml->alarms->alarm as $alarm) {
        $status = $alarm->attributes()->status;

        if ($status == "Tripped") {
            $alarmNum = $alarm->attributes()->{"alarm-num"};
            $deviceId = $alarm->attributes()->{"device-id"};
            $trap = $alarm->attributes()->trap;
            $field_value = $alarm->attributes()->field;


            $deviceIdDateTime = $deviceId . $date_time;

            insert_intoDB_alarms($deviceIdDateTime, $date, $time, $deviceId, $serverName, $field_value, $trap, $status);

            foreach ($xml->devices->device as $devices) {
                $id = $devices->attributes()->id;
                $name = $devices->attributes()->name;
                $deviceIdTimeDate = $id . $date_time;

                if ($deviceId == "$id") {

                    foreach ($devices->field as $field) {
                        $key = $field->attributes()->key;
                        if($key == "TempC" || $key == "Humidity" || $key == "Airflow")
                        {
                            if ($key == "TempC") {
                                $key = "tempC";
                            } elseif ($key == "Humidity") {
                                $key = "humidity";
                            } else {
                                $key = "airflow";
                            }
                        }


                        if ($key == "$field_value") {
                            $value = $field->attributes()->value;
                            $niceName = $field->attributes()->niceName;

                            $GLOBALS['alert_counter'] += 1;

                        }

                    }

                }
            }


        }


    }


}


alarm_checker($xml_mutundwe, $test);

$GLOBALS['alarm_counter'] = $GLOBALS['alert_counter'] + $GLOBALS['warning_counter'];

$array['alarm_counter'] =$GLOBALS['alarm_counter'];
$array['alert_counter'] =$GLOBALS['alert_counter'];
//$array['alert_counter'] =$test;
$array['warning_counter'] =$GLOBALS['warning_counter'];

print json_encode($array)


?>

