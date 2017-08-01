<?php
	if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	
	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'bobox'); ?></p> 
	<?php
		return;
	}
?>

<div id="comments">
<?php if ( have_comments() ) : ?>
	<h4 class="comments-title"><?php comments_number(__('No Responses', 'bobox'), __('One Response', 'bobox'), __('% Responses', 'bobox'));?> <?php printf(__('to &#8220;%s&#8221;', 'bobox'), the_title('', '', false)); ?></h4>


	<ol class="commentlist">
<?php wp_list_comments('type=comment&callback=mytheme_comment'); ?>

	</ol>

	
    
 <?php else :  if ( comments_open() ) : else : ?>

		
        <p class="nocomments"><?php _e('', 'bobox'); ?></p>

	<?php endif; ?>
<?php endif; ?>


<?php if ( comments_open() ) : ?>
</div>
<div id="respond">

<h4><?php comment_form_title( __('Leave a Reply', 'bobox'), __('Leave a Reply for %s' , 'bobox') ); ?></h4>

<div id="cancel-comment-reply"> 
	<small><?php cancel_comment_reply_link() ?></small>
</div> 

<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'bobox'), wp_login_url( get_permalink() )); ?></p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( is_user_logged_in() ) : ?>


<div class="memberbox"><?php printf(__('Logged in as <a href="%1$s">%2$s</a>.', 'bobox'), get_option('siteurl') . '/wp-admin/profile.php', $user_identity); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account', 'bobox'); ?>"><?php _e('Log out &raquo;', 'bobox'); ?></a>
</div>

<?php else : ?>
<div class="inputbox">
<input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="author"><small><?php _e('Name', 'bobox'); ?> <?php if ($req) _e("(required)", "bobox"); ?></small></label><br />

<input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="email"><small><?php _e('Mail (will not be published)', 'bobox'); ?> <?php if ($req) _e("(required)", "bobox"); ?></small></label><br />


</div>
<?php endif; ?>

<!--<p><small><?php printf(__('<strong>XHTML:</strong> You can use these tags: <code>%s</code>', 'bobox'), allowed_tags()); ?></small></p>-->
<div class="textbox">
<textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea>

<input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment', 'bobox'); ?>" title="<?php _e('Submit Comment', 'bobox'); ?>" />
</div>



<?php comment_id_fields(); ?> 

<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>
</div>




<?php endif; // if you delete this the sky will fall on your head ?>