<?php
/**
 * Created by PhpStorm.
 * User: ja
 * Date: 8/14/17
 * Time: 10:21 AM
 */
?>



<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);


include ('assets/php/xml_connection.php');
//include("insert_intoDB.php");


function xml_graph($xml)
{

    foreach($xml->devices->device as $devices){
        $id = $devices->attributes()->id;
        $name = $devices->attributes()->name;

        ?>
        <div style="width: auto; height: auto; margin-left: 30px;">
            <h3 style="text-align: center; margin-bottom: 0;width: 700px;"><?php echo $name;?></h3>
            <canvas id="<?php echo "id".$id;?>" style=" width: 700px; height:auto;border: 1px solid red;"></canvas>
        </div>
        <script>
            graph("<?php var_export($id);?>");
        </script>

        <?php

    }


}


?>


<?php
    xml_graph($xml_mutundwe);
?>







