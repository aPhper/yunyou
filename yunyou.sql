/*
Navicat MySQL Data Transfer

Source Server         : 192.168.1.100
Source Server Version : 50173
Source Host           : 192.168.1.100:3306
Source Database       : yunyou

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2015-06-15 19:05:32
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cloud
-- ----------------------------
DROP TABLE IF EXISTS `cloud`;
CREATE TABLE `cloud` (
  `col_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `col_name` char(64) DEFAULT NULL COMMENT '云平台名称',
  `col_ip` char(50) DEFAULT NULL COMMENT '云平台ip地址',
  `col_port` char(50) DEFAULT NULL COMMENT '云平台端口',
  `col_url` varchar(1024) DEFAULT NULL COMMENT '云平台地址',
  `col_apikey` varchar(1024) DEFAULT NULL COMMENT '云平台API密钥1',
  `col_seckey` varchar(1024) DEFAULT NULL COMMENT '云平台API密钥2',
  `col_desc` text COMMENT '云平台描述',
  `col_contactname` char(50) DEFAULT NULL COMMENT '联系人姓名',
  `col_contactcall` char(50) DEFAULT NULL COMMENT '联系人电话',
  `col_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`col_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='云平台描述';

-- ----------------------------
-- Records of cloud
-- ----------------------------
INSERT INTO `cloud` VALUES ('1', '本地云平台', '192.168.1.130', '8080', 'http://192.168.1.130:8080/client/api?', 'El9vyS5iI3gScEJaQAJgBO8K3qhVwAj-XZw0N8XOhLZyFdobCuS7uZsqQu8Tp9YnvNUZwnnJZUgagSSuws8pwQ', '3uEChqcshL0tkbo-2kUCsRptNf2gFWdN7ZdvQkxCTlEKVyuy_8qu6BLx50nWjTKsSQcNUr83MzCDnkom9WSBOw', '本地私有云平台', 'gaoxu', '18789457120', '2015-06-03 12:03:11', '0');
INSERT INTO `cloud` VALUES ('2', '测试云平台', '192.168.1.130', '8080', 'http://192.168.1.130:8080/client/api?', 'El9vyS5iI3gScEJaQAJgBO8K3qhVwAj-XZw0N8XOhLZyFdobCuS7uZsqQu8Tp9YnvNUZwnnJZUgagSSuws8pwQ', '3uEChqcshL0tkbo-2kUCsRptNf2gFWdN7ZdvQkxCTlEKVyuy_8qu6BLx50nWjTKsSQcNUr83MzCDnkom9WSBOw', '测试私有平台', '段伟', '18000000000', '2015-06-13 00:20:21', '0');

-- ----------------------------
-- Table structure for cloud_diskoffering
-- ----------------------------
DROP TABLE IF EXISTS `cloud_diskoffering`;
CREATE TABLE `cloud_diskoffering` (
  `col_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `col_diskoffering_id` char(64) DEFAULT NULL,
  `col_cloud_id` int(11) unsigned DEFAULT NULL,
  `col_name` char(50) DEFAULT NULL,
  `col_size` decimal(10,2) DEFAULT NULL,
  `col_storagetype` enum('local','shared') DEFAULT NULL,
  PRIMARY KEY (`col_id`),
  KEY `FK_cloud_diskoffering_cloud` (`col_cloud_id`),
  CONSTRAINT `FK_cloud_diskoffering_cloud` FOREIGN KEY (`col_cloud_id`) REFERENCES `cloud` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='磁盘规格';

-- ----------------------------
-- Records of cloud_diskoffering
-- ----------------------------
INSERT INTO `cloud_diskoffering` VALUES ('1', '8d67dea9-293c-4f91-86d2-38c2d84b6deb', '1', 'Small', '5.00', 'shared');
INSERT INTO `cloud_diskoffering` VALUES ('2', '8c42381b-ae2c-4355-ab98-a0e08db8e3ee', '1', 'Medium', '20.00', 'shared');
INSERT INTO `cloud_diskoffering` VALUES ('3', '899015cd-925d-4d3c-8e47-6a1446a45f75', '1', 'Large', '100.00', 'shared');
INSERT INTO `cloud_diskoffering` VALUES ('4', 'd11e234f-34ff-4826-bd39-57e78adcffb8', '1', 'Custom', '0.00', 'shared');
INSERT INTO `cloud_diskoffering` VALUES ('6', '073D3F56-F2E8-9F9A-C086-4B768593F478', '2', '测试磁盘', '30.00', 'shared');

-- ----------------------------
-- Table structure for cloud_gateway
-- ----------------------------
DROP TABLE IF EXISTS `cloud_gateway`;
CREATE TABLE `cloud_gateway` (
  `col_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `col_zone_id` int(11) unsigned NOT NULL DEFAULT '0',
  `col_ip` varchar(50) DEFAULT '0',
  `col_port` int(11) DEFAULT '0',
  `col_url` varchar(1024) DEFAULT '0',
  `col_user` char(50) DEFAULT '0',
  `col_passwd` char(50) DEFAULT '0',
  `col_cert` varchar(1024) DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`col_id`),
  KEY `FK_cloud_gateway_cloud_zone` (`col_zone_id`),
  CONSTRAINT `FK_cloud_gateway_cloud_zone` FOREIGN KEY (`col_zone_id`) REFERENCES `cloud_zone` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='网关描述表';

-- ----------------------------
-- Records of cloud_gateway
-- ----------------------------
INSERT INTO `cloud_gateway` VALUES ('1', '1', 'http://192.168.1.100', '8080', 'guacamole/#/client/c', 'guacadmmin', 'guacadmin', '0', '0');

-- ----------------------------
-- Table structure for cloud_job
-- ----------------------------
DROP TABLE IF EXISTS `cloud_job`;
CREATE TABLE `cloud_job` (
  `col_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `col_job_id` char(64) DEFAULT NULL,
  `col_cloud_id` int(11) unsigned DEFAULT NULL,
  `col_res_type` char(50) DEFAULT NULL,
  `col_res_id` int(11) DEFAULT NULL,
  `col_job_status` char(50) DEFAULT NULL,
  `col_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`col_id`),
  KEY `FK_cloud_job_cloud` (`col_cloud_id`),
  CONSTRAINT `FK_cloud_job_cloud` FOREIGN KEY (`col_cloud_id`) REFERENCES `cloud` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=220 DEFAULT CHARSET=utf8 COMMENT='云平台异步job状态';

-- ----------------------------
-- Records of cloud_job
-- ----------------------------
INSERT INTO `cloud_job` VALUES ('70', 'a9a408c8-0498-422b-bc84-07826262c3b8', '1', 'vm', '112', null, '2015-04-25 00:54:56');
INSERT INTO `cloud_job` VALUES ('71', null, '1', 'vm', '6100385', null, '2015-04-25 20:05:12');
INSERT INTO `cloud_job` VALUES ('72', '4f2c5688-15df-4a7e-a078-e023b9e13cba', '1', 'vm', '6100385', null, '2015-04-25 20:05:30');
INSERT INTO `cloud_job` VALUES ('73', '75b7b42f-2918-41ff-9a5c-ba83e26bd187', '1', 'vm', '6100385', null, '2015-04-25 20:06:10');
INSERT INTO `cloud_job` VALUES ('74', '33965403-7fc8-420b-9b09-f2cc9867425c', '1', 'vm', '6100385', null, '2015-04-25 20:09:32');
INSERT INTO `cloud_job` VALUES ('75', '7627db7c-032d-4c40-85b5-93bc38389501', '1', 'vm', '6100385', null, '2015-04-25 20:28:24');
INSERT INTO `cloud_job` VALUES ('76', '7c80518b-72e0-4a34-91fc-cbc588ad8187', '1', 'vm', '6100385', null, '2015-04-25 20:30:17');
INSERT INTO `cloud_job` VALUES ('77', '77f939c7-e632-46a8-b437-c639a0f0bd7e', '1', 'vm', '6100385', null, '2015-04-25 21:06:27');
INSERT INTO `cloud_job` VALUES ('78', '7693fa43-2d77-4e32-a11e-95c6547a4e3c', '1', 'vm', '6100385', null, '2015-04-25 21:06:55');
INSERT INTO `cloud_job` VALUES ('79', 'ea6222b7-92e6-4d5c-b274-0050465fac35', '1', 'vm', '113', null, '2015-04-28 23:40:15');
INSERT INTO `cloud_job` VALUES ('80', '3f5be497-f20b-47fa-9983-b8a4960eec17', '1', 'vm', '114', null, '2015-04-28 23:41:21');
INSERT INTO `cloud_job` VALUES ('81', '524a0009-7f43-45e1-90b7-d8f7651965ad', '1', 'vm', '115', null, '2015-04-29 01:46:20');
INSERT INTO `cloud_job` VALUES ('82', 'dff38c47-2623-4a48-9dc7-a6dd9f6f883b', '1', 'vm', '87', null, '2015-05-04 19:24:42');
INSERT INTO `cloud_job` VALUES ('83', 'dfe81cc3-64af-4754-bece-09507fa3aad5', '1', 'vm', '88', null, '2015-05-05 01:13:12');
INSERT INTO `cloud_job` VALUES ('84', '3289bfc4-da6a-4d36-bcf8-82151e9a4fb3', '1', 'vm', '89', null, '2015-05-05 01:14:31');
INSERT INTO `cloud_job` VALUES ('85', '5816f693-dcf1-4e47-ab4e-1b8e1f2d3ae4', '1', 'vm', '90', null, '2015-05-05 01:18:42');
INSERT INTO `cloud_job` VALUES ('86', 'a4e09521-2c92-4b0e-a320-88dad7655ba2', '1', 'vm', '91', null, '2015-05-05 01:38:18');
INSERT INTO `cloud_job` VALUES ('87', '3aa38c76-bfee-4d2f-aa18-a55c03e9dd52', '1', 'vm', '92', null, '2015-05-05 18:44:46');
INSERT INTO `cloud_job` VALUES ('88', 'e73e6e00-3183-4edd-af05-997be0bdcdbe', '1', 'vm', '93', null, '2015-05-05 19:09:03');
INSERT INTO `cloud_job` VALUES ('89', '83f43da5-c17a-461c-a79a-249fb111ca8d', '1', 'vm', '94', null, '2015-05-06 23:22:01');
INSERT INTO `cloud_job` VALUES ('90', 'aa56d3a4-ee2f-4683-a7a2-a598d13134cf', '1', 'vm', '95', null, '2015-05-07 01:45:09');
INSERT INTO `cloud_job` VALUES ('91', 'f4a9775b-21ab-43bf-a98b-d203a2ab790d', '1', 'vm', '96', null, '2015-05-07 01:50:51');
INSERT INTO `cloud_job` VALUES ('92', '1c742340-bf20-41c4-91fa-2fb2df422275', '1', 'vm', '97', null, '2015-05-07 01:50:58');
INSERT INTO `cloud_job` VALUES ('93', 'cbaa109d-cc6c-4c3e-b140-4871b24109cf', '1', 'vm', '98', null, '2015-05-07 01:51:48');
INSERT INTO `cloud_job` VALUES ('94', '80869bac-1bb8-4f9b-bd59-37eb4fb72e72', '1', 'vm', '99', null, '2015-05-07 01:53:03');
INSERT INTO `cloud_job` VALUES ('95', 'e801f189-0fdb-445f-bb33-94daff9d9570', '1', 'vm', '100', null, '2015-05-07 01:53:39');
INSERT INTO `cloud_job` VALUES ('96', '5aa7111a-0cfb-4167-b93b-12db865a4a08', '1', 'vm', '101', null, '2015-05-07 01:54:17');
INSERT INTO `cloud_job` VALUES ('97', '5d263bca-37d2-4569-a1fa-d5ba505c6a59', '1', 'vm', '102', null, '2015-05-07 01:55:18');
INSERT INTO `cloud_job` VALUES ('98', '166df188-ec4b-46bb-a9d5-f03bed1e3344', '1', 'vm', '103', null, '2015-05-07 02:09:58');
INSERT INTO `cloud_job` VALUES ('99', '6790f39b-ae1c-46b9-b1ff-a65c0074d637', '1', 'vm', '104', null, '2015-05-07 02:11:59');
INSERT INTO `cloud_job` VALUES ('100', '2acfc069-6a4d-41b8-bb70-755930d08ca9', '1', 'vm', '105', null, '2015-05-07 18:45:41');
INSERT INTO `cloud_job` VALUES ('101', '93193b70-8203-4d6a-a4fc-0c50b5dd88c5', '1', 'vm', '106', null, '2015-05-07 18:48:49');
INSERT INTO `cloud_job` VALUES ('102', 'decc6f9c-b055-4e30-acbc-7b818546bbc4', '1', 'vm', '0', null, '2015-05-07 23:54:27');
INSERT INTO `cloud_job` VALUES ('103', '029a2074-ebd9-4126-baef-d1e92b56f408', '1', 'vm', '0', null, '2015-05-08 00:06:58');
INSERT INTO `cloud_job` VALUES ('104', '278d548f-0f2d-4e80-aa20-882ca3b94f4a', '1', 'vm', '0', null, '2015-05-08 00:14:44');
INSERT INTO `cloud_job` VALUES ('105', '9c18ef60-b646-4193-bf8e-b3474cf524dd', '1', 'vm', '0', null, '2015-05-08 00:31:25');
INSERT INTO `cloud_job` VALUES ('106', 'b7c065b1-0855-4e6c-a6d5-5e1b2a99d912', '1', 'vm', '0', null, '2015-05-08 00:31:55');
INSERT INTO `cloud_job` VALUES ('107', '1291dadf-2bf1-4dac-9514-d3ee1a3d7386', '1', 'vm', '107', null, '2015-05-08 00:38:32');
INSERT INTO `cloud_job` VALUES ('108', '350c82ad-ce99-42a4-aedb-0010e960a60f', '1', 'vm', '108', null, '2015-05-08 17:41:24');
INSERT INTO `cloud_job` VALUES ('109', 'fc190c85-4f58-438e-ae2b-4bb6fedf4054', '1', 'vm', '109', null, '2015-05-08 17:43:48');
INSERT INTO `cloud_job` VALUES ('110', '8771cf5b-1d66-4961-8355-622ae0ccd494', '1', 'vm', '110', null, '2015-05-08 17:46:46');
INSERT INTO `cloud_job` VALUES ('111', '01b29d54-4400-41b8-8182-fd74a3489fd5', '1', 'vm', '111', null, '2015-05-08 17:51:27');
INSERT INTO `cloud_job` VALUES ('112', 'bdf254a5-3639-4226-a8cf-db92375f91a8', '1', 'vm', '112', null, '2015-05-08 18:02:43');
INSERT INTO `cloud_job` VALUES ('113', '326387ff-c65a-4731-ad33-73538a414550', '1', 'vm', '113', null, '2015-05-08 18:17:15');
INSERT INTO `cloud_job` VALUES ('114', 'c34ff5cb-7668-44a0-ac60-3879798b27d2', '1', 'vm', '114', null, '2015-05-08 18:17:34');
INSERT INTO `cloud_job` VALUES ('115', 'eb3433bb-3e8b-4ff6-9475-07f82c9c3a32', '1', 'vm', '115', null, '2015-05-08 18:21:43');
INSERT INTO `cloud_job` VALUES ('116', '94683ed8-e363-493a-a4da-3976d8a69063', '1', 'vm', '116', null, '2015-05-08 18:46:49');
INSERT INTO `cloud_job` VALUES ('117', '26995334-d42a-4ddf-a3ac-66f1000b656d', '1', 'vm', '117', null, '2015-05-08 18:49:14');
INSERT INTO `cloud_job` VALUES ('118', '5094ca2f-770b-477a-a255-85cd87f24e3c', '1', 'vm', '118', null, '2015-05-08 20:43:42');
INSERT INTO `cloud_job` VALUES ('119', '70596cab-c0be-456f-899e-e51af2656f20', '1', 'vm', '119', null, '2015-05-08 20:58:53');
INSERT INTO `cloud_job` VALUES ('120', 'f8189ee8-fb86-4499-a141-a1e4b497094b', '1', 'vm', '120', null, '2015-05-08 21:02:50');
INSERT INTO `cloud_job` VALUES ('121', '1df3ca2b-7657-4981-ae59-21dd38be48ee', '1', 'vm', '121', null, '2015-05-08 21:08:15');
INSERT INTO `cloud_job` VALUES ('122', '66ce9ce7-b482-4d03-87f1-f31e4c561bd5', '1', 'vm', '122', null, '2015-05-08 21:11:48');
INSERT INTO `cloud_job` VALUES ('123', '2b29d713-f628-4f4f-834c-a7f532f09e2b', '1', 'vm', '123', null, '2015-05-08 21:13:47');
INSERT INTO `cloud_job` VALUES ('124', '38b2773d-8e36-4111-97e7-5b350632f3b4', '1', 'vm', '124', null, '2015-05-08 22:04:35');
INSERT INTO `cloud_job` VALUES ('125', '7a3191ce-7985-427c-8aec-5f5c5e9d0c1a', '1', 'vm', '125', null, '2015-05-08 22:12:59');
INSERT INTO `cloud_job` VALUES ('126', 'd808397d-02e9-4cce-b1dc-8a423981f7f8', '1', 'vm', '126', null, '2015-05-08 22:21:55');
INSERT INTO `cloud_job` VALUES ('127', '85aadcdc-2fb1-4c6c-90b9-0b629f3deaed', '1', 'vm', '127', null, '2015-05-08 22:24:44');
INSERT INTO `cloud_job` VALUES ('128', 'e1e9487c-f440-4cbc-b9e6-77981f7afc1a', '1', 'vm', '128', null, '2015-05-08 22:50:37');
INSERT INTO `cloud_job` VALUES ('129', '8d618e13-dace-4ab4-a9f4-b3a0071160f3', '1', 'vm', '129', null, '2015-05-08 22:53:20');
INSERT INTO `cloud_job` VALUES ('130', '9d31c053-b9ee-46ca-89a6-6639afa8886f', '1', 'vm', '130', null, '2015-05-08 22:53:41');
INSERT INTO `cloud_job` VALUES ('131', '3003e562-35be-40c4-a6b8-bd98dba18267', '1', 'vm', '131', null, '2015-05-08 23:01:41');
INSERT INTO `cloud_job` VALUES ('132', 'bb53b06c-786c-4e60-a3ba-995e13e57930', '1', 'vm', '132', null, '2015-05-08 23:10:45');
INSERT INTO `cloud_job` VALUES ('133', '360caf9e-13d7-4e81-a8f3-a99226479b5e', '1', 'vm', '133', null, '2015-05-08 23:13:53');
INSERT INTO `cloud_job` VALUES ('134', '2c95615b-ebb2-4b0c-bef2-a6871580d635', '1', 'vm', '134', null, '2015-05-08 23:24:18');
INSERT INTO `cloud_job` VALUES ('135', '7b777891-3468-4014-a46c-2d67e90215b2', '1', 'vm', '135', null, '2015-05-08 23:27:14');
INSERT INTO `cloud_job` VALUES ('136', 'b65343e4-2fb2-46a6-89d6-d3802a2f5a1c', '1', 'vm', '137', null, '2015-05-09 00:10:38');
INSERT INTO `cloud_job` VALUES ('137', 'de7fba64-7370-4f87-8085-08bf33a68ecc', '1', 'vm', '139', null, '2015-05-09 00:19:26');
INSERT INTO `cloud_job` VALUES ('138', 'df8588b1-f95b-4eaf-9deb-bf75418a8ccd', '1', 'vm', '140', null, '2015-05-09 00:29:40');
INSERT INTO `cloud_job` VALUES ('139', 'a2487015-9539-4a49-badf-fcab32d9ccb3', '1', 'vm', '141', null, '2015-05-09 02:36:36');
INSERT INTO `cloud_job` VALUES ('140', '54932196-4524-41b3-b761-24b548d3f043', '1', 'vm', '142', null, '2015-05-09 02:52:58');
INSERT INTO `cloud_job` VALUES ('141', '46540d3b-669a-4f11-bc7b-95d43e76cc08', '1', 'vm', '143', null, '2015-05-11 19:42:27');
INSERT INTO `cloud_job` VALUES ('142', '234316b3-a0c9-4536-b0e1-6621acfe545a', '1', 'vm', '144', null, '2015-05-11 19:44:07');
INSERT INTO `cloud_job` VALUES ('143', '21f47e14-f7d3-4fb5-8ddc-a9bd6b037a9e', '1', 'vm', '145', null, '2015-05-11 20:05:34');
INSERT INTO `cloud_job` VALUES ('144', '0491574d-0553-40dd-92e7-2d82f5b94eda', '1', 'vm', '146', null, '2015-05-11 20:49:00');
INSERT INTO `cloud_job` VALUES ('145', '51b436a3-6477-4f49-a8f8-8b16e0b2f511', '1', 'vm', '147', null, '2015-05-11 21:15:49');
INSERT INTO `cloud_job` VALUES ('146', '33203e21-1693-4140-a519-f084437fcf5d', '1', 'vm', '148', null, '2015-05-11 22:52:16');
INSERT INTO `cloud_job` VALUES ('147', '70c3968b-1398-4258-9d1b-e2aa6f23dd19', '1', 'vm', '149', null, '2015-05-11 23:53:58');
INSERT INTO `cloud_job` VALUES ('148', '1426ec7c-2ffd-440e-92e5-4a5cbc8b16dc', '1', 'vm', '150', null, '2015-05-12 00:31:05');
INSERT INTO `cloud_job` VALUES ('149', '36f93183-dfd0-4c8c-8ecb-85d84acd1abc', '1', 'vm', '151', null, '2015-05-14 19:15:36');
INSERT INTO `cloud_job` VALUES ('150', 'ab71b04b-a31e-4f4b-abf4-d4feb4065ebe', '1', 'vm', '152', null, '2015-05-15 00:14:55');
INSERT INTO `cloud_job` VALUES ('151', 'ab874c8b-ec9e-4a1e-a77b-dfb5f68db34b', '1', 'vm', '153', null, '2015-05-15 01:15:30');
INSERT INTO `cloud_job` VALUES ('152', '234b19e0-34e5-471e-9649-7e67f1ac8705', '1', 'vm', '154', null, '2015-05-15 02:33:14');
INSERT INTO `cloud_job` VALUES ('153', '62c06ef6-3f34-4fc8-9e55-3ea6ec72b28f', '1', 'vm', '155', null, '2015-05-15 02:40:30');
INSERT INTO `cloud_job` VALUES ('154', 'eaa1503e-05f3-40dc-bfae-9662e36e4caa', '1', 'vm', '19', null, '2015-05-15 19:04:24');
INSERT INTO `cloud_job` VALUES ('155', '7ff92694-ef81-48c8-b4f5-8dd08e41f602', '1', 'vm', '156', null, '2015-05-17 06:19:43');
INSERT INTO `cloud_job` VALUES ('156', 'a0aea318-0044-4851-8b4f-2c125271fda3', '1', 'vm', '157', null, '2015-05-17 06:29:56');
INSERT INTO `cloud_job` VALUES ('157', 'f3142510-4cf8-4d9b-8172-254deeafcb8f', '1', 'vm', '158', null, '2015-05-17 06:34:04');
INSERT INTO `cloud_job` VALUES ('158', 'cc141bc3-ddce-4456-9b1c-4fd508742f94', '1', 'vm', '159', null, '2015-05-17 06:38:55');
INSERT INTO `cloud_job` VALUES ('159', '35659c0a-5f80-431b-a78c-76a678ad2c46', '1', 'vm', '160', null, '2015-05-17 06:40:36');
INSERT INTO `cloud_job` VALUES ('160', 'dd98d096-ce15-4346-abc7-7d9d7b460d38', '1', 'vm', '161', null, '2015-05-17 06:42:40');
INSERT INTO `cloud_job` VALUES ('161', '1d6d29f1-071e-4cfd-b600-7448c555398b', '1', 'vm', '162', null, '2015-05-17 06:48:27');
INSERT INTO `cloud_job` VALUES ('162', '0abf081d-82ce-44be-bd13-ba6b1ce8565c', '1', 'vm', '163', null, '2015-05-17 06:50:24');
INSERT INTO `cloud_job` VALUES ('163', 'f1f8461c-e28d-4e33-b904-0ac7076303ea', '1', 'vm', '164', null, '2015-05-17 20:09:39');
INSERT INTO `cloud_job` VALUES ('164', 'b4e8dbc2-ff39-43df-b763-82f3b9e17849', '1', 'vm', '165', null, '2015-05-17 20:28:56');
INSERT INTO `cloud_job` VALUES ('165', 'b33f1d35-10b9-4eb5-b6fb-ac2214be762c', '1', 'vm', '166', null, '2015-05-17 20:34:50');
INSERT INTO `cloud_job` VALUES ('166', '9cd12000-6670-401f-b1e7-1fe3da79c3b9', '1', 'vm', '167', null, '2015-05-17 20:44:14');
INSERT INTO `cloud_job` VALUES ('167', '23046917-4d48-4387-8be9-76e3ee3b2c34', '1', 'vm', '168', null, '2015-05-17 20:58:27');
INSERT INTO `cloud_job` VALUES ('168', '0a0ff270-e48d-46a1-8780-f1f31b91d899', '1', 'vm', '169', null, '2015-05-17 21:00:24');
INSERT INTO `cloud_job` VALUES ('169', 'c548f167-dc87-4661-866b-c31fc4543815', '1', 'vm', '170', null, '2015-05-17 21:09:04');
INSERT INTO `cloud_job` VALUES ('170', 'b4d21207-8cda-41f2-bad0-9760da371b90', '1', 'vm', '171', null, '2015-05-17 21:19:18');
INSERT INTO `cloud_job` VALUES ('171', '755d146e-5af1-42e7-aef4-fb40d494295f', '1', 'vm', '172', null, '2015-05-18 19:23:07');
INSERT INTO `cloud_job` VALUES ('172', '0e3c535a-c536-44ae-8d5b-e79705cb187a', '1', 'vm', '173', null, '2015-05-18 19:30:08');
INSERT INTO `cloud_job` VALUES ('173', 'f839ea48-727e-4cb9-a6ed-ee8840de64e7', '1', 'vm', '174', null, '2015-05-18 20:25:17');
INSERT INTO `cloud_job` VALUES ('174', 'd9cdddbb-4883-4d92-9b0b-6310a0d2a741', '1', 'vm', '175', null, '2015-05-18 20:38:42');
INSERT INTO `cloud_job` VALUES ('175', '9b5e667b-c418-42fa-9812-1e07ce38ba1b', null, 'cloud_template', '0', null, '2015-05-18 20:43:21');
INSERT INTO `cloud_job` VALUES ('176', 'bddb7ce3-1e2c-47a0-8f23-523e361f494c', null, 'cloud_template', '0', null, '2015-05-18 20:46:49');
INSERT INTO `cloud_job` VALUES ('177', '7e06d334-cf4d-490c-a37f-ceb379523eab', null, 'cloud_template', '0', null, '2015-05-18 20:49:48');
INSERT INTO `cloud_job` VALUES ('178', '1bae10e1-3b5c-4278-bf86-490f721a7820', null, 'cloud_template', '0', null, '2015-05-18 20:57:05');
INSERT INTO `cloud_job` VALUES ('179', '5ed4d7e3-007a-40bf-816e-c5fe5298a49e', null, 'cloud_template', '0', null, '2015-05-18 20:59:03');
INSERT INTO `cloud_job` VALUES ('180', '156a285c-7adf-4baf-81fc-f7be5c41c56a', null, 'cloud_template', '0', null, '2015-05-18 20:59:58');
INSERT INTO `cloud_job` VALUES ('181', '1bca709c-67ba-4c83-8a3f-5460de86694d', null, 'cloud_template', '9', null, '2015-05-18 21:02:21');
INSERT INTO `cloud_job` VALUES ('182', '37f24a7b-2c80-4ede-a09e-d787d462292d', '1', 'vm', '176', null, '2015-05-18 23:02:19');
INSERT INTO `cloud_job` VALUES ('183', 'a48f4f52-8763-40b7-82bc-2826bce71a50', '1', 'vm', '5', null, '2015-05-18 23:04:36');
INSERT INTO `cloud_job` VALUES ('184', 'c2e92142-2a88-48a2-8643-bc27f2063fef', '1', 'vm', '5', null, '2015-05-18 23:11:44');
INSERT INTO `cloud_job` VALUES ('185', 'b633d21e-e8b1-483e-9239-5f92881feed1', '1', 'vm', '5', null, '2015-05-18 23:34:27');
INSERT INTO `cloud_job` VALUES ('186', '0bf8a423-ca6e-496f-b670-988ae3374f76', '1', 'vm', '5', null, '2015-05-18 23:50:14');
INSERT INTO `cloud_job` VALUES ('187', 'cfb6ca5d-ba0e-475a-b27f-faa5f7f2a68b', '1', 'vm', '177', null, '2015-05-19 00:03:36');
INSERT INTO `cloud_job` VALUES ('188', '3f9326b7-df83-421a-a227-72da392169a6', '1', 'vm', '0', null, '2015-05-19 00:20:46');
INSERT INTO `cloud_job` VALUES ('189', 'd7f03626-0686-48c8-bcc6-785c1cb6aa97', '1', 'vm', '0', null, '2015-05-19 00:24:07');
INSERT INTO `cloud_job` VALUES ('190', '36d1537d-3de2-41e7-b621-02d8cae9ea33', '1', 'vm', '178', null, '2015-05-19 00:37:41');
INSERT INTO `cloud_job` VALUES ('191', '38aa7454-e78e-4818-9410-00bfd2b876d7', '1', 'vm', '0', null, '2015-05-19 00:45:47');
INSERT INTO `cloud_job` VALUES ('192', 'd6e94bb1-421d-40b8-a230-2e69ce60ae07', '1', 'vm', '179', null, '2015-05-19 00:46:51');
INSERT INTO `cloud_job` VALUES ('193', '821caed0-980a-4464-b0ee-e69b362789b0', '1', 'vm', '0', null, '2015-05-19 00:50:04');
INSERT INTO `cloud_job` VALUES ('194', '7f76230d-5055-4363-a009-38f0efd62975', null, 'cloud_template', '10', null, '2015-05-19 00:50:42');
INSERT INTO `cloud_job` VALUES ('195', '3f1e0399-0096-4c77-8e0b-187f144ea139', '1', 'vm', '180', null, '2015-06-01 18:56:46');
INSERT INTO `cloud_job` VALUES ('196', 'ae9f824f-ef15-4d5a-b450-f1dcceefaf03', '1', 'vm', '181', null, '2015-06-01 19:05:21');
INSERT INTO `cloud_job` VALUES ('197', 'e655539e-0263-4471-b1bd-5c9fb2fab858', '1', 'vm', '0', null, '2015-06-01 19:08:01');
INSERT INTO `cloud_job` VALUES ('198', '888756ed-44b0-4597-a432-3eceac4f56eb', '1', 'vm', '0', null, '2015-06-01 19:08:59');
INSERT INTO `cloud_job` VALUES ('199', 'e195dd9e-dc9f-4ef0-b6b2-e8c53aea8859', '1', 'vm', '0', null, '2015-06-01 19:10:09');
INSERT INTO `cloud_job` VALUES ('200', '858e8037-6c01-4dde-8049-0a41106dd1c5', '1', 'vm', '0', null, '2015-06-01 19:10:40');
INSERT INTO `cloud_job` VALUES ('201', '98ff0b1e-f277-4234-8001-3008dd800b85', '1', 'vm', '0', null, '2015-06-01 19:10:42');
INSERT INTO `cloud_job` VALUES ('202', '166a11f0-10dd-487e-b268-dca807e90fda', '1', 'vm', '0', null, '2015-06-01 19:11:05');
INSERT INTO `cloud_job` VALUES ('203', '5359a9e8-7f97-45aa-bfc6-5190bd01e2d3', '1', 'vm', '0', null, '2015-06-01 19:17:37');
INSERT INTO `cloud_job` VALUES ('204', '03218106-08b0-444e-864a-38fa85cd8693', '1', 'vm', '0', null, '2015-06-01 19:18:00');
INSERT INTO `cloud_job` VALUES ('205', 'aab17c20-520a-4fe6-aad8-916bd51fc737', '1', 'vm', '0', null, '2015-06-01 19:22:14');
INSERT INTO `cloud_job` VALUES ('206', 'd9de8850-1ad9-4402-802a-97f0f2eabb14', '1', 'vm', '182', null, '2015-06-01 19:22:49');
INSERT INTO `cloud_job` VALUES ('207', '1804fa35-f433-416b-858d-03f6d3170ddc', '1', 'vm', '0', null, '2015-06-01 19:26:19');
INSERT INTO `cloud_job` VALUES ('208', '90a8d251-a313-4ff0-8b1c-fc4de3dbfc83', '1', 'vm', '0', null, '2015-06-01 19:29:51');
INSERT INTO `cloud_job` VALUES ('209', 'd5254456-2b7b-426e-8cfe-2a162b2aef1b', '1', 'vm', '0', null, '2015-06-01 19:38:50');
INSERT INTO `cloud_job` VALUES ('210', '39e191eb-be20-44ed-a472-b6adf8025ac9', '1', 'vm', '0', null, '2015-06-01 19:39:01');
INSERT INTO `cloud_job` VALUES ('211', 'bd8efc97-3dbb-44c0-a93c-80b5f8b21963', '1', 'vm', '183', null, '2015-06-01 20:24:13');
INSERT INTO `cloud_job` VALUES ('212', '99250e7f-dedd-4a41-b0a7-441626bcc347', '1', 'vm', '5', null, '2015-06-01 21:28:45');
INSERT INTO `cloud_job` VALUES ('213', 'fed098a3-4998-4d4a-b461-01e8e63ea6a3', null, 'cloud_template', '11', null, '2015-06-01 21:29:07');
INSERT INTO `cloud_job` VALUES ('214', '27240c0e-5b03-4887-b1ba-0ff8a07fac4a', '1', 'vm', '184', null, '2015-06-01 21:33:21');
INSERT INTO `cloud_job` VALUES ('215', '53b5c37c-0a32-420f-be62-b59561bc17ac', '1', 'vm', '185', null, '2015-06-01 21:36:39');
INSERT INTO `cloud_job` VALUES ('216', '3b0c1f1c-0001-4a1e-9c21-bd6402b8efce', '1', 'vm', '186', null, '2015-06-01 22:14:41');
INSERT INTO `cloud_job` VALUES ('217', '6e7f054b-2c85-4983-8bc7-2699a6807351', '1', 'vm', '75010689', null, '2015-06-01 22:46:06');
INSERT INTO `cloud_job` VALUES ('218', 'a8742ba5-6e96-403b-b828-11d5ecccc2c8', null, 'cloud_template', '12', null, '2015-06-01 22:46:30');
INSERT INTO `cloud_job` VALUES ('219', '14d0d400-814e-447c-9397-4713338f7789', '1', 'vm', '187', null, '2015-06-01 22:51:10');

-- ----------------------------
-- Table structure for cloud_offering
-- ----------------------------
DROP TABLE IF EXISTS `cloud_offering`;
CREATE TABLE `cloud_offering` (
  `col_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置编号',
  `col_offering_id` char(64) NOT NULL,
  `col_cloud_id` int(11) unsigned NOT NULL,
  `col_name` char(50) NOT NULL COMMENT '配置名称',
  `col_cpunumber` decimal(10,2) NOT NULL COMMENT 'cpu核心数目',
  `col_cpuspeed` decimal(10,2) NOT NULL COMMENT 'cpu速度',
  `col_memory` decimal(10,2) NOT NULL COMMENT '内存大小',
  `col_valid` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT '是否有效',
  `col_status` tinyint(4) NOT NULL COMMENT '1，正常 2 默认 3 推荐',
  `col_price` decimal(10,2) NOT NULL COMMENT '价格',
  PRIMARY KEY (`col_id`),
  KEY `FK_cloud_offering_cloud` (`col_cloud_id`),
  KEY `col_offering_id` (`col_offering_id`),
  CONSTRAINT `FK_cloud_offering_cloud` FOREIGN KEY (`col_cloud_id`) REFERENCES `cloud` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='虚机配置（规格）表';

-- ----------------------------
-- Records of cloud_offering
-- ----------------------------
INSERT INTO `cloud_offering` VALUES ('1', '9c276cb8-a162-4325-b227-9cdcb74e0122', '1', 'Small Instance', '1.00', '500.00', '512.00', 'N', '0', '0.00');
INSERT INTO `cloud_offering` VALUES ('2', 'ef25b871-72db-47dd-95fb-cc90e6669a52', '1', 'Medium Instance', '1.00', '1000.00', '1024.00', 'N', '0', '0.00');

-- ----------------------------
-- Table structure for cloud_ostype
-- ----------------------------
DROP TABLE IF EXISTS `cloud_ostype`;
CREATE TABLE `cloud_ostype` (
  `col_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `col_cloud_id` int(11) unsigned NOT NULL DEFAULT '0',
  `col_ostype_id` char(64) DEFAULT NULL,
  `col_oscategory_id` char(64) DEFAULT NULL,
  `col_oscategory_name` varchar(20) DEFAULT NULL,
  `col_name` char(50) DEFAULT NULL,
  PRIMARY KEY (`col_id`),
  KEY `FK_cloud_ostype_cloud` (`col_cloud_id`),
  CONSTRAINT `FK_cloud_ostype_cloud` FOREIGN KEY (`col_cloud_id`) REFERENCES `cloud` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=939 DEFAULT CHARSET=utf8 COMMENT='操作系统';

-- ----------------------------
-- Records of cloud_ostype
-- ----------------------------
INSERT INTO `cloud_ostype` VALUES ('688', '1', '09d71170-fb86-11e4-a0f4-d6ed8d2c551f', '0959c7e4-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Apple Mac OS X 10.6 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('689', '1', '09daa169-fb86-11e4-a0f4-d6ed8d2c551f', '0959c7e4-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Apple Mac OS X 10.6 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('690', '1', '09e420b3-fb86-11e4-a0f4-d6ed8d2c551f', '0959c7e4-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Apple Mac OS X 10.7 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('691', '1', '09e4ae75-fb86-11e4-a0f4-d6ed8d2c551f', '0959c7e4-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Apple Mac OS X 10.7 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('692', '1', '09967cef-fb86-11e4-a0f4-d6ed8d2c551f', '0959c7e4-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Asianux 3(32-bit)');
INSERT INTO `cloud_ostype` VALUES ('693', '1', '0996f7ae-fb86-11e4-a0f4-d6ed8d2c551f', '0959c7e4-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Asianux 3(64-bit)');
INSERT INTO `cloud_ostype` VALUES ('694', '1', '095bbe1b-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 4.5 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('695', '1', '095c4199-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 4.6 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('696', '1', '095c7918-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 4.7 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('697', '1', '095cf33f-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 4.8 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('698', '1', '0c0dc735-fb87-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 5 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('699', '1', '0c0ddf9e-fb87-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 5 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('700', '1', '095d287d-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 5.0 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('701', '1', '095da31f-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 5.0 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('702', '1', '095e1fd4-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 5.1 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('703', '1', '096a972f-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 5.1 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('704', '1', '096c1c6c-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 5.2 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('705', '1', '096d2e90-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 5.2 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('706', '1', '0973a6f6-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 5.3 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('707', '1', '097435a5-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 5.3 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('708', '1', '0974bd0f-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 5.4 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('709', '1', '0974f6ab-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 5.4 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('710', '1', '09ac4b27-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 5.5 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('711', '1', '09ac813c-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 5.5 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('712', '1', '09b80360-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 5.6 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('713', '1', '09b88141-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 5.6 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('714', '1', '09bfeeab-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 5.7 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('715', '1', '09c0681a-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 5.7 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('716', '1', '09c4b461-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 5.8 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('717', '1', '09c4e9d5-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 5.8 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('718', '1', '09c564f5-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 5.9 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('719', '1', '09c5de2d-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 5.9 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('720', '1', '0c0f02b3-fb87-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 6 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('721', '1', '0c0f46a4-fb87-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 6 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('722', '1', '09b8b740-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 6.0 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('723', '1', '09b93747-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 6.0 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('724', '1', '09c6148d-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 6.1 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('725', '1', '09c68f31-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 6.1 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('726', '1', '09c708bf-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 6.2 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('727', '1', '09c73fea-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 6.2 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('728', '1', '09c401a4-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 6.3 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('729', '1', '09c4387f-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 6.3 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('730', '1', '09c7bf17-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 6.4 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('731', '1', '09c7f614-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 6.4 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('732', '1', '0a34025f-fb87-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 6.5 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('733', '1', '0a3417e8-fb87-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 6.5 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('734', '1', '0c0ed9d4-fb87-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'CentOS 7');
INSERT INTO `cloud_ostype` VALUES ('735', '1', '099836fd-fb86-11e4-a0f4-d6ed8d2c551f', '0957a067-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Debian GNU/Linux 4(32-bit)');
INSERT INTO `cloud_ostype` VALUES ('736', '1', '0998b303-fb86-11e4-a0f4-d6ed8d2c551f', '0957a067-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Debian GNU/Linux 4(64-bit)');
INSERT INTO `cloud_ostype` VALUES ('737', '1', '0997a6bb-fb86-11e4-a0f4-d6ed8d2c551f', '0957a067-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Debian GNU/Linux 5(64-bit)');
INSERT INTO `cloud_ostype` VALUES ('738', '1', '0975836f-fb86-11e4-a0f4-d6ed8d2c551f', '0957a067-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Debian GNU/Linux 5.0 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('739', '1', '09b45a17-fb86-11e4-a0f4-d6ed8d2c551f', '0957a067-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Debian GNU/Linux 6(32-bit)');
INSERT INTO `cloud_ostype` VALUES ('740', '1', '09b4d419-fb86-11e4-a0f4-d6ed8d2c551f', '0957a067-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Debian GNU/Linux 6(64-bit)');
INSERT INTO `cloud_ostype` VALUES ('741', '1', '09c88fdd-fb86-11e4-a0f4-d6ed8d2c551f', '0957a067-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Debian GNU/Linux 7(32-bit)');
INSERT INTO `cloud_ostype` VALUES ('742', '1', '09c90baa-fb86-11e4-a0f4-d6ed8d2c551f', '0957a067-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Debian GNU/Linux 7(64-bit)');
INSERT INTO `cloud_ostype` VALUES ('743', '1', '09a8c04d-fb86-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'DOS');
INSERT INTO `cloud_ostype` VALUES ('744', '1', '09aed992-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Fedora 10');
INSERT INTO `cloud_ostype` VALUES ('745', '1', '09aea231-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Fedora 11');
INSERT INTO `cloud_ostype` VALUES ('746', '1', '09ae29ed-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Fedora 12');
INSERT INTO `cloud_ostype` VALUES ('747', '1', '09adb0cc-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Fedora 13');
INSERT INTO `cloud_ostype` VALUES ('748', '1', '09af8fbf-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Fedora 8');
INSERT INTO `cloud_ostype` VALUES ('749', '1', '09af5a5d-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Fedora 9');
INSERT INTO `cloud_ostype` VALUES ('750', '1', '09a0e639-fb86-11e4-a0f4-d6ed8d2c551f', '095a7e68-fb86-11e4-a0f4-d6ed8d2c551f', null, 'FreeBSD (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('751', '1', '09a1766b-fb86-11e4-a0f4-d6ed8d2c551f', '095a7e68-fb86-11e4-a0f4-d6ed8d2c551f', null, 'FreeBSD (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('752', '1', '09e5a86a-fb86-11e4-a0f4-d6ed8d2c551f', '095a7e68-fb86-11e4-a0f4-d6ed8d2c551f', null, 'FreeBSD 10 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('753', '1', '09e63e64-fb86-11e4-a0f4-d6ed8d2c551f', '095a7e68-fb86-11e4-a0f4-d6ed8d2c551f', null, 'FreeBSD 10 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('754', '1', '09a48c41-fb86-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Microsoft Small Bussiness Server 2003');
INSERT INTO `cloud_ostype` VALUES ('755', '1', '09b6cca9-fb86-11e4-a0f4-d6ed8d2c551f', '0959c7e4-fb86-11e4-a0f4-d6ed8d2c551f', null, 'None');
INSERT INTO `cloud_ostype` VALUES ('756', '1', '099f5f1a-fb86-11e4-a0f4-d6ed8d2c551f', '095a0087-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Novell Netware 5.1');
INSERT INTO `cloud_ostype` VALUES ('757', '1', '099e34aa-fb86-11e4-a0f4-d6ed8d2c551f', '095a0087-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Novell Netware 6.x');
INSERT INTO `cloud_ostype` VALUES ('758', '1', '099646a6-fb86-11e4-a0f4-d6ed8d2c551f', '0959c7e4-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Open Enterprise Server');
INSERT INTO `cloud_ostype` VALUES ('759', '1', '0c0df4a6-fb87-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 5 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('760', '1', '0c0e0a3c-fb87-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 5 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('761', '1', '097605c3-fb86-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 5.0 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('762', '1', '097681ba-fb86-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 5.0 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('763', '1', '0976ba34-fb86-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 5.1 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('764', '1', '09775362-fb86-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 5.1 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('765', '1', '0977de7d-fb86-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 5.2 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('766', '1', '09785ae2-fb86-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 5.2 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('767', '1', '09789463-fb86-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 5.3 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('768', '1', '09790f67-fb86-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 5.3 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('769', '1', '09798f21-fb86-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 5.4 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('770', '1', '0979c85d-fb86-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 5.4 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('771', '1', '09b50a59-fb86-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 5.5 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('772', '1', '09b595fe-fb86-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 5.5 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('773', '1', '09b9b1bf-fb86-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 5.6 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('774', '1', '09b9e74a-fb86-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 5.6 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('775', '1', '09d10320-fb86-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 5.7 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('776', '1', '09d1735a-fb86-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 5.7 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('777', '1', '09d1ab2a-fb86-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 5.8 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('778', '1', '09d242af-fb86-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 5.8 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('779', '1', '09d2bb3d-fb86-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 5.9 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('780', '1', '09d2f146-fb86-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 5.9 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('781', '1', '0c0e1ef5-fb87-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 6 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('782', '1', '0c0e3313-fb87-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 6 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('783', '1', '09ba6070-fb86-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 6.0 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('784', '1', '09badbbd-fb86-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 6.0 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('785', '1', '09d37656-fb86-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 6.1 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('786', '1', '09d3eec1-fb86-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 6.1 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('787', '1', '09d426c0-fb86-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 6.2 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('788', '1', '09d4a134-fb86-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 6.2 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('789', '1', '09d51ada-fb86-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 6.3 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('790', '1', '09d5de26-fb86-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 6.3 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('791', '1', '09d65abb-fb86-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 6.4 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('792', '1', '09d69657-fb86-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 6.4 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('793', '1', '0c0f9b5a-fb87-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 6.5 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('794', '1', '0c0fb0e9-fb87-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Enterprise Linux 6.5 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('795', '1', '0c0eee32-fb87-11e4-a0f4-d6ed8d2c551f', '09581c44-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Oracle Linux 7');
INSERT INTO `cloud_ostype` VALUES ('796', '1', '09a97696-fb86-11e4-a0f4-d6ed8d2c551f', '0959c7e4-fb86-11e4-a0f4-d6ed8d2c551f', null, 'OS/2');
INSERT INTO `cloud_ostype` VALUES ('797', '1', '09933c06-fb86-11e4-a0f4-d6ed8d2c551f', '0959c7e4-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Other (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('798', '1', '09a93e45-fb86-11e4-a0f4-d6ed8d2c551f', '0959c7e4-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Other (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('799', '1', '0998eb2b-fb86-11e4-a0f4-d6ed8d2c551f', '0959c7e4-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Other 2.6x Linux (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('800', '1', '099968df-fb86-11e4-a0f4-d6ed8d2c551f', '0959c7e4-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Other 2.6x Linux (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('801', '1', '09e67b04-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Other CentOS (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('802', '1', '09e71040-fb86-11e4-a0f4-d6ed8d2c551f', '0957687c-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Other CentOS (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('803', '1', '09a74b75-fb86-11e4-a0f4-d6ed8d2c551f', '0959c7e4-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Other Linux (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('804', '1', '09a77ff5-fb86-11e4-a0f4-d6ed8d2c551f', '0959c7e4-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Other Linux (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('805', '1', '09b74e4d-fb86-11e4-a0f4-d6ed8d2c551f', '0959c7e4-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Other PV (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('806', '1', '09b7cc74-fb86-11e4-a0f4-d6ed8d2c551f', '0959c7e4-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Other PV (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('807', '1', '09e7a46b-fb86-11e4-a0f4-d6ed8d2c551f', '0958d31a-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Other SUSE Linux(32-bit)');
INSERT INTO `cloud_ostype` VALUES ('808', '1', '09e82847-fb86-11e4-a0f4-d6ed8d2c551f', '0958d31a-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Other SUSE Linux(64-bit)');
INSERT INTO `cloud_ostype` VALUES ('809', '1', '0992ba13-fb86-11e4-a0f4-d6ed8d2c551f', '095ab3f5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Other Ubuntu (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('810', '1', '09a7fabc-fb86-11e4-a0f4-d6ed8d2c551f', '095ab3f5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Other Ubuntu (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('811', '1', '09b42241-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 2');
INSERT INTO `cloud_ostype` VALUES ('812', '1', '0995514f-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 3(32-bit)');
INSERT INTO `cloud_ostype` VALUES ('813', '1', '0995ca8a-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 3(64-bit)');
INSERT INTO `cloud_ostype` VALUES ('814', '1', '09aa6af5-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 4(64-bit)');
INSERT INTO `cloud_ostype` VALUES ('815', '1', '097a4fb5-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 4.5 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('816', '1', '097ad1db-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 4.6 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('817', '1', '097b08a7-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 4.7 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('818', '1', '097b87ae-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 4.8 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('819', '1', '0c0e4735-fb87-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 5 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('820', '1', '0c0e5b90-fb87-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 5 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('821', '1', '0985c123-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 5.0 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('822', '1', '0986a753-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 5.0 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('823', '1', '09873a7b-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 5.1 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('824', '1', '0987c4fa-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 5.1 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('825', '1', '098874dd-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 5.2 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('826', '1', '0988f930-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 5.2 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('827', '1', '098973d3-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 5.3 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('828', '1', '0989ac39-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 5.3 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('829', '1', '0989e2c4-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 5.4 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('830', '1', '098a18a1-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 5.4 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('831', '1', '09acfc24-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 5.5 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('832', '1', '09ad7987-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 5.5 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('833', '1', '09bb1467-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 5.6 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('834', '1', '09bb8ffa-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 5.6 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('835', '1', '09caf43b-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 5.7 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('836', '1', '09cb6f12-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 5.7 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('837', '1', '09cba516-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 5.8 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('838', '1', '09cc2539-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 5.8 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('839', '1', '09ccb860-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 5.9 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('840', '1', '09cd52e2-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 5.9 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('841', '1', '0c0e7050-fb87-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 6 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('842', '1', '0c0e8466-fb87-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 6 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('843', '1', '09b613d5-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 6.0 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('844', '1', '09b69213-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 6.0 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('845', '1', '09cdd0b1-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 6.1 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('846', '1', '09ce0ca3-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 6.1 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('847', '1', '09ce8b85-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 6.2 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('848', '1', '09cf0d62-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 6.2 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('849', '1', '09cf48d6-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 6.3 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('850', '1', '09cfea4e-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 6.3 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('851', '1', '09d0590e-fb86-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 6.4 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('852', '1', '051a13c3-fb87-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 6.4 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('853', '1', '0dbe1089-fb87-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 6.5 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('854', '1', '0dbe18ee-fb87-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 6.5 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('855', '1', '0c0ec50b-fb87-11e4-a0f4-d6ed8d2c551f', '09589cb5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Red Hat Enterprise Linux 7');
INSERT INTO `cloud_ostype` VALUES ('856', '1', '09a1f0c5-fb86-11e4-a0f4-d6ed8d2c551f', '095a7e68-fb86-11e4-a0f4-d6ed8d2c551f', null, 'SCO OpenServer 5');
INSERT INTO `cloud_ostype` VALUES ('857', '1', '09a26a03-fb86-11e4-a0f4-d6ed8d2c551f', '095a7e68-fb86-11e4-a0f4-d6ed8d2c551f', null, 'SCO UnixWare 7');
INSERT INTO `cloud_ostype` VALUES ('858', '1', '099f9b0d-fb86-11e4-a0f4-d6ed8d2c551f', '095a7e68-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Sun Solaris 10(32-bit)');
INSERT INTO `cloud_ostype` VALUES ('859', '1', '09a00cee-fb86-11e4-a0f4-d6ed8d2c551f', '095a7e68-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Sun Solaris 10(64-bit)');
INSERT INTO `cloud_ostype` VALUES ('860', '1', '09bf325b-fb86-11e4-a0f4-d6ed8d2c551f', '095a7e68-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Sun Solaris 11 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('861', '1', '09beb828-fb86-11e4-a0f4-d6ed8d2c551f', '095a7e68-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Sun Solaris 11 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('862', '1', '09a0b063-fb86-11e4-a0f4-d6ed8d2c551f', '095a7e68-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Sun Solaris 8(Experimental)');
INSERT INTO `cloud_ostype` VALUES ('863', '1', '09a0414e-fb86-11e4-a0f4-d6ed8d2c551f', '095a7e68-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Sun Solaris 9(Experimental)');
INSERT INTO `cloud_ostype` VALUES ('864', '1', '09ab964d-fb86-11e4-a0f4-d6ed8d2c551f', '0958d31a-fb86-11e4-a0f4-d6ed8d2c551f', null, 'SUSE Linux Enterprise 10(32-bit)');
INSERT INTO `cloud_ostype` VALUES ('865', '1', '09abcfa9-fb86-11e4-a0f4-d6ed8d2c551f', '0958d31a-fb86-11e4-a0f4-d6ed8d2c551f', null, 'SUSE Linux Enterprise 10(64-bit)');
INSERT INTO `cloud_ostype` VALUES ('866', '1', '09a654f5-fb86-11e4-a0f4-d6ed8d2c551f', '0958d31a-fb86-11e4-a0f4-d6ed8d2c551f', null, 'SUSE Linux Enterprise 8(32-bit)');
INSERT INTO `cloud_ostype` VALUES ('867', '1', '09a6d29e-fb86-11e4-a0f4-d6ed8d2c551f', '0958d31a-fb86-11e4-a0f4-d6ed8d2c551f', null, 'SUSE Linux Enterprise 8(64-bit)');
INSERT INTO `cloud_ostype` VALUES ('868', '1', '09aaa1fd-fb86-11e4-a0f4-d6ed8d2c551f', '0958d31a-fb86-11e4-a0f4-d6ed8d2c551f', null, 'SUSE Linux Enterprise 9(32-bit)');
INSERT INTO `cloud_ostype` VALUES ('869', '1', '09ab1a6a-fb86-11e4-a0f4-d6ed8d2c551f', '0958d31a-fb86-11e4-a0f4-d6ed8d2c551f', null, 'SUSE Linux Enterprise 9(64-bit)');
INSERT INTO `cloud_ostype` VALUES ('870', '1', '098ad263-fb86-11e4-a0f4-d6ed8d2c551f', '0958d31a-fb86-11e4-a0f4-d6ed8d2c551f', null, 'SUSE Linux Enterprise Server 10 SP1 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('871', '1', '098b6ce8-fb86-11e4-a0f4-d6ed8d2c551f', '0958d31a-fb86-11e4-a0f4-d6ed8d2c551f', null, 'SUSE Linux Enterprise Server 10 SP1 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('872', '1', '098bf011-fb86-11e4-a0f4-d6ed8d2c551f', '0958d31a-fb86-11e4-a0f4-d6ed8d2c551f', null, 'SUSE Linux Enterprise Server 10 SP2 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('873', '1', '098c28af-fb86-11e4-a0f4-d6ed8d2c551f', '0958d31a-fb86-11e4-a0f4-d6ed8d2c551f', null, 'SUSE Linux Enterprise Server 10 SP2 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('874', '1', '09bbc6f8-fb86-11e4-a0f4-d6ed8d2c551f', '0958d31a-fb86-11e4-a0f4-d6ed8d2c551f', null, 'SUSE Linux Enterprise Server 10 SP3 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('875', '1', '098ca29c-fb86-11e4-a0f4-d6ed8d2c551f', '0958d31a-fb86-11e4-a0f4-d6ed8d2c551f', null, 'SUSE Linux Enterprise Server 10 SP3 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('876', '1', '09bcbd00-fb86-11e4-a0f4-d6ed8d2c551f', '0958d31a-fb86-11e4-a0f4-d6ed8d2c551f', null, 'SUSE Linux Enterprise Server 10 SP4 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('877', '1', '09bc40d0-fb86-11e4-a0f4-d6ed8d2c551f', '0958d31a-fb86-11e4-a0f4-d6ed8d2c551f', null, 'SUSE Linux Enterprise Server 10 SP4 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('878', '1', '098d1b09-fb86-11e4-a0f4-d6ed8d2c551f', '0958d31a-fb86-11e4-a0f4-d6ed8d2c551f', null, 'SUSE Linux Enterprise Server 11 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('879', '1', '098d530a-fb86-11e4-a0f4-d6ed8d2c551f', '0958d31a-fb86-11e4-a0f4-d6ed8d2c551f', null, 'SUSE Linux Enterprise Server 11 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('880', '1', '09bd8842-fb86-11e4-a0f4-d6ed8d2c551f', '0958d31a-fb86-11e4-a0f4-d6ed8d2c551f', null, 'SUSE Linux Enterprise Server 11 SP1 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('881', '1', '09bd4fb6-fb86-11e4-a0f4-d6ed8d2c551f', '0958d31a-fb86-11e4-a0f4-d6ed8d2c551f', null, 'SUSE Linux Enterprise Server 11 SP1 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('882', '1', '09c9bc5e-fb86-11e4-a0f4-d6ed8d2c551f', '0958d31a-fb86-11e4-a0f4-d6ed8d2c551f', null, 'SUSE Linux Enterprise Server 11 SP2 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('883', '1', '09c98597-fb86-11e4-a0f4-d6ed8d2c551f', '0958d31a-fb86-11e4-a0f4-d6ed8d2c551f', null, 'SUSE Linux Enterprise Server 11 SP2 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('884', '1', '09cabcd3-fb86-11e4-a0f4-d6ed8d2c551f', '0958d31a-fb86-11e4-a0f4-d6ed8d2c551f', null, 'SUSE Linux Enterprise Server 11 SP3 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('885', '1', '09ca3e53-fb86-11e4-a0f4-d6ed8d2c551f', '0958d31a-fb86-11e4-a0f4-d6ed8d2c551f', null, 'SUSE Linux Enterprise Server 11 SP3 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('886', '1', '0c0eb045-fb87-11e4-a0f4-d6ed8d2c551f', '0958d31a-fb86-11e4-a0f4-d6ed8d2c551f', null, 'SUSE Linux Enterprise Server 12 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('887', '1', '098a4e19-fb86-11e4-a0f4-d6ed8d2c551f', '0958d31a-fb86-11e4-a0f4-d6ed8d2c551f', null, 'SUSE Linux Enterprise Server 9 SP4 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('888', '1', '09b00ca1-fb86-11e4-a0f4-d6ed8d2c551f', '095ab3f5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Ubuntu 10.04 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('889', '1', '09b1f239-fb86-11e4-a0f4-d6ed8d2c551f', '095ab3f5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Ubuntu 10.04 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('890', '1', '09be02db-fb86-11e4-a0f4-d6ed8d2c551f', '095ab3f5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Ubuntu 10.10 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('891', '1', '09be816c-fb86-11e4-a0f4-d6ed8d2c551f', '095ab3f5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Ubuntu 10.10 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('892', '1', '09c3025c-fb86-11e4-a0f4-d6ed8d2c551f', '095ab3f5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Ubuntu 11.04 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('893', '1', '09c37ed8-fb86-11e4-a0f4-d6ed8d2c551f', '095ab3f5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Ubuntu 11.04 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('894', '1', '09c09fbf-fb86-11e4-a0f4-d6ed8d2c551f', '095ab3f5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Ubuntu 12.04 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('895', '1', '09c12093-fb86-11e4-a0f4-d6ed8d2c551f', '095ab3f5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Ubuntu 12.04 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('896', '1', '0c0e9a18-fb87-11e4-a0f4-d6ed8d2c551f', '095ab3f5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Ubuntu 14.04 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('897', '1', '0c0fc5dd-fb87-11e4-a0f4-d6ed8d2c551f', '095ab3f5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Ubuntu 14.04 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('898', '1', '09b1b56e-fb86-11e4-a0f4-d6ed8d2c551f', '095ab3f5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Ubuntu 8.04 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('899', '1', '09b3a93a-fb86-11e4-a0f4-d6ed8d2c551f', '095ab3f5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Ubuntu 8.04 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('900', '1', '09b1396d-fb86-11e4-a0f4-d6ed8d2c551f', '095ab3f5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Ubuntu 8.10 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('901', '1', '09b31eea-fb86-11e4-a0f4-d6ed8d2c551f', '095ab3f5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Ubuntu 8.10 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('902', '1', '09b0bd6b-fb86-11e4-a0f4-d6ed8d2c551f', '095ab3f5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Ubuntu 9.04 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('903', '1', '09b2e813-fb86-11e4-a0f4-d6ed8d2c551f', '095ab3f5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Ubuntu 9.04 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('904', '1', '09b086bc-fb86-11e4-a0f4-d6ed8d2c551f', '095ab3f5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Ubuntu 9.10 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('905', '1', '09b26d47-fb86-11e4-a0f4-d6ed8d2c551f', '095ab3f5-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Ubuntu 9.10 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('906', '1', '09a5caad-fb86-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Windows 2000 Advanced Server');
INSERT INTO `cloud_ostype` VALUES ('907', '1', '09a9f234-fb86-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Windows 2000 Professional');
INSERT INTO `cloud_ostype` VALUES ('908', '1', '09937335-fb86-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Windows 2000 Server');
INSERT INTO `cloud_ostype` VALUES ('909', '1', '0990fe33-fb86-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Windows 2000 Server SP4 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('910', '1', '09951a70-fb86-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Windows 3.1');
INSERT INTO `cloud_ostype` VALUES ('911', '1', '098dead9-fb86-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Windows 7 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('912', '1', '098e6ab3-fb86-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Windows 7 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('913', '1', '09c19e6e-fb86-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Windows 8 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('914', '1', '09c1d526-fb86-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Windows 8 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('915', '1', '0a344378-fb87-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Windows 8.1 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('916', '1', '0a342ea9-fb87-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Windows 8.1 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('917', '1', '09946a64-fb86-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Windows 95');
INSERT INTO `cloud_ostype` VALUES ('918', '1', '0993efb6-fb86-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Windows 98');
INSERT INTO `cloud_ostype` VALUES ('919', '1', '0994a26d-fb86-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Windows NT 4');
INSERT INTO `cloud_ostype` VALUES ('920', '1', '09bf7243-fb86-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Windows PV');
INSERT INTO `cloud_ostype` VALUES ('921', '1', '09a2a1ad-fb86-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Windows Server 2003 DataCenter Edition(32-bit)');
INSERT INTO `cloud_ostype` VALUES ('922', '1', '09a31d12-fb86-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Windows Server 2003 DataCenter Edition(64-bit)');
INSERT INTO `cloud_ostype` VALUES ('923', '1', '098eeb57-fb86-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Windows Server 2003 Enterprise Edition(32-bit)');
INSERT INTO `cloud_ostype` VALUES ('924', '1', '098f24f1-fb86-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Windows Server 2003 Enterprise Edition(64-bit)');
INSERT INTO `cloud_ostype` VALUES ('925', '1', '09a353d0-fb86-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Windows Server 2003 Standard Edition(32-bit)');
INSERT INTO `cloud_ostype` VALUES ('926', '1', '09a3d9d1-fb86-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Windows Server 2003 Standard Edition(64-bit)');
INSERT INTO `cloud_ostype` VALUES ('927', '1', '09a45667-fb86-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Windows Server 2003 Web Edition');
INSERT INTO `cloud_ostype` VALUES ('928', '1', '098fad40-fb86-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Windows Server 2008 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('929', '1', '09903ce9-fb86-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Windows Server 2008 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('930', '1', '0990c4b0-fb86-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Windows Server 2008 R2 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('931', '1', '09c24fdc-fb86-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Windows Server 2012 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('932', '1', '09a39565-fb87-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Windows Server 2012 R2 (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('933', '1', '09917ba0-fb86-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Windows Vista (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('934', '1', '09a8303e-fb86-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Windows Vista (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('935', '1', '09a50990-fb86-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Windows XP (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('936', '1', '09a59333-fb86-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Windows XP (64-bit)');
INSERT INTO `cloud_ostype` VALUES ('937', '1', '0991f3c0-fb86-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Windows XP SP2 (32-bit)');
INSERT INTO `cloud_ostype` VALUES ('938', '1', '09922ca1-fb86-11e4-a0f4-d6ed8d2c551f', '09594d06-fb86-11e4-a0f4-d6ed8d2c551f', null, 'Windows XP SP3 (32-bit)');

-- ----------------------------
-- Table structure for cloud_region
-- ----------------------------
DROP TABLE IF EXISTS `cloud_region`;
CREATE TABLE `cloud_region` (
  `col_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `col_region_id` char(64) DEFAULT NULL COMMENT '云平台区域ID',
  `col_cloud_id` int(11) unsigned DEFAULT NULL COMMENT '云平台ID',
  `col_name` varchar(1024) DEFAULT NULL COMMENT '区域名称',
  `col_desc` text COMMENT '区域描述',
  PRIMARY KEY (`col_id`),
  KEY `FK_cloud_region_cloud` (`col_cloud_id`),
  KEY `col_region_id` (`col_region_id`),
  CONSTRAINT `FK_cloud_region_cloud` FOREIGN KEY (`col_cloud_id`) REFERENCES `cloud` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='云平台区域描述';

-- ----------------------------
-- Records of cloud_region
-- ----------------------------
INSERT INTO `cloud_region` VALUES ('1', null, '1', '本地区', '本地亚洲区');
INSERT INTO `cloud_region` VALUES ('2', '6ab061f3-15b9-4c32-8f9a-125add20fffc', '2', 'region测试', '这个是一个region测试');
INSERT INTO `cloud_region` VALUES ('3', '82D9CB7B-8823-5D76-4C24-4FE442DD0C99', '1', 'regin1', '是个帅哥');

-- ----------------------------
-- Table structure for cloud_snapshot
-- ----------------------------
DROP TABLE IF EXISTS `cloud_snapshot`;
CREATE TABLE `cloud_snapshot` (
  `col_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `col_snapshot_id` char(64) DEFAULT NULL COMMENT '云平台内部快照id',
  `col_volume_id` int(11) unsigned DEFAULT NULL,
  `col_name` char(50) DEFAULT NULL,
  `col_desc` varchar(1024) DEFAULT NULL,
  `col_datetime` datetime DEFAULT NULL,
  `col_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`col_id`),
  KEY `FK_cloud_snapshot_cloud_volume` (`col_volume_id`),
  CONSTRAINT `FK_cloud_snapshot_cloud_volume` FOREIGN KEY (`col_volume_id`) REFERENCES `cloud_volume` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='虚机快照';

-- ----------------------------
-- Records of cloud_snapshot
-- ----------------------------
INSERT INTO `cloud_snapshot` VALUES ('7', '65fb566c-dbf3-4e58-89fd-49b66f3a9d95', null, 'test_ROOT-98_20150403093902', 'ROOT', '2015-04-03 17:39:02', '2015-04-10 17:56:54');
INSERT INTO `cloud_snapshot` VALUES ('8', '8ec1c7df-4bfc-41cf-9b23-0bdccc4289af', '3', 'test001_ROOT-114_20150403081758', 'ROOT', '2015-04-03 16:17:58', '2015-04-10 17:56:54');

-- ----------------------------
-- Table structure for cloud_template
-- ----------------------------
DROP TABLE IF EXISTS `cloud_template`;
CREATE TABLE `cloud_template` (
  `col_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增',
  `col_template_id` char(64) DEFAULT NULL COMMENT '模板id',
  `col_zone_id` int(11) unsigned DEFAULT NULL COMMENT '管理员维护',
  `col_ostype_id` int(11) unsigned DEFAULT NULL,
  `col_snapshot_id` int(11) unsigned DEFAULT NULL,
  `col_user_id` int(11) unsigned DEFAULT NULL,
  `col_type` char(50) DEFAULT NULL COMMENT '创建用户',
  `col_date` datetime DEFAULT NULL COMMENT '创建日期',
  `col_price` decimal(10,2) DEFAULT NULL COMMENT '价格，单位周',
  `col_status_code` char(20) DEFAULT NULL COMMENT '模板状态',
  `col_order` int(11) DEFAULT NULL,
  `col_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`col_id`),
  KEY `FK_template_template` (`col_template_id`),
  KEY `FK_template_base_region` (`col_zone_id`),
  KEY `FK_cloud_template_cloud_ostype` (`col_ostype_id`),
  KEY `FK_cloud_template_cloud_snapshot` (`col_snapshot_id`),
  KEY `FK_cloud_template_user` (`col_user_id`),
  KEY `col_status_code` (`col_status_code`),
  CONSTRAINT `col_status_code` FOREIGN KEY (`col_status_code`) REFERENCES `vm_status` (`col_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_cloud_template_cloud_ostype` FOREIGN KEY (`col_ostype_id`) REFERENCES `cloud_ostype` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_cloud_template_cloud_snapshot` FOREIGN KEY (`col_snapshot_id`) REFERENCES `cloud_snapshot` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_cloud_template_user` FOREIGN KEY (`col_user_id`) REFERENCES `user` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_template_base_region` FOREIGN KEY (`col_zone_id`) REFERENCES `cloud_zone` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='镜像模板';

-- ----------------------------
-- Records of cloud_template
-- ----------------------------
INSERT INTO `cloud_template` VALUES ('1', '728b9ee3-03a6-479e-8786-e3a2babb8a2a', '1', '914', null, '2', 'USER', null, null, null, null, '2015-06-01 22:50:52', '0');
INSERT INTO `cloud_template` VALUES ('2', '728b9ee3-03a6-479e-8786-e3a2babb8a2a', '1', '914', null, '8', 'USER', null, null, null, null, '2015-06-01 22:50:49', '0');
INSERT INTO `cloud_template` VALUES ('3', '728b9ee3-03a6-479e-8786-e3a2babb8a2a', '1', '914', null, '8', 'USER', null, null, null, null, '2015-06-01 22:50:46', '0');
INSERT INTO `cloud_template` VALUES ('4', '728b9ee3-03a6-479e-8786-e3a2babb8a2a', '1', '914', null, '8', 'USER', null, null, null, null, '2015-06-01 22:50:44', '0');
INSERT INTO `cloud_template` VALUES ('5', '728b9ee3-03a6-479e-8786-e3a2babb8a2a', '1', '914', null, '8', 'USER', null, null, null, null, '2015-06-01 22:50:43', '0');
INSERT INTO `cloud_template` VALUES ('6', '728b9ee3-03a6-479e-8786-e3a2babb8a2a', '1', '914', null, '8', 'USER', null, null, null, null, '2015-06-01 22:50:40', '0');
INSERT INTO `cloud_template` VALUES ('7', '728b9ee3-03a6-479e-8786-e3a2babb8a2a', '1', '914', null, '8', 'USER', null, null, null, null, '2015-06-01 22:50:38', '0');
INSERT INTO `cloud_template` VALUES ('9', '728b9ee3-03a6-479e-8786-e3a2babb8a2a', '1', '914', null, '8', 'USER', null, null, 'Starting', null, '2015-06-01 22:50:36', '0');
INSERT INTO `cloud_template` VALUES ('10', '728b9ee3-03a6-479e-8786-e3a2babb8a2a', '1', '914', null, '8', 'USER', null, null, 'Starting', null, '2015-06-01 22:50:34', '0');
INSERT INTO `cloud_template` VALUES ('11', '728b9ee3-03a6-479e-8786-e3a2babb8a2a', '1', '914', null, '8', 'USER', null, null, 'Starting', null, '2015-06-01 22:50:31', '0');
INSERT INTO `cloud_template` VALUES ('12', '728b9ee3-03a6-479e-8786-e3a2babb8a2a', '1', '914', null, '8', 'USER', null, null, 'Starting', null, '2015-06-01 22:46:30', '0');

-- ----------------------------
-- Table structure for cloud_vmsnapshot
-- ----------------------------
DROP TABLE IF EXISTS `cloud_vmsnapshot`;
CREATE TABLE `cloud_vmsnapshot` (
  `col_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `col_snapshot_id` char(64) DEFAULT NULL COMMENT '云平台内部快照id',
  `col_vm_id` int(11) unsigned DEFAULT NULL,
  `col_name` char(50) DEFAULT NULL,
  `col_desc` varchar(1024) DEFAULT NULL,
  `col_datetime` datetime DEFAULT NULL,
  `col_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`col_id`),
  KEY `FK_cloud_vmsnapshot_vm` (`col_vm_id`),
  CONSTRAINT `FK_cloud_vmsnapshot_vm` FOREIGN KEY (`col_vm_id`) REFERENCES `vm` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='虚机快照';

-- ----------------------------
-- Records of cloud_vmsnapshot
-- ----------------------------

-- ----------------------------
-- Table structure for cloud_volume
-- ----------------------------
DROP TABLE IF EXISTS `cloud_volume`;
CREATE TABLE `cloud_volume` (
  `col_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `col_volume_id` char(64) DEFAULT NULL,
  `col_vm_id` int(11) unsigned DEFAULT NULL,
  `col_diskoffering_id` int(11) unsigned DEFAULT NULL,
  `col_name` char(50) DEFAULT NULL,
  `col_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`col_id`),
  KEY `FK_cloud_volume_vm` (`col_vm_id`),
  KEY `FK_cloud_volume_cloud_diskoffering` (`col_diskoffering_id`),
  CONSTRAINT `FK_cloud_volume_cloud_diskoffering` FOREIGN KEY (`col_diskoffering_id`) REFERENCES `cloud_diskoffering` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_cloud_volume_vm` FOREIGN KEY (`col_vm_id`) REFERENCES `vm` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='磁盘卷';

-- ----------------------------
-- Records of cloud_volume
-- ----------------------------
INSERT INTO `cloud_volume` VALUES ('1', 'e5f96e32-354a-4081-8630-08e97c9ccdbf', null, '4', 'DATA-114', '2015-04-10 17:32:12');
INSERT INTO `cloud_volume` VALUES ('2', '9476dbb1-52f3-4ba8-9082-94bcc9f309ed', null, '4', 'DATA-98', '2015-04-10 17:32:12');
INSERT INTO `cloud_volume` VALUES ('3', 'db1a2052-9585-49b8-8aac-5c99d13442c3', null, null, 'ROOT-114', '2015-04-10 17:32:12');
INSERT INTO `cloud_volume` VALUES ('4', 'c954cc5d-8602-4f7e-a775-4b5f19d2845b', null, '4', 'DATA-113', '2015-04-10 17:32:12');
INSERT INTO `cloud_volume` VALUES ('5', 'fcd7ac62-e47a-4f7e-b4fe-7e55f4c9c34e', null, '4', 'DATA-33', '2015-04-10 17:32:12');
INSERT INTO `cloud_volume` VALUES ('6', 'b741596b-f1d7-413e-b071-af7933442665', null, null, 'ROOT-110', '2015-04-10 17:32:12');
INSERT INTO `cloud_volume` VALUES ('7', 'c7a2a5f5-2dd4-4876-8fcb-78a1daf04dde', null, '1', 'DATA-109', '2015-04-10 17:32:12');
INSERT INTO `cloud_volume` VALUES ('8', '624646d0-c3b1-4ecb-a5ab-f991745ab9db', null, '1', 'DATA-107', '2015-04-10 17:32:12');
INSERT INTO `cloud_volume` VALUES ('9', 'e39a114b-a9be-4f06-826d-edf0b3606318', null, '1', 'DATA-27', '2015-04-10 17:32:12');
INSERT INTO `cloud_volume` VALUES ('10', 'ea567a2b-4479-4cea-91b7-d9f8ecd91c6c', null, '4', 'DATA-104', '2015-04-10 17:32:12');
INSERT INTO `cloud_volume` VALUES ('11', 'bde0e851-371d-40c0-9855-8999599fa3c1', null, '4', 'DATA-24', '2015-04-10 17:32:12');
INSERT INTO `cloud_volume` VALUES ('12', '13cd0ad0-6202-438e-b4cd-6b866b5baafb', null, '1', 'DATA-37', '2015-04-10 17:32:12');

-- ----------------------------
-- Table structure for cloud_zone
-- ----------------------------
DROP TABLE IF EXISTS `cloud_zone`;
CREATE TABLE `cloud_zone` (
  `col_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `col_zone_id` char(64) NOT NULL COMMENT '数据中心ID',
  `col_region_id` int(11) unsigned NOT NULL COMMENT '云平台区域ID',
  `col_name` varchar(1024) NOT NULL COMMENT '数据中心名称',
  `col_desc` text NOT NULL COMMENT '数据中心详细描述',
  PRIMARY KEY (`col_id`),
  KEY `FK_zone_cloud` (`col_region_id`),
  KEY `col_zone_id` (`col_zone_id`),
  CONSTRAINT `FK_zone_cloud` FOREIGN KEY (`col_region_id`) REFERENCES `cloud_region` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='数据中心列表';

-- ----------------------------
-- Records of cloud_zone
-- ----------------------------
INSERT INTO `cloud_zone` VALUES ('1', '6ab061f3-15b9-4c32-8f9a-125add20fffb', '1', 'zone1', '');
INSERT INTO `cloud_zone` VALUES ('2', '6ab061f3-15b9-4c32-8f9a-125add20fffb', '2', 'zone测试', '这是一个zone测试');

-- ----------------------------
-- Table structure for config
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `key` char(50) NOT NULL,
  `value` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='全局配置表';

-- ----------------------------
-- Records of config
-- ----------------------------
INSERT INTO `config` VALUES ('cloud_max_cpunumber', '8');
INSERT INTO `config` VALUES ('cloud_max_disksize', '500');
INSERT INTO `config` VALUES ('cloud_max_memory', '8');
INSERT INTO `config` VALUES ('cloud_max_rootdisksize', '20');
INSERT INTO `config` VALUES ('cloud_max_vm', '10');
INSERT INTO `config` VALUES ('default_zoneid', null);
INSERT INTO `config` VALUES ('vm_pool_size', '10');

-- ----------------------------
-- Table structure for game
-- ----------------------------
DROP TABLE IF EXISTS `game`;
CREATE TABLE `game` (
  `col_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增',
  `col_name` char(100) NOT NULL COMMENT '游戏名称',
  `col_alias` char(100) DEFAULT NULL COMMENT '游戏别名',
  `col_pinyin_jp` char(100) DEFAULT NULL COMMENT 'col_name的简音',
  `col_pinyin_qp` char(100) DEFAULT NULL COMMENT 'col_name的全音',
  `col_ttype` char(50) NOT NULL COMMENT '终端类型，页游、手游、端游',
  `col_gtype` char(50) DEFAULT NULL COMMENT '游戏类型，比如角色扮演、战争策略、休闲娱乐',
  `col_version` char(50) DEFAULT NULL COMMENT '版本号',
  `col_subversion` char(50) DEFAULT NULL COMMENT '子版本号',
  `col_desc` varchar(10000) DEFAULT NULL COMMENT '游戏简介',
  `col_pic` varchar(100) DEFAULT NULL COMMENT '图片URL',
  `col_developer` char(50) DEFAULT NULL COMMENT '游戏的开发商',
  `col_operator` char(50) DEFAULT NULL COMMENT '游戏的运营商',
  `col_date` year(4) DEFAULT NULL COMMENT '游戏的发表或者开始运营日期',
  `col_valid` enum('Y','N') NOT NULL DEFAULT 'Y' COMMENT '是否显示',
  `col_priority` tinyint(4) NOT NULL DEFAULT '1' COMMENT '游戏的优先级',
  PRIMARY KEY (`col_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='游戏列表';

-- ----------------------------
-- Records of game
-- ----------------------------
INSERT INTO `game` VALUES ('1', '英雄联盟', 'LOL', null, null, '端游', '电子竞技', null, null, '《英雄联盟》（简称lol）是由美国Riot Games开发，腾讯游戏运营的英雄对战网游。《英雄联盟》除了即时战略、团队作战外，还拥有特色的英雄、自动匹配的战网平台，包括天赋树、召唤师系统、符文等元素。', '/images/lol.jpg', null, null, null, 'Y', '1');
INSERT INTO `game` VALUES ('2', '永恒之塔', 'Aion', null, null, '端游', '角色扮演', null, null, '《Aion：The Tower Of Eternity》是韩国第一网游巨头NCsoft投入了所有韩国国内网游研发精英，精心打磨制作的新一代奇幻MMORPG，是一款集NCsoft开发实力之大成的产品。', '/images/aion.jpg', null, null, null, 'Y', '1');
INSERT INTO `game` VALUES ('3', '穿越火线', 'CF', null, null, '端游', '射击竞技', null, null, '《穿越火线》（Cross Fire，简称CF）由韩国Smile Gate开发，在韩国由Neowiz发行，在中国大陆由腾讯公司运营。\r\n《穿越火线》是一款第一人称射击游戏的网络游戏，玩家扮演控制一名持枪战斗人员，与其他玩家进行械斗。', '/images/cf.jpg', null, null, null, 'Y', '1');
INSERT INTO `game` VALUES ('4', '部落冲突', 'Clash of Clans', null, null, '手游', '战略游戏', null, null, '《部落冲突》（部落战争）是为芬兰游戏公司Supercell所推出的策略类手机游戏，于2012年8月2日在苹果应用商店发布。\r\n该游戏以策略战争为主题，通过经营自己的村庄，玩家可逐渐强大兵力，进而成千上万的玩家进行战斗。[1] 村庄到达一定等级后，还可与其他村庄结成部落，进行部落间的战斗。\r\n其内容兼具攻、守城及养成元素，玩家于一开始时只有“建筑工人小屋”及各一座等级1的“大本营”、“金矿”、“兵营”以及各750点的“圣水”和“黄金”，第一次进入游戏会进入引导模式让玩家了解此游戏的建造、升级、提速及解锁的方式。随着游戏的进行，到了后期重心将会由单人模式移至多人模式。 2013年9月30日该游戏的安卓版在芬兰和加拿大率先推出，2013年10月7日Supercell在世界其他国家的 Google Play市场推出了该游戏。', '/images/blct.jpg', null, null, null, 'Y', '1');
INSERT INTO `game` VALUES ('5', '大天使之剑', 'DTS', null, null, '页游', 'ARPG', null, null, '《大天使之剑》是一款西方魔幻题材ARPG网页游戏。', '/images/dts.jpg', null, null, null, 'Y', '1');
INSERT INTO `game` VALUES ('6', '斗战神', 'Asura', null, null, '端游', 'MMORPG', null, null, '《斗战神》是腾讯旗下量子工作室开发，腾讯游戏运营的一款大型多人在线角色扮演游戏。[1] \r\n该游戏属于暗黑类型网游，采用自主研发的AGE引擎制作，为玩家创造极致的战斗体验。\r\n《斗战神》以今何在的小说《悟空传》为背景蓝本，游戏剧情原汁原味地呈现了小说的感染力，是该游戏的一大特色', '/images/dzs.jpg', null, null, null, 'Y', '1');

-- ----------------------------
-- Table structure for game_script
-- ----------------------------
DROP TABLE IF EXISTS `game_script`;
CREATE TABLE `game_script` (
  `col_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增',
  `col_name` char(50) DEFAULT NULL COMMENT '脚本名称',
  `col_author_id` int(11) unsigned DEFAULT NULL COMMENT '作者id',
  `col_url` varchar(1024) DEFAULT NULL COMMENT '脚本地址',
  `col_intro` varchar(1024) DEFAULT NULL COMMENT '简介',
  `col_desc` text COMMENT '描述url',
  `col_game_id` int(11) unsigned DEFAULT NULL COMMENT '游戏id',
  `col_version` char(50) DEFAULT NULL COMMENT '脚本版本',
  `col_os` char(50) DEFAULT NULL COMMENT '操作系统',
  `col_resolution` char(50) DEFAULT NULL COMMENT '分辨率',
  `col_color` tinyint(4) DEFAULT NULL COMMENT '色深',
  `col_theme` char(50) DEFAULT NULL COMMENT '主题',
  `col_font` char(50) DEFAULT NULL COMMENT '字体',
  `col_ishoutai` enum('Y','N') DEFAULT NULL COMMENT '是否支持后台运行',
  `col_isduokai` enum('Y','N') DEFAULT NULL COMMENT '是否支持多开',
  `col_hot` enum('N','Y') DEFAULT 'N' COMMENT '是否推荐',
  `col_date` datetime DEFAULT NULL COMMENT '上传日期',
  `col_error` varchar(1024) DEFAULT NULL,
  `col_status` tinyint(11) unsigned NOT NULL DEFAULT '0' COMMENT '是否审核0未审核,1审核中,2审核通过,3审核未通过',
  PRIMARY KEY (`col_id`),
  KEY `FK_gmae_script_user` (`col_author_id`),
  KEY `FK_gmae_script_game` (`col_game_id`),
  CONSTRAINT `FK_gmae_script_game` FOREIGN KEY (`col_game_id`) REFERENCES `game` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_gmae_script_user` FOREIGN KEY (`col_author_id`) REFERENCES `user` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='游戏脚本列表';

-- ----------------------------
-- Records of game_script
-- ----------------------------
INSERT INTO `game_script` VALUES ('1', '英雄联盟刷金币', '2', null, '', '★全智能AI★全后台★全地图★全英雄★日入3500+金★普通人机五杀★\r\n\r\n2015新脚本 虚拟机1G内 存也流畅稳定 智能地图,最高效率(首胜,人机奖励,匹配奖励).\r\n\r\n伪装玩家操作(换线-装备-技能-喊话-队友信号-防守基地)\r\n\r\n完全不用设置.简单选择 \"智能模式\" 一键搞定.', '1', null, null, null, null, null, null, 'N', 'N', 'Y', '2015-05-21 15:13:44', null, '0');
INSERT INTO `game_script` VALUES ('2', '热带鱼国服版1218【自动升级】', '2', null, null, '√自动升级+转职√自动存仓√怪物过滤√PK黑名单√批量交换√精灵支持√定点挂机√路径挂机√完美技能√自动出售√无遗漏清包√卡等级√挂机喊话√智能变换√智能分解√24小时无人值守稳定挂机', '2', null, null, null, null, '', null, 'Y', 'Y', 'Y', '2015-05-21 15:13:50', null, '0');
INSERT INTO `game_script` VALUES ('4', 'ＣＦ自动瞄准｜锁定跟踪｜稳定ＡＣＥ｜高效射击爆头', '8', null, null, '自动瞄准：准星一直瞄准敌人，无论敌人如何跑动准星都一直锁定跟踪，一开枪就毙命\r\n喷血秒杀：击中敌人会流血，能增强子弹的威力，此功能为武器工厂独家功能，简单游独有', '3', null, null, null, null, null, null, 'N', 'Y', 'Y', '2015-05-07 15:13:53', null, '0');
INSERT INTO `game_script` VALUES ('5', '部落冲突挂机神器V1', '8', null, null, '模拟操作，保持游戏持续在线，防止下线遭到攻击，实现部落冲突挂机', '4', null, null, null, null, null, null, 'Y', 'N', 'N', '2015-05-21 15:13:59', null, '0');
INSERT INTO `game_script` VALUES ('6', ' nieshe大天使之剑多开2.60', '8', null, null, '可最小化、可隐藏、换号、倒货、主线1-500、智力MM、神庙、日常任务、提前守候BOSS、断线重连、祈愿、换装、加点、副本、签到、自动挂机、死亡返回、拾取、清理、买药、24小时循环挂机、主线日常挂机完美兼容、循环不停、其他功能陆续添加...', '5', null, null, null, null, null, null, 'Y', 'Y', 'Y', '2015-05-28 15:14:03', null, '0');
INSERT INTO `game_script` VALUES ('7', '勤劳机器人、主线、打怪、拍卖行、副本、采集、单开', '8', null, null, 'V2.1g√自动做日常(活跃累积95点)√最完善技能释放√挖宝√1-19主线√副本单刷和组队√自动采集【快的不可思议】无精力邮寄、换角色√自动收邮件，汲灵，分解√存仓卖物分解√过滤捡物√同步器√自动副本√扫描拍卖行√智能打怪√pk助手√更多功能√', '6', null, null, null, null, null, null, 'N', 'N', 'Y', '2015-05-30 15:14:08', null, '0');
INSERT INTO `game_script` VALUES ('8', '自动刷野,自动人机', '8', 'df13f2ccd3b5c15072d29e61b5699d28.jpg', null, '自动刷野,自动人机自动刷野,自动人机自动刷野,自动人机自动刷野,自动人机自动刷野,自动人机自动刷野,自动人机自动刷野,自动人机自动刷野,自动人机自动刷野,自动人机', '1', null, null, null, null, null, null, 'N', 'N', 'N', '2015-05-18 18:29:49', null, '0');
INSERT INTO `game_script` VALUES ('11', '自动瞄准自动跟人', '8', 'c3dfa012701be96de45613327556a66d.zip', null, '自动瞄准自动瞄准自动瞄准自动瞄准自动瞄准自动瞄准自动瞄准自动瞄准自动瞄准自动瞄准自动瞄准自动瞄准自动瞄准自动瞄准自动瞄准自动瞄准', '1', null, null, null, null, null, null, 'N', 'N', 'N', '2015-05-18 18:29:45', null, '0');
INSERT INTO `game_script` VALUES ('12', '无限挂机无限挂机', '8', '9ad88206aa7cb52f24554b37ba192e39.zip', null, '无限挂机无限挂机无限挂机无限挂机无限挂机无限挂机无限挂机无限挂机无限挂机无限挂机无限挂机无限挂机', '4', null, null, null, null, null, null, 'N', 'N', 'N', '2015-05-19 23:05:12', null, '2');
INSERT INTO `game_script` VALUES ('13', '自动升级打怪', '8', 'b27deb45edc7be3711e178da9437fb0a.zip', null, '自动升级打怪自动升级打怪自动升级打怪自动升级打怪自动升级打怪自动升级打怪自动升级打怪自动升级打怪自动升级打怪自动升级打怪自动升级打怪自动升级打怪自动升级打怪', '5', null, null, null, null, null, null, 'N', 'N', 'N', '2015-05-30 13:05:08', null, '0');
INSERT INTO `game_script` VALUES ('14', '自动跑图自动跑图', '8', 'cd76f371d09c01417e3666bf4ee296ff.zip', null, '自动跑图自动跑图自动跑图自动跑图自动跑图自动跑图自动跑图自动跑图自动跑图自动跑图自动跑图自动跑图自动跑图自动跑图自动跑图自动跑图', '6', null, null, null, null, null, null, 'N', 'N', 'N', '2015-06-01 19:06:40', null, '0');
INSERT INTO `game_script` VALUES ('15', '12313123123', '8', '7fed88a66800c405df060f75eff7e157.zip', null, '1231312312312313123123123131231231231312312312313123123', '1', null, null, null, null, null, null, 'N', 'N', 'N', '2015-06-01 23:06:51', null, '0');

-- ----------------------------
-- Table structure for login_log
-- ----------------------------
DROP TABLE IF EXISTS `login_log`;
CREATE TABLE `login_log` (
  `col_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `col_user_id` int(11) unsigned DEFAULT NULL,
  `col_ip` char(50) DEFAULT NULL,
  `col_agent` varchar(1024) DEFAULT NULL,
  `col_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`col_id`),
  KEY `FK_login_log_user` (`col_user_id`),
  CONSTRAINT `FK_login_log_user` FOREIGN KEY (`col_user_id`) REFERENCES `user` (`col_id`)
) ENGINE=InnoDB AUTO_INCREMENT=203 DEFAULT CHARSET=utf8 COMMENT='用户登陆日志';

-- ----------------------------
-- Records of login_log
-- ----------------------------
INSERT INTO `login_log` VALUES ('91', '2', '192.168.1.3', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-13 20:49:49');
INSERT INTO `login_log` VALUES ('92', '2', '192.168.1.3', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-13 23:23:36');
INSERT INTO `login_log` VALUES ('93', '2', '192.168.1.3', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-13 23:24:03');
INSERT INTO `login_log` VALUES ('94', '9', '192.168.1.3', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-13 23:24:57');
INSERT INTO `login_log` VALUES ('95', '2', '192.168.1.3', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-13 23:41:06');
INSERT INTO `login_log` VALUES ('96', '2', '192.168.1.6', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-14 19:12:18');
INSERT INTO `login_log` VALUES ('97', '2', '192.168.1.6', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-14 21:17:22');
INSERT INTO `login_log` VALUES ('98', '2', '192.168.1.6', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-14 23:03:48');
INSERT INTO `login_log` VALUES ('99', '2', '192.168.1.6', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-15 00:06:47');
INSERT INTO `login_log` VALUES ('100', '2', '192.168.1.6', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-15 01:10:55');
INSERT INTO `login_log` VALUES ('101', '2', '192.168.1.6', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-15 01:32:16');
INSERT INTO `login_log` VALUES ('102', '2', '192.168.1.6', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-15 02:08:37');
INSERT INTO `login_log` VALUES ('103', '2', '192.168.1.6', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-15 18:09:22');
INSERT INTO `login_log` VALUES ('104', '2', '192.168.1.6', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-15 18:46:53');
INSERT INTO `login_log` VALUES ('105', '8', '192.168.1.6', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-15 19:12:06');
INSERT INTO `login_log` VALUES ('106', '8', '192.168.1.6', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-15 21:19:09');
INSERT INTO `login_log` VALUES ('107', '8', '192.168.1.6', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-15 22:50:36');
INSERT INTO `login_log` VALUES ('108', '8', '192.168.1.6', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-15 23:36:08');
INSERT INTO `login_log` VALUES ('109', '8', '192.168.1.6', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-16 01:19:51');
INSERT INTO `login_log` VALUES ('110', '8', '192.168.1.6', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-16 02:07:56');
INSERT INTO `login_log` VALUES ('111', '2', '192.168.1.6', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-16 02:39:33');
INSERT INTO `login_log` VALUES ('112', '8', '192.168.1.6', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-16 02:41:00');
INSERT INTO `login_log` VALUES ('113', '2', '192.168.1.9', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-16 19:36:54');
INSERT INTO `login_log` VALUES ('114', '8', '192.168.1.9', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-16 19:46:46');
INSERT INTO `login_log` VALUES ('115', '8', '192.168.1.9', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-16 20:34:16');
INSERT INTO `login_log` VALUES ('116', '8', '192.168.1.9', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-16 22:59:36');
INSERT INTO `login_log` VALUES ('117', '8', '192.168.1.9', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-17 00:05:42');
INSERT INTO `login_log` VALUES ('118', '8', '192.168.1.9', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-17 03:50:54');
INSERT INTO `login_log` VALUES ('119', '8', '192.168.1.9', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-17 04:00:55');
INSERT INTO `login_log` VALUES ('120', '8', '192.168.1.9', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-17 05:15:31');
INSERT INTO `login_log` VALUES ('121', '2', '192.168.1.9', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-17 05:27:27');
INSERT INTO `login_log` VALUES ('122', '2', '192.168.1.9', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-17 05:28:01');
INSERT INTO `login_log` VALUES ('123', '2', '192.168.1.9', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-17 06:19:33');
INSERT INTO `login_log` VALUES ('124', '2', '192.168.1.9', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-17 06:48:21');
INSERT INTO `login_log` VALUES ('125', '2', '192.168.1.9', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-17 19:08:04');
INSERT INTO `login_log` VALUES ('126', '1', '192.168.1.9', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-17 20:34:42');
INSERT INTO `login_log` VALUES ('127', '1', '192.168.1.9', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-18 18:07:44');
INSERT INTO `login_log` VALUES ('128', '1', '192.168.1.9', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-18 18:45:09');
INSERT INTO `login_log` VALUES ('129', '8', '192.168.1.9', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-18 18:52:10');
INSERT INTO `login_log` VALUES ('130', '8', '192.168.1.9', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-18 19:22:56');
INSERT INTO `login_log` VALUES ('131', '8', '192.168.1.9', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-18 20:02:17');
INSERT INTO `login_log` VALUES ('132', '8', '192.168.1.9', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-18 22:02:04');
INSERT INTO `login_log` VALUES ('133', '8', '192.168.1.9', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-18 22:54:51');
INSERT INTO `login_log` VALUES ('134', '2', '192.168.1.9', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-18 23:02:08');
INSERT INTO `login_log` VALUES ('135', '8', '192.168.1.9', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-19 00:41:17');
INSERT INTO `login_log` VALUES ('136', '8', '192.168.1.9', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-19 02:43:46');
INSERT INTO `login_log` VALUES ('137', '2', '192.168.1.5', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-19 23:21:21');
INSERT INTO `login_log` VALUES ('138', '8', '192.168.1.5', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-19 23:22:50');
INSERT INTO `login_log` VALUES ('139', '2', '192.168.1.7', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-30 19:59:14');
INSERT INTO `login_log` VALUES ('140', '11', '192.168.1.7', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-30 20:14:58');
INSERT INTO `login_log` VALUES ('141', '8', '192.168.1.7', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-30 20:23:04');
INSERT INTO `login_log` VALUES ('142', '11', '192.168.1.7', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-30 21:27:40');
INSERT INTO `login_log` VALUES ('143', '2', '192.168.1.7', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-30 21:28:08');
INSERT INTO `login_log` VALUES ('144', '8', '192.168.1.7', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-30 21:36:44');
INSERT INTO `login_log` VALUES ('145', '8', '192.168.1.7', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-05-30 23:51:53');
INSERT INTO `login_log` VALUES ('146', '14', '192.168.1.7', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-06-01 18:56:32');
INSERT INTO `login_log` VALUES ('147', '8', '192.168.1.7', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-06-01 19:53:11');
INSERT INTO `login_log` VALUES ('148', '8', '192.168.1.7', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-06-01 20:23:42');
INSERT INTO `login_log` VALUES ('149', '8', '192.168.1.7', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-06-01 21:28:21');
INSERT INTO `login_log` VALUES ('150', '2', '192.168.1.7', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-06-01 21:36:34');
INSERT INTO `login_log` VALUES ('151', '8', '192.168.1.7', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-06-01 22:12:55');
INSERT INTO `login_log` VALUES ('152', '2', '192.168.1.7', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-06-01 22:13:03');
INSERT INTO `login_log` VALUES ('153', '8', '192.168.1.7', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-06-01 22:13:49');
INSERT INTO `login_log` VALUES ('154', '8', '192.168.1.7', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-06-01 22:16:07');
INSERT INTO `login_log` VALUES ('155', '8', '192.168.1.7', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-06-02 00:16:32');
INSERT INTO `login_log` VALUES ('156', '8', '192.168.1.7', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-06-05 20:53:53');
INSERT INTO `login_log` VALUES ('157', '8', '192.168.1.7', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-06-05 22:37:13');
INSERT INTO `login_log` VALUES ('158', '16', '192.168.1.7', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-06-05 23:13:37');
INSERT INTO `login_log` VALUES ('159', '15', '192.168.1.7', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0', '2015-06-06 00:40:51');
INSERT INTO `login_log` VALUES ('160', '16', '192.168.1.7', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-06-06 01:39:05');
INSERT INTO `login_log` VALUES ('161', '16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36', '2015-06-09 01:14:44');
INSERT INTO `login_log` VALUES ('162', '16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36', '2015-06-09 01:27:44');
INSERT INTO `login_log` VALUES ('163', '16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36', '2015-06-09 01:34:04');
INSERT INTO `login_log` VALUES ('164', '16', '127.0.0.1', 'Mozilla/5.0 (Linux; Android 4.2.1; en-us; Nexus 4 Build/JOP40D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19', '2015-06-09 01:36:35');
INSERT INTO `login_log` VALUES ('165', '16', '127.0.0.1', 'Mozilla/5.0 (Linux; Android 4.2.1; en-us; Nexus 4 Build/JOP40D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19', '2015-06-09 01:38:41');
INSERT INTO `login_log` VALUES ('166', '16', '127.0.0.1', 'Mozilla/5.0 (Linux; Android 4.2.1; en-us; Nexus 4 Build/JOP40D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19', '2015-06-09 02:04:19');
INSERT INTO `login_log` VALUES ('167', '16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36', '2015-06-09 18:00:39');
INSERT INTO `login_log` VALUES ('168', '16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36', '2015-06-09 18:11:23');
INSERT INTO `login_log` VALUES ('169', '16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36', '2015-06-09 19:01:02');
INSERT INTO `login_log` VALUES ('170', '16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-06-09 19:22:52');
INSERT INTO `login_log` VALUES ('171', '16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36', '2015-06-09 22:00:34');
INSERT INTO `login_log` VALUES ('172', '16', '127.0.0.1', 'Mozilla/5.0 (Linux; Android 4.2.1; en-us; Nexus 4 Build/JOP40D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19', '2015-06-09 22:44:51');
INSERT INTO `login_log` VALUES ('173', '16', '127.0.0.1', 'Mozilla/5.0 (Linux; Android 4.2.1; en-us; Nexus 4 Build/JOP40D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19', '2015-06-10 02:28:21');
INSERT INTO `login_log` VALUES ('174', '16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36', '2015-06-10 22:27:23');
INSERT INTO `login_log` VALUES ('175', '15', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-06-10 22:49:27');
INSERT INTO `login_log` VALUES ('176', '16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36', '2015-06-10 23:57:23');
INSERT INTO `login_log` VALUES ('177', '15', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-06-11 01:59:34');
INSERT INTO `login_log` VALUES ('178', '16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-06-11 02:00:19');
INSERT INTO `login_log` VALUES ('179', '16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36', '2015-06-12 18:28:07');
INSERT INTO `login_log` VALUES ('180', '16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36', '2015-06-12 20:42:05');
INSERT INTO `login_log` VALUES ('181', '16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36', '2015-06-12 23:58:51');
INSERT INTO `login_log` VALUES ('182', '16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36', '2015-06-13 01:17:42');
INSERT INTO `login_log` VALUES ('183', '16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36', '2015-06-13 01:48:06');
INSERT INTO `login_log` VALUES ('184', '17', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-06-14 18:27:55');
INSERT INTO `login_log` VALUES ('185', '16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36', '2015-06-14 18:54:43');
INSERT INTO `login_log` VALUES ('186', '17', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-06-14 20:11:39');
INSERT INTO `login_log` VALUES ('187', '16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36', '2015-06-14 20:11:57');
INSERT INTO `login_log` VALUES ('188', '16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36', '2015-06-14 20:41:01');
INSERT INTO `login_log` VALUES ('189', '16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36', '2015-06-14 20:41:36');
INSERT INTO `login_log` VALUES ('190', '16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36', '2015-06-14 20:42:48');
INSERT INTO `login_log` VALUES ('191', '17', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-06-14 22:21:04');
INSERT INTO `login_log` VALUES ('192', '16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36', '2015-06-14 23:22:57');
INSERT INTO `login_log` VALUES ('193', '17', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-06-14 23:45:54');
INSERT INTO `login_log` VALUES ('194', '17', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-06-15 18:00:15');
INSERT INTO `login_log` VALUES ('195', '16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36', '2015-06-15 18:31:43');
INSERT INTO `login_log` VALUES ('196', '17', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-06-15 19:34:29');
INSERT INTO `login_log` VALUES ('197', '16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36', '2015-06-15 20:01:35');
INSERT INTO `login_log` VALUES ('198', '16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36', '2015-06-15 23:10:49');
INSERT INTO `login_log` VALUES ('199', '16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36', '2015-06-16 01:12:30');
INSERT INTO `login_log` VALUES ('200', '17', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36', '2015-06-16 01:12:50');
INSERT INTO `login_log` VALUES ('201', '16', '127.0.0.1', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; .NET4.0C)', '2015-06-16 02:51:05');
INSERT INTO `login_log` VALUES ('202', '16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36', '2015-06-16 02:58:59');

-- ----------------------------
-- Table structure for notice
-- ----------------------------
DROP TABLE IF EXISTS `notice`;
CREATE TABLE `notice` (
  `col_id` int(11) NOT NULL AUTO_INCREMENT,
  `col_admin_id` int(11) unsigned DEFAULT NULL COMMENT '发布者',
  `col_time` datetime DEFAULT NULL COMMENT '发布时间',
  `col_type` char(50) DEFAULT NULL COMMENT '通知类型，如：新闻 公告 促销活动',
  `col_content` text COMMENT '配合富编辑器还有做一些扩展，如附件的处理',
  PRIMARY KEY (`col_id`),
  KEY `FK_notice_base_user` (`col_admin_id`),
  CONSTRAINT `FK_notice_base_user` FOREIGN KEY (`col_admin_id`) REFERENCES `user` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='通知公告';

-- ----------------------------
-- Records of notice
-- ----------------------------
INSERT INTO `notice` VALUES ('1', '3', '2015-04-28 14:16:24', '通知', '关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知');
INSERT INTO `notice` VALUES ('2', '3', '2015-04-28 14:16:24', '通知', '关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知');
INSERT INTO `notice` VALUES ('3', '3', '2015-04-28 14:16:24', '通知', '关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知');
INSERT INTO `notice` VALUES ('4', '3', '2015-04-28 14:16:24', '通知', '关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知');
INSERT INTO `notice` VALUES ('5', '3', '2015-04-28 14:16:24', '通知', '关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知');
INSERT INTO `notice` VALUES ('6', '3', '2015-04-28 14:16:24', '通知', '关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知');
INSERT INTO `notice` VALUES ('7', '3', '2015-04-28 14:16:24', '通知', '关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知');
INSERT INTO `notice` VALUES ('8', '3', '2015-04-28 14:16:24', '通知', '关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知');
INSERT INTO `notice` VALUES ('9', '3', '2015-04-28 14:16:24', '通知', '关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知');
INSERT INTO `notice` VALUES ('10', '3', '2015-04-28 14:16:24', '通知', '关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知关于互助平台账号信息安全通知息安全通知息安全通知');

-- ----------------------------
-- Table structure for op_log
-- ----------------------------
DROP TABLE IF EXISTS `op_log`;
CREATE TABLE `op_log` (
  `col_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `col_user_id` int(11) unsigned DEFAULT NULL COMMENT '用户id',
  `col_res_type` char(50) NOT NULL DEFAULT '0' COMMENT '资源的类型，如vm templete',
  `col_red_id` int(11) unsigned DEFAULT NULL COMMENT '资源id',
  `col_action` varchar(100) DEFAULT NULL COMMENT '动作，如增删改\\关机 重启',
  `col_result` char(50) DEFAULT NULL COMMENT '动作产生的结果结果',
  `col_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '开始时间',
  PRIMARY KEY (`col_id`),
  KEY `FK_op_log_user` (`col_user_id`),
  CONSTRAINT `FK_op_log_user` FOREIGN KEY (`col_user_id`) REFERENCES `user` (`col_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='资源的操作日志';

-- ----------------------------
-- Records of op_log
-- ----------------------------

-- ----------------------------
-- Table structure for pay_channel
-- ----------------------------
DROP TABLE IF EXISTS `pay_channel`;
CREATE TABLE `pay_channel` (
  `col_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `col_type` char(50) DEFAULT NULL COMMENT '支付通道（如：支付宝 盛付通 财付通 连连支付 paypal）',
  `col_rate` decimal(10,2) DEFAULT NULL COMMENT '费率',
  `col_desc` text COMMENT '通道描述',
  PRIMARY KEY (`col_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='支付通道';

-- ----------------------------
-- Records of pay_channel
-- ----------------------------

-- ----------------------------
-- Table structure for pay_channel_parameter
-- ----------------------------
DROP TABLE IF EXISTS `pay_channel_parameter`;
CREATE TABLE `pay_channel_parameter` (
  `col_channel_id` int(11) unsigned NOT NULL COMMENT 'channel id',
  `col_key` char(50) NOT NULL COMMENT '键',
  `col_value` varchar(200) DEFAULT NULL COMMENT '值',
  PRIMARY KEY (`col_channel_id`,`col_key`),
  CONSTRAINT `FK_pay_channel_parameter_pay_channel` FOREIGN KEY (`col_channel_id`) REFERENCES `pay_channel` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='支付通道参数';

-- ----------------------------
-- Records of pay_channel_parameter
-- ----------------------------

-- ----------------------------
-- Table structure for promotion
-- ----------------------------
DROP TABLE IF EXISTS `promotion`;
CREATE TABLE `promotion` (
  `col_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `col_name` char(50) DEFAULT NULL COMMENT '活动名称',
  `col_guser` varchar(1024) DEFAULT NULL COMMENT '目标用户',
  `col_begin` datetime DEFAULT NULL COMMENT '开始日期',
  `col_end` datetime DEFAULT NULL COMMENT '结束日期',
  `col_content` text COMMENT '活动详情',
  `col_url` varchar(100) DEFAULT NULL COMMENT '活动页面地址',
  `col_submitor` int(11) unsigned DEFAULT NULL COMMENT '发布者',
  `col_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '发布时间',
  PRIMARY KEY (`col_id`),
  KEY `FK_promotion_base_user` (`col_submitor`),
  CONSTRAINT `FK_promotion_base_user` FOREIGN KEY (`col_submitor`) REFERENCES `user` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='促销活动表';

-- ----------------------------
-- Records of promotion
-- ----------------------------

-- ----------------------------
-- Table structure for script_template
-- ----------------------------
DROP TABLE IF EXISTS `script_template`;
CREATE TABLE `script_template` (
  `col_script_id` int(11) unsigned NOT NULL COMMENT 'game_script表id',
  `col_template` int(11) unsigned NOT NULL COMMENT 'cloud_template表id',
  `col_default` tinyint(4) DEFAULT '1' COMMENT '1 脚本默认模板',
  PRIMARY KEY (`col_script_id`,`col_template`),
  KEY `FK_script_template_game_script` (`col_script_id`),
  KEY `FK_script_template_cloud_template` (`col_template`),
  CONSTRAINT `FK_script_template_cloud_template` FOREIGN KEY (`col_template`) REFERENCES `cloud_template` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_script_template_game_script` FOREIGN KEY (`col_script_id`) REFERENCES `game_script` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='脚本模板对应表';

-- ----------------------------
-- Records of script_template
-- ----------------------------
INSERT INTO `script_template` VALUES ('1', '1', '1');
INSERT INTO `script_template` VALUES ('2', '2', '1');
INSERT INTO `script_template` VALUES ('4', '3', '1');
INSERT INTO `script_template` VALUES ('4', '10', '1');
INSERT INTO `script_template` VALUES ('4', '11', '1');
INSERT INTO `script_template` VALUES ('4', '12', '1');
INSERT INTO `script_template` VALUES ('5', '4', '1');
INSERT INTO `script_template` VALUES ('6', '5', '1');
INSERT INTO `script_template` VALUES ('7', '6', '1');
INSERT INTO `script_template` VALUES ('8', '7', '1');
INSERT INTO `script_template` VALUES ('8', '9', '1');

-- ----------------------------
-- Table structure for script_tutorial
-- ----------------------------
DROP TABLE IF EXISTS `script_tutorial`;
CREATE TABLE `script_tutorial` (
  `col_id` int(11) NOT NULL AUTO_INCREMENT,
  `col_user_id` int(11) unsigned DEFAULT NULL COMMENT '发布者',
  `col_time` datetime DEFAULT NULL COMMENT '发布时间',
  `col_type` char(50) DEFAULT NULL COMMENT '如：脚本设置、游戏攻略',
  `col_content` text COMMENT '内容',
  PRIMARY KEY (`col_id`),
  KEY `FK_notice_base_user` (`col_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='通知公告';

-- ----------------------------
-- Records of script_tutorial
-- ----------------------------

-- ----------------------------
-- Table structure for software
-- ----------------------------
DROP TABLE IF EXISTS `software`;
CREATE TABLE `software` (
  `col_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `col_name` char(50) DEFAULT NULL COMMENT '软件名称（包括操作系统）',
  `col_version` char(50) DEFAULT NULL COMMENT '版本',
  `col_url` varchar(100) DEFAULT NULL COMMENT '软件安装文件地址',
  `col_filetype` varchar(100) DEFAULT NULL COMMENT '文件类型，如ISO',
  `col_os` varchar(100) DEFAULT NULL COMMENT '可用操作系统',
  `col_price` decimal(10,2) DEFAULT NULL COMMENT '价格',
  PRIMARY KEY (`col_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='可用软件列表';

-- ----------------------------
-- Records of software
-- ----------------------------

-- ----------------------------
-- Table structure for status_collect
-- ----------------------------
DROP TABLE IF EXISTS `status_collect`;
CREATE TABLE `status_collect` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '状态主键',
  `status_code` int(11) NOT NULL COMMENT '状态编码唯一',
  `status_desc_en` varchar(1024) NOT NULL COMMENT '状态描述',
  `status_desc_cn` varchar(1024) NOT NULL,
  `col_status_desc` varchar(1024) NOT NULL COMMENT '对应表的列名(game_script.col_status)',
  PRIMARY KEY (`status_id`),
  UNIQUE KEY `index_status_code` (`status_code`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of status_collect
-- ----------------------------
INSERT INTO `status_collect` VALUES ('1', '0', 'not security audit', '未安全审核', 'game_script.col_status');
INSERT INTO `status_collect` VALUES ('2', '1', 'security audit now', '安全审核中', 'game_script.col_status');
INSERT INTO `status_collect` VALUES ('3', '2', 'security audit pass', '安全审核通过', 'game_script.col_status');
INSERT INTO `status_collect` VALUES ('4', '3', 'security audit no pass', '安全审核未通过', 'game_script.col_status');

-- ----------------------------
-- Table structure for template_offering_map
-- ----------------------------
DROP TABLE IF EXISTS `template_offering_map`;
CREATE TABLE `template_offering_map` (
  `col_template_id` int(11) unsigned NOT NULL,
  `col_offering_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`col_template_id`),
  KEY `offering_id` (`col_offering_id`),
  CONSTRAINT `FK_game_offering_map_cloud_template` FOREIGN KEY (`col_template_id`) REFERENCES `cloud_template` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `offering_id` FOREIGN KEY (`col_offering_id`) REFERENCES `cloud_offering` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- ----------------------------
-- Records of template_offering_map
-- ----------------------------
INSERT INTO `template_offering_map` VALUES ('1', '1');
INSERT INTO `template_offering_map` VALUES ('2', '1');
INSERT INTO `template_offering_map` VALUES ('3', '1');
INSERT INTO `template_offering_map` VALUES ('4', '1');
INSERT INTO `template_offering_map` VALUES ('5', '1');
INSERT INTO `template_offering_map` VALUES ('6', '1');
INSERT INTO `template_offering_map` VALUES ('7', '1');

-- ----------------------------
-- Table structure for ticket
-- ----------------------------
DROP TABLE IF EXISTS `ticket`;
CREATE TABLE `ticket` (
  `col_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `col_time` datetime DEFAULT NULL COMMENT '提交时间',
  `col_user_id` int(11) unsigned DEFAULT NULL COMMENT '用户id',
  `col_type_id` int(11) unsigned DEFAULT NULL COMMENT '问题类型',
  `col_question` varchar(100) DEFAULT NULL COMMENT '问题描述',
  `col_attachment` varchar(500) DEFAULT NULL COMMENT '附件地址',
  `col_status` enum('Y','N') DEFAULT NULL COMMENT '工单状态：进行中、结束',
  PRIMARY KEY (`col_id`),
  KEY `FK_ticket_base_user` (`col_user_id`),
  KEY `FK_ticket_ticket_type` (`col_type_id`),
  CONSTRAINT `FK_ticket_base_user` FOREIGN KEY (`col_user_id`) REFERENCES `user` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_ticket_ticket_type` FOREIGN KEY (`col_type_id`) REFERENCES `ticket_type` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='工单表';

-- ----------------------------
-- Records of ticket
-- ----------------------------

-- ----------------------------
-- Table structure for ticket_comment
-- ----------------------------
DROP TABLE IF EXISTS `ticket_comment`;
CREATE TABLE `ticket_comment` (
  `col_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `col_ticket_id` int(11) unsigned DEFAULT NULL,
  `col_time` datetime DEFAULT NULL,
  `col_uid` int(11) DEFAULT NULL COMMENT 'base_user id',
  `col_content` varchar(1000) DEFAULT NULL COMMENT '内容',
  `col_attachment` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`col_id`),
  KEY `FK_ticket_comment_ticket` (`col_ticket_id`),
  CONSTRAINT `FK_ticket_comment_ticket` FOREIGN KEY (`col_ticket_id`) REFERENCES `ticket` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='工单详细情况';

-- ----------------------------
-- Records of ticket_comment
-- ----------------------------

-- ----------------------------
-- Table structure for ticket_type
-- ----------------------------
DROP TABLE IF EXISTS `ticket_type`;
CREATE TABLE `ticket_type` (
  `col_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '问题id',
  `col_content` varchar(1000) DEFAULT NULL COMMENT '问题描述',
  PRIMARY KEY (`col_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='工单（问题）类型表';

-- ----------------------------
-- Records of ticket_type
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `col_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `col_name` char(50) DEFAULT NULL COMMENT '真实姓名',
  `col_nickname` char(50) NOT NULL COMMENT '昵称',
  `col_sex` enum('男','女') DEFAULT NULL COMMENT '性别',
  `col_imageurl` varchar(100) DEFAULT NULL COMMENT '照片URL',
  `col_mail` char(50) DEFAULT NULL COMMENT '邮箱',
  `col_call` char(50) DEFAULT NULL COMMENT '移动电话',
  `col_qq` char(50) DEFAULT NULL COMMENT 'QQ号',
  `col_winxin` char(50) DEFAULT NULL COMMENT '微信号',
  `col_passwd` char(50) DEFAULT NULL COMMENT '密码',
  `col_role` enum('user','author','cm','tech','admin') DEFAULT 'user' COMMENT '角色（用户、作者、客服、运维、管理员）',
  `col_rank` tinyint(4) DEFAULT NULL COMMENT '级别（不同级别有不用的优惠）',
  `col_cardtype` char(50) DEFAULT NULL COMMENT '证件类型',
  `col_card` char(50) DEFAULT NULL COMMENT '身份证号',
  `col_card_url` varchar(100) DEFAULT NULL COMMENT '身份证照片URL',
  `col_alipay` char(50) DEFAULT NULL COMMENT '支付宝账号（提现用)',
  `col_bank` char(50) DEFAULT NULL COMMENT '银行名称（提现用)',
  `col_subbank` char(100) DEFAULT NULL COMMENT '开户支行',
  `col_banknum` char(50) DEFAULT NULL COMMENT '银行卡号',
  `col_balance` decimal(10,2) DEFAULT NULL COMMENT '账户余额',
  `col_cmid` int(11) DEFAULT NULL COMMENT '专属客服(customer manager)',
  `col_datetime` datetime DEFAULT NULL COMMENT '注册日期',
  `col_spec_id` int(11) unsigned DEFAULT NULL,
  `col_valid` enum('Y','N') DEFAULT NULL COMMENT '是否已经注销',
  PRIMARY KEY (`col_id`,`col_nickname`),
  KEY `FK_user_user_res_spec` (`col_spec_id`),
  CONSTRAINT `FK_user_user_res_spec` FOREIGN KEY (`col_spec_id`) REFERENCES `user_res_spec` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', null, 'gaoxu', null, null, null, null, null, null, '7c4a8d09ca3762af61e59520943dc26494f8941b', 'user', null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('2', '', 'helloworld', '男', null, 'xiyou_gaoxu@163.com', null, '965669939', null, '7c4a8d09ca3762af61e59520943dc26494f8941b', 'user', null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('3', null, 'test', '男', null, '965669939@163.com', null, '123456789', null, '7c4a8d09ca3762af61e59520943dc26494f8941b', 'user', null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('4', null, 'hello', '男', null, 'gao_xu@126.com', null, '123456789', null, 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'user', null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('5', null, 'test00@', null, null, null, null, null, null, '62cbf61fbce67eeb64a226a50e1cb41fc80fc6fd', 'user', null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('6', null, 'nihaoma', null, null, null, null, null, null, '7c8f9ad03beee8a2fe4275af8bb52c2e4559eca9', 'user', null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('7', 'asdf', 'waiter', null, null, 'zxcvxvzxv@163.com', '18789457120', '1234123456', null, '7c4a8d09ca3762af61e59520943dc26494f8941b', 'tech', null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('8', '高旭', 'author', '男', null, 'aasdfasf@11.com', null, '12341234111', null, '7c4a8d09ca3762af61e59520943dc26494f8941b', 'author', null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('9', null, 'asdfasdf', null, null, null, null, null, null, '7c4a8d09ca3762af61e59520943dc26494f8941b', 'user', null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('10', null, 'ceshi', null, null, null, null, null, null, '7c4a8d09ca3762af61e59520943dc26494f8941b', 'user', null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('11', null, 'zuozhe', null, null, null, null, null, null, '7c4a8d09ca3762af61e59520943dc26494f8941b', 'user', null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('12', null, 'zuozhe1', null, null, null, null, null, null, '7c4a8d09ca3762af61e59520943dc26494f8941b', 'author', null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('13', null, 'ceshi1', null, null, null, null, null, null, '7c4a8d09ca3762af61e59520943dc26494f8941b', 'user', null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('14', null, 'test2', null, null, null, null, null, null, '7c4a8d09ca3762af61e59520943dc26494f8941b', 'user', null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('15', '高旭', 'kefu001', null, null, null, null, null, null, '7c4a8d09ca3762af61e59520943dc26494f8941b', 'cm', null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('16', 'asdf', 'yunwei001', null, null, '111111@qq.com', '18789457777', '123456798', null, '7c4a8d09ca3762af61e59520943dc26494f8941b', 'tech', null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('17', '高旭', 'yunying001', null, null, null, null, null, null, '7c4a8d09ca3762af61e59520943dc26494f8941b', 'admin', null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `user` VALUES ('18', 'gaoxu', 'yunying002', '男', null, '4867645@qq.com', '18789457120', '123456', null, '7c4a8d09ca3762af61e59520943dc26494f8941b', 'admin', null, null, null, null, null, null, null, null, null, null, null, null, null);

-- ----------------------------
-- Table structure for user_coupon
-- ----------------------------
DROP TABLE IF EXISTS `user_coupon`;
CREATE TABLE `user_coupon` (
  `col_id` int(11) NOT NULL AUTO_INCREMENT,
  `col_user_id` int(11) unsigned DEFAULT NULL COMMENT '用户id',
  `col_promotion_id` int(11) unsigned DEFAULT NULL COMMENT '促销活动id',
  `col_money` int(11) DEFAULT NULL COMMENT '金额',
  `col_begin` int(11) DEFAULT NULL COMMENT '开始时间',
  `col_end` int(11) DEFAULT NULL COMMENT '结束时间',
  `col_status` enum('已用',' 未用','失效') DEFAULT NULL COMMENT '状态',
  `col_time` datetime DEFAULT NULL COMMENT '发放时间',
  PRIMARY KEY (`col_id`),
  KEY `FK_user_coupon_promotion` (`col_promotion_id`),
  KEY `FK_coupon_base_user` (`col_user_id`),
  CONSTRAINT `FK_coupon_base_user` FOREIGN KEY (`col_user_id`) REFERENCES `user` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_user_coupon_promotion` FOREIGN KEY (`col_promotion_id`) REFERENCES `promotion` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户优惠卷表';

-- ----------------------------
-- Records of user_coupon
-- ----------------------------

-- ----------------------------
-- Table structure for user_order
-- ----------------------------
DROP TABLE IF EXISTS `user_order`;
CREATE TABLE `user_order` (
  `col_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `col_user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `col_datatime` datetime DEFAULT NULL COMMENT '购买日期',
  `col_money` decimal(10,2) unsigned DEFAULT NULL COMMENT '消费金额',
  `col_coupon_id` int(11) unsigned DEFAULT NULL COMMENT '优惠卷id',
  `col_realmoney` decimal(10,2) unsigned DEFAULT NULL COMMENT '实付金额',
  `col_status` enum('Y','N') DEFAULT NULL COMMENT '是否完成付款（已付款 等待付款）',
  `col_note` varchar(100) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`col_id`),
  KEY `FK_order_user` (`col_user_id`),
  CONSTRAINT `FK_order_user` FOREIGN KEY (`col_user_id`) REFERENCES `user` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户虚机已经购买记录，一个订单只能使用一个优惠卷';

-- ----------------------------
-- Records of user_order
-- ----------------------------

-- ----------------------------
-- Table structure for user_order_item
-- ----------------------------
DROP TABLE IF EXISTS `user_order_item`;
CREATE TABLE `user_order_item` (
  `col_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `col_order_id` int(11) unsigned DEFAULT NULL COMMENT '订单id',
  `col_item_type` enum('vm','game_script','software') DEFAULT NULL COMMENT '购买的类型',
  `col_item_id` int(11) DEFAULT NULL COMMENT '购买的vmid等',
  `col_begin` datetime DEFAULT NULL COMMENT '开始日期',
  `col_end` datetime DEFAULT NULL COMMENT '结束日期',
  `col_num` int(11) DEFAULT NULL COMMENT '数量',
  PRIMARY KEY (`col_id`),
  KEY `FK_order_item_order` (`col_order_id`),
  CONSTRAINT `FK_order_item_order` FOREIGN KEY (`col_order_id`) REFERENCES `user_order` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户订单详情';

-- ----------------------------
-- Records of user_order_item
-- ----------------------------

-- ----------------------------
-- Table structure for user_pay_log
-- ----------------------------
DROP TABLE IF EXISTS `user_pay_log`;
CREATE TABLE `user_pay_log` (
  `col_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `col_user_id` int(11) unsigned DEFAULT NULL COMMENT '账户id',
  `col_channel_id` int(11) unsigned DEFAULT NULL,
  `col_datetime` datetime DEFAULT NULL COMMENT '充值日期',
  `col_type` enum('充值','提现') DEFAULT NULL COMMENT '支付类型',
  `col_amount` decimal(10,2) DEFAULT NULL COMMENT '充值或者消费金额',
  `col_status` enum('Y','N') DEFAULT NULL COMMENT '充值状态（进行中 已经完成）',
  `col_result` enum('Y','N') DEFAULT NULL COMMENT '充值是否成功',
  `col_result_desc` varchar(1024) DEFAULT NULL COMMENT '充值失败的原因',
  PRIMARY KEY (`col_id`),
  KEY `FK_user_pay_log_user` (`col_user_id`),
  KEY `FK_user_pay_log_pay_channel` (`col_channel_id`),
  CONSTRAINT `FK_user_pay_log_pay_channel` FOREIGN KEY (`col_channel_id`) REFERENCES `pay_channel` (`col_id`),
  CONSTRAINT `FK_user_pay_log_user` FOREIGN KEY (`col_user_id`) REFERENCES `user` (`col_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户账户充值提现记录';

-- ----------------------------
-- Records of user_pay_log
-- ----------------------------

-- ----------------------------
-- Table structure for user_res_spec
-- ----------------------------
DROP TABLE IF EXISTS `user_res_spec`;
CREATE TABLE `user_res_spec` (
  `col_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `col_name` char(50) DEFAULT NULL,
  `col_desc` varchar(1024) DEFAULT NULL,
  `col_max_vm` int(11) DEFAULT NULL,
  `col_max_cpunumber` int(11) DEFAULT NULL,
  `col_max_memory` int(11) DEFAULT NULL COMMENT '单位mb',
  `col_max_disksize` int(11) DEFAULT NULL COMMENT '单位mb',
  PRIMARY KEY (`col_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户资源限额表';

-- ----------------------------
-- Records of user_res_spec
-- ----------------------------

-- ----------------------------
-- Table structure for vm
-- ----------------------------
DROP TABLE IF EXISTS `vm`;
CREATE TABLE `vm` (
  `col_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `col_vm_id` char(64) DEFAULT NULL,
  `col_name` char(50) DEFAULT NULL COMMENT '虚机名称，与云平台和网关一致',
  `col_user_id` int(11) unsigned DEFAULT NULL COMMENT '用户id',
  `col_template_id` int(11) unsigned DEFAULT NULL COMMENT '镜像id',
  `col_offering_id` int(11) unsigned DEFAULT NULL COMMENT '配置id',
  `col_zone_id` int(11) unsigned DEFAULT NULL COMMENT '数据中心id',
  `col_gateway_id` int(11) unsigned DEFAULT NULL COMMENT '网关id',
  `col_connection_id` int(11) unsigned DEFAULT NULL COMMENT '网关guacamole_connection的id',
  `col_connection_url` varchar(1024) DEFAULT NULL COMMENT '网关对应的虚机url',
  `col_inner_ip` char(50) DEFAULT NULL COMMENT '虚机内部ip地址',
  `col_inner_port` int(11) DEFAULT NULL COMMENT '虚机内部端口号',
  `col_outer_ip` char(50) DEFAULT NULL COMMENT '虚机外部ip地址',
  `col_outer_port` int(11) DEFAULT NULL COMMENT '虚机外部端口号',
  `col_user` char(50) DEFAULT NULL COMMENT '虚机用户名 ',
  `col_passwd` char(50) DEFAULT NULL COMMENT '虚机密码',
  `col_protocal` enum('RDP','VNC','SSH','Telnet') DEFAULT NULL COMMENT '网关协议',
  `col_status_code` char(10) NOT NULL COMMENT '虚机运行状态编号',
  `col_begin` datetime DEFAULT NULL COMMENT '开始日期 ',
  `col_end` datetime DEFAULT NULL COMMENT '结束日期',
  `col_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`col_id`),
  KEY `FK_vm_user` (`col_user_id`),
  KEY `FK_vm_template` (`col_template_id`),
  KEY `FK_vm_offering` (`col_offering_id`),
  KEY `FK_vm_gateway` (`col_gateway_id`),
  KEY `FK_vm_cloud_zone` (`col_zone_id`),
  KEY `FK_vm_vm_status` (`col_status_code`),
  CONSTRAINT `FK_vm_cloud_zone` FOREIGN KEY (`col_zone_id`) REFERENCES `cloud_zone` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_vm_gateway` FOREIGN KEY (`col_gateway_id`) REFERENCES `cloud_gateway` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_vm_offering` FOREIGN KEY (`col_offering_id`) REFERENCES `cloud_offering` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_vm_template` FOREIGN KEY (`col_template_id`) REFERENCES `cloud_template` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_vm_user` FOREIGN KEY (`col_user_id`) REFERENCES `user` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_vm_vm_status` FOREIGN KEY (`col_status_code`) REFERENCES `vm_status` (`col_code`)
) ENGINE=InnoDB AUTO_INCREMENT=188 DEFAULT CHARSET=utf8 COMMENT='用户虚机列表';

-- ----------------------------
-- Records of vm
-- ----------------------------
INSERT INTO `vm` VALUES ('174', 'ee3c3fd0-e1d7-40be-ad83-0bd77ab414aa', null, '8', '1', '1', '1', '1', '50', null, null, null, '192.168.1.236', '3389', 'administrator', 'Admin@123', 'RDP', 'Running', '2015-05-18 11:05:16', null, '2015-05-18 20:25:35');
INSERT INTO `vm` VALUES ('175', 'dfc366de-8b8f-4a67-8fcc-290600b010ee', null, '8', '1', '1', '1', '1', '51', null, null, null, '192.168.1.239', '3389', 'administrator', 'Admin@123', 'RDP', 'Stopped', '2015-05-18 12:05:41', null, '2015-05-19 00:45:52');
INSERT INTO `vm` VALUES ('176', '5ec0df79-a67c-4214-9956-749bdb05bb70', null, '2', '5', '1', '1', '1', '52', null, null, null, '192.168.1.225', '3389', 'administrator', 'Admin@123', 'RDP', 'Destroyed', '2015-05-18 14:05:18', null, '2015-05-18 23:50:13');
INSERT INTO `vm` VALUES ('177', 'da92b803-7901-42bf-b8cd-03d506fad5c4', null, '2', '3', '1', '1', '1', '53', null, null, null, '192.168.1.241', '3389', 'administrator', 'Admin@123', 'RDP', 'Destroyed', '2015-05-18 15:05:36', null, '2015-05-19 00:24:12');
INSERT INTO `vm` VALUES ('178', '2b855740-3b39-465a-aa8a-ee2111527087', null, '2', '6', '1', '1', '1', '54', null, null, null, '192.168.1.242', '3389', 'administrator', 'Admin@123', 'RDP', 'Running', '2015-05-18 16:05:41', null, '2015-05-19 00:41:06');
INSERT INTO `vm` VALUES ('179', 'af029bf9-10a4-4484-91da-3542c15b6c17', null, '8', '1', '1', '1', '1', '55', null, null, null, '192.168.1.233', '3389', 'administrator', 'Admin@123', 'RDP', 'Stopped', '2015-05-18 16:05:51', null, '2015-05-19 00:50:19');
INSERT INTO `vm` VALUES ('180', 'd948996a-07c8-4306-a236-5262fc7e193a', null, '14', '6', '1', '1', null, null, null, null, null, '192.168.1.235', '3389', null, null, null, 'Destroyed', '2015-06-01 18:06:46', null, '2015-06-01 19:11:10');
INSERT INTO `vm` VALUES ('181', 'd2887624-fb5e-42e9-abfa-e6f03b4b1a41', null, '14', '6', '1', '1', '1', '57', null, null, null, '192.168.1.234', '3389', 'administrator', 'Admin@123', 'RDP', 'Starting', '2015-06-01 19:06:21', null, '2015-06-01 19:39:00');
INSERT INTO `vm` VALUES ('182', 'd8ceaeb2-d478-4e46-bd61-e14d1185fe50', null, '14', '5', '1', '1', '1', '58', null, null, null, '192.168.1.246', '3389', 'administrator', 'Admin@123', 'RDP', 'Running', '2015-06-01 19:06:49', null, '2015-06-01 19:23:05');
INSERT INTO `vm` VALUES ('183', '5cc6e999-09cc-4cbc-b7e3-c3a44e95f6ae', null, '8', '1', '1', '1', '1', '59', null, null, null, '192.168.1.247', '3389', 'administrator', 'Admin@123', 'RDP', 'Stopped', '2015-06-01 20:06:13', null, '2015-06-01 21:29:01');
INSERT INTO `vm` VALUES ('184', '147f0414-250f-46cf-9482-e5fcb8df0c3c', null, '8', '3', '1', '1', '1', '61', null, null, null, '192.168.1.226', '3389', 'administrator', 'Admin@123', 'RDP', 'Running', '2015-06-01 21:06:21', null, '2015-06-01 22:14:36');
INSERT INTO `vm` VALUES ('185', '4eec5038-6ad3-4cb7-b6d2-3003f71bc066', null, '2', '3', '1', '1', '1', '60', null, null, null, '192.168.1.236', '3389', 'administrator', 'Admin@123', 'RDP', 'Running', '2015-06-01 21:06:39', null, '2015-06-01 21:36:55');
INSERT INTO `vm` VALUES ('186', '75010689-e525-467c-8584-e6a1f1f580be', null, '8', '1', '1', '1', '1', '62', null, null, null, '192.168.1.234', '3389', 'administrator', 'Admin@123', 'RDP', 'Stopped', '2015-06-01 22:06:41', null, '2015-06-01 22:46:26');
INSERT INTO `vm` VALUES ('187', '0ce01abc-1bed-4d55-9adb-d91e960017cd', null, '8', '1', '1', '1', '1', '63', null, null, null, '192.168.1.235', '3389', 'administrator', 'Admin@123', 'RDP', 'Running', '2015-06-01 22:06:10', null, '2015-06-01 22:53:43');

-- ----------------------------
-- Table structure for vm_software
-- ----------------------------
DROP TABLE IF EXISTS `vm_software`;
CREATE TABLE `vm_software` (
  `col_vm_id` int(11) unsigned NOT NULL,
  `col_software_id` int(11) unsigned NOT NULL,
  `col_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`col_vm_id`,`col_software_id`),
  CONSTRAINT `FK_vm_software_vm` FOREIGN KEY (`col_vm_id`) REFERENCES `vm` (`col_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='虚机已经安装的软件列表';

-- ----------------------------
-- Records of vm_software
-- ----------------------------

-- ----------------------------
-- Table structure for vm_status
-- ----------------------------
DROP TABLE IF EXISTS `vm_status`;
CREATE TABLE `vm_status` (
  `col_code` char(20) NOT NULL COMMENT '状态编号',
  `col_name` char(50) DEFAULT NULL COMMENT '状态名称',
  `col_desc` varchar(1000) DEFAULT NULL COMMENT '状态描述',
  PRIMARY KEY (`col_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='虚机状态详细描述表';

-- ----------------------------
-- Records of vm_status
-- ----------------------------
INSERT INTO `vm_status` VALUES ('Active', '激活', null);
INSERT INTO `vm_status` VALUES ('Destroyed', '删除', null);
INSERT INTO `vm_status` VALUES ('Error', '错误', null);
INSERT INTO `vm_status` VALUES ('Expunging', '删除中', null);
INSERT INTO `vm_status` VALUES ('Inactive', '未激活', null);
INSERT INTO `vm_status` VALUES ('Migrating', '迁移中', null);
INSERT INTO `vm_status` VALUES ('PowerOff', '关闭电源', null);
INSERT INTO `vm_status` VALUES ('PowerOn', '打开电源', null);
INSERT INTO `vm_status` VALUES ('PowerReportMissing', '电源报告丢失', null);
INSERT INTO `vm_status` VALUES ('PowerUnknown', '电源状态未知', null);
INSERT INTO `vm_status` VALUES ('Running', '运行中', null);
INSERT INTO `vm_status` VALUES ('Shutdowned', '关机', null);
INSERT INTO `vm_status` VALUES ('Starting', '启动中', null);
INSERT INTO `vm_status` VALUES ('Stopped', '停止', null);
INSERT INTO `vm_status` VALUES ('Stopping', '停止中', null);
INSERT INTO `vm_status` VALUES ('Unknown', '未知', null);
