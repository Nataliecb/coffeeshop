-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 31 2017 г., 00:12
-- Версия сервера: 5.5.45-log
-- Версия PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `coffeeshop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart_items`
--

CREATE TABLE IF NOT EXISTS `cart_items` (
  `id_item` int(4) NOT NULL AUTO_INCREMENT,
  `id_shop_item` int(4) NOT NULL,
  `id_order` int(4) NOT NULL,
  `quantity` int(4) NOT NULL,
  `id_weight` int(4) NOT NULL,
  `id_grist` int(4) NOT NULL,
  PRIMARY KEY (`id_item`),
  KEY `fk_id_grist` (`id_grist`),
  KEY `fk_id_item` (`id_shop_item`),
  KEY `fk_id_order` (`id_order`),
  KEY `fk_id_weight` (`id_weight`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `cart_items`
--

INSERT INTO `cart_items` (`id_item`, `id_shop_item`, `id_order`, `quantity`, `id_weight`, `id_grist`) VALUES
(1, 6, 6, 2, 1, 1),
(2, 3, 6, 1, 1, 1),
(3, 5, 6, 1, 1, 1),
(4, 6, 7, 2, 1, 1),
(5, 7, 7, 1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id_client` int(4) NOT NULL AUTO_INCREMENT,
  `fio` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `clients`
--

INSERT INTO `clients` (`id_client`, `fio`, `phone`, `email`) VALUES
(1, 'HI', 'GITLER', ''),
(2, 'ddd', 'dsadas', 'cdscs@gdf.jyu'),
(3, ' %D1%81%D1%8B%D0%B2', ' %D1%81%D0%B2%D1%8B', ' '),
(4, ' aaaaaa', ' dsdsa', ' '),
(5, ' fsd', ' fsd', ' '),
(6, ' ds', ' ds', ' '),
(7, ' %D0%B9%D0%B9%D0%B9%D0%B9%D0%B9%D0%B9%D0%B9', ' %D1%84%D1%84%D1%84%D1%84%D1%84%D1%84%D1%84%D1%84', ' '),
(8, ' %D0%B0%D0%B2%D1%8B', ' %D0%B0%D1%8B%D0%B2', ' '),
(9, ' sssss', ' dsdd', ' '),
(10, ' rr', ' ggg', ' '),
(11, ' lal', ' dsdas', ' ');

-- --------------------------------------------------------

--
-- Структура таблицы `coffee`
--

CREATE TABLE IF NOT EXISTS `coffee` (
  `id_coffee` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(40) NOT NULL,
  PRIMARY KEY (`id_coffee`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `coffee`
--

INSERT INTO `coffee` (`id_coffee`, `name`, `type`, `description`, `image`) VALUES
(1, 'Ethiopia Biftu Gudina', 'afrika', 'Вкус: аромат тропических фруктов и бузины', 'afrika_1.png'),
(2, 'Kenya Gathaithi', 'afrika', 'Вкус: аромат жасмина и красных ягод', 'afrika_2.png'),
(3, 'Kenya Kagongo', 'afrika', 'Вкус: сладкий лимон и красные ягоды', 'afrika_3.png'),
(4, 'Brazil Ferro', 'south_america', 'Вкус: яркий вкус лесного ореха и шоколада', 'south_amerika_1.png'),
(5, 'Colombia Divino Nino', 'south_america', 'Вкус: аромат дыни, апельсина и какао', 'south_amerika_2.png'),
(7, 'Costa Rica Lajas Negra', 'central_america', 'Вкус: апельсин, шоколад и лесной орех', 'central_amerika_1.png'),
(8, 'Costa Rica Lajas Honey', 'central_america', 'Вкус: слива, черная смородина и сухофрукты', 'central_amerika_2.png'),
(9, 'Indonesia Kintamani', 'asia', 'Вкус: имбирь, лайм и какао', 'asia.png');

-- --------------------------------------------------------

--
-- Структура таблицы `grists`
--

CREATE TABLE IF NOT EXISTS `grists` (
  `id_grist` int(4) NOT NULL AUTO_INCREMENT,
  `value` varchar(50) NOT NULL,
  PRIMARY KEY (`id_grist`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `grists`
--

INSERT INTO `grists` (`id_grist`, `value`) VALUES
(1, 'Цельные зерна'),
(2, 'Крупный помол'),
(3, 'Средний помол'),
(4, 'Мелкий помол');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id_order` int(4) NOT NULL AUTO_INCREMENT,
  `id_client` int(4) NOT NULL,
  `address` varchar(50) NOT NULL,
  `date_receive` date NOT NULL,
  `suggestions` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_order`),
  KEY `fk_id_client` (`id_client`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id_order`, `id_client`, `address`, `date_receive`, `suggestions`, `status`) VALUES
(1, 1, 'lol', '2010-01-17', '', 0),
(2, 2, 'dasad', '2017-01-13', 'dasdsa', 0),
(3, 3, ' %D1%81%D0%B2%D1%8B', '2017-01-10', ' ', 0),
(4, 4, ' ssssa', '2017-01-12', ' ', 0),
(5, 8, ' %D0%B0%D0%B2%D1%8B', '2017-01-11', ' ', 0),
(6, 10, ' nnn', '2017-01-11', ' ', 0),
(7, 11, ' eeeee', '2017-01-13', ' dfdsfcdscds', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_items`
--

CREATE TABLE IF NOT EXISTS `shop_items` (
  `id_item` int(4) NOT NULL AUTO_INCREMENT,
  `id_coffee` int(4) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `date_make` date NOT NULL,
  PRIMARY KEY (`id_item`),
  KEY `fk_id_coffee` (`id_coffee`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `shop_items`
--

INSERT INTO `shop_items` (`id_item`, `id_coffee`, `price`, `date_make`) VALUES
(1, 1, '100.00', '2016-10-22'),
(2, 2, '120.00', '2016-10-22'),
(3, 3, '155.00', '2016-10-22'),
(4, 4, '95.00', '2016-10-22'),
(5, 5, '110.00', '2016-10-22'),
(6, 7, '160.00', '2016-10-22'),
(7, 8, '145.00', '2016-10-22'),
(8, 9, '125.00', '2016-10-22');

-- --------------------------------------------------------

--
-- Структура таблицы `subscribes`
--

CREATE TABLE IF NOT EXISTS `subscribes` (
  `id_subscribe` int(4) NOT NULL AUTO_INCREMENT,
  `fio` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_subscribe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `weight`
--

CREATE TABLE IF NOT EXISTS `weight` (
  `id_weight` int(4) NOT NULL AUTO_INCREMENT,
  `value` varchar(10) NOT NULL,
  PRIMARY KEY (`id_weight`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `weight`
--

INSERT INTO `weight` (`id_weight`, `value`) VALUES
(1, '2 кг'),
(2, '1 кг'),
(3, '500 г'),
(4, '250 г');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `fk_id_grist` FOREIGN KEY (`id_grist`) REFERENCES `grists` (`id_grist`),
  ADD CONSTRAINT `fk_id_item` FOREIGN KEY (`id_shop_item`) REFERENCES `shop_items` (`id_item`),
  ADD CONSTRAINT `fk_id_order` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`),
  ADD CONSTRAINT `fk_id_weight` FOREIGN KEY (`id_weight`) REFERENCES `weight` (`id_weight`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_id_client` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id_client`);

--
-- Ограничения внешнего ключа таблицы `shop_items`
--
ALTER TABLE `shop_items`
  ADD CONSTRAINT `fk_id_coffee` FOREIGN KEY (`id_coffee`) REFERENCES `coffee` (`id_coffee`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
