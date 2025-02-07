-- Adminer 4.8.1 MySQL 8.0.40 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `ARTICLE`;
CREATE TABLE `ARTICLE` (
  `numArt` int NOT NULL AUTO_INCREMENT,
  `dtCreaArt` datetime DEFAULT CURRENT_TIMESTAMP,
  `dtMajArt` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `libTitrArt` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `libChapoArt` text COLLATE utf8mb3_unicode_ci,
  `libAccrochArt` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `parag1Art` text COLLATE utf8mb3_unicode_ci,
  `libSsTitr1Art` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `parag2Art` text COLLATE utf8mb3_unicode_ci,
  `libSsTitr2Art` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `parag3Art` text COLLATE utf8mb3_unicode_ci,
  `libConclArt` text COLLATE utf8mb3_unicode_ci,
  `urlPhotArt` varchar(70) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `numThem` int NOT NULL,
  PRIMARY KEY (`numArt`),
  KEY `ARTICLE_FK` (`numArt`),
  KEY `FK_ASSOCIATION_1` (`numThem`),
  CONSTRAINT `FK_ASSOCIATION_1` FOREIGN KEY (`numThem`) REFERENCES `THEMATIQUE` (`numThem`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

INSERT INTO `ARTICLE` (`numArt`, `dtCreaArt`, `dtMajArt`, `libTitrArt`, `libChapoArt`, `libAccrochArt`, `parag1Art`, `libSsTitr1Art`, `parag2Art`, `libSsTitr2Art`, `parag3Art`, `libConclArt`, `urlPhotArt`, `numThem`) VALUES
(1,	'2019-02-24 16:08:30',	'2025-02-07 00:48:43',	'Michel CORAJOUD, l’artisan de vos balades à Bordeaux.',	'À partir des années 2000, Le paysagiste Michel Corajoud a redonné un nouveau souffle aux balades bordelaises en réinventant les quais de la ville. Démolitions, réhabilitations, constructions. Découvrez l’impact de ces changements sur le quotidien de nos aînés.',	'À vous, nos aînés, je dédie ces mots, revivez avec nous les transformations des quais de Bordeaux.',	'Les quais de Bordeaux : un espace laissé pour compte.  Revivez Bordeaux avant les années 2000, avant les grands changements d’aujourd’hui. La ville industrielle, son port en déclin, l’activité commerciale déplacée vers Bassens et Le Verdon. Les quais abandonnés, envahis de hangars et de parkings, loin d’être accueillants. Le centre ville tournait le dos au fleuve, pollué et oublié, rendant toute activité nautique ou de loisirs quasi inexistante.\r\nPendant 45 ans, Jacques Chaban-Delmas a stabilisé Bordeaux sans amorcer de véritable transformation. En 1995, Alain Juppé a donné un second souffle à notre ville, en proposant un ‘concours’ pour un projet de réaménagement, à plusieurs architectes. Une poignée d’entre eux présentent leurs projets de réhabilitation des quais durant le premier mandat d’Alain Juppé pour renouer ce lien perdu avec la Garonne.\r\nUn projet visant à réhabiliter les quais est sélectionné celui de Michel CORAJOUD. Quai Sainte-Croix - Parc Saint-Michel, un parc paysager en bord de Garonne. Quai de la Douane - Place de la Bourse, un lieu de culture et de commerce. Quais Louis XVIII - Prairie des Girondins, prolongement des Quinconces jusqu’au fleuve.',	'&quot;Faire du paysage, c&#039;est faire du bien aux gens.&quot; Michel CORAJOUD',	'Vous avez toujours rêvé d’un Bordeaux paisible et accueillant. Un rêve partagé par Michel Corajoud, qui repense vos quais en mêlant nature et minéralité. Il veut vous faire redécouvrir Bordeaux sous un nouveau jour, jouer avec la lumière et réinventer un espace autrefois oublié.\r\n\r\nLes quais, emblème de Bordeaux, se transforment. La démolition du hangar 7 en 2000 marque un tournant. Le parvis est restructuré entre trottoirs, stationnements et tramway, révolution majeure du moment. Plus loin, le boulevard s’étire, bordé de chaussées et de verdure. Des matériaux solides sont choisis : céramique sous vos pieds, granit dans les contre-allées, grès pour les stationnements. Tout évolue sous vos yeux.\r\n\r\nLes quais ne sont plus réservés aux voitures : piétons, cyclistes et tramway y trouvent leur place. On ajuste sans détruire. Les façades demeurent, le sol change. Pavés, granit, grès, des choix durables. Le tramway s’intègre, les quais se réinventent en laissant derrière eux certains hangars.\r\n\r\nUn projet né avec la ville, pour la ville. Bordelais, urbanistes, élus : construisons ensemble les balades de demain.',	'L’héritage des quais : Une ville plus accessible pour nos aînés',	'Regardez comme vos quais ont changé, le temps a passé. Tout est pensé pour permettre à chacun de déambuler librement : trottoirs élargis, passages dégagés, bancs bien placés. Plus besoin de contourner des obstacles, la balade est fluide.\r\n\r\nDe nouveaux espaces ludiques apparaissent pour petits et grands, comme le parc pour enfants ou le skatepark. Des agrès sportifs encouragent l’activité physique. Bordeaux gagne en attractivité touristique, avec le miroir d’eau devenu emblématique.\r\n\r\nLes quais sont désormais un lieu de vie animé, avec des espaces verts, plus d’arbres et d’ombre. L’atmosphère est plus pure et moins polluée. Chaque pas invite à la contemplation. Bordeaux pour VOUS.\r\n\r\nTout est accessible, pour que chacun, quel que soit son âge ou sa mobilité, puisse profiter de la balade. On marche, on roule, on s’arrête, on prend le temps, admirant le fleuve qui, comme vous, a vu ces quais se transformer. Bordeaux s’adapte à ses habitants.',	'Bordeaux, votre ville, notre ville. Les années ont passé, les pavés foulés. L&#039;héritage de CORAJOUD et des techniciens a transformé l&#039;horizon bordelais. La mobilité et l&#039;écologie ont bouleversé votre quotidien et vos balades en famille. Bordeaux est devenu un leader français et une destination touristique incontournable. Les quais, autrefois industriels, sont désormais un véritable lieu de vie.',	'1738878310_article-evenement.png',	1),
(2,	'2019-03-13 20:14:10',	'2025-02-07 00:48:59',	'Hélène et Lucien, L’Amour de Bordeaux.',	'Bordeaux, à travers le temps et les changements. Ce témoignage de Hélène et Lucien mêle souvenirs nostalgiques et vision sur la ville d’aujourd’hui.',	'À vous, nos enfants, nous offrons ces mots, revivez avec nous l’histoire de Bordeaux et de ses quais',	'Un passé dépassé passé au peigne fin. Imaginez-vous dans les années 1960, sur les quais d’un port autonome. Les bateaux arrivaient sans cesse, déchargeant leurs cargaisons aux hangars 18, près des Quinconces. En 1968, lors d’un stage chez Delmas Desjeu, j’ai vu les navires importer du chocolat du monde entier. Les quais étaient le cœur battant de la ville : dockers, ouvriers, négociants en vin, et une activité constante. Les grues tournaient, les bateaux et wagons circulaient sans cesse, avec des produits comme le sucre, l’alcool, et le bois. C’était bruyant et animé. Le port était clos, protégé par un mur qui sécurisait les marchandises et régulait l’accès. Les habitants entendaient le bruit de l’activité, mais seuls les travailleurs y avaient accès, avec des papiers pour entrer. Derrière ce mur, le commerce tournait sans relâche.',	'&quot;La conscience du vieillissement grandit à chaque anniversaire.&quot; - Alain Juppé',	'Les quais, la zone oubliée. Autrefois, les quais de Bordeaux étaient un centre clé du commerce maritime, avec des navires déchargeant des marchandises comme le sucre ou le chocolat. Mais avec le temps, l’activité portuaire a déménagé à Bassens, mettant fin à l’effervescence des quais. Ces derniers ont été transformés en commerces et espaces touristiques, effaçant les traces du passé portuaire. Peu à peu, les quais abandonnés sont devenus un lieu de squats, de trafics et de règlements de comptes. La zone, sombre et dangereuse la nuit, était évitée par la plupart, devenant un symbole d’abandon et d’insécurité.',	'Un nouveau Bordeaux',	'L’arrivée d’Alain Juppé en tant que maire a bouleversé Bordeaux. Il a redynamisé la ville avec le tramway, la rénovation des quais et des façades. Avant, Bordeaux était une ville calme, mais aujourd’hui, elle s’anime la nuit, surtout autour de la Victoire, Saint-Pierre et les quais.\r\n\r\nMaintenant que la ville est réhabilitée, c’est plus touristique. C’est joli, mais on n’y va plus souvent. Les magasins ne nous attirent pas et le manque d’envie y joue aussi.\r\n\r\nQuant aux trottinettes, elles sont agaçantes ! Elles vont trop vite, et la circulation est chaotique. C’est pratique pour les jeunes, mais ils ne respectent pas toujours les règles. En plus, la ville est devenue moins sûre, surtout la nuit. Depuis la Covid, on sort moins, et on ne va plus au théâtre ou au cinéma comme avant.',	'Malgré les changements et défis, Bordeaux reste une ville qu&#039;on aime. Ses quartiers rénovés, ses quais réhabilités et son ambiance moderne, tout en préservant son charme, en font un endroit agréable où il fait bon vivre. Le mélange de son passé et de ses transformations récentes donne à la ville une identité unique, un vrai sentiment de chez-soi. Malgré quelques frustrations, Bordeaux reste un lieu où l&#039;on aime se retrouver.',	'1738879417_article-acteurs.png',	2),
(3,	'2019-11-09 10:34:20',	'2025-02-07 00:51:20',	'Bordeaux : Vieillir le temps d’un trajet en tramway.',	'Décembre 2023 : TBM transforme ses voyageurs de la ligne C, en nos grands parents.',	'Utiliser un simulateur de vieillissement pour comprendre ce que vivent nos aînés dans les transports',	'Être âgé dans le tramway. Mamie, Papi,\r\nAujourd’hui, en rentrant du collège, j’ai vu des passagers tester un simulateur de vieillissement dans le tramway. Un monsieur de TBM nous a expliqué que l&#039;équipement reproduisait la perte de muscles et de souplesse, rendant les mouvements plus difficiles. Monter une marche ou se tenir debout, c’est compliqué pour vous. Des lunettes floues simulaient des problèmes de vision (DMLA, glaucome, cataracte), et des écouteurs altéraient l’audition, rendant les annonces incompréhensibles. Des poids aux pieds rendaient la marche fatiguante et lente.\r\nRomain, un jeune en forme, a testé. Il a ressenti la perte de force et a compris la difficulté de se déplacer. Il était choqué de ne plus pouvoir lire les panneaux, même celui de l&#039;arrêt Victoire, près de la maison. Maintenant, j’ai peur de devenir vieux.',	'&quot;Les anciens sont les racines de la société, leur sagesse est un trésor.&quot; – Nelson Mandela',	'Aider nos aînés dans le tramway. Après avoir vécu cette expérience, j’ai compris l’importance de céder ma place. Avant, je pensais que c’était juste une question de politesse, mais maintenant, je vois que rester debout est un vrai défi pour vous. Entre la fatigue et la difficulté à garder l’équilibre, vos trajets sont épuisants.\r\n\r\nJe réalise aussi combien les transports peuvent être compliqués à prendre. Nous, on court pour attraper le tram, mais pour vous, c’est souvent impossible. Je ne m’étais jamais rendu compte qu’un simple trajet pouvait vous fatiguer autant.\r\n\r\nLes personnes qui ont testé le simulateur ont toutes changé de regard. Romain, par exemple, a été choqué de se retrouver perdu sans pouvoir rien voir. Les gens ont commencé à échanger, ce qui est rare à Bordeaux. Pourquoi ne pas avoir plus de sièges réservés, une signalétique plus visible ou des annonces plus claires ? Maintenant, je comprends qu’on doit être plus attentifs pour vous aider !',	'A Bordeaux, on doit s’y sentir bien.',	'Grâce à cette expérience dans le tram, j’ai compris l’importance d’initiatives comme celle de TBM. Sans ce simulateur, beaucoup de gens, moi le premier, ne réaliseraient pas à quel point les transports peuvent être difficiles pour vous. En quelques minutes, les autres passagers ont pris conscience de ce que vous vivez chaque jour. On ne mesure pas vos difficultés tant qu’on ne les vit pas soi-même.\r\n\r\nIl faudrait plus d’actions comme celle-ci pour sensibiliser les gens. Si tout le monde comprenait mieux le vieillissement, il y aurait plus de respect. Peut-être que davantage de personnes céderaient leur place, éviteraient de vous bousculer ou vous aideraient à lire un panneau.\r\n\r\nEn tout cas, ça m’a fait réfléchir. Je ferai plus attention à vous et à ceux qui vous entourent. J’espère que Bordeaux deviendra une ville où vous pourrez vous déplacer plus facilement et sereinement.',	'Après l&#039;expérience dans le tram, je réalise à quel point les transports sont difficiles pour vous. C’est plus épuisant que je ne le pensais. Désormais, je ferai attention et vous laisserai ma place sans hésiter. J’espère que les autres comprendront aussi et que les transports deviendront plus faciles.',	'1738888029_article-insolite-1.png',	13),
(4,	'2020-01-12 18:21:21',	'2025-02-07 00:51:36',	'Echoppes seniors, l’art de sociabiliser pour nos aînés',	'Depuis septembre dernier, 25 structures ont été mises en place à travers la ville pour permettre aux seniors de s’épanouir, de s’amuser et de partager des moments de convivialité',	'Un nouveau moyen de reconstruire la sociabilité chez nos aînés.',	'Redonner du lien et briser la solitude. L’isolement social touche environ 20 % des personnes âgées en France, avec des impacts graves sur leur santé. Une étude de l’Inserm révèle que les seniors isolés ont un risque accru de 60 % de développer des troubles cognitifs, dont la maladie d’Alzheimer. L&#039;isolement diminue les activités physiques et intellectuelles, favorisant la perte d’autonomie, et est une cause majeure de dépression.\r\n\r\nMaintenir un lien social est crucial pour bien vieillir. Les seniors participant à des activités collectives connaissent un meilleur bien-être. Les Échoppes seniors permettent de rompre la solitude, avec des échanges intergénérationnels qui stimulent leur curiosité et leurs capacités cognitives.\r\n\r\nÀ Bordeaux, plusieurs initiatives luttent contre l’isolement des aînés, dont un réseau de bénévoles et des événements festifs. Les Échoppes seniors complètent cette offre avec des espaces conviviaux proposant des ateliers, conférences, jeux, et activités physiques.',	'&quot;Le cœur ne vieillit pas, mais loger un dieu dans des ruines est pénible.&quot; Voltaire.',	'Bordeaux, une ville engagée pour ses aînés. Actuellement, près de 20 % de la population bordelaise a plus de 60 ans. D&#039;ici 2030, ce chiffre pourrait dépasser 57 000 seniors, soit un habitant sur cinq. Cette évolution soulève des questions sur le logement, la mobilité, l’accès aux soins et les services de proximité. La ville a donc adopté une stratégie centrée sur la prévention de la perte d’autonomie et le renforcement des liens sociaux.\r\n\r\nBordeaux a créé le Conseil Bordeaux Seniors Actions (CBSA), où les seniors participent à l’élaboration des politiques qui les concernent. La ville propose également des services d’aide à domicile, des transports adaptés et des activités culturelles pour les aînés.\r\n\r\nEn 2022, Bordeaux a obtenu le label &quot;Ville amie des aînés&quot; Niveau OR, récompensant ses efforts pour adapter l’environnement urbain aux besoins des personnes âgées. Ce label positionne Bordeaux comme une référence en France pour le bien-être des seniors.',	'Un habitat repensé pour mieux vivre ensemble',	'Les logements destinés aux seniors sont conçus pour garantir sécurité et confort. Parmi les aménagements, on retrouve l’absence de marches et de seuils pour éviter les chutes, des salles de bain avec douches à l’italienne et barres d’appui puis des espaces de circulation larges et sécurisés pour permettre un déplacement fluide, même en fauteuil roulant. Ces logements permettent aux seniors de rester autonomes un maximum et plus longtemps, tout en vivant dans un cadre rassurant.\r\n\r\n\r\nDivers services sont proposés pour accompagner les résidents au quotidien dont la livraison de repas à domicile, des visites médicales et des suivis de santé régulier ainsi que l’assistance à la mobilité. Ces services permettent aux seniors de vivre plus sereinement.',	'Les Échoppes seniors favorisent le vivre-ensemble grâce à des espaces communs et des activités variées. Ateliers créatifs (peinture, écriture, musique), rencontres intergénérationnelles et activités sportives douces (yoga, tai-chi, marche nordique) permettent aux aînés de rester actifs, de partager et de s’épanouir dans un cadre bienveillant.',	'1738888306_article-insolite-2.png',	13),
(5,	'2022-03-04 12:28:00',	'2025-02-04 09:49:12',	'La sculpture Sanna va-t-elle nous quitter ?',	'Depuis presque dix ans, la sculpture Sanna trône sur la place de la comédie. Visage emblématique et intriguant que l’on apprécie contempler. Aujourd’hui, il est possible qu’elle ne devienne plus qu’un souvenir… La ville de Bordeaux a toujours été investie dans la culture et l&#039;accès à l’art, c’est pourquoi le sujet de la sculpture Sanna fait polémique au sein de la ville.',	'Quelle histoire se cache derrière ce visage ?',	'La demoiselle de fonte a été érigée en 2013 par Jaume Plensa dans le cadre d’une exposition bordelaise, Sanna était accompagnée de sa « sœur » Paula, qui elle, était placée devant la cathédrale de Bordeaux. Jaume Plensa est un artiste Catalan qui a réalisé onze autres œuvres, exposées à travers la ville. Mais, celles-ci ont été retirées. Actuellement, c’est un particulier anonyme qui possède la sculpture Sanna, il laisse à la municipalité de Bordeaux un délai de 5 ans pour la conserver sur la place de la Comédie. Elle partirait à priori en 2027. Ce serait donc le départ d’une œuvre extravagante et surtout emblématique de la ville de Bordeaux.',	'Une demoiselle de fonte, d’âme et d’or',	'Sanna est une sculpture figurative monumentale faite entièrement de fonte, il s’agit du visage d’une jeune fille qui paraît particulièrement apaisée, comme si elle était endormie. Cette impression de plénitude est due aux yeux fermés de la jeune fille et à son expression imperturbable, comme si elle n’allait jamais les rouvrir. Sous certaines perspectives, Sanna peut adopter différents styles : de face son visage est parfaitement droit et bien proportionné mais de côté son visage semble difforme. Aussi, nous pouvons voir évoluer les couleurs de la demoiselle de fonte au fur et à mesure des années. En effet, la sculpture rouille et sa teinte varie en fonction du temps. Sanna se situe devant le grand théâtre sur la place de la Comédie, son style particulier qui marie la grossièreté du fer et la finesse des traits, se combine parfaitement avec l’opéra par ses formes imposantes et travaillées. Pour l’artiste, Jaume Plensa, le visage est « le miroir de l’âme ». Par conséquent, l&#039;œuvre permet aux bordelais d’acquérir un instant de paix de l’esprit en plein cœur de la ville.',	'L&#039;achat de la statue',	'En plus de son aspect artistique, la sculpture de Sanna génère évidemment aussi un certain engouement affectant son aspect économique. En effet, en 2014 après l’exposition de Jaume Plensa, Bordeaux fait une levée de fond pour racheter la sculpture. La ville a besoin de récolter 150 000 € auprès des habitants et prévoit ensuite de compléter cette récolte en sortant également un minimum de 150 000 € de sa poche. Effectivement, la valeur financière de l&#039;œuvre varie entre 300 000 € et 500 000 €. Malheureusement, les dons étant trop faibles, la récolte n&#039;aboutit pas à un résultat concluant. Seulement 44 000 € ont été récoltés ce qui n’a absolument pas été suffisant pour que la municipalité prenne en charge le reste de l’achat. Fort heureusement en 2015, un particulier anonyme achète la statue et signe un contrat avec la municipalité de Bordeaux pour la laisser 6 ans de plus sur la place de la Comédie. Plus récemment encore, le 8 février 2022, la ville de Bordeaux a annoncé officiellement qu’un autre accord avait été approuvé, permettant à la sculpture de rester sur la place et surtout dans nos cœurs jusqu’en 2027.',	'Finalement, cette sculpture reste encore parmi nous pendant un bon moment. Cette demoiselle de fonte au vécu poétique ayant rythmé la vie de beaucoup de bordelais continuera donc de le faire ces cinq prochaines années. Et cette affaire d’argent plutôt compliquée pour la mairie de Bordeaux lui a tout de même permis de conserver ce bien grâce à l’aide de ce fameux acheteur anonyme. Nous vous suggérons donc d’aller une fois encore apprécier sa présence avant son départ imminent ! Avec l’équipe de rédaction, nous nous demandions si vous aussi vous aviez des anecdotes croustillantes à raconter sur ce visage fait de métaux. Qu’est-ce qu’elle vous fait ressentir ? Êtes-vous heureux d’apprendre qu’elle reste à nos côtés encore longtemps vous aussi ? Nous avons hâte de lire vos réponses en commentaire !',	'1738659635_1738659621_1738659613_1738659522_imgArt25.jpeg',	1),
(55,	'2025-02-12 15:09:00',	'2025-02-07 14:10:23',	'Bordeaux 33',	'Bordeaux',	'Bordeaux',	'Bordeaux',	'Bordeaux',	'Bordeaux',	'Bordeaux',	'Bordeaux',	'Bordeaux',	'1738937423_article-evenement.png',	3);

DROP TABLE IF EXISTS `COMMENT`;
CREATE TABLE `COMMENT` (
  `numCom` int NOT NULL AUTO_INCREMENT,
  `dtCreaCom` datetime DEFAULT CURRENT_TIMESTAMP,
  `libCom` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `dtModCom` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `attModOK` tinyint(1) DEFAULT '0',
  `notifComKOAff` text COLLATE utf8mb3_unicode_ci,
  `dtDelLogCom` datetime DEFAULT NULL,
  `delLogiq` tinyint(1) DEFAULT '0',
  `numArt` int NOT NULL,
  `numMemb` int NOT NULL,
  PRIMARY KEY (`numCom`),
  KEY `COMMENT_FK` (`numCom`),
  KEY `FK_ASSOCIATION_2` (`numArt`),
  KEY `FK_ASSOCIATION_3` (`numMemb`),
  CONSTRAINT `FK_ASSOCIATION_2` FOREIGN KEY (`numArt`) REFERENCES `ARTICLE` (`numArt`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_ASSOCIATION_3` FOREIGN KEY (`numMemb`) REFERENCES `MEMBRE` (`numMemb`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;


DROP TABLE IF EXISTS `LIKEART`;
CREATE TABLE `LIKEART` (
  `numMemb` int NOT NULL,
  `numArt` int NOT NULL,
  `likeA` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`numMemb`,`numArt`),
  KEY `LIKEART_FK` (`numMemb`,`numArt`),
  KEY `FK_LIKEART1` (`numArt`),
  CONSTRAINT `FK_LIKEART1` FOREIGN KEY (`numArt`) REFERENCES `ARTICLE` (`numArt`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_LIKEART2` FOREIGN KEY (`numMemb`) REFERENCES `MEMBRE` (`numMemb`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;


DROP TABLE IF EXISTS `MEMBRE`;
CREATE TABLE `MEMBRE` (
  `numMemb` int NOT NULL AUTO_INCREMENT,
  `prenomMemb` varchar(70) COLLATE utf8mb3_unicode_ci NOT NULL,
  `nomMemb` varchar(70) COLLATE utf8mb3_unicode_ci NOT NULL,
  `pseudoMemb` varchar(70) COLLATE utf8mb3_unicode_ci NOT NULL,
  `passMemb` varchar(70) COLLATE utf8mb3_unicode_ci NOT NULL,
  `eMailMemb` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `dtCreaMemb` datetime DEFAULT CURRENT_TIMESTAMP,
  `dtMajMemb` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `accordMemb` tinyint(1) DEFAULT '1',
  `cookieMemb` varchar(70) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `numStat` int NOT NULL,
  PRIMARY KEY (`numMemb`),
  KEY `MEMBRE_FK` (`numMemb`),
  KEY `FK_ASSOCIATION_4` (`numStat`),
  CONSTRAINT `FK_ASSOCIATION_4` FOREIGN KEY (`numStat`) REFERENCES `STATUT` (`numStat`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

INSERT INTO `MEMBRE` (`numMemb`, `prenomMemb`, `nomMemb`, `pseudoMemb`, `passMemb`, `eMailMemb`, `dtCreaMemb`, `dtMajMemb`, `accordMemb`, `cookieMemb`, `numStat`) VALUES
(1,	'Freddie',	'Mercury',	'Admin99',	'$2y$10$N/g0ByiscKtjZXY3htXZc.nWco6X4OmR1SAsuZfwU0k9qenUfO4VS',	'freddie.mercury@gmail.com',	'2019-05-29 10:13:43',	'2025-02-04 20:13:21',	1,	NULL,	2),
(2,	'Phil',	'Collins',	'Phil09',	'$2y$10$N1QsPve3q4Plqqcg7UQh6OKguZtiBfPeicUd7T2AeUz1P18YHWkgu',	'phil.collins@gmail.com',	'2020-01-09 10:13:43',	'2025-02-01 01:04:32',	1,	NULL,	2),
(3,	'Julie',	'La Rousse',	'juju1989',	'12345678',	'julie.larousse@gmail.com',	'2020-03-15 14:33:23',	'2024-01-12 14:36:48',	1,	NULL,	3),
(4,	'David',	'Bowie',	'dav33B',	'$2y$10$xQ3czAJg/1Wd9wN0y4E8Ju1F9Ta77qXAVMaTmlxe.K./5STdrlfQu',	'david.bowie@gmail.com',	'2020-07-19 13:13:13',	'2025-02-01 00:55:04',	1,	NULL,	3),
(20,	'Charles',	'Charles',	'Admin1',	'$2y$10$fPSZFdH9cQv0oi8UXLbpseicAp1/7VIiqkYceYtdrEMiivuwU5/8C',	'Charles@gmail.com',	'2025-02-04 20:09:14',	'2025-02-05 22:28:17',	1,	NULL,	1),
(41,	'Membre2',	'Membre2',	'Membre2',	'$2y$10$vqG92M2ryiWR4nzaF5qj1eSTNcuBQRYI6L7OqM2j8O6dAI24gHRGq',	'membre2@gmail.com',	'2025-02-06 12:19:16',	NULL,	1,	NULL,	3);

DROP TABLE IF EXISTS `MOTCLE`;
CREATE TABLE `MOTCLE` (
  `numMotCle` int NOT NULL AUTO_INCREMENT,
  `libMotCle` varchar(60) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`numMotCle`),
  KEY `MOTCLE_FK` (`numMotCle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

INSERT INTO `MOTCLE` (`numMotCle`, `libMotCle`) VALUES
(1,	'Bordeaux'),
(2,	'Michel Corajoud'),
(3,	'Souvenirs de Bordeaux'),
(4,	'Transformation urbaine'),
(5,	'Réaménagement des quais'),
(6,	'Transformation urbaine'),
(7,	'Déclin du commerce maritime'),
(28,	'Tramway'),
(29,	'Simulateur de vieillissement'),
(30,	'Échoppes seniors'),
(31,	'Bien-être des aînés');

DROP TABLE IF EXISTS `MOTCLEARTICLE`;
CREATE TABLE `MOTCLEARTICLE` (
  `numArt` int NOT NULL,
  `numMotCle` int NOT NULL,
  PRIMARY KEY (`numArt`,`numMotCle`),
  KEY `MOTCLEARTICLE_FK` (`numArt`),
  KEY `MOTCLEARTICLE2_FK` (`numMotCle`),
  CONSTRAINT `FK_MotCleArt1` FOREIGN KEY (`numMotCle`) REFERENCES `MOTCLE` (`numMotCle`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_MotCleArt2` FOREIGN KEY (`numArt`) REFERENCES `ARTICLE` (`numArt`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

INSERT INTO `MOTCLEARTICLE` (`numArt`, `numMotCle`) VALUES
(1,	1),
(1,	2),
(1,	4),
(1,	5),
(1,	6),
(2,	1),
(2,	3),
(2,	4),
(2,	5),
(2,	6),
(2,	7),
(3,	1),
(3,	28),
(3,	29),
(4,	1),
(4,	30),
(4,	31),
(5,	3),
(5,	4),
(55,	2),
(55,	4),
(55,	7);

DROP TABLE IF EXISTS `STATUT`;
CREATE TABLE `STATUT` (
  `numStat` int NOT NULL AUTO_INCREMENT,
  `libStat` varchar(25) COLLATE utf8mb3_unicode_ci NOT NULL,
  `dtCreaStat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`numStat`),
  KEY `STATUT_FK` (`numStat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

INSERT INTO `STATUT` (`numStat`, `libStat`, `dtCreaStat`) VALUES
(1,	'Administrateur',	'2023-02-19 15:15:59'),
(2,	'Modérateur',	'2023-02-19 15:19:12'),
(3,	'Membre',	'2023-02-20 08:43:24');

DROP TABLE IF EXISTS `THEMATIQUE`;
CREATE TABLE `THEMATIQUE` (
  `numThem` int NOT NULL AUTO_INCREMENT,
  `libThem` varchar(60) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`numThem`),
  KEY `THEMATIQUE_FK` (`numThem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

INSERT INTO `THEMATIQUE` (`numThem`, `libThem`) VALUES
(1,	'L\'événement'),
(2,	'L\'acteur-clés'),
(3,	'Le mouvement émergeant'),
(13,	'L&#039;insolite / Le clin d&#039;oeil');

-- 2025-02-07 17:19:23