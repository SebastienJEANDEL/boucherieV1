# Requêtes o'Shop

## Exemple

<details><summary>Liste de tous les produits</summary>

```sql
SELECT *
FROM `product`
```

</details>

## Menu de navigation

<details><summary>Liste de toutes les catégories</summary>

```sql
SELECT * FROM `category`
```

</details>

<details><summary>Liste de toutes les marques</summary>

```sql
SELECT * FROM `brand`
```

</details>

<details><summary>Liste de tous les types</summary>

```sql
SELECT * FROM `type`

```

</details>

## Accueil

<details><summary>Liste des 5 catégories mises en avant triées par ordre d'apparition</summary>

```sql
SELECT * 
FROM category
WHERE home_order > 0
ORDER BY home_order ASC
LIMIT 5

SELECT picture, name, subtitle
FROM category
WHERE picture  IS NOT NULL
AND subtitle IS NOT NULL
ORDER BY home_order ASC
LIMIT 5
```

Ne pas utiliser l'opérateur & à la place du AND car ce n'est pas le même opérateur :
https://mariadb.com/kb/en/bitwise_and/

</details>

## Catégorie

<details><summary>Les données d'une catégorie en fonction de son id (par exemple id qui vaut 1)</summary>

```sql
SELECT * 
FROM brand
WHERE id = 1
```

</details>

<details><summary>La liste des produits qui appartiennent à une catégorie donnée (par exemple la catégorie avec l'id 5)</summary>

```sql
SELECT *
FROM product
WHERE category_id = 5
```

</details>

<details><summary>La liste des produits qui appartiennent à une catégorie donnée (avec le nom du type pour chaque produit)</summary>

```sql
SELECT `product`.*, `type`.`name` AS `type_name`
FROM `product`
INNER JOIN `type` ON `product`.`type_id` = `type`.`id`
WHERE `product`.`category_id` = 1
```

</details>

## Type

<details><summary>Les informations d'un type en fonction de son id</summary>

```sql
SELECT *
FROM `type`
WHERE `id` = 1
```

</details>

<details><summary>La liste des produits qui sont d'un type donné</summary>

```sql
SELECT *
FROM `product`
WHERE `type_id` = 1
```

</details>

## Marque

<details><summary>Les informations d'une marque en fonction de son id</summary>

```sql
SELECT *
FROM `brand`
WHERE `id` = 1
```

</details>

<details><summary>La liste des produits qui sont fabriqués par une marque donnée</summary>

```sql
SELECT *
FROM `product`
INNER JOIN `brand` ON `product`.`brand_id` = `brand`.`id`
WHERE `brand_id` = 1
```

</details>

<details><summary>La liste des produits qui sont fabriqués par une marque donnée (avec le nom du type de produit)</summary>

```sql
SELECT `product`.*, `type`.`name` AS `type_name`
FROM `product`
INNER JOIN `type` ON `product`.`type_id` = `type`.`id`
WHERE `brand_id` = 2
```

</details>

## Produit

<details><summary>Les données d'un produit à partir de son id (par exemple id vaut 2)</summary>

```sql
SELECT *
FROM product
WHERE id = 2
```

</details>

<details><summary>Les données d'un produit à partir de son id (qui vaut 6) ET le nom de la marque ET le nom de la catégorie</summary>

```sql
SELECT `product`.*, `category`.`name` AS `category_name`, `brand`.`name` AS `brand_name`
FROM `product`
INNER JOIN `category` ON `product`.`category_id` = `category`.`id`
INNER JOIN `brand` ON `product`.`brand_id` = `brand`.`id`
WHERE `product`.`id` = 6
```

</details>