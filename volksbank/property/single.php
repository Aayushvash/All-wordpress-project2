<?php 
/*
* @package     Property
* @author      Sabine Brings - brings-online.com
* @version     1.0
*/
?>
<?php get_header(); ?>
<div id="content">

<div class="col-ttc">
<div class="page-entry">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<h2 class="pagetitle"><?php the_title(); ?></h2>
 
				<?php the_content(); ?>
                

<?php 
$data = get_option('bo_options'); 
$cat =  isset( $data['blog']['bo_show_categories'] ) ? $data['blog']['bo_show_categories'] : null; 
$tag =  isset( $data['blog']['bo_show_tags'] ) ? $data['blog']['bo_show_tags'] : null;       
$date =  isset( $data['blog']['bo_show_date'] ) ? $data['blog']['bo_show_date'] : null; 
$author =  isset( $data['blog']['bo_show_author'] ) ? $data['blog']['bo_show_author'] : null; 
?>   
<div class="clear"></div>
<div class="meta-category">
<?php if($date == 'yes') { ?> <span class="meta">Veröffentlicht am:</span> <?php the_date(); ?><?php } ?><?php if($author == 'no' && $date == 'yes') { ?><br /><?php } ?>
<?php if($author == 'yes') { ?> | <span class="meta">von:</span> <?php the_author(); ?> <br /> <?php } ?>
<?php if($cat == 'yes') { ?>
<span class="meta">Kategorie:</span> <?php the_category(' &middot;'); ?><?php } ?>
<?php if ($tag == 'yes') { ?> &nbsp;| <?php $tags = the_tags();  if ( ! empty( $tags ) )	echo '<span class="meta">' . $tags . '</span>'; ?> <?php  } ?>
</div>
            
        		
	
 <?php comments_template('/comments.php');  ?>

		
	<?php endwhile; endif; ?>

	</div>
	</div><!-- eof col -->


<div class="col-otc cr">
<?php get_template_part('sidebar_blog'); ?>
</div>

<div class="clear"></div>
</div><!-- eof content -->
<?php get_footer(); ?>