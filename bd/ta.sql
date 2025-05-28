DROP DATABASE IF EXISTS ta;
CREATE DATABASE ta;
USE ta;


CREATE TABLE `ccxent` (
  `ident` bigint(11) NOT NULL,
  `idvdia` bigint(11) NOT NULL,
  `idvcol` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `dominio` (
  `iddom` bigint(11) NOT NULL,
  `nomdom` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `dominio` (`iddom`, `nomdom`) VALUES
(1, 'Tipo de permiso'),
(2, 'Area'),
(3, 'Dotación'),
(4, 'Talla CC'),
(5, 'Talla P'),
(6, 'Talla Z'),
(7, 'Talla G'),
(8, 'Colores'),
(9, 'Días');

CREATE TABLE `dotacion` (
  `ident` bigint(11) NOT NULL,
  `idperent` bigint(11) NOT NULL,
  `idperrec` bigint(11) NOT NULL,
  `fecent` date DEFAULT NULL,
  `observ` varchar(1000) DEFAULT NULL,
  `estent` bigint(11) NOT NULL,
  `firpent` varchar(255) DEFAULT NULL,
  `firprec` varchar(255) DEFAULT NULL,
  `fecdev` datetime DEFAULT NULL,
  `idperentd` bigint(11) DEFAULT NULL,
  `idperrecd` bigint(11) DEFAULT NULL,
  `observd` varchar(1000) DEFAULT NULL,
  `difent` varchar(50) DEFAULT NULL,
  `rutpdf` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `dotxent` (
  `ident` bigint(11) NOT NULL,
  `idvdot` bigint(11) NOT NULL,
  `idvtal` bigint(11) NOT NULL,
  `cant` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `jefxper` (
  `idjef` bigint(11) DEFAULT NULL,
  `idper` bigint(11) DEFAULT NULL,
  `tipjef` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `jefxper` (`idjef`, `idper`, `tipjef`) VALUES
(1, 2, 1),
(2, 1, 1);

CREATE TABLE `formato` (
    `idfor` bigint(11) NOT NULL, 
    `nomfor` varchar(50) NOT NULL,
    `codfor` varchar(25) DEFAULT NULL,
    `fecfor` date NOT NULL,
    `nomsec1` varchar(100) DEFAULT NULL,                                         
    `pre1` varchar(255) DEFAULT NULL,                                         
    `pre2` varchar(255) DEFAULT NULL,                                         
    `pre3` varchar(255) DEFAULT NULL,                                         
    `pre4` varchar(255) DEFAULT NULL,                                         
    `pre5` varchar(255) DEFAULT NULL,                                         
    `nomsec2` varchar(100) DEFAULT NULL,                                         
    `pre6` varchar(255) DEFAULT NULL,                                         
    `pre7` varchar(255) DEFAULT NULL,                                         
    `pre8` varchar(255) DEFAULT NULL,                                         
    `pre9` varchar(255) DEFAULT NULL,                                         
    `pre10` varchar(255) DEFAULT NULL,                                         
    `nomsec3` varchar(100) DEFAULT NULL,                                         
    `pre11` varchar(255) DEFAULT NULL,                                         
    `pre12` varchar(255) DEFAULT NULL,                                         
    `pre13` varchar(255) DEFAULT NULL,                                         
    `pre14` varchar(255) DEFAULT NULL,                                         
    `pre15` varchar(255) DEFAULT NULL,
    `nomsec4` varchar(100) DEFAULT NULL,                                         
    `pre16` varchar(255) DEFAULT NULL,
    `pre17` varchar(255) DEFAULT NULL,
    `pre18` varchar(255) DEFAULT NULL,
    `pre19` varchar(255) DEFAULT NULL,
    `pre20` varchar(255) DEFAULT NULL,
    `nomsec5` varchar(100) DEFAULT NULL,                                         
    `pre21` varchar(255) DEFAULT NULL,
    `pre22` varchar(255) DEFAULT NULL,
    `pre23` varchar(255) DEFAULT NULL,
    `pre24` varchar(255) DEFAULT NULL,
    `pre25` varchar(255) DEFAULT NULL,
    `porjef` int(2) DEFAULT NULL,
    `porpar` int(2) DEFAULT NULL,
    `poraut` int(2) DEFAULT NULL,
    `porsub` int(2) DEFAULT NULL,
    `actfor` tinyint(1) NOT NULL DEFAULT 1
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `respuesta` (
    `idres` bigint(11) NOT NULL, 
    `ideva` bigint(11) NOT NULL,
    `res1` float(1) DEFAULT NULL,                                         
    `res2` float(1) DEFAULT NULL,                                         
    `res3` float(1) DEFAULT NULL,                                         
    `res4` float(1) DEFAULT NULL,                                         
    `res5` float(1) DEFAULT NULL,                                         
    `res6` float(1) DEFAULT NULL,                                         
    `res7` float(1) DEFAULT NULL,                                         
    `res8` float(1) DEFAULT NULL,                                         
    `res9` float(1) DEFAULT NULL,                                         
    `res10` float(1) DEFAULT NULL,                                         
    `res11` float(1) DEFAULT NULL,                                         
    `res12` float(1) DEFAULT NULL,                                         
    `res13` float(1) DEFAULT NULL,                                         
    `res14` float(1) DEFAULT NULL,                                         
    `res15` float(1) DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `evaluacion` (
    `ideva` bigint(11) NOT NULL,
    `idpereval` bigint(11) NOT NULL,                                        
    `idperevald` bigint(11) NOT NULL,
    `feceva` date
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `modulo` (
  `idmod` int(5) NOT NULL,
  `nommod` varchar(100) NOT NULL,
  `imgmod` varchar(255) DEFAULT NULL,
  `actmod` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `modulo` (`idmod`, `nommod`, `imgmod`, `actmod`) VALUES
(1, 'Configuración', 'img/mod_configuracion.png', 1),
(2, 'Talento Humano', 'img/mod_novedades.png', 1);

CREATE TABLE `pagina` (
  `idpag` bigint(11) NOT NULL,
  `icono` varchar(255) NOT NULL,
  `nompag` varchar(25) NOT NULL,
  `arcpag` varchar(100) NOT NULL,
  `ordpag` int(3) NOT NULL,
  `menpag` varchar(30) NOT NULL,
  `mospag` tinyint(1) DEFAULT NULL,
  `idmod` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `pagina` (`idpag`, `icono`, `nompag`, `arcpag`, `ordpag`, `menpag`, `mospag`, `idmod`) VALUES
(101, 'fa fa-solid fa-cubes', 'Módulos', 'views/vmod.php', 1, 'home.php', 1, 1),
(102, 'fa fa-regular fa-file', 'Paginas', 'views/vpag.php', 2, 'home.php', 1, 1),
(103, 'fa fa-solid fa-user', 'PagxPef', 'views/vpgxf.php', 3, 'home.php', 2, 1),
(104, 'fa fa-solid fa-address-card', 'Perfil', 'views/vpef.php', 4, 'home.php', 1, 1),
(105, 'fa fa-solid fa-user', 'PerxPef', 'views/vperxf.php', 5, 'home.php', 2, 1),
(106, 'fa fa-solid fa-user', 'Personas', 'views/vper.php', 6, 'home.php', 1, 1),
(107, 'fa fa-solid fa-boxes-stacked', 'Dominio', 'views/vdom.php', 7, 'home.php', 1, 1),
(108, 'fa fa-solid fa-dollar-sign', 'Valor', 'views/vval.php', 8, 'home.php', 1, 1),
(109, 'fa fa-solid fa-list-ol', 'Formatos', 'views/vfor.php', 9, 'home.php', 1, 2),
(110, 'fa fa-solid fa-solid fa-lightbulb', 'Dotación', 'views/vdot.php', 10, 'home.php', 1, 2),
(111, 'fa fa-solid fa-file-circle-check', 'Permisos', 'views/vprm.php', 11, 'home.php', 1, 2),
(112, 'fa fa-solid fa-square-poll-vertical', 'Evaluación', 'views/veva.php', 12, 'home.php', 1, 2);
-- (112, 'fa fa-solid fa-square-poll-vertical', 'Calificación', 'views/vres.php', 12, 'home.php', 1, 2),

CREATE TABLE `pagxpef` (
  `idpag` bigint(11) NOT NULL,
  `idpef` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `pagxpef` (`idpag`, `idpef`) VALUES
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(109, 2),
(110, 1),
(110, 2),
(110, 3),
(111, 1),
(111, 2),
(111, 3),
(112, 1),
(112, 2),
(112, 3);

CREATE TABLE `pefxmod` (
  `idmod` int(5) NOT NULL,
  `idpef` bigint(11) NOT NULL,
  `idpag` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `pefxmod` (`idmod`, `idpef`, `idpag`) VALUES
(1, 1, 101),
(2, 1, 111),
(2, 2, 111),
(2, 3, 111);

CREATE TABLE `perfil` (
  `idpef` bigint(11) NOT NULL,
  `nompef` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `perfil` (`idpef`, `nompef`) VALUES
(1, 'SuperAdmin'),
(2, 'Talento humano'),
(3, 'Colaborador');

CREATE TABLE `permiso` (
  `idprm` bigint(11) NOT NULL,
  `noprm` bigint(11) DEFAULT NULL,
  `fecini` datetime DEFAULT NULL,
  `fecfin` datetime DEFAULT NULL,
  `idjef` bigint(11) NOT NULL,
  `idvtprm` bigint(11) NOT NULL,
  `sptrut` varchar(255) DEFAULT NULL,
  `desprm` varchar(250) DEFAULT NULL,
  `obsprm` varchar(250) DEFAULT NULL,
  `estprm` tinyint(1) DEFAULT NULL,
  `idper` bigint(11) NOT NULL,
  `fecsol` date DEFAULT NULL,
  `fecrev` date DEFAULT NULL,
  `idrev` bigint(11) DEFAULT NULL,
  `rutpdf` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `persona` (
  `idper` bigint(11) NOT NULL,
  `nomper` varchar(100) NOT NULL,
  `apeper` varchar(50) NOT NULL,
  `emaper` varchar(255) NOT NULL,
  `telper` varchar(10) DEFAULT NULL,
  `ndper` varchar(12) NOT NULL,
  `actper` tinyint(1) DEFAULT 1,
  `area` bigint(11) NOT NULL,
  `idfor` bigint(11) DEFAULT NULL,
  `hashl` tinytext DEFAULT NULL,
  `salt` tinytext DEFAULT NULL,
  `token` tinytext DEFAULT NULL,
  `feccam` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `persona` (`idper`, `nomper`, `apeper`, `emaper`, `telper`, `ndper`, `actper`, `area`, `idfor`, `hashl`, `salt`, `token`, `feccam`) VALUES
(1, 'Nicole Adamarys', 'Rodriguez Estevez', 'rodriada24@gmail.com', NULL, '1071328321', 1, 9, NULL, '7bb5f4680f2b1ef09d1ff9f4a2502ec2', 'b139771e98bf5e9bb807302f0fb0bd68', NULL, NULL),
(2, 'Juan David', 'Chaparro Dominguez', 'juanda.chapar@gmail.com', NULL, '1072642921', 1, 9, NULL, '7bb5f4680f2b1ef09d1ff9f4a2502ec2', 'b139771e98bf5e9bb807302f0fb0bd68', NULL, NULL);

CREATE TABLE `perxpef` (
  `idper` bigint(11) NOT NULL,
  `idpef` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `perxpef` (`idper`, `idpef`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(2, 3);

CREATE TABLE `valor` (
  `idval` bigint(11) NOT NULL,
  `nomval` varchar(70) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `iddom` bigint(11) DEFAULT NULL,
  `codval` bigint(11) DEFAULT NULL,
  `actval` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `valor` (`idval`, `nomval`, `iddom`, `codval`, `actval`) VALUES
(1, 'Calamidad domestica', 1, 101, 1),
(2, 'Cita medica', 1, 102, 1),
(3, 'Licencia Maternidad/paternidad', 1, 103, 1),
(4, 'No remunerado', 1, 104, 1),
(5, 'Trabajo en casa', 1, 105, 1),
(6, 'Dia Cumpleaños', 1, 106, 1),
(7, 'Vacaciones', 1, 107, 1),
(8, 'Otro', 1, 108, 1),
(9, 'Directivos', 2, 201, 1),
(10, 'Logistica', 2, 202, 1),
(11, 'Ventas', 2, 203, 1),
(12, 'Pantalón', 3, 301, 1),
(13, 'Camisa', 3,302, 1),
(14, 'Chaqueta', 3, 303, 1),
(15, 'Botas', 3, 304, 1),
(16, 'Guantes', 3, 305, 1),
(17, 'XS', 4, 401, 1),
(18, 'S', 4, 402, 1),
(19, 'M', 4, 403, 1),
(20, 'L', 4, 404, 1),
(21, 'XL', 4, 405, 1),
(22, 'XXL', 4, 406, 1),
(23, '28', 5, 501, 1),
(24, '30', 5, 502, 1),
(25, '32', 5, 503, 1),
(26, '34', 5, 504, 1),
(27, '36', 5, 505, 1),
(28, '36', 6, 601, 1),
(29, '37', 6, 602, 1),
(30, '38', 6, 603, 1),
(31, '39', 6, 604, 1),
(32, '40', 6, 605, 1),
(33, '41', 6, 606, 1),
(34, '42', 6, 607, 1),
(35, '43', 6, 608, 1),
(36, '44', 6, 609, 1),
(37, '4', 7, 701, 1),
(38, '5', 7, 702, 1),
(39, '6', 7, 703, 1),
(40, '7', 7, 704, 1),
(41, '8', 7, 705, 1),
(42, '9', 7, 706, 1),
(43, '10', 7, 707, 1),
(44, '11', 7, 708, 1),
(45, 'Gris', 8, 801, 1),
(46, 'Negro', 8, 802, 1),
(47, 'Vino tinto', 8, 803, 1),
(48, 'Azul oscuro', 8, 804, 1),
(49, 'Azul rey', 8, 805, 1),
(50, 'Beige', 8, 806, 1),
(51, 'Lunes', 9, 901, 1),
(52, 'Martes', 9, 902, 1),
(53, 'Miércoles', 9, 903, 1),
(54, 'Jueves', 9, 904, 1),
(55, 'Viernes', 9, 905, 1),
(56, 'Sábado', 9, 906, 1);

ALTER TABLE `ccxent`
  ADD KEY `ident` (`ident`),
  ADD KEY `idvdia` (`idvdia`),
  ADD KEY `idvcol` (`idvcol`);

ALTER TABLE `dominio`
  ADD PRIMARY KEY (`iddom`);

ALTER TABLE `dotacion`
  ADD PRIMARY KEY (`ident`),
  ADD KEY `idperent` (`idperent`),
  ADD KEY `idperrec` (`idperrec`),
  ADD KEY `idperentd` (`idperentd`),
  ADD KEY `idperrecd` (`idperrecd`),
  ADD KEY `estent` (`estent`);

ALTER TABLE `dotxent`
  ADD KEY `ident` (`ident`),
  ADD KEY `idvdot` (`idvdot`),
  ADD KEY `idvtal` (`idvtal`);

ALTER TABLE `jefxper`
  ADD KEY `idper` (`idper`),
  ADD KEY `idjef` (`idjef`);

ALTER TABLE `formato`
  ADD PRIMARY KEY (`idfor`);  

ALTER TABLE `respuesta`
  ADD PRIMARY KEY (`idres`),
  ADD KEY `ideva` (`ideva`);

ALTER TABLE `evaluacion`
  ADD PRIMARY KEY (`ideva`),
  ADD KEY `idpereval` (`idpereval`),
  ADD KEY `idperevald` (`idperevald`);

ALTER TABLE `modulo`
  ADD PRIMARY KEY (`idmod`);

ALTER TABLE `pagina`
  ADD PRIMARY KEY (`idpag`),
  ADD KEY `idmod` (`idmod`);

ALTER TABLE `pagxpef`
  ADD KEY `idpag` (`idpag`),
  ADD KEY `idpef` (`idpef`);

ALTER TABLE `pefxmod`
  ADD KEY `idmod` (`idmod`),
  ADD KEY `idpef` (`idpef`),
  ADD KEY `idpag` (`idpag`);

ALTER TABLE `perfil`
  ADD PRIMARY KEY (`idpef`);

ALTER TABLE `permiso`
  ADD PRIMARY KEY (`idprm`),
  ADD KEY `idjef` (`idjef`),
  ADD KEY `idvtprm` (`idvtprm`),
  ADD KEY `idper` (`idper`);

ALTER TABLE `persona`
  ADD PRIMARY KEY (`idper`),
  ADD KEY `area` (`area`),
  ADD KEY `idfor` (`idfor`);

ALTER TABLE `perxpef`
  ADD KEY `idper` (`idper`),
  ADD KEY `idpef` (`idpef`);

ALTER TABLE `valor`
  ADD PRIMARY KEY (`idval`),
  ADD KEY `iddom` (`iddom`);

ALTER TABLE `dominio`
  MODIFY `iddom` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `dotacion`
  MODIFY `ident` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `modulo`
  MODIFY `idmod` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `pagina`
  MODIFY `idpag` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

ALTER TABLE `perfil`
  MODIFY `idpef` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `permiso`
  MODIFY `idprm` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `persona`
  MODIFY `idper` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `valor`
  MODIFY `idval` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

ALTER TABLE `formato`
  MODIFY `idfor` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `respuesta`
  MODIFY `idres` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `evaluacion`
  MODIFY `ideva` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `ccxent`
  ADD CONSTRAINT `ccxent__ibfk_1` FOREIGN KEY (`ident`) REFERENCES `dotacion` (`ident`);

ALTER TABLE `dotacion`
  ADD CONSTRAINT `dotacion_ibfk_1` FOREIGN KEY (`idperent`) REFERENCES `persona` (`idper`),
  ADD CONSTRAINT `dotacion_ibfk_2` FOREIGN KEY (`idperrec`) REFERENCES `persona` (`idper`),
  ADD CONSTRAINT `dotacion_ibfk_3` FOREIGN KEY (`idperentd`) REFERENCES `persona` (`idper`),
  ADD CONSTRAINT `dotacion_ibfk_4` FOREIGN KEY (`idperrecd`) REFERENCES `persona` (`idper`);

ALTER TABLE `dotxent`
  ADD CONSTRAINT `dotxent__ibfk_1` FOREIGN KEY (`ident`) REFERENCES `dotacion` (`ident`);

ALTER TABLE `jefxper`
  ADD CONSTRAINT `jefxper_ibfk_1` FOREIGN KEY (`idper`) REFERENCES `persona` (`idper`),
  ADD CONSTRAINT `jefxper_ibfk_2` FOREIGN KEY (`idjef`) REFERENCES `persona` (`idper`);

ALTER TABLE `respuesta`
  ADD CONSTRAINT `respuesta_ibfk_1` FOREIGN KEY (`ideva`) REFERENCES `evaluacion` (`ideva`);

ALTER TABLE `evaluacion`
  ADD CONSTRAINT `evaluacion_ibfk_1` FOREIGN KEY (`idpereval`) REFERENCES `persona` (`idper`),
  ADD CONSTRAINT `evaluacion_ibfk_2` FOREIGN KEY (`idperevald`) REFERENCES `persona` (`idper`);

ALTER TABLE `pagina`
  ADD CONSTRAINT `pagina_ibfk_1` FOREIGN KEY (`idmod`) REFERENCES `modulo` (`idmod`);

ALTER TABLE `pagxpef`
  ADD CONSTRAINT `pagxpef_ibfk_1` FOREIGN KEY (`idpag`) REFERENCES `pagina` (`idpag`),
  ADD CONSTRAINT `pagxpef_ibfk_2` FOREIGN KEY (`idpef`) REFERENCES `perfil` (`idpef`);

ALTER TABLE `pefxmod`
  ADD CONSTRAINT `pefxmod_ibfk_1` FOREIGN KEY (`idmod`) REFERENCES `modulo` (`idmod`),
  ADD CONSTRAINT `pefxmod_ibfk_2` FOREIGN KEY (`idpef`) REFERENCES `perfil` (`idpef`);

ALTER TABLE `permiso`
  ADD CONSTRAINT `permiso_ibfk_1` FOREIGN KEY (`idjef`) REFERENCES `persona` (`idper`),
  ADD CONSTRAINT `permiso_ibfk_2` FOREIGN KEY (`idper`) REFERENCES `persona` (`idper`);

ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`idfor`) REFERENCES `formato` (`idfor`);

ALTER TABLE `perxpef`
  ADD CONSTRAINT `perxpef_ibfk_1` FOREIGN KEY (`idpef`) REFERENCES `perfil` (`idpef`),
  ADD CONSTRAINT `perxpef_ibfk_2` FOREIGN KEY (`idper`) REFERENCES `persona` (`idper`);

ALTER TABLE `valor`
  ADD CONSTRAINT `valor_ibfk_1` FOREIGN KEY (`iddom`) REFERENCES `dominio` (`iddom`);