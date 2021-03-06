<?php

include "header.php";
require_once "conf.inc.php";
require_once "functions.php";

if (isConnected()) {
    if (!empty($_SESSION["token"])) {
        $db = connectDB();
        $query = $db->prepare("SELECT member_lastname, member_firstname, member_email,member_address, member_zip_code 
                                        FROM member 
                                        WHERE member_id = :id AND member_token = :token;");
        $query->execute([
            "id" => $_SESSION["id"],
            "token" => $_SESSION["token"]
        ]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
    }
    ?>
    <div class="container">
        <div id="profile-picture" class="">
            <img class="profile-picture" src="img/paris1.jpg" alt="profile picture">
            <br>
            <button style="margin-top: 15px" class="btn btn-primary">Modifier</button>
        </div>
    </div>

    <div class="container container-fluid">
        <div id="information">
            <h2>Changer vos informations</h2>
            <div class="mr-auto ml-auto">
                <form method="POST" action="script/updateUser.php">
                    <table class="mr-auto ml-auto">
                        <tr>
                            <td>
                                <?php
                                if (isset($_SESSION["errorFormInfo"])) {
                                    foreach ($_SESSION["errorFormInfo"] as $keyError) {
                                        echo "<li style = 'color:red'>" . $listOfErrorsInfo[$keyError] . "</li>";
                                    }
                                    unset($_SESSION["errorFormInfo"]);
                                } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group ml-auto mr-auto">
                                    <label for="lastname">Nom</label>
                                    <input type="text" class="form-control" name="lastname"
                                           value="<?php echo $result["member_lastname"] ?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group ml-auto mr-auto">
                                    <label for="firstname">Prénom</label>
                                    <input type="text" class="form-control" name="firstname"
                                           value="<?php echo $result["member_firstname"] ?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group ml-auto mr-auto">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email"
                                           value="<?php echo $result["member_email"] ?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group ml-auto mr-auto">
                                    <label for="address">Adresse</label>
                                    <input type="text" class="form-control" name="address"
                                           value="<?php echo $result["member_address"] ?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group ml-auto mr-auto">
                                    <label for="zipcode">Code postal</label>
                                    <input type="text" class="form-control" name="zipcode"
                                           value="<?php echo $result["member_zip_code"] ?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="submit" style="margin-top: 10%; margin-bottom: 10%"
                                        class="btn btn-primary">
                                    Actualiser le profil
                                </button>
                            </td>
                        </tr>
                    </table>
                    <?php unset($_SESSION['postFormInfo']); ?>
                </form>
            </div>
            <div id="password">
                <h2>Changer votre mot de passe</h2>
                <div class="mr-auto ml-auto">
                    <form method="POST" action="script/changePwd.php">
                        <table class="ml-auto mr-auto">
                            <tr>
                                <td>
                                    <?php
                                    if (isset($_SESSION["errorFormPwd"])) {
                                        foreach ($_SESSION["errorFormPwd"] as $keyError) {
                                            echo "<li style = 'color:red'>" . $listOfErrorsPwd[$keyError] . "</li>";
                                        }
                                        unset($_SESSION["errorFormPwd"]);
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group ml-auto mr-auto">
                                        <label>MOT DE PASSE ACTUEL</label>
                                        <input type="password" class="form-control" name="oldPwd">

                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group ml-auto mr-auto">
                                        <label>NOUVEAU MOT DE PASSE</label>
                                        <input type="password" class="form-control" name="newPwd">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group ml-auto mr-auto">
                                        <label>CONFIRMER MOT DE PASSE</label>
                                        <input type="password" class="form-control" name="confirmNewPwd">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button type="submit" style="margin-top: 7%; margin-bottom: 10%"
                                            class="btn btn-primary">Changer le mot de passe
                                    </button>
                                </td>
                            </tr>
                        </table>
                        <?php unset($_SESSION['postFormPwd']); ?>
                    </form>
                </div>
            </div>
            <div id="delete">
                <h2>Supprimer son compte</h2>
                <div class="mr-auto ml-auto">
                    <!-- Button trigger modal -->
                    <button type="button" style="margin-top: 3%; margin-bottom: 5%" class="btn btn-danger"
                            data-toggle="modal" data-target="#exampleModalCenter">
                        Supprimer le compte
                    </button>

                    <!-- POP-UP DELETE ACCOUNT -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Supprimer le compte</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Toutes données vous concernant seront définitivement perdues.<br>
                                    Êtes-vous sûr de vouloir supprimer votre compte?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler
                                    </button>
                                    <a href="script/delete-account.php">
                                        <button type="button" class="btn btn-danger">Supprimer</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
} else {
    $_SESSION["previousLocation"] = "userSettings.php";
    $_SESSION["connexionNeeded"] = "Vous devez être connecter pour accéder à cette page";
    include "signup.php";
}

include_once "footer.php";

?>
