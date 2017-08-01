<?php
/** A simple text block **/
class ICY_Slogan_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Content Block',
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('icy_slogan_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'title' => '',
			'text' => '',
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		?>
		<p class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Main Slogan
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('text') ?>">
				Description
				<?php echo aq_field_textarea('text', $block_id, $text, $size = 'full') ?>
			</label>
		</p>
		
		<?php
	}
	
	function block($instance) {
		extract($instance);
		global $icy_options; 

		echo "<section class='icy-slogan'>";
			if($title) echo '<h2 class="icy-slogan-title fadeInDown animated">'.strip_tags($title).'</h2>';
			if($title) echo "<div class='slogan-separator'></div>";
			echo "<div class='fadeInUp animated'>" . wpautop(do_shortcode(htmlspecialchars_decode($text))) . "</div>";
		echo '</section>';
	}
	
}