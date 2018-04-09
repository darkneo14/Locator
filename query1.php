<?php
session_start();
require_once 'vendor/autoload.php';
use Neoxygen\NeoClient\ClientBuilder;

$connUrl = parse_url('http://master.sb02.stations.graphenedb.com:24789/db/data/');
$user = 'ne04j';
$pwd = 'preet'; 
$client = ClientBuilder::create()
  ->addConnection('default', 'http', 'localhost', 7474)
  ->setAutoFormatResponse(true)
  ->build();
$name=array();
$query='match (city)-[:GoesTo]->(city1) return city,city1';
$result = $client->sendCypherQuery($query)->getResult();
$name=$result->getNodes();
$place=array();
//print_r($name);
foreach ($name as $value) 
	{
		array_push($place,$value->getProperty('name'));
	}
	sort($place);

	?>
	<form action='query1.php?location=location'>
	<select id='location' name='location'><?php
	for($i=0;$i<count($place);$i++)
	{	
	?><option value="<?php echo $place[$i];?>"><?php echo $place[$i];?></option>
	<?php }?>
	</select>
	<input type=submit value='Display'><?php
if(isset($_GET['location']))
$location = $_GET['location'];
if(!empty($location))
{
	$query='match (city{name:"'.$location.'",type:"1"})-[r]->(city1) return city1';
	$result = $client->sendCypherQuery($query)->getResult();
	$name=$result->getNodes();
	echo('<br><h4>Next One</h4>');
	$max=0;
	$best="";
	//print_r($name);
	foreach ($name as $value) 
	{
			$location=$value->getProperty('name');
			echo $location;
			$count=$value->getProperty('count');
			if($count>$max)
			{
				$max=$count;
				$best=$value->getProperty('name');
			}
	}
	echo('<br><h4>Best One</h4><br>'.$best);
}

?>