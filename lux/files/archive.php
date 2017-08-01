<?php get_header(); ?>

<div class="centering">
	
    <div class="breadcrumbs">
        <?php if(function_exists('bcn_display')){bcn_display();}?>
    </div>

    <!-- left -->
    <div id="left">
    
		<?php $catID= get_query_var('cat'); 
		$category = get_category($catID); 
		$categories = get_categories("child_of=$catID");  ?>
        <?php if(count($categories) > 0 || $category->category_parent!=0) : ?>
        <div class="subCategories">
        	<p>Inhalte filtern nach:</p>
            <ul>
            	<li><a href="#">Themen</a>
                	<ul>
						<?php if( is_category() ) {
								$cat_id = get_query_var('cat');
								$cat_ancestors = array();
								$cat_ancestors[] = $cat_id;
                            do {
								$cat_id = get_category($cat_id);
								$cat_id = $cat_id->parent;
								$cat_ancestors[] = $cat_id; }
                            while ($cat_id);
								$cat_ancestors = array_reverse( $cat_ancestors );
								$top_cat = $cat_ancestors[1];
                            wp_list_categories('title_li=&child_of=' . $top_cat); } ?>
                    </ul>
                </li>
            </ul>
        </div>
        <?php endif; ?>
			
        <input type="hidden" name="totalPosts" id="totalPosts" value="<?php echo $wp_query->found_posts ; ?>"/>
        <?php 
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var('paged') : 1;  		
		$query = new WP_Query( array('meta_key' => 'article_date', 'orderby' => 'meta_value_num', 'paged' => $paged, 'order' => 'DESC', 'category__and' => array($catID) ) );
		if ( $query->have_posts() ) { ?>
        
        <div id="articlesList">
			<?php while ( $query->have_posts() ) { $query->the_post(); ?>            
            <div class="article"> 
            
                <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('thumbnail');?></a>
                <div class="inner">
                    
                    <?php if(get_field('pink_text')){?>
                    <div class="spl-text"><?php the_field('pink_text'); ?></div>
                    <?php } ?>
                    
                    <h2>
                        <a href="<?php the_permalink() ?>">
                            <?php if(get_field('second_headline')) { echo '<span class="subheader">'. get_field('second_headline'). '</span>'; } the_title(); ?>
                        </a>                
                    </h2>
                    
                    
                    <a href="<?php the_permalink() ?>"><?php the_excerpt(); ?></a>
                   
                   	<?php if(get_field('small_grey_text')){?><p class="special-text">* <?php the_field('small_grey_text');?></p><?php } ?>
                   
                    
                </div> 
        
            </div>            
            <?php } ?> 
        </div>

        <div id="page-nav"><?php next_posts_link('WEITERE ARTIKEL') ?></div>
                
        <?php } else {
        
        if ( is_category() ) { // If this is a category archive
            printf("<h1 class='center'>Sorry, but there aren't any posts in the %s category yet.</h1>", single_cat_title('',false));
        } else if ( is_date() ) { // If this is a date archive
            echo("<h1>Sorry, but there aren't any posts with this date.</h1>");
        } else if ( is_author() ) { // If this is a category archive
            $userdata = get_userdatabylogin(get_query_var('author_name'));
            printf("<h1 class='center'>Sorry, but there aren't any posts by %s yet.</h1>", $userdata->display_name);
        } else {
            echo("<h1 class='center'>No posts found.</h1>");
        }
        get_search_form();
        
		} wp_reset_postdata();  ?>
    
    </div>
    <!-- left container -->
    
    <?php get_sidebar('category'); ?>

	<div class="clear"></div>
</div>

<?php get_footer(); ?>

