<?php
session_start();
require_once("includes/script.php");
require_once("fonctions_panier.php");
$produits = $bdd->query('SELECT * FROM produits INNER JOIN genres_vet ON produits.pdt_genre_vet_id = genres_vet.genre_vet_id INNER JOIN types_vet ON produits.pdt_type_vet_id = types_vet.type_vet_id INNER JOIN membres ON produits.pdt_membre_id = membres.membre_id');
$donnees = $produits->fetchAll();
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
                <li><a href="tout.php" class="active">TOUT</a></li>
                <li><a href="vendre.php">VENDRE</a></li>
            </ul>
            <?php require_once("includes/nav.php")?>
        </nav>

        <div id="main">
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
      </div>

    </body>
</html>
