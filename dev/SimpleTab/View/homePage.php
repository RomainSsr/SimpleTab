<?php
/**
 * Created by PhpStorm.
 * User: SAUSERR_INFO
 * Date: 09.05.2018
 * Time: 16:09
 */

require_once"modals.php";
require_once"../Model/func.inc.php";

$tabs = getTabAndRelatedArtist();
$navIdOrButton = "<button type=\"button\" class=\"btn btn-light\" data-toggle=\"modal\" data-target=\"#addUser\">S'inscrire</button> | <button type=\"button\" class=\"btn btn-light\"data-toggle=\"modal\" data-target=\"#connectUser\">S'identifier</button>";
$navMenu = "<h5><a class=\"nav-link\" href=\"#\">Accueil <span class=\"sr-only\">(current)</span></a></h5>";
?>
<! DOCTYPE HTML>
<html>
<head>
    <title>Home</title>
    <script            src="https://code.jquery.com/jquery-3.3.1.js"            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="             crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <!-- JQuery CDN -->
</head>
<body>
<div class="border ">
    <div class=".col text-right mr-3 mb-0"> <?php echo $navIdOrButton;?>

    <div id="body" class=" mx-5">
<nav class="navbar navbar-expand-lg navbar-light bg-light p-0">
    <a class="navbar-brand" href="#">
        <img src="../public/images/logoSimpleTabGrand.png" alt="logo" width="215" height="125">
    </a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto " style="margin: auto;">
            <li class="nav-item active">
                <?php echo $navMenu?>
            </li>
        </ul>

        <form class="form-inline my-2 my-lg-0">
            <table>
                <tr>
                    <td>

                    </td>
                </tr>
                <tr>
                    <td>
                        <input class="form-control mr-0" type="radio" name="requirement" checked value="Titre"> Titre
                        <input class="form-control ml-4" type="radio" name="requirement" value="Artiste"> Artiste
                    </td>
                </tr>
                <tr>
                    <td>
                        <input class="form-control mr-sm-0" type="search" placeholder="Rechercher" aria-label="Search">
                        <button class="btn btn-outline-secondary " type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</nav>
</div>
</div>
</div>
<div class=" m-5">
    <table class="table table-dark">
        <thead style="color:red">
        <tr>
            <th scope="col">Artiste</th>
            <th scope="col">Titre</th>
            <th scope="col">Difficulté</th>
            <th scope="col">Note</th>
        </tr>
        </thead>
        <tbody>

            <?php
            for($i=0;$i < count($tabs);$i++)
            {
                echo "<tr>
                  <td><a id='artistName'>".$tabs[$i]['nameArtist']."</a></td>
                  <td>".$tabs[$i]['titleTab']."</td>
                  <td>".getDifficultyInLetters($tabs[$i]['lvlTab'])."</td>
                  <td>".$tabs[$i]['rateTab']."/5</td>
                  </tr>";
            }


?>

        </tbody>
    </table>

</div>
</body>
<script src="../js/function.js"></script>
<script type="text/javascript">
$('artistName').click(function () {
    
})    