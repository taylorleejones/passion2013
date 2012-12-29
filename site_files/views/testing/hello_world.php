<?php echo date("U"); ?>
<br /><br />
Time: <?php echo $this->benchmark->elapsed_time(); ?>
<br />Mem: <?php echo $this->benchmark->memory_usage(); ?>
<br /><br />
<div class="json-output"></div>