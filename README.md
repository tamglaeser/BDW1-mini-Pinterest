# Projet Final BDW1 : Application mini-Pinterest

Une page web pour photos organisées en catégories. On peut se connecter soit comme utilisateur soit comme administrateur. Tous les deux peuvent supprimer,
modifier, et ajouter des photos; l'utilisateur peut également cacher ses photos et voir son compte et l'administrateur peut voir les
statistiques de tous les utilisateurs ainsi que ajouter une categorie. On peut aussi voir les details des photos. De plus, tout est
basé sur une base de données avec une table Photo(<ins>photoId</ins>, nomFich, description, &#35;catId, &#35;utilId, statut), une table 
Categorie(<ins>catId</ins>, nomCat), une table administrateur(<ins>adminId</ins>, adminPseudo, adminMdp) et une table utilisateur(<ins>utilId</ins>, utilPseudo, utilMdp, etat).

On a commencé d'organiser notre programme avec le style en CSS et le reste dans les fichiers PHP/HTML.

Vous pouvez trouver notre présentation [ici](https://docs.google.com/presentation/d/1CnX2UKTs0m4WMiUYSfFnOpbxuXEd_v2zn0E4gZPTQQc/edit?usp=sharing).

## Pour Commencer

Cliquer sur ce lien pour retrouver [notre page web](https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/index.php). Lorsqu'il demande le sign-in,
c'est le suivant:
- username: p1926029
- mot de passe: ef5d0c  
 

On n'a pas besoin de conditions préalables.

## Workflow et Environnement

Le programme était développé **localement** dans l'IDE, après on a fait un `git commit` à notre local git repository et après on a fait un `git push` à [**forge.univ-lyon1.fr**](https://forge.univ-lyon1.fr/p1501149/bdw1_projet).
Puis on a fait un `git pull` de GitLab à notre directoire sur [**bdw1.univ-lyon1.fr**](https://bdw1.univ-lyon1.fr/) dont le web serveur a acces. Alternativement, on pourrait aussi simplement
modifier le programme en utilisant *Vim* sur bdw1.univ-lyon1.fr. Finalement, FileZilla est un autre moyen pour transmettre notre fichiers *directement* du local à bdw1.univ-lyon1.fr.

- **forge.univ-lyon1.fr**
  - *GitLab* - Git serveur
- **bdw1.univ-lyon1.fr**
  - Web serveur
    - port: 443 -- default pour HTTPS
  - Base de données
    - port: 3306 -- default pour MariaDB/MySQL
    - *phpMyAdmin* - pour réaliser et acéder la base de données
  - *Vim* - pour éditer le programme directement sur bdw1.univ-lyon1.fr
- **Local**
  - *PhpStorm* - JetBrains IDE, pour écrire le programme
  - *FileZilla* - un moyen de transmettre notre fichiers sur le serveur de l'université, de local à bdw1.univ-lyon1.fr  
- **Local >> bdw1.univ-lyon1.fr**
  - *Bash* - language d'Unix de shell et commande pour transmettre notre fichiers du local sur git et sur le serveur de l'université
    - *SSH* - connexion de l'host local a bdw1.univ-lyon1.fr
    - *Git* - local et sur bdw1.univ-lyon1.fr pour faire git clone, push, et pull de et à forge.univ-lyon1.fr



## Auteurs

**Tullia Glaeser** -- *l'Université de Claude Bernard Lyon 1, Tulane University* -- Base de données et Programmation WEB: A -- printemps 2020  
**Marine Masingarbe** -- *l'Université de Claude Bernard Lyon 1* -- Base de données et Programmation WEB: A -- printemps 2020