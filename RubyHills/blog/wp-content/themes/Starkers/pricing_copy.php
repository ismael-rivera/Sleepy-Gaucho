<?php /* Template Name: Pricing Copy
*/  
/* Short and sweet */
require('wp-blog-header.php');


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Front Page</title>


<? echo wp_head(); ?>
<link href="<?php bloginfo('template_directory'); ?>/css/pagestyles.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/slider.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/test.js"></script>
</head>

<body>
    <!--///////////////// HEADER BEGINS /////////////////////////-->
        <?php  include('pages/header.php'); ?>
    <!--///////////////// HEADER ENDS //////////////////////////--> 
<div id="content_wrapper">
               
    <!--///////////////// CONTENT BEGINS /////////////////////////--> 
    <div id="content">
    	<div id="content_left_column">
			<?php displayMenu(1); ?>
            <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('content_left_column')) : else : ?>  
                <p><strong>Widget Ready</strong></p>  
                <p>This left_column is widget ready! Add one in the admin panel.</p>  
            <?php endif; ?>
    	</div>
    	<div id="content_right_column">
        <!--/////////////////// PRICING DATABASE TABLE BEGINS HERE //////////////////////-->
        <table width="456" cellpadding="5" cellspacing="0" class="shadowout">

	<!-- Table header -->

		<thead>
			<tr>
				<th width="58" id="..." scope="col">Lot#</th>
                <th width="58" id="..." scope="col">Price</th>
			</tr>
            
		</thead>

	<!-- Table body -->

		<tbody>
			
				<?php
dbconnect();
$sql="SELECT * FROM lot_prices";
$result= mysql_query($sql) or die('Query failed:' . mysql_error());
if ($result) {
	while ($row = mysql_fetch_array($result, MYSQLI_ASSOC)){
		echo "<tr><td>{$row['id']}</td>
			  <td>{$row['price']}</td></tr>";
				}
	}
?>	
			
			
		</tbody>

</table>
        <!--/////////////////// PRICING DATABASE TABLE ENDS HERE //////////////////////-->
			<?php get_a_post('pricing'); ?>
            <h3><?php the_title(); ?></h3>
            <p><?php the_content(); ?></p>
        </div>
	</div>    
 	<!--///////////////// CONTENT ENDS /////////////////////////-->        
</div>
<!--///////////////// WRAPPER ENDS /////////////////////////-->
<?php  include('pages/footer.php'); ?>
</body>
</html>