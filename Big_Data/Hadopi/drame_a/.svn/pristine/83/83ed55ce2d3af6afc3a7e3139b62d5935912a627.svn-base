<!DOCTYPE html>
<html>
<head>
    <title>test</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >

</head>
<body>

<?php

if (file_exists('bdd.xml')) {
    $xml = simplexml_load_file('bdd.xml');
        
        for ($i = 0; $i < 100000; $i++)
        {
            $vid = $i;

            echo "clef ->".$i;
            echo "<br /><br />";
            echo "Titre : ".$xml->Video[$vid]->Title;
            echo "<br />";
            echo "Categories : ".$xml->Video[$vid]->Categories->Category;
            echo "<br />";            
        }

} else {
    exit('Echec lors de l\'ouverture du fichier test.xml.');
}
?>


</body>
</html>
