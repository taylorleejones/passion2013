<?php /* if($live) { ?>
<script type="text/javascript">
document.location = "<?= base_url('session/'.$live) ?>";
</script>
<?php } */ ?>

<article>
<div id="bg_player_location">
  <div id="my-video"></div>
	<script type='text/javascript'>
		jwplayer('my-video').setup({
			playlist: [{
				provider: 'http://players.edgesuite.net/flash/plugins/jw/v2.11/jw6/AkamaiAdvancedJWStreamProvider.swf',
				file: 'http://passion2-vh.akamaihd.net/DVR/passion2013/mp4/LGIntro.mp4',
				type : 'mp4'
			}],
			width: '640',
			height: '380',
			primary: 'flash',
			autostart: true
		});
	</script>
</div>
</article>

<div id="right-bar">
<?php if($live) { ?>
<a class="thumb" href="<?= base_url("session/".$live) ?>">Watch<br><span class="yellow">Live</span> Session</a>
<?php } else { ?>
<a class="thumb" href="<?= base_url("all-sessions") ?>">Watch<br/>Past Sessions</a>
<?php } ?>
<a class="thumb" onClick="javascript: pageTracker._trackPageview('givetofreedm');" target="_blank"href="https://secure.268generation.com/dosomethingnow/give/freedom">Give<br>To Freedom</a>
</div>