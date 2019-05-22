<?php

function creationPanier() {
  if(!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();
    $_SESSION['panier']['pdt_libelle'] = array();
    $_SESSION['panier']['pdt_prix'] = array();
  }
}

function ajouterArticle($pdt_libelle,$pdt_prix) {
  // Si le panier existe
  if ($_SESSION['panier']) {
    // On regarde si le produit est déjà dans le panier
    //$position_pdt = array_search($pdt_libelle, $_SESSION['panier']['pdt_libelle']);
    //if ($position_pdt == false) {
      // S'il n'est pas déjà dans le panier alors on l'ajoute
      array_push($_SESSION['panier']['pdt_libelle'], $pdt_libelle);
      array_push($_SESSION['panier']['pdt_prix'], $pdt_prix);
    //}
  } else {
    creationPanier();
    // echo "Un problème est survenu veuillez contacter l'administrateur du site.";
  }
}

// function supprimerArticle($pdt_libelle) {
//   // Si le panier existe
//   if (creationPanier()) {
//     // Création du panier temporaire
//     $tmp = array();
//     $tmp['pdt_libelle'] = array();
//     $tmp['pdt_prix'] = array();
//
//     for ($i = 0; $i < count($_SESSION['panier']['pdt_libelle']); $i++) {
//       if ($_SESSION['panier']['pdt_libelle'][$i] !== $pdt_libelle) {
//         array_push($tmp['pdt_libelle'], $_SESSION['panier']['pdt_libelle'][$i]);
//         array_push($tmp['pdt_prix'], $_SESSION['panier']['pdt_prix'][$i]);
//       }
//     }
//     // On remplace notre panier session par le panier temp
//     $_SESSION['panier'] = $tmp;
//     // On efface le panier temporaire
//     unset($tmp);
//   } else {
//     echo "Un problème est survenu veuillez contacter l'administrateur du site.";
//   }
// }
?>
