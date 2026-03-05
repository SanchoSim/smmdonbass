-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Хост: MySQL-5.7:3306
-- Время создания: Мар 04 2026 г., 12:17
-- Версия сервера: 5.7.44
-- Версия PHP: 8.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `smmdonbass_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `login` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`id`, `login`, `password`) VALUES
(1, 'admin', '$2y$10$iYnONjOlinPVaG/sDG0dcuKkIcqbJTnGoxOhk28TK/x1sigHV.kKy');

-- --------------------------------------------------------

--
-- Структура таблицы `resources`
--

CREATE TABLE `resources` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('main','reserve') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `platform` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` enum('Новости','Авто/Мото','Поездки','Работа','Объявления','Недвижимость','Общение','Хобби','Услуги','Электроника') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Объявления',
  `type` enum('chat','channel') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'chat',
  `subscribers` int(11) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `priority` int(11) DEFAULT '0',
  `price` int(11) DEFAULT NULL,
  `pin_price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `resources`
--

INSERT INTO `resources` (`id`, `name`, `url`, `status`, `created_at`, `platform`, `category`, `type`, `subscribers`, `description`, `priority`, `price`, `pin_price`) VALUES
(2, 'Недвижимость | Продажа | Коммерческая ЛНР | ДНР', 'https://t.me/nedvizhimost_prodaja_lnr', 'main', '2026-02-26 18:58:14', 'Telegram', 'Недвижимость', 'chat', NULL, '', 0, NULL, NULL),
(3, 'Объявления Донбасса ЛНР | ДНР', 'https://t.me/obyavleniya_donbass', 'main', '2026-02-26 19:05:22', 'Telegram', 'Объявления', 'chat', NULL, '', 0, NULL, NULL),
(4, 'Канал Луганск & События A+', 'https://t.me/lnr_news_events', 'main', '2026-02-27 21:53:16', 'Telegram', 'Новости', 'channel', NULL, '', 0, 3500, 3500),
(5, 'Канал Пешком по Луганску | Афиша Новости', 'https://t.me/afisha_lnr', 'main', '2026-02-27 21:53:16', 'Telegram', 'Новости', 'channel', NULL, '', 0, 500, 500),
(6, 'Канал Выплаты Зарплаты Пособия Луганск ЛНР ДНР РФ А+', 'https://t.me/vzplnr', 'main', '2026-02-27 21:53:16', 'Telegram', 'Новости', 'channel', NULL, '', 0, 1400, 1400),
(7, 'Канал Шабашка Луганск ЛНР | ДНР Поиск мастеров', 'https://t.me/shabashka_lnr', 'main', '2026-02-27 21:53:16', 'Telegram', 'Услуги', 'channel', NULL, '', 0, NULL, NULL),
(8, 'Канал Подслушано в Луганске', 'https://t.me/podslushanoLNR_1', 'main', '2026-02-27 21:53:16', 'Telegram', 'Общение', 'channel', NULL, '', 0, NULL, 1300),
(9, 'Недвижимость Аренда ЛНР | ДНР', 'https://t.me/arenda_prodaja_lnr', 'main', '2026-02-27 21:53:16', 'Telegram', 'Недвижимость', 'chat', NULL, '', 0, NULL, NULL),
(10, 'Работа Луганск | Вакансии ЛНР | ДНР', 'https://t.me/rabota_lg', 'main', '2026-02-27 21:53:16', 'Telegram', 'Работа', 'chat', NULL, '', 0, NULL, NULL),
(13, 'Пешком по Луганску | Афиша Новости  резерв', 'https://t.me/afisha_lnr1', 'reserve', '2026-02-27 21:53:16', 'Telegram', 'Новости', 'chat', NULL, NULL, 0, NULL, NULL),
(14, 'Канал Подслушано в Луганске  резерв', 'https://t.me/podslushanoLNR_2', 'reserve', '2026-02-27 21:53:16', 'Telegram', 'Общение', 'channel', NULL, '', 0, NULL, NULL),
(15, 'Канал Выплаты Зарплаты Пособия Луганск ЛНР ДНР РФ  резерв', 'https://t.me/vzplnr1', 'reserve', '2026-02-27 21:53:16', 'Telegram', 'Новости', 'channel', NULL, '', 0, NULL, NULL),
(16, 'Канал Луганск & События  резерв', 'https://t.me/lnr_news_events2', 'reserve', '2026-02-27 21:53:16', 'Telegram', 'Объявления', 'channel', NULL, '', 0, NULL, NULL),
(17, 'Отдам БЕСПЛАТНО ЛНР | ДНР РЕЗЕРВ', 'https://t.me/besplatno_lugansk1', 'reserve', '2026-02-27 21:53:16', 'Telegram', 'Объявления', 'chat', NULL, '', 0, NULL, NULL),
(18, 'Канал Приму в дар 🎁 Отдам даром ЛНР ДНР  резерв', 'https://t.me/mir_darov1', 'reserve', '2026-02-27 21:53:16', 'Telegram', 'Объявления', 'channel', NULL, '', 0, NULL, NULL),
(19, 'Фермер-садовод ЛНР | ДНР', 'https://t.me/fermer_lnr1', 'main', '2026-02-27 21:53:16', 'Telegram', 'Хобби', 'channel', NULL, '', 0, NULL, NULL),
(20, 'Авторынок | Продажа авто ЛНР | ДНР  Резерв', 'https://t.me/avtomarket_lnr1', 'reserve', '2026-02-27 21:53:16', 'Telegram', 'Авто/Мото', 'chat', NULL, '', 0, NULL, NULL),
(21, 'Канал Шабашка Луганск ЛНР | ДНР Поиск мастеров  резерв', 'https://t.me/shabashka_lnr1', 'reserve', '2026-02-27 21:53:16', 'Telegram', 'Услуги', 'chat', NULL, '', 0, NULL, NULL),
(22, 'Знакомства ЛНР | ДНР Резерв', 'https://t.me/znakomstvo_lnr1', 'reserve', '2026-02-27 21:53:16', 'Telegram', 'Общение', 'chat', NULL, '', 0, NULL, NULL),
(23, 'Чёрный | Белый список ЛНР | ДНР Резерв', 'https://t.me/blackwhite_list_lnr1', 'reserve', '2026-02-27 21:53:16', 'Telegram', 'Объявления', 'chat', NULL, '', 0, NULL, NULL),
(24, 'Луганск&События  чат резерв', 'https://t.me/nash_lugansk1', 'reserve', '2026-02-27 21:53:16', 'Telegram', 'Общение', 'chat', NULL, '', 0, NULL, NULL),
(25, 'Водитель по - лугански Резерв', 'https://t.me/driverlnr1', 'reserve', '2026-02-27 21:53:16', 'Telegram', 'Авто/Мото', 'chat', NULL, '', 0, NULL, NULL),
(26, 'Барахолка Донбасса | Доска объявлений', 'https://t.me/avito_donbassa', 'main', '2026-02-27 21:53:16', 'Telegram', 'Объявления', 'chat', NULL, '', 0, NULL, NULL),
(27, 'Объявления Луганск | ЛНР | ДНР Барахолка  резерв', 'https://t.me/baraholka_lg1', 'reserve', '2026-02-27 21:53:16', 'Telegram', 'Объявления', 'chat', NULL, '', 0, NULL, NULL),
(28, 'ОЛХ ЛНР ДНР | Барахолка ДОНБАССА  Резерв', 'https://t.me/obyavleniya_lnr2', 'reserve', '2026-02-27 21:53:16', 'Telegram', 'Объявления', 'chat', NULL, '', 0, NULL, NULL),
(29, 'Работа в Луганске и ЛНР | ДНР Вакансии', 'https://t.me/rabota_lg1', 'reserve', '2026-02-27 21:53:16', 'Telegram', 'Работа', 'chat', NULL, '', 0, NULL, NULL),
(30, 'Вакансии в Луганске ЛНР | ДНР Работа Резерв', 'https://t.me/rabota_donbass_lnr1', 'reserve', '2026-02-27 21:53:16', 'Telegram', 'Работа', 'chat', NULL, '', 0, NULL, NULL),
(31, 'Автолюбители Луганска|ЛНР |ДНР Контроль на дорогах', 'https://t.me/avto_lubiteli_lnr', 'main', '2026-02-27 21:53:16', 'Telegram', 'Авто/Мото', 'chat', NULL, '', 0, NULL, NULL),
(32, 'Объявления Луганск | ЛНР | ДНР Барахолка', 'https://t.me/baraholka_lg', 'main', '2026-02-27 21:53:16', 'Telegram', 'Объявления', 'chat', NULL, '', 0, NULL, NULL),
(33, 'Луганск&События  чат', 'https://t.me/nash_lugansk', 'main', '2026-02-27 21:53:16', 'Telegram', 'Общение', 'chat', NULL, '', 0, NULL, NULL),
(34, 'ДЕТСКАЯ БАРАХОЛКА ОБЪЯВЛЕНИЯ ЛНР | ДНР', 'https://t.me/baraholka_detskaya_lnr', 'main', '2026-02-27 21:53:16', 'Telegram', 'Объявления', 'chat', NULL, '', 0, NULL, NULL),
(35, 'Стройка Перестройка ДОНБАССА ЛНР | ДНР ОБЪЯВЛЕНИЯ', 'https://t.me/stroyka_remont_donbass', 'main', '2026-02-27 21:53:16', 'Telegram', 'Услуги', 'chat', NULL, '', 0, NULL, NULL),
(36, 'Вопрос-ответ | Полезный совет | ЛНР | ДНР', 'https://t.me/vopros_otvet_lnr', 'main', '2026-02-27 21:53:16', 'Telegram', 'Общение', 'chat', NULL, '', 0, NULL, NULL),
(37, 'Услуги | Обслуживание ЛНР | ДНР РЕЗЕРВ', 'https://t.me/uslugi_lnr1', 'reserve', '2026-02-27 21:53:16', 'Telegram', 'Услуги', 'chat', NULL, '', 0, NULL, NULL),
(38, 'Канал Приму в дар 🎁 Отдам даром ЛНР ДНР', 'https://t.me/mir_darov', 'main', '2026-02-27 21:53:16', 'Telegram', 'Объявления', 'channel', NULL, '', 0, NULL, NULL),
(39, 'Канал ЛУГАНСК Главный - Новости Live', 'https://t.me/glavnyi_v_luganske', 'main', '2026-02-27 21:53:16', 'Telegram', 'Новости', 'channel', NULL, '', 0, 500, 500),
(40, 'Объявления Животные ЛНР | ДНР', 'https://t.me/zveri_lnr', 'main', '2026-02-27 21:53:16', 'Telegram', 'Объявления', 'chat', NULL, '', 0, 300, NULL),
(41, 'Барахолка Мобильная ЛНР| ДНР |Apple Телефоны новые | бу-', 'https://t.me/mobilka_lnr', 'main', '2026-02-27 21:53:16', 'Telegram', 'Объявления', 'chat', NULL, '', 0, 300, NULL),
(43, 'Авторынок | Продажа авто ЛНР | ДНР', 'https://t.me/avtomarket_lnr', 'main', '2026-02-27 21:53:16', 'Telegram', 'Авто/Мото', 'chat', NULL, '', 0, 300, 1000),
(86, 'СтудLife Донбасс: Халява, Сессия, Тусовки', 'https://t.me/student_donbass', 'main', '2026-03-03 15:56:29', 'Telegram', 'Общение', 'chat', NULL, '', 0, NULL, NULL),
(88, 'Фермер-садовод ЛНР | ДНР', 'https://t.me/fermer_lnr', 'main', '2026-03-03 15:57:56', 'Telegram', 'Хобби', 'chat', NULL, '', 0, 300, NULL),
(169, 'Потерял - Нашёл ЛНР ДНР Бюро Находок', 'https://t.me/byuro_nahodok_lnr', 'main', '2026-03-04 07:38:45', 'Telegram', 'Общение', 'channel', NULL, '', 0, NULL, NULL),
(170, 'Такси | Регулярные Перевозки | Грузоперевозки |ЛНР ДНР', 'https://t.me/perevozki_donbas', 'main', '2026-03-04 07:38:45', 'Telegram', 'Поездки', 'channel', NULL, '', 0, NULL, NULL),
(171, 'Отдам БЕСПЛАТНО ЛНР | ДНР', 'https://t.me/besplatno_lugansk', 'main', '2026-03-04 07:38:45', 'Telegram', 'Объявления', 'channel', NULL, '', 0, NULL, NULL),
(172, 'Услуги | Обслуживание ЛНР | ДНР', 'https://t.me/uslugi_lnr', 'main', '2026-03-04 07:38:45', 'Telegram', 'Услуги', 'channel', NULL, '', 0, NULL, NULL),
(173, 'Потерял - Нашёл |ЛНР | ДНР Бюро Находок Chat', 'https://t.me/chat_byuro_nahodok_lnr', 'main', '2026-03-04 07:38:45', 'Telegram', 'Общение', 'channel', NULL, '', 0, NULL, NULL),
(174, 'ОЛХ ЛНР ДНР | Барахолка ДОНБАССА', 'https://t.me/obyavleniya_lnr', 'main', '2026-03-04 07:38:45', 'Telegram', 'Объявления', 'channel', NULL, '', 0, NULL, NULL),
(175, 'Знакомства Луганск ЛНР | ДНР', 'https://t.me/znakomstvo_lnr', 'main', '2026-03-04 07:38:45', 'Telegram', 'Общение', 'channel', NULL, '', 0, NULL, NULL),
(176, 'ТАЧКА ЗА СОТКУ |  АВТОРЫНОК ЛНР | ДНР', 'https://t.me/avto_sotka', 'main', '2026-03-04 07:38:45', 'Telegram', 'Авто/Мото', 'channel', NULL, '', 0, NULL, NULL),
(177, 'Канал Водитель по - лугански', 'https://t.me/driverlnr', 'main', '2026-03-04 07:38:45', 'Telegram', 'Авто/Мото', 'channel', NULL, '', 0, NULL, NULL),
(178, 'МотоМаркет ЛНР | ДНР Донбасс', 'https://t.me/motomarket_donbass', 'main', '2026-03-04 07:38:45', 'Telegram', 'Авто/Мото', 'channel', NULL, '', 0, NULL, NULL),
(179, 'ТехноБарахолка | Электроника | ЛНР | ДНР', 'https://t.me/tech_lnr_dnr', 'main', '2026-03-04 07:38:45', 'Telegram', 'Электроника', 'channel', NULL, '', 0, NULL, NULL),
(180, 'Компьютерная Барахолка ЛНР | ДНР', 'https://t.me/kpklugansk', 'main', '2026-03-04 07:38:45', 'Telegram', 'Электроника', 'channel', NULL, '', 0, NULL, NULL),
(181, 'Бартер |Обмен | Давай меняться', 'https://t.me/barter_obmenka', 'main', '2026-03-04 07:38:45', 'Telegram', 'Объявления', 'channel', NULL, '', 0, NULL, NULL),
(182, 'Вкусные Рецепты |Хозяйкины секреты | Советы', 'https://t.me/recepty_lnr', 'main', '2026-03-04 07:38:45', 'Telegram', 'Хобби', 'channel', NULL, '', 0, NULL, NULL),
(183, 'Рыбалка и Охота 🦆ЛНР | ДНР (', 'https://t.me/rubalka_ohotabest', 'main', '2026-03-04 07:38:45', 'Telegram', 'Хобби', 'channel', NULL, '', 0, NULL, NULL),
(184, 'Отдых у моря | Жилье от собственников', 'https://t.me/otduh_ymorya', 'main', '2026-03-04 07:38:45', 'Telegram', 'Недвижимость', 'channel', NULL, '', 0, NULL, NULL),
(185, 'Вакансии в Луганске ЛНР | ДНР Работа', 'https://t.me/rabota_donbass_lnr', 'main', '2026-03-04 07:38:45', 'Telegram', 'Работа', 'channel', NULL, '', 0, NULL, NULL),
(186, 'Канал МОТОР автоприколы автоновости', 'https://t.me/motor181', 'main', '2026-03-04 07:38:45', 'Telegram', 'Авто/Мото', 'channel', NULL, '', 0, NULL, NULL),
(187, 'Автозапчасти | Шины |Колеса | Разборка ЛНР | ДНР', 'https://t.me/zapchasti_lnr', 'main', '2026-03-04 07:38:45', 'Telegram', 'Авто/Мото', 'channel', NULL, '', 0, NULL, NULL),
(188, 'Попутчики ЛНР | ДНР', 'https://t.me/popytchik_lnr', 'main', '2026-03-04 07:38:45', 'Telegram', 'Поездки', 'channel', NULL, '', 0, NULL, NULL),
(189, 'Куплю Продам по городам', 'https://t.me/kupiprodai_local', 'main', '2026-03-04 07:38:45', 'Telegram', 'Объявления', 'channel', NULL, '', 0, NULL, NULL),
(190, 'Канал Признавашки Луганск . Ищу тебя', 'https://t.me/priznavashki_lnr', 'main', '2026-03-04 07:38:45', 'Telegram', 'Общение', 'channel', NULL, '', 0, NULL, NULL),
(191, 'Свет | Вода | Отопление |Коммуналка |Интернет ЛНР | ДНР', 'https://t.me/kommynalka_donbassa', 'main', '2026-03-04 07:38:45', 'Telegram', 'Новости', 'channel', NULL, '', 0, NULL, NULL),
(192, '🏡Недвижимость ЛНР |ДНР•Аренда|Сдача|Продажа', 'https://t.me/real_estate_donbass', 'main', '2026-03-04 07:38:45', 'Telegram', 'Недвижимость', 'channel', NULL, '', 0, NULL, NULL),
(193, 'Чёрный | Белый список ЛНР | ДНР', 'https://t.me/blackwhite_list_lnr', 'main', '2026-03-04 07:38:45', 'Telegram', 'Новости', 'channel', NULL, '', 0, NULL, NULL),
(194, 'Канал Объявления Донбасса ЛНР ДНР', 'https://t.me/obyavleniya_donbassa', 'main', '2026-03-04 07:38:45', 'Telegram', 'Объявления', 'channel', NULL, '', 0, NULL, NULL),
(195, 'Луганск Бьюти Объявления ЛНР | ДНР', 'https://t.me/lnr_beauty1', 'main', '2026-03-04 07:38:45', 'Telegram', 'Хобби', 'channel', NULL, '', 0, NULL, NULL),
(196, 'Шерстяной засранец🐱', 'https://t.me/sherstyanoy_zasranec', 'main', '2026-03-04 07:38:45', 'Telegram', 'Хобби', 'channel', NULL, '', 0, NULL, NULL),
(197, 'Канал Луганск & События', 'https://max.ru/lnr_news_events', 'main', '2026-03-04 07:38:45', 'MAX', 'Новости', 'channel', NULL, '', 0, NULL, NULL),
(198, 'Пешком по Луганску | Афиша Новости', 'https://max.ru/join/qZ8OPoAROn_3-NSYoI42EWGxFxqyedfpD4_Qz-uKu2U', 'main', '2026-03-04 07:38:45', 'MAX', 'Новости', 'channel', NULL, '', 0, NULL, NULL),
(199, 'Подслушано в Луганске', 'https://max.ru/podslushanoLNR_1', 'main', '2026-03-04 07:38:45', 'MAX', 'Общение', 'channel', NULL, '', 0, NULL, NULL),
(200, 'Выплаты Зарплаты Пособия Луганск ЛНР ДНР РФ', 'https://max.ru/vzplnr', 'main', '2026-03-04 07:38:45', 'MAX', 'Новости', 'channel', NULL, '', 0, NULL, NULL),
(201, 'ЛУГАНСК Главный - Новости Live', 'https://max.ru/join/-BOo9TMdcZ4DOCdn2NZsR4zEhNciuIsoPRvpQAigIko', 'main', '2026-03-04 07:38:45', 'MAX', 'Новости', 'channel', NULL, '', 0, NULL, NULL),
(202, 'Автомаркет | Продажа авто ЛНР | ДНР', 'https://max.ru/avtomarket_lnr', 'main', '2026-03-04 07:38:45', 'MAX', 'Авто/Мото', 'channel', NULL, '', 0, NULL, NULL),
(203, 'Работа в Луганске и ЛНР | ДНР Вакансии', 'https://max.ru/join/1iS1AcmcvdmY1nT0VcW0AyDANiPdcLYoedfbdbau8ik', 'main', '2026-03-04 07:38:45', 'MAX', 'Работа', 'channel', NULL, '', 0, NULL, NULL),
(204, 'Мамы и Папы Луганска ЛНР | ДНР', 'https://max.ru/join/jc3WKEqLwDOwv27kdd6OefPQ40lF9BrkeMSdYiohtW8', 'main', '2026-03-04 07:38:45', 'MAX', 'Общение', 'channel', NULL, '', 0, NULL, NULL),
(205, 'Услуги | Обслуживание ЛНР | ДНР', 'https://max.ru/join/bN2elFgPtJVwSjODgc3FQRoH8q_5Q4_Jgjg_XsDYuI8', 'main', '2026-03-04 07:38:45', 'MAX', 'Услуги', 'channel', NULL, '', 0, NULL, NULL),
(206, 'Попутчики ЛНР | ДНР', 'https://max.ru/join/dSGMwsFWJ_Yk4E9EFwSJazXBoAfkRhzWmd01Lr7FiP8', 'main', '2026-03-04 07:38:45', 'MAX', 'Поездки', 'channel', NULL, '', 0, NULL, NULL),
(207, 'Объявления Луганск | ЛНР | ДНР Барахолка Донбасса', 'https://max.ru/join/4TRTkE63eVMzeHPIAlNHgha587CAXL9WnEis_cLmqpY', 'main', '2026-03-04 07:38:45', 'MAX', 'Объявления', 'channel', NULL, '', 0, NULL, NULL),
(208, 'ТАЧКА ЗА СОТКУ | АВТОРЫНОК ЛНР | ДНР', 'https://max.ru/join/SnBnVjvbrbGyzcpcORKzL9Kzrq2IRLPblIfyTQkppJ0', 'main', '2026-03-04 07:38:45', 'MAX', 'Авто/Мото', 'channel', NULL, '', 0, NULL, NULL),
(209, 'Недвижимость Аренда Продажа  ЛНР | ДНР', 'https://max.ru/join/wq-4KEsiFgsF-DzRw5ra1zllNTe4XU6SplC0HpS-SW8', 'main', '2026-03-04 07:38:45', 'MAX', 'Недвижимость', 'channel', NULL, '', 0, NULL, NULL),
(210, 'ОЛХ ЛНР ДНР | Барахолка ДОНБАССА', 'https://max.ru/join/-U6TPe5whofu4q98LjYESh-NCdjDWT16_nyEUnQ_5iU', 'main', '2026-03-04 07:38:45', 'MAX', 'Объявления', 'channel', NULL, '', 0, NULL, NULL),
(211, 'Такси | Регулярные Перевозки | Грузоперевозки | ЛНР ДНР', 'https://max.ru/join/Mgk1d_pSBPEgRSrcFqu1jOC6UoLcJ95GA6KfyQ48OLI', 'main', '2026-03-04 07:38:45', 'MAX', 'Поездки', 'channel', NULL, '', 0, NULL, NULL),
(212, 'Объявления Донбасса ЛНР ДНР ', 'https://max.ru/join/rGLlKwn0upyQWb6SvJgna9NkeCSIOxsnxZhAn59GqA8', 'main', '2026-03-04 07:38:45', 'MAX', 'Объявления', 'channel', NULL, '', 0, NULL, NULL),
(213, 'Объявления Животные ЛНР | ДНР', 'https://max.ru/join/4ohXpdiSy45j1xMwkWGCYw4g2ZzOBWIURUslmBCXiNc', 'main', '2026-03-04 07:38:45', 'MAX', 'Объявления', 'channel', NULL, '', 0, NULL, NULL),
(214, 'Барахолка Донбасса | Доска объявлений', 'https://max.ru/join/Kzpf0J5hneCsXRvaFaBpL4gf4TqpjzkRfF6FEUzqvpA', 'main', '2026-03-04 07:38:45', 'MAX', 'Объявления', 'channel', NULL, '', 0, NULL, NULL),
(215, 'Отдам БЕСПЛАТНО ЛНР | ДНР', 'https://max.ru/join/aN5o7lNzcfd7RcL44X9KXc141U74GseNMYIAnkLyK8Y', 'main', '2026-03-04 07:38:45', 'MAX', 'Объявления', 'channel', NULL, '', 0, NULL, NULL),
(216, 'Работа Луганск | Вакансии ЛНР | ДНР', 'https://max.ru/join/PTKo49esE3BavazAT7FAnn_pwZXZ8jRqIr0GVC14TqM', 'main', '2026-03-04 07:38:45', 'MAX', 'Работа', 'channel', NULL, '', 0, NULL, NULL),
(217, 'Луганск&События', 'https://max.ru/join/o-e5WsWl5hEKXz-EJIjubM33W6o43XFafJkMrmTJoaA', 'main', '2026-03-04 07:38:45', 'MAX', 'Новости', 'channel', NULL, '', 0, NULL, NULL),
(218, 'Авторынок ЛНР ДНР', 'https://max.ru/join/-hyZoZqppJOt1L2GwIeZiT1gSDRU2AbAi5yITXmE4G8', 'main', '2026-03-04 07:38:45', 'MAX', 'Авто/Мото', 'channel', NULL, '', 0, NULL, NULL),
(219, 'Автозапчасти | Шины |Колеса| Разборка ЛНР| ДНР', 'https://max.ru/join/oNzb_8New-GhKC5qRV2Q6-WL1Q2F_UsllEAvfhrFz3o', 'main', '2026-03-04 07:38:45', 'MAX', 'Авто/Мото', 'channel', NULL, '', 0, NULL, NULL),
(220, 'Знакомства ЛНР | ДНР', 'https://max.ru/join/l8SrMNDhACfrHb05IOwNzBqnci3Br-tNtLY3uGKi-bM', 'main', '2026-03-04 07:38:45', 'MAX', 'Общение', 'channel', NULL, '', 0, NULL, NULL),
(221, 'Луганск по районам', 'https://max.ru/join/9EfCvJx0Gy5a4IsQ-_p6s6nxQLIEVXeG6-lC3Xu7CsM', 'main', '2026-03-04 07:38:45', 'MAX', 'Новости', 'channel', NULL, '', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`name`, `value`) VALUES
('show_reserve', '0');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Индексы таблицы `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `url` (`url`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`name`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=410;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
