<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 8/7/17
 * Time: 4:24 PM
 */

ini_set("display_errors", 1);
error_reporting(E_ALL);

$session_id = $_POST['username'];
session_id("$session_id");
session_start();
$_SESSION['usern@me_w@tchd0g_r00t'] = $session_id;
session_write_close();