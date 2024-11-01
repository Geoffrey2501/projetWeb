# Deefy

## Description

Ce projet web en PHP est le fruit de tous les TD réalisés durant le module DevWeb S3. C'est un site de gestion de playlists d'utilisateurs rattaché à une base de données. Un utilisateur s'identifie et peut accéder à ses morceaux de musique et modifier le contenu de sa session.

## Table des matières

- [Fonctionnalités](#fonctionnalités)
- [Utilisation](#utilisation)
- [Tests](#tests)

## Fonctionnalités

- **Mes playlists** : Affiche la liste des playlists de l’utilisateur authentifié. Chaque élément de la liste est cliquable et permet d’afficher une playlist qui devient la playlist courante, stockée en session.

- **Créer une playlist vide** : Un formulaire permettant de saisir le nom d’une nouvelle playlist est affiché. À la validation, la playlist est créée et stockée en BD ; elle devient la playlist courante.

- **Afficher la playlist courante** : Affiche la playlist stockée en session.

- **S’inscrire** : Création d’un compte utilisateur avec le rôle STANDARD.

- **S’authentifier** : Fournir ses credentials pour s’authentifier en tant qu’utilisateur enregistré.

## Utilisation

Pour utiliser ce projet, suivez les étapes suivantes :

1. **Cloner le dépôt** :
   ```bash
   git clone https://github.com/Geoffrey2501/projetWeb.git
   
2. **Démarrer les service web Apache et mysql**

   ![image](https://github.com/user-attachments/assets/c00aeb97-ea2c-4fb2-b077-2e249e79e692)

3. **Executer le script de création des tables et d'insertion des données** :

   ```bash
   mysql -u root -p deefy < script.sql

5. **Lancer le programme principal main/index.php**
   
   ![image](https://github.com/user-attachments/assets/6d132718-8f52-4489-9ca5-aca8fb3458d6)


## Tests 

**Naviguer dans les différentes sections du site web**

**Pour tester une authentification** : 

   -Entrer email : user1@mail.com,
           mot de passe : user1

**Pour créer un nouveau compte utilisateur** :

   -Cliquer sur "S'inscrire" sur le formulaire d'inscription 
   
   Remplir les champs demander avec une email valide 
   et un mot de passe d'au moins 10 caratères dont 
   une lettre majuscule et minuscule, un caractère spécial 
   et un chiffre


 
