<?php require("_init.php");
session_start();

if (isset($_SESSION['clientId'])) $clientId = $_SESSION['clientId']; else {
    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>La Galerie des Artisans - Panier</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/sweetalert.css"/>

    <script src="assets/js/chart-master/Chart.js"></script>

   
</head>

<body>

<section id="container" >
    <!-- **********************************************************************************************************************************************************
    TOP BAR CONTENT & NOTIFICATIONS
    *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
        <!--logo start-->
        <a href="index.php" class="logo"><b>La Galerie Des Artisants</b></a>
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
                            if (!$query = mysqli_query($link, $request)){
                                header('Location: index.php');
                            }
                            $count = mysqli_num_rows($query);
                            echo '<span class="badge bg-theme">'.$count.'</span>';
                        
                        ?>
                    </a>
		<?php endif; ?>
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
    <?php require("sidebar.php");?>
    <!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper site-min-height">
            <a style="color: #797979" href="">
                <h3> Panier</h3></a>


            <?php

            $request = "SELECT p.nomProduit, p.prix, p.image, p.id
                        FROM commandes as c, produits as p
                        WHERE c.payer = 0
                        AND c.idProduit= p.id
                        AND c.idClient =".$clientId;

            if (!$query = mysqli_query($link, $request)) {
                header('Location: store.php');
            }

            echo '<hr>';
            $prix = 0;
            while($row = mysqli_fetch_assoc($query)) {
                $prix = $prix + $row['prix'];
                echo '<div class="row" style="    margin: 10px;">
            <div class="col-md-8">
              <img src="' . $row["image"] . '" style="width:20%">
            </div>
            <div class="col-md-4">
                <p style="font-size:18px; text-align: center;">Nom du Produit : ' . $row['nomProduit'] . '</p>
                <p style="font-size:18px; text-align: center;">Prix : ' . $row['prix'] . ' €</p>
                <br />
                <form action="_traitement.php" method="POST" id="formRemoveProduitPanier">
                    <input type="hidden" name="typeTraitement" value="removeProduitPanier">
                    <input type="hidden" name="produitId" value="'.$row['id'].'">
                    <input type="hidden" name="clientId" value="'.$clientId.'">
                    <button style="margin-left: 130px;" type="button" class="btn btn-danger" onclick="removePanier()">Supprimer</button>
                </form>
            </div>
          </div><hr>';
            }

            if($prix == 0) {
                echo "<h3>Pas de produit dans le panier</h3>";
            } else {
            	
                echo '<div class="row" style="    margin: 10px;">
            <div class="col-md-8">
            </div>
            <div class="col-md-4">
                <p style="font-size:18px; text-align: center;">Prix Total TTC: ' . $prix . ' €</p>';
                
                if ($_SESSION["clientId"] < 500) echo '<a href="payer.php"><center><button type="submit" id="valide" class="btn btn-success" style="">Commander !</button></center></a>';
                else echo '<a href="loginClient.php"><center><button type="submit" id="valide" class="btn btn-success" style="">Commander !</button></center></a>';
                
                echo '
                <br />
            </div>
          </div>';
            }

            ?>
            </center>
            </div>
            </div>
            </div>
        </section><!--/wrapper -->
    </section><!-- /MAIN CONTENT -->

    <!--main content end-->
    <!--footer start-->
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


<!-- js placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>
<script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="assets/js/jquery.sparkline.js"></script>
<script src="assets/js/sweetalert.min.js"></script>

<!--common script for all pages-->
<script src="assets/js/common-scripts.js"></script>

<!--script for this page-->
<script src="assets/js/sparkline-chart.js"></script>

<div id="divValidationRejet">
</div>

<script>


    function removePanier(){
        swal({
            title: "Panier",
            text: "Êtes-vous sur de vouloir supprimer ce produit de votre panier ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Oui",
            cancelButtonText: "Annuler",
            closeOnConfirm: false
        }, function(){
            $('#formRemoveProduitPanier').submit();
        });
    }


    <?php if(isset($_GET['success'])) { ?>
        swal("Panier", "La produit a bien été supprimé", "success");
    <?php } elseif (isset($_GET['error'])) { ?>
        swal("Panier", "Impossible de supprimer le produit, réessayer ultérieurement", "error");
    <?php } ?>


    $(document).ready(function() {
        $("#valide").click(function() {
            var produitId = $(this).attr('name').substring(6);
            $.get("ajax.php", {typeAjax: "validationProduit", produitId: produitId}, function(data) {
                $("#divValidationRejet").html(data);
                setTimeout(function(){
                    location.reload();
                }, 1200);
            });
        });
        $("#rejet").click(function() {
            var produitId = $(this).attr('name').substring(5);
            $.get("ajax.php", {typeAjax: "rejetProduit", produitId: produitId}, function(data) {
                $("#divValidationRejet").html(data);
                setTimeout(function(){
                    location.reload();
                }, 1200);


            });
        });
    });

</script>



</body>
</html>
