<?php
session_start(); // ➤ Démarre la session PHP pour permettre le stockage des produits

// ➤ Incrémente la quantité d’un produit ciblé
function up_qtt() {
    if (isset($_GET["index"])) {
        $tab = []; // ➤ Tableau temporaire pour reconstruire la session
        $index = $_GET["index"];

        foreach ($_SESSION['products'] as $indexb => $product) {
            if ($indexb == $index) {
                // ➤ Produit ciblé
                $product["qtt"] += 1;
                $_SESSION['message'] = "➕ La quantité de " . $product["name"] . " a bien été changée";

                // ➤ Mise à jour du total
                $product["total"] = $product["price"] * $product["qtt"];
                $tab[] = $product;
            } else {
                // ➤ Produit non ciblé : conservé tel quel
                $tab[] = $product;
            }
        }

        $_SESSION["products"] = $tab;
        header("Location:recap.php");
    }
}

    // ➤ Diminue la quantité d’un produit ciblé
function down_qtt() {
    if (isset($_GET["index"])) {
        $tab = [];
        $index = $_GET["index"];

        foreach ($_SESSION['products'] as $indexb => $product) {
            if ($indexb == $index) {
                // ➤ Produit ciblé
                $product["qtt"] -= 1;
                $_SESSION['message'] = "➕ La quantité de " . $product["name"] . " a bien été changée";

                if ($product["qtt"] < 1) {
                    // ➤ Quantité tombée à 0 → produit supprimé
                    $_SESSION['message'] = "❌ " . $product["name"] . " a bien été supprimé";
                } else {
                    // ➤ Mise à jour du total
                    $product["total"] = $product["price"] * $product["qtt"];
                    $tab[] = $product;
                }
            } else {
                // ➤ Produit non ciblé
                $tab[] = $product;
            }
        }

        $_SESSION["products"] = $tab;
        header("Location:recap.php");
    }
}

// ➤ Ajoute un nouveau produit depuis le formulaire
function add() {
    if (isset($_POST['submit'])) {
        // ➤ Récupération sécurisée des données du formulaire
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
        $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);

        // ➤ Vérifie la validité des données
        if ($name && $price && $qtt) {
            // ➤ Création du produit
            $product = [
                "name" => $name,
                "price" => $price,
                "qtt" => $qtt,
                "total" => $price * $qtt
            ];

            // ➤ Ajoute le produit à la session
            $_SESSION['products'][] = $product;
            $_SESSION['message'] = "➕ Le produit " . $_POST['name'] . " a bien été ajouté";
        } else {
            // ➤ Données invalides
            $_SESSION['message'] = "❌ Le produit n'a pas été ajouté";
        }

        header("Location:index.php");
    }
}

// ➤ Supprime complètement un produit ciblé
function del() {
    if (isset($_GET["index"])) {
        $tab = [];
        $index = $_GET["index"];

        foreach ($_SESSION['products'] as $indexb => $product) {
            if ($indexb == $index) {
                // ➤ Produit ciblé pour suppression
                $_SESSION['message'] = "❌ " . $product["name"] . " a bien été supprimé";
                // ➤ Ne pas l'ajouter à $tab
            } else {
                // ➤ Produit non ciblé
                $tab[] = $product;
            }
        }

        $_SESSION["products"] = $tab;
        header("Location:recap.php");
    }
}

// ➤ Gestion centrale des actions selon le paramètre GET "action"
if (isset($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":
            add();
            break;

        case "delete":
            del();
            break;

        case "clear":
            // ➤ Supprime tous les produits du panier
            unset($_SESSION["products"]);
            $_SESSION['message'] = "❌ Le panier a été supprimé";
            header("Location:recap.php");
            break;

        case "up-qtt":
            up_qtt();
            break;

        case "down-qtt":
            down_qtt();
            break;
    }
}
?>
