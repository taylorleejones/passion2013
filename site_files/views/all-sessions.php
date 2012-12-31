					<h1>All Sessions</h1>
					<aside id='session-thumbs' class='clearfix floatleft'>
<?php foreach($sessions as $single) { if($single->visible == 2 || $single->visible == 3) { ?>
						<a href='<?= base_url("session/".$single->slug) ?>' id='link-to-post-<?= $single->id ?>' class=''><h3><?= $single->title ?></h3><span>Available until <?= date("l, F j, Y", $single->available_until) ?></span></a>
<?php } } ?>
					</aside>

					<div id="right-bar">
					 	<a class="thumb" onClick="javascript: pageTracker._trackPageview('givetofreedm');" target="_blank" href="https://secure.268generation.com/dosomethingnow/give/freedom">Give<br>to Freedom</a>
					 	<a class="thumb" onClick="javascript: pageTracker._trackPageview('digitalAAccess');" target="_blank" href="http://store.passion2013.com/daa/dp/3">Buy<br/>Digital<br/>All Access</a>
					 	<div id="feedback">
						<form id="feedback_form" action="<?php /*bloginfo('template_directory');*/ ?>/sendfeedback.php" method="POST">
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
						<div id="tweetlist" <?php /*if (get_option('twitter_kill') == "true"){
							echo "class='twitter_kill'";
						}*/ ?>>Loading...</div>
						<div id="schedule-widget">
							<ul id="upcoming-sessions-list">
								<?php
								foreach($sessions as $single) {
									if($single->visible == 1){
										$stime = date("l, F j, Y, g:i A", $single->start_time);
										echo "<li><div class='session-title " . $single->id ."'>" . $single->title . "</div><div class='session-time'>$stime&nbsp;EST</div></li>";
									} 
								}
								?>
							</ul>
						</div><!-- eo #schedule-widget -->
					</div><!-- eo #twidget -->
