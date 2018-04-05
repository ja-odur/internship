<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 7/20/17
 * Time: 9:31 AM
 */
?>

<?php
//include ('db_credentials.php');






function insertIntoDB( $serverName, $serverIP, $deviceName, $deviceID, $deviceIdTimeDate, $date_time, $date, $time, $tempC, $maxTemp, $minTemp, $humidity,
                      $maxHum, $minHum, $airflow, $maxAirflow, $minAirflow)
{
   

    $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);


// Check connection
    if (!$conn) {
        echo "<script> console.log('failed') </script>";
    }


  $query = sprintf("INSERT INTO Devices ( serverName, serverIP, deviceName, deviceID, deviceIdTimeDate, date_time, date, time, tempC, maxTemp, minTemp, humidity,
        maxHum, minHum, airflow, maxAirflow, minAirflow)
        VALUES ( '$serverName', '$serverIP', '$deviceName', '$deviceID', '$deviceIdTimeDate', '$date_time', '$date', '$time', '$tempC', '$maxTemp', '$minTemp', '$humidity',
        '$maxHum', '$minHum', '$airflow', '$maxAirflow', '$minAirflow')");

if(!mysqli_query($conn,$query)){
    //$error = mysqli_error($conn);
    //echo $error;
    ?>
    <script> console.log('Not inserted  duplicate time') </script>
    <?php
}



$conn->close();

}




?>

<?php

function insert_intoDB_alarms($deviceIdDateTime, $date, $time, $deviceId, $serverName, $field, $trap, $status)
{
    /*$DB_HOST = 'localhost';
    $DB_USERNAME = 'access_user';
    $DB_PASSWORD = 'access_user';
    $DB_NAME = 'snmp';*/

    $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);


// Check connection
    if (!$conn) {
        echo "<script> console.log('alarms_failed') </script>";
    }

    $query = sprintf("INSERT INTO alarms (deviceIdDateTime, date, time, deviceId, serverName, field,  trap, status)
            VALUES ('$deviceIdDateTime', '$date', '$time', '$deviceId', '$serverName', '$field', '$trap', '$status')");

    if(!mysqli_query($conn,$query)){
        //$error = mysqli_error($conn);
        //echo $error;
        ?>
        <script> console.log('Not inserted  duplicate alarms') </script>
        <?php
    }



    $conn->close();


}


//insertIntoDB ( 'odur', '132.5', 'odur12', '324', 'hgduytewujxzyu', '17-5-5 8:11:00', '17-5-5', '8:11:00', 30, 14, 15, 80,
  //  56, 13, 13, 45, 45);


?>
