DROP TABLE IF EXISTS `commodities`;
CREATE TABLE IF NOT EXISTS `commodities` (
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
  KEY `COMMODITY` (`commodity_id`),
  CONSTRAINT `CREATED_BY_FK` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `daily_price_log`;
CREATE TABLE IF NOT EXISTS `daily_price_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `commodity_id` char(5) NOT NULL,
  `entry_date` date NOT NULL,
  `price_type` enum('wholesale','retail') NOT NULL DEFAULT 'wholesale',
  `min_price` float(5,2) unsigned NOT NULL,
  `max_price` float(5,2) unsigned NOT NULL DEFAULT '0.00',
  `avg_price` float(5,2) unsigned NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE CONSTRAINT` (`entry_date`,`commodity_id`,`price_type`) USING BTREE,
  KEY `DATE LOOKUP` (`entry_date`),
  KEY `COMMODITY FOREIGN` (`commodity_id`),
  CONSTRAINT `COMMODITY FOREIGN` FOREIGN KEY (`commodity_id`) REFERENCES `commodities` (`commodity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `traders_due`;
CREATE TABLE `traders_due` (
	`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`transaction_uuid` CHAR(36) NOT NULL COLLATE 'utf8_unicode_ci',
	`trader_id` VARCHAR(70) NOT NULL COLLATE 'utf8_unicode_ci',
	`tradername` VARCHAR(70) NOT NULL COLLATE 'utf8_unicode_ci',
	`shop_id` VARCHAR(6) NOT NULL COLLATE 'utf8_unicode_ci',
	`due_date` VARCHAR(11) NOT NULL DEFAULT '' COLLATE 'utf8_unicode_ci',
	`monthly_rent` DECIMAL(9,2) NOT NULL,
	`late_fee` DECIMAL(9,2) NOT NULL,
	`other_amount` DECIMAL(9,2) NOT NULL,
	`adjustment` DECIMAL(9,2) NOT NULL,
	`total_amount` DECIMAL(9,2) NOT NULL,
	`created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`) USING BTREE,
	INDEX `TRANSACT_UUID` (`transaction_uuid`) USING BTREE,
	UNIQUE INDEX `UNIQUE` (`shop_id`, `trader_id`) USING BTREE
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB;

DROP TABLE IF EXISTS `traders_due_history`;
CREATE TABLE `traders_due_history` LIKE `traders_due`;
ALTER TABLE `traders_due_history` MODIFY COLUMN `id` BIGINT(20) UNSIGNED NOT NULL, DROP INDEX `UNIQUE`;

DROP TRIGGER IF EXISTS `traders_due_audit_trigger_create`;
CREATE TRIGGER `traders_due_audit_trigger_create`
AFTER INSERT ON `traders_due`
FOR EACH ROW
INSERT INTO
`traders_due_history` ( `id`, `transaction_uuid`, `trader_id`, `tradername`, `shop_id`, `due_date`, `monthly_rent`, `late_fee`, `other_amount`, `adjustment`, `total_amount`, `created_at`, `updated_at` )
values ( NEW.`id`, NEW.`transaction_uuid`, NEW.`trader_id`, NEW.`tradername`, NEW.`shop_id`, NEW.`due_date`, NEW.`monthly_rent`, NEW.`late_fee`, NEW.`other_amount`, NEW.`adjustment`, NEW.`total_amount`, NEW.`created_at`, NEW.`updated_at` );


DROP TRIGGER IF EXISTS `traders_due_audit_trigger_update`;
CREATE TRIGGER `traders_due_audit_trigger_update`
AFTER UPDATE ON `traders_due`
FOR EACH ROW
UPDATE `traders_due_history`
SET
`trader_id` = NEW.`trader_id`,
`transaction_uuid` = NEW.`transaction_uuid`,
`tradername` = NEW.`tradername`,
`shop_id` = NEW.`shop_id`,
`due_date` = NEW.`due_date`,
`monthly_rent` = NEW.`monthly_rent`,
`late_fee` = NEW.`late_fee`,
`other_amount` = NEW.`other_amount`,
`adjustment` = NEW.`adjustment`,
`total_amount` = NEW.`total_amount`,
`updated_at` = NEW.`updated_at`
WHERE `id` = NEW.`id`;

DROP TRIGGER IF EXISTS `traders_due_trigger_uuid`;
CREATE TRIGGER `traders_due_trigger_uuid`
BEFORE INSERT ON `traders_due`
FOR EACH ROW
SET NEW.`transaction_uuid` := UUID();

DROP TABLE IF EXISTS `traders_due_payment`;
CREATE TABLE `traders_due_payment` (
	`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`vendor_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
	`notify_email` VARCHAR(255) DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`payment_uuid` CHAR(36) NOT NULL COLLATE 'utf8_unicode_ci',
	`payment_channel` ENUM('esewa','cips','web') NOT NULL DEFAULT 'web' COLLATE 'utf8_unicode_ci',
	`payment_data` JSON NULL DEFAULT NULL,
	`reference_data` TEXT NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`paid_on` TIMESTAMP NULL DEFAULT NULL,
	`status` ENUM('processing','unverified','verified','failed') NOT NULL DEFAULT 'unverified' COLLATE 'utf8_unicode_ci',
	`amount_paid` DECIMAL(9,2) NOT NULL,
	`created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`) USING BTREE,
	UNIQUE INDEX `UNIQUE` (`vendor_id`, `payment_uuid`) USING BTREE,
    INDEX `PAID_ON` (`paid_on`) USING BTREE,
    INDEX `CHANNEL` (`payment_channel`) USING BTREE,
    INDEX `STATUS` (`status`) USING BTREE,
    FOREIGN KEY `TRADER_FK_DUES` (`vendor_id`) REFERENCES `traders_due_history`(`id`) ON UPDATE RESTRICT ON DELETE RESTRICT
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB;

DROP TABLE IF EXISTS `notices`;
CREATE TABLE `notices` (
	`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`type` ENUM('notice','tender','pest','traders', 'bill_publication', 'publication', 'annual') NULL DEFAULT 'notice' COLLATE 'utf8mb4_unicode_ci',
	`title_en` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`title_np` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`content_en` TEXT NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`content_np` TEXT NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`url` TEXT NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`valid_upto` TIMESTAMP NOT NULL,
	`created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	`created_by` BIGINT(20) UNSIGNED NOT NULL,
	`updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	`deleted_at` TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE,
	INDEX `CREATED_BY_FK_NOTICE` (`created_by`) USING BTREE,
	INDEX `INDEX_VALID_UPTO_ACTIVE_TYPE` (`type`, `valid_upto`, `deleted_at`) USING BTREE,
	CONSTRAINT `CREATED_BY_FK_NOTICE` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE RESTRICT ON DELETE RESTRICT
)
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB
;

DROP TRIGGER IF EXISTS `articles_trigger_uuid`;
CREATE TRIGGER
`articles_trigger_uuid`
BEFORE INSERT ON
`articles`
FOR EACH ROW
SET NEW.`article_uuid` := UUID();

DROP TRIGGER IF EXISTS `articles_trigger_published_at`;
CREATE TRIGGER
`articles_trigger_published_at`
BEFORE UPDATE ON
`articles`
FOR EACH ROW
BEGIN
if NEW.status = "published" then
    SET NEW.published_at = NOW();
end if;
END;
