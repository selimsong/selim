<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>

<table width="1215" height="240" border="1">
<?php
$m = new mongoClient('mongodb://127.0.0.1', array());
$db = $m->mei;
$collection = $db->goods;
$cursor = $collection->find()->limit(10);
foreach ($cursor as $doc) {
 ?>
  <tr bordercolor="#FF0000">
    <td width="319">title: <?php echo $doc['title'] ?></td>
    <td width="98">price: <?php echo $doc['price'] ?></td>
    <td width="107">website: <?php echo $doc['website'] ?></td>
    <td width="392">image:  <img border="0" src="<?php echo $doc['imageurl'] ?>"  ></td>
    <td width="121">goodsstatus: <?php echo $doc['gstatus'] ?></td>
    <td width="138">updatetime: <?php echo $doc['updatetime'] ?></td>
	<td width="edit"><a href="<?php echo $doc['buyurl'] ?>">buy</a></td>
    <td width="edit"><a href="edit.php?id=<?php echo $doc['_id']->{'$id'} ?>">编辑</a></td>
  </tr>
<?php
}
?>

</table>



</body>
</html>