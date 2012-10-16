<?php
	//header('P3P: CP="IE is often a NIGHTMARE"');
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
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
	<script src="<?php echo Yii::app()->params['root']; ?>/js/browserDetect.js" type="text/javascript"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<script type="text/javascript">
		//var FacebookURL = '<?php echo Fb_pageController::genRedirect($this->getAction()->getId()); ?>';
		var FacebookURL = '<?php echo Fb_pageController::genRedirect("fanpage"); ?>';
		if (self.location == top.location) {			
			
			top.location.href = FacebookURL;
		} 

	</script>
	<script type="text/javascript">
	if(null == window.fb_totallikes_clicked) {
		window.fb_totallikes_clicked = false;
	}
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
		$("#btnGravarUsuario-fake").click(function() {
			
			var nome = $('#Newsletter_nome').val();
			var email = $('#Newsletter_email').val();
			var cidade = $('#Newsletter_cidade').val();
			var uf = $('#Newsletter_uf').val();

			if ((nome == '')||(email == '')||(cidade == '')||(uf == '')||(nome == 'Nome completo')||(email == 'E-mail')||(cidade == 'Cidade')||(uf == '0')||(uf == '')) {
				//||!($('#Newsletter_jahFezDoacoes01').is(':checked'))||($('#Newsletter_jahFezDoacoes02').is(':checked'))
				if ((nome == '')||(nome == 'Nome completo')) {
					$('#Newsletter_nome').addClass('error');
					alert("Por favor, preencha seu nome.");	
				}
				else if((email == '')||(email == 'E-mail')){
					$('#Newsletter_email').addClass('error');
					alert("Por favor, preencha seu email.");	
				}
				else if((uf == '')||(uf == '0')){
					$('#Newsletter_uf, #lblUf').addClass('error');
					alert("Por favor, preencha seu estado.");	
				}
				else if((cidade == '')||(cidade == 'Cidade')){
					$('#Newsletter_cidade').addClass('error');
					alert("Por favor, preencha sua cidade.");	
				}			
				/*if(!($('#Newsletter_jahFezDoacoes01').is(':checked'))||($('#Newsletter_jahFezDoacoes02').is(':checked'))){
					$('#Newsletter_jahFezDoacoes01, #Newsletter_jahFezDoacoes02').addClass('error');
					alert("Por favor, diga se já doou para o MSF.");	
				}*/	
				return false;
		  		
			} 
			var myWindow = alert("Seu cadastro foi realizado com sucesso. Obrigado.");
			/*	window.console.log('submit form');
			var callback = function(){
				window.console.log('submit form');
			 	$("#Newsletter-form").trigger('submit');
			};

			$(myWindow).unload(function(){
			  if(this.location == "about:blank"){
			    $(myWindow).unload(callback);
			  } else {
			    callback();
			  }
			});*/
			//return false;
		});
		$(".btn curtir iframe").click(function(){
			if(!window.fb_totallikes_clicked) {
				$(".totalLikes").text(parseInt($(".totalLikes").text())+1);
				window.fb_totallikes_clicked = true;
			}
		});
		
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
        function abre(x,y) {

			var w = 1000;
			var h = 480;
			var lado = (screen.width - w) / 2;
			var topo = (screen.height - h) / 2;
			window.open(x,y,'height='+h+',width='+w+',top='+topo+',left='+lado+'');

		}
		function abreBoard(x,y) {
			var w = 735;
			var h = 750;
			var lado = (screen.width - w) / 2;
			var topo = (screen.height - h) / 2;
			window.open(x,y,'height='+h+',width='+w+',top='+topo+',left='+lado+',status=1,scrollbars=1');
		}
		function limpaInputs(nomeinput, valor) {
		    if (nomeinput.value == valor) {
		        nomeinput.value = '';
		    }
		}

		function voltaInputs(nomeinput, valor) {
		    if (nomeinput.value == '') {
		        nomeinput.value = valor;
		    }
		}
    </script> 
    
    <script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-35495259-1']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	  
	 
	 $(document).ready(function(){
	    $('#whiteout_overlay').fadeOut(500, function(){/* callback functions stuff here */});
	 });
	
	</script>

</head>

<body>	
<div id="fb-root"></div>
<div id="whiteout_overlay" style="position:absolute;z-index:99998;background:#FFF;width:100%;height:100%"><img src="<?php echo Yii::app()->params['root']; ?>/images/spinning.gif" class="loadingGif" style="position:relative; display:block; margin: 350px auto 0;" /></div>
<!--<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1&appId=402784116453669";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

FB.init({
 appId  : '402784116453669',
 status : false, // check login status
 cookie : true, // enable cookies to allow the server to access the session
 xfbml  : true// parse XFBML
 });

 //FB.Canvas.setSize({ height: 3400px });
 FB.Canvas.setAutoGrow(7);

setInterval( function() {FB.Canvas.setSize($(document).height());}, 500);
 </script>-->
    <!-- then we have to include the all.js file -->
    <script src="https://connect.facebook.net/pt_BR/all.js" type="text/javascript"></script>
    <!-- and finally we can use the FB JS SDK and it will actually work :) -->
    <script type="text/javascript" charset="utf-8">
        FB.init({
            appId: '402784116453669', 
            status: true, 
            cookie: false, 
            xfbml: true
        });

        jQuery(window).load(function(){
            //resize our tab app canvas after our content has finished loading
            //setInterval( function() {FB.Canvas.setSize($(document).height());}, 500);
            FB.Canvas.setSize({height:600});
            FB.Canvas.setAutoGrow(7);
            //browserDetect();
        });

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
		<div class="logo"><a href="https://www.msf.org.br/" target="_blank"><img src="<?php echo Yii::app()->params['root']; ?>/images/logo-mediocsSemFronteiras.png" /></a></div>
		<div class="text">Todo o conteúdo nas páginas com domínio msf.org.br é propriedade de Médicos Sem Fronteiras Brasil.<br />Este conteúdo está protegido com direitos reservados e outras leis de propriedade intelectual.</div>		
	</div>
</div><!-- footer -->
<?php //d($this); ?>
<?php //d(get_defined_vars()); ?>
</body>
</html>
