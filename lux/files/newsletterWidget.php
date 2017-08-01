<?php
/**
 * Newsletter Widget
 */

		
class LuxNewsletterWidget extends WP_Widget
{
  function LuxNewsletterWidget()
  {
    $widget_ops = array('classname' => 'LuxNewsletterWidget', 'description' => 'Displays newsletter form.' );
    $this->WP_Widget('LuxNewsletterWidget', 'Lux Newsletter Widget', $widget_ops);
  }
 
  function form($instance)
  {
	global $wpdb;
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
?>
  <p>
   <label for="<?php echo $this->get_field_id('title'); ?>">
   Newsletter Title: 
     <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" />
    </label>
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
	global $wpdb;  
    extract($args, EXTR_SKIP);
    
	
	echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title))
      echo $before_title . $title . $after_title;
	  
	$melinsoap = "http://melin.sv-www.de:8200/axis/melin523.jws?";
    ?>
    <?php 
	  if ($_POST['action']=='addnewslettersubscriber') 
	  { 
	    $errors = null;
	    if(empty($_SESSION['security_code'] ) ||
	  strcasecmp($_SESSION['security_code'], $_POST['security_code']) != 0)
			{
			   $errors .= "\n Der CAPTCHA Code ist falsch!";
			   unset($_POST['action']);
			}
			
	   if(empty($errors))
	   {	
		// Jetzt nachsehen ob die Emailadresse den neuen Newsletter schon abonniert hat
		$request = $melinsoap."method=subscriptionSimpleCheck&email=".$_POST['MAIL']."&newsletter_id=20014713";
		$xml = file_get_contents($request);
		$xml = preg_replace("/\<[^\>\<]*\>/", "", $xml);
		$xml = preg_replace("/\s/", "", $xml);
		//echo $xml;
		
		$hasNewNl = 0;
		if ($xml == "ok")
		{
			$hasNewNl = 1; 
		}
		//Check End
		
$request = $melinsoap."method=subscriberCreate&newsletter_id=20014713&page=PGID1370347361455&last_name=".$_POST['NACHNAME']."&first_name=".$_POST['VORNAME']."&email=".$_POST['MAIL']."&title=&salutation=".$_POST['ANREDE']."&AD_PERMISSION=1";
		
		//Request ausführen
		$xml = @file_get_contents($request);
		$xml = preg_replace("/\<[^\>\<]*\>/", "", $xml);
		$xml = preg_replace("/\s/", "", $xml);
		// echo "<br />".$xml;
		$result = 0;
		if ($xml == "ok") {
			$result = 1;
		}
		
		if ($hasNewNl<=0) {
                  echo '<span class="text_s">Vielen Dank für Ihre Anmeldung!<br /><br />
                                Um Ihr  Newsletter-Abonnement abzuschlie&szlig;en, erhalten Sie eine E-Mail. Klicken Sie bitte auf den dort genannten Link, um Ihre Bestellung zu best&auml;tigen.
					  <br />
					  <br />Mit freundlichen Gr&uuml;&szlig;en<br />
					  LUX<br /><br /></span>';
	   } else {
              echo '<span class="text_s">Herzlichen Dank f&uuml;r Ihre Newsletterbestellung.<br /><br />
                                Sie haben bereits den gew&auml;hlten Newsletter, daher gibt es keine &Auml;nderung an Ihrem Abostand.<br /><br />
                                Mit freundlichen Gr&uuml;&szlig;en<br />
					  LUX<br /><br /></span>';
			  }
	   }
	  }
	  if(empty($_POST['action']))
	  {
	?>
   <style>
   .err
	{
		font-family : Verdana, Helvetica, sans-serif;
		font-size : 12px;
		color: red;
	}
	</style> 
    <SCRIPT TYPE="text/javascript" LANGUAGE="JavaScript">
//<!--
function formSubmit()
{
    with(document.forms['newsletter'])
    {   
		
		
		if(document.newsletter.MAIL.value=="")
        {
            alert ("Bitte Ihre E-Mail Adresse eingeben!");
            document.newsletter.MAIL.focus();
            return false;
        }
		else
		{
		   if (!validEmail(document.newsletter.MAIL.value)) {
              alert ("E-Mail Adresse existiert nicht. Bitte überprüfen Sie Ihre Eingabe!");
			  document.newsletter.MAIL.focus();
              return false;
		   }
		}
		
        if (!document.newsletter.DATENSCHUTZ.checked)
        {
            alert ("Bitte klicken Sie das Feld Datenschutz an, wenn Sie einverstanden sind!");
            document.newsletter.DATENSCHUTZ.focus();
            return false;
        }
        else
		{
            submit();
		}
    }
}

function validEmail(email) {

  var strReg = "^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$";

  var regex = new RegExp(strReg);

  return(regex.test(email));

}

//-->
</SCRIPT>
<script language='JavaScript' type='text/javascript'>
function refreshCaptcha()
{
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>	
    <div class="formWidget newsletter">
     <?php
		if(!empty($errors)){
		echo "<p class='err'>".$errors."</p>";
		}
	   ?>
    <form method="post" name="newsletter" id="newsletter" action="<?php //echo $_SERVER['REQUEST_URI']; ?>">
        <INPUT TYPE=HIDDEN NAME="PAGE" VALUE="PGID1370347361455">
        <INPUT TYPE=HIDDEN NAME="TYP" VALUE="1">
        <INPUT TYPE=HIDDEN NAME="M_NEXTPAGE" VALUE="nl_confirmation.html">
        <INPUT TYPE=HIDDEN NAME="REQUIRES" VALUE="">
        <INPUT TYPE=HIDDEN NAME="AFFILIATE" VALUE="">
        <INPUT TYPE=HIDDEN NAME="UPDATE" VALUE="1">
        <INPUT TYPE=HIDDEN NAME="CHANNEL_HTML" VALUE="html">
        <INPUT TYPE=HIDDEN NAME="M_GET_CURRENT_SUBSCRIPTIONS" VALUE="1">
        <INPUT TYPE=HIDDEN NAME="SERVER_NAME" VALUE="hjr">
        <INPUT TYPE=HIDDEN NAME="M_GUI_SERVER_NAME" VALUE="uza">
        <INPUT TYPE=HIDDEN NAME="EMAIL" VALUE="<?php echo @$EMAIL ?>">
        <INPUT TYPE=HIDDEN NAME="action" VALUE="addnewslettersubscriber">
        <fieldset>    	
            <div class="field field-1">
                <label><input type="radio" name="ANREDE" <?php if($_POST['ANREDE'] == "Herr"){ ?> checked="checked" <?php } ?> value="Herr" />Herr</label>
                <label><input type="radio" name="ANREDE" <?php if($_POST['ANREDE'] == "Frau"){ ?> checked="checked" <?php } ?> value="Frau" />Frau</label>
            </div>
            <div class="field field-2">
                <input type="text" value="<?php echo $_POST['VORNAME']; ?>" name="VORNAME" placeholder="Vorname" />
                <input type="text" value="<?php echo $_POST['NACHNAME']; ?>" name="NACHNAME" placeholder="Nachname" />
            </div>        
            <div class="field field-3">
                <input type="text" value="<?php echo $_POST['MAIL']; ?>" name="MAIL" placeholder="E-Mail-Adresse *" />
            </div>
            <div class="field field-4">
                <input type="checkbox" <?php if($_POST['DATENSCHUTZ'] == "Datenschutz"){ ?> checked="checked" <?php } ?> name="DATENSCHUTZ" value="Datenschutz"/>
                <label>Ja, ich stimme der Erhebung, Verarbeitung und Nutzung meiner personenbezogenen Daten gemäß der <span><a href="http://www.es-werde-lux.de/site/?page_id=131" target="_blank" style="color:#B2DF00;">datenschutzrechtlichen Einwilligungserklärung</a></span> zu. * </label>
            </div>
            <div class="field field-5">
                <label>Sicherheitscode eingeben</label>
                <input type="text" id="security_code" name="security_code" value="" placeholder="Code *" style="margin-right:1px;"/>
                <img src="<?php bloginfo('template_url'); ?>/captcha_code_file.php?rand=<?php echo rand(); ?>" id='captchaimg' ><br>
                <!--<img src="<?php bloginfo('template_url'); ?>/captcha.php" id="captcha" class="image" alt="captcha"/>-->
                <span style="float:left;padding-top:2px;"><small style="color:#FFF;">Neues Bild? Klicken Sie <a href='javascript: refreshCaptcha();' style="color:#B2DF00;">hier</a>!</small></span>
            </div>       
            <p class="error-mass">* Pflichtfeld</p>        
            <input type="submit" class="button" value="JETZT BESTELLEN" onclick="formSubmit();return false;" />                
        </fieldset>
     </form>	
  </div>
    <?php 
	  }
    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("LuxNewsletterWidget");') );?>
