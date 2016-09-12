=== WP-Testimonials ===
Contributors: sunfrog
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7279865
Tags: widget, pages, testimonials
Requires at least: 2.7
Tested up to: 3.0.1
Stable tag: 3.4.1

Displays client testimonials in WordPress

== Description ==

The plugin includes the option to display a random testimonial in your sidebar using PHP code or the built-in widget. 

Testimonials can also be displayed all on one page.  Simply put [sfs-testimonials] in the body of the page.

Be sure to read the included documentation for style and configuration help.

== Installation ==

* Upload the entire wp-testimonials folder to your plugins directory
* Activate testimonials from the plugin page

== Frequently Asked Questions ==

= How do I display the testimonials in the sidebar? =

Use the built-in widget to display a random testimonial.  Or
use the following if you prefer to hand code the PHP:

`<?php sfstst_onerandom(); ?>`

Be sure to remove this code from your template if you disable the plugin 
so your site doesn't throw ugly errors at you.

NOTE: You must have text in the short text field in order for the testimonial to appear on the page.

= How do I show all my testimonials on a page? =

To show all testimonials on a single page:

1. Create a new page
2. Put [sfs-testimonials] in the body text
3. Publish

NOTE: You must have text in the full text field in order for the testimonial to appear on the page.

== Screenshots ==

1. Configuration page for testimonials

== ChangeLog ==

= 3.4.1 =
* Bug fixes

= 3.4 =
* Update for compatibility with WordPress 3.0
* Bug fix for shortcode
* Formatting updates to public pages for HTML5 compliance
* Removed option to open client site in new window (for HTML5 compliance)

= 3.3 =
* Added ability to include image (shows only on page, not in sidebar)
* Added default settings to wp_options on install or upgrade from version prior to 3.3
* Modified edit testimonials form to use labels
* Removed obsolete code from style sheet
* Added settings link to plugins page
* Bug fixes when saving settings

= 3.2 =
* Added charset to table creation

= 3.1 =
* Minor bug fix to correct blank sort order on edit

= 3.0 =
* Modified HTML to use blockquote and cite for formatting
* Added option to set number of random testimonials in sidebar
* Added ability to give access to non-administrators
* Added option to sort page by user defined sort order

= 2.2 =
* Corrected shortcode output

= 2.1 =
* Added backwards compatibility for WP2.7 and higher
* Option to have client website open in new window

= 2.0 =
* Compatibility with WP2.8 and higher
* Random block now pulls testimonial via "ORDER BY RAND" for true random order
* Removed obsolete field in table "views"
* Pages/posts can now be created using shortcode [sfs-testimonials] (eliminates the need for a custom theme page)
* Added "read more" link to random sidebar block
* Added configuration options to show/hide "read more" link in sidebar with customizable text
* Added options to delete table upon deactivation

== Support ==

If you need help, visit the WP-Testimonials support page at:
http://www.sunfrogservices.com/web-programmer/wp-testimonials/

Version 3.4.1, Released 2010-08-19
Copyright (C) 2007-2010 Jodi Diehl - http://www.sunfrogservices.com/

== Acknowledgements ==

* Thank you to Wouter from http://www.allwebsites.be for his XHTML contributions