<?php
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
remove_action( 'wp_head', 'wp_generator' );


/* WIDGETS AREAS */

if ( function_exists('register_sidebar') )
register_sidebar(array(
	'name' => 'sidebar',
	'before_widget' => '<div class="row rightBox">',
	'after_widget' => '</div>',
	'before_title' => '<span class="widget_title">',
	'after_title' => '</span>',
));

register_sidebar(array(
	'name' => 'footer',
	'before_widget' => '<div class="boxFooter">',
	'after_widget' => '</div>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
));

/* PAGINATION */

function emm_paginate($args = null) {
	$defaults = array(
		'page' => null, 'pages' => null,
		'range' => 2, 'gap' => 2, 'anchor' => 1,
		'before' => '<ul class="pager">', 'after' => '</ul>',
		'title' => __('Pages:'),
		'nextpage' => __('&raquo;'), 'previouspage' => __('&laquo'),
		'echo' => 1
	);

	$r = wp_parse_args($args, $defaults);
	extract($r, EXTR_SKIP);

	if (!$page && !$pages) {
		global $wp_query;

		$page = get_query_var('paged');
		$page = !empty($page) ? intval($page) : 1;

		$posts_per_page = intval(get_query_var('posts_per_page'));
		$pages = intval(ceil($wp_query->found_posts / $posts_per_page));
	}

	$output = "";
	if ($pages > 1) {
		$output .= "$before<li><span class='pagination-title'>$title</span></li>";
		$ellipsis = "<li><span class='page-numbers dots'>...</span></li>";

		if ($page > 1 && !empty($previouspage)) {
			$output .= "<li><a href='" . get_pagenum_link($page - 1) . "' class='prev page-numbers'>$previouspage</a></li>";
		}

		$min_links = $range * 2 + 1;
		$block_min = min($page - $range, $pages - $min_links);
		$block_high = max($page + $range, $min_links);
		$left_gap = (($block_min - $anchor - $gap) > 0) ? true : false;
		$right_gap = (($block_high + $anchor + $gap) < $pages) ? true : false;

		if ($left_gap && !$right_gap) {
			$output .= sprintf('%s%s%s',
				emm_paginate_loop(1, $anchor),
				$ellipsis,
				emm_paginate_loop($block_min, $pages, $page)
			);
		}
		else if ($left_gap && $right_gap) {
			$output .= sprintf('%s%s%s%s%s',
				emm_paginate_loop(1, $anchor),
				$ellipsis,
				emm_paginate_loop($block_min, $block_high, $page),
				$ellipsis,
				emm_paginate_loop(($pages - $anchor + 1), $pages)
			);
		}
		else if ($right_gap && !$left_gap) {
			$output .= sprintf('%s%s%s',
				emm_paginate_loop(1, $block_high, $page),
				$ellipsis,
				emm_paginate_loop(($pages - $anchor + 1), $pages)
			);
		}
		else {
			$output .= emm_paginate_loop(1, $pages, $page);
		}

		if ($page < $pages && !empty($nextpage)) {
			$output .= "<li><a href='" . get_pagenum_link($page + 1) . "' class='next page-numbers'>$nextpage</a></li>";
		}

		$output .= $after;
	}

	if ($echo) {
		echo $output;
	}

	return $output;
}

/* Helper function for pagination which builds the page links. */
function emm_paginate_loop($start, $max, $page = 0) {
	$output = "";
	for ($i = $start; $i <= $max; $i++) {
		$output .= ($page === intval($i))
			? "<li class='active'><span class='page-numbers current'><b>$i</b></span></li>"
			: "<li><a href='" . get_pagenum_link($i) . "' class='page-numbers'>$i</a></li>";
	}
	return $output;
}

/* Comments pagination by Orhideous */

function wp_comments_corenavi() {
  $pages = '';
  $max = get_comment_pages_count();
  $page = get_query_var('cpage');
  if (!$page) $page = 1;
  $a['current'] = $page;
  $a['echo'] = false;

  $total = 1; //1 - выводить текст "Страницы: ", 0 - не выводить
  $a['mid_size'] = 3; //сколько ссылок показывать слева и справа от текущей
  $a['end_size'] = 1; //сколько ссылок показывать в начале и в конце
  $a['prev_text'] = '&laquo;'; //текст ссылки "Предыдущая страница"
  $a['next_text'] = '&raquo;'; //текст ссылки "Следующая страница"

  if ($max > 1) echo '<div class="emm-paginate">';
  if ($total == 1 && $max > 1) $pages = '< class="emm-title">Страницы: </>'."\r\n";
  echo $pages . paginate_comments_links($a);
  if ($max > 1) echo '</div>';
}

add_filter( 'wp_feed_cache_transient_lifetime', create_function('$a', 'return 900;') );



/* Function image responsive */


function bootstrap_responsive_images( $html ){
	$classes = 'img-responsive';
	if ( preg_match('/<img.*? class="/', $html) ) {
		$html = preg_replace('/(<img.*? class=".*?)(".*?\/>)/', '$1 ' . $classes . ' $2', $html);
	} else {
		$html = preg_replace('/(<img.*?)(\/>)/', '$1 class="' . $classes . '" $2', $html);
	}
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
	return $html;
}

add_filter( 'the_content','bootstrap_responsive_images',10 );
add_filter( 'post_thumbnail_html', 'bootstrap_responsive_images', 10 );


/* CUSTOM COMMENTS */

function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class('clearfix'); ?> id="li-comment-<?php comment_ID() ?>">
	<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-meta commentmetadata clearfix">
			<img class="gravatar"src="<?php echo '//files.everypony.ru/main/avatars/?' . rand(0, 1000); ?>">
			<p><?php printf(__('<strong>%s</strong>'), get_comment_author_link()) ?></br>
			<span>
				<?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?>
	  		</span></p>
	  	</div>

		<div class="text"><?php comment_text() ?></div>
		<?php if ($comment->comment_approved == '0') : ?>
			<em><?php _e('Коммент зохавал спамфильтр. Скорее всего, я замечу и поправлю, когда проснусь.') ?></em><br />
		<?php endif; ?>
		<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?><?php edit_comment_link(__('(Edit)'),'  ','') ?>
	</div>
<?php }

function pony_stuff() {
    // wp_register_script( 'snow', '//files.everypony.ru/main/old/ny/MuffinSnow.js');
    // wp_enqueue_script( 'snow' );
    $tpl_dir = get_template_directory_uri();
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-tabs');
    wp_enqueue_script('ep', $tpl_dir . '/script.js?version=2.1', array('jquery'));
	wp_enqueue_script( 'scripts_js', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '', true );
	wp_enqueue_script( 'bootstrap_js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'offcanvas_js', get_template_directory_uri() . '/js/bootstrap.offcanvas.min.js', array('jquery'), '', true );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
	wp_enqueue_style( 'offcanvas', get_template_directory_uri() . '/css/bootstrap.offcanvas.min.css');
	wp_enqueue_style('ep', $tpl_dir . '/style.css');
}

add_action('wp_enqueue_scripts', 'pony_stuff');
add_action( 'wp_enqueue_scripts', 'theme_styles' );
add_action( 'wp_enqueue_scripts', 'theme_js' );
?>
