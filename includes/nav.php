<div id="icons">
    <a href="
    <?php
    if (isset($_SESSION['mail'])) {
      echo "profil.php";
    } else {
      echo "connexion.php";
    }
    ?>
    "><i class="fas fa-user"></i></a>
    <a href="panier.php"><i class="fas fa-shopping-cart"></i>
    <?php
    if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])) {
      $nb_articles_panier = count($_SESSION['panier']['pdt_libelle']);
      echo "(".$nb_articles_panier.")";
    }
    ?>
    </a>
</div>
