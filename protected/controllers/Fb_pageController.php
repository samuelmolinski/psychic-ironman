<?php

	class Fb_pageController extends Controller {
		public $fbURL = 'https://www.facebook.com/pages/SamplePage/220134694676331?sk=app_402784116453669';

		public function actionIndex() {
			$this -> render('index', array('auth' => $this -> authenticate()));
		}

		public function actionEspalhe() {
			$this -> render('espalhe');
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
