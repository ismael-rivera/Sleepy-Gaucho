<?php
/*
Plugin Name: WP Menu Manager
Plugin URI: http://www.ultimateidx.com/menu-manager/
Description: <strong>WP Menu Manager</strong> - Another fine <a href="http://www.UltimateIDX.com" target="_blank" title="WordPress Real Estate Sites Plug-in">WordPress Plugin</a> from The UltimateIDX&trade;. - Menu Creator / Manager empowers bloggers with more robust CMS type control over their menu structure, ordering and even placement.  With this version of the Menu Creator you can assign menus to widget locations in your them and even specify where they show up based on page, post, category, tag or tag slug. With Menu Creator, you can turn your blog into a truly powerful website solution. For information on how to create the thousands of types of menus possible please visit <a href="http://www.ultimateidx.com/menu-manager/" target="_blank" title="WordPress Real Estate Sites">The UltimateIDX Support</a> for this plug-in.
Author: UltimateIDX Mack McMillan and Jared Ritchey
Version: 1.1.7
Author URI: http://www.ultimateidx.com
*/
/*Support is maintained by Jared Ritchey at jaredritchey.com or UltimateIDX */
include_once('menu-creator.lib.php');
add_action('admin_menu', 'mc_add_pages');
add_action('activate_wp-menu-creator/menu-creator.php', 'mc_install');
add_action( 'widgets_init', 'widget_menu_widget_register' );

define('MC_URL', get_bloginfo('url') . "/wp-content/plugins/wp-menu-creator/menu-creator.css");
function mc_add_pages() {
	add_management_page('WP Menu Manager', 'WP Menu Manager', 8, "wp-menu-creator", "displayMenus");
	add_management_page('Edit Menu', '', 8, "mc-edit-menu", "editMenu");
	add_management_page('Edit Menu Item', '', 8, "mc-edit-menuitem", "editMenuItem");
}
function mc_install()
{
    global $wpdb;
    $table = $wpdb->prefix."menus";
    $structure = " CREATE TABLE $table (
					`id` INT NOT NULL AUTO_INCREMENT ,
					`title` VARCHAR( 128 ) NOT NULL ,
					PRIMARY KEY ( `id` )
					) ENGINE = MYISAM ";
    $wpdb->query($structure);
	$table = $wpdb->prefix."menuitems";
	$adjust = 'ALTER TABLE `' . $table . '` ADD `alttext` VARCHAR( 255 ) NOT NULL AFTER `value` ,
ADD `target` VARCHAR( 50 ) NOT NULL AFTER `alttext`';
	$wpdb->query($adjust);	
	$structure =  "CREATE TABLE $table (
					`id` INT NOT NULL AUTO_INCREMENT ,
					`title` VARCHAR( 255 ) NOT NULL ,
					`type` VARCHAR ( 20 ) NOT NULL ,
					`value` VARCHAR( 255 ) NOT NULL ,
					`alttext` VARCHAR( 255 ) NOT NULL ,
					`target` VARCHAR( 50 ) NOT NULL ,
					`order` INT NOT NULL ,
					`parent` INT NOT NULL ,
					`menu` INT NOT NULL ,
					PRIMARY KEY ( `id` ) ,
					INDEX ( `parent` )
					) ENGINE = MYISAM";
    $wpdb->query($structure);		
}
function displayMenus() {
	if ($_GET["action"] == "deletemenu") {
		deleteMenu($_GET["id"]);
		$msg = "Menu " . $_GET["id"] . " has been deleted.";
	}
	$posts = getMenus();
	include('display.menu.php');
}
function editMenu() {
	if ($_POST["action"] == "createmenu") {
		$_GET["id"] = createMenu($_POST["menutitle"]);
		$msg = "New menu has been created.";
	} elseif ($_POST["action"] == "updatemenuitem") {
		updateMenuItem($_POST);
		$msg = "Menu item updated.";
	} elseif ($_POST["action"] == "createmenuitem") {
		createNewMenuItem($_GET["id"], $_POST);
		$msg = "New menu item created.";
	} elseif ($_GET["action"] == "deletemenuitem") {
		deleteMenuItem($_GET["target"]);
		$msg = "Menu item and subitems deleted.";
	}
	$menu = getMenuInfo($_GET["id"]);
	include('edit.menu.php');
}
function editMenuItem() {
	$mi = getMenuItem($_GET["id"]);
	include('edit.menu.item.php');
}



// WIDGET START


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
	$menu_wrapper_top = $options[$number]['menu_wrapper_top'];
	$menu_wrapper_bottom = $options[$number]['menu_wrapper_bottom'];
	
	$menu_display_position = $options[$number]['menu_display_position'];
	$menu_elements_id = $options[$number]['menu_elements_id'];
	
	$menu_randomize_links = $options[$number]['menu_randomize_links'];
	$menu_how_many_rotate = $options[$number]['menu_how_many_rotate'];
	if(!$menu_how_many_rotate) $menu_how_many_rotate = 0;
	
	
	switch($menu_display_position){
		case 'pages':
		if($menu_elements_id){
			if(!is_page(explode(",",$menu_elements_id))) return;
		}else{
			if(!is_page()) return;
		}
		break;
		case 'posts':
		if($menu_elements_id){
			if(!is_single(explode(",",$menu_elements_id))) return;
		}else{
			if(!is_single()) return;
		}
		break;
		case 'categories':
		if($menu_elements_id){
			if(!is_category(explode(",",$menu_elements_id))) return;
		}else{
			if(!is_category()) return;
		}
		break;
		case 'home':
			if(!is_home() && !is_front_page()) return;
		break;
		case 'istag':
		if($menu_elements_id){
			if(!is_tag(explode(",",$menu_elements_id))) return;
		}else{
			if(!is_tag()) return;
		}
		break;
		case 'hastag':
		if($menu_elements_id){
			if(!has_tag(explode(",",$menu_elements_id))) return;
		}else{
			if(!has_tag()) return;
		}
		break;
	}
	
?>

		<?php echo $before_widget; ?>
		<?php echo $menu_wrapper_top;?>
		
			<?php if ( !empty( $title ) ) { echo "<h3>".$title."</h3>"; } ?>
			
			<?php if($menu_randomize_links == 'yes'):?>
			<?php echo displayRandomizedMenu($menu_id, $menu_how_many_rotate); ?>
			<?php else:?>
			<?php echo displayMenu($menu_id); ?>	
			<?php endif;?>
			<?php echo $menu_wrapper_bottom;?>
			
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
			
			$menu_wrapper_top = stripslashes($widget_text['menu_wrapper_top']);
			$menu_wrapper_bottom = stripslashes($widget_text['menu_wrapper_bottom']);
			
			$menu_display_position = strip_tags(stripslashes($widget_text['menu_display_position']));
			$menu_elements_id = strip_tags(stripslashes($widget_text['menu_elements_id']));
			
			$menu_randomize_links = strip_tags(stripslashes($widget_text['menu_randomize_links']));
			$menu_how_many_rotate = strip_tags(stripslashes($widget_text['menu_how_many_rotate']));
			
			$options[$widget_number] = compact( 'title', 'menu_id', 'menu_wrapper_top', 'menu_wrapper_bottom', 'menu_display_position', 'menu_elements_id', 'menu_randomize_links', 'menu_how_many_rotate' );
		}

		update_option('widget_menu_widget', $options);
		$updated = true;
	}

	if ( -1 == $number ) {
		$title = '';
		$menu_id = '';
		$menu_wrapper_top = '';
		$menu_wrapper_bottom = '';
		$menu_display_position = '';
		$menu_elements_id = '';
		$menu_randomize_links = '';
		$menu_how_many_rotate = '';
		$number = '%i%';
	} else {
		$title = attribute_escape($options[$number]['title']);
		$menu_id = attribute_escape($options[$number]['menu_id']);
		$menu_wrapper_top = attribute_escape($options[$number]['menu_wrapper_top']);
		$menu_wrapper_bottom = attribute_escape($options[$number]['menu_wrapper_bottom']);
		$menu_elements_id = attribute_escape($options[$number]['menu_elements_id']);
		$menu_display_position = attribute_escape($options[$number]['menu_display_position']);
		$menu_randomize_links = attribute_escape($options[$number]['menu_randomize_links']);
		$menu_how_many_rotate = attribute_escape($options[$number]['menu_how_many_rotate']);
	}
?>
		<p>Enter the menu title<br/>
			<input  id="menu_widget-title-<?php echo $number; ?>" name="widget-menu_widget[<?php echo $number; ?>][title]" type="text" value="<?php echo $title; ?>" size="35" /><br/><br/>
			Enter the menu ID<br/>
			<input  id="menu_widget-menu_id-<?php echo $number; ?>" name="widget-menu_widget[<?php echo $number; ?>][menu_id]" type="text" value="<?php echo $menu_id; ?>" size="35" /><br/><br/>
			
			Menu wrapper top<br/>
			<input  id="menu_widget-menu_wrapper_top-<?php echo $number; ?>" name="widget-menu_widget[<?php echo $number; ?>][menu_wrapper_top]" type="text" value="<?php echo $menu_wrapper_top; ?>" size="35" /><br/><br/>
			
			Menu wrapper bottom<br/>
			<input  id="menu_widget-menu_wrapper_bottom-<?php echo $number; ?>" name="widget-menu_widget[<?php echo $number; ?>][menu_wrapper_bottom]" type="text" value="<?php echo $menu_wrapper_bottom; ?>" size="35" /><br/><br/>
			
			Display Position (default is all)<br/>
			<select id="menu_widget-menu_display_position-<?php echo $number; ?>" name="widget-menu_widget[<?php echo $number; ?>][menu_display_position]">
			<option value="all" <?php if($menu_display_position == "all") echo "SELECTED"; ?>>All Pages, Posts, Categories</option>
			<option value="pages" <?php if($menu_display_position == "pages") echo "SELECTED"; ?>>Pages</option>
			<option value="posts" <?php if($menu_display_position == "posts") echo "SELECTED"; ?>>Posts(single)</option>
			<option value="categories" <?php if($menu_display_position == "categories") echo "SELECTED"; ?>>Categories</option>
			<option value="home" <?php if($menu_display_position == "home") echo "SELECTED"; ?>>Home</option>
			<option value="istag" <?php if($menu_display_position == "istag") echo "SELECTED"; ?>>Is Tag</option>
			<option value="hastag" <?php if($menu_display_position == "hastag") echo "SELECTED"; ?>>Has Tag</option>
			</select><br/><br/>
			
		    Enter element ID's (comma separated)<br/>
			<input  id="menu_widget-menu_elements_id-<?php echo $number; ?>" name="widget-menu_widget[<?php echo $number; ?>][menu_elements_id]" type="text" value="<?php echo $menu_elements_id; ?>" size="35" /><br/><br/>
			
			<input id="menu_widget-menu_randomize_links-<?php echo $number; ?>" name="widget-menu_widget[<?php echo $number;?>][menu_randomize_links]" type="checkbox" value="yes" <?php if($menu_randomize_links == 'yes') echo "CHECKED";?>> Randomize Links?<br/><br/>
			
			How many links do you want to rotate? <input id="menu_widget-menu_how_many_rotate-<?php echo $number; ?>" name="widget-menu_widget[<?php echo $number; ?>][menu_how_many_rotate]" type="text" value="<?php echo $menu_how_many_rotate; ?>" size="5" />
			
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
	$control_ops = array('width' => 300, 'height' => 350, 'id_base' => 'menu_widget');
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

?>