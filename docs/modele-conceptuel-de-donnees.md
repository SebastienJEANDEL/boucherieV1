# MCD à visualiser sur http://mocodo.wingi.net/

```
PRODUCER: producer code, name, picture, adress, contact, description
Distribute, 1N PRODUCER, 1N BREED : relation code, producer , breed

Produced By, 11 ANIMAL, 0N PRODUCER
ANIMAL: animal code, name, picture, description, health sheet, birthdate, slaughter date
Is a, 0N BREED, 11 ANIMAL
BREED: breed code, name, picture, advantage

PIECE: piece code, name, price, category, weight, status, publishedAt
Belongs to, 11 PIECE , ON ANIMAL
SPECIE: specie code, name, picture, description
Is Tagged, 11 BREED, 0N SPECIE
```