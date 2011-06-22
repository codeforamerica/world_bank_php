<?php
/** 
 *	worldBankApi
 * Forces use of JSON format if a format is not provided, otherwise this api gives you xml by default
 * If Language is not provided, then english is used. Default 'items per page' is 10 for all functions.
 * Nearly all these functions are the same. I would like to abstract these if time permits so only two or three functions
 * do the heavy lifting and the methods point to those.. Also it may be possible to use this object with entirely static calls
 * to avoid creating objects (probably resulting in speed increase and memory use reduction).
 */
 
class worldBankApi extends APIBaseClass{
	// worldBankApi does not use /need API key.
	public static $api_url = 'http://api.worldbank.org/';
	
	public function __construct($url=NULL)
	{
		parent::new_request(($url?$url:self::$api_url));
	} 
	
	public function call_topic($topics=NULL,$items_per_page=10,$language=NULL,$format=NULL){
		if(func_num_args() > 0) {
		// format is kinda silly but here... basically to define as an xml (default) you must set format to XML or anything other than null
			if($format==NULL) $data['format'] = 'json';
			$result = $this->_request($api_url . ($language !=NULL? $language . '/':NULL) . "topic" . (is_int($topics)?$topics.'/':NULL)  , 'GET',$data);
		}else{
			$result = $this->_request($api_url . 'topic?per_page=10&format=json','GET');
		}
		return($result?$result:NULL);
	
	}
	public function call_data($country,$indicator,$from=1960,$to=2011,$items_per_page =10,$language=NULL,$format=NULL){
		if(is_int($from) && $from < (is_int($to))) $data['date']= $from.$to;
		$data['format'] = ($format==NULL?'json':$format);
		$data['per_page'] = $items_per_page;
		$result = $this->_request($api_url . ($language !=NULL? $language . '/':NULL) . "/countries/$country/indicators/$indicator"  , 'GET',$data);
		return ($result?$result:NULL);
	}
	
	public function call_source($data_source=NULL,$items_per_page=10,$language=NULL,$format=NULL){
	// data source is an integer
		if(func_num_args() > 0) {
			if($data_source != NULL && is_integer($data_source)){
				if($format == NULL) $data['format'] = 'json';
				$data['per_page'] = $items_per_page;
				$result = $this->_request($api_url . ($language !=NULL? $language . '/':NULL) . "source/$data_source" , 'GET',$data);
			}
			if($items_per_page!= NULL) $data['items_per_page'] = $items_per_page;
				$data['format'] = ($format != NULL?$format:'json');
		}else
			$result = $this->_request($api_url . 'source?per_page=10&format=json','GET' );
			
		return ($result?$result:NULL);
	}
	
	public function call_indicator($indicators=NULL,$items_per_page=10,$language=NULL,$format=NULL){
		if(func_num_args() > 0) {
			if($indicators != NULL){
				if($format == NULL) $data['format'] = 'json';
				$data['per_page'] = $items_per_page;
				$result = $this->_request($api_url . ($language !=NULL? $language . '/':NULL) . "indicator/$data_source" , 'GET',$data);
			}
			if($items_per_page!= NULL) $data['items_per_page'] = $items_per_page;
			$data['format'] = ($format != NULL?$format:'json');
		}else
			$result = $this->_request($api_url . 'indicator?indicator=10&format=json','GET' );	
		return ($result?$result:NULL);
	}
	
	public function country_calls_countries($region=NULL,$incomelevel=NULL,$lendingtype=NULL,$language=NULL,$format=NULL){
		if(func_num_args() > 0) {
			if($region != NULL) $data ['region'] = $region;
			if($incomelevel!= NULL) $data['incomelevel'] = $incomelevel;
			if($lendingtype!= NULL) $data['lendingtype'] = $lendingtype;
			$data['format'] = ($format != NULL?$format:'json');
			$result = $this->_request($api_url . ($language !=NULL? $language. '/':NULL) . '/country/' , 'GET',$data);
		}else
			$result = $this->_request($api_url . 'country?per_page=10&format=json','GET' );
		return ($result?$result:NULL);	
	}
	public function country_calls_regions($region=NULL,$items_per_page=10,$language=NULL,$format=NULL){
		if(func_num_args() > 0) {
			if($region != NULL) $data ['region'] = $region;
			if($items_per_page!= NULL) $data['items_per_page'] = $items_per_page;
			$data['format'] = ($format != NULL?$format:'json');
			$result = $this->_request($api_url . ($language !=NULL? $language. '/':NULL) . 'region/' , 'GET',$data);
					
		}else
			$result = $this->_request($api_url . 'region?per_page=10&format=json','GET' );
		
		return ($result?$result:NULL);
	}
	
	public function country_calls_lendingtype($lendingtype=NULL,$items_per_page=10,$language=NULL,$format=NULL){
		if(func_num_args()>0) {
			if($incomelevel!= NULL) $data['incomelevel'] = $incomelevel;
			if($lendingtype!= NULL) $data['lendingtype'] = $lendingtype;
			$data['format'] = ($format != NULL?$format:'json');
			$result = $this->_request($api_url . ($language !=NULL? $language. '/':NULL) . 'lendingtype' , 'GET',$data);
		}else
			$result = $this->_request($api_url .'lendingtype?per_page=10&format=json','GET');
	
		return ($result?$result:NULL);
	}
	
	public function country_calls_incomelevel($incomelevel=NULL,$items_per_page=10,$language=NULL,$format=NULL){
		if(func_num_args()>0) {
			if($incomelevel!= NULL) $data['incomelevel'] = $incomelevel;
			if($lendingtype!= NULL) $data['lendingtype'] = $lendingtype;
			$data['format'] = ($format != NULL?$format:'json');
			$result = $this->_request($api_url . ($language !=NULL? $language. '/':NULL) . 'incomelevel' . ($incomelevel?$incomelevel.'/':NULL) , 'GET',$data);
		}else
			$result = $this->_request($api_url . 'incomelevel?per_page=10&format=json', 'GET');
	
		return ($result?$result:NULL);
	}
}
