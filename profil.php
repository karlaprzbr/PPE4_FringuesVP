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
            $req_membre = $bdd->query('SELECT * FROM membres WHERE membre_id = '.$_SESSION['id'])->fetch();
            $req_produits = $bdd->query('SELECT * FROM produits WHERE pdt_membre_id = '.$_SESSION['id']);
            $donnees = $req_produits->fetchAll();
            ?>
            <h2><?=$req_membre['membre_prenom']?> <?=$req_membre['membre_nom']?></h2>
            <p>Nombre de commandes :
              <?php
              if (isset($_SESSION['nb_cmd'])) {
                echo $_SESSION['nb_cmd'];
              } else {
                echo "0";
              }
              ?>
            </p>
            <p> Articles en vente :
              <div id="produits">
                <?php
                foreach ($donnees as $row) {
                  ?>
                  <div class="produit">
                    <p class="title"><?php echo $row['pdt_libelle'] ?></p>
                    <a href="fiche_produit.php?pdt_id=<?= $row['pdt_id'] ?>"><img src="<?php echo $row['pdt_img_lien'] ?>" /></a>
                    <p><?php echo $row['pdt_prix'] ?> €</p>
                    <p>Taille <?php echo $row['pdt_taille'] ?></p>
                  </div>
                <?php } ?>
              </div>
            </p>
            <?php
          }
          ?>

          <h2>Données personnelles</h2>
          <table>
            <tr>
              <td>Nom :</td>
              <td><?=$req_membre['membre_nom'] ?></td>
            </tr>
            <tr>
              <td>Prénom :</td>
              <td><?=$req_membre['membre_prenom'] ?></td>
            </tr>
            <tr>
              <td>Adresse :</td>
              <td><?=$req_membre['membre_adresse'] ?></td>
            </tr>
            <tr>
              <td>Mail :</td>
              <td><?=$req_membre['membre_mail'] ?></td>
            </tr>
            <tr>
              <td>
                <form action="profil.php" method="post">
                  <input type="submit" class="button" name="deconnexion" value="Deconnexion">
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
