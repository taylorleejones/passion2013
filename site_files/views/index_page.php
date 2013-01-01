<?php if($live) { ?>
<script type="text/javascript">
document.location = "<?= base_url('session/'.$live) ?>";
</script>
<?php } ?>

<article>
<div id="bg_player_location">
  <div id="my-video"></div>
	<script type='text/javascript'>
		jwplayer('my-video').setup({
			sources: [{
				file: 'http://passion2-vh.akamaihd.net/DVR/passion2013/mp4/LGIntro.mp4',
			}],
			width: '640',
			height: '380',
			autostart: true
		});
	</script>
</div>
</article>

<div id="right-bar">
<?php /* <a class="thumb" href="<?= base_url("session/".$current) ?>">Watch<br><span class="yellow">Live</span> Session</a> */ ?>
<a class="thumb" href="<?= base_url("all-sessions") ?>">Watch<br/>Past Sessions</a>
<a class="thumb" onClick="javascript: pageTracker._trackPageview('givetofreedm');" target="_blank"href="http://giving.passion2013.com">Give<br>To Freedom</a>
</div>