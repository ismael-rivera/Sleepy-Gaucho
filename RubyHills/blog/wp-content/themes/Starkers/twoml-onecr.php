<?php /* Template Name: 2Menu-Left/1-Column-Right
*/  
/* Short and sweet */
?>
<!--///////////////// HEADER BEGINS /////////////////////////-->
        <?php get_header('custom'); ?>
<!--///////////////// HEADER ENDS //////////////////////////--> 
<body>

<div id="content_wrapper">
               
    <!--///////////////// CONTENT BEGINS /////////////////////////--> 
    <div id="content">
    	<div id="content_left_column">
			<?php 
				displayMenu(1); 
				displayMenu(2);
				if (function_exists('dynamic_sidebar') && dynamic_sidebar('content_left_column')) : else : ?>  
                <p><strong>Widget Ready</strong></p>  
                <p>This left_column is widget NOT ready! NOTE TO SELF: FOR SOME REASON WIDGETS ARE NOT LOADING. MUST FIX THIS!! Add one in the admin panel.</p>  
            <?php endif; ?>
    	</div>
    	<div id="content_right_column">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

					<?php if ( is_front_page() ) { ?>
						<h3><?php the_title(); ?></h3>
					<?php } else { ?>	
						<h3><?php the_title(); ?></h3>
					<?php } ?>				

						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>


<?php endwhile; ?>
        </div>
	</div>    
 	<!--///////////////// CONTENT ENDS /////////////////////////-->        
</div>
<!--///////////////// WRAPPER ENDS /////////////////////////-->
<?php  include('footer-custom.php'); ?>
</body>
</html>