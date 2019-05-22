<?php
session_start();
include("fonctions_panier.php");
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
          <form method="post" action="panier.php">
            <table>
            	<tr>
            		<td>Votre panier</td>
            	</tr>
            	<tr>
            		<td>Libellé</td>
            		<td>Prix</td>
            		<td>Action</td>
            	</tr>


            	<?php
            	if ($_SESSION['panier'])
            	{
            	   $nbArticles=count($_SESSION['panier']['pdt_libelle']);
            	   if ($nbArticles <= 0)
            	   echo "<tr><td>Votre panier est vide </ td></tr>";
            	   else
            	   {
            	      for ($i=0 ;$i < $nbArticles ; $i++)
            	      {
            	         echo "<tr>";
            	         echo "<td>".htmlspecialchars($_SESSION['panier']['pdt_libelle'][$i])."</ td>";
            	         echo "<td>".htmlspecialchars($_SESSION['panier']['pdt_prix'][$i])."</td>";
            	         echo "</tr>";
            	      }

            	      // echo "<tr><td> </td>";
            	      // echo "<td>";
            	      // echo "Total : ".MontantGlobal();
            	      // echo "</td></tr>";

            	      // echo "<tr><td colspan=\"4\">";
            	      // echo "<input type=\"submit\" value=\"Rafraichir\"/>";
            	      // echo "<input type=\"hidden\" name=\"action\" value=\"refresh\"/>";

            	      // echo "</td></tr>";
            	   }
            	}
            	?>
            </table>
            </form>
        </div>

    </body>
</html>
