<html>
<head>
    <!-- rich text -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset("public/richtext/src/richtext.min.css") }}">



    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="{{ asset ("public/richtext/src/jquery.richtext.min.js") }}"></script>
    <script src="{{ asset ("public/richtext/src/jquery.caret.js") }}"></script>


    <script src="{{ asset ("public/richtext/src/jquery-insert-text.js") }}"></script>

    <style>
        #tags{
            position: absolute;
            width:300px;

            max-height: 400px;
            height: auto;
            background: #F1f1f1;
            border: solid 1px #DDD;
            overflow-y: auto;
            z-index: 1001;
            display: none;

        }

        #tags ul{
            margin: 0px;
            list-style: none;
            padding: 0px;
        }

        #tags ul li{
            padding: 10px 5px;
            font-family: Arial;
            font-size: 1em;
            border-bottom:solid 1px #FFF;
        }

        #tags ul li:hover{
            background-color: #FFF;
        }
    </style>
</head>

<body>
<textarea id="rich" style="width: 600px; height: 300px; display: none" ></textarea>

<div id="live"></div>
<div id="richs" contenteditable="true" style="width: 100%; height: 150px; border:solid 1px #DDD;"></div>


<div id="tags">
    <ul>
    </ul>
</div>
</body>

<script>

    var tags =[
        {"userid":"260000","name":"Shahed"},
        {"userid":"260001","name":"Jamil Anwar Zaman"},
        {"userid":"260002","name":"Janel Gomej"},
        {"userid":"261111","name":"system_mail"},
        {"userid":"269123","name":"Rima Pal"},
        {"userid":"269700","name":"Fazlur Rahman"},
        {"userid":"9000","name":"Umme Salma Jahan Meena"},
        {"userid":"9001","name":"Md. Murad Ahamed Khan"},
        {"userid":"9002","name":"Nakul Kumar Biswas"},
        {"userid":"9003","name":"Mohammad Mamun-Ur-Rashid"},
        {"userid":"9004","name":"Shumona Shafinaz"},
        {"userid":"9005","name":"Md. Nazrul Islam"},
        {"userid":"9006","name":"Md. Azharul Islam"},
        {"userid":"9007","name":"Matiar Rahman"},
        {"userid":"9008","name":"md.feroz akter"},
        {"userid":"9009","name":"Mohammad Rafique"},
        {"userid":"9010","name":"Saha, Narayan"},
        {"userid":"9012","name":"Mamun Bhuyan"},
        {"userid":"9013","name":"Dr. Muntasir Moin Nabil"},
        {"userid":"9014","name":"Minara Chowdhury"},
        {"userid":"9015","name":"Nazmoon Nahar"},
        {"userid":"9016","name":"Afsana Karim"},
        {"userid":"9017","name":"Kazi Md. Sofiul Kabir"},
        {"userid":"9018","name":"Sanjida Alam"},
        {"userid":"9019","name":"Ishrat Apa"},
        {"userid":"9020","name":"Moniruzzaman"},
        {"userid":"9021","name":"Jesmin Akter"},
        {"userid":"9022","name":"S. M. Sabbir Ahammed"},
        {"userid":"9023","name":"Md.Jalal Uddin"},
        {"userid":"9024","name":"Md.Alamgir Hossain"},
        {"userid":"9025","name":"Md. Feroz Kabir"},
        {"userid":"9026","name":"Feroj Al Mojahid"},
        {"userid":"9027","name":"S.M. Rofiquzzaman"},
        {"userid":"9028","name":"Kishor Mishra"},
        {"userid":"9029","name":"Bishwajit Kantho Dev"},
        {"userid":"9030","name":"Syed Salik Ahmed"},
        {"userid":"9031","name":"Biswajith Kumar Saha"},
        {"userid":"9032","name":"Dilip Chandra Das"},
        {"userid":"9033","name":"Md. Waliul Islam"},
        {"userid":"9034","name":"Shakil Ahmed Khan"},
        {"userid":"9035","name":"Roushan Ara Begum"},
        {"userid":"9037","name":"Md. Abu Nausher Ali"},
        {"userid":"9038","name":"Md. Enamul Haque"},
        {"userid":"9040","name":"T A Robin"},
        {"userid":"9041","name":"ANM Ehtesham Kabir"},
        {"userid":"9043","name":"Mohd. Aziz Khan"},
        {"userid":"9044","name":"Ziaur Rahman"},
        {"userid":"9045","name":"Sujan Moy Chowdhury"},
        {"userid":"9046","name":"Md. Imrul Hasan"},
        {"userid":"9047","name":"Md. Abul Kalam Azad "},
        {"userid":"9048","name":"Md: Azahar Ali Miah "},
        {"userid":"9049","name":"S.M.Harun-Or-Rashid"},
        {"userid":"9050","name":"Chameli Akter"},
        {"userid":"9051","name":"Faridul Julfiker"},
        {"userid":"9052","name":"Proshanta Kumar Mondal "},
        {"userid":"9053","name":"Dr. Utpal Kumar Barua "},
        {"userid":"9054","name":"Md. Moktatherul Haque "},
        {"userid":"9055","name":"Md. Antaz Uddin"},
        {"userid":"9056","name":"Md.Rabiul Islam "},
        {"userid":"9057","name":"Kajal Kanto Das "},
        {"userid":"9058","name":"Altaf Hossen"},
        {"userid":"9059","name":"Sheikh Md. Abdul Khaleque"},
        {"userid":"9060","name":"Ripan Kumar Paul"},
        {"userid":"9061","name":"Md. Ahsan Habib"},
        {"userid":"9062","name":"A.T.M Golam Mostafa"},
        {"userid":"9063","name":"Imrul Hasan "},
        {"userid":"9064","name":"MD. Abdur ROB PATWARY  "},
        {"userid":"9065","name":"Harej Al-Mamun"},
        {"userid":"9066","name":"Mohammed Zahorul Islam"},
        {"userid":"9067","name":"Maysa Tabassum"},
        {"userid":"9068","name":"Nurul Alam"},
        {"userid":"9069","name":"Nilu Kanto Paul"},
        {"userid":"9070","name":"Md. Rafiqul Islam"},
        {"userid":"9071","name":"Md. Kamal Hossain"},
        {"userid":"9072","name":"Md. Zakir Hossain"},
        {"userid":"9073","name":"Md. Mahmud Hassan Talukdar"},
        {"userid":"9074","name":"Shawkat Ara"},
        {"userid":"9075","name":"Dr. A. H. Md. Rezanur Shakil"},
        {"userid":"9076","name":"Tangina Saharin Siddique"},
        {"userid":"9077","name":"Wahiduzzaman"},
        {"userid":"9078","name":"Dibyendu Biswas"},
        {"userid":"9079","name":"Md. Khursidul Islam"},
        {"userid":"9080","name":"Md Kamruzzaman"},
        {"userid":"9081","name":"Mohammad Nurul Absar"},
        {"userid":"9082","name":"Abdur Rahman"},
        {"userid":"9083","name":"Md. Abdus Salam"},
        {"userid":"9084","name":"Husna Banu Rani"},
        {"userid":"9085","name":"Sumon Kumar Biswas"},
        {"userid":"9086","name":"Md. Shahidullah"},
        {"userid":"9087","name":"Mostafa Qumrul Hassan"},
        {"userid":"9088","name":"Md. Alam Biswas"},
        {"userid":"9089","name":"Mrinal Kanti Sarkar"},
        {"userid":"9090","name":"Abdur Rouf Sardar"},
        {"userid":"9091","name":"Bivakar Roy"},
        {"userid":"9092","name":"Anjuman Begum"},
        {"userid":"9093","name":"Md. Maksud-ul Hasan"},
        {"userid":"9094","name":"Faridul Zulfikar"},
        {"userid":"9095","name":"Proshanta Kumar Mondal"},
        {"userid":"9096","name":"Md. Abdur Rahman"},
        {"userid":"9097","name":"Parimal Saha"},
        {"userid":"9098","name":"Md. Ashraful Alam Mondul"},
        {"userid":"9099","name":"Md. Jamidul Islam"},
        {"userid":"9100","name":"Md. Jamal Uddin "},
        {"userid":"9101","name":"Md. Masuduzzaman"},
        {"userid":"9102","name":"Mst. Mazeda Khatun"},
        {"userid":"9103","name":"Hossen, Iftekhar"},
        {"userid":"9104","name":"Md. Golam Mostafa"},
        {"userid":"99999","name":"Admin"}

    ];

    function load_tags(tags){

        //console.log(tags);

        //remove old values from list
        $("#tags ul").empty();

        //Add new element to list
        $.each(tags, function(i, v) {
            //if (v.name.search(new RegExp(/ja/i)) != -1) {
                $("#tags ul").append('<li>'+v.name+'</li>');
           // }
        });

       // $("#tags").css({"top":$(".richText-editor").offset().top+50+"px", "left":$(".richText-editor").offset().left+20+"px"});
        $("#tags").css({"top":$("#richs").offset().top+50+"px", "left":$("#richs").offset().left+20+"px"});
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
                temp.push({"userid":v.userid, "name":v.name});
            }
        });

        console.log(temp);
        load_tags(temp);

    }

    function hide_tags(){
        $("#tags").hide();
    }


    var trigger =0;
    var search_text ="";
    var caret=0;
    var all_txt = "";
    var first_part_before_caret = "";
    var last_part_after_caret = "";

    function reset_triggers() {
        //reset trigger and search text
        trigger =0;
        search_text ="";
    }

    function split_text() {
        //all_txt = $(".richText-editor").html();
        all_txt = $("#richs").text();
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

        $("#richs").on("keyup",function (e){
            //console.log("page x:",e.pageX);
            //Load Tags when pressed @
            if(e.keyCode == 50){
                load_tags();

                //reset trigger and search text
                reset_triggers();

                //set caret of @
                caret = $('#richs').caret();
                //caret = 10;

                //Split up the text of richtextbox
                split_text();

                trigger = 1;
                console.log("Caret pos:",caret);
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
                if(e.keyCode != 50 && e.keyCode != 32 && e.keyCode != 16 && e.keyCode != 8 )
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

        $(".richText-editor").on("click",function (){
            hide_tags();
            reset_triggers();

            //cursorPos = $(".richText-editor");
            console.log("cursor pos:",$('.richText-editor').caret());

        });


        //Click on suggestion list
        $(document).on("click","#tags ul li", function (){


            txt = first_part_before_caret;
            txt += $(this).html();
            txt += last_part_after_caret;

            //txt = $('.richText-editor') as  HTMLInputElement;

            console.log("Curser pos before concat:",caret);

            //$('#rich').val('');
            //$('.richText-editor').html('');
            //try{
                //$('#rich').insertText(' <span style="bakground-color:#FF0;">Shahed</span> ', caret);
                $('#richs').html(txt);
                $('.richText-editor').html($('#rich').val());

                $("#tags").hide();

            //}catch (e) {

           // }

           // $('.richText-editor').html(txt);

        });


    });

</script>
</html>