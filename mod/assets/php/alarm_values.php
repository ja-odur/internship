<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 8/15/17
 * Time: 10:21 PM
 */
?>
<?php

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

$GLOBALS['temperature'] = 'temp';
$GLOBALS['humidity'] = 'humidity';
$GLOBALS['airflow'] = 'airflow';

