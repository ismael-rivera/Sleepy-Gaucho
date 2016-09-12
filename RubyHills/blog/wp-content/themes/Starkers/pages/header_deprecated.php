<div id="header_wrapper" class="shadowout">
    <div id="header">
            <a class="logo" href="<?php echo get_settings('home'); ?>">Home</a>
            <div id="session_menu"><?php displayMenu(3); ?></div>
            <div id="titlebar">
                <a class="title" href="<?php echo get_settings('home'); ?>"><?php bloginfo( 'name' ); ?></a><br />
                <h2><?php bloginfo( 'description' ); ?></h2>
            </div>
            <div id="search"><?php //get_search_form(); ?></div>
                <div id="navbar">
                        <ul id="nav">
                        <?php
                            $howmany = 6; ?>
                            
                            <?php
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