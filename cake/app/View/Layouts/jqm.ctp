<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <title></title>
  
  
  
  <link rel="stylesheet" href="https://d10ajoocuyu32n.cloudfront.net/mobile/1.3.1/jquery.mobile-1.3.1.min.css">
  
  <!-- Extra Codiqa features -->
  <link rel="stylesheet" href="codiqa.ext.css">
  
  <!-- jQuery and jQuery Mobile -->
  <script src="https://d10ajoocuyu32n.cloudfront.net/jquery-1.9.1.min.js"></script>
  <script src="https://d10ajoocuyu32n.cloudfront.net/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>

  <!-- Extra Codiqa features -->
  <script src="https://d10ajoocuyu32n.cloudfront.net/codiqa.ext.js"></script>
   
</head>
<body>
<!-- Home -->
<div data-role="page" id="home">
    <div data-theme="b" data-role="header">
        <h3>
            掲示板
        </h3>
    </div>
    <body>
	<div id="container">
		<div id="header">
			<h2>掲示板</h2>
		</div>
		<div id="content">
		<!-- <a href="http://49.212.46.130/~g031k037/cake/boards/m_index" data-rel="mobile">モバイル版</a> -->

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
		</div>
	</div>
	<?php 
	// echo $this->element('sql_dump'); 
	?>
</body>
  <div data-theme="b" data-role="footer" data-position="fixed">
        <h3>
        ooshida yuri
      </h3>
    </div>
</div>