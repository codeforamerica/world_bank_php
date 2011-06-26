<?php
// Base API Class
require 'APIBaseClass.php';

require 'worldBankApi.php';

$new = new worldBankApi();

echo $new->call_topic();
// reference  http://data.worldbank.org/querybuilder 
echo $new->call_data('BEL','AG.CON.FERT.ZS');

echo $new->call_source();

echo $new->call_indicator();

echo $new->country_calls_countries();

echo $new->country_calls_regions();

echo $new->country_calls_lendingtype();

echo $new->country_calls_incomelevel();

// Debug information
die(print_r($new).print_r(get_object_vars($new)).print_r(get_class_methods(get_class($new))));
