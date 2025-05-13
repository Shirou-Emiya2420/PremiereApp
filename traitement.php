<?php
session_start();// Démarre la session PHP pour pouvoir stocker les produits

if(isset($_POST['submit'])){// Vérifie si le formulaire a été soumis

     // Récupère et filtre les données du formulaire
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);

    // Vérifie que toutes les données sont valides
    if($name && $price && $qtt){
        // Crée un tableau représentant le produit
        $product = [
            "name" => $name,
            "price" => $price,
            "qtt" => $qtt,
            "total" => $price * $qtt // Calcule le total pour ce produit
        ];
        // Ajoute le produit au tableau 'products' dans la session
        $_SESSION['products'][] = $product;
    }
}
// Redirige l'utilisateur vers le formulaire après soumission
header("Location:index.php");

?>