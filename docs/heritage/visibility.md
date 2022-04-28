# Visibilité

Les propriétés et méthodes d'une classe peuvent être mises à disposition de toute partie du code ou restreintes à une partie seulement.

## `public`

C'est "open bar".

Les propriétés sont accessibles et modifiables **depuis n'importe quelle partie du code** (code interne à la classe et code externe à la classe).

Les méthodes peuvent être appelés **depuis n'importe quelle partie du code** (code interne à la classe et code externe à la classe).

## `private`

C'est "fermé à clés".

Les propriétés sont accessibles et modifiables **uniquement depuis le code interne à la classe**.

Les méthodes peuvent être appelées **uniquement depuis le code interne à la classe**.

## `protected`

C'est "pour la famille".

![The Godfather](https://media.giphy.com/media/l0Iy89owS5CYP7Hk4/giphy-downsized.gif)

Les propriétés sont accessibles et modifiables **depuis le code interne à la classe, et le code interne des classes enfants (descendants) et parents (ancêtres).**

Les méthodes peuvent être appelées **depuis le code interne à la classe, et le code interne des classes enfants (descendants) et parents (ancêtres).**

Dans notre exemple avec Animal, Chien et EpagneulBreton où Chien hérite d'Animal et EpagneulBreton hérite de Chien, la méthode aboyer() déclarée en visibilité `protected` est accessible dans la classe EpagneulBreton et aussi (même si c'est moins courant comme usage) dans la classe Animal.



## Analogie

_Je suis dans ma maison, et toutes les portes et fenêtres sont grandes ouvertes_ => `public`

_Je suis dans ma maison, et j'ai fermé les fenêtres et les portes à double-tour_ => `private`

_Je suis dans ma maison, et j'ai fermé les fenêtres et les portes à double-tour, mais j'ai donné un double des clés à mes parents et à mes enfants_ => `protected`

