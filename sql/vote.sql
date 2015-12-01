-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-12-01 21:08:12
-- 服务器版本： 5.5.46-0ubuntu0.14.04.2
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vote`
--

-- --------------------------------------------------------

--
-- 表的结构 `opt`
--

CREATE TABLE `opt` (
  `id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `ABC` varchar(1) NOT NULL COMMENT '选项值',
  `de` text NOT NULL COMMENT '选项描述',
  `num` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='选项表';

--
-- 转存表中的数据 `opt`
--

INSERT INTO `opt` (`id`, `topic_id`, `ABC`, `de`, `num`) VALUES
(132, 115, 'A', '安卓', 1),
(133, 115, 'B', 'windows', 2),
(134, 116, 'A', '米饭', 0),
(135, 116, 'B', '馒头', 2),
(136, 116, 'C', '不知道', 1),
(137, 117, 'A', '张三', 0),
(138, 117, 'B', '李四', 1),
(139, 117, 'C', '王五', 0),
(140, 117, 'D', '赵六', 1),
(141, 118, 'A', '吃饭', 1),
(142, 118, 'B', '睡觉', 1),
(143, 118, 'C', '打豆豆', 0);

-- --------------------------------------------------------

--
-- 表的结构 `topic`
--

CREATE TABLE `topic` (
  `id` int(11) NOT NULL,
  `de` text NOT NULL COMMENT '问题描述',
  `mult` tinyint(1) NOT NULL COMMENT '是否多选'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `topic`
--

INSERT INTO `topic` (`id`, `de`, `mult`) VALUES
(115, '买平板电脑你倾向于哪个系统？', 0),
(116, '今天晚上吃什么？', 0),
(117, '你觉得谁应当选班长？', 0),
(118, '你现在在干嘛？（多选）', 1);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `id` int(20) NOT NULL,
  `name` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `email`) VALUES
(1, 'kacey', 'd50e0c23ea3a400efe893023467acf462816bea6', 'sd_hukaixuan@163.com'),
(2, 'test', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'sd_hukaixuan@163.com'),
(4, 'xiaohong', 'bcb58c91e18656345fafda2f2914264135091014', 'xiaohong@qq.com'),
(5, 'xiaoming', 'a1221c1ba6f59571346ce1c94abd7725961e3d2d', 'xiaoming@qq.com'),
(6, 'xiaolan', '07a23703f28443cc1dcce28d20e3203e809b4820', 'xiaolan@163.com'),
(7, 'zhangsan', 'b07b1ba3f5ddf0788a32b3caa5ab943c6230af6a', 'zhangsan@163.com'),
(8, 'root', 'd50e0c23ea3a400efe893023467acf462816bea6', 'root@qq.gmail'),
(9, 'mm', 'cecec3ec436bf58a4ecce3e179835e25ff691f3e', 'mm@qq.com');

-- --------------------------------------------------------

--
-- 表的结构 `user_topic`
--

CREATE TABLE `user_topic` (
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `flag` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user_topic`
--

INSERT INTO `user_topic` (`user_id`, `topic_id`, `flag`) VALUES
(1, 115, 1),
(1, 116, 1),
(1, 117, 1),
(1, 118, 1),
(6, 115, 1),
(6, 116, 1),
(8, 115, 1),
(8, 116, 1),
(8, 116, 2),
(8, 117, 1),
(8, 117, 2),
(8, 118, 1),
(8, 118, 2),
(9, 115, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `opt`
--
ALTER TABLE `opt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_topic`
--
ALTER TABLE `user_topic`
  ADD PRIMARY KEY (`user_id`,`topic_id`,`flag`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `opt`
--
ALTER TABLE `opt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;
--
-- 使用表AUTO_INCREMENT `topic`
--
ALTER TABLE `topic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;
--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
