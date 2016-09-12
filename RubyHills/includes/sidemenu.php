<?php

$config->dbconnect();
$sql="SELECT * FROM nav WHERE type = 'sidemenu' ORDER BY id LIMIT 0,6";
$result= mysql_query($sql) or die('Query failed:' . mysql_error());

if ($result) {
	while ($row = mysql_fetch_array($result, MYSQLI_ASSOC)){
		echo "<li><a href='{$row['url']}' title='{$row['title']}'>{$row['name']}</a></li>";
		}
	}
?>	
<!--<ul id="navigation">
 <li><a href="http://webdesign.about.com/">Home</a></li>
 <li><a href="./">Land Development</a></li>
 <li><a href="lots.php">Lots</a></li>
 <li><a href="./">Shop Online</a></li>
 <li><a href="./">Support</a></li>
 <li><a href="./">Training &amp; Consulting</a></li>
 <li><a href="./">Brigita</a></li>
 <li><a href="./">John</a></li>
 <li><a href="./">Michael</a></li>
 <li><a href="./">Peter</a></li>
 <li><a href="./">Sarah</a></li>
 <li><a href="./">Clients</a></li>
 <li><a href="./">Testimonials</a></li>
 <li><a href="./">Press</a></li>
 <li><a href="./">FAQs</a></li>
 <li><a href="./">Featured</a></li>
 <li><a href="./">Top Rated</a></li>
 <li><a href="./">Prices</a></li>
 <li><a href="http://webdesign.about.com/cs/webdesignlayout/a/bl_layouts.htm">XHTML+CSS
 Layout Templates </a></li>
 <li><a href="./">Amenities</a></li>
 <li><a href="./">Photo Albums</a></li>
 <li><a href="./">Virtual Tour</a></li>
 <li><a href="./" class="dir">Contact Us</a>
 <li id="youarehere"><a href="/library/layouts/bl_listlayouts.htm">List Layout Templates </a></li>
 <li><a href="http://webdesign.about.com/od/websitetemplates/index.htm">More Layout
 Templates</a></li>
 <li><a href="./">Directions</a></li>
 <li><a href="./">Map &amp; Driving Directions</a></li>
 <li><a href="./">Your Feedback</a></li>
 </ul>-->