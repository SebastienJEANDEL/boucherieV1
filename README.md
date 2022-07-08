Ceci est un site de boucherie en ligne
Pour le moment:
On y retrouve la liste de tous les animaux, 
le détail d'un animal
la liste de animaux d'une race définie par son id

Le formulaire d'ajout d'un animal (non stylisé et non déclaré dans AnimalController) 

DONE:
A ce stade, le projet contient:

les 5 tables

les controllers associés

les entités et leur relations

la méthode fixture:load

des exemples crées avec faker

des exemples d'animaux (table animal)
des exemples de races (table breed)
des exemple de producteurs (table producer)

une relation ManyToOne entre Animal et Breed

une relation ManyToMany entre Producer et Breed

affichage du template index (liste des animaux)
affichage du template show (détail avec la race de l'animal)

Querybuilder dans AnimalRepository OK, appelé depuis le controlleur AnimalController.TODO: Cependant l'adresse doit être écrite en dur dans l'url "/filterByBreed/{id}", pour le moment aucun lien n'appelle cette route. J'ai commencé à mettre un if POST dans la route de l'index animal. Je reverrai ça après avoir créé un form ajout animal.

 Users dont l'admin Seb ont été créés

 DONE: donner des droits: pour faire simple: 
        un anonyme peut voir la liste de tous les animaux,
        un user peut voir la page d'un animal, ne peut ni supprimer, ni ajouter un animal(pour le test, on laissera le bouton vert "ajouter un animal" visible,
        un manager peut ajouter un animal mais ne peut ni modifier supprimer, 
        le role admin ira partout
les autorisations pour user sont définies security.yaml
les autorisations pour manager sont définies en annotation de la méthode
les autorisations pour admin sont définies dans dans la méthode

DONE: créer un voter (un manager ne peut plus ajouter d'animal après 14h00) TODO:activer ce voter depuis add AnimalController. Trouver comment transmettre le $user

DONE: service: une méthode qui incremente le nombre de vue. 


TODO:formulaire d'ajout d'un animal, d'une race et d'un producteur
        ATTENTION:  en entrant la FK producerid dans Animal, celle ci doit etre égale à la même FK de sa breed_id
        Il faudra faire un where dans producer et mettre le texte "choisissez d'abord une race"
        Il faudra une première submission de formulaire quand Breed sera définie

TODO:afficher ds templates: "Producteurs qui produisent la race XX avec méthode crée dans ProducerRepository" et essayer "Producteur de l'animal XX"

TODO: conditionner la liste de tous les animaux, si un filtre "race" a été sélectionné

TODO: refaire certains fakers inappropriés

TODO: stylisé un peu les templates

TODO: ecouteur Kernel: compter le nombre de vue de chaque pièce

TODO: service: si j'ai plus de cing vue sur une pièce , son status doit passer en promo (status 2)

TODO: récupérer les image d'animaux issues d'une API externe


