<?php
/** 
 *	worldBankApi
 *	Use _request(url,method,data-optional,headers-optional) to access the API
 */
 
class worldBankApi extends APIBaseClass{

	public static $api_url = 'http://api.worldbank.org/';
	
	public function __construct($url=NULL,$api_key=NULL)
	{
		parent::new_request(($url?$url:self::$api_url));
	} 
	
	public function country_calls_countries($language=NULL,$region=NULL,$incomelevel=NULL,$lendingtype=NULL,$format=NULL){
		if(func_num_args() > 0) {
			if($region != NULL) $data ['region'] = $region;
			if($incomelevel!= NULL) $data['incomelevel'] = $incomelevel;
			if($lendingtype!= NULL) $data['lendingtype'] = $lendingtype;
			$data['format'] = ($format != NULL?$format:'json');
			$result = $this->_request($api_url . ($language !=NULL? $language:NULL) . 'country/' , 'GET',$data);
		
		}else
			$result = $this->_request($api_url . 'country?per_page=10&format=json' );
	}
	public function country_calls_regions($language=NULL,$region=NULL,$items_per_page=10,$format=NULL){
		if(func_num_args() > 0) {
			if($region != NULL) $data ['region'] = $region;
			if($items_per_page!= NULL) $data['items_per_page'] = $items_per_page;
			$data['format'] = ($format != NULL?$format:'json');
			$result = $this->_request($api_url . ($language !=NULL? $language:NULL) . 'region/' , 'GET',$data);
					
		}else
			$result = $this->_request($api_url . 'region?per_page=10&format=json' );
		
	}
	
	public function country_calls_lendingtype($language=NULL,$lendingtype=NULL,$items_per_page=10,$format=NULL){
		if(func_num_args()>0) {
			if($incomelevel!= NULL) $data['incomelevel'] = $incomelevel;
			if($lendingtype!= NULL) $data['lendingtype'] = $lendingtype;
			$result = $this->_request($api_url . ($language !=NULL? $language:NULL) . 'lendingtype' , 'GET',$data);
		}else
			$result = $this->_request($api_url .'lendingtype?per_page=10&format=json','GET');
	
	}
	
	public function country_calls_incomelevel($language=NULL,$incomelevel=NULL,$items_per_page=10,$format=NULL){
		if(func_num_args()>0) {
			if($incomelevel!= NULL) $data['incomelevel'] = $incomelevel;
			if($lendingtype!= NULL) $data['lendingtype'] = $lendingtype;
			$result = $this->_request($api_url . ($language !=NULL? $language:NULL) . 'lendingtype' , 'GET',$data);
		}else
			$result = $this->_request($api_url . 'lendingtype?per_page=10&format=json', 'GET');
	}
}
