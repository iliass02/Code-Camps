<?php
session_start();
require('_init.php');

if (!isset($_SESSION['adminId'])) {
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>La Galerie des Artisans</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">

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
            <h3><i class="fa fa-angle-right"></i> Statistique</h3>
            <!-- page start-->
            <div id="morris">
                <div class="row mt">
                        <div class="col-lg-6">
                            <div class="content-panel">
                                <h4><i class="fa fa-angle-right"></i> Clients</h4>
                                <div class="panel-body">
                                    <div id="hero-donut" class="graph"></div>
                                </div>
                            </div>
                        </div>
                    <div class="col-lg-6">
                        <div class="content-panel">
                            <h4><i class="fa fa-angle-right"></i> Nombre de ventes sur 1 semaine</h4>
                            <div class="panel-body">
                                <div id="hero-bar" class="graph"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt">

                </div>
            </div>
            <!-- page end-->
        </section>
    </section><!-- /MAIN CONTENT -->

    <!--main content end-->
    <!--footer start-->
    <footer class="site-footer">
        <div class="text-center">
            2014 - Alvarez.is
            <a href="morris.html#" class="go-top">
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
<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
<script src="assets/js/common-scripts.js"></script>

<!--script for this page-->
<script>
    var Script = function () {

        //morris chart

        $(function () {
            // data stolen from http://howmanyleft.co.uk/vehicle/jaguar_'e'_type
            var tax_data = [
                {"period": "2011 Q3", "licensed": 3407, "sorned": 660},
                {"period": "2011 Q2", "licensed": 3351, "sorned": 629},
                {"period": "2011 Q1", "licensed": 3269, "sorned": 618},
                {"period": "2010 Q4", "licensed": 3246, "sorned": 661},
                {"period": "2009 Q4", "licensed": 3171, "sorned": 676},
                {"period": "2008 Q4", "licensed": 3155, "sorned": 681},
                {"period": "2007 Q4", "licensed": 3226, "sorned": 620},
                {"period": "2006 Q4", "licensed": 3245, "sorned": null},
                {"period": "2005 Q4", "licensed": 3289, "sorned": null}
            ];

            Morris.Donut({
                element: 'hero-donut',
                data: [
                <?php

                    $request = "SELECT COUNT(*) as count, type FROM clients GROUP BY type";

                    if (!$query = mysqli_query($link, $request)) {
                        header('Location: produitAValider.php');
                    } else {
                        while($row = mysqli_fetch_assoc($query)) {
                            $count = $row['count'];
                            if($row['type'] == 0 ) {
                                $type = "Administrateurs";
                            } elseif ($row['type'] == 1) {
                                $type = "Fournisseurs";
                            } elseif ($row['type'] == 2) {
                                $type = "Clients";
                            } else {
                                $type = "";
                            }

                            echo "{label: '$type', value: $count },";
                        }
                    }
                    ?>
                ],
                colors: ['#3498db', '#2980b9', '#34495e'],
                formatter: function (y) { return y  }
            });

            Morris.Bar({
                element: 'hero-bar',
                data: [
                    <?php
                        $request = "SELECT COUNT(*) as count, convert(DATE, date) as date
                                    FROM commandes
                                    WHERE payer=2
                                    AND date BETWEEN NOW() - INTERVAL 6 DAY and NOW()
                                    GROUP BY convert(DATE, date)";

                        if (!$query = mysqli_query($link, $request)) {
                            header('Location: produitAValider.php');
                        } else {
                            while ($row = mysqli_fetch_assoc($query)) {
                                echo '{device: \''.$row['date'].'\', vente: \''.$row['count'].'\'},';
                            }
                        }
                    ?>
                ],
                xkey: 'device',
                ykeys: ['vente'],
                labels: ['Vente'],
                barRatio: 0.4,
                xLabelAngle: 35,
                hideHover: 'auto',
                barColors: ['#ac92ec']
            });

            new Morris.Line({
                element: 'examplefirst',
                xkey: 'year',
                ykeys: ['value'],
                labels: ['Value'],
                data: [
                    {year: '2008', value: 20},
                    {year: '2009', value: 10},
                    {year: '2010', value: 5},
                    {year: '2011', value: 5},
                    {year: '2012', value: 20}
                ]
            });

            $('.code-example').each(function (index, el) {
                eval($(el).text());
            });
        });

    }();






</script>

<script>
    //custom select box

    $(function(){
        $('select.styled').customSelect();
    });

</script>

</body>
</html>



