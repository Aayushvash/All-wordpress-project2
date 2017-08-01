<?php /*
Template Name: Startseite individuell
*
* @file           homepage4.php
 * @package       Property
 * @author        Sabine Brings
 * @version        1.0
 */
?>

<?php get_header(); ?>

<?php 
$data = get_option('bo_options');
$p1 = isset( $data['homeI']['bo_home_part1'] ) ? $data['homeI']['bo_home_part1'] : null;
$p2 = isset( $data['homeI']['bo_home_part2'] ) ? $data['homeI']['bo_home_part2'] : null;
$p3 = isset( $data['homeI']['bo_home_part3'] ) ? $data['homeI']['bo_home_part3']  : null;
$p4 = isset( $data['homeI']['bo_home_part4'] ) ? $data['homeI']['bo_home_part4']  : null;
$p5 = isset( $data['homeI']['bo_home_part5'] ) ? $data['homeI']['bo_home_part5']  : null;
$p6 = isset( $data['homeI']['bo_home_part6'] ) ? $data['homeI']['bo_home_part6']  : null;
$p7 = isset( $data['homeI']['bo_home_part7'] ) ? $data['homeI']['bo_home_part7']  : null;
$p8 = isset( $data['homeI']['bo_home_part8'] ) ? $data['homeI']['bo_home_part8']  : null;
$p9 = isset( $data['homeI']['bo_home_part9'] ) ? $data['homeI']['bo_home_part9']  : null;
$p10 = isset( $data['homeI']['bo_home_part10'] ) ? $data['homeI']['bo_home_part10']  : null;
?>	

<?php if($p1 != '') { ?>
<div class="col-940"> 
<div class="left"><?php if($p1 == 'separator') { echo '<div class="separator"></div>';} else { get_template_part($p1); } ?></div>
<div class="right">
<h3>Immobilien Suche</h3>
<?php 
			if (function_exists('_qmt_init')) {
			the_widget('Taxonomy_Drill_Down_Widget', array(
				'title' => '',
				'mode' => 'dropdowns',
				'taxonomies' => array('proptype','keyword', 'location') 
				//'taxonomies' => array( 'offertype','proptype', 'rooms', 'keyword', 'location', 'size' ) 
			));
			}
		?>
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/chosen.js"></script>
<script type="text/javascript">
	          	jQuery(document).find(".widget_taxonomy-drill-down select option").each(function() {
				    var $this = jQuery(this);
				    $this.html( $this.html().split('&nbsp;').join('') );
				});

          	jQuery(".widget_taxonomy-drill-down select").chosen();
                 </script>
				 
				 
				 
				 
		</div>
	
		<div class="clear"></div>
		<div class="rights1">
		<div class="mc_custom_border_hdr">VIP Angebotsinfo</div>
		<p class="font-set">Sie möchten laufend über neue Immobilienangebote informiert werden? Dann tragen Sie bitte hier Ihre E-mail Adresse ein.</p>
		<?php //echo do_shortcode('[mailchimpsf_form]'); ?>
		<?php //echo do_shortcode('[email-subscribers namefield="NO" desc="" group="Public"]'); ?>
		<?php es_subbox( $namefield = "", $desc = "", $group = "" ); ?>

		
		</div>
		
		
		</div>
<?php } ?>

<?php if($p2 != '') { ?>
<div class="col-940"> <?php if($p2 == 'separator') { echo '<div class="separator"></div>';} else { get_template_part($p2); } ?></div>
<?php } ?>

<?php if($p3 != '') { ?>
<div class="col-940"> <?php if($p3 == 'separator') { echo '<div class="separator"></div>';} else { get_template_part($p3); } ?></div>
<?php } ?>

<?php if($p4 != '') { ?>
<div class="col-940"> <?php if($p4 == 'separator') { echo '<div class="separator"></div>';} else { get_template_part($p4); } ?></div>
<?php } ?>

<?php if($p5 != '') { ?>
<div class="col-940"> <?php if($p5 == 'separator') { echo '<div class="separator"></div>';} else { get_template_part($p5); } ?></div>
<?php } ?>

<?php if($p6 != '') { ?>
<div class="col-940"> <?php if($p6 == 'separator') { echo '<div class="separator"></div>';} else { get_template_part($p6); } ?></div>
<?php } ?>

<?php if($p7 != '') { ?>
<div class="col-940"> <?php if($p7 == 'separator') { echo '<div class="separator"></div>';} else { get_template_part($p7); } ?></div>
<?php } ?>

<?php if($p8 != '') { ?>
<div class="col-940"> <?php if($p8 == 'separator') { echo '<div class="separator"></div>';} else { get_template_part($p8); } ?></div>
<?php } ?>

<?php if($p9 != '') { ?>
<div class="col-940"> <?php if($p9 == 'separator') { echo '<div class="separator"></div>';} else { get_template_part($p9); } ?></div>
<?php } ?>

<?php if($p10 != '') { ?>
<div class="col-940"> <?php if($p10 == 'separator') { echo '<div class="separator"></div>';} else { get_template_part($p10); } ?></div>
<?php } ?>


<?php get_footer(); ?>
