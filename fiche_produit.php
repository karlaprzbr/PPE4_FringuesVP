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
          <div id="ficheProduit">
            <?php
            session_start();
            $bdd = new PDO('mysql:host=localhost;dbname=vilkar','root','');
            $bdd->exec("SET NAMES 'UTF8'");
            if(isset($_GET['pdt_id']) AND !empty($_GET['pdt_id'])) {
              $get_id = strip_tags($_GET['pdt_id']);
              $produit = $bdd->prepare('SELECT * FROM produits INNER JOIN images ON produits.pdt_img_id = images.img_id INNER JOIN types_vet ON produits.pdt_type_vet_id = types_vet.type_vet_id INNER JOIN genres_vet ON produits.pdt_genre_vet_id = genres_vet.genre_vet_id INNER JOIN membres ON produits.pdt_membre_id = membres.membre_id WHERE pdt_id =' . $get_id);
              $produit->execute(array($get_id));
              $produit = $produit->fetch();
              $commentaires = $bdd->query('SELECT * FROM commentaires INNER JOIN images ON produits.pdt_img_id = images.img_id INNER JOIN types_vet ON produits.pdt_type_vet_id = types_vet.type_vet_id INNER JOIN genres_vet ON produits.pdt_genre_vet_id = genres_vet.genre_vet_id INNER JOIN membres ON produits.pdt_membre_id = membres.membre_id WHERE pdt_id =' . $get_id);
              $commentaires = $commentaires->fetchAll();
            } else {
              die('Erreur');
            }
            ?>
            <h1> <?php $produit['pdt_libelle'] ?> </h1>
            <img src="<?php echo $produit['img_lien'] ?>" alt="Image produit" />
            <p><?php $produit['pdt_description'] ?> </p>
            <p><?php $produit['pdt_prix'] ?>€ </p>
          </div>
        </div>

    </body>
</html>
