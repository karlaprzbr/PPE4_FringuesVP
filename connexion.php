<!doctype html>
<html>
    <?php require_once("includes/head.php")?>
    <body>
        <?php require_once("includes/header.php")?>
        <nav>
            <ul>
                <li><a href="femmes.php">FEMMES</a></li>
                <li><a href="hommes.php">HOMMES</a></li>
                <li><a href="#">ENFANTS</a></li>
                <li><a href="#">TOUS</a></li>
                <li><a href="#">VENDRE</a></li>
            </ul>
            <?php require_once("includes/nav.php")?>
        </nav>
        
        <div id="main" class="conMain">
            <h3>Connexion</h3>
            <form>
                <label>Mail</label>
                <input>
                <label>Mot de passe</label>
                <input>
                <button>Connexion</button>
            </form>
            <p>Pas encore membre ? <a href="#">Inscrivez-vous !</a></p>
        </div>
        
        <?php require_once("includes/footer.php")?>
    </body>
</html>