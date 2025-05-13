<?php
session_start();// Démarre la session PHP pour pouvoir stocker les produits



if (0) {
    if(isset($_GET["index"])){
        foreach ($_SESSION['products'] as $indexb => $product) {
            if ($indexb == $index) {
                // ➤ Produit ciblé

                if ($action < -1) {
                    // ➤ Si action < -1 (ex: -2), on force la quantité à 0
                    $product["qtt"] = 0;
                } else {
                    // ➤ Sinon, on ajoute ou retire une unité
                    $product["qtt"] += $action;
                }

                $_SESSION['message'] = "➕ La quantité de " . $product["name"] . " a bien été changée";

                if ($product["qtt"] < 1) {
                    // ➤ Si la quantité est inférieure à 1, on le supprime
                    $_SESSION['message'] = "❌ " . $product["name"] . " a bien été supprimé";
                    unset($product[$index]); // ⚠️ Erreur ici : tu essaies de supprimer une clé dans $product, pas dans $_SESSION
                    // => Rien à ajouter dans $tab dans ce cas
                } else {
                    // ➤ Met à jour le total
                    $product["total"] = $product["price"] * $product["qtt"];
                    $tab[] = $product; // ➤ Ajoute le produit mis à jour
                }
            } else {
                // ➤ Produit non ciblé, on le garde tel quel
                $tab[] = $product;
            }
        }
    }
    if (is_string($action) && is_string($index)) { // ⚠️ Ici tu compares des nombres à des chaînes → à corriger !
        // ➤ Prépare un tableau pour stocker les produits mis à jour
        $tab;

        if ($index == -1) {
            // ➤ Si index = -1, on considère que le panier doit être vidé (aucun produit ciblé)
            $_SESSION['message'] = "❌ Le panier a été supprimé";
        } else {
            // ➤ Parcours de tous les produits de la session
            foreach ($_SESSION['products'] as $indexb => $product) {
                if ($indexb == $index) {
                    // ➤ Produit ciblé

                    if ($action < -1) {
                        // ➤ Si action < -1 (ex: -2), on force la quantité à 0
                        $product["qtt"] = 0;
                    } else {
                        // ➤ Sinon, on ajoute ou retire une unité
                        $product["qtt"] += $action;
                    }

                    $_SESSION['message'] = "➕ La quantité de " . $product["name"] . " a bien été changée";

                    if ($product["qtt"] < 1) {
                        // ➤ Si la quantité est inférieure à 1, on le supprime
                        $_SESSION['message'] = "❌ " . $product["name"] . " a bien été supprimé";
                        unset($product[$index]); // ⚠️ Erreur ici : tu essaies de supprimer une clé dans $product, pas dans $_SESSION
                        // => Rien à ajouter dans $tab dans ce cas
                    } else {
                        // ➤ Met à jour le total
                        $product["total"] = $product["price"] * $product["qtt"];
                        $tab[] = $product; // ➤ Ajoute le produit mis à jour
                    }
                } else {
                    // ➤ Produit non ciblé, on le garde tel quel
                    $tab[] = $product;
                }
            }
        }

        // ➤ Remplace les anciens produits par ceux du tableau mis à jour
        $_SESSION["products"] = $tab;
    } else {
        // ➤ Cas où les paramètres GET ne sont pas valides
        $_SESSION['message'] = "❌ La quantité n'a pas été changée";
    }

    // ➤ Redirection vers le récapitulatif
    header("Location:recap.php");
}


if(isset($_GET["action"])){
    switch($_GET["action"]){
        case "add": if(isset($_POST['submit'])){// Vérifie si le formulaire a été soumis

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
               $_SESSION['message'] = "➕ Le produit ".$_POST['name']."a bien été ajouté";
           }else{
               $_SESSION['message'] = "❌ Le produit n'a pas été ajouté";
           }
           // Redirige l'utilisateur vers le formulaire après soumission
           header("Location:index.php");
       };break;
       case "delete": ;break;
       case "clear": ;break;
       case "up-qtt":if(isset($_GET["index"])){
        $tab;
        $index = $_GET["index"];
        foreach ($_SESSION['products'] as $indexb => $product) {
            if ($indexb == $index) {
                // ➤ Produit ciblé
                $product["qtt"] += 1;
                $_SESSION['message'] = "➕ La quantité de " . $product["name"] . " a bien été changée";

                if ($product["qtt"] < 1) {
                    // ➤ Si la quantité est inférieure à 1, on le supprime
                    $_SESSION['message'] = "❌ " . $product["name"] . " a bien été supprimé";
                    unset($product[$index]); // ⚠️ Erreur ici : tu essaies de supprimer une clé dans $product, pas dans $_SESSION
                    // => Rien à ajouter dans $tab dans ce cas
                } else {
                    // ➤ Met à jour le total
                    $product["total"] = $product["price"] * $product["qtt"];
                    $tab[] = $product; // ➤ Ajoute le produit mis à jour
                }
            } else {
                // ➤ Produit non ciblé, on le garde tel quel
                $tab[] = $product;
            }
        }
    }$_SESSION["products"] = $tab; header("Location:recap.php"); break;
       case "down-qtt": if(isset($_GET["index"])){
        $tab;
        $index = $_GET["index"];
        foreach ($_SESSION['products'] as $indexb => $product) {
            if ($indexb == $index) {
                // ➤ Produit ciblé
                $product["qtt"] -= 1;
                $_SESSION['message'] = "➕ La quantité de " . $product["name"] . " a bien été changée";

                if ($product["qtt"] < 1) {
                    // ➤ Si la quantité est inférieure à 1, on le supprime
                    $_SESSION['message'] = "❌ " . $product["name"] . " a bien été supprimé";
                    unset($product[$index]); // ⚠️ Erreur ici : tu essaies de supprimer une clé dans $product, pas dans $_SESSION
                    // => Rien à ajouter dans $tab dans ce cas
                } else {
                    // ➤ Met à jour le total
                    $product["total"] = $product["price"] * $product["qtt"];
                    $tab[] = $product; // ➤ Ajoute le produit mis à jour
                }
            } else {
                // ➤ Produit non ciblé, on le garde tel quel
                $tab[] = $product;
            }
        }
    }$_SESSION["products"] = $tab; header("Location:recap.php"); break;
    }
}

?>