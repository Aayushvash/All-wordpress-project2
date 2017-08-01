<?php
/* Image Block */
if(!class_exists('ICY_Contentbox_Text_Block')) {
	class ICY_Contentbox_Text_Block extends AQ_Block {
		
		function __construct() {
			$block_options = array(
				'name' => 'ContentBox Text',
				'size' => 'span12',
			);
			
			//create the widget
			parent::__construct('ICY_Contentbox_Text_Block', $block_options);
		}
		
		function form($instance) {
			$defaults = array(
				'img' => '',
				'height' => '',
				'crop' => 0,
				'background_color' => '',
				'scrolling_speed' =>'25'	
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			$font_family_options = array('PS'=>'PS Sans','BN'=>'Bebas Neue');
			$position_options = array('absolute'=>'Absolute','fixed'=>'Fixed','inherit'=>'Inherit','relative'=>'Relative','static'=>'Static');
			$border_style_options = array('solid'=>'Solid','dotted'=>'Dotted','double'=>'Double');
			$parallaxScroll_options = array('0'=>'No','1'=>'Yes');
			$text_font_weight_options = array('normal'=>'Normal','bold'=>'Bold');
			?>
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
				</label>
			</p>
            <p class="description">
				<label for="<?php echo $this->get_field_id('position_left') ?>">
					Position Left(optional)<br/>
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
				<label for="<?php echo $this->get_field_id('width') ?>">
					Width in px(optional)<br/>
					<?php echo aq_field_input('width', $block_id, $width) ?>
				</label>
			</p>
            <p class="description">
				<label for="<?php echo $this->get_field_id('height') ?>">
					Height in px(optional)<br/>
					<?php echo aq_field_input('height', $block_id, $height) ?>
				</label>
			</p>
            <p class="description">
				<label for="<?php echo $this->get_field_id('background_color') ?>">
					Background Color(optional)<br/>
					<?php echo aq_field_color_picker('background_color', $block_id, $background_color) ?>
				</label>
			</p>
            <p class="description">
				<label for="<?php echo $this->get_field_id('background_image') ?>">
					Background Image<br/>
					<?php echo aq_field_upload('background_image', $block_id, $background_image) ?>
				</label>
				<?php if($background_image) { ?>
				<div class="screenshot">
					<img src="<?php echo $background_image ?>" />
				</div>
				<?php } ?>
			</p>
            <p class="description">
				<label for="<?php echo $this->get_field_id('opacity') ?>">
					Opacity (optional)<br/>
					<?php echo aq_field_input('opacity', $block_id, $opacity) ?>
				</label>
			</p>
            <p class="description">
				<label for="<?php echo $this->get_field_id('layer_level') ?>">
					Layer Level (optional)<br/>
					<?php echo aq_field_input('layer_level', $block_id, $layer_level) ?>
				</label>
			</p>
            <p class="description">
				<label for="<?php echo $this->get_field_id('text_font_family') ?>">
					Text Font Family<br/>
					<?php echo aq_field_select('text_font_family', $block_id, $font_family_options, $text_font_family) ?>
				</label>
			</p>
             <p class="description">
				<label for="<?php echo $this->get_field_id('text_font_size') ?>">
					Text Font Size(optional)<br/>
					<?php echo aq_field_input('text_font_size', $block_id, $text_font_size); ?>
				</label>
			</p>
            <p class="description">
				<label for="<?php echo $this->get_field_id('text_font_color') ?>">
					Text Font Color(optional)<br/>
					<?php echo aq_field_color_picker('text_font_color', $block_id, $text_font_color) ?>
				</label>
			</p>
            <p class="description">
				<label for="<?php echo $this->get_field_id('text_line_height') ?>">
					Text Line Height(optional)<br/>
					<?php echo aq_field_input('text_line_height', $block_id, $text_line_height); ?>
				</label>
			</p>
             <p class="description">
				<label for="<?php echo $this->get_field_id('text_font_weight') ?>">
					Text Font Weight<br/>
					<?php echo aq_field_select('text_font_weight', $block_id, $text_font_weight_options, $text_font_weight) ?>
				</label>
			</p>
            <p class="description">
				<label for="<?php echo $this->get_field_id('heading_font_family') ?>">
					Heading Font Family<br/>
					<?php echo aq_field_select('heading_font_family', $block_id, $font_family_options, $heading_font_family) ?>
				</label>
			</p>
             <p class="description">
				<label for="<?php echo $this->get_field_id('heading_font_size') ?>">
					Heading Font Size(optional)<br/>
					<?php echo aq_field_input('heading_font_size', $block_id, $heading_font_size); ?>
				</label>
			</p>
            <p class="description">
				<label for="<?php echo $this->get_field_id('heading_font_color') ?>">
					Heading Font Color(optional)<br/>
					<?php echo aq_field_color_picker('heading_font_color', $block_id, $heading_font_color) ?>
				</label>
			</p>
            
            <p class="description">
				<label for="<?php echo $this->get_field_id('border_color') ?>">
					Border Color(optional)<br/>
					<?php echo aq_field_color_picker('border_color', $block_id, $border_color) ?>
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
				<label for="<?php echo $this->get_field_id('content_title') ?>">
					Content Title<br/>
					<?php echo aq_field_input('content_title', $block_id, $content_title) ?>
				</label>
			</p>  
            <p class="description">
			<label for="<?php echo $this->get_field_id('text') ?>">
				Content
				<?php echo aq_field_textarea('text', $block_id, $text, $size = 'full') ?>
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
			   .<?php echo $blockId;?> { 
			       <?php if($background_image){ ?>background-image:url('<?php echo $background_image; ?>'); <?php }?>
				   background-repeat:no-repeat;
				   <?php if($background_color){ ?>background-color:<?php echo $background_color; ?>;<?php }?>
				   <?php if($width){ ?>width:<?php echo $width; ?>px; <?php }?>
				   <?php if($height){ ?>height:<?php echo $height; ?>px; <?php }?>
				   top: <?php echo $position_top; ?>;
				   left: <?php echo $position_left; ?>;
				   right: <?php echo $position_right; ?>;
				   bottom: <?php echo $position_bottom; ?>;
				   <?php if($opacity){ ?>opacity:<?php echo $opacity; ?>;<?php }?>
				   <?php if($position){ ?>position:<?php echo $position;?>;<?php }?>
				   <?php if($border_color){ ?>border:<?php if($border_thickness) echo $border_thickness.'px'; ?><?php if($border_style) echo ' '.$border_style; ?><?php echo $border_color;?>;<?php }?>
				   <?php if($layer_level){ ?>z-index:<?php echo $layer_level;?>;<?php }?>
				    <?php if($border_color){ ?>border:<?php if($border_thickness) echo $border_thickness.'px'; ?><?php if($border_style) echo ' '.$border_style; ?><?php echo $border_color;?>;<?php }?>
			  }
			</style>
            <div class="<?php echo $blockId;?>">
            <?php if($content_title){ ?><h2 style="text-transform: none; font-family: <?php if($heading_font_family=='PS') echo 'PTSansRegular'; else echo 'BebasNeueRegular';?>;<?php if($heading_font_size){ echo 'font-size:'.$heading_font_size.'px;'; } ?><?php if($heading_font_color){ echo 'color:'.$heading_font_color.';'; } ?>"><?php echo $content_title; ?></h2><?php }?>
            <?php if($text){ ?><div style="font-family:<?php if($text_font_family=='PS') echo 'PTSansRegular'; else echo 'BebasNeueRegular';?>;<?php if($text_font_size){ echo 'font-size:'.$text_font_size.'px;'; } ?><?php if($text_font_color){ echo 'color:'.$text_font_color.';'; } ?> <?php if($text_line_height){ echo 'line-height:'.$text_line_height.'px;'; } ?>"><?php echo html_entity_decode($text); ?></div><?php }?>
            </div>
            <?php 
			} else {
				?>
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
			   .<?php echo $blockId;?> { 
			       <?php if($background_image){ ?>background-image:url('<?php echo $background_image; ?>'); <?php }?>
				   background-repeat:no-repeat;
				   <?php if($background_color){ ?>background-color:<?php echo $background_color; ?>;<?php }?>
				   <?php if($width){ ?>width:<?php echo $width; ?>px; <?php }?>
				   <?php if($height){ ?>height:<?php echo $height; ?>px; <?php }?>
				   top: <?php echo $position_top; ?>;
				   left: <?php echo $position_left; ?>;
				   right: <?php echo $position_right; ?>;
				   bottom: <?php echo $position_bottom; ?>;
				   <?php if($opacity){ ?>opacity:<?php echo $opacity; ?>;<?php }?>
				   <?php if($position){ ?>position:<?php echo $position;?>;<?php }?>
				   <?php if($border_color){ ?>border:<?php if($border_thickness) echo $border_thickness.'px'; ?><?php if($border_style) echo ' '.$border_style; ?><?php echo $border_color;?>;<?php }?>
				   <?php if($layer_level){ ?>z-index:<?php echo $layer_level;?>;<?php }?>
				    <?php if($border_color){ ?>border:<?php if($border_thickness) echo $border_thickness.'px'; ?><?php if($border_style) echo ' '.$border_style; ?><?php echo $border_color;?>;<?php }?>
			  }
			</style>
            <style type="text/css">
			/*  #parallax-<?php echo $block_id; ?> { <?php if($layer_level){ ?>z-index:<?php echo $layer_level;?>;<?php }?>  <?php if($position){ ?>position:<?php echo $position;?>;<?php }?> left: 0; top: 0; <?php if($width){ ?>width:<?php echo $width; ?>px; <?php }?> }*/
			  #bg-<?php echo $block_id; ?> { <?php if($width){ ?>width:<?php echo $width; ?>px; <?php }?> <?php if($position){ ?>position:<?php echo $position;?>;<?php }?> <?php if($position_top){ ?>top: <?php echo $position_top; ?>px; <?php }?> <?php if($position_left){ ?>left: <?php echo $position_left; ?>px; <?php }?> }
			</style>
            
             <div id="parallax-<?php echo $block_id; ?>" class="<?php echo $blockId;?>">
                <div id="bg-<?php echo $block_id; ?>">
                 <?php if($content_title){ ?><h2 style="text-transform: none; font-weight: bold; font-family:<?php if($heading_font_family=='PS') echo 'PTSansRegular'; else echo 'BebasNeueRegular';?>;<?php if($heading_font_size){ echo 'font-size:'.$heading_font_size.'px;'; } ?><?php if($heading_font_color){ echo 'color:'.$heading_font_color.';'; } ?>"><?php echo $content_title; ?></h2><?php }?>
            <?php if($text){ ?><div style="font-family:<?php if($text_font_family=='PS') echo 'PTSansRegular'; else echo 'BebasNeueRegular';?>;<?php if($text_font_size){ echo 'font-size:'.$text_font_size.'px;'; } ?><?php if($text_font_color){ echo 'color:'.$text_font_color.';'; } ?><?php if($text_font_weight){ echo 'font-weight:'.$text_font_weight.';'; } ?> <?php if($text_line_height){ echo 'line-height:'.$text_line_height.'px;'; } ?>"><?php echo  html_entity_decode($text); ?></div><?php }?>
                </div>
             </div>
                <?php 
			   }
		}
		
		
	}
}