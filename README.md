# MDLAP-2023

## Folder Structure
    .
    ├── assets # Contient bootstrap et fichiers css
    ├── bin # console Symfony
    ├── config # Contient packages Symfony
    ├── node_modules # Contient les modules node
    ├── public
        ├── build #npm
        ├── img # Contient les images necessaire à l'application
        ├── .htaccess # (à créer)
        └── index.php # Controlleur frontal
    ├── resources
        └── Sujet # Controlleur frontal
            ├── DiagrammeClasse
            ├── Parametres
            └── Sujet
    ├── src
        ├── Controller
        ├── Entity
        └── Repository
    ├── templates
        ├── HTMLelements
            ├── body.twig
            ├── footer.twig
            └──header.twig
        ├── accueil
        └── base.twig
    ├──  .env
    ├──  .gitignore
    ├──  README.md
    ├──  composer.json
    ├──  composer.lock
    ├──  package-lock.json
    └──  package.json
---

## Installation de l'environnement
### Wampserver
1. Installer [NodeJS LTS ou +](https://nodejs.org/en/download)
2. Installer [Scoop](https://scoop.sh) en ligne de commande
3. Installer [Symfony](https://symfony.com/download) en ligne de commande
4. Installer [Composer](https://getcomposer.org/download/)
5. cloner le projet
6. Ouvrir un terminal PowerShell dans le répertoire du dossier et taper la commande `composer install`
7. Taper la commande `npm install` puis `npm run build`

### Serveur production
Interne : 10.10.2.142 :80 (MDL) 10.10.2.142 :81(API)
Externe : SSH -L 127.0.0.1:1337:10.10.2.142:80 root@freesio.lyc-bonaparte.fr -p 22142

## configuration de Postman
1. Téléchargement de postman : https://www.postman.com/
2. Tutoriel postman : **`https://www.youtube.com/watch?v=vMdhZvmRPe0&ab_channel=NouvelleTechno`**


AP Maison des ligues - BTS SIO 2023 - DODERO ADRIEN - CROCHARD PASCAL - ESCULIER DYLAN
