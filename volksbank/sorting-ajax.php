	<?php
	require_once('../../../wp-config.php');
	global $wpdb;
	$slug = $_REQUEST['sortBy']; 
?>
<ul id="content3">
     <?php if($slug==-1){query_posts('post_type=projecten&showposts=-1');  }else{
		query_posts('post_type=projecten&taxonomy=type&showposts=-1&term='.$slug); 
	 }
	  if (have_posts()) : while (have_posts()) : the_post(); ?>
                                            <li>
                                                <div class="pro-item">
                                                    <div class="pro-img">
                                                        <?php the_post_thumbnail('img1'); ?>
                                                        <div class="overlay pro-over">
                                                            <div class="on-center">
                                                                <div class="on-center-in">
                                                                    <span class="ln-icn"><img src="<?php bloginfo('template_url'); ?>/images/lnk-icn.png"/></span>
                                                                </div>
                                                            </div>
                                                            <a href="<?php the_permalink(); ?>" class="btn">Bekijk project</a>
                                                        </div>
                                                    </div>
                                                    <div class="pro-txt">
                                                        <h4><?php the_title(); ?></h4>
                                                        <span><?php the_field('title2'); ?></span>
                                                        <div class="pro-lnk">
                                                            <a href="javascript:void(0);"><?php the_field('text_1'); ?></a>
                                                            <a href="javascript:void(0);"><?php the_field('text_2'); ?></a>
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>
                                                </div>
                                            </li>
                                         <?php endwhile; endif; wp_reset_query(); ?>
	</ul>			  
<script type="text/javascript">
jQuery(document).ready(function(){
    
    //how much items per page to show
    var show_per_page = 6; 
    //getting the amount of elements inside content div
    var number_of_items = jQuery('#content3').children().size();
    //calculate the number of pages we are going to have
    var number_of_pages = Math.ceil(number_of_items/show_per_page);
    
    //set the value of our hidden input fields
    jQuery('#current_page').val(0);
    jQuery('#show_per_page').val(show_per_page);
    
    //now when we got all we need for the navigation let's make it '
    
    /* 
    what are we going to have in the navigation?
        - link to previous page
        - links to specific pages
        - link to next page
    */
    var navigation_html = '';
    var current_link = 0;
    while(number_of_pages > current_link){
        navigation_html += '<li><a class="page_link" href="javascript:go_to_page(' + current_link +')" longdesc="' + current_link +'"> '+ (current_link + 1) +'</a></li>';
        current_link++;
    }
    navigation_html += '';
    
    jQuery('#page_navigation').html(navigation_html);
    
    //add active_page class to the first page link
    jQuery('#page_navigation .page_link:first').addClass('active_page');
    	jQuery('#page_navigation li:first').addClass('active');
    jQuery('#page_navigation li').each(function(){
					jQuery(this).click(function(){
						jQuery(this).addClass('active');
						jQuery(this).siblings().removeClass('active');
						});
					});
    //hide all the elements inside content div
    jQuery('#content3').children().css('display', 'none');
    
    //and show the first n (show_per_page) elements
    jQuery('#content3').children().slice(0, show_per_page).css('display', 'block');
    
});

function previous(){
    
    new_page = parseInt(jQuery('#current_page').val()) - 1;
    //if there is an item before the current active link run the function
    if(jQuery('.active_page').prev('.page_link').length==true){
        go_to_page(new_page);
    }
    
}

function next(){
    new_page = parseInt(jQuery('#current_page').val()) + 1;
    //if there is an item after the current active link run the function
    if(jQuery('.active_page').next('.page_link').length==true){
        go_to_page(new_page);
    }
    
}
function go_to_page(page_num){
    //get the number of items shown per page
    var show_per_page = parseInt(jQuery('#show_per_page').val());
    
    //get the element number where to start the slice from
    start_from = page_num * show_per_page;
    
    //get the element number where to end the slice
    end_on = start_from + show_per_page;
    
    //hide all children elements of content div, get specific items and show them
    jQuery('#content3').children().css('display', 'none').slice(start_from, end_on).css('display', 'block');
    
    /*get the page link that has longdesc attribute of the current page and add active_page class to it
    and remove that class from previously active page link*/
    jQuery('.page_link[longdesc=' + page_num +']').addClass('active_page').siblings('.active_page').removeClass('active_page');
    
    //update the current page input field
    jQuery('#current_page').val(page_num);
}
        </script>