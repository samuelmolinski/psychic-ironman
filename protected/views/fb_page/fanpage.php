<?php
	$this -> breadcrumbs = array('fanpage', );
?>
<h1>Fanpage</h1>

<p>You may change the content of this page by modifying the file <tt><?php echo __FILE__; ?></tt>.</p>

<?php ?><br />
<a id='userAuth' href='#' onclick='setTimeout(function() {top.location.href = "<?php echo $loginUrl; ?>"}, 500);'>Authorize app</a>