/**
 * @copyright ronaldo.lrrpnt@eduge.ch && floran.stck@eduge.ch
 */

/**
 * Récupère la valeur d'une clé dans l'url
 * @param key La clé pour laquelle on veut récupérer la valeur.
 * @remark 	Provient de GitHub https://gist.github.com/varemenos/2531765
 * 			@varemenosvaremenos/getparam.js
 *
 */
function getUrlVar(key){
	var result = new RegExp(key + "=([^&]*)", "i").exec(window.location.search); 
	return result && unescape(result[1]) || ""; 
}

function modifyTab(idTab) {
    alert("modifie la tablature" + idTab);
}
function deleteTab(idTab) {
    alert("supprime la tablature" + idTab);
}

function hidePopup() {
    // on fait disparaître le popup
	$('#myModal').hide();
	$('.modal-backdrop').hide();

}
$('#logo').click(function (){
    $("#message").slideDown(500); // use slide down for animation
    setTimeout(function () {
        $("#message").slideUp(500);
    }, 2000);
});

function displayMessage(message,statut)
{
	var div = $("#message");
	switch (statut) {
		case 0:
			if($(div).css("display", "none")) 
			{
			  $(div).attr('class','alert alert-success');
			  $(div).fadeIn(750);
			  $(div).html(message);
			  $(div).css("display", "inline");
			  $(div).fadeOut(3250);
			  $('html, body').animate({scrollTop: '0px'}, 300);
			} 
			else 
			{
			  $(div).css("display", "none");
			}
		break;
		
		case 1:
			if($(div).css("display", "none")) 
			{	
				$(div).attr('class','alert alert-danger');
				$(div).fadeIn(750);
				$(div).html('<span class="glyphicon glyphicon-remove"></span> ' + message);
				$(div).css("display", "inline");
				$('html, body').animate({scrollTop: '0px'}, 300);
				$(div).fadeOut(5250);
			    setTimeout(function(){}, 6000);
	
			 } 
			 else 
			 {
				 $(div).css("display", "none");
			 }
		break;
	}
}

/* 
 * Crée une message box (modal) 
 * @param message Le message à afficher
 */
function msgBox(message)
{
	var modal = '<section class="modal fade" id="msgBox" role="dialog"><section class="modal-dialog"><section class="modal-content">';
	
	var body = '<section class="modal-body">';
	body += '<p class="alert alert-warning"><span class="glyphicon glyphicon-exclamation-sign"></span> <b>Attention, </b>' + message + '</p></section>';
	
	var footer =  '<section class="modal-footer">';
	footer += '<button type="button" class="btn btn-danger btn-sm" id="Cancel" style="float: left;">Annuler</button>';
	footer += '<button  type="button" class="btn btn-success btn-sm" id="OK" style="float: right;">OK</button></section></section>';
	
	modal += body + footer + '</section></section>';
	
	$('body').append(modal);
}

/* Efface la message box */
function removeMsgBox()
{
	$('#msgBox').modal("hide");
	$('#msgBox').remove();
	$('.modal-backdrop').remove();
	$('body').removeClass('modal-open');
	$('body').attr("style", "");
}

function identifyUser(pseuoOrMail,password)
{

    get_data("../controller/identifyUser.php",identifyUser,{'mailOrPseudo' :pseuoOrMail, 'pwdConnexion' : password},true);
    function identifyUser(data) {
        data.forEach(function(user) {
            location.reload();
        });
    }
}
