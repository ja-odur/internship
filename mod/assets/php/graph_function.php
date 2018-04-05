<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 8/14/17
 * Time: 8:27 PM
 */
?>
<?php

function xml_graph($xml)
{

    foreach($xml->devices->device as $devices){
        $id = $devices->attributes()->id;
        $name = $devices->attributes()->name;


        ?>
        <div class="graph-template">
            <h4 style="text-align: center; margin-bottom: 0;width: 450px;"><?php echo $name;?></h4>
            <canvas id="<?php echo 'id'.$id;?>" style="width: 350px; height:250px;"></canvas>
        </div>
        <script>
            graph("<?php echo $id;?>");
        </script>

        <?php

    }

}
