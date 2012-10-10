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
	<script src="<?php echo Yii::app()->params['root']; ?>/js/validate.js" type="text/javascript"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<script type="text/javascript">
		//var FacebookURL = '<?php echo Fb_pageController::genRedirect($this->getAction()->getId()); ?>';
		var FacebookURL = '<?php echo Fb_pageController::genRedirect("fanpage"); ?>';
		if (self.location == top.location) {
			//setTimeout(top.location.href = FacebookURL, 200);
		} 
	</script>
	<script type="text/javascript">
	$(document).ready(function() {
		// validate signup form on keyup and submit
		//$("#Newsletter-form").validate();
		$("#Newsletter_uf").change(function(){
			$('#lblUf').html($('#Newsletter_uf').val());
			$('#lblUf').removeClass('error');
		});
		$('#Newsletter_nome, #Newsletter_cidade, #Newsletter_uf, #Newsletter_email, #Newsletter_jahFezDoacoes01, #Newsletter_jahFezDoacoes02, #lblUf').click(function() {
			$(this).removeClass('error');
			if($(this) == $('#Newsletter_uf')) {
				$('#lblUf').removeClass('error');
			}
		});
		$("#Newsletter-form").submit(function() {
			if(!($('#Newsletter_jahFezDoacoes01').is(':checked') == '')||($('#Newsletter_jahFezDoacoes02').is(':checked') == '')){
				$('#Newsletter_jahFezDoacoes01, #Newsletter_jahFezDoacoes02').addClass('error');
		  		return false;
			} 
			var nome = $('#Newsletter_nome').val();
			var email = $('#Newsletter_email').val();
			var cidade = $('#Newsletter_cidade').val();
			var uf = $('#Newsletter_uf').val();

			if ((nome == '')||(email == '')||(cidade == '')||(uf == '')||(nome == 'Nome completo')||(email == 'E-mail')||(cidade == 'Cidade')||(uf == '0')) {
				
				if ((nome == '')||(nome == 'Nome completo')) {
					$('#Newsletter_nome').addClass('error');
				}
				if((cidade == '')||(cidade == 'Cidade')){
					$('#Newsletter_cidade').addClass('error');
				}
				if((uf == '')||(uf == '0')){
					$('#Newsletter_uf, #lblUf').addClass('error');
				}
				if((email == '')||(email == 'E-mail')){
					$('#Newsletter_email').addClass('error');
				}
				alert("Failed!");				
		  		return false;
			} 
		  	return false;
			alert("pass!");
		});
		alert("setup!");
	});
	</script>

	<script type="text/javascript"> 
        function newInvite(){
             var receiverUserIds = FB.ui({ 
                    method : 'apprequests',
                    message: 'Que amigos você deseja convidar para o aplicativo do MSF?',
             },
             function(receiverUserIds) {
                      console.log("IDS : " + receiverUserIds.request_ids);
                    }
             );   
        }
    </script> 
</head>

<body>	
<script src="http://connect.facebook.net/pt_BR/all.js"></script>
<script>
FB.init({
 appId  : '402784116453669',
 status : false, // check login status
 cookie : true, // enable cookies to allow the server to access the session
 xfbml  : true// parse XFBML
 });

 //FB.Canvas.setSize({ height: 3400px });
 FB.Canvas.setAutoResize(7);

 </script>

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
<?php //d($this); ?>
<?php //d(get_defined_vars()); ?>
</body>
</html>
