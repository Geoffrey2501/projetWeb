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
   git clone https://github.com/votre-utilisateur/deefy.git
