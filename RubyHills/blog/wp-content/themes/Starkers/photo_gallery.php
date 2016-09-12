<?php /* Template Name: Photo Gallery
*/  
/* Short and sweet */?>
<!--///////////////// HEADER BEGINS ///////////////////////-->
<?php get_header('custom'); ?>
<!--///////////////// HEADER ENDS /////////////////////////--> 
<body>
    <div id="content_wrapper">
         
      <div id="gallery_wrapper" class="rounded-corners shadowout">
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
    <!--///////////////// CONTENT BEGINS //////////////////////--> 
    <div id="content">
     
    </div>     
    <!--///////////////// CONTENT ENDS ////////////////////////-->       
    </div>
    <!--///////////////// FOOTER BEGINS ///////////////////////-->
		<?php  include('footer-custom.php'); ?>
    <!--///////////////// FOOTER ENDS /////////////////////////-->    
</body>
</html>