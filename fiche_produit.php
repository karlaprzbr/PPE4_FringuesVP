<?php
session_start();
require_once("includes/script.php");
include("fonctions_panier.php");

if(isset($_GET['pdt_id']) AND !empty($_GET['pdt_id'])) {
  $pdt_id = strip_tags($_GET['pdt_id']);
  $produit = $bdd->prepare('SELECT * FROM produits INNER JOIN types_vet ON produits.pdt_type_vet_id = types_vet.type_vet_id INNER JOIN genres_vet ON produits.pdt_genre_vet_id = genres_vet.genre_vet_id INNER JOIN membres ON produits.pdt_membre_id = membres.membre_id WHERE pdt_id =' . $pdt_id);
  $produit->execute(array($pdt_id));
  $donnees = $produit->fetch();
  $pdt_libelle = $donnees['pdt_libelle'];
  $pdt_prix = $donnees['pdt_prix'];
  //$commentaires = $bdd->query('SELECT * FROM commentaires INNER JOIN images ON produits.pdt_img_id = images.img_id INNER JOIN types_vet ON produits.pdt_type_vet_id = types_vet.type_vet_id INNER JOIN genres_vet ON produits.pdt_genre_vet_id = genres_vet.genre_vet_id INNER JOIN membres ON produits.pdt_membre_id = membres.membre_id WHERE pdt_id =' . $get_id);
  //$commentaires = $commentaires->fetchAll();
} else {
  die('Erreur');
}
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
          <div id="ficheProduit">
            <h1> <?php echo $donnees['pdt_libelle'] ?> </h1>
            <img src="<?php echo $donnees['pdt_img_lien'] ?>" alt="Image produit" />
            <p><?php echo $donnees['pdt_description'] ?> </p>
            <p>
              <?php echo $donnees['pdt_prix'] ?>€
              <form action="fiche_produit.php?pdt_id=<?= $_GET['pdt_id'] ?>" method="POST"><input type="submit" name="ajout_panier" value="Ajouter au panier"></form>
              <?php
              if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['ajout_panier'])) {
                ajouterArticle($pdt_id,$pdt_libelle,$pdt_prix);
                // var_dump($_SESSION['panier']);
                // exit();
              }
              ?>
            </p>
          </div>
        </div>

    </body>
</html>
