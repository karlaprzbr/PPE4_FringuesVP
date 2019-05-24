<?php
session_start();
require_once("includes/script.php");
$_SESSION['genres'] = $bdd->query('SELECT * FROM genres_vet')->fetchAll();
$_SESSION['types'] = $bdd->query('SELECT * FROM types_vet')->fetchAll();

if(isset($_POST['libelle']) && isset($_POST['description']) && isset($_POST['prix']) && isset($_POST['taille']) && isset($_POST['genres']) && isset($_POST['types'])) {
  if(!empty($_POST['libelle']) && !empty($_POST['description']) && !empty($_POST['prix']) && !empty($_POST['taille']) && !empty($_POST['genres']) && !empty($_POST['types'])) {
    $pdt_libelle = strip_tags($_POST['libelle']);
    $pdt_description = strip_tags($_POST['description']);
    $pdt_prix = strip_tags($_POST['prix']);
    $pdt_taille = strip_tags(intval($_POST['taille']));
    $pdt_genre = $_POST['genres'];
    $pdt_type = $_POST['types'];
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
                <li><a href="vendre.php" class="active">VENDRE</a></li>
            </ul>
            <?php require_once("includes/nav.php")?>
        </nav>

        <div id="main">
          <h1>Vendre un article</h1>
            <?php
            if(isset($_SESSION['mail'])) {
              ?>
              <form class="" action="vendre.php" method="post" enctype="multipart/form-data">
                <table>
                  <tr>
                    <td>Titre du produit à mettre en vente</td>
                    <td><input type="text" name="libelle" placeholder="Titre"></td>
                  </tr>
                  <tr>
                    <td>Description du produit</td>
                    <td><input type="text" name="description" placeholder="Description"></td>
                  </tr>
                  <tr>
                    <td>Prix</td>
                    <td><input type="text" name="prix" placeholder="Prix"></td>
                  </tr>
                  <tr>
                    <td>Taille</td>
                    <td><input type="text" name="taille" placeholder="Taille"></td>
                  </tr>
                  <tr>
                    <td>Choisissez le genre</td>
                    <td>
                      <select id="genres" required="true" name="gernes">
                        <?php
                        foreach ($_SESSION['genres'] as $row) {
                          echo "<option>".$row['genre_libelle']."</option>";
                        }
                        ?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td>Choisissez le type de vêtement</td>
                    <td>
                      <select id="types" required="true" name="types">
                        <?php
                        foreach ($_SESSION['types'] as $row) {
                          echo "<option>".$row['type_vet_libelle']."</option>";
                        }
                        ?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td>Choisissez une image pour votre produit</td>
                    <td><input type="file" name="fileToUpload" id="fileToUpload"></td>
                  </tr>
                  <tr>
                    <td><input type="submit" value="Vendre" name="submit"></td>
                    <td><button>Annuler</button></td>
                  </tr>
                </table>
              </form>
              <?php
            } else {
              ?>
              <p>Vous devez d'abord vous connecter pour pouvoir vendre vos articles. <a href="connexion.php">Connexion</a></p>
              <p>Pas encore de compte ? <a href="inscription.php">Inscrivez-vous !</a></p>
              <?php
            }
            ?>
        </div>

    </body>
</html>
