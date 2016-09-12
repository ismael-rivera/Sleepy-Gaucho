<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>WP-Testimonials Documentation</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<h2>Managing Testimonials</h2>
<p>Testimonials can be added/edited/deleted under the <a href="../../../../wp-admin/admin.php?page=sfstst_manage">Testimonials</a> menu.
  Images are optional and will display only on the page (not in the sidebar).
  If you do not set a minimum height on the settings page the image will display
  full size. You may use an image uploaded through WordPress or reference a URL
  from anywhere on the Internet.</p>
<h2>Settings</h2>
<p>You can manage several options for the testimonials through the <a href="../../../../wp-admin/admin.php?page=tsfstst_config">Settings</a> menu.  </p>
  <ol>
    <li><strong>Set minimum user leve</strong>l - this allows you the option of allowing editors
      or authors access to your testimonials management page</li>
    <li><strong>Show &quot;more&quot; link in sidebar</strong> - this
      option will insert a link below the  testimonial in the sidebar that will
      take visitors to the
      full page of testimonials. </li>
    <li><strong>Text for &quot;more&quot; link</strong> - enter what text you want to appear as the hyperlink
      to your full page of testimonials</li>
    <li><strong>Number to show in sidebar</strong> - how many random testimonials should be displayed
      in the sidebar</li>
    <li><strong>Testimonials page</strong> - select the page where you have the shortcode (see
      below) for displaying all of your testimonials</li>
    <li><strong>Sort</strong> - select which method to use when displaying the full page of testimonials</li>
    <li><strong>Image alignment</strong> - select if images should be aligned left or right within
      the testimonial</li>
    <li><strong>Remove table</strong> - this will delete all plugin-related data when deactivating
      the plugin (use with caution)</li>
  </ol>
  <p>NOTE: you must create a new page for testimonials (see below) to use the
  &quot;more&quot; and &quot;page&quot; options above</p>
  <h2>Show all testimonials in page</h2>
  <ol>
    <li>Create a new page</li>
    <li>Enter [sfs-testimonials] in the body content</li>
    <li>Publish</li>
  </ol>
<h2>Sidebar display of random testimonial</h2>
    <p>To add the random testimonial block to your sidebar, you can hard code
      the PHP or use the built-in widget. To activate the widget, go to Appearance,
      Widgets and drag the &quot;Testimonials&quot; widget
    to the sidebar where you want the testimonial block to appear.</p>
    <p>&lt;?php sfstst_onerandom(); ?&gt;</p>
    <p>Be sure to remove this code from your template if you disable the plugin so your site doesn't throw ugly errors at you.</p>
<h2>Style &amp; Layout</h2>
<p>Testimonials are displayed using blockquote and cite formatting. You can control
  how the testimonials look by adding code to your theme style sheet.
  Modifying core plugin files is not recommended as they will be overwritten
  with future updates. </p>
<p>To control the look of the testimonials, place the following code in your
  theme CSS and modify to suit your needs (sfstest-sidebar controls the formatting
  in the widget and sfstest-page handles the formatting on your page):</p>
<p>/* CSS for testimonials */<br>
  #sfstest-sidebar blockquote {  padding: 2px; }<br>
  #sfstest-sidebar cite { font-style:
italic; }<br>
#sfstest-page blockquote { padding: 10px; }<br>
#sfstest-page cite { font-style: italic;
}<br>
#sfstest-sidebar .sfststreadmore { 	text-align: center; margin-top: 5px; }</p>
<p>The plugin assumes you have .alignright and .alignleft already in your style
sheet. If you do not, add the following and adjust as necessary:</p>
<p>#sfstest-page .align-right { float:right; margin: 0 0 5px 5px; }<br>
  #sfstest-page .align-left { float:left; margin: 0 5px 5px 0; }</p>
<h2>Support</h2>
<p>If you need help, visit the
  WP-Testimonials support page at: <a href="http://www.sunfrogservices.com/web-programmer/wp-testimonials/">http://www.sunfrogservices.com/web-programmer/wp-testimonials/</a></p>
</div>
<?php 
$yearnow = date('Y');
if($yearnow == "2007") {
    $yearcright = "";
} else { 
    $yearcright = "2007-";
}
?>
	  <p>WP-Testimonials is &copy; Copyright <?php echo("".$yearcright."".date('Y').""); ?>, <a href="http://www.sunfrogservices.com/" target="_blank">Jodi
	      Diehl</a> and distributed under the <a href="http://www.fsf.org/licensing/licenses/quick-guide-gplv3.html" target="_blank">GNU
	      General Public License</a>. 
	  If you find this plugin useful, please consider a <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7279865" target="_blank">donation</a>.</p>
</body>
</html>