<!doctype html>
<html>
    <?php require_once("includes/head.php")?>
    <body>
        <?php require_once("includes/includes.php")?>
        <nav>
            <ul>
                <li><a href="femmes.php">FEMMES</a></li>
                <li><a href="hommes.php">HOMMES</a></li>
                <li><a href="#">ENFANTS</a></li>
                <li><a href="tout.php">TOUT</a></li>
                <li><a href="#">VENDRE</a></li>
            </ul>
            <?php require_once("includes/nav.php")?>
        </nav>

        <div id="main">
          <div id="tout">
          <?php
            session_start();
            $bdd = new PDO('mysql:host=localhost;dbname=fringuesvp','root','');
            $bdd->exec("SET NAMES 'UTF8'");
            $produits = $bdd->query('SELECT * FROM produits INNER JOIN images ON produits.img_id = images.img_id INNER JOIN genres_vet ON produits.genre_vet_id = genres_vet.genre_vet_id INNER JOIN types_vet ON produits.type_vet_id = types_vet.type_vet_id INNER JOIN membres ON produits.membre_id = membres.membre_id');
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

    </body>
</html>
