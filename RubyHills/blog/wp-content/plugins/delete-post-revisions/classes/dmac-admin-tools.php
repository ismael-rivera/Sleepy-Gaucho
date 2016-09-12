<?php
if ( !class_exists( 'DMAC_Admin_Tools_1_0_00' ) ) :
/**
 * DMAC Admin Tools
 * 
 * @version 1.0.00
 * @author Donal MacArthur
 * @copyright Copyright (c) 2011, Donal MacArthur
 * @link http://donalmacarthur.com/
 */
class DMAC_Admin_Tools_1_0_00 {

	/**
	 * PHP4 constructor method. This provides backwards compatibility for users with setups
	 * on older versions of PHP. Once WordPress no longer supports PHP4, this method will be removed.
	 *
	 * @since 1.0.00
	 * @param string $prefix The theme or plugin prefix
	 */
	function DMAC_Admin_Tools_1_0_00( $prefix = 'dmac' ) {
		$this->__construct( $prefix );
	}

	/**
	 * Constructor method for the DMAC_Admin_Tools class.  
	 * 
	 * @since 1.0.00
	 * @param string $prefix The theme or plugin prefix
	 */
	function __construct( $prefix = 'dmac' ) {
		$this->prefix = $prefix;
	}
	
	/**
	 * Build a text box.
	 *
	 * @since 1.0.00
	 * @param string $optionName The name of the option set
	 * @param array $element Configuration array for the textbox element
	 * @param string $savedValue The saved value for the option drawn from the database
	 * @return string $textbox
	 */
	function text( $optionName, $element, $savedValue = '' ) {
	
		if ( $optionName )
			$name = $optionName . "[{$element['id']}]";
		else
			$name = $element['id'];
			
		$class    = $element['class'];
		
		$disabled = isset( $element['enabled'] ) ? disabled( 0, $element['enabled'], false ) : '';
		
		$text = "<input type='text' name='{$name}' class='text {$class}' value='{$savedValue}'" . $disabled . " />";
	
		return $text;
	}
		
	/**
	 * Build a checkbox.
	 *
	 * @since 1.0.00
	 * @param string $optionName The name of the option set
	 * @param array $element Configuration array for the textbox element
	 * @param string $savedValue The saved value for the option drawn from the database
	 * @return string $checkbox
	 */
	function checkbox( $optionName, $element, $savedValue = 0 ) {
	
		if ( $optionName )
			$name = $optionName . "[{$element['id']}]";
		else
			$name = $element['id'];

		$id       = $element['id'];
		$label    = $element['label'];
		
		$disabled = isset( $element['enabled'] ) ? disabled( 0, $element['enabled'], false ) : '';
		$checked  = checked( 1, $savedValue, false );
		
		$checkbox  = "<input type='checkbox' name='{$name}' id='{$id}' value='1'" . $checked . $disabled . " />";
		$checkbox .= "<label for='{$id}'>{$label}</label>";
	
		return $checkbox;
	}
	
	/**
	 * Build a dropdown list.
	 * 
	 * @since 1.0.00
	 * @param string $optionName The name of the option set
	 * @param array $element Configuration array for the textbox element
	 * @param string $savedValue The saved value for the option drawn from the database
	 * @return string $select
	 */
	function select( $optionName, $element, $savedValue = '' ) {
	
		if ( $optionName )
			$name = $optionName . "[{$element['id']}]";
		else
			$name = $element['id'];

		$id       = $element['id'];
		$class    = $element['class'];
		
		$disabled = isset( $element['enabled'] ) ? disabled( 0, $element['enabled'], false ) : '';
		
		$select = "<select name='{$name}' class='{$class}'" . $disabled . ">\n";
		
			foreach ( $element['options'] as $name => $value ) {
				$selected = selected( $value, $savedValue, false );
				$select .= "<option value=\"{$value}\"" . $selected . ">{$name}</option>\n";
			}
		
		$select .= "</select>\n";
		
		return $select;
	}
	
	/**
	 * Build a dropdown list of pages.
	 * 
	 * @since 1.0.00
	 * @param string $optionName The name of the option set
	 * @param array $element Configuration array for the option element
	 * @param string $savedValue The saved value for the option drawn from the database
	 * @return string $pages
	 */
	function pages( $optionName, $element, $savedValue = '' ) {
	
		if ( $optionName )
			$name = $optionName . "[{$element['id']}]";
		else
			$name = $element['id'];

		$class    = $element['class'];
		
		$args = $element['options'];
		
		$args['echo'] = false;
		$args['name'] = $name;
		$args['selected'] = $savedValue;
		
		$attributes = "select class='{$class}'";
		
		$pages = wp_dropdown_pages( $args );
		
		$pages = str_replace( 'select', $attributes, $pages );
		
		return $pages;
	}
	
	/**
	 * Build a dropdown list of categories.
	 * 
	 * @since 1.0.00
	 * @param string $optionName The name of the option set
	 * @param array $element Configuration array for the option element
	 * @param string $savedValue The saved value for the option drawn from the database
	 * @return string $categories
	 */
	function categories( $optionName, $element, $savedValue = '' ) {
	
		if ( $optionName )
			$name = $optionName . "[{$element['id']}]";
		else
			$name = $element['id'];

		$class    = $element['class'];
		
		$args = $element['options'];
		
		$args['echo'] = false;
		$args['name'] = $name;
		$args['selected'] = $savedValue;
		
		$attributes = "select class='{$class}'";
		
		$categories = wp_dropdown_categories( $args );
		
		$categories = str_replace( 'select', $attributes, $categories );
		
		return $categories;
	}
	
	/**
	 * Build a radio button.
	 * 
	 * @since 1.0.00
	 * @param string $optionName The name of the option set
	 * @param array $element Configuration array for the textbox element
	 * @param string $savedValue The saved value for the option drawn from the database
	 * @return string $radio
	 */
	function radio( $optionName, $element, $savedValue = '' ) {
	
		if ( $optionName )
			$name = $optionName . "[{$element['id']}]";
		else
			$name = $element['id'];

		$id       = $element['button-id'];
		$value    = $element['value'];
		$label    = $element['label'];

		$disabled = isset( $element['enabled'] ) ? disabled( 0, $element['enabled'], false ) : '';
		$checked  = checked( $element['value'], $savedValue, false );
	
		$radio  = "<input type='radio' name='{$name}' id='{$id}' value='{$value}'" . $checked . $disabled . " />";
		$radio .= "<label for='{$id}'>{$label}</label>";
		
		return $radio;
	}
	
	/**
	 * Build a textarea.
	 * 
	 * @since 1.0.00
	 * @param string $optionName The name of the option set
	 * @param array $element Configuration array for the textbox element
	 * @param string $savedValue The saved value for the option drawn from the database
	 * @return string $textarea
	 */
	function textarea( $optionName, $element, $savedValue = '' ) {
	
		if ( $optionName )
			$name = $optionName . "[{$element['id']}]";
		else
			$name = $element['id'];

		$class    = $element['class'];
		
		$disabled = isset( $element['enabled'] ) ? disabled( 0, $element['enabled'], false ) : '';
		
		$textarea = "<textarea name='{$name}' class='{$class}'" . $disabled . ">{$savedValue}</textarea>\n";
	
		return $textarea;
	}

	/**
	 * Build an info element.
	 *
	 * @since 1.0.00
	 * @param string $optionName The name of the option set
	 * @param array $element Configuration array for the element
	 * @param string $savedValue Not applicable in this case
	 * @return string $output
	 */
	function info( $optionName, $element, $savedValue = '' ) {
	
		$output = $element['content'];
		
		return $output;
	}

	/**
	 * Build a hidden input element.
	 *
	 * @since 1.0.00
	 * @param string $optionName The name of the option set
	 * @param array $element Configuration array for the textbox element
	 * @param string $savedValue The saved value for the option drawn from the database
	 * @return string $textbox
	 */
	function hidden( $optionName, $element, $savedValue = '' ) {
	
		if ( $optionName )
			$name = $optionName . "[{$element['id']}]";
		else
			$name = $element['id'];
		
		$hidden = "<input type='hidden' name='{$name}' value='{$savedValue}' />";
	
		return $hidden;
	}

	/**
	 * Build options table.
	 * 
	 * This is the framework's standard option building function. 
	 * We pass it an array of option elements. It loops through the array, determines
	 * the appropriate function to use to produce each option element based on the option's type,
	 * then calls that function and passes it the necessary values.
	 *
	 * @since 1.0.00
	 * @param string $optionName The name of the option set
	 * @param array $optionElements Array of option elements
	 * @param array $savedValues Array of saved or default values for the options
	 * @param bool $echo True to echo, false to return
	 * @param bool $table True to add opening and closing <table> tags
	 * @return string $output
	 */
	function build_option_table( $optionName, $optionElements, $savedValues = array(), $echo = true, $table = true ) {
	
		$standardElements = array( 'text', 'checkbox', 'select', 'radio', 'textarea', 'info', 'pages', 'categories' );
		$output = '';
	
		/* Build a table to hold the options. */
		if ( $table )
			$output .= "<table class='form-table'>\n";
			
			/* Loop through the options array and add a row to the table for each option. */
			foreach ( $optionElements as $element ) {
			
				$type = $element['type'];
				$savedValue = isset( $element['id'] ) && isset( $savedValues[$element['id']] ) ? $savedValues[$element['id']] : '';
				$function =  $this->prefix . '_' . $type . '_option';
				
				/* If the element is one of our standard types, call the standard row function. */
				if ( in_array( $type, $standardElements ) )
					$output .= $this->standard_option_row( $optionName, $element, $savedValue );
			
				/* Else, if the class contains a custom method for dealing with the element type, call it. */
				elseif ( method_exists( $this, $type ) )
					$output .= $this->$type( $optionName, $element, $savedValue );
				
				/* Else, look outside the class for a function dealing with this specific element type. */
				elseif ( function_exists( $function ) )
					$output .= $function( $optionName, $element, $savedValue );
			}

		/* End the table. */
		if ( $table )
			$output .= "</table><!-- end .form-table -->\n";
		
		/* Print or return the output. */
		if ( $echo )
			echo $output;
		else
			return $output;
	}
	
	/**
	 * Build an option table row for a standard form element.
	 *
	 * @since 1.0.00
	 * @param string $optionName The name of the option set
	 * @param array $element Configuration array for the element
	 * @param string $savedValue The saved value for the option drawn from the database
	 * @return string $output
	 */
	function standard_option_row( $optionName, $element, $savedValue = '' ) {
	
		$output = "<tr>\n";
		
		/* If the option has a title, print it. */
		if ( isset( $element['title'] ) && $element['title'] ) {
			$output .= "<td class='title'>{$element['title']}</td>\n";
			$colspan = '';
		}
		else {
			$colspan = " class='title' colspan='2'";
		}
		// Note: We need to add class='title' to the colspan='2' declaration above
		// to work around a table width bug in IE8. The colspan='2' cell needs to have
		// the same width assigned to it as the actual title cells or it makes a mess
		// of all the cells' alignment when any of the other cells have a fixed width. 
	
		/* The option's type gives us the method name to call to build the form element. */
		$method = $element['type'];
	
		/* Get the form element. */
		$formElement = $this->$method( $optionName, $element, $savedValue );
		
		/* If the element has a description, add it. */
		if ( isset( $element['desc'] ) && $element['desc'] )
			$formElement .= "<span class='dmac-description'></br>{$element['desc']}</span>";
	
		/* Add the form element to the row. */
		$output .= "<td{$colspan}>{$formElement}</td>\n";
		
		/* End the row and return the output. */
		$output .= "</tr>\n";
		return $output;
	}
	
	/**
	 * Build an option box - a container for a set of related options.
	 *
	 * This function acts as a wrapper for the build_options_table() method above. It wraps
	 * each set of options passed to it in standard markup for styling purposes.
	 *
	 * @since 1.0.00
	 */
	function build_option_box( $optionName, $optionElements, $savedValues = array(), $addButton = true ) {

		/* Extract a title and ID for the option box from the first element of the options array. */
		$title = $optionElements['section-heading']['title'];
		$id = $optionElements['section-heading']['id'];
		
		/* Get the options table. */
		$content = $this->build_option_table( $optionName, $optionElements, $savedValues, false );
		
		/* Build a WordPress-style postbox to hold the options. */
		echo "<div class='postbox {$id} fixedbox'>\n";
			echo "<div class='handlediv' title='Click to toggle'><br /></div>\n";
			echo "<h3 class='hndle'><span>{$title}</span></h3>\n";
			echo "<div class='inside dmac-postbox'>\n";
				echo $content;
				
				/* Are we adding a submit button? */
				if ( $addButton )
					echo "<p class='submit minor {$id}'><input type='submit' value='Save Changes' /></p>\n";
					
			echo "</div>\n";
		echo "</div>\n";
	
	}
	
	/**
	 * Build a WordPress-style postbox.
	 *
	 * @since 1.0.00
	 */
	function build_postbox( $id, $title, $content ) {
	
		echo "<div class='postbox {$id} fixedbox'>\n";
			echo "<div class='handlediv' title='Click to toggle'><br /></div>\n";
			echo "<h3 class='hndle'><span>{$title}</span></h3>\n";
			echo "<div class='inside dmac-postbox'>\n";
				echo $content;
			echo "</div>\n";
		echo "</div>\n";
	}
	
	/**
	 * Print the standard 'Like This Plugin?' side box content.
	 * 
	 * @since 1.0.00
	 * @param array $data array of plugin links
	 * @return string $out the formatted sidebox content
	 */		
	function like_box_content( $data ) {
	
		/* Wrap the postbox content in a .dmac-postbox div for styling purposes. */
		$out = "<div class='dmac-postbox'>\n";
			$out .= "<table class='form-table'>\n";
				$out .= "<tr><td>If you like this plugin, why not do any or all of the following:</td></tr>\n";
				$out .= "<tr><td><ul>\n";
					$out .= "<li><a href='{$data['homepage-link']}'>Link to it so other people can find it.</a></li>\n";
					$out .= "<li><a href='{$data['wp-repo-link']}'>Give it a 5-star rating on WordPress.</a></li>\n";
					$out .= "<li><a href='{$data['donate-link']}'>Show your appreciation by making a donation.</a></li>\n";
				$out .= "</ul></td></tr>\n";
			$out .= "</table>\n";
		$out .= "</div>\n";
		
		return $out;
	}
	
	/**
	 * Print the standard 'Need Support?' side box content.
	 * 
	 * @since 1.0.00
	 * @param array $data array of plugin links
	 * @return string $out the formatted sidebox content
	 */
	function support_box_content( $data ) {
	
		/* Wrap the postbox content in a .dmac-postbox div for styling purposes. */
		$out = "<div class='dmac-postbox'>\n";
			$out .= "<table class='form-table'>\n";
				$out .= "<tr><td>If you have any problems with this plugin or ideas for improvements or new features, please post about them on the WordPress <a href='{$data['wp-forum-link']}'>support forums</a> or the plugin's <a href='{$data['homepage-link']}'>homepage</a>.</td></tr>\n";
			$out .= "</table>\n";
		$out .= "</div>\n";
		
		return $out;
	}
	
	/**
	 * Print the standard 'Make A Donation' side box content.
	 * 
	 * @since 1.0.00
	 * @param string $form PayPal donation form
	 * @return string $out the formatted sidebox content
	 */		
	function donate_box_content( $form ) {
	
		/* Wrap the postbox content in a .dmac-postbox div for styling purposes. */
		$out = "<div class='dmac-postbox'>\n";
			$out .= "<table class='form-table'>\n";
				$out .= "<tr><td>Building and maintaining this plugin has cost me countless hours of work. If you like it, why not donate a token of your appreciation!</td></tr>\n";
				$out .= "<tr><td style='text-align: center;'>{$form}</td></tr>\n";
			$out .= "</table>\n";
		$out .= "</div>\n";
		
		return $out;
	}
	
	/**
	 * Print content for a generic sidebox.
	 * 
	 * @since 1.0.00
	 * @param array|string $content the raw content for the sidebox
	 * @return string $out the formatted sidebox content
	 */		
	function side_box_content( $content ) {
	
		/* Wrap the postbox content in a .dmac-postbox div for styling purposes. */
		$out = "<div class='dmac-postbox'>\n";
			$out .= "<table class='form-table'>\n";
			
				/* If our input is an array... */
				if ( is_array( $content ) ) {
					foreach ( $content as $line )
						$out .= "<tr><td>{$line}</td></tr>\n";
				}
			
				/* Else, assume it's a string. */
				else 
					$out .= "<tr><td>{$content}</td></tr>\n";
					
			$out .= "</table>\n";
		$out .= "</div>\n";
		
		return $out;
	}
}
endif;