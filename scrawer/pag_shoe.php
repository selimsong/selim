<?php
$brandJson = 'shoe.json';
file_exists($brandJson) && unlink($brandJson);


$m = new mongoClient('mongodb://127.0.0.1', array());
$db = $m->spider;
$cbrand = $db->shoeorder;
$cursor = $cbrand->find(array("title"=> '价格'));
$cPagin = $db->shoepagin;
$cPagin->remove();

foreach ($cursor as $d) {
  
  $brandName = $d['brand'];
  $listLink  = $d['link'];
  
  $Aline = shell_exec("scrapy crawl shoepagination  -a domain=".$listLink."  -o ".$brandJson." 2>&1   ");
  $content = file_get_contents($brandJson);
  $con = preg_split("/\r?\n/", $content);
  $data = json_decode($con[0], true);

  foreach($data['title'] as $k =>  $v){
     $doc = array('brand'=> $brandName,'pageNum' => trim($v), 'pageurl' => 'http://list.jd.com/'.trim($data['orderurl'][$k]), 'from'=>'jd','d' => date("d"),'updatetime'=> time());

     $cPagin->insert($doc);
  }
}
