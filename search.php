<?php get_header(); ?>
	
<div class="col-lg-9">
	<div id="archive-title">Результаты поиска по запросу "<?php /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = esc_html($s, 1); $count = $allsearch->post_count; _e(''); _e('<strong>'); echo $key; _e('</strong>'); wp_reset_query(); ?>"</div>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="postItem">
		<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
		<div class="meta">
			<div class="date"><?php the_time('j M, Y') ?></div>
		</div>
		<?php the_excerpt(); ?>
		<div class="meta">
			<div class="categs"><?php the_category(', ') ?></div>
			<div><?php comments_popup_link('Нет комментариев', '1 комментарий', '% комментариев'); ?></div>
		</div>
	</div>

	<?php endwhile; ?>

	<?php else : ?>
	<p>Наши отборные поисковые отряды не смогли найти этой страницы. Извини, поняша, попробуй как-нибудь иначе.</p>
	<div style="text-align:center;"><img src="//projects.everypony.ru/error/404.png"></div>
	<?php endif; ?>
		<?php if (function_exists("emm_paginate")) {
			emm_paginate();
		} ?>
</div>

<?php get_sidebar(); ?>	
<?php get_footer(); ?>
