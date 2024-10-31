# Deefy

## Description

Ce projet web en php est le fruit de tous les TD réalisés durant le module DevWeb S3. 
C'est un site de gestion de playlists d'utilisateurs rattaché à un base de données.
Un utilisateur s'identifie et peut accéder à ses morceaux de musique et modifier le contenu de sa session.

## Table des matières

- [Fonctionnalités](#fonctionnalités)
- [Utilisation](#utilisation)
- [Tests](#tests)

## Fonctionnalités 

-mes playlists : affiche la liste des playlists de l’utilisateur authentifié ; chaque élément de la
liste est cliquable et permet d’afficher une playlist qui devient la playlist courante ; stockée
en session.

-créer une playlist vide : un formulaire permettant de saisir le nom d’une nouvelle playlist est
affiché. A la validation, la playlist est créée et stockée en BD ; elle devient la playlist
courante.

-Afficher la playlist courante : affiche la playlist stockée en session.

-S’inscrire : création d’un compte utilisateur avec le rôle STANDARD.

-s’authentifier : fournir ses credentials pour s’authentifier en tant qu’utilisateur enregistré.
