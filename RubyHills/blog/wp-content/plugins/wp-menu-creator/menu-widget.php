<?

function widget_menu_widget($args, $widget_args = 1) {
	extract( $args, EXTR_SKIP );
	if ( is_numeric($widget_args) )
		$widget_args = array( 'number' => $widget_args );
	$widget_args = wp_parse_args( $widget_args, array( 'number' => -1 ) );
	extract( $widget_args, EXTR_SKIP );

	$options = get_option('widget_menu_widget');
	if ( !isset($options[$number]) )
		return;

	$title = $options[$number]['title'];
	$menu_id = $options[$number]['menu_id'];
?>
		<?php echo $before_widget; ?>
			<?php if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>
			<div class="menu_widgetwidget"><?php echo $menu_id; ?></div>
		<?php echo $after_widget; ?>
<?php
}

function widget_menu_widget_control($widget_args) {
	global $wp_registered_widgets;
	static $updated = false;

	if ( is_numeric($widget_args) )
		$widget_args = array( 'number' => $widget_args );
	$widget_args = wp_parse_args( $widget_args, array( 'number' => -1 ) );
	extract( $widget_args, EXTR_SKIP );

	$options = get_option('widget_menu_widget');
	if ( !is_array($options) )
		$options = array();

	if ( !$updated && !empty($_POST['sidebar']) ) {
		$sidebar = (string) $_POST['sidebar'];

		$sidebars_widgets = wp_get_sidebars_widgets();
		if ( isset($sidebars_widgets[$sidebar]) )
			$this_sidebar =& $sidebars_widgets[$sidebar];
		else
			$this_sidebar = array();

		foreach ( $this_sidebar as $_widget_id ) {
			if ( 'widget_menu_widget' == $wp_registered_widgets[$_widget_id]['callback'] && isset($wp_registered_widgets[$_widget_id]['params'][0]['number']) ) {
				$widget_number = $wp_registered_widgets[$_widget_id]['params'][0]['number'];
				if ( !in_array( "menu_widget-$widget_number", $_POST['widget-id'] ) ) unset($options[$widget_number]);
			}
		}

		foreach ( (array) $_POST['widget-menu_widget'] as $widget_number => $widget_text ) {
			$title = strip_tags(stripslashes($widget_text['title']));
			$menu_id = strip_tags(stripslashes($widget_text['menu_id']));
			$options[$widget_number] = compact( 'title', 'menu_id' );
		}

		update_option('widget_menu_widget', $options);
		$updated = true;
	}

	if ( -1 == $number ) {
		$title = '';
		$menu_id = '';
		$number = '%i%';
	} else {
		$title = attribute_escape($options[$number]['title']);
		$menu_id = attribute_escape($options[$number]['menu_id']);
	}
?>
		<p>
			<input class="widefat" id="menu_widget-title-<?php echo $number; ?>" name="widget-menu_widget[<?php echo $number; ?>][title]" type="text" value="<?php echo $title; ?>" />
			<input class="widefat" id="menu_widget-menu_id-<?php echo $number; ?>" name="widget-menu_widget[<?php echo $number; ?>][menu_id]" type="text" value="<?php echo $menu_id; ?>" />
			<input type="hidden" id="menu_widget-submit-<?php echo $number; ?>" name="menu_widget-submit-<?php echo $number; ?>" value="1" />
		</p>
<?php
}

function widget_menu_widget_register() {

	// Check for the required API functions
	if ( !function_exists('wp_register_sidebar_widget') || !function_exists('wp_register_widget_control') )
		return;

	if ( !$options = get_option('widget_menu_widget') )
		$options = array();
	$widget_ops = array('classname' => 'widget_menu_widget', 'description' => __('Menu Creator Widget'));
	$control_ops = array('width' => 460, 'height' => 350, 'id_base' => 'menu_widget');
	$name = __('WP Menu Creator Widget');

	$id = false;
	foreach ( array_keys($options) as $o ) {
		// Old widgets can have null values for some reason
		if ( !isset($options[$o]['title']) || !isset($options[$o]['menu_id']) )
			continue;
		$id = "menu_widget-$o"; // Never never never translate an id
		wp_register_sidebar_widget($id, $name, 'widget_menu_widget', $widget_ops, array( 'number' => $o ));
		wp_register_widget_control($id, $name, 'widget_menu_widget_control', $control_ops, array( 'number' => $o ));
	}
	
	// If there are none, we register the widget's existance with a generic template
	if ( !$id ) {
		wp_register_sidebar_widget( 'menu_widget-1', $name, 'widget_menu_widget', $widget_ops, array( 'number' => -1 ) );
		wp_register_widget_control( 'menu_widget-1', $name, 'widget_menu_widget_control', $control_ops, array( 'number' => -1 ) );
	}
	
}

add_action( 'widgets_init', 'widget_menu_widget_register' );