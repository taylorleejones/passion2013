var fullPath = "http://passion-livestream-env.elasticbeanstalk.com";
//var fullPath = window.location.protocol + "//" + window.location.host + "/";

/*
$(document).ready(function() {
	$.ajax({
		type: "POST",
		url: fullPath+"json/time.php",
		dataType: "json",
		success: jsonHandle
	});
});

window.jsonHandle = function(json) {
	$(".json-output").html(json.unixtime);
};
*/

$(document).ready(function() {

	$("#session-date-start").datepicker();
	$("#session-date-start").datepicker("option", "dateFormat", "DD, M d, yy");
	$("#session-date-start").datepicker("setDate", $("#hidden-start-date").val());
	$("#session-date-end").datepicker();
	$("#session-date-end").datepicker("option", "dateFormat", "DD, M d, yy");
	$("#session-date-end").datepicker("setDate", $("#hidden-end-date").val());
	$("#available-until").datepicker();
	$("#available-until").datepicker("option", "dateFormat", "DD, M d, yy");
	$("#available-until").datepicker("setDate", $("#hidden-available-until").val());

	$("#session-time-start").timepicker();
	$("#session-time-end").timepicker();

	$("#page-title").keyup(function() {
		var slug = $("#page-title").val().toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-');
		if(slug.substr(-1) == '-')
        	slug = slug.substr(0, slug.length - 1);
		$("#page-slug").val(slug);
	});
	$("#session-title").keyup(function() {
		var slug = $("#session-title").val().toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-');
		if(slug.substr(-1) == '-')
        	slug = slug.substr(0, slug.length - 1);
		$("#session-slug").val(slug);
	});

	$(".session-on-off").on("click", function() {
		var id = $(this).parents(".single-session").find(".session-id").html();
		var state = $(this).val();
		var qstring = "id="+id+"&state="+state;
		console.log(qstring);
		$.ajax({type: "post", data: qstring, url: fullPath+"admin/change_session_state", success: function() {
			//
		}});
	});

});
