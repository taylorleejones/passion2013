<?php
$baseurl = "http://passioncon.bc.cdn.bitgravity.com";
$salt = "qrA9>,zV3[tjM4%/passioncon";
$videos = array(
		$baseurl . str_replace("&", "%26", bg_gen_secure_uri("/secure/passion2012-live-dsn-intro-high.mov", "$salt", 10800)),
		$baseurl . str_replace("&", "%26", bg_gen_secure_uri("/secure/passion2012-live-dsn-intro-medium.mov", "$salt", 10800)),
		$baseurl . str_replace("&", "%26", bg_gen_secure_uri("/secure/passion2012-live-dsn-intro-low.mov", "$salt", 10800))
	);
get_header(); ?>

	<?php
	query_posts("post_type=passion_sessions");
	$currentsession = false;
	$ucsessions = "<ul id='upcoming-sessions-list'>";
	$psessions = "<div class='clearfix'><h2>Past Sessions</h2>";
	if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php $ss = get_post_meta($post->ID, "_session-status", true);
			if ($ss == 1){
					$redirect = get_permalink();
					$cid = $post->ID;
					$currentsession = true;
					$basestreamurl = get_post_meta($post->ID, "_stream-url", true);
					$thetitle = get_the_title();
				}
				?>

		<?php endwhile; endif; ?>

		<article>
				<h1>A Message From Louie</h1>
				<div id="bg_player_location">
				<a href="http://www.adobe.com/go/getflashplayer">
				<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
				</a>
				</div>
				<script type="text/javascript" src="http://bitcast-b.bitgravity.com/player/6/functions.js"></script>
				<script type="text/javascript">
				var flashvars = {};
				flashvars.File = "<?php echo $videos[0]; ?>";
				flashvars.FileQuality2 = "<?php echo $videos[1]; ?>";
				flashvars.FileQuality3 = "<?php echo $videos[2]; ?>";
				flashvars.FileLabel = "1.2Mbps";
				flashvars.FileQuality2Label = "700Kbps";
				flashvars.FileQuality3Label = "300Kbps";
				flashvars.FileBitrate = "1200";
				flashvars.FileQuality2Bitrate = "700";
				flashvars.FileQuality3Bitrate = "300";
				flashvars.DefaultLevel = "2";
				flashvars.Mode = "ondemand";
				flashvars.AutoPlay = "true";
				flashvars.ScrubMode = "advanced";
				flashvars.BufferTime = "1.5";
				flashvars.VideoFit = "automatic";
				flashvars.DefaultRatio = "1.777778";
				flashvars.LogoPosition = "topleft";
				flashvars.ColorBase = "#000000";
				flashvars.ColorControl = "#666666";
				flashvars.ColorHighlight = "#99FF00";
				flashvars.ColorFeature = "#99FF00";
				var params = {};
				params.allowFullScreen = "true";
				params.allowScriptAccess = "always";
				var attributes = {};
				attributes.id = "bitgravity_player_6";
				swfobject.embedSWF(stablerelease, "bg_player_location", "640", "380", "9.0.115", "http://bitcast-b.bitgravity.com/player/expressInstall.swf", flashvars, params, attributes);
				</script>
				</article>
				<div id="right-bar">
					<?php if ($currentsession){ ?>
						<a class="thumb" href="<?php echo $redirect; ?>">Watch<br><span class="yellow">Live</span> Session</a>
					<?php } else {?>
						<a class="thumb" href="/all-sessions">Watch<br/>Past Sessions</a>	
					<?php } ?>
					<a class="thumb" onClick="javascript: pageTracker._trackPageview('givetofreedm');" target="_blank"href="https://secure.268generation.com/dosomethingnow/give/freedom">Give<br>To Freedom</a>
				</div><!-- ending #right-bar -->

	<?php wp_reset_query();?>


<?php get_footer(); ?>