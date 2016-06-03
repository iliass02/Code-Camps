<?php
session_start();
require("_init.php");

if(!isset($_SESSION['clientId'])) header('Location: index.php');
$clientId = $_SESSION['clientId'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>La Galerie des Artisans - Payer</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/sweetalert.css"/>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
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

        <div class="nav notify-row" id="top_menu">
            <!--  notification start -->
            <ul class="nav top-menu">
                <!-- inbox dropdown start-->
                <li id="header_inbox_bar" class="dropdown">
                    <a href="panier.php">
                        <i class="fa fa-shopping-cart"></i>
                        <?php
                        if (isset($_SESSION['clientId'])) {
                            $request = "SELECT * FROM commandes WHERE payer=0 AND idClient=".$_SESSION['clientId'];
                            if (!$query = mysqli_query($link, $request)){
                                header('Location: index.php');
                            }
                            $count = mysqli_num_rows($query);
                            if ($count == 0) {
                                header('Location: index.php');
                            }

                            echo '<span class="badge bg-theme">'.$count.'</span>';
                        }
                        ?>
                    </a>

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
                <li><a class="logout" href="logout.php">Espace Admin</a></li>
            </ul>
        </div>
    </header>
    <!--header end-->
    <?php require('sidebar.php'); ?>
    <!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content" style="min-height: 630px;">
        <section class="wrapper">
            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <table class="table table-striped table-advance table-hover">
                            <h4><i class="fa fa-angle-right"></i> Mes adresses de livraison
                                <button style="float: right; margin: 0 7px;" class="btn btn-info btn-xs" data-toggle='modal' data-target='#myModal' >Ajouter une adresse de livraisaon</button></h4>
                            <hr>
                            <thead>
                            <tr>
                                <th></th>
                                <th>Nom et Prenom</th>
                                <th>Adresse</th>
                                <th>Code Postal</th>
                                <th>Ville</th>
                                <th>Pays</th>
                                <th>Téléphone</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <?php

                                $request = "SELECT
                                                *
                                            FROM
                                                adresseLivraison
                                            WHERE
                                                idClient= ".$_SESSION['clientId'];

                                if (!$query = mysqli_query($link, $request)){
                                    echo "Erreur";
                                } else {
                                    $count = mysqli_num_rows($query);
                                    if ($count > 0) {
                                        while ($row = mysqli_fetch_assoc($query)) {
                                            echo '<tr>
                                                <td><input type="radio" name="adresseLivraison" class="adresseLivraison" value="'.$row['id'].'"></td>
                                                <td>'.$row['nom'].'</td>
                                                <td>'.$row['adresse'].'</td>
                                                <td>'.$row['codePostal'].'</td>
                                                <td>'.$row['ville'].'</td>
                                                <td>'.$row['pays'].'</td>
                                                <td>'.$row['telephone'].'</td>
                                                </tr>';
                                        }

                                    } else {
                                        echo "Aucune adresse trouvé";
                                    }
                                }



                                ?>
                            </tr>
                            </tbody>
                        </table>



                        <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Ajouter une adresse de Livraison</h4>
                                    </div>
                                    <div class="modal-body">

                                        <form role="form" method="post" action="_traitement.php" id="formModifProduit">
                                            <div class="form-group">
                                                <label>Nom *</label>
                                                <input id="nom" type="text" class="form-control" name="nom">
                                            </div>
                                            <div class="form-group">
                                                <label>Prenom *</label>
                                                <input id="prenom" type="text" class="form-control" name="prenom">
                                            </div>
                                            <div class="form-group">
                                                <label>Adresse *</label>
                                                <input id="adresse" type="text" class="form-control" name="adresse">
                                            </div>
                                            <div class="form-group">
                                                <label>Code Postal *</label>
                                                <input id="codePostal" type="text" class="form-control" name="codePostal">
                                            </div>
                                            <div class="form-group">
                                                <label>Ville *</label>
                                                <input id="ville" type="text" class="form-control" name="ville">
                                            </div>
                                            <div class="form-group">
                                                <label>Pays *</label>
                                                <input id="pays" type="text" class="form-control" name="pays">
                                            </div>
                                            <div class="form-group">
                                                <label>Téléphone *</label>
                                                <input id="telephone" type="text" class="form-control" name="telephone">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                                <input type="hidden" name="typeTraitement" value="AjoutAdresseLivraison">
                                                <input type="hidden" name="clientId" id="clientId" value="<?php echo $_SESSION['clientId']; ?>">
                                                <button type="submit" id="submitAjoutAdresseLivraison" class="btn btn-theme">Ajouter</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div><!--/ row -->






            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <table class="table table-striped table-advance table-hover">
                            <h4><i class="fa fa-angle-right"></i> Mes Cartes bancaires
                                <button style="float: right; margin: 0 7px;" class="btn btn-info btn-xs" data-toggle='modal' data-target='#myModal1'>Ajouter une carte bancaire</button>
                            </h4>
                            <hr>
                            <thead>
                            <tr>
                                <th></th>
                                <th>Type de la carte</th>
                                <th>Nom et prenom du titulaire</th>
                                <th>Numéro de la carte</th>
                                <th>date d'expiration</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <?php

                                $request = "SELECT
                                                *
                                            FROM
                                                carteBleue
                                            WHERE
                                                idClient= ".$_SESSION['clientId'];

                                if (!$query = mysqli_query($link, $request)){
                                    echo "Erreur";
                                } else {
                                    $count = mysqli_num_rows($query);
                                    if ($count > 0) {
                                        while ($row = mysqli_fetch_assoc($query)) {
                                            if ($row['typeCarte'] == 1) {
                                                $type = "MasterCard";
                                            } elseif ($row['typeCarte'] == 2) {
                                                $type = "VISA";
                                            } elseif ($row['typeCarte'] == 3) {
                                                $type = "Maestro";
                                            }
                                            echo '<tr>
                                                <td><input type="radio" name="carteBancaire" class="carteBancaire"></td>
                                                <td>'.$type.'</td>
                                                <td>'.$row['titulaireCarte'].'</td>
                                                <td>'.$row['numeroCarte'].'</td>
                                                <td>'.$row['dateExpiration'].'</td>
                                                </tr>';
                                        }

                                    } else {
                                        echo "Aucune Carte bancaire trouvé";
                                    }
                                }



                                ?>
                            </tr>
                            </tbody>
                        </table>



                        <!-- Modal -->
                        <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Ajouter une adresse de Livraison</h4>
                                    </div>
                                    <div class="modal-body">

                                        <form role="form" method="post" action="_traitement.php" id="formAjoutCarteBleue">
                                            <div class="form-group">
                                                <label>Type Carte</label>
                                                <div class="radio">
                                                    <label><input type="radio" id="type1" name="type" value="1">MasterCard</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" id="type2" name="type" value="2">VISA</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" id="type3" name="type" value="3">Maestro</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Nom et Prenom du titulaire *</label>
                                                <input id="titulaireCarte" type="text" class="form-control" name="titulaireCarte">
                                            </div>
                                            <div class="form-group">
                                                <label>Numéro de la carte *</label>
                                                <input id="numeroCarte" type="text" class="form-control" name="numeroCarte">
                                            </div>
                                            <div class="form-group">
                                                <label>Date d'expiration *</label>
                                                <input id="dateExpiration" type="text" class="form-control" name="dateExpiration">
                                            </div>
                                            <div class="form-group">
                                                <label>Cryptogramme *</label>
                                                <input id="cryptogramme" type="text" class="form-control" name="cryptogramme">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                                <input type="hidden" name="typeTraitement" value="AjoutCarteBleue">
                                                <input type="hidden" name="clientId" id="clientId" value="<?php echo $_SESSION['clientId']; ?>">
                                                <button type="submit" id="submitAjoutCarteBleue" class="btn btn-theme">Ajouter</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div><!--/ row -->

            <!-- achat -->
            <form action="_traitement.php" method="post" id="SubmitClientAPaye">
                <input type="hidden" name="adresseLivraisonId" id="adresseLivraisonId">
                <input type="hidden" name="typeTraitement" value="ClientAPaye">
                <input type="hidden" name="clientId" value="<?php echo $clientId; ?>"><br>
                <center><button class="btn btn-success btn-lg" type="submit" id="SubmitClientAPaye">Payer !</button></center>
            </form>




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
</section>

<!-- js placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/jjquery-1.8.3.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>
<script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="assets/js/sweetalert.min.js"></script>

<!--common script for all pages-->
<script src="assets/js/common-scripts.js"></script>

<!--script for this page-->
<script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
<script type="text/javascript" src="assets/js/gritter-conf.js"></script>

<script>
    //custom select box

    <?php if (isset($_GET['success']) && $_GET['success'] == '1') { ?>
        swal("Adrese de livraison", "L'adresse de livraison a bien été ajouté", "succes");
    <?php } elseif (isset($_GET['error']) && $_GET['error'] == '1') { ?>
        swal("Adrese de livraison", "Erreur lors de l'ajout de l'adresse de livraison, veuillez réessayer plus tard", "error");
    <?php } elseif (isset($_GET['error']) && $_GET['error'] == '2') { ?>
        swal("Carte Bancaire", "Erreur lors de l'ajout de la carte bancaire, veuillez réessayer plus tard", "error");
    <?php } elseif (isset($_GET['success']) && $_GET['success'] == "2" ) { ?>
        swal("Carte Bancaire", "La carte bancaire à bien été ajouté", "success");
    <?php } ?>


    <?php if (isset($_GET["inscriptionReussie"]) == 1) : ?>
	sweetAlert("Yesss !", "Bienvenue cher client", "success");
	<?php endif; ?>

    $(document).ready(function(){




        $('#SubmitClientAPaye').click(function(){

            if ($('.adresseLivraison').is(':checked') == true) {
                adresseLivraisonId = $('.adresseLivraison').val();
                $('#adresseLivraisonId').val(adresseLivraisonId);
            }

            if($('.carteBancaire').is(':checked') == false || $('.adresseLivraison').is(':checked') == false) {
                swal("Paiement", "Paiement impossible, veuillez chosir une adresse de livraison et une carte bancaire", "error");
            } else {
                swal({
                    title: "Paiement",
                    text: "Êtes vous sûr de vouloir payer ?!",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "Non",
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Oui !",
                    closeOnConfirm: false
                }, function(){
                    $('#SubmitClientAPaye').submit()
                });
            }
            return false;
        });


        $("#submitAjoutAdresseLivraison").click(function() {

            var nom=$("#nom").val();
            var prenom=$("#prenom").val();
            var adresse=$("#adresse").val();
            var ville=$("#ville").val();
            var codePostal=$("#codePostal").val();
            var pays=$("#pays").val();
            var telephone=$("#telephone").val();

            if (nom == "" || prenom == "" || adresse == "" || codePostal == "" || ville == "" || pays == "" || telephone == "") {
                swal("Erreur", "Tous les champs sont requis", "error");
                return false;
            }

        });


        $('#submitAjoutCarteBleue').click(function() {
            var titulaireCarte = $('#titulaireCarte').val();
            var numeroCarte = $('#numeroCarte').val();
            var cryptogramme = $('#cryptogramme').val();
            var dateExpiration = $('#dateExpiration').val();
            if ($('#type1').is(':checked')) {
                var type = $('#type1').val();
            } else if ($('#type2').is(':checked')) {
                var type = $('#type2').val();
            } else if ($('#type3').is(':checked')) {
                var type = $('#type3').val();
            } else {
                var type = "";
            }

            if (titulaireCarte == "" || numeroCarte == "" || cryptogramme == "" || dateExpiration == "" || type == "") {
                swal("Erreur", "Tous les champs sont requis", "error");
                return false;
            }

        });

    });




</script>

</body>
</html>



