# Mise en place héritage

- Identifier le code commun (celui qui est dupliqué dans plusieurs classes)
  - on peut s'aider de la comparaison de fichiers dans VSCode
- Mettre ce code commun dans une nouvelle classe
- Si besoin, modifier la visibilité des propriétés et méthodes qu'on souhaite partager en `protected` (si elles étaient en `private`) / sinon on peut laisser en `public` ou `protected`
- Ajouter les extends sur les classes "enfants" qui héritent de la nouvelle classe "parent"
- Inclure la nouvelle classe pour que PHP en prenne connaissance (l'inclusion doit se faire)
- Supprimer dans les classes "enfants" tout le code qui a été factorisé (centralisé) dans la classe "parent"