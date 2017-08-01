<?php get_header(); ?>

<div class="centering">

    <!-- left -->
    <div id="left">
		
        <div class="errorPage">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('page404_sidebar') ) : ?>
            <h1>SEIte nicht gefunden</h1>
            <p>Vielen Dank für Ihr Interesse an LUX. Die von Ihnen aufgerufene Seite wurde leider nicht gefunden. Möglicherweise haben Sie eine falsche Internet-Adresse (URL) eingegeben, das Dokument existiert nicht mehr oder der Name des Dokuments wurde geändert.</p>
            <p>Bitte überprüfen Sie die eingegebene Adresse oder besuchen Sie unsere Startseite.</p>
            <?php endif; ?>
            <p><a href="<?php echo get_option('home'); ?>/" class="button">WEITER ZUR STARTSEITE</a></p>
        </div>
                
    </div>
    <!-- left container --> 

	<div class="clear"></div>
</div>

<?php get_footer(); ?>