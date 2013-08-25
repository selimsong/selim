<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>

<?php

if(!empty($_POST['title'])){
$m = new mongoClient('mongodb://127.0.0.1', array());
$db = $m->mei;
$collection = $db->goods;
$doc = array('title' => trim($_POST['title']), 'price' => trim($_POST['price']), 'website' => trim($_POST['website']), 'imageurl' => addslashes(trim($_POST['imageurl'])), 'gstatus' => $_POST['gstatus']);
$collection->update(array('_id' => new MongoId($_POST['id'])) ,array('$set' => $doc));
header('Location: /list.php');
exit();
}

$m = new mongoClient('mongodb://127.0.0.1', array());
$db = $m->mei;
$collection = $db->goods;
$cursor = $collection->findOne(array('_id' => new MongoId($_GET['id'])));
var_dump($cursor);
 ?>
<form action="" method="post">
title   :<input  type="text" name="title" value="<?php echo $cursor['title']; ?>"   /><br />
price   :<input  type="text" name="price" value="<?php echo $cursor['price']; ?>"   /><br />
website :<input  type="text" name="website"   value="<?php echo $cursor['website']; ?>"  /><br />
imageUrl:<input type="text" name="imageurl"  value="<?php echo $cursor['imageurl']; ?>" /><br />
gstatus<input type="text" name="gstatus"  value="<?php echo $cursor['gstatus']; ?>" /><br />
<input type="hidden" name="id"  value="<?php echo $_GET['id']; ?>" /><br />
<input type="submit" value="Submit">
</form>





</body>
</html>