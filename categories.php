<?php
session_start();
require_once("includes/script.php");
include("fonctions_panier.php");
?>

<!doctype html>
<html>
    <?php require_once("includes/head.php")?>
    <body>
        <?php require_once("includes/includes.php")?>
        <nav>
            <ul>
                <li>
                  <a href="femmes.php">FEMMES</a>
                  <ul>
                    <li><a href="femme_tops.php">Tops</a></li>
                    <li><a href="femme_bas.php">Jeans, pantalons, shorts</a></li>
                    <li><a href="femme_robes.php">Robes, jupes</a></li>
                    <li><a href="femme_vestes.php">Vestes, manteaux</a></li>
                    <li><a href="femme_accessoires.php">Chaussures, accessoires</a></li>
                  </ul>
                </li>
                <li><a href="hommes.php">HOMMES</a></li>
                <li><a href="tout.php">TOUT</a></li>
                <li><a href="vendre.php">VENDRE</a></li>
            </ul>
            <?php require_once("includes/nav.php")?>
        </nav>

        <div id="main">
          <ul>
              <li><a href="femmes.php">FEMMES</a></li>
              <li><a href="hommes.php">HOMMES</a></li>
              <li><a href="tout.php">TOUT</a></li>
              <li><a href="vendre.php">VENDRE</a></li>
          </ul>
        </div>

    </body>
</html>
