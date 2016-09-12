<?php
/**
 * Plugin Name: GPP Testimonials Widget
 * Plugin URI: http://graphpaperpress.com/plugins/gpp-testimonials-widget/
 * Description: A widget that introduces you to the world.
 * Version: 1.2.1
 * Author: Thad Allender
 * Author URI: http://graphpaperpress.com
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */
 
/*-----------------------------------------------------------------------------------*/
/* Initiate the plugin */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('gpp_testimonials_init')) {

	add_action('init', 'gpp_testimonials_init');
	
	function gpp_testimonials_init() { 
		
		define ('GPP_TESTIMONIALS_PLUGIN_URL',WP_PLUGIN_URL.'/'.dirname(plugin_basename(__FILE__)).'');
		define ('GPP_TESTIMONIALS_PLUGIN_DIR',WP_PLUGIN_DIR.'/'.dirname(plugin_basename(__FILE__)).'');
	
	}
}

/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action( 'widgets_init', 'testimonials_load_widgets' );

/**
 * Register our widget.
 * 'Testimonials_Widget' is the widget class used below.
 *
 * @since 0.1
 */
function testimonials_load_widgets() {
	register_widget( 'Testimonials_Widget' );
}

/**
 * Example Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 0.1
 */
class Testimonials_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function Testimonials_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'Testimonials', 'description' => __('A widget that displays testimonials and quotes.', 'testimonials') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'testimonials-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'testimonials-widget', __('Testimonials', 'testimonials'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$photo = $instance['photo'];
		$quote = $instance['quote'];
		$about = $instance['about'];
		$name = $instance['name'];
		$link = $instance['link'];

		/* Before widget (defined by themes). */
		echo $before_widget;
		
		echo '<div class="testimonials_widget">';

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
			
		/* If there is quote and name text, show it. */
		if ( $quote )
			echo '<h2>'.$quote;
		
		if ( $name )
			echo '<span class="name">- '.$name.'</span>';
		
		if ( $quote )
			echo '</h2>';
			
		echo '<div class="bio">';

		/* If there is a photo, show it. */
		if ( $photo )
			echo '<img src="'.$photo.'" alt="'.$title.'" class="alignleft" />';
			
		/* If there is a name, show it. */
		if ( $about )
			echo '<h6>About '.$name.'</h6>';
			
		/* If there is about text, show it. */
		if ( $about )
			echo '<p class="about">'.$about.'</p>';
			
		/* If link, show link */
		if ( $link )
			printf( '<a class="link" href="' . __('%1$s', 'testimonials') . '" title="' . __('%2$s', 'testimonials') . '">' . __('%1$s', 'testimonials') . '</a>', $link, $title );
			
		echo '</div><!-- .bio -->';
		echo '</div><!-- .testimonials_widget -->';

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['photo'] = strip_tags( $new_instance['photo'] );
		$instance['name'] = strip_tags( $new_instance['name'] );
		$instance['link'] = strip_tags( $new_instance['link'] );
		
		/* No need to strip tags for show_email, show_phone. */
		$instance['quote'] = $new_instance['quote'];
		$instance['about'] = $new_instance['about'];
		
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('', 'testimonials'), 'quote' => '', 'name' => '', 'about' => '', 'photo' => '', 'link' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Testimonial Title:', 'testimonials'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>
		
		<!-- Testimonial: Text Area -->
		<p>
			<label for="<?php echo $this->get_field_id( 'quote' ); ?>"><?php _e('Testimonial:', 'testimonials'); ?></label> 
			<textarea rows="6" class="widefat" id="<?php echo $this->get_field_id( 'quote' ); ?>" name="<?php echo $this->get_field_name( 'quote' ); ?>"><?php echo $instance['quote']; ?></textarea>
		</p>
		
		<!-- Name: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e('Name:', 'testimonials'); ?></label> 
			<input id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" value="<?php echo $instance['name']; ?>" class="widefat" />
		</p>

		<!-- About: Text Area -->
		<p>
			<label for="<?php echo $this->get_field_id( 'about' ); ?>"><?php _e('About:', 'testimonials'); ?></label> 
			<textarea rows="6" class="widefat" id="<?php echo $this->get_field_id( 'about' ); ?>" name="<?php echo $this->get_field_name( 'about' ); ?>"><?php echo $instance['about']; ?></textarea>
		</p>
		
		<!-- Photo: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'photo' ); ?>"><?php _e('Photo:', 'testimonials'); ?></label>
			<?php
				$photo = $instance['photo'];
				if ( $photo ) { ?>
					<p><img src="<?php echo $instance['photo']; ?>" width="50px" height="auto" /></p>
			<?php } ?>
			<input id="<?php echo $this->get_field_id( 'photo' ); ?>" name="<?php echo $this->get_field_name( 'photo' ); ?>" value="<?php echo $instance['photo']; ?>" class="widefat" /><br />
			<span class="description small"><a href="media-new.php">Upload a photo</a> and paste the URL to it here.  Crop and size accordingly before uploading.</span>
		</p>
		
		<!-- Link: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e('Website:', 'testimonials'); ?></label> 
			<input id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo $instance['link']; ?>" class="widefat" />
		</p>
		
	<?php
	}
}

function gpp_testimonials_styles() { ?>

<!-- Styles the GPP Testimonial Widget -->
<style type="text/css">
.testimonials_widget { margin: 20px 0; }
.testimonials_widget h2 { padding:30px 100px; margin: 20px 0 0; background: transparent url(<?php echo GPP_TESTIMONIALS_PLUGIN_URL .'/img/quote.png'; ?>) no-repeat top left}
.testimonials_widget h2, .testimonials_widget .about { font-family: Cambria, Georgia, Times, "Times New Roman", serif; font-style: italic }
.testimonials_widget .bio { width:50%; margin: 0 auto}
.testimonials_widget img {}
.testimonials_widget .name { display:block; font-size: 16px; font-weight: bold; text-align:right; padding: 20px 100px 0 0;min-width: 90px;min-height: 67px; background: transparent url(<?php echo GPP_TESTIMONIALS_PLUGIN_URL .'/img/quote-end.png'; ?>) no-repeat bottom right}
.testimonials_widget .link {}

#sidebar .testimonials_widget h2, #footer .testimonials_widget h2 { padding: 0; background: none; font-size: 16px;}
#sidebar .testimonials_widget .name, #footer .testimonials_widget .name {padding-right: 0;min-width: 0;min-height: 0; background: none; font-size: 12px;}
#sidebar .testimonials_widget .bio, #footer .testimonials_widget .bio {width: 100%; margin: 1em 0}
</style>

<?php	}

add_action('wp_head', 'gpp_testimonials_styles');

// create shortcode function
function gpp_testimonials_shortcode($atts, $content = null, $code) {  
    extract(shortcode_atts(array(  
        'name' => '',
        'about' => '',
        'url' => '',
        'image' => ''
        
    ), $atts));
    
    
		$testimonial = sprintf( '<div class="testimonials_widget"><h2>%s <span class="name">%s</span></h2><div class="bio"><img src="%s" alt="%s" class="alignleft" /><h6>About %s</h6><p class="about">%s</p><a class="link" href="%s">%s</a></div></div><!-- .testimonials_widget -->',
        $content, $name, $image, $name, $name, $about, $url, $url );
    
    return $testimonial;
    
} 
add_shortcode('testimonial','gpp_testimonials_shortcode');


// Create init functions
function gpp_testimonials_add_button() {  
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
   {  
     add_filter('mce_external_plugins', 'add_plugin');  
     add_filter('mce_buttons', 'register_button');  
   }  
}
add_action('init', 'gpp_testimonials_add_button');

// Register the button
function register_button($buttons) {  
   array_push($buttons, "testimonial");  
   return $buttons;  
}
// Register the TinyMCE plugin
function add_plugin($plugin_array) {  
   $plugin_array['testimonial'] = GPP_TESTIMONIALS_PLUGIN_URL.'/testimonials.js';  
   return $plugin_array;  
}  

?>