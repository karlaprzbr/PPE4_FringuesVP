<!doctype html>
<html>
    <?php require_once("includes/head.php")?>
    <body>
        <?php require_once("includes/header.php")?>
        <nav>
            <ul>
                <li><a href="femmes.php">FEMMES</a></li>
                <li><a href="hommes.php" class="active">HOMMES</a></li>
                <li><a href="Tout.php">TOUT</a></li>
                <li><a href="#">VENDRE</a></li>
            </ul>
            <?php require_once("includes/nav.php")?>
        </nav>
        <div id="sideNav">
            <div id="contenu">
                <p>FILTRER PAR PRODUITS</p>
                <a href="hommes.php">Tous les produits</a>
                <a href="homme_chemises.php">Chemises</a>
                <a href="homme_bas.php">Jeans, pantalons, shorts</a>
                <a href="homme_vestes.php" class="active">Vestes, manteaux</a>
                <a href="homme_accessoires.php">Chaussures, accessoires</a>
            </div>
        </div>

        <div id="main">
          <div id="produits">
            <?php
              session_start();
              $bdd = new PDO('mysql:host=localhost;dbname=fringuesvp','root','');
              $bdd->exec("SET NAMES 'UTF8'");
              $produits = $bdd->query('SELECT * FROM produits INNER JOIN images ON produits.pdt_img_id = images.img_id INNER JOIN genres_vet ON produits.pdt_genre_vet_id = genres_vet.genre_vet_id INNER JOIN types_vet ON produits.pdt_type_vet_id = types_vet.type_vet_id INNER JOIN membres ON produits.pdt_membre_id = membres.membre_id WHERE genre_libelle = "homme" AND type_vet_libelle = "vestes_manteaux"');
              $donnees = $produits->fetchAll();
              foreach ($donnees as $row) {
                ?>
                <div class="produit">
                  <p class="title"><?php echo $row['pdt_libelle'] ?></p>
                  <a href="#"><img src="<?php echo $row['img_lien'] ?>" /></a>
                  <p><?php echo $row['pdt_prix'] ?> €</p>
                  <p>Taille <?php echo $row['pdt_taille'] ?></p>
                </div>
            <?php } ?>
        </div>
        </div>

        <?php require_once("includes/footer.php")?>
    </body>
</html>
