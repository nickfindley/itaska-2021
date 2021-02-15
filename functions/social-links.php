<?php
function dutchtown_popup( $height = '400', $width = '600' )
{
    $onclick = 'javascript:window.open(this.href,\'\', \'';
    $onclick .= 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,';
    $onclick .= 'height=' . $height;
    $onclick .= ',width=' . $width;
    $onclick .= '\');return false;';

    return $onclick;
}

function dutchtown_facebook_href()
{
    $href = 'https://www.facebook.com/sharer/sharer.php?u=';
    $href .= urlencode( get_the_permalink() );
    $href .= '&amp;t=';
    $href .= urlencode( get_the_title() );

    return $href;
}

function dutchtown_facebook_anchor()
{
    $anchor = '<a href="' . dutchtown_facebook_href() . '" onclick="' . dutchtown_popup( '300' ) . '" target="_blank" rel="noopener">';
    $anchor .= 'Facebook</a>';

    return $anchor;
}

function dutchtown_facebook_icon()
{
    $link = '<a href="' . dutchtown_facebook_href() . '" title="Share on Facebook.">';
    $link .= '<i class="fab fa-fw fa-facebook-square"></i>';
    $link .= '<span class="sr-only">Share on Facebook</span>';
    $link .= '</a>';

    return $link;
}

function dutchtown_facebook_header_link()
{
    $link = '<i class="fab fa-fw fa-facebook-square"></i>';
    $link .= '<span class="post-meta-expanded">Share on </span>';
    $link .= dutchtown_facebook_anchor();

    return $link;
}

function dutchtown_facebook_footer_link()
{
    $link = dutchtown_facebook_anchor();

    return $link;
}

function dutchtown_twitter_href()
{
    $href = 'http://twitter.com/share?text=';
    $href .= urlencode('Read "' . get_the_title() . '" on DutchtownSTL.org: ');
    $href .= '&amp;url=' . urlencode( get_the_permalink() );

    return $href;
}

function dutchtown_twitter_anchor()
{
    $anchor = '<a href="' . dutchtown_twitter_href() . '" onclick="' . dutchtown_popup() . '" target="_blank" rel="noopener">';
    $anchor .= 'Twitter</a>';

    return $anchor;
}

function dutchtown_twitter_icon()
{
    $link = '<a href="' . dutchtown_twitter_href() . '" title="Share on Twitter.">';
    $link .= '<i class="fab fa-fw fa-twitter"></i>';
    $link .= '<span class="sr-only">Share on Twitter</span>';
    $link .= '</a>';

    return $link;
}

function dutchtown_twitter_header_link()
{
    $link = '<i class="fab fa-fw fa-twitter"></i>';
    $link .= '<span class="post-meta-expanded">Tweet on </span>';
    $link .= dutchtown_twitter_anchor();

    return $link;
}

function dutchtown_twitter_footer_link()
{
    $link = dutchtown_twitter_anchor();

    return $link;
}

function dutchtown_mailto_href()
{
    $href = 'mailto:?subject=';
    $href .= urlencode( get_the_title() );
    $href .= '&amp;body=';
    $href .= urlencode( 'Take a look at what I found on DutchtownSTL.org:' );
    $href .= '%0a%0d';
    $href .= urlencode( get_the_title() );
    $href .= '%0a';
    $href .= urlencode( get_the_permalink() );

    return $href;
}

function dutchtown_mailto_anchor()
{
    $anchor = '<a href="' . dutchtown_mailto_href() . '" onclick="' . dutchtown_popup() .'" target="_blank" rel="noopener">';
    $anchor .= 'Email</a>';

    return $anchor;
}

function dutchtown_mailto_icon()
{
    $link = '<a href="' . dutchtown_mailto_href() . '" title="Share via email.">';
    $link .= '<i class="fas fa-fw fa-envelope"></i>';
    $link .= '<span class="sr-only">Share via email</span>';
    $link .= '</a>';

    return $link;
}

function dutchtown_mailto_header_link()
{
    $link = '<i class="fas fa-fw fa-envelope"></i>';
    $link .= '<span class="post-meta-expanded">Send via </span>';
    $link .= dutchtown_mailto_anchor();

    return $link;
}

function dutchtown_mailto_footer_link()
{
    $link = dutchtown_mailto_anchor();

    return $link;
}

function dutchtown_header_social_links()
{
    echo '<li>' . dutchtown_facebook_header_link() . '</li>';
    echo '<li>' . dutchtown_twitter_header_link() . '</li>';
    echo '<li>' . dutchtown_mailto_header_link() . '</li>';
}

function dutchtown_footer_social_links( $text = 'Share this post on' )
{
    echo $text .  ' ';
    echo dutchtown_facebook_footer_link() . ', ';
    echo dutchtown_twitter_footer_link() . ', or via ';
    echo dutchtown_mailto_footer_link() . '. ';
}

function dutchtown_icon_social_links()
{
    echo '<li class="icon-link">' . dutchtown_facebook_icon() . '</li>';
    echo '<li class="icon-link">' . dutchtown_twitter_icon() . '</li>';
    echo '<li class="icon-link">' . dutchtown_mailto_icon() . '</li>';
}
?>