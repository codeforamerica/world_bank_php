<?php
/** 
 *	The most bare bones API library example
 *	Use _request(url,method,data-optional,headers-optional) to access the API
 */
 
class worldBankApi extends APIBaseClass{

	public static $api_key = '';
	public static $api_url = 'http://api.worldbank.org/';
	
	public function __construct($url=NULL,$api_key=NULL)
	{
	// api key for now is optional, but will probably need to look into new_request to ensure the key
	// is handled properly
		parent::new_request(($url?$url:self::$api_url));
	}
	
}
