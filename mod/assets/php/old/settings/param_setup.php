<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 8/7/17
 * Time: 3:43 PM
 */
?>

<div class="container">
    <h1 class="content-header">WATCHDOG <small>Dashboard </small> <small>PARAMETER SETUP</small></h1>


    <div class="param-setup-wrapper">

        <div class="container-fluid" style="margin: auto;">
            <div>

                <div class="form-group">
                    <label>Temperature:</label>
                    <input type="number" name="tempAlert" id="tempAlert" class="form-control" placeholder="Enter Alert value" >
                    <input type="number" name="tempWarning" id="tempWarning" class="form-control" placeholder="Enter warning value" >
                    <input type="hidden" name="tempOK" id="tempOK" class="form-control" placeholder="Enter acceptable value(Max)" >
                </div>

                <div class="form-group">
                    <label>Humidity: </label>
                    <input type="number" name="humAlert" id="humAlert" class="form-control" placeholder="Enter Alert value">
                    <input type="number" name="humWarning" id="humWarning" class="form-control" placeholder="Enter warning value" >
                    <input type="hidden" name="humOK" id="humOK" class="form-control" placeholder="Enter acceptable value(Max)" >
                </div>

                <div class="form-group">
                    <label >Airflow: </label>
                    <input type="number" name="airAlert" id="airAlert" class="form-control" placeholder="Enter Alert value">
                    <input type="number" name="airWarning" id="airWarning" class="form-control" placeholder="Enter warning value" >
                    <input type="hidden" name="airOK" id="airOK" class="form-control" placeholder="Enter acceptable value(Max)" >
                </div>

                <div>
                    <input type="submit" id = "submit" value="send data">
                    <!--<button id ="submit" >Submit data</button>-->
                </div>

            </div>

        </div>

        <p id="msg" ></p>

    </div>
    <h1 id="ses"></h1>
</div>

