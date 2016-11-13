<div id="footerwrapper">
<!--<table width="960" border="0" cellpadding="2">
  <tr>
    <td><?php //if (function_exists('dynamic_sidebar') && dynamic_sidebar('left_column')) : else : ?>  
        <p><strong>Widget Ready</strong></p>  
        <p>This left_column is widget ready! Add one in the admin panel.</p>  
    <?php //endif; ?> </td>
    <td><?php //if (function_exists('dynamic_sidebar') && dynamic_sidebar('center_column')) : else : ?>  
        <p><strong>Widget Ready</strong></p>  
        <p>This center_column is widget ready! Add one in the admin panel.</p>  
    <?php //endif; ?></td>
    <td><?php //if (function_exists('dynamic_sidebar') && dynamic_sidebar('right_column')) : else : ?>  
        <p><strong>Widget Ready</strong></p>  
        <p>This center_column is widget ready! Add one in the admin panel.</p>  
    <?php //endif; ?></td>
  </tr>
</table>-->
    <div id="footer"> 
    	<?php get_footer('custom'); ?>
    </div>          
</div>
<div id="subfooterwrapper">
<div id="subfooter"><a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			<a href="http://wordpress.org/" title="Semantic Personal Publishing Platform" rel="generator">Proudly powered by WordPress </a>
            <a href="#" class="legal">lorem ipsum legal blah</a></div>
</div> 
           