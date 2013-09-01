<?php
set_time_limit(0);
$shoes_table = 'shoes';

$m = new mongoClient('mongodb://127.0.0.1', array());
$db= $m->spider;


function get_shoeBrand(){
   global $db;
  $collection = $db->brands;
  return $collection->find(array("weight" => 2));
}
