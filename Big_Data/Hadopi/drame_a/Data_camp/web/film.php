<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Web Stream</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1" http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfont-->
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lobster+Two:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--Animation-->
<script src="js/wow.min.js"></script>
<link href="css/animate.css" rel='stylesheet' type='text/css' />
<script>
	new WOW().init();
</script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
				});
			});
		</script>
</head>
<body>
    <!-- header-section-starts -->
	<div class="header">
		<div class="container">
			<div class="top-header">
				<div class="logo">
					<a href="accueil.php"><img src="images/logo.png" class="img-responsive" alt="" /></a>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
			<div class="menu-bar">
			<div class="container">
				<div class="top-menu">
					<ul>
						<li><a href="accueil.php">Accueil</a></li>|
						<li><a href="film.php">Films</a></li>|
						<li><a href="serie.php">Séries</a></li>|
						<li><a href="anime.php">Animés</a></li>
						<div class="clearfix"></div>
					</ul>
				</div>
				<div class="login-section">
					<ul>
						<li><a href="form.php">Suggestions</a>  </li>
						<div class="clearfix"></div>
					</ul>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		</div>	</div>
		<div class="banner wow fadeInUp" data-wow-delay="0.4s" id="Home">
		    <div class="container">
				<div class="banner-info">
					<div class="banner-info-head text-center wow fadeInLeft" data-wow-delay="0.5s">
						<div class="line">
							<h2>Web Stream</h2>
						</div>
					</div>
					<div class="form-list wow fadeInRight" data-wow-delay="0.5s">
				        <form action="recherche.php" method="POST">
				           <center><input type="text" value="Search" class="text" placeholder="Recherche Film Série Animé"/></center>
				        </form>
					</div>
					<!-- start search-->
		<script type="text/javascript">
	         $('.main-search').hide();
	        $('button').click(function (){
	            $('.main-search').show();
	            $('.main-search text').focus();
	        }
	        );
	        $('.close').click(function(){
	            $('.main-search').hide();
	        });
	    </script>
					
				</div>
			</div>
		</div>
	</div>
	<!-- header-section-ends -->
	<!-- content-section-starts -->
		<div class="popular-restaurents" id="Popular-Restaurants">
			<div class="container">
				<div class="col-md-4 top-restaurents">
					<div class="top-restaurent-head">
						<h3>Partenaires</h3>
					</div>
					<div class="top-restaurent-grids">
						<div class="top-restaurent-logos">
							<div class="res-img-1 wow bounceIn" data-wow-delay="0.4s">
								<a href="http://boutique.arte.tv/" target="blank"><img src="images/restaurent-1.jpg" class="img-responsive" alt="" /></a>
							</div>
							<div class="res-img-2 wow bounceIn" data-wow-delay="0.4s">
							    <a href="https://www.jookvideo.com/" target="blank"><img src="images/restaurent-2.jpg" class="img-responsive" alt="" /></a>
							</div>
							<div class="res-img-1 wow bounceIn" data-wow-delay="0.4s">
							    <a href="http://www.vodeo.tv/" target="blank"><img src="images/restaurent-3.jpg" class="img-responsive" alt="" /></a>
							</div>
							<div class="res-img-2 wow bounceIn" data-wow-delay="0.4s">
							    <a href="http://www.allocine.fr/" target="blank"><img src="images/restaurent-4.jpg" class="img-responsive" alt="" /></a>
							</div>
							<div class="res-img-1 wow bounceIn" data-wow-delay="0.4s">
							    <a href="http://carlottavod.com/" target="blank"><img src="images/restaurent-5.jpg" class="img-responsive" alt="" /></a>
							</div>
							<div class="res-img-2 wow bounceIn" data-wow-delay="0.4s">
							    <a href="http://www.wakanim.tv/" target="blank"><img src="images/restaurent-6.jpg" class="img-responsive" alt="" /></a>
							</div>>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
				<div class="col-md-8 top-cuisines">
					<div class="top-cuisine-head">
						<h3>Films</h3>
					</div>
					<div class="top-cuisine-grids">
						<div class="top-cuisine-grid wow bounceIn" data-wow-delay="0.4s">
						    <!--<a href="#"><img src="web/images/cuisine1.jpg" class="img-responsive" alt="" /> </a>-->
						    	<?php
							    	$xml = simplexml_load_file('bdd.xml');

									$vid = 4854;
						            echo "<a href = ".$xml->Video[$vid]->URL."><img src='".$xml->Video[$vid]->URLPhoto."'/></a>";
									echo "<script>$('img:eq(7)').attr('class', 'img-responsive')</script>";
						            echo "<label>";
						            echo $xml->Video[$vid]->Title;
						            echo "</label>";
					            ?>
					    </div>
						<div class="top-cuisine-grid wow bounceIn" data-wow-delay="0.4s">
						    <?php

									$vid = 4855;
						            echo "<a href = ".$xml->Video[$vid]->URL."><img src='".$xml->Video[$vid]->URLPhoto."'/></a>";
									echo "<script>$('img:eq(8)').attr('class', 'img-responsive')</script>";
						            echo "<label>";
						            echo $xml->Video[$vid]->Title;
						            echo "</label>";
					            ?>
					    </div>
						<div class="top-cuisine-grid wow bounceIn" data-wow-delay="0.4s">
						    <?php
									$vid = 4856;
						            echo "<a href = ".$xml->Video[$vid]->URL."><img src='".$xml->Video[$vid]->URLPhoto."'/></a>";
									echo "<script>$('img:eq(9)').attr('class', 'img-responsive')</script>";
						            echo "<label>";
						            echo $xml->Video[$vid]->Title;
						            echo "</label>";
					            ?>
					    </div>
						<div class="top-cuisine-grid nth-grid wow bounceIn" data-wow-delay="0.4s">
						    <?php

									$vid = 4857;
						            echo "<a href = ".$xml->Video[$vid]->URL."><img src='".$xml->Video[$vid]->URLPhoto."'/></a>";
									echo "<script>$('img:eq(10)').attr('class', 'img-responsive')</script>";
						            echo "<label>";
						            echo $xml->Video[$vid]->Title;
						            echo "</label>";
					            ?>
					    </div>
						<div class="top-cuisine-grid nth-grid1 wow bounceIn" data-wow-delay="0.4s">
						    <?php

									$vid = 4858;
						            echo "<a href = ".$xml->Video[$vid]->URL."><img src='".$xml->Video[$vid]->URLPhoto."'/></a>";
									echo "<script>$('img:eq(11)').attr('class', 'img-responsive')</script>";
						            echo "<label>";
						            echo $xml->Video[$vid]->Title;
						            echo "</label>";
					            ?>
					    </div>
						<div class="top-cuisine-grid nth-grid1 wow bounceIn" data-wow-delay="0.4s">
						    <?php
						    		
							    	$xml = simplexml_load_file('bdd.xml');

									$vid = 4861;
						            echo "<a href = ".$xml->Video[$vid]->URL."><img src='".$xml->Video[$vid]->URLPhoto."'/></a>";
									echo "<script>$('img:eq(12)').attr('class', 'img-responsive')</script>";
						            echo "<label>";
						            echo $xml->Video[$vid]->Title;
						            echo "</label>";
					            ?>
					    </div>
						<div class="top-cuisine-grid nth-grid1 wow bounceIn" data-wow-delay="0.4s">
						    <?php
						    		
							    	$xml = simplexml_load_file('bdd.xml');

									$vid = 4859;
						            echo "<a href = ".$xml->Video[$vid]->URL."><img src='".$xml->Video[$vid]->URLPhoto."'/></a>";
									echo "<script>$('img:eq(13)').attr('class', 'img-responsive')</script>";
						            echo "<label>";
						            echo $xml->Video[$vid]->Title;
						            echo "</label>";
					            ?>
					    </div>
						<div class="top-cuisine-grid nth-grid nth-grid1 wow bounceIn" data-wow-delay="0.4s">
						    <?php
						    		
							    	$xml = simplexml_load_file('bdd.xml');

									$vid = 4860;
						            echo "<a href = ".$xml->Video[$vid]->URL."><img src='".$xml->Video[$vid]->URLPhoto."'/></a>";
									echo "<script>$('img:eq(14)').attr('class', 'img-responsive')</script>";
						            echo "<label>";
						            echo $xml->Video[$vid]->Title;
						            echo "</label>";
					            ?>
					    </div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>

		<div class="service-section">
			<div class="service-section-top-row">
				<div class="container">
					<div class="service-section-top-row-grids wow bounceInLeft" data-wow-delay="0.4s">
					<div class="col-md-3 service-section-top-row-grid1">
						<h3 style="color: blue">Le site des offres culturelles en ligne</h3>
					</div>
					<div class="col-md-2 service-section-top-row-grid2">
						<ul>
							<li><i class="arrow"></i></li>
							<a href="http://www.hadopi.fr/"><li class="lists" style="color: blue">Hadopi</li></a>
						</ul>
						<ul>
							<li><i class="arrow"></i></li>
							<a href="http://www.prep-etna.fr/"><li class="lists" style="color: blue">Prep'ETNA</li></a>
						</ul>
						<ul>
							<li><i class="arrow"></i></li>
							<a href="http://www.offrelegale.fr/"><li class="lists" style="color: blue">Offre légale</li></a>
						</ul>
					</div>
					<div class="col-md-5 service-section-top-row-grid3">
						<img src="images/lunch.png" class="img-responsive" alt="" />
					</div>
					<div class="col-md-2 service-section-top-row-grid4 wow swing animated" data-wow-delay= "0.4s">
						<input type="submit" value="Cliquez ici">
					</div>
					<div class="clearfix"></div>
					</div>
				</div>
			</div>
			
			<div class="service-section-bottom-row">
				<div class="container">
					<div class="col-md-4 service-section-bottom-grid wow bounceIn "data-wow-delay="0.2s">
						<div class="icon">
							<img src="images/icon1.jpg" class="img-responsive" alt="" />
						</div>
						<div class="icon-data">
							<h4>Etna</h4>
							<p>École des Technologies Numériques Appliquées</p>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="col-md-4 service-section-bottom-grid wow bounceIn "data-wow-delay="0.2s">
						<div class="icon">
							<img src="images/icon2.jpg" class="img-responsive" alt="" />
						</div>
						<div class="icon-data">
							<h4>Hadopi</h4>
							<p>La Haute Autorité pour la Diffusion des Oeuvres et la Protection des droits sur Internet </p>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="col-md-4 service-section-bottom-grid wow bounceIn "data-wow-delay="0.2s">
						<div class="icon">
							<img src="images/icon3.jpg" class="img-responsive" alt="" />
						</div>
						<div class="icon-data">
							<h4>Code Camp</h4>
							<p>Les Code Camps représentent un système d'apprentissage unique et innovant</p>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<div class="contact-section" id="contact">
			<div class="container">
				<div class="contact-section-grids">
					<div class="col-md-3 contact-section-grid wow fadeInLeft" data-wow-delay="0.4s">
						<h4>Catégories</h4>
						<ul>
							<li><i class="point"></i></li>
							<li class="data"><a href="index.php">Accueil</a></li>
						</ul>
						<ul>
							<li><i class="point"></i></li>
							<li class="data"><a href="film.php">Films</a></li>
						</ul>
						<ul>
							<li><i class="point"></i></li>
							<li class="data"><a href="série.php">Séries</a></li>
						</ul>
						<ul>
							<li><i class="point"></i></li>
							<li class="data"><a href="animé.php">Animés</a></li>
						</ul>
					</div>
					<div class="col-md-3 contact-section-grid wow fadeInRight" data-wow-delay="0.4s">
						<h4>Contactez-nous</h4>
						<ul>
							<li><i class="in"></i></li>
							<li class="data"><a href="https://www.linkedin.com/in/iliassmarchoud" target="blank"> Linkedin Iliass</a></li>
						</ul>
						<ul>
							<li><i class="in"></i></li>
							<li class="data"><a href="https://www.linkedin.com/in/ahamadoudrame" target="blank"> Linkedin Ahamadou</a></li>
						</ul>
						<ul>
							<li><i class="in"></i></li>
							<li class="data"><a href="https://www.linkedin.com/in/faouzikridagh" target="blank"> Linkedin Faouzi</a></li>
						</ul>
						<ul>
							<li><i class="in"></i></li>
							<li class="data"><a href="https://www.linkedin.com/in/anthonycadet" target="blank"> Linkedin Anthony</a></li>
						</ul>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- content-section-ends -->
	<!-- footer-section-starts -->
	<!-- footer-section-ends -->
	  <script type="text/javascript">
						$(document).ready(function() {
							/*
							var defaults = {
					  			containerID: 'toTop', // fading element id
								containerHoverID: 'toTopHover', // fading element hover id
								scrollSpeed: 1200,
								easingType: 'linear' 
					 		};
							*/
							
							$().UItoTop({ easingType: 'easeOutQuart' });
							
						});
					</script>
				<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>

</body>
</html>