<?php 
/**
 * Delete Post Revisions Backend Class
 * 
 * This class handles all the backend functionality for the plugin. It sets up
 * the plugin's page on the WordPress dashboard, handles the post deletion 
 * process, and displays the results. Instantiating this class initializes the 
 * plugin.
 *
 * @package Delete_Post_Revisions
 * @version 1.3
 * @author Donal MacArthur
 * @copyright Copyright (c) 2011, Cranes & Skyhooks
 * @link http://cranesandskyhooks.com/wordpress-plugins/delete-post-revisions/
 */
class Delete_Post_Revisions {

	/**
	 * Stores the page hook for the plugin's admin page.
	 *
	 * @var string
	 * @since 1.0
	 */
	var $pagehook;
	
	/**
	 * Stores a reference to an instance of the DMAC_Admin_Tools class.
	 *
	 * @var string
	 * @since 1.3
	 */
	var $admin_tools;
	
	/**
	 * PHP4 constructor method. This provides backwards compatibility for users with setups
	 * on older versions of PHP. Once WordPress no longer supports PHP4, this method will be removed.
	 *
	 * @since 1.0
	 */
	function Delete_Post_Revisions() {
		$this->__construct();
	}

	/**
	 * Constructor method for the Delete_Post_Revisions class.  
	 *
	 * @since 1.0
	 */
	function __construct() {

		/* Add support for two layout columns. */
		add_filter( 'screen_layout_columns', array( &$this, 'layout_columns' ), 10, 2 );

		/* Register the plugin's initialization function on the 'admin_menu' hook. */
		add_action( 'admin_menu', array( &$this, 'on_admin_menu' ) );
	}
	
	/**
	 * Required filter for dual column support.  
	 *
	 * @since 1.0
	 */
	function layout_columns ( $columns, $screen ) {
	
		if ($screen == $this->pagehook) {
			$columns[$this->pagehook] = 2;
		}
		return $columns;
	}
	
	/**
	 * Initialize the plugin's admin page. Called on the 'admin_menu' hook.
	 *
	 * @since 1.0
	 */
	function on_admin_menu() {
	
		/* Register the plugin's admin page. */
		$this->pagehook = add_submenu_page( 'tools.php', 'Delete Post Revisions', 'Delete Revisions', 'manage_options', 'delete-revisions', array( &$this, 'on_show_page' ) );
		
		/* Set up all the necessary page elements when the page loads. */
		add_action( 'load-' . $this->pagehook, array( &$this, 'on_load_page' ) );
	}
	
	/**
	 * Set up the admin page's elements. Fired if WordPress detects that the page is about to be rendered.
	 * 
	 * The add_meta_box call takes the format ($id, $title, $callback, $page, $context, $priority, $callback_args).
	 * Adding metaboxes at this point means they can be shown/hidden using the screen options tab.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_meta_box
	 * @since 1.0
	 */
	function on_load_page() {
	
		/* Instantiate the DMAC Admin Tools class. */
		$this->admin_tools = new DMAC_Admin_Tools_1_0_00();
		
		/* Load the bundled DMAC admin stylesheet. */
		wp_enqueue_style( 'dmac-admin-styles', trailingslashit( DPR_URL ) . 'styles/dmac-admin-styles.css' );

		/* Load the postbox scripts. */ 
		wp_enqueue_script('common');
		wp_enqueue_script('wp-lists');
		wp_enqueue_script('postbox');
	
		/* Print the postbox initialization functions to the page head. */ 
		add_action( 'admin_head-' . $this->pagehook, array( &$this, 'on_admin_head' ) );

		/* Register the page's metaboxes. */
		add_meta_box( 'delete-post-revisions', 'Instructions', array( &$this, 'delete_revisions_content' ), $this->pagehook, 'normal' );
		
		/* Register the page's side metaboxes. */
		add_meta_box( 'dmac-sidebox-like', 'Like This Plugin?', array( &$this, 'like_box_content' ), $this->pagehook, 'side' );
		add_meta_box( 'dmac-sidebox-donate', 'Make A Donation!', array( &$this, 'donate_box_content' ), $this->pagehook, 'side' );
		add_meta_box( 'dmac-sidebox-support', 'Need Support?', array( &$this, 'support_box_content' ), $this->pagehook, 'side' );
	}
	
	/**
	 * Print the postbox initialization scripts to the page head.
	 * 
	 * @since 1.0
	 */	
	function on_admin_head() {
?>
		<script type="text/javascript">
			//<![CDATA[
			jQuery(document).ready( function($) {
				// Close postboxes that should be closed.
				$('.if-js-closed').removeClass('if-js-closed').addClass('closed');
				// Set up postboxes.
				postboxes.add_postbox_toggles('<?php echo $this->pagehook; ?>');
			});
			//]]>
		</script>
<?php	
	}
	
	/**
	 * Print the plugin's admin page.
	 * 
	 * @since 1.0
	 */
	function on_show_page() {
	
		/* We need the global columns variable to enable dual column support. */
		global $screen_layout_columns;
	
		/* Check the user has permission to be on this page. */
		if ( !current_user_can( 'manage_options' ) )
			wp_die( __('You do not have sufficient permissions to access this page.') );
			
		/* Set up a page data array to pass to each meta box. */
		$data = array();
		$data['wp-repo-link']  = 'http://wordpress.org/extend/plugins/delete-post-revisions/';
		$data['wp-forum-link'] = 'http://wordpress.org/tags/delete-post-revisions';
		$data['donate-link']   = 'https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=HHSJFSHRKRKQS';
		$data['homepage-link'] = 'http://cranesandskyhooks.com/wordpress-plugins/delete-post-revisions/';
	
		/* Print the page header. */
		echo "<div class='wrap dmac delete-revisions'>\n";
			screen_icon();
			echo "<h2>Delete Post Revisions</h2>\n";
			
			/* Add metabox nonce fields. */
			wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false );
			wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false );
		
			/* Print the metabox container div. */
			$hasSidebar = $screen_layout_columns == 2 ? ' has-right-sidebar' : '';
			echo "<div id='poststuff' class='metabox-holder{$hasSidebar}'>\n";
		
				/* Print the sidebar metaboxes. */
				echo "<div id='side-info-column' class='inner-sidebar'>\n";
					do_meta_boxes( $this->pagehook, 'side', $data );
				echo "</div>\n";
		
				/* Print the main content metaboxes. */
				echo "<div id='post-body' class='has-sidebar'>\n";
					echo "<div id='post-body-content' class='has-sidebar-content'>\n";
					
						do_meta_boxes( $this->pagehook, 'normal', $data );
						
						/* If the delete button has been clicked, call the delete revisions function. */
						if ( isset( $_POST['dmac_delete_revisions'] ) && $_POST['dmac_delete_revisions'] )
							$this->delete_revisions();
						
					echo "</div>\n";
				echo "</div>\n";
		
			echo "</div><!-- end .metabox-holder -->\n";
	
		/* Print the page footer. */
		echo "</div>\n";
	}
	
	/**
	 * Print the content of the page's main postbox.
	 * 
	 * @since 1.0
	 */	
	function delete_revisions_content() {
	
		/* Wrap the postbox content in a .dmac-postbox div for styling purposes. */
		echo "<div class='dmac-postbox'>\n";
			echo "<form method='post' action=''>\n";
		
				/* Get the postbox content. */
				$content = $this->get_content();
				
				/* Print the postbox content. */
				$this->admin_tools->build_option_table( '', $content );
			
				/* Print a 'delete' button. */ 
				echo "<p style='margin: 10px 10px 20px; padding: 0;'><input type='submit' class='button' value='Delete Post Revisions' /></p>\n";
				echo "<input type='hidden' name='dmac_delete_revisions' value='true' />\n";
				wp_nonce_field( 'delete-revisions', 'nonce-delete-revisions' );
				
			echo "</form>\n";
		echo "</div>\n";
	}
	
	/**
	 * This function handles the actual deletion process.
	 *
	 * We get an array of revision posts from the database using get_posts().
	 * We loop through the array, print out some info for each post, then delete it
	 * using wp_delete_post().
	 * 
	 * @since 1.0
	 * @link http://codex.wordpress.org/Template_Tags/get_posts
	 * @link http://codex.wordpress.org/Function_Reference/wp_delete_post
	 */
	function delete_revisions() {
	
		/* Check the form nonce. */
		check_admin_referer( 'delete-revisions', 'nonce-delete-revisions' );
		
		/* Are we showing details? */
		$showDetails = isset( $_POST['dmac_show_details'] ) && $_POST['dmac_show_details'] ? true : false;
		
		/* Set up variables for our loop. */
		$details = array();
		$deleted = 0;
		
		/* Delete revisions from the database in blocks of 100. */
		do {
			$args = array( 
				'post_type'   => 'revision',
				'post_status' => 'any',
				'numberposts' => 100
			);
			$revisions = get_posts( $args );
			
			foreach ( $revisions as $revision ) {
				if ( $showDetails ) {
					$details[] = array(
						'id'    => $revision->ID,
						'title' => $revision->post_title,
						'date'  => $revision->post_modified
					);
				}
				wp_delete_post( $revision->ID, true );
				$deleted++;
			}
			$more = count( $revisions ) == 100 ? true : false;
		
		} while ( $more );
		
		/* If no revisions were found. */
		if ( $deleted == 0 ) {
			$content = "<table class='form-table'><tr><td><em>No revisions were found. Nothing has been deleted from the database.</em></td></tr></table>";
			$this->admin_tools->build_postbox( '', 'Results', $content );
		}
		
		/* Else, revisions have been deleted. Tell the user how many. */
		else {
		
			if ( $deleted == 1 ) 
				$text = '1 post revision has been deleted from the database.';
			else
				$text = $deleted . ' post revisions have been deleted from the database.';
				
			if ( $deleted > 10000 )
				$text .= ' Phewww!';
				
			if ( $showDetails )
				$text .= ' Details displayed below:';
		
			$content = "<table class='form-table'><tr><td>{$text}</td></tr></table>";
			$this->admin_tools->build_postbox( '', 'Results', $content );
		
			/* If we're showing details, build a table to display them. */
			if ( $showDetails ) {
			
				echo "<table class='widefat' style='margin-bottom: 20px;' cellspacing='0'>\n";
				
					echo "<thead>";
						echo "<tr>";
							echo "<th>No.</th>";
							echo "<th>ID</th>";
							echo "<th>Title</th>";
							echo "<th>Date Saved</th>";
						echo "</tr>";
					echo "</thead>";
					
					echo "<tfoot>";
						echo "<tr>";
							echo "<th>No.</th>";
							echo "<th>ID</th>";
							echo "<th>Title</th>";
							echo "<th>Date Saved</th>";
						echo "</tr>";
					echo "</tfoot>";
				
					$count = 0;
					foreach ( $details as $revision ) {
						$count++;
						$style = $count % 2 == 0 ? '': " style='background: #F9F9F9;'"; 
						echo "<tr{$style}>\n";
							echo '<td>' . $count . ".</td>\n";
							echo '<td>' . $revision['id'] . "</td>\n";
							echo '<td>' . $revision['title'] . "</td>\n";
							echo '<td>' . $revision['date'] . "</td>\n";
						echo "</tr>\n";
					}
				echo "</table>\n";
			}
		}
	}
	
	/**
	 * Returns the page's content as an array in standard Atlas format.
	 * 
	 * @since 1.0
	 * @return array
	 */	
	function get_content() {

		$content = array(
		
			array(
				'type' => 'info',
				'content' => "By default, whenever you update a post or page, WordPress saves a backup or 'revision' copy of the old page. There is no default limit to how many revisions are saved for each page, so these revision copies tend to build up over time, bloating your database unnecessarily. This simple tool cleans up your database by deleting all existing revisions." ),
				
			array(
				'type' => 'info',
				'content' => "<strong>Warning:</strong> The deletion process is irreversible. Once your revisions have been deleted, they're gone for good." ),
		
			array(
				'type' => 'info',
				'content' => "You should only need to run this plugin once, then you can deactivate and delete it. Deleting your existing revisions won't prevent them from building up again in future, but you can disable the revision feature or limit the number of revisions WordPress saves to a number of your choice by setting WordPress's <code>WP_POST_REVISIONS</code> constant. You can find full instructions on how to do this on the <a href='http://cranesandskyhooks.com/wordpress-plugins/delete-post-revisions/'>plugin's homepage</a>." ),
		
			array(
				'type' => 'info',
				'content' => "To begin the deletion process, simply click the button below. (Note: the process may take some time on large sites.)" ),
				
			array(
				'type' => 'checkbox',
				'title' => '',
				'id' => 'dmac_show_details',
				'desc' => '',
				'std' => 0,
				'label' => 'Check to show details - not recommended if your revisions number in the thousands.' ),
		);
		
		return $content;
	}
	
	/**
	 * Print the 'Like This Plugin?' side box content.
	 * 
	 * @since 1.0
	 */		
	function like_box_content( $data ) {
		echo $this->admin_tools->like_box_content( $data );
	}

	/**
	 * Print the 'Make A Donation' side box content.
	 * 
	 * @since 1.0
	 */		
	function donate_box_content() {
	
		$form = '<form action="https://www.paypal.com/cgi-bin/webscr" method="post"><input type="hidden" name="cmd" value="_s-xclick"><input type="hidden" name="hosted_button_id" value="HHSJFSHRKRKQS"><input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" style="max-width: 100%;"><img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1"></form>';

		echo $this->admin_tools->donate_box_content( $form );
	}

	/**
	 * Print the 'Need Support?' side box content.
	 * 
	 * @since 1.0
	 */		
	function support_box_content( $data ) {
	
		$content = array( "You can find full instructions on how to manage WordPress's post revision feature on the <a href='{$data['homepage-link']}'>plugin's homepage</a>.", "If you have any problems with this plugin or ideas for improvements or new features, please post about them on the WordPress <a href='{$data['wp-forum-link']}'>support forums</a>." );
	
		echo $this->admin_tools->side_box_content( $content );
	}
}