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

echo "<b>$namnet <br> $enamnet</b>";
}
}
echo "</td></tr></table>\n";
$_POST['texten'] = "";    // Raderar $texten, förhindrar dubbelpost.
echo "</BODY></HTML>\n";

?>