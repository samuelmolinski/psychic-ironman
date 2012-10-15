<?php


/**
 * 
 * Publica uma mensagem no mural de um usuário
 * 
 * @param object $facebookObj - referência para o objeto do facebook
 * @param object $user - referência para o objeto que representa o usuário logado
 * @param string $message - mensagem a ser publicada
 * @param string $link - link que irá na mensagem a ser publicada
 * @param string $picture - URL da imagem que será publicada no POST
 * @param string $name - nome de quem publicou
 * @param string $description - descrição de quem publicou
 * 
 *  @return true se publicou, false se não publicou
 */
function postWall ($facebookObj, $user, $message, $name, $description, $type = 'register') {
	
	$gender = strtolower(getUserGender($facebookObj, $user));
	
	// mensagem para quando responder o questionario
	if ( strtolower($type) == 'register' ) {
		if ( strtoupper($message) == 'GOSTOSO' ) {
			if ( $gender == 'male' ) {
				$picture = 'http://www.yogoberryapp.com.br/theapp/app/img/euSouGOSTOSO.jpg';
			} else {
				$picture 	= 'http://www.yogoberryapp.com.br/theapp/app/img/euSouGOSTOSA.jpg';
				$name   	= str_replace("GOSTOSO", "GOSTOSA", $name);
			}
		} else {
			$picture = 'http://www.yogoberryapp.com.br/theapp/app/img/euSou'.strtoupper($message).'.jpg';
		}

		$message = 'Faça você também e descubra se é Gostoso(a), Saudável ou Original. Você pode ganhar um Yogoberry para você e mais dois amigos.';
	}	
	
	// mensagem para quando formar trinca
	if ( strtolower($type) == 'triple' ) {
		$persons = explode(",", $name);
		$message    = $persons['0'] . " formou uma trinca com " . $persons['1'] . " e " . $persons['2'] . " e ganhou Yogoberry pra galera.";	
		$picture = 'http://www.yogoberryapp.com.br/theapp/app/img/potinhoYogo.jpg';
		$name = 'Faça o Quiz Yogoberry e descubra se você é Gostoso(a), Saudável ou Original.';
	}
	
	try {
		$publishStream = $facebookObj->api("/$user/feed", 'post', array(
				'message' => $message, 
				'link'    => 'http://www.facebook.com/YogoberryOficial?sk=app_164348600298757',
				'picture' => $picture,
				'name'    => $name,
				'description'=> $description
				)
		);
		
		return true;
                 
	} catch (FacebookApiException $e) {
		return false;
	}
}

/**
 * 
 * Atualiza o status do usuario (mais simples do que a funcao postWall)
 * 
 * @param object $facebookObj - referência para o objeto do facebook
 * @param object $user - referência para o objeto que representa o usuário logado
 * @param string $message - mensagem a ser publicada
 * 
 * @return true se atualizou, false se não atualizou
 */
function updateStatus ($facebookObj, $user, $message) {
	 $statusUpdate = $facebookObj->api("/$user/feed", 'post', array('message'=> $message));
	 
	 return $statusUpdate;
}

/**
 * Pega todos os amigos de um usuário
 * 
 * @param object $facebookObj - referência para o objeto do facebook
 * @param string $userId - ID do usuário que terá os amigos recuperados
 * 
 * @return array - lista de amigos 
 */
function getFriends ($facebookObj, $userId) {
	try {
		$friendsTmp = $facebookObj->api('/' . $userId . '/friends');
		$friends 	= $friendsTmp['data'];
		
		return $friends;
		
	} catch (FacebookApiException $e) {
		return false;
	}
}

/**
 * Busca as informacoes de um usuario
 * 
 * @param object $facebookObj - referência para o objeto do facebook
 * @param object $user - referência para o objeto que representa o usuário logado
 * 
 * @return array - informacoes do usuario 
 */
function getUserInfo ($facebookObj, $user) {
	return $facebookObj->api("/$user");
}

/**
 * Retorna o sexo de um usuario
 * 
 * @param object $facebookObj - referência para o objeto do facebook
 * @param object $user - referência para o objeto que representa o usuário logado
 * 
 * @return string - sexo 
 */
function getUserGender ($facebookObj, $user) {
	$userInfo 	= $facebookObj->api("/$user");
	$aux 		= isset($userInfo['gender']) && !empty($userInfo['gender']) ? $userInfo['gender'] : '';
	
	return $aux;
}

/**
 * Retorna a URL da imagem o profile do usuario
 * 
 * @param object $facebookObj - referência para o objeto do facebook
 * @param object $user - referência para o objeto que representa o usuário logado
 * 
 * @return string - URL da imagem 
 */
function getProfilePicture ($facebookObj, $user) {
	$picture = $facebookObj->api("/$user?fields=picture");
	
	return $picture['picture'];
}