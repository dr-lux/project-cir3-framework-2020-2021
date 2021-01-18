# project-cir3-framework-2020-2021 - Readme FR 

Projet Framework Symfony et React
Calculateur de temps de plongée

Projet réalisé par
Julien Marquet
Titouan Allain

Supervisé par
Christophe Vignaud
Fabien Canu

Semestre 1
Année 2020 - 2021


Ce projet de calculateur de temps de plongée ce décompose en deux partie:

Un partie front-end pour l'utilisateur en React et une partie back-end pour l'administrateur en Symfony.

NB: Les informations suivantes sont pour une mise en route du service en mode dev, pour le mode prod, veuillez vous renseignez sur les compilations des codes des frameworks.

# Symfony

Après avoir modifié à votre convenance le fichier de configuration `.env`, vous pouvez lancer votre serveur Symfony depuis le repertoire `symf-cir3-prj` la commande:

`symfony server:start -d`

# React
Front end de l'application
## API
Les routes sont modifiables dans le fichier paths.json :

 - `staticUrl` : url "statique" de l'api, c'est la partie fixe de l'url http://[ip server]/
 - autres urls sont pour target l'api Symfony.
