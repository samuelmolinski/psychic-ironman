<?php 
	
?>
<div id="logoVideo" class="clearfix">	
	<a href="<?php echo CHtml::normalizeUrl(array('fb_page/index')); ?>"><img class="msf-logo-espalhe" src="<?php echo Yii::app()-> params['root']; ?>/images/logo-espalhe.png"></a>
</div>
<div class="espalheIntro">
	<p>Faça download de uma das nossas imagens <br />e coloque como foto de capa do seu perfil no Facebook.</p>

</div>
<div id="boards" class="clearfix">
	<div class='board'>
		<a href="<?php echo Yii::app()->params['root'] ?>/m_download.php?file=CoverPessoal_02.jpg"><img src="<?php echo Yii::app()-> params['root']; ?>/images/cp2.png" /></a>
	</div>
	<div class='board'>
		<a href="<?php echo Yii::app()->params['root'] ?>/m_download.php?file=CoverPessoal_03.jpg"><img src="<?php echo Yii::app()-> params['root']; ?>/images/cp3.png" /></a>
	</div>
	<div class='board'>
		<a href="<?php echo Yii::app()->params['root'] ?>/m_download.php?file=CoverPessoal_04.jpg"><img src="<?php echo Yii::app()-> params['root']; ?>/images/cp4.png" /></a>
	</div>
	<div class='board share'>
		<a href="https://twitter.com/MSF_brasil" target="_blank"><img src="<?php echo Yii::app()-> params['root']; ?>/images/logo-twitter.png" /></a>
		<hr />
		<a href="https://www.msf.org.br/formulario_doacao.aspx?source=poderdocurtir" target="_blank"><img src="<?php echo Yii::app()-> params['root']; ?>/images/logo-doe.png" /></a>
	</div>
</div>
<div class="espalheIntro">
	<p>Clique na imagem que preferir e compartilhe com seus amigos.<br />Copie o endereço da ação - <a href="http://www.msf.org.br/poderdocurtir" target='_blank'>www.msf.org.br/poderdocurtir</a><br/>e coloque no seu post junto com a imagem.</p>
	<!-- <p>Compartilhe algumas imagens e publique na sua timeline,chamando seus amigos pra conhecerem a ação.<br />Não esqueça de compartilhar também o link, <a href="http://www.msf.org.br/poderdocurtir" target='_blank'>www.msf.org.br/poderdocurtir</a></p> -->
</div>
<div id="boards" class="clearfix">
	<?php 
		$urls = array(
			'https://www.facebook.com/photo.php?fbid=507255659285654&set=a.507255462619007.122390.111139578897266&type=3&theater',
			'https://www.facebook.com/photo.php?fbid=507255515952335&set=a.507255462619007.122390.111139578897266&type=3&theater',
			'https://www.facebook.com/photo.php?fbid=507255602618993&set=a.507255462619007.122390.111139578897266&type=3&theater',
			'https://www.facebook.com/photo.php?fbid=507255705952316&set=a.507255462619007.122390.111139578897266&type=3&theater',
			'https://www.facebook.com/photo.php?fbid=507255755952311&set=a.507255462619007.122390.111139578897266&type=3&theater',
			'https://www.facebook.com/photo.php?fbid=507255795952307&set=a.507255462619007.122390.111139578897266&type=3&theater',
			'https://www.facebook.com/photo.php?fbid=507255825952304&set=a.507255462619007.122390.111139578897266&type=3&theater'
			);

		for ($i=0; $i < 7; $i++) { 
			$js_link = "abreBoard(\"{$urls[$i]}\");";
			$count = $i +1;
			$board = Yii::app()->params['root']."/images/board0$count.png";
			echo "<div class='board'><a href='#' onClick='$js_link' ><img src='$board' /></a></div>";
		}
	?>
	<div class='board share'>
		<a href="https://twitter.com/MSF_brasil" target="_blank"><img src="<?php echo Yii::app()-> params['root']; ?>/images/logo-twitter.png" /></a>
		<hr />
		<a href="https://www.msf.org.br/formulario_doacao.aspx?source=poderdocurtir" target="_blank"><img src="<?php echo Yii::app()-> params['root']; ?>/images/logo-doe.png" /></a>
	</div>
</div>