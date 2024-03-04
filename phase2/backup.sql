-- MySQL dump 10.13  Distrib 5.7.40, for Linux (x86_64)
--
-- Host: localhost    Database: idm
-- ------------------------------------------------------
-- Server version	5.7.40

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `SequelizeMeta`
--

DROP TABLE IF EXISTS `SequelizeMeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SequelizeMeta` (
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`name`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SequelizeMeta`
--

LOCK TABLES `SequelizeMeta` WRITE;
/*!40000 ALTER TABLE `SequelizeMeta` DISABLE KEYS */;
INSERT INTO `SequelizeMeta` VALUES ('201802190000-CreateUserTable.js'),('201802190003-CreateUserRegistrationProfileTable.js'),('201802190005-CreateOrganizationTable.js'),('201802190008-CreateOAuthClientTable.js'),('201802190009-CreateUserAuthorizedApplicationTable.js'),('201802190010-CreateRoleTable.js'),('201802190015-CreatePermissionTable.js'),('201802190020-CreateRoleAssignmentTable.js'),('201802190025-CreateRolePermissionTable.js'),('201802190030-CreateUserOrganizationTable.js'),('201802190035-CreateIotTable.js'),('201802190040-CreatePepProxyTable.js'),('201802190045-CreateAuthZForceTable.js'),('201802190050-CreateAuthTokenTable.js'),('201802190060-CreateOAuthAuthorizationCodeTable.js'),('201802190065-CreateOAuthAccessTokenTable.js'),('201802190070-CreateOAuthRefreshTokenTable.js'),('201802190075-CreateOAuthScopeTable.js'),('20180405125424-CreateUserTourAttribute.js'),('20180612134640-CreateEidasTable.js'),('20180727101745-CreateUserEidasIdAttribute.js'),('20180730094347-CreateTrustedApplicationsTable.js'),('20180828133454-CreatePasswordSalt.js'),('20180921104653-CreateEidasNifColumn.js'),('20180922140934-CreateOauthTokenType.js'),('20181022103002-CreateEidasTypeAndAttributes.js'),('20181108144720-RevokeToken.js'),('20181113121450-FixExtraAndScopeAttribute.js'),('20181203120316-FixTokenTypesLength.js'),('20190116101526-CreateSignOutUrl.js');
/*!40000 ALTER TABLE `SequelizeMeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_token`
--

DROP TABLE IF EXISTS `auth_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_token` (
  `access_token` varchar(255) NOT NULL,
  `expires` datetime DEFAULT NULL,
  `valid` tinyint(1) DEFAULT NULL,
  `user_id` varchar(36) DEFAULT NULL,
  `pep_proxy_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`access_token`),
  UNIQUE KEY `access_token` (`access_token`),
  KEY `user_id` (`user_id`),
  KEY `pep_proxy_id` (`pep_proxy_id`),
  CONSTRAINT `auth_token_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `auth_token_ibfk_2` FOREIGN KEY (`pep_proxy_id`) REFERENCES `pep_proxy` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_token`
--

LOCK TABLES `auth_token` WRITE;
/*!40000 ALTER TABLE `auth_token` DISABLE KEYS */;
INSERT INTO `auth_token` VALUES ('009faa7f-ed31-457a-98e7-b688dddb5e2d','2023-01-15 10:28:41',1,NULL,'pep_proxy_e580b05c-e416-4964-902c-4800f7b6e8b1'),('01ae5a99-a870-49f0-a43e-691a1aa717b2','2023-01-14 07:28:44',1,'admin',NULL),('01c5d11b-be94-4c3f-aee5-76f9b010d36c','2023-01-14 20:34:25',1,NULL,'pep_proxy_e580b05c-e416-4964-902c-4800f7b6e8b1'),('01eee95a-e27c-4ad8-a770-bdd85429e4e7','2023-01-13 23:31:57',1,'admin',NULL),('031ec0e1-a1c0-478e-a123-1d8e3998e3de','2023-01-13 21:30:04',1,'admin',NULL),('05f7dbe9-1fee-4407-b365-00e18e680b9b','2023-01-13 21:30:04',1,'admin',NULL),('066b9076-5678-4eb6-a0da-57be0b0e6ea8','2023-01-14 22:48:09',1,'admin',NULL),('06a13d00-bfa9-4d5e-a8bb-1723b01b2def','2023-01-14 07:33:45',1,'admin',NULL),('0829ef59-1d1e-4155-b66b-5edc556bbe9b','2023-01-15 18:25:43',1,'admin',NULL),('09d298c8-0c4e-408e-b6c4-57b096aaa4ee','2023-01-14 16:47:42',1,NULL,'pep_proxy_e580b05c-e416-4964-902c-4800f7b6e8b1'),('0daa5ea4-b626-4373-8cbb-1fbc2880f947','2023-01-14 07:34:30',1,'admin',NULL),('0e0d3383-a637-4925-bdc7-efe0aab79f35','2023-01-14 16:31:31',1,NULL,'pep_proxy_e580b05c-e416-4964-902c-4800f7b6e8b1'),('12ae2759-a3ab-460e-9f48-06c64b81600c','2023-01-13 21:29:49',1,'admin',NULL),('13c48a6f-9668-4c28-8466-375331c0b054','2023-01-14 09:49:17',1,'admin',NULL),('13c569ce-d86c-4b48-9e8e-dc86d0289621','2023-01-14 22:44:28',1,'admin',NULL),('146c5975-5055-4acb-b1d6-503a778219d7','2023-01-14 18:27:49',1,'admin',NULL),('16050f0f-7111-4ad3-9fbb-e14413e13a3f','2023-01-14 22:34:38',1,'admin',NULL),('1636a8d6-2889-433c-849e-eaec3e8a4841','2023-01-13 21:37:58',1,'admin',NULL),('1658cd7c-6b7f-4134-821a-3845b64c5f38','2023-01-14 09:52:45',1,'admin',NULL),('16fec74d-7ce8-4ee1-bbd4-78122eb735d0','2023-01-13 21:37:11',1,'admin',NULL),('1867170f-d866-46c4-86c0-68e74f837783','2023-01-14 16:29:20',1,NULL,'pep_proxy_e580b05c-e416-4964-902c-4800f7b6e8b1'),('191585cc-2ac0-4675-ac14-ce01a757d9dd','2023-01-15 18:27:21',1,'admin',NULL),('1a6dc299-4425-46cc-9fd3-92d38de29da0','2023-01-15 11:30:07',1,'admin',NULL),('1c825868-0363-48b1-99f0-8f77f288c540','2023-01-15 17:58:55',1,NULL,'pep_proxy_e580b05c-e416-4964-902c-4800f7b6e8b1'),('1fd505c6-c43b-483b-84fe-17effb54aa98','2023-01-14 13:17:11',1,NULL,'pep_proxy_e580b05c-e416-4964-902c-4800f7b6e8b1'),('2224f66c-f229-4fed-8c2d-02ff374dc7cb','2023-01-13 21:30:00',1,'admin',NULL),('22ce9abd-3329-45e2-bfe2-fc3f52c7f685','2023-01-13 21:40:44',1,'admin',NULL),('22db5d5f-152d-4ea6-9557-a43cfe884759','2023-01-15 01:00:19',1,'admin',NULL),('24c1245a-3b38-4950-a5ab-656a4452653d','2023-01-14 09:46:41',1,'admin',NULL),('25613dff-5e20-4460-b0a2-ff2db63be664','2023-01-13 21:31:52',1,'admin',NULL),('271852b2-6e55-408b-8732-b37076fbc26e','2023-01-14 18:33:26',1,'admin',NULL),('2730bcfa-f543-41f5-bdd7-d9a651f21835','2023-01-14 22:31:38',1,'admin',NULL),('28cdefaf-6a46-4902-a617-cb1189a25d1e','2023-01-14 22:22:52',1,'admin',NULL),('2993dbac-8ace-4af2-abdb-5dc8b1226708','2023-01-14 01:21:04',1,'admin',NULL),('29b54a32-33d6-4ea7-ad36-6d333cbdc727','2023-01-13 21:24:43',1,'admin',NULL),('29ef1ffe-b254-4fe7-81f9-c4813d4df7df','2023-01-14 18:19:53',1,'admin',NULL),('2d8ec28d-85ed-4393-b906-2a74269a1dd8','2023-01-13 21:27:38',1,'admin',NULL),('2e5d0d20-29b9-4059-822d-30bc41b17ae9','2023-01-14 07:27:35',1,'admin',NULL),('2fc016c1-0d89-413d-be3e-a7ffe331d011','2023-01-14 08:57:36',1,'admin',NULL),('3088a728-c431-4321-b289-4dc3c5b3968a','2023-01-14 16:30:13',1,NULL,'pep_proxy_e580b05c-e416-4964-902c-4800f7b6e8b1'),('32298657-fc92-4491-b49f-97ef21d5334c','2023-01-13 21:37:41',1,'admin',NULL),('32c8e98e-a376-4afc-af85-21c86f76e278','2023-01-14 17:52:57',1,'admin',NULL),('3369355f-9efc-44e1-adb2-ad11f614be6f','2023-01-14 22:23:18',1,'admin',NULL),('35572264-cf4b-4997-a31a-8072523b5da9','2023-01-15 18:06:05',1,'admin',NULL),('369b9671-eb2d-4815-90e1-20112681c038','2023-01-14 01:20:44',1,'admin',NULL),('3980dfe7-e338-4f4c-b05d-23e9f3253c70','2023-01-13 21:42:23',1,'admin',NULL),('3a5d743a-a708-497d-b70e-83ef2fe03f0b','2023-01-14 18:33:20',1,'admin',NULL),('3ad5faae-09d2-419c-9bdf-540373644c81','2023-01-13 21:50:05',1,'admin',NULL),('3af2e83f-7923-40a5-877b-36a81ec71e38','2023-01-15 18:26:39',1,'admin',NULL),('3ef031bf-f70b-491d-a9bb-ff800580bb3a','2023-01-14 21:45:18',1,'admin',NULL),('41ca0978-76e1-4974-aa1c-b5a97c1cfe57','2023-01-14 21:12:29',1,'admin',NULL),('4250d197-6f59-45fa-9fa5-8d46a8d24a04','2023-01-14 23:02:33',1,'admin',NULL),('429abe2a-535f-4cd3-965a-d31836a50096','2023-01-15 18:05:18',1,'admin',NULL),('430a32df-b7a1-4c8a-90e8-05d57e459eaf','2023-01-14 07:19:13',1,'admin',NULL),('45c4f05d-2cf3-4ca9-892c-62e137388845','2023-01-13 21:30:04',1,'admin',NULL),('45fb146e-cff7-40bf-a959-47eb497a05e5','2023-01-13 21:31:41',1,'admin',NULL),('46f5edf5-63d7-4eaf-9ea5-8257835f29aa','2023-01-15 13:06:08',1,'admin',NULL),('475555ed-d321-4a22-8c25-ec99f978169e','2023-01-14 09:24:29',1,'admin',NULL),('49e3db08-6df8-494a-9ad8-f920ece29fc5','2023-01-13 21:42:45',1,'admin',NULL),('4c0602c0-5234-48f7-ae2d-4b0489266d0d','2023-01-13 21:42:24',1,'admin',NULL),('4c1882bd-04fa-43dd-82ba-2db7db9bf8d7','2023-01-13 21:30:03',1,'admin',NULL),('4fa8d04c-5e19-4b48-99a1-f765dcb7028b','2023-01-14 22:34:41',1,'admin',NULL),('530f780b-59d2-4151-bed4-074f8f06e573','2023-01-14 22:38:13',1,'admin',NULL),('5355a05c-ccc9-4245-82fe-a655f56dfdf5','2023-01-14 21:26:21',1,'admin',NULL),('556fde15-9143-47e1-9f5e-333d67a2cd2a','2023-01-13 21:30:17',1,'admin',NULL),('559d2014-315b-4377-9c64-c6179b17946d','2023-01-14 16:30:50',1,NULL,'pep_proxy_e580b05c-e416-4964-902c-4800f7b6e8b1'),('567850b8-d313-4b37-8789-d7217cf33d35','2023-01-13 21:39:20',1,NULL,'pep_proxy_e580b05c-e416-4964-902c-4800f7b6e8b1'),('56bcc7d6-2249-4be9-825b-d998a0fe06d8','2023-01-15 18:13:56',1,'admin',NULL),('5a09d7e9-b519-43fd-966c-0d8402014c49','2023-01-14 07:23:25',1,'admin',NULL),('5b081321-010d-4ed8-8161-f5e3c78ab810','2023-01-14 13:19:41',1,'admin',NULL),('5c66f068-3c1d-4eb7-82df-a4d5fef5a0ad','2023-01-15 18:09:12',1,'admin',NULL),('5f3d9442-650b-4798-aefa-4b8b44674a7a','2023-01-14 07:17:02',1,NULL,'pep_proxy_e580b05c-e416-4964-902c-4800f7b6e8b1'),('63048eee-1cd4-4832-8f40-2eeec9499022','2023-01-15 19:21:53',1,'admin',NULL),('65e76768-41a8-43c5-916e-4a47fcbe1850','2023-01-14 08:20:12',1,'admin',NULL),('65ed18d6-9e4e-4e31-91a4-5ab510079ed1','2023-01-15 13:06:15',1,'admin',NULL),('665fcc1c-22a9-4268-9df5-436378b3ed1c','2023-01-15 13:13:21',1,'admin',NULL),('698df8db-a18a-4d9f-aa4e-0d35f211fffb','2023-01-14 15:52:06',1,'admin',NULL),('6a1ee515-bf60-41f8-b155-c5090cbf20d3','2023-01-14 19:45:18',1,'admin',NULL),('72d3735b-3dfc-410a-b709-86cfe964a8a4','2023-01-13 21:21:48',1,NULL,'pep_proxy_e580b05c-e416-4964-902c-4800f7b6e8b1'),('75df1671-1402-4f9f-af33-09c1ace4dec2','2023-01-13 21:44:25',1,'admin',NULL),('76f2a56f-de73-4633-b471-fd85c7bae17b','2023-01-13 23:31:34',1,'admin',NULL),('7779b1fa-4858-4ec8-9a06-e73f89905bda','2023-01-13 21:31:51',1,'admin',NULL),('78b4969c-524a-4f68-985b-1cdefceb57b9','2023-01-14 08:18:16',1,'admin',NULL),('7b34a271-60c6-4156-9895-b7c3591bbe54','2023-01-13 21:45:11',1,'admin',NULL),('7ea422b7-82a0-455e-9980-f8d940f04555','2023-01-13 23:03:18',1,'admin',NULL),('7fabdee5-52e4-493f-b595-7ace67109727','2023-01-15 18:05:10',1,'admin',NULL),('81a20a79-cf04-44da-914a-099dccb46d76','2023-01-14 16:35:13',1,NULL,'pep_proxy_e580b05c-e416-4964-902c-4800f7b6e8b1'),('81f6ab4e-6492-4a2a-b91f-1729cdc63bda','2023-01-13 21:35:19',1,'admin',NULL),('826fb8c4-21fc-46d2-bd98-857e03403aed','2023-01-14 09:18:14',1,'admin',NULL),('83d69fc8-cfc5-4e87-a291-5c191fa087a3','2023-01-13 21:31:52',1,'admin',NULL),('85e983c2-66c7-4b5e-84e9-05ad4708a574','2023-01-14 01:21:37',1,'admin',NULL),('86561bfb-b9c8-46c1-9d0f-ef483c2ab05f','2023-01-14 22:38:07',1,'admin',NULL),('8b53666b-f2eb-4aed-bd98-5d419d166d6a','2023-01-13 21:22:00',1,'admin',NULL),('8bf417f2-5b5c-45f1-a8f5-672afc5f80c5','2023-01-13 21:45:04',1,'admin',NULL),('8d598d34-b85e-4464-9ebf-1684c6da8161','2023-01-13 21:41:54',1,'admin',NULL),('91143c0d-d332-4557-8d64-8fde2431426b','2023-01-14 13:25:51',1,'admin',NULL),('91561207-f22c-4d58-b788-e06f3fea85de','2023-01-14 22:31:31',1,'admin',NULL),('92a64c6e-9386-4611-af55-60424d468d70','2023-01-14 22:35:53',1,'admin',NULL),('957c1eb7-53ce-439d-b27d-1acc5c3c1f63','2023-01-14 09:02:03',1,'admin',NULL),('95cf4cca-a035-40d3-a4dc-1df838f18a03','2023-01-14 07:30:00',1,'admin',NULL),('974fa378-ae1b-4a19-8e43-ef56796e0054','2023-01-14 01:21:06',1,'admin',NULL),('98617744-55d0-4a2b-becf-e93bdde4a408','2023-01-13 21:25:53',1,'admin',NULL),('994a9fdc-9afa-4cd1-bdb2-c07a16f31fe0','2023-01-14 09:50:44',1,'admin',NULL),('9a5d950d-7b18-42b8-968a-86adcee03ad4','2023-01-15 18:01:00',1,'admin',NULL),('9c817f3d-1419-43c3-8aa8-626714a54a28','2023-01-15 18:19:07',1,'admin',NULL),('9c8a8b28-15ba-4c49-b348-3a6318ba3e31','2023-01-14 13:19:38',1,'admin',NULL),('a0a00dd8-ea8f-46cf-81fb-df056dece78e','2023-01-14 22:20:15',1,'admin',NULL),('a1d8de71-3b2a-4c49-8f3b-12fb3fac528d','2023-01-14 07:36:38',1,'admin',NULL),('a20454b9-dbac-4b6c-b329-0bec387adf56','2023-01-13 21:27:26',1,'admin',NULL),('a2e6ff94-5307-417a-a540-da4881caae94','2023-01-14 22:42:15',1,'admin',NULL),('a5c742e7-0c13-4885-9a75-d9840ec08698','2023-01-14 22:48:03',1,'admin',NULL),('a71632d9-ed3c-41fb-8642-18c6785f6269','2023-01-14 23:02:36',1,'admin',NULL),('a72d8cae-99e1-4acb-b129-06b36d207aeb','2023-01-14 09:54:23',1,'admin',NULL),('a76f8992-5ab2-4341-bfe6-93bddadb3164','2023-01-14 09:05:13',1,'admin',NULL),('a8f6bba5-cb12-4806-8896-b487fbacaf27','2023-01-15 13:52:43',1,'admin',NULL),('ab408409-5b47-40b5-bba1-c4a5e2a41d8e','2023-01-14 08:56:26',1,'admin',NULL),('ad4c6d0e-a720-4fe8-9520-1f5a0e260c3c','2023-01-14 00:27:53',1,'admin',NULL),('ada9772e-3be4-4155-a707-3aa58cdb6e29','2023-01-13 21:39:34',1,'admin',NULL),('af23aaba-c37a-48f4-8e87-8329040cc873','2023-01-14 07:17:13',1,'admin',NULL),('af2aec5f-349c-44f6-9ce3-e59faf6db332','2023-01-15 10:29:12',1,'admin',NULL),('af30a154-cabd-4119-b8eb-eb18dde88e7e','2023-01-14 20:34:39',1,'admin',NULL),('af338667-d6a7-424f-b636-14cc594d9ae4','2023-01-13 21:30:04',1,'admin',NULL),('b04e0ae0-786f-4102-ad1a-024c212249af','2023-01-14 17:53:34',1,'admin',NULL),('b13ce181-4fab-4a27-85ac-81d9e4e9a45f','2023-01-14 22:44:34',1,'admin',NULL),('b25c7cc0-d8a4-438d-9ebf-10c73382e54c','2023-01-14 07:54:55',1,'admin',NULL),('b49a9460-d7b5-4638-a7e7-0801d0d371d7','2023-01-13 21:51:55',1,'admin',NULL),('b665cdb2-8f4a-48fa-ae94-d6dacb0e73bd','2023-01-15 19:40:21',1,'admin',NULL),('b6698edf-c3cd-4a7b-9bc4-f2e6bb98bf81','2023-01-15 19:23:59',1,'admin',NULL),('b70d17bb-97ed-4d26-8906-f63209a37a41','2023-01-14 16:37:21',1,NULL,'pep_proxy_e580b05c-e416-4964-902c-4800f7b6e8b1'),('b803fa96-ae36-42f3-9724-c5f72dc84ce6','2023-01-14 17:48:54',1,'admin',NULL),('b92184d8-2377-4b3e-9f42-902e20009137','2023-01-14 14:40:14',1,'admin',NULL),('ba786fba-e7b8-446f-8728-9f9118cb8681','2023-01-14 07:26:34',1,'admin',NULL),('bad2ac2c-c753-4a2c-8575-4909bf1787a1','2023-01-15 18:10:43',1,'admin',NULL),('bceea1a1-7527-46ae-8f08-a71976846503','2023-01-14 07:32:33',1,'admin',NULL),('bd6927f3-3a7f-4b20-a0f6-0c200d6d2db0','2023-01-13 21:37:35',1,'admin',NULL),('be829651-1920-46b3-a917-d3cf9899c1e4','2023-01-14 22:35:56',1,'admin',NULL),('bf5cef21-8900-4d89-aa1a-c1a02de1c6b8','2023-01-13 23:32:01',1,'admin',NULL),('c092130e-4d50-4859-aa9c-66a11507b2a5','2023-01-15 18:25:49',1,'admin',NULL),('c58da908-324c-4793-a976-057b07885b80','2023-01-15 18:55:08',1,'admin',NULL),('c76eddac-908e-459b-9068-1280459dc7e4','2023-01-13 22:27:48',1,'admin',NULL),('c868bf74-43ec-4472-a1a2-bc3d0ba88520','2023-01-14 22:42:10',1,'admin',NULL),('c89c4f1e-5702-45ed-bdd1-2c68605fc1ea','2023-01-14 22:31:35',1,'admin',NULL),('c9c7881c-9014-4ddd-ab50-4701430c658f','2023-01-14 22:23:29',1,'admin',NULL),('cac0a404-1ad8-4494-9de6-7eab4ae056de','2023-01-13 22:27:41',1,'admin',NULL),('cdb07f6f-8ee3-4d8f-aed9-981d90e5c48c','2023-01-14 08:21:59',1,'admin',NULL),('cefdb49a-0895-449e-acf4-79639e7805b1','2023-01-14 16:32:31',1,NULL,'pep_proxy_e580b05c-e416-4964-902c-4800f7b6e8b1'),('cf609dd9-f85f-4a75-b84b-2259a94597ee','2023-01-14 08:16:31',1,'admin',NULL),('d109450c-1d0f-41a3-93b6-7608790204e3','2023-01-14 01:21:38',1,'admin',NULL),('d340d1a2-4de7-4dfa-83e4-a00d9df48b74','2023-01-13 21:23:16',1,'admin',NULL),('d3694977-cbc1-4024-8a09-7e890cefc016','2023-01-14 22:14:18',1,'admin',NULL),('d3dcad60-5911-46ac-ae08-b91dc9b74bb6','2023-01-14 09:24:30',1,'admin',NULL),('d5d89eab-344f-4f17-95bc-beb5854df0de','2023-01-14 18:27:39',1,'admin',NULL),('d69aca3b-acbb-496b-9d2c-73f33879085e','2023-01-14 13:23:33',1,'admin',NULL),('d6eede20-d293-451f-b0dd-b6eaf4573bc0','2023-01-14 07:54:05',1,'admin',NULL),('d750171e-b0ec-4b1d-baf1-34f1f8d619a0','2023-01-14 14:04:13',1,'admin',NULL),('d817ea9b-ec84-4d81-9884-3bbccb96baab','2023-01-13 21:31:51',1,'admin',NULL),('d9397db8-f943-45d1-b95a-35d0e785dae4','2023-01-14 22:38:16',1,'admin',NULL),('dad0222d-a861-488d-9129-c6398d2e125b','2023-01-14 09:05:51',1,'admin',NULL),('dba1cb99-f236-4045-af70-e1405ee22e67','2023-01-13 23:07:36',1,'admin',NULL),('dd50a793-9c22-4195-be27-f0a8ed078197','2023-01-14 07:22:23',1,'admin',NULL),('e1f6c537-cc1d-4419-942b-8b4fa18ec8e8','2023-01-14 08:17:33',1,'admin',NULL),('e2410ee4-c387-4f8a-bbd0-157fbfbab7d1','2023-01-14 08:24:34',1,'admin',NULL),('e2bcc103-5f7d-4e30-a833-c3a5696ef87f','2023-01-14 13:21:23',1,'admin',NULL),('e617d266-f2cd-40e6-89f8-71a12ea5d445','2023-01-13 21:58:54',1,'admin',NULL),('ef4a2e69-2fed-43d6-9dfa-c9339b5606f5','2023-01-14 07:21:04',1,'admin',NULL),('f0741763-822b-459e-b5c7-a01d2d56910c','2023-01-14 22:20:23',1,'admin',NULL),('f09c4b38-3ca4-4c8d-990e-85e41ce75d4a','2023-01-14 22:48:06',1,'admin',NULL),('f34cb17d-cedf-4c05-aeac-5450fa167a5b','2023-01-14 14:24:16',1,'admin',NULL),('f3a72f93-c48e-40c6-8575-ce5e2192f128','2023-01-13 21:26:11',1,'admin',NULL),('f4b67fd3-6c8f-4a67-b295-bbf0578292db','2023-01-14 07:17:09',1,'admin',NULL),('f654a2cd-c4ed-49f9-aa34-dcc81c48e1c1','2023-01-13 21:52:15',1,'admin',NULL),('f8ba131e-19bf-469c-9810-6739cbd8fae0','2023-01-14 22:31:42',1,'admin',NULL),('fb2769c1-5e98-428a-af3f-8e1760445b30','2023-01-15 12:43:04',1,'admin',NULL),('fdc983af-804d-44df-810f-76d61583cf10','2023-01-14 13:21:51',1,'admin',NULL),('fffa5bc2-e0e2-43ca-bd6e-faf3145ba508','2023-01-13 21:22:08',1,'admin',NULL);
/*!40000 ALTER TABLE `auth_token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `authzforce`
--

DROP TABLE IF EXISTS `authzforce`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authzforce` (
  `az_domain` varchar(255) NOT NULL,
  `policy` char(36) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `version` int(11) DEFAULT NULL,
  `oauth_client_id` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`az_domain`),
  KEY `oauth_client_id` (`oauth_client_id`),
  CONSTRAINT `authzforce_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authzforce`
--

LOCK TABLES `authzforce` WRITE;
/*!40000 ALTER TABLE `authzforce` DISABLE KEYS */;
/*!40000 ALTER TABLE `authzforce` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eidas_credentials`
--

DROP TABLE IF EXISTS `eidas_credentials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eidas_credentials` (
  `id` varchar(36) NOT NULL,
  `support_contact_person_name` varchar(255) DEFAULT NULL,
  `support_contact_person_surname` varchar(255) DEFAULT NULL,
  `support_contact_person_email` varchar(255) DEFAULT NULL,
  `support_contact_person_telephone_number` varchar(255) DEFAULT NULL,
  `support_contact_person_company` varchar(255) DEFAULT NULL,
  `technical_contact_person_name` varchar(255) DEFAULT NULL,
  `technical_contact_person_surname` varchar(255) DEFAULT NULL,
  `technical_contact_person_email` varchar(255) DEFAULT NULL,
  `technical_contact_person_telephone_number` varchar(255) DEFAULT NULL,
  `technical_contact_person_company` varchar(255) DEFAULT NULL,
  `organization_name` varchar(255) DEFAULT NULL,
  `organization_url` varchar(255) DEFAULT NULL,
  `oauth_client_id` varchar(36) DEFAULT NULL,
  `organization_nif` varchar(255) DEFAULT NULL,
  `sp_type` varchar(255) DEFAULT 'private',
  `attributes_list` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `oauth_client_id` (`oauth_client_id`),
  CONSTRAINT `eidas_credentials_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eidas_credentials`
--

LOCK TABLES `eidas_credentials` WRITE;
/*!40000 ALTER TABLE `eidas_credentials` DISABLE KEYS */;
/*!40000 ALTER TABLE `eidas_credentials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `iot`
--

DROP TABLE IF EXISTS `iot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `iot` (
  `id` varchar(255) NOT NULL,
  `password` varchar(40) DEFAULT NULL,
  `oauth_client_id` varchar(36) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_client_id` (`oauth_client_id`),
  CONSTRAINT `iot_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `iot`
--

LOCK TABLES `iot` WRITE;
/*!40000 ALTER TABLE `iot` DISABLE KEYS */;
/*!40000 ALTER TABLE `iot` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_access_token`
--

DROP TABLE IF EXISTS `oauth_access_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_access_token` (
  `access_token` varchar(255) NOT NULL,
  `expires` datetime DEFAULT NULL,
  `scope` varchar(2000) DEFAULT NULL,
  `refresh_token` varchar(255) DEFAULT NULL,
  `valid` tinyint(1) DEFAULT NULL,
  `extra` json DEFAULT NULL,
  `oauth_client_id` varchar(36) DEFAULT NULL,
  `user_id` varchar(36) DEFAULT NULL,
  `iot_id` varchar(255) DEFAULT NULL,
  `authorization_code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`access_token`),
  UNIQUE KEY `access_token` (`access_token`),
  KEY `oauth_client_id` (`oauth_client_id`),
  KEY `user_id` (`user_id`),
  KEY `iot_id` (`iot_id`),
  KEY `refresh_token` (`refresh_token`),
  KEY `authorization_code_at` (`authorization_code`),
  CONSTRAINT `authorization_code_at` FOREIGN KEY (`authorization_code`) REFERENCES `oauth_authorization_code` (`authorization_code`) ON DELETE CASCADE,
  CONSTRAINT `oauth_access_token_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE,
  CONSTRAINT `oauth_access_token_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `oauth_access_token_ibfk_3` FOREIGN KEY (`iot_id`) REFERENCES `iot` (`id`) ON DELETE CASCADE,
  CONSTRAINT `refresh_token` FOREIGN KEY (`refresh_token`) REFERENCES `oauth_refresh_token` (`refresh_token`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_access_token`
--

LOCK TABLES `oauth_access_token` WRITE;
/*!40000 ALTER TABLE `oauth_access_token` DISABLE KEYS */;
INSERT INTO `oauth_access_token` VALUES ('02dd9b2f3e0ae851f1a761b61954d419aa56e585','2023-01-14 00:27:54','bearer','4e71666808072ba9e051dc9e170180ff6f52827a',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('04039cf0b5414f66fd2f11b7eeb907bdb7a041ed','2023-01-14 22:48:09','bearer','fe1c4d66a060b65bf3da39204c33b97ed00564c4',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('0657ac359805b880d802e41b7dcdf74413475183','2023-01-13 21:30:04','bearer','44cfed00d787218f75117d4bbaa25082b646ec4a',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','admin',NULL,NULL),('071a3cd1d5d13fcc0d433147f640dd22b9c68b03','2023-01-15 18:19:07','bearer','4d0e10eb9bdd1e16348bc0dcee740fa00adfc146',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('0d42c4e6197321c7841c3c0c326d486be8031ec6','2023-01-14 22:35:56','bearer','b0e452e6df6816203a82a3b4ef2473ca636096cc',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('225bd50d17490ce221b89e839ecad3a5313afb3b','2023-01-14 22:42:15','bearer','d8cc50f19759bec8272421ff1bafdbec1920f1c3',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('23a737662423fa6cca0ab759299411359d5a9282','2023-01-15 18:09:12','bearer','ab020f564ef31b0e0ca46511958bb1d49f369cab',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','8b1a00c7-107d-4521-aeea-4a5ca658d062',NULL,NULL),('257577436712ed00b082c0b1fc853b52150a6bc1','2023-01-14 08:21:59','bearer','d62f5af3720915e92cc9443a045102db0a0fb01f',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('27a59e0171b2d150c8b5e27a5e5989f465847762','2023-01-13 21:30:17','bearer','f0235c29960ad3def382555dbccd5a4453d57e9b',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','admin',NULL,NULL),('28efc7fb20918ce5326f99f88adbd0da3dc3dcc5','2023-01-14 18:27:49','bearer','05dbbd7a09d513fd664cb22536c4f73e408535a5',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('2c47e564fa767e23c2f6ef03137fe457b3c2c1be','2023-01-14 20:34:39','bearer','8acbad351b18c0e2d9cf4c4d555e0305867352c9',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('2d4f08a6bf8c95fe91bcd79f60faf1474d1e3935','2023-01-13 21:44:25','bearer','fbb28bd53d70333bd8c7139f45281625f4b3b484',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('2d64c8ea928e326275cf22dedb6960750f95614e','2023-01-15 10:29:12','bearer','826a0f1b3a8905e2bf2993922f6e54143c2e23eb',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('37ca48fece00564864af6679ba90ddfb8310d884','2023-01-14 21:26:21','bearer','6799e406fee76425eea95711b1a2b7d6d52ffa46',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','admin',NULL,NULL),('39190b5763cde049f01065f15851bb8d0668db46','2023-01-14 13:19:38','bearer','10ee328050d2983ea6ab72890ff2302f83ca9981',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('3e6762492ca64f8a6b115d6323859de7759ead1d','2023-01-15 18:55:08','bearer','e8df62d5b10a3894fc3fadbcdae88bd3dff416bf',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('411cff90f0c0d3e7bf0ed02c46e83d78adda8308','2023-01-15 19:40:21','bearer','edf65d49979e3822e8e5cb30641303e918c6d35b',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('42a84e5dbf7683efea22e73572f04534becbcd1b','2023-01-14 07:17:09','bearer','a78fe371e1e1c8998484c5b3f08cab880fbcde6d',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('447d2575696d252aa5ead06f42ec91bc79aa832e','2023-01-15 11:30:07','bearer','6d5e38e319d765352af9fced9541cb8463bc1eef',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('476b7715024f6d18c33d92c622d9b1dd996236c0','2023-01-13 23:32:01','bearer','67e1c20e312406195a0ac6308952e95e03504d00',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('4930b54e0c4fff5225e601878614e8b114027eaa','2023-01-15 12:43:04','bearer','4b1f828293afd8f2ea75614b98efb25aa99d5a93',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('4d8b0949a1c8f0c00dd73a2027e7d565f2d531ef','2023-01-14 23:02:36','bearer','efa66ca780a8fd57f140bf4820134c70647a7e7b',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('4dde5c3148f6371c95f500fd917eaeb997ddd6c3','2023-01-14 14:40:14','bearer','209862f5f0cc0b50987ebae066f0ffee631c1b39',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('4fee64fcfc35b76eda850c9cf8ce404e70aff25e','2023-01-13 21:52:15','bearer','bc7de16128602807b772c280de7c53e6352de7a5',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('63798272864394d31bfe71d695ea4979ec39e519','2023-01-14 21:45:18','bearer','1ee2edc7a6550ce4437ba6247cec5c1271429890',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('6514ed872afaa3dcb85aa611f83a4eb0d89119ce','2023-01-15 13:13:21','bearer','1136bcd84785faef581d965060cceda44545be2a',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('66e610672f1345c7813f44bfe529078d3543aaf4','2023-01-14 22:38:16','bearer','2560fe47688c3d9da43a43f4bc59805f183ac662',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('6906fb5b879b7c0b90aa034bbbe3b793daf1b451','2023-01-14 15:52:06','bearer','c3471d492ddebb6df4fe5c4fd1abed04e0b011a6',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('702bd8c627fb0c7448b1d920adb7050c2178f2e3','2023-01-14 09:24:29','bearer','5057573153e23bb71fd291fa3ab5fa525a29ad54',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('7272b79f8f6aea8d5e19187af829fd8e0e08089f','2023-01-13 21:29:49','bearer','c1c83c0784e368577d1812c437d56391838b9ddc',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('74833e90e03ecf02bd98f96ce70d11b67c0ee62e','2023-01-13 21:45:11','bearer','9efe3bf4e57402bfe2e298bf723e4b1a524c765a',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('757697490443afbbb4b9ca3783e15f562d2a0ba9','2023-01-15 18:10:43','bearer','256b2870d6b8597e45426faef6c02a6ed5fa9fcf',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('75c0e8ad3933ea88976ff218f3f005cb14eb5b93','2023-01-14 18:33:26','bearer','fe0a00b2dc9f920ff0e964a7fe9e9476bffcbc97',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('7c5fd3ff0d2c8a67fa26ebfa473ec6b0aee0679a','2023-01-15 19:21:53','bearer','c52e71df7d36094a53af8be67ce6c60da7e61654',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('7d004dd0aebc534b2d17e296a19a77bef798e928','2023-01-14 21:12:29','bearer','08fc9cbc1fd59c06f6dcd793492961abc1e3ceca',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('7e0c8943e9279f5904af5a4d60df640f5ff5693e','2023-01-14 14:24:16','bearer','38df165ff50f5d3df0f455ee8cab982f86070126',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('82c39239126e93d1c81399f75931b5c445274573','2023-01-15 01:00:19','bearer','a029a2814d4e412beece9211878be535386e7c7a',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','admin',NULL,NULL),('8b13bfcc830af76f77f26bdb183278478c86b888','2023-01-15 18:26:39','bearer','51b3eadeabbea3f2bbb00a840116e95754f609b8',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('8cafc8665b4b96228810999171ce07b12207ec3b','2023-01-15 18:05:10','bearer','8702f69ccce43c8128777c725dbc6caed241b62b',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('8cecbc01158a7784b55a6e2adb16fad02b48ee83','2023-01-13 21:30:03','bearer','45225c8cdcd35821437d00f6d975d48f23ff5559',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','admin',NULL,NULL),('95d19335c937cfe19032c659711afea6b22f2622','2023-01-13 21:30:04','bearer','0ccda1fbccabb02eb5a25792f074eaf650cb2b80',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','admin',NULL,NULL),('96abf8b1cfa0143250bbc346c72bfed6e42448e4','2023-01-15 13:06:15','bearer','012fd520d701b6f8b82fc7e6afe84f1f3da42de6',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('97d8504aa98656d070b339b701998b03df2bc222','2023-01-15 18:01:00','bearer','19d7962c78e19bc2f014ef2fd25844adddad5d4e',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('9aec0b65fbf49504e99af8ac9dbb481ed8f6abcb','2023-01-14 22:44:34','bearer','ed13f7cf1865c9f326616d712c0e83907533f241',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('9ce900b819b02dc2d8daf33992e12651947908e7','2023-01-14 17:53:34','bearer','d07d2e981b9c10f9101d9ca89cf7d3e4bc7a61db',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('9d653c0efa92ddb03c787bf9fb962571696c55b0','2023-01-14 22:34:41','bearer','feee22aa9010af3ee43da026387444e9b9991304',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('9eb3397fd4567a1ffe0a800bac7c533d301a8262','2023-01-14 17:48:54','bearer','3ec1fc83a255b49c38c14a2108af837ee176b90a',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('a2ebc453d51f3ee603b9bece3f01205dff9b36d7','2023-01-13 21:50:05','bearer','33c25235e71812a5791c2059c7330a11b873a842',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','8b1a00c7-107d-4521-aeea-4a5ca658d062',NULL,NULL),('a88817362dea2844a69b3142cdaba9c9159f1110','2023-01-15 18:27:21','bearer','49ef0fe7a8e90b4aff28703a8a47bd3e4f965b12',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('a90995685eb7355e1f6f15d7e6d9efde45f3f957','2023-01-15 18:13:56','bearer','07d281658ac72148add3bf11f3e6068195122d44',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('aa46a6f84199f89556597dc3f15025d72925b59e','2023-01-15 13:52:44','bearer','cd14f07554d63abac40e233425184fee5995c39e',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('ad7562fa9b276f7ff700e9bb5015addd105bbb6e','2023-01-13 22:27:48','bearer','a90e1a75e761488f8b656e0ada8146183e7d65ee',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','8b1a00c7-107d-4521-aeea-4a5ca658d062',NULL,NULL),('b4f3285db21a4de9cc5f45094ac52a05d2eba47d','2023-01-14 22:14:18','bearer','434b11d256297310c08c0bd2f8b6a03efd93f865',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','8b1a00c7-107d-4521-aeea-4a5ca658d062',NULL,NULL),('b615e4acce0fcb56f053577dcc7c3fb603a122b1','2023-01-14 22:20:23','bearer','acb7c2363cf13a8823410728c705be21bed8ae9b',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('b9b2890e8745dbf152855768c3a8f30d18d63832','2023-01-15 18:06:05','bearer','b9e10de854cf31ccc3bb0dd2f587b85d72a26309',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('bb45c1d24f265fffcbe38c3de0461f01d9903c81','2023-01-13 21:30:04','bearer','3cd07abb0b7e4713e4b72dbd52ca6aab3a661e38',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','admin',NULL,NULL),('bc270e51a6304ea6989b942e7c2d78ec81de82d8','2023-01-15 18:25:49','bearer','16f8fc77211cee37a58fe069a4fed39f1b2c59d4',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('c31b54dd97a2ec3b79d1f6f41adeef1e4c68900c','2023-01-14 22:31:42','bearer','73e6a7d07e3e8552ab32d47d904e1c5a3b9a5316',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('c9e83c044f8a40ec4be0497c09ff1d7f90db925c','2023-01-13 21:58:54','bearer','9e11ca822696a30b28ade57ed90ce015919105d3',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','8b1a00c7-107d-4521-aeea-4a5ca658d062',NULL,NULL),('cdd930105ec9530288ec9cf3534bd4308ab6e78f','2023-01-15 18:25:43','bearer','2e1ff81213164d5ca7aa3fd43101b21e253179ed',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('d7dad8fe194b66324bea81b5ab9252fef491fd03','2023-01-13 21:51:55','bearer','ad9e6c8a0f583217ae6a5176ea449836d4be860f',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','admin',NULL,NULL),('dd201280d079cae21e51bdf142a21e259d3fe991','2023-01-15 19:23:59','bearer','7e919c79f18036856186e07423cd71144c7c062c',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('dd291ece9c6706ec416a996039f8cb4ea0359469','2023-01-14 19:45:18','bearer','c9baf095bf93cc3eb34b0f7ebe3eeca07ab8a0cd',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('dda3a337033c7528e970943fae27f68b78d2a44e','2023-01-14 22:23:18','bearer','6932d6236d783e8d608e02b6bef10249d1a6488a',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('ded442e25121b08824f8ad4c16f56a705649d75a','2023-01-13 23:03:18','bearer','ee8fb6536598dd6b0295f0654947b3f836130322',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('e1ae0924f4a3e7c09063d369a683fef9cde6b417','2023-01-13 23:07:36','bearer','dddfb904b85fecc6b1e324690979866cca79237d',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('e5368c3368135d4bc8e786f029df5af01948a24b','2023-01-13 21:30:04','bearer','9662b1afd0261df63838703dcb0ae88eb8a94de0',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','admin',NULL,NULL),('e7ae09051aa3de18346fcc34c70a3123238803b2','2023-01-14 22:23:29','bearer','8577fd79d95406fd1dd0b7fcc4208e32539afc32',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('e8afd8f9e174fa47bd4e5c85927424b3cf1395f6','2023-01-13 21:30:00','bearer','ce2040aaa97417a4d08b7896b675ac69c21ec817',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('e8f221747e812501a374ade9aeefdec5e797bef8','2023-01-13 22:27:41','bearer','8a4a30d2a4ee26588245880855e2558c4e816499',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL),('ed23c8797409296783dc572ab7bde31593319ec0','2023-01-15 18:05:18','bearer','6ef146e67a898b484b9872863ec15ddde7e219a7',1,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL);
/*!40000 ALTER TABLE `oauth_access_token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_authorization_code`
--

DROP TABLE IF EXISTS `oauth_authorization_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_authorization_code` (
  `authorization_code` varchar(256) NOT NULL,
  `expires` datetime DEFAULT NULL,
  `redirect_uri` varchar(2000) DEFAULT NULL,
  `scope` varchar(2000) DEFAULT NULL,
  `valid` tinyint(1) DEFAULT NULL,
  `extra` json DEFAULT NULL,
  `oauth_client_id` varchar(36) DEFAULT NULL,
  `user_id` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`authorization_code`),
  UNIQUE KEY `authorization_code` (`authorization_code`),
  KEY `oauth_client_id` (`oauth_client_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `oauth_authorization_code_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE,
  CONSTRAINT `oauth_authorization_code_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_authorization_code`
--

LOCK TABLES `oauth_authorization_code` WRITE;
/*!40000 ALTER TABLE `oauth_authorization_code` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_authorization_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_client`
--

DROP TABLE IF EXISTS `oauth_client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_client` (
  `id` varchar(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `secret` char(36) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `url` varchar(2000) DEFAULT NULL,
  `redirect_uri` varchar(2000) DEFAULT NULL,
  `image` varchar(255) DEFAULT 'default',
  `grant_type` varchar(255) DEFAULT NULL,
  `response_type` varchar(255) DEFAULT NULL,
  `client_type` varchar(15) DEFAULT NULL,
  `scope` varchar(2000) DEFAULT NULL,
  `extra` json DEFAULT NULL,
  `token_types` varchar(2000) DEFAULT NULL,
  `jwt_secret` varchar(255) DEFAULT NULL,
  `redirect_sign_out_uri` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_client`
--

LOCK TABLES `oauth_client` WRITE;
/*!40000 ALTER TABLE `oauth_client` DISABLE KEYS */;
INSERT INTO `oauth_client` VALUES ('dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','estore','This is a shopping app designed at Tuc','82349928-066d-4e81-98b1-c94d7a7297c0','http://estore/assets/index.php','http://estore/assets/scripts/php/main/welcome.php','default','authorization_code,implicit,password,client_credentials,refresh_token','code,token',NULL,NULL,NULL,NULL,NULL,'http://estore/assets/scripts/php/helper_scripts/logout.php'),('idm_admin_app','idm','idm',NULL,'','','default','','',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `oauth_client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_refresh_token`
--

DROP TABLE IF EXISTS `oauth_refresh_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_refresh_token` (
  `refresh_token` varchar(256) NOT NULL,
  `expires` datetime DEFAULT NULL,
  `scope` varchar(2000) DEFAULT NULL,
  `oauth_client_id` varchar(36) DEFAULT NULL,
  `user_id` varchar(36) DEFAULT NULL,
  `iot_id` varchar(255) DEFAULT NULL,
  `authorization_code` varchar(255) DEFAULT NULL,
  `valid` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`refresh_token`),
  UNIQUE KEY `refresh_token` (`refresh_token`),
  KEY `oauth_client_id` (`oauth_client_id`),
  KEY `user_id` (`user_id`),
  KEY `iot_id` (`iot_id`),
  KEY `authorization_code_rt` (`authorization_code`),
  CONSTRAINT `authorization_code_rt` FOREIGN KEY (`authorization_code`) REFERENCES `oauth_authorization_code` (`authorization_code`) ON DELETE CASCADE,
  CONSTRAINT `oauth_refresh_token_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE,
  CONSTRAINT `oauth_refresh_token_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `oauth_refresh_token_ibfk_3` FOREIGN KEY (`iot_id`) REFERENCES `iot` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_refresh_token`
--

LOCK TABLES `oauth_refresh_token` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_token` DISABLE KEYS */;
INSERT INTO `oauth_refresh_token` VALUES ('012fd520d701b6f8b82fc7e6afe84f1f3da42de6','2023-01-29 12:06:15','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('05dbbd7a09d513fd664cb22536c4f73e408535a5','2023-01-28 17:27:49','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('07d281658ac72148add3bf11f3e6068195122d44','2023-01-29 17:13:56','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('08fc9cbc1fd59c06f6dcd793492961abc1e3ceca','2023-01-28 20:12:29','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('0ccda1fbccabb02eb5a25792f074eaf650cb2b80','2023-01-27 20:30:04','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','admin',NULL,NULL,1),('10ee328050d2983ea6ab72890ff2302f83ca9981','2023-01-28 12:19:38','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('1136bcd84785faef581d965060cceda44545be2a','2023-01-29 12:13:21','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('16f8fc77211cee37a58fe069a4fed39f1b2c59d4','2023-01-29 17:25:49','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('19d7962c78e19bc2f014ef2fd25844adddad5d4e','2023-01-29 17:01:00','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('1ee2edc7a6550ce4437ba6247cec5c1271429890','2023-01-28 20:45:18','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('209862f5f0cc0b50987ebae066f0ffee631c1b39','2023-01-28 13:40:14','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('2560fe47688c3d9da43a43f4bc59805f183ac662','2023-01-28 21:38:16','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('256b2870d6b8597e45426faef6c02a6ed5fa9fcf','2023-01-29 17:10:43','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('2e1ff81213164d5ca7aa3fd43101b21e253179ed','2023-01-29 17:25:43','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('33c25235e71812a5791c2059c7330a11b873a842','2023-01-27 20:50:05','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','8b1a00c7-107d-4521-aeea-4a5ca658d062',NULL,NULL,1),('38df165ff50f5d3df0f455ee8cab982f86070126','2023-01-28 13:24:16','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('3cd07abb0b7e4713e4b72dbd52ca6aab3a661e38','2023-01-27 20:30:04','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','admin',NULL,NULL,1),('3ec1fc83a255b49c38c14a2108af837ee176b90a','2023-01-28 16:48:54','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('434b11d256297310c08c0bd2f8b6a03efd93f865','2023-01-28 21:14:18','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','8b1a00c7-107d-4521-aeea-4a5ca658d062',NULL,NULL,1),('44cfed00d787218f75117d4bbaa25082b646ec4a','2023-01-27 20:30:04','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','admin',NULL,NULL,1),('45225c8cdcd35821437d00f6d975d48f23ff5559','2023-01-27 20:30:03','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','admin',NULL,NULL,1),('49ef0fe7a8e90b4aff28703a8a47bd3e4f965b12','2023-01-29 17:27:21','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('4b1f828293afd8f2ea75614b98efb25aa99d5a93','2023-01-29 11:43:04','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('4d0e10eb9bdd1e16348bc0dcee740fa00adfc146','2023-01-29 17:19:07','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('4e71666808072ba9e051dc9e170180ff6f52827a','2023-01-27 23:27:54','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('5057573153e23bb71fd291fa3ab5fa525a29ad54','2023-01-28 08:24:29','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('51b3eadeabbea3f2bbb00a840116e95754f609b8','2023-01-29 17:26:39','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('6799e406fee76425eea95711b1a2b7d6d52ffa46','2023-01-28 20:26:21','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','admin',NULL,NULL,1),('67e1c20e312406195a0ac6308952e95e03504d00','2023-01-27 22:32:01','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('6932d6236d783e8d608e02b6bef10249d1a6488a','2023-01-28 21:23:18','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('6d5e38e319d765352af9fced9541cb8463bc1eef','2023-01-29 10:30:07','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('6ef146e67a898b484b9872863ec15ddde7e219a7','2023-01-29 17:05:18','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('73e6a7d07e3e8552ab32d47d904e1c5a3b9a5316','2023-01-28 21:31:42','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('7e919c79f18036856186e07423cd71144c7c062c','2023-01-29 18:23:59','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('826a0f1b3a8905e2bf2993922f6e54143c2e23eb','2023-01-29 09:29:12','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('8577fd79d95406fd1dd0b7fcc4208e32539afc32','2023-01-28 21:23:29','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('8702f69ccce43c8128777c725dbc6caed241b62b','2023-01-29 17:05:10','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('8a4a30d2a4ee26588245880855e2558c4e816499','2023-01-27 21:27:41','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('8acbad351b18c0e2d9cf4c4d555e0305867352c9','2023-01-28 19:34:39','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('9662b1afd0261df63838703dcb0ae88eb8a94de0','2023-01-27 20:30:04','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','admin',NULL,NULL,1),('9e11ca822696a30b28ade57ed90ce015919105d3','2023-01-27 20:58:54','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','8b1a00c7-107d-4521-aeea-4a5ca658d062',NULL,NULL,1),('9efe3bf4e57402bfe2e298bf723e4b1a524c765a','2023-01-27 20:45:11','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('a029a2814d4e412beece9211878be535386e7c7a','2023-01-29 00:00:19','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','admin',NULL,NULL,1),('a78fe371e1e1c8998484c5b3f08cab880fbcde6d','2023-01-28 06:17:09','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('a90e1a75e761488f8b656e0ada8146183e7d65ee','2023-01-27 21:27:48','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','8b1a00c7-107d-4521-aeea-4a5ca658d062',NULL,NULL,1),('ab020f564ef31b0e0ca46511958bb1d49f369cab','2023-01-29 17:09:12','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','8b1a00c7-107d-4521-aeea-4a5ca658d062',NULL,NULL,1),('acb7c2363cf13a8823410728c705be21bed8ae9b','2023-01-28 21:20:23','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('ad9e6c8a0f583217ae6a5176ea449836d4be860f','2023-01-27 20:51:55','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','admin',NULL,NULL,1),('b0e452e6df6816203a82a3b4ef2473ca636096cc','2023-01-28 21:35:56','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('b9e10de854cf31ccc3bb0dd2f587b85d72a26309','2023-01-29 17:06:05','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('bc7de16128602807b772c280de7c53e6352de7a5','2023-01-27 20:52:15','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('c1c83c0784e368577d1812c437d56391838b9ddc','2023-01-27 20:29:49','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('c3471d492ddebb6df4fe5c4fd1abed04e0b011a6','2023-01-28 14:52:06','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('c52e71df7d36094a53af8be67ce6c60da7e61654','2023-01-29 18:21:53','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('c9baf095bf93cc3eb34b0f7ebe3eeca07ab8a0cd','2023-01-28 18:45:18','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('cd14f07554d63abac40e233425184fee5995c39e','2023-01-29 12:52:44','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('ce2040aaa97417a4d08b7896b675ac69c21ec817','2023-01-27 20:30:00','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('d07d2e981b9c10f9101d9ca89cf7d3e4bc7a61db','2023-01-28 16:53:34','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('d62f5af3720915e92cc9443a045102db0a0fb01f','2023-01-28 07:21:59','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('d8cc50f19759bec8272421ff1bafdbec1920f1c3','2023-01-28 21:42:15','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('dddfb904b85fecc6b1e324690979866cca79237d','2023-01-27 22:07:36','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('e8df62d5b10a3894fc3fadbcdae88bd3dff416bf','2023-01-29 17:55:08','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('ed13f7cf1865c9f326616d712c0e83907533f241','2023-01-28 21:44:34','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('edf65d49979e3822e8e5cb30641303e918c6d35b','2023-01-29 18:40:21','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('ee8fb6536598dd6b0295f0654947b3f836130322','2023-01-27 22:03:18','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('efa66ca780a8fd57f140bf4820134c70647a7e7b','2023-01-28 22:02:36','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('f0235c29960ad3def382555dbccd5a4453d57e9b','2023-01-27 20:30:17','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','admin',NULL,NULL,1),('fbb28bd53d70333bd8c7139f45281625f4b3b484','2023-01-27 20:44:25','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('fe0a00b2dc9f920ff0e964a7fe9e9476bffcbc97','2023-01-28 17:33:26','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('fe1c4d66a060b65bf3da39204c33b97ed00564c4','2023-01-28 21:48:09','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1),('feee22aa9010af3ee43da026387444e9b9991304','2023-01-28 21:34:41','bearer','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','74973906-471e-4d11-85ca-f0a859777c4b',NULL,NULL,1);
/*!40000 ALTER TABLE `oauth_refresh_token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_scope`
--

DROP TABLE IF EXISTS `oauth_scope`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_scope` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scope` varchar(255) DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_scope`
--

LOCK TABLES `oauth_scope` WRITE;
/*!40000 ALTER TABLE `oauth_scope` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_scope` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organization`
--

DROP TABLE IF EXISTS `organization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `organization` (
  `id` varchar(36) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `description` text,
  `website` varchar(2000) DEFAULT NULL,
  `image` varchar(255) DEFAULT 'default',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organization`
--

LOCK TABLES `organization` WRITE;
/*!40000 ALTER TABLE `organization` DISABLE KEYS */;
INSERT INTO `organization` VALUES ('71724de7-e4da-441b-85e3-f116450f319d','estoreUsers','This organization keeps as owners the Admins who have requested access to the app and as members the users.',NULL,'default'),('77d79aa8-7b3e-4938-9680-0a5ae06cd59f','estoreSellers','This organization keeps as owners the Admins who have requested access to the app and as members the Sellers',NULL,'default');
/*!40000 ALTER TABLE `organization` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pep_proxy`
--

DROP TABLE IF EXISTS `pep_proxy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pep_proxy` (
  `id` varchar(255) NOT NULL,
  `password` varchar(40) DEFAULT NULL,
  `oauth_client_id` varchar(36) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_client_id` (`oauth_client_id`),
  CONSTRAINT `pep_proxy_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pep_proxy`
--

LOCK TABLES `pep_proxy` WRITE;
/*!40000 ALTER TABLE `pep_proxy` DISABLE KEYS */;
INSERT INTO `pep_proxy` VALUES ('pep_proxy_e580b05c-e416-4964-902c-4800f7b6e8b1','c0e2dd3c97e6ea3f6a7d5aeafb3df3caa41c85a3','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','bdb4ffdc0b1a4bf5');
/*!40000 ALTER TABLE `pep_proxy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission`
--

DROP TABLE IF EXISTS `permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission` (
  `id` varchar(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `is_internal` tinyint(1) DEFAULT '0',
  `action` varchar(255) DEFAULT NULL,
  `resource` varchar(255) DEFAULT NULL,
  `xml` text,
  `oauth_client_id` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `oauth_client_id` (`oauth_client_id`),
  CONSTRAINT `permission_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission`
--

LOCK TABLES `permission` WRITE;
/*!40000 ALTER TABLE `permission` DISABLE KEYS */;
INSERT INTO `permission` VALUES ('1','Get and assign all internal application roles',NULL,1,NULL,NULL,NULL,'idm_admin_app'),('2','Manage the application',NULL,1,NULL,NULL,NULL,'idm_admin_app'),('3','Manage roles',NULL,1,NULL,NULL,NULL,'idm_admin_app'),('4','Manage authorizations',NULL,1,NULL,NULL,NULL,'idm_admin_app'),('5','Get and assign all public application roles',NULL,1,NULL,NULL,NULL,'idm_admin_app'),('6','Get and assign only public owned roles',NULL,1,NULL,NULL,NULL,'idm_admin_app'),('645ca3e2-3151-4e2b-b95f-b0f5dfa61d19','Access App for Shopping','Permission to Access the products displayed',0,'http://estore/assets/scripts/php/main/products.php','\\products',NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c'),('96d83864-46dd-4b55-a386-0c38e86fc9de','CRUD operations on products','Permission to perform Add Remove and Edit operations on products',0,'http://estore/assets/scripts/php/main/seller.php','\\products',NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c'),('e10f047e-ff1d-401a-8ae7-94561fa12031','CRUD operations on user','Permission to Add Remove and Edit users',0,'http://estore/assets/scripts/php/main/administration.php','\\users',NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c');
/*!40000 ALTER TABLE `permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` varchar(36) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `is_internal` tinyint(1) DEFAULT '0',
  `oauth_client_id` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `oauth_client_id` (`oauth_client_id`),
  CONSTRAINT `role_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES ('641e26e5-0063-44ff-991a-47bc50f4f377','Seller',0,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c'),('ce55c887-6ce9-422a-bb55-27c3ab38456f','User',0,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c'),('d8404574-8bbd-4096-916f-9a2f4ab0583a','Admin',0,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c'),('provider','Provider',1,'idm_admin_app'),('purchaser','Purchaser',1,'idm_admin_app');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_assignment`
--

DROP TABLE IF EXISTS `role_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_assignment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_organization` varchar(255) DEFAULT NULL,
  `oauth_client_id` varchar(36) DEFAULT NULL,
  `role_id` varchar(36) DEFAULT NULL,
  `organization_id` varchar(36) DEFAULT NULL,
  `user_id` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_client_id` (`oauth_client_id`),
  KEY `role_id` (`role_id`),
  KEY `organization_id` (`organization_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `role_assignment_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_assignment_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_assignment_ibfk_3` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_assignment_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_assignment`
--

LOCK TABLES `role_assignment` WRITE;
/*!40000 ALTER TABLE `role_assignment` DISABLE KEYS */;
INSERT INTO `role_assignment` VALUES (2,'owner','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','d8404574-8bbd-4096-916f-9a2f4ab0583a','71724de7-e4da-441b-85e3-f116450f319d',NULL),(3,'member','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','ce55c887-6ce9-422a-bb55-27c3ab38456f','71724de7-e4da-441b-85e3-f116450f319d',NULL),(4,'owner','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','d8404574-8bbd-4096-916f-9a2f4ab0583a','77d79aa8-7b3e-4938-9680-0a5ae06cd59f',NULL),(5,'member','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','641e26e5-0063-44ff-991a-47bc50f4f377','77d79aa8-7b3e-4938-9680-0a5ae06cd59f',NULL),(69,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','provider',NULL,'admin'),(70,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','d8404574-8bbd-4096-916f-9a2f4ab0583a',NULL,'74973906-471e-4d11-85ca-f0a859777c4b'),(71,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','d8404574-8bbd-4096-916f-9a2f4ab0583a',NULL,'admin'),(72,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','641e26e5-0063-44ff-991a-47bc50f4f377',NULL,'8b1a00c7-107d-4521-aeea-4a5ca658d062'),(73,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','641e26e5-0063-44ff-991a-47bc50f4f377',NULL,'d3030ee3-6c8b-440d-8ad7-b010012025b0'),(74,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','641e26e5-0063-44ff-991a-47bc50f4f377',NULL,'b2a0ed5a-df6a-49c0-9341-0c968e1e2308'),(75,NULL,'dc7c8057-6cc5-40f9-92b9-ec7ef20e284c','ce55c887-6ce9-422a-bb55-27c3ab38456f',NULL,'66721bc2-bb01-42f1-96f8-25c737de5ed1');
/*!40000 ALTER TABLE `role_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_permission`
--

DROP TABLE IF EXISTS `role_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` varchar(36) DEFAULT NULL,
  `permission_id` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `permission_id` (`permission_id`),
  CONSTRAINT `role_permission_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_permission_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_permission`
--

LOCK TABLES `role_permission` WRITE;
/*!40000 ALTER TABLE `role_permission` DISABLE KEYS */;
INSERT INTO `role_permission` VALUES (1,'provider','1'),(2,'provider','2'),(3,'provider','3'),(4,'provider','4'),(5,'provider','5'),(6,'provider','6'),(7,'purchaser','5');
/*!40000 ALTER TABLE `role_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trusted_application`
--

DROP TABLE IF EXISTS `trusted_application`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trusted_application` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oauth_client_id` varchar(36) DEFAULT NULL,
  `trusted_oauth_client_id` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_client_id` (`oauth_client_id`),
  KEY `trusted_oauth_client_id` (`trusted_oauth_client_id`),
  CONSTRAINT `trusted_application_ibfk_1` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE,
  CONSTRAINT `trusted_application_ibfk_2` FOREIGN KEY (`trusted_oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trusted_application`
--

LOCK TABLES `trusted_application` WRITE;
/*!40000 ALTER TABLE `trusted_application` DISABLE KEYS */;
/*!40000 ALTER TABLE `trusted_application` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` varchar(36) NOT NULL,
  `username` varchar(64) DEFAULT NULL,
  `description` text,
  `website` varchar(2000) DEFAULT NULL,
  `image` varchar(255) DEFAULT 'default',
  `gravatar` tinyint(1) DEFAULT '0',
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `date_password` datetime DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT '0',
  `admin` tinyint(1) DEFAULT '0',
  `extra` json DEFAULT NULL,
  `scope` varchar(2000) DEFAULT NULL,
  `starters_tour_ended` tinyint(1) DEFAULT '0',
  `eidas_id` varchar(255) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('66721bc2-bb01-42f1-96f8-25c737de5ed1','alextsip','Empty','Empty','default',0,'alextsipou@gmail.com','66a90e3560867aef91ef382200e11c7614e66419','2023-01-13 22:31:57',1,0,NULL,NULL,0,NULL,'2c9462676b267835'),('74973906-471e-4d11-85ca-f0a859777c4b','psklavos1','This is a Test','http://estore/assets','default',0,'psklavos1@tuc.gr','e930897e955f238767cf500e5255f9462fb4fc10','2023-01-13 20:23:16',1,0,NULL,NULL,0,NULL,'11b17c5608f20f24'),('8b1a00c7-107d-4521-aeea-4a5ca658d062','gskoul','Empty','Empty','default',0,'gskoul@gmail.com','56532b50e58789ca826164e7255ed81324d952fa','2023-01-13 20:35:19',1,0,NULL,NULL,0,NULL,'15337eb060e36ee5'),('admin','admin',NULL,NULL,'default',0,'admin@test.com','44c4e18e3e839a9f4e27872e99704524a31439b1','2023-01-13 20:08:18',1,1,NULL,NULL,0,NULL,'b149cb0934cd251e'),('b2a0ed5a-df6a-49c0-9341-0c968e1e2308','ariaKaz','Empty','Empty','default',0,'ariakaz@gmail.com','5790c15c9032030cfb12a6277602da8993504654','2023-01-15 12:06:08',1,0,NULL,NULL,0,NULL,'f96c47edaffc0f23'),('d3030ee3-6c8b-440d-8ad7-b010012025b0','leobako','Empty','Empty','default',0,'leobako@gmail.com','3ef78ebb80a54b85836c53262a65249a6ea6ecd2','2023-01-13 22:31:34',1,0,NULL,NULL,0,NULL,'58af98a487f6ee55');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_authorized_application`
--

DROP TABLE IF EXISTS `user_authorized_application`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_authorized_application` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(36) DEFAULT NULL,
  `oauth_client_id` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `oauth_client_id` (`oauth_client_id`),
  CONSTRAINT `user_authorized_application_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_authorized_application_ibfk_2` FOREIGN KEY (`oauth_client_id`) REFERENCES `oauth_client` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_authorized_application`
--

LOCK TABLES `user_authorized_application` WRITE;
/*!40000 ALTER TABLE `user_authorized_application` DISABLE KEYS */;
INSERT INTO `user_authorized_application` VALUES (1,'74973906-471e-4d11-85ca-f0a859777c4b','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c'),(2,'admin','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c'),(3,'8b1a00c7-107d-4521-aeea-4a5ca658d062','dc7c8057-6cc5-40f9-92b9-ec7ef20e284c');
/*!40000 ALTER TABLE `user_authorized_application` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_organization`
--

DROP TABLE IF EXISTS `user_organization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_organization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(10) DEFAULT NULL,
  `user_id` varchar(36) DEFAULT NULL,
  `organization_id` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `organization_id` (`organization_id`),
  CONSTRAINT `user_organization_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_organization_ibfk_2` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_organization`
--

LOCK TABLES `user_organization` WRITE;
/*!40000 ALTER TABLE `user_organization` DISABLE KEYS */;
INSERT INTO `user_organization` VALUES (24,'owner','admin','77d79aa8-7b3e-4938-9680-0a5ae06cd59f'),(25,'owner','admin','71724de7-e4da-441b-85e3-f116450f319d');
/*!40000 ALTER TABLE `user_organization` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_registration_profile`
--

DROP TABLE IF EXISTS `user_registration_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_registration_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activation_key` varchar(255) DEFAULT NULL,
  `activation_expires` datetime DEFAULT NULL,
  `reset_key` varchar(255) DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `verification_key` varchar(255) DEFAULT NULL,
  `verification_expires` datetime DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_email` (`user_email`),
  CONSTRAINT `user_registration_profile_ibfk_1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_registration_profile`
--

LOCK TABLES `user_registration_profile` WRITE;
/*!40000 ALTER TABLE `user_registration_profile` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_registration_profile` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-15 18:55:53
