<?php
/**
 * ZomatoApi Class
 *
 * @author Valter Nepomuceno <valter.nep@gmail.com>
 * @since 15th November 2015
 * @version 1
 **/
 
class ZomatoApi {
    
    private $dataFormat;
    private $apikey = '9be10252e955cd33f9a9ec30c9eb1e57';
    private $baseUrl = 'https://developers.zomato.com/api/v2.1';
    
    function __construct($dataFormat) {
        $this->dataFormat = $dataFormat;
    }
    
    /**
     * Sends HTTP GET Request to the request URL using CURL
     * @param string $requestUrl Request URL to execute CURL
     * @param string $dataFormat Accepts 'XML' or 'JSON'
     * @return JSON response from querying request URL
     */
    private function getCurlRequest($requestUrl) {
        $header = array('Accept: application/' . $this->dataFormat,
                        'user_key: ' . $this->apikey);
        
        $curl = curl_init($requestUrl);
        curl_setopt($curl, CURLOPT_URL, $requestUrl);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        
        $response = curl_exec($curl);
        curl_close($curl);
        
        return $response;
    }
    
    
    /********************
     *      COMMON      *
     ********************/
    
    /**
     * GET /cities => Find the Zomato ID and other details for a city
     * @param string  $q            Query by city name
     * @param double  $lat          Latitude
     * @param double  $lon          Longitude
     * @param string  $city_ids     Comma separated city_id values
     * @param integer $count        Number of max results to display
     * @return JSON response from querying cities
     */
    public function getCitiesRequest($q, $lat, $lon, $city_ids, $count) {
        $requestUrl = $this->baseUrl . '/cities';
        if (!empty($q)) $requestUrl = $requestUrl . '?q=' . $q;
        if (!empty($lat)) $requestUrl = $requestUrl . '&lat=' . $lat;
        if (!empty($lon)) $requestUrl = $requestUrl . '&lon=' . $lon;
        if (!empty($city_ids)) $requestUrl = $requestUrl . '&city_ids=' . $city_ids;
        if (!empty($count)) $requestUrl = $requestUrl . '&count=' . $count;
        
        return $this->getCurlRequest($requestUrl);
    }
    
    /**
     * GET /collections => Returns Zomato Restaurant Collections in a City
     * @param integer $city_id  Id of the city for which collections are needed
     * @param double  $lat      Latitude of any point within a city
     * @param double  $lon      Longitude of any point within a city
     * @param integer $count    Max number of results needed
     * @return JSON response from querying collections
     */
    public function getCollectionsRequest($city_id, $lat, $lon, $count) {
        $requestUrl = $this->baseUrl . '/collections';
        if (!empty($city_id)) $requestUrl = $requestUrl . '?city_id=' . $city_id;
        if (!empty($lat)) $requestUrl = $requestUrl . '&lat=' . $lat;
        if (!empty($lon)) $requestUrl = $requestUrl . '&lon=' . $lon;
        if (!empty($count)) $requestUrl = $requestUrl . '&count=' . $count;
        
        return $this->getCurlRequest($requestUrl);
    }
    
    /**
     * GET /cuisines => Get a list of all cuisines of restaurants listed in a city
     * @param integer $city_id  Id of the city for which collections are needed
     * @param double  $lat      Latitude of any point within a city
     * @param double  $lon      Longitude of any point within a city
     * @return JSON response from querying cuisines
     */
    public function getCuisinesRequest($city_id, $lat, $lon) {
        $requestUrl = $this->baseUrl . '/cuisines';
        if (!empty($city_id)) $requestUrl = $requestUrl . '?city_id=' . $city_id;
        if (!empty($lat)) $requestUrl = $requestUrl . '&lat=' . $lat;
        if (!empty($lon)) $requestUrl = $requestUrl . '&lon=' . $lon;
        
        return $this->getCurlRequest($requestUrl);
    }
    
    /**
     * GET /establishments => Get a list of restaurant types in a city
     * @param integer $city_id  Id of the city for which collections are needed
     * @param double  $lat      Latitude of any point within a city
     * @param double  $lon      Longitude of any point within a city
     * @return JSON response from querying establishments
     */
    public function getEstablishmentsRequest($city_id, $lat, $lon) {
        $requestUrl = $this->baseUrl . '/establishments';
        if (!empty($city_id)) $requestUrl = $requestUrl . '?city_id=' . $city_id;
        if (!empty($lat)) $requestUrl = $requestUrl . '&lat=' . $lat;
        if (!empty($lon)) $requestUrl = $requestUrl . '&lon=' . $lon;
        
        return $this->getCurlRequest($requestUrl);
    }
    
    /**
     * GET /geocode => Get Foodie and Nightlife Index, list of popular cuisines
     *                 and nearby restaurants around the given coordinates
     * @param double  $lat      Latitude of any point within a city
     * @param double  $lon      Longitude of any point within a city
     * @return JSON response from querying geocode
     */
    public function getGeocodeRequest($lat, $lon) {
        $requestUrl = $this->baseUrl . '/geocode';
        if (!empty($lat)) $requestUrl = $requestUrl . '?lat=' . $lat;
        if (!empty($lon)) $requestUrl = $requestUrl . '&lon=' . $lon;
        
        return $this->getCurlRequest($requestUrl);
    }
    
    
    /********************
     *     LOCATION     *
     ********************/
    
    /**
     * GET /location_details => Get Foodie Index, Nightlife Index, Top Cuisines
     *                          and Best rated restaurants in a given location
     * @param integer $entity_id    Location id obtained from locations api
     * @param string  $entity_type  Location type obtained from locations api
     * @return JSON response from querying location details
     */
    public function getLocationDetailsRequest($entity_id, $entity_type) {
        $requestUrl = $this->baseUrl . '/location_details';
        if (!empty($entity_id)) $requestUrl = $requestUrl . '?entity_id=' . $entity_id;
        if (!empty($entity_type)) $requestUrl = $requestUrl . '&entity_type=' . $entity_type;
        
        return $this->getCurlRequest($requestUrl);
    }
    
    /**
     * GET /locations => Search for Zomato locations by keyword. Provide coordinates
     *                   to get better search results
     * @param string  $query  Suggestion for location name
     * @param double  $lat    Latitude
     * @param double  $lon    Longitude
     * @param integer $count  Max number of results to fetch
     * @return JSON response from querying locations
     */
    public function getLocationsRequest($query, $lat, $lon, $count) {
        $requestUrl = $this->baseUrl . '/locations';
        if (!empty($query)) $requestUrl = $requestUrl . '?query=' . $lat;
        if (!empty($lat)) $requestUrl = $requestUrl . '&lat=' . $lat;
        if (!empty($lon)) $requestUrl = $requestUrl . '&lon=' . $lon;
        if (!empty($count)) $requestUrl = $requestUrl . '&count=' . $count;
        
        return $this->getCurlRequest($requestUrl);
    }

    
    /********************
     *    RESTAURANT    *
     ********************/
    
    /**
     * GET /restaurant => Get detailed restaurant information using Zomato restaurant ID
     * @param integer $res_id Id of restaurant whose details are requested
     * @return JSON response from querying a restaurant
     */
    public function getRestaurantRequest($res_id) {
        $requestUrl = $this->baseUrl . '/restaurant';
        if (!empty($res_id)) $requestUrl = $requestUrl . '?res_id=' . $res_id;
        
        return $this->getCurlRequest($requestUrl);
    }
    
    /**
     * GET /reviews => Partner Access Get restaurant reviews using the Zomato restaurant ID
     * @param integer $res_id  Id of restaurant whose details are requested
     * @param integer $start   Fetch results after this offset
     * @param integer $count   Max number of results to retrieve ( <20 )
     * @return JSON response from querying reviews
     */
    public function getReviewsRequest($res_id, $start, $count) {
        $requestUrl = $this->baseUrl . '/reviews';
        if (!empty($res_id)) $requestUrl = $requestUrl . '?res_id=' . $res_id;
        if (!empty($start)) $requestUrl = $requestUrl . '&start=' . $start;
        if (!empty($count)) $requestUrl = $requestUrl . '&count=' . $count;
        
        return $this->getCurlRequest($requestUrl);
    }
    
    /**
     * GET /search => The location input can be specified using Zomato location ID or
     *                coordinates. Cuisine / Establishment / Collection IDs can be obtained
     *                from respective api calls.
     * @param integer $entity_id            Location id
     * @param string  $entity_type          Location type
     * @param string  $q                    Search keyword
     * @param integer $start                Fetch results after offset
     * @param integer $count                Max number of results to display
     * @param double  $lat                  Latitude
     * @param double  $lon                  Longitude
     * @param double  $radius               Radius around (lat,lon); to define search area
     * @param string  $cuisines             List of cuisine id's separated by comma
     * @param string  $establishment_type   Establishment id obtained from establishments call
     * @param string  $collection_id        Collection id obtained from collections call
     * @param string  $sort                 Sort restaurants by ...
     * @param string  $order                Used with 'sort' parameter to define ascending / descending
     * @ return JSON response from querying search engine
     */
    public function getSearch($entity_id, $entity_type, $q, $start, $count, $lat, $lon,
                              $radius, $cuisines, $establishment_type, $collection_id,
                              $sort, $order) {
        $requestUrl = $this->baseUrl . '/search';
        if (!empty($entity_id)) $requestUrl = $requestUrl . '?entity_id=' . $entity_id;
        if (!empty($entity_type)) $requestUrl = $requestUrl . '&entity_type=' . $entity_type;
        if (!empty($q)) $requestUrl = $requestUrl . '&q=' . $q;
        if (!empty($start)) $requestUrl = $requestUrl . '&start=' . $start;
        if (!empty($count)) $requestUrl = $requestUrl . '&count=' . $count;
        if (!empty($lat)) $requestUrl = $requestUrl . '&lat=' . $lat;
        if (!empty($lon)) $requestUrl = $requestUrl . '&lon=' . $lon;
        if (!empty($radius)) $requestUrl = $requestUrl . '&radius' . $radius;
        if (!empty($cuisines)) $requestUrl = $requestUrl . '&cuisines' . $cuisines;
        if (!empty($establishment_type)) $requestUrl = $requestUrl . '&establishment_type' . $establishment_type;
        if (!empty($collection_id)) $requestUrl = $requestUrl . '&collection_id' . $collection_id;
        if (!empty($sort)) $requestUrl = $requestUrl . '&sort' . $sort;
        if (!empty($order)) $requestUrl = $requestUrl . '&order' . $order;
        
        return $this->getCurlRequest($requestUrl);
    }
    
}

?>