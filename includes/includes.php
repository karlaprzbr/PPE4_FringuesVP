<header id="navig" class="navig">
    <a href="index.php"><h1>FRINGUES <span>ventes privées</span></h1></a>
    <a href="categories.php">Catégories</a>
    <a href="panier.php"><i class="fas fa-shopping-cart"></i> Panier
    <?php
    if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])) {
      $nb_pdt = count($_SESSION['panier']['pdt_id']);
      echo " (".$nb_pdt.")";
    }
    ?>
    </a>
    <?php
    if (isset($_SESSION['mail'])) {
      echo "<a href=\"profil.php\"><i class=\"fas fa-user\"></i> Profil</a>";
    } else {
      echo "<a href=\"connexion.php\"><i class=\"fas fa-user\"></i> Connexion / Inscription</a>";
    }
    ?>
</header>
<a href="javascript:void(0);" class="icon" onclick="openNav()"><i class="fa fa-bars"></i></a>
<script src="js/openNav.js"></script>

<footer>
    <script>
        let date = new Date()
        let currentYear = date.getFullYear()
    </script>

    <p class="footer-text">
        2018-<script>document.write(currentYear)</script> | <span class="marque">FRINGUES </span><span class="desc">ventes privées</span>
    </p>
</footer>
