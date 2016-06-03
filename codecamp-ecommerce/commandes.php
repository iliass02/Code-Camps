<?php
session_start();
require('_init.php');
//die(var_dump($_SESSION));

if(!isset($_SESSION['fournisseurId']) && !isset($_SESSION['clientId'])) {
 header('Location: index.php');
}

if (isset($_SESSION['fournisseurId'])) {
    $fournisseurId = $_SESSION['fournisseurId'];
} else if (isset($_SESSION['clientId'])) {
    $clientId = $_SESSION['clientId'];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>La Galerie des Artisans - Mes commandes</title>

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

        <div class="nav notify-row" id="top_menu">
            <!--  notification start -->
            <ul class="nav top-menu">
                <!-- inbox dropdown start-->
                <li id="header_inbox_bar" class="dropdown">

                    <?php if (isset($_SESSION['clientId'])) : ?>

                        <a href="panier.php">
                            <i class="fa fa-shopping-cart"></i>

                            <?php

                            $request = "SELECT * FROM commandes WHERE payer=0 AND idClient=".$_SESSION['clientId'];
                            if(!$query = mysqli_query($link, $request)){
                                header('Location: index.php');
                            }
                            $count = mysqli_num_rows($query);
                            echo '<span class="badge bg-theme">'.$count.'</span>';

                            ?>
                        </a>
                    <?php endif;?>
                </li>
                <!-- inbox dropdown end -->
            </ul>
            <!--  notification end -->
        </div>


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
                <?php
                if (isset($_SESSION["adminId"]) || isset($_SESSION["fournisseurId"])){
                    echo '<li><a class="logout" href="logout.php">Deconnexion</a></li>';
                } else echo '<li><a class="logout" href="logout.php">Espace Admin</a></li>';
                ?>
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
            <h3><i class="fa fa-angle-right"></i> Mes Commandes</h3>

            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <?php if (isset($_SESSION['fournisseurId'])) { ?>
                            <table class="table table-striped table-advance table-hover">
                                <h4><i class="fa fa-angle-right"></i>Liste de mes commmandes</h4>
                                <hr>
                                <thead>
                                <tr>
                                    <th>Nom et Prenom du client</th>
                                    <th>Adresse de livraison</th>
                                    <th>Nom du produit</th>
                                    <th>Status de la livraison</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <?php

                                    /*
                                     * CHANGER ID
                                     */
                                        $request = "SELECT cs.idProduit, cs.idClient, p.nomProduit, c.nom, c.prenom, al.adresse, al.codePostal, al.ville, al.pays, cs.payer
                                                    FROM commandes as cs, produits as p, clients as c, adresseLivraison as al
                                                    WHERE p.idClient = ".$fournisseurId."
                                                    AND cs.idProduit = p.id
                                                    AND cs.payer != 0
                                                    AND cs.payer != 1
                                                    AND cs.idClient = c.id
                                                    AND cs.idClient = al.idClient
                                                    ORDER BY cs.date DESC";


                                    $query = mysqli_query($link, $request);
                                    while($row = mysqli_fetch_assoc($query)) {
                                        $produitId = $row['idProduit'];
                                        $statut = $row['payer'];
                                        $clientId = $row['idClient'];
                                        echo '<tr>';
                                        echo '<td>'.$row['nom'].' '.$row['prenom'].'</td>';
                                        echo '<td>'.$row['adresse'].' '.$row['codePostal'].' '.$row['ville'].' '.$row['pays'].'</td>';
                                        echo '<td>'.$row['nomProduit'].'</td>';
                                        if($statut == 2) {
                                            echo '<td><span class="label label-warning">En cours de traitement</span></td>';
                                        } elseif ($statut == 3) {
                                            echo '<td><span class="label label-success">En cours de livraison</span></td>';
                                        }
                                        echo '<td><button class=\'btn btn-primary btn-xs\' data-toggle=\'modal\' data-target=\'#myModal\' onclick=\'editCommande('.$produitId.', '.$statut.', '.$clientId.')\'><i class=\'fa fa-pencil\'></i></button></td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                </tr>
                                </tbody>
                            </table>
                        <?php } else if (isset($_SESSION['clientId'])) { ?>

                            <table class="table table-striped table-advance table-hover">
                                <h4><i class="fa fa-angle-right"></i>Liste de mes commmandes</h4>
                                <hr>
                                <thead>
                                <tr>
                                    <th>Nom et Prenom du Fournisseur</th>
                                    <th>Nom du produit</th>
                                    <th>Status de la livraison</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <?php

                                    /*
                                     * CHANGER ID
                                     */
                                    $request = "SELECT cs.idProduit, cs.idClient, p.nomProduit, c.nom, c.prenom, c.adresse, cs.payer
                                                FROM commandes as cs, produits as p, clients as c
                                                WHERE c.id = ".$clientId."
                                                AND cs.idProduit = p.id
                                                AND cs.payer != 0
                                                AND cs.payer != 1
                                                AND cs.idClient = c.id
                                                ORDER BY cs.date DESC";


                                    $query = mysqli_query($link, $request);
                                    while($row = mysqli_fetch_assoc($query)) {
                                        $produitId = $row['idProduit'];
                                        $statut = $row['payer'];
                                        $clientId = $row['idClient'];
                                        echo '<tr>';
                                        echo '<td>'.$row['nom'].' '.$row['prenom'].'</td>';
                                        echo '<td>'.$row['nomProduit'].'</td>';
                                        if($statut == 2) {
                                            echo '<td><span class="label label-warning">En cours de traitement</span></td>';
                                        } elseif ($statut == 3) {
                                            echo '<td><span class="label label-success">En cours de livraison</span></td>';
                                        }
                                        echo '</tr>';
                                    }
                                    ?>
                                </tr>
                                </tbody>
                            </table>
                        <?php } ?>





                        <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Status du Produit</h4>
                                    </div>
                                    <div class="modal-body">

                                        <form role="form" method="post" action="_traitement.php" id="formtupdateStatutProduit">

                                            <div class="form-group">
                                                <label>Status *</label>
                                                <select id="statut" class="form-control" name="statut">
                                                    <option value="3">En cours de livraison</option>
                                                    <option value="2">En cours de traitement</option>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                                <input type="hidden" name="typeTraitement" value="updateStatutProduit">
                                                <input type="hidden" name="produitId" id="produitId">
                                                <input type="hidden" name="clientId" id="clientId">
                                                <button type="submit" id="submitupdateStatutProduit" class="btn btn-theme">Modifier le statut</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div><!-- /content-panel -->
                </div><!-- /col-md-12 -->
            </div><!-- /row -->

        </section>
    </section><!-- /MAIN CONTENT -->

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

    <?php
    if(isset($_GET['success'])) {
    if($_GET['success'] == '1') { ?>
    swal("Modification statut", "La modification du statut du produit a bien été prise en compte", "success");
    <?php }
    } if (isset($_GET['error'])) {
    if($_GET['error'] == '1') { ?>
    swal("Erreur", "Impossible de modifier le  statut du produit, réessayer plus tard", "error");
    <?php }
    }?>

    $(document).ready(function() {


        $(function(){
            $('select.styled').customSelect();
        });
    });

    function editCommande(produitId, statut, clientId){
        $('#produitId').val(produitId);
        $('#statut').val(statut);
        $('#clientId').val(clientId)
    }

    $('#submitupdateStatutProduit').click(function(){
        swal({
                title: "Fournisseur",
                text: "Modifier le statut de ce produit ?!",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "Fermer",
                confirmButtonColor: "#00cc00",
                confirmButtonText: "Oui !",
                closeOnConfirm: false },
            function(){
                $('#formtupdateStatutProduit').submit();
            }
        );
        return false;
    });




</script>

</body>
</html>
