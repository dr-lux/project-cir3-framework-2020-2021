# project-cir3-framework-2020-2021

Compte-rendu de projet
Framework Symfony et React
Calculateur de temps de plongée



Projet réalisé par
Julien Marquet
Titouan Allain

Supervisé par
Christophe Vignaud
Fabien Canu

Semestre 1
Année 2020 - 2021
























Index

1-	Symfony
a.	Entité
b.	API
i.	URL des API
ii.	Description des API
c.	Méthodes CRUD
i.	Liste des entités CRUD-able
ii.	Exemples génériques des méthodes CRUD
1.	Créer
a.	readAll()
b.	read($id)
c.	readSelector()
2.	Lire
a.	New(Request $request)
3.	Éditer
a.	checkEditAvailable($id)
b.	edit(Request $request, Entité $entite)
c.	editSelector()
4.	Supprimer
a.	delete($id)
b.	deleteSelector()
2-	React
3-	Ressources
















Symfony

Entité

	Le cahier de charge initiale stipulait la nécessité de 3 entités pour réaliser la fonction première de l’application du projet, le calcul du temps de plongée en fonction d’une table de plongée (TablePlongee), d’une profondeur (Profondeur) et d’un temps donné (Temps).

Pour faciliter l’utilisateur dans l’interface de calcul de temps de plongée en front-end, nous avons rajouter une entité de paramètre par défaut (DefaultParam) pour permettre au service front-end de donner à l’utilisateur une configuration par défaut.

 


API
	La mise en place de ces API permettent un partage de ressources de base de données en backend pour notamment le serveur front-end.

URL des API

Attention : les liens cliquables ne fonctionneront uniquement si vous avez le serveur Symfony en cours d’exécution sur votre environnement de développement en local.

	http://localhost:8000/api/profondeur
	http://localhost:8000/api/profondeur/depth/{depth}
http://localhost:8000/api/temps
	http://localhost:8000/api/defaultParam	http://localhost:8000/api/temps/depth/{depth}/time/{time}

Description des API

-	@Route("/profondeur", name="api_profondeur")
	
	API pour avoir toutes les entrées de l’entité Profondeur.

-	@Route("/profondeur/depth/{depth}", name="api_profondeur_by_depth")

API pour avoir la première entrée de l’entité Profondeur qui à la bonne profondeur choisie.

-	@Route("/temps", name="api_temps")

	API pour avoir toutes les entrées de l’entité Temps.

-	@Route("/defaultParam", name="api_defaultParam")

	API pour avoir toutes les entrées de l’entité DefaultParam.

-	 @Route("/temps/depth/{depth}/time/{time}", name="api_Temps_by_Depth_and_Time")

	API pour avoir la première entrée de Temps en fonction d’une valeur de temps et d’une valeur de profondeur.

Méthodes CRUD

Liste des entités CRUD-able

Les entités ayant les fonctionnalités CRUD :

-	DefaultParam
-	TablePlongee
-	Profondeur
-	Temps

Exemples génériques des méthodes CRUD

Créer



