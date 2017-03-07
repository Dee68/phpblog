-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Фев 26 2017 г., 10:17
-- Версия сервера: 10.1.13-MariaDB
-- Версия PHP: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `phpblog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `catid` int(11) NOT NULL,
  `catname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`catid`, `catname`) VALUES
(1, 'Python Language'),
(2, 'PHP language'),
(3, 'Java Language'),
(4, 'Bootstrap CSS');

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `post` int(11) NOT NULL,
  `commentator` int(11) NOT NULL,
  `comDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `comment`, `post`, `commentator`, `comDate`) VALUES
(4, 'Whao! python seems to be one of the greatest languages ever.\r\nGreat article keep it up.', 11, 2, '2017-02-23 07:27:19'),
(5, 'java is really an awesome language indeed.', 13, 11, '2017-02-24 10:44:47'),
(7, 'I believe python is the most concise of all programming languages', 10, 11, '2017-02-24 11:46:31'),
(8, 'A nice piece, welldone. Bootstrap CSS is fantastic!', 29, 1, '2017-02-25 18:35:45');

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE `pages` (
  `pageid` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `is_published` tinyint(1) DEFAULT '1',
  `body` text NOT NULL,
  `slug` varchar(100) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`pageid`, `title`, `is_published`, `body`, `slug`, `created_date`) VALUES
(1, 'About', 1, '<p><span style="color: #2c3e50; font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 22.5px;">PhpBlog is a blog that posts articles of various programming languages,web design, algorithms and all new informational technology to higher applied mathematics. The articles are written by good experts of their various fields.You can register as a member to ask questions to these experts, you are always welcome.</span></p>', 'about', '2017-02-26 01:26:32'),
(2, 'Service', 0, '<p>Our services</p>', 'service', '2017-02-26 01:32:57');

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `postid` int(11) NOT NULL,
  `posttitle` varchar(100) NOT NULL,
  `postcontent` text NOT NULL,
  `category` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `posttag` varchar(255) DEFAULT NULL,
  `postdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `postimage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`postid`, `posttitle`, `postcontent`, `category`, `author`, `posttag`, `postdate`, `postimage`) VALUES
(9, 'PHP Programming', '<p class="lead" style="box-sizing: border-box; margin: 0px 0px 21px; font-size: 22.5px; line-height: 1.4; color: #2c3e50; font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, vero, obcaecati, aut, error quam sapiente nemo saepe quibusdam sit excepturi nam quia corporis eligendi eos magni recusandae laborum minus inventore?</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10.5px; color: #2c3e50; font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 15px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, tenetur natus doloremque laborum quos iste ipsum rerum obcaecati impedit odit illo dolorum ab tempora nihil dicta earum fugiat. Temporibus, voluptatibus.</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10.5px; color: #2c3e50; font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 15px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, doloribus, dolorem iusto blanditiis unde eius illum consequuntur neque dicta incidunt ullam ea hic porro optio ratione repellat perspiciatis. Enim, iure!</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10.5px; color: #2c3e50; font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 15px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, nostrum, aliquid, animi, ut quas placeat totam sunt tempora commodi nihil ullam alias modi dicta saepe minima ab quo voluptatem obcaecati?</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10.5px; color: #2c3e50; font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 15px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dolor quis. Sunt, ut, explicabo, aliquam tenetur ratione tempore quidem voluptates cupiditate voluptas illo saepe quaerat numquam recusandae? Qui, necessitatibus, est!</p>', 2, 2, 'php,programming', '2017-02-20 15:45:31', 'php.jpg'),
(10, 'Creating With Python', '<p class="lead" style="box-sizing: border-box; margin: 0px 0px 21px; font-size: 22.5px; line-height: 1.4; color: #2c3e50; font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, vero, obcaecati, aut, error quam sapiente nemo saepe quibusdam sit excepturi nam quia corporis eligendi eos magni recusandae laborum minus inventore?</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10.5px; color: #2c3e50; font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 15px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, tenetur natus doloremque laborum quos iste ipsum rerum obcaecati impedit odit illo dolorum ab tempora nihil dicta earum fugiat. Temporibus, voluptatibus.</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10.5px; color: #2c3e50; font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 15px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, doloribus, dolorem iusto blanditiis unde eius illum consequuntur neque dicta incidunt ullam ea hic porro optio ratione repellat perspiciatis. Enim, iure!</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10.5px; color: #2c3e50; font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 15px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, nostrum, aliquid, animi, ut quas placeat totam sunt tempora commodi nihil ullam alias modi dicta saepe minima ab quo voluptatem obcaecati?</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10.5px; color: #2c3e50; font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 15px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dolor quis. Sunt, ut, explicabo, aliquam tenetur ratione tempore quidem voluptates cupiditate voluptas illo saepe quaerat numquam recusandae? Qui, necessitatibus, est!</p>', 1, 2, 'python,creating,creativity', '2017-02-20 15:47:52', 'images.png'),
(11, 'Python Programming', '<p class="lead" style="box-sizing: border-box; margin: 0px 0px 21px; font-size: 22.5px; line-height: 1.4; color: #2c3e50; font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, vero, obcaecati, aut, error quam sapiente nemo saepe quibusdam sit excepturi nam quia corporis eligendi eos magni recusandae laborum minus inventore?</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10.5px; color: #2c3e50; font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 15px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, tenetur natus doloremque laborum quos iste ipsum rerum obcaecati impedit odit illo dolorum ab tempora nihil dicta earum fugiat. Temporibus, voluptatibus.</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10.5px; color: #2c3e50; font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 15px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, doloribus, dolorem iusto blanditiis unde eius illum consequuntur neque dicta incidunt ullam ea hic porro optio ratione repellat perspiciatis. Enim, iure!</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10.5px; color: #2c3e50; font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 15px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, nostrum, aliquid, animi, ut quas placeat totam sunt tempora commodi nihil ullam alias modi dicta saepe minima ab quo voluptatem obcaecati?</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10.5px; color: #2c3e50; font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 15px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dolor quis. Sunt, ut, explicabo, aliquam tenetur ratione tempore quidem voluptates cupiditate voluptas illo saepe quaerat numquam recusandae? Qui, necessitatibus, est!</p>', 1, 1, 'python,programming', '2017-02-21 15:28:16', 'python-14.jpg'),
(13, 'JAVA VERSATILITY', '<p class="lead" style="box-sizing: border-box; margin: 0px 0px 21px; font-size: 22.5px; line-height: 1.4; color: #2c3e50; font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, vero, obcaecati, aut, error quam sapiente nemo saepe quibusdam sit excepturi nam quia corporis eligendi eos magni recusandae laborum minus inventore?</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10.5px; color: #2c3e50; font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 15px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, tenetur natus doloremque laborum quos iste ipsum rerum obcaecati impedit odit illo dolorum ab tempora nihil dicta earum fugiat. Temporibus, voluptatibus.</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10.5px; color: #2c3e50; font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 15px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, doloribus, dolorem iusto blanditiis unde eius illum consequuntur neque dicta incidunt ullam ea hic porro optio ratione repellat perspiciatis. Enim, iure!</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10.5px; color: #2c3e50; font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 15px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, nostrum, aliquid, animi, ut quas placeat totam sunt tempora commodi nihil ullam alias modi dicta saepe minima ab quo voluptatem obcaecati?</p>\r\n<p>&nbsp;</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10.5px; color: #2c3e50; font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dolor quis. Sunt, ut, explicabo, aliquam tenetur ratione tempore quidem voluptates cupiditate voluptas illo saepe quaerat numquam recusandae? Qui, necessitatibus, est!</p>', 3, 1, 'java,versatility', '2017-02-23 23:13:13', 'java.png'),
(26, 'Python For Kids', '<p class="lead" style="box-sizing: border-box; margin: 0px 0px 21px; font-size: 22.5px; line-height: 1.4; color: #2c3e50; font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, vero, obcaecati, aut, error quam sapiente nemo saepe quibusdam sit excepturi nam quia corporis eligendi eos magni recusandae laborum minus inventore?</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10.5px; color: #2c3e50; font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 15px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, tenetur natus doloremque laborum quos iste ipsum rerum obcaecati impedit odit illo dolorum ab tempora nihil dicta earum fugiat. Temporibus, voluptatibus.</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10.5px; color: #2c3e50; font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 15px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, doloribus, dolorem iusto blanditiis unde eius illum consequuntur neque dicta incidunt ullam ea hic porro optio ratione repellat perspiciatis. Enim, iure!</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10.5px; color: #2c3e50; font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 15px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, nostrum, aliquid, animi, ut quas placeat totam sunt tempora commodi nihil ullam alias modi dicta saepe minima ab quo voluptatem obcaecati?</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10.5px; color: #2c3e50; font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 15px;">&nbsp;</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10.5px; color: #2c3e50; font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 15px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dolor quis. Sunt, ut, explicabo, aliquam tenetur ratione tempore quidem voluptates cupiditate voluptas illo saepe quaerat numquam recusandae? Qui, necessitatibus, est!</p>', 1, 2, 'php, action, server', '2017-02-25 12:06:00', 'python.jpg'),
(29, 'Designing  Web Pages With Boostrap CSS', '<p class="lead" style="box-sizing: border-box; margin: 0px 0px 21px; font-size: 22.5px; line-height: 1.4; color: #2c3e50; font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, vero, obcaecati, aut, error quam sapiente nemo saepe quibusdam sit excepturi nam quia corporis eligendi eos magni recusandae laborum minus inventore?</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10.5px; color: #2c3e50; font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 15px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, tenetur natus doloremque laborum quos iste ipsum rerum obcaecati impedit odit illo dolorum ab tempora nihil dicta earum fugiat. Temporibus, voluptatibus.</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10.5px; color: #2c3e50; font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 15px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, doloribus, dolorem iusto blanditiis unde eius illum consequuntur neque dicta incidunt ullam ea hic porro optio ratione repellat perspiciatis. Enim, iure!</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10.5px; color: #2c3e50; font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 15px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, nostrum, aliquid, animi, ut quas placeat totam sunt tempora commodi nihil ullam alias modi dicta saepe minima ab quo voluptatem obcaecati?</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10.5px; color: #2c3e50; font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 15px;">&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10.5px; color: #2c3e50; font-family: Lato, ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dolor quis. Sunt, ut, explicabo, aliquam tenetur ratione tempore quidem voluptates cupiditate voluptas illo saepe quaerat numquam recusandae? Qui, necessitatibus, est!</p>', 4, 3, 'design , bootstrap , css', '2017-02-25 17:59:41', 'images4.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `rolename` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id`, `rolename`) VALUES
(1, 'member'),
(2, 'administtrator');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` text,
  `email` varchar(70) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `userimage` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `user_role` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `firstname`, `lastname`, `email`, `address`, `userimage`, `password`, `user_role`) VALUES
(1, 'admin', NULL, NULL, 'admin@gmail.com', NULL, NULL, '$2y$10$PPlTrDWqONuTaM5AgMj1S.5LdLKg7BsxfrgErNFrPqBtRUxTTFCLm', 2),
(2, 'john', 'john', 'velmont', 'jdoe123@gmail.com', '13 lenin avenue zaporozhye', 'python1.jpg', '$2y$10$uqDBRLoTIwzdci5/oNGpnucl/A3fmTdbdvRQU955I2C89LikyWxVC', 1),
(3, 'jane', NULL, NULL, 'jane123@yahoo.com', NULL, NULL, '$2y$10$/j2x9RmZoqz9R9Rwo1.F8erpiRK7lw1GZ7g5rPNYP4vCUI6jroU4a', 1),
(5, 'Andy', NULL, NULL, 'andy@gmail.com', NULL, NULL, '$2y$10$/IZ7jrLkeoFTif3/fbi3zuFEdYa83ahDstrLUemJaSja.9CJRIXLy', 1),
(11, 'marina', NULL, NULL, 'megeri1432@gmail.com', NULL, NULL, '$2y$10$b8f4484hx63LU2pC5Uxsxe8cwfMJtGcZBky7tEUCqfZSv5KHNZ97G', 1),
(13, 'Andrew', NULL, NULL, 'andrew@mail.ru', NULL, NULL, '$2y$10$bOUo09PKkzuKSDLrWiFjF.2KUu29Hl9umG0fhCmnNsCp7WHIbJL7S', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`catid`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post` (`post`,`commentator`),
  ADD KEY `commentator` (`commentator`);

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`pageid`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postid`),
  ADD KEY `category` (`category`,`author`),
  ADD KEY `author` (`author`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_role` (`user_role`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `pageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `postid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`commentator`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post`) REFERENCES `posts` (`postid`) ON DELETE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`author`) REFERENCES `user` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `posts_ibfk_3` FOREIGN KEY (`category`) REFERENCES `category` (`catid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`user_role`) REFERENCES `role` (`id`) ON DELETE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
