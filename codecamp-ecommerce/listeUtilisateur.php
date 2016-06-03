<?php
  require("_init.php");
  session_start();
  if(!$_SESSION['adminId']) header('Location: login.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>La Galerie des Artisans - Liste Utilisateurs</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
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
                    <!-- settings start -->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.php#">
                            <i class="fa fa-tasks"></i>
                            <span class="badge bg-theme">4</span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">You have 4 pending tasks</p>
                            </li>
                            <li>
                                <a href="index.php#">
                                    <div class="task-info">
                                        <div class="desc">DashGum Admin Panel</div>
                                        <div class="percent">40%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.php#">
                                    <div class="task-info">
                                        <div class="desc">Database Update</div>
                                        <div class="percent">60%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.php#">
                                    <div class="task-info">
                                        <div class="desc">Product Development</div>
                                        <div class="percent">80%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.php#">
                                    <div class="task-info">
                                        <div class="desc">Payments Sent</div>
                                        <div class="percent">70%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                                            <span class="sr-only">70% Complete (Important)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="external">
                                <a href="#">See All Tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- settings end -->
                    <!-- inbox dropdown start-->
                    <li id="header_inbox_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.php#">
                            <i class="fa fa-envelope-o"></i>
                            <span class="badge bg-theme">5</span>
                        </a>
                        <ul class="dropdown-menu extended inbox">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">You have 5 new messages</p>
                            </li>
                            <li>
                                <a href="index.php#">
                                    <span class="photo"><img alt="avatar" src="assets/img/ui-zac.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Zac Snider</span>
                                    <span class="time">Just now</span>
                                    </span>
                                    <span class="message">
                                        Hi mate, how is everything?
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="index.php#">
                                    <span class="photo"><img alt="avatar" src="assets/img/ui-divya.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Divya Manian</span>
                                    <span class="time">40 mins.</span>
                                    </span>
                                    <span class="message">
                                     Hi, I need your help with this.
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="index.php#">
                                    <span class="photo"><img alt="avatar" src="assets/img/ui-danro.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Dan Rogers</span>
                                    <span class="time">2 hrs.</span>
                                    </span>
                                    <span class="message">
                                        Love your new Dashboard.
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="index.php#">
                                    <span class="photo"><img alt="avatar" src="assets/img/ui-sherman.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Dj Sherman</span>
                                    <span class="time">4 hrs.</span>
                                    </span>
                                    <span class="message">
                                        Please, answer asap.
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="index.php#">See all messages</a>
                            </li>
                        </ul>
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
                    <li><a class="logout" href="logout.php">Deconnexion</a></li>
            	</ul>
            </div>
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <?php require("sidebar.php");?>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> Liste des utilisateurs</h3>


              <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                          <table class="table table-striped table-advance table-hover">
                            <h4><i class="fa fa-angle-down"></i> Administrateurs</h4>
                            <hr>
                              <thead>
                              <tr>
                                  <th>Nom - Prénom</th>
                                  <th>Adresse</th>
                                  <th>Téléphone</th>
                                  <th>Adresse mail</th>
                                  <th></th>
                              </tr>
                              </thead>
                              <tbody>
                              <tr>
                                <?php
                                
                                  $query = "SELECT id, nom, prenom, adresse, telephone, mail, type FROM clients WHERE type=0";
                                  $fetch = mysqli_query($link, $query);

                                  while ($each_row = mysqli_fetch_assoc($fetch))
                                  {
                                    $id = $each_row['id'];

                                    echo '
                                      <td><a href="profile.php?user=' . $id . '">' . $each_row["nom"] . ' ' . $each_row["prenom"] . '</a></td>
                                      <td>' . $each_row["adresse"] . '</td>
                                      <td>' . $each_row["telephone"] . '</td>
                                      <td>' . $each_row["mail"] . '</td>
                                      <form action="_traitement.php" id="formRemoveUser' . $id . '" method="post">
                                      <input type="hidden" name="typeTraitement" value="removeUser">
                                      <input type="hidden" id="idUser' . $id . '" name="idUser" value=' . $id . '>
                                      <td><button class="btn btn-danger btn-xs" type="button" onclick="delUser(' . $id . ');" ><i class="fa fa-trash-o" id="removeUser"></i></button></td>
                                      </form>';
                                      ?>
                                      <td>
                                          <button class='btn btn-primary btn-xs' data-toggle='modal' data-target='#myModal' onclick='editUser("<?php echo $each_row['id']; ?>", "<?php echo $each_row['nom']; ?>", "<?php echo $each_row['prenom']; ?>", "<?php echo $each_row['adresse']; ?>", "<?php echo $each_row['telephone']; ?>", "<?php echo $each_row['mail']; ?>", "<?php echo $each_row['type']; ?>")'>
                                            <i class='fa fa-pencil'></i>
                                          </button>
                                      </td>
                                    <?php   echo '</tr>';
                                  }

                                ?>

                              </tbody>
                          </table>
                     </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->

              <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                          <table class="table table-striped table-advance table-hover">
                            <h4><i class="fa fa-angle-down"></i> Fournisseurs</h4>
                            <hr>
                              <thead>
                              <tr>
                                  <th>Nom - Prénom</th>
                                  <th>Adresse</th>
                                  <th>Téléphone</th>
                                  <th>Adresse mail</th>
                                  <th></th>
                              </tr>
                              </thead>
                              <tbody>
                              <tr>
                                <?php
                                
                                  $query = "SELECT id, nom, prenom, adresse, telephone, mail, type FROM clients WHERE type=1";
                                  $fetch = mysqli_query($link, $query);

                                  while ($each_row = mysqli_fetch_assoc($fetch))
                                  {
                                    $id = $each_row['id'];

                                    echo '
                                      <td><a href="profile.php?user=' . $id . '">' . $each_row["nom"] . ' ' . $each_row["prenom"] . '</a></td>
                                      <td>' . $each_row["adresse"] . '</td>
                                      <td>' . $each_row["telephone"] . '</td>
                                      <td>' . $each_row["mail"] . '</td>
                                      <form action="_traitement.php" id="formRemoveUser' . $id . '" method="post">
                                      <input type="hidden" name="typeTraitement" value="removeUser">
                                      <input type="hidden" id="idUser' . $id . '" name="idUser" value=' . $id . '>
                                      <td><button class="btn btn-danger btn-xs" type="button" onclick="delUser(' . $id . ');" ><i class="fa fa-trash-o" id="removeUser"></i></button></td>
                                      </form>';
                                      ?>
                                      <td>
                                          <button class='btn btn-primary btn-xs' data-toggle='modal' data-target='#myModal' onclick='editUser("<?php echo $each_row['id']; ?>", "<?php echo $each_row['nom']; ?>", "<?php echo $each_row['prenom']; ?>", "<?php echo $each_row['adresse']; ?>", "<?php echo $each_row['telephone']; ?>", "<?php echo $each_row['mail']; ?>", "<?php echo $each_row['type']; ?>")'>
                                            <i class='fa fa-pencil'></i>
                                          </button>
                                      </td>
                                    <?php   echo '</tr>';
                                  }

                                ?>

                              </tbody>
                          </table>
                     </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->


              <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                          <table class="table table-striped table-advance table-hover">
                            <h4><i class="fa fa-angle-down"></i> Clients</h4>
                            <hr>
                              <thead>
                              <tr>
                                  <th>Nom - Prénom</th>
                                  <th>Adresse</th>
                                  <th>Téléphone</th>
                                  <th>Adresse mail</th>
                                  <th></th>
                              </tr>
                              </thead>
                              <tbody>
                              <tr>
                                <?php
                                
                                  $query = "SELECT id, nom, prenom, adresse, telephone, mail, type FROM clients WHERE type=2";
                                  $fetch = mysqli_query($link, $query);

                                  while ($each_row = mysqli_fetch_assoc($fetch))
                                  {
                                    $id = $each_row['id'];

                                    echo '
                                      <td><a href="profile.php?user=' . $id . '">' . $each_row["nom"] . ' ' . $each_row["prenom"] . '</a></td>
                                      <td>' . $each_row["adresse"] . '</td>
                                      <td>' . $each_row["telephone"] . '</td>
                                      <td>' . $each_row["mail"] . '</td>
                                      <form action="_traitement.php" id="formRemoveUser' . $id . '" method="post">
                                      <input type="hidden" name="typeTraitement" value="removeUser">
                                      <input type="hidden" id="idUser' . $id . '" name="idUser" value=' . $id . '>
                                      <td><button class="btn btn-danger btn-xs" type="button" onclick="delUser(' . $id . ');" ><i class="fa fa-trash-o" id="removeUser"></i></button></td>
                                      </form>';
                                      ?>
                                      <td>
                                          <button class='btn btn-primary btn-xs' data-toggle='modal' data-target='#myModal' onclick='editUser("<?php echo $each_row['id']; ?>", "<?php echo $each_row['nom']; ?>", "<?php echo $each_row['prenom']; ?>", "<?php echo $each_row['adresse']; ?>", "<?php echo $each_row['telephone']; ?>", "<?php echo $each_row['mail']; ?>", "<?php echo $each_row['type']; ?>")'>
                                            <i class='fa fa-pencil'></i>
                                          </button>
                                      </td>
                                    <?php   echo '</tr>';

                                  }

                                ?>
                              </tbody>
                          </table>

                        <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Modifier un utilisateur</h4>
                                    </div>
                                    <div class="modal-body">

                                        <form role="form" method="post" action="_traitement.php" id="formModifUser">
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
                                                <label>Téléphone *</label>
                                                <input id="tel" type="number" class="form-control" name="tel">
                                            </div>
                                            <div class="form-group">
                                                <label>Adresse mail *</label>
                                                <input id="mail" type="mail" class="form-control" name="mail">
                                            </div>
                                            <div class="form-group">
                                                <label>Type *</label>
                                                <select id="type" class="form-control" name="type">
                                                    <option value="0">Administrateur</option>
                                                    <option value="1">Fournisseur</option>
                                                    <option value="2">Client</option>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                                <input type="hidden" name="typeTraitement" value="modifUser">
                                                <input type="hidden" name="idUser" id="idUser">
                                                <button type="submit" id="submitModifUser" class="btn btn-theme">Modifier</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fin Modal -->


                      </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->

		</section><!--/wrapper-->
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              <p>2016 - La Galerie des Artisants</p>
              <a href="basic_table.php#" class="go-top">
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
    <script src="assets/js/sweetalert.min.js"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->
    
  <script>
      //custom select box

    <?php
    if(isset($_GET['success'])) {
    if($_GET['success'] == '1') { ?>
    swal("Modification ustilisateur", "La modification de l'utilisateur à bien été prise en compte", "success");
    <?php }
    } if (isset($_GET['error'])) {
    ?>
    swal("Erreur", "Impossible de modifier l'utilisateur, réessayer plus tard", "error");
    <?php
    }
    ?>

    function editUser(id, nom, prenom, adresse, tel, mail, type){
        $('#idUser').val(id);
        $('#nom').val(nom);
        $('#prenom').val(prenom);
        $('#adresse').val(adresse);
        $('#tel').val(tel);
        $('#mail').val(mail);
        $('#type').val(type);
    }

    function delUser(idUser)
    {
      swal({
            title: "Administrateur",
            text: "Voulez-vous vraiment supprimer cet utilisateur ?",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Fermer",
            confirmButtonColor: "#00cc00",
            confirmButtonText: "Oui",
            closeOnConfirm: false },
          function(){
              $('#formRemoveUser' + idUser).submit();
          }
      );
      return false;
    }

    $(document).ready(function() {

      $("#submitModifUser").click(function() {

      
        var nom=$("#nom").val();
        var prenom=$("#prenom").val();
        var adresse=$("#adresse").val();
        var telephone=$("#tel").val();
        var mail=$("#mail").val();
        var type=$("#type").val();

        if (nom == "" || prenom == "" || mail == ""
          || adresse == "" || telephone == "" || type == "")
        {
          swal("Erreur", "Tous les champs sont requis", "error");
          return false;
        }

        else
        {
          swal({
                title: "Fournisseur",
                text: "Voulez-vous vraiment modifier cet utilisateur ?",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "Fermer",
                confirmButtonColor: "#00cc00",
                confirmButtonText: "Oui",
                closeOnConfirm: false },
              function(){
                  $('#formModifUser').submit();
              }
          );
          return false;
        }
      });
    });



  </script>

  </body>
</html>
