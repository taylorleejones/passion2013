<div class="return-link"><a href="<?= base_url("admin/manage-pages") ?>">Return to Page Manager</a></div>
<h2>Add Page</h2>
<?php echo form_open("admin/add-page"); ?>
<div class="field">Author<br><?php echo form_input("author", set_value("author")); ?></div>
<div class="field">Title<br><?php echo form_input("title", set_value("title"), 'id="page-title"'); ?></div>
<div class="field">URL Slug<br><?php echo form_input("slug", set_value("slug"), 'id="page-slug"'); ?></div>
<div class="field">Page Content<br><?php echo form_textarea("content", set_value("content")); ?></div>
<div class="field"><?php echo form_checkbox("in_menu", "1", FALSE, 'class="checkbox"'); ?> Display In Menu</div>
<div class="field"><?php echo form_checkbox("as_post", "1", FALSE, 'class="checkbox"'); ?> Display As Post</div>
<div class="field"><?php echo validation_errors('<div class="validation-err">','</div>'); ?></div>
<div class="field"><?php echo form_submit("form-submit", "Add Page"); ?></div>
</form>