/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `about`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `about` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `about_content` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `age_verification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `age_verification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `age_verification_on_off` int DEFAULT NULL COMMENT '1=yes,2=no',
  `popup_type` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `min_age` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `app_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `android_link` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ios_link` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mobile_app_on_off` int DEFAULT NULL COMMENT '1=yes,2=no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `automation_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `automation_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `automation_id` bigint unsigned NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `automation_logs_user_id_automation_id_index` (`user_id`,`automation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `automations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `automations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trigger_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delay_in_hours` int NOT NULL DEFAULT '0',
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `banner_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `banner_image` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `reorder_id` int NOT NULL,
  `vendor_id` int NOT NULL,
  `category_id` int DEFAULT NULL,
  `type` int DEFAULT NULL COMMENT '1=category,2=products',
  `product_id` int DEFAULT NULL,
  `section` int NOT NULL COMMENT '0=sliders,1=banner1,2=banner2',
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blogs` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `reorder_id` int NOT NULL,
  `vendor_id` int NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_id` bigint unsigned NOT NULL,
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'calculation with extra',
  `tax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extras_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extras_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extras_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'item original price with qty calculation',
  `variants_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `variants_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `variants_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'item original price',
  `is_available` int NOT NULL DEFAULT '1' COMMENT '1 = Yes . 2 = No',
  `attribute` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buynow` int NOT NULL DEFAULT '0' COMMENT '1=buynow,0=cart',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_item_id_foreign` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `reorder_id` int NOT NULL,
  `vendor_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Yes,2=No',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1=Yes,2=No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `city` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reorder_id` int NOT NULL,
  `country_id` int NOT NULL,
  `city` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `is_deleted` int NOT NULL DEFAULT '2' COMMENT '1=Yes,2=No',
  `is_available` int NOT NULL DEFAULT '1' COMMENT '1=Yes,2=No	',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int DEFAULT NULL,
  `vendor_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `country` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reorder_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `is_deleted` int NOT NULL DEFAULT '2' COMMENT '1=Yes,2=No',
  `is_available` int NOT NULL DEFAULT '1' COMMENT '1=Yes,2=No',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `currencies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `currency` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `code` text COLLATE utf8mb4_general_ci NOT NULL,
  `currency_symbol` text COLLATE utf8mb4_general_ci NOT NULL,
  `is_available` int NOT NULL DEFAULT '1' COMMENT '1=yes,2=no\r\n',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `currency_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `currency_settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `exchange_rate` float NOT NULL,
  `currency_position` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1' COMMENT '1=left, 2=right',
  `currency_space` int NOT NULL DEFAULT '1' COMMENT '1=yes,2=no',
  `currency_formate` int NOT NULL,
  `decimal_separator` int NOT NULL DEFAULT '1' COMMENT '1=dot,2=no',
  `is_available` int NOT NULL DEFAULT '1' COMMENT '1=yes,2=no	',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `custom_domain`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `custom_domain` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `requested_domain` text COLLATE utf8mb4_general_ci NOT NULL,
  `current_domain` text COLLATE utf8mb4_general_ci,
  `status` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `custom_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `custom_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reorder_id` int NOT NULL,
  `vendor_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `type` int NOT NULL COMMENT '1=default,2=process,3=complete,4=cancel',
  `is_available` int NOT NULL DEFAULT '1',
  `is_deleted` int NOT NULL DEFAULT '2',
  `order_type` int NOT NULL DEFAULT '1' COMMENT '1=delivery,2=pickup,3=dinein,4=pos',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `extras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `extras` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `price` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faqs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reorder_id` int NOT NULL,
  `vendor_id` int NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `answer` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `favorite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `favorite` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `features`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `features` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reorder_id` int NOT NULL,
  `vendor_id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `firebase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `firebase` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `sub_title` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `is_available` int NOT NULL DEFAULT '1' COMMENT '1=yes,2=no',
  `is_deleted` int NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `footerfeatures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `footerfeatures` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `fun_fact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fun_fact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `title` text COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `global_extras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `global_extras` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reorder_id` int NOT NULL,
  `vendor_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `is_available` int NOT NULL DEFAULT '1',
  `is_deleted` int NOT NULL DEFAULT '2',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `howitworks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `howitworks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reorder_id` int NOT NULL,
  `vendor_id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `updated_at` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `instagram_imports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `instagram_imports` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `vendor_id` bigint unsigned NOT NULL,
  `instagram_post_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_id` bigint unsigned DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media_url` text COLLATE utf8mb4_unicode_ci,
  `caption` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `instagram_imports_instagram_post_id_index` (`instagram_post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reorder_id` int NOT NULL,
  `vendor_id` int NOT NULL,
  `cat_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `item_name` text COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `item_price` float NOT NULL DEFAULT '0',
  `currency` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Lira',
  `item_original_price` float DEFAULT '0',
  `sku` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `qty` int DEFAULT '0',
  `low_qty` int DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `tax` varchar(255) COLLATE utf8mb4_general_ci DEFAULT '0',
  `slug` text COLLATE utf8mb4_general_ci,
  `min_order` int DEFAULT NULL,
  `max_order` int DEFAULT NULL,
  `is_available` int NOT NULL DEFAULT '1',
  `is_deleted` int NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `frequently_bought_items` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `has_variants` int NOT NULL DEFAULT '2',
  `variants_json` longtext COLLATE utf8mb4_general_ci,
  `attribute` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `attchment_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `attchment_file` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `download_file` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `video_url` text COLLATE utf8mb4_general_ci,
  `view_count` int NOT NULL DEFAULT '0',
  `stock_management` int NOT NULL COMMENT '1=yes,2=no',
  `is_imported` int DEFAULT '2',
  `top_deals` int NOT NULL DEFAULT '2',
  `is_new_arrival` tinyint(1) NOT NULL DEFAULT '0',
  `is_best_selling` tinyint(1) NOT NULL DEFAULT '0',
  `is_exclusive` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dollar_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `landing2_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `landing2_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `section` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `field` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `landing2_translations_unique` (`section`,`field`,`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `landing_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `landing_settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `landing_home_banner` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `subscribe_image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `faq_image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `primary_color` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `secondary_color` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `languages` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `layout` int NOT NULL DEFAULT '1' COMMENT '1=ltr,2=rtl',
  `is_default` int NOT NULL DEFAULT '2' COMMENT '1 = yes , 2 = no',
  `is_available` int NOT NULL DEFAULT '1' COMMENT '1=yes,2=no',
  `is_deleted` int NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `order_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned DEFAULT NULL,
  `item_id` bigint unsigned DEFAULT NULL,
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extras_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extras_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extras_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attribute` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `variants_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `variants_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `variants_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `user_id` text COLLATE utf8mb4_unicode_ci,
  `order_number` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_number_start` int DEFAULT NULL,
  `order_number_digit` int DEFAULT NULL,
  `payment_type` int NOT NULL,
  `payment_id` text COLLATE utf8mb4_unicode_ci,
  `sub_total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'tax_amount',
  `tax_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grand_total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tips` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_type` int NOT NULL DEFAULT '1' COMMENT '1 = Delivery , 2 = Pickup,3="dine in",4="pos"',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `building` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `landmark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_area` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_charge` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `couponcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_notes` text COLLATE utf8mb4_unicode_ci,
  `vendor_note` text COLLATE utf8mb4_unicode_ci,
  `customer_name` text COLLATE utf8mb4_unicode_ci,
  `customer_email` text COLLATE utf8mb4_unicode_ci,
  `mobile` text COLLATE utf8mb4_unicode_ci,
  `delivery_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL,
  `status_type` int NOT NULL,
  `is_notification` int NOT NULL DEFAULT '1' COMMENT '1 = Unread , 2 = Read',
  `screenshot` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` int NOT NULL COMMENT '1=unpaid,2=paid',
  `dinein_table` int DEFAULT NULL,
  `dinein_tablename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `other_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `other_settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `estimated_delivery_on_off` int DEFAULT NULL COMMENT '	1=Yes, 2=No',
  `days_of_estimated_delivery` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `trusted_badge_image_1` text COLLATE utf8mb4_general_ci,
  `trusted_badge_image_2` text COLLATE utf8mb4_general_ci,
  `trusted_badge_image_3` text COLLATE utf8mb4_general_ci,
  `trusted_badge_image_4` text COLLATE utf8mb4_general_ci,
  `safe_secure_checkout_payment_selection` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `safe_secure_checkout_text` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `safe_secure_checkout_text_color` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `maintenance_on_off` int DEFAULT NULL COMMENT '1=yes,2=no	',
  `maintenance_title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `maintenance_description` text COLLATE utf8mb4_general_ci,
  `maintenance_image` text COLLATE utf8mb4_general_ci,
  `notice_on_off` int DEFAULT NULL COMMENT '	1=yes,2=no	',
  `notice_title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `notice_description` text COLLATE utf8mb4_general_ci,
  `tips_settings` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `reorder_id` int NOT NULL,
  `vendor_id` int DEFAULT NULL,
  `unique_identifier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_type` int NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `public_key` text COLLATE utf8mb4_unicode_ci,
  `secret_key` text COLLATE utf8mb4_unicode_ci,
  `encryption_key` text COLLATE utf8mb4_unicode_ci,
  `environment` int NOT NULL,
  `payment_description` longtext COLLATE utf8mb4_unicode_ci,
  `base_url_by_region` text COLLATE utf8mb4_unicode_ci,
  `is_available` int NOT NULL,
  `is_activate` int NOT NULL DEFAULT '1' COMMENT '1=Yes,2=No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `pixcel_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pixcel_settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `twitter_pixcel_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT '-',
  `facebook_pixcel_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT '-',
  `linkedin_pixcel_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT '-',
  `google_tag_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT '-',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `plans` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reorder_id` int NOT NULL,
  `vendor_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name` text COLLATE utf8mb4_general_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_general_ci,
  `features` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` float NOT NULL,
  `tax` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `themes_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_type` int NOT NULL COMMENT '1 = duration, 2 = days',
  `duration` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT '1=1 month\r\n2=3 month\r\n3=6 month\r\n4=1\r\n year\r\n\r\n\r\n',
  `days` int NOT NULL,
  `order_limit` int NOT NULL,
  `appointment_limit` int NOT NULL,
  `custom_domain` int NOT NULL COMMENT '1=yes,2=no',
  `google_analytics` int NOT NULL COMMENT '1=yes,2=no',
  `pos` int NOT NULL COMMENT '1 = Yes , 2 = No',
  `vendor_app` int NOT NULL,
  `customer_app` int DEFAULT NULL COMMENT '1=yes,2=no',
  `role_management` int DEFAULT NULL COMMENT '1=yes,2=no',
  `pwa` int DEFAULT NULL,
  `is_available` int DEFAULT '1' COMMENT '1=Yes\r\n2=No\r\n',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `coupons` int DEFAULT NULL COMMENT '1=yes,2=no',
  `themes` int DEFAULT NULL COMMENT '1=yes,2=no',
  `blogs` int DEFAULT NULL COMMENT '1=yes,2=no',
  `google_login` int DEFAULT NULL COMMENT '1=yes,2=no',
  `facebook_login` int NOT NULL,
  `sound_notification` int DEFAULT NULL COMMENT '1=yes,2=no',
  `whatsapp_message` int DEFAULT NULL COMMENT '1=yes,2=no',
  `telegram_message` int DEFAULT NULL COMMENT '1=yes,2=no',
  `pixel` int NOT NULL,
  `tax_report` int NOT NULL DEFAULT '2',
  `global_addons` int NOT NULL DEFAULT '2',
  `product_qa` int NOT NULL DEFAULT '2',
  `bulk_import` int NOT NULL DEFAULT '2',
  `shipping_management` int NOT NULL DEFAULT '2',
  `top_deals` int NOT NULL DEFAULT '2',
  `reports` int NOT NULL DEFAULT '2' COMMENT '1=enable, 2=disable',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `privacypolicy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `privacypolicy` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `privacypolicy_content` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `item_id` int NOT NULL,
  `reorder_id` int DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `is_imported` int DEFAULT '2',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `promocodes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `promocodes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `reorder_id` int NOT NULL,
  `vendor_id` int NOT NULL,
  `offer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `offer_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `offer_type` int NOT NULL COMMENT '1=fixed,2=percentage',
  `offer_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_amount` int NOT NULL,
  `usage_type` int DEFAULT NULL COMMENT '1=Limited time\r\n,2=multiple times',
  `usage_limit` int NOT NULL,
  `start_date` date NOT NULL,
  `exp_date` date NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_available` int NOT NULL DEFAULT '1' COMMENT '1=yes,2=no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `promotionalbanner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `promotionalbanner` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reorder_id` int NOT NULL,
  `vendor_id` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `question_answer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `question_answer` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `product_id` int DEFAULT NULL,
  `service_id` int DEFAULT NULL,
  `question` text COLLATE utf8mb4_general_ci NOT NULL,
  `answer` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `role_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_access` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `role_id` int NOT NULL,
  `module_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `add` int NOT NULL,
  `edit` int NOT NULL,
  `delete` int NOT NULL,
  `manage` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `role_manager`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_manager` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `module` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `is_available` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `is_deleted` int NOT NULL COMMENT '1=yes,2=no',
  `created_at` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `updated_at` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `checkout_login_required` int DEFAULT '2' COMMENT '1 = Yes , 2 = No',
  `is_checkout_login_required` int DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default-logo.png',
  `darklogo` text COLLATE utf8mb4_unicode_ci,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'favicon-.png',
  `delivery_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timezone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `description` text COLLATE utf8mb4_unicode_ci,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `copyright` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `og_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'og_image.png',
  `language` int NOT NULL DEFAULT '1',
  `template` int NOT NULL DEFAULT '1',
  `primary_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secondary_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cname_title` text COLLATE utf8mb4_unicode_ci,
  `cname_text` text COLLATE utf8mb4_unicode_ci,
  `interval_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `interval_type` int NOT NULL,
  `time_format` int NOT NULL DEFAULT '1' COMMENT '1=Yes,2=No',
  `date_format` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default-banner.png',
  `tracking_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `view_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firebase` longtext COLLATE utf8mb4_unicode_ci,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default-cover.png',
  `notification_sound` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'notification.mp3',
  `recaptcha_version` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_recaptcha_site_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_recaptcha_secret_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `score_threshold` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cookie_text` text COLLATE utf8mb4_unicode_ci,
  `cookie_button_text` text COLLATE utf8mb4_unicode_ci,
  `app_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `background_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theme_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pwa` int DEFAULT NULL,
  `app_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_driver` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_host` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_port` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_encryption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_fromaddress` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_fromname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `landing_page` int NOT NULL,
  `google_client_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `google_client_secret` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `google_redirect_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'http://your-domain-url.com/checklogin/google/callback-google',
  `facebook_client_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `facebook_client_secret` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `facebook_redirect_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'http://your-domain-url.com/checklogin/facebook/callback-facebook',
  `web_host` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refund_policy` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook_mode` int DEFAULT NULL,
  `google_mode` int DEFAULT NULL,
  `whoweare_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whoweare_subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whoweare_description` text COLLATE utf8mb4_unicode_ci,
  `whoweare_image` text COLLATE utf8mb4_unicode_ci,
  `subscribe_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_detail_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `languages` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `default_language` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `default_currency` text COLLATE utf8mb4_unicode_ci,
  `currencies` text COLLATE utf8mb4_unicode_ci,
  `product_ratting_switch` int NOT NULL DEFAULT '1',
  `ordertype_date_time` int DEFAULT '2' COMMENT '1=yes,2=no',
  `per_slot_limit` int DEFAULT '1',
  `online_order` int NOT NULL DEFAULT '1' COMMENT '1 = yes , 2 = no',
  `custom_domain` text COLLATE utf8mb4_unicode_ci,
  `google_review` text COLLATE utf8mb4_unicode_ci,
  `product_type` int DEFAULT '1' COMMENT '1=physical,2=digital',
  `min_order_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `shopify_store_url` text COLLATE utf8mb4_unicode_ci,
  `shopify_access_token` text COLLATE utf8mb4_unicode_ci,
  `order_prefix` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_number_start` int DEFAULT NULL,
  `image_size` float DEFAULT NULL,
  `tawk_widget_id` text COLLATE utf8mb4_unicode_ci,
  `tawk_on_off` int DEFAULT '1',
  `order_success_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_data_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maintenance_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_unavailable_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wizz_chat_settings` text COLLATE utf8mb4_unicode_ci,
  `wizz_chat_on_off` int DEFAULT '1',
  `quick_call` int NOT NULL,
  `quick_call_mobile_view_on_off` int DEFAULT NULL,
  `quick_call_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quick_call_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `quick_call_mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quick_call_position` int NOT NULL,
  `quick_call_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fake_sales_notification` int NOT NULL,
  `product_source` int NOT NULL,
  `next_time_popup` int NOT NULL,
  `notification_display_time` int NOT NULL,
  `sales_notification_position` int NOT NULL,
  `product_fake_view` int NOT NULL,
  `fake_view_message` text COLLATE utf8mb4_unicode_ci,
  `min_view_count` int NOT NULL,
  `max_view_count` int NOT NULL,
  `cart_checkout_countdown` int NOT NULL,
  `countdown_message` text COLLATE utf8mb4_unicode_ci,
  `countdown_expired_message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `countdown_mins` int NOT NULL,
  `min_order_amount_for_free_shipping` text COLLATE utf8mb4_unicode_ci,
  `shipping_charges` text COLLATE utf8mb4_unicode_ci,
  `shipping_area` int DEFAULT NULL,
  `cart_checkout_progressbar` int NOT NULL,
  `progress_message` text COLLATE utf8mb4_unicode_ci,
  `progress_message_end` text COLLATE utf8mb4_unicode_ci,
  `product_section_display` int DEFAULT NULL,
  `product_display_limit` int DEFAULT NULL,
  `forget_password_email_message` longtext COLLATE utf8mb4_unicode_ci,
  `delete_account_email_message` longtext COLLATE utf8mb4_unicode_ci,
  `banktransfer_request_email_message` longtext COLLATE utf8mb4_unicode_ci,
  `cod_request_email_message` longtext COLLATE utf8mb4_unicode_ci,
  `subscription_reject_email_message` longtext COLLATE utf8mb4_unicode_ci,
  `subscription_success_email_message` longtext COLLATE utf8mb4_unicode_ci,
  `admin_subscription_request_email_message` longtext COLLATE utf8mb4_unicode_ci,
  `admin_subscription_success_email_message` longtext COLLATE utf8mb4_unicode_ci,
  `vendor_register_email_message` longtext COLLATE utf8mb4_unicode_ci,
  `admin_vendor_register_email_message` longtext COLLATE utf8mb4_unicode_ci,
  `vendor_status_change_email_message` longtext COLLATE utf8mb4_unicode_ci,
  `contact_email_message` longtext COLLATE utf8mb4_unicode_ci,
  `new_order_invoice_email_message` longtext COLLATE utf8mb4_unicode_ci,
  `vendor_new_order_email_message` longtext COLLATE utf8mb4_unicode_ci,
  `order_status_email_message` longtext COLLATE utf8mb4_unicode_ci,
  `admin_auth_pages_bg_image` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `vendor_register` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `shipping_area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shipping_area` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `reorder_id` int DEFAULT NULL,
  `area_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `delivery_charge` double NOT NULL,
  `is_available` int NOT NULL DEFAULT '1' COMMENT '1 = yes, 2 = no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `shipping_companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shipping_companies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whatsapp_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shipping_companies_is_active_index` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `shipping_company_vendor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shipping_company_vendor` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `shipping_company_id` bigint unsigned NOT NULL,
  `vendor_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shipping_company_vendor_unique` (`shipping_company_id`,`vendor_id`),
  UNIQUE KEY `shipping_company_vendor_vendor_unique` (`vendor_id`),
  CONSTRAINT `shipping_company_vendor_shipping_company_id_foreign` FOREIGN KEY (`shipping_company_id`) REFERENCES `shipping_companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `shipping_company_vendor_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `social_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `social_links` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `icon` text NOT NULL,
  `link` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `store_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `store_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reorder_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `is_available` int NOT NULL DEFAULT '1' COMMENT '1=Yes,2=No',
  `is_deleted` int NOT NULL DEFAULT '2' COMMENT '1=Yes,2=No',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `subscribers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscribers` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `systemaddons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `systemaddons` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `unique_identifier` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `version` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `activated` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `type` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tables` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reorder_id` int NOT NULL,
  `vendor_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `is_available` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tax`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tax` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reorder_id` int NOT NULL,
  `vendor_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` int NOT NULL,
  `tax` varchar(255) NOT NULL,
  `is_available` int NOT NULL DEFAULT '1' COMMENT '1=Yes,2=No',
  `is_deleted` int NOT NULL DEFAULT '2' COMMENT '1=Yes,2=No',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `telegram_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `telegram_message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `item_message` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `telegram_message` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `order_created` int NOT NULL,
  `telegram_access_token` text COLLATE utf8mb4_general_ci NOT NULL,
  `telegram_chat_id` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `terms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `terms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `terms_content` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testimonials` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reorder_id` int NOT NULL,
  `vendor_id` int NOT NULL,
  `item_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `star` int NOT NULL,
  `description` longtext COLLATE utf8mb4_general_ci,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `theme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `theme` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reorder_id` int NOT NULL,
  `vendor_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `updated_at` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `theme_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `theme_sections` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `vendor_id` bigint unsigned NOT NULL,
  `section_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reorder_id` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `timings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `timings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `day` varchar(50) NOT NULL,
  `open_time` varchar(30) NOT NULL,
  `break_start` varchar(255) NOT NULL,
  `break_end` varchar(255) NOT NULL,
  `close_time` varchar(30) NOT NULL,
  `is_always_close` tinyint(1) NOT NULL COMMENT '1 For Yes, 2 For No',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `top_deals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `top_deals` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `start_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `offer_type` int NOT NULL,
  `deal_type` int NOT NULL COMMENT '1=one time,2=daily',
  `top_deals_switch` int NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `offer_amount` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transactions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `user_id` text COLLATE utf8mb4_general_ci,
  `order_id` text COLLATE utf8mb4_general_ci,
  `order_number` text COLLATE utf8mb4_general_ci,
  `transaction_number` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `transaction_type` text COLLATE utf8mb4_general_ci NOT NULL COMMENT '1 = added-money-wallet,\r\n2 = order placed (using wallet),\r\n3 = order cancel ,\r\n',
  `plan_id` int NOT NULL,
  `plan_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'payment_type = COD : 1,RazorPay : 2, Stripe : 3, Flutterwave : 4, Paystack : 5, Mercado Pago : 7, PayPal : 8, MyFatoorah : 9, toyyibpay : 10 , \r\nwallet:16\r\n ',
  `payment_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `amount` float NOT NULL DEFAULT '0',
  `tips` varchar(11) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `grand_total` float NOT NULL,
  `tax` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `offer_amount` float DEFAULT NULL,
  `offer_code` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '1=1 Month,\r\n2=3Month\r\n3=6 Month\r\n4=1 Year',
  `days` int DEFAULT NULL,
  `purchase_date` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `service_limit` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `appoinment_limit` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `custom_domain` int NOT NULL COMMENT '1 = yes, 2 = no',
  `google_analytics` int NOT NULL COMMENT '1 = yes, 2 = no',
  `pos` int NOT NULL COMMENT '1 = yes, 2 = no',
  `vendor_app` int NOT NULL COMMENT '1 = Yes , 2 = No',
  `customer_app` int DEFAULT NULL COMMENT '1=yes,2=no',
  `role_management` int DEFAULT NULL COMMENT '1=yes,2=no',
  `pwa` int DEFAULT NULL,
  `coupons` int DEFAULT NULL,
  `themes` int NOT NULL,
  `expire_date` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `themes_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `screenshot` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` int NOT NULL COMMENT '1 = pending, 2 = yes/BankTransferAccepted,3=no/BankTransferDeclined',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `blogs` int DEFAULT NULL,
  `google_login` int DEFAULT NULL,
  `facebook_login` int NOT NULL,
  `sound_notification` int DEFAULT NULL,
  `whatsapp_message` int DEFAULT NULL,
  `telegram_message` int DEFAULT NULL,
  `pixel` int DEFAULT NULL,
  `tax_report` int NOT NULL DEFAULT '2',
  `global_addons` int NOT NULL DEFAULT '2',
  `product_qa` int NOT NULL DEFAULT '2',
  `bulk_import` int NOT NULL DEFAULT '2',
  `shipping_management` int NOT NULL DEFAULT '2',
  `top_deals` int NOT NULL DEFAULT '2',
  `features` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tax_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reports` int NOT NULL DEFAULT '2' COMMENT '1=enable, 2=disable',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `store_id` int DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_text` text COLLATE utf8mb4_unicode_ci,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1=Admin,2=vendor,4=driver,3=User/Customer',
  `description` text COLLATE utf8mb4_unicode_ci,
  `token` longtext COLLATE utf8mb4_unicode_ci,
  `country_id` int DEFAULT NULL,
  `city_id` int DEFAULT NULL,
  `plan_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `available_on_landing` int NOT NULL DEFAULT '2' COMMENT '1 = Yes , 2 = No',
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` int DEFAULT NULL,
  `free_plan` int NOT NULL DEFAULT '0',
  `is_delivery` tinyint(1) DEFAULT NULL COMMENT '1=Yes,2=No',
  `allow_without_subscription` int NOT NULL DEFAULT '2' COMMENT '1=Yes,2=No',
  `is_verified` tinyint(1) NOT NULL COMMENT '1=Yes,2=No',
  `is_available` tinyint(1) NOT NULL COMMENT '1=Yes,2=No',
  `is_deleted` int NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license_type` text COLLATE utf8mb4_unicode_ci,
  `role_id` int NOT NULL,
  `vendor_id` int DEFAULT NULL,
  `wallet` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `custom_domain` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_seen_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `variants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `variants` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `price` float NOT NULL,
  `original_price` float DEFAULT '0',
  `qty` int DEFAULT '0',
  `min_order` int DEFAULT NULL,
  `max_order` int DEFAULT NULL,
  `low_qty` int DEFAULT NULL,
  `stock_management` int NOT NULL COMMENT '1=Yes,2=No',
  `is_available` int NOT NULL DEFAULT '1' COMMENT '1=Yes,2=No',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `whatsapp_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `whatsapp_message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `item_message` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `order_whatsapp_message` longtext COLLATE utf8mb4_general_ci,
  `order_status_message` longtext COLLATE utf8mb4_general_ci,
  `whatsapp_number` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `whatsapp_phone_number_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `whatsapp_access_token` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `whatsapp_chat_on_off` int NOT NULL,
  `whatsapp_mobile_view_on_off` int NOT NULL,
  `whatsapp_chat_position` int NOT NULL DEFAULT '1' COMMENT '1=left, 2=right',
  `order_created` int NOT NULL COMMENT '1 = Yes , 2 = No',
  `status_change` int NOT NULL COMMENT '1 = Yes , 2 = No',
  `message_type` int NOT NULL COMMENT '1 = automatic_using_api , 2 = manually	',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `whatsapp_otps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `whatsapp_otps` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` timestamp NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `whatsapp_otps_mobile_index` (`mobile`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `whoweare`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `whoweare` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `reorder_id` int DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `sub_title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1,'2014_10_12_000000_create_users_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2,'2021_12_20_101946_create_settings_table',2);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3,'2021_12_20_121616_create_categories_table',3);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (4,'2021_12_22_072131_create_cuisines_table',4);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (5,'2021_12_23_065134_create_menuses_table',5);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (6,'2014_10_12_100000_create_password_resets_table',6);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (7,'2019_08_19_000000_create_failed_jobs_table',6);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (8,'2019_12_14_000001_create_personal_access_tokens_table',6);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (9,'2022_11_14_051836_create_banner_image_table',6);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (10,'2022_11_14_053221_create_banner_image_table',7);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (11,'2014_10_12_100000_create_password_reset_tokens_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (12,'2026_03_27_120000_create_landing2_translations_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (13,'2026_04_09_220258_add_whatsapp_to_users_table',9);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (17,'2026_04_23_202227_add_dollar_price_to_items_table',10);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (18,'2026_04_23_202310_add_email_to_orders_table',11);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (19,'2026_04_30_123104_add_currency_to_items_table',11);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (20,'2026_05_08_092026_add_image_to_categories_table',12);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (21,'2026_05_08_202755_add_new_features_to_plans_and_transactions_tables',13);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (22,'2026_05_08_204813_add_reports_to_plans_and_transactions_tables',14);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (23,'2026_05_24_002936_create_automations_table',15);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (24,'2026_05_24_002957_create_automation_logs_table',15);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (25,'2026_05_24_003312_add_last_seen_at_to_users_table',15);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (26,'2026_05_24_004609_create_whatsapp_otps_table',15);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (27,'2026_05_24_014856_create_jobs_table',16);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (28,'2026_06_10_000001_create_shipping_companies_table',17);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (29,'2026_06_10_000002_create_shipping_company_vendor_table',18);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (30,'2026_06_10_000003_add_unique_vendor_to_shipping_company_vendor_table',19);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (31,'2026_06_14_234459_create_instagram_imports_table',20);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (32,'2026_06_17_212216_add_homepage_flags_to_items_table',21);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (33,'2026_06_17_214424_create_theme_sections_table',22);
