<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 8/3/17
 * Time: 12:59 PM
 */

ini_set("display_errors", 1);
error_reporting(E_ALL);

$session_id = $_POST['username'];
session_id("$session_id");
session_start();

session_destroy();

echo 755;
