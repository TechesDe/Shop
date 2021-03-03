-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Фев 02 2021 г., 17:45
-- Версия сервера: 8.0.23
-- Версия PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `production`
--

-- --------------------------------------------------------

--
-- Структура таблицы `characteristics`
--

CREATE TABLE `characteristics` (
  `ID_Model` int UNSIGNED NOT NULL,
  `Description` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Category` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `characteristics`
--

INSERT INTO `characteristics` (`ID_Model`, `Description`, `Category`) VALUES
(14, 'Керамический электрический 2л.', 'briefly'),
(15, 'Керамический электрический 1,7л.', 'briefly'),
(16, 'Керамический электрический 1,8л.', 'briefly'),
(17, 'Керамический электрический 2л.', 'briefly'),
(18, 'Водяной, керамическая подошва, вертикальное отпаривание', 'briefly');

-- --------------------------------------------------------

--
-- Структура таблицы `list`
--

CREATE TABLE `list` (
  `ID_List` int UNSIGNED NOT NULL,
  `ID_Customer` int UNSIGNED NOT NULL,
  `Status` enum('registration','received','ready','issued','canceled') NOT NULL,
  `Type_Pay` enum('site','shop') DEFAULT 'shop'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `list_product`
--

CREATE TABLE `list_product` (
  `ID_List` int UNSIGNED NOT NULL,
  `ID_Product` int UNSIGNED DEFAULT NULL,
  `ID_Model` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `manufacturer`
--

CREATE TABLE `manufacturer` (
  `ID_manufacturer` int UNSIGNED NOT NULL,
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `manufacturer`
--

INSERT INTO `manufacturer` (`ID_manufacturer`, `name`) VALUES
(30, 'Bauknecht'),
(17, 'Bosch'),
(13, 'Brayer'),
(43, 'Camelion'),
(19, 'Centek'),
(42, 'Delta'),
(28, 'Econ'),
(20, 'Energy'),
(14, 'First'),
(12, 'Galaxy'),
(24, 'Goodhelper'),
(38, 'Gorenje'),
(33, 'Holberg'),
(23, 'Homestar'),
(32, 'Indesit'),
(18, 'Irit Home'),
(10, 'Kelly'),
(15, 'Magnit'),
(11, 'Mercuryhaus'),
(35, 'Monstermount'),
(22, 'Polaris'),
(31, 'Privileg'),
(46, 'Remington'),
(25, 'Sakura'),
(39, 'Samsung'),
(27, 'Scarlet'),
(36, 'Sinbo'),
(21, 'Smile'),
(37, 'Snaige'),
(34, 'Wader'),
(26, 'Willmark'),
(45, 'Бердск'),
(29, 'Великие Реки'),
(16, 'Мастерица'),
(44, 'Микма'),
(40, 'Пскова'),
(41, 'Яромир');

-- --------------------------------------------------------

--
-- Структура таблицы `model`
--

CREATE TABLE `model` (
  `ID_model` int UNSIGNED NOT NULL,
  `BarCode` bigint UNSIGNED NOT NULL,
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ID_type` int UNSIGNED DEFAULT NULL,
  `ID_manufacturer` int UNSIGNED DEFAULT NULL,
  `ImgPath` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `model`
--

INSERT INTO `model` (`ID_model`, `BarCode`, `name`, `ID_type`, `ID_manufacturer`, `ImgPath`) VALUES
(14, 4680353001204, 'CT-0061', 16, 19, '\\img\\Чайники\\CT-0061.png'),
(15, 6920690014016, 'KL-1401', 16, 10, NULL),
(16, 4680353017632, 'CT-0066', 16, 19, NULL),
(17, 6920690014023, 'KL-1402', 16, 10, NULL),
(18, 5055539125965, 'PIR 2480AK', 17, 22, NULL),
(19, 2177617675087, 'ES20', 23, 32, NULL),
(20, 2122776131424, 'HRB 180SW', 23, 33, NULL),
(21, 4607119830687, 'RK 61620', 23, 38, NULL),
(22, 2101205918461, 'RE34SM-S1DA21', 23, 37, NULL),
(23, 2120582259554, 'WBP 714', 24, 30, NULL),
(24, 2157871458244, 'Super Eco 834', 24, 30, NULL),
(25, 2138724261990, 'PWF M 643', 24, 31, NULL),
(26, 2118552441634, 'WF 60F-1ROHOWDLP', 24, 39, NULL),
(27, 2119404947632, 'IWSC 6105 CIS', 24, 32, NULL),
(28, 2111578951750, 'BWSB 61051', 24, 32, NULL),
(29, 4242005135822, 'MFW 2520W', 20, 17, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `model_price`
--

CREATE TABLE `model_price` (
  `ID_model` int UNSIGNED NOT NULL,
  `Price` int NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `ID_Product` int UNSIGNED NOT NULL,
  `ID_Model` int UNSIGNED NOT NULL,
  `ID_Customer` int UNSIGNED DEFAULT NULL,
  `ID_Status` int UNSIGNED NOT NULL,
  `Price` int UNSIGNED DEFAULT NULL,
  `Date_Sale` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE `status` (
  `ID_Status` int UNSIGNED NOT NULL,
  `Name` varchar(18) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `type`
--

CREATE TABLE `type` (
  `ID_Type` int UNSIGNED NOT NULL,
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `type`
--

INSERT INTO `type` (`ID_Type`, `name`) VALUES
(16, 'Чайник'),
(17, 'Утюг'),
(18, 'Блендер'),
(19, 'Миксер'),
(20, 'Мясорубка'),
(21, 'Часы'),
(22, 'Кронштейн'),
(23, 'Холодильник'),
(24, 'Стиральная машина'),
(25, 'Духовой шкаф');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `ID_User` int UNSIGNED NOT NULL,
  `Email` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Phone` bigint NOT NULL,
  `Password` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Access` enum('customer','admin','seller') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'customer',
  `First_Name` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Second_Name` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Extra_Name` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`ID_User`, `Email`, `Phone`, `Password`, `Access`, `First_Name`, `Second_Name`, `Extra_Name`) VALUES
(10, 'kirillzelen00@gmail.com', 89118532550, '90d703cdb8e0b8bdba1a92eee47e2eff', 'seller', 'Кирилл', 'NULL', 'NULL');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `characteristics`
--
ALTER TABLE `characteristics`
  ADD KEY `ID_Model` (`ID_Model`);

--
-- Индексы таблицы `list`
--
ALTER TABLE `list`
  ADD PRIMARY KEY (`ID_List`),
  ADD KEY `ID_Customer` (`ID_Customer`);

--
-- Индексы таблицы `list_product`
--
ALTER TABLE `list_product`
  ADD KEY `ID_List` (`ID_List`),
  ADD KEY `ID_Product` (`ID_Product`),
  ADD KEY `ID_Model` (`ID_Model`);

--
-- Индексы таблицы `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`ID_manufacturer`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`ID_model`),
  ADD UNIQUE KEY `BarCode` (`BarCode`),
  ADD KEY `ID_Subtype` (`ID_type`),
  ADD KEY `ID_manufacturer` (`ID_manufacturer`);

--
-- Индексы таблицы `model_price`
--
ALTER TABLE `model_price`
  ADD KEY `ID_model` (`ID_model`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ID_Product`),
  ADD KEY `ID_Model` (`ID_Model`),
  ADD KEY `ID_Customer` (`ID_Customer`),
  ADD KEY `ID_Status` (`ID_Status`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`ID_Status`);

--
-- Индексы таблицы `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`ID_Type`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_User`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `ID_manufacturer` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT для таблицы `model`
--
ALTER TABLE `model`
  MODIFY `ID_model` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `ID_Product` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `ID_Status` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `type`
--
ALTER TABLE `type`
  MODIFY `ID_Type` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `ID_User` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `characteristics`
--
ALTER TABLE `characteristics`
  ADD CONSTRAINT `characteristics_ibfk_1` FOREIGN KEY (`ID_Model`) REFERENCES `model` (`ID_model`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `list`
--
ALTER TABLE `list`
  ADD CONSTRAINT `list_ibfk_1` FOREIGN KEY (`ID_Customer`) REFERENCES `user` (`ID_User`);

--
-- Ограничения внешнего ключа таблицы `list_product`
--
ALTER TABLE `list_product`
  ADD CONSTRAINT `list_product_ibfk_1` FOREIGN KEY (`ID_List`) REFERENCES `list` (`ID_List`),
  ADD CONSTRAINT `list_product_ibfk_2` FOREIGN KEY (`ID_Product`) REFERENCES `product` (`ID_Product`),
  ADD CONSTRAINT `list_product_ibfk_3` FOREIGN KEY (`ID_Model`) REFERENCES `model` (`ID_model`);

--
-- Ограничения внешнего ключа таблицы `model`
--
ALTER TABLE `model`
  ADD CONSTRAINT `model_ibfk_1` FOREIGN KEY (`ID_type`) REFERENCES `type` (`ID_Type`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `model_ibfk_2` FOREIGN KEY (`ID_manufacturer`) REFERENCES `manufacturer` (`ID_manufacturer`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `model_price`
--
ALTER TABLE `model_price`
  ADD CONSTRAINT `model_price_ibfk_1` FOREIGN KEY (`ID_model`) REFERENCES `model` (`ID_model`);

--
-- Ограничения внешнего ключа таблицы `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`ID_Status`) REFERENCES `status` (`ID_Status`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`ID_Customer`) REFERENCES `user` (`ID_User`),
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`ID_Model`) REFERENCES `model` (`ID_model`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
