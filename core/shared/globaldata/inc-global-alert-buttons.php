<?
// GLOBAL CLASSES/ALERTS/BUTTON AND TEXT

// ID
$gloMyIDInfo = "Detta är ditt unika personliga id-nummer. Den blir praktisk för dig för att identifiera dig själv med vår support.";
$gloMyClientIDInfo = "Detta är ditt unika kund id-nummer. Den blir praktisk för dig för att identifiera dig själv med vår support.";
$gloMyServiceIDInfo = "Detta är tjänstens unika id-nummer. Den blir praktisk för dig för att identifiera dig själv med vår support.";
$gloMySiteIDInfo = "Detta är hemsidans unika id-nummer. Den blir praktisk för dig för att identifiera dig själv med vår support.";

$gloMyHaloIDInfo = "Detta är ditt unika HALO id-nummer. Den blir praktisk för dig för att identifiera dig själv med vår support.";

// Customdomains info
$gloSiteCustomDomainsInfo = "När ni vill publicera era hemsidor på era egna domäner<br> (tex minhemsida.se istället för moonhalo.se/minhemsida)<br> kontaktar ni support, så hjälper vi er med publiceringen.<br> Det fungerar även om domänen är extern hos någon annan.";
$gloHaloCustomDomainsInfo = "När ni vill publicera era Halos på era egna domäner<br> (tex minhemsida.se istället för moonhalo.se/minhemsida)<br> kontaktar ni support, så hjälper vi er med publiceringen.<br> Det fungerar även om domänen är extern hos någon annan.";


// GLOBAL BUTTON CLASSES
$btnPrimary = "btn brand-button";
$btnSecondary = "btn btn-secondary";
$btnLight = "btn btn-light";
$btnDanger = "btn btn-light";
$btnWarning = "btn btn-warning";
$btnInfo = "btn btn-info";
$btnSuccess = "btn brand-button";
$btnSubmit = "btn brand-button";
$btnCancel = "btn btn-light";
$btnGeneric = "btn btn_generic";
$btnDark = "btn btn-dark";

$gloJavaBack    = "javascript:history.back()";
$gloBackButton  = "<a class='" . $btnLight . "' href='" . $gloJavaBack . "'><i class='fas fa-arrow-circle-left'></i> Tillbaka</a>";
$gloAbortButton = "<a class='" . $btnLight . "' href='" . $gloJavaBack . "'><i class='fas fa-times-circle'></i> Tillbaka</a>";

$gloClose    = $gloBase . "close";
$gloCloseButton  = "<a class='" . $btnLight . "' href='" . $gloClose . "'><i class='fas fa-arrow-circle-down'></i> Tillbaka</a>";
$gloCloseButton2  = "<a class='" . $btnLight . "' href='" . $gloJavaBack . "'><i class='fas fa-times-circle'></i> Stäng</a>";


$gloSendButton = "<button type='submit' class='" . $btnSuccess . "'><i class='fas fa-check-circle'></i> Spara</button>";
$gloCreateButton = "<button type='submit' class='" . $btnSuccess . "'><i class='fas fa-plus-circle'></i> Skapa</button>";
$gloAddButton = "<button type='submit' class='" . $btnSuccess . "'><i class='fas fa-plus-circle'></i> Lägg till</button>";

$gloModalAbortButton = "<button type='button' class='" . $btnLight . "' data-dismiss='modal' data-bs-dismiss='modal'><i class='fas fa-times-circle'></i> Avbryt</a>";
$gloModalCloseButton = "<button type='button' class='" . $btnLight . "' data-dismiss='modal' data-bs-dismiss='modal'><i class='fas fa-times-circle'></i> Stäng</a>";


// DEFAULT STATUS TEXTS
$gloStatusSaveError = "kunde inte sparas korrekt. Var god försök igen eller kontakta administratören.";
$gloStatusUpdateError = "kunde inte uppdateras korrekt eller så har du klickat på spara knappen utan att ändra något. Var god försök igen eller kontakta administratören.";
$gloStatusUpdateOK = "uppdaterades utan problem.";
$gloStatusSaveOK = "uppdaterades utan problem.";

// DEFAULT HR
$HR = "<hr style='border: 1px solid #d9d9d9; margin-bottom: 30px;'>"; // HR CARD TOP
$HR10 = "<hr style='border: 1px solid #d9d9d9; margin-bottom: 10px;'>";
$HR0 = "<hr style='border: 1px solid #d9d9d9; margin: 0px;'>";
$HRB = "<hr style='border: 1px solid #d9d9d9; margin-top: 30px; margin-bottom: 10px;'>"; // HR CARD BOTTOM

// DEFAULT CARD TITLE
$CARDTITLEBEGIN = "<h4 class='cardtitle'><b>cardtitless text-primary";
$CARDTITLEEND = "</b></h4><hr>";

// DEFAULT GLOBAL ALERT CLASSES
$alert = "alert alert-dismissable mb30 p-3 text-dark";
$alertError = "alert alert-danger alert-dismissable mb30 p-3 text-dark";
$alertSuccess = "alert alert-success alert-dismissable mb30 p-3 text-dark";
$alertInfo = "alert alert-info alert-dismissable mb30 p-3 text-dark";
$alertWarning = "alert alert-warning alert-dismissable mb30 p-3 text-dark";
$alertDanger = "alert alert-danger alert-dismissable mb30 p-3 text-dark";

// GLOBAL TEXTS
$gloWrongAccess = "
	 <h3 class='mt5'><i class='fas fa-exclamation-triangle'></i> Fel beh&ouml;righet</h3>
	 <p>Tyv&auml;rr har du inte beh&ouml;righet att anv&auml;nda denna tj&auml;nst på denna kundprofil. F&ouml;r mer information var v&auml;nlig kontakta din systemadministrat&ouml;r.</p>
	 <br>
     <p><a class='btn btn-light' href='javascript: window.history.back();'><i class='fas fa-arrow-alt-circle-left'></i> Tillbaka</a></p>
	";

$gloWrongAccess2 = "
	 <h3 class='mt5'><i class='fas fa-exclamation-triangle'></i> Fel beh&ouml;righet</h3>
	 <p>Tyv&auml;rr har du inte beh&ouml;righet att anv&auml;nda denna tj&auml;nst på denna kundprofil. F&ouml;r mer information var v&auml;nlig kontakta din systemadministrat&ouml;r.</p>
	";

$gloNoService = "
	 <h3 class='mt5'><i class='fas fa-info-circle'></i> Denna tjänst är inte aktiverad på denna kundprofil.</h3>
	 <p>Tyvärr kan du inte använda denna tjänst då den inte är aktiverad ännu på denna kundprofil. <br>Om du skulle vilja använda denna tjänst gå till Store och beställ tjänsten (Observera att bara er Huvud Administratör kan beställa).</p>
	 <br>
     <p><a class='btn btn-light' href='javascript: window.history.back();'><i class='fas fa-arrow-alt-circle-left'></i> Tillbaka</a> 
	 <a class='btn btn-primary' href='/store'><i class='fas fa-shopping-cart'></i> Store</a></p>
	";

$gloWrongTurn = "
	 <h3 class='mt5'><i class='fas fa-info-circle'></i> Du har hamnat lite fel.</h3>
	 <p>Du har hamnat lite fel, det kan bero på att du använt webbläsarens bakåt knapp. </p>
	 <br>
     <p>
	  <a class='btn btn-light' href='/close'><i class='fas fa-user-tie'></i> Tillbaka till Startsidan / Mitt konto</a>
	 </p>
	";

$gloEmptyDB = "
	 <h3 class='mt5'><i class='fas fa-info-circle'></i> Databasen &auml;r tom</h3>
	 <p>Det finns ingen sparad info i denna databas &auml;nnu.</p>
	 <br>
     <p><a class='btn btn-light' href='javascript: window.history.back();'><i class='fas fa-arrow-alt-circle-left'></i> Tillbaka</a></p>
	";

$gloEmpty = "
	 <h3 class='mt5'><i class='fas fa-info-circle'></i> H&auml;r var det tomt</h3>
	 <p>Det finns ingen sparad info h&auml;r &auml;nnu.</p>    
	";

$gloMissingID = "
	 <h3 class='mt5'><i class='fas fa-info-circle'></i> Information saknas</h3>
	 <p>Det finns ingen info ännu.</p>
	 <br>
   	 <p><a class='btn btn-light' href='javascript: window.history.back();'><i class='fas fa-arrow-alt-circle-left'></i> Tillbaka</a></p>
	";

$gloServiceUnderConstruction = "
	 <h3 class='mt5'><i class='fas fa-user-astronaut'></i> Tjänst ej tillgänglig ännu</h3>
	 <p>Tjänsten är fortfarande under uppbyggnad, kom tillbaka senare. / Service under construction, come back later.</p>
	 <br>
   	 <p><a class='btn btn-light' href='javascript: window.history.back();'><i class='fas fa-arrow-alt-circle-left'></i> Tillbaka</a></p>
	";

$gloIndev = "
	 <h3 class='mt5'><i class='fas fa-user-astronaut'></i> Tjänst ej tillgänglig ännu</h3>
	 <p>Tjänsten är fortfarande under uppbyggnad, kom tillbaka senare. / Service under construction, come back later.</p>
	";

$gloReadOnly = "
	 <h4 class='mt5 mb-0 text-dark'><i class='fas fa-info-circle'></i> Datan som finns här kan inte redigeras men du kan se vad som finns.</h4>
	";
