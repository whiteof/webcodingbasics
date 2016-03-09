CREATE TABLE `#__lesson` (
    `id` integer(10) UNSIGNED NOT NULL auto_increment,
    `title` varchar(255) NOT NULL,
    `description` text NULL,
    `url` varchar(255) NOT NULL,
    PRIMARY KEY  (`id`)
)  DEFAULT CHARSET=utf8;

INSERT INTO `#__lesson` (`id`, `title`, `description`, `url`) VALUES
(1, 'Урок 1', '', 'lesson1.mp4'),
(2, 'Урок 2', '', 'lesson2.mp4'),
(3, 'Урок 3', '', 'lesson3.mp4'),
(4, 'Урок 4', '', 'lesson4.mp4'),
(5, 'Урок 5', '', 'lesson5.mp4'),
(6, 'Урок 6', '', 'lesson6.mp4'),
(7, 'Урок 7', '', 'lesson7.mp4');

CREATE TABLE `#__user_lesson` (
    `id` integer(10) UNSIGNED NOT NULL auto_increment,
    `lesson_id` integer NOT NULL,
    `user_id` integer NOT NULL,
    PRIMARY KEY  (`id`)
)  DEFAULT CHARSET=utf8;