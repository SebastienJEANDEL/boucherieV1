# MCD à visualiser sur http://mocodo.wingi.net/

```
PIECE: piece code, animal code, piece category, piece name, piece weight
made, 0N PRODUCER, 11 ANIMAL, 11 PIECE, 11 ANIMAL
PRODUCER: producer code, name, picture, adress, contact, description

ANIMAL: animal code, product name, description, picture, health sheet, date of birth, slaughter date, producer code, race code
TYPE: type code, name, picture,
is tagged,0N PRODUCER, N1 RACE,0N PRODUCER, 1N TYPE

is a, 0N TYPE, 11 ANIMAL, 0N RACE, 11 ANIMAL
RACE: race code, name, advantages,type_id



```