$(document).ready(function () {


   $('#submit').click(function () {
       var tempAlert = $('#tempAlert').val();
       var tempWarning = $('#tempWarning').val();
       var tempOK = $('#tempOK').val();
       var humAlert = $('#humAlert').val();
       var humWarning = $('#humWarning').val();
       var humOK = $('#humOK').val();
       var airAlert = $('#airAlert').val();
       var airWarning = $('#airWarning').val();
       var airOK = $('#airOK').val();

        $.ajax({
            type: "post",
            url: "process_form.php",
            data:{
                tempAlert:tempAlert,
                tempWarning:tempWarning,
                tempOK:tempOK,

                humAlert:humAlert,
                humWarning:humWarning,
                humOK:humOK,

                airAlert:airAlert,
                airWarning:airWarning,
                airOK:airOK
            },
            success: function (data) {
                $('#msg').html(data);
                alert(data);
            }
        });
        return false;
   });

   $('#label_default_values').click(function () {
       if($("#checkbox_default_values").is(':checked')){

           $('#form-wrapper').hide();

           var tempAlert = 24;
           var tempWarning = 20;

           var humAlert = 60;
           var humWarning = 50;

           var airAlert = 60;
           var airWarning = 50;

           alert('default values set.');


           $.ajax({
               type: "post",
               url: "process_form.php",
               data:{
                   tempAlert:tempAlert,
                   tempWarning:tempWarning,

                   humAlert:humAlert,
                   humWarning:humWarning,

                   airAlert:airAlert,
                   airWarning:airWarning,
               },
               success: function (data) {
                   $('#msg').html(data);

               }
           });
       }
       else
       {
           $('#form-wrapper').show();
           alert('default values unset.')
       }
   });

    $('#submit_new_user').click(function () {
        var username = $('#username').val();
        var password = $('#password').val();
        var password_verify = $('#password_verify').val();
        var check_status = 'false';
        var sessionID = $('#hiddenField').val();

        if($("#checkbox_default").is(':checked')){
            check_status = 'true';
        }

        $.ajax({
            //dataType: 'json',
            type: "post",
            url: "process_newAccount.php",
            data:{
                username:username,
                password:password,
                password_verify:password_verify,
                check_status:check_status,
                sessionID:sessionID
            },
            success: function (data) {

                var arr = JSON.parse(data);

                //alert(arr["$username_error"]);
                $('#username_error').html(arr["$username_error"]);
                $('#password_error').html(arr["$password_error"]);
                $('#password').val('');
                $('#password_verify').val('');
                $('#ses').html(arr['$success']);
                if(arr['$success'] != null)
                {
                    $('#username').val('');
                    alert(arr['$success']);
                }


            },
            error: function (){
                alert('Could not load data');
            }
        });
        return false;
    });

   $('#logout').click(function (event) {
       event.preventDefault();
       var username = $('#hiddenField').val();

       $.ajax({
            type: "post",
            url:"destroy_session.php",
            data:{username:username},
            success: function () {
                window.location.href = 'login.php';
            }
        });
   });

    $('#settings').click(function (event) {
        event.preventDefault();
        var username = $('#hiddenField').val();

        $.ajax({
            type: "post",
            url:"session_fill.php",
            data:{username:username},
            success: function () {
                window.location.href = 'setting_loginAccounts.php';
            }
        });
    });

    $('#param_settings').click(function (event) {
        event.preventDefault();
        var username = $('#hiddenField').val();

        $.ajax({
            type: "post",
            url:"session_fill.php",
            data:{username:username},
            success: function () {
                window.location.href = 'settings.php';
            }
        });
    });


});