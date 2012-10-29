<?php

	require_once "protected/extensions/yii-facebook-opengraph/php-sdk-3.1.1/facebook.php";
	require_once "m_super_dump.php";

	//Create facebook application instance.
	$facebookObj = new Facebook(array(
	  'appId'  => '402784116453669',
	  'secret' => 'b1d8c5d95c442f4176f2c90f54945d62',
	  'cookie' => true,
	));

	$user = $facebookObj->getUser();
	$userinfo = $facebookObj->api($user);

	$jsonResponse 				= array();
	$jsonResponse['status'] 	= false;
	$jsonResponse['message'] 	= 'json message';
	
	if (true) {

		$name = $_POST['name'];
		$shareLink = $_POST['shareLink'];
		
		// publica no mural das 3 pessoas que a trinca foi criada com sucesso

		//postWall($facebook, $user, '', $person3['0']['nm_facebook_usuario'].",".$person2['0']['nm_facebook_usuario'].",".$person1['0']['nm_facebook_usuario'], '', 'triple');
		//d($user);
		try {
			$publishStream = $facebookObj->api("/$user/feed", 'post', array(
					'message' => $name.' descobriu o Poder do Curtir dele(a). Descubra o seu.', //$message,
					'link'    => $shareLink, //'https://www.facebook.com/MedicosSemFronteiras/app_402784116453669',
					'picture' => 'http://www.msf.org.br/poderdocurtir/images/icons/Icone_app_111x74.png',
					//'name'    => $name, //$name,
					'description'=> "Descubra o Poder do Curtir e venha fazer a diferença junto com a gente.", //$description
					)
			);
			$ret = true;
	                 
		} catch (FacebookApiException $e) {
			$ret = false;
		}

		echo json_encode($publishStream);
		
	} else {
		echo json_encode($jsonResponse);
	}