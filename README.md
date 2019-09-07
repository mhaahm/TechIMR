# TechIMR
Pour installer l'application, il faut:
 * cloner le projet
 git clone https://github.com/mhaahm/TechIMR.git
 
 * lancer l'installation des dépendancs
 php composer.phar install or composer install
 
 * lancer la commande de migration
 php bin\console doctrine:migrations:migrate
 
 * lancer la commande pour importer le fichier de collecte
 php bin/console ACTParser <path ver le fichier xml>
  
 
 Pour les apis:
 
  * il faut lancer le serveur interne de php
  php bin\console server:run
  
  Voici un exemple
  http://127.0.0.1:8000/api/acts
 
