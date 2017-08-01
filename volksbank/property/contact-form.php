<?php
/*
...........................................................
Template Name: Kontaktformular Page
*
*
* @file           contact-form.php
* @package        Property
* @author         Sabine Brings
* @version        1.0
............................................................
*/
?>
<?php 
$data = get_option('bo_options');
$response = isset( $data['contact2']['bo_contact_response'] ) ? $data['contact2']['bo_contact_response'] : null;
$response2 = isset( $data['contact2']['bo_contact_response_offer'] ) ? $data['contact2']['bo_contact_response_offer'] : null;
$recipient = isset( $data['contact2']['bo_formmail_address'] ) ? $data['contact2']['bo_formmail_address'] : null;
$sub = isset( $data['contact2']['bo_formmail_subject'] ) ? $data['contact2']['bo_formmail_subject'] : null;
$but = isset( $data['contact1']['bo_contact_form_button'] ) ? $data['contact1']['bo_contact_form_button'] : null;
$wrmail = isset( $data['contact3']['bo_send_wrmail'] ) ? $data['contact3']['bo_send_wrmail'] : null;
$homeaddress = isset( $data['contact3']['bo_wr_mailaddress'] ) ? $data['contact3']['bo_wr_mailaddress'] : null;
$wrlink = isset( $data['contact3']['bo_wr_page_url'] ) ? $data['contact3']['bo_wr_page_url'] : null;
$imprint = isset( $data['contact3']['bo_imprint_url'] ) ? $data['contact3']['bo_imprint_url'] : null;
$shwr = isset( $data['contact3']['bo_show_wr'] ) ? $data['contact3']['bo_show_wr'] : null;

if(isset($_POST['submitted'])) {
	if(trim($_POST['checking']) !== '') {
		$captchaError = true;
	} else {
		if(trim($_POST['contactName']) === '') {
			$nameError = __('Bitte tragen Sie Ihren Namen ein.','bobox');
			$hasError = true;
		} else {
			$name = trim($_POST['contactName']);
		}
		

		if($_POST["object-title"] && $shwr == 'yes') {
		if(trim($_POST['contactWR']) === '') {
			$wrError = __('Die Checkbox muss aktiviert werden.','bobox');
			$hasError = true;
		} else {
			$wr = trim($_POST['contactWR']);
		} }
		
$objectid = trim($_POST['objectID']);
$objectname = trim($_POST['objectName']);
$objectlink = trim($_POST['objectLink']);
$objectloc = trim($_POST['objectLoc']);
$objectsize = trim($_POST['objectSize']);
$objectrooms = trim($_POST['objectRooms']);
$contactnumber = trim($_POST['contactNumber']);
$contactmonumber = trim($_POST['contactMoNumber']);
$contactstreet = trim($_POST['contactStreet']);
$contactcity = trim($_POST['contactCity']);
			
				
		if(trim($_POST['email']) === '')  {
			$emailError = __('Bitte tragen Sie Ihre E-Mail-Adresse ein.','bobox');
			$hasError = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$emailError = __('Sie haben eine ungültige E-Mail Adresse eingetragen.','bobox');
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}
		if(function_exists('stripslashes')) {
				$comments = stripslashes(trim($_POST['comments']));
			} else {
				$comments = trim($_POST['comments']);
		}
		if(!isset($hasError)) {
			 
			$emailTo = $recipient;
			$subject = $sub;
			$body = "\n\nEine Anfrage über das Online-Formular von:"; 
			$body .= "\n\nName: $name \nE-Mail: $email \nTelefon: $contactnumber \nMobil: $contactmonumber \nStraße, Ort: $contactstreet - $contactcity";
			$body .= "\n\n...........................................";
			$body .= "\nImmobiliendaten: \nObjekt-ID: $objectid \nName: $objectname \nStandort: $objectloc \nGröße: $objectsize qm; \nZimmer: $objectrooms \n\nURL des Objektes: $objectlink ";
				$body .= "\n...........................................";
			$body .= "\n\nNachricht: $comments ";
			$headers = 'From: <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
    			$headers .= "Content-type: text/plain; charset=utf-8\r\n";
    			$headers .= "Content-Transfer-Encoding: 8bit";
			
			mail($emailTo, $subject, $body, $headers);
			
						
			if($objectname != '' && $wrmail == 'yes') {
				
				$wrinfo = file_get_contents(locate_template('wrmail.php')); 
				$subject = __('Ihre Anfrage - ','bobox') . $sub;
				$body = "\n\nHerzlichen Dank, $name - wir haben Ihre Anfrage zu folgendem Objekt erhalten:";
					$body .= "\n\n...........................................";
				$body .= "\nImmobiliendaten: \nObjekt-ID: $objectid \nName: $objectname \nStandort: $objectloc \nGröße: $objectsize qm; \nZimmer: $objectrooms \n\nURL des Objektes: $objectlink ";
					$body .= "\n...........................................";
				$body .= "\n\n";
				$body .= "$wrinfo";
				$body .= "Hier finden Sie auch noch einmal die komplette Widerrufsbelehrung: \n$wrlink";
				$body .= "\n\n...............................................................\n";
				$body .= "$homeaddress";
				$body .= "\n\nImpressum: $imprint";
				$headers = 'From: ' . $emailTo . "\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
    				$headers .= "Content-type: text/plain; charset=utf-8\r\n";
    				$headers .= "Content-Transfer-Encoding: 8bit";
				mail($email, $subject, $body, $headers);
			}
			
			$emailSent = true;

		}
	}
} ?>

<?php get_header(); ?>


<div id="content">
 <div id="properties" style="display:none;">

<?php
if (function_exists('_qmt_init')) {
the_widget('Taxonomy_Drill_Down_Widget', array(
    'title' => '',
    'mode' => 'dropdowns',
    'taxonomies' => array( 'proptype', 'keyword', 'location' ) ,
	'orderby' => 'title',
	'order' => 'asc'
	//'taxonomies' => array( 'offertype','proptype', 'rooms', 'keyword', 'location', 'size' ) 
));
}
?>

</div><!-- eof properties -->
<div class="col-ttc">
    
<div class="page-entry">

<?php if(isset($emailSent) && $emailSent == true) { ?>

<div class="thanks">
<h2><?php echo __('Thanks','bobox');?>, <?php echo $name;?></h2>
        
<?php  if($objectname != '' && $shwr == 'yes') { ?>
<p><?php echo $response2; ?></p>
<p><?php echo __('Hier geht es zurück zum Angebot &raquo;&raquo; ','bobox');?> <a href="<?php echo $objectlink ?>"><?php echo $objectname ?></a></p>
<?php } else { ?> 
<p><?php echo $response; ?></p>
 <?php } ?>
</div>
<?php } else { ?>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
		
	 <h2 class="pagetitle"><?php the_title(); ?></h2>
    
    	<?php the_content(); ?>
        
        <?php if(isset($hasError) || isset($captchaError)) { ?>
			<p class="error" style="color:#ff3300;"><?php echo __('There was an error submitting the form.','bobox') ?><p>
		<?php } ?>
        
        
     <div class="contactwrap">   
        
        <?php if($_POST["object-title"]) { ?>

        <div class="requestinfos"><?php // echo __('Ihre Anfrage zum Objekt','bobox'); ?></div>
          <div class="selected-offer">
            <table>
              <tr>
                <td colspan="2"><?php echo __('Ich bitte um Kontaktaufnahme zu folgendem Objekt','bobox'); ?>:</td>
              </tr>
              <tr>
                <td colspan="2"><em><a href="<?php echo $_POST["object-link"]?>"><?php echo $_POST["object-title"] ?></a></em> </td>
              </tr>
              <tr>
                <td class="key"> <?php echo __('Objekt ID','bobox'); ?>:</td><td><?php echo $_POST["object-item"] ?></td>
              </tr>
            </table>
          </div>
        </div>
        <?php } ?>

       <?php echo do_shortcode('[contact-form-7 id="4" title="Kontaktformular 1"]'); ?>
    </div><!-- eof contact wrap -->
    
<?php endwhile; ?>
<?php endif; ?>
<?php } ?>

</div><!-- eof page entry -->
</div><!-- eof column left -->

<div class="col-otc cr">

<?php get_template_part('sidebar_contact'); ?>

</div>
<div class="clear"></div>

</div><!-- eof content -->

<?php get_footer(); ?>	