# Projet Final BDW1 : Application mini-Pinterest

Une page web pour photos organisées en catégories. On se pourrait connecter soit comme utilisateur soit comme administrateur. Tous les deux puevent supprimer,
modifier, et ajouter des photos; l'utilisateur peut également cacher ses photos et voir son compte et l'administrateur peut voir les
statistiques de tous les utilisateurs ainsi que ajouter une categorie. On peut aussi voir les details des photos. Enfin, c'est tout
basé sur une base de données avec une table Photo(<ins>photoId</ins>, nomFich, description, &#35;catId, &#35;utilId, statut), une table 
Categorie(<ins>catId</ins>, nomCat), une table administrateur(<ins>adminId</ins>, adminPseudo, adminMdp), et une table utilisateur(<ins>utilId</ins>, utilPseudo, utilMdp, etat).

## Pour Commencer

Cliquer sur ce lien pour retrouver notre page web: https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/index.php. S'il demande le sign-in pour https://bdw1.univ-lyon1.fr,
c'est le suivant:
- username: p1926029
- mot de passe: ef5d0c  
 

On n'a pas besoin des conditions préalables.

## Construit Avec

- **phpMyAdmin** - pour réaliser et acéder la base de données
  - type de serveur: MariaDB
  - user: p1926029@localhost
- **PhpStorm** de JetBrains IDEs- pour écrire le programme
- **Git** - logiciel système - et **Bash** - language d'Unix de shell et commande pour transmettre notre fichiers du local sur git et sur le serveur de l'université
- **FileZilla** - un moyen de transmettre notre fichiers sur le serveur de l'université


## Auteurs

**Tullia Glaeser** -- *l'Université de Claude Bernard Lyon 1, Tulane University* -- Base de données et Programmation WEB: 2A -- printemps 2020  
**Marine Masingarbe** -- *l'Université de Claude Bernard Lyon 1* -- Base de données et Programmation WEB: 2A -- printemps 2020