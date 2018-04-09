
<?php
session_start();

require_once 'vendor/autoload.php';
use Neoxygen\NeoClient\ClientBuilder;

$connUrl = parse_url('http://master.sb02.stations.graphenedb.com:24789/db/data/');
$user = 'neo4j';
$pwd = 'preet';


 
$client = ClientBuilder::create()
  ->addConnection('default', 'http', 'localhost', 7474)
  ->setAutoFormatResponse(true)
  ->build();
$name=$_SESSION['name'];
$lat=$_SESSION['lat'];
$long=$_SESSION['long'];
$city=$_SESSION['city'];
//print_r($name);
for($i=0;$i<count($name);$i++)
{
	$city[$i] = str_replace(' ', '', $city[$i]);
	$city[$i] = str_replace(',', '', $city[$i]);
	$name[$i] = str_replace(',', '', $name[$i]);
	print_r($city[$i]);
$query = 'CREATE (city:'.$city[$i].' {name:"'.$name[$i].'",lat:"'.$lat[$i].'",long:"'.$long[$i].'",uid:"'.$uid.'"})';
$result = $client->sendCypherQuery($query)->getResult();
if($i!=0)
{$query1 = 'MATCH (city1:'.$city[$i-1].' {name:"'.$name[$i-1].'",lat:"'.$lat[$i-1].'",long:"'.$long[$i-1].'",uid:"'.$uid.'"}), (city2:'.$city[$i].'{name:"'.$name[$i].'",lat:"'.$lat[$i].'",long:"'.$long[$i].'",uid:"'.$uid.'"}) CREATE (city2)-[r:TravelsTo]->(city1) return r';
$result = $client->sendCypherQuery($query1)->getResult();
}
}
$query = 'CREATE (user:User {name: {name} }) RETURN user';
$parameters = array('name' => 'Maxime');
//$client->sendCypherQuery($query, $parameters);
$query = 'MATCH (user1:User {name:{name1}}), (user2:User {name:{name2}}) CREATE (user1)-[:FOLLOWS]->(user2)';
$params = ['name1' => 'Kenneth', 'name2' => 'Maxime'];
//$client->sendCypherQuery($query, $params);

?>

<iframe src="http://localhost:7474/browser/" height="500px" width="500px"></iframe>
