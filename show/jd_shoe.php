<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>

<table width="1215" height="240" border="1">
<?php
$m = new mongoClient('mongodb://127.0.0.1', array());
$db = $m->spider;
$collection = $db->shoes;
$cursor = $collection->find()->limit(20)->skip($skip);

$p = !empty($_GET['p']) ? $_GET['p'] : 1;
$skip = ($p-1)*20;
$count   = $collection->count();
$page_count = ceil($count/20); 
$pre_page = ($p == 1)? 1 : $p - 1; 
$next_page= ($p == $page_count)? $p : $p + 1 ; 

foreach ($cursor as $doc) {
 ?>
  <tr bordercolor="#FF0000">
    <td width="319">title: <?php echo $doc['title'] ?></td>
    <td width="98">price: <?php //echo $doc['price'] ?></td>
    <td width="107">from: <?php echo $doc['from'] ?></td>
    <td width="392">image:  <img border="0" src="<?php echo $doc['imgurl'] ?>"  ></td>
    <td width="121">weight: <?php echo $doc['weight'] ?></td>
    <td width="138">updatetime: <?php echo $doc['updatetime'] ?></td>
	<td width="edit"><a href="<?php echo $doc['buyurl'] ?>">buy</a></td>
    <td width="edit"><a href="edit.php?id=<?php echo $doc['_id']->{'$id'} ?>">编辑</a></td>
  </tr>
<?php
}
?>
  <tr bordercolor="#FF0000">
    <td width="319"><a href="<?php echo $pre_page;  ?>">上一页</a></td>
    <td width="98"><a href="<?php echo $next_page;  ?>">下一页</a></td>
  </tr>
</table>



</body>
</html>