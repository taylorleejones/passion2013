<?php /* echo $session_data->title; */ ?>


		<article id="post-<?= $session_data->id ?>">
			<h1><?php if($session_data->visible == 2) {echo '<span class="yellow">LIVE: </span>';} echo $session_data->title; ?></h1>
			<div class="entry">
				<div id="bg_player_location">
					<div id="my-video"></div>
<?php
if($session_data->visible == 2) {
	$smil_path = $session_data->live_smil;
	$mobile_smil_path = $session_data->live_smil_mobile;
} elseif($session_data->visible == 3) {
	$smil_path = $session_data->archive_smil;
	$mobile_smil_path = $session_data->archive_smil_mobile;
}
?>
<script type='text/javascript'>
	jwplayer('my-video').setup({
		sources: [{
			file: '<?= base_url().$smil_path ?>',
		}],
		width: '640',
		height: '380',
		autostart: true
	});
</script>
					</div>	 
			</div>
		</article>

<?php /* else */ ?>

<!-- <h1>Not Found</h1> -->

		<div id="right-bar">
					 	<a class="thumb" target="_blank" onClick="javascript: pageTracker._trackPageview('givetofreedm');" href="https://secure.268generation.com/dosomethingnow/give/freedom">Give<br>To Freedom</a>
					 	<a class="thumb" onClick="javascript: pageTracker._trackPageview('digitalAAccess');" target="_blank" href="http://268store.com/store/product/743/P2012-DIGITAL-ALL-ACCESS/">Buy<br/>Digital<br/>All Access</a>
					 	<div id="feedback">
						<form id="feedback_form" action="/sendfeedback.php" method="POST">
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
						<div id="tweetlist"></div>
						<div id="schedule-widget">
							<ul id="upcoming-sessions-list">
								<?php
								foreach($all_sessions as $single) {
									if ($single->id != $session_data->id){
										if($single->visible == 1){
											$stime = date("l, F j, Y, g:i A", $single->start_time);
											echo "<li><div class='session-title " . $single->id ."'>" . $single->title . "</div><div class='session-time'>$stime&nbsp;EST</div></li>";
										} 
									}
								}
								?>
							</ul>
						</div><!-- eo #schedule-widget -->
					</div><!-- eo #twidget -->
					<?php /*
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
				    */
					?>
					<aside id='session-thumbs' class='clearfix floatleft'>
<?php foreach($all_sessions as $single) { if($single->visible == 2 || $single->visible == 3) { ?>
						<a href='<?= base_url("session/".$single->slug) ?>' id='link-to-post-<?= $single->id ?>' class=''><h3><?= $single->title ?></h3><span>Available until <?= date("l, F j, Y", $single->available_until) ?></span></a>
<?php } } ?>
					</aside>