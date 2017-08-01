<?php
/**

 * @package WordPress

 * @subpackage Default_Theme

 */
get_header();
?>

<!-- start centerpart -->

<div id="center-part"> 

    <!-- fino bar -->

    <div id="one" class="fino-bar">
        <div class="centering main-top">
            <?php the_field('heading_content'); ?>
            <div class="arrow"> <a href="#one"><img src="<?php echo get_template_directory_uri(); ?>/images/down-arrow.png" alt="" /></a> </div>
            <div class="pro">
                <?php
                $args = array('post_type' => 'profino', 'post_status' => 'publish', 'posts_per_page' => 6);

                $loop = new WP_Query($args);

                $i = 1;

                while ($loop->have_posts()) : $loop->the_post();
                    ?>
                    <div class="box <?php
                    if ($i == 3 || $i == 6) {
                        echo 'spc';
                    }
                    ?>">
                        <div class="top">
                            <?php the_post_thumbnail(); ?>
                        </div>
                        <h4>#
                            <?php the_title(); ?>
                        </h4>
                        <?php the_content(); ?>
                    </div>
                    <?php
                    $i++;
                endwhile;
                wp_reset_query();
                ?>
            </div>
        </div>
    </div>

    <!-- finish fino bar --> 

    <!-- all bar -->

    <div class="all-bar scrollme" >
        <div class="cantain">
            <div class="left">

                <h2>
                    <?php the_field('wird_leichter_left') ?>
                </h2>

            </div>
            <div class="middle">
                <div data-scale="0" data-to="0.5" data-from="1.2" data-when="enter" class="effect_box effect_box_scale animateme" style="opacity: 1; transform: translate3d(0px, 0px, 0px) rotateX(0deg) rotateY(0deg) rotateZ(0deg) scale3d(0.174, 0.174, 0.174);">
                    <div class="new">
                        <h3>
                            <?php the_field('wird_leichter_tag_line') ?>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="right">

                <?php the_field('wird_leichter_right') ?>

            </div>
        </div>
    </div>

    <!-- finish all-bar --> 

    <!-- rund bar -->

    <div class="rund-bar"  id="two">
        <div class="centering">
            <h2>rundgang</h2>
            <div class="video">
                <div class="left"> <img src="<?php the_field('rundgang_top'); ?>" alt="" /> <a class="various fancybox.iframe" id="video" href="<?php the_field('rundgang_video_url'); ?>?autoplay=1">
                        <div class="play"> <img src="<?php echo get_template_directory_uri(); ?>/images/play.png" alt="" /> </div>
                    </a> </div>
                <div class="right">
                    <?php the_field('rundgang_content'); ?>
                </div>
                <?php
                // loop through the rows of data

                while (have_rows('rundgang_list')) : the_row();
                    ?>
                    <div class="names">
                        <div class="poto"> <img src="<?php the_sub_field('image'); ?>" alt="" /> </div>
                        <div class="msg">
                            <p><span><img src="<?php echo get_template_directory_uri(); ?>/images/double-arrow.png" alt="" /></span>
                                <?php the_sub_field('content'); ?>
                                <span><img src="<?php echo get_template_directory_uri(); ?>/images/double-arrow1.png" alt=""/></span></p>
                            <h4>
                                <?php the_sub_field('title'); ?>
                            </h4>
                        </div>
                    </div>
                    <?php
                endwhile;
                ?>
            </div>
        </div>
    </div>

    <!-- finish rund bar --> 

    <!-- wird bar -->

    <div class="wird-bar scrollme">
        <div class="cantain">
            <div class="left">

                <h2>
                    <?php the_field('wird_leichter_left_content') ?>
                </h2>

            </div>
            <div class="middle">
                <div data-scale="0" data-to="0.5" data-from="1.2" data-when="enter" class="effect_box effect_box_scale animateme" style="opacity: 1; transform: translate3d(0px, 0px, 0px) rotateX(0deg) rotateY(0deg) rotateZ(0deg) scale3d(0.174, 0.174, 0.174);">
                    <div class="new">
                        <h3>
                            <?php the_field('wird_leichter_tagline_content') ?>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="right">

                <?php the_field('wird_leichter_right_content') ?>

            </div>
        </div>
    </div>

    <!-- finish wird-bar --> 

    <!-- tech bar -->

    <div class="tech-bar"  id="three">
        <div class="centering">
            <h2>highlights</h2>
            <div class="nor">
                <?php
                $args = array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 1);

                $loop = new WP_Query($args);

                $i = 1;

                while ($loop->have_posts()) : $loop->the_post();
                    ?>
                    <div class="left">
                        <?php the_post_thumbnail(); ?>
                        <h3>
                            <?php the_field('custom_date'); ?>
                        </h3>
                        <span>
                            <?php the_title(); ?>
                        </span> <span>
                            <?php the_field('sub_title'); ?>
                        </span>
                        <div class="overlay">
                            <h4>
                                <?php the_field('custom_date'); ?>
                            </h4>
                            <span>
                                <?php the_title(); ?>
                            </span> <span>
                                <?php the_field('sub_title'); ?>
                            </span>
                            <p class="cnt"><?php // echo substr(strip_tags($loop->post_content), 0, 70);  ?>
                                <?php
                                $content = get_the_content();
                                $content = strip_tags($content);
                                echo substr($content, 0, 255);
                                ?>…....<a href="<?php the_permalink(); ?>">mehr</a> </p>
                            <p class="mbl-cnt"><?php // echo substr(strip_tags($loop->post_content), 0, 70);  ?>
                                <?php
                                $content = get_the_content();
                                $content = strip_tags($content);
                                echo substr($content, 0, 75);
                                ?>…....<a href="<?php the_permalink(); ?>">mehr</a> </p>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_query();
                ?>
                <div class="right">
                    <?php
                    $args = array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 1, 'offset' => 1);

                    $loop = new WP_Query($args);

                    $i = 1;

                    while ($loop->have_posts()) : $loop->the_post();
                        ?>
                        <div class="top">
                            <?php the_post_thumbnail('post-small') ?>
                            <h3>
                                <?php the_field('custom_date'); ?>
                            </h3>
                            <span>
                                <?php the_title(); ?>
                            </span>
                            <div class="overlay">
                                <h4>
                                    <?php the_field('custom_date'); ?>
                                </h4>
                                <span>
                                    <?php the_title(); ?>
                                </span>
                                <p><?php // echo substr(strip_tags($loop->post_content), 0, 70);  ?>
                                    <?php
                                    $content = get_the_content();
                                    $content = strip_tags($content);
                                    echo substr($content, 0, 70);
                                    ?>…....<a href="<?php the_permalink(); ?>">mehr</a> </p>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_query();
                    ?>
                    <?php
                    $args = array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 1, 'offset' => 2);

                    $loop = new WP_Query($args);

                    $i = 1;

                    while ($loop->have_posts()) : $loop->the_post();
                        ?>
                        <div class="bottom">
                            <?php the_post_thumbnail('post-small') ?>
                            <h3>
                                <?php the_field('custom_date'); ?>
                            </h3>
                            <span>
                                <?php the_title(); ?>
                            </span>
                            <div class="overlay">
                                <h4>
                                    <?php the_field('custom_date'); ?>
                                </h4>
                                <span>
                                    <?php the_title(); ?>
                                </span>
                                <p><?php // echo substr(strip_tags($loop->post_content), 0, 70);   ?>
                                    <?php
                                    $content = get_the_content();
                                    $content = strip_tags($content);
                                    echo substr($content, 0, 70);
                                    ?>…....<a href="<?php the_permalink(); ?>">mehr</a> </p>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_query();
                    ?>
                </div>
                <?php
                $args = array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 1, 'offset' => 3);

                $loop = new WP_Query($args);

                $i = 1;

                while ($loop->have_posts()) : $loop->the_post();
                    ?>
                    <div class="box1">
                        <?php the_post_thumbnail('post-medium') ?>
                        <h3>
                            <?php the_field('custom_date'); ?>
                        </h3>
                        <span>
                            <?php the_title(); ?>
                        </span> <span>
                            <?php the_field('sub_title'); ?>
                        </span>
                        <div class="overlay">
                            <h4>
                                <?php the_field('custom_date'); ?>
                            </h4>
                            <span>
                                <?php the_title(); ?>
                            </span> <span>
                                <?php the_field('sub_title'); ?>
                            </span>
                            <p><?php echo substr(strip_tags($post->post_content), 0, 70); ?>....<a href="<?php the_permalink(); ?>">mehr</a></p>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_query();
                ?>
                <?php
                $args = array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 1, 'offset' => 4);

                $loop = new WP_Query($args);

                $i = 1;

                while ($loop->have_posts()) : $loop->the_post();
                    ?>
                    <div class="box2">
                        <?php the_post_thumbnail('post-medium') ?>
                        <h3>
                            <?php the_field('custom_date'); ?>
                        </h3>
                        <span>
                            <?php the_title(); ?>
                        </span> <span>
                            <?php the_field('sub_title'); ?>
                        </span>
                        <div class="overlay">
                            <h4>
                                <?php the_field('custom_date'); ?>
                            </h4>
                            <span>
                                <?php the_title(); ?>
                            </span> <span>
                                <?php the_field('sub_title'); ?>
                            </span>
                            <p><?php // echo substr(strip_tags($loop->post_content), 0, 70);  ?>
                                <?php
                                $content = get_the_content();
                                $content = strip_tags($content);
                                echo substr($content, 0, 100);
                                ?>…....<a href="<?php the_permalink(); ?>">mehr</a> </p>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_query();
                ?>
            </div>
            <div class="jet"> <a href="<?php the_field('highlights_link'); ?>" class="link">Jetzt anmelden</a> </div>
        </div>
    </div>

    <!-- finish tech bar --> 

    <!-- .ger-bar -->

    <div class="ger-bar">
        <div class="centering animatedParent">
            <?php
// loop through the rows of data

            if (have_rows('gerettete_list')):
                $counters = 1;
                $jks = 1;
                while (have_rows('gerettete_list')) : the_row();

                    $count = get_sub_field('count_text');
                    $icon = get_sub_field('icon');
                    ?>
                    <div class="box <?php
                    if ($counters == 1) {
                        echo 'animated fadeInUp slow go delay-250';
                    }
                    ?> <?php
                    if ($counters == 2) {
                        echo 'animated fadeInUp slow go delay-500';
                    }
                    ?> <?php
                    if ($counters == 3) {
                        echo 'animated fadeInUp slow go delay-750';
                    }
                    ?> <?php
                    if ($counters == 4) {
                        echo 'active animated fadeInUp slow go delay-1000';
                    }
                    ?>  " id="<?php echo $counters; ?>"> 
                        <div class="top">
                            <?php if ($icon) { ?>

                                <img src="<?php echo $icon['sizes']['icon-small']; ?>">

                            <?php } else { ?>
                                <p class="counter" data-count="<?php the_sub_field('count_text'); ?>">
                                    0 
                                </p>
                            <?php } ?>

                        </div>
                        <span>
                            <?php the_sub_field('text'); ?>
                        </span> </div>
                    <?php
                    $counters++;
                    $jks++;
                endwhile;
            endif;

            wp_reset_query();
            ?>
        </div>
    </div>

    <div style="display:none" class="ger-bar mobile">
        <div class="centering">
            <?php
            // loop through the rows of data

            if (have_rows('gerettete_list')):
                $counters = 1;
                $jks = 1;
                while (have_rows('gerettete_list')) : the_row();

                    $count = get_sub_field('count_text');
                    $icon = get_sub_field('icon');
                    ?>
                    <div class="box <?php
                    if ($counters == 1) {
                        echo 'left animated bounceInLeft slow go';
                    }
                    ?> <?php
                    if ($counters == 2) {
                        echo 'top animated bounceInDown slow go';
                    }
                    ?> <?php
                    if ($counters == 3) {
                        echo 'top animated bounceInDown slow go';
                    }
                    ?> <?php
                    if ($counters == 4) {
                        echo 'left right active animated bounceInRight slow go';
                    }
                    ?>  " id="<?php echo $counters; ?>"> 
                        <div class="top">
                            <?php if ($icon) { ?>

                                <img src="<?php echo $icon['sizes']['icon-small']; ?>">

                            <?php } else { ?>
                                <p class="counter" data-count="<?php the_sub_field('count_text'); ?>">
                                    0 
                                </p>
                            <?php } ?>

                        </div>
                        <span>
                            <?php the_sub_field('text'); ?>
                        </span> </div>
                    <?php
                    $counters++;
                    $jks++;
                endwhile;
            endif;

            wp_reset_query();
            ?>
        </div>
    </div>

    <!-- finish ger-bar --> 

    <!-- agenda bar -->

    <div class="agenda-bar" id="four">
        <div class="centering">
            <h2>agenda</h2>
            <div class="bert">
                <div class="jun">
                    <div class="top-agenda">
                        <?php $image = get_field('agenda_banner'); ?>
                        <img src="<?php echo $image['url']; ?>" alt="" />

                        <?php
                        query_posts(array('post_type' => 'agenda', 'showposts' => 1, 'post_status' => 'publish', 'orderby' => 'meta_value', 'meta_key' => 'agenda_is_top', 'meta_value' => true));
                        $ye = array();
                        $yeCheck = array();
                        if (have_posts()) : while (have_posts()) : the_post();
                                ?>
                                <?php
                                $ym = explode('-', get_field('date', get_the_ID()));
                                array_push($ye, $ym[0]);
                                $yeCheck[$ym[0]][] = get_the_ID();
                                $yea = array_unique($ye);
                                ?>		  
                                <?php
                            endwhile;
                        endif;
                        wp_reset_query();
                        ?>
                        <?php foreach ($yeCheck as $year => $pid) { ?>

                            <?php
                            $y = substr($year, 0, 4);
                            $m = substr($year, 4, 2);
                            switch ($m) {
                                case "01" :
                                    $stringmonth = "Jan";
                                    break;
                                case "02" :
                                    $stringmonth = "feb";
                                    break;
                                case "03" :
                                    $stringmonth = "März";
                                    break;
                                case "04" :
                                    $stringmonth = "April";
                                    break;
                                case "05" :
                                    $stringmonth = "Mai";
                                    break;
                                case "06" :
                                    $stringmonth = "Juni";
                                    break;
                                case "07" :
                                    $stringmonth = "Juli";
                                    break;
                                case "08" :
                                    $stringmonth = "Aug";
                                    break;
                                case "09" :
                                    $stringmonth = "Sept";
                                    break;
                                case "10" :
                                    $stringmonth = "Okt";
                                    break;
                                case "11" :
                                    $stringmonth = "Nov";
                                    break;
                                case "12" :
                                    $stringmonth = "Dez";
                                    break;
                                default:
                                    break;
                            }
                            //echo $stringmonth.' '.$y; 
                            ?> 
                            <?php
                            query_posts(array('post_type' => 'agenda', 'post__in' => $pid));

                            $i = 1;
                            if (have_posts()) : while (have_posts()) : the_post();
                                    ?>
                                    <?php
                                    $format_in = 'Ym-d';
                                    $format_out = 'd';
                                    $date = DateTime::createFromFormat($format_in, get_field('date', get_the_ID()));
                                    $ndate = DateTime::createFromFormat('Ym-d', get_field('date'));
                                    $sub = get_field('sub_headline');
                                    ?>

                                    <div class="title">
                                        <div class="left"> 
                                            <div class="cl">
                                            <?php if ($date->format($format_out)) { ?>
                                                <h5>
                                                    <span> <?php echo $date->format($format_out); ?>.</span>
                                                    <span><?php echo $stringmonth; ?></span>
                                                </h5>
                                            <?php } ?> 
                                            <h6 style="display:none;">
                                                <?php echo $ndate->format('d.m.y'); ?>
                                                <span><?php the_field('day'); ?></span>			  
                                            </h6> 
                                            </div>
                                        </div>
                                        <div class="right">
                                            <h3>
                                                <?php the_field('author_name'); ?>
                                            </h3>
                                            <em>
                                                <?php if ($sub) { ?>
                                                    <?php echo $sub; ?>

                                                <?php } else { ?>
                                                    <?php the_title(); ?>
                                                <?php } ?>		
                                            </em>
                                            <p class="show"><?php echo strip_tags(get_the_content()); ?></p>
                                        </div>
                                    </div>
                                    <?php
                                endwhile;
                            endif;
                            ?>
                        <?php } ?>
                    </div>



                    <?php
                    query_posts(array('post_type' => 'agenda', 'showposts' => 11, 'meta_key' => 'date', 'order' => 'ASC', 'orderby' => 'meta_value_num', 'post_status' => 'publish', 'paged' => $paged));
                    $ye = array();
                    $yeCheck = array();
                    if (have_posts()) : $k = 0;
                        while (have_posts()) : the_post();
                            ?>
                            <?php
                            $ym = explode('-', get_field('date', get_the_ID()));

                            array_push($ye, $ym[0]);

                            $yeCheck[$ym[0]][] = get_the_ID();

                            $yea = array_unique($ye);
                            ?>
                            <?php
                        endwhile;
                    endif;
                    wp_reset_query();
                    ?>
                    <?php foreach ($yeCheck as $year => $pid) { ?>

                        <?php
                        $y = substr($year, 0, 4);
                        $m = substr($year, 4, 2);
                        switch ($m) {
                            case "01" :
                                $stringmonth = "Jan";
                                break;
                            case "02" :
                                $stringmonth = "feb";
                                break;
                            case "03" :
                                $stringmonth = "März";
                                break;
                            case "04" :
                                $stringmonth = "April";
                                break;
                            case "05" :
                                $stringmonth = "Mai";
                                break;
                            case "06" :
                                $stringmonth = "Juni";
                                break;
                            case "07" :
                                $stringmonth = "Juli";
                                break;
                            case "08" :
                                $stringmonth = "Aug";
                                break;
                            case "09" :
                                $stringmonth = "Sept";
                                break;
                            case "10" :
                                $stringmonth = "Okt";
                                break;
                            case "11" :
                                $stringmonth = "Nov";
                                break;
                            case "12" :
                                $stringmonth = "Dez";
                                break;
                            default:
                                break;
                        }

                        //echo $stringmonth.' '.$y; 
                        ?> 
                        <?php
                        query_posts(array('post_type' => 'agenda', 'post__in' => $pid));
                        if (have_posts()) : while (have_posts()) : the_post();
                                $sub = get_field('sub_headline');
                                ?>
                                <?php
                                $format_in = 'Ym-d';
                                $format_out = 'd';
                                $date = DateTime::createFromFormat($format_in, get_field('date', get_the_ID()));
                                $ndate = DateTime::createFromFormat('Ym-d', get_field('date'));
                                ?>

                                <div class="box <?php
                                if (get_field('agenda_is_top')) {
                                    echo "checktop";
                                }
                                ?> ">

                                    <div class="grp1">

                                        <div class="inner">
                                            <div class="cl">
                                            <?php if ($date->format($format_out)) { ?>
                                                <h5>
                                                    <span> <?php echo $date->format($format_out); ?>.</span>
                                                    <span><?php echo $stringmonth; ?></span>
                                                </h5>
                                            <?php } ?> 
                                            <h6 style="display:none;">
                                                <?php echo $ndate->format('d.m.y'); ?>
                                                <span><?php the_field('day'); ?></span>

                                            </h6>
                                            </div>

                                        </div>
                                        <div class="inner2">
                                            <h3>
                                                <?php the_field('author_name'); ?>
                                            </h3>
                                            <p>
                                                <?php if ($sub) { ?>
                                                    <?php echo $sub; ?>

                                                <?php } else { ?>
                                                    <?php the_title(); ?>
                                                <?php } ?>	
                                            </p>
                                            <span class="bert-hide"><?php echo strip_tags(get_the_content()); ?></span>
                                        </div>
                                    </div>

                                </div>          
                                <?php
                                $k++;
                            endwhile;
                        endif;
                        wp_reset_query();
                        ?>
                    <?php } ?>

                    <!-- 2nd step --> 

                    <!-- 3rd step --> 

                    <!-- 4th step --> 

                    <!-- 5th step --> 

                    <!-- finish 5th step --> 
                    <div class="clear"></div>
                </div>
            </div>
            <div class="jet"> <a href="<?php the_field("agenda_link") ?>" class="link">Jetzt anmelden</a> </div>
        </div>
    </div>

    <!-- finish agenda bar --> 

    <!-- start slider bar -->

    <div class="slider-bar" id="five">

        <h2>weiterbildungsteam</h2>
        <div class="centering">
            <div class="slider"  >
                <div id="owl-weiterbil" class="owl-carousel">
                    <?php
                            $args = array('post_type' => 'team', 'post_status' => 'publish', 'posts_per_page' => 48);

                            $loop = new WP_Query($args);

                            $i = 1;



                            $nopost = $loop->found_posts;

                            while ($loop->have_posts()) : $loop->the_post();
                                ?>
                    <div class="item">
                        <div class="film_roll_child">
                         <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?>
                                        <div class="member">
                                            <h3>
                                                <?php the_field('name_title'); ?>
                                                <br/>
                                                <?php the_title(); ?>
                                                <span><?php the_field('sub_title') ?></span></h3>
                                        </div>
                                    </a>
                                    <div class="text">
                                        <div class="mid">
                                            <div class="left">
                                                <?php the_post_thumbnail(); ?>
                                            </div>
                                            <div class="right">
                                                <h3>
                                                    <?php the_field('name_title'); ?>
                                                    <em>·
                                                        <?php the_field('dseignation'); ?>
                                                    </em></h3>
                                                <div class="clear"></div>
                                                <ul>
                                                    <li><a href="<?php the_field('facebook'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social_img1.png" alt="" /></a></li>
                                                    <li><a href="<?php the_field('twitter'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social_img2.png" alt="" /></a></li>
                                                    <li><a href="<?php the_field('gogle_plus'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social_img4.png" alt="" /></a></li>
                                                    <li><a href="<?php the_field('email'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/message_img.png" alt="" /></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <p>
                                            <?php the_content(); ?>
                                        </p>
                                        <a href="#" class="close"></a> </div>
                        </div>
                    </div>
                                        <?php endwhile; ?>
                </div>

                
            </div>

        </div>

        <div class="centering">
            <div class="slider" style="display:none;">
                <div  class="flexslider mobile">
                    <ul class="slides">
                        <li>
                            <ul>
                                <?php
                                $args = array('post_type' => 'team', 'post_status' => 'publish', 'posts_per_page' => 48);

                                $loop = new WP_Query($args);

                                $i = 1;



                                $nopost = $loop->found_posts;

                                while ($loop->have_posts()) : $loop->the_post();
                                    ?>
                                    <li>
                                        <?php the_post_thumbnail(); ?>
                                        <div class="member">
                                            <h3>
                                                <?php the_field('name_title'); ?>
                                                <br/>
                                                <?php the_title(); ?>
                                                <span><?php the_field('sub_title') ?></span></h3>
                                        </div>
                                        <div class="text">
                                            <div class="mid">
                                                <div class="left">
                                                    <?php the_post_thumbnail(); ?>
                                                </div>
                                                <div class="right">
                                                    <h3>
                                                        <?php the_field('name_title'); ?>
                                                        <em>·
                                                            <?php the_field('dseignation'); ?>
                                                        </em></h3>
                                                    <div class="clear"></div>
                                                    <ul>
                                                        <li><a href="<?php the_field('facebook'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social_img1.png" alt="" /></a></li>
                                                        <li><a href="<?php the_field('twitter'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social_img2.png" alt="" /></a></li>
                                                        <li><a href="<?php the_field('gogle_plus'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social_img4.png" alt="" /></a></li>
                                                        <li><a href="<?php the_field('email'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/message_img.png" alt="" /></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <p>
                                                <?php the_content(); ?>
                                            </p>
                                            <a href="#" class="close"></a> </div>
                                    </li>
                                    <?php if ($i % 4 == 0) { ?>
                                    </ul>
                                </li>
                                <?php if ($nopost > $i) { ?>
                                    <li>
                                        <ul>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php
                                    $i++;
                                endwhile;
                                wp_reset_query();
                                ?>
                                <?php if ($i - 1 != $nopost) { ?>
                                </ul>
                            </li>
                        <?php } ?>
                        <span class="overlay"></span>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
            <a href="#" class="be">Referent werden</a>
            <div class="clear"></div>
            <div class="now">
                <p>Jetzt Referent für die profino werden!</p>
                <?php echo do_shortcode('[contact-form-7 id="121" title="Jetzt Referent für die profino werden!"]'); ?> </div>
            <div class="clear"></div>
        </div>
    </div>

    <!-- finish slider-bar --> 

    <!-- start slider2 bar -->

    <div class="slider2-bar" id="six">
        <div class="centering">
            <h2>aussteller</h2>
            <div class="slider">
                <div id="owl-aussteller" class="owl-carousel">
                    <?php
                    $args = array('post_type' => 'aussteller', 'post_status' => 'publish', 'posts_per_page' => 24);

                    $loop = new WP_Query($args);





                    $nopost = $loop->found_posts;

                    while ($loop->have_posts()) : $loop->the_post();
                        ?>
                        <div class="item"><?php the_post_thumbnail(); ?></div>
                    <?php endwhile; ?>
                </div>

                <div class="clear"></div>
            </div>


            <a href="#" class="were">Aussteller werden</a>
            <div class="clear"></div>
            <div class="sign"> <?php echo do_shortcode('[contact-form-7 id="121" title="Jetzt Referent für die profino werden!"]'); ?> </div>
            <div class="clear"></div>
        </div>
    </div>

    <!-- finish slider2-bar --> 

</div>
<?php get_footer(); ?>