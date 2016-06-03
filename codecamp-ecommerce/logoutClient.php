<?php

require('_init.php');
// Desctuction session
session_start();

$query = "DELETE FROM commandes WHERE payer=0 AND idClient=".$_SESSION['clientId'];

if(!mysqli_query($link, $query)) {
    echo "Erreur : impossible de vider le panier";
}

session_destroy();
session_unset();
session_start();



header('Location: index.php');

?>