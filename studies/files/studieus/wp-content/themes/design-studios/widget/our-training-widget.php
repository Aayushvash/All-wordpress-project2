<?php 
/**
 * product popular 
 */

class training_widget extends WP_Widget {

    /** constructor -- name this the same as the class above */

    function training_widget() {

        parent::WP_Widget(false, $name = 'Custom Training Widget');    

    } 

    /** @see WP_Widget::widget -- do not rename this */

    function widget($args, $instance) {    

        extract( $args );

        $title = apply_filters('widget_title', $instance['title']);  
        ?>
				<?php echo $before_widget; ?>
				
				
					
								<div class="head">
										<h2><?php echo $title;?></h2>
									</div>
									<div class="listing">
										<ul>
										
							<?php if(have_rows('our_trainings',5)) : while(have_rows('our_trainings',5)) : the_row(); ?>			
											<li>
											<?php $img1 = get_sub_field('image');?>
												<i><img src="<?php echo $img1['sizes']['training-img'];?>" alt=""/></i>
												<p>
													<span class="orng"><?php the_sub_field('training_title');?></span>
													<span class="norml"><?php echo nl2br(get_sub_field('training_content'));?></span> 
												</p>
												<div class="clearfix"></div>
												<a href="<?php the_permalink(22);?>" class="moreBtn">Naar training</a>
											</li>
											
						<?php endwhile; endif; wp_reset_query();?>								
										</ul>
									</div>
						
					
		
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

add_action('widgets_init', create_function('', 'return register_widget("training_widget");'));

/*** End product popular ***/

?>