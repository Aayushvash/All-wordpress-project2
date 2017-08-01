<div class='wzHalf'>
 <!--Form is only to remember the choice-->
 <form>
  <label for='aantalCursisten'>Hoeveel cursisten wilt u inschrijven?</label>
<?php
echo "<select name='aantalCursisten'>";
echo "</select>";
?>
 </form>
</div>
<div class='wzHalf cursus'>
 <div class='wzTitle'>
 Nieuwe cursisten
 </div>
 <div class='wzError'></div>
 <div class='wzText'>
<?php if(!is_user_logged_in())
{?>
  <div class='loginQuestion'>
   <p>Heeft u al een keer eerder bij ons gepland, en staat u in ons systeem?</p>
   <input type='radio' value='J' id="rb1" name='gotAccount' /><label for="rb1">Ja</label> <input type='radio' id="rb2" value='N' name='gotAccount' /><label for="rb2">Nee</label>
  </div>
  <div class='loginDiv'>
   <fieldset class='loginForm'>
    <span>Dan kunt u hier inloggen.</span><br />
    <?php
    wp_login_form(
	array(
	'echo'=>true,
	'value_remember'=>true
	));?>
    <div class='message'></div>
   </fieldset>
  </div>
<?php
}?>
  <div class='cursisten'>
<?php
visual_load_student_input_fields();
?>
  </div>
  <div class='bestaandeCursisten'>
   <div class='wzTitle'>Uw cursisten</div>
   <div class='cursistenA'></div>
  </div>
  <div class='loading_students'><center><img src='<?php echo __visual('cursusplanning_students_loader_gif',plugins_url('img/loader.gif',dirname(__FILE__)));?>' /></center></div>
 </div>
</div>
<div class='clear'></div>