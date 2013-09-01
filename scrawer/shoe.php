<?php
include_once('conf.php');

$shoeJson = 'shoe.json';
$brands = get_shoeBrand();
$cshoePagin = $db->shoepagin;

$collection = $db->shoes;
$collection->remove();

foreach($brands as $d){
  
   $brandName = $d['title'];
   $cursor = $cshoePagin->find(array('brand'=>$brandName));
   $page = array();
   foreach($cursor as $value){
     if(is_numeric($value['pageNum'])){
      $page[$value['pageNum']] = $value['pageurl'];
     }
   }
   ksort($page);
   $i = 0;
   $expUrl = null;
   $count = count($page) - 1;
   foreach($page as $k=>$v){
       if($count == $i){
          $finalKey = $k;
          $finalUrl = $v;
        }
     $i++;
   } 
   
   $expUrl = explode('-', $finalUrl);
   krsort($expUrl); 
   foreach($expUrl  as $ek=>$ev){
       if(trim($finalKey) == trim($ev)){
           $replaceKey = trim($ek);   //get the last page number to replace
           break;
       }
   }
   ksort($expUrl);

   for($i=1;$i<=$finalKey; $i++){
     $expUrl[$replaceKey] = $i;
     $spiderUrl[] = implode('-', $expUrl);  
   }
   foreach($spiderUrl as $sv){
     sleep(10);
     $con= $content = null;
     file_exists($shoeJson) && unlink($shoeJson);
     $listLink = $sv; 
     $Aline = shell_exec("scrapy crawl shoe -a domain=".$listLink." -o ".$shoeJson." 2>&1  ");
//     echo $Aline;
     $content = file_get_contents($shoeJson);
     $con = preg_split("/\r?\n/", $content);
     $data = json_decode($con[0], true);
     $shoeImg = array_merge($data['imgurlLazy'], $data['imgurl']);
     foreach($data['title'] as $k => $v){
         $doc = array('title' => trim($v), 'brand'=>$brandName, 'link' => 'http://list.jd.com/'.trim($data['buyurl'][$k]), 'imgurl'=>$shoeImg[$k], 'from'=>'jd','weight'=>1,'d' => date("d"),'m'=> date("m"), 'updatetime'=> time());
         $collection->insert($doc);
      }

     }


}

