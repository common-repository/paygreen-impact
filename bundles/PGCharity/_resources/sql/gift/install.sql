
CREATE TABLE `%{database.entities.gift.table}`
(
    `id`              int(11)         UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `reference`       varchar(100)    NOT NULL,
    `amount`          int(10)         UNSIGNED NOT NULL,
    `id_cart`         varchar(100)    NOT NULL,
    `id_partnership`  int(10)         UNSIGNED NOT NULL,
    `created_at`      int(10)         UNSIGNED NOT NULL,
    `status`          varchar(100)    NOT NULL
) ENGINE = `%{db.var.engine}`
  DEFAULT CHARSET = `utf8`
;

CREATE UNIQUE INDEX `UX_ID_CART` ON `%{database.entities.gift.table}` (`id_cart`);