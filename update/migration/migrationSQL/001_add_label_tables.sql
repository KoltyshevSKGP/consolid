-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Час створення: Сер 12 2020 р., 19:28
-- Версія сервера: 5.7.30-0ubuntu0.16.04.1
-- Версія PHP: 7.3.18-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `sk`
--

-- --------------------------------------------------------
DROP TABLE `label_field`;
DROP TABLE `label_field_type`;
DROP TABLE `label_template`;
DROP TABLE `label_lang`;

--
-- Структура таблиці `label_company_lang`
--

CREATE TABLE `label_company_lang` (
                                      `id` int(12) NOT NULL,
                                      `company` int(11) NOT NULL,
                                      `lang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблиці `label_dictionary`
--

CREATE TABLE `label_dictionary` (
                                    `id` int(11) NOT NULL,
                                    `company_id` int(11) DEFAULT NULL,
                                    `product_id` int(11) DEFAULT NULL,
                                    `attr` varchar(255) NOT NULL,
                                    `lang` int(11) NOT NULL,
                                    `trans` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Структура таблиці `label_field`
--

CREATE TABLE `label_field` (
                               `id` int(11) NOT NULL,
                               `title` varchar(255) CHARACTER SET utf8 NOT NULL,
                               `name` varchar(255) CHARACTER SET utf8 NOT NULL,
                               `type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп даних таблиці `label_field`
--

INSERT INTO `label_field` (`id`, `title`, `name`, `type`) VALUES
(1, 'Баркод', 'barcode', 1),
(2, 'Дата виготовлення', 'prod_date', 3),
(3, 'Дата палетування', 'pal_date', 3),
(4, 'Вага нетто', 'netto', 2),
(5, 'Вага брутто', 'brutto', 2),
(6, 'Загальний тираж', 'circulation', 3),
(7, 'Тип паперу', 'paper_type', 4),
(8, 'Місто', 'city', 2);

-- --------------------------------------------------------

--
-- Структура таблиці `label_field_param`
--

CREATE TABLE `label_field_param` (
                                     `id` int(11) NOT NULL,
                                     `template_field` int(11) NOT NULL,
                                     `title` varchar(100) NOT NULL,
                                     `value` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `label_field_type`
--

CREATE TABLE `label_field_type` (
                                    `id` int(11) NOT NULL,
                                    `name` varchar(255) NOT NULL,
                                    `tag` varchar(100) NOT NULL,
                                    `params` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `label_field_type`
--

INSERT INTO `label_field_type` (`id`, `name`, `tag`, `params`) VALUES
(1, 'Баркод', 'svg', 'id, name'),
(2, 'Ручний ввід', 'input', 'id, name'),
(3, 'Ручний ввід із значенням', 'input', 'id, name, value'),
(4, 'Значення із бази даних', 'select', 'id, name, table, column');

-- --------------------------------------------------------

--
-- Структура таблиці `label_register`
--

CREATE TABLE `label_register` (
                                  `id` int(11) NOT NULL,
                                  `identifier` varchar(255) NOT NULL,
                                  `company` int(11) NOT NULL,
                                  `lang` int(11) NOT NULL,
                                  `template` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `label_content`
--

CREATE TABLE `label_content` (
                                 `id` int(11) NOT NULL,
                                 `label` int(11) NOT NULL,
                                 `title` varchar(100) DEFAULT NULL,
                                 `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `lang`
--

CREATE TABLE `label_lang` (
                              `id` int(11) NOT NULL,
                              `title` varchar(150) NOT NULL,
                              `short` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `label_lang`
--

INSERT INTO `label_lang` (`id`, `title`, `short`) VALUES
(1, 'Українська', 'ua'),
(2, 'English', 'en'),
(3, 'Polski', 'pl'),
(4, 'Spain', 'es');

-- --------------------------------------------------------

--
-- Структура таблиці `label_template`
--

CREATE TABLE `label_template` (
                                  `id` int(11) NOT NULL,
                                  `name` varchar(255) NOT NULL,
                                  `lang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Структура таблиці `label_template_field`
--

CREATE TABLE `label_template_field` (
                                        `id` int(11) NOT NULL,
                                        `template` int(11) NOT NULL,
                                        `field` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `label_template_param`
--

CREATE TABLE `label_template_param` (
                                        `id` int(11) NOT NULL,
                                        `template` int(11) NOT NULL,
                                        `format` varchar(50) DEFAULT 'A4',
                                        `orientation` varchar(50) DEFAULT 'P',
                                        `label_amount` int(11) DEFAULT '1',
                                        `page_amount` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `label_company_lang`
--
ALTER TABLE `label_company_lang`
    ADD PRIMARY KEY (`id`),
  ADD KEY `company` (`company`),
  ADD KEY `lang` (`lang`);

--
-- Індекси таблиці `label_dictionary`
--
ALTER TABLE `label_dictionary`
    ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `label_dictionary_label_lang_fk` (`lang`);

--
-- Індекси таблиці `label_field`
--
ALTER TABLE `label_field`
    ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`);

--
-- Індекси таблиці `label_field_param`
--
ALTER TABLE `label_field_param`
    ADD PRIMARY KEY (`id`),
  ADD KEY `label_field_param_label_template_field_fk` (`template_field`);

--
-- Індекси таблиці `label_field_type`
--
ALTER TABLE `label_field_type`
    ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `label_register`
--
ALTER TABLE `label_register`
    ADD PRIMARY KEY (`id`),
  ADD KEY `label_register_company_fk` (`company`),
  ADD KEY `label_register_label_lang_fk` (`lang`),
  ADD KEY `label_register_label_template_fk` (`template`);

--
-- Індекси таблиці `label_content`
--
ALTER TABLE `label_content`
    ADD PRIMARY KEY (`id`),
  ADD KEY `label_content_label_register_fk` (`label`);

--
-- Індекси таблиці `label_lang`
--
ALTER TABLE `label_lang`
    ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `label_template`
--
ALTER TABLE `label_template`
    ADD PRIMARY KEY (`id`),
  ADD KEY `label_template_label_lang_fk` (`lang`);

--
-- Індекси таблиці `template_field`
--
ALTER TABLE `label_template_field`
    ADD PRIMARY KEY (`id`),
  ADD KEY `label_field` (`field`),
  ADD KEY `label_template` (`template`);

--
-- Індекси таблиці `label_template_param`
--
ALTER TABLE `label_template_param`
    ADD PRIMARY KEY (`id`),
  ADD KEY `label_template_param_label_template_fk` (`template`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `label_company_lang`
--
ALTER TABLE `label_company_lang`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблиці `label_dictionary`
--
ALTER TABLE `label_dictionary`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблиці `label_field`
--
ALTER TABLE `label_field`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблиці `label_field_param`
--
ALTER TABLE `label_field_param`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблиці `label_field_type`
--
ALTER TABLE `label_field_type`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблиці `label_register`
--
ALTER TABLE `label_register`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблиці `label_content`
--
ALTER TABLE `label_content`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблиці `label_lang`
--
ALTER TABLE `label_lang`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблиці `label_template`
--
ALTER TABLE `label_template`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблиці `label_template_field`
--
ALTER TABLE `label_template_field`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблиці `label_template_param`
--
ALTER TABLE `label_template_param`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `label_company_lang`
--
ALTER TABLE `label_company_lang`
    ADD CONSTRAINT `label_company_lang_company_fk` FOREIGN KEY (`company`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `label_company_lang_label_lang_fk` FOREIGN KEY (`lang`) REFERENCES `label_lang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `label_dictionary`
--
ALTER TABLE `label_dictionary`
    ADD CONSTRAINT `company_id` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `label_dictionary_label_lang_fk` FOREIGN KEY (`lang`) REFERENCES `label_lang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `label_field`
--
ALTER TABLE `label_field`
    ADD CONSTRAINT `additional_label_fields_label_field_type_fk` FOREIGN KEY (`type`) REFERENCES `label_field_type` (`id`);

--
-- Обмеження зовнішнього ключа таблиці `label_field_param`
--
ALTER TABLE `label_field_param`
    ADD CONSTRAINT `label_field_param_label_template_field_fk` FOREIGN KEY (`template_field`) REFERENCES `label_template_field` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `label_register`
--
ALTER TABLE `label_register`
    ADD CONSTRAINT `label_register_company_fk` FOREIGN KEY (`company`) REFERENCES `company` (`id`),
  ADD CONSTRAINT `label_register_label_lang_fk` FOREIGN KEY (`lang`) REFERENCES `label_lang` (`id`),
  ADD CONSTRAINT `label_register_label_template_fk` FOREIGN KEY (`template`) REFERENCES `label_template` (`id`);

--
-- Обмеження зовнішнього ключа таблиці `label_content`
--
ALTER TABLE `label_content`
    ADD CONSTRAINT `label_content_label_register_fk` FOREIGN KEY (`label`) REFERENCES `label_register` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `label_template`
--
ALTER TABLE `label_template`
    ADD CONSTRAINT `label_template_label_lang_fk` FOREIGN KEY (`lang`) REFERENCES `label_lang` (`id`);

--
-- Обмеження зовнішнього ключа таблиці `label_template_field`
--
ALTER TABLE `label_template_field`
    ADD CONSTRAINT `label_template_field_label_field_fk` FOREIGN KEY (`field`) REFERENCES `label_field` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `label_template_field_label_template_fk` FOREIGN KEY (`template`) REFERENCES `label_template` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `label_template_param`
--
ALTER TABLE `label_template_param`
    ADD CONSTRAINT `label_template_param_label_template_fk` FOREIGN KEY (`template`) REFERENCES `label_template` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
