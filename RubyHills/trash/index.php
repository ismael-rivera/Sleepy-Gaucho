<?php
/* Short and sweet */
/*define('WP_USE_THEMES', false);
require('blog/wp-blog-header.php');*/
?>
<?php  
include "functions/config.php";
$config= new config;
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php $config->getInfo('title'); ?></title>
<link href="<?php echo info('stylesheet'); ?>" rel="stylesheet" type="text/css" />
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
</head>
<body>
    <div id="layer0">
        <div id="session" class="wrapper">
            <div id="menu">
                    	<ul id="nav" class="dropdown"><?php include "includes/topmenu.php"; ?></ul> 
            		</div>
                    <h1>Ruby Hills</h1>
                    <h3>Country Estates</h1>
        </div>    
    </div>

<div id="layer1">
<!--///////////////////////////header/////////////////////////-->    
        <div id="header" class="wrapper">
        	<!--<div id="logo"><a href="index.php">www.rubyhills.com</a></div>-->
			<ul id="sidenav" class="side"><?php include "includes/sidemenu.php"; ?></ul>  
            <div id="slider"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="750" height="300" id="FlashID" title="main_slider">
                        <param name="movie" value="flash/slideshow.swf" />
                        <param name="quality" value="high" />
                        <param name="wmode" value="opaque" />
                        <param name="swfversion" value="6.0.65.0" />
                        <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
                        <param name="expressinstall" value="Scripts/expressInstall.swf" />
                        <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
                        <!--[if !IE]>-->
                        <object type="application/x-shockwave-flash" data="flash/slideshow.swf" width="750" height="300">
                          <!--<![endif]-->
                          <param name="quality" value="high" />
                          <param name="wmode" value="opaque" />
                          <param name="swfversion" value="6.0.65.0" />
                          <param name="expressinstall" value="Scripts/expressInstall.swf" />
                          <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
                          <div>
                            <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
                            <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p></div>
                  <!--[if !IE]>-->
                </object>
                <!--<![endif]-->
              </object></div>
        </div>
<!--///////////////////////end header/////////////////////////-->        
    </div>
<!--//////////////////////BEGIN LAYER 2////////////////////////////-->    
<div id="layer2">
    <div id="container" class="wrapper">
<?php

/*----------------------------DYNAMIC CONTENT FROM PAGES--------------------------------------*/

$url = '';
$homeurl = 'content/home.php';
	
if (!empty($_GET['cat'])) {$url .= $_GET['cat'] . '/';} 
if (!empty($_GET['page'])) {$url .= $_GET['page'] . '.php';}
if (!isset($_GET['cat'])) { include $homeurl;}
	else {include $url; }
	
	
/*---------------------------END DYNAMIC CONTENT FROM PAGES-----------------------------------*/	

		
?>	
    </div>
</div>
<!--//////////////////////END LAYER 2//////////////////////////////-->
<!--//////////////////////BEGIN LAYER 3////////////////////////////////////-->

<div id="layer3">
            <div id="footer" class="wrapper">
                <div id="widget1"></div>
                <div id="widget2"></div>
                <div id="widget3"></div>
            </div>
        </div>	
	  
<!--//////////////////////END LAYER 3//////////////////////////////////////-->
<div id="layer4">
<div id="site-info" class="wrapper">
<? echo info('legal'); ?>
<br />
Property of RubyHills.com inc.<br />
Website designed by Ismael Rivera
</div>
</div>
<!--//////////////////////END LAYER 4//////////////////////////////////////-->
<script type="text/javascript">
swfobject.registerObject("FlashID");
</script>
</body>
</html>