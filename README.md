**Pierre Hansen, Projet 7 OpenClassroom, "Créez un web service exposant une API"**
### Instructions d'installation
#### Etape 1 - **Clonez le projet**

Pour ce faire rendez vous sur l'onglet "<> Code" sur la page du projet GitHub et cliquez sur le bouton vert "Code". Copiez ensuite le lien HTTPS.  

Puis clonez le projet avec la commande `git clone URL`.  

Rendez vous dans le dossier généré à l'aide de la commande `cd nom_du_dossier`

Réalisez dans le terminal la commande `composer install`.  

Paramétrez ensuite le fichier généré ".env" pour les informations de connexion à la base de données aux lignes commençant par "DATABASE_URL".

#### Etape 2- **Intégrez la base de donnée**

Depuis votre console saisissez `php bin/console doctrine:migrations:migrate`.

Ensuite saisissez la commande `php bin/console doctrine:fixtures:load` afin de charger les données exemples dans la base. 

A noter que le mot de passe pour les utilisateurs générés est "motdepasse". 

#### Etape 3- **Utilisation de l'API**

Démarrez le micro-serveur à l'aide de la commande "symfony server:start -d".

Pour accéder aux différentes ressources et collections, utilisez "/documentation" afin d'y retrouver les différentes URI et leur utilisation.


