<!DOCTYPE html>


<?php
session_start();
    require('_init.php');
    if(!$_SESSION['fournisseurId']) header('Location: login.php');
 ?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>La Galerie des Artisans - Ajout Produit</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/sweetalert.css"/>

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

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
          	<h3><i class="fa fa-angle-right"></i> Ajouter un nouveau produit</h3>

          	<!-- BASIC FORM ELELEMNTS -->
          	<div class="row mt">
          		<div class="col-lg-12">
                  <div class="form-panel">
                      <form class="form-horizontal style-form" method="post" enctype="multipart/form-data" action="_traitement.php" id="formAjoutProduit">
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nom du produit *</label>
                              <div class="col-sm-10" id="div_nomProduit">
                                  <input id="nomProduit" type="text" class="form-control" name="nomProduit">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Description *</label>
                              <div class="col-sm-10">
                                  <textarea id="description" class="form-control" rows="4" cols="50" name="description"> </textarea>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Prix € *</label>
                              <div class="col-sm-10">
                                  <input id="prix" type="number" class="form-control" name="prix">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Categorie *</label>
                              <div class="col-sm-10">
                                  <select id="Categorie" class="form-control" name="categorie">
                                      <option value="1">Maroquinerie</option>
                                      <option value="2">Cosmétique</option>
                                      <option value="3">Maison</option>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Stock *</label>
                              <div class="col-sm-10">
                                  <input id="stock" type="number" class="form-control" name="stock">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Image *</label>
                              <div class="col-sm-10">
                                  <input id="image" type="file" name="image">
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="col-sm-4">
                                  <input type="hidden" name="typeTraitement" value="ajoutProduit">
                                  <button type="submit" id="submitAjoutProduit" class="btn btn-theme">Ajouter</button>
                              </div>
                          </div>
                      </form>
                  </div>
          		</div><!-- col-lg-12-->
          	</div><!-- /row -->

		</section><! --/wrapper -->
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


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>

	<!--custom switch-->
	<script src="assets/js/bootstrap-switch.js"></script>

	<!--custom tagsinput-->
	<script src="assets/js/jquery.tagsinput.js"></script>

	<!--custom checkbox & radio-->

	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap-daterangepicker/date.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap-daterangepicker/daterangepicker.js"></script>

	<script type="text/javascript" src="assets/js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>


	<script src="assets/js/form-component.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>


  <script>
      //custom select box

      $(document).ready(function() {

          $('#submitAjoutProduit').click(function() {


              var nomProduit = $('#nomProduit').val();
              var description = $('#description').val();
              var prix = $('#prix').val();
              var stock = $('#stock').val();
              var categorie = $('#categorie').val();
              var image = $('#image').val();

              if (nomProduit == '' || description == '' || prix == '' || stock == '' || categorie == '' || image == ''){
                  swal("Erreur", "Tous les champs sont requis", "error");
                  return false;
              } else if (nomProduit != '' || description != '' || prix != '' || stock != '' || categorie != ''|| image != '') {

                  swal({
                      title: "Fournisseur",
                      text: "Ajouter un nouveau produit ?!",
                      type: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#00cc00",
                      confirmButtonText: "Oui",
                      closeOnConfirm: false },
                      function(){
                          $('#formAjoutProduit').submit();
                      }
                  );
                  return false;
              }
          });

          $(function(){
              $('select.styled').customSelect();
          });
      });

  </script>




  </body>
</html>
