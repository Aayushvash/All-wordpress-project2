<?php /*
Template Name: Widerrufsbelehrung
*/
?>



<?php get_header(); ?>

	<div id="content">

<div class="col-full">
<div class="page-entry">
    
<div class="widerruf">   
<h2>Widerrufsbelehrung für Verbraucher</h2>


  <h3> Widerrufsrecht</h3>
  <p>Sie haben das Recht, binnen vierzehn Tagen ohne Angabe von Gründen diesen Vertrag zu widerrufen.
    Die Widerrufsfrist beträgt vierzehn Tage ab dem Tag des Vertragsabschlusses.
    Um Ihr Widerrufsrecht auszuüben, müssen Sie uns </p>
    
    <p class="wraddress">
    <?php 
	$data = get_option('bo_options');
	$adr = isset( $data['contact3']['bo_wr_address'] ) ? $data['contact3']['bo_wr_address'] : null; 
	
	echo $adr;
	
	?>
    
    </p>
    
    
  <p>   mittels einer eindeutigen Erklärung (z.B. ein mit der Post versandter Brief, Telefax oder E-Mail) über Ihren Entschluss, diesen Vertrag zu widerrufen, informieren. Sie können dafür das beigefügte Muster-Widerrufsformular verwenden, das jedoch nicht vorgeschrieben ist. 
    Zur Wahrung der Widerrufsfrist reicht es aus, dass Sie die Mitteilung über die Ausübung des Widerrufsrechts vor Ablauf der Widerrufsfrist absenden.</p>
  
<h3>Folgen des Widerrufs </h3>
<p>   Wenn Sie diesen Vertrag widerrufen, haben wir Ihnen alle Zahlungen, die wir von Ihnen erhalten haben, einschließlich der Lieferkosten (mit Ausnahme der zusätzlichen Kosten, die sich daraus ergeben, dass Sie eine andere Art der Lieferung als die von uns angebotene, günstigste Standardlieferung gewählt haben), unverzüglich und spätestens binnen vierzehn Tagen ab dem Tag zurückzuzahlen, an dem die Mitteilung über Ihren Widerruf dieses Vertrags bei uns eingegangen ist. Für diese Rückzahlung verwenden wir dasselbe Zahlungsmittel, das Sie bei der ursprünglichen Transaktion eingesetzt haben, es sei denn, mit Ihnen wurde ausdrücklich etwas anderes vereinbart; in keinem Fall werden Ihnen wegen dieser Rückzahlung Entgelte berechnet. </p>
<p>  Haben Sie verlangt, dass die Dienstleistungen während der Widerrufsfrist beginnen sollen, so haben Sie uns einen angemessenen Betrag zu zahlen, der dem Anteil der bis zu dem Zeitpunkt, zu dem Sie uns von der Ausübung des Widerrufsrechts hinsichtlich dieses Vertrags unterrichten, bereits erbrachten Dienstleistungen im Vergleich zum Gesamtumfang der im Vertrag vorgesehenen Dienstleistungen entspricht.</p>
  
  <h3> Muster-Widerruf</h3>
  <p>(Wenn Sie den Vertrag widerrufen wollen, dann kopieren Sie bitte diesen Muster-Widerruf, tragen Ihre Daten ein und senden ihn an uns zurück.)</p>

  <p class="wraddress">
  An<br />
    <?php echo $adr; ?>
    
    </p>
    
  <p>Hiermit widerrufe(n) ich/wir (*) den von mir/uns (*) abgeschlossenen Vertrag über den Kauf der folgenden Waren (*)/ die Erbringung der folgenden Dienstleistung (*)</p>
  <p> −	Bestellt am (*)/ erhalten am (*)
    <br />
    −	Name des/der Verbraucher(s)<br />
−	Anschrift des/der Verbraucher(s)<br />
−	Unterschrift des/der Verbraucher(s) (nur bei Mitteilung auf Papier)<br />
<br />
<br />
−	Datum<br />
    (*) Unzutreffendes streichen. </p>
<form>
<input type="button" class="print" value="Diese Seite drucken" onClick="window.print()">
</form>    
        
</div>
               
        
</div>
</div>
</div>

<?php get_footer(); ?>
