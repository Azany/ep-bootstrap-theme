<?php

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments" xmlns="http://www.w3.org/1999/html">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<h2 class="h2comments"><?php comments_number('Комментариев нет', '1 комментарий', '% комментариев' );?></h2>
<a name="comments"></a>
	<ul class="commentlist">
	<?php wp_list_comments('callback=mytheme_comment'); ?>
	</ul>
<?php if(function_exists('wp_comments_corenavi')) wp_comments_corenavi(); ?>

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments">Комментирование закрыто.</p>

	<?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>

<div class="respond">

<h2 class="commentsform"><?php comment_form_title( 'Комментировать', 'Комментировать %s' ); ?></h2>

<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>Чтобы оставлять комментарии надо <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">войти</a>.</p>
<?php else : ?>

	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" class="form-group">

	<?php if ( $user_ID ) : ?>

	<p>Вы вошли как <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Выйти</a></p>

	<?php else : ?>

	<div class="form-group comment-form-author">
		<label for="author">Имя <?php if ($req) echo "(необходимо заполнить)"; ?></label>
		<input type="text" class="form-control" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
	</div>

	<div class="form-group comment-form-email">
		<label for="email">E-mail <?php if ($req) echo "(необходимо заполнить)"; ?></label>
		<input type="text" class="form-control" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
	</div>

	<?php endif; ?>
	<div class="form-group">
		<label for="comment">Текст комментария</label>
		<textarea name="comment" class="form-control" id="comment" cols="100%" rows="5" tabindex="4"></textarea>
	</div>

		<input type="submit" class="btn btn btn-default" tabindex="5" value="Откомментировать">
	<?php comment_id_fields(); ?>
	</p>
	<?php do_action('comment_form', $post->ID); ?>

	</form>

<?php endif; // If registration required and not logged in ?>
</div>

<?php endif; // if you delete this the sky will fall on your head ?>
