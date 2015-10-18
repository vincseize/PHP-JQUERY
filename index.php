<!DOCTYPE html>
<html>
    <?php
    require_once("inc_links.php");
    require_once("get_nvillages.php");

/*echo "<br><br><br><br>";
$host = $_SERVER['HTTP_HOST'];
echo $host;
*/
    ?>

    <head>

<title><?php echo TITLE_SITE;?></title>


        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <link href="css/font-awesome.min.css"
        rel="stylesheet" type="text/css">
        <link href="css/bootstrap.css"
        rel="stylesheet" type="text/css">
    



<style>


.etoiles {
  display: inline-block;
  width: 60px;
  height: 60px;
  margin: 1em;
}


</style>

<script src="<?php echo HOMEPATH;?>/js/battle_timeleft.js" type="text/javascript"></script>



<script language='Javascript'> var widthScreen = window.screen.width; </script>
<script language='Javascript'> var heightScreen = window.screen.height; </script>







<script type="text/javascript">
			
		








			$(document).ready(function () {  



					$('.loadMenu').click(function(event) {
					  $("#content").load($(this).attr('href')); //load the data
					  event.preventDefault(); // prevent the browser from following the link
					});

					if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
						// alert('toto');
						// gdc.php?X='+widthScreen+'&Y='+heightScreen+'
			/*            var widthScreen = window.screen.width; 
						var heightScreen = window.screen.height;*/
						document.location.href = 'gdc.php?X='+widthScreen+'&Y='+heightScreen;
					}


			});




			function changeUInavbarGDC(page){ 

				$('#contentAdmin').hide();
				$('footer').hide();

				$('#content').show();
				$('#content').load(page); 

				$('#divLoading').show();

				$('#homeButton').css('background-color','#202020');
				$('#homeSIMU').css('background-color','#202020');
				$('#menuGDC').css('background-color','#19355E');



			}



			function changeUInavbarSIMU(page){ 

				$('#contentAdmin').hide();
				$('footer').hide();

				$('#content').show();
				$('#content').load(page); 

				$('#divLoading').show();

				$('#homeButton').css('background-color','#202020');
				$('#homeSIMU').css('background-color','#19355E');
				$('#menuGDC').css('background-color','#202020');



			}


			function changeUInavbarAdmin_1(page){ 

				$('#content').hide();$('#contentAdmin').show();
				$('footer').hide();

				$('#contentAdmin').load(page);

				$('#divLoading').show();

				$('#homeButton').css('background-color','#202020');
				$('#homeSIMU').css('background-color','#202020');
				$('#menuGDC').css('background-color','#202020');

			}



			function changeUInavbarAdmin_2(page){ 

				$('#content').hide();$('#contentAdmin').show();
				$('footer').hide();

				$('#contentAdmin').load(page);

				$('#divLoading').show();

				$('#homeButton').css('background-color','#202020');
				$('#homeSIMU').css('background-color','#202020');
				$('#menuGDC').css('background-color','#202020');

			}






</script>


<style type="text/css">
.navbarMenu li:hover{
    background:#19355E  !important;
}
/*.navbarMenu li:focus{
    background:#19355E  !important;
}*/
</style>





    </head>
    
    <body style="font-family:Arial;">
        <div class="navbar navbar-default navbar-fixed-top" style="background-color:#202020">
            <div class="container" style="background-color:#202020">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- <a id="homeButton" class="navbar-brand" onClick="changeUInavbarHOME('index.php');" href="#" style="color:white;"><span>Home</span></a> -->

                </div>

                <div  class="collapse navbar-collapse" id="navbar-ex-collapse">
                    <a id="homeButton" class="navbar-brand" href="index.php"   style="color:white;"><span>Home</span></a>                
                    <ul class="nav navbar-nav navbar-right navbarMenu">
                        <li>
                            <a id="homeSIMU" href="#" onClick="changeUInavbarSIMU('simu.php');" style="color:white">SIMULATEUR (soon)</a>
                        </li>
                        <li>
<!--                         
                            <a id="menuGDC" href="#" onClick="$('#contentAdmin').hide();$('#content').show();$('#content').load('gdc.php'); $('footer').hide();$('#divLoading').show();$('#homeButton').css('background-color','#202020');$('#menuGDC').css('background-color','#19355E');" style="color:white">GDC</a>
                            --> 
                           <!--  <a id="menuGDC" href="gdc.php?X=800&Y=500" onClick="changeUInavbarGDC('gdc.php');" style="color:white">GDC</a> -->


<script>

     /*document.write('<a id="menuGDC" href="gdc.php?X='+widthScreen+'&Y='+heightScreen+'" onClick="changeUInavbarGDC(\'gdc.php\');" style="color:white">GDC</a>')*/
      document.write('<a id="menuGDC" href="gdc.php?X='+widthScreen+'&Y='+heightScreen+'" target="blank" style="color:white">GDC</a>')

    </script>


                                                
                        </li>
                        <li>
                            <a href="phpBB3" target="blank" style="color:white">FORUM</a>
                        </li>
                    </ul>

                    <div class="btn-group btn-group-sm">
                        <a class="active btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" style="color:white;background-color:#4C1F00;">Admin<br><span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <!-- <a href="admin/index.php" target="blank" >Upload Ennemy Villages</a> -->
                                <a href="#" onClick="changeUInavbarAdmin_1('admin/index.php');" >Manage GDC</a>
                            </li>
                            <li>
                                <!-- <a href="#" onClick="changeUInavbarAdmin_2('manageUsers.php');" >Manage Users (wip)</a> -->
                               <!--  <a href="#" onClick="changeUInavbarAdmin_2('crud_users/index.php');" >Manage Users (wip)</a> 
                                <a href="crud_users/demos/appearence/alternate-row.php" target="blank">Manage Users</a>
                               <a href="crud_users/index.php" target="blank">Manage Users</a>-->
                               <a href="crud_users/index.php">Manage Users</a>
                            </li>
<!--                             <li>
                                <a href="#">Action</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">Action</a>
                            </li> -->
                        </ul>


                        <div name="navbarGDC" id="navbarGDC" style="margin: 0px; padding: 0px; position: relative; left: 100px; top: 0px; width: 660px; height: 50px;z-index: 30000; background-color: #202020;"></div>






                    </div>

                </div>
            </div>
        </div>









<br><br>


        <div id="content">
















        <div class="section"  style="background-color:#F8F8F8;background-image:url('images/bg_content.jpg');background-repeat:repeat-y;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-justify">

                                         <h2 style="color:#192131;">Règles du clan: </h2>
                        <p>
- Invitations interdites d'autant plus que le recrutement est fermé actuellement, seul les amis et la famille sont acceptés.
<br>- Lorsque le recrutement est ouvert, nous recrutons lvl70 minimum MAXÉ, les nouveaux membres sont acceptés si et seulement si après la présentation d'un de nos membres (ex moi: Villa 21ans Montpellier) sans dire "et toi?", le nouveau membre doit se présenter seul (moindre des politesses) s'il se présente alors il passe aîné et est accepté, si non il est exclu sur le champ.
<br>- Les dons sont illimités, vous pouvez demander autant que vous voulez, dons par défaut en mode multi archers/barbares. Le respect des dons impératifs en guerre de clans.

<br><b>En guerre :</b>
<br>- Avant la guerre, test d'activité effectué 24h avant. Pour participer à la guerre il faut passer votre profil en vert dès lors que le test d'activité est lancé pour stipulé que vous vouliez participer à la guerre.
Avec le nouveau système de guerre, je ne peux que choisir 10/15/20/25.. Membres, de ce fait, je prendrai ceux qui ont le plus de trophée.
<br>- Une fois la guerre lancé, tous le monde doit passer son profil de guerre en rouge pour le prochain test d'activité (impérativement), si ce n'est pas le cas, ce dernier ne pourra pas participer à la prochaine guerre.

<br><b>Jour de préparation de guerre :</b>
<br>Les châteaux de clan sont remplis selon la stratégie mise en place (ex: dragon ou archer). Bien entendu, les personnes ayant des troupes faibles doivent laisser la priorité au troupes fortes.
<br><b>Jour de combat :</b>
Deux attaques obligatoires sinon sanction


<br>1 attaque manquée = 1 guerre de sanction
<br>2 attaques manquées = 2 guerres de sanction
<br>Récidiviste = Sanction x2
<br>- Première attaque, chacun attaque son propre numéro, deuxième attaque on demande aux adj/chef quel village vous pouvez ou devez attaquer. (Sinon sanction)
<br>- Vous avez la priorité sur votre numéro durant les 12 premières heures de combat, au delà, d'autres membres peuvent effectuer leur deuxième attaque sur votre village.
<br>- Il est interdit d'effectuer des attaques sans conviction, à savoir, les attaques géant, full archers, full barbares ... Par exemple sont INTERDITES !! (Sinon Sanction)
<br>Les compo préconisé : Ballons, Cochons, Dragons, Gowiwi, Gowipe, ...
<br>
<br>
<i>Merci et bon jeu à tous.</i></p>  
                            

                        <!-- <img src="images/bg_home.jpg"
                        class="center-block img-responsive"> -->

                    </div>
                </div>
            </div>
        </div>




</div>













        <footer class="section section-primary">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <h1>Zemelattitude</h1>
                        <p>Ici réside le clan quasi imbattable en guerre. 
                            <br>Plus qu'un clan, une vrai famille peuplée de frêres et sœurs à gogo. 
                            <br>La patience est la clef de la réussite.</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="text-info text-right">
                            <br>
                            <br>
                        </p>
                        <div class="row">
                            <div class="col-md-12 hidden-lg hidden-md hidden-sm text-left"  style="sbackground-image:url('images/facebook.png');background-repeat:no-repeat;">
                                <!-- <a href="#"><i class="fa fa-3x fa-fw fa-instagram text-inverse"></i></a> -->
                               <!--  <a href="#"><i class="fa fa-3x fa-fw fa-twitter text-inverse"></i></a> -->
                                <a href="https://www.facebook.com/Zemelclan" target="blank"><img src="images/facebook.png" alt="Facebook" height="42" width="42"></a>
                                <!-- <a href="#"><i class="fa fa-3x fa-fw fa-github text-inverse"></i></a> -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 hidden-xs text-right">
                                <!-- <a href="#"><i class="fa fa-3x fa-fw fa-instagram text-inverse"></i></a> -->
                                <!-- <a href="#"><i class="fa fa-3x fa-fw fa-twitter text-inverse"></i></a> -->
                                <a href="https://www.facebook.com/Zemelclan" target="blank"><img src="images/facebook.png" alt="Facebook" height="42" width="42"></a>
                                <!-- <a href="#"><i class="fa fa-3x fa-fw fa-github text-inverse"></i></a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>



<!-- <div name="navbarGDC" id="navbarGDC" style="margin: 0px; padding: 0px; position: fixed; left: 400px; top: 0px; width: 200px; height: 50px;z-index: 30000; background-color: rgb(102, 102, 102);"></div> -->

<div id="contentAdmin"></div>


<div name="divLoading" id="divLoading" style="margin: 0px; padding: 0px; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: rgb(102, 102, 102); z-index: 30001; opacity: 0.8;">
<p style="position: absolute; color: White; top: 30%; left: 35%;">
Loading, please wait...
<img src="images/ajax-loading.gif">
</p>
</div>



<script type="text/javascript">
$('#divLoading').hide();
$('#homeButton').css('background-color','#19355E');
$('#homeSIMU').css('background-color','#202020');
$('#menuGDC').css('background-color','#202020');

$('#navbarGDC').load('navbarGDC.php'); 


$(document).ready(function () {
    setInterval(function () {
        $("#navbarGDC").load('navbarGDC.php');
    }, 60000);


$.get( 
                  "admin/getName.php",
                  function(data) {
                    tmpN = data;
                    resN = tmpN.split(":");
                    resN = resN[1];
                    resN = resN.replace("\"", ""); 
                    resN = resN.replace("\"", ""); 
                    resN = resN.replace("}", ""); 
                    name = resN.replace("]", ""); 
                     // $('#clanName').val(name);
                     $('#clanName2').val(name);

                  }
               );


});


</script>





    </body>

</html>