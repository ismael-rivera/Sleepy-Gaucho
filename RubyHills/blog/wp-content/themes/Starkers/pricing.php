<?php /* Template Name: Pricing
*/  
/* Short and sweet */?>
<!--///////////////// HEADER BEGINS /////////////////////////-->
<?php get_header('custom'); ?>
<!--///////////////// HEADER ENDS //////////////////////////--> 
<body>
<div id="content_wrapper">      
    <!--///////////////// CONTENT BEGINS /////////////////////////--> 
    <div id="content">
    	<div id="content_left_column">
			<?php displayMenu(1);
             	  displayMenu(2); 
            	 if (function_exists('dynamic_sidebar') && dynamic_sidebar('content_left_column')) : else : ?>  
                <p><strong>Widget Ready</strong></p>  
                <p>This left_column is widget ready! Add one in the admin panel.</p>  
            <?php endif; ?>
    	</div>
    	<div id="content_right_column">
        
<?php include ("pages/table.php") ?>
        </div>
	</div>    
 	<!--///////////////// CONTENT ENDS /////////////////////////-->        
</div>
<!--///////////////// WRAPPER ENDS /////////////////////////-->
<?php  include('footer-custom.php'); ?>
</body>
</html>