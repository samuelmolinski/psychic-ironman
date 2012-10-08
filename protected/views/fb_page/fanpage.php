<?php 


	$me = Yii::app()->facebook->api('/me');
	$user = Yii::app()->facebook->api($userId);
	$friend0 = Yii::app()->facebook->api($id0);
	$friend1 = Yii::app()->facebook->api($id1);
	$friend2 = Yii::app()->facebook->api($id2);

	/*$url = 'https://graph.facebook.com/thakurbhai/picture';
	$location = get_headers($url, 1);
	if (array_key_exists('Location', $location))
	{
		d($location['Location']);
	}*/

	////$user['photo'] = $p->getRealUrl("https://graph.facebook.com/$userId/source");
	//$friend0['photo'] = $p->getRealUrl("https://graph.facebook.com/$id0/source");
	//$friend1['photo'] = $p->getRealUrl("https://graph.facebook.com/$id1/source");
	//$friend2['photo'] = $p->getRealUrl("https://graph.facebook.com/$id2/source");

	//d($friend0['photo']);
	//d($friend1['photo']);
	//d($friend2['photo']);

	$friends = Yii::app()->facebook->api("/$userId/friends");
	$user['friendCount'] = count($friends['data'])+1;
	$root = Yii::app()-> params['root'];
	d($user);

	if($me['id']==$userId['id']) {
		$visitor = false;
	} else {
		$visitor = true;
	}
?>

<div>
	<img id="poderDoSueCurtirLG" src="<?php echo Yii::app()->params['root']; ?>/images/logo-poderDoSeuCurtir.png"/>
	<hr class="por part"/><span class="abel">POR</span><hr class="por part"/>
	<span class="userName"><?php echo $user['name']; ?></span>
	<hr class="por"/>
	<div class="abel">
	<?php if($visitor) { ?>
	<p>Quando o Leonardo Brossa curte ou compartilha nossos<br />conteúdos, ele destaca a nossa atuação para seus </p>
	<?php } else { ?>
	<p>Quando você curte ou compartilha nossos<br />conteúdos, destaca a nossa atuação para seus </p>
	<?php } ?>
	<span class="friendCount"><?php echo $userId['friendCount'] ?> Amigos</span>
	<p>Mas o potencial real é muito maior, chegando a</p>
	</div>
	<div class="curtirRibbon"><span class="improvedfriendCount"><?php echo $userId['friendCount']*3 ?> Amigos</span></div>
	<p>Dessa forma, a crise no Sudão do Sul, por exemplo, pode fazer parte de debates com<br />pessoas com quem ele costuma interagir.</p>
	<div id="connections">
		<div id="friend0">
			<img src="<?php echo Yii::app()-> params['root']."/timthumb.php?h=125&w=125&zc=1&src=".$friend0['photo'] ?>" width="125" height="125"/>
			<span class="name"><?php echo $friend0['name'] ?></span>
		</div>
		<div id="friend1">
			<img src="<?php echo Yii::app()-> params['root']."/timthumb.php?h=125&w=125&zc=1&src=".$friend1['photo'] ?>"  width="125" height="125"/>
			<span class="name"><?php echo $friend1['name'] ?></span>
		</div>
		<div id="friend2">
			<img src="<?php echo Yii::app()-> params['root']."/timthumb.php?h=95&w=105&zc=1&src=".$friend2['photo'] ?>"  width="95" height="105"/>
			<span class="name"><?php echo $friend2['name'] ?></span>
		</div>
	</div>
</div>