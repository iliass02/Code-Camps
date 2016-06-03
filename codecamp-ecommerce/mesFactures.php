<?php
include ("_init.php");

session_start();
	
if (!isset($_SESSION["adminId"]) && !isset($_SESSION["fournisseurId"])) header('Location: index.php');

	
	?>
	<!DOCTYPE html>
	<html lang="fr">
	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	    <title>La Galerie des Artisans - Liste produit fournisseur</title>
	
	    <!-- Bootstrap core CSS -->
	    <link href="assets/css/bootstrap.css" rel="stylesheet">
	    <!--external css-->
	    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
	
	    <!-- Custom styles for this template -->
	    <link href="assets/css/style.css" rel="stylesheet">
	    <link href="assets/css/style-responsive.css" rel="stylesheet">
	    <link rel="stylesheet" type="text/css" href="assets/css/sweetalert.css"/>
	
	    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	    <![endif]-->
	</head>
	
	<body>
	
	<section id="container" >
	    <!-- **********************************************************************************************************************************************************
	    TOP BAR CONTENT & NOTIFICATIONS
	    *********************************************************************************************************************************************************** -->
	    <!--header start-->
	    <header class="header black-bg">
	        <div class="sidebar-toggle-box">
	            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
	        </div>
	        <!--logo start-->
	        <a href="index.php" class="logo"><b>La Galerie des Artisans</b></a>
	        <!--logo end-->
	        
	         <script type="text/javascript">
			function lookup(champRecherche) {
				if(champRecherche.length == 0) {
					// Masquer la boit de suggestion
					$('#suggestions').hide();
				} else {
					$('#suggestions').show();
					
					$.post("ajax.php", {typeAjax:'autocompleteHaut', champRecherche: champRecherche}, function(data){
						if(data.length > 0) {
							$('#listeSuggestions').html(data);
							$("#attenteAjax").html('');
						} else {
							$('#suggestions').hide();
						}
					});
				}
			}
		</script>
        

        	<?php if (isset($_POST["champRechercheHaut"])) $champRechercheInput = stripslashes(traiteTexte($_POST["champRechercheHaut"]));
			else $champRechercheInput = '';
			?>
      
      
      
							
      
      <form class="navbar-form navbar-left" name="form-recherche-haut" id="form-recherche-haut" role="search" method="post" action="recherche.php">
							
							<div style="position:absolute;  margin-top:33px; margin-left: -70px; padding-bottom: 150px; background-color:rgba(255,255,255,0.9); border:1px solid #cbcbcb; display:none" class="col-xs-8 col-sm-5 col-md-3 col-lg-3 col-sm-offset-1 col-md-offset-2 col-md-offset-2" id="suggestions">
				<div style="height:15px" id="attenteAjax">
				</div>
				<div id="listeSuggestions">
					&nbsp;
				</div>
			</div>
				
						
							
							<div class="input-group">
					    		<input autocomplete="off" id="champRechercheHaut" name="champRechercheHaut" type="text" class="form-control" placeholder="Nom produit" value="<?php echo $champRechercheInput?>" onkeyup="lookup(this.value);">
					    		<span class="input-group-btn">
					  				<button type="submit button" class="btn btn-default"><span class="glyphicon glyphicon-search"></span>&nbsp;</button>
								</span>
							</div>
						</form>
						
	
	        <div class="top-menu">
	            <ul class="nav pull-right top-menu">
	                <li><a class="logout" href="logout.php">Deconnexion</a></li>
	            </ul>
	        </div>
	    </header>
	    <!--header end-->
	
	    <?php require('sidebar.php'); ?>
	
	    <!-- **********************************************************************************************************************************************************
	    MAIN CONTENT
	    *********************************************************************************************************************************************************** -->
	    <!--main content start-->
	    <section id="main-content">
	        <section class="wrapper">
	            <h3><i class="fa fa-angle-right"></i> Mes factures</h3>
	
	            <div class="row mt">
	                <div class="col-md-12">
	                    <div class="content-panel">
	                        <table class="table table-striped table-advance table-hover">
	                            <h4><i class="fa fa-angle-right"></i>Liste de mes factures</h4>
	                            <hr>
	                            <thead>
	                            <tr>
	                                <th>Nom</th>
	                                <th>Prénom</th>
	                                <th>Vendu par </th>
	                                <th>Téléchargement</th>
	                                
	                            </tr>
	                            </thead>
	                            <tbody>
	                          
	                               <?php 
	                               if (isset($_SESSION["fournisseurId"])) {
	                               		$fournisseurId = $_SESSION["fournisseurId"];
		                               	$query = "SELECT nom, prenom FROM clients WHERE id=$fournisseurId";
		                               	$result = mysqli_query($link, $query);
		                               	$jeuDonnees = mysqli_fetch_assoc($result);
		                               	$nomFournisseur = $jeuDonnees["nom"];
		                               	$prenomFournisseur = $jeuDonnees["prenom"];
		                               	
		                               	
		                               	$query = "SELECT F.idClient, C.nom, C.prenom FROM factures F
		                               	INNER JOIN clients C ON C.id=F.idClient
		                               	WHERE FIND_IN_SET($fournisseurId, F.idFournisseurs) AND F.admin=0";
		                               	$result = mysqli_query($link, $query);
		                               	if (!$result) echo "Erreur de requete";
		                               	while ($row = mysqli_fetch_assoc($result)) {
		                               		$nom = $row["nom"];
		                               		$prenom = $row["prenom"];
		                               		$idClient = $row["idClient"];
		                               		echo "<tr>";
		                               		echo "<td>$nom</td>";
		                               		echo "<td>$prenom</td>";
		                               		echo "<td>$nomFournisseur $prenomFournisseur</td>";
		                               		echo "<td><a href='factureAdmin.php?id=$idClient&idF=$fournisseurId'><p>Cliquez ici pour voir la facture</p></a>";
		                               		echo "</tr>";
		                               	}
	                               } if (isset($_SESSION["adminId"])) {
		                               	
		                               	$query = "SELECT idFournisseurs FROM factures F";
		                               	$result = mysqli_query($link, $query);
		                               	if (!$result) echo "Erreur de requete";
		                               	$jeuDonnees = mysqli_fetch_assoc($result);
		                               	$fournisseurIds = explode(",", $jeuDonnees["idFournisseurs"]);
		                               	$i = 0;
		                               	while (array_key_exists($i, $fournisseurIds)) {
		                               		
		                               		$fournisseurId = $fournisseurIds[$i];
		                               		$i++;
		                               		
		                               		$query = "SELECT nom, prenom FROM clients WHERE id=$fournisseurId";
		                               		$result = mysqli_query($link, $query);
		                               		$jeuDonnees2 = mysqli_fetch_assoc($result);
		                               		$nomFournisseur = $jeuDonnees2["nom"];
		                               		$prenomFournisseur = $jeuDonnees2["prenom"];
		                               		
		                               		$query2 = "SELECT F.idClient, C.nom, C.prenom FROM factures F
		                               		INNER JOIN clients C ON C.id=F.idClient
		                               		WHERE FIND_IN_SET($fournisseurId, F.idFournisseurs) AND F.admin=0";
		                               		$result2 = mysqli_query($link, $query2);
		                               		while ($row = mysqli_fetch_assoc($result2)) {
		                               			$nom = $row["nom"];
		                               			$prenom = $row["prenom"];
		                               			$idClient = $row["idClient"];
		                               			echo "<tr>";
		                               			echo "<td>$nom</td>";
		                               			echo "<td>$prenom</td>";
		                               			echo "<td>$nomFournisseur $prenomFournisseur</td>";
		                               			echo "<td><a href='factureAdmin.php?id=$idClient&idF=$fournisseurId'><p>Cliquez ici pour voir la facture</p></a>";
		                               			echo "</tr>";
		                               		}
		                               		
		                               	}
		                               	
	                               }
	                               
	                               ?>
	                      
	                            </tbody>
	                        </table>
	
	                       
	
	
	                    </div><!-- /content-panel -->
	                </div><!-- /col-md-12 -->
	            </div><!-- /row -->
	
	        </section><! --/wrapper -->
	    </section><!-- /MAIN CONTENT -->
	<footer class="site-footer" style="position: absolute; width: 100%; bottom: 0; z-index:-1">
        <div class="text-center">
            La Galerie des Artisans
            <a href="#" class="go-top">
                <i class="fa fa-angle-up"></i>
            </a>
        </div>
    </footer>
	    <!--main content end-->
	</section>
	
	<!-- js placed at the end of the document so the pages load faster -->
	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
	<script src="assets/js/jquery.scrollTo.min.js"></script>
	<script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
	<script src="assets/js/sweetalert.min.js"></script>
	
	
	<!--common script for all pages-->
	<script src="assets/js/common-scripts.js"></script>
	
	<!--script for this page-->
	
	<script>
	    //custom select box
	
	
	    $(document).ready(function() {
	
	
	        $(function(){
	            $('select.styled').customSelect();
	        });
	    });
	

	
	
	
	
	</script>
	
	</body>
	</html>
		

