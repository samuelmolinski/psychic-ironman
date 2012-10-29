<?php

	class Fb_pageController extends Controller {
		public $layout = 'fb';
		public $fbURL = 'https://www.facebook.com/MedicosSemFronteiras/app_402784116453669';
		public $fbAappData;
		public $fb_user_profile;
		public $fb_userId;
		public $fb_loginUrl;
		public $fb_authorized;

		public function actionIndex() {
			$this->authenticate();
			
			$model = new Newsletter;
			$model -> setScenario('Newsletter');
			$formStatus = 0;
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

			$redirect = $this -> pageRedirect();

			$appData = @$this->getAppData();
			// redirect to fanpage if it has the approprate appdata
			if($appData && $appData->userId && $appData->id0 && $appData->id1 && $appData->id2) {
				$url = Yii::app()->createUrl('fb_page/fanpage',array('app_data' => json_encode($appData)));
				$this->redirect($url);
			} else {
				//$this -> render('index', array('success'=>$formStatus, 'model'=>$model, 'fbConnectLink' => $fbConnectLink, 'loginUrl'=>$loginUrl, 'userName'=>$userinfo->first_name, 'shareLink'=>$shareLink));
				$this -> render('index', array('success'=>$formStatus, 'model'=>$model, 'fbConnectLink' => $this->fb_loginUrl, 'userName'=>$this->fb_user_profile->first_name, 'shareLink'=>$shareLink));

			}
		}

		public function actionEspalhe() {
			$this->authenticate();
			$this -> render('espalhe');
		}		
		
		public function actionFanpage() {
			$this->authenticate();
			
			$model = new Newsletter;
			$model -> setScenario('Newsletter');
			$formStatus = 0;
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

			$appData = @$this->getAppData();
			//if we have fb appdata lets us it to render the page
			if($appData && $appData->userId && $appData->id0 && $appData->id1 && $appData->id2){
				$arr = array('userId'=>$appData->userId, 'id0'=>$appData->id0, 'id1'=>$appData->id1, 'id2'=>$appData->id2);
				$shareLink = $this->generateFanpageLink($arr);
				
				if($this->fb_authorized==$appData->userId) {		
					$visitor = false;
				} else {					
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
			} elseif($this->fb_authorized){
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
							if($this->fb_userId!=$comment['from']['id']){
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

				$me = Yii::app()->facebook->api('/me');
				$user = Yii::app()->facebook->api($this->fb_userId);
				$friend0 = Yii::app()->facebook->api($commenters[0]);
				$friend1 = Yii::app()->facebook->api($commenters[1]);
				$friend2 = Yii::app()->facebook->api($commenters[2]);
				$p = new sfFacebookPhoto;
				$userp = $p->getRealUrl("https://graph.facebook.com/{$this->fb_userId}/picture?type=large");
				$friend0p = $p->getRealUrl("https://graph.facebook.com/{$commenters[0]}/picture?type=large");
				$friend1p = $p->getRealUrl("https://graph.facebook.com/{$commenters[1]}/picture?type=large");
				$friend2p = $p->getRealUrl("https://graph.facebook.com/{$commenters[2]}/picture?type=large");
				$friends = Yii::app()->facebook->api("/{$this->fb_userId}/friends");
				$friendCount = count($friends['data'])+1;
				//d($user);
				$arr = array('userId'=>$this->fb_userId,
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
												'userId'=>$this->fb_userId, 
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
			session_start();
			// if logging out
			if (isset($_GET['logout'])) {
			    session_unset();
			    session_destroy();
			    header('HTTP/1.1 302 Found');
			    header('Location: '.Yii::app()->params['home']);
			    exit;
			// else we have a valid application session			
			} else if (isset($_SESSION['fb_userId'])) { 
			    try{
			        // if we need to make an API call, the Facebook PHP-SDK stored our
			        // access_token in $_SESSION.
					header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');
					header('P3P: CP="IE is often a NIGHTMARE"');
			        $this->fb_user_profile = (object) Yii::app()->facebook->api("/{$_SESSION['fb_userId']}");
			        $this->fb_userId = $_SESSION['fb_userId'];
			        $token = 'fb_'.Yii::app()->facebook->appId.'_access_token';

			        if (isset($_SESSION[$token])) {
			        //if (isset($_REQUEST['state'])) {
			        	$this->fb_authorized = TRUE;
			        	$this->fb_loginUrl = "<a href='".CHtml::normalizeUrl(array('fb_page/fanpage'))."' class='btn connectFacebook' id='fb-login' ></a>";
			        } else {
			        	$this->fb_authorized = FALSE;
						$link = Yii::app()->facebook->getLoginUrl(array('canvas' => 1, 'fbconnect' => 0, 'scope' => 'email,user_about_me,publish_stream,read_stream'));
						$fbConnectLink = "<a href='#'  id='fb-login' onclick='setTimeout(function() {top.location.href = \"$link\"}, 500);' class='btn connectFacebook'></a>";
						$this->fb_loginUrl = $fbConnectLink;
			        }
			    	
			    } catch (FacebookApiException $e) {
			        // if our access_token is now invalid (i.e. user removed our app, or
			        // logged out of Facebook, etc.), we can recover here. this is the only
			        // way I know of to know if a token has been invalidated.
			        if ($e->getType() == 'OAuthException'){
			            session_unset();
			            session_destroy();
			            header('HTTP/1.1 302 Found');
			            header('Location: '.Yii::app()->params['home']);
			            exit;
			        }else{
			            throw $e;
			        }
			    }
			// else attempting to log in
			} else if (Yii::app()->facebook->getUser()) {			
			    $this->fb_userId = Yii::app()->facebook->getUser();
			    if ($this->fb_userId) {
			        // login successful
			        $_SESSION['fb_userId'] = $this->fb_userId;
			    }

			    header('HTTP/1.1 302 Found');
			    header('Location: '.Yii::app()->params['home']);
			    exit;
			// if user not logged in, or access token invalidated
			} else {
				//$link = Yii::app()->facebook->getLoginUrl(array('canvas' => 1, 'fbconnect' => 0, 'scope' => 'email,user_about_me,publish_stream,read_stream'));
				//$fbConnectLink = "<a href='#'  id='fb-login' onclick='setTimeout(function() {top.location.href = \"$link\"}, 500);' class='btn connectFacebook'></a>";
			    //$this->fb_loginUrl = $fbConnectLink;
			    $this->fb_loginUrl = "<a href='".CHtml::normalizeUrl(array('fb_page/fanpage'))."' class='btn connectFacebook' id='fb-login' ></a>";
			}

			//d($_SESSION);
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
