<?php
    global $blog_id;
    switch_to_blog( 1 );
?>
<div class="navbar-wrapper fixed-top">
    <div id="navbarCollapse">
        <nav class="navbar navbar-dark navbar-expand-md navbar-top-banner">
            <div class="navbar-container container">
                <?php
                    wp_nav_menu( array(
                        'theme_location'  => 'top_left_banner',
                        'depth'	          => 1, // 1 = no dropdowns, 2 = with dropdowns.
                        'container'       => 'div',
                        'container_class' => 'collapse navbar-collapse',
                        'container_id'    => 'navbarTopLeft',
                        'menu_class'      => 'navbar-nav',
                        'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                        'walker'          => new WP_Bootstrap_Navwalker(),
                    ) );
                ?>

                <?php
                    wp_nav_menu( array(
                        'theme_location'  => 'top_right_banner',
                        'depth'	          => 1, // 1 = no dropdowns, 2 = with dropdowns.
                        'container'       => 'div',
                        'container_class' => 'collapse navbar-collapse',
                        'container_id'    => 'navbarTopRight',
                        'menu_class'      => 'navbar-nav ml-auto',
                        'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                        'walker'          => new WP_Bootstrap_Navwalker(),
                    ) );
                ?>
            </div>   
        </nav>

        <nav class="navbar navbar-dark navbar-expand-md">       
            <div class="navbar-container container">       
                <a class="navbar-brand" href="<?php echo home_url(); ?>">DutchtownSTL.org</a>
            
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".collapse" aria-controls="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <?php
                wp_nav_menu( array(
                    'theme_location'  => 'primary',
                    'depth'	          => 2, // 1 = no dropdowns, 2 = with dropdowns.
                    'container'       => 'div',
                    'container_class' => 'collapse navbar-collapse',
                    'container_id'    => 'navbarPrimary',
                    'menu_class'      => 'navbar-nav ml-auto',
                    'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                    'walker'          => new WP_Bootstrap_Navwalker(),
                ) );
                ?>
            </div><!-- .navbar-container -->
        </nav>

        <?php 
            restore_current_blog();
            if ( $blog_id != 1 ) : 
        ?>

        <nav class="navbar navbar-dark navbar-expand-md navbar-subsite">
            <div class="navbar-container container">
                <?php
                    wp_nav_menu( array(
                        'theme_location'  => 'subsite_menu',
                        'depth'	          => 2, // 1 = no dropdowns, 2 = with dropdowns.
                        'container'       => 'div',
                        'container_class' => 'collapse navbar-collapse',
                        'container_id'    => 'navbarSubsite',
                        'menu_class'      => 'navbar-nav',
                        'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                        'walker'          => new WP_Bootstrap_Navwalker(),
                    ) );
                ?>
            </div>   
        </nav>
        <?php endif; ?>
    </div>
</div>
