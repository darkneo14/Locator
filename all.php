<?php

session_start();
require_once __DIR__ . '/vendor/autoload.php';
use Neoxygen\NeoClient\ClientBuilder;

//Setting Mysql Database
$conn = mysql_pconnect("localhost", "root", "");
mysql_select_db("locator");

//Setting Neo4j Client
$connUrl = parse_url('http://master.sb02.stations.graphenedb.com:24789/db/data/');
$user = 'neo4j';
$pwd = 'preet';


 
$client = ClientBuilder::create()
  ->addConnection('default', 'http', 'localhost', 7474)
  ->setAutoFormatResponse(true)
  ->build();


//Setting Facebook api
$fb = new Facebook\Facebook([
  'app_id' => 'facebook_app_id',
  'app_secret' => 'facebook_app_secret',
  'default_graph_version' => 'v2.5',
]);
$helper = $fb->getCanvasHelper();

//Access Token Array
$act=array("EAAQT1n47SUABAN2ZCYkzdw2DDnv2jOBnV4qLjGEJmcZBYHTw9HcnSrptmuoiHK79uZB8ZAOc3RenwRebHTqRbWQgHC1tGZCiti0SoODUFoZBJuH5YMV7hEzZAJ4Vk8CUw4gTHXl7ChH2134WcAZBUsfMTRZBiHFF9capj51LETZC8vTWvnh2pkYDcV",
"EAAQT1n47SUABALSbRUtxCicnHJ9DUlGlmFhavlX8xnq1TcH2DiWyeyy1f6HBkgqR7Q7hJvfJq335Evp8qamuewUjScGAW4DczoTZBnlulXXZCuIyn4F0BZA70c1ThGevztSuRVdDxZAXmIiFqrFHc4BEO08tkPGFys0wsNhsZAWSf3NhBzegq",
"EAAQT1n47SUABAF8ZCGYjv3rrgzkZCEbJPCJVeWJXZB3xbeuGiHZC5Gg49lYqobui53p5REPy6oaPYJSd9B840aELuHprsv0rBJWrhbOBOBzF56KBfs31u0q16jHFlrFheqag7AqSIoG19DdNvxE5ZBCzmnTFafiEaVwwbYyre5e7BdLxR37i6",
"EAAQT1n47SUABANXaUUWLXRRvQXhJO2goXsMLX89J2u5VI8QlQtssE4uo9r7cWIty1LZBbkpyyM6dRVTU7w3tXjO9pqsZBYlbzD4yfIGrRnSotTSML0gxjz2NtgV7zHGzOyDBQuLUAeloDRq0RU1mIqRYZBJpuR1QmisJJuxIvwVTsgUrZBrZC",
"EAAQT1n47SUABABmKZC2Pjavxwnx6W5XFn4HvC2H9W5JhWHYkZCPMu7NjTDaGVYHQ0ATWOJBr5sZCk8fCNKCvlt14NZCR9puWGnTQ2CJ6i3UkiyZCZB2eh8lQXWZCYs8fe25IChZAtMxmvv2ezugvhN3U5ZA17nTvcmMLhnSEfqj1Ynid3kcXWm6aM",
"EAAQT1n47SUABAMwpZBcOQ7WVktN4OTLtn4sWH2ltZAYZBdZBBmpZBHjBJJftdZBwGzzMJZA30ZCYTvpikPnXJxG41VOiijbGlEZBgMBjSybDIBOPUAKjjubKg4b7z6AmK26Vj6NGpPEZCZC29c3NAhkiI1X0mnVZBFRYartZAvQHw5Xae5Uy9Q0YjqGsG",
"EAAQT1n47SUABAIVXHp6ZAeVbxGQGslZCbPW78a4zqh3uoPj91rk3jx7F6QFr0d7ZAVBy54urOHLwF4ZAfXugcw12FV5qZCx9ZAv3Nso0GYYM6A7ZBGeJ6y2YkbxyhPj9VNX8luy1bSce4TlrP7VSEel02q5PdnhtywLjZAc0ZCQB0wfQ9frljMG2J",
"EAAQT1n47SUABAHzdPbFmofSmloOheb1kGaDN4UrmVtRORgsqJT5VpJqKMz8ZByACET6ZCaLNuZA93cJDlvKoNP76lviBMmuXINEujrKlq2hF84BYRiram4SdcGBxQaVfTzDZAMzWG2cwnnDfzeeZBZB92x3DJtqZAlSRWbaqr7XhKR0IyXlg1tF",
"EAAQT1n47SUABAO0QmQNKlzj4WVzigJz7O2V5pP35lBgoltMK1e1DMoqRXKwvDLyN0LS4tiPLjWiK5NnsfZBYwzEJDE20A7XTvH2CNhXcvNJApJd51zqUstqQIZCQOa15sGYzN5CuhJjy1jZBQjKZBf7rUxDGJgoyFD4IEZBAZCYY7jOOZCmBm7t");
$permissions = ['user_posts'];
for($zi=0;$zi<5;$zi++)
{
$accessToken=$act[$zi];
$_SESSION['facebook_access_token']=$act[$zi];
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
		echo $uid."<br>";
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		// When Graph returns an error
		if ($e->getCode() == 190) {
			unset($_SESSION['facebook_access_token']);
			echo 'Graph returned an error: ' . $e->getMessage();
			$helper = $fb->getRedirectLoginHelper();
			$loginUrl = $helper->getLoginUrl('https://apps.facebook.com/APP_NAMESPACE/', $permissions);
			//echo "<script>window.top.location.href='".$loginUrl."'</script>";
			exit;
		}
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}
	//************************************
	// getting all posts published by user
	//***********************************
	try {
		$posts_request = $fb->get('/me/posts');
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
	$posts_response = $posts_request->getGraphEdge()->asArray();
	//print_r($posts_response);
	$n=count($posts_response);
	$id=array();
	for($i=0;$i<$n;$i++)
	{
		$id[]=$posts_response[$i]['id'];
	}
	//print_r($id);
	//echo $posts_response[0]['id'];
	try {
		//print_r($posts_response['place']['name']);
		$ck="Select * from checkin where uid='$uid'";
			$ckk=mysql_query($ck,$conn);
			if(mysql_num_rows($ckk)!=0)
				continue;
		$nm=array();
		$lt=array();
		$ln=array();
		$ct=array();
		//Fetching all Checkins
		for($i=0;$i<$n;$i++)
		{
			$a="/".$id[$i]."?fields=place,created_time";
			$posts_request = $fb->get($a);
			$total_posts = array();
			$posts_response = $posts_request->getGraphNode()->asArray();
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
				$ctt=$ct[$i-1];
			else
				$ctt=$posts_response['place']['location']['city'];
			echo "City=> ".$ctt."<br>";
			$ct[]=$ctt;
			
			//Inserting Data Into MySql
			
			$sql = "INSERT INTO checkin VALUES('$uid', '$nn', '$ltt', '$lln', '$ctt')";
			mysql_query($sql,$conn);
			
			}
		}
		$_SESSION['lat']=$lt;
		$_SESSION['long']=$ln;
		$_SESSION['name']=$nm;
		$_SESSION['city']=$ct;
		
		$name=$nm;
$lat=$lt;
$long=$ln;
$city=$ct;
//print_r($name);
for($i=0;$i<count($name);$i++)
{
	$city[$i] = str_replace(' ', '', $city[$i]);
	$city[$i] = str_replace(',', '', $city[$i]);
	$city[$i] = str_replace('-', '', $city[$i]);
	$name[$i] = str_replace(',', '', $name[$i]);
if ((strpos($name[$i], 'Delhi') !== false) && (strpos($name[$i], 'Domestic') !== false) && (strpos($name[$i], 'Airport') !== false))
$name[$i]='Delhi domestic airport- Terminal 1D';   

	
$query='match (city:'.$city[$i].' {name:"'.$name[$i].'",type:"1"}) return city';
$result = $client->sendCypherQuery($query)->getResult();
$user = $result->getSingleNode();
$k=1;

if($user==NULL)
{	
echo $city[$i]." ";
$query = 'CREATE (city:'.$city[$i].' {name:"'.$name[$i].'",lat:"'.$lat[$i].'",long:"'.$long[$i].'",count:"'.$k.'",type:"1"})';
$result = $client->sendCypherQuery($query)->getResult();
if($i!=0)
{$query1 = 'MATCH (city1:'.$city[$i-1].' {name:"'.$name[$i-1].'",lat:"'.$lat[$i-1].'",long:"'.$long[$i-1].'",type:"1"}), (city2:'.$city[$i].'{name:"'.$name[$i].'",lat:"'.$lat[$i].'",long:"'.$long[$i].'",type:"1"}) CREATE (city2)-[r:GoesTo]->(city1) return r';
$result = $client->sendCypherQuery($query1)->getResult();
}
}
else
{
$query = 'match (city:'.$city[$i].' {name:"'.$name[$i].'",type:"1"}) return city';
$result = $client->sendCypherQuery($query)->getResult();
$res=$result->getSingleNode();
$cou=$res->getProperty('count');
$count=((int)$cou)+1;
$query = 'match (city:'.$city[$i].' {name:"'.$name[$i].'",type:"1"}) set city.count='.$count.' return city.count';
$client->sendCypherQuery($query)->getResult();
}
}
$zk=1;
for($i=0;$i<count($name);$i++)
{
	$city[$i] = str_replace(' ', '', $city[$i]);
	$city[$i] = str_replace(',', '', $city[$i]);
	$city[$i] = str_replace('-', '', $city[$i]);
	$name[$i] = str_replace(',', '', $name[$i]);
	print_r($city[$i]);
$query = 'CREATE (city:'.$city[$i].' {name:"'.$name[$i].'",lat:"'.$lat[$i].'",long:"'.$long[$i].'",uid:"'.$uid.'",type:"0"})';
$result = $client->sendCypherQuery($query)->getResult();
if($i!=0)
{$query1 = 'MATCH (city1:'.$city[$i-1].' {name:"'.$name[$i-1].'",lat:"'.$lat[$i-1].'",long:"'.$long[$i-1].'",uid:"'.$uid.'",type:"0"}), (city2:'.$city[$i].'{name:"'.$name[$i].'",lat:"'.$lat[$i].'",long:"'.$long[$i].'",uid:"'.$uid.'",type:"0"}) CREATE (city2)-[r:TravelsTo]->(city1) return r';
$result = $client->sendCypherQuery($query1)->getResult();
}
}


		?>
		<form action="neo.php" method="post">
			<button type="submit">Neo4j</button>
		</form>
		<?php
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
	echo 'Graph returned an error: ' . $e->getMessage();
	$loginUrl = $helper->getLoginUrl('https://apps.facebook.com/APP_NAMESPACE/', $permissions);
	//echo "<script>window.top.location.href='".$loginUrl."'</script>";
}
}

?>