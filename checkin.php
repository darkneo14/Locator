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
			
			$sql = "INSERT INTO checkin VALUES('$uid', '$nn', '$ltt', '$lln', '$ctt')";
			mysql_query($sql,$conn);
			//print_r($posts_response);
			}
			
			$tdt=clone $date2;
			
		}
		//$_SESSION['lat']=$lt;
		//$_SESSION['long']=$ln;
		//$_SESSION['name']=$nm;
		//$_SESSION['city']=$ct;
		
		
				$name=$nm;
$lat=$lt;
$long=$ln;
$city=$ct;
//print_r($name);
for($i=0;$i<count($name);$i++)
{
	if($name[$i]=="break")
		continue;
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
{$query1 = 'MATCH (city1:'.$city[$i-1].' {name:"'.$name[$i-1].'",lat:"'.$lat[$i-1].'",long:"'.$long[$i-1].'"}), (city2:'.$city[$i].'{name:"'.$name[$i].'",lat:"'.$lat[$i].'",long:"'.$long[$i].'"}) CREATE (city2)-[r:GoesTo]->(city1) return r';
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
$za=0;
for($i=0;$i<count($name);$i++)
{
	if($name[$i]=="break")
	{
		$uid++;
		$za=1;
	}
	$city[$i] = str_replace(' ', '', $city[$i]);
	$city[$i] = str_replace(',', '', $city[$i]);
	$city[$i] = str_replace('-', '', $city[$i]);
	$name[$i] = str_replace(',', '', $name[$i]);
	print_r($city[$i]);
$query = 'CREATE (city:'.$city[$i].' {name:"'.$name[$i].'",lat:"'.$lat[$i].'",long:"'.$long[$i].'",uid:"'.$uid.'",type:"0"})';
$result = $client->sendCypherQuery($query)->getResult();
if($i!=0 && $za==0)
{$query1 = 'MATCH (city1:'.$city[$i-1].' {name:"'.$name[$i-1].'",lat:"'.$lat[$i-1].'",long:"'.$long[$i-1].'",uid:"'.$uid.'",type:"0"}), (city2:'.$city[$i].'{name:"'.$name[$i].'",lat:"'.$lat[$i].'",long:"'.$long[$i].'",uid:"'.$uid.'",type:"0"}) CREATE (city2)-[r:TravelsTo]->(city1) return r';
$result = $client->sendCypherQuery($query1)->getResult();
}
$za=0;
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
	$loginUrl = $helper->getLoginUrl('https://apps.facebook.com/APP_NAMESPACE/', $permissions);
	echo "<script>window.top.location.href='".$loginUrl."'</script>";
}

//header("Location: index.php");