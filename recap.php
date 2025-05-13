<?php
session_start(); // Démarre la session pour accéder aux produits enregistrés
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Récapitulatif des produits</title>
  <script src="https://cdn.tailwindcss.com"></script> <!-- CDN Tailwind CSS -->
</head>
<body class="bg-gray-50 flex flex-col gap-6 items-center justify-center min-h-screen">
<!-- <div class="flex flex-col md:flex-row gap-6 w-full max-w-6xl p-6 items-start"> -->
<div class="mt-4 bg-white text-center py-3 px-4 rounded-xl shadow text-gray-700 text-sm ">
    <?php //Compte le nombre d'article dans la session
      $i = 0;
      foreach($_SESSION['products'] ?? [] as $product){
        $i += $product['qtt'];
      }
      echo "🧺 Nombre total d'articles : <strong>$i</strong>";
    ?>
  </div>
  <!-- Conteneur principal -->
  <div class="w-full max-w-4xl bg-white shadow-md rounded-xl p-6 space-y-6">

    <h1 class="text-2xl font-semibold text-center text-gray-800">Récapitulatif des produits</h1>

    <?php
    // Vérifie si des produits existent dans la session
    if (!isset($_SESSION['products']) || empty($_SESSION['products'])) {
        // Si non, message d'absence
        echo "<p class='text-center text-gray-500'>Aucun produit en session...</p>";
    } else {
        // Sinon, création du tableau d'affichage
        echo "<div class='overflow-x-auto'>
                <table class='min-w-full text-sm text-left border border-gray-200'>
                  <thead class='bg-gray-100 text-gray-700 uppercase'>
                    <tr>
                      <th class='py-2 px-4 border'>#</th>
                      <th class='py-2 px-4 border'>Nom</th>
                      <th class='py-2 px-4 border'>Prix</th>
                      <th class='py-2 px-4 border'>Quantité</th>
                      <th class='py-2 px-4 border'>Total</th>
                    </tr>
                  </thead>
                  <tbody>";

        $totalGeneral = 0; // Initialise le total général

        // Parcours des produits en session
        foreach ($_SESSION['products'] as $index => $product) {
            // Affichage ligne par ligne avec les infos produit
            echo "<tr class='border-t'>
            <td class='py-2 px-4 border'>$index</td>
            <td class='py-2 px-4 border'>
              <div class='flex justify-between items-center'>
                <span>{$product['name']}</span>
                <a href=\"traitement.php?action=-2&index=$index\" class='bg-red-500 text-white px-2 rounded hover:bg-red-600 text-sm'>
                  Supprimer
                </a>
              </div>
            </td>
            <td class='py-2 px-4 border'>" . number_format($product['price'], 2, ",", "&nbsp;") . "&nbsp;€</td>
            <td class='py-2 px-4 border'>
              <div class='flex justify-between items-center'>
                <span>{$product['qtt']}</span>
                <div class='flex gap-2'>
                  <a href=\"traitement.php?action=down-qtt&index={$index}\" class='bg-red-500 text-white px-2 rounded hover:bg-red-600'>-</a>
                  <a href=\"traitement.php?action=up-qtt&index={$index}\" class='bg-green-500 text-white px-2 rounded hover:bg-green-600'>+</a>
                </div>
              </div>
            </td>
            <td class='py-2 px-4 border'>" . number_format($product['total'], 2, ",", "&nbsp;") . "&nbsp;€</td>
          </tr>";
    
            $totalGeneral += $product['total']; // Ajoute au total
        }

        // Affichage du total général
        echo "<tr class='bg-gray-50 font-semibold'>
                <td colspan='4' class='py-2 px-4 text-right border'>Total général :</td>
                <td class='py-2 px-4 border'>" . number_format($totalGeneral, 2, ",", "&nbsp;") . "&nbsp;€</td>
              </tr>
              </tbody>
            </table>
          </div>";
    }
    ?>

    <!-- Bouton retour vers la page de commande -->
    <div class="text-center">
      <a href="index.php" class="inline-block mt-4 bg-indigo-500 text-white px-6 py-2 rounded-lg shadow hover:bg-indigo-600 transition">
        Retour à la commande
      </a>
      <a href="traitement.php?action=-1&index=-1" class="inline-block mt-4 bg-red-500 text-white px-6 py-2 rounded-lg shadow hover:bg-red-600 transition">
        Tout Supprimer
      </a>
      </div>
  </div>
  <?php //Compte le nombre d'article dans la session
      if(isset($_SESSION["message"]) && !empty($_SESSION["message"])){
        echo "<div class=\"mt-4 bg-white text-center py-3 px-4 rounded-xl shadow text-gray-700 text-sm\">
".$_SESSION["message"]."  </div>";
      }
    ?>
</body>
</html>
