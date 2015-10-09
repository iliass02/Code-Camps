<?php

if (file_exists('bdd.xml')) {
    $xml = simplexml_load_file('bdd.xml');
        
            $vid = 4854;
            
            echo "<a href = ".$xml->Video[$vid]->URL."><img src='".$xml->Video[$vid]->URLPhoto."' /></a>";
            echo "<br>";
            echo "<label>";
            echo "Titre : ".$xml->Video[$vid]->Title;
            echo "</label>";
            echo "<br>";
            echo "Date de publication : ".$xml->Video[$vid]->PublicationDate;

} else {
    exit('Echec lors de l\'ouverture du fichier test.xml.');
}
}

?>