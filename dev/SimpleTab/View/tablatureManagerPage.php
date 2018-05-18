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

if(isset($_SESSION['user']))
{
    $navIdOrButton = "<div class=\"dropdown\">
                            <button type=\"button\" onclick=\" \" class=\"btn btn-light dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\"> ".$_SESSION['user'][0]['pseudoUser']."</button>
                            <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
                                <a class=\"dropdown-item\" href=\"../controller/destroySession.php\">Déconnexion</a>
                            </div>
                      </div>";

    $navMenu1 = "<h5><a class=\"nav-link\" href=\"../view/homePage.php\">Accueil <span class=\"sr-only\">(current)</span></a></h5>";
    $navMenu2 = "<h5><a class=\"nav-link\" href=\"../view/tablatureManagerPage.php\">Gestion des tablatures </a></h5>";


}
else
{
    header("location: ../view/homePage.php");
}
?>
<html>
<head>
    <title>Gestion des tablatures</title>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <!-- JQuery CDN -->
</head>
<body>
<div class="border ">
    <div class=".col text-right mr-3 mb-0"> <?php echo $navIdOrButton;?>

        <div id="body" class=" mx-5">
            <nav class="navbar navbar-expand-lg navbar-light bg-light p-0">
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
<div class="alert alert-success fade show" role="alert" id="message" style="display:none;">
    A simple success alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
</div>

<div class=" m-5" id="tabTable">

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
<script src="../js/utilities.js"></script>
<script type="text/javascript">
    $( document ).ready(function() {
        var idUser = <?php echo $_SESSION['user'][0]['idUsers'];?>;
        get_data("../controller/getTabAndRelatedArtistPostedByUser.php",getTabAndRelatedArtistPostedByUser,{'idUser' : idUser},true);
        function getTabAndRelatedArtistPostedByUser(data) {
            $('#tabs').empty();
            data.forEach(function (tablature) {
                var artist = $('<a class="artistName" >' + tablature.nameArtist + '</a>');
                var td = $("<td>").append(artist);
                var lvl = getDifficultyInLetters(tablature.lvlTab);
                var tr = $("<tr>").append(td);
                $(tr).append(
                    '<td>' + tablature.titleTab + '</td>' +
                    '<td>' + lvl + '</td>' +
                    '<td>' + tablature.rateTab + '</td>' +
                    '<td style="width:1%;"><button  class="btn btn-dark border-0" style="background-color: #20262b;" onclick="deleteTab('+tablature.idTab+')"><i class="fas fa-trash-alt"></i></button></td>'+
                    '<td style="width:1%;"><button class="btn btn-dark border-0" style="background-color: #20262b;" onclick="modifyTab('+tablature.idTab+')"><i class="fas fa-pencil-alt"></i></button></td>'+
                    '</tr>');
                $('#tabs').append(tr);


                $(artist).click(function () {
                    var artistName = $(this).text();
                    get_data("../controller/getTabByArtist.php", getTabByArtist, {'artistName': artistName}, false);

                    function getTabByArtist(data) {
                        $('#tabs').empty();
                        data.forEach(function (tablature) {
                            var $lvl = getDifficultyInLetters(tablature.lvlTab);
                            var $row = $('<tr>' +
                                '<td><a class="artistName" >' + tablature.nameArtist + '</a></td>' +
                                '<td>' + tablature.titleTab + '</td>' +
                                '<td>' + $lvl + '</td>' +
                                '<td>' + tablature.rateTab + '</td>' +
                                '</tr>');
                            $('#tabs').append($row);

                        });
                    }
                });

                $('#btnAddTab').click(function () {
                    var title = $('#addTitle').val();
                    var artist = $('#addArtist').val();
                    var lvl = $('#addLvl option:selected').val();
                    var capo = $('#addCapo').val();
                    var key = $('#addKey').val();
                    var tuning = $('#addTuning').val();
                    var tabBody = $('#addTablatureBody').val();
                    var link = $('#addLink').val();
                    get_data("../controller/addTab.php", addTab, {'addTitle' :title,'addArtist':artist , 'addLvl' :lvl, 'addCapo' :capo, 'addKey' :key, 'addTuning' :tuning, 'addTabBody' :tabBody, 'addLink' :link}, false);
                    function addTab(data) {
                        var message = "";
                        if (data == true) {
                            message = "<div class=\"alert alert-info\" role=\"alert\">" +
                                " Votre tablature est en cours d'approbation, elle sera visible si l'administrateur l'accepte.</div>";
                        }
                        else {
                            message = "<div class=\"alert alert-danger text-center\" role=\"alert\">" +
                                "Un problème est survenu </div>";
                        }
                        $('#tabTable').append(message);
                    }


                });
            });
        }

    });
</script>