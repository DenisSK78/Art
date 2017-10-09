-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 06 2017 г., 14:25
-- Версия сервера: 5.5.53
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `gallery`
--

-- --------------------------------------------------------

--
-- Структура таблицы `author`
--

CREATE TABLE `author` (
  `author_id` int(3) NOT NULL,
  `author_name` tinytext NOT NULL,
  `person_id` int(5) NOT NULL,
  `author_biography` text,
  `aut_prim` text,
  `aut_napr` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `author`
--

INSERT INTO `author` (`author_id`, `author_name`, `person_id`, `author_biography`, `aut_prim`, `aut_napr`) VALUES
(1, 'Fedorov', 1, 'Родился в 1963, Закончил ВУЗ, работал-неработал, забил, опять работал', 'Надо переподписать договор!', 'Скульптура'),
(2, 'Артемьева', 4, 'Родилась в 1958, жила-жила, родила, працавала, устала, училась ну пока хватит', 'Забрать работы 13.09.17', 'Графика'),
(3, 'Шилов', 7, 'Родился в 1972, потомственный художник от слова худо, худо-до-дожник, по утрам делает зарядку.', 'Выставка в октябре', 'Лектор'),
(5, 'Ольга Коваленко', 101, NULL, 'Искусствовед, лекции. ', 'Лектор'),
(6, 'Шобин', 100, NULL, 'Артдизайн, современное искусство. Творческая группа Concept /Art /Confession.', 'Скульптор'),
(7, 'Асташёв', 99, NULL, 'Скульптура бронза.', 'Скульптор'),
(8, 'Петруль', 98, NULL, 'Основное картины, так же скульптура и др.', 'Художник'),
(9, 'Cesler', 97, NULL, 'Артобъекты, картины.', 'Артдизайн');

-- --------------------------------------------------------

--
-- Структура таблицы `collections`
--

CREATE TABLE `collections` (
  `coll_id` int(5) NOT NULL,
  `coll_name` tinytext NOT NULL,
  `author_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `collections`
--

INSERT INTO `collections` (`coll_id`, `coll_name`, `author_id`) VALUES
(2, 'Характеры', 1),
(3, 'Африка', 2),
(4, '555', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `events`
--

CREATE TABLE `events` (
  `event_id` int(3) NOT NULL,
  `event_name` tinytext NOT NULL,
  `event_date` date DEFAULT NULL,
  `event_addr` tinytext,
  `event_prim` text NOT NULL,
  `event_vid` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `event_date`, `event_addr`, `event_prim`, `event_vid`) VALUES
(1, 'Пикассо', '2017-03-04', 'Галерея', '', 'Лекция'),
(2, 'Горизонты', '2017-03-04', 'Галерея', '', 'Открытие выставки'),
(3, 'На закате', '2017-04-12', 'Галерея', '', 'Выставка'),
(4, 'Необычное', '2017-04-16', 'Галерея', '', 'Лекция'),
(5, 'Искуство в кино', '2017-05-20', 'Галерея', '', 'Выставка'),
(27, 'Фото', '2017-07-30', 'ул.Семёнова 12', '', 'Открытие выставки'),
(29, 'Осень', '2017-09-15', 'Галерея', 'Автор Асташёв', 'Открытие выставки'),
(30, 'Пятничный вечер', '2017-07-28', 'Галерея', 'Купить шампанское', 'Собрание'),
(31, 'Квадрат', '2017-07-31', 'Горецкого, 7', '20 человек, актовый зал', 'Лекции'),
(32, 'К концу лета', '2017-08-25', 'Галерея', 'О мероприятиях сентябя', 'Рассылка'),
(34, 'Выставка в Москве ', '2017-07-30', 'Варшавское шоссе, 125', 'отъезд 27', 'Выставка'),
(35, 'Современное искусство ч.1', '2017-09-08', 'Отель, Конференц зал.', '', 'Лекции'),
(36, 'Современное искусство ч.2', '2017-09-15', 'Отель, Конференц зал.', '', 'Лекции'),
(37, 'КОНЦЕПТУАЛИЗМ', '2017-09-22', 'Отель, Конференц зал.', '', 'Лекции'),
(38, 'Шобин новое', '2017-09-29', 'Отель, Галерея.', '', 'Выставка');

-- --------------------------------------------------------

--
-- Структура таблицы `logg_pass`
--

CREATE TABLE `logg_pass` (
  `lg_id` int(11) NOT NULL,
  `lg_logg` tinytext NOT NULL,
  `lg_pass` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `logg_pass`
--

INSERT INTO `logg_pass` (`lg_id`, `lg_logg`, `lg_pass`) VALUES
(1, 'user1', '$2y$10$5I1bwxqqJ/XRgHj1w6Ix3u4YhEDEhA1X08J2mQ6RbWOUNAiBqBDSC'),
(2, 'user2', '$2y$10$33v1fUBTPvwIymsewu0izeMGanPzbyEIdTb2DN4slUTX3KR8POhcm'),
(3, 'admin', '$2y$10$N9JQPAXyfeLPYmyeI1h3BePiGP.5Ea7ObQEIhGHFaXsuEeXwTUmAG');

-- --------------------------------------------------------

--
-- Структура таблицы `person`
--

CREATE TABLE `person` (
  `person_id` int(5) NOT NULL,
  `pers_name` tinytext NOT NULL,
  `pers_sex` enum('мужской','женский') NOT NULL,
  `pers_birth` date DEFAULT NULL,
  `pers_tel` tinytext,
  `pers_email` tinytext,
  `pers_adres` tinytext,
  `pers_con_phone` enum('1','0') NOT NULL DEFAULT '0',
  `pers_con_email` enum('1','0') NOT NULL DEFAULT '0',
  `pers_con_vib` enum('1','0') NOT NULL DEFAULT '0',
  `pers_con_whats` enum('1','0') NOT NULL DEFAULT '0',
  `pers_con_telegr` enum('1','0') NOT NULL DEFAULT '0',
  `pers_con_mesen` enum('1','0') NOT NULL DEFAULT '0',
  `pers_prim` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `person`
--

INSERT INTO `person` (`person_id`, `pers_name`, `pers_sex`, `pers_birth`, `pers_tel`, `pers_email`, `pers_adres`, `pers_con_phone`, `pers_con_email`, `pers_con_vib`, `pers_con_whats`, `pers_con_telegr`, `pers_con_mesen`, `pers_prim`) VALUES
(1, 'Фёдоров Иван Семёнович', 'мужской', '1974-07-09', '(029) 375-29-65', 'grin@mail.ru', 'Минск, ул.Горецкого 12/3-78', '1', '1', '0', '0', '0', '1', 'Интересует подарочный фонд.'),
(2, 'Жданов Генадий Михайлович', 'мужской', '1977-07-15', '(025) 485-25-12', 'sevm@mail.ru', 'Минск, ул.Зелёная 12-56', '1', '1', '0', '0', '1', '0', ''),
(3, 'Примов николай Семёнович', 'мужской', '1974-07-11', '(044) 294-56-81', 'sun@tut.by', 'Минск, ул.Солнечная 18', '1', '1', '0', '0', '0', '1', ''),
(4, 'Ирина Фёдоровна Артемьева', 'женский', '1959-01-16', '(029) 293-33-45', 'run@mail.ru', 'Минск, ул.Правды 124', '1', '1', '1', '0', '0', '0', 'Искусствовед.'),
(5, 'Фёдоров Иван Сергеевич', 'мужской', '1949-12-17', '(025) 489-23-12', 'get@mail.ru', 'Минск, ул.Белецкого 3/1-45', '1', '1', '1', '0', '0', '0', ''),
(6, 'Иванова Ира Александровна', 'женский', '1957-07-20', '(033) 458-21-21', 'print@mail.ru', 'Минск, ул.Ленина 45-12', '1', '1', '0', '1', '0', '0', 'Интересует Асташёв.'),
(7, 'Шилов Николай Иванович', 'мужской', '1952-12-12', '(033) 297-77-45', 'tip@mail.ru', 'Минск, ул.Мининина 12-78', '1', '1', '1', '0', '0', '0', 'Автор'),
(12, 'Силиверстров Иван Семёнович', 'мужской', '1968-07-26', '(802) 976-33-84', 'perviy@nomer.ru', 'Минск, Бирюзова 17д', '1', '0', '1', '0', '0', '0', 'Покупал в подарок из подарочного фонда.'),
(14, 'Жирова Екатерина Семёновна', 'женский', '1977-12-15', '(029) 564-34-21', 'kat@mail.ru', 'Минск, Железнодорожная, 17', '1', '1', '0', '0', '1', '0', 'Интересует скульптура.'),
(25, 'Ленина Галина Ивановна', 'женский', '2003-03-15', '(029) 678-76-89', 'lenin@giv.ru', 'Москва, Щелковское шоссе 13', '1', '1', '0', '1', '0', '0', 'интересует скульптура'),
(26, 'Еремеева Светлана', 'женский', '1976-11-20', '(017) 331-25-48', 'svet@open.by', 'Минск, ул.Ленина 17-14', '1', '1', '1', '0', '0', '1', 'Искуствовед - Современное искуство'),
(27, 'Зеленов Сергей Иванович', 'мужской', '2017-07-05', '(029) 567-45-67', 'zelenov@mail.ru', 'Мин. обл. п. \"Зелёное\"-27', '1', '1', '1', '0', '0', '0', 'Посещает лекции.'),
(28, 'Миров Сергей', 'мужской', '1962-03-14', '(029) 563-26-22', 'mir@tut.by', 'Минск, Вокзальная 12-12', '1', '1', '0', '1', '0', '0', 'Покупал картины.'),
(29, 'Герасимов Иван Федорович', 'мужской', '1957-02-15', '(029) 333-27-27', 'fedGer@rambler.ru', 'Минск, ул.Победителей 12/2-15', '1', '1', '0', '1', '0', '0', 'Интересует скульптура.'),
(30, 'Зиновьев Пётр Иванович', 'мужской', '1952-08-14', '(029) 640-00-03', 'zinovyev@rambler.ru', 'Минск, Гинтовта 12-12', '1', '1', '1', '0', '1', '1', 'Интересует Асташёв'),
(31, 'Петрова Ирина', 'женский', '1975-08-07', '(033) 784-56-23', 'koroleva@google.com', 'Минск, ул. Зелёная 12', '1', '1', '0', '1', '1', '1', 'Картины \"Петруль\"'),
(61, 'Силивёрстов Игорь', 'мужской', '1980-03-22', '(033) 456-46-46', 'sil@tut.by', 'Минск, Темерязьева 7а-30', '1', '1', '1', '1', '0', '1', 'Интересуют картины для интерьера, дизайнер.'),
(62, 'Петровичь Иван', 'мужской', '1990-05-12', '(044) 564-65-45', 'yunga@tut.by', 'Минск, Захарова 12/2-17', '1', '0', '0', '1', '1', '1', 'Дизайн интерьера.'),
(63, 'Петрова Марина', 'женский', '1976-08-13', '(029) 564-45-46', 'mary@net.su', 'Минск, Держинского, 100', '1', '0', '1', '0', '1', '0', 'лекции'),
(95, 'Белкович Евгений', 'мужской', '1960-08-26', '(029) 568-15-42', 'belka@mail.ru', 'Минск, Белецкого 12/2-89', '1', '1', '1', '1', '1', '1', 'лекции современное искусство '),
(97, 'Цеслер Владимир Юрьевич', 'мужской', '1959-08-22', '(029) 664-44-55', 'cesler@tut.by', 'Минск, ул.Богдановича 28-34', '1', '1', '1', '0', '1', '1', 'автор'),
(98, 'Петруль Максим Семёнович', 'мужской', '1965-08-14', '(033) 333-55-22', 'petrul@tut.by', 'Минск, Независимости 17-67', '1', '1', '1', '1', '0', '1', 'автор'),
(99, 'Асташёв Андрей Андреевич', 'мужской', '1974-06-21', '(033) 444-55-66', 'ostashev@rambler.ru', 'Минск, Зелёная 17', '1', '1', '1', '1', '1', '0', 'автор'),
(100, 'Шобин Олег Александрович', 'мужской', '1970-04-26', '(029) 555-45-47', 'shobin@tut.by', 'Минск, Держинского, 87-12', '1', '1', '1', '1', '1', '1', 'автор'),
(101, 'Коваленко Ольга Ивановна', 'женский', '1963-01-10', '(029) 742-56-56', 'kovalenko@open.by', 'Минск, Бародулина 12-60', '1', '1', '0', '1', '0', '0', 'лектор');

-- --------------------------------------------------------

--
-- Структура таблицы `subjects`
--

CREATE TABLE `subjects` (
  `subj_id` int(5) NOT NULL,
  `subj_name` tinytext NOT NULL,
  `subj_b_date` int(4) DEFAULT NULL,
  `subj_razmX` int(11) DEFAULT NULL,
  `subj_razmY` int(11) DEFAULT NULL,
  `subj_razmZ` int(11) DEFAULT NULL,
  `author_id` int(3) NOT NULL,
  `subj_mat` tinytext NOT NULL,
  `subj_vid` tinytext NOT NULL,
  `subj_prim` text NOT NULL,
  `Cost` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `subjects`
--

INSERT INTO `subjects` (`subj_id`, `subj_name`, `subj_b_date`, `subj_razmX`, `subj_razmY`, `subj_razmZ`, `author_id`, `subj_mat`, `subj_vid`, `subj_prim`, `Cost`) VALUES
(1, 'Хитрый', 2007, 15, 15, 40, 7, 'Бронза', 'Скульптура', 'Настольная.....', 0),
(2, 'Самурай и девочка', 2014, 25, 35, 80, 7, 'Бронза', 'Скульптура', '', 0),
(3, 'Богомол', 2012, 10, 15, 60, 9, 'Холст', 'Картина', '', 0),
(4, 'Стрелок', 2003, 150, 150, 400, 8, 'Бронза', 'Скульптура', '', 0),
(5, 'Расвет', 2015, 800, 1200, 20, 5, 'Картон', 'Фото', '', 0),
(8, 'Княжна', 2015, 100, 110, 350, 5, 'Бронза', 'Скульптура', 'Зал галереи.', 0),
(9, 'Слон', 2016, 100, 300, 200, 2, 'Малахит', 'Скульптура', '', 0),
(10, 'Поезд', 2007, 0, 1200, 600, 9, 'Холст', 'Графика', '3 этаж отеля.', 0),
(11, 'Весна', 2015, 230, 230, 800, 6, 'Бронза', 'Скульптура', 'Выставлена на центральном входе отеля.', 0),
(14, 'Море', 2016, 0, 1000, 450, 8, 'Бронза', 'Картина', 'Синий фон............', 0),
(15, 'Геометрия', 2008, 0, 1200, 900, 8, 'Холст', 'Картина', 'в красном фоне', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`),
  ADD KEY `person_id` (`person_id`);

--
-- Индексы таблицы `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`coll_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Индексы таблицы `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Индексы таблицы `logg_pass`
--
ALTER TABLE `logg_pass`
  ADD PRIMARY KEY (`lg_id`);

--
-- Индексы таблицы `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`person_id`);

--
-- Индексы таблицы `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subj_id`),
  ADD KEY `author_id` (`author_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `author`
--
ALTER TABLE `author`
  MODIFY `author_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `collections`
--
ALTER TABLE `collections`
  MODIFY `coll_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT для таблицы `logg_pass`
--
ALTER TABLE `logg_pass`
  MODIFY `lg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `person`
--
ALTER TABLE `person`
  MODIFY `person_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT для таблицы `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subj_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `author`
--
ALTER TABLE `author`
  ADD CONSTRAINT `author_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`);

--
-- Ограничения внешнего ключа таблицы `collections`
--
ALTER TABLE `collections`
  ADD CONSTRAINT `collections_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`);

--
-- Ограничения внешнего ключа таблицы `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
