<?php

$brandJson = 'brand.json';
$Aline = shell_exec("scrapy crawl brand  -o ".$brandJson."   2>&1 ");

$m = new mongoClient('mongodb://127.0.0.1', array());
$db = $m->spider;
$collection = $db->brands;
$collection->remove();
$content = file_get_contents($brandJson);
$con = preg_split("/\r?\n/", $content);
foreach($con as $value){
  $v = json_decode($value, true);
  if(!empty($v['title'][0]) && !empty($v['link'][0])){
     $doc = array('title' => trim($v['title'][0]), 'link' => 'http://list.jd.com/'.trim($v['link'][0]), 'from'=>'jd','weight'=>1,'d' => date("d"),'m'=> date("m"), 'updatetime'=> time());
     $collection->insert($doc);
   }
  
}



