<?php d($loginUrl); ?>
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
			<?php echo $fbConnectLink; ?>
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
				<li class="cur"><span class="icon-play"></span><img src="<?php echo Yii::app()-> params['root']; ?>/timthumb.php?h=95&w=175&zc=1&src=http://img.youtube.com/vi/g63uwgbAbZE/0.jpg" rel='g63uwgbAbZE' ></li>
				<li><span class="icon-play"></span><img src="<?php echo Yii::app()-> params['root']; ?>/timthumb.php?h=95&w=175&zc=1&src=http://img.youtube.com/vi/9bZkp7q19f0/0.jpg" rel='9bZkp7q19f0' ></li>
				<li><span class="icon-play"></span><img src="<?php echo Yii::app()-> params['root']; ?>/timthumb.php?h=95&w=175&zc=1&src=http://img.youtube.com/vi/ILg42J9DR9I/0.jpg" rel='ILg42J9DR9I' ></li>
				<li><span class="icon-play"></span><img src="<?php echo Yii::app()-> params['root']; ?>/timthumb.php?h=95&w=175&zc=1&src=http://img.youtube.com/vi/KjCL5-fSaSQ/0.jpg" rel='KjCL5-fSaSQ' ></li>
				<li><span class="icon-play"></span><img src="<?php echo Yii::app()-> params['root']; ?>/timthumb.php?h=95&w=175&zc=1&src=http://img.youtube.com/vi/5-xBGmwQY5Y/0.jpg" rel='5-xBGmwQY5Y' ></li>
			</ul>
		</div>
	</div>
</div>
<div id="callToAction" class="clearfix">
	<div class="espalhe"><a href="<?php echo CHtml::normalizeUrl(array('fb_page/espalhe')); ?>"><img src="<?php echo Yii::app()-> params['root']; ?>/images/logo-espalheANossaMensagem.png" alt=""></a></div>
	<div class="volunteer"><a href="#"><img src="<?php echo Yii::app()-> params['root']; ?>/images/logo-voluntarioVirtual.png" alt=""></a></div>
</div>
<script type="text/javascript" src="<?php echo Yii::app()-> params['root']; ?>/js/fb_pageIndex.js"></script>