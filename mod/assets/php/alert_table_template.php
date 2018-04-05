<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 8/3/17
 * Time: 2:46 PM
 */
?>

<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);

include ('xml_connection.php');
//include("insert_intoDB.php");

function xmlDevice($xml)
{
    $serverName = $xml->attributes()->host; // host
    $serverIP = $xml->attributes()->address; //ip address


    $dateTime = $xml->attributes()->datetime; //date and time
    $dateTimeArray = explode(" ", $dateTime);

    $time = $dateTimeArray[2];

    $date1 = $dateTimeArray[1];
    $dateArray = explode("/", $date1);
    $aDate = array($dateArray[2], $dateArray[1], $dateArray[0]);
    $date = implode("-", $aDate);

    $date_time = implode(' ', array($date, $time));



    foreach ($xml->alarms->alarm as $alarm) {
    $status = $alarm->attributes()->status;

    if ($status == "Tripped") {
        $alarmNum = $alarm->attributes()->{"alarm-num"};
        $deviceId = $alarm->attributes()->{"device-id"};
        $trap = $alarm->attributes()->trap;
        $field_value = $alarm->attributes()->field;


        $deviceIdDateTime = $deviceId . $date_time;

        //insert_intoDB_alarms($deviceIdDateTime, $date, $time, $deviceId, $serverName, $field, $trap, $status);

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

                        if ($key == "TempC") {
                            $tempC = $value;
                            $niceNameTempC = $niceName;
                        } elseif ($key == "Humidity") {
                            $humidity = $value;
                            $niceNameHum = $niceName;
                        } else {
                            $airflow = $value;
                            $niceNameAir = $niceName;
                        }


                        ?>

                        <tr>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $niceName; ?></td>
                            <td><?php echo $value; ?></td>
                            <td><a href="#">log ticket</a></td>
                        </tr>

                        <?php

                    }

                }

            }
        }


    }


}





}




?>



<div class="container-fluid tableAlert-wrapper" id="table-wrapper">

    <h2 class="all_header"> <small>All</small> Alerts</h2>

        <table class="table table-condensed table-hover table-striped" id="tableAlert">
            <thead>
            <tr>
                <th>Device</th>
                <th>ID</th>
                <th>Parameter</th>
                <th>Value</th>
                <th>Remedy</th>
            </tr>
            </thead>
            <tbody>
            <?php
                xmlDevice($xml_mutundwe);
            ?>

            </tbody>
        </table>

</div>




