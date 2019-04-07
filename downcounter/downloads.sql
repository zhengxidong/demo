--
-- 表的结构 `downloads`
--

CREATE TABLE IF NOT EXISTS `downloads` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(50) NOT NULL,
  `savename` varchar(50) NOT NULL,
  `downloads` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `downloads`
--

INSERT INTO `downloads` (`id`, `filename`, `savename`, `downloads`) VALUES
(1, '测试文件.zip', '20130421091247586.zip', 11),
(2, 'Microsoft Office Word 文档.docx', '20130421098547547.docx', 5),
(3, 'Microsoft Office Excel 工作表.xlsx', '20130421098543323.xlsx', 3),
(4, 'ajax_load.gif', '20130421091134256.gif', 10),
(5, '测试压缩文件包.zip', '20130421094213455.zip', 2),
(6, 'Song.mp3', '20130421094213431.mp3', 2);

