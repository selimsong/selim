<?php

$brandJson = 'shoe.json';
file_exists($brandJson) && unlink($brandJson);

$m = new mongoClient('mongodb://127.0.0.1', array());
$db = $m->spider;
$cbrand = $db->brands;
$cursor = $cbrand->find(array("weight"=> 2));
$cOrder = $db->shoeorder;
$cOrder->remove();

foreach ($cursor as $d) {
  $brandName = $d['title'];
  $listLink  = $d['link'];
  $Aline = shell_exec("scrapy crawl shoeorder -a domain=".$listLink."  -o ".$brandJson." 2>&1   ");
  
  $content = file_get_contents($brandJson);
  $con = preg_split("/\r?\n/", $content);
  $data = json_decode($con[0], true);

  foreach($data['title'] as $k =>  $v){
     $doc = array('brand'=> $brandName,'title' => trim($v), 'link' => 'http://list.jd.com/'.trim($data['orderurl'][$k]), 'from'=>'jd','weight'=>1,'d' => date("d"),'updatetime'=> time());

     $cOrder->insert($doc);
  }
  


}
