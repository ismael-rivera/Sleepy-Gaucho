<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 * We filter the output of wp_title() a bit -- see
	 * twentyten_filter_wp_title() in functions.php.
	 */
	wp_title( '|', true, 'right' );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link href="<?php //bloginfo('template_directory'); ?>/css/pagestyles.css" rel="stylesheet" type="text/css>

<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>
<div id="header_wrapper" class="shadowout">
    <div id="header">
            <a class="logo" href="<?php echo get_settings('home'); ?>">Home</a>
            <div id="session_menu"><?php displayMenu(3); ?></div>
            <div id="titlebar">
                <a class="title" href="<?php echo get_settings('home'); ?>"><?php bloginfo( 'name' ); ?></a><br />
                <h2><?php bloginfo( 'description' ); ?></h2>
            </div>
            <?php get_search_form(); ?>
                <div id="navbar">
                        <ul id="nav">
                        <?php
                            $howmany = 6;
                            
                            $pages = wp_list_pages("echo=0&title_li=");
                            
                            $pages_arr = explode("\n", $pages);
                            
                            for($i=0;$i<$howmany;$i++){
                                echo $pages_arr[$i];
                            }
                        ?>
                        </ul>
                </div>
                    
    </div>
    
</div>        