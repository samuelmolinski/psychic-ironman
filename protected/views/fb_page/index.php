<?php
	$this -> breadcrumbs = array('index', );

	//Yii::app() -> facebook -> ogTags['title'] = "My Page Title";
?>
<div id="logoVideo" class="clearfix">
	<div class="cutir">
		<img class="msf-logo" src="<?php echo Yii::app()-> params['root']; ?>/images/logo-mediocsSemFronteiras.png">
		<img class="msf-curtir" src="<?php echo Yii::app()-> params['root']; ?>/images/logo-poderDoSeuCurtir.png">
	</div>
	<div class="mainVideo">
		<iframe width="485" height="296" src="http://www.youtube.com/embed/g63uwgbAbZE" frameborder="0" allowfullscreen></iframe>
	</div>
</div>
<div id="network" class="clearfix">
	<div class="rede"><img class="" src="<?php echo Yii::app()-> params['root']; ?>/images/logo-msfRede.png"></div>
	<div class="underMainVideo">
		<div class="auth">
			<div class="btn connectFacebook"></div>
		</div>
		<div class="curtirCount">
			<div class="count"><span class="totalLikesContainer">+&nbsp;<span class="totalLikes">134,302</span></span></div>			
			<div class="btn curtir"></div>
		</div>
	</div>
</div>
<div id="videos" class="clearfix">
	
</div>
<div id="callToAction" class="clearfix">
	
</div>

<?php ?>

<br />
<a id='userAuth' href='#' onclick='setTimeout(function() {top.location.href = "<?php //echo $loginUrl; ?>"}, 500);'>Authorize app</a>