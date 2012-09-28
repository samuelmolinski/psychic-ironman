<?php

	class Fb_pageController extends Controller {
		public $layout = 'fb';
		public $fbURL = 'https://www.facebook.com/pages/SamplePage/220134694676331?sk=app_402784116453669';

		public function actionIndex() {
			$appData = @$this->getAppData();
			d($appData);	
			//redirect for our static pages				
			if($appData) {
				$this -> render('fanpage', $appData);
			} else {
				$this -> render('index', array('auth' => $this -> authenticate()));
			}
			
		}

		public function actionEspalhe() {
			$this -> render('espalhe');
		}		
		
		public function actionFanpage() {
			$auth = $this->authenticate();
			$appData = @$this->getAppData();
			if($appData && $appData->userID && $appData->id0 && $appData->id1 && $appData->id2){
				d($appData);					
				$this -> render('fanpage', array('userId'=>$appData->userID, 'id0'=>$appData->id0, 'id1'=>$appData->id1, 'id2'=>$appData->id2, 'shareLink'=> $shareLink));
			}
			if($auth){
				//if we have fb appdata lets us it to render the page
				//time to generate ids of 'friends'					
				$timeUntil = time() - (3600 * 24 * 90);
				$user_feed = Yii::app() -> facebook -> api("/me/feed?until=$timeUntil&metadata=1&limit=500");
				$user_friends = Yii::app() -> facebook -> api("/me/friends");
				//get only post with comments
				$commentFeed = array();
				$mostComments = array();
				$commenters = array();
				foreach ($user_feed['data'] as $k => $post) {
					//d($post);
					//d($post['comments']['count']);
					if ($post['comments']['count'] != 0) {
						array_push($commentFeed, $post);
					}
				}
				//d($auth['id']);
				foreach($commentFeed as $k=>$comments){
					if($comments['comments']['data']){
						foreach($comments['comments']['data'] as $j=>$comment){
							if($auth['id']!=$comment['from']['id']){
								if(!key_exists($comment['from']['id'], $mostComments)) {
									$mostComments[$comment['from']['id']] = 1;
								} else {
									$mostComments[$comment['from']['id']] = $mostComments[$comment['from']['id']]+1;
								}
							}
						}
					}
				}
				//d($mostComments);
				if (count($mostComments)>=4) {
					asort($mostComments);						
				} else {
					asort($mostComments);	
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
					//d($friendsNeed);
					//d($mostComments);
				}
				foreach($mostComments as $k =>$v){
					$commenters[] = $k;
				}
				d($mostComments);
				$arr = array('userId'=>$auth['id'], 'id0'=>$commenters[0], 'id1'=>$commenters[1], 'id2'=>$commenters[2], 'id3'=>$commenters[3]);
				d($arr);
				$shareLink = $this->generateFanpageLink($arr);
				d($shareLink);
				$this -> render('fanpage', array('userId'=>$appData->userID, 'commenters'=>$commenters, 'shareLink'=> $shareLink));
			
			} else {
				$this -> redirect('index');
			}
		}

		public function authenticate() {

			$user = Yii::app() -> facebook -> getUser();
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

		public function getFbLoginURL() {
			return Yii::app() -> facebook -> getLoginUrl(array('canvas' => 1, 'fbconnect' => 0, 'scope' => 'email,user_about_me,publish_stream,read_stream', 'redirect_uri' => $this -> fbURL));

		}

		public function getAppData() {
			$signed_request = Yii::app() -> facebook -> getSignedRequest();
			$app_data = $signed_request["app_data"];
			$app_data = json_decode($app_data);
			return $app_data;
		}

		public function generateFanpageLink($app_data) {
			$app_data = urlencode(json_encode($app_data));
			$app_data = 'app_data=' . $app_data;
			$p = strpos($this -> fbURL, '?');
			if (NULL != $app_data) {
				if (FALSE === $p) {
					$fbURL = $this -> fbURL . '?' . $app_data;
				} else {
					$fbURL = $this -> fbURL . '&' . $app_data;
				}
				return $fbURL;
			} else {
				return NULL;
			}
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
