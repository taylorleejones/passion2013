var fullPath = "http://wb-passion-test-env.elasticbeanstalk.com/";
//var fullPath = window.location.protocol + "//" + window.location.host + "/";

$(document).ready(function() {

$("#activate-twitter").on("click", function() {
	$("#activate-schedule").removeClass("active");
	$(this).addClass("active");
	$("#schedule-widget").hide();
	$("#tweetlist").show();
});
$("#activate-schedule").on("click", function() {
	$("#activate-twitter").removeClass("active");
	$(this).addClass("active");
	$("#tweetlist").hide();
	$("#schedule-widget").show();
});

});