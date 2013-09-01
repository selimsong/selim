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
$collection = $db->brands;
$cursor = $collection->find();
foreach ($cursor as $doc) {
 ?>
  <tr bordercolor="#FF0000">
    <td width="319">title: <?php echo $doc['title'] ?></td>
    <td width="98">time: <?php echo $doc['updatetime'] ?></td>
    <td width="edit"><a href="<?php echo $doc['link'] ?>"><?php echo $doc['title'] ?></a></td>
  </tr>
<?php
}
?>

</table>



</body>
</html>
