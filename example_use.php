<?php
// Base API Class
require 'APIBaseClass.php';

require 'open311Api.php';

$new = new open311Api();

echo $new->call_topic();


// Debug information
die(print_r($new).print_r(get_object_vars($new)).print_r(get_class_methods(get_class($new))));
