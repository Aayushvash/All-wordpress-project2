<?php
/* Image Block */
if(!class_exists('ICY_Html_Block')) {
	class ICY_Html_Block extends AQ_Block {
		
		function __construct() {
			$block_options = array(
				'name' => 'Html Block',
				'size' => 'span12',
			);
			
			//create the widget
			parent::__construct('ICY_Html_Block', $block_options);
		}
		
		function form($instance) {
		
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>
            <p class="description">
			<label for="<?php echo $this->get_field_id('content') ?>">
				Content (Enter Html Code)
				<?php echo aq_field_textarea('content', $block_id, $content, $size = 'full',$rows='30') ?>
			</label>
		    </p>
            <?php
		}
		
		function block($instance) {
			extract($instance);
			global $icy_options; 
			
			$blockClass = 'aq-block-'.$id_base; 
			$blockId = 'aq-block-'.$template_id.'-'.$order.'';
			if(empty($parallaxScroll))
			{ 
			 ?>
              <style>
			   #<?php echo $blockId;?> { 
			     max-width: 1280px; margin: 0 auto; position: relative;z-index:999;
			   }
			</style>   
             <?php 
			  print(html_entity_decode($content));
			}
			else
			{ ?>
            <style>
			   #<?php echo $blockId;?> { 
			     max-width: 1280px; margin: 0 auto; position: relative; z-index:999;
			   }
			</style>   
            <script type="text/javascript">
				$(document).ready(function() {
					$(window).bind('scroll',function(e){
						parallaxScroll_<?php echo $block_id; ?>();
					});
				});
				function parallaxScroll_<?php echo $block_id; ?>(){
					var scrolled = $(window).scrollTop();
					$('#parallax-<?php echo $block_id; ?>').css('top',(0-(scrolled*.<?php echo $scrolling_speed; ?>))+'px');
				}
			</script>
            <style type="text/css">
			  #parallax-<?php echo $block_id; ?> { <?php if($layer_level){ ?>z-index:<?php echo $layer_level;?>;<?php }?>  <?php if($position){ ?>position:<?php echo $position;?>;<?php }?> left: 0; top: 0; width: 100%; }			  
			</style>
             <div id="parallax-<?php echo $block_id; ?>">
                   <img id="bg-<?php echo $block_id; ?>" src="<?php echo $img; ?>" style="
				   <?php if($width){ ?>width:<?php echo $width; ?>px; <?php }?>
				   <?php if($height){ ?>height:<?php echo $height; ?>px; <?php }?>
				   top: <?php echo $position_top; ?>px;
				   left: <?php echo $position_left; ?>;
                   right: <?php echo $position_right; ?>px;
				   bottom: <?php echo $position_bottom; ?>px;
				   <?php if($opacity){ ?>opacity:<?php echo $opacity; ?>;<?php }?>
				   <?php if($position){ ?>position:<?php echo $position;?>;<?php }?>
				   <?php if($border_color){ ?>border:<?php if($border_thickness) echo $border_thickness.'px'; ?><?php if($border_style) echo ' '.$border_style; ?><?php echo $border_color;?>;<?php }?>
				   <?php if($layer_level){ ?>z-index:<?php echo $layer_level;?>;<?php }?>" />
                </div>
         
            <?php 
			}
		}
		
		
	}
}