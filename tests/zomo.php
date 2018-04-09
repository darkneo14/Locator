<?php
    
	
	require './../classes/ZomatoApi.php';
	
	error_reporting(0);
$conn = mysql_pconnect("localhost", "root", "");

if (!$conn) {
    echo "Unable to connect to DB: " . mysql_error();
    exit;
}

mysql_select_db("locator");

$latqry="select distinct latitude,longitude from checkin";
$ltqr=mysql_query($latqry);
while($qry=mysql_fetch_assoc($ltqr))
{


$zomatoJsonApi = new ZomatoApi('json');
//$jsondata= $zomatoJsonApi->getGeocodeRequest(28.6315, 77.2167);
$lat=(double)$qry['latitude'];
$lont=(double)$qry['longitude'];
$jsondata= $zomatoJsonApi->getGeocodeRequest($lat, $lont);

$data = json_decode($jsondata, true);
//$id = $data['empid'];
$title=$data['location']['title'];
//$name=$data['location']['city_name'];

$rid= $data['popularity']['nearby_res'];
$sid= $data['popularity']['subzone_id'];

$sql =  "SELECT * FROM res WHERE sid = '$sid' ";


$result1 = mysql_query($sql,$conn);

if ((!$result1)) {
    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
    //exit;
}
if (mysql_num_rows($result1) == 0)
{  

foreach ($rid AS $index => $value)
{
	
	
	$rid[$index] = (int)$value; 
	$aa=$rid[$index];
	//echo $aa;
$jsonResponse = $zomatoJsonApi->getRestaurantRequest($aa);
$da = json_decode($jsonResponse, true);
$rname=$da['name'];
$loc=$da['location']['address'];
$loc=str_replace('\'', '', $loc);
$urat=$da['user_rating']['aggregate_rating'];
$urat=(double)$urat;
//echo $loc;
$findme='\'';
$pos = strpos($rname, $findme);
if ($pos === false)
{    

$sql = "INSERT INTO res(title, sid, rid, rname, urat, loc) VALUES('$title', '$sid', '$aa', '$rname', '$urat', '$loc')";
    if(!mysql_query($sql,$conn))
    {
        //die('Error : ' . mysql_error());
    }


	$jsonRes = $zomatoJsonApi->getReviewsRequest($aa,0,20);
	$dat = json_decode($jsonRes, true);
	for($i=0;$i<20;$i++)
	{	
		$rev=$dat['user_reviews'][$i]['review']['review_text'];
		$rat=$dat['user_reviews'][$i]['review']['rating'];
		$findme='\'';
		$pos = strpos($rev, $findme);
if ($pos === false && $rat>0)
{    
$sql = "INSERT INTO review(rid, rat, rev) VALUES('$aa', '$rat', '$rev')";
    if(!mysql_query($sql,$conn))
    {
        //die('Error : ' . mysql_error());
    }
	}
	}
	//echo $rev;
	
}
	
}
}
}
     
	 
	 session_start();
$_SESSION['sid']   = $sid;
	header("Location:index.php");


?>