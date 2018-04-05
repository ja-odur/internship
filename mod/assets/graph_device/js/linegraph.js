/**
 * Created by root on 7/13/17.
 */

function graph(id) {
    $(document).ready(function () {
        $.ajax({
            url: "http://localhost/mod/assets/graph_device/json_data.php?id="+id,
            type: "GET",

            success: function (data) {

                console.log(data);
                var time = [];
                var tempC = [];
                var humidity = [];
                var airflow = [];


                for (var i in data) {
                    time.push(data[i].time);
                    tempC.push(data[i].tempC);
                    humidity.push(data[i].humidity);
                    airflow.push(data[i].airflow);
                }

                var chartdata = {
                    labels: time,
                    datasets: [
                        {
                            label: "temp ",
                            fill: false,
                            lineTension: 0.8,
                            borderWidth: 1,
                            backgroundColor: "rgba(59,89,152, 0.75)",
                            borderColor: "rgba(59, 89, 152, 1)",
                            pointHoverBacground: "rgba(59, 89, 152, 1)",
                            pointHoverBorderColor: "rgba(59, 89, 152, 1)",
                            pointRadius: 0,
                            data: tempC
                        },
                        {
                            label: "Humidity",
                            fill: false,
                            lineTension: 0.1,
                            borderWidth: 1,
                            backgroundColor: "rgba(29,202,255, 0.75)",
                            borderColor: "rgba(29, 202, 255, 1)",
                            pointHoverBacground: "rgba(29, 202, 255, 1)",
                            pointHoverBorderColor: "rgba(29, 202, 255, 1)",
                            pointRadius: 0,
                            data: humidity
                        },
                        {
                            label: "airflow",
                            fill: false,
                            lineTension: 0.1,
                            borderWidth: 1,
                            backgroundColor: "rgba(211,72,54, 0.5)",
                            borderColor: "rgba(211, 72, 54, 1)",
                            pointHoverBacground: "rgba(211, 72, 54, 0.3)",
                            pointHoverBorderColor: "rgba(211, 72, 54, 0.3)",
                            pointRadius: 0,
                            data: airflow
                        }

                    ]
                };

                var opt = {
                    scales: {
                        xAxes: [{
                            display: false
                        }],
                        yAxes: [{
                            display: true
                        }],
                    },
                    animation: false,
                }



                var deviceId = "#id"+id;
                var ctx = $(deviceId);

                var lineGraph = new Chart(ctx, {
                    type: "line",
                    options: opt,
                    data: chartdata
                });
            },
            error: function (data) {

            }
        });
    });

}


