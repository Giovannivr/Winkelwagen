<?php
/*
 // Deze code om contactformulier via mail te versturen met de informatie
*/

  $name = $_POST['naam'];
  $email= $_POST['email'];


  $totaal = "$name . $email";
  $tomail = "giovannivr@live.com";

  mail($tomail, "Nieuwe vraag", $totaal);

?>
<h1>Uw bericht is verstuurd wij nemen zo spoedig mogelijk contact met u op.</h1>
<h1>Druk op de home link om terug te gaan naar de homepagina van onze webshop</h1>
<a class="nav-link text-white" href="http://127.0.0.1:8000/">Home</a>
