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
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
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
                    <td class='py-2 px-4 border'>{$product['name']}</td>
                    <td class='py-2 px-4 border'>" . number_format($product['price'], 2, ",", "&nbsp;") . "&nbsp;€</td>
                    <td class='py-2 px-4 border'>{$product['qtt']}</td>
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
    </div>
  </div>
</body>
</html>
