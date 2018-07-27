<?php

require_once('rl_init.php');
if ($options['notes_disable']) {
	require_once('deny.php');
	exit();
}

login_check();

include(TEMPLATE_DIR.'header.php'); ?>
<br />
<?php

	if (!file_exists(DOWNLOAD_DIR.basename(lang(327)).'.txt')) {
		$temp = fopen(DOWNLOAD_DIR.basename(lang(327)).'.txt', 'w');
		fclose($temp);
	}
	if (isset($_POST['notes']) && $_POST['notes']) {
		file_put_contents(DOWNLOAD_DIR.basename(lang(327)).'.txt', $_POST['notes']);
?>
	<p><?php echo lang(325); ?></p>
<?php
	}
	$content = file_get_contents(DOWNLOAD_DIR.basename(lang(327)).'.txt');
?>
<div class="box-body">
<form method="post" action="<?php echo $PHP_SELF;?>">
<div class="form-group">
<textarea class="form-control" class="notes" name="notes" rows="8"><?php echo htmlentities($content); ?></textarea>
</div>
<div class="form-group">
<input class="btn btn-primary" type="submit" name="submit" value="<?php echo lang(326); ?>" />
</div>
</form>
</div>
<?php include(TEMPLATE_DIR.'footer.php'); ?>