<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 8/9/17
 * Time: 4:14 PM
 */

ini_set("display_errors", 1);
error_reporting(E_ALL);
//echo 'working <br>';

$DB_host = $DB_username = $DB_password = $DB_name = null;
$error = array();
$error['$username_error'] =  $error['$password_error'] = $error['$success'] = null;


if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (!empty($_POST['sessionID']))
    {

        session_id($_POST['sessionID']);
        session_start();
        $DB_host = isset($_SESSION['db_h0st_w@tchd0g_r00t']) ? $_SESSION['db_h0st_w@tchd0g_r00t'] : null;
        $DB_username = isset($_SESSION['db_usern@me_w@tchd0g_r00t']) ? $_SESSION['db_usern@me_w@tchd0g_r00t'] : null;
        $DB_password = isset($_SESSION['db_p@ssw0rd_w@tchd0g_r00t']) ? $_SESSION['db_p@ssw0rd_w@tchd0g_r00t'] : null;
        $DB_name = isset($_SESSION['db_n@me_w@tchd0g_r00t']) ? $_SESSION['db_n@me_w@tchd0g_r00t'] : null;
        session_write_close();

    }


    if (!empty($_POST['username'])) {
        $db_username = '';
        //$username = crypt(data_test($_POST['username']), 'watchdog');
        $username = $_POST['username'];
        $db_username = extract_similar_username($DB_host, $DB_username, $DB_password, $DB_name, $username);
        //echo " username $username <br> db_username $db_username <br>";

        if (!($username == "$db_username")) {
            if (!empty($_POST['password'])) {

                if (!empty($_POST['password_verify'])) {
                    $password_verify = $_POST['password_verify'];


                    if ($_POST['password'] == "$password_verify") {
                        if (!empty($_POST['check_status'])) {
                            if ($_POST['check_status'] == 'true') {
                                delete_default_account($DB_host, $DB_username, $DB_password, $DB_name);
                            }
                        }
                        $password_hash = crypt(data_test($password_verify), 'watchdog');
                        insert_credentials($DB_host, $DB_username, $DB_password, $DB_name, $username, $password_hash);
                        $error['$success'] = 'New user added.';
                    } else {
                        $error['$password_error'] = 'Passwords didn\'t match';
                    }
                } else {
                    $error['$password_error'] = 'Please verify password';
                }
            } else {
                $error['$password_error'] = 'Password required';
            }


        } else {
            $error['$username_error'] = 'username already exists, please choose another.';
        }

    } //end of If-username
    else {
        $error['$username_error'] = 'Username required';
    }
}


//functions

function data_test($data){
    $data = trim($data);
    $data = htmlspecialchars($data);

    return $data;
}

function extract_similar_username ($DB_host, $DB_username, $DB_password, $DB_name, $username)
{
    $conn = new mysqli($DB_host, $DB_username, $DB_password, $DB_name);

    $sql = sprintf("select username from user_authenication where username = '$username'");


    if($conn->query($sql)){
        $result = $conn->query($sql);
    }
    else
        {
            return null;
        }

    $data = array();

    foreach ($result as $row) {
        $data[] = $row;
    }



    $conn->close();
    if(!empty($data)) {
        return $data[0]['username'];
    }
    else { return null;}
}

function insert_credentials ($DB_host, $DB_username, $DB_password, $DB_name, $username, $password)
{
    $conn = new mysqli($DB_host, $DB_username, $DB_password, $DB_name);

    $sql = sprintf("insert into  user_authenication (username, password) values ('$username', '$password')");

    $conn->query($sql);

    $conn->close();

}
function delete_default_account ($DB_host, $DB_username, $DB_password, $DB_name)
{
    $conn = new mysqli($DB_host, $DB_username, $DB_password, $DB_name);

    $sql = sprintf("delete from  user_authenication where username ='admin'");
   // $sql = sprintf("delete from  user_authenication where username ='wa1sf3hIexnqU'");

    $conn->query($sql);



    $conn->close();

}



print json_encode($error);


