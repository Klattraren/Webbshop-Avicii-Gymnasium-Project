<?php
if ($_POST)
{
$namn = $_POST['namn'];
$meddelande = $_POST['meddelande'];
$enamn = $_POST['enamn'];
$tele = $_POST['tele'];
$epost = $_POST['epost'];
$adress = $_POST['adress'];
$input = $namn."|".$enamn."|".$tele."|".$adress."|".$epost."|".$meddelande."\n";

$filinformation = file_get_contents ("gastbok.txt");
$filen = fopen ("gastbok.txt", "w");
fwrite($filen,$input);
fwrite( $filen, $filinformation);
fclose($filen);
echo "Tack för ditt inlägg! ";

}
else 
{
	echo "Du måste skriva ett inlägg! ";
}

?>
<br>
<a href="gb.php">Gå tillbaka<a/>