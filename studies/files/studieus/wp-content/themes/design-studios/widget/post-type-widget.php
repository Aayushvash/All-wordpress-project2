<?php 
/**
 * product popular 
 */

class price_feed_widget1 extends WP_Widget {

    /** constructor -- name this the same as the class above */

    function price_feed_widget1() {

        parent::WP_Widget(false, $name = 'Custom Post Widget');    

    } 

    /** @see WP_Widget::widget -- do not rename this */

    function widget($args, $instance) {    

        extract( $args );

        $title = apply_filters('widget_title', $instance['title']);  
        ?>
				<?php echo $before_widget; ?>
				
				
					
					<?php
					$arry2 = get_field('select_post_for_right_side', 5);
					if( $arry2 ): ?>
					
					<?php foreach( $arry2 as $post): ?> 
						<?php setup_postdata($post); 
							//print_r($post); 						
							$postid = $post->ID;
						?>
						
						<div class="readalso">
							<div class="head">
								<h2><?php echo $title;?> </h2>
							</div>
				<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'custom-readalso' ); ?>
							<div class="img" style="background:url('<?php echo $url;?>')no-repeat center;    background-size: cover;">
								<p><?php echo $post->post_title; ?></p>
							</div>
							<div class="parah">
							
								<?php $excerpt= $post->post_excerpt;?>
								<p><?php echo substr($excerpt, 0, 170);?></p>
								<a href="<?php the_permalink($postid);?>" class="moreBtn">Lees meer</a>
								
							</div>
						</div>
						<?php endforeach; wp_reset_query(); ?>
						<?php wp_reset_postdata();  ?>
						<?php endif; ?>	
						
					
		
<?php echo $after_widget; ?>

<?php
    }

    /** @see WP_Widget::update -- do not rename this */

    function update($new_instance, $old_instance) {        

        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);   

        return $instance;
    } 

    /** @see WP_Widget::form -- do not rename this */

    function form($instance) {  
        $title = esc_attr($instance['title']);   
        ?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
    <?php _e('Title:'); ?>
  </label>
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>
<?php 

    } 

} // end class twitter_feed_widget

add_action('widgets_init', create_function('', 'return register_widget("price_feed_widget1");'));

/*** End product popular ***/

?>