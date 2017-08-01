<?php

// recent articles widget
class Recent_Articles_Widget extends WP_Widget {
    function Recent_Articles_Widget() {
        //Constructor
        parent::WP_Widget(false, $name = 'LUX Recent Articles', array(
            'description' => 'This is custom Recent Articles widget.'
        ));
    }
    function widget($args, $instance) {
        // outputs the content of the widget
        global $post;
        extract( $args );
         $category = implode(",",$instance['category']); 
        //$raw_title = empty($instance['raw_title']) ? ' ' : apply_filters('widget_raw_title', $instance['raw_title']);
		$raw_count = empty($instance['raw_count']) ? ' ' : apply_filters('widget_raw_count', $instance['raw_count']); 
        // query to retrieve recent posts from a given category

        query_posts(array(
            'cat' => $category,
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => -1 
			//'showposts' => $raw_count
        ));
		$_latestPosts = array();
	
		if ( have_posts() ) :
				while ( have_posts() ) : the_post();  
				 if(get_field('front_post_order'))
				 {
					 $_latestPosts[]= array('order'=>get_field('front_post_order'),'id'=>get_the_ID());
				 }
			   endwhile;
			   
			if($_latestPosts)    
			for($count=1;$count<=4;$count++)
			{
				foreach($_latestPosts as $data)
				{
					if($data['order'] == $count)
					 {
						 $_latestFour[$count]=$data['id'];
					     break; 
					 }
				}
			}
		endif;
      
		
	    echo $before_widget;
		echo '<div class="recentArticles">';
        if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
          echo "<ul>";
          // output widget
		if($_latestFour) {
			$i=1; 
		foreach($_latestFour as $x) :  
         if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php if($x == get_the_ID()) {   ?>
        <li<?php if($i%4==0){ echo ' class="last"'; } ?>>
            <div class="cat-title">
                <?php $category = get_the_category(); echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>'; ?>
            </div>       
            <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('thumb-big');?></a>
            <div class="inner">
            	
                
                <?php if(get_field('small_grey_text')){?>
                <div class="spl-text">SONDERVERÖFFENTLICHUNG<sub>*</sub></div>
            	<?php } ?>
                
                <h2>
                    <a href="<?php the_permalink() ?>">
                        <?php if(get_field('second_headline')) { echo '<span class="subheader">'. get_field('second_headline'). '</span>'; } the_title(); ?>
                    </a>                
                </h2>
                
                
               <a href="<?php the_permalink() ?>"><?php the_excerpt(); ?></a>
               
               <?php if(get_field('small_grey_text')){?><p class="special-text">* <?php the_field('small_grey_text');?></p><?php } ?>
               
                
            </div>
        </li>
        <?php $i++; ?>
        <?php } ?>
        <?php  endwhile; 
        else:
            echo '<li>No posts found.</li>';
        endif;
		endforeach;
		}
         echo "</ul>";
        wp_reset_query();
		echo '</div>';
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        //update and save the widget
		
        return $new_instance;
    }
    function form($instance) {
        //widgetform in backend
        $category = $instance['category']; 
        //$raw_title = strip_tags($instance['raw_title']);
		$raw_count = strip_tags($instance['raw_count']);
       // Get the existing categories and build a simple select dropdown for the user.
        $categories = get_categories();
        $cat_options = array();
        //$cat_options[] = '<option value="BLANK">Select one...</option>';
        foreach ($categories as $cat) { 
           if($category) $selected = in_array($cat->cat_ID,$category) === true  ? ' selected="selected"' : '';
            $cat_options[] = '<option value="' . $cat->cat_ID .'"' . $selected . '>' . $cat->name . '</option>';
        }
        ?>  
            <p>
                <label for="<?php echo $this->get_field_id('category'); ?>">
                    <?php _e('Select Categories <small>(With Press CNTR)</small>'); ?>
                </label>
                <select id="<?php echo $this->get_field_id('category'); ?>" multiple="multiple" size="4" class="widefat" name="<?php echo $this->get_field_name('category'); ?>[]">
                    <?php echo implode('', $cat_options); ?>
                </select>
            </p>
          	<p>
              <label for="<?php echo $this->get_field_id('raw_count'); ?>">Number of eJournals to show: </label>
              <input size="3" id="<?php echo $this->get_field_id('raw_count'); ?>" name="<?php echo $this->get_field_name('raw_count'); ?>" type="text" value="<?php echo attribute_escape($raw_count); ?>" />
          	</p>            
        <?php
    }
}
register_widget('Recent_Articles_Widget');
// end recent articles widget


// Start Gewinnspiel intro widget
function wt_get_ID_by_page_name($page_name)
{
    global $wpdb;
    $page_name_id = $wpdb->get_var("SELECT ID FROM  $wpdb->posts WHERE post_title = '".$page_name."' AND post_type = 'page'");
   return $page_name_id;
}

class Menu_widget extends WP_Widget {
 
 
    /** constructor -- name this the same as the class above */
    function Menu_widget() {
        parent::WP_Widget(false, $name = 'LUX Page Intro Widget');   
    }
 
    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) {   
        extract( $args );
        //$title         = apply_filters('widget_title', $instance['title']);
        $menu     = $instance['menu'];
		$moretext     = $instance['moretext'];
        $pageid = wt_get_ID_by_page_name($menu); ?>
		<?php echo $before_widget; ?>
			<?php if ( $title ) echo $before_title . $title . $after_title; ?>
            <?php $ref = array( 'p' => $pageid ,'post_type' => 'page'); $ref_posts = new WP_Query ($ref);  ?>   
            <?php if ($ref_posts->have_posts()) : while ($ref_posts->have_posts()) : $ref_posts->the_post(); global $more;  $more = 0; ?>            
            <div class="introArticle">                  
                <div class="cat-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </div>                 
                <div class="right">
                	<?php the_post_thumbnail('full');?>
					<?php if(get_field('sub_heading')) { ?><h3><a href="<?php the_permalink(); ?>"><?php the_field('sub_heading');?></a></h3><?php } ?>        
                    <?php if(get_field('front_page_widget_text')) { the_field('front_page_widget_text'); } else { the_content(); } ?>
                    <a href="<?php the_permalink(); ?>" class="button"><?php if($moretext){ echo $moretext; ?> <?php } else { ?>Lesen Sie weiter<?php } ?></a>
                </div>
                <div class="clear"></div>
             </div>   
            <?php  endwhile; endif; wp_reset_query(); ?>
        <?php echo $after_widget; ?>
        <?php }
    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {       
        $instance = $old_instance;
        //$instance['title'] = strip_tags($new_instance['title']);
        $instance['menu'] = strip_tags($new_instance['menu']);
		$instance['moretext'] = strip_tags($new_instance['moretext']);
        return $instance;
    }
 
    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {   
 
        //$title     = esc_attr($instance['title']);
        $menu    = esc_attr($instance['menu']);
		$moretext     = esc_attr($instance['moretext']);
        ?>
        <p>
         <label for="<?php echo $this->get_field_id('menu'); ?>"><?php _e('Select Page'); ?></label>
          <select name="<?php echo $this->get_field_name('menu'); ?>" id="<?php echo $this->get_field_id('menu'); ?>">
          <?php $ref = array('post_type' => 'page', 'showposts'=> -1);
                $ref_posts = new WP_Query ($ref);
         if ($ref_posts->have_posts()) : while ($ref_posts->have_posts()) : $ref_posts->the_post(); ?>
        <option value="<?php echo get_the_title(); ?>" <?php if($menu==get_the_title()) { ?> selected="selected" <?php } ?>><?php echo get_the_title(); ?></option>
        <?php  endwhile; endif; wp_reset_query(); ?>
        </select>
       </p> 

     <p>
      <label for="<?php echo $this->get_field_id('moretext'); ?>"><?php _e('Read More Text:'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('moretext'); ?>" name="<?php echo $this->get_field_name('moretext'); ?>" type="text" value="<?php echo $moretext; ?>" />
    </p>	   
	   
	   <?php } } // end class Menu_widget
add_action('widgets_init', create_function('', 'return register_widget("Menu_widget");'));
// End Gewinnspiel intro widget


// Related Articles box widget
class Related_Articles extends WP_Widget {
    function Related_Articles() {
        //Constructor
        parent::WP_Widget(false, $name = 'LUX Related Articles', array(
            'description' => 'This is custom Related Articles widget.'
        ));
    }
    function widget($args, $instance) {
        // outputs the content of the widget
        global $post;
        extract( $args );
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
        $rasw_count = empty($instance['rasw_count']) ? ' ' : apply_filters('widget_rasw_count', $instance['rasw_count']);
        echo $before_widget; ?>
        
		<?php 
		
		$related_article = get_field('related_articles', $post->post_parent); $postid=array(); 	
		
		if($related_article)
		{	
		  foreach($related_article as $article){ array_push($postid, $article->ID);}	
		}
		$the_posts = array('post_type'=> 'post','post__in'=> $postid,'posts_per_page'=> $rasw_count,);
		
		$the_query = new WP_Query($the_posts);  ?>
        <div class="relatedList">
        	<ul>
				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

                <li>
                	<?php if ( !empty( $title ) ) { echo '<div class="cat-title"><span class="widgetTitle">'.$title.'</span></div>'; }; ?>
                    
                    <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('thumb-big');?></a>
                    
                    <div class="inner">
                        
                        <h2>
                            <a href="<?php the_permalink() ?>">
                                <?php if(get_field('second_headline')) { echo '<span class="subheader">'. get_field('second_headline'). '</span>'; } the_title(); ?>
                            </a>                
                        </h2>
                        
                      <a href="<?php the_permalink() ?>"><?php the_excerpt(); ?></a>
                       
                    </div>
                    
                </li>
                <?php endwhile; wp_reset_postdata(); ?>  		
        	</ul>
        </div>
        <?php echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        //update and save the widget
        return $new_instance;
    }
    function form($instance) {
		
        //widgetform in backend 
		$title = strip_tags($instance['title']);
		$rasw_count = strip_tags($instance['rasw_count']);
        ?> 
          <p>
              <label for="<?php echo $this->get_field_id('title'); ?>">Title: </label>
              <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" />
          </p>        
          <p>
              <label for="<?php echo $this->get_field_id('rasw_count'); ?>">Number of Articles to show: </label>
              <input size="3" id="<?php echo $this->get_field_id('rasw_count'); ?>" name="<?php echo $this->get_field_name('rasw_count'); ?>" type="text" value="<?php echo attribute_escape($rasw_count); ?>" />
          </p>
        <?php
    }
}
register_widget('Related_Articles');
// Related Articles box widget


// start Feature recent articles widget
class Feature_Posts_Widget extends WP_Widget {
    function Feature_Posts_Widget() {
        //Constructor
        parent::WP_Widget(false, $name = 'LUX Feature Post Widget', array(
            'description' => 'Feature Recente Post Widget'
        ));
    }
    function widget($args, $instance) {
        // outputs the content of the widget
        global $post;
        extract( $args );
        $category = (is_numeric($instance['category']) ? (int)$instance['category'] : '');
		$faw_count = empty($instance['faw_count']) ? ' ' : apply_filters('widget_raw_count', $instance['faw_count']);
		//$btn_text = empty($instance['btn_text']) ? ' ' : apply_filters('widget_btn_text', $instance['btn_text']);
        //$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
        // query to retrieve recent posts from a given category
        query_posts(array(
            'cat' => $category,
            'post_status' => 'publish',
            'caller_get_posts'=>1,
            'showposts' => '5',
			'showposts' => $faw_count
        ));
        echo $before_widget;
		echo '<div class="featureArticles">';
        if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
          echo "<ul>";
          // output widget
        $i=1; if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        
        <li<?php if($i%4==0){ echo ' class="last"'; }?>>

			<?php 
                $attachment_id = get_field('featured_icon'); 
                $size = "featured-img"; 
                $image = wp_get_attachment_image_src( $attachment_id, $size ); 
            ?>     
        
            <div class="cat-title">
				<?php $category = get_the_category(); echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name;?>
                <?php if(get_field('featured_icon')) {?>
                <img src="<?php echo $image[0]; ?>" /> 
                <?php } ?>
                <?php '</a>'; ?>
            </div>       
            <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('thumb-big');?></a>
            <div class="inner">
            	
                <?php if(get_field('small_grey_text')){?>
                <div class="spl-text">SONDERVERÖFFENTLICHUNG<sub>*</sub></div>
            	<?php } ?>
                
                <h2>
                    <a href="<?php the_permalink() ?>">
                        <?php if(get_field('second_headline')) { echo '<span class="subheader">'. get_field('second_headline'). '</span>'; } the_title(); ?>
                    </a>                
                </h2>
                
                
               <a href="<?php the_permalink() ?>"><?php the_excerpt(); ?></a>
               
               <?php if(get_field('small_grey_text')){?><p class="special-text">* <?php the_field('small_grey_text');?></p><?php } ?>
               
               <a href="<?php the_permalink() ?>" class="button">
			   	<?php if(get_field('button_text')) {?><?php the_field('button_text');?><?php } else { ?>Hier klicken<?php } ?>
               </a> 
               
            </div>
        </li>
        
		<?php $i++; endwhile; else: echo '<li>No posts found.</li>'; endif; echo "</ul>"; wp_reset_query(); echo '</div>';

        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        //update and save the widget
        return $new_instance;
    }
    function form($instance) {
        //widgetform in backend
        $category = esc_attr($instance['category']);
		$faw_count = strip_tags($instance['faw_count']);
		//$btn_text = strip_tags($instance['btn_text']);
        //$title = strip_tags($instance['title']);
       // Get the existing categories and build a simple select dropdown for the user.
        $categories = get_categories();
        $cat_options = array();
        //$cat_options[] = '<option value="BLANK">Select one...</option>';
        foreach ($categories as $cat) {
            $selected = $category === $cat->cat_ID ? ' selected="selected"' : '';
            $cat_options[] = '<option value="' . $cat->cat_ID .'"' . $selected . '>' . $cat->name . '</option>';
        }
        ?>
            <p>
                <label for="<?php echo $this->get_field_id('category'); ?>">
                    <?php _e('Select Feature Category:'); ?>
                </label>
                <select id="<?php echo $this->get_field_id('category'); ?>" class="widefat" name="<?php echo $this->get_field_name('category'); ?>">
                    <?php echo implode('', $cat_options); ?>
                </select>
            </p>
          	<p>
              <label for="<?php echo $this->get_field_id('raw_count'); ?>">Number of Articles to show : </label>
              <input size="3" id="<?php echo $this->get_field_id('faw_count'); ?>" name="<?php echo $this->get_field_name('faw_count'); ?>" type="text" value="<?php echo attribute_escape($faw_count); ?>" />
          	</p>       
          	<p style="display:block;">
              <label for="<?php echo $this->get_field_id('btn_text'); ?>">More Button Text : </label>
              <input class="widefat" size="3" id="<?php echo $this->get_field_id('btn_text'); ?>" name="<?php echo $this->get_field_name('btn_text'); ?>" type="text" value="<?php echo attribute_escape($btn_text); ?>" />
          	</p>                          
        <?php
    }
}
register_widget('Feature_Posts_Widget');
// end Feature recent articles widget


// eJournals box widget
class eJournals_Widget extends WP_Widget {
    function eJournals_Widget() {
        //Constructor
        parent::WP_Widget(false, $name = 'LUX Recent eJournal', array(
            'description' => 'This is custom Recent eJournals widget.'
        ));
    }
    function widget($args, $instance) {
        // outputs the content of the widget
        global $post;
        extract( $args );
        $ejw_count = empty($instance['ejw_count']) ? ' ' : apply_filters('widget_ejw_count', $instance['ejw_count']);
		$ejw_url = empty($instance['ejw_url']) ? ' ' : apply_filters('widget_ejw_url', $instance['ejw_url']);
        echo $before_widget; ?>
        
		<?php $the_query = new WP_Query('post_type=ejournal&posts_per_page='.$ejw_count); ?>
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <div class="recent-ejournal" OnClick="window.location.href = '<?php echo $ejw_url;?>'">
        	<div class="inner">
				<?php the_post_thumbnail('journal-small');?>
                <h3><?php the_title();?></h3>
                <?php the_excerpt();?>
                <div class="clear"></div>
            </div>
        </div>
        <?php endwhile; wp_reset_postdata(); ?>  		
        
        <?php echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        //update and save the widget
        return $new_instance;
    }
    function form($instance) {
		
        //widgetform in backend 
		$ejw_count = strip_tags($instance['ejw_count']);
		$ejw_url = strip_tags($instance['ejw_url']);
        ?> 
          <p>
              <label for="<?php echo $this->get_field_id('ejw_count'); ?>">Number of eJournals to show: </label>
              <input size="3" id="<?php echo $this->get_field_id('ejw_count'); ?>" name="<?php echo $this->get_field_name('ejw_count'); ?>" type="text" value="<?php echo attribute_escape($ejw_count); ?>" />
          </p>

          <p>
              <label for="<?php echo $this->get_field_id('ejw_url'); ?>">eJournal Page Link: </label>
              <input class="widefat" id="<?php echo $this->get_field_id('ejw_url'); ?>" name="<?php echo $this->get_field_name('ejw_url'); ?>" type="text" value="<?php echo attribute_escape($ejw_url); ?>" />
          </p>
        <?php
    }
}
register_widget('eJournals_Widget');
// end eJournals box widget


// special box widget
class Special_Text_Widget extends WP_Widget {
    function Special_Text_Widget() {
        //Constructor
        parent::WP_Widget(false, $name = 'LUX Special Text Widget', array(
            'description' => 'This is custom text widget with sticker text and link.'
        ));
    }
    function widget($args, $instance) {
        // outputs the content of the widget
        global $post;
        extract( $args );
        $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$stw_text = empty($instance['stw_text']) ? ' ' : apply_filters('widget_stw_text', $instance['stw_text']);
		$stw_sticker = empty($instance['stw_sticker']) ? ' ' : apply_filters('widget_stw_sticker', $instance['stw_sticker']);
		$stw_link = empty($instance['stw_link']) ? ' ' : apply_filters('widget_stw_link', $instance['stw_link']);
		$stw_target = empty($instance['title']) ? ' ' : apply_filters('widget_stw_target', $instance['stw_target']);
        echo $before_widget; ?>
        
		<div class="special_widget_text"<?php if (!empty($stw_link)) {?> onclick="window.open('<?php echo $stw_link;?>','<?php echo $stw_target ?>');"<?php } ?>>
			<div class="inner">
				<?php if ( !empty( $title ) ) { echo '<h3>'.$title.'</h3>'; };
                
                if (!empty($stw_text)) {
                echo '<p>'.$stw_text.'</p>';
                }
        
                if (!empty($stw_sticker)) {
                echo '<span class="sticker">'.$stw_sticker.'</span>';
                }
                
		echo '<div class="clear"></div></div></div>';
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        //update and save the widget
        return $new_instance;
    }
    function form($instance) {
		
        //widgetform in backend
        $title = strip_tags($instance['title']);
		$stw_text = strip_tags($instance['stw_text']);
		$stw_sticker = strip_tags($instance['stw_sticker']);
		$stw_link = strip_tags($instance['stw_link']);
		$stw_target = $instance['stw_target'];
      
        ?>
          <p>
              <label for="<?php echo $this->get_field_id('title'); ?>">Title: </label>
              <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" />
          </p>

          <p>
              <label for="<?php echo $this->get_field_id('stw_text'); ?>">Descriptions: </label>
              <textarea class="widefat" rows="6" cols="" id="<?php echo $this->get_field_id('stw_text'); ?>" name="<?php echo $this->get_field_name('stw_text'); ?>"><?php echo attribute_escape($stw_text); ?></textarea>
          </p>

          <p>
              <label for="<?php echo $this->get_field_id('stw_sticker'); ?>">Sticker Title: </label>
              <input class="widefat" id="<?php echo $this->get_field_id('stw_sticker'); ?>" name="<?php echo $this->get_field_name('stw_sticker'); ?>" type="text" value="<?php echo attribute_escape($stw_sticker); ?>" />
          </p>

          <p>
              <label for="<?php echo $this->get_field_id('stw_link'); ?>">Link URL: </label>
              <input class="widefat" id="<?php echo $this->get_field_id('stw_link'); ?>" name="<?php echo $this->get_field_name('stw_link'); ?>" type="text" value="<?php echo attribute_escape($stw_link); ?>" />
          </p>

          <p>
              <label for="<?php echo $this->get_field_id('stw_target'); ?>">Link URL Target: </label>
              <select name="<?php echo $this->get_field_name('stw_target'); ?>" id="<?php echo $this->get_field_id('stw_target'); ?>">
              	<option value="_self"<?php if($stw_target=="_self") { ?> selected="selected" <?php } ?>>Self Window</option>
                <option value="_blank" <?php if($stw_target=="_blank") { ?> selected="selected" <?php } ?>>New Window</option>
              </select> 
          </p>
                              
        <?php
    }
}
register_widget('Special_Text_Widget');
// end special box widget