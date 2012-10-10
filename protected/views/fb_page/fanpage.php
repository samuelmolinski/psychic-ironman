<?php 

	$auth = $this->authenticate();
	$me = Yii::app()->facebook->api('/me');
	$user = Yii::app()->facebook->api($userId);
	$friend0 = Yii::app()->facebook->api($id0);
	$friend1 = Yii::app()->facebook->api($id1);
	$friend2 = Yii::app()->facebook->api($id2);
	$p = new sfFacebookPhoto;
	$states = array( 0=>'UF','AC'=>'AC','AL'=>'AL','AM'=>'AM','AP'=>'AP','BA'=>'BA','CE'=>'CE','DF'=>'DF','ES'=>'ES','GO'=>'GO','MA'=>'MA','MG'=>'MG','MS'=>'MS','MT'=>'MT','PA'=>'PA','PB'=>'PB','PI'=>'PI','PR'=>'PR','RJ'=>'RJ','RN'=>'RN','RO'=>'RO','RR'=>'RR','RS'=>'RS','SC'=>'SC','SE'=>'SE','SP'=>'SP','TO'=>'TO');

	$user['photo'] = $p->getRealUrl("http://graph.facebook.com/$userId/picture?type=large");
	$friend0['photo'] = $p->getRealUrl("http://graph.facebook.com/$id0/picture?type=large");
	$friend1['photo'] = $p->getRealUrl("http://graph.facebook.com/$id1/picture?type=large");
	$friend2['photo'] = $p->getRealUrl("http://graph.facebook.com/$id2/picture?type=large");

	$friends = Yii::app()->facebook->api("/$userId/friends");
	//d($friends);
	$user['friendCount'] = count($friends['data'])+1;
	$root = Yii::app()-> params['root'];
	//d($user);

	if($me['id']==$userId) {
		$visitor = false;
	} else {
		$visitor = true;
	}

	d($_POST);
	d($shareLink)
?>
<div id='fanpage'>
	<img id="poderDoSueCurtirLG" src="<?php echo Yii::app()->params['root']; ?>/images/logo-poderDoSeuCurtir.png"/>
	<div class="userTitle">
		<span class='intro'><hr class="por part"/><span class="subtitle">POR</span><hr class="por part"/></span>
		<span class="userName"><?php echo $user['name']; ?></span>
		<hr class="bot"/>
	</div>
	<div class="abel">
	<?php if($visitor) { ?>
	<p>Quando o <?php echo $user['name']; ?> curte ou compartilha nossos<br />conteúdos, ele destaca a nossa atuação para seus </p>
	<?php } else { ?>
	<p>Quando você curte ou compartilha nossos<br />conteúdos, destaca a nossa atuação para seus </p>
	<?php } ?>
	<span class="friendCount fb_font"><?php echo $user['friendCount'] ?> Amigos</span>
	<p>Mas o potencial real é muito maior, chegando a</p>
	</div>
	<div class="curtirRibbon"><span class="improvedfriendCount fb_font"><?php echo $user['friendCount']*231 ?> Amigos</span></div>
	<p style="font-size: 34px;">Dessa forma, a crise no Sudão do Sul, por<br />exemplo, pode fazer parte de debates com<br />pessoas com quem ele costuma interagir.</p>
	<div id="connections">
		<div id="friend0">
			<a href="http://facebook.com/<?php echo $id0 ?>" target="_blank"><img src="<?php echo Yii::app()-> params['root']."/timthumb.php?h=125&w=125&zc=1&src=".$friend0['photo'] ?>" width="125" height="125"/></a>
			<span class="name"><?php echo $friend0['first_name'] ?></span>
		</div>
		<div id="friend1">
			<a href="http://facebook.com/<?php echo $id1 ?>"  target="_blank"><img src="<?php echo Yii::app()-> params['root']."/timthumb.php?h=125&w=125&zc=1&src=".$friend1['photo'] ?>"  width="125" height="125"/></a>
			<span class="name"><?php echo $friend1['first_name'] ?></span>
		</div>
		<div id="friend2">
			<a href="http://facebook.com/<?php echo $id2 ?>"  target="_blank"><img src="<?php echo Yii::app()-> params['root']."/timthumb.php?h=105&w=95&zc=1&src=".$friend2['photo'] ?>"  width="95" height="105"/></a>
			<span class="name"><?php echo $friend2['first_name'] ?></span>
		</div>
	</div>
	<p  style="font-size: 18px;">Esse poder divulga crises humanitárias que a imprensa não costuma mostrar<br />e valoriza nosso trabalho. Além disso, dá força para os mais de 30 mil Médicos Sem Fronteiras<br />terem certeza de que cada esforço valeu a pena.</p>
	<img id="map" src="<?php echo Yii::app()->params['root']; ?>/images/layout-map.png" />
	<div id="callToAction">
		<div class="userPhotoFrame">
			<img id="userPhoto" src="<?php echo Yii::app()-> params['root']."/timthumb.php?h=255&w=225&zc=1&src=".$user['photo'] ?>"  width="225" height="245"/>
			<img class="icon-msf" src="<?php echo Yii::app()->params['root']; ?>/images/icon-msf.png" />
		</div>
		<div class="formWrapper">			
			<h2>É você atuando com a gente. É você como um verdadeiro Amigo Sem Fronteiras.</h2>
			<p style="font-size: 20px;">Agora, seja um Voluntário Virtual, receba nossos materiais<br />e ajude a espalhar ainda mais a nossa causa.</p>
			<div class="buttons">				
				<?php if($visitor) { ?>				
				<div class="compartilhe other btn"></div>
				<div class="discover other btn"></div>
				<?php } else { ?>
				<div class="compartilhe btn"></div>
				<div class="discover btn"></div>
				<?php } ?>
			</div>
			<div class="inscreva-se"> 

				<?php
					$form = $this -> beginWidget('CActiveForm', array(
						'id' => 'Newsletter-form',
						'enableAjaxValidation' => false,
					));
				?>      

                <span class="campo gg">      
					<?php echo $form->textField($model, 'nome', array('value'=>'Nome completo', 'class'=>'g', 'onfocus' => 'limpaInputs(this,\'Nome completo\')', 'onblur' => 'voltaInputs(this,\'Nome completo\')')); ?>
                </span>

                <span class="campo gg">      
					<?php echo $form->textField($model, 'email', array('value'=>'E-mail', 'class'=>'g', 'onfocus' => 'limpaInputs(this,\'E-mail\')', 'onblur' => 'voltaInputs(this,\'E-mail\')')); ?>
                </span>

                <span class="campo gg">      
					<?php echo $form->textField($model, 'cidade', array('value'=>'Cidade', 'class'=>'g', 'onfocus' => 'limpaInputs(this,\'Cidade\')', 'onblur' => 'voltaInputs(this,\'Cidade\')')); ?>
                </span>
                <div id="UpdatePanel1">	
                    <span class="clearfix" style="margin-left: 6px;">
                        <span class="campo select bgselect">
                            <span class="bgselectright" style="width: 45px;">
                                <span id="lblUf">UF</span>
                                <?php echo $form->dropDownList($model, 'uf', $states, array('value'=>'Cidade', 'class'=>'g')); ?>
                                
					        </span>
                        </span>
                    </span>							                        
				</div>
                <span>
                    <label style="color:#777777;">Já doou para a MSF?</label>
                    <br>

                    <table id="rbtDoou" cellspacing="2" cellpadding="2" border="0">
						<tbody>
							<tr>
								<td><span style="color: rgb(119, 119, 119);">
									<?php echo $form->radioButton($model, 'jahFezDoacoes', array('value'=>'1', 'id'=>'Newsletter_jahFezDoacoes01')); ?>
									<label for="rbtDoou_0">Sim</label></span>
								</td>
								<td>
									<span style="color: rgb(119, 119, 119);">
										<?php echo $form->radioButton($model, 'jahFezDoacoes', array('value'=>'0', 'id'=>'Newsletter_jahFezDoacoes02')); ?>
										<label for="rbtDoou_1">Não</label>
									</span>
								</td>
							</tr>
						</tbody>
					</table>
                </span>
                <?php
					echo CHtml::submitButton('', array('id'=>'btnGravarUsuario', 'class'=>'bot-enviar', 'src'=>'http://www.msf.org.br/imagens/botoes/bot-enviar-news.gif', 'name'=>"btnGravarUsuario", 'style'=>"border-width:0px;"));
				?>
                <!-- <input type="image" name="btnGravarUsuario" id="btnGravarUsuario" class="bot-enviar" src="http://www.msf.org.br/imagens/botoes/bot-enviar-news.gif" onclick="return validaNewsLetterHome();" style="border-width:0px;"> -->
                <?php $this -> endWidget(); ?>
            </div>
		</div>
	</div>
</div>
<script type="text/javascript">
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