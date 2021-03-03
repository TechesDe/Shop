-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Фев 14 2021 г., 17:40
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
  `Category` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ID_Characteristic` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `characteristics`
--

INSERT INTO `characteristics` (`ID_Model`, `Description`, `Category`, `ID_Characteristic`) VALUES
(51, 'Меняет цвет при нагревании', 'Дополнительно', 1),
(51, '1.8л', 'Объем', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `ID_Model` int UNSIGNED NOT NULL,
  `Path` varchar(128) NOT NULL,
  `number` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`ID_Model`, `Path`, `number`) VALUES
(51, '../img/Чайник/6920691314870-0.jpeg', 0),
(51, '../img/Чайник/6920691314870-1.jpeg', 1),
(54, '../img/Чайник/9120099331012-1.jpg', 0);

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
(57, 'Brayer'),
(56, 'Kelly');

-- --------------------------------------------------------

--
-- Структура таблицы `model`
--

CREATE TABLE `model` (
  `ID_model` int UNSIGNED NOT NULL,
  `BarCode` bigint UNSIGNED NOT NULL,
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ID_type` int UNSIGNED DEFAULT NULL,
  `ID_manufacturer` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `model`
--

INSERT INTO `model` (`ID_model`, `BarCode`, `name`, `ID_type`, `ID_manufacturer`) VALUES
(51, 6920691314870, 'KL-1487', 30, 56),
(54, 9120099331012, 'BR1045YE', 30, 57);

-- --------------------------------------------------------

--
-- Структура таблицы `model_price`
--

CREATE TABLE `model_price` (
  `ID_model` int UNSIGNED NOT NULL,
  `Price` int NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `model_price`
--

INSERT INTO `model_price` (`ID_model`, `Price`, `Date`) VALUES
(51, 1400, '2021-02-14'),
(54, 1300, '2021-02-14');

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
(30, 'Чайник');

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
(10, 'kirillzelen00@gmail.com', 89118532550, '90d703cdb8e0b8bdba1a92eee47e2eff', 'seller', 'Кирилл', 'NULL', 'NULL'),
(12, 'cranzurik70@mail.ru', 89118540669, '44cee3b863dc0f80f23beb36e1249009', 'seller', 'Юрий', 'Жилинский', 'NULL');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `characteristics`
--
ALTER TABLE `characteristics`
  ADD PRIMARY KEY (`ID_Characteristic`),
  ADD KEY `ID_Model` (`ID_Model`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
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
-- AUTO_INCREMENT для таблицы `characteristics`
--
ALTER TABLE `characteristics`
  MODIFY `ID_Characteristic` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `ID_manufacturer` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT для таблицы `model`
--
ALTER TABLE `model`
  MODIFY `ID_model` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

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
  MODIFY `ID_Type` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `ID_User` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `characteristics`
--
ALTER TABLE `characteristics`
  ADD CONSTRAINT `characteristics_ibfk_1` FOREIGN KEY (`ID_Model`) REFERENCES `model` (`ID_model`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`ID_Model`) REFERENCES `model` (`ID_model`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `model_ibfk_1` FOREIGN KEY (`ID_type`) REFERENCES `type` (`ID_Type`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `model_ibfk_2` FOREIGN KEY (`ID_manufacturer`) REFERENCES `manufacturer` (`ID_manufacturer`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `model_price`
--
ALTER TABLE `model_price`
  ADD CONSTRAINT `model_price_ibfk_1` FOREIGN KEY (`ID_model`) REFERENCES `model` (`ID_model`) ON DELETE CASCADE ON UPDATE CASCADE;

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
