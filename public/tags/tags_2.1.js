    var tags=null;
    var tag_or_hash = null;
    // var tag =[
    //
    //             {
    //                 "userid": "9062",
    //                 "name": "A.T.M Golam Mostafa",
    //                 "email": "smucricmncsp@gmail.com",
    //
    //             },
    //             {
    //                 "userid": "9082",
    //                 "name": "Abdur Rahman",
    //                 "email": "abdur.rahman@savethechildren.org"
    //             },
    //
    //
    // ];

    groups = [
        {
            "userid": "1",
            "name": "MNH",
            "email": ""
        },
        {
            "userid": "2",
            "name": "PI",
            "email": ""
        },
        {
            "userid": "3",
            "name": "Newborn",
            "email": ""
        },
        {
            "userid": "4",
            "name": "Operations",
            "email": ""
        },
        {
            "userid": "5",
            "name": "ICT Innovation",
            "email": ""
        },


    ];

    var trigger =0;
    var search_text ="";
    var caret=0;
    var all_txt = "";
    var first_part_before_caret = "";
    var last_part_after_caret = "";
    var current_tag_element_id = null;

    function load_tags(tags){

        //console.log(tags);

        //remove old values from list
        $("#tags ul").empty();

        //Add new element to list
        $.each(tags, function(i, v) {
            //if (v.name.search(new RegExp(/ja/i)) != -1) {
                $("#tags ul").append('<li data-email="'+v.email+'">'+v.name+'</li>');
            // }
        });

        // $("#tags").css({"top":$(".richText-editor").offset().top+50+"px", "left":$(".richText-editor").offset().left+20+"px"});
        $("#tags").css({"top":$(current_tag_element_id).offset().top+50+"px", "left":$(current_tag_element_id).offset().left+20+"px"});
        $("#tags").show();
    }

    function search_in_json( keycode){
    //var regex = new RegExp(keycode, "i");

        if (keycode.length <1){
            hide_tags();
            return false;
        }

        temp = [];

        reg = keycode +"\\i";

        $.each(tags, function(i, v) {
            if (v.name.search(new RegExp(keycode,"i")) != -1) {
                //console.log(v.email);
                temp.push({"userid":v.userid, "name":v.name, "email": v.email});
            }
        });

        console.log(temp);
        load_tags(temp);

    }

    function hide_tags(){
        $("#tags").hide();
    }




    function reset_triggers() {
        //reset trigger and search text
        trigger =0;
        search_text ="";
    }

    function split_text(id) {
        //all_txt = $(".richText-editor").html();
        //all_txt = $("#issue-detail").text();
        all_txt = $(id).text();
        first_part_before_caret = all_txt.substring(0,caret);
        last_part_after_caret = all_txt.substring(caret,all_txt.length);

        console.log("caret", caret);
        console.log(all_txt);
        console.log("first:", first_part_before_caret);
        console.log("last:",last_part_after_caret);
    }



    $(document).ready(function() {
    //$('#rich').richText();

    //console.log(search_text);

    $(document).on("keyup",".tags-input",function (e){
        console.log("page x:",e.keyCode);

        //Assign current element id
        current_tag_element_id = this;


        //Load Tags when pressed @=50 & #=51
        if(e.keyCode == 50 || e.keyCode == 51){

            if(e.keyCode == 50){
                tags= tag;
                tag_or_hash = "@";
            }
            else if(e.keyCode == 51){
                tags=groups;
                tag_or_hash = "#";
            }
            else{
                tags = null;
                tag_or_hash = null;
            }


            load_tags();

            //reset trigger and search text
            reset_triggers();

            //set caret of @
            caret = $(this).caret();
            //caret = 10;

            //Split up the text of richtextbox
            split_text($(this));

            trigger = 1;
            console.log("Caret pos:",caret);
            console.log("Tags",tags);
        }

        //hide tags when pressed space bar
        if(e.keyCode == 32){
            hide_tags();

            trigger =0;
            search_text ="";


        }

        //Adding new character to search text while typing
        if (trigger == 1)
        {
            if(e.keyCode != 50 && e.keyCode != 51 && e.keyCode != 32 && e.keyCode != 16 && e.keyCode != 8  )
            {
                search_text += String.fromCharCode(e.keyCode);
                search_in_json(search_text);
            }

            // When backspace is pressed
            if(e.keyCode == 8){
                search_text = search_text.substring(0, search_text.length-1);
                search_in_json(search_text);

            }

            //console.log("Search Text: ", search_text.length);
        }

    });

    $(document).on("click",".tags-input",function (){
    hide_tags();
    reset_triggers();

    //cursorPos = $(".richText-editor");
    //console.log("cursor pos:",$('.richText-editor').caret());

});


    //Click on suggestion list
    $(document).on("click","#tags ul li", function (){


        txt = first_part_before_caret;
        //txt += "<span style=\"background-color:#FF0;\">"+$(this).html()+"</span>&nbsp;";

        if(tag_or_hash == "@"){
            txt += "["+$(this).data('email')+"] ";

            //txt += "<span style=\"background-color:#FF0;\" data-email=\""+$(this).data('email')+"\">"+$(this).html()+"</span>&nbsp;";
        }

        if(tag_or_hash == "#"){
            txt += "["+$(this).html()+"] ";
        }

        txt += last_part_after_caret;

        //txt = $('.richText-editor') as  HTMLInputElement;

        console.log("Curser pos before concat:",caret);

        //$('#rich').val('');
        //$('.richText-editor').html('');
        //try{
        //$('#rich').insertText(' <span style="bakground-color:#FF0;">Shahed</span> ', caret);
        $(current_tag_element_id).html(txt);
        //$('.richText-editor').html($('#rich').val());

        $("#tags").hide();

        //}catch (e) {

        // }

        // $('.richText-editor').html(txt);

    });

});