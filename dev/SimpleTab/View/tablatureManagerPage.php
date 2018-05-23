<?php
/** * Created by PhpStorm.
 * User: SAUSERR_INFO
 * Date: 16.05.2018
 * Time: 11:10
 */
session_start();

require_once "../view/modals.php";

$navIdOrButton="";
$navMenu1 = "";
$navMenu2 = "";
$redirect = 1;

if(isset($_SESSION['user']))
{
    $navIdOrButton = "<div class=\"dropdown\">
                            <button type=\"button\" onclick=\" \" class=\"btn btn-light dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\"> ".$_SESSION['user'][0]['pseudoUser']."</button>
                            <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
                                <a class=\"dropdown-item\" href=\"../controller/destroySession.php\">Déconnexion</a>
                            </div>
                      </div>";
    if($_SESSION['user'][0]['role_idrole'] == 0)
    {
        $navMenu1 = "<h5><a class=\"nav-link\" href=\"../view/homePage.php\">Accueil <span class=\"sr-only\">(current)</span></a></h5>";
        $navMenu2 = "<h5><a class=\"nav-link\" href=\"../view/tablatureManagerPage.php\">Gestion des tablatures </a></h5>";
    }
    elseif($_SESSION['user'][0]['role_idrole'] == 1)
    {
        $navMenu1 ="<h5><a class=\"nav-link\" href=\"../view/homePage.php\">Accueil <span class=\"sr-only\">(current)</span></a></h5>";
        $navMenu2 = "<h5><a class=\"nav-link\" href=\"../view/tablatureAndUserManagerPage.php\">Gestion des tablatures et utilisateurs </a></h5>";
    }
}
else
{
   $redirect = 0;
}
?>
<html>
<head>
    <title>Gestion des tablatures</title>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <!-- Copyright (c) 2016 Indri Muska. Licensed under the MIT license.-->
    <script src="//rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.js"></script>
    <link href="//rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <!-- JQuery CDN -->
</head>
<body>
<div class="border ">
    <div class=".col text-right mr-3 mb-0"> <?php echo $navIdOrButton;?>

        <div id="body" class=" mx-5">
            <nav class="navbar navbar-expand-lg navbar-light  p-0">
                <a class="navbar-brand" href="../view/homePage.php" id="logo">
                    <img src="../public/images/logoSimpleTabGrand.png" alt="logo" width="215" height="125">
                </a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto " style="margin: auto;">
                        <li class="nav-item active">
                            <?php echo $navMenu1?>
                        </li>
                        <li class="nav-item active">
                            <?php echo $navMenu2?>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0" method="get" action="../view/search.php">
                        <input class="form-control mr-sm-0" type="search" placeholder="Rechercher" aria-label="Search" id="searchBar" name="nameArtistOrTitleTab">
                        <button type="submit" class=" btn btn-outline-secondary ">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </nav>
        </div>
    </div>
</div>
<div  id="message" style="display:none;">
</div>

<div class=" m-5" >

    <table class="table table-dark">
        <thead style="color:red">
        <tr class="text-center">
            <th colspan="6"><button class="btn btn-dark" data-toggle="modal" data-target="#addTab" style="color:red;">Ajouter une tablature</button></a></i></th>
        </tr>
        <tr>
            <th scope="col">Artiste</th>
            <th scope="col">Titre</th>
            <th scope="col">Difficulté</th>
            <th scope="col">Note</th>
            <th scope="col" colspan="2" style="text-align: center">Gestion</th>
        </tr>
        </thead>
        <tbody id='tabs'>
        </tbody>
    </table>
    </td>


</div>
</body>
<script src="../js/function.js"></script>
<script type="text/javascript">
    $( document ).ready(function() {

        var redirect = <?php echo $redirect;?>;

        if(redirect == 1 ) {


            var idUser = <?php if(isset($_SESSION['user'][0]['idUsers'])){ echo $_SESSION['user'][0]['idUsers'];} else {echo -1;}?>;
            reloadTabByUSers(idUser);

            get_data("../controller/getArtistNames.php",getArtistNames,{},false);
            function getArtistNames(data)
            {
                data.forEach(function (artist) {
                    $('#addArtist').append('<option>'+artist.nameArtist+'</option>');
                    $('#modifyAuthor').append('<option>'+artist.nameArtist+'</option>');
                })

            }
            $('#addArtist').editableSelect({ effects: 'default' });
            $('#modifyAuthor').editableSelect({ effects: 'default' });


            $('#btnAddTab').click(function () {
                var title = $('#addTitle').val();
                var artist = $('#addArtist').val();
                var lvl = $('#addLvl option:selected').val();
                var capo = $('#addCapo').val();
                var key = $('#addKey').val();
                var tuning = $('#addTuning').val();
                var tabBody = $('#addTablatureBody').val();
                get_data("../controller/addTab.php", addTab, {
                    'addTitle': title,
                    'addArtist': artist,
                    'addLvl': lvl,
                    'addCapo': capo,
                    'addKey': key,
                    'addTuning': tuning,
                    'addTabBody': tabBody,
                }, false);

                function addTab(data) {
                    var message = "";
                    if (data == true) {
                        alert("La tablature a bien été ajoutée, elle sera visible quand l'administrateur l'aura acceptée")
                    }
                    else {
                        alert("Un problème est survenu")

                    }
                    reloadTabByUSers(idUser);


                }

                $('#addTab').modal('hide')
                reloadTabByUSers(idUser);
            });


            $('#btnModifyTab').click(function () {
                var title = $('#modifyTitle').val();
                var artist = $('#modifyAuthor').val();
                var lvl = $('#modifyLvl option:selected').val();
                var capo = $('#modifyCapo').val();
                var key = $('#modifyKey').val();
                var tuning = $('#modifyTuning').val();
                var tabBody = $('#modifyTablatureBody').val();
                get_data("../controller/modifyTabById.php", modifyTabById, {
                    'modifyTitle': title,
                    'modifyAuthor': artist,
                    'modifyLvl': lvl,
                    'modifyCapo': capo,
                    'modifyKey': key,
                    'modifyTuning': tuning,
                    'modifyTabBody': tabBody,

                }, false);

                function modifyTabById(data) {
                    if (data == true) {
                        alert('La tablature a été modifiée avec succès');
                    }
                    else {
                        alert("Un problème est survenu")
                    }
                    reloadTabByUSers(idUser);


                }

                $('#modifyTab').modal('hide')
                reloadTabByUSers(idUser);
            });
        }
        else
        {
            window.location.href = "../view/homePage.php";
        }
    });
</script>