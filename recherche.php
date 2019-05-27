<?php
session_start();
require_once("includes/script.php");
include("fonctions_panier.php");
if (isset($_POST['chercher'])) {
  if (!empty($_POST['search'])) {
    $recherche = htmlspecialchars($_POST['search']);
    try {
      $sql = "SELECT * FROM produits WHERE pdt_libelle LIKE '%" .$recherche. "%'");
      $resultat = mysql_query($sql);
      while ($row = mysql_fetch_array($resultat)) {
        $pdt_id = $row['pdt_id'];
        $pdt_libelle = $row['pdt_libelle'];
        $pdt_
      }
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

    </body>
</html>
