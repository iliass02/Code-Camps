<?php
session_start();
if(!isset($_SESSION['clientId']) && !isset($_SESSION['fournisseurId']) && !isset($_SESSION['adminId'])) {
    $_SESSION['clientId'] = rand(500, 100000);
}
require("_init.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>La Galerie des Artisans - Fiche Produit</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/sweetalert.css"/>

    <script src="assets/js/chart-master/Chart.js"></script>

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
</form>
    
    
    <?php require("sidebar.php");?>
    <!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper site-min-height">


            <?php
                if(!isset($_POST['idProduit'])) {
                    header('Location: index.php');
                }

                $tabTitreCategorie = array(1 => "Maroquinerie", 2 => "Cosmetique", 3 => "Maison");
            ?>

            <a style="color: #797979" href="index.php?categorie=<?php echo $_POST['categorie'] ?>">
            <h3>Store
            
            
            <?php if (isset($_GET["id"])) $produitId = $_GET["id"];?>
             <?php if (isset($_GET["categorie"])) $categorieId = $_GET["categorie"];?>
            
            
                <i class="fa fa-angle-right"></i> <?php
                echo ' '.$tabTitreCategorie[$categorieId];
                ?>
            </h3></a>


            <?php

                $request = "SELECT p.*, c.nom, c.prenom FROM produits as p, clients as c WHERE p.idClient = c.id AND p.id=".$produitId;
                $query = mysqli_query($link, $request);

                if(mysqli_num_rows($query) < 1) {
                    header('Location: index.php');
                }

                while($row = mysqli_fetch_assoc($query)) {
                    $idProduit = $row['id'];

                    echo '<h4>&nbsp&nbsp&nbsp<i class="fa fa-angle-down"></i>'.$row['nomProduit'].'</h4>';
                    echo '<div class="row mt">';
                    echo '<div class="row">';
                    echo '<div style="margin-left:-100px">';
                    echo '<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6 mb">';
                    echo '<center>';
                    echo '<p><img src="' . $row["image"] . '" style="width:50%"></p>';
                    echo ' </center>';
                    echo '</div>';
                    echo '<div class="col-xs-12 col-sm-8 col-md-6 col-lg-5 mb">';
                    echo '<center>';
                    echo '<p style="font-size:18px"> Vendu par <span style="color: #68dff0;">' . $row["nom"] . '&nbsp&nbsp' . $row["prenom"] .'</span></p>';
                    echo '<hr />';
                    echo '<p style="font-size:18px"> Prix : <span style="color: #ffd777">' . $row["prix"] . ' €</span></p>';
                    echo '<hr />';
                    echo '<p style="font-size:18px"> Disponible : ' . $row["stock"] . ' </p>';
                    echo '<hr />';
                    echo '<p style="font-size:18px;     word-wrap: break-word;"> Description : ' . $row["description"] . '</p>';
                    echo '<br /><br />';
                    if (isset($_SESSION["clientId"])){
                        echo '<p><button type="button"  id="addpanier" onclick="addPanier('.$produitId.', '.$_SESSION['clientId'].')" class="btn btn-success" style="height:50px; width:50%; font-size:18px">Ajouter au Panier !</button></a>';
                    } else {
                        echo '<h4>Impossible de commander en tant que Fournisseur ou Admin</h4>';
                    }
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

<div id="divValidationPanier">
</div>

<script>


    function addPanier (idProduit, idClient) {
        $.get("ajax.php", {typeAjax: "insertProduitPanier", produitId: idProduit, idClient: idClient}, function (data) {
            $("#divValidationPanier").html(data);
            setTimeout(function(){
                location.reload();
            }, 1500);
        });
    }

</script>



</body>
</html>
