# 🛒 Projet : Gestion de Produits en Session PHP

## 📝 Description

Ce projet est une mini application web permettant d'ajouter des produits via un formulaire 🧾, de les stocker en session PHP 🧠, puis d'en afficher un récapitulatif clair et visuel 📊. L'interface est construite avec Tailwind CSS pour un rendu moderne et responsive 🎨.

## 🚀 Fonctionnalités

* ➕ Ajout de produits avec nom, prix et quantité
* 🧮 Calcul du total ligne par ligne et du total général
* 🗂 Stockage temporaire dans la session utilisateur
* 📋 Récapitulatif visuel sous forme de tableau
* 🔄 Navigation fluide entre ajout et récapitulatif

## 🛠 Technologies

* 🐘 PHP (sessions)
* 🌐 HTML5
* 🎨 Tailwind CSS (via CDN)

## 📂 Fichiers

* `index.php` : Formulaire d'ajout de produit
* `traitement.php` : Traitement des données et stockage en session
* `recap.php` : Affichage des produits enregistrés

## ⚙️ Installation

1. Cloner ou télécharger le projet dans un dossier de votre serveur local (ex : `htdocs` pour XAMPP).
2. Démarrer Apache via votre stack locale (XAMPP, WAMP, etc).
3. Accéder au projet via `http://localhost/nom_du_dossier/index.php` dans votre navigateur.

## 🧪 Utilisation

1. Saisir un nom, un prix et une quantité dans le formulaire.
2. Cliquer sur "Ajouter" ✅.
3. Cliquer sur le bouton "Recap" pour voir le récapitulatif 📑.
4. Les produits restent disponibles tant que la session est active.

## 💡 Améliorations possibles

* 🗑 Suppression de produit individuellement
* 💾 Sauvegarde en base de données
* 🔍 Validation côté client en JavaScript
* ⚡ Affichage dynamique en AJAX
