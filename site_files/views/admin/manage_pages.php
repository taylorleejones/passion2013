<?php if($message) { ?>
<div class="result-message"><?= $message ?></div>
<?php } ?>
<h2 class="section-header"><a href="add-page">Add New Page</a><h2>

<h2 class="section-header">Existing Pages</h2>
<div class="page-holder">
<?php if(!empty($pages)) { foreach($pages as $single) { ?>
  <div class="single-page clearfix">
  	<div class="page-id"><?= $single->id ?></div>
  	<div class="page-title"><?= $single->title ?></div>
  	<div class="page-edit"><a href="<?= base_url("admin/edit-page/".$single->id) ?>">Edit Details</a></div>
  </div>
<?php } } else { echo "No pages yet!"; } ?>
</div>