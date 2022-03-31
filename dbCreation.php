<?php 
$sqlTableCreation = 'CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `pseudo_user` varchar(45) NOT NULL,
  `mail_user` varchar(45) DEFAULT NULL,
  `psw_user` varchar(255) DEFAULT NULL,
  `admin_user` int(11) DEFAULT NULL,
  `deleted_user` int(11) DEFAULT NULL,
  `lastPseudoChange` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `pseudo_user` (`pseudo_user`),
  ADD UNIQUE KEY `pseudo_user_2` (`pseudo_user`);

ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;';