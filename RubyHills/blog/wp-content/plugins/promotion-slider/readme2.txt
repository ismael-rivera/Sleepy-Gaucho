Promotion Slider

Promotion Slider is a jQuery slideshow populated by the promotions you enter into the WordPress admin area.

    Description
    Installation
    FAQ
    Screenshots
    Changelog
    Stats

How do I insert the Promotion Slider?

You can insert the Promotion Slider by pasting the shortcode [promoslider] into the content area of a page or post. Be sure to use the HTML editor when inserting shortcodes! Also, be aware that if you don't have any published promotions, the slider will not appear. To customize your slider, there are optional attributes that can be used with the shortcode.
What are the optional attributes that can be used with the shortcode?

There are several attributes that are supported by the [promoslider] shortcode:

    id - You can assign a promotion slider its own HTML id attribute so you can easily customize the CSS for a particular instance of the slider. Example: [promoslider id="my_id"]
    width - Set the width of the carousel to fit your needs. By default, the width of the slider will automatically fit the space it is given. You can define the width using pixels or a percentage. Example: [promoslider width="600px"] OR [promoslider width="90%"]
    height - Set the height of the carousel to fit your needs. By default the height of the slider is 235px. It is best to define the height of the slider using pixels. Example: [promoslider height="300px"]
    post_type - You can display any post type in the slider, including custom post types. Most users will probably just use the built-in 'promotion' post type and the default WordPress 'post' post type. The 'promotion' post type is default, so you would only need to specify this if you want to display your standard WordPress blog posts. Example: [promoslider post_type="post"]
    category - You can choose to display only posts from a particular category, regardless of which post type you are pulling from. Please note that if a category doesn't exist, all posts will show in the slider. If there are no posts in an existing category, the slider will not show at all when using this attribute. Example: [promoslider category="my_category"]
    numberposts - The numberposts attribute allows you to set the number of posts to display in the slider. The default is -1 and will show all available posts. Example: [promoslider numberposts="3"]
    start_on - This attribute allows you to set which slide the slider starts on when the page loads. This attribute accepts the values 'random' and 'first'. Example: [promoslider start_on="first"]
    auto_advance - The auto advance attribute allows you to override the site-wide settings and either allow or disallow the automatic advancement of slides. This attribute accepts two values: auto_advance and no_auto_advance. All sliders will auto advance by default. Example: [promoslider auto_advance="false"]
    time_delay - You can set the time delay from the options page, but this shortcode attribute allows you to override any site-wide settings and set the time delay for an individual slider. If the time delay is less than 3 seconds or more than 15 seconds, the time delay will default to 6 seconds. Be sure that you only use an integer when setting this value. Example: [promoslider time_delay="10"]
    display_nav - You can choose whether or not to display the slider navigation and, if so, what it should look like. The shortcode value overrides any settings on the options page. Accepted values include: none, default, fancy, links and thumb. Example: [promoslider display_nav="links"]
    display_title - You can choose whether or not to display the title and, if so, what it should look like. The shortcode value overrides any settings on the options page. Accepted values include: none, default, fancy. Example: [promoslider display_title="default"]
    display_excerpt - You can choose whether or not to display the excerpt. The shortcode value overrides any settings on the options page. Accepted values include: none, excerpt. Example: [promoslider display_excerpt="excerpt"]
    pause_on_hover - This attribute allows you to pause the slider when the mouse is over it. Accepted values include: pause, no_pause. Example [promoslider pause_on_hover="pause"]

You can combine all of these attributes together as needed. Example: [promoslider id="my_id" post_type="post" category="my_category" width="600px" height="300px" time_delay="8" numberposts="3" display_nav="thumb" pause_on_hover="pause"]
How do I create promotions?

Promotions can be created in the WordPress administration area by clicking on 'Promotions' in the navigation and then selecting 'Add New Promotion'.

You will be able to provide a title, content, category, and optonal URL, as well as a featured image. The featured image will be used in the slider, and the title and content that you create will display ONLY on the promotion page when a user clicks through from the slider image. You can enable the display of other content on the slider if desired. For detailed instructions, see 'How can I enable the display of additional content in the slider?'.

Images can be placed within the content area of the promotion without affecting the slider, and featured images will not display on the promotion pages. If you set the optional URL, the slider will link to that URL rather than the promotion page.

You can optionally create categories for your promotions by clicking on 'Promotions' in the navigation area and then selecting 'Categories'. You can create sliders that will only display certain categories using the shortcode attributes.
How can I enable the display of additional content in the slider?

You can enable the title and/or excerpt display from the slider options page. The 'Slider Options' page is under 'Promotions' in the left hand navigation in the WordPress admin area. You can also enable the display of the title and/or excerpt using the shortcode attributes.

Enabling the excerpt while the default slider navigation is active will result in some overlap of the two elements. I would recommend switching to the navigation links instead. You can also disable the slider navigation altogether from here if you wish.

Note: By using the 'id' attribute in the shortcode, you can assign all instances of the promotion slider a unique id. This will allow you to customize the look and feel of individual sliders by editing the css in your theme's stylesheet.

More advanced users might want to display extra content on one slider, but not on another. This can be done by using the id attribute available in the shortcode and using the action hooks to add custom functions. Here is an example:

    function my_slider_content($values){ extract($values); if( $id == 'my_unique_id' ){ add_action('promoslider_content', 'promoslider_display_title', 9); add_action('promoslider_content', 'promoslider_extra_content'); } } add_action('promoslider_content', 'my_slider_content'); function promoslider_extra_content(){ echo '<< INSERT CUSTOM CONTENT HERE >>'; }

How can I change the time delay between slides?

Just click on 'Promotions' in the WordPress admin area and select the 'Slider Options' page. You can change the default time delay for all your sliders from here. To change the time delay for just one instance of a slider, just use the shortcode attributes described previously.
What if I don't want the slides to automatically advance?

If you would rather not have the slides advance automatically, users can still browse through the promotions in the slider with the slider navigation. To disable the automatic advancement of slides, just click on 'Promotions' in the WordPress admin area and select the 'Slider Options' page. You can disable automatic slide advancement from here. To change the automatic advancement for just one instance of a slider, just use the shortcode attributes described previously.
What if I want to show the slider in my sidebar?

All you need to do is add a text widget to your sidebar and include the shortcode as described earlier. Most likely, you will need to adust the height of the slider in your sidebar by using the shortcode attribute. You may also want to use a more space-saving navigation option, or remove the slider navigation altogether.
What if I don't want to use the shortcode? Can I hardcode the slider into my theme?

Hardcoding the slider into your theme is just as simple as using the shortcode. All you do is insert the following line into your theme where you want the slider to appear:

    <?php echo do_shortcode('[promoslider]') ?>

If you want to use any of the shortcode attributes when hardcoding your theme, you may do so like this:

    <?php echo do_shortcode('[promoslider id="my_id" post_type="post" category="my_category"]'); ?>

Can I control the order in which the slides appear?

By default, the slides appear in order by publication date. You can change the order by changing the publish date for a promotion. This is the simplest way, but you can also use the more advanced method below.

We provide a filter which allows you to customize the get_posts() query. You can use any of the documented parameters in your query. Here is an example of how you could control the order:

    `function order_promotions_by_title($query){ $query['orderby'] = 'title'; $query['order'] = 'ASC'; return $query; } add_filter('promoslider_query', 'order_promotions_by_title');

How can I change the default linking behaviour for a slider panel?

When creating or editing a promotion, you can easily change the linking behaviour for that particular promotion from the meta box displayed below the content editing area. You can have the links open in a new window, define a custom destination URL and disable the links altogether.
How can I insert third party ad code into the slider?

You can easily insert ad code into the slider by using the meta box below the content editing area when creating or editing a promotion in the WordPress admin. There is a box where you can insert your third party code and a checkbox which will make it actively display for that particular promotion. We recommend only using this feature when you know the exact size of the ads that will appear.
What hooks do you provide in this plugin?

Here is a list of all the hooks available to advanced users:

    before_promoslider - This action hook is called just before each instance of the Promotion Slider within a wrapper div. The id of the slider is passed as an argument. The id will be null if it is not set for a particular slider.
    after_promoslider - This action hook is called just after each instance of the Promotion Slider within a wrapper div. The id of the slider is passed as an argument. The id will be null if it is not set for a particular slider.
    promoslider_content - This action hook is called within each panel in the Promotion Slider. We use this hook to populate the content in the slider, including the title, excerpt and image. The $values argument is available when using this hook and is an array containing the following variables: $id (the HTML id attribute for the current slider), $title (the post title), $excerpt (the post excerpt), $image(the HTML image element for the current post's featured image), $destination_url (the destination URL for the post), $target (the HTML anchor target attribute to be used with the destination URL), $disable_links (a boolean variable that is true when a user wishes to disable all links for a particular post), $display_title (a string indicating whether to show the title and, if so, which one), and $display_excerpt (a string indicating whether to show the excerpt or not). Reference the shortcode attributes for acceptable values for display_title and display_excerpt.
    promoslider_nav - This action hook is called after all the panels and before the closing div tag for the slider, but only if there is more than one panel and the thumbnail navigation is not being used. We use this hook to insert the slider navigation. $display_nav is passed as an argument. See the shortcode attribute for acceptable values.
    promoslider_thumbnail_nav - This action hook is called just before the 'before_promoslider' hook after the slider and before the closing wrapper div tag. We use this hook to insert the slider thumbnail navigation. Several values are passed as an array: $id(the HTML id attribute for the current slider), $title(the post title), $thumbs(a collection of thumbnails to be used for the navigation) and $width(used to match the thumbnail nav witdth to that of the slider).
    promoslider_query - This filter is applied to the get_posts() query for each slider before it is run. This hook can only be used to make changes to all the sliders on the site because the $query variable is all that is passed as an argument.
    promoslider_query_by_id - This filter is applied to the get_posts() query before it is run and after the promoslider_query filter. The argument passed to this filter is an associative array containg the query and id. You can use the PHP extract() function to easily gain access to the $query and $id variables. Be sure to return the $query within an associative array at the end of your filter. The purpose of this filter is to allow you to change the query for a slider with a particular id.
    promoslider_custom_query_results - This filter allows you to return the results object of your own custom query. The purpose of this filter is so users can bypass the get_posts() function and run more advanced custom queries.
    promoslider_image_size - This filter allows you to change the default image size in the slider. The default value is the string 'full'. The value passed through this filter is directly applied to the $size argument in the get_the_post_thumbnail() function. See the WordPress codex for more information on acceptable values and functionality.
    promoslider_image_size_by_id - This filter allows you to change the default image size in the slider based on the slider's id. This filter passes an associative array containing the $id and $image_size values. The $image_size must be returned within an associative array. The value passed through this filter is directly applied to the $size argument in the get_the_post_thumbnail() function. See the WordPress codex for more information on acceptable values and functionality.
    promoslider_thumb_size - This filter allows you to change the default thumbnail size used in the slider thumbnail navigation. The default value is the string 'thumbnail'. The value passed through this filter is directly applied to the $size argument in the get_the_post_thumbnail() function. See the WordPress codex for more information on acceptable values and functionality.
    promoslider_add_meta_to_save - This filter is applied to the data array prior to processing and saving the promotion meta data. It is designed for developers who need to save additional meta data to the promotion custom post type after having created a custom meta box. The $data variable is available when using this filter and contains an array of all the meta keys to be saved when a promotion is created or updated.

