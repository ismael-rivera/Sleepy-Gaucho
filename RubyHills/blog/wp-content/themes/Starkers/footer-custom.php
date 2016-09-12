<div id="footerwrapper">
    <div id="footer"> 
    	<?php get_sidebar( 'footer' );?>
<?php
	wp_footer();
?>
    </div>          
</div>
<div id="subfooterwrapper">
<div id="subfooter"><a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			<a href="http://wordpress.org/" title="Semantic Personal Publishing Platform" rel="generator">Proudly powered by WordPress </a>
            <a href="#" class="legal">lorem ipsum legal blah</a></div>
</div>



</body>
</html>