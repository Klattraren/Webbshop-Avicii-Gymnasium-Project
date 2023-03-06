<?php  
error_reporting(0);
                  // Uppdaterad 26 juli 2018
$fnamn = "data/gastbok.txt";        // Filen som skall ändras (med sökväg).
if (file_exists($fnamn)) {
if (isset ($_REQUEST["spara"])) {    // Spara ändringar:
$r = $_POST['r']; $nr = $_POST['nr'];     // r=radnr. nr=del på raden.
$fil = file($fnamn);
$raden = explode('|', $fil[$r]);
for($i = 0; $i<$nr+1; $i++) {
$raden[$i] = $_POST{'c'.$i};         // Hämtar från formulär till raden.
}
$raden[2] = stripslashes($raden[2]);
$raden[2] = str_replace("\r\n", "<br>", $raden[2]);    // Lägger till <br>
$raden = implode('|', $raden);        // Packar ihop raden.
$raden = $raden ."\r\n";        // Lägger tillbaka radbrytningen.
$fil[$r] = $raden;
$fp = fopen($fnamn, 'w');
fwrite($fp, implode('', $fil));        // Packar ihop raderna och sparar.
fclose($fp);
header("Location:". $_SERVER['PHP_SELF']);    // Till fil efer redigering.
}
 
if (isset ($_REQUEST["radera"])) {            // Raderar rad:
    $innehåll = file($fnamn);
    array_splice ($innehåll, $_REQUEST["radera"], 1);
    $fil = fopen ($fnamn,"w");
    if ($fil)
    {
    
    foreach ($innehåll as $radera) { fputs ($fil, $radera); }
    flock ($fil, 3); fclose ($fil);
    }
header("Location:". $_SERVER['PHP_SELF']);    // Till fil, som visas efter radering.
}
 
echo "<html><head>
<META HTTP-EQUIV=\"Pragma\" CONTENT=\"no-cache\">
<META HTTP-EQUIV=\"Expires\" CONTENT=\"-1\">
<meta name=\"robots\" content=\"noindex, nofollow\">
<title>Redigera gästbok</title></head><body BGCOLOR=\"#cccccc\">\n";
echo "Editera <b>$fnamn:</b> ";
echo "Filstorlek: ".filesize($fnamn)." bytes. \n";
echo "Senast ändrad: ".date("Y-m-d H:i", filemtime($fnamn)).".<br>\n";
 
if (isset ($_REQUEST["rad"]))
{
 
echo "<form name=\"edit\" method=\"post\" action=\"$PHP_SELF\">\n";
echo "<b>Ändra denna post:</b><br>\n";
$data = file($fnamn);
$ed = explode('|', $data[$_GET['rad']]);    // Raden som skall ändras.
foreach($ed as $nr=>$del)
{
$rad = $_GET['rad'];                
}
$ed[2] = str_replace("<br>", "\n", $ed[2]);    // Tar bort <br>.
echo "<center><table><tr>\n";
echo "<td>Datum<br><input type=\"text\" size=30 name=\"c0\" value=\"$ed[0]\"></td>\n";
echo "<td>Namn<br><input type=\"text\" size=30 name=\"c1\" value=\"$ed[1]\"></td>\n";
echo "<td>Efternamn<br><input type=\"text\" size=30 name=\"c2\" value=\"$ed[2]\"></td>\n";


echo "<input type=\"hidden\" name=\"nr\" value=\"$nr\">\n";
echo "<input type=\"hidden\" name=\"r\" value=\"$rad\">\n";
echo "<td colspan=4><input type=\"submit\" name=\"spara\" value=\"Spara\">\n";
echo "<input type=\"reset\" value=\"Ångra\"></form></td></tr>\n";
echo "</table>\n";
}
else {
$data = file($fnamn)Or Die("Filen, $fnamn är tom!<br>\n");
echo "<b>Var noga, så du inte ändrar fel rad!</b><br>\n";
// asort($data);    // Om raderna skall sorteras.
echo "<table cellspacing=1>\n";                // Radlista.
echo "<tr><th>Datum</th><th>Namn</th><th>Efternamn</th></tr>\n";
foreach($data as $index=>$rad)
{
$fält = explode("|",$rad);
echo "<tr valign=top bgcolor=white>\n";
echo "<td><a href=\"?rad=$index\">Ändra</a> <a href=\"?radera=$index\">Radera</a></td>\n";
echo "<td>$fält[0]</td><td>$fält[3]</td><td>$fält[1]</td><td>$fält[2]</td><td>$fält[4]</td><td>$fält[5]</td><td>$fält[6]</td><td>$fält[7]</td>\n";
echo "</tr>\n";
}
echo "</table>\n";
}
} else {echo "Filen:<b> $fnamn </b>finns inte!";}
echo "</body></html>";

?>
<br><br><br><button onclick="window.print()">Skriv ut</button>
