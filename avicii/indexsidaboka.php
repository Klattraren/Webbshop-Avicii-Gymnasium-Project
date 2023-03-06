<html>
<head>
<title>Testkör BMW M3</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="stylesidan.css">



</head>
<div>
<body>
<table align=center width=800 bgcolor="#fff"><tr><td>
<?php
echo "<form method=\"post\" action=\"\"\n>"
?>

<center>
<h2 id="titletext">Kom och provkör nya BMW M3!</h2>
<?php?>
<table>

<div class="Input">
    <input type="text" id="input" class="Input-text" placeholder="Förnamn" name="namnet">
    <label for="input" class="Input-label">Namn</label>
	<br>
  </div>
  <div class="Input">
    <input type="text" id="input" class="Input-text" placeholder="Efternamn" name="enamnet">
    <label for="input" class="Input-label">Efternamn</label>
	<br>
  </div>
  <div class="Input">
    <input type="text" id="input" class="Input-text" placeholder="Epost" name="email">
    <label for="input" class="Input-label">Email</label>
	<br>
  </div>	

  
<input type="submit" name="Submit" value="Skicka">
<input type="reset" name="reset" value="Radera">
</center>
</table>
</form>



<?php                // Uppdaterad gästbok

$ip = $_SERVER['REMOTE_ADDR'];
$datum = date('Y-m-d H:i');
$tdatum = date('d');
$fnamn = "data/gastbok.txt";        // Katalog/fil för gästboksinläggen.
$fel = "(2 siffror)";
$fusk = "40";
if ($_POST['namnet']){
if ($_POST['email']){
 

if ($tdatum < $fusk ) {
 
 
$input = $datum."|".$_POST['namnet']."|".$_POST['enamnet']."\n";
    if (file_exists($fnamn))
    {
    $fil = file_get_contents($fnamn);    // Hämta gamla texten till $file.
    }
$fp = fopen ($fnamn, "w");      // Öppnar filen för överskrivning
fwrite($fp, "$input");           // Skriv in den nya texten 
fwrite($fp, "$fil");         // Lägg till den tidigare texten
fclose ($fp);             // Stänger filen.
header("Location:". $_SERVER['PHP_SELF']); exit;
}
}
}


 

?>
</div>
</body>
 


