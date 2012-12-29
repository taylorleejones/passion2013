<?php if($message) { ?>
<div class="result-message"><?= $message ?></div>
<?php } ?>
<h2 class="section-header"><a href="add-session">Add New Session</a><h2>

<h2 class="section-header">Existing Sessions</h2>
<div class="session-holder">
<?php if(!empty($sessions)) { foreach($sessions as $single) { ?>
  <div class="single-session clearfix">
  	<div class="session-id"><?= $single->id ?></div>
  	<div class="session-title"><?= $single->title ?></div>
  	<div class="session-edit"><a href="<?= base_url("admin/edit-session/".$single->id) ?>">Edit Details</a></div>
  	<div class="session-switch">
      Off <input type="radio" class="session-on-off" name="<?= $single->id ?>-switch" value="0"<?php if($single->visible == 0) echo ' checked="checked"'; ?> />
      Future <input type="radio" class="session-on-off" name="<?= $single->id ?>-switch" value="1"<?php if($single->visible == 1) echo ' checked="checked"'; ?> />
      Live <input type="radio" class="session-on-off" name="<?= $single->id ?>-switch" value="2"<?php if($single->visible == 2) echo ' checked="checked"'; ?> />
      Archived <input type="radio" class="session-on-off" name="<?= $single->id ?>-switch" value="3"<?php if($single->visible == 3) echo ' checked="checked"'; ?> />
  	</div>
  </div>
<?php } } else { echo "No sessions yet!"; } ?>
</div>