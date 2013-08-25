<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php
if(!empty($_POST['title'])){
$m = new mongoClient('mongodb://127.0.0.1', array());
$db = $m->star;
$collection = $db->mei;
$doc = array('title' => trim($_POST['title']), 'price' => trim($_POST['price']), 'website' => trim($_POST['website']), 'imageurl' => addslashes(trim($_POST['imageurl'])), 'gstatus' => 1,'updatetime'=> time());
$collection->insert($doc);

}
 ?>
<form>
title   :<input  type="text" name="title" value=""   /><br />
price   :<input  type="text" name="price" value=""   /><br />
website :<input  type="text" name="website"   value="京东"  /><br />
imageUrl:<input type="text" name="imageurl"  value="" /><br />
<input type="submit" value="Submit">
</form>


</body>
</html>