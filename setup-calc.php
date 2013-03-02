<?php
$query = <<<SQL

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

DROP TABLE IF EXISTS `data`;
CREATE TABLE IF NOT EXISTS `data` (
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `map` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `range` double NOT NULL,
  `val` double NOT NULL,
  `time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `blurb` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `projmaps`;
CREATE TABLE IF NOT EXISTS `projmaps` (
  `project` int(4) NOT NULL,
  `map` int(4) NOT NULL AUTO_INCREMENT,
  `private` tinyint(1) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`map`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `projusers`;
CREATE TABLE IF NOT EXISTS `projusers` (
  `project` int(4) NOT NULL,
  `user` int(4) NOT NULL,
  `isAdmin` int(4) NOT NULL,
  KEY `user` (`user`),
  KEY `project` (`project`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `hash` varchar(50) NOT NULL,
  `uid` int(4) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


SQL;
if (isset($request[1]) && $request[1] == 'yesreset') {
	$database->query($query);
	//$project = new Project();
	//$project->createNew(array());
	//$project->addMap(new Map());
}
?>