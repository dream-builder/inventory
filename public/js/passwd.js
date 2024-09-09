function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test( $email );
}

$(document).ready(function (){

    $("#reset-pass-request").click(function (){

        email = $("#email").val();

        if(!validateEmail(email)){
            alert('Email address invalid');
            return false;
        }

        var data_post ={
            email: email
        }
        $(".app-loader").show();
        $.ajax({
            type: "GET",
            url: "forgot_password_request",
            data: data_post,
            cache: false,
            success: function(data){
                //alert(data);
                sweetAlert(data);
                $(".app-loader").hide();
            }
        });

    });




    //Reset Password
    $('#reset_submit').click(function () {

        //Get Field values
        var user_id = $("#user_id").val();
        var newpass = $("#newpass").val();
        var repass = $("#repass").val();

        //Check Password validity
        if ( newpass.length < 6 || repass != newpass) {

            if (newpass.length < 6) {
                sweetAlert('Password should be minimum 6 characters long');
                return false;
            }

            if (repass != newpass) {
                sweetAlert('New pass and Re-type password dose not match');
                return false;
            }

        }

        //Generating JSON for POST
        var data_post = {
            user_id : $("#user_id").val(),
            pass: $("#newpass").val(),
            oldpass: $("#oldpass").val()
        };

        //Show loader
        $(".app-loader").show();

        //Jquery Execution started
        $.ajax({
            type: "GET",
            url: "reset_password_change",
            data: data_post,
            cache: false,
            success: function (data) {
                sweetAlert(data);

                //Clear Field
                $("#newpass").val('');
                $("#repass").val('');

                //hide loader
               $(".app-loader").hide();
            }
        });

    });


});