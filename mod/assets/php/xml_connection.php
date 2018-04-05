<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 7/25/17
 * Time: 9:40 AM
 */


ini_set("display_errors", 1);
error_reporting(E_ALL);



$xml_mutundwe = simplexml_load_file("data.xml") or die("ERROR: Cannot create object");
$xml_Plot77 = simplexml_load_file("Plot77data.xml") or die("ERROR: Cannot create object");
$xml_mbuyaGroundFloor = simplexml_load_file("Mbuya_ground_data.xml") or die("ERROR: Cannot create object");
$xml_mbuyaSecondFloor = simplexml_load_file("Mbuya_2fl_data.xml") or die("ERROR: Cannot create object");
$xml_zambia = simplexml_load_file("data_zambia.xml") or die("ERROR: Cannot create object");
$xml_swaziland = simplexml_load_file("data_swaziland.xml") or die("ERROR: Cannot create object");


function connect_curl($url, $username = 'dcm', $password = 'dcm')
{
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_USERPWD, "$username:$password");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 60);

    $output = curl_exec($curl);

    if ($curl == false) {
        echo 'curl error' . curl_error($curl);
    }


    curl_close($curl);


    return simplexml_load_string($output) or die("ERROR: Cannot create object");

}

/*

$xml_mutundwe = connect_curl('10.156.201.43/data.xml');
$xml_Plot77 = connect_curl('10.156.75.159/data.xml');
$xml_mbuyaGroundFloor = connect_curl('10.156.110.67/data.xml');
$xml_mbuyaSecondFloor = connect_curl('10.156.110.66/data.xml');
$xml_zambia = connect_curl('10.110.19.23/data.xml');
$xml_swaziland = connect_curl('10.254.2.66/data.xml');
*/