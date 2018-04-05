<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 8/14/17
 * Time: 8:18 PM
 */
?>
<?php
include ("xml_connection.php");
include ("graph_function.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!empty($_POST['username']))
    {
       if($_POST['username'] == 'uganda')
       {
           xml_graph($xml_mutundwe);
           xml_graph($xml_Plot77);
           xml_graph($xml_mbuyaGroundFloor);
           xml_graph($xml_mbuyaSecondFloor);
       }
        elseif($_POST['username'] == 'zambia')
        {
            xml_graph($xml_zambia);
        }
        elseif($_POST['username'] == 'swaziland')
        {
            xml_graph($xml_swaziland);
        }
        else{}
    }


}


