

<?php



include ('xml_connection.php');
include('all_device_template.php');
include("insert_intoDB.php");


function xmlDevice($xml)
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
        $deviceIdTimeDate = '25'.$id.$date_time;

        ?>

        <script>console.log('<?php echo $deviceIdTimeDate; ?>')</script>

        <?php

        $tempC =null; $maxTemp =null;
        $minTemp = null; $humidity =null;
        $maxHum =null; $minHum =null;
        $airflow =null; $maxAirflow =null;
        $minAirflow = null;

        foreach($devices->field as $field){
            $key = $field->attributes()->key;

            if($key == "TempC" || $key == "Humidity" || $key == "Airflow"){
                $value = $field->attributes()->value;
                $minValue = $field->attributes()->min;
                $maxValue = $field->attributes()->max;
                $niceName = $field->attributes()->niceName;


                if($key == "TempC"){
                    $tempC = $value; $maxTemp = $maxValue; $minTemp = $minValue;
                }
                elseif($key == "Humidity"){
                    $humidity = $value; $maxHum = $maxValue; $minHum = $minValue;
                }
                else {
                    $airflow = $value; $maxAirflow = $maxValue; $minAirflow = $minValue;
                }
                //echo $tempC.' '.$maxTemp.' '.$minTemp.' '.$humidity.' '.$maxHum.' '.$minHum.' '.$airflow.' '.$maxAirflow.' '.$minAirflow.'<br>';
            }



        }
        deviceTemplate ($name, $id, $tempC, $humidity, $airflow);

        insertIntoDB($serverName, $serverIP, $name, $id, $deviceIdTimeDate,  $date_time, $date, $time, $tempC, $maxTemp, $minTemp, $humidity,
            $maxHum, $minHum, $airflow, $maxAirflow, $minAirflow);



    }


}


?>




