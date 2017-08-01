<?php 
/*
Template Name: Gewinnspiel Page
*/
get_header(); ?> 

<div class="centering">



    <div class="breadcrumbs">

        <?php if(function_exists('bcn_display')){bcn_display();}?>

    </div> 

            

    <!-- left -->

    <div id="left">



        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>     

        <div class="articleDetail" id="post-<?php the_ID(); ?>">    


                  

          
      <?php if(get_field('sub_heading')) {?>
            <h1 class="title"><?php the_field('sub_heading'); ?></h1>
			<?php } else { ?>
            <h1 class="title"><?php the_title(); ?></h1>
            <?php }?> 

            

            <div class="articleImg">

            

           

                <div class="social-buttons">

                    <span class='st_twitter_large' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='twitter'></span>

                    <span class='st_facebook_large' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='facebook'></span>

                    <span class='st_googleplus_large' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='plusone'></span>  

                    <?php TellAFriend(); ?>

                    <a class="print" href="javascript:window.print()">Print this Article</a>

                </div>

          
                <div class="inner-img">

                

<?php
$post_content = get_the_content();
preg_match('/\[gallery.*ids=.(.*).\]/', $post_content, $ids);
$array_id = explode(",", $ids[1]);
	
	//echo "<pre>";
	//print_r($array_id);
    echo wp_get_attachment_image( $array_id[0],'medium' );

					 //the_post_thumbnail('medium');?>

    

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

      

        <?php endwhile; else: ?>

       

        <?php endif; ?>



    </div>

    <!-- left -->

    

    <?php get_sidebar('gewinnspiel'); ?>

    

    <div class="clear"></div>

        

</div>







<?php get_footer(); ?>