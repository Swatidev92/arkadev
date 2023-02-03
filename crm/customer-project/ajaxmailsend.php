<?php 
include("../../lib/opin.inc.php");
//echo "1";die;
//print_r($_POST['val']);die;
if($_POST['val']==1){
    $res = array(
        'subject' => "Välkommen till Arka Energy",
        'msg' => "Varmt välkommen till oss på Arka Energy.<br>
        <br>
        Nu när ni är kund hos oss tycker vi det är viktigt att ni får en förståelse för hur processen framåt kommer att se ut.<br>
        <br>
        <b>1.</b> Kontrakt signerat. (Klart)<br>
        <br>
        <b>2.</b> Föranmälan av ert system skickas in till er nätägare. I de allra flesta fall behöver vi en signatur på föranmälan. Tidsramen för denna process varierar mellan olika nätägare men när nätägaren har gett sitt installationsmedgivande kommer även ni som kund att få en bekräftelse. Efter detta kommer vi kontakta er för att planera installationen. (Påbörjad)<br>
        <br>
        <b>3. Planering av installationsdatum.</b> Detta sker efter att vi har fått installationsmedgivande från nätägaren.<br>
        <br>
        <b>4. Systeminstallation.</b> Beroende på takets storlek och komplexitet tar installationen normalt mellan 1-3 dagar. Under denna del av installationen behöver ni som kund inte vara hemma om ni inte har särskilda önskemål om placering av växelriktare som t.ex. garage eller källare.<br>
        <br>
        <b>5. Elinstallation.</b> Installation av växelriktare till elcentral. Under denna del av installationen behöver ni vara hemma. Elinstallatören kommer att kontakta er för att boka en tid för installation och genomgång av systemet.<br>
        <br>
        <b>6. Driftsättning och kontroll.</b> Systemtest för att säkerställa att allt fungerar som det ska.<br>
        <br>
        Efter lyckad driftsättning av ert system skapas ett konto för övervakning av systemet som ni kan följa via App eller Web.
        <br>
        <br>
        <b>7. Färdiganmälan.</b> När elinstallationen är slutförd skickas en färdiganmälan in till nätägaren. Ni får ej slå på systemet förrän nätägaren har varit på plats och gjort en slutbesiktning eftersom ni då kan få betala för strömmen som produceras och går till elnätet.<br>
        <br>
        Tiden för detta varierar beroende på nätägare samt vilka aktiviteter som behöver utföras. <br>
        <br>
        I detta skede kommer de även undersöka om din elmätare behöver bytas ut.<br>
        <br>
        <b>OBS:</b> Vi kan ej påverka handläggningstiden för detta och ni som kund har ej rätt att innehålla betalningen till dess att nätägaren har varit på plats.<br>
        <br>
        <b>8.</b> Bekräftelse från nätägare att ni får slå på ert system. Nu kan ni slå på brytaren och börja ta vara på solenergin.<br>  
        <br>
        Har ni några frågor om ovanstående punkter kan ni kontakta mig.<br>
        <br>
        <br>
        <!-- Vänliga Hälsningar<br>-->
        <br>
        Filip Doder<br>
        Projektledare<br>
         <br>
         <table style='background-color:green;width:100%;padding: 10px;'>
         <tr style='color:white;'>
         <td style='fon-size:10px;padding-left: 20px;padding-top: 5px;padding-bottom: 5px;color:white;'> 
         Mobil: +46 (0)70 975 00 31<br>
         Växel: +46 (0)880 08 80<br>
         Birger Jarlsgatan 104E<br>
         114 20 Stockholm</td>
         <td style='text-align: right;font-size: 20px;'><a href='www.arka.se' style='color:#FFFCFB  !important;'>www.arka.se</a><br></td>
         </tr> 
         </table>
        <br>
       <p style='font-size:10px;'> Vi på ARKA ENERGY är drivande i omställningen till 100% förnyelsebar energi och att skapa ett fossilfritt samhälle för framtida generationer. <br>
        <br>
        Vi erbjuder solceller, elbilsladdare, energilagringslösningar och applikationer som gör det möjligt för människor att kontrollera, spara, dela och hantera sin energiproduktion, lagring och konsumtion.<br></p>
        <br>"

    );
    echo json_encode($res);
    //echo "1";
}
elseif($_POST['val']==2){
    $res = array(
        'subject' => "Installationsdatum - Arka Energy AB",
        'msg' => "Hej,<br><br>
        Detta automatiskt genererat epost-meddelande, vänligen svara inte på detta meddelande.<br><br>
        Ni har fått en preliminär inbokad installation vecka ?.<br><br>
        Den ansvarige projektledaren kommer kontakta er ca två veckor innan planerad installation för att bekräfta datumet och gå igenom installationsprocessen. Installations Datumet kan bli tidigarelagd och i dessa fall blir ni kontaktade av den ansvarige projektledaren.<Br><br>
        När vi utför tak montaget så behöver ni inte vara hemma, men ni behöver finnas tillgängliga via telefon.<br><br>
        Anm: Om det skulle uppkomma oförutsägbara hinder, så kan datum komma att ändras. Ni kommer då meddelas omgående.<br>
        <br>
        
        <!--Vi på ARKA ENERGY är drivande i omställningen till 100% förnyelsebar energi och att skapa ett fossilfritt samhälle för framtida generationer.<br> 
        <br>
        Vi erbjuder solceller, elbilsladdare, energilagring lösningar och applikationer som gör det möjligt för människor att kontrollera, spara, dela och hantera sin energiproduktion, lagring och konsumtion.<br>
        <Br>-->
        <br>
        <table style='background-color:green;width:100%;padding: 10px;'>
        <tr style='color:white;'>
        <td style='fon-size:10px;padding-left: 20px;padding-top: 5px;padding-bottom: 5px;color:white;'> 
        Mobil: +46 (0)70 975 00 31<br>
        Växel: +46 (0)880 08 80<br>
        Birger Jarlsgatan 104E<br>
        114 20 Stockholm</td>
        <td style='text-align: right;font-size: 20px;'><a href='www.arka.se' style='color:#FFFCFB  !important;'>www.arka.se</a><br></td>
        </tr> 
        </table>
        <Br>
        <p style='font-size:10px;'>Vi på ARKA ENERGY är drivande i omställningen till 100% förnyelsebar energi och att skapa ett fossilfritt samhälle för framtida generationer. <Br>
        <br>
        Vi erbjuder solceller, elbilsladdare, energilagringslösningar och applikationer som gör det möjligt för människor att kontrollera, spara, dela och hantera sin energiproduktion, lagring och konsumtion.</p>"

    );
    echo json_encode($res);
}
else{

}