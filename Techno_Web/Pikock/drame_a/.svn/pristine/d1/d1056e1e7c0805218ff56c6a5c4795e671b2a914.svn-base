<!DOCTYPE html>
<html>
	<head>
   		<title>Téléchargement Terminé</title>
    	<link rel="stylesheet" type="text/css" href="../css/téléchargement.css">
    	<meta http-equiv="Content Type" content="text/html"; charset="utf-8">
	</head>
<font face="Oswald"></font>
	<body>
		</br></br></br></br></br>
		<h1>Téléchargement Terminé !</h1>
		<center><img src="../img/Validation.png"><center>
    </body>
</html>

<?php

function choppe_image($_url,$_fichier){
    $in = fopen($_url, "rb");
    $out = fopen($_fichier, "wb");

    while ($brut = fread($in,8192)){
        fwrite($out, $brut, 8192);
    }
    fclose($in); 
    fclose($out);
}

$url = 'http://chart.apis.google.com/chart?cht=qr&chs=500x500&chl=amifa.pikock.me';
$fichier = $_SERVER['DOCUMENT_ROOT'].'/Présentation_final/code_qr.jpg';

choppe_image($url,$fichier);

?>
