SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `testing_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `user_answer` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `answered` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `answers` (`id`, `testing_id`, `question_id`, `user_answer`, `answered`) 
VALUES (1, 1, 1, 'Правильна відповідь', 1);

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


CREATE TABLE `entries` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `training_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `progress` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Записи на тренінги';


INSERT INTO `entries` (`id`, `user_id`, `training_id`, `date`, `progress`) 
VALUES (1, 1, 1, '2017-12-11 16:54:10', 0);


CREATE TABLE `invites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `training_id` int(11) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '0 - waining, 1 - accepted, 2 - not accepted'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `invites` (`id`, `user_id`, `training_id`, `status`, `date`) 
VALUES (1, 1, 1, 1, '2017-12-11 16:53:54');

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
(1, 'Вступ', 'Інформаці́йні техноло́гії, ІТ (використовується також загальніший / вищий за ієрархією термін інформаційно-комунікаційні технології (Information and Communication Technologies, ICT) — сукупність методів, виробничих процесів і програмно-технічних засобів, інтегрованих з метою збирання, опрацювання, зберігання, розповсюдження, показу і використання інформації в інтересах її користувачів.[джерело?]\r\n\r\nТехнології, що забезпечують та підтримують інформаційні процеси, тобто процеси пошуку, збору, передачі, збереження, накопичення, тиражування інформації та процедури доступу до неї.', '2017-12-11 14:52:26', 1);

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
(1, 'Nokia 6 (2018) может получить Snapdragon 660', 'Появились некоторые детали относительно обновленного варианта смартфона Nokia 6. Если верить утечкам, он будет интереснее оригинальной модели. Первый вариант Nokia 6 был анонсирован в феврале этого года. \r\nСамый мощный на тот момент смартфон HMD/Nokia получил чип Snapdragon 430, 3 + 32 ГБ и ценник в районе $250, что, по меркам 2017, очень печально. По имеющимся сведениям, Nokia 6 (2018) будет основан на производительном Snapdragon 660 и получит 4 ГБ RAM и 32 ГБ хранилища.\r\n\r\nЭто куда как более приемлемо. Ожидается, что новинка похвастается экраном 18:9 с тонкими рамками, следовательно, с вероятностью 99% сканер отпечатка пальца будет сзади. Представить Nokia 6 (2018) могут на Mobile World Congress, и наверняка модель будет дороже первого варианта, выпущенного почти год назад. ', '2017-12-11 11:12:35', 1);

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
(1, 'Тестове питання', 'Правильна відповідь', 'Не правильна відповідь 1', 'Не правильна відповідь 2', 'Не правильна відповідь 3', 1);

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
(1, 'Математика', 'Матема́тика (грец. μάθημα — наука, знання, вивчення) — наука, яка первісно виникла як один з напрямків пошуку істини (у грецькій філософії) у сфері просторових відношень (землеміряння — геометрії) і обчислень (арифметики), для практичних потреб людини рахувати, обчислювати, вимірювати, досліджувати форми та рух фізичних тіл.'),
(2, 'Англійська мова', 'Англі́йська мо́ва (English, the English language) — мова, що належить до германської групи індоєвропейської сім\'ї мов. '),
(3, 'КІТ', 'Комп\'ютерно інформаційні технології');

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
(1, 1, '2017-12-11 15:34:10', 1, 1, 1);

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
(1, 'Тест', 1);

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
(1, 'Тестовий тренінг', 1, 3, 1);

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
(1, 'timoniann@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Timoniann', 'Timones', '2017-12-11 13:05:23', 2, NULL, 'Khust', NULL, NULL, NULL);

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
-- Индексы таблицы `invites`
--
ALTER TABLE `invites`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `entries`
--
ALTER TABLE `entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `invites`
--
ALTER TABLE `invites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `lections`
--
ALTER TABLE `lections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `testings`
--
ALTER TABLE `testings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `trainings`
--
ALTER TABLE `trainings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
