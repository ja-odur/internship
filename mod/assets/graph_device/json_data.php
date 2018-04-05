<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 7/13/17
 * Time: 2:49 PM
 */


ini_set("display_errors", 1);
error_reporting(E_ALL);

$id = $_GET['id'];
//$id = "01935D441800002D";




header('content-Type: application/json');

define('DB_HOST' ,'localhost');
define('DB_USERNAME', 'access_user');
define('DB_PASSWORD' , 'access_user');
define('DB_NAME' ,'snmp');

$mysql = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if (!$mysql) {
    die("Connection failed: " . $mysql->error);
}

$query = sprintf("SELECT time, tempC, humidity, airflow FROM Devices WHERE deviceId = '$id'");

$result = $mysql->query($query);

$data = array();

foreach ($result as $row) {
    $data[] = $row;
}

$result->close();

$mysql->close();

print json_encode($data);



