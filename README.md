Ceci est un site de boucherie en ligne
Pour le moment:
On y retrouve la liste de tous les animaux, 
le détail d'un animal


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

Querybuilder dans AnimalRepository OK, appelé depuis le controlleur AnimalController. Cependant l'adresse doit être écrite en dur dans l'url "/filterByBreed/{id}", pour le moment aucun lien n'appelle cette route. J'ai commencé à mettre un if POST dans la route de l'index animal

TODO:afficher ds templates: "Producteurs qui produisent la race XX avec méthode crée dans ProducerRepository" et essayer "Producteur de l'animal XX"

TODO:formulaire d'ajout d'un animal, d'une race et d'un producteur
        ATTENTION:  en entrant la FK producerid dans Animal, celle ci doit etre égale à la même FK de sa breed_id

TODO: refaire certains fakers inappropriés

TODO: stylisé un peu les templates


