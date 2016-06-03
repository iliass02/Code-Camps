  <?php require("_init.php"); 
  session_start();
  
  if(!$_SESSION['adminId']) header('Location: login.php');
  
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
            <!--logo start-->
            <a href="index.php" class="logo"><b>La Galerie Des Artisants</b></a>
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
      <?php require("sidebar.php");?>
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
            <h2><i class="fa fa-angle-right"></i> Liste des produits non-validés</h2>

<?php
      
$query = "SELECT id, image, nomProduit, description, prix, idClient, categorie FROM produits WHERE active=2 ORDER BY categorie";
$result = mysqli_query($link, $query);
$oldCategorie = array();
  
$tabTitreCategorie = array(1 => "Maroquinerie", 2 => "Cosmetique", 3 => "Maison");

if (!mysqli_num_rows($result)) echo '<h3>&nbsp&nbsp&nbsp<i class="fa fa-angle-down"></i> Aucun produit trouvé !</h3>';
while ($row = mysqli_fetch_assoc($result))
{
  if ($row['categorie'] == CATEGORIE_MAROQUINERIE)
  {
    if (!in_array($tabTitreCategorie[CATEGORIE_MAROQUINERIE], $oldCategorie))
    {
      echo '<h3>&nbsp&nbsp&nbsp<i class="fa fa-angle-down"></i> ' . $tabTitreCategorie[CATEGORIE_MAROQUINERIE] . '</h3>
              <div class="row">';
    }

    $requestPro = "SELECT nom, prenom, mail, adresse, telephone FROM clients WHERE id=" . $row['idClient'];
    $resultPro = mysqli_query($link, $requestPro);
    $rowPro = mysqli_fetch_assoc($resultPro);

    echo '<div style="margin-left:-100px">
            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-5 mb">
              <center>
                <p><img src="' . $row["image"] . '" style="width:50%"></p>
                <p style="font-size:18px">' . $row["nomProduit"] . '<br />Prix : <span style="color: #68dff0;"><b>' . $row["prix"] . '</b>€</span></p>
              </center>
            </div>
            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-5 mb" style="margin-top:15px">
              <center>
                <p style="font-size:18px"><i>Identiter du vendeur : </i><span style="color: black;"><b>' . $rowPro["nom"] . '&nbsp&nbsp' . $rowPro["prenom"] .'</b></span></p>
                <hr />
                <p style="font-size:18px"><i>Adresse : </i>' . $rowPro["adresse"] .'</p>
                <hr />
                <p style="font-size:18px"><i>Numéro de téléphone : </i>' . $rowPro["telephone"] .'</p>
                <hr />
                <p style="font-size:18px"><i>Adresse mail : </i>' . $rowPro["mail"] .'</p>
                <hr />
                <p style="font-size:18px"><i>Description : </i>' . $row["description"] . '</p>
                <hr />
                <br />
                  <p><button type="button" id="valide" name="valide'.$row["id"].'" class="btn btn-success" style="height:40px; width:50%; font-size:18px">Valider !</button>
                  <p><button type="button" id="rejet" name="rejet'.$row["id"].'" class="btn btn-danger" style="height:40px; width:50%; font-size:18px">Rejeter !</button>
              </center>
            </div>
          </div>';

    $oldCategorie[] = $tabTitreCategorie[CATEGORIE_MAROQUINERIE];
  }

  if ($row['categorie'] == CATEGORIE_COSMETIQUE)
  {
    echo '</div>';
    echo '<br />';

    if (!in_array($tabTitreCategorie[CATEGORIE_COSMETIQUE], $oldCategorie))
    {
      echo '<h3>&nbsp&nbsp&nbsp&nbsp<i class="fa fa-angle-down"></i> ' . $tabTitreCategorie[CATEGORIE_COSMETIQUE] . '</h3>
              <div class="row">';
    }

    $requestPro = "SELECT nom, prenom, mail, adresse, telephone FROM clients WHERE id=" . $row['idClient'];
    $resultPro = mysqli_query($link, $requestPro);
    $rowPro = mysqli_fetch_assoc($resultPro);

    echo '
          <div style="margin-left:-100px">
            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-5 mb">
              <center>
                <p><img src="' . $row["image"] . '" style="width:50%"></p>
                <p style="font-size:18px">' . $row["nomProduit"] . '<br />Prix : <span style="color: #68dff0;"><b>' . $row["prix"] . '</b>€</span></p>
              </center>
            </div>
            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-5 mb" style="margin-top:15px">
              <center>
                <p style="font-size:18px"><i>Identiter du vendeur : </i><span style="color: black;"><b>' . $rowPro["nom"] . '&nbsp&nbsp' . $rowPro["prenom"] .'</b></span></p>
                <hr />
                <p style="font-size:18px"><i>Adresse : </i>' . $rowPro["adresse"] .'</p>
                <hr />
                <p style="font-size:18px"><i>Numéro de téléphone : </i>' . $rowPro["telephone"] .'</p>
                <hr />
                <p style="font-size:18px"><i>Adresse mail : </i>' . $rowPro["mail"] .'</p>
                <hr />
                <p style="font-size:18px"><i>Description : </i>' . $row["description"] . '</p>
                <hr />
                <br />
                  <p><button type="button" id="valide" name="valide'.$row["id"].'" class="btn btn-success" style="height:40px; width:50%; font-size:18px">Valider !</button>
                  <p><button type="button" id="rejet" name="rejet'.$row["id"].'" class="btn btn-danger" style="height:40px; width:50%; font-size:18px">Rejeter !</button>
              </center>
            </div>
          </div>';

    $oldCategorie[] = $tabTitreCategorie[CATEGORIE_COSMETIQUE];
  }

  if ($row['categorie'] == CATEGORIE_MAISON)
  {    
    echo '</div>';
    echo '<br />';

    if (!in_array($tabTitreCategorie[CATEGORIE_MAISON], $oldCategorie))
    {
      echo '<h3>&nbsp&nbsp&nbsp&nbsp<i class="fa fa-angle-down"></i> ' . $tabTitreCategorie[CATEGORIE_MAISON] . '</h3>
              <div class="row">';
    }

    $requestPro = "SELECT nom, prenom, mail, adresse, telephone FROM clients WHERE id=" . $row['idClient'];
    $resultPro = mysqli_query($link, $requestPro);
    $rowPro = mysqli_fetch_assoc($resultPro);

    echo '
          <div style="margin-left:-100px">
            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-5 mb">
              <center>
                <p><img src="' . $row["image"] . '" style="width:50%"></p>
                <p style="font-size:18px">' . $row["nomProduit"] . '<br />Prix : <span style="color: #68dff0;"><b>' . $row["prix"] . '</b>€</span></p>
              </center>
            </div>
            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-5 mb" style="margin-top:15px">
              <center>
                <p style="font-size:18px"><i>Identiter du vendeur : </i><span style="color: black;"><b>' . $rowPro["nom"] . '&nbsp&nbsp' . $rowPro["prenom"] .'</b></span></p>
                <hr />
                <p style="font-size:18px"><i>Adresse : </i>' . $rowPro["adresse"] .'</p>
                <hr />
                <p style="font-size:18px"><i>Numéro de téléphone : </i>' . $rowPro["telephone"] .'</p>
                <hr />
                <p style="font-size:18px"><i>Adresse mail : </i>' . $rowPro["mail"] .'</p>
                <hr />
                <p style="font-size:18px"><i>Description : </i>' . $row["description"] . '</p>
                <hr />
                <br />
                  <p><button type="button" id="valide" name="valide'.$row["id"].'" class="btn btn-success" style="height:40px; width:50%; font-size:18px">Valider !</button>
                  <p><button type="button" id="rejet" name="rejet'.$row["id"].'" class="btn btn-danger" style="height:40px; width:50%; font-size:18px">Rejeter !</button>
              </center>
            </div>
          </div>';

    $oldCategorie[] = $tabTitreCategorie[CATEGORIE_MAISON];
  }

}

?>
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
  

      $(document).ready(function() {
    	$("#valide").click(function() {
	    	var produitId = $(this).attr('name').substring(6);
	    	$.get("ajax.php", {typeAjax: "validationProduit", produitId: produitId}, function(data) {
	    		$("#divValidationRejet").html(data);
			     setTimeout(function(){
		    		   location.reload();
		    		 }, 1100);
	    	});
    	});
	    $("#rejet").click(function() {
	       var produitId = $(this).attr('name').substring(5);
	       $.get("ajax.php", {typeAjax: "rejetProduit", produitId: produitId}, function(data) {
	    	   $("#divValidationRejet").html(data);
		     setTimeout(function(){
	    		   location.reload();
	    		 }, 1100);
	            
	            
	       });        	
    	});
      });

  </script>
    
    
    
  </body>
</html>
