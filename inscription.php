<?php
session_start();
require_once("includes/script.php");
?>

<!doctype html>
<html>
    <?php require_once("includes/head.php")?>
    <body>
        <?php require_once("includes/includes.php")?>
        <nav>
            <ul>
                <li><a href="femmes.php">FEMMES</a></li>
                <li><a href="hommes.php">HOMMES</a></li>
                <li><a href="tout.php">TOUT</a></li>
                <li><a href="vendre.php">VENDRE</a></li>
            </ul>
            <?php require_once("includes/nav.php")?>
        </nav>

        <div id="main">
            <h1>Inscription</h1>
            <?php
            if(isset($_SESSION['mail'])) {
              echo "<p>Vous êtes déjà connecté !</p>";
            } else {
              ?>
              <form action="inscription.php" method="post">
                <table>
                  <tr>
                    <td>Nom de famille :</td>
                    <td><input type="text" name="membre_nom"></td>
                  </tr>
                  <tr>
                    <td>Prénom :</td>
                    <td><input type="text" name="membre_prenom"></td>
                  </tr>
                  <tr>
                    <td>Choisissez un pseudo :</td>
                    <td><input type="text" name="membre_pseudo"></td>
                  </tr>
                  <tr>
                    <td>Adresse complète :</td>
                    <td><input type="text" name="membre_adresse"></td>
                  </tr>
                  <tr>
                    <td>Mail :</td>
                    <td><input type="email" name="membre_mail"></td>
                  </tr>
                  <tr>
                    <td>Choisissez un mot de passe :</td>
                    <td><input type="password" name="membre_MDP_1"></td>
                  </tr>
                  <tr>
                    <td>Confirmez votre mot de passe :</td>
                    <td><input type="password" name="membre_MDP_2"></td>
                  </tr>
                  <tr>
                    <td><button>Valider</button></td>
                    <td><button>Annuler</button></td>
                  </tr>
                </table>
              </form>
              <?php
            }
            ?>
        </div>

    </body>
</html>
