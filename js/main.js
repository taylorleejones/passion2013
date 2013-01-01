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

(function($){

var pls = {};
pls.bgimage = $("#bgimage img");
pls.whRatio = 2.27;

pls.tArray = [ // twitter words array
	[ // first, users
	"@passion268", "@louiegiglio", "@christomlin", "@crowdermusic", "from:lecrae", "from:johnpiper",
	"from:jesusculture", "from:karijobe", "from:bethmoorelpm", "@matt_redman", "@kpstanfill", "from:charliehallband",
	"from:christynockels"

	],
	[ // now keywords
	'#passion2013', '#headedtothedome', '268generation', 'passion2013', 'headedtothedome',
	'"Passion 2013"', '"Passion in Atlanta"', '"Passion Conference"', '"Passion in Atl"', '"Atlanta for Passion"'
	]
]
pls.rUrl = "";

function fetchTweets(update, refreshurl){ // this function will run on the client every 15 seconds
	// if update is true, the url will be the refresh url
	// build url; has to be dynamic so that the "since_id" parameter can be updated.
	var url = (function(){
		if (!update){
			var u = "http://search.twitter.com/search.json?rpp=5&result_type=recent&q=";
			var terms = pls.tArray[0].join(" OR ");
			terms += " OR " + pls.tArray[1].join(" OR ");
			u += encodeURIComponent(terms);
			if (pls.sinceID != "" && pls.sinceID != undefined && pls.sinceID != 0 && pls.sinceID != false ){
				u += "&since_id=" + pls.sinceID;
			}
			u+="&callback=?";
		} else {
			u = refreshurl;
		}
		return u;
	})();

	$.getJSON(url).success(function(data){
		// pull out tweets
		if (update){
			var tweetText ="";
		} else {
			var tweetText = "<ul id='tweets'>";
		}
		$(data["results"]).each(function(i,el){
					var rawTweet = el["text"];
					var tweet = rawTweet.replace(/(https?:\/\/[^\s]+|www\.[^\s]+)/g, "<a target='_blank' href='$1'>$1</a>");
					var	tweethtml =  tweet.replace(/(?:^|\s)#([^\s]+)\s/g, "<a href='http://search.twitter.com/search?q=%23$1'> #$1</a> ");
						tweethtml = tweet.replace(/@([^\s]+)/g, '<a target="_blank" href="http://twitter.com/$1">@$1</a>');
					tweetText += "<li><a target='blank' href='http://twitter.com/" +
								el["from_user"] +
								"'>" + el["from_user"] + "</a>: " + tweethtml +
								"</li>";
						if (i == data["results"].length - 1){
							if (!update){
								tweetText += "</ul>";
								$("#tweetlist").html(tweetText);
								$("#tweets li").fadeIn();
							} else {
								$(tweetText).prependTo("#tweets");
								$("#tweets li").fadeIn();
								if ($("#tweets li").length > 5){
									$("#tweets li").each(function(i,el){
										if (i > 4){
											$(el).fadeOut(function(){
												$(this).remove();
											});
										}
									});
								}
							}
						}
			});		
		pls.rUrl = "http://search.twitter.com/search.json" + data["refresh_url"] + "&callback=?";
		window.tweetTimeout = setTimeout(function(){
			fetchTweets(true, pls.rUrl);
		}, 16000);
	}).error(function(){
		clearTimeout(window.tweetTimeout);
		$("#tweetlist").html("<a class='reloadtwitter'>Error loading feed. Click here to try again.</a>");
		$("a.reloadtwitter").click(function(){
			$(this).unbind("click").html("trying again...");
			fetchTweets();
		});
	});
}

function twidget(){
	$("#twidget h2").click(function(){
		var self = $(this);
		if (!self.hasClass("active")){
			$("#twidget h2.active").removeClass("active");
			self.addClass("active");
			// Cufon.refresh();
			$("#twidget").children("div").hide();
			$("#twidget #" + self.data("target")).show();
		}
	});
}

function feedbackForm(){
	var f = $("#feedback_form");
	f.find("input[type=text], textarea").each(function(i,el){
		var originalval = $(this).val();
		$(this).focus(function(){
			if ($(this).val() == originalval){
				$(this).val("")	
			}
		});
		$(this).blur(function(){
			if ($(this).val() == ""){
				$(this).val(originalval);
			}
		});
	});
	var opts = {
			beforeSubmit: function(){
				f.find("textarea").val("sending...");
			},
			success: function(data){
				console.log(data);
				if (data == "1"){
					var message = "Feedback sent succesfully.";
					f.find("textarea").val("Message sent!");
				} else if (data == "-1") {
					var message = "Looks like there was an issue on the server. Try again.";
					f.find("textarea").val("Message not sent! Probably a server error.");
				} else {
					var message = "Feedback wasn't sent correctly - double check the form, or try later.";
					f.find("textarea").val("Message not sent. Check the form fields, or try again later.");
				}
				$("<div id='form_message'>" + message + "</div>").css({top:"-80px"}).appendTo("body").animate({top:"0px"}).delay(3000).fadeOut(function(){
					$("#form_message").remove();
				});
			}
		}
	f.submit(function(e){
		f.ajaxSubmit(opts);
		e.preventDefault();
	});
}

function formSubmitDiv(){
	$("form").each(function(){
		var f = $(this);
		f.find("div.submit").click(function(){
			f.submit();
		});
	});
}

function futureClick(){
	$("a.future").click(function(e){
		e.preventDefault();
		if ( $(e.target).attr("id").indexOf($("article.passion_sessions").attr("id")) > 0){
			return false;
		} else {
			var formhtml = '<form id="_go-to-session" action=" ' +
			$(this).attr("href") +
			'" method="POST"><input type="hidden" name="from_ad" value="true"></form>';
			$(formhtml).hide().appendTo("body");
			$("#_go-to-session").submit();
		}
	});
}

function bgImageResize(){
	pls.windowRatio = $(window).width() / $(window).height();
	// if window width/height is greater than bg image width/height,
	// resize image width to window width
	if (pls.windowRatio > pls.whRatio){
		
		var w = $(window).width();
		var h = w/pls.whRatio;

		pls.bgimage.css({
			width : w,
			height : h,
			marginTop : 0.5 * ($(window).height() - (w/pls.whRatio)),
			marginLeft : 0
		});

	} else if (pls.windowRatio < pls.whRatio){
		var h = $(window).height();
		var w = h * pls.whRatio;
		var mL = 0.5 * ($(window).width() - w);
		pls.bgimage.css({
			width : w,
			height : h,
			marginLeft : mL,
			marginTop : 0
		});
	}
}

function init(){
	// A few utils
	$("#session-thumbs a").click(function(e){
		if ($(e.target).attr("id").indexOf($("article.passion_sessions").attr("id")) > 0){
			e.preventDefault();
		}
	});
	// now other functions
	bgImageResize();
	formSubmitDiv();
	futureClick();
	if (!pls.twitterKill){
		fetchTweets();	
	} else {
		$("#tweetlist").html("Feed is not available at this time.");
	}
	twidget();
	feedbackForm();
	$(window).resize(function(){
		bgImageResize();
	});
}
init();

})(jQuery);



(function($){
	window.pMessage = setInterval(function(){
        $.getJSON("http://search.twitter.com/search.json?rpp=1&q=from%3Apassion2013live&callback=?")
        .success(function(data){
        	if (!data['results'].length){ return false; }
            var tweet = data['results'][0]['text'];
            if (tweet.match("#support")){
                tweet = tweet.replace("#support", "");
                if (tweet != $("#session-thumbs p").html()){
                if ($("#session-thumbs p").length > 0){ $("#session-thumbs p").html(tweet);
                } else {
                    $("<p>" + tweet +"</p>").prependTo("#session-thumbs");
                    $("#session-thumbs p").css({
                            fontSize : "1em",
                            color : "#ddd",
                            textTransform : "uppercase",
                            marginBottom : "12px"
                        });
                    }
                }
            } else {
                if ($("#session-thumbs p") > 0){
                    $("#session-thumbs p").remove();
                }
            }
    }).error(function(){
        return false;
    });
    }, 12000);

})(jQuery);
