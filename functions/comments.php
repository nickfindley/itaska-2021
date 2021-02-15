<?php
if ( ! function_exists ( 'dutchtown_get_comment_count' ) ) :
	/**
	 * Returns the number of comments as a word or phrase.
	 * Default output: '[number] comments'
	 * Options:
	 * 	$show_zero: echo the string even if there are no comments
	 * 	$term_singular: the word for one comment (reply, response, etc.)
	 *	$term_plural: the word for multiple comments (replies, responses, etc.)
	 * 	$cap: capitalize the first letter of the string, default false
	 *	$there: include 'there is/there are' before the number
	 *	$phrase: return a phrase ('one comment') or just the number ('one')
	 *	$max: the highest number to convert to a word
	 *	$before: text/HTML to echo before the phrase
	 *	$before: text/HTML to echo after the phrase
	 */
	
	function dutchtown_get_comment_count( $args = array() )
	{
		$defaults = array(
			'show_zero'		=> false,
			'term_singular'	=> 'comment',
			'term_plural'	=> 'comments',
			'cap'			=> false,
			'there'			=> false,
			'phrase'		=> true,
			'max'			=> 20,
			'before_output'	=> '',
			'after_output'	=> '',
			'before_phrase'	=> '',
			'after_phrase'	=> ''
		);

		$args = wp_parse_args( $args, $defaults );

		$count = get_comments_number();

		if ( $count == 1 )
		{
			$count_print = 'one';
			$count_phrase = 'one ' . $args['term_singular'];
			$count_there = 'there is';
		}
		else if ( $count == 0 || $count > 1 && $count <= $args['max'] )
		{	
			require get_template_directory() . '/functions/numbers-to-words.php';
			$nw = new NumbersToWords();
			$count_print = $nw->convert($count);
			$count_phrase = $count_print . ' ' . $args['term_plural'];
			$count_there = 'there are';
		}
		else
		{
			$count_print = $count;
			$count_phrase = $count . ' ' . $args['term_plural'];
			$count_there = 'there are';
		}

		if ( $args['phrase'] == true )
		{
			$output = $args['before_phrase'] . $count_phrase . $args['after_phrase'];
		}
		else
		{
			$output = $args['before_phrase'] . $count_print . $args['after_phrase'];
		}

		if ( $args['there'] == true )
		{
			$output = $count_there . ' ' . $output;
		}

		if ( $args['cap'] == true )
		{
			$stripped = strip_tags( $output );
			$capped = ucfirst( $stripped );
			$output = str_replace( $stripped, $capped, $output );
		}

		if ( $count > 0 )
		{
			return $args['before_output'] . $output . $args['after_output'];
		}
		else if ( $count == 0 )
		{
			if ( $args['show_zero'] == true && comments_open() )
			{
				return $args['before_output'] . $output . $args['after_output'];
			}
		}
		else
		{
			return;
		}
	}
endif;

if ( ! function_exists ( 'dutchtown_comment_count' ) ) :
	function dutchtown_comment_count( $args = array() )
	{
		echo dutchtown_get_comment_count( $args );
	}
endif;

if ( ! function_exists( 'dutchtown_get_comment_link_args' ) ) :
	function dutchtown_get_comment_link_args( $args = array() )
	{	
		$defaults = array(
			'before_list'	=> '',
			'after_list'	=> '',
			'before_form'	=> '',
			'after_form'	=> '',
			'list_or_form'	=> 'both',
			'separator'		=> '',
			'list_output'	=> '',
			'form_output'	=> '',
			'count_args'	=> array(
				'show_zero'		=> false,
				'term_singular'	=> 'comment',
				'term_plural'	=> 'comments',
				'cap'			=> true,
				'there'			=> false,
				'phrase'		=> true,
				'max'			=> 20,
				'before_output'	=> '',
				'after_output'	=> '',
				'before_phrase'	=> '<a href="' . get_the_permalink() . '#comments">',
				'after_phrase'	=> '</a>'
			)
		);

		$args = array_replace_recursive( $defaults, $args );
		return $args;
	}
endif;

if ( ! function_exists( 'dutchtown_get_comment_link' ) ) :
	function dutchtown_get_comment_link ( $args = array() )
	{
		$count = get_comments_number();
        $args = dutchtown_get_comment_link_args( $args );

        $list_output = '';
        $form_output = '';

		if ( $count > 0 || $args['count_args']['show_zero'] == true )
		{			
			$list_link = dutchtown_get_comment_count( $args['count_args'] );
			$list_output = $args['before_list'] . $list_link . $args['after_list'];
        }

        if ( comments_open() )
        {
            $form_link = '<a href="' . get_the_permalink() . '#leave-comment">Leave a comment</a>';
            $form_output = $args['before_form'] . $form_link . $args['after_form'];
        }

        if ( $args['list_or_form'] == 'both' )
        {
            $output = $list_output . $args['separator'] . $form_output;
        }
        else if ( $args['list_or_form'] == 'list' )
        {
            $output = $list_output;
        }
        else if ( $args['list_or_form'] == 'form' )
        {
            $output = $form_output;
        }

        return $output;
	}
endif;

if ( ! function_exists ( 'dutchtown_comment_link' ) ) :
	function dutchtown_comment_link( $args )
	{
		echo dutchtown_get_comment_link( $args );
	}
endif;

//  http://justintadlock.com/archives/2016/11/16/designing-better-nested-comments
//  Create a link to the parent comment.
if ( ! function_exists ( 'dutchtown_comment_parent_link' ) ) :
    function dutchtown_comment_parent_link( $args = array() ) 
    {

        echo dutchtown_get_comment_parent_link( $args );
    }
endif;

if ( ! function_exists( 'dutchtown_get_comment_parent_link' ) ) :
    function dutchtown_get_comment_parent_link( $args = array() )
    {

        $link = '';

        $defaults = array(
            'text'   => '%s', // Defaults to comment author.
            'depth'  => 2,    // At what level should the link show.
            'before' => '',   // String to output before link.
            'after'  => ''    // String to output after link.
        );

        $args = wp_parse_args( $args, $defaults );

        if ( $args['depth'] <= $GLOBALS['comment_depth'] ) {

            $parent = get_comment()->comment_parent;

            if ( 0 < $parent ) {

                $url  = esc_url( get_comment_link( $parent ) );
                $text = sprintf( $args['text'], get_comment_author( $parent ) );

                $link = sprintf( '%s<a class="comment-parent-link" href="%s">%s</a>%s', $args['before'], $url, $text, $args['after'] );
            }
        }

        return $link;
    }
endif;

//  Custom comment walker to output comments in <dl> tags
//	https://gist.github.com/georgiecel/9445357

class Dutchtown_Walker_Comment extends Walker_Comment
{
	var $tree_type = 'comment';
	var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );
 
	// constructor – wrapper for the comments list
	function __construct()
	{
		?><dl class="comments-list"><?php
	}

	// start_lvl – wrapper for child comments list
	function start_lvl( &$output, $depth = 0, $args = array() )
	{
		$GLOBALS['comment_depth'] = $depth + 2;
		
		?><dl class="comments-child"><?php
	}
	
	// end_lvl – closing wrapper for child comments list
	function end_lvl( &$output, $depth = 0, $args = array() )
	{
		$GLOBALS['comment_depth'] = $depth + 2;

		?></dl><?php
	}

	// start_el – HTML for comment template
	function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 )
	{
		$depth++;
		$GLOBALS['comment_depth'] = $depth;
		$GLOBALS['comment'] = $comment;
		$parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' ); 

		if ( 'article' == $args['style'] )
		{
			$tag = 'dl';
			$add_below = 'comment';
		}
		else
		{
			$tag = 'dl';
			$add_below = 'comment';
		} ?>

		<dt <?php comment_class(empty( $args['has_children'] ) ? '' :'parent') ?> id="comment-<?php comment_ID() ?>" itemprop="comment" itemscope itemtype="http://schema.org/Comment">
			<i class="fas fa-fw fa-comment fa-flip-horizontal"></i> <a class="comment-author-link" href="<?php comment_author_url(); ?>" itemprop="author"><?php comment_author(); ?></a> on <time class="comment-meta-item" datetime="<?php comment_date('Y-m-d') ?>T<?php comment_time('H:iP') ?>" itemprop="datePublished"><a href="#comment-<?php comment_ID() ?>" itemprop="url" class="comment-permalink" title="Permanent link to this comment"><?php comment_date('F jS, Y \a\t g:ia') ?></a></time>
            <?php edit_comment_link( __( '(Edit this comment)', 'dutchtown' ) ); ?>
            <?php dutchtown_comment_parent_link( array('before' => '<br><i class="fas fa-fw fa-reply fa-flip-horizontal fa-flip-vertical reply-icon"></i> ', 'text' => 'In reply to %s&apos;s comment') ); ?>
		</dt>
		<dd class="comment-content post-content" itemprop="text">
            <?php if ($comment->comment_approved == '0') : ?>
				<p class="comment-awaiting-moderation">This comment is awaiting moderation.</p>
            <?php else: ?>
			<?php comment_text(); ?>
			<p class="comment-reply-link-p"><?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'before' => '<i class="fas fa-reply reply-icon"></i> ', 'reply_text' => 'Reply to this comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?></p>
            <?php endif;
	}

	// end_el – closing HTML for comment template
	function end_el(&$output, $comment, $depth = 0, $args = array() )
	{
		?></dd><?php
	}

	// destructor – closing wrapper for the comments list
	function __destruct()
	{
		?></dl><?php
	}
}
?>