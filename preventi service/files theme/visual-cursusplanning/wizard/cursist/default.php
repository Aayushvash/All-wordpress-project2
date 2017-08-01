<div class='exists'>
 <input type='hidden' name='cursist[ID][]' />
 <input type='checkbox' class='addCursist' id='in' /><span> </span><span id='NAAM'></span><span> doet mee</span>
 <br />
</div>
<div class='clear'></div>
<div class='exists inDb'>
 <span id='NAAM'></span><span> bevindt zich al in deze cursus.<br /></span>
 <span class='uitschrijven'>U heeft nog <span id='WIJZIGDAGEN'></span> dag<span class='meer'>en</span> om deze inschrijving te annuleren.<br />
 <a href='uitschrijven' id='dFC'>Uitschrijven</a></span>
 <span class='uitschrijven'>Uitschrijven is niet meer mogelijk.</span>
</div>
<div class='notExists'>
<!--Verander het ID niet van cursistNaam, op basis hiervan kan de cursist zichzelf inschrijven bij stap 4-->
<!--Voor een nieuwe cursist is een naam VERPLICHT-->
<label for='cursistVoorletters'>Voorletters*: </label><input type='text' name='cursist[VOORLETTERS][]' class='mandatory' id='cursistVoorletters' /><br />
<label for='cursistTussenvoegsel'>Tussenvoegsel: </label><input type='text' name='cursist[TUSSENVOEGSEL][]' id='cursistTussenvoegsel' /><br />
<label for='cursistNaam'>Achternaam*: </label><input type='text' name='cursist[NAAM][]' class='mandatory' id='cursistNaam' /><br />
<label for='cursistGeboortedatum'>Geboortedatum: </label><input type='text' name='cursist[GEBOORTEDATUM][]' id='cursistGeboortedatum' /><br />
<label for='cursistEmail'>Email: </label><input type='text' name='cursist[EMAIL][]' id='cursistEmail' /><br />
<div class='clear'></div>
</div>