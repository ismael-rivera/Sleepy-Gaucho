<?php /* Template Name: Home Page*/  ?>
<!--///////////////// HEADER BEGINS ///////////////////////-->
<?php get_header('custom'); ?>
<!--///////////////// HEADER ENDS /////////////////////////-->

<body> 
    <div id="content_wrapper">
         <div id="slider_wrapper">
<!--///////////////// SLIDER WRAPPER BEGINS //////////////////////-->          
        <?php echo do_shortcode('[promoslider id="image_slider"]'); ?>
        <!--/////////////////// BEGIN Slideshow HTML ////////////////////////-->
   			
<!--///////////////// SLIDER WRAPPER ENDS //////////////////////-->
   	</div>
      <div id="messagePage" class="rounded-corners shadowout">Your Most Important Message or Catchy Phrase Goes In Here
        <div><a class="button rounded-corners" href="<?php the_permalink(); ?>">read more</a></div>
        </div>    
    <!--///////////////// CONTENT BEGINS //////////////////////--> 
    <div id="content">
      <div id="primaryLeft">
            <?php get_a_post('our-firm'); ?>
    <h3><?php the_title(); ?></h3>
    <?php displayMenu(1); ?>
     <div id="iconLeft"></div>
    <p><?php the_content_rss('', 0, '', 50); ?><br />
    <a href="<?php the_permalink(); ?>">read more</a></p>
            </div>
      <div id="primaryRight">
            <?php get_a_post('our-lots'); ?>
    <h3><?php the_title(); ?></h3>
    <?php displayMenu(2); ?>
    <div id="iconRight"></div>
    <p><?php the_content_rss('', 0, '', 50); ?><br />
    <a href="<?php the_permalink(); ?>">read more</a></p>
            </div>
    </div>     
    <!--///////////////// CONTENT ENDS ////////////////////////-->       
    </div>
    <!--///////////////// FOOTER BEGINS ///////////////////////-->
		<?php  include('footer-custom.php'); ?>
    <!--///////////////// FOOTER ENDS /////////////////////////-->    
</body>
</html>