=== WordPress Menu Creator ===
Contributors: The UltimateIDX, Jared Ritchey and Dan Loughmiller
Donate link: http://www.ultimateidx.com/
Tags: wordpress menu, menu manager, xhtml, css menu, drop down menu, cascading menu, menu tool, active link, OpenCube, Widget Assignment
Requires at least: 2.7+
Tested up to: 2.8.4
Stable tag: 1.1.7

WordPress Menu Creator ( Menu Manager ) was developed to provide a website owners with a truly easy to manage easy to configure menu solution.

== Description ==
`WIDGET SUPPORT AND WIDGET ASSIGNMENT HAS BEEN ADDED THIS RELEASE` 
The UltimateIDX Presents, WP Menu Creator for WordPress Menu Management at its best. Developed originally for the theme developer, new features make this release a little more friendly for casual users. This plugin provides blog website owners with a truly easy to manage easy to configure menu solution for WordPress or WordPress CMS sites. In this release you can now assign menus to pages, posts, categories, tags and tag slugs, similar to popular CMS solutions like Joomla or Drupal.  With this Menu Manager you can configure your menus with images, position, rank, level and literally any number of a dozen different baseline formats of common menu design today.

Tested with version 2.8.4 and WordPress MU, the menu manager can support literally dozens of menus on your blog with THOUSANDS of design possibilities. The menu items can be linked to blog posts, blog pages, internal content and even external links all of which can be displayed in any order you wish them to be displayed in.

The Menu Creator supports menu types from suckerfish cascading menus to nearly any type of WordPress theme menu that is compatible with unordered lists. Since the menus and menu items are each generated with a unique CSS ID and Class, you have infinite options for styling your menus to match your themes design. The Menu Creator has been ported to work with commercial solutions such as the OpenCube menu system. The generated output for all menu items have been tested and validated to be SEO, XHTML and CSS compliant and meet all accessibility and compliance guidelines. `Look at the FAQ tab above to answer some common questions we encounter.`

> For Theme Developers, please visit UltimateIDX.com for details on how to distribute this plugin with your WordPress themes FREELY and Without Additional License Requirements. We can provide you easy to include PHP code to make your distribution of the plugin exceptionally easy.

== Installation ==
1. Extract the `wp-menu-creator.zip` to your local system prior to upload.
1. Upload `wp-menu-creator` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugin Panel' in WordPress
1. While in the WordPress admin panel, simply navigate to the Menu Creator by clicking on the tab for "Manage".
1. Once you create your menu, you want to take the menu ID which is displayed in the list to the left and add it to a template tag as follows `<?php displayMenu(1, 2); ?>` The first number is the menu ID number and the second number is the number of levels to potentially display. This would produce the kind of results for making a cascading menu. You can however exclude the number of levels if your menu is a single group of unordered list itmes as follows; `<?php displayMenu(1); ?>` What this will produce is a single unordered list of links for you to style.
1. Place the following code between the <head></head> section of your template header.php file. <script type="text/javascript" src="<?php echo get_option('home'); ?>/wp-content/plugins/wp-menu-creator/external.js"></script>

== Frequently Asked Questions ==
1. It doesnt work with my theme. Now what?
*The Menu Creator can work with any known theme currently on the market that we have encountered. Granted, we did not try to copy or emulate every possible CSS solution available, but by following some of the tutorials on the UltimateIDX website you can see how almost any theme can be used with relative ease.
1. Why doesnt your menu plugin provide actual css markup for the menus?
*There are way to many possible options for creating menus that we opted to not include examples within the actual plugin due to concern that some people may conclude this plugin to be limited to just those examples. The fact is this tool is capable of literally thousands of menu styles. The documentation and support forum site is your best option for code examples*
1. Will this work with the SuckerFish style menu from HTML Dog or A-List-Apart?
*Yes its been tested all the way to three sub levels!*
1. Will this work with commercial menu products like the BrotherCake or OpenCube menus?
*We have tested with both and we maintain a separate build for the OpenCube menu system which is available however we usually ask that people contact our forum for details becaues it can be tricky*
1. Will this work in WordPress Multi User?
*Yes, we have this very plugin installed on Real Estate sites where there are literally dozens of Realtor agent blogs.*
1. *Are there any special settings I should be aware of?*
*Yes there are a few very important ones, the first is that the plugin can be modified to prevent people from deleting menus which is ideal for using it in a WordPress MU type setting and the menu creator requires a theme that is either Widget enabled or follows good WordPress theme heirarchy. There are video tutorials you can examine to help with configuration by visiting [UltimateIDX](http://www.ultimateidx.com/menu-manager/ "UltimateIDX Instructional Videos")*
1. Are there any linkback requirements?
*Linkback Requirements and posts about the product are certainly appreciated but by no means required. With all of our plugins we do not add link back features by default either. :-)*
1. Can I distribute this plugin with my themes (commercial or gpl)?
*Yes, I have some code that will assist you in doing this so distribution will be much easier for your projects.*


== Screenshots ==
1. `/tags/1.1.6/screenshot-1.jpg`
2. `/tags/1.1.6/screenshot-2.jpg`
3. `/tags/1.1.6/screenshot-3.jpg`
4. `/tags/1.1.6/screenshot-4.jpg`
5. `/tags/1.1.6/screenshot-5.jpg`
6. `/tags/1.1.6/screenshot-6.jpg`
7. `/tags/1.1.6/screenshot-7.jpg`

== Important Recent Updates This Release ==
1. WIDGET SUPPORT you can even assign the pages or posts the menus will show up on.
1. THESIS THEME IS NOW SUPPORTED. We use WIDGETS as well now.
1. Set menu links to open in new window using a fully XHTML Compliant method.
1. We have added image support so you can create menus that are image based.
1. Updated NOFOLLOW option for the REL option in your links. Now you can decide what the bots follow.
1. We added a new RSS feature that provides updates from the code snippet inventory as we update.
1. Easier to sort drag and drop menu positioning. The order you set is instantaneously updated on the front end.
1. options for adding REL=NOFOLLOW and making the links open in a new window or a combination of the two.


== Features In Next Release ==
1. Adding in the ability to import categories, pages and tags for menu generation.
1. Adding in the feature to allow you to edit css, header includes and other files.


== Additional Configuration Notes ==
Support forum is brand spaking new and is scheduled to be open for configuration helps and notes on Saturday May 16th

== Quick Start Guide ==
1. Determine where the menu will be located on your blog
1. Determine if your menu will be a single level or multi level menu.
1. Once you create the menu and your desired menu items, it is important to place the proper template tags in your template where the menu is to render.
1. Some addition you will need to add the code to the header section of your template for "external.js" if you intend on using the new XHTML Strict compliant method for opening a link in a new window.
1. As always additional and more detailed information is available on the UltimateIDX.com website.

== What Kind Of Menus Can I Use ==
* Menus are generated as un-ordered lists which can be single or multi level cascading and are fully XHTML CSS Compliant and we promise they will validate.
* jQuery and Mootools menu types certainly supported, as we have dozens of examples on client sites.
* Can support multiple menus per blog with no technical limitations as to how many, We have sites with as many as 22 menus.
* Can be used in conjunction with the OpenCube Menu Structure with some basic modification to the OpenCube JS code.
* Works with DynamicDrives JS menus with some simple modifications.
* Easily works with nearly any menu from our pal, the CSS Master himself, Eric Meyer!
* Works with the menus generated from our friends at http://www.cssmenumaker.com/
* Certainly works with those menus generated at http://13styles.com/
* At this point it works with any known SuckerFish style cascading menu code. The fact is, if its built on un-ordered lists, its supported.

WP Menu Creator can be used with [OpenCube Menus](http://www.opencube.com/ "OpenCube CSS / XHTML Menu Solution") which is a commercial product licensed on a per site bases.  The UltimateIDX has a developers license for OpenCube and can generate menus for projects upon request.

> `<?php displayMenu(1); // This would display menu ID 1 with no sub menu links ?>` <br /> `<?php displayMenu(1, 2); // This would display up to 2 levels of menu links for the menu ID 1 ?>`  `<script type="text/javascript" src='<?php echo get_option('home'); ?>/wp-content/plugins/wp-menu-creator/external.js'></script>`

> Example layouts and css can be found on the project(s) site located at UltimateIDX.com or by contacting us for technical support.

