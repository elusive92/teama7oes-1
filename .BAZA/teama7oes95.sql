-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 30 Lis 2014, 15:46
-- Wersja serwera: 5.6.20
-- Wersja PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `teama7oes`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `blacklists`
--

CREATE TABLE IF NOT EXISTS `blacklists` (
`id` int(11) NOT NULL,
  `id_A` int(11) NOT NULL,
  `id_B` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=3 ;

--
-- RELACJE TABELI `blacklists`:
--   `id_A`
--       `users` -> `id`
--   `id_B`
--       `users` -> `id`
--

--
-- Zrzut danych tabeli `blacklists`
--

INSERT INTO `blacklists` (`id`, `id_A`, `id_B`, `date`) VALUES
(2, 3, 4, '2014-11-12 16:31:20');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `conversations`
--

CREATE TABLE IF NOT EXISTS `conversations` (
`id` int(11) NOT NULL,
  `id_A` int(11) NOT NULL,
  `id_B` int(11) NOT NULL,
  `last_activity` datetime NOT NULL,
  `unreaded` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=2 ;

--
-- RELACJE TABELI `conversations`:
--   `id_B`
--       `users` -> `id`
--   `id_A`
--       `users` -> `id`
--

--
-- Zrzut danych tabeli `conversations`
--

INSERT INTO `conversations` (`id`, `id_A`, `id_B`, `last_activity`, `unreaded`) VALUES
(1, 3, 1, '2014-11-22 15:23:01', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `friendlist`
--

CREATE TABLE IF NOT EXISTS `friendlist` (
`id` int(11) NOT NULL,
  `id_adding` int(11) NOT NULL,
  `id_friend` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=6 ;

--
-- RELACJE TABELI `friendlist`:
--   `id_adding`
--       `users` -> `id`
--   `id_friend`
--       `users` -> `id`
--

--
-- Zrzut danych tabeli `friendlist`
--

INSERT INTO `friendlist` (`id`, `id_adding`, `id_friend`, `data`) VALUES
(1, 3, 1, '2014-11-12 15:20:16'),
(2, 3, 4, '2014-11-12 16:23:34'),
(3, 3, 5, '2014-11-12 17:38:21'),
(4, 6, 7, '2014-11-18 19:21:52'),
(5, 1, 3, '2014-11-22 15:23:37');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `galleries`
--

CREATE TABLE IF NOT EXISTS `galleries` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `descript` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `filename` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

--
-- RELACJE TABELI `galleries`:
--   `user_id`
--       `users` -> `id`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `games`
--

CREATE TABLE IF NOT EXISTS `games` (
`id` int(11) NOT NULL,
  `gamename` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `descript` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `logo` varchar(20) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `games`
--

INSERT INTO `games` (`id`, `gamename`, `descript`, `logo`) VALUES
(1, 'Pokemon', 'Gra w pokemony , red blue itp', 'pokemon.jpg'),
(2, 'LeagueofLegends', 'LeagueofLegends22', NULL),
(3, 'World of Warcraft', ' gra komputerowa z gatunku MMORPG wyprodukowana przez amerykańską firmę Blizzard Entertainment. Jej akcja toczy się cztery lata po wydarzeniach przedstawionych w grze Warcraft III: The Frozen Throne, w świecie stworzonym w 1994 roku na potrzeby Warcraft: ', NULL),
(4, 'Assassin Creed Unity', 'Kolejna pełnoprawna odsłona bestsellerowego cyklu Assassin’s Creed, zapoczątkowanego przez koncern Ubisoft w 2007 roku. Jest to jednocześnie pierwsza część gry, zaprojektowana wyłącznie z myślą o posiadaczach PC i konsol ósmej generacji. Nowa część gry to', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `matches`
--

CREATE TABLE IF NOT EXISTS `matches` (
`id` int(11) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `id_teamsA` int(11) DEFAULT NULL,
  `id_teamsB` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `result` int(1) NOT NULL,
  `round` int(10) NOT NULL,
  `bracket` int(11) NOT NULL,
  `resultA` int(1) NOT NULL,
  `resultB` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

--
-- RELACJE TABELI `matches`:
--   `id_teamsA`
--       `teams` -> `id`
--   `id_teamsB`
--       `teams` -> `id`
--   `tournament_id`
--       `tournaments` -> `id`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `matchsquad`
--

CREATE TABLE IF NOT EXISTS `matchsquad` (
`id` int(11) NOT NULL,
  `match_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `teammember_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

--
-- RELACJE TABELI `matchsquad`:
--   `match_id`
--       `matches` -> `id`
--   `team_id`
--       `teams` -> `id`
--   `teammember_id`
--       `teammembers` -> `id`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
`id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `senddate` datetime NOT NULL,
  `text` varchar(600) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=5 ;

--
-- RELACJE TABELI `messages`:
--   `conversation_id`
--       `conversations` -> `id`
--   `user_id`
--       `users` -> `id`
--

--
-- Zrzut danych tabeli `messages`
--

INSERT INTO `messages` (`id`, `conversation_id`, `user_id`, `senddate`, `text`) VALUES
(1, 1, 3, '2014-11-22 15:22:13', 'siema'),
(2, 1, 1, '2014-11-22 15:22:31', 'no hej'),
(3, 1, 3, '2014-11-22 15:22:56', 'testuje'),
(4, 1, 1, '2014-11-22 15:23:01', 'dziala');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `news`
--

CREATE TABLE IF NOT EXISTS `news` (
`id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `title` varchar(80) COLLATE utf8_polish_ci NOT NULL,
  `descript` varchar(3000) COLLATE utf8_polish_ci NOT NULL,
  `photo` varchar(20) COLLATE utf8_polish_ci DEFAULT NULL,
  `draft` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=13 ;

--
-- RELACJE TABELI `news`:
--   `game_id`
--       `games` -> `id`
--

--
-- Zrzut danych tabeli `news`
--

INSERT INTO `news` (`id`, `game_id`, `title`, `descript`, `photo`, `draft`, `created_at`, `updated_at`) VALUES
(4, 1, 'Czolgi', 'dodano aktualizacje do gry', NULL, 0, '2014-11-11 18:22:37', '2014-11-11 18:22:37'),
(5, 1, 'Koniec wojny ', 'Od 6:10 we wtorek, 11 listopada do 6:00 w poniedzia', NULL, 0, '2014-11-12 15:52:21', '2014-11-12 15:52:21'),
(6, 1, 'Specjal w czolgach', 'Pięciokrotnie więcej doświadczenia za pierwsze zwycięstwo dnia\r\n\r\nDoświadczenie to najpotężniejsza broń!\r\n\r\n15% zniżki na wszystkie pojazdy standardowe VIII poziomu\r\n\r\nCzas wspiąć się w górę drzewa technologicznego i zdobyć duże czołgi!', NULL, 0, '2014-11-12 15:53:37', '2014-11-12 15:53:37'),
(7, 1, 'Dalsze losy zwyciestw', '\r\n    Zdobądźcie 111 111 PD w dowolnej liczbie bitew.\r\n    Znajdźcie się pośród 11 graczy, którzy zdobyli najwięcej bazowego doświadczenia podczas bitwy w drużynie (premie za pierwsze zwycięstwo dnia, konto premium itd. nie będą brane pod uwagę).', NULL, 0, '2014-11-12 15:55:19', '2014-11-12 15:55:19'),
(8, 1, 'Assasin Cread', 'W historyczną rzeczywistość wmieszana jest historia zmagań Assasynów z Templariuszami, i chociaż działalność stronnictw przekłada się na historyczne wydarzenia, to w dalszym ciągu Unity mogłoby służyć jako znakomita pomoc naukowa w nauce historii tego okresu - choćby dlatego, że za sprawą gry ta historia i występujące w niej postacie ożywają: król Francji i król żebraków, Markiz de Sade i Robespierre, Napoleon i Vidoq wkraczają na scenę i zostawiają swój ślad w historii głównego bohatera Arno Doriana.\r\n\r\nWspinając się na 25 puktów widokowych francuskiej stolicy odkrywamy mapę Paryża ostatniej dekady osiemnastego wieku. Lud Paryża gromadzi się na placach i oblega budynki aktualnie sprawujących władzę. Barykady na ulicach, rewolucyjne napisy i dostrzegalne wszędzie ślady zniszczeń nie pozostawiają wątpliwości, że znaleźliśmy się w ważnym dziejowo momencie - słowem, idealna sceografia dla dramatu historycznego w jakim przyszło nam brać udział. Nie zamierzam zdradzać elementów fabuły, bo przechodząc Assasin’s Creed: Unity można się poczuć jak podczas oglądania hollywoodzkiej epopei.', NULL, 0, '2014-11-12 16:57:57', '2014-11-12 16:57:57'),
(12, 1, 'Oferta dnia w Gamersgate', 'Bus Simulator 2012 - 2.10£\r\n\r\nPo obniżonej cenie możecie również nabyć:\r\n\r\nDefenders of Ardania – 2€ - Steam\r\nDefenders of Ardania Collection – 2.00£ – Steam\r\nImpire – 2.99£ – Steam\r\nMagicka – 1.74£ – Steam\r\nMagicka Collection – 5.74£ – Steam\r\nMagicka – Four Pack – 7.49€ - Steam\r\nWarlock: Master of the Arcane Complete Collection – 4.75£ – Steam', NULL, 0, '2014-11-18 13:37:40', '2014-11-18 13:37:40');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `players`
--

CREATE TABLE IF NOT EXISTS `players` (
`id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nickname` varchar(20) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

--
-- RELACJE TABELI `players`:
--   `game_id`
--       `games` -> `id`
--   `user_id`
--       `users` -> `id`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `teamgalleries`
--

CREATE TABLE IF NOT EXISTS `teamgalleries` (
`id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `title` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `descript` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `filename` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

--
-- RELACJE TABELI `teamgalleries`:
--   `team_id`
--       `teams` -> `id`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `teaminvitations`
--

CREATE TABLE IF NOT EXISTS `teaminvitations` (
`id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

--
-- RELACJE TABELI `teaminvitations`:
--   `team_id`
--       `teams` -> `id`
--   `user_id`
--       `users` -> `id`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `teammembers`
--

CREATE TABLE IF NOT EXISTS `teammembers` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `joindate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `leftdate` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=2 ;

--
-- RELACJE TABELI `teammembers`:
--   `user_id`
--       `users` -> `id`
--   `team_id`
--       `teams` -> `id`
--

--
-- Zrzut danych tabeli `teammembers`
--

INSERT INTO `teammembers` (`id`, `user_id`, `team_id`, `joindate`, `leftdate`) VALUES
(1, 3, 1, '2014-11-30 13:31:38', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `teamname` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `logo` varchar(20) COLLATE utf8_polish_ci DEFAULT NULL,
  `ranking` int(5) NOT NULL DEFAULT '1000',
  `win` int(4) NOT NULL DEFAULT '0',
  `lose` int(4) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=2 ;

--
-- RELACJE TABELI `teams`:
--   `user_id`
--       `users` -> `id`
--   `game_id`
--       `games` -> `id`
--

--
-- Zrzut danych tabeli `teams`
--

INSERT INTO `teams` (`id`, `user_id`, `game_id`, `teamname`, `logo`, `ranking`, `win`, `lose`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 2, 'Test1', NULL, 1000, 0, 0, 0, '2014-11-30 14:31:38', '2014-11-30 14:31:38');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tournamentmembers`
--

CREATE TABLE IF NOT EXISTS `tournamentmembers` (
`id` int(11) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `position` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

--
-- RELACJE TABELI `tournamentmembers`:
--   `tournament_id`
--       `tournaments` -> `id`
--   `team_id`
--       `teams` -> `id`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tournaments`
--

CREATE TABLE IF NOT EXISTS `tournaments` (
`id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `numberofteams` int(5) NOT NULL,
  `numberofplayers` int(2) NOT NULL,
  `name` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `descript` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `regdate` date NOT NULL,
  `startdate` date NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=2 ;

--
-- RELACJE TABELI `tournaments`:
--   `game_id`
--       `games` -> `id`
--

--
-- Zrzut danych tabeli `tournaments`
--

INSERT INTO `tournaments` (`id`, `game_id`, `numberofteams`, `numberofplayers`, `name`, `descript`, `regdate`, `startdate`, `status`) VALUES
(1, 2, 32, 64, 'Big Bang 4', 'Rozgrywki w LoLa. Zmiazdz przeciwnikow', '2014-11-23', '2014-11-30', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `username` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_polish_ci NOT NULL,
  `password_temp` varchar(60) COLLATE utf8_polish_ci NOT NULL,
  `code` varchar(60) COLLATE utf8_polish_ci NOT NULL,
  `active` int(11) NOT NULL,
  `permissions` int(1) NOT NULL DEFAULT '0',
  `about` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `photo` varchar(20) COLLATE utf8_polish_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `comefrom` varchar(20) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=11 ;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `password_temp`, `code`, `active`, `permissions`, `about`, `created_at`, `updated_at`, `photo`, `remember_token`, `comefrom`) VALUES
(1, 'elusive9225@gmail.com', 'elusive92', '$2y$10$FbYsCManSOWJC/T9KreUHOMOWVIdIDRtJSPbPRKe2dvMv.rdOve5m', '', '', 1, 1, 'Lubie grac w lola', '2014-11-08 16:08:28', '2014-11-08 16:08:57', NULL, 'Syev56lwRXqLyBZA3e30cOVpHfUFYtvNPdaxWa1Lp4dWUBOCj9taMVCScteb', ''),
(3, 'elusive92@gmail.com', 'elu', '$2y$10$rFEbfq9IDySqmxXIhM9lOuVVTboU9o7vBEJtVtNYFQixVJb9LrGpK', '', '', 1, 1, 'Mam ksywke radzio', '2014-11-11 11:59:37', '2014-11-11 12:00:03', NULL, 'ZtXgq4vTwLJhZ6SWk5hUipTJLkgyjcdHF4msMtBNu5VKLYRkTBV7XgGXsAh8', ''),
(4, 'el@gmail.com', 'arek', '$2y$10$ctWyqoJ5J7rNtfFjwodcgu8ESFTGc6Vb3zChhFTjhbg1kiW/kBuG6', '', '', 1, 0, NULL, '2014-11-12 15:45:07', '2014-11-12 15:45:07', NULL, 'kR9i6ecuL40PCDgSm3vH7GEG2uHKEq2IEArpRKthAW0ddEcJeBxZy3ZvrsAp', ''),
(5, 'els@gmail.com', 'marcinnic', '$2y$10$eg6Sd1fXbgPovLVaLtdG6Ol2IqCgt3gewiOdxqzV62gnTG9Jv.C8C', '', '', 1, 0, 'Jestem czarny, bialy i lubie biale kotki!', '2014-11-12 15:45:37', '2014-11-12 15:45:37', NULL, '', ''),
(6, 'test@gmail.com', 'test', '$2y$10$xCNH8A1cvkw4rxUZo0ncNeOzDMiMr7RybA2xJsBTwP7yWKHqN.ER2', '', '', 1, 0, 'Konto testowe1', '2014-11-18 13:28:08', '2014-11-18 13:28:08', NULL, 'BerWpowzoBB1tFFWfK1LvYZQfVqjW7BAO3MAbd5fbWha3MWT7rQ0fIhfWia1', ''),
(7, 'test1@gmail.com', 'test1', '$2y$10$yuleFeQkJ/l67oQCa3QA5ebUEfXmYvSdKjLzFh7i/qZwJBbmm6phG', '', '81B0jHgUAvtuAKqZJBwxw5PUeZUKZKAJEQQ3u6Xiln0Uql5fAJGW9upMRk5l', 0, 0, NULL, '2014-11-18 13:31:54', '2014-11-18 13:31:54', NULL, '', ''),
(8, 'test2@gmail.com', 'test2', '$2y$10$HD3z6HNHokg6vU3mZ6iisee5ex5R0PC.sfGFfv5gkRTvhOfgAXRcy', '', '', 1, 0, NULL, '2014-11-18 13:32:45', '2014-11-18 13:32:45', NULL, '', ''),
(9, 'test3@gmail.com', 'test3', '$2y$10$dmr1HmvbI65N6HRlP2rCeOabvy/HOGjv/ua6BpHebNClS2mTDGgPC', '', '', 1, 0, NULL, '2014-11-18 13:33:07', '2014-11-18 13:33:07', NULL, '', ''),
(10, 'admin1@gmail.com', 'admin1', '$2y$10$v4kQuOQlWodWOGev4oq53O8AZCi8eJz9AAV8Cm3MROyP.yqHWHhau', '', '', 1, 1, NULL, '2014-11-18 13:33:26', '2014-11-18 13:33:26', NULL, '9bQ7n6yKS1ABh5qEmOmjuPyQzEDufBu49ITQO88N9ABxEyjMb4pMoqcIXplI', '');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `blacklists`
--
ALTER TABLE `blacklists`
 ADD PRIMARY KEY (`id`), ADD KEY `idA` (`id_A`), ADD KEY `idB` (`id_B`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
 ADD PRIMARY KEY (`id`), ADD KEY `idA` (`id_A`), ADD KEY `idB` (`id_B`);

--
-- Indexes for table `friendlist`
--
ALTER TABLE `friendlist`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`), ADD KEY `adding` (`id_adding`), ADD KEY `friend` (`id_friend`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
 ADD PRIMARY KEY (`id`), ADD KEY `id` (`user_id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
 ADD PRIMARY KEY (`id`), ADD KEY `idtournament` (`tournament_id`), ADD KEY `idteamA` (`id_teamsA`), ADD KEY `idteamB` (`id_teamsB`);

--
-- Indexes for table `matchsquad`
--
ALTER TABLE `matchsquad`
 ADD PRIMARY KEY (`id`), ADD KEY `idteam` (`team_id`), ADD KEY `id` (`teammember_id`), ADD KEY `idteam_2` (`team_id`), ADD KEY `id_2` (`teammember_id`), ADD KEY `idmatch` (`match_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
 ADD PRIMARY KEY (`id`), ADD KEY `idA` (`user_id`), ADD KEY `idcon` (`conversation_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
 ADD PRIMARY KEY (`id`), ADD KEY `idgame` (`game_id`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
 ADD PRIMARY KEY (`id`), ADD KEY `idgame` (`game_id`), ADD KEY `id` (`user_id`);

--
-- Indexes for table `teamgalleries`
--
ALTER TABLE `teamgalleries`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`), ADD KEY `idteam` (`team_id`);

--
-- Indexes for table `teaminvitations`
--
ALTER TABLE `teaminvitations`
 ADD PRIMARY KEY (`id`), ADD KEY `idteam` (`team_id`), ADD KEY `id` (`user_id`);

--
-- Indexes for table `teammembers`
--
ALTER TABLE `teammembers`
 ADD PRIMARY KEY (`id`), ADD KEY `id` (`user_id`), ADD KEY `idteam` (`team_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
 ADD PRIMARY KEY (`id`), ADD KEY `id` (`user_id`), ADD KEY `idgame` (`game_id`);

--
-- Indexes for table `tournamentmembers`
--
ALTER TABLE `tournamentmembers`
 ADD PRIMARY KEY (`id`), ADD KEY `idteam` (`team_id`), ADD KEY `idtournament` (`tournament_id`);

--
-- Indexes for table `tournaments`
--
ALTER TABLE `tournaments`
 ADD PRIMARY KEY (`id`), ADD KEY `idgame` (`game_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `blacklists`
--
ALTER TABLE `blacklists`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `conversations`
--
ALTER TABLE `conversations`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `friendlist`
--
ALTER TABLE `friendlist`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT dla tabeli `galleries`
--
ALTER TABLE `galleries`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `games`
--
ALTER TABLE `games`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT dla tabeli `matches`
--
ALTER TABLE `matches`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `matchsquad`
--
ALTER TABLE `matchsquad`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `messages`
--
ALTER TABLE `messages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT dla tabeli `news`
--
ALTER TABLE `news`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT dla tabeli `players`
--
ALTER TABLE `players`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `teamgalleries`
--
ALTER TABLE `teamgalleries`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `teaminvitations`
--
ALTER TABLE `teaminvitations`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `teammembers`
--
ALTER TABLE `teammembers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `teams`
--
ALTER TABLE `teams`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `tournamentmembers`
--
ALTER TABLE `tournamentmembers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `tournaments`
--
ALTER TABLE `tournaments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `blacklists`
--
ALTER TABLE `blacklists`
ADD CONSTRAINT `blacklists_ibfk_1` FOREIGN KEY (`id_A`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `blacklists_ibfk_2` FOREIGN KEY (`id_B`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `conversations`
--
ALTER TABLE `conversations`
ADD CONSTRAINT `conversations_ibfk_1` FOREIGN KEY (`id_B`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `conversations_ibfk_2` FOREIGN KEY (`id_A`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `friendlist`
--
ALTER TABLE `friendlist`
ADD CONSTRAINT `friendlist_ibfk_1` FOREIGN KEY (`id_adding`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `friendlist_ibfk_2` FOREIGN KEY (`id_friend`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `galleries`
--
ALTER TABLE `galleries`
ADD CONSTRAINT `galleries_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `matches`
--
ALTER TABLE `matches`
ADD CONSTRAINT `matches_ibfk_2` FOREIGN KEY (`id_teamsA`) REFERENCES `teams` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
ADD CONSTRAINT `matches_ibfk_3` FOREIGN KEY (`id_teamsB`) REFERENCES `teams` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
ADD CONSTRAINT `matches_ibfk_4` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `matchsquad`
--
ALTER TABLE `matchsquad`
ADD CONSTRAINT `matchsquad_ibfk_1` FOREIGN KEY (`match_id`) REFERENCES `matches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `matchsquad_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `matchsquad_ibfk_3` FOREIGN KEY (`teammember_id`) REFERENCES `teammembers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `messages`
--
ALTER TABLE `messages`
ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `news`
--
ALTER TABLE `news`
ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `players`
--
ALTER TABLE `players`
ADD CONSTRAINT `players_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `players_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `teamgalleries`
--
ALTER TABLE `teamgalleries`
ADD CONSTRAINT `teamgalleries_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `teaminvitations`
--
ALTER TABLE `teaminvitations`
ADD CONSTRAINT `teaminvitations_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `teaminvitations_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `teammembers`
--
ALTER TABLE `teammembers`
ADD CONSTRAINT `teammembers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `teammembers_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `teams`
--
ALTER TABLE `teams`
ADD CONSTRAINT `teams_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `teams_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `tournamentmembers`
--
ALTER TABLE `tournamentmembers`
ADD CONSTRAINT `tournamentmembers_ibfk_1` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tournamentmembers_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `tournaments`
--
ALTER TABLE `tournaments`
ADD CONSTRAINT `tournaments_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Zdarzenia
--
CREATE DEFINER=`root`@`localhost` EVENT `KasowanieZaproszen` ON SCHEDULE EVERY 1 DAY STARTS '2014-11-17 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM `teaminvitations` WHERE CURRENT_TIMESTAMP - `date`>7$$

CREATE DEFINER=`root`@`localhost` EVENT `KasowanieWiadomosci` ON SCHEDULE EVERY 5 DAY STARTS '2014-11-23 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM `messages` WHERE CURRENT_TIMESTAMP - `senddate`>180$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
