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
$permissions = ['email', 'user_likes','user_posts','user_tagged_places','user_location']; // optional
$loginUrl = $helper->getLoginUrl('http://locator.com/locator/login-callback.php', $permissions);

//echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
//header("Location: '$loginUrl'");

?>
<script>
location.href=<?php $loginUrl ; ?>
</script>