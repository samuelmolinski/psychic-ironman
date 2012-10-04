<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework 
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />-->
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/m_ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params['root']; ?>/css/m_style.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params['root']; ?>/css/m_base.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params['root']; ?>/css/form.css" />
	<!-- scripts -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container clearfix" id="page">

	<!--<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'fb-Index', 'url'=>array('/fb_page/index')),
				array('label'=>'Fanpage', 'url'=>array('/fb_page/fanpage')),
				array('label'=>'Espalhe', 'url'=>array('/fb_page/espalhe')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div> mainmenu -->
	
	<?php echo $content; ?>

</div><!-- page -->

<div id="footer" class="clearfix">
	<div>			
		<div class="logo"><img src="<?php echo Yii::app()->params['root']; ?>/images/logo-mediocsSemFronteiras.png" /></div>
		<div class="text">Todo o conteúdo nas páginas com domínio msf.org.br é propriedade de Médicos Sem Fronteiras Brasil.<br />Este conteúdo está protegido com direitos reservados e outras leis de propriedade intelectual.</div>		
	</div>
</div><!-- footer -->
</body>
</html>
