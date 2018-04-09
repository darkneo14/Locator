<?php

session_start();

require_once __DIR__ . '/vendor/autoload.php';



?>

<?php
$fb = new Facebook\Facebook([
  'app_id' => 'facebook_app_id',
  'app_secret' => 'facebook_app_secret',
  'default_graph_version' => 'v2.5',
]);


$helper = $fb->getRedirectLoginHelper();


try {
  $accessToken = $helper->getAccessToken();
  $response = $fb->get('/me?fields=id,name', $accessToken );
  $userNode = $response->getGraphUser();
  echo 'Logged in as ' . $userNode->getName();


/*  $data = [
  'message' => 'A neat photo upload example. Neat.',
  'url' => 'https://example.com/photo.jpg',
];

$response1 = $fb->post('/me/photos', $data,$accessToken);
$graphNode = $response1->getGraphNode();

echo 'Photo ID: ' . $graphNode['id'];
 */
  //echo $accessToken;
  
  
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
  // Logged in!
  $_SESSION['facebook_access_token'] = (string) $accessToken;

	?>
    <a href="post-on-timeline.php">Post</a>
    <?php
  // Now you can redirect to another page and use the
  // access token from $_SESSION['facebook_access_token']
}


header("Location: checkin.php");

?>