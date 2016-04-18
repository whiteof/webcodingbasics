CREATE TABLE `#__survey_stepone` (
    `id` integer(10) UNSIGNED NOT NULL auto_increment,
    `first_name` varchar(255) NOT NULL DEFAULT '',
    `last_name` varchar(255) NOT NULL DEFAULT '',
    `years_in_usa` integer NOT NULL,
    `job` varchar(255) NOT NULL DEFAULT '',
    `education` integer NOT NULL,
    `english_level` integer NOT NULL,
    `why` text NOT NULL DEFAULT '',
    `what` text NOT NULL DEFAULT '',
    `sex` varchar(20) NOT NULL DEFAULT '',
    `age` varchar(20) NOT NULL DEFAULT '',
    `how` varchar(255) NOT NULL DEFAULT '',
    `email` varchar(100) NOT NULL DEFAULT '',
    `user_id` integer NOT NULL,
    `ip` varchar(20) NULL,
    `created` datetime NOT NULL default '0000-00-00 00:00:00',
    `created_by` int(10) unsigned NOT NULL default '0',
    PRIMARY KEY  (`id`)
)  DEFAULT CHARSET=utf8;

CREATE TABLE `#__survey_steptwo` (
    `id` integer(10) UNSIGNED NOT NULL auto_increment,
    `user_id` integer(10) NOT NULL,
    `family_situation` integer(10) NOT NULL,
    `learn_for` varchar(100) NOT NULL,
    `challenges` text NOT NULL,
    `expectations` text NOT NULL,
    `ip` varchar(20) NULL,
    `created` datetime NOT NULL default '0000-00-00 00:00:00',
    `created_by` int(10) unsigned NOT NULL default '0',
    PRIMARY KEY  (`id`)
)  DEFAULT CHARSET=utf8;

CREATE TABLE `#__survey_stepthree` (
    `id` integer(10) UNSIGNED NOT NULL auto_increment,
    `user_id` integer(10) NOT NULL,
    `why` text NOT NULL,
    `ip` varchar(20) NULL,
    `created` datetime NOT NULL default '0000-00-00 00:00:00',
    `created_by` int(10) unsigned NOT NULL default '0',
    PRIMARY KEY  (`id`)
)  DEFAULT CHARSET=utf8;