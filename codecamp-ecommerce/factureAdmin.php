<?php

include('_init.php');

	
	ob_start();
	
	session_start();
	
	if (isset($_GET["id"])) $idClient = $_GET["id"];
	if (isset($_GET["idF"])) $idFournisseur = $_GET["idF"];
	
	$query = "SELECT nom, prenom FROM clients WHERE id=$idFournisseur";
	$result = mysqli_query($link, $query);
	if (!$result) include(CHEMIN_SCRIPT.'messageErreur.php');
	if (mysqli_num_rows($result) > 0) $jeuDonneesFournisseur = mysqli_fetch_assoc($result);
	$nomFournisseur = $jeuDonneesFournisseur["nom"];
	$prenomFournisseur = $jeuDonneesFournisseur["prenom"];
	
	
		
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
				$query = "SELECT nom, prenom, adresse, codePostal, ville FROM adresseLivraison WHERE idClient=$idClient";
				$result = mysqli_query($link, $query);
				if (!$result) include(CHEMIN_SCRIPT.'messageErreur.php');
				if (mysqli_num_rows($result) > 0) $jeuDonneesClient = mysqli_fetch_assoc($result);
				$nomClient = $jeuDonneesClient["nom"];
?>				
				<td style="width : 25%; font-size: 14px;">
					<?php echo strtoupper($nomClient)." ".$jeuDonneesClient["prenom"]; ?><br>
					<?php echo $jeuDonneesClient["adresse"]; ?><br>
					<?php echo $jeuDonneesClient["codePostal"].' '.$jeuDonneesClient["ville"];?><br><br>
					<?php echo "Vendu par : <br>$nomFournisseur $prenomFournisseur"; ?>
				</td>
			</tr>
		</table><br><br>
		<i>Référence : Facture La Galerie des Artisans <?php echo date('m/Y');?></i><br>
		
<?php 
		
		$query = "SELECT C.idProduit, P.idClient as idFournisseur, P.nomProduit, P.description, P.prix, P.categorie, C.date FROM commandes C
		INNER JOIN produits P ON P.id=C.idProduit
		WHERE P.idClient=$idFournisseur";
		$result = mysqli_query($link, $query);
		if (!$result) die(404);
		
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
				
				$montant = $row["prix"];
				
	
				
				$cumulTotal += $montant;
				?>
				
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
				<td class="black" style="font-size: 16px; font-weight: bold; padding: 1mm">Total panier : </td>
				<td style="text-align: right; font-size: 16px"><b><?php echo $cumulTotal; ?> €</b></td>
			</tr>
	
			<tr>
				<td colspan="4" class="noBorder" style="padding: 1mm"></td>
				<td class="black" style="font-size: 16px; font-weight: bold; padding: 1mm">Net à payer (TTC) : </td>
				<td style="text-align: right; font-size: 16px"><b><?php echo pourcentage($cumulTotal); ?> €</b></td>
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
		$pdf->Output("facture$nomClient.pdf");

		
		
	} catch (HTML2PDF_exception $e) {
		die($e);
	}

//}
?>

