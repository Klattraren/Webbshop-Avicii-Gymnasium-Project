<?php
$fnamn = "data/gastbok.txt";
if (file_exists($fnamn))
{
$data = file($fnamn);
foreach($data as $rad)
{
$fält = explode("|",$rad);
$datum = $fält[0];
$namnet = $fält[1];
$enamnet = $fält[2];
$adress = $fält[3];
$ort = $fält[4];
$email = $fält[5];
$tel = $fält[6];
$datum2 = $fält[7];

if (preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,6})$/', $email))
{
$email = "<a href=\"mailto:".$email."\">$email</a>";
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
echo "<hr>\n";
echo "<b>$ort $datum</b><br>\n";
echo "<b>$namnet $enamnet <br> $email <br> $tel <br> $datum2 </b>";
}
}
echo "</td></tr></table>\n";
$_POST['texten'] = "";    // Raderar $texten, förhindrar dubbelpost.
echo "</BODY></HTML>\n";

?>

<br><br><br><button onclick="window.print()">Skriv ut</button>