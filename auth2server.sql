# Host: localhost  (Version: 5.5.53)
# Date: 2018-06-11 23:08:38
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "access"
#

DROP TABLE IF EXISTS `access`;
CREATE TABLE `access` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `accessToken` varchar(255) NOT NULL DEFAULT '',
  `refreshToken` varchar(255) NOT NULL DEFAULT '',
  `createTime` int(11) NOT NULL DEFAULT '0',
  `userId` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "access"
#

/*!40000 ALTER TABLE `access` DISABLE KEYS */;
INSERT INTO `access` VALUES (1,'Ly75Mgos2uf7iYlR','SuTbWeycWGJHq7Xs',1528719737,5),(2,'KIHIuKDHQhusuiqC','3ZvhjCcEnu7oMuCK',1528720300,5),(3,'DvSjPkXJn64cCZRn','VQUO1MoFWaXsWqtv',1528720756,5),(4,'GxhtaPHFGnXABvZc','f9j9UE9fhDZxAl32',1528720930,5),(5,'1xfWT5bxadeIEfw2','zxFq5d2ABQL5WamP',1528720977,5),(6,'NPdEqtZHjBAPK914','9uXNA7WUbYhSVdMc',1528721131,5),(7,'QEsJmkYRlDwRtgjB','cyBG9tTBOJSUBvFx',1528721358,5),(8,'tZarc4DMUuMJYgdk','DSvdlBOFsCJi1GBJ',1528721474,5),(9,'WzowlOX9jHEZ5836','JsLyesnMt8287OXe',1528721705,5),(10,'tKEoBmBH01tudaWd','oBzg7mk9xKf2oYHU',1528728045,5),(11,'ARJoVR7g7ArPqiqH','Y0o32B3xlVS5LNs5',1528728139,5),(12,'Hb4NTZOXfY3qpPMT','mbP4gKyaWYkspHF1',1528728373,5),(13,'5X2znyiEF2MownOO','NAXL2vsE4zNrDb6f',1528728483,5),(14,'92ZToaE8DaAVCjLE','NZFOhzutniLp2GjP',1528728525,5),(15,'hgY7jQAmuMsLxX9G','Us6WKFhVQTt6S19i',1528728651,5);
/*!40000 ALTER TABLE `access` ENABLE KEYS */;

#
# Structure for table "auth"
#

DROP TABLE IF EXISTS `auth`;
CREATE TABLE `auth` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL DEFAULT '0',
  `authorCode` varchar(255) NOT NULL DEFAULT '',
  `createTime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

#
# Data for table "auth"
#

/*!40000 ALTER TABLE `auth` DISABLE KEYS */;
INSERT INTO `auth` VALUES (1,5,'Sb0OOCsms3O5LBFf',1528714876),(2,5,'S6ilNcOqRjK1FJGf',1528714899),(3,5,'RhS57yerLExRmmUM',1528715302),(4,5,'WWhxLHesuhkjJCKd',1528715861),(5,5,'5gZI1pCne2ca9rLP',1528715886),(6,5,'tabv7DwjBE4fBPFF',1528715977),(7,5,'jIwoPNV4ph7Sa6kC',1528717368),(8,5,'1eqn5xHJR270mCq1',1528717611),(9,5,'visxJ0GhYsvyRxBx',1528718270),(10,5,'BkqWwoy7dFChC0nR',1528718361),(11,5,'ETwDoV7BK5jz04Bk',1528719275),(12,5,'KJ3cGa5dYGV0LMxr',1528720426),(13,5,'EDx5fw3KGElfGXuW',1528720488),(14,5,'cyPOxctoe5yOs8X7',1528728042),(15,5,'JzGgLSjK22lLINKi',1528728369),(16,5,'cmibQV5gpwG6cERK',1528728649);
/*!40000 ALTER TABLE `auth` ENABLE KEYS */;

#
# Structure for table "user"
#

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `salt` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

#
# Data for table "user"
#

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (5,'gg','boy','ggboy@qq.com','2b067541174acb5ea83ae9f6ae4a7e83','sXpE');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
