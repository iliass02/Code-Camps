<?php

include("_init.php");
session_start();
if(!isset($_SESSION['clientId']) && !isset($_SESSION['fournisseurId']) && !isset($_SESSION['adminId'])) {
    $_SESSION['clientId'] = rand(500, 100000);
}
if (isset($_GET['inscriptionReussi'])) $inscriptionReussi = $_GET['inscriptionReussi'];
else $inscriptionReussi = 0;

if (isset($_GET['facture'])) $facture = $_GET['facture'];



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>La Galerie des Artisans - Store</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/js/fancybox/jquery.fancybox.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/sweetalert.css"/>

    <script src="assets/js/jquery.js"></script>


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<section id="container">
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
                   
                    <?php
                        if (isset($_SESSION['clientId'])) :
                       ?> 	
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
        <section class="wrapper site-min-height">
                    <?php if (isset($_GET['categorie'])){
                        if($_GET['categorie'] == "1"){
                            echo '<h3> Store <i class="fa fa-angle-right"></i> Maroquinerie</h3>';
                        } elseif ($_GET['categorie'] == 2 ) {
                            echo '<h3> Store <i class="fa fa-angle-right"></i> Cosmétique</h3>';
                        } elseif ($_GET['categorie'] == 3) {
                            echo '<h3> Store <i class="fa fa-angle-right"></i> Maison</h3>';
                        }
                    } else {
                        echo '<h3> Store <i class="fa fa-angle-right"></i> Nouveaux produits mis en ligne</h3>';
                    } ?>
                    <hr>
                    <div class="row mt">

                        <?php
                        if(!isset($_GET['categorie'])){
                            $request = "SELECT p.*, c.nom, c.prenom FROM produits as p, clients as c WHERE active = 1 AND c.id = p.idClient ORDER BY date ASC LIMIT 10";
                            $query = mysqli_query($link, $request);

                            if(mysqli_num_rows($query) == 0) {
                                echo '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 desc">';
                                echo '<h4> Aucun produit disponible sur le Store</h4>';
                                echo '</div>';
                            }

                            while($row = mysqli_fetch_assoc($query)) {
                                $nomProduit = $row['nomProduit'];
                                $id = $row['id'];
                                $prix = $row['prix'];
                                $image = $row['image'];
                                $nom = $row['nom'];
                                $prenom = $row['prenom'];
                                $categorie = $row['categorie']; ?>

                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 desc">
                                <div class="project-wrapper">
                                    <div class="project" style="    margin: 30px;">
                                        <div class="photo-wrapper">
                                            <div class="photo">
                                                <a href="ficheProduit.php?id=<?php echo $id; ?>&categorie=<?php echo $categorie;?>">
                                                    <?php
                                              
                                                    echo '<input type="image" class="img-responsive" src="'.$image.'" alt="submit">';
                                                    ?>
                                                </a>
                                            </div>
                                            <div class="overlay"></div>
                                        </div>
                                        <h4><?php echo $nomProduit; ?></h4>
                                        <h5>Par : <?php echo $nom.' '.$prenom; ?></h5>
                                        <hr>
                                        <h4>Prix : <span style="color: #68dff0"><?php echo $prix; ?> €</span></h4>
                                        <?php if (isset($_SESSION["clientId"])) :?>
                                        <a style="color: #ffd777" href="javascript:;" onclick="addPanier(<?php echo $id;?>, <?php echo $_SESSION['clientId']; ?>)"><i class="fa fa-shopping-cart fa-2x pull-left"></i></a>
                                    	<?php endif; ?>
                                    </div>
                                </div>
                            </div><!-- col-lg-4 -->
                            <?php } ?>

                        <?php } else {

                            $request = "SELECT p.*, c.nom, c.prenom FROM produits as p, clients as c WHERE active = 1 AND c.id = p.idClient AND categorie =" . $_GET['categorie'];
                            $query = mysqli_query($link, $request);

                            if (mysqli_num_rows($query) == 0) {
                                echo '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 desc">';
                                echo '<h4> Aucun produit trouvé</h4>';
                                echo '</div>';
                            }

                            while ($row = mysqli_fetch_assoc($query)) {
                                $nomProduit = $row['nomProduit'];
                                $id = $row['id'];
                                $prix = $row['prix'];
                                $image = $row['image'];
                                $nom = $row['nom'];
                                $prenom = $row['prenom'];
                                $categorie = $row['categorie'];


                                ?>

                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 desc">
                                    <div class="project-wrapper">
                                        <div class="project" style="    margin: 30px;">
                                            <div class="photo-wrapper">
                                                <div class="photo">
                                                    <form action="ficheProduit.php?id=<?php echo $id; ?>&categorie=<?php echo $categorie;?>" method="POST">
                                                        <?php
                                                        echo '<input type="hidden" name="categorie" value="' . $categorie . '">';
                                                        echo '<input type="hidden" name="idProduit" value="' . $id . '">';
                                                        echo '<input type="image" class="img-responsive" src="' . $image . '" alt="submit">';
                                                        ?>
                                                    </form>
                                                </div>
                                                <div class="overlay"></div>
                                            </div>
                                            <h4><?php echo $nomProduit; ?></h4>
                                            <h5>Par : <?php echo $nom . ' ' . $prenom; ?></h5>
                                            <hr>
                                            <h4>Prix : <span style="color: #68dff0"><?php echo $prix; ?> €</span></h4>
                                            <a style="color: #ffd777" href="javascript:;" onclick="addPanier(<?php echo $id;?>, <?php echo $_SESSION['clientId']; ?>)"><i class="fa fa-shopping-cart fa-2x pull-left"></i></a>
                                        </div>
                                    </div>
                                </div><!-- col-lg-4 -->
                            <?php }
                        }?>



                    </div><!-- /row -->
        </section><! --/wrapper -->
    </section><!-- /MAIN CONTENT -->

   <footer class="site-footer">
        <div class="text-center">
            La Galerie des Artisans
            <a href="#" class="go-top">
                <i class="fa fa-angle-up"></i>
            </a>
        </div>
    </footer>
    <!--footer end-->
</section>

<div id="divValidationPanier">
</div>

<!-- js placed at the end of the document so the pages load faster -->
<script src="assets/js/fancybox/jquery.fancybox.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>
<script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="assets/js/sweetalert.min.js"></script>


<!--common script for all pages-->
<script src="assets/js/common-scripts.js"></script>

<!--script for this page-->

<script type="text/javascript">


        <?php if (isset($_GET['error']) && $_GET['error'] == '3') { ?>
            swal("Paiement", "Erreur lors du Paiement, veuillez réessayer plus tard", "error");
        <?php } elseif (isset($_GET['success']) && $_GET['success'] == "3" ) { ?>
            swal("Paiement", "Le Paiment a été effectué avec succès", "success");
        <?php } ?>

		<?php if ($facture == 1) :?>
		swal("Commande confirmée", "Vous avez recu un mail de confirmation", "success");
        <?php endif;?>
        
    function addPanier (idProduit, idClient) {
        $.get("ajax.php", {typeAjax: "insertProduitPanier", produitId: idProduit, idClient: idClient}, function (data) {
            $("#divValidationPanier").html(data);
            setTimeout(function(){
                location.reload();
            }, 1500);
        });
    }

    $(function() {
        //    fancybox
        jQuery(".fancybox").fancybox();
    });

</script>

<script>
    //custom select box

    $(function(){
        $("select.styled").customSelect();
    });

</script>

</body>
</html>
