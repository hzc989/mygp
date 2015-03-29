-- phpMyAdmin SQL Dump
-- version 2.11.9.2
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1:3306
-- 生成日期: 2015 年 03 月 24 日 03:50
-- 服务器版本: 5.1.28
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `newchange`
--

-- --------------------------------------------------------

--
-- 表的结构 `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `item_id` bigint(100) NOT NULL AUTO_INCREMENT,
  `type` bigint(20) NOT NULL,
  `title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `attachment` text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT '默认为null，有path则取path',
  `author` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `time` datetime NOT NULL COMMENT '发帖时间',
  `last_modify` datetime NOT NULL,
  `status` char(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '0代表正常，1代表不显示',
  PRIMARY KEY (`item_id`),
  KEY `author` (`author`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- 导出表中的数据 `item`
--

INSERT INTO `item` (`item_id`, `type`, `title`, `content`, `attachment`, `author`, `time`, `last_modify`, `status`) VALUES
(2, 2, '邮箱密码', '防止忘记了邮箱的密码：\r\nNewChange', NULL, '20111003660', '0000-00-00 00:00:00', '2015-02-21 11:41:37', '0'),
(3, 1, '测试item2', '测试测试', NULL, '20111003661', '0000-00-00 00:00:00', '2015-02-21 11:43:28', '0'),
(4, 1, '测试item3', '测试内容测试内容测试内容测试内容测试内容测试内容测试内容测试内容测试内容测试内容测试内容测试内容测试内容', NULL, '20111003661', '0000-00-00 00:00:00', '2015-02-21 11:44:28', '0'),
(5, 1, '1234', '阿斯顿发将哈尔奥迪女擦啊速度和', NULL, '20111003660', '0000-00-00 00:00:00', '2015-02-24 20:55:14', '0'),
(6, 2, '测试5', '撒的发生地方', NULL, '20111003660', '0000-00-00 00:00:00', '2015-02-21 11:49:26', '1'),
(14, 1, '测试上传文件', '测试文件\r\n测试文件', '../upload/20111003660/test.txt', '20111003660', '0000-00-00 00:00:00', '2015-02-23 17:11:20', '0'),
(16, 2, '测试again&again', '测试内容\r\n测试内容', '../upload/20111003660/backgroung(800_204).png', '20111003660', '2015-02-24 00:57:27', '2015-02-24 00:57:27', '0'),
(18, 3, '再测试一下有文件上传的情况', '再测试一下有文件上传的情况', '../upload/20111003660/myitem.php', '20111003660', '2015-02-24 01:50:19', '2015-02-24 01:50:19', '0'),
(19, 1, 'test', 'test', NULL, '20111003661', '2015-02-24 22:18:10', '2015-02-25 00:36:20', '0'),
(20, 3, 'test item', 'test', '../upload/20111003660/JavaScriptjsfly.rar', '20111003660', '2015-03-04 17:54:55', '2015-03-04 17:54:55', '0'),
(21, 1, 'test', 'asfdsdaf', NULL, '20111003660', '2015-03-07 21:34:17', '2015-03-07 21:34:37', '0');

-- --------------------------------------------------------

--
-- 表的结构 `item_alarm`
--

CREATE TABLE IF NOT EXISTS `item_alarm` (
  `id` bigint(100) NOT NULL AUTO_INCREMENT,
  `item_id` bigint(100) NOT NULL,
  `owner` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '原帖所属人',
  `reason` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` char(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '0未通过，1已通过',
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- 导出表中的数据 `item_alarm`
--

INSERT INTO `item_alarm` (`id`, `item_id`, `owner`, `reason`, `status`) VALUES
(15, 18, '20111003660', 'test举报', '0'),
(17, 6, '20111003660', 'test举报', '1');

-- --------------------------------------------------------

--
-- 表的结构 `reply`
--

CREATE TABLE IF NOT EXISTS `reply` (
  `reply_id` bigint(100) NOT NULL AUTO_INCREMENT,
  `item_id` bigint(100) NOT NULL,
  `replier` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `time` datetime NOT NULL,
  `status` char(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`reply_id`),
  KEY `item_id` (`item_id`),
  KEY `replier` (`replier`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- 导出表中的数据 `reply`
--

INSERT INTO `reply` (`reply_id`, `item_id`, `replier`, `content`, `time`, `status`) VALUES
(1, 14, '20111003661', '测试回复内容', '2015-02-21 11:51:15', '0'),
(2, 5, '20111003660', '测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试', '2015-02-21 11:52:06', '1'),
(3, 6, '20111003660', '回复回复回复回复回复回复回复回复回复回复回复回复回复回复回复回复', '2015-02-21 11:53:01', '0'),
(4, 6, '20111003660', '回复回复回复回复回复', '2015-02-21 11:52:54', '0'),
(5, 5, '20111003661', '内容内容', '2015-02-24 19:22:36', '0'),
(6, 5, '20111003660', '测试回复内容\r\n测试回复内容', '2015-02-24 20:55:14', '0'),
(10, 19, '20111003660', 'test reply2', '2015-02-25 00:36:20', '0'),
(11, 21, '20111003660', 'asdfasdf', '2015-03-07 21:34:37', '0');

-- --------------------------------------------------------

--
-- 表的结构 `reply_alarm`
--

CREATE TABLE IF NOT EXISTS `reply_alarm` (
  `id` bigint(100) NOT NULL AUTO_INCREMENT,
  `reply_id` bigint(100) NOT NULL,
  `item_id` bigint(100) NOT NULL,
  `owner` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '原回复所属人',
  `reason` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` char(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '0未通过，1已通过',
  PRIMARY KEY (`id`),
  KEY `reply_id` (`reply_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- 导出表中的数据 `reply_alarm`
--

INSERT INTO `reply_alarm` (`id`, `reply_id`, `item_id`, `owner`, `reason`, `status`) VALUES
(9, 2, 5, '20111003660', 'test回复审查', '1'),
(14, 4, 6, '20111003660', 'test again', '0'),
(15, 11, 21, '20111003660', 'asdfa', '0');

-- --------------------------------------------------------

--
-- 表的结构 `rule`
--

CREATE TABLE IF NOT EXISTS `rule` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_editor` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author` (`last_editor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- 导出表中的数据 `rule`
--

INSERT INTO `rule` (`id`, `content`, `last_editor`) VALUES
(1, '公告1：警告超过三次则会被永久禁言。', '000'),
(2, '公告2：不允许发布商业类帖子，例如为自己的店铺宣传等等，一经发现则会被警告一次。', '001');

-- --------------------------------------------------------

--
-- 表的结构 `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `type` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- 导出表中的数据 `type`
--

INSERT INTO `type` (`type`, `name`) VALUES
(1, '衣服饰品'),
(2, '书籍文具'),
(3, '生活杂物'),
(4, '求助求购');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_type` char(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '0管理员，1普通用户',
  `alarm` int(2) NOT NULL DEFAULT '0' COMMENT '满3次禁言',
  `status` char(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '0代表正常，1代表不显示',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 导出表中的数据 `user`
--

INSERT INTO `user` (`user_id`, `password`, `user_type`, `alarm`, `status`) VALUES
('000', '1234', '0', 0, '0'),
('001', '1234', '0', 0, '0'),
('20111003660', '1234', '1', 2, '0'),
('20111003661', '1234', '1', 0, '0');

--
-- 限制导出的表
--

--
-- 限制表 `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_2` FOREIGN KEY (`type`) REFERENCES `type` (`type`);

--
-- 限制表 `item_alarm`
--
ALTER TABLE `item_alarm`
  ADD CONSTRAINT `item_alarm_ibfk_3` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`);

--
-- 限制表 `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `reply_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `reply_alarm`
--
ALTER TABLE `reply_alarm`
  ADD CONSTRAINT `reply_alarm_ibfk_3` FOREIGN KEY (`reply_id`) REFERENCES `reply` (`reply_id`);

--
-- 限制表 `rule`
--
ALTER TABLE `rule`
  ADD CONSTRAINT `rule_ibfk_1` FOREIGN KEY (`author`) REFERENCES `user` (`user_id`);
