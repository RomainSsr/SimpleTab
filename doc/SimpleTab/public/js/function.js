/**
 * @copyright dominique.aigroz@edu.ge.ch dario.gng@eduge.ch romain.ssr@eduge.ch
 * Effectue un appel ajax et exécute une fonction en cas de succès
 * @param string url        Le chemin vers le fichier qui va récupérer nos données
 * @param string callback   Le nom de la fonction à exécuter après avoir reçu les données. Il ne faut pas mettre de parenthèses
 * @param object params     Object qui contient tout les paramètres à envoyer
 * @param boolean async		Pour activer / désactiver l'asynchrone d'un appel ajax
 */

function get_data(url, callback, params = {}, async) {
    // Copier l'objet params dans une variable locale
    // qui sera simplement utilisées pour l'appel Ajax
    var dp = params;
    // On utilise le paramètre de la fonction qui est stocké sur le stack
    // pour créer un tableau qui contient les paramètres additionnels qui se
    // trouvent après params.
    // Si on stocke ces paramètres dans un tableau créé dans cette function,
    // il sera détruit après l'appel Ajax et on aura plus rien lorsqu'on sera
    // rappelé de manière asynchrone.
    params = Array();
    for (var i = 4; i < arguments.length; i++){
        params.push(arguments[i]);
    }
    $.ajax({
        method: 'POST',
        url: url,
        data: dp,
        dataType: 'json',
        async : async,
        success: function (data) {
            var msg = '';

            switch (data.ReturnCode){
                case 0 : // tout bon
                    // On récupère par params, notre tableau des arguments.
                    params.unshift(data.Data);
                    callback.apply(this, params);
                    break;
                case 1: // erreur param
                    alert("Veuillez remplir tous les champs correctement");
                    break;
                case 2 : // problème récup données
                    alert("Un problème est survenu");
                case 3 : // problème encodage sur serveur
                    alert("Un problème est survenu");

                default:

                    break;
            }
        },
        error: function(jqXHR){
            // Votre gestion de l'erreur
        }
    });
}

/**
 * Retourne le niveau de la tablature en toute lettres : 0 -> facile ;  1 -> moyen ; 2 -> difficile
 * @param $lvlNumber -> le niveau de la tablature en chiffre
 */
function getDifficultyInLetters($lvlNumber)
{
    switch ($lvlNumber)
    {
        case "0":
            return "Facile";
            break;
        case "1":
            return "Moyen";
            break;

        case "2":
            return "Difficile";
            break;

    }
}

/**
 * Envoie l'id d'une tablature à la fonction getInfoTab
 * @param idTab
 */
function passTabIdToGetInfosTab(idTab)
{
    get_data("../controller/getInfosTab.php",getInfosTab,{'idTab' : idTab},true);
    function getInfosTab(data)
    {
        if(data != false)
        {
            if($.isEmptyObject(data.metadata.capo))
            {
                data.metadata.capo = "";
            }
            if($.isEmptyObject(data.metadata.key))
            {
                data.metadata.key = "";
            }
            lvlNumber = getDifficultyInNumber(data.metadata.lvl);
            $('#modifyTitle').val(data.metadata.title);
            $('#modifyAuthor').val(data.metadata.author);
            $('#modifyLvl select').val(data.metadata.level);
            $('#modifyCapo').val(data.metadata.capo);
            $('#modifyKey').val(data.metadata.key);
            $('#modifyTuning').val(data.metadata.tuning);
            $('#modifyTablatureBody').val(data.corpse);

        }
    }
}

/**
 * Supprime la tablature par son id et rafraichît le tableau des tablatures de l'utilisateur
 * @param idTab
 * @param idUser
 */
function deleteTabById(idTab, idUser)
{
    if(confirm("Voulez-vous vraiment supprimer la tablature ?")) {
        get_data("../controller/deleteTabById.php", deleteTabById, {'idTab': idTab}, true);

        function deleteTabById(data) {
            var message = "";
            if (data == true) {
                message = "<div class=\"alert alert-success text-center\" role=\"alert\">" +
                    " Votre tablature a bien été suprimée.</div>";
            }
            else {
                message = "<div class=\"alert alert-danger text-center\" role=\"alert\">" +
                    "Un problème est survenu </div>";
            }
            $('#message').append(message);
            alert('la tablature a été bien supprimée');
            reloadTabByUSers(idUser);

        }
    }
}

/**
 * Quand l'adinistrateur refuse une tablature, elle est supprimée ainsi que la tablature au format XML
 * @param idTab
 */
function refuseTab(idTab)
{
    get_data("../controller/deleteTabById.php",deleteTabById,{'idTab' : idTab},true);
    function deleteTabById(data)
    {
        var message = "";
        if (data == true) {
            alert('la tablature a été refusée');
            getAllNonApprouvedTabs();

        }
        else {
            alert('un problème est survenu');

        }

    }
}

/**
 * Quand l'adinistrateur accepte une tablature, son champ approuved passe à 1. La tablature devient consultable par tous.
 * @param idTab
 */
function accepTab(idTab)
{
    get_data("../controller/approuveTab.php",approuveTab,{'idTab' : idTab},true);
    function approuveTab(data)
    {
        var message = "";
        if (data == true)
        {
            alert('la tablature a été approuvée');
            getAllNonApprouvedTabs();

        }
        else
        {
            alert('un problème est survenu');
        }

    }
}

/**
 * rafraichît le tableau des tablatures postées par l'utilisateurs par leur ID
 * @param idUser
 */
function reloadTabByUSers(idUser)
{
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
                '<td style="width:1%;"><button  class="btn btn-dark border-0" style="background-color: #20262b;" onclick="deleteTabById(' + tablature.idTab + ','+idUser+')"><i class="fas fa-trash-alt"></i></button></td>' +
                '<td style="width:1%;"><button class="btn btn-dark border-0" data-toggle="modal" data-target="#modifyTab" style="background-color: #20262b;" onclick="passTabIdToGetInfosTab(' + tablature.idTab + ')"><i class="fas fa-pencil-alt"></i></button></td>' +
                '</tr>');
            $('#tabs').append(tr);


            $(artist).click(function () {
                var artistName = $(this).text();
                get_data("../controller/getTabByArtist.php", getTabByArtist, {'artistName': artistName}, true);

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


        });
    }
}

/**
 * Récupère toutes les tablatures non approuvée (champs approuved = 0)
 */
function getAllNonApprouvedTabs()
{
    get_data("../controller/getAllNonApprouvedTab.php",getAllNonApprouvedTab,{},true);
    function getAllNonApprouvedTab(data) {
        $('#tabs').empty();
        data.forEach(function (tablature) {
            var artist = tablature.nameArtist;
            var td = $("<td>").append(artist);
            var lvl = getDifficultyInLetters(tablature.lvlTab);
            var tr = $("<tr>").append(td);
            $(tr).append(
                '<td><a class="titleTab">'+tablature.titleTab+'</a></td>' +
                '<td>' + lvl + '</td>' +
                '<td>' + tablature.rateTab + '</td>' +
                '<td style="width:1%;"><button  class="btn btn-dark border-0" style="background-color: #20262b;" onclick="accepTab(' + tablature.idTab +')"><i class="fas fa-check"></i></button></td>' +
                '<td style="width:1%;"><button class="btn btn-dark border-0"  style="background-color: #20262b;" onclick="refuseTab(' + tablature.idTab + ')"><i class="fas fa-times"></i></button></td>' +
                '</tr>');
            $('#tabs').append(tr);


            $('.titleTab').click(function () {
                var titleTab = $(this).text();
                get_data("../controller/getTabByTitle.php",getTabByTitle,{'titleTab':titleTab},true);
                function getTabByTitle(data) {
                    data.forEach(function(tablature) {
                        window.location.href= "../view/tablaturePage.php?idTab="+tablature.idTab;
                    });
                }
            });
        });
    }
}

/**
 * Récupère les utilisateurs et le nombre de tablatures qu'ils ont posté
 */
function getUsersAndNbTabPosted()
{
    get_data("../controller/getUsersAndNbTabPosted.php",getUsersAndNbTabPosted,{},true);
    function getUsersAndNbTabPosted(data) {
        $('#users').empty();
        data.forEach(function (user) {
            var pseudo =  user.pseudoUser;
            var email = user.emailUser;
            var nbTab = user.nbTab;
            var tr = $("<tr>");
            $(tr).append(
                '<td>' + pseudo + '</td>' +
                '<td>' + email + '</td>' +
                '<td>' + nbTab + '</td>' +
                '<td style="width:1%;"><button class="btn btn-dark border-0"  style="background-color: #20262b;" onclick="deleteUserById(' + user.idUsers + ')"><i class="fas fa-trash-alt"></i></button></td>' +
                '</tr>');
            $('#users').append(tr);
        });
    }
}

/**
 * Supprime la tablatures à partir d'un ID
 * @param idUser
 */
function deleteUserById(idUser)
{
    if(confirm("Voulez-vous vraiment supprimer l'utilisateur ?")) {
        get_data("../controller/deleteUserById.php", deleteUserById, {'idUser': idUser}, true);

        function deleteUserById(data) {
            var message = "";
            if (data == true) {
                alert("l'utilisateur a été supprimé avec succès");
                getAllNonApprouvedTabs();
                getUsersAndNbTabPosted();

            }
            else {
                alert('un problème est survenu');

            }

        }
    }
}

function updateTabRate()
{
    get_data("../controller/deleteUserById.php",deleteUserById,{'idUser' : idUser},true);

}

/**
 * Renvoie la difficulté d'une tablature en toute lettres depuis un chiffre
 * @param $lvlInLetter
 * @returns le chiffre correspondant à la difficulté
 */
function getDifficultyInNumber($lvlInLetter)
{
    $lvl = $.trim($lvlInLetter);
    switch ($lvl)
    {
        case "Facile":
            return 0;
            break;
        case "Moyen":
            return 1;
            break;
        case "Difficile":
            return 2;
            break;
    }

}

function identifyUser(pseuoOrMail,password)
{

    get_data("../controller/identifyUser.php",identifyUser,{'mailOrPseudo' :pseuoOrMail, 'pwdConnexion' : password},true);
    function identifyUser(data) {
        if(data.length != 0)
        {
            data.forEach(function(user) {
                location.reload();
            });
        }
        else
        {
            alert("l'utilisateur n'existe pas ou le mot de passe est incorrect")
            get_data("../controller/destroySession.php",destroySession,{},true);
            function destroySession(data)
            {

            }
        }

    }
}