<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 8/2/17
 * Time: 10:02 PM
 */
include('db_credentials.php');

ini_set("display_errors", 1);
error_reporting(E_ALL);

$array = array();
$set_string = '';




if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!empty($_POST['tempAlert']))
    {
        $tempAlert = $_POST['tempAlert'];
        $tempAlertLabel = 'tempAlert';
        $array[$tempAlertLabel] = "$tempAlert";
    }

    if(!empty($_POST['tempWarning']))
    {
        $tempWarning = $_POST['tempWarning'];
        $tempWarningLabel = 'tempWarning';
        $array[$tempWarningLabel] = "$tempWarning";
    }

    if(!empty($_POST['tempOK']))
    {
        $tempOK = $_POST['tempOK'];
        $tempOKLabel = 'tempOK';
        $array[$tempOKLabel] = "$tempOK";
    }

    if(!empty($_POST['humAlert']))
    {
        $humAlert = $_POST['humAlert'];
        $humAlertLabel = 'humAlert';
        $array[$humAlertLabel] = "$humAlert";
    }

    if(!empty($_POST['humWarning']))
    {
        $humWarning = $_POST['humWarning'];
        $humWarningLabel = 'humWarning';
        $array[$humWarningLabel] = "$humWarning";
    }

    if(!empty($_POST['humOK']))
    {
        $humOK = $_POST['humOK'];
        $humOKLabel = 'humOK';
        $array[$humOKLabel] = "$humOK";
    }

    if(!empty($_POST['airAlert']))
    {
        $airAlert = $_POST['airAlert'];
        $airAlertLabel = 'airAlert';
        $array[$airAlertLabel] = "$airAlert";
    }

    if(!empty($_POST['airWarning']))
    {
        $airWarning = $_POST['airWarning'];
        $airWarningLabel = 'airWarning';
        $array[$airWarningLabel] = "$airWarning";
    }

    if(!empty($_POST['airOK']))
    {
        $airOK = $_POST['airOK'];
        $airOKLabel = 'airOK';
        $array[$airOKLabel] = "$airOK";
    }

}
$numItems = count($array);
$counter = 0;

foreach ($array as $key=>$value)
{
    if(++$counter === $numItems)
    {
        $set_string = $set_string . "$key" . "=" . "\"" . $value . "\"";
    }
    else
    {
        $set_string = $set_string . "$key" . "=" . "\"" . $value . "\"" . ', ';
    }

}




if(!empty($set_string))
{
    $sql = sprintf("UPDATE parameter_value_setup SET $set_string WHERE country = 'All' ");
    $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $result = $conn->query($sql);
    if (!$result) {
        echo $conn->error;
    }
    $conn->close();

    echo 'Data sent';
}
else
{
   echo 'All fields are empty' ;
}




