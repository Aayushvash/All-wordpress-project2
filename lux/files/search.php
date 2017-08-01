<?php get_header(); ?>

<div class="centering">

    <div class="breadcrumbs">
        <?php if(function_exists('bcn_display')){bcn_display();}?>
    </div>

    <!-- left -->
    <div id="left">

        <input type="hidden" name="totalPosts" id="totalPosts" value="<?php echo $wp_query->found_posts ; ?>"/>
        <?php if (have_posts()) : ?>
        
        <div id="articlesList">
			<?php while (have_posts()) : the_post(); ?>            
            <div class="article"> 
            
                <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('thumbnail');?></a>
                <div class="inner">
                    
                    <?php if(get_field('small_grey_text')){?>
                    <div class="spl-text">SONDERVERÖFFENTLICHUNG<sub>*</sub></div>
                    <?php } ?>
                    
                    <h2>
                        <a href="<?php the_permalink() ?>">
                            <?php if(get_field('second_headline')) { echo '<span class="subheader">'. get_field('second_headline'). '</span>'; } the_title(); ?>
                        </a>                
                    </h2>
                    
					<?php if (get_field('article_date')) { echo '<div class="date">'.date('d.m.Y', strtotime(get_field('article_date'))).'</div>'; } ?>
                    
                    <?php the_excerpt(); ?>
                   
                   <?php if(get_field('small_grey_text')){?><p class="special-text">* <?php the_field('small_grey_text');?></p><?php } ?>
                   
                    
                </div> 
        
            </div>            
            <?php endwhile; ?> 
        </div>

        <div id="page-nav"><?php next_posts_link('WEITERE ARTIKEL') ?></div>
                
        <?php else :
        
        if ( is_category() ) { // If this is a category archive
            printf("<h1>Sorry, but there aren't any posts in the %s category yet.</h1>", single_cat_title('',false));
        } else if ( is_date() ) { // If this is a date archive
            echo("<h1>Sorry, but there aren't any posts with this date.</h1>");
        } else if ( is_author() ) { // If this is a category archive
            $userdata = get_userdatabylogin(get_query_var('author_name'));
            printf("<h1>Sorry, but there aren't any posts by %s yet.</h1>", $userdata->display_name);
        } else {
            echo("<h1>Es wurden keine Treffer gefunden</h1>");
        }
        
        endif;
        ?>
    
    </div>
    <!-- left container -->
    
    <?php get_sidebar('category'); ?>

	<div class="clear"></div>
</div>

<?php get_footer(); ?>

