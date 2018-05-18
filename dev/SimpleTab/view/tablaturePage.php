<?php
/**
 * Created by PhpStorm.
 * User: SAUSERR_INFO
 * Date: 17.05.2018
 * Time: 09:29
 */
session_start();

if(isset($_SESSION['user']))
{
  $userId =  $_SESSION['user'][0]['idUsers'];
}

if(isset($_GET['idTab']))
{
    $idTab = $_GET['idTab'];
    include "../tabs/".$idTab.".php";
    $tabs = new SimpleXMLElement($xmlstr);

    $idTab = $_GET['idTab'];
    $title =$tabs->metadata->title;
    $author =$tabs->metadata->author;
    $tuning = $tabs->metadata->tuning;
    $capo =$tabs->metadata->capo;
    $key =$tabs->metadata->key;
    $lvl =$tabs->metadata->level;
    $link = $tabs->metadata->link;
    $bodyTab = $tabs->corpse;

    $body = "<div id='tab' class='p-3 border' style='display: table; margin:0 auto;'>
    <div id='metadatas' >
        <table>
            <tr>
                <td> Titre :</td>
                <td>$title </td>
            </tr>
            <tr>
                <td> Auteur :</td>
                <td> $author</td>
            </tr>
            <tr>
                <td> Accordage :</td> 
                <td> $tuning</td>
            </tr>
            <tr>
                <td> Capo :</td> 
                <td>$capo </td>
            </tr>
            <tr>
                <td> Tonalité :</td> 
                <td> $key</td>
            </tr>
            <tr>
                <td> Difficulté :</td> 
                <td>$lvl </td>
            </tr>
        </table>
    </div>
    <div id='tabBody' >
        <table>
            <tr>
                <td>
                    <pre>$bodyTab </pre>
                </td>
                <td valign=\"bottom\">
                    <iframe width='400' height='250' style='float: right;' src= '$link'>
                    </iframe>
                </td>
            </tr>
        </table>
    </div>
   
</div>

<div class='p- 3 border' style='margin:0 auto;' id='commentSection'>
    <table>
     <tr>
            <td id='rating'> 5/5</td>
        </tr>
        <tr>
            <td id='comments'>Commentaire :</td>
        </tr>
        <tr id='addComment'>
            <td><textarea id='myComment' placeholder='Que pensez-vous de cette tablature ?'></textarea></td><td><button id='postComment'>Soumettre</button></td>
        </tr>
    </table>
</div>";




}
else
{
    $body = "<div class=\"alert alert-danger text-center\" role=\"alert\">
                Aucune Tablature sélectionée, veuillez retourner à <a class=\"alert-link\" href='../view/homePage.php '>la page d'Accueil</a> et cliquez sur le titre pour sélectionner une tablature. 
            </div>";
}

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
        if($_SESSION['user'][0]['role_idrole'] == 0)
        {
            $navMenu1 = "<h5><a class=\"nav-link\" href=\"../view/homePage.php\">Accueil <span class=\"sr-only\">(current)</span></a></h5>";
            $navMenu2 = "<h5><a class=\"nav-link\" href=\"../view/tablatureManagerPage.php\">Gestion des tablatures </a></h5>";
        }
        elseif($_SESSION['user'][0]['role_idrole'] == 1)
        {
            $navMenu1 ="<h5><a class=\"nav-link\" href=\"../view/homePage.php\">Accueil <span class=\"sr-only\">(current)</span></a></h5>";
            $navMenu2 = "<h5><a class=\"nav-link\" href=\"#\">Gestion des tablatures et utilisateurs </a></h5>";
        }
    }
    else
    {
        $navIdOrButton = "<button type=\"button\" class=\"btn btn-light\" data-toggle=\"modal\" data-target=\"#addUser\">S'inscrire</button> | <button type=\"button\" class=\"btn btn-light\"data-toggle=\"modal\" data-target=\"#connectUser\">S'identifier</button>";
        $navMenu1 = "<h5><a class=\"nav-link\" href=\"#\">Accueil <span class=\"sr-only\">(current)</span></a></h5>";
    }


?>

<! DOCTYPE HTML>
<html>
<head>
    <title>Page d'une tablature</title>
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
<?php echo $body; ?>
<script src="../js/function.js"></script>
<script src="../js/utilities.js"></script>
<script type="text/javascript">
    $( document ).ready(function() {
        var idTab = <?php echo $_GET['idTab'];?>;
        get_data("../controller/getCommentsByTab.php",getCommentsByTab,{'idTab': idTab},true);
        function getCommentsByTab(data) {
            data.forEach(function (comment) {
                $('#comments').append(comment.contentComment);
            });
        }
        $('#postComment').click(function () {
            var idUserComment = <?php echo $userId;?>;
            var idTabComment = <?php echo $idTab;?>;
            var contentComment = $('#myComment').val();
            get_data("../controller/addComment.php", addComment, {
                'contentComment': contentComment,
                'idTabComment': idTabComment,
                'idUserComment': idUserComment
            }, true);

            function addComment(data) {
                var message = "";
                if (data == true) {
                    message = "<div class=\"alert alert-info\" role=\"alert\">" +
                        " Votre commentaire est en cours d'approbation, il sera visible si l'administrateur l'accepte.</div>";
                }
                else {
                    message = "<div class=\"alert alert-danger text-center\" role=\"alert\">" +
                        "Un problème est survenu </div>";
                }
                $('#commentSection').append(message);
            }
        });
    });
</script>
