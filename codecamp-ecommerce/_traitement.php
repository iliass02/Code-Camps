<?php
include('_init.php');

if (isset($_POST['typeTraitement'])) $typeTraitement = $_POST['typeTraitement'];
elseif (isset($_GET['typeTraitement'])) $typeTraitement = $_GET['typeTraitement'];
else exit();
// Dans la plupart des cas, la variable id est envoyée en GET ou en POST
if (isset($_POST['id']) && is_numeric($_POST['id'])) $id = intval($_POST['id']);
elseif (isset($_GET['id']) && is_numeric($_GET['id'])) $id = intval($_GET['id']);
// En fonction du type de traitement, on exécute la requête
switch($typeTraitement) {
/**
 * GESTION UTILISATEURS
 * 
 * 
 */
	case 'ajoutProduit' :
		session_start();
		if(isset($_POST['nomProduit']) && isset($_POST['description']) && isset($_POST['prix']) && isset($_POST['categorie']) && isset($_POST['stock'])) {
			if(!empty($_POST['nomProduit']) && !empty($_POST['description']) && !empty($_POST['prix']) && !empty($_POST['categorie']) && !empty($_POST['stock']) ) {
				/*
                 * variable for SQL request
                 */
				$nomProduit = $_POST['nomProduit'];
				$description = $_POST['description'];
				$prix = $_POST['prix'];
				$categorie = $_POST['categorie'];
				$stock = $_POST['stock'];
				$idClient = $_SESSION['fournisseurId'];
				/*
                 * UPLOAD IMAGE
                 */
				$target_dir = "images/";
				$target_file = $target_dir . basename($_FILES["image"]["name"]);
				$uploadOk = 1;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				// Check if image file is a actual image or fake image
				$check = getimagesize($_FILES["image"]["tmp_name"]);
				if(!$check !== false) {
					echo "Erreur, ce n'est pas une image";
					$uploadOk = 0;
				}
				// Check if file already exists
				if (file_exists($target_file)) {
					$target_file = $target_dir . basename(rand(1, 100000).$_FILES["image"]["name"]);
					$uploadOk = 1;
				}
				// Check file size
				if ($_FILES["image"]["size"] > 500000) {
					echo "Sorry, your file is too large.";
					$uploadOk = 0;
				}
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					&& $imageFileType != "gif" ) {
					echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
					$uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
					echo "Sorry, your file was not uploaded.";
					// if everything is ok, try to upload file
				}
				if ($uploadOk == 1) {
					if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
						echo "Sorry, there was an error uploading your file.";
					}
				}
				/*
                 * SQL Request : INSERT PRODUIT
                 */
				$request = "INSERT INTO produits (nomProduit, description, prix, categorie, active, stock, image, idClient, date)
							  VALUES ('$nomProduit', '$description', '$prix', $categorie, 2, $stock, '$target_file', $idClient, NOW())";
				if($query = mysqli_query($link, $request)) {
					header('Location: listeProduitFournisseur.php');
				} else {
					echo "Error";
				}
			} else {
				echo "Vide";
			}
		} else {
			echo "NULL";
		}
		break;

	case 'removeProduit':
		if(isset($_POST['idProduit'])) {
			$idProduit = $_POST['idProduit'];
			$request = "DELETE FROM produits WHERE id = ".$idProduit;
			if($query = mysqli_query($link, $request)) {
				header('Location: listeProduitFournisseur.php?success=2');
			} else {
				header('Location: listeProduitFournisseur.php?error=2');
			}
		} else {
			header('Location: listeProduitFournisseur.php?error=2');
		}
		break;

	case 'modifProduit':
		if(isset($_POST['idProduit']) || isset($_POST['nomProduit']) || isset($_POST['description']) || isset($_POST['prix']) || isset($_POST['stock']) || isset($_POST['categorie'])){
			$nomProduit = $_POST['nomProduit'];
			$description = $_POST['description'];
			$prix = $_POST['prix'];
			$stock = $_POST['stock'];
			$categorie = $_POST['categorie'];
			$idProduit = $_POST['idProduit'];
			$query = "UPDATE produits
						SET nomProduit = '$nomProduit',description='$description', prix='$prix', stock='$stock', categorie='$categorie'
						WHERE id=".$idProduit;
			if (!mysqli_query($link, $query)) header('Location: listeProduitFournisseur.php?error=1');
			else header('Location: listeProduitFournisseur.php?success=1');
		}
		break;

	case 'removeProduitPanier':
		if( isset($_POST['produitId'])) {
			$produitId = $_POST['produitId'];
			$clientId = $_POST['clientId'];

			$request = "DELETE FROM commandes
						WHERE idProduit=".$produitId."
						AND idClient = ".$clientId;

			if (!$query = mysqli_query($link, $request)) {
				header('Location: panier.php?error=1');
			} else {
				header('Location: panier.php?success=1');
			}
		}
		break;

	case 'ClientAPaye':

		if (isset($_POST['clientId']) || isset($_POST['adresseLivraisonId'])) {
			$clientId = $_POST['clientId'];
			$adresseLivraisonId = $_POST['adresseLivraisonId'];

			$request = "UPDATE commandes as cs, produits as p
						SET cs.payer=1, p.stock = p.stock-1, cs.idAdresseLivraison = '$adresseLivraisonId'
						WHERE
						cs.payer=0 AND p.id = cs.idProduit AND cs.idClient=".$clientId;
			if (!$query = mysqli_query($link, $request)) {
				header('Location: payer.php?error=3');
			} else {
				header('Location: facture.php');
			}
		}

		break;

	case 'updateStatutProduit':

		if (isset($_POST['produitId']) || isset($_POST['statut']) || isset($_POST['clientId'])) {
			$produitId = $_POST['produitId'];
			$statut = $_POST['statut'];
			$clientId = $_POST['clientId'];

			$request = "UPDATE commandes
						SET payer =".$statut."
						WHERE idProduit =".$produitId."
						AND idClient = ".$clientId;

			if (!$query = mysqli_query($link, $request)) {
				header('Location: commandes.php?error=1');
			} else {
				header('Location: commandes.php?success=1');
			}
		}

		break;

	case 'removeUser':

		if(isset($_POST['idUser']))
		{
			$idUser = $_POST['idUser'];
			$request = "DELETE FROM clients WHERE id = ".$idUser;

			if($query = mysqli_query($link, $request)) header('Location: listeUtilisateur.php?success=1');
			else header('Location: listeUtilisateur.php?error=1');
		}
		else header('Location: listeUtilisateur.php?error=2');
		break;

	case 'modifUser':

		if(isset($_POST['idUser']) || isset($_POST['nom']) || isset($_POST['prenom'])|| isset($_POST['adresse'])
			|| isset($_POST['tel']) || isset($_POST['mail']) || isset($_POST['type']) || isset($_POST['newMdp']))
		{

			$nom = $_POST['nom'];
			$prenom = $_POST['prenom'];
			$adresse = $_POST['adresse'];
			$telephone = $_POST['tel'];
			$mail = $_POST['mail'];
			$type = $_POST['type'];
			$motDePasse = $_POST['newMdp'];
			$idUser = $_POST['idUser'];
			$type = $_POST['type'];

			if ($type != "")
				$query = "UPDATE clients
							SET nom='$nom',
								prenom='$prenom',
								adresse='$adresse',
								telephone='$telephone',
								mail='$mail',
								type='$type'
							WHERE id=".$idUser;
			else
				$query = "UPDATE clients
							SET nom='$nom',
								prenom='$prenom',
								adresse='$adresse',
								telephone='$telephone',
								mail='$mail',
								motDePasse='$motDePasse'
							WHERE id=".$idUser;

			if (!mysqli_query($link, $query)) header('Location: listeUtilisateur.php?error=1');
			else header('Location: listeUtilisateur.php?success=1');
		}
		break;

	case 'AjoutAdresseLivraison':

		if (isset($_POST['nom']) || isset($_POST['prenom']) || isset($_POST['adresse']) || isset($_POST['codePostal']) || isset($_POST['ville']) || isset($_POST['pays']) || isset($_POST['telephone']) || isset($_POST['clientId']) ) {
			$nom = $_POST['nom'];
			$prenom = $_POST['prenom'];
			$adresse = $_POST['adresse'];
			$codePostal = $_POST['codePostal'];
			$ville = $_POST['ville'];
			$pays = $_POST['pays'];
			$telephone = $_POST['telephone'];
			$clientId = $_POST['clientId'];

			$query = "INSERT INTO adresseLivraison (
					  	nom, prenom, idClient, adresse, codePostal, ville, pays, telephone
					  ) VALUES (
					  	'$nom', '$prenom', $clientId,'$adresse', '$codePostal', '$ville', '$pays','$telephone'
					  )";

			if (!$request = mysqli_query($link, $query)) {
				header('Location: payer.php?error=1');
			} else {
				header('Location: payer.php?success=1');
			}
		}

		break;


	case 'AjoutCarteBleue' :

		if (isset($_POST['titulaire']) || isset($_POST['numeroCarte']) || isset($_POST['dateExpiration']) || isset($_POST['cryptogramme']) || isset($_POST['clientId']) || isset($_POST['type'])) {
			$titulaire = $_POST['titulaireCarte'];
			$numeroCarte = $_POST['numeroCarte'];
			$dateExpiration = $_POST['dateExpiration'];
			$cryptogramme = $_POST['cryptogramme'];
			$clientId = $_POST['clientId'];
			$typeCarte = $_POST['type'];


			$request = "SELECT * FROM carteBleue WHERE numeroCarte='".$numeroCarte."' ";

			if (!$query = mysqli_query($link, $request)) {
				die('OK');
				header('Location: payer.php?error=1');
			} else {
				$count = mysqli_num_rows($query);
				if ($count < 0) {
					header('Location: payer.php?error=2');
				} else {
					$request = "INSERT INTO carteBleue (
									titulaireCarte, numeroCarte, dateExpiration, cryptogramme, idClient, typeCarte
								) VALUES (
									'$titulaire', '$numeroCarte', '$dateExpiration', '$cryptogramme', $clientId, $typeCarte
								)";

					if(!$query = mysqli_query($link, $request)) {
						header('Location: payer.php?error=2');
					} else {
						header('Location: payer.php?success=2');
					}
				}
			}
		}


		break;

	
	case 'inscriptionUtilisateur' :
		
		if (isset($_POST['nom']) && $_POST['nom'] != "") $nom = traiteTexte($_POST['nom']);
		else $nom = "";
		
		if (isset($_POST['prenom']) && $_POST['prenom'] != "") $prenom = traiteTexte($_POST['prenom']);
		else $prenom = "";
		
		if (isset($_POST['mail']) && $_POST['mail'] != "") $mail = traiteTexte($_POST['mail']);
		else $mail = "";
		
		if (isset($_POST['motDePasse']) && $_POST['motDePasse'] != "") $motDePasse = traiteTexte($_POST['motDePasse']);
		else $motDePasse = "";
		
		if (isset($_POST['adresse']) && $_POST['adresse'] != "") $adresse = traiteTexte($_POST['adresse']);
		else $adresse = "";
		
		if (isset($_POST['telephone']) && $_POST['telephone'] != "") $telephone = traiteTexte($_POST['telephone']);
		else $telephone = "";
		
		if (isset($_POST['dateNaissance']) && $_POST['dateNaissance'] != "") $dateNaissance = traiteTexte($_POST['dateNaissance']);
		else $dateNaissance = "";
		
		$query = "SELECT COUNT(*) as count FROM clients WHERE mail LIKE '$mail'";
		 $result = mysqli_query($link, $query);
		 if (!$result) die(404);
		 $jeuDonnees = mysqli_fetch_assoc($result);
		 if ($jeuDonnees["count"] > 0) {
			 header('Location: pageErreur.php?erreur=1');
		 } else {
		 	$query = "INSERT INTO clients (nom, prenom, mail, motDePasse, adresse, telephone, dateNaissance, type)
		 	VALUES ('$nom', '$prenom', '$mail', '$motDePasse', '$adresse', '$telephone', '$dateNaissance', 1)";
		 	if (!mysqli_query($link, $query)) {
				echo "Erreur de requete";
			}
		 	else {
					header('Location: index.php?inscriptionReussi=1');
			}
		 	
		 }
		
		
		break;
		
	case 'connexionUtilisateur' :
		
		if (isset($_POST['mail']) && $_POST['mail'] != "") $mail = traiteTexte($_POST['mail']);
		else $mail = "";
		
		if (isset($_POST['motDePasse']) && $_POST['motDePasse'] != "") $motDePasse = traiteTexte($_POST['motDePasse']);
		else $motDePasse = "";
		
		$query = "SELECT * FROM clients WHERE mail='$mail' AND motDePasse='$motDePasse' AND type<>2";
		$result = mysqli_query($link, $query);
		if (!$result) die(404);
		$jeuDonnees = mysqli_fetch_assoc($result);
		if (mysqli_num_rows($result) == 1) {
			$typeUtilisateur = $jeuDonnees["type"];
			if ($typeUtilisateur == 0) {
				session_start();
				$_SESSION['adminId'] = $jeuDonnees["id"];
				header('Location: statistique.php');
			} elseif ($typeUtilisateur == 1) {
				session_start();
				$_SESSION['fournisseurId'] = $jeuDonnees["id"];
				header('Location: listeProduitFournisseur.php');
			} 
		} else header('Location: login.php?connexionEchoue=1');
		
		
		
		break;
		
	case 'motDePasseOubliee':
		
		if (isset($_POST['mailOubliee']) && $_POST['mailOubliee'] != "") $mailOubliee = traiteTexte($_POST['mailOubliee']);
		else $mailOubliee = ""; 
		
		$query = "SELECT * FROM clients WHERE mail='$mailOubliee'";
		$result = mysqli_query($link, $query);
		if (!$result) die(404);
		$jeuDonnees = mysqli_fetch_assoc($result);
		if (mysqli_num_rows($result) == 1) {
			$id = $jeuDonnees["id"];
			$message = "<p>Voici un lien de réinitialisation pour pouvoir changer votre mot de passe oubliée</p>
					<p>>>>Cliquez <a href='http://localhost:8888/codecamp-ecommerce/reinitialisationMotDePasse.php?cle=azertyuiop&id=$id'>ici</a><<<</p>";
			mailHTML(array('to_name'=>'Cher utilisateur',
					 'to_email'=>"kridag_f@etna-alternance.net",
					 'from_name'=>'La Galerie des Artisans',
					 'from_email'=>'kridag_f@etna-alternance.net',
					 'subject'=>'Reinitialisation de mot de passe La Galerie des Artisans',
					 'message'=>$message));
			header('Location: login.php?connexionEchoue=3');
			
			
		} else header('Location: login.php?connexionEchoue=2');
		
		break;
		
		case 'motDePasseOublieeClient':
		
			if (isset($_POST['mailOubliee']) && $_POST['mailOubliee'] != "") $mailOubliee = traiteTexte($_POST['mailOubliee']);
			else $mailOubliee = "";
		
			$query = "SELECT * FROM clients WHERE mail='$mailOubliee'";
			$result = mysqli_query($link, $query);
			if (!$result) die(404);
			$jeuDonnees = mysqli_fetch_assoc($result);
			if (mysqli_num_rows($result) == 1) {
				$id = $jeuDonnees["id"];
				$message = "<p>Voici un lien de réinitialisation pour pouvoir changer votre mot de passe oubliée</p>
				<p>>>>Cliquez <a href='http://localhost:8888/codecamp-ecommerce/reinitialisationMotDePasse.php?cle=azertyuiop&id=$id'>ici</a><<<</p>";
				mailHTML(array('to_name'=>'Cher utilisateur',
						'to_email'=>"kridag_f@etna-alternance.net",
						'from_name'=>'La Galerie des Artisans',
						'from_email'=>'kridag_f@etna-alternance.net',
						'subject'=>'Reinitialisation de mot de passe La Galerie des Artisans',
						'message'=>$message));
				header('Location: loginClient.php?erreur=2');
					
					
			} else header('Location: loginClient.php?erreur=3');
		
			break;
		
	case 'reinitialisationMotDePasse':
		
		if (isset($_POST['nouveauMotDePasse']) && $_POST['nouveauMotDePasse'] != "") $nouveauMotDePasse = traiteTexte($_POST['nouveauMotDePasse']);
		else $nouveauMotDePasse = "";
		
		if (isset($_POST['id']) && $_POST['id'] != 0) $id = $_POST['id'];
		else $id = "";
		
		session_start();
		
		$query = "UPDATE clients SET 
		motDePasse='$nouveauMotDePasse'
		WHERE id=$id";
		
		if (!mysqli_query($link, $query)) header("Location: reinitialisationMotDePasse.php?cle=azertyuiop&id=$id&erreur=1");
		else {
			if (!isset($_SESSION["clientId"])) header('Location: login.php?reinitialisation=1');
			else header('Location: loginClient.php?reinitialisation=1');
		}
		
		
		break;
		
	
		case 'inscriptionClient' :

			session_start();

			if (isset($_POST['nom']) && $_POST['nom'] != "") $nom = traiteTexte($_POST['nom']);
			else $nom = "";
		
			if (isset($_POST['prenom']) && $_POST['prenom'] != "") $prenom = traiteTexte($_POST['prenom']);
			else $prenom = "";
		
			if (isset($_POST['mail']) && $_POST['mail'] != "") $mail = traiteTexte($_POST['mail']);
			else $mail = "";
		
			if (isset($_POST['motDePasse']) && $_POST['motDePasse'] != "") $motDePasse = traiteTexte($_POST['motDePasse']);
			else $motDePasse = "";
		
			if (isset($_POST['adresse']) && $_POST['adresse'] != "") $adresse = traiteTexte($_POST['adresse']);
			else $adresse = "";
		
			if (isset($_POST['telephone']) && $_POST['telephone'] != "") $telephone = traiteTexte($_POST['telephone']);
			else $telephone = "";
		
			if (isset($_POST['dateNaissance']) && $_POST['dateNaissance'] != "") $dateNaissance = traiteTexte($_POST['dateNaissance']);
			else $dateNaissance = "";
		
			$query = "SELECT COUNT(*) as count FROM clients WHERE mail LIKE '$mail'";
			$result = mysqli_query($link, $query);
			if (!$result) die(404);
			$jeuDonnees = mysqli_fetch_assoc($result);
			if ($jeuDonnees["count"] > 0) {
				header('Location: pageErreur.php?erreur=1');
			} else {
				$query = "INSERT INTO clients (nom, prenom, mail, motDePasse, adresse, telephone, dateNaissance, type)
				VALUES ('$nom', '$prenom', '$mail', '$motDePasse', '$adresse', '$telephone', '$dateNaissance', 2)";
				if (!mysqli_query($link, $query)) echo "Erreur de requete";
				else {
					$nouvelleId = mysqli_insert_id($link);
					$query = "UPDATE commandes SET
							idClient=$nouvelleId
							WHERE idClient=".$_SESSION["clientId"];
					
					if (!mysqli_query($link, $query)) echo "Erreur de requete";
					else {
						
						session_start();
						session_destroy();
						session_unset();
						session_start();
						$_SESSION["clientId"] = $nouvelleId;

						$requet2 = "SELECT COUNT(*) count FROM commandes WHERE payer=1 AND idClient=".$_SESSION['clientId'];

						if (!$query2 = mysqli_query($link, $requet2)) {
							header('Location: index.php');
						} else {
							$row = mysqli_fetch_row($query2);
							$count = $row[0];
							if($count > 0) {
								header('Location: payer.php?inscriptionReussie=1');
							} else {
								header('Location: commandes.php');
							}
						}
					}
					mailHTML(array('to_email'=>'kridag_f@etna-alternance.net', 'from_email'=>'kridag_f@etna-alternance.net', 'subject'=>'Bienvenue cher client', 'message'=>"<h2>Bonjour cher $nom $prenom</h2><p>La Galerie des Artisans a le plasir de vous avoir, profitez de nos articles à petit prix</p><br>"));
				}
		
			}
		
		
			break;
			
			case 'connexionClient' :
			
				if (isset($_POST['mail']) && $_POST['mail'] != "") $mail = traiteTexte($_POST['mail']);
				else $mail = "";
			
				if (isset($_POST['motDePasse']) && $_POST['motDePasse'] != "") $motDePasse = traiteTexte($_POST['motDePasse']);
				else $motDePasse = "";
			
				$query = "SELECT * FROM clients WHERE mail='$mail' AND motDePasse='$motDePasse' AND type=2";
				$result = mysqli_query($link, $query);
				if (!$result) die(404);
				$jeuDonnees = mysqli_fetch_assoc($result);
				if (mysqli_num_rows($result) == 1) {
					$typeUtilisateur = $jeuDonnees["type"];
					if ($typeUtilisateur == 2) {
						session_start();
						$request = "UPDATE commandes SET idClient=".$jeuDonnees['id']." WHERE idClient=".$_SESSION['clientId'];
						if (!$query = mysqli_query($link, $request)) die("ERREUR DE REQUETE");
						else {
							session_start();
							session_destroy();
							session_unset();
							session_start();

							$_SESSION['clientId'] = $jeuDonnees['id'];

							$requet2 = "SELECT COUNT(*) count FROM commandes WHERE payer=1 AND idClient=".$_SESSION['clientId'];

							if (!$query2 = mysqli_query($link, $requet2)) {
								header('Location: index.php');
							} else {
								$row = mysqli_fetch_row($query2);
								$count = $row[0];
								if($count > 0) {
									header('Location: payer.php');
								} else {
									header('Location: commandes.php');
								}
							}
						}
			
					}
						
				}
				else header('Location: loginClient.php?erreur=1');
			
			
			
				break;
		
} // FIN SWITCH
?>