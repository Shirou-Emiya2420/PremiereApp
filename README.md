# Projet : Gestion de Panier avec PHP & Sessions 🛒

## ✨ Description

Une application web simple qui permet d'ajouter, modifier, afficher ou supprimer des produits dans un panier, en utilisant uniquement PHP natif et les sessions. L'interface est moderne et responsive grâce à Tailwind CSS.

## 🔧 Fonctionnalités

* Ajout d'un produit avec nom, prix et quantité
* Affichage d'un tableau récapitulatif des produits
* Incrémentation/décrémentation de quantité
* Suppression d'un seul produit ou du panier complet
* Affichage dynamique de messages (succès/erreur)

## 📁 Structure des fichiers

* `index.php` : Formulaire d'ajout de produit
* `recap.php` : Tableau récapitulatif du panier
* `traitement.php` : Fichier qui gère toutes les actions (add, delete, up-qtt, down-qtt, clear)

## 📄 Technologies

* PHP natif (sessions)
* HTML5 / CSS3
* [Tailwind CSS](https://tailwindcss.com/) via CDN

## ⚙️ Installation

1. Copier les fichiers dans un dossier de votre serveur local (ex: `htdocs/mon_panier` pour XAMPP)
2. Démarrer Apache
3. Accéder à l'application via :

   ```
   http://localhost/mon_panier/index.php
   ```

## 🔍 Utilisation

* Remplir le formulaire (nom, prix, quantité)
* Cliquer sur **Ajouter** pour stocker le produit en session
* Cliquer sur **Voir le récapitulatif** pour accéder à `recap.php`
* Depuis la page de récapitulatif :

  * Utiliser "+" ou "-" pour modifier la quantité
  * Cliquer sur "Supprimer" pour retirer un produit
  * Cliquer sur "Tout supprimer" pour vider la session

## ✨ Améliorations possibles

* Persistance en base de données (MySQL)
* Affichage dynamique avec AJAX
* Ajout d'un système de connexion utilisateur
* Notifications avec timeout

## ✅ Objectif pédagogique

Ce projet est idéal pour apprendre :

* La gestion des sessions en PHP
* La manipulation de tableaux
* La structuration d'une mini-application modulaire
* L'intégration d'interfaces avec Tailwind CSS
