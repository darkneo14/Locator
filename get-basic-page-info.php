<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => 'facebook_app_id',
  'app_secret' => 'facebook_app_secret',
  'default_graph_version' => 'v2.5',
]);
/*
$fb = new Facebook\Facebook([
  'app_id' => '910921265691732',
  'app_secret' => '327494abdd12d11d4236ea4b8e7fafd2',
  'default_graph_version' => 'v2.5',
]);*/

$helper = $fb->getRedirectLoginHelper();
$permissions = []; // optional
	
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
		// getting short-lived access token
		$_SESSION['facebook_access_token'] = (string) $accessToken;
	  	// OAuth 2.0 client handler
		$oAuth2Client = $fb->getOAuth2Client();
		// Exchanges a short-lived access token for a long-lived one
		$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
		$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
		// setting default access token to be used in script
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	}
	// redirect the user back to the same page if it has "code" GET variable
	if (isset($_GET['code'])) {
		header('Location: ./');
	}
	// getting basic info about user
	try {
		$profile_request = $fb->get('/me');
		$profile = $profile_request->getGraphNode()->asArray();
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		// When Graph returns an error
		echo 'Graph returned an error: ' . $e->getMessage();
		session_destroy();
		// redirecting user back to app login page
		header("Location: ./");
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}
	
	// get basic page info
	$page = $fb->get('/me?fields=name,first_name,last_name,birthday,website,location,gender,picture,email');
	//$fb->get('/me?fields=id,name,picture.width(500),cover');
	//$page = $page->getGraphNode()->asArray();
	$profile = $page->getGraphNode()->asArray();
	
	foreach ($profile['picture'] as $key => $value)
          echo " <html> <img src='$value'  ><br></html>";
        echo " Name : " .$profile['name'];
        echo " <html> <br> </html>" ;
	echo "Birthday : " . $profile['birthday']->format('d-m-Y');
        echo " <html> <br> </html>" ;
        echo "Gender : " . $profile['gender'];
        echo " <html> <br> </html>" ;
        echo " Email Address  : " .$profile['email'];
        echo " <html> <br> </html>" ;
	echo  "Location: " .$profile['location']['name'];
	
	
	//echo "<img src='{$page['cover']['source']}'>";
  	// Now you can redirect to another page and use the access token from $_SESSION['facebook_access_token']
} else {
	// replace your website URL same as added in the developers.facebook.com/apps e.g. if you used http instead of https and you used non-www version or www version of your website then you must add the same here
	$loginUrl = $helper->getLoginUrl('http://sohaibilyas.com/APP_DIR/', $permissions);
	echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
}