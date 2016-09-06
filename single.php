<?php get_header(); ?>


<div class="col-lg-9">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
	<div class="row postItem">
		<h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
			<div class="meta"><?php the_time('j M Y') ?> by <?php printf( get_the_author() ); ?> в рубрике <span class="categs"><?php the_category(' ') ?></span> <?php edit_post_link('Редактировать вот это'); ?></div>
	
		<?php the_content(__('Читать запись целиком &raquo;')); ?>

		<div class="meta meta-comments">
			<?php comments_popup_link('Комментариев нет', '1 комментарий ', '% комментариев'); ?>
			<?php the_tags('| Метки: ', ', ', ''); ?>
		</div>

	</div>

    <div class="row comments">
	    <?php comments_template(); ?>
	    <?php endwhile; ?>
    </div>
	<?php else : ?>
	<p>Дерпи потеряла.</p>
	<?php endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
