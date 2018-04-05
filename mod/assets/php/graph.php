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


include ('xml_connection.php');
include("graph_function.php");

?>
<style>
    #graph-header> ul {
        background-color: blue;
    }
    #graph-header > ul > li > a {
        color: white;
    }
    #graph-header > ul > li > a:hover {
        background-color: white;
        color: black;
    }
    #graph-header > ul > li > a:active {
        background-color: white;
        color: black;
    }
    .active_inner > a{
        color: black !important;
        background-color: white !important;
    }
    #graph-header > ul > li > a:focus {
        background-color: white;
        font-size: 20px;
        color: black;
    }
</style>
<div class="container-fluid" id="graph-header" style="margin-top: 10px;background-color: grey;">
    <ul class="nav navbar-nav" style="margin-left: 30%;">
        <li id="graph_all" class="active_inner"><a>All</a></li>
        <li id="graph_uganda"><a>Uganda</a></li>
        <li id="graph_zambia"><a>Zambia</a></li>
        <li id="graph_swaziland"><a>Swaziland</a></li>
    </ul>
</div>

<div id="graph_container">
<?php
    xml_graph($xml_mutundwe);
    xml_graph($xml_Plot77);

    xml_graph($xml_zambia);
    xml_graph($xml_mbuyaGroundFloor);
    xml_graph($xml_mbuyaSecondFloor);

    xml_graph($xml_swaziland);
?>
</div>
<script>
    $(document).ready(function () {

        $('#graph_all').click(function (event) {
            event.preventDefault();
            $('.content-wrapper').load('assets/header_footer/graph.header_footer');
        });

      function graph(id, username, containerId, file)
      {

          $(id).click(function (event) {
              event.preventDefault();
              $('.active_inner').removeClass('active_inner');
              $(id).addClass('active_inner');
              //$(containerId).load(file);
              $.ajax({
                  type: "post",
                  url:file,
                  data:{username:username},
                  success: function (data) {
                      $(containerId).html(data)
                  }
              });
          });
      }
        graph('#graph_uganda', 'uganda', '#graph_container', 'assets/header_footer/graph_processor.header_footer');
        graph('#graph_zambia', 'zambia', '#graph_container', 'assets/header_footer/graph_processor.header_footer');
        graph('#graph_swaziland', 'swaziland', '#graph_container', 'assets/header_footer/graph_processor.header_footer');




    });
</script>







