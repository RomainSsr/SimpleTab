/**
 * @copyright dominique.aigroz@edu.ge.ch dario.gng@eduge.ch
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
                case 1:
                    displayMessage("Veuillez remplir les champs marqué d'un *",2); // erreur param
                    break;
                case 2 : // problème récup données
                case 3 : // problème encodage sur serveur
                default:
                    msg = data.Message;
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

function modifyTab(idTab)
{
    alert("modifie la tablature" + idTab);
}
function deleteTab(idTab)
{
    alert("supprime la tablature" + idTab);
}
