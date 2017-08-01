<fieldset class='vs_fl_left'>
 <div class='notLogged'>
  <p>Als laatste hebben wij alleen nog uw contactgegevens nodig.</p>
  <div class="radioBar">
  <label for='zelfCursist'>Bent u zelf ook &eacute;&eacute;n van de cursisten?<!--<em>(alleen mogelijk met een particuliere inschrijving)</em> --></label><br />
  <input type="radio" value="J" id="zelfCursist" class="rba" name="INSCHRIJVER[RELATIE][ISCURSIST]"/><label for="zelfCursist">Ja</label> <input type="radio" class="rba1" value="N" checked="checked" id="zelfCursist1" name="INSCHRIJVER[RELATIE][ISCURSIST]"/><label for="zelfCursist1">Nee</label> <br />
  </div>
  <div class='hiddenInput' id="zelfCursist">
   <label for='cursistNaamKeuze'>Welke cursist bent u?</label><br />
   <select name='cursistNaamKeuze'>
   
   </select>
  </div>
  <div class="formBar">
  <label for='bedrijfsnaam'>Bedrijfsnaam: </label>
  <input type='text' id='bedrijfsnaam' name='INSCHRIJVER[RELATIE][BEDRIJFSNAAM]' placeholder="Het systeem zal u als particulier herkennen/factureren als u dit leeg laat" value='' maxlength="60"/>
  <label for='name'>Uw achternaam<span>*</span> </label>
  <input type='text' id='name' name='INSCHRIJVER[RELATIE][NAAM]' maxlength="40" value='' class='mandatory' />
  <label for='Voorletters'>Voorletters<span>*</span> </label>
  <input type='text' class='mandatory' name='INSCHRIJVER[RELATIE][VOORLETTERS]' maxlength="20" id='Voorletters' />
  <label for='Tussenvoegsel'>Tussenvoegsel: </label>
  <input type='text' class='' name='INSCHRIJVER[RELATIE][TUSSENVOEGSEL]' maxlength="10" id='Tussenvoegsel' />
  <label for='adres'>Adres<span>*</span> </label>
  <input type='text' id='adres' name='INSCHRIJVER[ADRES][ADRES]' maxlength="100" value='' class='mandatory' />
  <label for='postcode'>Postcode<span>*</span> </label>
  <input type='text' id='postcode' name='INSCHRIJVER[ADRES][POSTCODE]' maxlength="7" value='' class='mandatory' />
  <label for='woonplaats'>Plaats<span>*</span> </label>
  <input type='text' id='woonplaats' name='INSCHRIJVER[ADRES][PLAATS]' maxlength="100" value='' class='mandatory' />
  <label for='email'>Email<span>*</span> </label>
  <input type='email' id='email' name='INSCHRIJVER[RELATIE][EMAIL]' maxlength="255" value='' class='mandatory' />
  <label for='Tel'>Telefoonnummer<span>*</span> </label>
  <input type='text' class='mandatory' name='INSCHRIJVER[RELATIE][TELEFOONNR]' maxlength="15" id='Tel' />
  </div>
 </div>
 <div class='logged'>
  <p>U bent al ingelogd.<br />
  Om uw gegevens te wijzigen of in te zien, kunt u <a href='<?php echo admin_url( 'profile.php' )?>' target="_blank">hier</a> klikken.</p>
 </div>
</fieldset>