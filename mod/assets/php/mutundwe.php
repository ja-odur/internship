<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 8/6/17
 * Time: 1:39 AM
 */

?>

<h2 class="all_header">Mutundwe Data Center</h2>
<?php
include ('xml_function.php');
xmlDevice($xml_mutundwe);
?>

<script>
    $(document).ready( function () {
        clearInterval(set_interval);
    });

</script>