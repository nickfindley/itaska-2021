<?php
add_action( 'wp_head', 'dutchtown_fonts' );

function dutchtown_fonts()
{
    $font_path = get_template_directory_uri() . '/dist/fonts/';
    $woff2_fonts = array(
        array(
            'handle' => 'avenir-light',
            'url' => $font_path . 'avenir/Light.woff2'
        ),
        // array(
        //     'handle' => 'avenir-light-italic',
        //     'url' => $font_path . 'avenir/LightIt.woff2'
        // ),
        // array(
        //     'handle' => 'avenir-light-condensed',
        //     'url' => $font_path . 'avenir/LightCn.woff2'
        // ),
        array(
            'handle' => 'avenir-regular',
            'url' => $font_path . 'avenir/Regular.woff2'
        ),
        // array(
        //     'handle' => 'avenir-regular-italic',
        //     'url' => $font_path . 'avenir/It.woff2'
        // ),
        array(
            'handle' => 'avenir-bold',
            'url' => $font_path . 'avenir/Bold.woff2'
        ),
        // array(
        //     'handle' => 'avenir-bold-italic',
        //     'url' => $font_path . 'avenir/BoldIt.woff2'
        // ),
        // array(
        //     'handle' => 'fa-brands',
        //     'url' => $font_path . 'fontawesome/fa-brands-400.woff2'
        // ),
        // array(
        //     'handle' => 'fa-solid',
        //     'url' => $font_path . 'fontawesome/fa-solid-900.woff2'
        // )
    );

    foreach ( $woff2_fonts as $font ) :
        echo '<link rel="preload" as="font" type="font/woff2" crossorigin="anonymous" href="' . $font['url'] . '" id="' . $font['handle'] . '">' . "\n\t";
    endforeach;
}