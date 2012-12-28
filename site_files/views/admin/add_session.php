<div class="return-link"><a href="<?= base_url("admin/manage-sessions") ?>">Return to Session Manager</a></div>
<h2>Add Session</h2>
<?php echo form_open("admin/add-session"); ?>
<div class="field">Title<br><?php echo form_input("title", set_value("title"), 'id="session-title"'); ?></div>
<div class="field">URL Slug<br><?php echo form_input("slug", set_value("slug"), 'id="session-slug"'); ?></div>
<div class="field">Live SMIL<br><?php echo form_input("live_smil", set_value("live_smil")); ?></div>
<div class="field">Archive SMIL<br><?php echo form_input("archive_smil", set_value("archive_smil")); ?></div>
<div class="field">Description<br><?php echo form_textarea("description", set_value("description")); ?></div>
<div class="field time-date">
  Start Date <?php echo form_input("start_date", set_value("start_date"), 'id="session-date-start"'); ?>
  <span>Start Time <?php echo form_input("start_time", set_value("start_time"), 'id="session-time-start"'); ?></span>
</div>
<div class="field time-date">
  End Date <?php echo form_input("end_date", set_value("end_date"), 'id="session-date-end"'); ?>
  <span>End Time <?php echo form_input("end_time", set_value("end_time"), 'id="session-time-end"'); ?></span>
</div>
<div class="field time-date">Available Until <?php echo form_input("available_until", set_value("available_until"), 'id="available-until"'); ?></div>
<div class="field"><?php echo validation_errors('<div class="validation-err">','</div>'); ?></div>
<div class="field"><?php echo form_submit("form-submit", "Add Session"); ?></div>
</form>