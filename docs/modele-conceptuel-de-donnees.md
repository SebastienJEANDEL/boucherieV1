# MCD à visualiser sur http://mocodo.wingi.net/

```
PRODUCER: producer code, name, picture, adress, contact, description
Is a, 0N BREED, 11 ANIMAL
BREED: breed code, name, picture, advantage, specie code

Product By, 11 ANIMAL, 0N PRODUCER
ANIMAL: animal code, name, picture, description, health sheet, date of birth, slaughter date, producer code, race code
Is Tagged, 11 BREED, 0N SPECIE

PIECE: piece code, name, price, category, weight, status, publishedAt, animal code
Belongs to, 11 PIECE , ON ANIMAL
SPECIE: specie code, name, picture, description

```
# MCD avec la relation manyToMany producer-Breed
```
PRODUCER: producer code, name, picture, adress, contact, description
Distribute, 1N PRODUCER, 1N PRODUCT-RELATION
PRODUCT-RELATION: relation code, producer code, breed code
Distributed By, 1N BREED, 1N PRODUCT-RELATION

Produced By, 11 ANIMAL, 0N PRODUCER
ANIMAL: animal code, name, picture, description, health sheet, date of birth, slaughter date, producer code, race code
Is a, 0N BREED, 11 ANIMAL
BREED: breed code, name, picture, advantage, specie code

PIECE: piece code, name, price, category, weight, status, publishedAt, animal code
Belongs to, 11 PIECE , ON ANIMAL
SPECIE: specie code, name, picture, description
Is Tagged, 11 BREED, 0N SPECIE
```