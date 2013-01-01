<?php
	$baseliveurl = "http://passioncon.live.cdn.bitgravity.com";
	$basepasturl = "http://bitcast-g.bitgravity.com/passioncon";
	$salt = "qrA9>,zV3[tjM4%/passioncon";
	$cid=false;
get_header(); ?>

	<?php
	if (have_posts()) : while (have_posts()) : the_post(); $activeID = $post->ID;?>
	<?php $ss = get_post_meta($post->ID, "_session-status", true); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<h1><?php if ($ss == 1) {echo '<span class="yellow">LIVE: </span>';} the_title(); ?></h1>
			<div class="entry">
				<div id="bg_player_location">
					<a href="http://www.adobe.com/go/getflashplayer">
						<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
					</a>
				</div>
				<script type="text/javascript" src="http://bitcast-b.bitgravity.com/player/6/functions.js"></script>
				<?php 
					if ($ss == "-1" || $ss == "" || !isset($ss)){ // session is turned "off", is set to "", or isn't set
						
						$GLOBALS['extrajs'] =  "<script>" .
							"jQuery(document).ready(function(){" .
								"var newhtml = \"<p>The stream you have selected is not currently available.</p>\";" .
								"jQuery(\"#bg_player_location\").html(newhtml);});" .
						"</script>";

						} else if ($ss == "0") { // Session is set to "past", show VOD
							$vodurl = get_post_meta($post->ID, "_archive-url", true);
							if (strpos($vodurl, "/passioncon")){
								$vodurl = split("/passioncon", $vodurl);
								$vodurl = $vodurl[1];
							}
							$videos = array(
								$basepasturl . str_replace("&", "%26", bg_gen_secure_uri($vodurl . "-high.f4v", "$salt", 10800)),
								$basepasturl . str_replace("&", "%26", bg_gen_secure_uri($vodurl . "-med.f4v", "$salt", 10800)),
								$basepasturl . str_replace("&", "%26", bg_gen_secure_uri($vodurl . "-low.f4v", "$salt", 10800))
							);
						?>

						<!-- <script type="text/javascript">
						var flashvars = {};
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
						flashvars.File = '<?php echo $videos[0]; ?>';
						flashvars.FileQuality2 = '<?php echo $videos[1]; ?>';
						flashvars.FileQuality3 = '<?php echo $videos[2]; ?>';
						flashvars.FileLabel = "High";
						flashvars.FileQuality2Label = "Medium";
						flashvars.FileQuality3Label = "Low";
						flashvars.FileBitrate = "1112";
						flashvars.FileQuality2Bitrate = "782";
						flashvars.FileQuality3Bitrate = "475";
						flashvars.DefaultLevel = "1";
						flashvars.Mode = "stream";
						var params = {};
						params.allowFullScreen = "true";
						params.allowScriptAccess = "always";
						var attributes = {};
						attributes.id = "bitgravity_player_6";
						swfobject.embedSWF(stablerelease, "bg_player_location", "640", "380", "9.0.115", "http://bitcast-b.bitgravity.com/player/expressInstall.swf", flashvars, params, attributes);
						</script> -->
					<?php
					} else if ($ss == "1") { // Session is set to "Present", show live stream
						$liveurl = get_post_meta($post->ID, "_stream-url", true);
						if (strpos($liveurl, ".com")){
							$liveurl = split(".com", $liveurl);
							$liveurl = $liveurl[1];
						}
						$videos = array(
								$baseliveurl . str_replace("&", "%26", bg_gen_secure_uri($liveurl . "01", "$salt", 10800)),
								$baseliveurl . str_replace("&", "%26", bg_gen_secure_uri($liveurl . "02", "$salt", 10800)),
								$baseliveurl . str_replace("&", "%26", bg_gen_secure_uri($liveurl . "03", "$salt", 10800)),
								$baseliveurl . str_replace("&", "%26", bg_gen_secure_uri($liveurl . "04", "$salt", 10800))
							);
					?>
						
						<script type="text/javascript">
						var flashvars = {};
						flashvars.File = '<?php echo $videos[0]; ?>';
						flashvars.FileQuality2 = '<?php echo $videos[1]; ?>';
						flashvars.FileQuality3 = '<?php echo $videos[2]; ?>';
						flashvars.FileQuality4 = '<?php echo $videos[3]; ?>';
						flashvars.FileLabel = "High";
						flashvars.FileQuality2Label = "Medium";
						flashvars.FileQuality3Label = "Low";
						flashvars.FileQuality4Label = "Audio";
						flashvars.FileBitrate = "1200";
						flashvars.FileQuality2Bitrate = "700";
						flashvars.FileQuality3Bitrate = "300";
						flashvars.FileQuality4Bitrate = "97";
						flashvars.DefaultLevel = "2";
						flashvars.DefaultLevel = "2";
						flashvars.Mode = "live";
						flashvars.AutoPlay = "true";
						flashvars.ScrubMode = "simple";
						flashvars.BufferTime = "1.5";
						flashvars.VideoFit = "automatic";
						flashvars.DefaultRatio = "1.777778";
						flashvars.ColorBase = "#000000";
						flashvars.ColorControl = "#666666";
						flashvars.ColorHighlight = "#C7F500";
						flashvars.ColorFeature = "#C7F500";
						flashvars.Volume = "1";
						flashvars.AutoBitrate = "on";
						flashvars.AllowDebug = "false";
						flashvars.AllowInfo = "false";
						flashvars.NoText = "true";

						var params = {};
						params.allowFullScreen = "true";
						params.allowScriptAccess = "always";
						params.wmode = "opaque";
						var attributes = {};
						attributes.id = "bitgravity_player_6";
						swfobject.embedSWF(stablerelease, "bg_player_location", "640", "380", "9.0.115", "http://bitcast-b.bitgravity.com/player/expressInstall.swf", flashvars, params, attributes);
						</script>
					<?php
					} else if ($ss == "2") { // Session is set to Future, show set date
						 $GLOBALS['extrajs'] =  "<script>" .
							"jQuery(document).ready(function(){" .
								"var newhtml = \"The session you selected will be available on " . get_post_meta($post->ID, '_date-day', true) . " at " .
								get_post_meta($post->ID, '_date-time', true) . "\";" .
								"jQuery(\"#bg_player_location\").html(newhtml);});" .
						"</script>";
						;
					 }?>
					 
			</div>

		</article>

		<?php endwhile; ?>
		<?php else : ?>

		<h1>Not Found</h1>

	<?php endif; wp_reset_query();?>
		<div id="right-bar">
					 	<a class="thumb" target="_blank" onClick="javascript: pageTracker._trackPageview('givetofreedm');" href="http://giving.passion2013.com">Give<br>To Freedom</a>
					 	<a class="thumb" onClick="javascript: pageTracker._trackPageview('digitalAAccess');" target="_blank" href="http://268store.com/store/product/743/P2012-DIGITAL-ALL-ACCESS/">Buy<br/>Digital<br/>All Access</a>
					 	<div id="feedback">
						<form id="feedback_form" action="<?php bloginfo('template_directory'); ?>/sendfeedback.php" method="POST">
							<textarea name="_message">Do you have an interesting story to share? Having technical problems? Click here to type your message.</textarea>
							<div class="floatright">
								<input type="text" name="_name" value="name" id="name"><br/>
								<input type="text" name="_email" value="email" id="email"><br/>
								<input type="submit" value="Send >>">
							</div>
						</form>
					</div>
					 </div>
					 <div id="twidget" class="floatleft">
						<h2 id="activate-twitter" data-target="tweetlist"class="active">Feed</h2>
						<h2 id="activate-schedule" data-target="schedule-widget">Schedule</h2>
						<div id="tweetlist"<?php if (get_option('twitter_kill') == "true"){
							echo "class='twitter_kill'";
						}?>></div>
						<div id="schedule-widget">
							<ul id="upcoming-sessions-list">
								<?php query_posts("post_type=passion_sessions&orderby=menu_order&order=ASC");
									if (have_posts()) : while (have_posts()) : the_post();
									$ss = get_post_meta($post->ID, "_session-status", true);
										if ($post->ID == $cid){
											// Do nothing else with the currently streaming post
										} else {
											if ($ss == 2){
												$stime = get_post_meta($post->ID, "_date-day", true) . ", " . get_post_meta($post->ID, "_date-time", true);
												echo "<li><div class='session-title " . $post->ID ."'>" . get_the_title() . "</div><div class='session-time'>$stime&nbsp;EST</div></li>";
											} 
										}
									endwhile; endif; wp_reset_query();
								?>
							</ul>
						</div><!-- eo #schedule-widget -->
					</div><!-- eo #twidget -->
					<?php 
					$sidebarhtml = "<aside id='session-thumbs' class='clearfix'>";
					$extraclasses = "";
					$ssns = new WP_Query("post_type=passion_sessions&orderby=menu_order&order=ASC");
					if ($ssns->have_posts()) : while ($ssns->have_posts()) : $ssns->the_post();
						if ($post->ID == $activeID){
							$extraclasses .= " currently-playing";
							$span = "Currently Playing";
						} else {
							$extraclasses = "";
							$span = "Available until " . get_post_meta($post->ID, "_expiration", true);
						}
						$ss = get_post_meta($post->ID, "_session-status", true);
						if ($ss == 1){
							$cid = $post->ID;
							$extraclasses .= " live-now";
							if ($span == "Currently Playing"){
								$span = "Currently Streaming Live";
							} else {
								$span = "Watch Live Now";
							}
							$sidebarhtml .= "<a href='" . get_permalink() . "' id='link-to-post-". $post->ID ."' class='$extraclasses'><h3>" . get_the_title() . "</h3><span>$span</span>" . get_the_post_thumbnail($post->ID, 'session-poster') ."</a>";
						} elseif ($ss == 0) {
							$extraclasses .= " past";
							$sidebarhtml .= "<a href='" . get_permalink() ."' id='link-to-post-". $post->ID ."' class='$extraclasses'><h3>" . get_the_title() . "</h3><span>$span</span>" . get_the_post_thumbnail($post->ID, 'session-poster') . "</a>";
						}
					endwhile;
					$sidebarhtml .= "</aside>";
				endif;
				wp_reset_query();
						 echo $sidebarhtml; 
					?>	

<?php get_footer(); ?>