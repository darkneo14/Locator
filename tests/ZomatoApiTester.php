<?php
/**
 * ZomatoApi Tester
 *
 * @author Valter Nepomuceno <valter.nep@gmail.com>
 * @since 15th November 2015
 * @version 1
 **/

require './../classes/ZomatoApi.php';

$zomatoJsonApi = new ZomatoApi('json');
//$jsonResponse = $zomatoJsonApi->getGeocodeRequest(28.6315, 77.2167);
//$jsonResponse = $zomatoJsonApi->getReviewsRequest(310448,0,10);
$jsonResponse = $zomatoJsonApi->getRestaurantRequest(310143);

//$jsonRes = $zomatoJsonApi->getReviewsRequest(310143,0,10);
$dat = json_decode($jsonResponse, true);

$urat=$dat['user_rating']['aggregate_rating'];
$urat=(double)$urat;
echo $urat;
echo gettype($urat);
	$i=0;
	//$rev=$dat['user_reviews'][$i]['review']['rating'];
	
	//echo $rev;
	//echo gettype($rev);

//$zomatoXmlApi = new ZomatoApi('xml');
//	$xmlResponse = $zomatoXmlApi->getCitiesRequest('Lisbon', 0.0, 0.0, '', 0);

print($jsonResponse);
//print($xmlResponse);'

?>