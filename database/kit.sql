-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 09 2017 г., 17:57
-- Версия сервера: 5.7.14
-- Версия PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `kit`
--

-- --------------------------------------------------------

--
-- Структура таблицы `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `testing_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `user_answer` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `answered` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `answers`
--

INSERT INTO `answers` (`id`, `testing_id`, `question_id`, `user_answer`, `answered`) VALUES
(1, 1, 1, 'Answer', 1),
(2, 1, 3, '1', 0),
(3, 2, 1, 'Answer', 1),
(4, 2, 3, 'True', 1),
(5, 3, 5, 'Lorem2', 0),
(6, 3, 6, 'False', 0),
(7, 3, 7, 'Yea', 0),
(8, 3, 8, 'Aga', 1),
(9, 4, 5, 'Lorem2', 0),
(10, 4, 6, 'True', 1),
(11, 4, 7, 'Yea', 0),
(12, 4, 8, 'Ok', 0),
(13, 5, 1, 'Var1', 0),
(14, 5, 3, 'True', 1),
(15, 6, 9, '2', 0),
(16, 6, 10, 'q', 1),
(17, 6, 11, 'e', 1),
(18, 7, 12, 'q', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `file_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `release_date` date DEFAULT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `title`, `description`, `file_name`, `author`, `user_id`, `release_date`, `subject_id`) VALUES
(1, 'Final project report', 'This is report for project...', '', 'Me', 0, '2015-05-05', 0),
(2, 'Final project report', 'This is report for project...', 'Final_Project_Report.pdf', 'Me', 0, '2015-05-05', 0),
(3, 'Final project report', 'This is report for project...', 'Final_Project_Report.pdf', 'Me', 2, '2015-05-05', 0),
(4, 'Final project report', 'This is report for project...', 'Final_Project_Report.pdf', 'Me', 2, '2015-05-05', 0),
(5, 'Inf-ak', 'No description', 'inf-ak.pdf', 'Me', 2, '2015-05-01', 0),
(6, 'Indicidual tasks', 'I dont know, who is it', 'Індивід. завдання.pdf', 'Me', 2, '2010-01-01', 0),
(7, 'Indicidual tasks', 'I dont know, who is it', '', 'Me', 2, '2017-01-01', 0),
(8, 'Indicidual tasks', 'I dont know, who is it', 'php9C86.tmp', 'Me', 2, '2017-01-01', 0),
(9, 'CodeWars', 'Description', 'phpD4C.tmp', 'Author', 2, '2016-01-04', 0),
(10, 'BookName', 'Desc', 'phpED60.tmp', 'Author', 2, '2018-01-05', 0),
(11, 'Programa Informatika', 'Some description', 'php8333.tmp', 'Author', 2, '2015-05-06', 3),
(12, 'English book', 'Some description', 'phpE6F6.tmp', 'Author', 2, '2015-01-08', 3),
(13, 'By math', 'Some description', 'phpDA4A.tmp', 'Me', 2, '2016-01-08', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `entries`
--

CREATE TABLE `entries` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `training_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `progress` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Записи на тренінги';

--
-- Дамп данных таблицы `entries`
--

INSERT INTO `entries` (`id`, `user_id`, `training_id`, `date`, `progress`) VALUES
(1, 2, 2, '2017-12-03 14:27:00', 0),
(2, 2, 2, '2017-12-03 14:53:00', 0),
(3, 2, 1, '2017-12-03 16:56:56', 0),
(4, 2, 4, '2017-12-03 18:39:46', 0),
(5, 3, 1, '2017-12-04 19:31:43', 0),
(6, 3, 3, '2017-12-05 12:06:18', 0),
(7, 2, 7, '2017-12-07 16:02:39', 0),
(8, 2, 3, '2017-12-08 02:24:35', 0),
(9, 3, 4, '2017-12-09 19:49:32', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `lections`
--

CREATE TABLE `lections` (
  `id` int(11) NOT NULL,
  `title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime DEFAULT NULL,
  `training_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `lections`
--

INSERT INTO `lections` (`id`, `title`, `content`, `date`, `training_id`) VALUES
(1, 'Test lection', 'This is test lection for...sad', '2017-11-29 20:33:16', 1),
(2, 'Some lection ', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio dolorum deleniti, ullam dolor facilis ea quia, dicta in, impedit reprehenderit iure tempora cupiditate quasi, distinctio ad illum quis rem! Voluptatibus!', '2017-11-29 20:39:08', 1),
(3, 'Lect1', 'Content', '2017-12-03 14:56:50', 2),
(4, 'Empty lection', 'Empty content', '2017-12-03 15:20:13', 3),
(5, 'So...', 'sadasd', '2017-12-03 15:20:19', 3),
(6, 'Predicates', 'Simple contentLorem ipsum dolor sit amet, consectetur adipisicing elit. Atque, ex. Eligendi ducimus commodi sapiente ullam a, animi rerum. Vel rerum, magnam vero culpa doloribus harum fuga quia laborum quos accusamus?\r\nQuantum\r\nsf\r\nsdsf\r\nsdfsdf\r\n', '2017-12-04 07:54:01', 4),
(7, 'Simple', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam distinctio quia, dolore necessitatibus nemo nam, dolor ducimus labore inventore, ea animi impedit assumenda totam, sequi libero alias asperiores eos voluptas.\r\nKaka', '2017-12-04 14:48:09', 4),
(8, 'Test navbar', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem officiis inventore consequuntur ratione omnis facere velit facilis debitis veniam sed sunt, perspiciatis asperiores harum atque dolore expedita esse, veritatis. Hic.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem officiis inventore consequuntur ratione omnis facere velit facilis debitis veniam sed sunt, perspiciatis asperiores harum atque dolore expedita esse, veritatis. Hic.\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem officiis inventore consequuntur ratione omnis facere velit facilis debitis veniam sed sunt, perspiciatis asperiores harum atque dolore expedita esse, veritatis. Hic.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem officiis inventore consequuntur ratione omnis facere velit facilis debitis veniam sed sunt, perspiciatis asperiores harum atque dolore expedita esse, veritatis. Hic.', '2017-12-04 16:06:35', 4),
(9, 'Some lection', 'Some titlefs;fsdfsdf', '2017-12-04 17:32:00', 1),
(10, 'Лекція', 'Контент', '2017-12-07 14:01:48', 7);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `date`, `user_id`) VALUES
(1, 'Some title', 'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.', '2017-11-28 14:34:55', 1),
(2, 'News title', '<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi dignissimos fugit id inventore, cum, minima a at sint nisi beatae sit consequuntur vel. Quidem rerum, dolores ab aliquid quo voluptatum!</div>\r\n<div>Corrupti harum recusandae dolorum, enim nostrum aliquid commodi pariatur, eum officia amet maiores iste tenetur dolor, placeat soluta, laboriosam doloribus quidem! Quam recusandae minima sequi sint ipsa, dolorem aliquam nisi.</div>\r\n<div>Quis magnam neque quae quisquam accusamus nemo amet saepe iste odio mollitia tempora sed eius veniam quo error optio, non ipsum autem corporis aliquid nulla temporibus, voluptate! Dolorem, velit nemo.</div>', '2017-11-29 22:09:25', 2),
(3, 'Lorem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis libero, architecto aut neque tempora placeat tenetur nesciunt tempore eos eum, vero laboriosam in incidunt quae, dolores sit a aliquid suscipit?', '2017-11-29 22:11:53', 2),
(4, 'Some', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate laborum dicta consectetur vero reprehenderit, eos autem, fugit veniam ex excepturi, accusantium blanditiis quisquam velit molestiae amet nisi labore nobis. Consequuntur.\r\nDoloribus tempore nesciunt placeat, quisquam aperiam quaerat non corporis, architecto libero deserunt, voluptatum veritatis? Placeat repellat, consectetur dolore laudantium quos ex quidem architecto tempore ipsum. At ratione impedit quo suscipit.\r\nNisi fuga temporibus iusto dolorum perferendis cum nemo omnis odio consequatur distinctio, est libero architecto similique aut soluta doloremque, enim corporis, assumenda saepe alias asperiores voluptates! Nesciunt, facere, sequi. Eveniet?\r\nQuidem porro unde cumque, similique nesciunt eos architecto, officia a laborum dolores in dicta minima doloremque deserunt magni quisquam ipsa earum veritatis ad? Labore distinctio est ipsa quod, eveniet dicta.\r\nPlaceat modi autem nesciunt, ullam, dignissimos, voluptatum hic qui laborum numquam sed esse rem quis blanditiis odio mollitia assumenda. Voluptates necessitatibus unde excepturi est vel, tenetur ipsam provident tempora beatae!', '2017-12-04 21:18:03', 2),
(5, 'Test title', 'TestContent', '2017-12-04 21:25:35', 2),
(6, 'Lorem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid repellat error, ipsa praesentium laboriosam omnis hic, asperiores soluta repellendus quasi sapiente fugit facere optio labore deleniti facilis, id, vel neque.\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum suscipit animi reiciendis ipsa exercitationem veniam, beatae excepturi voluptas numquam quod est, ipsam distinctio, accusantium earum odio aliquid quam nulla non?\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. In suscipit minus assumenda dolorem at repellendus sequi ratione quis. Minima quisquam corporis facilis pariatur praesentium magnam consequatur at enim aut nisi!', '2017-12-07 07:38:55', 2),
(7, 'Lorem2', '<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam eos nam expedita maiores, doloremque aspernatur obcaecati fugiat necessitatibus, ipsum quos soluta consectetur facere vero id inventore, sapiente porro eveniet minima.</div>\r\n<div>Earum aut nemo maxime doloremque error, fuga tenetur saepe neque quo accusantium ex qui explicabo architecto, voluptates ratione possimus consequatur voluptas culpa corporis ullam. Labore similique magni quidem quisquam nisi.</div>\r\n<div>Et natus at debitis beatae officia eum error quod alias totam repellat vel, mollitia cum aliquam corrupti distinctio expedita. Odio dolores officia dolore reprehenderit, sunt maiores nulla commodi illum quis?</div>\r\n<div>Optio eius rem minus aliquam aliquid, reiciendis vitae cupiditate consectetur blanditiis eligendi sapiente dicta vero nihil neque impedit cumque adipisci inventore quibusdam distinctio quaerat culpa ducimus maiores. Dolorem, ad, omnis?</div>\r\n<div>Dolores assumenda dignissimos sunt porro pariatur nisi atque repellendus, maxime accusantium odio provident adipisci exercitationem sint laboriosam voluptatum quod. Magnam porro, possimus velit corrupti atque omnis. Iste pariatur nisi perferendis.</div>', '2017-12-07 07:40:33', 2),
(8, 'Lorem3', '<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam eos nam expedita maiores, doloremque aspernatur obcaecati fugiat necessitatibus, ipsum quos soluta consectetur facere vero id inventore, sapiente porro eveniet minima.</div>\r\n<div>Earum aut nemo maxime doloremque error, fuga tenetur saepe neque quo accusantium ex qui explicabo architecto, voluptates ratione possimus consequatur voluptas culpa corporis ullam. Labore similique magni quidem quisquam nisi.</div>\r\n<div>Et natus at debitis beatae officia eum error quod alias totam repellat vel, mollitia cum aliquam corrupti distinctio expedita. Odio dolores officia dolore reprehenderit, sunt maiores nulla commodi illum quis?</div>\r\n<div>Optio eius rem minus aliquam aliquid, reiciendis vitae cupiditate consectetur blanditiis eligendi sapiente dicta vero nihil neque impedit cumque adipisci inventore quibusdam distinctio quaerat culpa ducimus maiores. Dolorem, ad, omnis?</div>\r\n<div>Dolores assumenda dignissimos sunt porro pariatur nisi atque repellendus, maxime accusantium odio provident adipisci exercitationem sint laboriosam voluptatum quod. Magnam porro, possimus velit corrupti atque omnis. Iste pariatur nisi perferendis.</div>', '2017-12-07 07:40:39', 2),
(9, 'Lorem4', '<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam eos nam expedita maiores, doloremque aspernatur obcaecati fugiat necessitatibus, ipsum quos soluta consectetur facere vero id inventore, sapiente porro eveniet minima.</div>\r\n<div>Earum aut nemo maxime doloremque error, fuga tenetur saepe neque quo accusantium ex qui explicabo architecto, voluptates ratione possimus consequatur voluptas culpa corporis ullam. Labore similique magni quidem quisquam nisi.</div>\r\n<div>Et natus at debitis beatae officia eum error quod alias totam repellat vel, mollitia cum aliquam corrupti distinctio expedita. Odio dolores officia dolore reprehenderit, sunt maiores nulla commodi illum quis?</div>\r\n<div>Optio eius rem minus aliquam aliquid, reiciendis vitae cupiditate consectetur blanditiis eligendi sapiente dicta vero nihil neque impedit cumque adipisci inventore quibusdam distinctio quaerat culpa ducimus maiores. Dolorem, ad, omnis?</div>\r\n<div>Dolores assumenda dignissimos sunt porro pariatur nisi atque repellendus, maxime accusantium odio provident adipisci exercitationem sint laboriosam voluptatum quod. Magnam porro, possimus velit corrupti atque omnis. Iste pariatur nisi perferendis.</div>', '2017-12-07 07:40:43', 2),
(10, 'Lorem5', '<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam eos nam expedita maiores, doloremque aspernatur obcaecati fugiat necessitatibus, ipsum quos soluta consectetur facere vero id inventore, sapiente porro eveniet minima.</div>\r\n<div>Earum aut nemo maxime doloremque error, fuga tenetur saepe neque quo accusantium ex qui explicabo architecto, voluptates ratione possimus consequatur voluptas culpa corporis ullam. Labore similique magni quidem quisquam nisi.</div>\r\n<div>Et natus at debitis beatae officia eum error quod alias totam repellat vel, mollitia cum aliquam corrupti distinctio expedita. Odio dolores officia dolore reprehenderit, sunt maiores nulla commodi illum quis?</div>\r\n<div>Optio eius rem minus aliquam aliquid, reiciendis vitae cupiditate consectetur blanditiis eligendi sapiente dicta vero nihil neque impedit cumque adipisci inventore quibusdam distinctio quaerat culpa ducimus maiores. Dolorem, ad, omnis?</div>\r\n<div>Dolores assumenda dignissimos sunt porro pariatur nisi atque repellendus, maxime accusantium odio provident adipisci exercitationem sint laboriosam voluptatum quod. Magnam porro, possimus velit corrupti atque omnis. Iste pariatur nisi perferendis.</div>', '2017-12-07 07:40:49', 2),
(11, 'Lorem6', '<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam eos nam expedita maiores, doloremque aspernatur obcaecati fugiat necessitatibus, ipsum quos soluta consectetur facere vero id inventore, sapiente porro eveniet minima.</div>\r\n<div>Earum aut nemo maxime doloremque error, fuga tenetur saepe neque quo accusantium ex qui explicabo architecto, voluptates ratione possimus consequatur voluptas culpa corporis ullam. Labore similique magni quidem quisquam nisi.</div>\r\n<div>Et natus at debitis beatae officia eum error quod alias totam repellat vel, mollitia cum aliquam corrupti distinctio expedita. Odio dolores officia dolore reprehenderit, sunt maiores nulla commodi illum quis?</div>\r\n<div>Optio eius rem minus aliquam aliquid, reiciendis vitae cupiditate consectetur blanditiis eligendi sapiente dicta vero nihil neque impedit cumque adipisci inventore quibusdam distinctio quaerat culpa ducimus maiores. Dolorem, ad, omnis?</div>\r\n<div>Dolores assumenda dignissimos sunt porro pariatur nisi atque repellendus, maxime accusantium odio provident adipisci exercitationem sint laboriosam voluptatum quod. Magnam porro, possimus velit corrupti atque omnis. Iste pariatur nisi perferendis.</div>', '2017-12-07 07:40:54', 2),
(12, 'Lorem7', '<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam eos nam expedita maiores, doloremque aspernatur obcaecati fugiat necessitatibus, ipsum quos soluta consectetur facere vero id inventore, sapiente porro eveniet minima.</div>\r\n<div>Earum aut nemo maxime doloremque error, fuga tenetur saepe neque quo accusantium ex qui explicabo architecto, voluptates ratione possimus consequatur voluptas culpa corporis ullam. Labore similique magni quidem quisquam nisi.</div>\r\n<div>Et natus at debitis beatae officia eum error quod alias totam repellat vel, mollitia cum aliquam corrupti distinctio expedita. Odio dolores officia dolore reprehenderit, sunt maiores nulla commodi illum quis?</div>\r\n<div>Optio eius rem minus aliquam aliquid, reiciendis vitae cupiditate consectetur blanditiis eligendi sapiente dicta vero nihil neque impedit cumque adipisci inventore quibusdam distinctio quaerat culpa ducimus maiores. Dolorem, ad, omnis?</div>\r\n<div>Dolores assumenda dignissimos sunt porro pariatur nisi atque repellendus, maxime accusantium odio provident adipisci exercitationem sint laboriosam voluptatum quod. Magnam porro, possimus velit corrupti atque omnis. Iste pariatur nisi perferendis.</div>', '2017-12-07 07:40:59', 2),
(13, 'Lorem8', '<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam eos nam expedita maiores, doloremque aspernatur obcaecati fugiat necessitatibus, ipsum quos soluta consectetur facere vero id inventore, sapiente porro eveniet minima.</div>\r\n<div>Earum aut nemo maxime doloremque error, fuga tenetur saepe neque quo accusantium ex qui explicabo architecto, voluptates ratione possimus consequatur voluptas culpa corporis ullam. Labore similique magni quidem quisquam nisi.</div>\r\n<div>Et natus at debitis beatae officia eum error quod alias totam repellat vel, mollitia cum aliquam corrupti distinctio expedita. Odio dolores officia dolore reprehenderit, sunt maiores nulla commodi illum quis?</div>\r\n<div>Optio eius rem minus aliquam aliquid, reiciendis vitae cupiditate consectetur blanditiis eligendi sapiente dicta vero nihil neque impedit cumque adipisci inventore quibusdam distinctio quaerat culpa ducimus maiores. Dolorem, ad, omnis?</div>\r\n<div>Dolores assumenda dignissimos sunt porro pariatur nisi atque repellendus, maxime accusantium odio provident adipisci exercitationem sint laboriosam voluptatum quod. Magnam porro, possimus velit corrupti atque omnis. Iste pariatur nisi perferendis.</div>', '2017-12-07 07:41:04', 2),
(14, 'Lorem9', '<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam eos nam expedita maiores, doloremque aspernatur obcaecati fugiat necessitatibus, ipsum quos soluta consectetur facere vero id inventore, sapiente porro eveniet minima.</div>\r\n<div>Earum aut nemo maxime doloremque error, fuga tenetur saepe neque quo accusantium ex qui explicabo architecto, voluptates ratione possimus consequatur voluptas culpa corporis ullam. Labore similique magni quidem quisquam nisi.</div>\r\n<div>Et natus at debitis beatae officia eum error quod alias totam repellat vel, mollitia cum aliquam corrupti distinctio expedita. Odio dolores officia dolore reprehenderit, sunt maiores nulla commodi illum quis?</div>\r\n<div>Optio eius rem minus aliquam aliquid, reiciendis vitae cupiditate consectetur blanditiis eligendi sapiente dicta vero nihil neque impedit cumque adipisci inventore quibusdam distinctio quaerat culpa ducimus maiores. Dolorem, ad, omnis?</div>\r\n<div>Dolores assumenda dignissimos sunt porro pariatur nisi atque repellendus, maxime accusantium odio provident adipisci exercitationem sint laboriosam voluptatum quod. Magnam porro, possimus velit corrupti atque omnis. Iste pariatur nisi perferendis.</div>', '2017-12-07 07:41:09', 2),
(15, 'Lorem10', '<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam eos nam expedita maiores, doloremque aspernatur obcaecati fugiat necessitatibus, ipsum quos soluta consectetur facere vero id inventore, sapiente porro eveniet minima.</div>\r\n<div>Earum aut nemo maxime doloremque error, fuga tenetur saepe neque quo accusantium ex qui explicabo architecto, voluptates ratione possimus consequatur voluptas culpa corporis ullam. Labore similique magni quidem quisquam nisi.</div>\r\n<div>Et natus at debitis beatae officia eum error quod alias totam repellat vel, mollitia cum aliquam corrupti distinctio expedita. Odio dolores officia dolore reprehenderit, sunt maiores nulla commodi illum quis?</div>\r\n<div>Optio eius rem minus aliquam aliquid, reiciendis vitae cupiditate consectetur blanditiis eligendi sapiente dicta vero nihil neque impedit cumque adipisci inventore quibusdam distinctio quaerat culpa ducimus maiores. Dolorem, ad, omnis?</div>\r\n<div>Dolores assumenda dignissimos sunt porro pariatur nisi atque repellendus, maxime accusantium odio provident adipisci exercitationem sint laboriosam voluptatum quod. Magnam porro, possimus velit corrupti atque omnis. Iste pariatur nisi perferendis.</div>', '2017-12-07 07:41:14', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `answer` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `variant1` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `variant2` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `variant3` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `test_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `questions`
--

INSERT INTO `questions` (`id`, `question`, `answer`, `variant1`, `variant2`, `variant3`, `test_id`) VALUES
(1, 'Some question', 'Answer', 'Var1', 'Var2', 'Var3', 1),
(2, 'Why me?', 'Cz u r z master', 'No', 'NO', 'NO', 4),
(3, 'Question1', 'True', '1', '1', '1', 1),
(4, 'Питання', 'Відповід ь', 'Варіант1', 'Варіант2', 'Варіант3', 5),
(5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem exercitationem molestiae mollitia a voluptates ipsam, alias quidem numquam ad pariatur culpa sed incidunt doloremque neque explicabo repellat suscipit modi autem.', 'Lorem1', 'Lorem2', 'Lorem3', 'Lorem4', 6),
(6, 'Question...', 'True', 'False', 'False', 'SSD', 6),
(7, 'Better place', 'Yes', 'Yea', 'Ohh', 'No', 6),
(8, 'Last question', 'Aga', 'Ok', 'Good', 'Nice', 6),
(9, 'Question', '1', '2', '3', '4', 3),
(10, 'WWW', 'q', 'w', 'e', 'r', 3),
(11, 'EEE', 'e', 'w', 'q', 'r', 3),
(12, 'GG', 'q', 'w', 'e', 'w', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `description`) VALUES
(3, 'English', 'London is a capital of Great Britain'),
(4, 'History', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(2, 'Математика', 'Хороший предмет');

-- --------------------------------------------------------

--
-- Структура таблицы `testings`
--

CREATE TABLE `testings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `test_id` int(11) NOT NULL,
  `questions_count` int(11) NOT NULL,
  `answered_count` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `testings`
--

INSERT INTO `testings` (`id`, `user_id`, `date`, `test_id`, `questions_count`, `answered_count`) VALUES
(1, 2, '2017-12-07 20:31:12', 1, 2, 1),
(2, 2, '2017-12-07 23:25:01', 1, 2, 2),
(3, 2, '2017-12-08 00:24:57', 6, 4, 1),
(4, 3, '2017-12-08 00:26:47', 6, 4, 1),
(5, 2, '2017-12-08 10:46:18', 1, 2, 1),
(6, 2, '2017-12-09 17:40:31', 3, 3, 2),
(7, 3, '2017-12-09 17:49:45', 2, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tests`
--

CREATE TABLE `tests` (
  `id` int(11) NOT NULL,
  `title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `training_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `tests`
--

INSERT INTO `tests` (`id`, `title`, `training_id`) VALUES
(1, 'FirstTest', 4),
(2, 'TestTest', 4),
(3, 'Adding test throught navbar', 4),
(4, 'Test', 1),
(5, 'Тест', 7),
(6, 'Test1', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `trainings`
--

CREATE TABLE `trainings` (
  `id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `private` tinyint(4) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `trainings`
--

INSERT INTO `trainings` (`id`, `name`, `user_id`, `subject_id`, `private`) VALUES
(1, 'Test training', 2, 2, 1),
(2, 'Test training 2', 2, 2, 1),
(3, 'Training123', 2, 2, 0),
(4, 'Learning English', 2, 3, 1),
(5, 'New training', 2, 3, 0),
(6, 'Created by user', 3, 3, 0),
(7, 'Тренінг', 2, 3, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `registration_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `access` int(11) NOT NULL DEFAULT '0',
  `last_visit` datetime DEFAULT NULL,
  `city` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `about` text COLLATE utf8_unicode_ci,
  `avatar` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `workplace` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `first_name`, `last_name`, `registration_date`, `access`, `last_visit`, `city`, `about`, `avatar`, `workplace`) VALUES
(2, 'timoniann@gmail.com', '5b1b68a9abf4d2cd155c81a9225fd158', 'Timoniann', 'Timones', '2017-11-29 12:40:16', 3, NULL, 'Khust', 'It is about for me', 'phpE2BE.tmp', 'UZhNU'),
(3, 'test@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Test', 'Test', '2017-11-30 12:17:10', 0, NULL, NULL, NULL, NULL, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lections`
--
ALTER TABLE `lections`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `testings`
--
ALTER TABLE `testings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `trainings`
--
ALTER TABLE `trainings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `entries`
--
ALTER TABLE `entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `lections`
--
ALTER TABLE `lections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `testings`
--
ALTER TABLE `testings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `trainings`
--
ALTER TABLE `trainings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
