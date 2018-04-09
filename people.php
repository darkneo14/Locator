<?php
session_start();
ob_start();
require_once __DIR__ . '/vendor/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => 'facebook_app_id',
  'app_secret' => 'facebook_app_secret',
  'default_graph_version' => 'v2.5',
]);
$helper = $fb->getCanvasHelper();
$permissions = ['user_posts']; // optionnal
try {
	if (isset($_SESSION['facebook_access_token'])) {
	$accessToken = $_SESSION['facebook_access_token'];
	} else {
  		$accessToken = $helper->getAccessToken();
	}
} catch(Facebook\Exceptions\FacebookResponseException $e) {
 	// When Graph returns an error
 	echo 'Graph returned an error: ' . $e->getMessage();
  	exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
 	// When validation fails or other local issues
	echo 'Facebook SDK returned an error: ' . $e->getMessage();
  	exit;
 }
if (isset($accessToken)) {
	if (isset($_SESSION['facebook_access_token'])) {
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	} else {
		$_SESSION['facebook_access_token'] = (string) $accessToken;
	  	// OAuth 2.0 client handler
		$oAuth2Client = $fb->getOAuth2Client();
		// Exchanges a short-lived access token for a long-lived one
		$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
		$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	}
	// validating the access token
	try {
		$request = $fb->get('/me');
		$profile = $request->getGraphNode()->asArray();
		$uid=$profile['id'];
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		// When Graph returns an error
		if ($e->getCode() == 190) {
			unset($_SESSION['facebook_access_token']);
			$helper = $fb->getRedirectLoginHelper();
			$loginUrl = $helper->getLoginUrl('https://apps.facebook.com/APP_NAMESPACE/', $permissions);
			echo "<script>window.top.location.href='".$loginUrl."'</script>";
			exit;
		}
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}
	// getting all posts published by user
	try {
		$posts_request = $fb->get('/me?fields=posts.limit(200)');
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		// When Graph returns an error
		echo 'Graph returned an error: ' . $e->getMessage();
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}
	$total_posts = array();
	$posts_response = $posts_request->getGraphNode()->asArray();
	//print_r($posts_response);
	$n=count($posts_response['posts']);
	$id=array();
	echo $n;
	for($i=0;$i<$n;$i++)
	{
		$id[]=$posts_response['posts'][$i]['id'];
		echo $posts_response['posts'][$i]['id'];
	}
	//print_r($id);
	//echo $posts_response[0]['id'];
	try {
		//print_r($posts_response['place']['name']);
		$nm=array();
		$lt=array();
		$ln=array();
		$ct=array();
		$kk;
		for($i=$n-1;$i>0;$i--)
		{
			$a="/".$id[$i]."?fields=place,created_time";
			$posts_request = $fb->get($a);
			$total_posts = array();
			$posts_response = $posts_request->getGraphNode()->asArray();
			
			//For date
			$date2 =  new DateTime($posts_response['created_time']->format(DateTime::ISO8601));
			
			
			if($i!=($n-1))
			{
				$diff=date_diff($date2,$tdt);
				//echo "<br>".$diff->days."<br>";
				$dd=$diff->days+1;
				
				// If Days difference between two checkins is more than 5 days change
				if($dd>=6){
					$nm[]="break";
					$lt[]="break";
					$ln[]="break";
					$ct[]="break";
					
				}
				
				echo "<br>".$dd."<br>";
				
				//echo $dff."<br>";
				
			}
			
			
			//for place if place not dere discard
			if(isset($posts_response['place'])){
			echo "Name=> ".$posts_response['place']['name']."<br>";
			//$_SESSION['name']=array();
			$nm[]=$posts_response['place']['name'];
			$nn=$posts_response['place']['name'];
			echo "Latitude=> ".$posts_response['place']['location']['latitude']."<br>";
			$lt[]=$posts_response['place']['location']['latitude'];
			$ltt=$posts_response['place']['location']['latitude'];;
			echo "Longitude=> ".$posts_response['place']['location']['longitude']."<br>";
			$ln[]=$posts_response['place']['location']['longitude'];
			$lln=$posts_response['place']['location']['longitude'];;
			if(!isset($posts_response['place']['location']['city']))
				$ctt=$ct[$kk];
			else
			{
				$ctt=$posts_response['place']['location']['city'];
				$kk=count($ct);
			}
			echo "City=> ".$ctt."<br>";
			$ct[]=$ctt;
			
			//Inserting Data Into MySql
			
			
			//print_r($posts_response);
			}
			
			$tdt=clone $date2;
			
		}

		$fp=fopen("data".$uid.".txt","w");
		fwrite($fp,"uid".PHP_EOL);
		fwrite($fp,$uid.PHP_EOL);
		fwrite($fp,"Name".PHP_EOL);
		for($i=0;$i<count($ct);$i++){
			
			fwrite($fp,$nm[$i].PHP_EOL);
			
		}
		fwrite($fp,"Latitute".PHP_EOL);
		for($i=0;$i<count($ct);$i++){
			
			fwrite($fp,$lt[$i].PHP_EOL);
			
		}
		fwrite($fp,"Logitude".PHP_EOL);
		for($i=0;$i<count($ct);$i++){
			
			fwrite($fp,$ln[$i].PHP_EOL);
			
		}
		fwrite($fp,"City".PHP_EOL);
		for($i=0;$i<count($ct);$i++){
			
			fwrite($fp,$ct[$i].PHP_EOL);
			
		}
		
		fclose($fp);
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		// When Graph returns an error
		echo 'Graph returned an error: ' . $e->getMessage();
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}
	$total_posts = array();
	//$posts_response = $posts_request->getGraphNode();
	$posts_response = $posts_request->getGraphNode()->asArray();
	
  	// Now you can redirect to another page and use the access token from $_SESSION['facebook_access_token']
} else {
	$helper = $fb->getRedirectLoginHelper();
	$loginUrl = $helper->getLoginUrl('https://apps.facebook.com/APP_NAMESPACE/', $permissions);
	//echo "<script>window.top.location.href='".$loginUrl."'</script>";
}

header("Location: thanku.html");