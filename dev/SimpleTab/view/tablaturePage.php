<?php
/**
 * Created by PhpStorm.
 * User: SAUSERR_INFO
 * Date: 17.05.2018
 * Time: 09:29
 */
session_start();

require_once "../view/modals.php";

if(isset($_SESSION['user']))
{
  $userId =  $_SESSION['user'][0]['idUsers'];
  $pseudoUSer = $_SESSION['user'][0]['pseudoUser'];
}

if(isset($_GET['idTab']))
{
    $idTab = $_GET['idTab'];
    include "../tabs/".$idTab.".php";
    $tabs = new SimpleXMLElement($xmlstr);

    $idTab = $_GET['idTab'];
    $title =$tabs->metadata->title;
    $nameArtist =$tabs->metadata->author;
    $tuning = $tabs->metadata->tuning;
    $capo =$tabs->metadata->capo;
    $key =$tabs->metadata->key;
    $lvl =$tabs->metadata->level;
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
                <td> $nameArtist</td>
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
               
            </tr>
        </table>
    </div>
   <div class='border-top' id='commentSection'>
    <table class='col'>
   <tr>
            <td colspan='2' id='Score' class='text-right'><i id='1' class='far fa-star rateStar'></i><i id='2' class='far fa-star rateStar'></i><i id='3' class='far fa-star rateStar'></i><i id='4' class='far fa-star rateStar'></i><i id='5' class='far fa-star rateStar'></i></td>
        </tr>
            <td colspan='2' id=\"averageScore\" class='text-right'> note moyenne : </td>
        </tr>
        <tr id='comments'>
            <td colspan='2'>Commentaire :</td>
        </tr>
        <tr id='addComment'>
            <td colspan='2'><textarea style='width: 100%;' id='myComment' placeholder='Que pensez-vous de cette tablature ?'></textarea><button style='float: right; display: inline;' id='postComment'>Soumettre</button></td>
        </tr>
    </table>
</div>
</div>

";




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
        $navMenu2 = "<h5><a class=\"nav-link\" href=\"../view/tablatureAndUserManagerPage.php\">Gestion des tablatures et utilisateurs </a></h5>";
    }
}
else
{
    $navIdOrButton = "<button type=\"button\" class=\"btn btn-light\" data-toggle=\"modal\" data-target=\"#addUser\">S'inscrire</button> | <button type=\"button\" class=\"btn btn-light\"data-toggle=\"modal\" data-target=\"#connectUser\">S'identifier</button>";
    $navMenu1 = "<h5><a class=\"nav-link\" href=\"../view/homePage.php\">Accueil <span class=\"sr-only\">(current)</span></a></h5>";
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
<?php echo $body; ?>
<script src="../js/function.js"></script>
<script type="text/javascript">
    $( document ).ready(function() {
        var idTab = <?php echo $_GET['idTab'];?>;
        var idUserComment = <?php if(isset($userId)){echo $userId;}else{echo -1;} ?>;
        var idTabComment = <?php  if(isset($idTab)){echo $idTab;}else{echo -1;}?>;
        var pseudoUser = "<?php if(isset($pseudoUSer)){echo $pseudoUSer;}else{echo "";} ?>";
        get_data("../controller/getCommentsByTab.php",getCommentsByTab,{'idTab': idTab},true);
        function getCommentsByTab(data) {
            data.forEach(function (comment) {
                $('#comments').after('<tr class="border-top p-1 m-1"><td ><label><b>'+comment.pseudoUser+': </b></label><label> '+comment.contentComment+'</label></td></tr>')
            });
        }

        get_data("../controller/getRateByTabId.php",getRateByTabId,{'idTab': idTab},true);
        function getRateByTabId(data)
        {
            data.forEach(function (rate) {
                if (rate.users_idUsers == idUserComment) {
                    $('#Score').text("Vous avez attribué la note de " + rate.rate );
                }
            });
        }

        get_data("../controller/getTabById.php",getTabById,{'idTab': idTab},true);
        function getTabById(data) {
            data.forEach (function (tab) {
                if(tab.rateTab > 0)
                {
                    $('#averageScore').text("note moyenne : "+tab.rateTab);
                }
                else
                {
                    $('#averageScore').text("La tablature n'est pas notée");
                }
            });


        }



        $('#postComment').click(function () {


            var contentComment = $('#myComment').val();


            if(idUserComment != -1 && idTabComment != -1)
            {
            get_data("../controller/addComment.php", addComment, {
                'contentComment': contentComment,
                'idTabComment': idTabComment,
                'idUserComment': idUserComment
            }, true);

            function addComment(data) {

                if (data == true && userPseudo != "") {
                    alert("votre commentaire a bien été enregistré !");
                }
                else {
                    alert("un problème est survenu");
                }
            }
            }
            else
            {
                alert("vous devez être connecté pour laisser une appréciation");
            }
        });

        $('#btnAddUser').click(function () {
            var name = $('#name').val();
            var forename = $('#forename').val();
            var password = $('#password').val();
            var passwordConfirm = $('#passwordConfirm').val();
            var email = $('#email').val();
            var pseudo = $('#pseudo').val();
            get_data("../controller/addUser.php",addUser,{'name' :name, 'forename' : forename, 'password' : password,  'email' : email, 'pseudo' : pseudo, 'passwordConfirm' : passwordConfirm},true);
            function addUser(data){
                identifyUser(pseudo,password);
                $('#addUser').modal('hide');

            }
        });

        $('#btnIdentifyUser').click(function () {
            var mailOrPseudo = $('#pseudoOrMail').val();
            var pwdConnexion = $('#pwdConnexion').val();
            identifyUser(mailOrPseudo,pwdConnexion);
            $('#connectUser').modal('hide');

        });

        $('.rateStar').mouseenter(function () {
            for(i = $(this).attr('id');i>=1;i--)
            {
                $('#'+i).removeClass("far fa-star");
                $('#'+i).addClass("fas fa-star");
            }


        });
        $('.rateStar').mouseleave(function () {
            $(this).removeClass("fas fa-star");
            $(this).addClass("far fa-star");
        });

        $('.rateStar').click(function () {

            if(idUserComment != -1) {
                var rate = $(this).attr('id');

                get_data("../controller/addRate.php", addRate, {
                    'idUser': idUserComment,
                    'idTab': idTab,
                    'rate': rate
                }, true);

                function addRate(data) {
                    if (data == true && pseudoUser != "") {

                        alert("votre note a bien été enregistrée !");
                        location.reload();
                    }
                    else {
                        alert("un problème est survenu");
                    }
                }
            }
            else
            {
                alert("vous devez être connecté pour laisser une appréciation");
            }
        });

    });
</script>
