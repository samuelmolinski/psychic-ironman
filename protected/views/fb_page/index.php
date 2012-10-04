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
			<a href='#' onclick='setTimeout(function() {top.location.href = ""}, 500);' class="btn connectFacebook"></a>
		</div>
		<div class="curtirCount">
			<div class="count"><span class="totalLikesContainer">+&nbsp;<span class="totalLikes">134,302</span></span></div>			
			<div class="btn curtir"></div>
		</div>
	</div>
</div>
<div id="videos" class="clearfix">
	<div class="title"></div>
	<div class="presentedVideos">
		<div id="currentVideo"><iframe src="http://www.youtube.com/embed/g63uwgbAbZE" frameborder="0"  width="365" height="200"></iframe></div>
		<div class="videoThumbnails clearfix">
			<ul>
				<li><span class="icon-play"></span><img src="<?php echo Yii::app()-> params['root']; ?>/timthumb.php?h=95&w=175&zc=1&src=http://img.youtube.com/vi/t4H_Zoh7G5A/0.jpg" rel='t4H_Zoh7G5A' ></li>
				<li><span class="icon-play"></span><img src="<?php echo Yii::app()-> params['root']; ?>/timthumb.php?h=95&w=175&zc=1&src=http://img.youtube.com/vi/t4H_Zoh7G5A/0.jpg" rel='t4H_Zoh7G5A' ></li>
				<li><span class="icon-play"></span><img src="<?php echo Yii::app()-> params['root']; ?>/timthumb.php?h=95&w=175&zc=1&src=http://img.youtube.com/vi/t4H_Zoh7G5A/0.jpg" rel='t4H_Zoh7G5A' ></li>
				<li><span class="icon-play"></span><img src="<?php echo Yii::app()-> params['root']; ?>/timthumb.php?h=95&w=175&zc=1&src=http://img.youtube.com/vi/g63uwgbAbZE/0.jpg" rel='g63uwgbAbZE' ></li>
				<!-- <li><span class="icon-play"></span><img src="<?php echo Yii::app()-> params['root']; ?>/timthumb.php?h=95&w=175&zc=1&src=http://img.youtube.com/vi/g63uwgbAbZE/0.jpg" rel='g63uwgbAbZE' ></li> -->
			</ul>
		</div>
	</div>
</div>
<div id="callToAction" class="clearfix">
	<div class="espalhe"><a href="<?php echo CHtml::link('Espalhe',array('fb_page/espalhe')); ?>"><img src="<?php echo Yii::app()-> params['root']; ?>/images/logo-espalheANossaMensagem.png" alt=""></a></div>
	<div class="volunteer"><a href="#"><img src="<?php echo Yii::app()-> params['root']; ?>/images/logo-voluntarioVirtual.png" alt=""></a></div>
</div>