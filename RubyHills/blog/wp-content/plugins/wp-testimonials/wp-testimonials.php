<?php
/* 
Plugin Name: WP-Testimonials
Plugin URI: http://www.sunfrogservices.com/web-programming/wp-testimonials/
Description: Lets you display your testimonials in a random block and/or all on one page.  Widget included.  Optional link in sidebar block to "view all" testimonials on a page.  Requires WordPress 2.7 or higher.
Version: 3.4.1
Author: Jodi Diehl
Author URI: http://www.sunfrogservices.com
License: GPL

WP-Testimonials - displays testimonials in WordPress
Version 3.4.1
Copyright (C) 2007-2010 Jodi Diehl
Released 2010-08-19

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

Contact Jodi Diehl at http://www.sunfrogservices.com/

*/

// +---------------------------------------------------------------------------+
// | WP hooks                                                                  |
// +---------------------------------------------------------------------------+

/* WP actions */

register_activation_hook( __FILE__, 'sfstst_install' );
register_deactivation_hook( __FILE__, 'sfstst_deactivate' );
add_action('admin_menu', 'sfstst_addpages');
add_action( 'admin_init', 'register_sfstst_options' );
add_action('init', 'sfstst_addcss');
add_action('plugins_loaded', 'sfstst_Set');
add_shortcode('sfs-testimonials', 'sfstst_showall');

function register_sfstst_options() { // whitelist options
  register_setting( 'sfstst-option-group', 'sfs_showlink' );
  register_setting( 'sfstst-option-group', 'sfs_linktext' );
  register_setting( 'sfstst-option-group', 'sfs_linkurl' );
  register_setting( 'sfstst-option-group', 'sfs_deldata' );
  register_setting( 'sfstst-option-group', 'sfs_setlimit' );
  register_setting( 'sfstst-option-group', 'sfs_admng' );
  register_setting( 'sfstst-option-group', 'sfs_imgalign' );
  register_setting( 'sfstst-option-group', 'sfs_imgmax' );
  register_setting( 'sfstst-option-group', 'sfs_sorder' );
}

function unregister_sfstst_options() { // unset options
  unregister_setting( 'sfstst-option-group', 'sfs_showlink' );
  unregister_setting( 'sfstst-option-group', 'sfs_linktext' );
  unregister_setting( 'sfstst-option-group', 'sfs_linkurl' );
  unregister_setting( 'sfstst-option-group', 'sfs_deldata' );
  unregister_setting( 'sfstst-option-group', 'sfs_setlimit' );
  unregister_setting( 'sfstst-option-group', 'sfs_admng' );
  unregister_setting( 'sfstst-option-group', 'sfs_imgalign' );
  unregister_setting( 'sfstst-option-group', 'sfs_imgmax' );
  unregister_setting( 'sfstst-option-group', 'sfs_sorder' );
}


function sfstst_addcss() { // include style sheet
  	  wp_enqueue_style('sfstst_css', '/' . PLUGINDIR . '/wp-testimonials/css/wp-testimonials-style.css' );        
}  

// +---------------------------------------------------------------------------+
// | Create admin links                                                        |
// +---------------------------------------------------------------------------+

function sfstst_addpages() { 

	if (get_option('sfs_admng') == '') { $sfs_admng = 'update_plugins'; } else {$sfs_admng = get_option('sfs_admng'); }

// Create top-level menu and appropriate sub-level menus:
	add_menu_page('Testimonials', 'Testimonials', $sfs_admng, 'sfstst_manage', 'sfstst_adminpage', plugins_url('/wp-testimonials/sfstst_icon.png'));
	add_submenu_page('sfstst_manage', 'Settings', 'Settings', $sfs_admng, 'tsfstst_config', 'sfstst_options_page');
}

// +---------------------------------------------------------------------------+
// | Create table on activation                                                |
// +---------------------------------------------------------------------------+

function sfstst_install () {
   global $wpdb;

   $table_name = $wpdb->prefix . "testimonials";
   if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
 
		if ( $wpdb->supports_collation() ) {
				if ( ! empty($wpdb->charset) )
					$charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
				if ( ! empty($wpdb->collate) )
					$charset_collate .= " COLLATE $wpdb->collate";
		}
      
	   $sql = "CREATE TABLE IF NOT EXISTS " . $table_name . "(
		testid int( 15 ) NOT NULL AUTO_INCREMENT ,
		text_short text,
		text_full text,
		clientname text,
		company text,
		homepage text,
		sfimgurl text,
		storder INT( 5 ) NOT NULL,
		PRIMARY KEY ( `testid` )
		) ".$charset_collate.";";
	  
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
dbDelta($sql);
	  
	  $txt_short = "Thank you for installing the WP-Testimonials plugin.";
	  $txt_long = "Thank you for installing the WP-Testimonials plugin.  You can manage the testimonials through the admin area under the Testimonials tab.";
      $insert = "INSERT INTO " . $table_name .
            " (text_short,text_full,clientname,company,homepage) " .
            "VALUES ('$txt_short','$txt_long','Jodi Diehl','Website Programmer, Virtual Assistant','http://www.sunfrogservices.com/')";
      $results = $wpdb->query( $insert );

	// insert default settings into wp_options 
	$toptions = $wpdb->prefix ."options";
	$defset = "INSERT INTO ".$toptions.
		"(option_name, option_value) " .
		"VALUES ('sfs_admng', 'update_plugins'),('sfs_deldata', ''),".
		"('sfs_linktext', 'Read More'),('sfs_linkurl', ''),('sfs_setlimit', '1'),".
		"('sfs_showlink', ''),('sfs_imgalign','right'),('sfs_sorder', 'testid DESC')";
	$dodef = $wpdb->query( $defset );

	} 

	// add sort order if current version is older than 3.0
	if (get_option('sfstst_version') < '3.0') { 
		$sql = "ALTER TABLE " . $table_name . " ADD `storder` INT( 5 ) NOT NULL ;";
		$results = $wpdb->query( $sql );
	}

	// add default values for core settings if current version is older than 3.0
	if (get_option('sfstst_version') < '3.0') { 
		$toptions = $wpdb->prefix ."options";
		$defset = "INSERT INTO ".$toptions.
			"(option_name, option_value) " .
			"VALUES ('sfs_admng', 'update_plugins'),('sfs_setlimit', '1'),('sfs_sorder', 'testid DESC')";
		$dodef = $wpdb->query( $defset );
	}

	// add image field if current version is older than 3.3
	if (get_option('sfstst_version') < '3.3') { 
		$sql = "ALTER TABLE " . $table_name . " ADD `sfimgurl` TEXT ;";
		$results = $wpdb->query( $sql );
	}
	
	// remove obsolete option sfs_linkblank if older than 3.4
	if (get_option('sfstst_version') < '3.4') { 
		delete_option("sfs_linkblank");
	}
	
	// update version in options table
	  delete_option("sfstst_version");
	  add_option("sfstst_version", "3.4.1");
}

// +---------------------------------------------------------------------------+
// | Add Settings Link so Plugins Page                                         |
// +---------------------------------------------------------------------------+

function add_settings_link($links, $file) {
	static $sfstst_plugin;
	if (!$sfstst_plugin) $sfstst_plugin = plugin_basename(__FILE__);
	
	if ($file == $sfstst_plugin){
		$settings_link = '<a href="admin.php?page=tsfstst_config">'.__("Settings").'</a>';
		 // array_unshift($links, $settings_link);
		 $links[] = $settings_link;
	}
	return $links;
}

function sfstst_Set() {
	if (current_user_can('update_plugins')) 
	add_filter('plugin_action_links', 'add_settings_link', 10, 2 );
}

// +---------------------------------------------------------------------------+
// | Add New Testimonial                                                       |
// +---------------------------------------------------------------------------+

/* add new testimonial form */
function sfstst_newform() {
?>
	<div class="wrap">
	<h2>Add New Testimonial</h2>
	<ul>
	<li>If you want to include this testimonial in the random block, you must have content in the &quot;short text&quot; field.</li>
	<li>You must have content in the &quot;full text&quot; field for this testimonial to show on your Testimonials page.</li>
	</ul>
	<br />
	<div id="sfstest-form">
	<form name="addnew" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<label for="clientname">Client Name:</label><input name="clientname" type="text" size="45"><br/>
	<label for="company">Company:</label><input name="company" type="text" size="45"><br/>
	<label for="website">Website:</label><input name="homepage" type="text" size="45" value="http://" onFocus="this.value=''"><br/>
	<label for="text_short">Short text (20-30 words for random block):</label><textarea name="text_short" cols="45" rows="5"></textarea><br/>
	<label for="text_full">Full text:</label><textarea name="text_full" cols="45" rows="15"></textarea><br/>
	<label for="sfimgurl">Image URL:</label><input name="sfimgurl" type="text" size="10"> (copy File URL from <a href="<?php echo admin_url('/upload.php'); ?>" target="_blank">Media</a>) <br/>
	<label for="storder">Sort order:</label><input name="storder" type="text" size="10"> (optional) <br/>
	<input type="submit" name="sfstst_addnew" value="<?php _e('Add Testimonial', 'sfstst_addnew' ) ?>" /><br/>
	
	</form>
	</div>
	</div>
<?php } 

/* insert testimonial into DB */
function sfstst_insertnew() {
	global $wpdb;
	$table_name = $wpdb->prefix . "testimonials";
	
	$txt_short = $wpdb->escape($_POST['text_short']);
	$txt_long = $wpdb->escape($_POST['text_full']);
	$clientname = $wpdb->escape($_POST['clientname']);
	$company = $wpdb->escape($_POST['company']);
	$homepage = $_POST['homepage'];
	$sfimgurl = $_POST['sfimgurl'];
	$storder = $_POST['storder'];
	
	$insert = "INSERT INTO " . $table_name .
	" (text_short,text_full,clientname,company,homepage,sfimgurl,storder) " .
	"VALUES ('$txt_short','$txt_long','$clientname','$company','$homepage','$sfimgurl','$storder')";
	
	$results = $wpdb->query( $insert );

}

// +---------------------------------------------------------------------------+
// | Manage Page - list all and show edit/delete options                       |
// +---------------------------------------------------------------------------+


/* show list of testimonials */
function sfstst_showlist() {
	global $wpdb;
	$table_name = $wpdb->prefix . "testimonials";
	$tstlist = $wpdb->get_results("SELECT testid,clientname,company,homepage FROM $table_name");

	foreach ($tstlist as $tstlist2) {
		echo '<p>';
		echo '<a href="admin.php?page=sfstst_manage&amp;mode=sfststedit&amp;testid='.$tstlist2->testid.'">Edit</a>';
		echo '&nbsp;|&nbsp;';
		echo '<a href="admin.php?page=sfstst_manage&amp;mode=sfststrem&amp;testid='.$tstlist2->testid.'" onClick="return confirm(\'Delete this testimonial?\')">Delete</a>';
		echo '&nbsp;&nbsp;';
		echo stripslashes($tstlist2->clientname);
			if ($tstlist2->company != '') {
				if ($tstlist2->homepage != '') {
					echo ' ( <a href="'.$tstlist2->homepage.'">'.stripslashes($tstlist2->company).'</a>  )';
				} else {
					echo ' ('.stripslashes($tstlist2->company).')';
				}
			}
		echo '</p>';
	}
}

/* edit testimonial form */

function sfstst_edit($testid){
	global $wpdb;
	$table_name = $wpdb->prefix . "testimonials";
	
	$gettst2 = $wpdb->get_row("SELECT testid, clientname, company, homepage, text_full, text_short, sfimgurl, storder FROM $table_name WHERE testid = $testid");
	
	echo '<h3>Edit Testimonial</h3>';
	echo '<ul>
	<li>If you want to include this testimonial in the random block, you must have content in the &quot;short text&quot; field.</li>
	<li>You must have content in the &quot;full text&quot; field for this testimonial to show on your Testimonials page.</li>
	</ul>';

	echo '<div id="sfstest-form">';
	echo '<form name="edittst" method="post" action="admin.php?page=sfstst_manage">';
	 echo '<label for="clientname">Client Name:</label>
		  <input name="clientname" type="text" size="45" value="'.stripslashes($gettst2->clientname).'"><br/>
		<label for="company">Company:</label>
		  <input name="company" type="text" size="45" value="'.stripslashes($gettst2->company).'"><br/>
		<label for="homepage">Website:</label>
		 <input name="homepage" type="text" size="45" value="'.$gettst2->homepage.'"><br/>
		<label for="text_short">Short text (20-30 words for random block):</label>
		  <textarea name="text_short" cols="45" rows="5">'.stripslashes($gettst2->text_short).'</textarea><br/>
		<label for="text_full">Full text:</label>
		  <textarea name="text_full" cols="45" rows="15">'.stripslashes($gettst2->text_full).'</textarea><br/>
		<label for="sfimgurl">Image URL:</label><input name="sfimgurl" type="text" size="10" value="'.$gettst2->sfimgurl.'"> (copy File URL from <a href="'.admin_url('/upload.php').'" target="_blank">Media</a>) <br/>
		<label for="storder">Sort order:</label>
		 <input name="storder" type="text" size="10" value="'.$gettst2->storder.'"> (optional)<br/>
		  <input type="hidden" name="testid" value="'.$gettst2->testid.'">
		  <input name="sfststeditdo" type="submit" value="Update">';
	echo '</form>';
	echo '</div>';
}

/* update testimonial in DB */
function sfstst_editdo($testid){
	global $wpdb;
	$table_name = $wpdb->prefix . "testimonials";
	
	$testid = $testid;
	$txt_short = $wpdb->escape($_POST['text_short']);
	$txt_long = $wpdb->escape($_POST['text_full']);
	$clientname = $wpdb->escape($_POST['clientname']);
	$company = $wpdb->escape($_POST['company']);
	$homepage = $_POST['homepage'];
	$sfimgurl = $_POST['sfimgurl'];
	$storder = $_POST['storder'];
	
	$wpdb->query("UPDATE " . $table_name .
	" SET text_short = '$txt_short', ".
	" text_full = '$txt_long', ".
	" clientname = '$clientname', ".
	" company = '$company', ".
	" homepage = '$homepage', ".
	" sfimgurl = '$sfimgurl', ".
	" storder = '$storder' ".
	" WHERE testid = '$testid'");
}

/* delete testimonials from DB */
function sfstst_removetst($testid) {
	global $wpdb;
	$table_name = $wpdb->prefix . "testimonials";
	
	$insert = "DELETE FROM " . $table_name .
	" WHERE testid = ".$testid ."";
	
	$results = $wpdb->query( $insert );

}


/* admin page display */
function sfstst_adminpage() {
	global $wpdb;
?>
	<div class="wrap">
	<?php
	echo '<h2>Testimonials Management Page</h2>';
	echo '<p align="right">Need help? <a href="/' . PLUGINDIR . '/wp-testimonials/docs/documentation.php" target="_blank">documentation</a> &nbsp;|&nbsp; <a href="http://www.sunfrogservices.com/web-programming/wp-testimonials/">support page</a></p>';

		if (isset($_POST['sfstst_addnew'])) {
			sfstst_insertnew();
			?>
	<div id="message" class="updated fade"><p><strong><?php _e('Testimonial Added'); ?>.</strong></p></div><?php
		}
		if ($_REQUEST['mode']=='sfststrem') {
			sfstst_removetst($_REQUEST['testid']);
			?><div id="message" class="updated fade"><p><strong><?php _e('Testimonial Deleted'); ?>.</strong></p></div><?php
		}
		if ($_REQUEST['mode']=='sfststedit') {
			sfstst_edit($_REQUEST['testid']);
			exit;
		}
		if (isset($_REQUEST['sfststeditdo'])) {
			sfstst_editdo($_REQUEST['testid']);
			?><div id="message" class="updated fade"><p><strong><?php _e('Testimonial Updated'); ?>.</strong></p></div><?php
		}
			sfstst_showlist(); // show testimonials
		?>
	</div>
	<div class="wrap"><?php sfstst_newform(); // show form to add new testimonial ?>
	</div>
	<div class="wrap">
	<?php 
$yearnow = date('Y');
if($yearnow == "2007") {
    $yearcright = "";
} else { 
    $yearcright = "2007-";
}
?>
	  <p>WP-Testimonials is &copy; Copyright <?php echo("".$yearcright."".date('Y').""); ?>, <a href="http://www.sunfrogservices.com/" target="_blank">Jodi Diehl</a> and distributed under the <a href="http://www.fsf.org/licensing/licenses/quick-guide-gplv3.html" target="_blank">GNU General Public License</a>. 
	  If you find this plugin useful, please consider a <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7279865" target="_blank">donation</a>.</p>
	</div>
<?php } 

// +---------------------------------------------------------------------------+
// | Sidebar - show random testimonial(s) in sidebar                           |
// +---------------------------------------------------------------------------+

/* show random testimonial(s) in sidebar */
function sfstst_onerandom() {
	global $wpdb;
	$table_name = $wpdb->prefix . "testimonials";
	if (get_option('sfs_setlimit') == '') {
		$sfs_setlimit = 1;
	} else {
		$sfs_setlimit = get_option('sfs_setlimit');
	}
	$randone = $wpdb->get_results("SELECT testid, clientname, company, homepage, text_short FROM $table_name WHERE text_short !='' order by RAND() LIMIT $sfs_setlimit");

	echo '<div id="sfstest-sidebar">';
	
	foreach ($randone as $randone2) {
			
			echo '<blockquote>';
			echo '<p>';
			echo nl2br(stripslashes($randone2->text_short));
			echo '</p>';
	
			echo '<p><cite>';
			if ($randone2->company != '') {
			echo stripslashes($randone2->clientname).'<br/>';
				if ($randone2->homepage != '') {
					echo '<a href="'.$randone2->homepage.'" class="cite-link">'.stripslashes($randone2->company).'</a>';
				} else {
					echo stripslashes($randone2->company);
				}
		
			} else {
				echo stripslashes($randone2->clientname).'';
			}
			echo '</cite></p>';
			echo '</blockquote>';

		} // end loop
			$sfs_showlink = get_option('sfs_showlink');
			$sfs_linktext = get_option('sfs_linktext');
			$sfs_linkurl = get_option('sfs_linkurl');
			
				if (($sfs_showlink == 'yes') && ($sfs_linkurl !='')) {
					if ($sfs_linktext == '') { $sfs_linkdisplay = 'Read More'; } else { $sfs_linkdisplay = $sfs_linktext; }
					echo '<div class="sfststreadmore"><a href="'.$sfs_linkurl.'">'.$sfs_linkdisplay.'</a></div>';
				}
	echo '</div>';
}

// +---------------------------------------------------------------------------+
// | Widget for testimonial in sidebar                                         |
// +---------------------------------------------------------------------------+
if (version_compare($wp_version, '2.8', '>=')) { // check if this is WP2.8+

	### Class: WP-Testimonials Widget
	 class sfstst_widget extends WP_Widget {
		// Constructor
		function sfstst_widget() {
			$widget_ops = array('description' => __('Displays one random testimonial in your sidebar', 'wp-testimonials'));
			$this->WP_Widget('testimonials', __('Testimonials'), $widget_ops);
		}
	 
		// Display Widget
		function widget($args, $instance) {
			extract($args);
			$title = esc_attr($instance['title']);
	
			echo $before_widget.$before_title.$title.$after_title;
	
				sfstst_onerandom();
	
			echo $after_widget;
		}
	 
		// When Widget Control Form Is Posted
		function update($new_instance, $old_instance) {
			if (!isset($new_instance['submit'])) {
				return false;
			}
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			return $instance;
		}
	 
		// DIsplay Widget Control Form
		function form($instance) {
			global $wpdb;
			$instance = wp_parse_args((array) $instance, array('title' => __('Testimonials', 'wp-testimonials')));
			$title = esc_attr($instance['title']);
	?>
	 
	 
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'wp-testimonials'); ?>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label>
	 
	<input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
	<?php
		}
	}
	 
	### Function: Init WP-Testimonials  Widget
	add_action('widgets_init', 'widget_sfstst_init');
	function widget_sfstst_init() {
		register_widget('sfstst_widget');
	}
} else { // this is an older WP so use old widget structure
	function widget_sfststwidget($args) {
		extract($args);
	?>
			<?php echo $before_widget; ?>
				<?php echo $before_title
					. 'Testimonial'
					. $after_title; ?>
			 <?php sfstst_onerandom(); ?>
			<?php echo $after_widget; ?>
	<?php
	}
	add_action('plugins_loaded', 'sfstst_sidebarWidgetInit');
	function sfstst_sidebarWidgetInit()
	{
		register_sidebar_widget('Testimonials', 'widget_sfststwidget');
	}
}



// +---------------------------------------------------------------------------+
// | Configuration options for testimonials                                    |
// +---------------------------------------------------------------------------+

function sfstst_options_page() {
?>
	<div class="wrap">
	<?php if ($_REQUEST['updated']=='true') { ?>
	<div id="message" class="updated fade"><p><strong>Settings Updated</strong></p></div>
	<?php  } ?>

	<h2>Testimonials Settings</h2>
	<?php echo '<p align="right">Need help? <a href="/' . PLUGINDIR . '/wp-testimonials/docs/documentation.php" target="_blank">documentation</a> &nbsp;|&nbsp; <a href="http://www.sunfrogservices.com/web-programming/wp-testimonials/">support page</a></p>'; ?>
	<form method="post" action="options.php">
	<?php wp_nonce_field('update-options'); ?>
	<?php settings_fields( 'sfstst-option-group' ); ?>
	
	<table cellpadding="5" cellspacing="5">

	<tr valign="top">
	<td>Minimum user level to manage testimonials</td>
	<td>
	<?php if (get_option('sfs_admng') == 'update_plugins') { ?>
	<input type="radio" name="sfs_admng" value="update_plugins" checked /> Administrator
	<?php } else { ?>
	<input type="radio" name="sfs_admng" value="update_plugins" /> Administrator
	<?php } ?>	
	<?php if (get_option('sfs_admng') == 'edit_pages') { ?>
	<input type="radio" name="sfs_admng" value="edit_pages" checked /> Editor
	<?php } else { ?>
	<input type="radio" name="sfs_admng" value="edit_pages" /> Editor
	<?php } ?>
	<?php if (get_option('sfs_admng') == 'publish_posts') { ?>
	<input type="radio" name="sfs_admng" value="publish_posts" checked /> Author
	<?php } else { ?>
	<input type="radio" name="sfs_admng" value="publish_posts" /> Author
	<?php } ?>
	</td>
	</tr>

	<tr valign="top">
	<td>Show link in sidebar to full page of testimonials</td>
	<td>
	<?php $sfs_showlink = get_option('sfs_showlink'); 
	if ($sfs_showlink == 'yes') { ?>
	<input type="checkbox" name="sfs_showlink" value="yes" checked />
	<?php } else { ?>
	<input type="checkbox" name="sfs_showlink" value="yes" />
	<?php } ?>
	</td>
	</tr>
	
	<tr valign="top">
	<td>Text for sidebar link (Read More, View All, etc)</td>
	<td><input type="text" name="sfs_linktext" value="<?php echo get_option('sfs_linktext'); ?>" /></td>
	</tr>

	<tr valign="top">
	<td>Number of testimonials to show in sidebar</td>
	<td><input type="text" name="sfs_setlimit" value="<?php echo get_option('sfs_setlimit'); ?>" /></td>
	</tr>

	<tr valign="top">
	<td>Testimonials page for sidebar link<br/> (use shortcode [sfs-testimonials])</td>
	<td> <select name="sfs_linkurl">
	 <option value="">
<?php echo attribute_escape(__('Select page')); ?></option> 
 <?php 
  $pages = get_pages(); 
  foreach ($pages as $pagg) {
  $pagurl = get_page_link($pagg->ID);
  $sfturl = get_option('sfs_linkurl');
  	if ($pagurl == $sfturl) {
		$option = '<option value="'.get_page_link($pagg->ID).'" selected>';
		$option .= $pagg->post_title;
		$option .= '</option>';
		echo $option;
	} else {
		$option = '<option value="'.get_page_link($pagg->ID).'">';
		$option .= $pagg->post_title;
		$option .= '</option>';
		echo $option;	
	}
  }
 ?>	</select></td>
	</tr>

	<tr valign="top">
	<td>Sort testimonials on page by</td>
	<td>
	<?php if (get_option('sfs_sorder') == 'testid ASC') { ?>
	<input type="radio" name="sfs_sorder" value="testid ASC" checked /> Order entered, oldest first
	<?php } else { ?>
	<input type="radio" name="sfs_sorder" value="testid ASC" /> Order entered, oldest first
	<?php } ?><br/>	
	<?php if (get_option('sfs_sorder') == 'testid DESC') { ?>
	<input type="radio" name="sfs_sorder" value="testid DESC" checked /> Order entered, newest first
	<?php } else { ?>
	<input type="radio" name="sfs_sorder" value="testid DESC" /> Order entered, newest first
	<?php } ?><br/>
	<?php if (get_option('sfs_sorder') == 'storder ASC') { ?>
	<input type="radio" name="sfs_sorder" value="storder ASC" checked /> User defined sort order
	<?php } else { ?>
	<input type="radio" name="sfs_sorder" value="storder ASC" /> User defined sort order
	<?php } ?>
	</td>
	</tr>

	<tr valign="top">
	<td>Use class alignleft or alignright for testimonial image</td>
	<td>
	<?php $sfs_imgalign = get_option('sfs_imgalign'); 
	if ($sfs_imgalign == 'alignleft') { ?>
	<input type="radio" name="sfs_imgalign" value="alignleft" checked /> Left 
	<input type="radio" name="sfs_imgalign" value="alignright" /> Right
	<?php } elseif ($sfs_imgalign == 'alignright') { ?>
	<input type="radio" name="sfs_imgalign" value="alignleft" /> Left
	<input type="radio" name="sfs_imgalign" value="alignright" checked/> Right
	<?php } else { ?>
	<input type="radio" name="sfs_imgalign" value="alignleft" /> Left
	<input type="radio" name="sfs_imgalign" value="alignright" /> Right
	<?php } ?>
	</td>
	</tr>

	<tr valign="top">
	<td>Maximum height (in pixels) for image</td>
	<td><input type="text" name="sfs_imgmax" value="<?php echo get_option('sfs_imgmax'); ?>" /> (if left blank images will show full size)</td>
	</tr>
	
	<tr valign="top">
	<td>Remove table when deactivating plugin</td>
	<td>
	<?php $sfs_deldata = get_option('sfs_deldata'); 
	if ($sfs_deldata == 'yes') { ?>
	<input type="checkbox" name="sfs_deldata" value="yes" checked /> (this will result in all data being deleted!)
	<?php } else { ?>
	<input type="checkbox" name="sfs_deldata" value="yes" /> (this will result in all data being deleted!)
	<?php } ?>
	</td>
	</tr>
	
	</table>
	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="sfs_admng,sfs_showlink,sfs_linktext,sfs_setlimit,sfs_linkurl,sfs_sorder,sfs_imgalign,sfs_imgmax,sfs_deldata" />
	
	<p class="submit">
	<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
	</p>
	
	</form>
	
	</div>
<?php 
}


// +---------------------------------------------------------------------------+
// | Uninstall plugin                                                          |
// +---------------------------------------------------------------------------+

function sfstst_deactivate () {
	global $wpdb;

	$table_name = $wpdb->prefix . "testimonials";

	$sfs_deldata = get_option('sfs_deldata');
	if ($sfs_deldata == 'yes') {
		$wpdb->query("DROP TABLE {$table_name}");
		delete_option("sfs_showlink");
		delete_option("sfs_linktext");
		delete_option("sfs_linkurl");
		delete_option("sfs_deldata");
		delete_option("sfs_setlimit");
		delete_option("sfs_admng");
		delete_option("sfs_sorder");
		delete_option("sfs_imgalign");
		delete_option("sfs_imgmax");
 	}
    delete_option("sfstst_version");
	unregister_sfstst_options();

}

// +---------------------------------------------------------------------------+
// | Show testimonials on page with shortcode [sfs-testimonials]               |
// +---------------------------------------------------------------------------+


/* show page of all testimonials */
function sfstst_showall() {
global $wpdb;

	$sfimgalign = get_option('sfs_imgalign');
	if ($sfimgalign == '') { $sfs_imgalign = 'alignright'; } else { $sfs_imgalign = get_option('sfs_imgalign'); }

	$sfs_sorder = (get_option('sfs_sorder'));
	if ($sfs_sorder != 'testid ASC' AND $sfs_sorder != 'testid DESC' AND $sfs_sorder != 'storder ASC')
	{ $sfs_sorder2 = 'testid ASC'; } else { $sfs_sorder2 = $sfs_sorder; }
	
	$table_name = $wpdb->prefix . "testimonials";
	$tstpage = $wpdb->get_results("SELECT testid,clientname,company,text_full,homepage,sfimgurl FROM $table_name WHERE text_full !='' ORDER BY $sfs_sorder2");
	$retvalo = '';
	$retvalo .= '';
	$retvalo .= '<div id="sfstest-page">';
	foreach ($tstpage as $tstpage2) {
		if ($tstpage2->text_full != '') { // don't show blank testimonials

			$retvalo .= '<blockquote>';
			$retvalo .= '<p>';
			if ($tstpage2->sfimgurl != '') { // check for image
				$sfs_imgmax = get_option('sfs_imgmax');
				if ($sfs_imgmax == '') { $sfiheight = ''; } else { $sfiheight = ' height="'.get_option('sfs_imgmax').'"'; }
				$retvalo .= '<img src="'.$tstpage2->sfimgurl.'"'.$sfiheight.' class="'.$sfs_imgalign.'" alt="'.stripslashes($tstpage2->clientname).'">';
			}

			$retvalo .= nl2br(stripslashes($tstpage2->text_full));
			$retvalo .= '</p>';

				$retvalo .= '<p><cite>';
				if ($tstpage2->company != '') {
				$retvalo .= stripslashes($tstpage2->clientname).'<br/>';
					if ($tstpage2->homepage != '') {
							$retvalo .= '<a href="'.$tstpage2->homepage.'" class="cite-link">'.stripslashes($tstpage2->company).'</a>';
					} else {
						$retvalo .= stripslashes($tstpage2->company).'';
					}
				} else {
					$retvalo .= stripslashes($tstpage2->clientname).'';
				}
				$retvalo .= '</cite></p>';
		$retvalo .= '</blockquote>';

		}
	}
	$retvalo .= '</div>';
return $retvalo;
}

?>