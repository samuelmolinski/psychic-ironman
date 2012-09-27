<?php

	class Fb_pageController extends Controller {
		public $fbURL = 'https://www.facebook.com/pages/SamplePage/220134694676331?sk=app_402784116453669';
		
		public function actionIndex() {
			//SBaseFacebook::$CURL_OPTS[CURLOPT_CAINFO] =
			// getcwd().'/assets/fb_ca_chain_bundle.crt';
			//d(getcwd());
			$this -> render('index', array('auth'=>$this->authenticate()));
		}

		// -----------------------------------------------------------
		// Uncomment the following methods and override them if needed
		/*
		 public function filters()
		 {
		 // return the filter configuration for this controller, e.g.:
		 return array(
		 'inlineFilterName',
		 array(
		 'class'=>'path.to.FilterClass',
		 'propertyName'=>'propertyValue',
		 ),
		 );
		 }

		 public function actions()
		 {
		 // return external action classes, e.g.:
		 return array(
		 'action1'=>'path.to.ActionClass',
		 'action2'=>array(
		 'class'=>'path.to.AnotherActionClass',
		 'propertyName'=>'propertyValue',
		 ),
		 );
		 }*/

		public function authenticate() {

			$user = Yii::app() -> facebook -> getUser();
			//d($user);
			//d(Yii::app()->facebook);
			if ($user) {
				try {
					$user_profile = @Yii::app() -> facebook -> api('/me');
					// Here : API call succeeded, you have a valid access token
					//d($user_profile);
					return $user_profile;
				} catch (FacebookApiException $e) {
					// Here : API call failed, you don't have a valid access token
					// you have to send him to $facebook->getLoginUrl()
					return $user = null;
				}
			}
			return $user;
		}

		public function getFbLoginURL() {
			return Yii::app() -> facebook -> getLoginUrl(array('canvas' => 1, 'fbconnect' => 0, 'scope' => 'email,user_about_me,publish_stream,read_stream', 'redirect_uri' => $this->fbURL));
						
		}
		
		public function getAppData() {
			$signed_request = Yii::app() -> facebook -> getSignedRequest();
			d($signed_request);
			$app_data = $signed_request["app_data"];
			//inspect($signed_request);
			$app_data = json_decode($app_data);
			return $app_data;
		}

		/*
		 public function authenticate() {
		 $fbURL =
		 'https://www.facebook.com/pages/SamplePage/220134694676331?sk=app_402784116453669';
		 $facebook_id = Yii::app() -> facebook -> getUser();
		 $user_info = Yii::app() -> facebook -> api('/me');
		 if ($user_info) {
		 $user = User::model() -> find('facebook_id=?', array($facebook_id));
		 if ($user === null)
		 return $this -> errorCode == self::ERROR_UNKNOWN_IDENTITY;
		 else {
		 $this -> _id = $user -> id;
		 $this -> _username = $user -> username;
		 $this -> _name = $user -> username;
		 $this -> errorCode = self::ERROR_NONE;
		 $this -> setState('fullName', $user_info['first_name'] . " " .
		 $user_info['last_name']);
		 $this -> setState('avatar', Yii::app() -> facebook ->
		 getProfilePicture('large'));
		 $this -> setState('avatarThumb', Yii::app() -> facebook ->
		 getProfilePicture('square'));
		 }
		 } else
		 return $this -> errorCode == self::ERROR_UNKNOWN_IDENTITY;
		 return $this -> errorCode == self::ERROR_NONE;
		 }*/

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
