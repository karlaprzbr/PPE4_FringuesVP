<?php
session_start();
require_once("includes/script.php");
require_once("fonctions_panier.php");
$_SESSION['genres'] = $bdd->query('SELECT * FROM genres_vet')->fetchAll();
$_SESSION['types'] = $bdd->query('SELECT * FROM types_vet')->fetchAll();

if(isset($_POST['vendre'])) {
  if(!empty($_POST['libelle']) && !empty($_POST['description']) && !empty($_POST['prix']) && !empty($_POST['taille']) && !empty($_POST['genres']) && !empty($_POST['types'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
    $upload_ok = 1;
    $image_file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

      $check = getimagesize($_FILES['fileToUpload']['tmp_name']);
      if ($check !== false) {
        $upload_ok = 1;
      } else {
        echo "<p>Le fichier n'est pas une image</p>";
        $upload_ok = 0;
      }
      if (file_exists($target_file)) {
        echo "<p>Désolé, l'image existe déjà. Choisissez-en une autre ou renommez-la.</p>";
        $upload_ok = 0;
      }
      if ($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg" && $image_file_type != "gif") {
        echo "<p>Désolé, seulement les extensions JPG, JPEG, PNG et GIF sont autorisées.";
        $upload_ok = 0;
      }
      if ($upload_ok == 0) {
        echo "<p>Désolé, votre image n'a pas pu être enregistrée.</p>";
      } else {
        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
          $pdt_libelle = htmlspecialchars($_POST['libelle']);
          $pdt_description = htmlspecialchars($_POST['description']);
          $pdt_prix = htmlspecialchars(floatval($_POST['prix']));
          $pdt_taille = htmlspecialchars($_POST['taille']);
          $pdt_img_lien = "uploads/".$_FILES['fileToUpload']['name'];
          $pdt_membre = $_SESSION['id'];
          $pdt_type = htmlspecialchars($_POST['types']);
          $pdt_genre = htmlspecialchars($_POST['genres']);
          try {
            $requete = $bdd->prepare('INSERT INTO produits(pdt_libelle,pdt_description,pdt_prix,pdt_taille,pdt_img_lien,pdt_membre_id,pdt_type_vet_id,pdt_genre_vet_id) VALUES(?,?,?,?,?,?,?,?)');
            $requete->execute(array($pdt_libelle,$pdt_description,$pdt_prix,$pdt_taille,$pdt_img_lien,$pdt_membre,$pdt_type,$pdt_genre));
            echo "<p>Votre produit a bien été ajouté</p>";
            $_SESSION['nb_pdt_vente'] = $_SESSION['nb_pdt_vente'] + 1;
          } catch(PDOException $e) {
            echo $requete . "<br>" . $e->getMessage();
          }
        }
      }
  } else {
    echo "<p>Tous les champs doivent être renseignés.</p>";
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
              <form class="" action="test_vendre.php" method="post" enctype="multipart/form-data">
                <table>
                  <tr>
                    <td>Titre du produit à mettre en vente</td>
                    <td><input type="text" class="text"name="libelle"></td>
                  </tr>
                  <tr>
                    <td>Description du produit</td>
                    <td><input type="text" class="text"name="description"></td>
                  </tr>
                  <tr>
                    <td>Prix</td>
                    <td><input type="text" class="text"name="prix"></td>
                  </tr>
                  <tr>
                    <td>Taille</td>
                    <td><input type="text" class="text"name="taille"></td>
                  </tr>
                  <tr>
                    <td>Choisissez le genre</td>
                    <td>

                      <select id="genres" required="true" name="genres">
                        <?php
                        foreach ($_SESSION['genres'] as $row) {
                          echo "<option value=\"".$row['genre_vet_id']."\">".$row['genre_vet_libelle']."</option>";
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
                          echo "<option value=\"".$row['type_vet_id']."\">".$row['type_vet_libelle']."</option>";
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
                    <td><input type="submit" class="button" value="Vendre" name="vendre"></td>
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
