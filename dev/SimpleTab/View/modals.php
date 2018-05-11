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
                        <td class="float-right"> <input type="text"  class=" emptyForbiddenField" id="domainDescription" style="resize: none;" autofocus></td>
                    </tr>
                    <tr>
                        <td><label class="text-left">Prénom <label style="color: red;">*</label> : </label></td>
                        <td class="float-right"><input type="text"  class=" emptyForbiddenField" id="domainDescription" style="resize: none;" ></td>
                    </tr>
                    <tr>
                        <td><label class="text-left">Pseudo<label style="color: red;">*</label> : </label></td>
                        <td class="float-right"><input type="text"  class=" emptyForbiddenField" id="domainDescription" style="resize: none;" ></td>
                    </tr>
                    <tr>
                        <td><label class="text-left">Email <label style="color: red;">*</label> : </label></td>
                        <td class="float-right"><input type="text"  class=" emptyForbiddenField" id="domainDescription" style="resize: none;" ></td>
                    </tr>
                    <tr>
                        <td><label class="text-left">Mot de passe <label style="color: red;">*</label> : </label></td>
                        <td class="float-right"> <input type="text"  class=" emptyForbiddenField" id="domainDescription" style="resize: none;" ></td>
                    </tr>
                    <tr>
                        <td><label class="text-left">Retapez le mot de passe <label style="color: red;">*</label> : </label></td>
                        <td class="float-right"><input type="text"  class=" emptyForbiddenField" id="domainDescription" style="resize: none;" ></td>
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
                        <td colspan="2" ><button style="color:red;" id="btnAddUser" type="button" class="btn btn-dark col mt-2">Connexion</button></td>
                    </tr>
                </table>
            </div>

        </div>
    </div>
</div>
<!-- END Modal -->
<script type="text/javascript">
    function hideModal() {
        $('#addUser').modal('hide')
    }

</script>