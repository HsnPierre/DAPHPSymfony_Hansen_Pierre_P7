**Pierre Hansen, Projet 7 OpenClassroom, "Créez un web service exposant une API"**
### Instructions d'installation
#### Etape 1 - **Créez votre dossier**

Choisissez le dossier dans lequel vous souhaitez cloner le dossier et initialisez-y Git à l'aide de GitBash en executant 'git init'.  

#### Etape 2- **Clonez le projet**

Pour se faire rendez vous sur l'onglet "<> Code" sur la page du projet GitHub et cliquez sur le bouton vert "Code". Copiez ensuite le lien HTTPS.  

Puis clonez le projet avec la commande 'git clone URL'.  

Réalisez dans le terminal la commande "composer install".  

Paramétrez ensuite le fichier généré ".env" pour les informations de connexion à la base de données.

#### Etape 3- **Intégrez la base de donnée**

Depuis votre console saisissez "symfony console" (ou "php bin/console") "doctrine:migrations:migrate".

Ensuite saisissez la commande "php bin/console doctrine:fixtures:load" afin de charger les data fixtures. 

A noter que le mot de passe pour les utilisateurs générés est "motdepasse". 

#### Etape 4- **Utilisation de l'API**

Hébergez en local le projet à l'aide de logiciels externes tels que MAMP par exemple, puis démarrez votre serveur en localhost ou à l'aide de symfony avec la commande "symfony server:start -d".

Ensuite, avec un logiciel tel que Postman, accédez à l'API depuis http://localhost ou http://127.0.0.1 en fonction de votre serveur.

Pour accéder aux différentes ressources et collections, utilisez "/api/documentation" afin d'y retrouver les différentes URI et leurs utilisations.


