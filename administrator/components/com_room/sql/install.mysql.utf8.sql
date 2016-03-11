CREATE TABLE `#__lesson` (
    `id` integer(10) UNSIGNED NOT NULL auto_increment,
    `title` varchar(255) NOT NULL,
    `description` text NULL,
    `code` text NULL,
    `parent_id` integer(10) NULL,
    PRIMARY KEY  (`id`)
)  DEFAULT CHARSET=utf8;

INSERT INTO `#__lesson` (`id`, `title`, `description`, `code`, `parent_id`) VALUES
(1, 'Урок 1', 'Познакомимся с основами интернета и другими базовыми знаниями необходимыми каждому веб программисту. Ты попрактикуешься в создании простых HTМL страничек.', '<iframe src="https://player.vimeo.com/video/66967728" width="100%" height="450px" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>', NULL),
(2, 'Урок 2', 'Углубимся в изучение HTML и рассмотрим СSS ( таблицы стилей ). В конце этого урока у Тебя должна быть страничка интернет-магазина, с которой мы и будем рабоать в последующих уроках.', '<iframe src="https://player.vimeo.com/video/66341790" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>', NULL),
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