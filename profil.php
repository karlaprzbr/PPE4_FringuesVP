<?php
session_start();
require_once("includes/script.php");
include("fonctions_panier.php");
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
                <li><a href="#">VENDRE</a></li>
            </ul>
            <?php require_once("includes/nav.php")?>
        </nav>

        <div id="main">
          <?php
          if (isset($_SESSION['id'])) {
            $requete = $bdd->query('SELECT * FROM membres WHERE membre_id = '.$_SESSION['id'])->fetch();
            ?>
            <h2><?=$requete['membre_prenom']?> <?=$requete['membre_nom']?></h2>
            <p>Nombre de commandes :
              <?php
              if (isset($_SESSION['nb_cmd'])) {
                echo $_SESSION['nb_cmd'];
              } else {
                echo "0";
              }
              ?>
            </p>
            <p> Nombre d'articles en vente :
              <?php
              if (isset($_SESSION['nb_pdt_vente'])) {
                echo $_SESSION['nb_pdt_vente'];
              } else {
                echo "0";
              }
              ?>
            </p>
            <?php
          }
          ?>

          <h2>Données personnelles</h2>
          <table>
            <tr>
              <td>Nom :</td>
              <td><?=$requete['membre_nom'] ?></td>
            </tr>
            <tr>
              <td>Prénom :</td>
              <td><?=$requete['membre_prenom'] ?></td>
            </tr>
            <tr>
              <td>Adresse :</td>
              <td><?=$requete['membre_adresse'] ?></td>
            </tr>
            <tr>
              <td>Mail :</td>
              <td><?=$requete['membre_mail'] ?></td>
            </tr>
            <tr>
              <td><button value="Modifier le profil">Modifier le profil</button></td>
              <td>
                <form action="profil.php" method="post">
                  <input type="submit" name="deconnexion" value="Deconnexion">
                </form>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['deconnexion'])) {
                  session_destroy();
                  header("Location: index.php");
                }
                ?>
              </td>
            </tr>
          </table>


        </div>

    </body>
</html>
