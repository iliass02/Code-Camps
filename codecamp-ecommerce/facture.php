<?php

include('_init.php');

	
	ob_start();
	
	session_start();
	
	
		
?>
		
	<style>
		table.table { width:100%; margin:auto; line-height: 6mm; border-collapse:collapse; }
		
		table.footer { line-height: 6mm; margin:auto; border-collapse:collapse;}
		table.footer td { border:1px solid #000; padding: 1mm 1mm; font-weight: normal;}
		table.footer th { border:1px solid #000;}
		
		table.border tr { border:none }
		table.border td { border-bottom:1px solid #CFD1D2; border-top:1px solid #CFD1D2; padding: 1mm 1mm; }
		table.border th.head, td.black { background-color: #68DFF0; color: #000; font-weight: normal; padding: 2mm 1mm; }
		
		td.noBorder { border:none }
		
		em { font-size: 9px; color:grey; }
		i { font-size: 10px; }
		small { text-align: center; font-size: 11px; color: black;}
		strong { margin-left: 250px; margin-top: 30x; font-size: 15px; }
		
	</style>
		
	<page backtop="10mm" backleft="5mm" backright="5mm" backbottom="45mm" style="font-size: 15px">
		
		<page_footer>
			<div style="text-align: right; line-height: 3mm; width: 98%; ">
				<i>Exoneration de la TVA, article 262 ter-1 du CGI</i><br>
				<i>Nos référence bancaires</i>
			</div><br>
			<table style="text-align: right;  margin-left: 210px; width: 40%" class="footer">
				<thead>
					<tr>
						<th style="width: 70%; text-align: center">IBAN</th>
						<th style="width: 30%; text-align: center">BIC</th>
					</tr>
				</thead>
				
				<tbody>
					<tr>
						<td style="text-align: center; font-size: 12px">FR452004100001123344442E02343</td>
						<td style="text-align: center; font-size: 12px">PSTRFRPPPAR</td>
					</tr>
				</tbody>
			
			</table><br>
			<div style="text-align: right">
				Page [[page_cu]]/[[page_nb]]
			</div>
			
		</page_footer>
		
		<img style="width: 65mm" src="assets/img/logo2.png"><strong>Facture n°L<?php echo date('Ym');?></strong><br>
			
		<table style="vertical-align: top;" class="table">
			<tr>
				<td style="width: 75%; line-height: 5mm">
					Téléphone : <?php echo "030303003030"; ?><br>
					Fax : <?php echo "dezdzdzr"; ?><br>
					E-mail : <?php echo "dezre"; ?><br>
					Site Web : <?php echo "ezdzarf"; ?>
				</td>
					
<?php 
				$query = "SELECT A.nom, A.prenom, A.adresse, A.codePostal, A.ville, C.mail FROM adresseLivraison A
					INNER JOIN clients C ON C.id=A.idClient
					WHERE A.idClient=".$_SESSION["clientId"];
				$result = mysqli_query($link, $query);
				if (!$result) include(CHEMIN_SCRIPT.'messageErreur.php');
				if (mysqli_num_rows($result) > 0) $jeuDonneesClient = mysqli_fetch_assoc($result);
?>				
				<td style="width : 25%; font-size: 14px;">
					<?php echo strtoupper($jeuDonneesClient["nom"])." ".$jeuDonneesClient["prenom"]; ?><br>
					<?php echo $jeuDonneesClient["adresse"]; ?><br>
					<?php echo $jeuDonneesClient["codePostal"], ' ', strtoupper($jeuDonneesClient["ville"]);?>
				</td>
			</tr>
		</table><br><br><br><br>
		<i>Référence : Facture La Galerie des Artisans <?php echo date('m/Y');?></i><br>
		
<?php 
		
		$query = "SELECT C.idProduit, P.idClient as idFournisseurs, P.nomProduit, P.description, P.prix, P.categorie, C.date FROM commandes C
		INNER JOIN produits P ON P.id=C.idProduit
		WHERE payer=1 AND C.idClient=".$_SESSION["clientId"];
		$result = mysqli_query($link, $query);
		if (!$result) die(404);
		$nbLignes = mysqli_num_rows($result);
		$i = 1;
		$idProduits = "";
		$idFournisseurs = "";
		?>
		
		
		<table class="border table">
				<thead>
					
						<tr>
							<th class="head" style="width: 10%">N°</th>
							<th class="head" style="width: 25%">Nom du produit</th>
							<th class="head" style="width: 25%">Description</th>
							<th class="head" style="width: 10%">Categorie</th>
							<th class="head" style="width: 20%">Date</th>
							<th class="head" style="width: 10%">Cout</th>
											
						</tr>
				</thead>
					
					<?php 
		while ($row = mysqli_fetch_assoc($result)) :
				


				settype($row["idProduit"], 'string');
				
				settype($row["idFournisseurs"], 'string');
				
				$montant = $row["prix"];
				if ($nbLignes == $i) {
					$idProduits .= $row["idProduit"];
					$idFournisseurs .= $row["idFournisseurs"];
				}
				else  {
					$idProduits .= $row["idProduit"].",";
					$idFournisseurs .= $row["idFournisseurs"].",";
				}
			
				$i++;
				$montant = $row["prix"];
				
					
				$cumulTotal += $montant; ?>
				
				<tr style="background-color: #FFD777">
				<td><?php echo $row["idProduit"]; ?></td>
				<td><?php echo $row["nomProduit"]; ?></td>
				<td><?php echo $row["description"]; ?></td>
				<td><?php echo $row["categorie"]; ?></td>
				<td><?php echo $row["date"]; ?></td>
				<td style="text-align: right;"><?php echo $montant; ?> €</td></tr>			
				
			
			<?php endwhile;?>
	
	
			<tr>
				<td colspan="4" class="noBorder" style="padding: 1mm"></td>
				<td class="black" style="font-size: 16px; font-weight: bold; padding: 1mm">Net à payer (TTC) : </td>
				<td style="text-align: right; font-size: 16px"><b><?php echo $cumulTotal; ?> €</b></td>
			</tr>	
			
	</table>
			
	
					
		</page>
		
<?php 
		
	$content_html = ob_get_clean();
	
	
	require('html2pdf/html2pdf.class.php');
	
	try {
		$pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8');
		$pdf->pdf->SetDisplayMode('fullpage');
		$pdf->SetDefaultFont('helvetica');
		$pdf->writeHTML($content_html);
		
		$clientId = $_SESSION["clientId"];
		
		$query = "INSERT INTO factures (idClient, idFournisseurs, admin) VALUES ($clientId, '$idFournisseurs', 0)";
		if (!mysqli_query($link, $query)) echo "Erreur de requete";
		else {
			$factureId = mysqli_insert_id($link);
			$date = date("Y-m");
			$cheminFacture = "factures/$date/facture10$factureId.pdf";
			$query = "UPDATE factures SET cheminFacture='$cheminFacture' WHERE id=$factureId";
			if (!mysqli_query($link, $query)) die(404);
			else {
				if (file_exists("factures/$date")) $pdf->Output($cheminFacture, "F");
				else {
					mkdir("factures/$date");
					$pdf->Output($cheminFacture, "F");
				}	
			$query = "UPDATE commandes SET payer=2 WHERE idProduit IN ($idProduits)";
			if (!mysqli_query($link, $query)) die(404);
			newMailHTML("kridag_f@etna-alternance.net", "kridag_f@etna-alternance.net", "Confirmation de votre commande", "<h2>Bonjour cher client</h2><br><p>La Galerie des Artisans vous remercie pour cette achat</p><br><i>PS : Votre facture est en piece jointe</i>", "$cheminFacture");
			newMailHTML("kridag_f@etna-alternance.net", "kridag_f@etna-alternance.net", "Confirmation de votre commande", "<h2>Bonjour cher admin</h2><p>Le client ".$jeuDonneesClient["nom"]." ".$jeuDonneesClient["prenom"]." a eu confirmation de sa commande</p><br><i>PS : La facture est en piece jointe</i>", "$cheminFacture");
			mailHTML(array('to_email'=>'kridag_f@etna-alternance.net', 'from_email'=>'kridag_f@etna-alternance.net', 'subject'=>'Confirmation de votre commande', 'message'=>"<h2>Bonjour cher fournisseur</h2><p>Verifiez votre liste des commandes un de vos produits a été commandé ;)</p><br>"));
			header('Location: index.php?facture=1');
			}
		}
		
	} catch (HTML2PDF_exception $e) {
		die($e);
	}

//}
?>

