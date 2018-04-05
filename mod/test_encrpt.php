<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 8/1/17
 * Time: 2:25 PM
 */
ini_set("display_errors", 1);
error_reporting(E_ALL);

include ('db_credentials.php');
$username = 'odur';
$password = 'joseph';

if(!empty($username))
{
    $username = crypt(data_test($username), 'watchdog');
    echo data_test('odur'). ' odur<br>';
    echo "$username <br>";

    $sql = sprintf("SELECT username, password FROM user_authenication WHERE username = '$username'");

    $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $result = $conn->query($sql);

    foreach ($result as $row)
    {
        $data[] = $row;
    }
    $conn->close();

    if(!empty($password))
    {
        $password = data_test($password);

        $hash = $data[0]['password'];

        if(password_verify($password, $hash))
        {
          echo 'successful';
           // exit;
        }
        else
        {
            echo 'Invalid username or password';
        }
    }
    else
    {
        echo  'password is required';
    }

}

else
{
    echo 'Username is required';
}


function data_test($data){
    $data = trim($data);
    $data = htmlspecialchars($data);

    return $data;
}
echo '<br>';

print_r($data);
