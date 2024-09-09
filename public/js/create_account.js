$(document).ready(function (){
    $("#email").focusout(function(){

        email = $("#email").val();
        //email = "mfazlur.rahman11@savethechildren.org";

        var data_post = {
            email: email
        };

        $.ajax({
            type: "GET",
            url: "is_account_exists",
            data: data_post,
            cache: false,
            success: function(data){
                console.log(data);
                //alert("test");
                if(data=="1") {
                    $("#email").val("");
                    sweetAlert('Account already exists with this email address. If you forget your password then reset it');
                }
                else
                {

                }

            }
        });
        /*$(this).val("");
        sweetAlert('Account already exists with this email address. If you forget your password then reset it');*/

    });

});

function check_email(){}

//create-account
$(document).on('click',"#create-account",function(){
//$("#create-account").click(function (){
    //alert("test");

    name = $("#name").val();
    email = $("#email").val();
    password = $("#password").val();

    if($("#name").val()==''){
        sweetAlert('Name is required');
        return false;
    }

    if($("#email").val()==''){
        sweetAlert('Email address is required');
        return false;
    }

    if(!validateEmail(email)){
        sweetAlert('Email address invalid');
        return false;
    }

    if($("#password").val()==''){
        sweetAlert('Password is required');
        return false;
    }

    if($("#Confirmpassword").val()==''){
        sweetAlert('Confirm password is required');
        return false;
    }

    if($("#password").val()!=$("#Confirmpassword").val()){
        sweetAlert('Password does not matched');
        return false;
    }




    var data_post ={
        //user_id: $("#name").val(),
        name: $("#name").val(),
        email: email,
        password:$("#password").val()

    };

    /* var data_post ={
         email: email
     }*/

    $(".app-loader").show();
    $.ajax({
        type: "GET",
        url: "create_account",
        data: data_post,
        cache: false,
        success: function(data){
            //alert(data);
            //sweetAlert(data);
            if(data=="1") {
                sweetAlert('Account created successfully.');
                $("#name").val('');
                $("#password").val('');
                $("#Confirmpassword").val('');
                $("#email").val('')
            }

            $(".app-loader").hide();
        }
    });

});