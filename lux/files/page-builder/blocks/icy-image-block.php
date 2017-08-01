<?php
/* Image Block */
if(!class_exists('ICY_Image_Block')) {
	class ICY_Image_Block extends AQ_Block {
		
		function __construct() {
			$block_options = array(
				'name' => 'Image',
				'size' => 'span12',
			);
			
			//create the widget
			parent::__construct('ICY_Image_Block', $block_options);
		}
		
		function form($instance) {
			$defaults = array(
				'img' => '',
				'height' => '',
				'crop' => 0,
				'background_color' => '#ebebeb',
				'scrolling_speed' =>'25'	
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			$position_options = array('absolute'=>'Absolute','fixed'=>'Fixed','inherit'=>'Inherit','relative'=>'Relative','static'=>'Static');
			$border_style_options = array('solid'=>'Solid','dotted'=>'Dotted','double'=>'Double');
			$background_repeat_options = array('repeat'=>'Repeat','no-repeat'=>'No-Repeat','repeat-y'=>'Repeat-y','repeat-x'=>'Repeat-x');
			$parallaxScroll_options = array('0'=>'No','1'=>'Yes');
			?>
            
			<p class="description">
				<label for="<?php echo $this->get_field_id('img') ?>">
					Image<br/>
					<?php echo aq_field_upload('img', $block_id, $img) ?>
				</label>
				<?php if($img) { ?>
				<div class="screenshot">
					<img src="<?php echo $img ?>" />
				</div>
				<?php } ?>
			</p>
            <p class="description">
				<label for="<?php echo $this->get_field_id('position') ?>">
					Position<br/>
					<?php echo aq_field_select('position', $block_id, $position_options, $position) ?>
				</label>
			</p>
            <p class="description">
				<label for="<?php echo $this->get_field_id('position_top') ?>">
					Position Top (optional)<br/>
					<?php echo aq_field_input('position_top', $block_id, $position_top) ?>
                    <?php  ?>
				</label>
			</p>
            <p class="description">
				<label for="<?php echo $this->get_field_id('position_left') ?>">
					Position Left in px or in percentage (optional, for example 20% or 200px)<br/>
					<?php echo aq_field_input('position_left', $block_id, $position_left) ?>
				</label>
			</p>
            <p class="description">
				<label for="<?php echo $this->get_field_id('position_right') ?>">
					Position Right(optional)<br/>
					<?php echo aq_field_input('position_right', $block_id, $position_right) ?>
				</label>
			</p>
            <p class="description">
				<label for="<?php echo $this->get_field_id('position_bottom') ?>">
					Position Bottom(optional)<br/>
					<?php echo aq_field_input('position_bottom', $block_id, $position_bottom) ?>
				</label>
			</p>
			<p class="description">
				<label for="<?php echo $this->get_field_id('height') ?>">
					Height in px(optional)<br/>
					<?php echo aq_field_input('height', $block_id, $height) ?>
				</label>
			</p>
            <p class="description">
				<label for="<?php echo $this->get_field_id('width') ?>">
					Width in px(optional)<br/>
					<?php echo aq_field_input('width', $block_id, $width) ?>
				</label>
			</p>
            <p class="description">
				<label for="<?php echo $this->get_field_id('background_color') ?>">
					Background Color(optional)<br/>
					<?php echo aq_field_color_picker('background_color', $block_id, $background_color) ?>
				</label>
			</p>
            <p class="description">
				<label for="<?php echo $this->get_field_id('opacity') ?>">
					Opacity (optional)<br/>
					<?php echo aq_field_input('opacity', $block_id, $opacity) ?>
				</label>
			</p>
            <p class="description">
				<label for="<?php echo $this->get_field_id('layer_level') ?>">
					Layer Level(optional)<br/>
					<?php echo aq_field_input('layer_level', $block_id, $layer_level) ?>
				</label>
			</p>
            <p class="description">
				<label for="<?php echo $this->get_field_id(' border_color') ?>">
					Border Color(optional)<br/>
					<?php echo aq_field_color_picker('border_color', $block_id, $border_color)  ?>
				</label>
			</p>
            <p class="description">
				<label for="<?php echo $this->get_field_id('border_thickness') ?>">
					Border Thickness-in px(optional)<br/>
					<?php echo aq_field_input('border_thickness', $block_id, $border_thickness) ?>
				</label>
			</p>
            <p class="description">
				<label for="<?php echo $this->get_field_id('border_style') ?>">
					Border Style<br/>
					<?php echo aq_field_select('border_style', $block_id, $border_style_options, $border_style) ?>
				</label>
			</p>
             <p class="description">
				<label for="<?php echo $this->get_field_id('parallaxScroll') ?>">
					Parallax Scroll Script (optional)<br/>
					<?php echo aq_field_select('parallaxScroll', $block_id, $parallaxScroll_options, $parallaxScroll) ?>
				</label>
			</p>
            <p class="description">
				<label for="<?php echo $this->get_field_id('scrolling_speed') ?>">
					Scrolling Speed (optional)<br/>
					<?php echo aq_field_input('scrolling_speed', $block_id, $scrolling_speed) ?>
				</label>
			</p>		
            <?php
		}
		
		function block($instance) {
			extract($instance);
			global $icy_options; 
			$grid = $icy_options['grid_size'];
			//$width = icy_get_column_width($size, $grid);					
			$blockClass = 'aq-block-'.$id_base; 
			$blockId = 'aq-block-'.$template_id.'-'.$order.'';
			if(empty($parallaxScroll))
			{ 
			?>
			<style>
			   #<?php echo $blockId;?> { 
			     max-width: 1280px; margin: 0 auto; position: relative;
			   }
			</style>   
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
            <?php 
			}
			else
			{ ?>
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
            <style>
			   #<?php echo $blockId;?> { 
			     max-width: 1280px; margin: 0 auto; position: relative;
			   }
			</style>  
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