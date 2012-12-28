<?php
/*
Template Name: All Sessions
*/
?>
<?php
	$baseurl = "http://passioncon.bc.cdn.bitgravity.com";
	$salt = "qrA9>,zV3[tjM4%/passioncon";
	$cid=false;
	$sidebarhtml = "<h1>All Sessions</h1><aside id='session-thumbs' class='clearfix floatleft'>";
	$ssns = new WP_Query("post_type=passion_sessions&orderby=menu_order&order=ASC");
				if ($ssns->have_posts()) : while ($ssns->have_posts()) : $ssns->the_post();
					$ss = get_post_meta($post->ID, "_session-status", true);
					if ($ss == 1){
						$cid = $post->ID;
					} elseif ($ss == 0) {
						$expiration = get_post_meta($post->ID, "_expiration", true);
						$extraclasses = "past";
						$sidebarhtml .= "<a href='" . get_permalink() ."' id='link-to-post-". $post->ID ."' class='$extraclasses'><h3>" . get_the_title() . "</h3><span>Available until $expiration</span>". get_the_post_thumbnail($post->ID, "session-poster") ."</a>";
					}
					endwhile;
				endif;
				$sidebarhtml .= "</aside>";
				wp_reset_query();
get_header(); ?>
<?php echo $sidebarhtml; ?>
		<div id="right-bar">
					 	<a class="thumb" onClick="javascript: pageTracker._trackPageview('givetofreedm');" target="_blank" href="https://secure.268generation.com/dosomethingnow/give/freedom">Give<br>to Freedom</a>
					 	<a class="thumb" onClick="javascript: pageTracker._trackPageview('digitalAAccess');" target="_blank" href="http://268store.com/store/product/743/P2012-DIGITAL-ALL-ACCESS/">Buy<br/>Digital<br/>All Access</a>
					 	<div id="feedback">
						<form id="feedback_form" action="<?php bloginfo('template_directory'); ?>/sendfeedback.php" method="POST">
							<textarea name="_message">Do you have an interesting story to share? Having technical problems? Tell us here.</textarea>
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
						<div id="tweetlist" <?php if (get_option('twitter_kill') == "true"){
							echo "class='twitter_kill'";
						}?>>Loading...</div>
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
												echo "<li><div class='session-title " . $post->ID ."'>" . get_the_title() . "</div><div class='session-time'>" . $stime . "&nbsp;EST</div></li>";
											} 
										}
									endwhile; endif; wp_reset_query();
								?>
							</ul>
						</div><!-- eo #schedule-widget -->
					</div><!-- eo #twidget -->

<?php get_footer(); ?>