[English version](#bdw1-final-project--mini-pinterest-app)  
[French version](#Projet-Final-BDW1--Application-mini-Pinterest)

# BDW1 Final Project : Mini-Pinterest App

A web page for organizing photos in categories. One can connect as either a user or an administrator. Both user and aministrator can delete, modify, and add photos; the user can also hide his/her photos and see his/her account information and the administrator can see the statistics of all the users as well as add a category. One can also see the details of each photo. Furthermore, this is based off of a database with the following tables: Photo(<ins>photoId</ins>, nomFich, description, &#35;catId, &#35;utilId, statut), Categorie(<ins>catId</ins>, nomCat), administrateur(<ins>adminId</ins>, adminPseudo, adminMdp), and utilisateur(<ins>utilId</ins>, utilPseudo, utilMdp, etat)[\*](#translation).

We have begun organizing our program with the style in CSS and the rest in PHP/HTML files.

One can find our presentation [here](https://docs.google.com/presentation/d/1CnX2UKTs0m4WMiUYSfFnOpbxuXEd_v2zn0E4gZPTQQc/edit?usp=sharing).

## To Begin

Click on this link to see [our web page](https://bdw1.univ-lyon1.fr/p1926029/BDW1-ProjetFinale/bdw1_projet/index.php). Use the following to sign in:
- username: p1926029
- password: ef5d0c  
 

There's no need for any prerequisited.

## Workflow and Environnement

The program was developed **locally** in the IDE, then we did a `git commit` to our local git repository, and lastly we did a `git push` to [**forge.univ-lyon1.fr**](https://forge.univ-lyon1.fr/p1501149/bdw1_projet).
Next we did a `git pull` from GitLab to our directory on [**bdw1.univ-lyon1.fr**](https://bdw1.univ-lyon1.fr/) which the web server has access to. Alternatively, one could also simply modify the program using *Vim* on bdw1.univ-lyon1.fr. Finally, FileZilla is another method of transmitting our files *directly* from the local environment to bdw1.univ-lyon1.fr.

- **forge.univ-lyon1.fr**
  - *GitLab* - Git server
- **bdw1.univ-lyon1.fr**
  - Web server
    - port: 443 -- default for HTTPS
  - Database
    - port: 3306 -- default for MariaDB/MySQL
    - *phpMyAdmin* - to realize and access the database
  - *Vim* - to edit the program directly on bdw1.univ-lyon1.fr
- **Local**
  - *PhpStorm* - JetBrains IDE, to write the program
  - *FileZilla* - a way to transmit our files to the university's server, from the local environment to bdw1.univ-lyon1.fr  
- **Local >> bdw1.univ-lyon1.fr**
  - *Bash* - Unix shell and command language to transmit our files from the local environment to git and to the university's server
    - *SSH* - connection from the local host to bdw1.univ-lyon1.fr
    - *Git* - local and on bdw1.univ-lyon1.fr to do git clone, push, and pull from and to forge.univ-lyon1.fr



## Authors

**Tullia Glaeser** -- *l'Université de Claude Bernard Lyon 1, Tulane University* -- Database and Web Programming: A -- Spring 2020  
**Marine Masingarbe** -- *l'Université de Claude Bernard Lyon 1* -- Database and Web Programming: A -- Spring 2020

##### \*I have left the table and variable names in their original french, however here is the translation: Photo(<ins>photoId</ins>, fileName, description, &#35;catId, &#35;utilId, status), Category(<ins>catId</ins>, catName), administrator(<ins>adminId</ins>, adminPseudo, adminPwd), and user(<ins>utilId</ins>, utilPseudo, utilPwd, state).<a name="translation"></a>


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
