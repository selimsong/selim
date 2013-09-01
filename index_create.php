<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>mei94: 一家专门做特卖,特价，的名品导购网站</title>
     <!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<?php
ob_start();
?>
<body>
    <header>
        <a class="logo" href="#"><h1>mei 94</h1></a>
        <p class="logoText">购物的乐趣 与分享</p>
        <ul class="mainMenu">
            <li><a href="#">首页</a></li>
            <li><a href="#">关于我们</a></li>
            <li class="selected"><a href="#">联系我们</a></li>
        </ul>
    </header>
    <div class="wrapMain">
        <div role="main" class="main">
            <div class="filter">
                <em class="filterName">分类</em>
                <a class="all selected" href="#">所有</a>
                <a class="video" href="#">李宁</a>
            </div>
            <div class="postExcerpts">
			<?php
				$m = new mongoClient('mongodb://127.0.0.1', array());
				$db = $m->spider;
				$collection = $db->shoes;
				$cursor = $collection->find()->limit(20);
				foreach ($cursor as $doc) {
			?>
               <div class="postExcerpt photography">
                    <div class="postExcerptInner">
                        <div class="titleAndCat">
                            <h2><?php echo $doc['title'] ?></h2>
                            <em class="cat">￥<?php echo $doc['price'] ?></em>
                             <em><?php echo $doc['website'] ?></em> 
                        </div>
                        <div class="imgWrap">
                            <img src="<?php echo $doc['imgurl'] ?>" alt="<?php echo $doc['title'] ?>" > 
                        </div>
                        <a class="view" href="#">View</a>
                    </div>
               </div>

			   <?php } ?>
                   
    </div>
    </div>
    </div>
    <footer>
    
      <!--
        <div class="widget">
            <h3 class="widgetTitle">Text Widget</h3>
            <div class="widgetContent">
                <p>Etiam a aliquet dolor. Aliquam diam sapien, mattis id placerat ac, consectetur luctus metus. Proin at magna id urna facilisis facilisis. Maecenas consectetur tempus egestas.</p>
                <p>Fusce eget tortor orci. Integer vulputate, nulla eu sagittis bibendum.</p>
            </div>
        </div>
        <div class="widget">
            <h3 class="widgetTitle">Twitter</h3>
            <div class="widgetContent">
                <div class="tweet">
                    <blockquote>
                        <p>Envato Web Designer Pro Bundle for $20 <a href="http://t.co/Clkws0ug">http://t.co/Clkws0ug</a></p>
                        <span class="time">57 minutes ago</span>
                    </blockquote>
                </div>
                <div class="tweet">
                    <blockquote>
                        <p>Envato Web Designer Pro Bundle for $20 <a href="http://t.co/Clkws0ug">http://t.co/Clkws0ug</a></p>
                        <span class="time">57 minutes ago</span>
                    </blockquote>
                </div>
            </div>
        </div>
        <div class="widget">
            <h3 class="widgetTitle">Recent Posts</h3>
            <div class="widgetContent">
                <ul>
                    <li><a href="#">Etiam a aliquet dolo</a></li>
                    <li><a href="#">Etiam a aliquet dolo</a></li>
                    <li><a href="#">Etiam a aliquet dolo</a></li>
                    <li><a href="#">Etiam a aliquet dolo</a></li>
                </ul>
            </div>
        </div>
        <div class="widget">
            <h3 class="widgetTitle">Categories</h3>
            <div class="widgetContent">
                <ul>
                    <li><a href="#">Video</a></li>
                    <li><a href="#">Photography</a></li>
                    <li><a href="#">Text</a></li>
                    <li><a href="#">Audio</a></li>
                </ul>
            </div>
        </div>
        -->
        
        
        <div class="footerInner">
            <p class="copy">Copyright &copy; 2013 &nbsp;&nbsp;&nbsp;&nbsp;
	<a class="fg-color-white" href="http://www.miitbeian.gov.cn/">沪ICP备13015807号</a></p>
        </div>
    </footer>


</body>
</html>
<?php
file_put_contents('index.html', ob_get_contents());
ob_end_flush();
?>
