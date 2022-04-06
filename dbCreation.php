<?php 
$sqlTableCreation = 'CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo_user` varchar(45) NOT NULL,
  `mail_user` varchar(45) DEFAULT NULL,
  `psw_user` varchar(255) DEFAULT NULL,
  `admin_user` int(11) DEFAULT NULL,
  `deleted_user` int(11) DEFAULT NULL,
  `lastPseudoChange` date DEFAULT NULL
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `mail_user` (`mail_user`),
  UNIQUE KEY `pseudo_user` (`pseudo_user`)
)

CREATE TABLE Contact( 
  `id_contact` int(11) NOT NULL AUTO_INCREMENT, 
  `text_cont` TEXT, 
  `date_heure_cont` DATETIME, 
  `pic_path_cont` varchar(45),
  `id_user` INT NOT NULL,
  PRIMARY KEY(`id_contact`), 
  FOREIGN KEY(`id_user`) REFERENCES Users(`id_user`) ,
  UNIQUE KEY `pic_path_cont` (`pic_path_cont`)
); 
';