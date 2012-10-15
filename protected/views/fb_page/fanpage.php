<?php 
	//$me = Yii::app()->facebook->api('/me');
	//d($me['id']);
	//d($userId);
	/*$auth = $this->authenticate();
	$me = Yii::app()->facebook->api('/me');
	$user = Yii::app()->facebook->api($userId);
	$friend0 = Yii::app()->facebook->api($id0);
	$friend1 = Yii::app()->facebook->api($id1);
	$friend2 = Yii::app()->facebook->api($id2);
	$p = new sfFacebookPhoto;
	$user['photo'] = $p->getRealUrl("https://graph.facebook.com/$userId/picture?type=large");
	$friend0['photo'] = $p->getRealUrl("https://graph.facebook.com/$id0/picture?type=large");
	$friend1['photo'] = $p->getRealUrl("https://graph.facebook.com/$id1/picture?type=large");
	$friend2['photo'] = $p->getRealUrl("https://graph.facebook.com/$id2/picture?type=large");*/
	$states = array( 0=>'UF','AC'=>'AC','AL'=>'AL','AM'=>'AM','AP'=>'AP','BA'=>'BA','CE'=>'CE','DF'=>'DF','ES'=>'ES','GO'=>'GO','MA'=>'MA','MG'=>'MG','MS'=>'MS','MT'=>'MT','PA'=>'PA','PB'=>'PB','PI'=>'PI','PR'=>'PR','RJ'=>'RJ','RN'=>'RN','RO'=>'RO','RR'=>'RR','RS'=>'RS','SC'=>'SC','SE'=>'SE','SP'=>'SP','TO'=>'TO');

	$root = Yii::app()-> params['root'];
	
	if(!$shareLink){
		//$visitor was coming always null :/
		$visitor = true;
		$arr = array('userId'=>$userId,
			'userp'=>$userp, 
			'usern'=>$usern, 
			'id0'=>$id0, 
			'id0p'=>$id0p, 
			'id0un'=>$id0un,
			'id1'=>$id1, 
			'id1p'=>$id1p, 
			'id1un'=>$id1un,
			'id2'=>$id2, 
			'id2p'=>$id2p, 
			'id2un'=>$id2un,
			'friendCount'=>$friendCount);
		$shareLink = $this->generateFanpageLink($arr);
	}

?>
<div id='fanpage'>
	
	<a href="https://www.facebook.com/MedicosSemFronteiras/app_402784116453669" target="_blank"><img id="poderDoSueCurtirLG" src="<?php echo Yii::app()->params['root']; ?>/images/logo-poderDoSeuCurtir-lg.png"/></a>
    
	<div class="userTitle">
		<span class='intro'><hr class="por part"/><span class="subtitle">POR</span><hr class="por part"/></span>
		<span class="userName"><?php echo $usern; ?></span>
		<hr class="bot"/>
	</div>
	<div class="abel">
	<?php if($visitor) { ?>
	<p>Quando <?php echo $usern; ?> curte ou compartilha nossos<br />conteúdos, ele(a) destaca a nossa atuação para seus </p>
	<?php } else { ?>
	<p>Quando você curte ou compartilha nossos<br />conteúdos, destaca a nossa atuação para seus </p>
	<?php } ?>
	<span class="friendCount fb_font"><?php echo $friendCount ?> Amigos</span>
	<p>Mas o potencial real é muito maior, chegando a</p>
	</div>
	<div class="curtirRibbon"><span class="improvedfriendCount fb_font"><?php echo number_format($friendCount*206, 0, '', '.'); ?> Amigos</span></div>
    <?php if($visitor) { ?>
	<p style="font-size: 34px;">Dessa forma, a crise no Sudão do Sul, por<br />exemplo, pode fazer parte de debates com<br />pessoas com quem ele(a) costuma interagir.</p>
	<?php } else { ?>
	<p style="font-size: 34px;">Dessa forma, a crise no Sudão do Sul, por<br />exemplo, pode fazer parte de debates com<br />pessoas com quem você costuma interagir.</p>
	<?php } ?>
	
	<div id="connections">
		<div id="friend0">
			<a href="https://facebook.com/<?php echo $id0 ?>" target="_blank"><img src="<?php echo Yii::app()-> params['root']."/timthumb.php?h=125&w=125&zc=1&src=".$id0p ?>" width="125" height="125"/></a>
			<span class="name"><?php echo $id0un ?></span>
		</div>
		<div id="friend1">
			<a href="https://facebook.com/<?php echo $id1 ?>"  target="_blank"><img src="<?php echo Yii::app()-> params['root']."/timthumb.php?h=125&w=125&zc=1&src=".$id1p ?>"  width="125" height="125"/></a>
			<span class="name"><?php echo $id1un ?></span>
		</div>
		<div id="friend2">
			<a href="https://facebook.com/<?php echo $id2 ?>"  target="_blank"><img src="<?php echo Yii::app()-> params['root']."/timthumb.php?h=105&w=95&zc=1&src=".$id2p ?>"  width="95" height="105"/></a>
			<span class="name"><?php echo $id2un ?></span>
		</div>
	</div>
	<p  style="font-size: 18px;">Esse poder divulga crises humanitárias que a imprensa não costuma mostrar<br />e valoriza nosso trabalho. Além disso, dá força para os mais de 30 mil Médicos Sem Fronteiras<br />terem certeza de que cada esforço valeu a pena.</p>
	<img id="map" src="<?php echo Yii::app()->params['root']; ?>/images/layout-map.png" />
	<div id="callToAction">
		<div class="userPhotoFrame">
			<img id="userPhoto" src="<?php echo Yii::app()-> params['root']."/timthumb.php?h=255&w=225&zc=1&src=".$userp ?>"  width="225" height="245"/>
			<img class="icon-msf" src="<?php echo Yii::app()->params['root']; ?>/images/icon-msf.png" />
		</div>
		<div class="formWrapper">
        
        	<?php if($visitor) { ?>
            <h2>É <?php echo $usern; ?> atuando com a gente. É <?php echo $usern; ?> como um verdadeiro Amigo Sem Fronteiras.</h2>
			<p style="font-size: 20px;">Agora, descubra o seu Poder do Curtir<br />e ajude a espalhar ainda mais a nossa causa.</p>
            <?php } else { ?>
            <h2>É você atuando com a gente. É você como um verdadeiro Amigo Sem Fronteiras.</h2>
			<p style="font-size: 20px;">Agora, seja um Voluntário Virtual, receba nossos materiais<br />e ajude a espalhar ainda mais a nossa causa.</p>
            <?php } ?>			
			
			<div class="buttons">				
				<?php if($visitor) { ?>				
				<a href="javascript:;" onClick="abre('https://www.facebook.com/dialog/feed?app_id=402784116453669&link=<?php echo $shareLink; ?>&picture=https://www.msf.org.br/poderdocurtir/images/icons/Icone_app_111x74.png&name=Veja o Poder do Curtir de <?php echo $usern ?>&description=Descubra o seu Poder do Curtir e venha fazer a diferença junto com Médicos Sem Fronteiras, pois a vida é mais importante do que as fronteiras.&redirect_uri=https%3A//www.msf.org.br/poderdocurtir/Fbshare.html');"><div class="compartilhe other btn"></div></a>
				<a href="https://www.facebook.com/MedicosSemFronteiras/app_402784116453669" target="_blank"><div class="discover other btn"></div></a>
				<?php } else { ?>
				<a href="javascript:;" onClick="abre('https://www.facebook.com/dialog/feed?app_id=402784116453669&link=<?php echo $shareLink; ?>&picture=https://www.msf.org.br/poderdocurtir/images/icons/Icone_app_111x74.png&name=Veja o Poder do Curtir de <?php echo $usern ?>&description=Descubra o seu Poder do Curtir e venha fazer a diferença junto com Médicos Sem Fronteiras, pois a vida é mais importante do que as fronteiras.&redirect_uri=https%3A//www.msf.org.br/poderdocurtir/Fbshare.html');"><div class="compartilhe btn"></div></a>
				<a href="#" onClick="newInvite(); return false;"><div class="discover btn"></div></a>
				<?php } ?>
			</div>

			<?php if($visitor) { ?>
            <!-- start yes widget if -->
			<?php } else { ?>
			<div class="inscreva-se"> 

				<?php
					$form = $this -> beginWidget('CActiveForm', array(
						'id' => 'Newsletter-form',
						'enableAjaxValidation' => false,
					));
				?>

                <span class="campo gg">      
					<?php echo $form->textField($model, 'nome', array('value'=>'Nome completo', 'class'=>'g required', 'onfocus' => 'limpaInputs(this,\'Nome completo\')', 'onblur' => 'voltaInputs(this,\'Nome completo\')')); ?>
                </span>

                <span class="campo gg">      
					<?php echo $form->textField($model, 'email', array('value'=>'E-mail', 'class'=>'g required', 'onfocus' => 'limpaInputs(this,\'E-mail\')', 'onblur' => 'voltaInputs(this,\'E-mail\')')); ?>
                </span>
                <div id="UpdatePanel1">	
                    <span class="clearfix" style="margin-left: 6px;">
                        <span class="campo select bgselect">
                            <span class="bgselectright" style="width: 45px;">
                                <span id="lblUf">UF</span>
                                <?php echo $form->dropDownList($model, 'uf', $states, array('value'=>'uf', 'class'=>'g required')); ?>
                                
					        </span>
                        </span>
                    </span>							                        
				</div>
                <span class="campo gg">      
					<?php echo $form->textField($model, 'cidade', array('value'=>'Cidade', 'class'=>'g required', 'onfocus' => 'limpaInputs(this,\'Cidade\')', 'onblur' => 'voltaInputs(this,\'Cidade\')')); ?>
                </span>
                <span>
                    <label style="color:#777777;">Já doou para a MSF?</label>
                    <br>

                    <table id="rbtDoou" cellspacing="2" cellpadding="2" border="0">
						<tbody>
							<tr>
								<td><span style="color: rgb(119, 119, 119);">
									<?php echo $form->radioButton($model, 'jahFezDoacoes', array('value'=>'1', 'id'=>'Newsletter_jahFezDoacoes01', 'class'=>'required')); ?>
									<label for="rbtDoou_0">Sim</label></span>
								</td>
								<td>
									<span style="color: rgb(119, 119, 119);">
										<?php echo $form->radioButton($model, 'jahFezDoacoes', array('value'=>'0', 'id'=>'Newsletter_jahFezDoacoes02', 'class'=>'required')); ?>
										<label for="rbtDoou_1">Não</label>
									</span>
								</td>
							</tr>
						</tbody>
					</table>
                </span>
                <?php
					echo CHtml::submitButton('', array('id'=>'btnGravarUsuario', 'class'=>'bot-enviar btn', 'name'=>"btnGravarUsuario"));
				?>
                <!-- <input type="image" name="btnGravarUsuario" id="btnGravarUsuario" class="bot-enviar" src="https://www.msf.org.br/imagens/botoes/bot-enviar-news.gif" onclick="return validaNewsLetterHome();" style="border-width:0px;"> -->
                <?php $this -> endWidget(); ?>
            </div>
            <!-- end yes widget if -->
            <?php } d($visitor);?>
		</div>
	</div>
</div>
<script>
<?php if($visitor) { ?>
            <!-- start yes widget if -->
<?php } else { ?>
	$(document).ready (function(){
		//https://www.msf.org.br/poderdocurtir/autosharing.php?forwardURL=
		var params = "name=<?php echo $usern ?>&shareLink=<?php echo $shareLink ?>";
			window.console.log(params);
		$.ajax( {  
			type: "POST",  
			url: "https://www.msf.org.br/poderdocurtir/ajax_fb_postwall.php",
			async: false,
			data: params,
			dataType: "json",
			
			success: function(ret){window.console.log('success');},
			error: function(XMLHttpRequest, textStatus, errorThrown){window.console.log('error');}			    	
		}); 
	});
<?php } ?>
</script>