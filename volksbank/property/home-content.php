<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
    <div class="col-ttc ct">    
           <div class="page-content">
    			<?php the_content(); ?>
                </div>
				</div>

<?php endwhile; endif; ?>

<div class="col-otc ct cr">
<div id="sidebar">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(__('Homepage Sidebar','bobox')) ) : ?> <?php endif; ?>
</div>
</div>
<div class="clear"></div>
