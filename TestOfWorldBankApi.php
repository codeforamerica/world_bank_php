<?php
/* load simpletest library

   downloadable using

wget http://downloads.sourceforge.net/project/simpletest/simpletest/simpletest_1.1/simpletest_1.1alpha3.tar.gz;
tar -zxf simpletest_1.1alpha3.tar.gz;

*/
require_once('simpletest/autorun.php');
// load baseclass 
require_once('APIBaseClass.php');
// load your class here...
require_once('worldBankApi.php');
// the name of the api class is 'yourApi'
class TestOfApiClass extends UnitTestCase {
   public $api;
   // put your class name here
   public static $class_name = 'worldBankApi';
    function testApiConstructs(){
    	$this->api = new self::$class_name();
    	$this->check_class_params('_http _root api_url');
    	
    	$this->assertNotNull($this->api->call_topic());
// reference  http://data.worldbank.org/querybuilder 
		$this->assertNotNull($this->api->call_data('BEL','AG.CON.FERT.ZS'));
		
		$this->assertNotNull($this->api->call_source());
		
		$this->assertNotNull($this->api->call_indicator());
		
		$this->assertNotNull($this->api->country_calls_countries());
		
		$this->assertNotNull($this->api->country_calls_regions());
		
		$this->assertNotNull($this->api->country_calls_lendingtype());
		
		$this->assertNotNull($this->api->country_calls_incomelevel());
    	
    	
    	
    }

    function check_class_params($params=NULL,$mode=TRUE){
    	// look up parameters inside of class and see if they are set/ true
    	// also allow to only check for certain parameters by passing in an array with the names of those variables or a space seperated string
    	// parameters to look for in the object
    	$api_class_vars =  get_class_vars(get_class($this->api));
    	if($params != null && is_string($params)){    		
			$params = explode(' ',$params);
			foreach($params as $key_name)
				$api_vars [$key_name] = "$key_name";
			$api_vars = array_intersect_key($api_class_vars,$api_vars);
    	}
    	else
    		$api_vars = $api_class_vars;		
    	// anything that isnt intersected should return false
   
    	foreach($api_vars as $key=>$value){
    		if($mode == TRUE)
    			$this->assertTrue(array_key_exists($key,$api_class_vars));
    		elseif($mode == FALSE)
    			$this->assertFalse(array_key_exists($key,$api_class_vars));
    		}
    }
}
?>

