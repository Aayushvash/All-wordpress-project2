<?php
if(isset($_GET['status']) && $_GET['status']=='complete')
{
	echo __visual('planning_wizard_thanks_for_your_appliance',"<p>Bedankt voor uw aanmelding.<br />
	U zal per mail bevestigd worden.</p>
	<p>U kunt nu dit venster sluiten, of nog een aanmelding doen.</p>");
}
?>
<div class='loadingIndicator'>
 <p><center><?php echo __visual('busy_loading',"Bezig met laden...");?></center></p>
 <div class='loadBarContainer'>
  <div class='loadBar'></div>
  <div class='status'><span id='percentage'>0</span>%</div>
 </div>
</div>
<div class='planningContainer'>
 <?php echo visual_get_submit_button( __visual('planning_wizard_refresh_button_title',"Vernieuwen"), 'button', 'refresh');?><br />
 <div class='stepButtons'>
  <div class='background'><div class='line'><div class='lineContainer'><div class='slider'></div></div></div></div>
  <div class='steps'>
   <div class='step'><div class='bgColor'></div><div class='cell'><div class='centeredStr'>1</div></div></div>
  </div>
 </div>
 <div class='stepContent'>
  <div class='contentContainer'>
   <div class='stepContentView'>
    <div class='topBar'>
	<div class='tBD 1'><?php echo __visual('planning_wizard_title',"<h4>Kies een cursus</h4>");?></div>
    </div>
    <div class='wizardContent'>
<?php include('wizard/cursusKeuze.php');?>
    </div>
	<div class="pagination">
	<div class='tBD prev'><?php echo visual_get_submit_button( __visual('planning_wizard_prev_button_title',"Vorige"), 'button', 'prev',true,array('disabled'=>'disabled'));?><span></span></div>
     <div class='tBD next'><?php echo visual_get_submit_button( __visual('planning_wizard_next_button_title',"Volgende"), 'button', 'next');?><span></span></div>
	</div>
   </div>
   <div class='stepContentView'>
    <div class='topBar'>
     <div class='tBD'><?php echo __visual('planning_wizard_title',"<h4>Kies een datum</h4>");?></div>
    </div>
	<div class='wizardContent datumBar'>
	  <?php include('wizard/datumKeuze.php');?>
	</div>
	<div class="pagination">
	 <div class='tBD prev'><?php echo visual_get_submit_button( __visual('planning_wizard_prev_button_title',"Vorige"), 'button', 'prev');?><span></span></div>
     <div class='tBD next'><?php echo visual_get_submit_button( __visual('planning_wizard_next_button_title',"Volgende"), 'button', 'next');?><span></span></div>
	</div>
   </div>
   <div class='stepContentView'>
    <div class='topBar'>
	<div class='tBD'><?php echo __visual('planning_wizard_title',"<h4>Cursistengegevens</h4>");?></div>
    
    </div>
    <div class='wizardContent step3Bar'>
<?php include('wizard/cursistenKeuze.php');?>
    </div>
	<div class="pagination">
	 <div class='tBD prev'><?php echo visual_get_submit_button( __visual('planning_wizard_prev_button_title',"Vorige"), 'button', 'prev');?><span></span></div>
     <div class='tBD next'><?php echo visual_get_submit_button( __visual('planning_wizard_next_button_title',"Volgende"), 'button', 'next');?><span></span></div>
	</div>
   </div>
   <div class='stepContentView'>
    <div class='topBar'>
	<div class='tBD'><?php echo __visual('planning_wizard_title',"<h4>Uw gegevens</h4>");?></div>
    </div>
    <div class='wizardContent step4Bar'>
<?php include('wizard/contactGegevens.php');?>
    </div>
	<div class="pagination">
	<div class='tBD prev'><?php echo visual_get_submit_button( __visual('planning_wizard_prev_button_title',"Vorige"), 'button', 'prev');?><span></span></div>
     <div class='tBD next'><?php echo visual_get_submit_button( __visual('planning_wizard_next_button_title',"Volgende"), 'button', 'next');?><span></span></div>
	</div>
   </div>
   <div class='stepContentView'>
    <div class='topBar'>
	<div class='tBD'><?php echo __visual('planning_wizard_title',"<h4>Bevestigen</h4>");?></div>
    </div>
    <div class='wizardContent step5Bar'>
<?php include('wizard/samenvatting.php');?>
    </div>
	<div class="pagination lastpage">
	<div class='tBD prev'><?php echo visual_get_submit_button( __visual('planning_wizard_prev_button_title',"Vorige"), 'button', 'prev');?><span></span></div>
     <div class='tBD next'><?php echo visual_get_submit_button( __visual('planning_wizard_next_button_title',"Volgende"), 'button', 'next');?><span></span></div>
	</div>
   </div>
   <div class='clear'></div>
  </div>
 </div>
</div>