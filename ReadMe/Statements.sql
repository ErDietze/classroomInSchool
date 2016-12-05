/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  PaulsBook
 * Created: 09.11.2016
 */

select * from schulklasse where id = 17;
select * from schueler;
DELETE FROM s, sk USING schueler s, schulklasse sk WHERE sk.id = s.schulklasse_id and sk.id = 12;

show table status

DELETE sk, s
      FROM schueler s
      JOIN schulklasse sk ON s.schulklasse_id = sk.id
     WHERE s.schulklasse_id = 17

SHOW CREATE TABLE schueler

ALTER TABLE `schueler` DROP FOREIGN KEY `schueler_ibfk_2`;

alter TABLE `schueler` 
  ADD CONSTRAINT `schueler_ibfk_1` FOREIGN KEY (`schulklasse_id`) REFERENCES `schulklasse` (`id`)

insert into schulklasse (name) values ('BAD');
insert into schueler (vorname, nachname, schulklasse_id) values ('paul','Kirchhoff',19);
insert into schueler (vorname, nachname, schulklasse_id) values ('Tom','Kirchhoff',19);
insert into schueler (vorname, nachname, schulklasse_id) values ('Luap','Kirchhoff',19);

Select * from schueler where schulklasse_id = ?

select * from schulklasse;