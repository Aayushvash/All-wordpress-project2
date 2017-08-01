<?php 
/**
 * Free Title or Text
 * Page Composer Section
 *
 * @package SimpleMag
 * @since 	SimpleMag 2.0
**/
?>

<section class="home-section title-text">

	<?php 
	
	$content = get_sub_field( 'title_text_content' ); 
	$tag = get_sub_field( 'title_styling' );
	
	$content_styling = array (
		'theme_title' => '<header class="section-header"><h2 class="title"><span>' . $content . '</span></h2></header>',
		'heading_1' => '<h1>' . $content . '</h1>',
		'heading_2' => '<h2>' . $content . '</h2>',
		'bold_text' => '<b>' . $content . '</b>',
		'paragraph_text' => '<p>' . $content . '</p>',
	);
	
	// Loop through radio inputs an output the result
	foreach ( $content_styling as $style => $value ) {
		if ( $tag == $style) { echo $value; }
	}
		
	?>
		
</section><!-- Title/Text -->