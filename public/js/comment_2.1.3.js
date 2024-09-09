var facility_id = null;
var user_id = 260000;
var comment_id = null;
var current_user=null;
var tag = null;

$(document).ready(function(){

	$("#div_dropdown").change(function(){

		$("#app-loader").show();
		$('#zilla_group').hide();
		$('#upazila_group').hide();

		$.ajax({
			type: "GET",
			url: site_url+"/getzilla",
			data: {"zillaid":$(this).val()},
			cache: false,
			success: function(data){
				console.log(data);

				//Populate Zilla Deopdown

				$("#zilla_dropdown").empty();
				$("#upazila_dropdown").empty();

				$('#zilla_dropdown').append('<option selected="selected"></option>');
				$.each( data, function( key, val ) {
					$('#zilla_dropdown').append($('<option>', {value:val.ZillaId, text:val.ZillaNameEng + ' ['+val.ZillaId+']'}));
				});

				$('#zilla_group').show('slow');

				//Hide comment panel
				$("#comment-panel").hide();

				$("#app-loader").hide();
			}
		});

	});

	$("#zilla_dropdown").change(function(){

		$("#app-loader").show();
		$('#upazila_group').hide();

		$.ajax({
			type: "GET",
			url: site_url+"/getupazila",
			data: {"zillaid":$(this).val()},
			cache: false,
			success: function(data){
				//console.log(data);

				//Populate Zilla Deopdown

				$("#upazila_dropdown").empty();

				$('#upazila_dropdown').append('<option selected="selected"></option>');

				$.each( data, function( key, val ) {

					if(val.UpazilaId<10)
						upazilaid = "0" +  val.UpazilaId;
					else
						upazilaid = val.UpazilaId;

					$('#upazila_dropdown').append($('<option>', {value:val.UpazilaId, text:val.UpazilaNameEng + ' ['+val.UpazilaId+']'}));
				});

				$("#app-loader").hide();
				//Hide comment panel
				$("#comment-panel").hide();
				$('#upazila_group').show('slow');
			}
		});

	});

	$("#upazila_dropdown").change(function(){

		$("#app-loader").show();
		//$('#upazila_group').hide();
		//Hide comment panel
		$("#comment-panel").hide();

		$.ajax({
			type: "GET",
			url: site_url+"/getfacility",
			data: {"zillaid":$("#zilla_dropdown").val(),"upazilaid":$("#upazila_dropdown").val()},
			cache: false,
			success: function(data){
				console.log(data);
				facility_dropdown(data);

				return ;

				$("#facility_table > tbody").empty();

				$.each(data,function(key, val){

					//console.log(key);

					cat = val.facility_category==null?"":val.facility_category;


					if(cat == "A")
						cat = '<span class="label label-success" style="display:block; padding:3px; width:50px; text-align:center; border-radius:3px;" > A </span>';

					if(cat == "B")
						cat = '<span class="label label-warning" style="display:block; padding:3px; width:50px; text-align:center; border-radius:3px;"> B </span>';

					if(cat == "C")
						cat = '<span class="label label-danger" style="display:block; padding:3px; width:50px; text-align:center; border-radius:3px;"> C </span>';

					$('#facility_table tbody').append('<tr data-facilityid='+val.facilityid+' class="facility_tr"><td>'+val.facilityid+'</td><td>'+val.facility_name+'</td><td>'+cat+'</td><td><a href="facility_detail?fid=/'+val.facilityid+'" target="_blank" >Detail</a></td></tr>');

				});



			}
		});

	});


	//Facility Dropdown

	function facility_dropdown(data){

		$("#facility_dropdown").empty();

		$('#facility_dropdown').append('<option selected="selected"></option>');
		$('#facility_dropdown').append('<option value="99999">Other program Activities</option>');
		$.each( data, function( key, val ) {

			if (val.UpazilaId < 10)
				upazilaid = "0" + val.UpazilaId;
			else
				upazilaid = val.UpazilaId;

			$('#facility_dropdown').append($('<option>', {value: val.facilityid, text: val.facility_name}));
		});

		$("#app-loader").hide();
	}


	//Get Comments
	//This will be called when select facilty from faciity dropdown

	$(document).on('change','#facility_dropdown',function (){

		facility_id = $(this).val();

		//Set Facility name to detail section
		$("#facility-name").html($("#facility_dropdown option:selected").text());

		//Load all issue and reply of that Facility By ID
		show_comment(facility_id);

	});



	//Show Assign Person from users table
	$(document).on('click',"#comments-to-add-btn",function(){

		$("#app-loader").show();


		//Emptying fields
		$("#issue-title").val("");
		$("#issue-detail").html("");
		$("#file_to_upload").val("");
		$("#attachments").html("");

		//This will load users form user table

		$.ajax({
			type: "GET",
			url: site_url+"/getusers",
			//data: {"user_id":$(this).val()},
			cache: false,
			success: function(data){
				//Assign to global TAG
				tag = data;

				//Populate assign user Drop down

				$("#assign-user").empty();

				//add dynamic value to assign dropdown
				$('#assign-user').append('<option selected="selected"></option>');

				$.each( data, function( key, val ) {
					$('#assign-user').append($('<option>', {value:val.user_id, text:val.name}));
				});

				//current_user_id is a global variable declared in index.blade
				$('#assign-user').show();
				$('#assign-user').val(current_user_id); // select current user as default assign person


				$("#app-loader").hide();

				//OPENING EDIT MODAL

				$("#issue-create-date").datepicker().datepicker("setDate", new Date());

				var now = new Date();
				now.setDate(now.getDate()+7);
				$("#issue-completion-date").datepicker().datepicker("setDate", now);


				//Emptying fields
				$("#issue-title").val("");
				$("#issue-detail").html("");
				$("#file_to_upload").val("");
				$("#attachments").html("");



				$('#modal-issue').modal('show');
			}
		});

	});

	//Add issue 
	$(document).on('click','#create-issue',function(){

		var data_post ={
			facility_id: $("#facility_dropdown").val(),
			user_id : 260000,
			title: $("#issue-title").val(),
			//detail: $("#issue-detail").val(),
			detail: $("#issue-detail").text(),
			category: $("#issue-category").val(),
			priority: $("#issue-priority").val(),
			tags:$("#tags").val(),
			create_date: $("#issue-create-date").val(),
			completion_date:$("#issue-completion-date").val(),
			assign_to:$("#assign-user").val(),
			resolved:'',
			attachment: upload_files,
			reson_of_visit: $("#issue-visit-reason").val(),

		};
		console.log("Upload list form comment",data_post);

		//return ;
		//Data validation

		if($("#issue-title").val().length<5){
			sweetAlert("Please add a title");
			return ;
		}

		if($("#issue-detail").text().length<5)
		{
			sweetAlert("Please add some description");
			return ;
		}

		if($("#issue-visit-reason").text().length<5)
		{
			sweetAlert("Please write reason of visit");
			return ;
		}

		//show loader
		$("#app-loader").show();
		$.ajax({
			type: "GET",
			url: site_url + "/add_comments",
			data: data_post,
			cache: false,
			success: function(data){
				show_comment (data_post.facility_id);
				//$('#comments-to-add').val('');
				$("#modal-issue").modal('hide');

				//IF COMMENT BODY IS EXISTS THEN IT WILL SHOW
				if($('#comment-body').length) {
					show_comment(data_post.facility_id)
				}

				$("#app-loader").hide();
			}
		});

	});

});


//Show facility information by ID
function show_comment (facility_id) {

	$("#app-loader").show();

	$.ajax({
		type: "GET",
		url: site_url+"/get_comments",
		data: {"facility_id": facility_id, "return_type":'view'},
		cache: false,
		success: function (data) {

			//console.log(data);

			$("#app-loader").hide();

			$("#comment-body").html(data);

			//Show comment panel
			$("#comment-panel").show();

			$("#app-loader").hide();//hide loader

		}
	});
}

//Modal issue status change
//This will fire when, user click on issue status change button (Flag)
$(document).on('click','.issue-status',function (){
	comment_id = $(this).data('issueid');
	issuestatus = $(this).data('issuestatus');
	//issuestatusdetails = $(this).data('issuestatusdetails');
	facility_id = $(this).data('facility_id');

	//$("#reply_parent_id").val($(this).data('parentid'));
	$("#issue_id1").val($(this).data('issueid'));
	$("#issue_id1").val(comment_id);
	$("#facility_id1").val(facility_id);
	//$("#issue-update-detail").val(issuestatusdetails);

	$("#issue-status").val(issuestatus);
	$("#modal-issue-status").modal('show');
});

$(document).on('click','#change-status',function (){

	if($("#facility_id1").val()!='')
	{
		facility_id=$("#facility_id1").val();
	}
	else
	{
		facility_id= $("#facility_dropdown").val();
	}


	//If no detail, it will not submit
	if($("#issue-update-detail").text().length<1){
		sweetAlert("Please write some description");
		return false;
	}

	$("#app-loader").show();//show loader

	var data_post ={
		facility_id: facility_id,
		comment_id : comment_id,
		status: $("#issue-status").val(),
		resolved: $("#issue-update-detail").text()
	};

	//$("#app-loader").show();//show loader

	$.ajax({
		type: "GET",
		url: "update_status",
		data: data_post,
		cache: false,
		success: function(data){
			//show_comment (facility_id);
			//$('#comments-to-add').val('');
			show_issue_detail(data_post.comment_id);

			//IF COMMENT BODY IS EXISTS THEN IT WILL SHOW
			if($('#comment-body').length) {
				show_comment(data_post.facility_id)
			}

			$("#app-loader").hide();//hide loader
		}
	});

	$("#modal-issue-status").modal('hide');
});


//Modal issue edit
//This will fire when, user click on issue status change button (Flag)
$(document).on('click','.issue-edit',function (){
	comment_id = $(this).data('issueid');
	facility_id = $(this).data('facility_id');
	issuedetails = $(this).data('issuedetails');
	user_id = $(this).data('userid');


	$("#issue_id").val(comment_id);
	$("#user_id").val(user_id);
	$("#facility_id").val(facility_id);
	$("#issue-detail-edit").text($(this).data('issuedetails'));
	//$("#modal-issue").modal('show');
	$("#modal-issue-edit").modal('show');

});

$(document).on('click','#btn-issue-edit_details',function (){
	//current_user = $(this).val(current_user_id);
	//user_id = $("#user_id").val();
	//$('#assign-user').val(current_user_id);

	if(user_id!= current_user_id)
	{
		alert("Permission denied")
		return;
	}
	else {
		facility_id = $("#facility_id").val();

		$("#app-loader").show();//show loader

		var data_post = {
			//facility_id: facility_id,
			//facility_id: $("#facility_id").val(),
			comment_id: comment_id,
			//status: $("#issue-status").val(),
			detail: $("#issue-detail-edit").text()
		};

		//$("#app-loader").show();//show loader

		$.ajax({
			type: "GET",
			url: "update_issue_details",
			data: data_post,
			cache: false,
			success: function (data) {
				show_comment(facility_id);
				//$('#comments-to-add').val('');

			}
		});
		//$("#modal-issue").modal('show');
		$("#modal-issue-edit").modal('hide');
	}
});


//Reply Comments  edit
//This will fire when, user click on issue status change button (Flag)
$(document).on('click','.reply-edit',function (){
	comment_id = $(this).data('reply_issue_id');
	facility_id = $(this).data('reply_facility_id');
	//issuedetails = $(this).data('issuedetails');


	$("#parent-id").val($(this).data('parent-id'));
	$("#reply_issue_id").val(comment_id);
	$("#reply_facility_id").val(facility_id);

	$("#reply-detail-edit").html($(this).data('issuedetails'));
	$("#modal-reply-comments-edit").modal('show');

});

$(document).on('click','#btn-reply-comments-edit',function (){

	facility_id = $("#reply_facility_id").val();

	$("#app-loader").show();//show loader

	var data_post ={
		//facility_id: facility_id,
		//facility_id: $("#facility_id").val(),
		facility_id: $("#facility_dropdown").val(),
		comment_id : comment_id,
		//status: $("#issue-status").val(),
		detail: $("#reply-detail-edit").html()
	};

	//$("#app-loader").show();//show loader
	$.ajax({
		type: "GET",
		url: "update_issue_details",
		data: data_post,
		cache: false,
		success: function(data){
			//show_comment (facility_id);
			//$('#comments-to-add').val('');

			$("#app-loader").hide();//hide loader

			show_issue_detail($("#parent-id").val());

			//IF COMMENT BODY IS EXISTS THEN IT WILL SHOW
			if($('#comment-body').length) {
				show_comment(data_post.facility_id)
			}

		}
	});
	$("#modal-reply-comments-edit").modal('hide');
});

//Reset Password
$(document).on('click','#reset_submit',function (){

	//Get Field values
	var oldpass = $("#oldpass").val();
	var newpass = $("#newpass").val();
	var repass = $("#repass").val();

	//Check Password validity
	if(oldpass.length<2 || newpass.length<6 || repass != newpass)
	{
		if(oldpass.length<2)
		{
			sweetAlert('Please enter old pass');
			return false;
		}

		if(newpass.length<2){
			sweetAlert('Password should be minimum 2 characters long');
			return false;
		}

		if(repass != newpass){
			sweetAlert('New pass and Re-type password dose not match');
			return false;
		}

	}

	//Generating JSON for POST
	var data_post ={
		pass: $("#newpass").val(),
		oldpass: $("#oldpass").val()
	};

	//Show loader
	$("#app-loader").show();

	//Jquery Execution started
	$.ajax({
		type: "GET",
		url: site_url + "/account/password_change",
		data: data_post,
		cache: false,
		success: function(data){
			sweetAlert(data);

			//Clear Field
			$("#oldpass").val('');
			$("#newpass").val('');
			$("#repass").val('');

			//hide loader
			$("#app-loader").hide();
		}
	});

});


//reply comment
//Open Reply Modal
$(document).on('click',".reply-issue",function(){

	$("#issue-reply-txt").html('');
	$("#reply_parent_id").val($(this).data('parentid'));
	$("#reply_facility_id").val($(this).data('facility_id'));
	$('#modal-reply').modal('show');
});

$(document).on('click',"#reply-btn",function(){

	if($("#reply_facility_id").val()!='')
	{
		$facilityid=$("#reply_facility_id").val();
	}
	else
	{
		$facilityid= $("#facility_dropdown").val();
	}


	//check if there is no reply
	if($("#issue-reply-txt").text().length<1){
		sweetAlert('Please write something before reply.');
		return ;
	}


	var data_post ={
		//409391


		//facility_id: $("#reply_facility_id").val(),
		//facility_id: $("#facility_dropdown").val();
		facility_id: $facilityid,
		title: 'Reply', //$("#issue-title").val(),
		detail: $("#issue-reply-txt").html(),
		category: 'comment',
		priority: 'normal',
		tags:'',
		create_date:current_date(),
		completion_date:current_date(),
		//assign_to:$("#assign-user").val(), // if there is no assigned id, then null
		assign_to:$("#assign-user").val()==null?"":$("#assign-user").val(),
		child_of: $("#reply_parent_id").val()

	};

	//show loader
	$("#app-loader").show();
	$.ajax({
		type: "GET",
		url: "add_comments",
		data: data_post,
		cache: false,
		success: function(data){

			$('#modal-reply').modal('hide');

			//Load issue detail with reply
			show_issue_detail($("#reply_parent_id").val());

			//IF COMMENT BODY IS EXISTS THEN IT WILL SHOW
			if($('#comment-body').length) {
				show_comment(data_post.facility_id)
			}

			$("#app-loader").hide();//hide loader
		}
	});

});


function current_date(){
	formattedDate = new Date();
	d = formattedDate.getDate();
	m =  formattedDate.getMonth() + 1; // JavaScript months are 0-11

	h = formattedDate.getHours();
	i = formattedDate.getMinutes();
	s = formattedDate.getSeconds();

	y = formattedDate.getFullYear();

	return y + "-" + m + "-" + d +' '+ h +":" + i +":" + s;
}



function formatted_date(date_time){
	formattedDate = new Date(date_time);
	d = formattedDate.getDate();
	m =  formattedDate.getMonth() + 1; // JavaScript months are 0-11

	h = formattedDate.getHours();
	i = formattedDate.getMinutes();
	s = formattedDate.getSeconds();

	y = formattedDate.getFullYear();

	return d + "-" + m + "-" + y +' &nbsp;<i class="fa fa-clock-o"></i> '+ h +":" + i ;
}

$(document).ready( function () {
	$('.datatable').DataTable({

		dom: 'Blfrtip',
		responsive: true,
		pageLength: 10,
		buttons: [
			{
				//className:'btn-info',
				extend: 'copyHtml5',
				text: '<i class="fa fa-files-o"></i>',
				titleAttr: 'Copy'
			},
			{
				//className:'btn-info',
				extend: 'excelHtml5',
				text: '<i class="fa fa-file-excel-o"></i>',
				titleAttr: 'Excel'
			},
			{
				// className:'btn-info',
				extend: 'csvHtml5',
				text: '<i class="fa fa-file-text-o"></i>',
				titleAttr: 'CSV'
			},
			{
				//className:'btn-info',
				extend: 'pdfHtml5',
				text: '<i class="fa fa-file-pdf-o"></i>',
				titleAttr: 'PDF'
			},
//            {
//                extend: 'print',
//                text: 'Print current page',
//                exportOptions: {
//                    modifier: {
//                        page: 'current'
//                    }
//                }
//            }
			{
				text: '<i class="fa fa-print"></i>',
				extend: 'print',
				className: 'btn-print',
				titleAttr: 'Print',

			}


		],
		"order": [],
		"columnDefs": [
			{ "searchable": false, "targets": [0] }  // Disable search on first and last columns
		]
		//lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]

	});

	$(document).on('click',".clickable-row",function () {

		window.location = $(this).data("href");
	});

	//Issue edit new




} );

$(document).on("click",".issue-edit-new",function (){

	var data_post = {
		issueid: $(this).data('issueid')
	};

	$.ajax({
		type: "GET",
		url: site_url+"/issueedit",
		data: data_post,
		cache: false,
		success: function(data){
			//console.log("edit ",data);

			$("#issue-edit-modal").html(data);

			$(".modal").css({'background': 'rgba(0, 0, 0, 0)'});
			$('#modal-edit-issue').modal({
				backdrop: false,
				show: true
			});

			$('#modal-edit-issue').draggable({
				handle: ".modal-header"
			});
		}
	});
});


$(document).on("click","#update-issue-edit", function (){
	var data_post ={
		issueid: $("#issue-edit-issue-id").val(),
		facility_id: $("#issue-edit-facility-id").val(),
		detail: $("#issue-edit-detail").html(),
		category: $("#issue-edit-category").val(),
		priority: $("#issue-edit-priority").val(),
		attachment: $("#issue-edit-attachment").val(),

		create_date:$("#issue-edit-create-date").val(),
		completion_date:$("#issue-edit-completion-date").val(),
		//assign_to:$("#assign-user").val(), // if there is no assigned id, then null
		assign_to:$("#assign-edit-user").val()
	};

	//console.log("edit value", data_post);

	//Data validation
	if($("#issue-edit-detail").html().length<5){
		sweetAlert("Please write some description");
		return ;
	}


	$.ajax({
		type: "GET",
		url: site_url + "/issueupdate",
		data: data_post,
		cache: false,
		success: function(data){
			if(data=="Success")
			{
				sweetAlert("Update Success");
				$('#modal-edit-issue').modal('hide');
				$("#issue-edit-issue-id").val('');
				$("#issue-edit-detail").text('');
				$("#issue-edit-category").val('');
				$("#issue-edit-priority").val('');
				$("#issue-edit-create-date").val('');
				$("#issue-edit-completion-date").val('');
				$("#assign-edit-user").val('');

				//show_comment (facility_id);
				show_issue_detail(data_post.issueid);

				//IF COMMENT BODY IS EXISTS THEN IT WILL SHOW
				if($('#comment-body').length) {
					show_comment(data_post.facility_id)
				}

			}
		}
	});
});

function show_issue_detail(issueid){
	$.ajax({
		type: "GET",
		url: site_url + "/issueDetails/id="+issueid+"?ajax=1",

		cache: false,
		success: function(data){
			$("#issue-detail-reply").html(data);
		}
	});
}

$("#issue-category").change(function(){

	if($(this).val() == 'issue'){
		$("#issue-period").show('slow');
	}else{
		$("#issue-period").hide('slow');
	}

});