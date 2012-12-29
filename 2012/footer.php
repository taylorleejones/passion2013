</div><!-- ending page wrap -->

<div id="footer">

    <div class="footer_right">
        <div class="flogo" style="display: block; ">
        	<a class="ajax_load" href="http://268generation.com/passion2012/home/" title="Return to Home Page"><img src="http://268generation.com/passion2012/am-site/themes/Passion2012/images/logo_footer.png" alt=""></a>
        </div>
    </div>
    <div class="clear"><!-- --></div>
</div>

	<?php wp_footer(); ?>

<div id="bgimage"><img src="<?php bloginfo('template_directory'); ?>/_/img/main-bg.jpg"></div>
<!-- here comes the javascript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php bloginfo("template_directory"); ?>/_/jquery-1.7.1.min.js">\x3C/script>')</script>

<?php
if ($GLOBALS["devmode"] == true){ ?>
	<script type="text/javascript" language="javascript" src="http://268generation.com/passion2012/am-site/themes/Passion2012/js/cufon-yui.js"></script>
	<script type="text/javascript" language="javascript" src="http://268generation.com/passion2012/am-site/themes/Passion2012/js/HNExLight_250.font.js"></script>
	<script type="text/javascript" language="javascript" src="http://268generation.com/passion2012/am-site/themes/Passion2012/js/HNLight_300.font.js"></script>
	<script type="text/javascript" language="javascript" src="http://268generation.com/passion2012/am-site/themes/Passion2012/js/HNBold_700.font.js"></script>
	<?php if (isset($GLOBALS["extrajs"])) { echo $GLOBALS["extrajs"]; }?>
	<script src="<?php bloginfo('template_directory'); ?>/_/js/jquery.form.js"></script>
	<script src="<?php bloginfo('template_directory'); ?>/_/js/functions.js"></script>
	<script type="text/javascript">
		if(typeof(Cufon) != "undefined") {Cufon.now();}
		Cufon.replace("h1, h2",{fontFamily:"HNBold",hover:true});Cufon.replace("div.bread_crumb .cufon_text",{fontFamily:"HNExLight"});Cufon.replace("ul.nav li a",{fontFamily:"HNBold",hover:true});

	</script>
<?php } else { ?>
	<script src="<?php bloginfo('template_directory'); ?>/_/js/all.min.js"></script>
	<?php if (isset($GLOBALS["extrajs"])) { echo $GLOBALS["extrajs"]; }?>
	<script type="text/javascript">
		if(typeof(Cufon) != "undefined") {Cufon.now();}
		Cufon.replace("h1, h2",{fontFamily:"HNBold",hover:true});Cufon.replace("div.bread_crumb .cufon_text",{fontFamily:"HNExLight"});Cufon.replace("ul.nav li a",{fontFamily:"HNBold",hover:true});

	</script>
<?php } ?>

<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
	chromium.org/developers/how-tos/chrome-frame-getting-started -->
<!--[if lt IE 7 ]>
	<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
	<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
<![endif]--> 

<!-- add live updated text -->
<script>

(function($){
	window.pMessage = setInterval(function(){
        $.getJSON("http://search.twitter.com/search.json?rpp=1&q=from%3Apassionliveteam&callback=?")
        .success(function(data){
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

</script>

<script type="text/javascript">
var _sf_async_config={uid:31564,domain:"live.268generation.com"};
(function(){
  function loadChartbeat() {
    window._sf_endpt=(new Date()).getTime();
    var e = document.createElement('script');
    e.setAttribute('language', 'javascript');
    e.setAttribute('type', 'text/javascript');
    e.setAttribute('src',
       (("https:" == document.location.protocol) ? "https://a248.e.akamai.net/chartbeat.download.akamai.com/102508/" : "http://static.chartbeat.com/") +
       "js/chartbeat.js");
    document.body.appendChild(e);
  }
  var oldonload = window.onload;
  window.onload = (typeof window.onload != 'function') ?
     loadChartbeat : function() { oldonload(); loadChartbeat(); };
})();

</script>
</body>

</html>
