<?php get_header(); $post = $wp_query->post; ?>



<?php  if (in_category('feature')) { ?>		





<div id="featuredDetail" style="height: <?php the_field('page_height');?>px">

    <?php while (have_posts()) : the_post(); ?>     

    	<?php the_content(); ?>

    <?php endwhile; ?>

</div>       

 

<?php } else  { ?>



<div class="centering">



    <div class="breadcrumbs">

        <?php if(function_exists('bcn_display')){bcn_display();}?>

    </div> 

            

    <!-- left -->

    <div id="left">



        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>     

        <div class="articleDetail" id="post-<?php the_ID(); ?>">    

        

            <?php if(empty($_GET['u'])) { ?>

             <div class="date"><?php if (get_field('article_date')) { echo '<div class="date">'.date('d.m.Y', strtotime(get_field('article_date'))).'</div>'; } ?>von <?php the_field('article_author_name'); ?></div>

            <?php } ?>

            <?php if(get_field('sponsor_text_for_article_detail')){?>

            <div class="spl-text"><?php the_field('sponsor_text_for_article_detail'); ?></div>

            <?php } ?>      

                  

            <h1 class="title">

                <?php if(get_field('second_headline')) { echo '<span class="subheader">'. get_field('second_headline'). '</span>'; } the_title(); ?>

            </h1>

            

            <div class="articleImg">

            

            <?php if(empty($_GET['u'])) { ?>

                <div class="social-buttons">

                    <span class='st_twitter_large' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='twitter'></span>

                    <span class='st_facebook_large' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='facebook'></span>

                    <span class='st_googleplus_large' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='plusone'></span>  

                    <?php TellAFriend(); ?>

                    <a class="print" href="javascript:window.print()">Print this Article</a>

                </div>

            <?php } ?>    

                <div class="inner-img">

                

                    <?php the_post_thumbnail('medium');?>

    

                    <?php 

                    $the_content = get_the_content();

                    preg_match_all("~(?:\[/?)[^/\]]+/?\]~s", $the_content, $matches);

                    if($matches)

                    {    

                        foreach ($matches[0] as $match)

                        {

                          if(preg_match('/gallery/',$match))

                            echo do_shortcode($match);

                        }

                    }

                    ?>

                    

                </div>

                                                    

            </div>

            <?php if(empty($_GET['u'])) { ?>

            <?php 

                $my_excerpt = get_the_excerpt();

                if ( $my_excerpt != '' ) {}

                echo '<h4>'.$my_excerpt.'</h4>'; 

            ?>    

            <?php } ?>        

            <div class="entry">

            

                <?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>



                <?php if(get_field('article_sponsor_text')) {?>

                <div class="sponson-text">

                    <p><?php the_field('article_sponsor_text');?></p>

                    <?php if(get_field('article_sponsor_url')) {?>

                    <a href="<?php the_field('article_sponsor_url');?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/mehr-btn.png" /></a>

                    <?php } ?>

                </div>

                <?php } ?>

                                    

            </div>     

                                   

        </div>

        <?php comments_template(); ?>

        <?php endwhile; else: ?>

        <p>Sorry, no posts matched your criteria.</p>

        <?php endif; ?>



    </div>

    <!-- left -->

    

    <?php if(empty($_GET['u'])) { ?><?php get_sidebar('article'); ?><?php } ?>

    

    <div class="clear"></div>

        

</div>        

<?php } ?>



<?php get_footer(); ?>