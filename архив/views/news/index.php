<?php include ROOT.'/views/layouts/header.php';?>
 <div class="content">
  <div class="wrapper">
    <h1>Welcome to Motion</h1>
	<p>Asmart & Creative Single page template</p>
	<div class="slider clearfix">
	<img src="/template/images/back2.png" class="right">
	<img src="/template/images/back1.png" class="left">
	<img src="/template/images/barsa.png" class="center" >
	</div>
	<img id="arrowleft" src="/template/images/arrowleft.png">
    <img id="arrowright" src="/template/images/arrowright.png">
  </div>
 </div>
 <div class="mertis">
  <div class="wrapper">
  <h2>Smart & Creative</h2>
	<p>This is you will use it :)</p>
	<div class="mertis-image clearfix">
	 <div class="item">
	  <image src="/template/images/mertis/multi.png">
	  <a href="#"><h3>Multi purpose</h3>
	  <p>lorem ipsum dolor sit amet, consectetur adipisicing</p></a>
	 </div>
	 <div class="item">
	  <a href="#"><image src="/template/images/mertis/flat.png">
	  <h3>Flat UI</h3>
	  <p>lorem ipsum dolor sit amet, consectetur adipisicing</p></a>
	 </div>
	 <div class="item">
	  <a href="#"><image src="/template/images/mertis/creative.png">
	  <h3>Creative Design</h3>
	  <p>lorem ipsum dolor sit amet, consectetur adipisicing</p></a>
	 </div>
	</div>
  </div>
 </div>
 <div class="news">
     <div class="wrapper">
         <?php foreach ($newslist as $item):?>
         <div class="item">
             <img src="<?php echo $item['path_image'];?>">
             <div class="short_content">
                 <h2><a href="/news/<?php echo $item['id'];?>"><?php echo $item['header'];?> </a></h2>
                 <p><?php echo $item['date'];?></p>
                 <p><?php echo $item['content'];?></p>
                 <ul class="news_footer">
                 <li>Автор:<?php echo $item['author'];?></li><li>comments</li>
                 </ul>
             </div>
         </div>
         <?php endforeach;?>
    </div>
 </div>
</body>
</html>

