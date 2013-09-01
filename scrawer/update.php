<?php

$m = new mongoClient('mongodb://127.0.0.1', array());
$db = $m->spider;
$collection = $db->brands;
$update = array('鸿星尔克', '李宁', '特步', '乔丹');
foreach($update as $up){

$collection->update(array('title'=> new MongoRegex("/".$up."/")), array('$set'=> array('weight'=>2)));
}



