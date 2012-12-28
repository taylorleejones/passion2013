<article>
<div id="bg_player_location">
  <div id="my-video"></div>
	<script type='text/javascript'>
		jwplayer('my-video').setup({
			file: '<?= base_url() ?>test.smil',
			width: '640',
			height: '380',
			autostart: true
		});
	</script>
</div>
</article>

<div id="right-bar">
<?php if($current) { ?>
<a class="thumb" href="<?= base_url("session/".$current) ?>">Watch<br><span class="yellow">Live</span> Session</a>
<?php } else { ?>
<a class="thumb" href="<?= base_url("all-sessions") ?>">Watch<br/>Past Sessions</a>
<?php } ?>
<a class="thumb" onClick="javascript: pageTracker._trackPageview('givetofreedm');" target="_blank"href="https://secure.268generation.com/dosomethingnow/give/freedom">Give<br>To Freedom</a>
</div>