<?php
session_start();
require_once("includes/script.php");
require_once("fonctions_panier.php");
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

        <div id="main" class="conMain">
            <h3>Connexion</h3>
            <form method="post" action="connexion.php">
              <table>
                <tr>
                  <td>Mail : </td>
                  <td><input type="text" class="text"name="mail"></td>
                </tr>
                <tr>
                  <td>Mot de passe : </td>
                  <td><input type="password" name="mdp"></td>
                </tr>
                <tr>
                  <td></td>
                  <td><input type="submit" class="button" name="envoi" value="Connexion"></td>
                </tr>
                <tr>
                  <td>Pas encore membre ?</td>
                  <td><a href="inscription.php">Inscrivez-vous !</a></td>
                </tr>
              </table>
            </form>
            <?php
            if (isset($_POST['envoi']) AND isset($_POST['mail']) AND isset($_POST['mdp']) AND !empty($_POST['mail']) AND !empty($_POST['mdp'])) {
              $mail_con = htmlspecialchars($_POST['mail']);
              $mdp_con = sha1($_POST['mdp']);
              $requete = $bdd->query('SELECT * FROM membres WHERE membre_mail = "'.$mail_con.'" AND membre_mdp = "'.$mdp_con.'"')->fetch();
              if ($requete) {
                $_SESSION['id'] = $requete['membre_id'];
                $_SESSION['mail'] = $requete['membre_mail'];
                $_SESSION['nb_cmd'] = $requete['membre_nb_cmd'];
                $_SESSION['nb_pdt_vente'] = $requete['membre_pdt_vente'];
                //header("Location: profil.php");
                echo "<p>Vous êtes connecté ! Vous pouvez maintenant vendre et acheter des articles :)</p>";
              } else {
                echo "<p>L'identifiant et le mot de passe n'ont pas été reconnus.</p>";
              }
            }
            ?>
        </div>
    </body>
</html>
