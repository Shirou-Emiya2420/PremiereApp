<?php
session_start(); // Démarre la session pour accéder aux produits enregistrés
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ajout produit</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">
  <div class="w-full max-w-sm space-y-4">
  <div class="mt-4 bg-white text-center py-3 px-4 rounded-xl shadow text-gray-700 text-sm">
    <?php //Compte le nombre d'article dans la session
      $i = 0;
      foreach($_SESSION['products'] ?? [] as $product){
        $i += $product['qtt'];
      }
      echo "🧺 Nombre total d'articles : <strong>$i</strong>";
    ?>
  </div>
    <form action="traitement.php?action=add" method="post" class="bg-white shadow-xl rounded-2xl p-8 space-y-6">
      <h1 class="text-2xl font-semibold text-gray-800 text-center">Ajouter un produit</h1>

      <div>
        <label class="text-sm text-gray-500">Nom du produit</label>
        <input type="text" name="name" class="w-full mt-1 px-4 py-2 bg-gray-100 rounded-lg border border-transparent focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
      </div>

      <div>
        <label class="text-sm text-gray-500">Prix</label>
        <input type="number" step="any" name="price" class="w-full mt-1 px-4 py-2 bg-gray-100 rounded-lg border border-transparent focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
      </div>

      <div>
        <label class="text-sm text-gray-500">Quantité</label>
        <input type="number" name="qtt" value="1" class="w-full mt-1 px-4 py-2 bg-gray-100 rounded-lg border border-transparent focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
      </div>

      <div class="text-center">
        <button type="submit" name="submit" class="w-full bg-indigo-500 text-white py-2 rounded-lg font-medium hover:bg-indigo-600 transition">Ajouter</button>
      </div>
    </form>

    <div class="text-center">
      <a href="recap.php" class="inline-block bg-gray-200 text-gray-800 px-5 py-2 rounded-lg shadow hover:bg-gray-300 transition">
        Voir le récapitulatif
      </a>
    </div>

      <?php //Message d'ajout d'un article
      if(isset($_SESSION["message"]) && !empty($_SESSION["message"])){
        echo "<div class=\" opacity-80 mt-4 bg-white text-center py-3 px-4 rounded-xl shadow text-gray-700 text-sm\">
".$_SESSION["message"]."  </div>";
      }
    ?>

  </div>


</body>
</html>
