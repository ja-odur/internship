<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 7/20/17
 * Time: 9:39 PM
 */
?>

<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

//include("insert_intoDB.php");
//$xml = simplexml_load_file("data.xml") or die("ERROR: Cannot create object");
//$count_alarms = 0;

function alarms($xml, $count_alarms)
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



    foreach ($xml->alarms->alarm as $alarm) {
        $status = $alarm->attributes()->status;

        if ($status == "Tripped") {
            $count_alarms += 1;
            $alarmNum = $alarm->attributes()->{"alarm-num"};
            $deviceId = $alarm->attributes()->{"device-id"};
            $trap = $alarm->attributes()->trap;
            $field = $alarm->attributes()->field;
            $deviceIdDateTime = $deviceId.$date_time;

            insert_intoDB_alarms($deviceIdDateTime, $date, $time, $deviceId, $serverName, $field, $trap, $status);



           /* echo $alarmNum . ' ' . $deviceId . ' ' . $field .' '. $deviceIdDateTime.' '.$trap.' '.$status.' '.
                $date. ' '.$time.' '.$serverName. ' '.$field.'<br><br>';

           */
        }


    }

    return $count_alarms;
}

//alarms($xml, $count_alarms);
