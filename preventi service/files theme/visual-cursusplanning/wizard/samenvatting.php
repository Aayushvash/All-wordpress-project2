<?php echo __visual('cursusplanning_wizard_conclusion_title','<h2>Samenvatting</h2>');?>
<form class='sendData'></form>
<!--Commentariseer div class='json' wanneer je klaar bent met ontwikkelen, de json zal dan niet meer worden weergegeven-->
<!--<div class="json"></div>-->
<div class="returnData">
<!--Bouw de onderstaande data op zoals in de jSON hierboven-->
 <table>
  <tr>
   <td><strong>Naam:</strong> </td><td id='INSCHRIJVER.RELATIE.NAAM'></td>
  </tr>
  <tr>
   <td><strong>Email:</strong> </td><td id='INSCHRIJVER.RELATIE.EMAIL'></td>
  </tr>
  <tr>
   <td><strong>Adres:</strong> </td><td id='INSCHRIJVER.ADRES.ADRES'></td>
  </tr>
  <tr>
   <td><strong>Postcode: </strong></td><td id='INSCHRIJVER.ADRES.POSTCODE'></td>
  </tr>
  <tr>
   <td><strong>Plaats:</strong> </td><td id='INSCHRIJVER.ADRES.PLAATS'></td>
  </tr>
 </table>
 <table>
  <tr>
   <td><strong>Cursus</strong></td><td id='ACTIVITEIT.OMSCHRIJVING'></td>
  </tr>
  <tr>
   <td><strong>Data</strong></td>
   <td>
    <table id='PLANKOP.PLANDATES'>
     <tr>
      <td id='OMSCHRIJVING'></td>
      <td id='DATUM'></td>
      <td id='VAN'></td>
      <td id='TOT'></td>
     </tr>
    </table>
   </td>
  </tr>
  <tr>
   <td><strong>Locatie</strong></td>
   <td>
    <table>
     <tr>
      <td id='PLANKOP.NAAM'></td>
     </tr>
     <tr>
      <td id='PLANKOP.ADRES'></td>
     </tr>
     <tr>
      <td id='PLANKOP.POSTCODE'></td>
     </tr>
     <tr>
      <td id='PLANKOP.PLAATS'></td>
     </tr>
    </table>
   </td>
  </tr>
 </table>
 <h3>Cursisten</h3>
<?php visual_student_tables_with_chosen_fields();?>
<!--
<table id='CURSISTEN'>
 <tr>
  <td>
   <table>
    <tr>
     <td>Aanhef:</td>
     <td id='AANHEF'></td>
    </tr>
    <tr>
     <td>Voorletters:</td>
     <td id='VOORLETTERS'></td>
    </tr>
    <tr>
     <td>Tussenvoegsel:</td>
     <td id='TUSSENVOEGSEL'></td>
    </tr>
    <tr>
     <td>Achternaam:</td>
     <td id='NAAM'></td>
    </tr>
   </table>
  </td>
 </tr>
</table>-->
<h3>Totaalbedrag &euro; <span id="BEDRAG"></span></h3>
<br />
<hr />
<br />
</div>
<?php do_action('visual_ideal_banks');?>
<div class="submitF">
<input type='submit' name='confirm' value="<?php echo ((isset($GLOBALS['visual_ideal']) && (bool)get_option('visual_cursusplanning_ideal',1)==true)?'Afrekenen':'Inzenden');?>" />
<span></span>
</div>
<div class='indicator'></div>