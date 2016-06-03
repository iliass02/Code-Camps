<?php


if (isset($_GET['typeAjax'])) $typeAjax = $_GET['typeAjax'];
elseif (isset($_POST['typeAjax'])) $typeAjax = $_POST['typeAjax'];
else exit();


switch ($typeAjax) {

	case 'insertProduitPanier' :
		include ('_init.php');

		if (isset($_GET['produitId']) && is_numeric($_GET['produitId']) && isset($_GET['idClient']) && is_numeric($_GET['idClient'])){
			$produitId = intval($_GET['produitId']);
			$clientId = intval($_GET['idClient']);
		} else exit();

		$query = "INSERT INTO commandes (
					idClient, idProduit, payer, date
				  ) VALUES (
				  	$clientId, $produitId, 0, NOW()
				  )";
		if(!mysqli_query($link, $query)) echo "Erreur";
		else echo '<script>swal({title: "Panier", text: "Le produit a bien été ajouté au panier", type: "success", timer: 1000, showConfirmButton: false});</script>';

		break;
	
	case 'validationProduit' :
		include('_init.php');
		
		if (isset($_GET['produitId']) && is_numeric($_GET['produitId'])) $produitId = intval($_GET['produitId']);
		else exit();
		
		$query = "UPDATE produits SET
				active=1
				WHERE id=$produitId";
		if (!mysqli_query($link, $query)) echo "Erreur";
		else echo '<script>swal({title: "Produit accepté", text: "", type: "success", timer: 1000, showConfirmButton: false});</script>';
		
		break;
		
	case 'rejetProduit' :
		include('_init.php');
	
		if (isset($_GET['produitId']) && is_numeric($_GET['produitId'])) $produitId = intval($_GET['produitId']);
		else exit();
	
		$query = "UPDATE produits SET
		active=0
		WHERE id=$produitId";
		if (!mysqli_query($link, $query)) echo "Erreur";
		else echo '<script>swal({title: "Produit refusé", text: "", type: "success", timer: 1000, showConfirmButton: false});</script>';
		
		break;
		
		case 'autocompleteHaut':
			include('_init.php');
		
			// On vérifie qu'un élément est bien envoyé
			if (isset($_POST['champRecherche'])) {
				$champRecherche = traiteTexte($_POST['champRecherche']);
				// Plus grand que 0
				if (strlen($champRecherche) > 0) {
					$query = "SELECT id, categorie, nomProduit FROM produits WHERE nomProduit LIKE '%$champRecherche%'";
					$result = mysqli_query($link, $query);
					$html = "";
					while ($row = mysqli_fetch_assoc($result)) {
						$html .= "<center><b><a href='ficheProduit.php?id=".$row["id"]."&categorie=".$row["categorie"]."'>Article ".$titreCategorie[$row["categorie"]]." : ".$row["nomProduit"]."</a></b></center><br>";
					}
				} 
			}
			
			echo $html;
			break;
		
}