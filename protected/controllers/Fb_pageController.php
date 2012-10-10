<?php

	class Fb_pageController extends Controller {
		public $layout = 'fb';
		public $fbURL = 'https://www.facebook.com/MedicosSemFronteiras/app_402784116453669';
		public $fbAappData;
		//public $fbURL = 'https://www.facebook.com/pages/SamplePage/220134694676331?sk=app_402784116453669';

		public function actionIndex() {
			$redirect = $this -> pageRedirect();
			$user = Yii::app()->facebook->getUser();
			$model = new Newsletter;
			$model -> setScenario('Newsletter');
			$formStatus = 0;

			if(!$redirect) {
				$appData = @$this->getAppData();
				//redirect for our static pages	
				if (!$auth = Yii::app()->facebook->getUser())
					$auth = $this -> authenticate();
				//if authorized go to the fanpage else require authorization
				if(@$auth) {				
					$fbConnectLink = "<a href='".CHtml::normalizeUrl(array('fb_page/fanpage'))."' class='btn connectFacebook'></a>";
				} else {
					$loginUrl = $this->getFbLoginURL('fanpage');
					d($loginUrl);
					$fbConnectLink = "<a href='#' onclick='setTimeout(function() {top.location.href = \"$loginUrl\"}, 500);' class='btn connectFacebook'></a>";
					//$fbConnectLink = "<a href='#' target='_top class='btn connectFacebook'></a>";
				}
				// redirect to fanpage if has the approprate appdata
				if($appData && $appData->userId && $appData->id0 && $appData->id1 && $appData->id2) {
					//$this -> render('fanpage', $appData);
					$url = Yii::app()->createUrl('fb_page/fanpage',array('app_data' => json_encode($app_data)));
					$this->redirect($url);
					//$this -> redirect('fanpage');
				} else {
					$this -> render('index', array('success'=>$formStatus, 'model'=>$model, 'fbConnectLink' => $fbConnectLink));
				}
			}
		}

		public function actionEspalhe() {
			$this -> render('espalhe');
		}		
		
		public function actionFanpage() {

			$model = new Newsletter;
			$model -> setScenario('Newsletter');
			$formStatus = 0;
			//$auth = $this->authenticate();
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

			$user = Yii::app()->facebook->getUser();
			//d($user);
			$appData = @$this->getAppData();
			//d($appData);		
			//if we have fb appdata lets us it to render the page			
			if($appData && $appData->userID && $appData->id0 && $appData->id1 && $appData->id2 && $appData->id3){
				$this -> render('fanpage', array('model'=>$model, 'userId'=>$appData->userID, 'id0'=>$appData->id0, 'id1'=>$appData->id1, 'id2'=>$appData->id2));
			}
			if($user){
				//time to generate ids of 'friends'					
				$timeUntil = time() - (3600 * 24 * 90);
				$user_feed = Yii::app() -> facebook -> api("/me/feed?until=$timeUntil&metadata=1&limit=500");
				$user_friends = Yii::app() -> facebook -> api("/me/friends");
				//get only post with comments
				$commentFeed = array();
				$mostComments = array();
				$commenters = array();
				foreach ($user_feed['data'] as $k => $post) {
					//d($post['comments']['count']);
					if (($post['comments']['count'] != 0)&&($post['comments']['data'])) {
					//d($post);
						foreach($post['comments']['data'] as $j=> $comment){
							if($user!=$comment['from']['id']){
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
					//$needed = 1;
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
				//d($mostComments);
				$arr = array('userId'=>$user, 'id0'=>$commenters[0], 'id1'=>$commenters[1], 'id2'=>$commenters[2]);
				//d($arr);
				$shareLink = $this->generateFanpageLink($arr);
				//d($shareLink);
				$this -> render('fanpage', array('model'=>$model, 'userId'=>$user, 'id0'=>$commenters[0], 'id1'=>$commenters[1], 'id2'=>$commenters[2], 'shareLink'=> $shareLink));
			
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
			if ($redirect) {
				$ad = '/fb_page/' . $redirect;
				$url = Yii::app()-> params['root'];
				$redirect = $url . $ad;
				return Yii::app() -> facebook -> getLoginUrl(array('canvas' => 1, 'fbconnect' => 0, 'scope' => 'email,user_about_me,publish_stream,read_stream', 'redirect_uri' => $redirect));
			} else {
				return Yii::app() -> facebook -> getLoginUrl(array('canvas' => 1, 'fbconnect' => 0, 'scope' => 'email,user_about_me,publish_stream,read_stream'));
			}
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
				$signed_request = Yii::app() -> facebook -> getSignedRequest();
				$app_data = $signed_request["app_data"];
				$app_data = json_decode($app_data);
				return $app_data;
			} else {
				return $this->fbAappData;
			}
		}

		public function genRedirect($pageName) {
			
			$app_data = (object) array('pageRedirect'=>$pageName);
			//add page redirect in appdata
			$app_data = urlencode(json_encode($app_data));
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

		public function generateFanpageLink($app_data) {
			$app_data = urlencode(json_encode($app_data));
			$app_data = 'app_data=' . $app_data;
			$p = strpos($this->fbURL, '?');
			if (FALSE === $p) {
				$fbURL = $this->fbURL . '?' . $app_data;
			} else {
				$fbURL = $this->fbURL . '&' . $app_data;
			}
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
