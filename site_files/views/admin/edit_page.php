<div class="return-link"><a href="<?= base_url("admin/manage-pages") ?>">Return to Page Manager</a></div>
<?php if($message) { ?>
<div class="result-message"><?= $message ?></div>
<?php } ?>
<h2>Edit Page &quot;<?= $page->title ?>&quot;</h2>
<?php echo form_open(base_url("admin/edit-page/".$page->id)); ?>
<div class="field">Author<br><?php echo form_input("author", set_value("author", $page->author)); ?></div>
<div class="field">Title<br><?php echo form_input("title", set_value("title", $page->title), 'id="page-title"'); ?></div>
<div class="field">URL Slug<br><?php echo form_input("slug", set_value("slug", $page->slug), 'id="page-slug"'); ?></div>
<div class="field">Page Content<br><?php echo form_textarea("content", set_value("content", $page->content)); ?></div>
<div class="field"><?php echo form_checkbox("in_menu", "1", $page->in_menu, 'class="checkbox"'); ?> Display In Menu</div>
<div class="field"><?php echo form_checkbox("as_post", "1", $page->as_post, 'class="checkbox"'); ?> Display As Post</div>
<div class="field"><?php echo validation_errors('<div class="validation-err">','</div>'); ?></div>
<div class="field"><?php echo form_submit("form-submit", "Edit Page"); ?></div>
</form>