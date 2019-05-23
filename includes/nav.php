<div id="icons">
    <form action="/action_page.php">
        <input type="text" placeholder="Rechercher..." name="search">
        <button type="submit"><i class="fas fa-search"></i></button>
    </form>
    <a href="
    <?php
    if (isset($_SESSION['mail'])) {
      echo "profil.php";
    } else {
      echo "connexion.php";
    }
    ?>
    "><i class="fas fa-user"></i></a>
    <a href="panier.php"><i class="fas fa-shopping-cart"></i></a>
</div>
