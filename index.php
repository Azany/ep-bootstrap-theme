<?php get_header(); ?>

<div class="col-lg-9 ep-content">
		<!-- archive-title -->
		<?php if(is_month()) { ?>
		<h1>Архив за "<strong><?php the_time('F, Y') ?></strong>"</h1>
		<?php } ?>
		<?php if(is_category()) { ?>
		<h1 class="category-h"><?php $current_category = single_cat_title("", true); ?></h1>
		<?php } ?>
		<?php if(is_tag()) { ?>
		<h1>Посты, содержащие тег <strong><?php wp_title('',true,''); ?></strong></h1>
		<?php } ?>
		<?php if(is_author()) { ?>
		<h1>Архив за "<strong><?php wp_title('',true,''); ?></strong>"</h1>
		<?php } ?>
		<!-- /archive-title -->

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="row postItem">
		<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
		<div class="meta">Опубликовано <?php the_time('j M Y') ?> автором <?php printf( get_the_author() ); ?> в рубрике <span class="categs"><?php the_category(', ') ?></span>
		</div>
		<div class="post-text"><?php the_content(__('Читать запись целиком &raquo;')); ?>
		</div>
		<div class="meta meta-comments">
			<span class="m-c-links"><?php comments_popup_link('Комментариев нет', '1 комментарий ', '% комментариев'); ?></span>
			<?php the_tags('| Метки: ', ', ', ''); ?>
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
