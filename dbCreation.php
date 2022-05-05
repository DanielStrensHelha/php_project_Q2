<?php 
$sqlTableCreation =
'CREATE TABLE users(
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo_user` varchar(25) NOT NULL,
  `mail_user` varchar(45) DEFAULT NULL,
  `psw_user` varchar(255) DEFAULT NULL,
  `admin_user` int(11) DEFAULT NULL,
  `deleted_user` int(11) DEFAULT NULL,
  `lastPseudoChange` date DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `mail_user` (`mail_user`),
  UNIQUE KEY `pseudo_user` (`pseudo_user`)
);

  CREATE TABLE guitarist(
  `id_guitarist` int(11) NOT NULL AUTO_INCREMENT,
  `name_guit` VARCHAR(25),
  `thumbnail_guit` VARCHAR(150),
  `ytbSample_guit` VARCHAR(150),
  `sptSample_guit` VARCHAR(150),
  `style_guit` VARCHAR(75),
  `wiki_hero` TEXT,
  `pic_guit` VARCHAR(150),
  `ytbLink_guit` VARCHAR(150),
  `ytbExplain_guit` TEXT,
  `ytbLinkBis_guit` VARCHAR(150),
  `ytbExplainBis_guit` TEXT,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY(`id_guitarist`),
  FOREIGN KEY(`id_user`) REFERENCES users(`id_user`)
  );

  CREATE TABLE comments(
  `id_comments` int(11) NOT NULL AUTO_INCREMENT,
  `date_com` DATETIME,
  `text_com` TEXT,
  `id_user` int(11) NOT NULL,
  `id_guitarist` int(11) NOT NULL,

  PRIMARY KEY(`id_comments`),
  FOREIGN KEY(`id_user`) REFERENCES users(`id_user`),
  FOREIGN KEY(`id_guitarist`) REFERENCES guitarist(`id_guitarist`)
  );

  CREATE TABLE contact(
  `id_contact` int(11) NOT NULL AUTO_INCREMENT,
  `text_cont` TEXT,
  `date_heure_cont` DATETIME,
  `pic_path_cont` VARCHAR(45),
  `id_user` int(11) NOT NULL,
  PRIMARY KEY(`id_contact`),
  FOREIGN KEY(`id_user`) REFERENCES users(`id_user`)
  );

  CREATE TABLE appreciation(
  `id_user` int(11),
  `id_guitarist` int(11),
  `likes` int(11),
  PRIMARY KEY(`id_user`, `id_guitarist`),
  FOREIGN KEY(`id_user`) REFERENCES users(`id_user`),
  FOREIGN KEY(`id_guitarist`) REFERENCES guitarist(`id_guitarist`)
  );

  ALTER TABLE `users` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;
  ALTER TABLE `guitarist` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;
  ALTER TABLE `comments` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;
  ALTER TABLE `contact` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;
  ALTER TABLE `appreciation` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;

  INSERT INTO users (pseudo_user, mail_user, psw_user, admin_user) 
  VALUES ("Admin", "adminTso@batso.tsoba", "$2y$10$qwtUVG7W2A1iQKaZo3S0ROk.Y2Chd73pI.D99Sz4qYMu0b9cnBmeK", 1);
';