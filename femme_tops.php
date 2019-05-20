<!doctype html>
<html>
    <?php require_once("includes/head.php")?>
    <body>
        <?php require_once("includes/header.php")?>
        <nav>
            <ul>
                <li><a href="femmes.php" class="active">FEMMES</a></li>
                <li><a href="hommes.php">HOMMES</a></li>
                <li><a href="tout.php">TOUT</a></li>
                <li><a href="#">VENDRE</a></li>
            </ul>
            <?php require_once("includes/nav.php")?>
        </nav>
        <div id="sideNav">
            <div id="contenu">
                <p>FILTRER PAR PRODUITS</p>
                <a href="femmes.php">Tous les produits</a>
                <a href="femme_tops.php" class="active">Tops</a>
                <a href="femme_bas.php">Jeans, pantalons, shorts</a>
                <a href="femme_robes.php">Robes, jupes</a>
                <a href="femme_vestes.php">Vestes, manteaux</a>
                <a href="femme_accessoires.php">Chaussures, accessoires</a>
            </div>
        </div>

        <div id="main">
          <div id="produits">
            <?php
              session_start();
              $bdd = new PDO('mysql:host=localhost;dbname=fringuesvp','root','');
              $bdd->exec("SET NAMES 'UTF8'");
              $produits = $bdd->query('SELECT * FROM produits INNER JOIN images ON produits.pdt_img_id = images.img_id INNER JOIN genres_vet ON produits.pdt_genre_vet_id = genres_vet.genre_vet_id INNER JOIN types_vet ON produits.pdt_type_vet_id = types_vet.type_vet_id INNER JOIN membres ON produits.pdt_membre_id = membres.membre_id WHERE genre_libelle = "femme" AND type_vet_libelle = "tops_chemises"');
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
