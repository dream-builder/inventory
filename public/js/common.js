//validation

function CheckRequired(selector){
    var result = true;
    if (!selector) {
        selector = "form"
    }
    $(selector).find("input.required, select.required, textarea.required").each(function(i, item){
        if ($(item).val() == "") {
            result = false;
            $(this).addClass("error");
            MarkCross($(this).closest(".form-group").find("label"), true);
        }
        else{
            MarkCross($(this).closest(".form-group").find("label"), false);
        }
    });
    return result;
}
function MarkCross(selector, invalid){
    $(selector).find("span").remove();

    if (invalid) {
        $(selector).append('<span>&nbsp;</span><span class="text-red fa fa-close"></span>');
        $(selector).css({'color':'red'});
    }
    else{
        $(selector).append('<span>&nbsp;</span><span class="text-green fa fa-check"></span>');
        $(selector).css({'color':'black'});

    }
}
function InitErrorChange(){
    $(".error").on("change", function(){
        if($(this).val()){
            $(this).closest(".form-group").find("label").find("span").remove();
            $(this).closest(".form-group").find("label").append('<span>&nbsp;</span><span class="text-green fa fa-check"></span>');
            $(this).closest(".form-group").find("label").css({'color':'black'});
        }
    }).addClass("linked");
}
function Validate(title,msg){
    var result = CheckRequired();
    if (!result) {
        ShowErrorMsg(title, msg);
        InitErrorChange();
        $(".alert").show();
    }
    return result;
}

function ShowSuccessMsg(title, msg){
    swal({
        title: title,
        text: msg,
        type: "success",
        confirmButtonColor: "#007AFF"
    });
}

function ShowErrorMsg(title, msg){
    swal({
        title: title,
        text: msg,
        type: "error",
        confirmButtonColor: "#007AFF"
    });
}