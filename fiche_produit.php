<?php
session_start();
require_once("includes/script.php");
include("fonctions_panier.php");

if(isset($_GET['pdt_id']) AND !empty($_GET['pdt_id'])) {
  $pdt_id = htmlspecialchars($_GET['pdt_id']);
  $produit = $bdd->prepare('SELECT * FROM produits INNER JOIN types_vet ON produits.pdt_type_vet_id = types_vet.type_vet_id INNER JOIN genres_vet ON produits.pdt_genre_vet_id = genres_vet.genre_vet_id INNER JOIN membres ON produits.pdt_membre_id = membres.membre_id WHERE pdt_id =' . $pdt_id);
  $produit->execute(array($pdt_id));
  $pdt_data = $produit->fetch();
  $pdt_libelle = $pdt_data['pdt_libelle'];
  $pdt_prix = $pdt_data['pdt_prix'];
  $pdt_taille = $pdt_data['pdt_taille'];
  $commentaires = $bdd->query('SELECT * FROM commentaires INNER JOIN membres ON commentaires.com_membre_id = membres.membre_id INNER JOIN produits ON commentaires.com_pdt_id = produits.pdt_id WHERE pdt_id ='. $pdt_id .' ORDER BY com_date DESC');
  if ($commentaires !== false ) {
    $com_data = $commentaires->fetchAll();
  }
} else {
  die('Erreur');
}
if (isset($_POST['comment'])) {
  if (!empty($_POST['objet']) && !empty($_POST['commentaire'])) {
    $com_objet = htmlspecialchars($_POST['objet']);
    $com_texte = htmlspecialchars($_POST['commentaire']);
    $com_date = date("Y-m-d H:i:s");
    $com_pdt_id = $pdt_id;
    $com_membre_id = $_SESSION['id'];
    try {
      $requete = $bdd->prepare('INSERT INTO commentaires(com_objet,com_texte,com_date,com_pdt_id,com_membre_id) VALUES(?,?,?,?,?)');
      $requete->execute(array($com_objet,$com_texte,$com_date,$com_pdt_id,$com_membre_id));
      echo "<p>Votre commentaire a bien été posté.</p>";
    } catch (\Exception $e) {
      echo $e->getMessage();
    }

  }
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
            <h1> <?php echo $pdt_data['pdt_libelle'] ?> </h1>
            <img src="<?php echo $pdt_data['pdt_img_lien'] ?>" alt="Image produit" />
            <p><?php echo $pdt_data['pdt_description'] ?> </p>
            <p>Taille <?php echo $pdt_data['pdt_taille']?></p>
            <p>
              <?php echo $pdt_data['pdt_prix'] ?>€
              <form action="fiche_produit.php?pdt_id=<?= $_GET['pdt_id'] ?>" method="POST"><input type="submit" class="button" name="ajout_panier" value="Ajouter au panier"></form>
              <?php
              if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['ajout_panier'])) {
                ajouterArticle($pdt_id,$pdt_libelle,$pdt_prix);
              }
              ?>
            </p>
              <div class="commentaire">
                <?php
                if (isset($_SESSION['id'])) {
                  ?>
                  <h2>Posez une question au vendeur</h2>
                  <form class="" action="fiche_produit.php?pdt_id=<?=$pdt_id?>" method="post">
                  <input type="text" class="text"name="objet" placeholder="Objet">
                  <input type="text" class="text"name="commentaire" placeholder="Commentaire"/>
                  <input type="submit" class="button" value="Envoyer" name="comment"/>
                  </form>
                  <?php
                } else if (!empty($com_data)) {
                  echo "<h2>Commentaires</h2>";
                }
                ?>
                <?php
                  foreach ($com_data as $row) {
                    if ($row['com_membre_id'] == $row['pdt_membre_id']) { ?>
                    <div class="reponse">
                      <h3 class="objet"><?php echo $row['com_objet'] ?></h3>
                      <p><?php echo $row['com_texte'] ?></p>
                      <p>Réponse postée le <?php echo $row['com_date'] ?></p>
                    </div>
                  <?php } else { ?>
                      <div class="question">
                        <h3 class="objet"><?php echo $row['com_objet'] ?></h3>
                        <p><?php echo $row['com_texte'] ?></p>
                        <p>Question posée par <?php echo $row['membre_prenom'] ?> le <?php echo $row['com_date'] ?></p>
                      </div>
                  <?php }
                } ?>
              </div>


          </div>
        </div>

    </body>
</html>
