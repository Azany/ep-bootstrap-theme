<?php get_header(); ?>

<!--<div id="content" class="row ep-content">-->
	<div class="col-lg-9">
		<div class="pageItem">
			<h1><?php the_title(); ?></h1>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<?php the_content(); ?>

			<?php endwhile; else: ?>
				<p>Наши отборные поисковые отряды не смогли найти этой страницы. Извини, поняша, попробуй как-нибудь иначе.</p>
		        	<div style="text-align:center;"><img src="//projects.everypony.ru/error/404.png"></div>
			<?php endif; ?>
		</div>
	</div>
<!--</div>-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
