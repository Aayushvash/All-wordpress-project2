<?php
/* Image Block */
if(!class_exists('ICY_Page_Background_Block')) {
	class ICY_Page_Background_Block extends AQ_Block {
		
		function __construct() {
			$block_options = array(
				'name' => 'Page   Background',
				'size' => 'span12',
			);
			
			//create the widget
			parent::__construct('ICY_Page_Background_Block', $block_options);
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
			$position_options = array('absolute'=>'Absolute','fixed'=>'Fixed','inherit'=>'Inherit','relative'=>'Relative','static'=>'Static');
			$parallaxScroll_options = array('0'=>'No','1'=>'Yes');
			$background_repeat_options = array('repeat'=>'Repeat','no-repeat'=>'No-Repeat','repeat-y'=>'Repeat-y','repeat-x'=>'Repeat-x');
			$background_position_options = array('0'=>'None','left top'=>'Left Top','left bottom'=>'Left Bottom','right bottom'=>'Right Bottom','right top'=>'Right Top','top'=>'Top','bottom'=>'Bottom','center'=>'Center');
			?>
            
			<p class="description">
				<label for="<?php echo $this->get_field_id('img') ?>">
					Background Image<br/>
					<?php echo aq_field_upload('img', $block_id, $img) ?>
				</label>
				<?php if($img) { ?>
				<div class="screenshot">
					<img src="<?php echo $img ?>" />
				</div>
				<?php } ?>
			</p>
            <p class="description">
				<label for="<?php echo $this->get_field_id('background_repeat') ?>">
					Background Repeat<br/>
					<?php echo aq_field_select('background_repeat', $block_id, $background_repeat_options, $background_repeat) ?>
				</label>
			</p>
            <p class="description">
				<label for="<?php echo $this->get_field_id('background_position') ?>">
					Background Position<br/>
					<?php echo aq_field_select('background_position', $block_id, $background_position_options, $background_position) ?>
				</label>
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
				<label for="<?php echo $this->get_field_id('height') ?>">
					Height in px<br/>
					<?php echo aq_field_input('height', $block_id, $height) ?>
				</label>
			</p>
            <p class="description">
				<label for="<?php echo $this->get_field_id('width') ?>">
					Width in px or in percentage(for example 100% or 500px)<br/>
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
            <p class="description">
				<label for="<?php echo $this->get_field_id('layer_level') ?>">
					Layer Level(optional)<br/>
					<?php echo aq_field_input('layer_level', $block_id, $layer_level) ?>
				</label>
			</p>
			<?php
		}
		
		function block($instance) {
			extract($instance);
			global $icy_options; 
			$grid = $icy_options['grid_size'];
			//$width = icy_get_column_width($size, $grid);	
			
			$blockId = 'aq-block-'.$template_id.'-'.$order.'';
			?>
            <script type="text/javascript">
				$(document).ready(function() {
					$('#content').height('<?php echo ($height-100); ?>');
				});
			</script>	
            <?php 
			if(empty($parallaxScroll))
			{ 
			?>
			<style>
			  #<?php echo $blockId;?> {
				   <?php if($img){ ?>background-image:url('<?php echo $img; ?>'); <?php }?>
				   <?php if($background_repeat){ ?>background-repeat:<?php echo $background_repeat; ?>;<?php }?>
				   <?php if($background_position){ ?>background-position: <?php echo $background_position; ?>;<?php }?>
				   <?php if($background_color){ ?>background-color:<?php echo $background_color; ?>;<?php }?>
				   background-size: 100% 100%;
				   <?php if($width){ ?>width:<?php echo $width; ?>; <?php }?>
				   <?php if($height){ ?>height:<?php echo $height; ?>px; <?php }?>
				    top: <?php echo $position_top; ?>px;
				   left: <?php echo $position_left; ?>;
                   right: <?php echo $position_right; ?>px;
				   bottom: <?php echo $position_bottom; ?>px;
				   <?php if($opacity){ ?>opacity:<?php echo $opacity; ?>;<?php }?>
				   <?php if($position){ ?>position:<?php echo $position;?>;<?php }?>
				   <?php if($layer_level){ ?>z-index:<?php echo $layer_level;?>;<?php }?>
				   margin: 0px;
				  }
			</style>
            <?php 
			}else { 
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
            
            <style type="text/css">
			  #parallax-<?php echo $block_id; ?> { width: 100%; <?php if($layer_level){ ?>z-index:<?php echo $layer_level;?>;<?php }?>  <?php if($position){ ?>position:<?php echo $position;?>;<?php }?> left: 0; top: 0; }
			  
			  #bg-<?php echo $block_id; ?> { 
				   <?php if($img){ ?>background-image:url('<?php echo $img; ?>'); <?php }?>
				   <?php if($background_repeat){ ?>background-repeat:<?php echo $background_repeat; ?>;<?php }?>
				   <?php if($background_position){ ?>background-position: <?php echo $background_position; ?>;<?php }?>
				   <?php if($background_color){ ?>background-color:<?php echo $background_color; ?>;<?php }?>
				   <?php if($width){ ?>width:<?php echo $width; ?>; <?php }?>
				   <?php if($height){ ?>height:<?php echo $height; ?>px; <?php }?>
				   background-size: 100% 100%;
				    top: <?php echo $position_top; ?>px;
				   left: <?php echo $position_left; ?>;
                   right: <?php echo $position_right; ?>px;
				   bottom: <?php echo $position_bottom; ?>px;
				   <?php if($opacity){ ?>opacity:<?php echo $opacity; ?>;<?php }?>
				   <?php if($position){ ?>position:<?php echo $position;?>;<?php }?>
				  }
			</style>
             <div id="parallax-<?php echo $block_id; ?>">
               <div id="bg-<?php echo $block_id; ?>"></div>
             </div>
            <?php }
		}
		
		
	}
}