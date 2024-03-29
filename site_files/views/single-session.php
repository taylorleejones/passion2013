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
?>
<script type='text/javascript'>
	jwplayer('my-video').setup({
		sources: [{
			file: '<?= base_url().$smil_path ?>'
		},{
			file: '<?= $mobile_smil_path ?>'
		}],
		width: '640',
		height: '380',
		primary: 'flash',
		autostart: true
	});
</script>
<?php } elseif($session_data->visible == 3) {
	$smil_path = $session_data->archive_smil;
	$mobile_smil_path = $session_data->archive_smil_mobile;
?>
<script type='text/javascript'>
var userAgent = window.navigator.userAgent;

if (userAgent.match(/iPad/i) || userAgent.match(/iPhone/i) || userAgent.match(/Android/i)) {
   // iPad or iPhone or Android
   jwplayer('my-video').setup({
		sources: [{
			file: '<?= $mobile_smil_path ?>'
		}],
		width: '640',
		height: '380',
		primary: 'flash',
		autostart: true
	});
}
else {
	// anything else
   	jwplayer('my-video').setup({
		playlist: [{
			provider: 'http://players.edgesuite.net/flash/plugins/jw/v2.11/jw6/AkamaiAdvancedJWStreamProvider.swf',
			file: '<?= base_url().$smil_path ?>',
			type : 'mp4'
		}],
		width: '640',
		height: '380',
		primary: 'flash',
		autostart: true
	});
}

</script>
<?php } ?>
					</div>	 
			</div>
		</article>

<?php /* else */ ?>

<!-- <h1>Not Found</h1> -->

		<div id="right-bar">
					 	<a class="thumb" target="_blank" onClick="javascript: pageTracker._trackPageview('givetofreedm');" href="http://giving.passion2013.com">Give<br>To Freedom</a>
					 	<a class="thumb" onClick="javascript: pageTracker._trackPageview('digitalAAccess');" target="_blank" href="http://store.passion2013.com/daa/dp/3">Buy<br/>Digital<br/>All Access</a>
					 	<div id="feedback">
						<form id="feedback_form" action="/sendfeedback.php" method="POST">
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

					<aside id='session-thumbs' class='clearfix floatleft'>
<?php foreach($all_sessions as $single) { if($single->visible == 2 || $single->visible == 3) { ?>
						<a href='<?= base_url("session/".$single->slug) ?>' id='link-to-post-<?= $single->id ?>' class=''><h3><?= $single->title ?></h3><span>Available until <?= date("l, F j, Y", $single->available_until) ?></span></a>
<?php } } ?>
					</aside>