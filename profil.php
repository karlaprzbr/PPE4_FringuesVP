<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=fringuesvp;charset=utf8', 'root', '');
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
                <li><a href="#">VENDRE</a></li>
            </ul>
            <?php require_once("includes/nav.php")?>
        </nav>

        <div id="main">
          <?php
          if (isset($_SESSION['id'])) {
            $requete = $bdd->query('SELECT * FROM membres WHERE membre_id = '.$_SESSION['id'])->fetch();
            ?>
            <h2><?=$requete['membre_prenom']?> <?=$requete['membre_nom']?></h2>
            <?php
          }
          ?>
          <form action="profil.php" method="post">
            <input type="submit" name="deconnexion" value="Deconnexion">
          </form>
          <?php
          if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['deconnexion'])) {
            session_destroy();
            header("Location: index.php");
          }
          ?>
        </div>

    </body>
</html>
