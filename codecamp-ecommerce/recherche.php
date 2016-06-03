<?php 
include('_init.php');

session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>La Galerie des Artisans</title>

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
            <a href="index.php" class="logo"><b>La Galerie Des Artisants</b></a>
            
            
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
                <?php
                if (isset($_SESSION["adminId"]) || isset($_SESSION["fournisseurId"])){
                    echo '<li><a class="logout" href="logout.php">Deconnexion</a></li>';
                } else echo '<li><a class="logout" href="logout.php">Espace Admin</a></li>';
                ?>
            </ul>
        </div>
        </header>
      <!--header end-->
      <?php
        require('sidebar.php');
      ?>
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
            <h2><i class="fa fa-angle-right"></i> Recherche</h2>

            
            
            
            <?php 
            
            if (isset($_POST["champRechercheHaut"])) {
            	$champRecherche = traiteTexte($_POST["champRechercheHaut"]);
            
            echo "<h3>Nom produit similaire a : $champRecherche</h3>";
            
            ?>
            
             <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:15px">
          <div class="row">
            <div class="col-md-12">
              <div class="content-panel">
                  <p style="font-size: 18px"><i class="fa fa-angle-right"></i> Resultats de votre recherche</p>
                  <hr>
                <table class="table" style="    table-layout: fixed;">
                  <thead>
                    <tr>
                      <th>Nom du produit</th>
                      <th>Catégorie</th>
                      <th>Prix</th>
                      <th>Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                    <?php 
            $query = "SELECT id, categorie, nomProduit, prix FROM produits WHERE nomProduit LIKE '%$champRecherche%'";
            $result = mysqli_query($link, $query);
            while ($row = mysqli_fetch_assoc($result)) {
            	echo "<tr><td>".$row["nomProduit"]."</td>";
            	echo "<td>".$titreCategorie[$row["categorie"]]."</td>";
            	echo "<td>".$row["prix"]." €</td>";
            	echo "<td><b><a href='ficheProduit.php?id=".$row["id"]."&categorie=".$row["categorie"]."'>Cliquez pour accéder au detail</a></b></td></tr>";
            }
            
            
            
            
            
            
            }
            
            
            ?>
            
         
                        </tbody>
                </table></div><!-- --/content-panel ---->
          </div><!-- /col-md-12 -->
     </div>
     </div>
            
        </section><!--/wrapper -->
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
            La Galerie Des Artisants
              <a href="panels.php#" class="go-top">
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


    


  </script>
    
    
    
  </body>
</html>


 

