
CREATE TABLE `%{database.entities.carrier_equivalence.table}`
(
    `id`              int(11)         UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_carrier`      int(10)         UNSIGNED NOT NULL,
    `equivalence`     varchar(100)    NOT NULL
) ENGINE = `%{db.var.engine}`
  DEFAULT CHARSET = `utf8`
;
