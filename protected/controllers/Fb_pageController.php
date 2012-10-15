<?php

	class Fb_pageController extends Controller {
		public $layout = 'fb';
		public $fbURL = 'https://www.facebook.com/MedicosSemFronteiras/app_402784116453669';
		public $fbAappData;
		//public $fbURL = 'https://www.facebook.com/pages/SamplePage/220134694676331?sk=app_402784116453669';

		public function actionIndex() {
			header('P3P: CP="IE is often a NIGHTMARE"');

			d($_COOKIE);
			d($_SESSION);
			d($_REQUEST);
			$redirect = $this -> pageRedirect();

			$auth = $this->authenticate();
			$model = new Newsletter;
			$model -> setScenario('Newsletter');
			$formStatus = 0;

			$appData = @$this->getAppData();
			// redirect to fanpage if it has the approprate appdata
			if($appData && $appData->userId && $appData->id0 && $appData->id1 && $appData->id2) {
				$url = Yii::app()->createUrl('fb_page/fanpage',array('app_data' => json_encode($appData)));
				$this->redirect($url);
			} else {
				//if(isset($_COOKIE['fb_402784116453669_state'])||isset($_COOKIE['fbsr_402784116453669'])) {	
				d($auth);
				if($auth || $appData->pageRedirect) {		
					$fbConnectLink = "<a href='".CHtml::normalizeUrl(array('fb_page/fanpage'))."' class='btn connectFacebook'></a>";
					$user = Yii::app()->facebook->getUser();
					$userinfo = Yii::app()->facebook->api($user);
				} else {
					/*$params = array(
					  'ok_session' => 'https://www.msf.org.br/poderdocurtir',
					  'no_user' => 'https://www.msf.org.br/poderdocurtir/no_user',
					  'no_session' => 'https://www.msf.org.br/poderdocurtir/no_session',
					);

					$next_url = Yii::app()->facebook->getLoginStatusUrl($params);*/
					//d($next_url);
					if($appData->pageRedirect){
						$fbConnectLink = "<a href='".CHtml::normalizeUrl(array('fb_page/fanpage'))."' class='btn connectFacebook'></a>";
					} else {						
						$loginUrl = $this->getFbLoginURL('fanpage');
						d($loginUrl);
					}
					$fbConnectLink = "<a href='#' onclick='setTimeout(function() {top.location.href = \"$loginUrl\"}, 500);' class='btn connectFacebook'></a>";
					//$fbConnectLink = "<a href='#' target='_top class='btn connectFacebook'></a>";
				}
				
				$this -> render('index', array('success'=>$formStatus, 'model'=>$model, 'fbConnectLink' => $fbConnectLink, 'loginUrl'=>$loginUrl, 'userName'=>$userinfo->first_name, 'shareLink'=>$shareLink));
			}
		}

		public function actionEspalhe() {
			header('P3P: CP="IE is often a NIGHTMARE"');
			$this -> render('espalhe');
		}		
		
		public function actionFanpage() {
			header('P3P: CP="IE is often a NIGHTMARE"');
			$model = new Newsletter;
			$model -> setScenario('Newsletter');
			$formStatus = 0;
			$auth = $this->authenticate();
			//$userinfo = Yii::app()->facebook->getInfo();

			if (isset($_POST['Newsletter'])) {

				$model->attributes=$_POST['Newsletter'];
				$r = $model -> save();
				//d($r);
				if ($r) {
					//d($model->id);
					//d($_POST['Frase']);
					//d($model->attributes);

					$formStatus = 1;
				} else {
					$formStatus = -1;
				}
			}

			$userId = Yii::app()->facebook->getUser();
			//d($user);
			$appData = @$this->getAppData();
			//if we have fb appdata lets us it to render the page
			if($appData && $appData->userId && $appData->id0 && $appData->id1 && $appData->id2){
				$arr = array('userId'=>$appData->userId, 'id0'=>$appData->id0, 'id1'=>$appData->id1, 'id2'=>$appData->id2);
				$shareLink = $this->generateFanpageLink($arr);
				
				if($auth) {		
					$fbConnectLink = "href='".CHtml::normalizeUrl(array('fb_page/fanpage'))."'";
					$visitor = false;
				} else {
					//$loginUrl = $this->getFbLoginURL('fanpage');
					//$fbConnectLink = "onclick='setTimeout(function() {top.location.href = \"$loginUrl\"}, 500);'";					
					$visitor = true;
				}
				$this -> render('fanpage', array('model'=>$model,
												 'userId'=>$appData->userId,
												'userp'=>$appData->userp, 
												'usern'=>$appData->usern, 
												 'id0'=>$appData->id0, 
												 'id0p'=>$appData->id0p, 
												 'id0un'=>$appData->id0un,
												 'id1'=>$appData->id1, 
												 'id1p'=>$appData->id1p, 
												 'id1un'=>$appData->id1un,
												 'id2'=>$appData->id2, 
												 'id2p'=>$appData->id2p, 
												 'id2un'=>$appData->id2un,
												 'friendCount'=>$appData->friendCount,
												 'shareLink'=> $appData->shareLink, 
												 //'fbConnectLink' => $appData->fbConnectLink,
												 'visitor'=>$visitor
												 ));
			} elseif($userId){
				//time to generate ids of 'friends'					
				$timeUntil = time() - (3600 * 24 * 90);
				$user_feed = Yii::app() -> facebook -> api("/me/feed?until=$timeUntil&metadata=1&limit=500");
				$user_friends = Yii::app() -> facebook -> api("/me/friends");
				//get only post with comments
				$commentFeed = array();
				$mostComments = array();
				$commenters = array();
				foreach ($user_feed['data'] as $k => $post) {
					if (($post['comments']['count'] != 0)&&($post['comments']['data'])) {
						foreach($post['comments']['data'] as $j=> $comment){
							if($userId!=$comment['from']['id']){
								if(!key_exists($comment['from']['id'], $mostComments)) {
									$mostComments[$comment['from']['id']] = 1;
								} else {
									$mostComments[$comment['from']['id']] = $mostComments[$comment['from']['id']]+1;
								}
							}
						}
					}
				}
				if (count($mostComments)>=4) {
					arsort($mostComments);						
				} else {
					$needed = 4-count($mostComments);
					$friendsNeed = array_rand($user_friends['data'], $needed);
					if(is_numeric($friendsNeed)) {
						$mostComments[$user_friends['data'][$friendsNeed]['id']] = 1;
					} else {
						foreach($friendsNeed as $index){
							$mostComments[$user_friends['data'][$index]['id']] = 1;
						}
					}
					arsort($mostComments);	
				}
				foreach($mostComments as $k =>$v){
					$commenters[] = $k;
				}

				$auth = $this->authenticate();
				$me = Yii::app()->facebook->api('/me');
				$user = Yii::app()->facebook->api($userId);
				$friend0 = Yii::app()->facebook->api($commenters[0]);
				$friend1 = Yii::app()->facebook->api($commenters[1]);
				$friend2 = Yii::app()->facebook->api($commenters[2]);
				$p = new sfFacebookPhoto;
				$userp = $p->getRealUrl("https://graph.facebook.com/$userId/picture?type=large");
				$friend0p = $p->getRealUrl("https://graph.facebook.com/{$commenters[0]}/picture?type=large");
				$friend1p = $p->getRealUrl("https://graph.facebook.com/{$commenters[1]}/picture?type=large");
				$friend2p = $p->getRealUrl("https://graph.facebook.com/{$commenters[2]}/picture?type=large");
				$friends = Yii::app()->facebook->api("/$userId/friends");
				$friendCount = count($friends['data'])+1;
				//d($user);
				$arr = array('userId'=>$userId,
							'userp'=>$userp, 
							'usern'=>$user['name'], 
							'id0'=>$commenters[0], 
							'id0p'=>$friend0p, 
							'id0un'=>$friend0['first_name'],
							'id1'=>$commenters[1], 
							'id1p'=>$friend1p, 
							'id1un'=>$friend1['first_name'],
							'id2'=>$commenters[2], 
							'id2p'=>$friend2p, 
							'id2un'=>$friend2['first_name'],
							'friendCount'=>$friendCount);
				$shareLink = $this->generateFanpageLink($arr);
				$this -> render('fanpage', array('model'=>$model, 
												'userId'=>$userId, 
												'userp'=>$userp, 
												'usern'=>$user['name'],
												'id0'=>$commenters[0], 
												'id0p'=>$friend0p, 
												'id0un'=>$friend0['first_name'],
												'id1'=>$commenters[1], 
												'id1p'=>$friend1p, 
												'id1un'=>$friend1['first_name'],
												'id2'=>$commenters[2], 
												'id2p'=>$friend2p, 
												'id2un'=>$friend2['first_name'],
												'friendCount'=>$friendCount, 
												'visitor'=>$visitor,
												'shareLink'=> $shareLink));
			
			} else {
				//$this -> render('fanpage');
				$this -> redirect('index');
			}
		}

		public function authenticate() {

			$user = Yii::app()->facebook->getUser();
			//d($user);
			//d(Yii::app()->facebook);
			if ($user) {
				try {
					$user_profile = @Yii::app() -> facebook -> api('/me');
					return $user_profile;
				} catch (FacebookApiException $e) {
					return $user = null;
				}
			}
			return $user;
		}

		public function getFbLoginURL($redirect = Null) {
			/*if(isset($_COOKIE['FbLoginURL'])||isset($_COOKIE['fb_402784116453669_state'])||isset($_COOKIE['fbsr_402784116453669'])){
				return $_COOKIE['FbLoginURL'];
			} else {
				//d('cookie set');
				$link = Yii::app()->facebook->getLoginUrl(array('canvas' => 1, 'fbconnect' => 0, 'scope' => 'email,user_about_me,publish_stream,read_stream'));
				$inTwoMonths = 60 * 60 * 24 * 60 + time(); 
				setcookie('FbLoginURL', $link, $inTwoMonths); 
			}
			//d($_SESSION);
			//d($_COOKIE);
			if ($redirect) {
				$ad = '/index.php/fb_page/' . $redirect;
				$url = Yii::app()-> params['root'];
				$redirect = $url . $ad;
				return Yii::app() -> facebook -> getLoginUrl(array('canvas' => 1, 'fbconnect' => 0, 'scope' => 'email,user_about_me,publish_stream,read_stream'));
				//return Yii::app() -> facebook -> getLoginUrl(array('canvas' => 1, 'fbconnect' => 0, 'scope' => 'email,user_about_me,publish_stream,read_stream', 'redirect_uri' => $redirect));
			} else {*/
				return Yii::app()->facebook->getLoginUrl(array('canvas' => 1, 'fbconnect' => 0, 'scope' => 'email,user_about_me,publish_stream,read_stream'));
			//}
		}

		private function pageRedirect(){
			$appData = $this->getAppData();			
			if (@$appData->pageRedirect) {
				switch($appData->pageRedirect) {
					case 'fanpage':
						$this->redirect(array('fanpage'));
						break;
					case 'espalhe':
						$this->redirect(array('espalhe'));
						break;
					default:
						break;
				}
			}
			return FALSE;
		}

		public function getAppData() {
			if(!$this->fbAappData){
				if(isset($_GET['app_data'])){
					$app_data = $_GET["app_data"];
				} else {					
					$signed_request = Yii::app()->facebook ->getSignedRequest();
					$app_data = $signed_request["app_data"];
				}
				$app_data = json_decode($app_data);
				//d($app_data);
				return $app_data;
			} else {
				return $this->fbAappData;
			}
		}

		public function genRedirect($pageName) {
			
			$app_data = (object) array('pageRedirect'=>$pageName);
			//add page redirect in appdata
			$app_data = urlencode(json_encode($app_data));
			//$app_data = json_encode($app_data);
			$app_data = 'app_data=' . $app_data;
			$url = Yii::app()->params['FB_url'];
			$p = strpos($url, '?');
			if (FALSE === $p) {
				$fbURL = $url . '?' . $app_data;
			} else {
				$fbURL = $url . '&' . $app_data;
			}
			return $fbURL;
		}

		public function generateFanpageLink($app_data, $noEncode = false) {
			//d($app_data);
			if(!$noEncode){
				$app_data = urlencode(json_encode($app_data));
				//$app_data = json_encode($app_data);
			}
			$app_data = 'app_data=' . $app_data;
			//d($app_data);
			//$root = Yii::app()->params['root'] . '/index.php/fb_page/fanpage';
			$root = $this->fbURL;
			$p = strpos($root, '?');
			if (FALSE === $p) {
				$fbURL = $root . '?' . $app_data;
			} else {
				$fbURL = $root . '&' . $app_data;
			}
			//d($fbURL);
			return $fbURL;
		}

		protected function afterRender($view, &$output) {
			parent::afterRender($view, $output);
			//Yii::app()->facebook->addJsCallback($js); // use this if you are registering
			// any $js code you want to run asyc
			Yii::app() -> facebook -> initJs($output);
			// this initializes the Facebook JS SDK on all pages
			Yii::app() -> facebook -> renderOGMetaTags();
			// this renders the OG tags
			return true;
		}

	}
