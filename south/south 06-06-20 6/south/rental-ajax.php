<?php
	require_once('../../../wp-config.php');
	global $wpdb;
	$date = $_REQUEST['date']; 
	$time = $_REQUEST['mr']; 
	//echo $date.'<-->'.$time;
	$args=array('post_type' => 'rental','post_status' => 'publish','meta_key' => 'booked_boats','meta_value' => true, 'posts_per_page'=> '-1');
	$the_query = new WP_Query( $args );
	$tid= array();
	if($the_query->have_posts()) {  
		while ($the_query->have_posts()) : $the_query->the_post(); 
			$cdate = get_field('add_date');
			$ctime = get_field('select_time');
			//echo  $cdate.''.$ctime;
			if($date==$cdate && $time==$ctime){
				//echo get_the_ID();
			  array_push($tid,get_the_ID());
			}
		endwhile;  } //echo "<pre>"; print_r($tid);
		if($tid){  ?>	
				<ul>
					<?php $i=1; query_posts(array('post_type' => 'rental','post__not_in' => $tid, 'posts_per_page'=> '-1')); 
					if (have_posts()) : while (have_posts()) : the_post(); ?>
						<li class="<?php if($i%3==0){ echo "last"; } ?>">
							<div class="image">
								<h2><?php the_title(); ?></h2>
								<a href="<?php echo get_permalink().'&date='.$date.'&time='.$time; ?>"><?php the_post_thumbnail('rental-img'); ?></a>
							</div>
							<span class="info">Max Passengers: <?php the_field('passenger'); ?><span><?php the_field('power'); ?></span><?php the_field('length'); ?></span>
							<div class="detailInfo">
								<a href="<?php echo get_permalink().'?date='.$date.'&time='.$time; ?>">More Details</a>
								<p>$<?php if($time==get_field('afternoon',10)){ the_field('afternoon'); }elseif(get_field('afternoon',10)){the_field('all_day');}else { the_field('4_hours');}  ?></p>
							</div>
						</li>
					<?php $i++; endwhile; endif; ?>
                </ul>
		<?php } else { ?>
			<ul>
				<?php $i=1; query_posts(array('post_type' => 'rental', 'posts_per_page'=> '-1')); 
				if (have_posts()) : while (have_posts()) : the_post(); ?>
					<li class="<?php if($i%3==0){ echo "last"; } ?>">
						<div class="image">
							<h2><?php the_title(); ?></h2>
							<a href="<?php echo get_permalink().'?date='.$date.'&time='.$time; ?>"><?php the_post_thumbnail('rental-img'); ?></a>
						</div>
						<span class="info">Max Passengers: <?php the_field('passenger'); ?><span><?php the_field('power'); ?></span><?php the_field('length'); ?></span>
						<div class="detailInfo">
							<a href="<?php echo get_permalink().'?date='.$date.'&time='.$time; ?>">More Details</a>
							<p>$<?php if($time==get_field('afternoon',10)){ the_field('afternoon'); }elseif(get_field('afternoon',10)){the_field('all_day');}else { the_field('4_hours');}  ?></p>
						</div>
					</li>
				<?php $i++; endwhile; endif; ?>
            </ul>
		<?php } ?>
		
				  
