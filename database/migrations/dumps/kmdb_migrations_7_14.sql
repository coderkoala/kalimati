DROP TABLE IF EXISTS `daily_arrival_log`;
CREATE TABLE IF NOT EXISTS `daily_arrival_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `commodity_id` char(5) NOT NULL,
  `entry_date` date NOT NULL,
  `quantity` decimal(20,2) unsigned NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE_CONST_ARRIVAL` (`entry_date`, `commodity_id`) USING BTREE,
  KEY `LOOKUP_DATE` (`entry_date`),
  KEY `COMMODITY_FOREIGN_ARRIVAL` (`commodity_id`),
  CONSTRAINT `CONST_COMMODITY_ARRIVAL` FOREIGN KEY (`commodity_id`) REFERENCES `commodities_arrival` (`commodity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
