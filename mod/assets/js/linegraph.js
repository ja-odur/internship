/**
 * Created by root on 7/13/17.
 */

$(document).ready(function () {
    $.ajax({
        url : "http://localhost/graph/json_data.php",
        type : "GET", 
        
        success : function (data) {
            console.log(data);

            var userId = [];
            var facebook_follower = [];
            var twitter_follower = [];
            var googlePlus_follower = [];

            for (var i in data){
                userId.push(data[i].userid);
                facebook_follower.push(data[i].facebook);
                twitter_follower.push(data[i].twitter);
                googlePlus_follower.push(data[i].googlePlus);
            }

            var chartdata = {
                labels: userId,
                datasets: [
                    {
                        label: "facebook",
                        fill: false,
                        lineTension: 0.1,
                        backgroundColor: "rgba(59,89,152, 0.75)",
                        borderColor: "rgba(59, 89, 152, 1)",
                        pointHoverBacground: "rgba(59, 89, 152, 1)",
                        pointHoverBorderColor: "rgba(59, 89, 152, 1)",
                        data: facebook_follower
                    },
                    {
                        label: "twitter",
                        fill: false,
                        lineTension: 0.1,
                        backgroundColor: "rgba(29,202,255, 0.75)",
                        borderColor: "rgba(29, 202, 255, 1)",
                        pointHoverBacground: "rgba(29, 202, 255, 1)",
                        pointHoverBorderColor: "rgba(29, 202, 255, 1)",
                        data: twitter_follower
                    },
                    {
                        label: "googleplus",
                        fill: false,
                        lineTension: 0.1,
                        backgroundColor: "rgba(211,72,54, 0.75)",
                        borderColor: "rgba(211, 72, 54, 1)",
                        pointHoverBacground: "rgba(211, 72, 54, 1)",
                        pointHoverBorderColor: "rgba(211, 72, 54, 1)",
                        data: googlePlus_follower
                    }

                ]
            };

            var ctx = $("#mycanvas");

            var lineGraph = new Chart(ctx, {
                type: "line",
                data: chartdata
            });
        },
        error : function (data) {

        }
    });
});
