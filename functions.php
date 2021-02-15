<?php
global $blog_id;

require get_template_directory() . '/functions/setup.php';
require get_template_directory() . '/functions/widgets-init.php';
require get_template_directory() . '/functions/scripts.php';

require get_template_directory() . '/functions/utilities/camel-case.php';
require get_template_directory() . '/functions/utilities/string-convert.php';

require get_template_directory() . '/functions/archive-title.php';
require get_template_directory() . '/functions/autoversion.php';
require get_template_directory() . '/functions/block-events.php';
require get_template_directory() . '/functions/body-classes.php';
require get_template_directory() . '/functions/bootstrap-navwalker.php';
require get_template_directory() . '/functions/broadcast.php';
require get_template_directory() . '/functions/comments.php';
require get_template_directory() . '/functions/chartjs.php';
require get_template_directory() . '/functions/excerpt.php';
require get_template_directory() . '/functions/fonts.php';
require get_template_directory() . '/functions/gravity-forms.php';
require get_template_directory() . '/functions/gravity-forms-bootstrap.php';
require get_template_directory() . '/functions/multisite-widgets.php';
require get_template_directory() . '/functions/numbers-to-words.php';
require get_template_directory() . '/functions/oxford-categories.php';
require get_template_directory() . '/functions/pagination.php';
require get_template_directory() . '/functions/paypal-donation.php';
require get_template_directory() . '/functions/places.php';
require get_template_directory() . '/functions/posted-date.php';
require get_template_directory() . '/functions/primary-term.php';
require get_template_directory() . '/functions/relevanssi.php';
require get_template_directory() . '/functions/relevanssi-hits-filter.php';
require get_template_directory() . '/functions/search-results.php';
require get_template_directory() . '/functions/site-notice.php';
require get_template_directory() . '/functions/social-links.php';
require get_template_directory() . '/functions/temp-table.php';
require get_template_directory() . '/functions/yoast.php';

require get_template_directory() . '/functions/acf/callout-box.php';
require get_template_directory() . '/functions/acf/category-image.php';
require get_template_directory() . '/functions/acf/div-open-close.php';
require get_template_directory() . '/functions/acf/front-page-posts.php';
require get_template_directory() . '/functions/acf/front-page-social.php';
require get_template_directory() . '/functions/acf/flora-block.php';
require get_template_directory() . '/functions/acf/masonry-block.php';
require get_template_directory() . '/functions/acf/member-card.php';
require get_template_directory() . '/functions/acf/options.php';
require get_template_directory() . '/functions/acf/poll.php';
require get_template_directory() . '/functions/acf/quick-contact.php';

require get_template_directory() . '/functions/polls/poll-cpt-taxonomy.php';
require get_template_directory() . '/functions/polls/poll-fields-acf.php';
require get_template_directory() . '/functions/polls/poll-form.php';
require get_template_directory() . '/functions/polls/poll-results.php';

if ( $blog_id == 1 ) :
    require get_template_directory() . '/functions/events-calendar.php';
endif;

// function content_test( $text )
// {
//     $find = 'neighborhood';
//     $replace = '<span class="notranslate">neighborhood</span>';
//     $text = str_replace( $find, $replace, $text );
//     return $text;
// }
// add_filter( 'the_content', 'content_test', 99 );