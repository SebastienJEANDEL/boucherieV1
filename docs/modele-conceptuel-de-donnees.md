# MCD à visualiser sur http://mocodo.wingi.net/

```
ANIMAL: animal code, product name, description, picture, rate, health sheet, date of birth, slaughter date, producer code, type code, category code, race code, details
is tagged,0N PRODUCER, N1 RACE,0N PRODUCER, 1N TYPE
PRODUCER: producer code, name, picture, adress, contact
made, 0N PRODUCER, 11 ANIMAL
TYPE: type code, name, picture, race code, details
is a, 0N TYPE, 11 ANIMAL, 0N RACE, 11 ANIMAL
RACE: race code, name, advantages, 




```