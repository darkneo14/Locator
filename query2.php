<?php
session_start();
require_once 'vendor/autoload.php';
use Neoxygen\NeoClient\ClientBuilder;

//$connUrl = parse_url('http://master.sb02.stations.graphenedb.com:24789/db/data/');
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
foreach ($name as $value) 
	{
		array_push($place,$value->getProperty('name'));
	}
	sort($place);
?>
<form action='query2.php?from=from,to=to'>
	FROM
	<select id='from' name='from'>
	<?php
	for($i=0;$i<count($place);$i++)
	{	
	?><option value="<?php echo $place[$i];?>"><?php echo $place[$i];?></option>
	<?php }?>
	</select>
	TO
	<select id='to' name='to'>
	<?php
	for($i=0;$i<count($place);$i++)
	{	
	?><option value="<?php echo $place[$i];?>"><?php echo $place[$i];?></option>
	<?php }?>
	</select>
	<input type=submit value='Display'></form><?php
if(isset($_GET['from']) && isset($_GET['to'])) 
{
	$from = $_GET['from'];
	$to=$_GET['to'];
}

if(!empty($from) && !empty($to))
{
	echo("<h5>Shortest Route</h5>");
	$query='MATCH (from{name:"'.$from.'",type:"0"}), (to{name:"'.$to.'",type:"0"}) , path = shortestPath((from)-[:TravelsTo*]->(to)) RETURN path';
	$result = $client->sendCypherQuery($query)->getResult()->getTableFormat();
	//$name=$result->getNodes();
	
	
	$place=array();
	$i=0;
	//print_r($result);
	//echo $result[0]['path'][0]['name'];
	foreach ($result as $value) 
	{
		//foreach ($value as $value1) 
	//{
		
		foreach ($value['path'] as $value2) 
		{
			if(isset($value2['name']))
				echo $value2['name'];
			/*foreach ($value2 as $value3) 
			{   
				$i=$i+1;
				if($i!=2)
				{
					//echo "</br>";
					
					echo ($value3);
				echo("<br/>");
				}
				
			}*/
			
			//print_r($value2);
			$i=0;
		echo("<br/>");
		}
		
	//}
	}
	
	
	
		echo("<h5>Most Travelled Route</h5>");
	
	$query='match (city{name:"'.$from.'",type:"0"}) with city as a match (city{name:"'.$to.'",type:"0"}) with city as b,a as a match p=(a)-[*]->(b) with reduce(c=0,n in nodes(p)|c+n.count) as d , p as p1 return d,nodes(p1) order by d desc ';
	$result = $client->sendCypherQuery($query)->getResult()->getTableFormat();
	$k=9;
	
	//print_r($result);
	
		foreach ($result as $value) 
	{
		//foreach ($value as $value1) 
	//{
		
		foreach ($value['nodes(p1)'] as $value2) 
		{
			if(isset($value2['name']))
				echo $value2['name'];
			/*foreach ($value2 as $value3) 
			{   
				$i=$i+1;
				if($i!=2)
				{
					//echo "</br>";
					
					echo ($value3);
				echo("<br/>");
				}
				
			}*/
			
			//print_r($value2);
			$i=0;
		echo("<br/>");
		}
		
	//}
	}
	echo("<h5>Longest Route</h5>");
	$query='match (city{name:"'.$from.'",type:"0"}) with city as a match (city{name:"'.$to.'",type:"0"}) with city as b,a as a match p=(a)-[*]->(b) with reduce(c=0,n in nodes(p)|c+1) as d , p as p1 return d,nodes(p1) order by d desc ';
	$result = $client->sendCypherQuery($query)->getResult()->getTableFormat();
	$k=9;
	
	//print_r($result);
		foreach ($result as $value) 
	{
		//foreach ($value as $value1) 
	//{
		if($k==0)
	{
		break;
	}
	$k=0;
		foreach ($value['nodes(p1)'] as $value2) 
		{
			$i=$i+1;
			if(isset($value2['name']))
			{
				
				if($i!=2)
				{
					echo $value2['name'];
					echo("<br/>");
				}
				
			}
			/*foreach ($value2 as $value3) 
			{   
				$i=$i+1;
				if($i!=2)
				{
					//echo "</br>";
					
					echo ($value3);
				echo("<br/>");
				}
				
			}*/
			
			//print_r($value2);
			$i=0;
		echo("<br/>");
		}
		
	//}
	}
	
	
/*	foreach ($result as $value) 
	{
	if($k==0)
	{
		break;
	}
	$k=0;
	 foreach ($value as $value1) 
	 {
		if (is_array($value1) || is_object($value1))
		{
		foreach ($value1 as $value2) 
		{
			
			foreach ($value2 as $value3) 
			{   
				
				$i=$i+1;
				if($i!=2)
				{
					echo ($value3);
				echo("<br/>");
				}
				
			}
			$i=0;
		echo("<br/>");
		}}
		
	 }
	}*/
	
}	
?>
