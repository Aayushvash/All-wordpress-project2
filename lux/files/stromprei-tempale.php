<?php 
/*

	Template Name Posts: Stromprei Post  Template
*
*/

?>
<?php get_header(); ?> 

<div class="centering">
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    
    <script type="text/javascript">
    var e = "#eaeaea #666666 #C1E7FF #5EBEFF #8CD1FF #0099FF #00609F #007BCE #00243C".split(" "),
    options = {
        pieSliceText: "none",
        pieHole: 0.5,
        pieSliceBorderColor: "none",
        chartArea:	{
            left:"4.5%",
            top:"4.5%",
            width:"91%",
            height:"91%"
        },
        backgroundColor: {
            fill: "transparent",
            strokeWidth: 0
            },
        slices: {
            1: {
                offset: 0
            }
        },
        enableInteractivity: false,
        tooltip: {
            trigger: "none"
        },
        colors: e,
        legend: {
            position: "none"
        }
    };
    
    google.load("visualization", "1", {
    packages: ["corechart"]
    });
    
    google.setOnLoadCallback(drawChart);
    
    function drawChart() {
    var b = new google.visualization.DataTable;
    b.addColumn("string", "Topping");
    b.addColumn("number", "Slices");
    b.addRows([
        ["Netznutzungsentgelte (23,3 %)", 233],
        ["Beschaffung, Vertrieb, Marge (25,6 %)", 256],
        ["EEG-Umlage (19,1 %)", 191],
        ["Konzessionsabgabe (6,1 %)", 61],				
        ["KWKG (0,5 %)", 5],
        ["Stromsteuer (7,4 %)", 74],
        ["Offshore-Haftungsumlage (0,9 %)", 9],
        ["\u00a719-StromNEV-Umlage (1,2 %)", 12],
        ["Umsatzsteuer (16,0 %)", 160]
    ]);
    
    for (var c = [], f = 0, a = 0; a < b.getNumberOfRows(); a++) {
        var f = f + b.getValue(a, 1),
            h = b.getValue(a, 0),
            g = b.getValue(a, 1);
        2 === a && (c[a] = document.createElement("li"), c[a].id = "legend_head", c[a].innerHTML = '<h3 class="legend_heading">Steuern und Abgaben</h3>', $("#legend").append(c[a]));
        c[a] = document.createElement("li");
        c[a].setAttribute("data-row", a);
        c[a].setAttribute("data-value", g);
        c[a].id = "legend_" + b.getValue(a, 0);
        c[a].innerHTML = '<div class="legendMarker" style="background-color:' + e[a] + ';" ></div><span>' + h + "</span>";
        $("#legend").append(c[a]);
    }
    
    var d = new google.visualization.PieChart(document.getElementById("chart_div"));
    
    google.visualization.events.addListener(d, "select", function () {
        var a = d.getSelection()[0];
        if (a) {
            var c = b.getValue(a.row, 0);
            $("#legend").find("li").each(function (a, b) {
                -1 < $(this).attr("id").indexOf(c) && $(this).click();
            });
        }
    });
    
    d.draw(b, options);
    
    $("#legend li:not(#legend_head)").click(function () {
        var a = $(this).find("span").text();
        $("#legend li").removeClass("active");
        $(this).addClass("active");
        
        options.slices = options.slices || {};
        
        for (var c in options.slices) {
            options.slices[c].offset = 0;
        }
        
        options.slices[$(this).data("row")] = options.slices[$(this).data("row")] || {};
        options.slices[$(this).data("row")].offset = 0.1;
        
        d.setSelection([{
            row: $(this).data("row"),
            column: null
        }]);
        
        d.draw(b, options);
        
        $addAnimation(a);
    });
    }
    
    function $addAnimation(b) {
    $("html,body").animate({
        scrollTop: $(".text2").offset().top.toFixed(2)
    }, "slow");
    switch (b) {
    case "Netznutzungsentgelte (23,3 %)":
        $(".text2 .text_data").fadeOut();
        $(".text2 #one").fadeIn();
        break;
    case "Beschaffung, Vertrieb, Marge (25,6 %)":
        $(".text2 .text_data").fadeOut();
        $(".text2 #two").fadeIn();
        break;
    case "Stromsteuer (7,4 %)":
        $(".text2 .text_data").fadeOut();
        $(".text2 #three").fadeIn();
        break;
    case "Offshore-Haftungsumlage (0,9 %)":
        $(".text2 .text_data").fadeOut();
        $(".text2 #four").fadeIn();
        break;
    case "EEG-Umlage (19,1 %)":
        $(".text2 .text_data").fadeOut();
        $(".text2 #five").fadeIn();
        break;
    case "\u00a719-StromNEV-Umlage (1,2 %)":
        $(".text2 .text_data").fadeOut();
        $(".text2 #six").fadeIn();
        break;
    case "Konzessionsabgabe (6,1 %)":
        $(".text2 .text_data").fadeOut();
        $(".text2 #seven").fadeIn();
        break;
    case "Umsatzsteuer (16,0 %)":
        $(".text2 .text_data").fadeOut();
        $(".text2 #eight").fadeIn();
        break;
    case "KWKG (0,5 %)":
    
        $(".text2 .text_data").fadeOut();
        $(".text2 #nine").fadeIn();
        break;
    default:
        $(".text2 .text_data").fadeOut(), $(".text2 #one").fadeIn();
    }
    };
    </script>
    
    <div class="breadcrumbs">
    	<?php if(function_exists('bcn_display')){bcn_display();}?>
    </div>

    <!-- begin text block -->
    <div class="text-block">

        <h1><span>Der Strompreis</span></h1>
        
        <div class="strom">
                            
            <span>Eine deutsche Sinfonie der Steuern und Abgaben<img class="arrow" src="<?php bloginfo('template_url'); ?>/images/arrow-1.png" alt="" /> </span>
        
            <div class="text">
        
                <p>Laut dem Vergleichsportal Verivox hat der staatliche Anteil am Strompreis in Deutschland erstmals die Grenze von 50 Prozent überschritten. Ermittelt wurde dieser Wert anhand eines privaten Haushalts mit einem Jahresverbrauch von 4.000 Kilowattstunden. Der durchschnittliche Strompreis (inklusive Grundgebühr) betrug dabei 27,60 Cent pro Kilowattstunde (Stand: Februar 2013).</p>
    
            </div>

            <div class="clear"></div>
    
                <img class="hut" src="<?php bloginfo('template_url'); ?>/images/hut.png" alt="" />
                            
        </div>
        
        <div class="detail">

            <div class="rotator">
                
                <h2><span>Über die Hälfte <br />geht an den Staat.</span><img class="arrow1" src="<?php bloginfo('template_url'); ?>/images/arrow_1.png" alt="" /></h2>
                
                <span class="side_tile"><span>Fläche anklicken und unten nachlesen...</span></span>
                <img class="tab_circle3" src="<?php  bloginfo('template_url'); ?>/images/circle3.png" id="circleimg" alt="" />
                
                <ul id="legend"></ul>
                <div id="chart_div"></div>   
                
            </div>
           
            <div class="clear"></div>
            
        </div>                

        <div class="text2">
            
            <div id="one" class="text_data">
                
                <div class="title">
                
                    <span class="percent"><span>23,3%</span></span>
                    
                    <span class="head">Netznutzungsentgelte<img class="arrow" src="<?php bloginfo('template_url'); ?>/images/arrow_1.png" alt="" /></span>
                    
                 </div>                   
                 
                <div class="content">
                    
                    <p><strong>Diese Entgelte erheben die Stromnetzbetreiber von den jeweiligen Stromlieferanten für die Netznutzung, das heißt für den Transport des Stroms durch ihre Netze zu den Verbrauchern. Sie enthalten unter anderem die Kosten für den Aufbau, den Betrieb und die Instandhaltung von Stromnetzen.</strong>
                    
                    <p> Die Ermittlung der Netznutzungsentgelte wird entsprechend dem Energiewirtschaftsgesetz in der Stromnetzentgeltverordnung geregelt. Die Berechnung der Entgelte erfolgt dabei durch die Festsetzung einer Erlösobergrenze für die jeweiligen Netzbetreiber, die durch eine Kostenprüfung ermittelt wird und die gesamten zulässigen Netzkosten und sonstigen Erlöse decken darf. Geprüft und gegebenenfalls korrigiert werden die Netzentgelte der großen und mittelgroßen Netzbetreiber von der Bundesnetzagentur. Für die Entgelte von Netzbetreibern, deren Stromnetz weniger als 100.000 Haushalte umfasst, sind die Aufsichtsbehörden der jeweiligen Bundesländer zuständig.</p>
               
                </div>
                                    
            </div>
            
            <div id="two" class="text_data">
                
            <div class="title">
            
                <span class="percent"><span>25,6%</span></span>
                
                <span class="head">Beschaffung, Vertrieb, Marge<img class="arrow" src="<?php bloginfo('template_url'); ?>/images/arrow_1.png" alt="" /></span>
                
             </div>                   
             
            <div class="content">
                
                <p><strong>Rund ein Viertel des Strompreises entfällt auf die Erzeugung, den Einkauf und den Vertrieb inklusive Gewinn.</strong>
                
                <p>Was den Stromeinkauf betrifft, so werden die Kosten dafür größtenteils durch die Entwicklungen auf den Energiemärkten – wie zum Beispiel an der Strombörse EEX (European Energy Exchange) in Leipzig – beeinflusst. </p>
           
            </div>
                                    
            </div>
            
            <div id="three" class="text_data">
                
                <div class="title">
                
                    <span class="percent"><span>7,4 %  </span></span>
                    
                    <span class="head"> Stromsteuer<img class="arrow" src="<?php bloginfo('template_url'); ?>/images/arrow_1.png" alt="" /></span>
                    
                 </div>                   
                 
                <div class="content">
                    
                    <p><strong>Als Teil der Ökosteuer wurde die Stromsteuer zum 1. April 1999 im Rahmen des Gesetzes zum Einstieg in die ökologische Steuerreform eingeführt. Sie ist eine indirekte Verbrauchsteuer, die sowohl bei Stromversorgern als auch bei Eigenerzeugern, die ihren Strom zum Selbstverbrauch entnehmen, anfällt.</strong>
                    
                    <p>Seit 2003 beträgt sie 2,05 ct/kWh. Etwa 90 Prozent der Einnahmen aus der Stromsteuer werden für die Rentenkasse verwendet. Dies war ausschlaggebend dafür, dass sowohl der Arbeitnehmer- als auch der Arbeitgeberanteil an den Beiträgen zur Rentenversicherung abgesenkt werden konnte. </p>
               
                </div>

            </div>
            
            <div id="four" class="text_data">
                
                <div class="title">
                
                    <span class="percent"><span>0,9 %</span></span>
                    
                    <span class="head">Offshore-Haftungsumlage<img class="arrow" src="<?php bloginfo('template_url'); ?>/images/arrow_1.png" alt="" /></span>
                    
                 </div>                   
                 
                <div class="content">
                    
                    <p><strong>Seit dem 1. Januar 2013 ist die Offshore-Haftungsumlage ein neuer Bestandteil des Strompreises. </strong>
                    
                    <p>Sie wurde nach § 17 des novellierten Energiewirtschaftsgesetzes von 2012 zur Deckung von Schadenersatzkosten eingeführt, die durch den verspäteten Anschluss von Windenergieanlagen auf See, sogenannten Offshore-Windparks, an das Übertragungsnetz an Land oder durch lang andauernde Netzunterbrechungen entstehen können. Für Letztverbraucher mit einem  Stromverbrauch von bis zu 1.000.000 kWh beträgt die Umlage 0,25 ct/kWh. Für darüber hinausgehende Strombezüge werden 0,05 ct/kWh erhoben. Unternehmen des produzierenden Gewerbes, deren Jahresverbrauch mehr als 1.000.000 kWh betrug und deren Stromkosten im vorangegangenen Kalenderjahr 4 Prozent des Umsatzes überstiegen, können auf Antrag beim Netzbetreiber die Offshore-Haftungsumlage für jede zusätzliche Kilowattstunde auf 0,025 Cent begrenzen. </p>
               
                </div>
                                    
            </div>
            
            <div id="five" class="text_data">
                
                <div class="title">
                
                    <span class="percent"><span>19,1 %</span></span>
                    
                    <span class="head">EEG-Umlage<img class="arrow" src="<?php bloginfo('template_url'); ?>/images/arrow_1.png" alt="" /></span>
                    
                 </div>                   
                 
                <div class="content">
                    
                    <p><strong> Das im Jahr 2000 zur Förderung des Ausbaus erneuerbarer Energien eingeführte Erneuerbare-Energien-Gesetz (EEG) verpflichtet Netzbetreiber dazu, Strom aus regenerativen Energiequellen bevorzugt ins Netz einzuspeisen. Für diesen eingespeisten Strom erhalten die Erzeuger feste Vergütungssätze.</strong>
                    
                    <p> Die Förderkosten werden über die EEG-Umlage auf die Stromkunden verteilt. Unter anderem aufgrund des immensen Zuwachses an Anlagen zur Erzeugung von Strom aus erneuerbaren Energiequellen ist die EEG-Abgabe in den vergangenen Jahren immer wieder kräftig angestiegen. Aber auch die Tatsache, dass immer mehr stromintensive Unternehmen zum Schutz der Wettbewerbsfähigkeit Nachlässe auf die Ökostromabgabe erhalten, führt zu Erhöhungen der EEG-Umlage. Mussten die Verbraucher 2012 noch 3,592 Cent pro Kilowattstunde (ct/kWh) bezahlen, sind 2013 bereits 5,277 ct/kWh fällig. 2014 wird die Abgabe dann auf 6,240 ct/kWh steigen.</p>
               
                </div>
                                    
            </div>
            
            <div id="six" class="text_data">
                
                <div class="title">
                
                    <span class="percent"><span>1,2 %</span></span>
                    
                    <span class="head">§19-StromNEV-Umlage<img class="arrow" src="<?php bloginfo('template_url'); ?>/images/arrow_1.png" alt="" /></span>
                    
                 </div>                   
                 
                <div class="content">
                    
                    <p><strong> Mit der zum 1. Januar 2012 eingeführten Umlage nach § 19 der Stromnetzentgeltverordnung (StromNEV) werden entgangene Erlöse der Netzbetreiber für die Netzentgeltbefreiung stromintensiver Unternehmen ausgeglichen. Seit Anfang 2013 zahlen Letztverbraucher für die jeweils ersten 100.000 kWh je Abnahmestelle eine Umlage von 0,329 ct/kWh.</strong>
                    
                    <p>Ist der Jahresstromverbrauch größer als 100.000 kWh, werden pro zusätzlicher Kilowattstunde 0,05 Cent fällig. Unternehmen des produzierenden Gewerbes, des schienengebundenen Verkehrs oder der Eisenbahninfrastruktur, deren Stromkosten im vorangegangenen Kalenderjahr 4 Prozent des Umsatzes überstiegen, bezahlen für über 100.000 kWh hinausgehende Strombezüge maximal 0,025 ct/kWh.</p>
               
                </div>
                                    
            </div>
            
            <div id="seven" class="text_data">
                
                <div class="title">
                
                    <span class="percent"><span>6,1 %</span></span>
                    
                    <span class="head">Konzessionsabgabe<img class="arrow" src="<?php bloginfo('template_url'); ?>/images/arrow_1.png" alt="" /></span>
                    
                 </div>                   
                 
                <div class="content">
                    
                    <p><strong>Die Konzessionsabgabe wird von Städten und Gemeinden von den Energieversorgungsunternehmen für die Nutzung öffentlicher Wege und Straßen erhoben.</strong>
                    
                    <p>Die zulässige Höhe der Konzessionsabgabe ist dabei von der Einwohnerzahl abhängig. Für Tarifkunden in Gemeinden mit bis zu 25.000 Einwohnern beträgt sie 1,32 ct/kWh, bei bis zu 100.000 Einwohnern liegt sie bei 1,59 ct/kWh, bei bis zu 500.000 Einwohnern müssen 1,99 ct/kWh gezahlt werden und bei Städten mit mehr als 500.000 Einwohnern beträgt die Abgabe 2,39 ct/kWh. </p>
               
                </div>
                                    
            </div>
            
            <div id="eight" class="text_data">
                
                <div class="title">
                
                    <span class="percent"><span>16,0 %</span></span>
                    
                    <span class="head">Umsatzsteuer<img class="arrow" src="<?php bloginfo('template_url'); ?>/images/arrow_1.png" alt="" /></span>
                    
                 </div>                   
                 
                <div class="content">
                    
                    <p><strong>Mit der Umsatzsteuer (Mehrwertsteuer) wird der Austausch von Lieferungen und sonstigen Leistungen besteuert.</strong>
                    
                    <p> Sie muss vom Endverbraucher bezahlt werden und wird beim Strom mit 19 Prozent auf den Netto-Gesamtstrompreis – inklusive Umlagen, Abgaben, Stromsteuer, Netznutzungsentgelte sowie Beschaffung und Vertrieb – erhoben. Vom Bruttostrompreis entfallen damit knapp 16 Prozent auf die Umsatzsteuer. </p>
               
                </div>
                                    
            </div>
            
            <div id="nine" class="text_data">
                
                <div class="title">
                
                    <span class="percent"><span>0,5 %</span></span>
                    
                    <span class="head">KWKG-Umlage  <img class="arrow" src="<?php bloginfo('template_url'); ?>/images/arrow_1.png" alt="" /></span>
                    
                 </div>                   
                 
                <div class="content">
                    
                    <p><strong> Die Umlage wurde mit dem Kraft-Wärme-Kopplungsgesetz (KWKG) im Jahr 2002 eingeführt und dient der Förderung der Stromerzeugung aus Anlagen mit Kraft-Wärme-Kopplung. Seit dem 1. Januar 2013 wird für Letztverbraucher mit einem Jahresstromverbrauch bis 100.000 kWh ein Aufschlag in Höhe von 0,126 ct/kWh erhoben. </strong>
                    
                    <p>Für darüber hinausgehende Strombezüge werden 0,06 ct/kWh berechnet. Energieintensive Unternehmen, deren Stromkosten im vorangegangenen Kalenderjahr 4 Prozent des Umsatzes überstiegen, müssen für über 100.000 kWh hinausgehende Strombezüge 0,025 ct/kWh entrichten.  </p>
               
                </div>
                                    
            </div>
            
            <div class="clear"></div>
                                    
        </div>
        
        <div class="clear"></div>
        
    </div>
    <!-- finish text block -->

	<div class="clear"></div>
            	
</div>

<?php get_footer(); ?>

