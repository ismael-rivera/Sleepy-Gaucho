=== GPP Testimonials Widgets ===
Plugin Name: GPP Testimonials Widget
Version: 1.2
Contributors: endortrails
Donate link: http://graphpaperpress.com
Tags: widget, widgets, hooks, custom, testimonial, quote, graphpaperpress
Requires at least: 3.0.4
Tested up to: 3.1
Stable tag: 1.2

Adds a new Testimonials widget to the Widgets panel.

== Description ==

Adds a new Testimonials widget to the Widgets panel.

== Installation ==

1. Extract the plugin folder from the zip download.
1. Upload `gpp-testimonials-widget` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the *Plugins* menu in WordPress.
3. Go to your *Widgets* panel and drag the Testimonial widget to a widgetized area.
4. To add a testimonial to a Post or Page, use the Add a Testimonial icon (blue quote icon) to add Testimonial shortcode to the editor.  It will throw the following shortcode to the editor.  The testimonial itself goes between the `[testimonial]` and `[testimonial]`.  In the end, it looks something like this:

`[testimonial name="John Doe" about="About John Doe section goes here" url="http://johndoe.com" image="http://johndoe.com/link-to-an-image.jpg"]This is where your testimonial goes.[/testimonial]`


== Screenshots ==

1. Testimonial display
2.  Widget fields

== Frequently Asked Questions ==

= This Widget doesn't fit in my sidebar or footer widget. How do I change that? =

You need to override the default CSS styles that come with this plugin.  Add this CSS to the bottom of your theme's style.css file and change them where you see fit.  The !important declaration is, well, important.  Don't delete those.

`.testimonials_widget { margin: 20px 0 !important; }
.testimonials_widget h2 { padding:30px 100px !important; margin: 20px 0 0 !important; background: transparent url(img/quote.png) no-repeat top left !important }
.testimonials_widget h2, .testimonials_widget .about { font-family: Cambria, Georgia, Times, "Times New Roman", serif !important; font-style: italic !important; }
.testimonials_widget .bio { width: 50% !important; margin: 0 auto !important}
.testimonials_widget img {}
.testimonials_widget .name { display:block !important; font-size: 16px !important; font-weight: bold !important; text-align: right !important; padding-right: 100px !important; min-width: 90px !important; min-height: 67px !important; background: transparent url(img/quote-end.png) no-repeat bottom right !important; }
.testimonials_widget .link {}`

= Why create this plugin? =

Many users don't understand how to use action hooks from a child theme.  PHP might not be their thing.  I wanted these users to be able to easily take advantage of some more advanced WordPress features without having to learn how to code.

== Changelog ==

**Version 1.2.1**
* CSS spacing fix

**Version 1.2**
* Added shortcode for adding Testimonials to Posts and Pages

**Version 1.1**
* Added styling for widget if in #sidebar or #footer

**Version 1.0**
* Plugin launch

== Upgrade Notice ==
* No notices at this time *