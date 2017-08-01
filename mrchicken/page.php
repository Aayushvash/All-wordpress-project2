<?php

/**

 * @package WordPress

 * @subpackage Default_Theme

 */



get_header(); ?>



<!-- begin content -->

<section id="content-wrap">

    

    <!-- begin centerwrap -->

    <section id="center-wrap">

	

        <!-- begin text block -->


		<article class="text-block">

    

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <div class="post" id="post-<?php the_ID(); ?>">

            

                <h1><?php the_title(); ?></h1>

                

                <div class="entry">

                

                    <?php the_content('<p class="serif">' . __('Read the rest of this page &raquo;', 'kubrick') . '</p>'); ?>

    

                    <?php wp_link_pages(array('before' => '<p><strong>' . __('Pages:', 'kubrick') . '</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

    

                </div>

            </div>

            <?php endwhile; endif; ?>

            

            <div class="clear"></div>

            

            <?php $link = get_field('link');

			if(($link)!="") {

			 ?>

     <!--      <a href="<?php //the_field('link'); ?>" class="order">Orderr</a> -->

            <?php } ?>

            

        </article>

        <!-- finish text block -->



    </section>

    <!-- finish center wrap -->



</section>

<!-- finish content -->

        

    

<?php get_footer(); ?>