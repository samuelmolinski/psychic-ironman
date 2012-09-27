<?php
	$this -> breadcrumbs = array('Fb Page', );

	Yii::app() -> facebook -> ogTags['title'] = "My Page Title";
?>
<h1><?php echo $this -> id . '/' . $this -> action -> id; ?></h1>

<p>You may change the content of this page by modifying the file <tt><?php echo __FILE__; ?></tt>.</p>

<?php ?>

<?php

	$loginUrl = $this->getFbLoginUrl();
	//d($loginUrl);			
	//d($auth);
	if ($auth) {
		//time limit for 90 days
		$timeUntil = time() - (3600 * 24 * 90);
		$user_feed = Yii::app() -> facebook -> api("/me/feed?until=$timeUntil&metadata=1&limit=500");
		$user_friends = Yii::app() -> facebook -> api("/me/friends");
		//get only post with comments
		$commentFeed = array();
		$mostComments = array();
		foreach ($user_feed['data'] as $k => $post) {
			//d($post);
			//d($post['comments']['count']);
			if ($post['comments']['count'] != 0) {
				array_push($commentFeed, $post);
			}
		}
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
		$appData = $this->getAppData();
		d($appData);
		d($mostComments);
		//d($user_feed);
		d($user_friends);

		$test = $auth;
	}//d($test);
?><br />
<a id='userAuth' href='#' onclick='setTimeout(function() {top.location.href = "<?php echo $loginUrl; ?>"}, 500);'>Authorize app</a>