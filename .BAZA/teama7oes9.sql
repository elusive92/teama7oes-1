-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 11 Lis 2014, 19:16
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

--
-- RELACJE TABELI `blacklists`:
--   `id_A`
--       `users` -> `id`
--   `id_B`
--       `users` -> `id`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `conversations`
--

CREATE TABLE IF NOT EXISTS `conversations` (
`id` int(11) NOT NULL,
  `id_A` int(11) NOT NULL,
  `id_B` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `friendlist`
--

CREATE TABLE IF NOT EXISTS `friendlist` (
`id` int(11) NOT NULL,
  `id_adding` int(11) NOT NULL,
  `id_friend` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

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
(8, 3, 1, '2014-11-11 15:07:34');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `games`
--

INSERT INTO `games` (`id`, `gamename`, `descript`, `logo`) VALUES
(1, 'Pokemon', 'Gra w pokemony , red blue itp', 'pokemon.jpg');

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
  `recivedate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

--
-- RELACJE TABELI `messages`:
--   `conversation_id`
--       `conversations` -> `id`
--   `user_id`
--       `users` -> `id`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `news`
--

CREATE TABLE IF NOT EXISTS `news` (
`id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `descript` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `photo` varchar(20) COLLATE utf8_polish_ci DEFAULT NULL,
  `draft` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=4 ;

--
-- RELACJE TABELI `news`:
--   `game_id`
--       `games` -> `id`
--

--
-- Zrzut danych tabeli `news`
--

INSERT INTO `news` (`id`, `game_id`, `title`, `descript`, `photo`, `draft`, `created_at`, `updated_at`) VALUES
(3, 1, 'POkemony do boju', 'nowy post o pokemonach. Dizsiaj wchodzi nowa gra do boju o wolnosc', NULL, 0, '2014-11-11 18:02:34', '2014-11-11 17:01:53');

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
  `joindate` datetime NOT NULL,
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
(1, 1, 4, '2014-11-11 11:24:06', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) DEFAULT NULL,
  `teamname` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `logo` varchar(20) COLLATE utf8_polish_ci DEFAULT NULL,
  `ranking` int(5) NOT NULL DEFAULT '1000',
  `win` int(4) NOT NULL DEFAULT '0',
  `lose` int(4) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=5 ;

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
(4, 1, NULL, 'PokeCenter', NULL, 1000, 0, 0, 0, '2014-11-11 11:24:06', '2014-11-11 11:24:06');

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
  `regdate` datetime NOT NULL,
  `startdate` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

--
-- RELACJE TABELI `tournaments`:
--   `game_id`
--       `games` -> `id`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `password_temp`, `code`, `active`, `permissions`, `about`, `created_at`, `updated_at`, `photo`, `remember_token`, `comefrom`) VALUES
(1, 'elusive9225@gmail.com', 'elusive92', '$2y$10$FbYsCManSOWJC/T9KreUHOMOWVIdIDRtJSPbPRKe2dvMv.rdOve5m', '', '', 1, 1, NULL, '2014-11-08 16:08:28', '2014-11-08 16:08:57', NULL, 'HdcJSdYYJoTyJdfqgtSaV6WH2n3TdzETUzUyB2Xvn4RtvbUVvttYQWhICJRC', ''),
(3, 'elusive92@gmail.com', 'elu', '$2y$10$rFEbfq9IDySqmxXIhM9lOuVVTboU9o7vBEJtVtNYFQixVJb9LrGpK', '', '', 1, 1, NULL, '2014-11-11 11:59:37', '2014-11-11 12:00:03', NULL, 'B6enKafVlYmixiIr4VY9As8HWdsnXnTtuAoDYpJCpK4Plebz6t9X12VrAI7m', '');

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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `conversations`
--
ALTER TABLE `conversations`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `friendlist`
--
ALTER TABLE `friendlist`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT dla tabeli `galleries`
--
ALTER TABLE `galleries`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `games`
--
ALTER TABLE `games`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `news`
--
ALTER TABLE `news`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT dla tabeli `tournamentmembers`
--
ALTER TABLE `tournamentmembers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `tournaments`
--
ALTER TABLE `tournaments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
