<?php
/**
 * Created by PhpStorm.
 * User: SAUSERR_INFO
 * Date: 11.05.2018
 * Time: 14:15
 */
?>
<!-- Modal Pop-up addUser() -->
<div class="modal fade" id="addUser" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content-->
        <div class="modal-content ">
            <div class="modal-header pb-0">
                <table>
                    <tr>
                        <td>
                            <h4 class="modal-title " style="text-align: left;">Inscription</h4>
                        </td>
                    </tr>
                    <tr>
                        <td> <small class="text-muted"> Les champs marqués d'un <label style="color: red;">*</label> sont obligatoires</small></td>
                    </tr>
            </table>


            </div>

            <div class="modal-body">
                <table class="col">
                    <tr>
                        <td> <label class="text-left">Nom  <label style="color: red;">*</label> : </label></td>
                        <td class="float-right"> <input type="text"  class=" emptyForbiddenField" id="name" style="resize: none;" autofocus ></td>
                    </tr>
                    <tr>
                        <td><label class="text-left">Prénom <label style="color: red;">*</label> : </label></td>
                        <td class="float-right"><input type="text"  class=" emptyForbiddenField" id="forename" style="resize: none;" ></td>
                    </tr>
                    <tr>
                        <td><label class="text-left">Pseudo<label style="color: red;">*</label> : </label></td>
                        <td class="float-right"><input type="text"  class=" emptyForbiddenField" id="pseudo" style="resize: none;" ></td>
                    </tr>
                    <tr>
                        <td><label class="text-left">Email <label style="color: red;">*</label> : </label></td>
                        <td class="float-right"><input type="text"  class=" emptyForbiddenField" id="email" style="resize: none;" ></td>
                    </tr>
                    <tr>
                        <td><label class="text-left">Mot de passe <label style="color: red;">*</label> : </label></td>
                        <td class="float-right"> <input type="password"  class=" emptyForbiddenField" id="password" style="resize: none;" ></td>
                    </tr>
                    <tr>
                        <td><label class="text-left">Retapez le mot de passe <label style="color: red;">*</label> : </label></td>
                        <td class="float-right"><input type="password"  class=" emptyForbiddenField" id="passwordConfirm" style="resize: none;" ></td>
                    </tr>
                    <tr>
                        <td colspan="2"><button style="color:red;" id="btnAddUser" type="button" class="btn btn-dark col">Rejoindre SimpleTab</button></td>
                    </tr>
                </table>
            </div>
            <!-- Modal footer-->
            <div class="modal-footer">
                <table class="col text-center">
                    <tr>
                        <td><label> Déjà inscrit ? </label></td>
                    </tr>
                    <tr>
                        <td>
                            <button type="button" class="btn btn-light" data-toggle="modal" data-target="#connectUser" onclick="hideModal()">Identifiez-vous !</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- END Modal -->


<!-- Modal Pop-up connectUser() -->
<div class="modal fade" id="connectUser" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header pb-0">

            <h4 class="modal-title " style="text-align: left;">Connexion</h4>
            </div>
            <div class="modal-body">
                <table class="col">
                    <tr>
                        <td> <label class="text-left">Pseudo ou email: </label></td>
                        <td class="float-right"> <input type="text"  class="mb-2  emptyForbiddenField" id="pseudoOrMail" style="resize: none;" autofocus></td>
                    </tr>
                    <tr>
                        <td><label class="text-left">Mot de passe: </label></td>
                        <td class="float-right"><input type="password"  class=" emptyForbiddenField" id="pwdConnexion" style="resize: none;" ></td>
                    </tr>
                    <tr >
                        <td colspan="2" ><button style="color:red;" id="btnIdentifyUser" type="button" class="btn btn-dark col mt-2">Connexion</button></td>
                    </tr>
                </table>
            </div>

        </div>
    </div>
</div>
<!-- END Modal -->

<!-- Modal Add Tab Form -->
<div class="modal fade " id="addTab" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" style="display: table;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header pb-0">

                <h4 class="modal-title " style="text-align: left;">Ajouter une tablature</h4>
            </div>
            <div class="modal-body">
                <table class="col">
                    <tr>
                        <td><label class="text-left">Titre: </label></td>
                        <td><label class="text-left">Auteur: </label></td>
                        <td><label class="text-left">Difficulté: </label></td>
                        <td><label class="text-left">Capo: </label></td>
                        <td><label class="text-left">Tonalité: </label></td>
                        <td><label class="text-left">Accordage: </label></td>
                    </tr>
                    <tr>
                        <td class="pr-2"> <input type="text"  class=" emptyForbiddenField" id="addTitle" style="resize: none;" autofocus></td>
                        <td class="pr-2"> <select type="text"  class=" emptyForbiddenField" id="addArtist" style="resize: none;" >
                            </select></td>
                        <td class="pr-2" style="display: inline"><select class="form-control" id="addLvl">
                                <option value="0">Facile</option>
                                <option value="1">Moyen</option>
                                <option value="2">Difficile</option>

                            </select></td>
                        <td class="pr-2"> <input type="text"  class=" emptyForbiddenField" id="addCapo" style="resize: none;" ></td>
                        <td class="pr-2"> <input type="text"  class=" emptyForbiddenField" id="addKey" style="resize: none;" ></td>
                        <td class="pr-2"> <input type="text"  class=" emptyForbiddenField" id="addTuning" style="resize: none;" value="E A D G B E"></td>
                    </tr>
                    <tr>
                        <td>Tablature</td>
                    </tr>
                    <tr>
                        <td colspan="6" ><textarea style="resize: vertical; height: 100%; width: 100%;" id="addTablatureBody"></textarea></td>
                    </tr>
                    <tr >

                        <td colspan="6" ><button style="color:red;" id="btnAddTab" type="button" class="btn btn-dark col mt-2">Ajouter</button></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- END Modal -->

<!-- Modal Modify Tab Form -->
<div class="modal fade bd-example-modal-lg" id="modifyTab" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" style="display: table;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header pb-0">

                <h4 class="modal-title " style="text-align: left;">Modifier une tablature</h4>
            </div>
            <div class="modal-body">
                <table class="col">
                    <tr>
                        <td> <label class="text-left">Titre: </label></td>
                        <td><label class="text-left">Auteur: </label></td>
                        <td><label class="text-left">Difficulté: </label></td>
                        <td><label class="text-left">Capo: </label></td>
                        <td><label class="text-left">Tonalité: </label></td>
                        <td><label class="text-left">Accordage: </label></td>
                    </tr>
                    <tr>
                        <td class="pr-2"> <input type="text"  class=" emptyForbiddenField" id="modifyTitle" style="resize: none;" autofocus></td>
                        <td class="pr-2"> <select type="text"  class=" emptyForbiddenField" id="modifyAuthor" style="resize: none;" >
                            </select></td>
                        <td class="pr-2"><select class="form-control" id="modifyLvl">
                                <option value="0">Facile</option>
                                <option value="1">Moyen</option>
                                <option value="2">Difficile</option>

                            </select></td>
                        <td class="pr-2"> <input type="text"  class=" emptyForbiddenField" id="modifyCapo" style="resize: none;" ></td>
                        <td class="pr-2"> <input type="text"  class=" emptyForbiddenField" id="modifyKey" style="resize: none;" ></td>
                        <td class="pr-2"> <input type="text"  class=" emptyForbiddenField" id="modifyTuning" style="resize: none;" ></td>
                    </tr>
                    <tr>
                        <td>Tablature</td>
                    </tr>
                    <tr>
                        <td colspan="6" ><textarea style="resize: vertical; height: 100%; width: 100%;" id="modifyTablatureBody"></textarea></td>
                    </tr>
                    <tr >

                        <td colspan="6" ><button style="color:red;" id="btnModifyTab" type="button" class="btn btn-dark col mt-2">Modifier</button></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- END Modal -->