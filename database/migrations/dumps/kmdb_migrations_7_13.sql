SET foreign_key_checks = 0;
DROP TABLE IF EXISTS `commodities_arrival`;
CREATE TABLE IF NOT EXISTS `commodities_arrival` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `commodity_id` char(5) NOT NULL,
  `commodity_np` varchar(64) CHARACTER SET utf8 COLLATE 'utf8_unicode_ci' NOT NULL DEFAULT '',
  `commodity_en` varchar(64) NOT NULL,
  `unit_en` varchar(16) CHARACTER SET utf8 COLLATE 'utf8_unicode_ci' NOT NULL DEFAULT '',
  `unit_np` varchar(16) CHARACTER SET utf8 COLLATE 'utf8_unicode_ci' NOT NULL DEFAULT '',
  `created_by` bigint(20) unsigned NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `COMMODITY_ARRIVAL_ID` (`commodity_id`),
  CONSTRAINT `COMMODITY_ARRIVAL_CREATED_BY_FK` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (101,'गोलभेडा ठूलो','Tomato Big','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (102,'गोलभेडा सानो','Tomato Small','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (104,'आलु रातो','Potato Red','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (105,'आलु सेतो','Potato White','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (106,'प्याज सुकेको','Onion Dry','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (107,'गाजर','Carrot','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (108,'बन्दा','Cabbage','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (110,'काउली स्थानिय','Cauli Local','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (111,'काउली तराई','Cauli Terai','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (113,'मूला रातो','Raddish Red','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (114,'मूला सेतो','Raddish White','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (115,'भन्टा लाम्चो','Brinjal Long','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (116,'भन्टा डल्लो','Brinjal Round','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (117,'बोडी','Cow pea','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (118,'मटरकोशा','Green Peas','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (119,'घिउ सिमी','French Bean','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (120,'टाटे सिमी','Sword Bean','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (121,'भटमासकोशा','Soyabean Green','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (122,'तितो करेला','Bitter Gourd','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (123,'लौका','Bottle Gourd','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (124,'परवर','Pointed Gourd','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (125,'चिचिण्डो','Snake Gourd','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (126,'घिरौला','Smooth Gourd','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (127,'झिगूनी','Sponge Gourd','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (128,'फर्सी पाकेको','Pumpkin','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (129,'फर्सी हरियो','Squash','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (130,'सलगम','Turnip','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (131,'भिण्डी','Okara','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (132,'सखरखण्ड','Sweet Potato','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (133,'बरेला','Barela','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (134,'पिंडालू','Arum','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (135,'स्कूस','Christophine','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (136,'रायो साग','Brd Leaf Mustard','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (137,'पालूगो साग','Spinach Leaf','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (138,'चमसूरको साग','Cress Leaf','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (139,'तोरीको साग','Mustard Leaf','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (140,'मेथीको साग','Fenugreek Leaf','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (141,'प्याज हरियो','Onion Green','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (142,'बकूला','Bakula','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (143,'तरुल','Yam','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (144,'च्याउ','Mushroom','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (145,'कुरीलो','Asparagus','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (146,'न्यूरो','Neuro','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (147,'ब्रोकाउली','Brocauli','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (148,'चुकुन्दर','Sugarbeet','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (149,'सजिवन','Drumstick','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (150,'कोइरालो','Bauhania flower','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (151,'रातो बन्दा','Red Cabbbage','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (152,'जिरीको साग','Lettuce','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (153,'ग्याठ कोबी','Knolkhol','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (154,'सेलरी','Celery','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (155,'पार्सले','Parseley','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (156,'सौफको साग','Fennel Leaf','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (157,'पुदीना','Mint','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (158,'गान्टे मूला','Turnip A','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (159,'हरियो मकै','Maize','Per Piece','प्रति वटा');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (160,'इमली','Tamarind','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (161,'तामा','Bamboo Shoot','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (162,'तोफु','Tofu','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (163,'गुन्दुक','Gundruk','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (201,'स्याउ','Apple','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (202,'केरा','Banana','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (203,'कागती','Lime','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (204,'अनार','Pomegranate','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (205,'आँप','Mango','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (206,'अंगुर','Grapes','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (207,'सुन्तला','Orange','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (208,'तरबुजा','Water Melon','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (209,'मौसम','Sweet Orange','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (210,'जुनार','Mandarin','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (211,'भुई कटहर','Pineapple','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (212,'काक्रो','Cucumber','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (213,'रुख कटहर','Jack Fruit','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (214,'निबुवा','Lemon','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (215,'चाक्सी','Sweet Lime','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (216,'नासपाती','Pear','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (217,'मेवा','Papaya','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (218,'अम्बा','Guava','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (219,'लप्सी','Mombin','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (220,'लीच्ची','Litchi','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (221,'खरबुजा','Musk Melon','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (222,'उखु','Sugarcane','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (223,'किनु','Kinnow','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (224,'स्ट्रबेरी भुईऐसेलु','Strawberry','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (225,'किवि','Kiwi','KG','के.जी');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (226,'शरीफा','Sarifa','KG','के.जी');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (227,'आभोकाडो','Avocado','KG','के.जी');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (228,'अमला','Amla','KG','के.जी');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (301,'अदुवा','Ginger','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (302,'खु्र्सानी सुकेको','Chilli Dry','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (303,'खु्र्सानी हरियो','Chilli Green','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (303,'खुर्सानी हरियो','Chilli Green','KG','के जी');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (304,'भेडे खु्र्सानी','Capsicum','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (306,'लसुन हरियो','Garlic Green','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (307,'हरियो धनिया','Coriander Green','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (308,'लसुन सुकेको','Garlic Dry','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (310,'छ्यापी सुकेको','Clive Dry','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (311,'छ्यापी हरियो','Clive Green','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (401,'माछा सुकेको','Fish Dry','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (402,'माछा ताजा','Fish Fresh','KG','के.जी.');
INSERT INTO `commodities_arrival`(`commodity_id`,`commodity_np`,`commodity_en`,`unit_en`,`unit_np`) VALUES (501,'अन्य','Other','KG','के जी');
SET foreign_key_checks = 1;
