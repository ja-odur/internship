


$(document).ready(function () {
    $('.content-wrapper').load('./assets/php/xml_dataAlert.php');
    setInterval(function () {
        $('.content-wrapper').load('./assets/php/xml_dataAlert.php');
    }, 5000);



    $('.navButton').click(function () {

        $('.verticalNav').toggle(600);

        $('.content-wrapper ').toggleClass('zoom-content-wrapper');
        $('.navButton ').toggleClass('zoom-content-wrapper');

        $('#button1').toggle(500);
        $('#button2').toggle(1000);

    });


    $('.graphButton').click(function () {
        $('.graph-canvas').toggle();

        var graphButton = $('.graphButton');

        if(graphButton.html() == 'SHOW GRAPHS') {
            graphButton.html('HIDE GRAPHS');
        }
        else{
            graphButton.html('SHOW GRAPHS');
        }
    });



    $('#display_trends').hide();
    $('#parent').hide();

});

