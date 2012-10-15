<?php 
	$states = array( 0=>'UF','AC'=>'AC','AL'=>'AL','AM'=>'AM','AP'=>'AP','BA'=>'BA','CE'=>'CE','DF'=>'DF','ES'=>'ES','GO'=>'GO','MA'=>'MA','MG'=>'MG','MS'=>'MS','MT'=>'MT','PA'=>'PA','PB'=>'PB','PI'=>'PI','PR'=>'PR','RJ'=>'RJ','RN'=>'RN','RO'=>'RO','RR'=>'RR','RS'=>'RS','SC'=>'SC','SE'=>'SE','SP'=>'SP','TO'=>'TO');
	$fbCount1 = get_facebook_count('https://www.facebook.com/MedicosSemFronteiras');
	$totalLikes = $fbCount1->like_count;
?>
<div id="logoVideo" class="clearfix">
	<div class="cutir">
		<img class="msf-logo" src="<?php echo Yii::app()-> params['root']; ?>/images/logo-mediocsSemFronteiras.png">
		<img class="msf-curtir" src="<?php echo Yii::app()-> params['root']; ?>/images/logo-poderDoSeuCurtir.png">
	</div>
	<div class="mainVideo">
		<iframe width="485" height="296" src="https://www.youtube.com/embed/TCx9DGI_dBQ" frameborder="0" allowfullscreen></iframe>
	</div>
</div>
<div id="network" class="clearfix">
	<div class="rede"><img class="" src="<?php echo Yii::app()-> params['root']; ?>/images/logo-msfRede.png"></div>
	<div class="underMainVideo">
		<div class="auth">
			<?php echo $fbConnectLink; ?>
		</div>
		<div class="curtirCount">
			<div class="count"><span class="totalLikesContainer">+&nbsp;<span class="totalLikes"><?php echo number_format($totalLikes, 0, '', '.'); ?></span></span></div>			
			<!-- <div class="btn curtir"><iframe src="//www.facebook.com/plugins/like.php?href=https://www.facebook.com/MedicosSemFronteiras&layout=standard&show_faces=true&width=80&action=like&colorscheme=light&height=32" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:80px; height:32px; padding0; opacity: 0;" allowTransparency="true"></iframe></div> -->
			<div class="fb-like" data-href="https://www.facebook.com/MedicosSemFronteiras" data-send="false" data-layout="button_count" data-width="200" data-show-faces="false"></div>
		</div>
	</div>
</div>
<div id="videos" class="clearfix">
	<div class="title"></div>
	<div class="presentedVideos">
		<div id="currentVideo"><iframe src="https://www.youtube.com/embed/jXaQAc6YcRw" frameborder="0"  width="365" height="200"></iframe></div>
		<div class="videoThumbnails clearfix">
			<ul>
				<li class="cur"><span class="icon-play"></span><img src="<?php echo Yii::app()-> params['root']; ?>/timthumb.php?h=95&w=175&zc=1&src=https://img.youtube.com/vi/jXaQAc6YcRw/0.jpg" rel='jXaQAc6YcRw' ></li>
				<li><span class="icon-play"></span><img src="<?php echo Yii::app()-> params['root']; ?>/timthumb.php?h=95&w=175&zc=1&src=https://img.youtube.com/vi/9-QKKTkfEjM/0.jpg" rel='9-QKKTkfEjM' ></li>
				<li><span class="icon-play"></span><img src="<?php echo Yii::app()-> params['root']; ?>/timthumb.php?h=95&w=175&zc=1&src=https://img.youtube.com/vi/-6nGltJssuQ/0.jpg" rel='-6nGltJssuQ' ></li>
				<li><span class="icon-play"></span><img src="<?php echo Yii::app()-> params['root']; ?>/timthumb.php?h=95&w=175&zc=1&src=https://img.youtube.com/vi/F57kVayRD9I/0.jpg" rel='F57kVayRD9I' ></li>
				<li><span class="icon-play"></span><img src="<?php echo Yii::app()-> params['root']; ?>/timthumb.php?h=95&w=175&zc=1&src=https://img.youtube.com/vi/Wp5RzsT530s/0.jpg" rel='Wp5RzsT530s' ></li>
			</ul>
		</div>
	</div>
</div>
<div id="callToAction" class="clearfix">
	<div class="espalhe"><a href="<?php echo CHtml::normalizeUrl(array('fb_page/espalhe')); ?>"><img src="<?php echo Yii::app()-> params['root']; ?>/images/logo-espalheANossaMensagem.png" alt=""></a></div>
	<div class="volunteer">
		<div class="innerwrapper_volunteer">
			<img src="<?php echo Yii::app()-> params['root']; ?>/images/logo-voluntarioVirtual.png" alt="" id="volunteerImg">		
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
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo Yii::app()-> params['root']; ?>/js/fb_pageIndex.js"></script>
<script>
	$("#volunteerImg").click(function(){$('.innerwrapper_volunteer').animate({'margin-top':'-230px'} ,500, function(){
		$("#lblUf").fadeIn();
	})});
</script>