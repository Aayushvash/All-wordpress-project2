<?php 
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>
<script src="<?php bloginfo('template_url');?>/js/jquery.textareaCounter.plugin.js" type="text/javascript"></script>
<script type="text/javascript">
	var info;
	$(document).ready(function(){
		
		var options2 = {
				'maxCharacterSize': 1200,
				'originalStyle': 'originalTextareaInfo',
				'warningStyle' : 'warningTextareaInfo',
				'warningNumber': 40,
				'displayFormat' : '#input/#max | #words words'
		};
		$('#comment').textareaCount(options2);
		
	});

	$(document).ready(function () {
	  $("span.question").hover(function () {
		$(this).append('<div class="tooltip"><p><?php echo of_get_option('comment_text'); ?></p></div>');
	  }, function () {
		$("div.tooltip").remove();
	  });
	});
	
</script>
<!-- You can start editing here. -->

<div id="commentArea">

	<?php if ( comments_open() ) : ?>
    
    <div id="respond">
    
        <h3><?php comment_form_title( 'Artikel kommentieren', 'Artikel kommentieren' ); ?></h3>
        
        <div class="cancel-comment-reply">
            <small><?php cancel_comment_reply_link(); ?></small>
        </div>
        
        <?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
        <p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>
        <?php else : ?>
        
        <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
        
            <?php if ( is_user_logged_in() ) : ?>
            
                <p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>
    
                <textarea name="comment" id="comment" cols="58" rows="10" tabindex="4" placeholder="Ihr Beitrag"></textarea> 
                
                <?php do_action('comment_form', $post->ID); ?>
                
            <?php else : ?>
            
                <div class="left">
                
                    <p><input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" placeholder="Name"  size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> /></p>
                    
                    <p><input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" placeholder="Email" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> /></p>
                    
                    <?php do_action('comment_form', $post->ID); ?>
    			
                </div>
                
                <div class="right">
                
                    <textarea name="comment" id="comment" cols="58" rows="10" tabindex="4" placeholder="Ihr Beitrag"></textarea>
        
                </div>
				
                <div class="clear"></div>
                                        
            <?php endif; ?>
			
            <?php comment_id_fields(); ?>
            
            <div class="commTool">            	
                <p><?php if(of_get_option('comment_text')) {?><span class="question">Hilfe/Kommentarregeln</span><?php } ?>noch 1200 Zeichen</p>                
            	<input name="submit" type="submit" id="submit" tabindex="5" value="VERÖFFENTLICHEN" />
                <div class="clear"></div>			
            </div>
                                
        </form>
        
        <?php endif; // If registration required and not logged in ?>
        
    </div>
    
    <?php endif; // if you delete this the sky will fall on your head ?>
    
    <a name="comments"></a>
    
    <?php if ( have_comments() ) : ?>
    
        <ol class="commentlist">
           	<?php wp_list_comments('type=comment&callback=mytheme_comment'); ?>
        </ol>

        <?php if(function_exists('wp_comments_corenavi')) wp_comments_corenavi(); ?>
        
     <?php else : // this is displayed if there are no comments so far ?>
    
        <?php if ( comments_open() ) : ?>
            <!-- If comments are open, but there are no comments. -->
    
         <?php else : // comments are closed ?>
            <!-- If comments are closed. -->
            <p class="nocomments">Comments are closed.</p>
    
        <?php endif; ?>
    <?php endif; ?>

</div>